<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Plugin;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Stable or beta.
 *
 * Pelican's own update check keys its feed by *panel* version and has no notion
 * of a release channel, so this is a thin layer next to it rather than a change
 * to it. The beta feed's address is derived from the stable one that is already
 * in plugin.json - update.json becomes update-beta.json - so there is nothing
 * extra to configure.
 *
 * The panel's own button on Admin -> Plugins keeps following the stable feed;
 * the one on the Theme page follows whichever channel is selected here.
 */
class Channels
{
    public const STABLE = 'stable';

    public const BETA = 'beta';

    public const DEV = 'dev';

    /**
     * Dev builds are only offered on panels served from this domain. They are
     * cut straight from the working branch, so anywhere else they would be a
     * trap rather than a choice.
     */
    public const DEV_DOMAIN = 'l3g3clan.nl';

    public static function current(): string
    {
        $channel = (string) Theme::config('channel', self::STABLE);

        // A panel that is not allowed dev builds falls back rather than breaking:
        // moving a copy of this plugin elsewhere quietly lands on stable.
        if ($channel === self::DEV) {
            return self::devAllowed() ? self::DEV : self::STABLE;
        }

        return $channel === self::BETA ? self::BETA : self::STABLE;
    }

    public static function devAllowed(): bool
    {
        foreach ([(string) config('app.url'), (string) (request()?->getHost() ?? '')] as $candidate) {
            if ($candidate !== '' && str_contains(strtolower($candidate), self::DEV_DOMAIN)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [
            self::STABLE => Theme::trans('settings.channel.stable'),
            self::BETA => Theme::trans('settings.channel.beta'),
        ];

        if (self::devAllowed()) {
            $options[self::DEV] = Theme::trans('settings.channel.dev');
        }

        return $options;
    }

    /**
     * The newest release on the selected channel, or null when the feed cannot
     * be read - an unreachable feed is not an error worth showing.
     *
     * @return array{version: string, download_url: string}|null
     */
    public static function latest(): ?array
    {
        $url = self::feed();

        if ($url === null) {
            return null;
        }

        $channel = self::current();

        return cache()->remember(
            'legend-theme.channel.' . $channel . '.' . md5($url),
            now()->addMinutes(10),
            static function () use ($url): ?array {
                try {
                    $data = Http::timeout(5)->connectTimeout(2)->get($url)->throw()->json();
                } catch (Throwable) {
                    return null;
                }

                if (!is_array($data)) {
                    return null;
                }

                // A feed may cover several plugins, keyed by plugin id.
                if (array_key_exists(Theme::id(), $data) && is_array($data[Theme::id()])) {
                    $data = $data[Theme::id()];
                }

                // Entries are keyed by panel version, with * as the fallback -
                // the same shape Pelican reads.
                $entry = $data[(string) config('app.version')] ?? $data['*'] ?? null;

                if (!is_array($entry) || !isset($entry['version'], $entry['download_url'])) {
                    return null;
                }

                return [
                    'version' => (string) $entry['version'],
                    'download_url' => (string) $entry['download_url'],
                ];
            },
        );
    }

    /**
     * Drops the cached feed so the next read goes out to the network again -
     * what the "Check for updates" button is for, since the cache otherwise
     * holds for ten minutes.
     */
    public static function forget(): void
    {
        $url = self::feed();

        if ($url !== null) {
            cache()->forget('legend-theme.channel.' . self::current() . '.' . md5($url));
        }
    }

    public static function updateAvailable(): bool
    {
        $latest = self::latest();

        if ($latest === null) {
            return false;
        }

        return version_compare($latest['version'], self::installedVersion(), '>');
    }

    public static function installedVersion(): string
    {
        try {
            return (string) (Plugin::find(Theme::id())?->version ?? '0.0.0');
        } catch (Throwable) {
            return '0.0.0';
        }
    }

    /**
     * The stable feed is the update_url from plugin.json.
     *
     * For beta there are two shapes in the wild: both manifests next to each
     * other (update.json and update-beta.json), or a separate branch with its
     * own update.json. The derived name covers the first; setting a beta URL
     * explicitly covers the second, and anything hosted elsewhere.
     */
    private static function feed(): ?string
    {
        try {
            $url = (string) (Plugin::find(Theme::id())?->update_url ?? '');
        } catch (Throwable) {
            return null;
        }

        $channel = self::current();

        if ($channel === self::STABLE) {
            return $url === '' ? null : $url;
        }

        $configured = trim((string) Theme::config($channel . '_url', ''));

        if ($configured !== '') {
            return $configured;
        }

        if ($url === '') {
            return null;
        }

        return preg_replace('/\.json$/', '-' . $channel . '.json', $url, 1) ?: null;
    }
}
