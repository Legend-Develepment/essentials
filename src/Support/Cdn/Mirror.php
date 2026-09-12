<?php

namespace LegendDevelopment\Theme\Support\Cdn;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use LegendDevelopment\Theme\Support\Channels;
use LegendDevelopment\Theme\Support\Languages;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Translations;
use Throwable;

/**
 * An off-panel copy of every language this panel can answer in.
 *
 * **Every language the panel can answer in**, the shipped ones and the uploaded
 * ones together, as the document the download button produces. The shipped ones
 * are there so that the address is worth pointing something at - another panel,
 * a bot, a site - and the uploaded ones because they are the half that can
 * actually be lost.
 *
 * They are sent under different rules, because they change for different
 * reasons. **A shipped language changes when the plugin is released**, so the
 * version is the whole of the question and it is asked once per pass. **An
 * uploaded one changes when a person edits it**, so each is hashed every pass -
 * there are never many, and a hash is cheap next to being wrong.
 *
 * The plugin half survives a plugin update - it sits in the application's
 * language directory rather than in the plugin folder, deliberately. **The
 * panel half does not survive a Pelican upgrade**, because that extracts its
 * own release over the panel and takes its own language files with it, and the
 * panel half lives among them. That is the loss this is for.
 *
 * **The timer decides when to look, not when to send.** Each language is turned
 * into the same document the download button produces, hashed, and compared
 * with what was last sent. An ordinary minute reads a few files, hashes them
 * and stops. Without that gate this would be several hundred kilobytes a minute
 * for something that changes when a person edits it.
 *
 * **It pushes. Restoring is a button somebody presses.** There is no way to
 * remove an installed language from the panel, so a bad file arriving on its
 * own would be a door that opens one way. And a restore overwrites what is
 * here, which is a thing to mean rather than a thing to schedule.
 */
class Mirror
{
    /**
     * Where they sit, and it is the same on every panel.
     *
     * Deliberately outside the per-panel folder: a language is not one panel's
     * property, and the reason to put one on a CDN at all is that the address
     * is the same wherever it is asked for - another panel, a bot, a site.
     *
     * The consequence, said out loud: two panels pointed at one CDN account
     * share these files, and the second one to send wins. That is what sharing
     * means, and it is the arrangement somebody asking for a fixed address is
     * asking for.
     */
    public const FOLDER = 'essentials/Languages';

    /** What was last sent, so an unchanged language is not sent again. */
    private const STATE = 'legend-theme/translation-mirror.json';

    /** Long enough for a slow CDN and no longer. */
    private const TIMEOUT = 20;

    /**
     * Send anything that has changed since last time.
     *
     * @return array{looked: int, sent: int, failed: int}
     */
    public static function push(): array
    {
        $out = ['looked' => 0, 'sent' => 0, 'failed' => 0];

        if (!Uploads::on()) {
            return $out;
        }

        $was = self::state();
        $now = [];
        $mine = Translations::uploaded();

        /*
         * The shipped ones, and only when the plugin has moved.
         *
         * Building one is reading forty files and flattening four thousand
         * keys, and there are thirty of them. Doing that every minute to
         * discover that a release has not happened is a third of a second per
         * minute for ever; the version answers the same question for nothing.
         */
        $version = trim(Channels::installedVersion());
        $shipped = ((string) ($was['_version']['at'] ?? '')) === $version
            ? []
            : array_values(array_diff(Languages::available(), $mine));

        foreach (array_merge($mine, $shipped) as $code) {
            $out['looked']++;

            try {
                $body = Translations::json($code);
            } catch (Throwable $exception) {
                report($exception);
                $out['failed']++;

                continue;
            }

            $hash = hash('sha256', $body);
            $before = is_array($was[$code] ?? null) ? $was[$code] : [];

            // Unchanged, and the address it went to is still known. Nothing to
            // do, which is what almost every minute looks like.
            if (($before['hash'] ?? null) === $hash && trim((string) ($before['url'] ?? '')) !== '') {
                $now[$code] = $before;

                continue;
            }

            $url = Uploads::put(self::FOLDER, $code . '.json', $body, 'application/json', true);

            if ($url === null) {
                $out['failed']++;

                // Keep what was known. A failed send does not unlearn where the
                // last good copy is.
                if ($before !== []) {
                    $now[$code] = $before;
                }

                continue;
            }

            $out['sent']++;

            /*
             * Whose language this is, written down at the moment it is known.
             *
             * A restore has to tell a language somebody made from one the
             * plugin ships, and the document itself cannot say: it is the two
             * halves already merged. Here the answer is in hand, so it is kept.
             */
            $now[$code] = [
                'hash' => $hash,
                'url' => $url,
                'own' => in_array($code, $mine, true),
                'at' => now()->toDateTimeString(),
            ];
        }

        /*
         * And everything this pass did not look at stays known.
         *
         * $now replaces the state wholesale, so a pass that skipped the shipped
         * languages - which is every pass after the first on one version - was
         * dropping thirty-two addresses and rewriting the index with one entry
         * in it. What was not examined is not thereby gone.
         */
        foreach ($was as $code => $row) {
            if (!array_key_exists($code, $now)) {
                $now[$code] = $row;
            }
        }

        /*
         * What was sent for this version, so the next pass can skip the shipped
         * ones. Kept beside them rather than anywhere else, because it is only
         * ever true of the copy this file describes.
         */
        $now['_version'] = ['at' => $version];

        /*
         * And a list of what is up there, so a restore does not have to guess
         * which languages exist. Written only when the set of them changes:
         * it is the one file here that is not somebody's work.
         */
        if (array_keys($now) !== array_keys($was)) {
            $index = Uploads::put(
                self::FOLDER,
                'index.json',
                (string) json_encode(array_values(array_diff(array_keys($now), ['_index', '_version']))),
                'application/json',
                true,
            );

            if ($index !== null) {
                $now['_index'] = ['url' => $index, 'at' => now()->toDateTimeString()];
            } elseif (isset($was['_index'])) {
                $now['_index'] = $was['_index'];
            }
        } elseif (isset($was['_index'])) {
            $now['_index'] = $was['_index'];
        }

        self::remember($now);

        return $out;
    }

