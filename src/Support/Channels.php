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

    public static function current(): string
    {
        return Theme::config('channel', self::STABLE) === self::BETA ? self::BETA : self::STABLE;
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
     * The stable feed is the update_url from plugin.json; the beta feed is that
     * same address with -beta before the extension.
     */
    private static function feed(): ?string
    {
        try {
            $url = (string) (Plugin::find(Theme::id())?->update_url ?? '');
        } catch (Throwable) {
            return null;
        }

        if ($url === '') {
            return null;
        }

        if (self::current() === self::STABLE) {
            return $url;
        }

        return preg_replace('/\.json$/', '-beta.json', $url, 1) ?: null;
    }
}
