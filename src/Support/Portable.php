<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The settings as a file: out, and back in again.
 *
 * What it is for. Moving a look from a test panel to a live one without setting
 * sixty fields twice; keeping a copy before trying something, so there is
 * something to go back to; handing your look to somebody else.
 *
 * What it deliberately leaves out is the uploads - the sign-in picture, the
 * background, the icon pack. Those are files on a disk, and a settings file that
 * quietly did not include them would be worse than one that says so: you would
 * import it, see the picture missing, and have no way to tell whether it had
 * been left out or lost.
 *
 * An imported file is a file from outside. Nothing here writes anything: it
 * produces a settings array which goes through Settings::persist(), the same
 * path the form uses, so every value meets the same sanitiser it would have met
 * had it been typed in. Import is the third caller of those sanitisers and is
 * not given a path of its own.
 */
class Portable
{
    /** What the file says it is, so a wrong file can be turned away as one. */
    private const MARKER = 'legend-theme-settings';

    /**
     * The two settings that are lists rather than values.
     *
     * They live in storage/app/private/legend-theme rather than in .env, which is why
     * they were missing from the file for as long as they were: everything else
     * here comes from Settings::data() and these two do not go through it at
     * all. A settings file that quietly left out every announcement and every
     * sidebar link was not a settings file.
     */
    public const ANNOUNCEMENTS = 'announcements';

    public const NAV_LINKS = 'nav_links';

    /**
     * Settings that name a file rather than holding a value.
     *
     * icon_pack_file is the upload field itself and is never a stored value.
     */
    /*
     * Fields that are something you do rather than something the panel is set
     * to. An upload and the code beside it describe one action taken once; the
     * result is a file on disk, and carrying the instruction to a second panel
     * would either do nothing or repeat work that is already done there.
     */
    private const EXCLUDED = [
        'login_image',
        'background_image',
        'icon_pack_file',
        'language_file',
        'language_code',
        'language_url',

        /*
         * And two that are secrets rather than settings.
         *
         * A settings file is made to be handed to somebody else - that is the
         * whole point of it, and it is the reason these are not in one. A
         * Twitch client secret in a file somebody exports to share their
         * colours is a credential leaked by a feature that was being helpful.
         */
        'igdb_client_id',
        'igdb_client_secret',

        /*
         * And where the watchdog writes to.
         *
         * A Discord webhook URL is a credential - anybody holding it can post
         * into that channel as your panel - and a list of addresses is somebody
         * else's contact details. Neither belongs in a file made to be handed
         * to another administrator so they can copy your colours.
         */
        'alert_webhook',
        'alert_email',
    ];

    /** A settings file is a few kilobytes; anything larger is not one. */
    public const MAX_BYTES = 262144;

    /**
     * @return array<string, mixed>
     */
    public static function export(): array
    {
        return [
            'marker' => self::MARKER,
            'plugin' => Theme::id(),
            // Not used on the way back in - a file from an older release is
            // still worth importing, and the sanitisers decide what survives -
            // but worth having when somebody opens the file to read it.
            'version' => Channels::installedVersion(),
            'exported_at' => now()->toIso8601String(),
            'settings' => self::settings(),
        ];
    }

    public static function filename(): string
    {
        return 'essentials-' . now()->format('Y-m-d-His') . '.json';
    }

    /** @var array<string, mixed>|null */
    private static ?array $settings = null;

    /**
     * The current settings, minus the ones that are files.
     *
     * Read once. Showing what a file would change asks for this three times -
     * once to know which keys exist, once for the comparison, once again when
     * the import runs - and Settings::data() is not free: it reads a file for
     * the custom CSS and builds the icon and area lists on the way past.
     *
     * @return array<string, mixed>
     */
    public static function settings(): array
    {
        if (self::$settings !== null) {
            return self::$settings;
        }

        /*
         * All four groups, not just the first.
         *
         * For a long time this was Settings::data() alone, which is the main
         * form and nothing else - so a settings file carried sixty-one settings
         * out of seventy-eight and neither announcement nor sidebar link at all.
         * The reason was structural rather than an oversight: the login screen
         * and the system status page have their own persist(), the two lists do
         * not go through Settings at all, and none of them was reachable from
         * the one method this asked.
         *
         * Anything with a persist() belongs here. See apply(), which is the
         * other half and has to stay in step with it.
         */
        $data = array_merge(
            Settings::data(),
            Settings::loginData(),
            Settings::systemStatusData(),
            // The watchdog's thresholds and channels travel; the address it
            // posts to and the people it writes to do not. See EXCLUDED.
            Settings::alertsData(),
            [
                self::ANNOUNCEMENTS => Notice::rows(),
                self::NAV_LINKS => NavLinks::rows(),
            ],
        );

        foreach (self::EXCLUDED as $key) {
            unset($data[$key]);
        }

        return self::$settings = $data;
    }