    /**
     * Put back what is up there.
     *
     * Pressed by a person, after an upgrade has taken the panel half of a
     * language with it. Every language in the copy is installed over whatever
     * is here, which is the point: what is here is the thing that was lost.
     *
     * @return array{found: int, put: int, failed: int}
     */
    public static function pull(): array
    {
        $out = ['found' => 0, 'put' => 0, 'failed' => 0];
        $state = self::state();

        foreach ($state as $code => $row) {
            if ($code === '_index' || $code === '_version' || !is_array($row)) {
                continue;
            }

            $url = trim((string) ($row['url'] ?? ''));

            if ($url === '') {
                continue;
            }

            $out['found']++;

            try {
                $response = Http::timeout(self::TIMEOUT)->get($url);

                if (!$response->successful()) {
                    $out['failed']++;

                    continue;
                }

                $flat = $response->json();

                if (!is_array($flat) || $flat === []) {
                    $out['failed']++;

                    continue;
                }

                /*
                 * A language somebody made comes back whole. One the plugin
                 * ships comes back without this plugin's half.
                 *
                 * That half was never lost - it arrives with every release -
                 * and writing it back would put it in the override directory,
                 * where it wins over the plugin's own file for ever. Every
                 * correction in every later release would then be invisible on
                 * this panel, and nothing would say why. The panel's half is a
                 * different matter and is the whole reason to press this: a
                 * Pelican upgrade really does take it away.
                 *
                 * Rows written before this was recorded have no answer in them,
                 * and a code the plugin does not ship can only be somebody's
                 * own, so the two together cover those as well.
                 */
                $own = (bool) ($row['own'] ?? false) || !Languages::ships((string) $code);

                if (!$own) {
                    $prefix = Translations::prefix();

                    $flat = array_filter(
                        $flat,
                        static fn (string $key): bool => !str_starts_with($key, $prefix),
                        ARRAY_FILTER_USE_KEY,
                    );
                }

                if ($flat === []) {
                    continue;
                }

                Translations::install((string) $code, $flat);
                $out['put']++;
            } catch (Throwable $exception) {
                report($exception);
                $out['failed']++;
            }
        }

        return $out;
    }

    /**
     * What is known about the copy, for the page that reports it.
     *
     * @return array<int, array{code: string, url: string, at: string}>
     */
    public static function known(): array
    {
        $out = [];

        foreach (self::state() as $code => $row) {
            if ($code === '_index' || $code === '_version' || !is_array($row)) {
                continue;
            }

            $out[] = [
                'code' => (string) $code,
                'url' => (string) ($row['url'] ?? ''),
                'at' => (string) ($row['at'] ?? ''),
            ];
        }

        return $out;
    }

    /**
     * What was last sent.
     *
     * A file rather than the cache, for the same reason the webhook's log is
     * one: a cache that is cleared on deploy would turn the first minute after
     * every deploy into a full send of every language.
     *
     * @return array<string, array<string, mixed>>
     */
    private static function state(): array
    {
        try {
            $disk = Storage::disk('local');

            if (!$disk->exists(self::STATE)) {
                return [];
            }

            $found = json_decode((string) $disk->get(self::STATE), true);
        } catch (Throwable) {
            return [];
        }

        return is_array($found) ? $found : [];
    }

    /** @param  array<string, array<string, mixed>>  $state */
    private static function remember(array $state): void
    {
        try {
            Storage::disk('local')->put(self::STATE, (string) json_encode($state));
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    /**
     * Forget a language, so Restore does not bring it back.
     *
     * Without this, removing an uploaded language on the panel would last until
     * somebody pressed Restore and the copy walked back in. The address is
     * dropped rather than the file: there is no way to delete from a bucket
     * through Uploads, and a file nothing points at costs a few kilobytes and
     * is the only copy left of something somebody spent an evening on.
     */
    public static function forget(string $code): bool
    {
        $state = self::state();

        if ($code === '' || !array_key_exists($code, $state)) {
            return false;
        }

        unset($state[$code]);
        self::remember($state);

        return true;
    }

    /** Whether there is anywhere to send them and anything to send. */
    public static function ready(): bool
    {
        try {
            return Uploads::on() && Languages::available() !== [];
        } catch (Throwable) {
            return false;
        }
    }

    /** How often the timer looks, in minutes, as an administrator set it. */
    public static function minutes(): int
    {
        $minutes = (int) Theme::config('files_mirror_minutes', 1);

        return max(1, min(1440, $minutes));
    }
}