    /**
     * A parsed file, written to the panel.
     *
     * Every group is merged over what is there now rather than written whole:
     * the file leaves the uploads out, and writing a missing key would read as
     * "put it back to the default". Each group goes through the same persist()
     * the form uses, so an imported value meets the sanitiser it would have met
     * had it been typed in.
     *
     * @param  array<string, mixed>  $settings
     */
    public static function apply(array $settings): void
    {
        /*
         * persist() runs last, and that is not arbitrary.
         *
         * persistSystemStatus() writes LEGEND_THEME_FEATURES_OFF through
         * Features::withOne(), which reads the current list from config to leave
         * the rest of it alone. Config is loaded at boot, so it cannot see what
         * another persist() wrote to .env a moment earlier in the same request.
         * Run it after persist() and it would rewrite the whole feature list
         * from a stale read, undoing every feature the file just set.
         *
         * Going the other way costs nothing: the main form's own `features` key
         * already carries the system status switch - they are the same switch,
         * as persistSystemStatus() says itself - so persist() writing last gets
         * it right for both.
         */
        Settings::persistAlerts(array_merge(Settings::alertsData(), $settings));
        Settings::persistSystemStatus(array_merge(Settings::systemStatusData(), $settings));
        Settings::persistLogin(array_merge(Settings::loginData(), $settings));
        Settings::persist(array_merge(Settings::data(), $settings));

        // Written whole rather than merged - a list is the setting, and half of
        // one is not a sensible thing to end up with. Both savers run everything
        // through their own clean(), which is what makes a file from outside
        // safe to hand them.
        if (is_array($settings[self::ANNOUNCEMENTS] ?? null)) {
            Notice::save($settings[self::ANNOUNCEMENTS]);
        }

        if (is_array($settings[self::NAV_LINKS] ?? null)) {
            NavLinks::save($settings[self::NAV_LINKS]);
        }
    }

    /**
     * A file, turned into settings this panel recognises.
     *
     * Unknown keys are dropped rather than passed along. persist() writes an
     * explicit list of environment variables, so an unknown key would be
     * ignored anyway - but dropping it here is what lets changes() report
     * honestly on what the file will actually do.
     *
     * @return array<string, mixed>
     */
    public static function parse(string $json): array
    {
        try {
            $decoded = json_decode($json, true);
        } catch (Throwable) {
            return [];
        }

        if (!is_array($decoded)) {
            return [];
        }

        // A bare settings object is accepted too: somebody who edited the file
        // down to the part they wanted should not be told it is the wrong file.
        $settings = is_array($decoded['settings'] ?? null) ? $decoded['settings'] : $decoded;

        if (($decoded['marker'] ?? self::MARKER) !== self::MARKER) {
            return [];
        }

        $known = array_keys(self::settings());

        return array_intersect_key($settings, array_flip($known));
    }

    /**
     * What importing this would change, and to what.
     *
     * Shown before anything is written, because a settings file can undo an
     * afternoon's work and "sixty settings replaced" is not something to find
     * out afterwards.
     *
     * @param  array<string, mixed>  $incoming
     * @return array<int, array{key: string, from: string, to: string}>
     */
    public static function changes(array $incoming): array
    {
        $current = self::settings();
        $changes = [];

        foreach ($incoming as $key => $value) {
            if (!array_key_exists($key, $current)) {
                continue;
            }

            // Loose, on purpose: '2' from a JSON file and 2 from the form are
            // the same setting, and reporting that as a change would fill the
            // list with entries that do nothing.
            if ($current[$key] == $value) {
                continue;
            }

            $changes[] = [
                'key' => $key,
                'from' => self::describe($current[$key]),
                'to' => self::describe($value),
            ];
        }

        return $changes;
    }

    /**
     * A value, in a few words.
     *
     * Lists are counted rather than printed: the icon overrides can hold fifty
     * rows, and a diff nobody can read is a diff nobody reads.
     */
    private static function describe(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'on' : 'off';
        }

        if ($value === null || $value === '') {
            return '—';
        }

        if (is_array($value)) {
            $count = count($value);

            return $count === 1 ? '1 entry' : $count . ' entries';
        }

        $value = (string) $value;

        return mb_strlen($value) > 40 ? mb_substr($value, 0, 40) . '…' : $value;
    }
}
