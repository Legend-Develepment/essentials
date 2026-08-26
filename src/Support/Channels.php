<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Plugin;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Stable, beta or dev.
 *
 * Pelican's own update check keys its feed by *panel* version and has no notion
 * of a release channel, so this is a thin layer next to it rather than a change
 * to it. Every channel's feed is worked out from the stable one already in
 * plugin.json - see derive() - so there is nothing to fill in by hand.
 *
 * The panel's own button on Admin -> Plugins keeps following the stable feed;
 * the one on the Theme page follows whichever channel is selected here, as does
 * the scheduled check in Support\AutoUpdate.
 */
class Channels
{
    public const STABLE = 'stable';

    public const BETA = 'beta';

    public const DEV = 'dev';

    public const AUTO_OFF = 'off';

    public const AUTO_HOURLY = 'hourly';

    public const AUTO_DAILY = 'daily';

    public const AUTO_WEEKLY = 'weekly';

    /**
     * Dev builds are only offered on panels served from this domain. They are
     * cut straight from the working branch, so anywhere else they would be a
     * trap rather than a choice.
     */
    public const DEV_DOMAIN = 'l3g3clan.nl';

    /**
     * Which branch publishes which channel. A dev build lands on DEV without
     * anything being merged, so its feed has to be looked for there and not
     * beside the stable one.
     *
     * @var array<string, string>
     */
    private const BRANCHES = [
        self::STABLE => 'main',
        self::BETA => 'beta',
        self::DEV => 'DEV',
    ];

    /**
     * Why the last feed read failed, so "Check for updates" can say what went
     * wrong instead of only that something did. Set on the attempt itself, so
     * it stays null when the answer came from the cache.
     */
    private static ?string $lastError = null;

    public static function lastError(): ?string
    {
        return self::$lastError;
    }

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
        // The configured address first, so this still answers in the scheduler
        // and on the command line, where there is no request to ask.
        foreach ([(string) config('app.url'), (string) (request()?->getHost() ?? '')] as $candidate) {
            if (self::isDevHost($candidate)) {
                return true;
            }
        }

        return false;
    }

    /**
     * The domain itself or anything under it - panel.l3g3clan.nl and
     * server.l3g3clan.nl both count.
     *
     * Matched on the host and nowhere else: looking for the domain anywhere in
     * the address would also say yes to https://example.com/l3g3clan.nl and to
     * l3g3clan.nl.example.com, neither of which is the panel.
     */
    private static function isDevHost(string $candidate): bool
    {
        $candidate = trim($candidate);

        if ($candidate === '') {
            return false;
        }

        // config('app.url') is a full address; a request hands over a bare host.
        $host = strtolower((string) (parse_url($candidate, PHP_URL_HOST) ?: $candidate));

        // A bare host may still carry a port, and a fully qualified one a
        // trailing dot.
        $host = rtrim(strstr($host, ':', true) ?: $host, '.');

        return $host === self::DEV_DOMAIN || str_ends_with($host, '.' . self::DEV_DOMAIN);
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
     * How often the panel installs a new release on its own. Off unless asked
     * for: an update rebuilds the panel's assets, which takes the panel a few
     * minutes, and that is not something to spring on anyone.
     */
    public static function autoUpdate(): string
    {
        $value = (string) Theme::config('auto_update', self::AUTO_OFF);

        return in_array($value, [self::AUTO_HOURLY, self::AUTO_DAILY, self::AUTO_WEEKLY], true)
            ? $value
            : self::AUTO_OFF;
    }

    /**
     * @return array<string, string>
     */
    public static function autoUpdateOptions(): array
    {
        return [
            self::AUTO_OFF => Theme::trans('settings.channel.auto.off'),
            self::AUTO_HOURLY => Theme::trans('settings.channel.auto.hourly'),
            self::AUTO_DAILY => Theme::trans('settings.channel.auto.daily'),
            self::AUTO_WEEKLY => Theme::trans('settings.channel.auto.weekly'),
        ];
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

        try {
            return cache()->remember(
                self::cacheKey($url),
                now()->addMinutes(10),
                static fn (): ?array => self::read($url),
            );
        } catch (Throwable $exception) {
            // A cache that cannot be written must not stop the check. Seen on a
            // panel where storage/framework/cache was not writable by the web
            // user: every write threw, which took whole pages down with it.
            report($exception);

            return self::read($url);
        }
    }

    private static function cacheKey(string $url): string
    {
        return 'legend-theme.channel.' . self::current() . '.' . md5($url);
    }

    /**
     * One read of the feed, with no cache in the way.
     *
     * @return array{version: string, download_url: string}|null
     */
    private static function read(string $url): ?array
    {
        try {
            $response = Http::timeout(5)->connectTimeout(2)->get($url);
        } catch (Throwable $exception) {
            self::$lastError = $exception->getMessage();

            return null;
        }

        if (!$response->successful()) {
            self::$lastError = 'HTTP ' . $response->status();

            return null;
        }

        $data = $response->json();

        if (!is_array($data)) {
            // The most common cause is a byte order mark, which makes
            // json_decode return null without saying anything.
            self::$lastError = str_starts_with($response->body(), "\xEF\xBB\xBF")
                ? 'The feed starts with a byte order mark, which is not valid JSON.'
                : 'The feed did not contain valid JSON.';

            return null;
        }

        // A feed may cover several plugins, keyed by plugin id.
        if (array_key_exists(Theme::id(), $data) && is_array($data[Theme::id()])) {
            $data = $data[Theme::id()];
        }

        // Entries are keyed by panel version, with * as the fallback - the same
        // shape Pelican reads.
        $entry = $data[(string) config('app.version')] ?? $data['*'] ?? null;

        if (!is_array($entry) || !isset($entry['version'], $entry['download_url'])) {
            return null;
        }

        return [
            'version' => (string) $entry['version'],
            'download_url' => (string) $entry['download_url'],
        ];
    }

    /**
     * Drops the cached feed so the next read goes out to the network again -
     * what the "Check for updates" button is for, since the cache otherwise
     * holds for ten minutes.
     */
    public static function forget(): void
    {
        $url = self::feed();

        if ($url === null) {
            return;
        }

        try {
            cache()->forget(self::cacheKey($url));
        } catch (Throwable $exception) {
            // Same reasoning as latest(): a cache that misbehaves costs a
            // needless network read, not the button.
            report($exception);
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
     * The stable feed is the update_url from plugin.json; the other channels are
     * derived from it, so nothing has to be filled in by hand.
     *
     * Setting a URL for a channel explicitly still wins, for a feed that lives
     * somewhere this cannot work out on its own.
     */
    public static function feed(): ?string
    {
        $channel = self::current();

        if ($channel !== self::STABLE) {
            $configured = trim((string) Theme::config($channel . '_url', ''));

            if ($configured !== '') {
                return $configured;
            }
        }

        return self::derive($channel);
    }

    /**
     * The address a channel's feed is expected at, worked out from the stable
     * one in plugin.json. Also what the settings form shows as its placeholder,
     * so the derived address is visible rather than a promise.
     */
    public static function derive(string $channel): ?string
    {
        try {
            $url = (string) (Plugin::find(Theme::id())?->update_url ?? '');
        } catch (Throwable) {
            return null;
        }

        if ($url === '') {
            return null;
        }

        if ($channel === self::STABLE) {
            return $url;
        }

        $parts = parse_url($url);

        if (!is_array($parts) || !isset($parts['scheme'], $parts['host'], $parts['path'])) {
            return null;
        }

        // update.json -> update-beta.json, next to the stable manifest.
        $path = preg_replace('/update(\.json)$/', 'update-' . $channel . '$1', (string) $parts['path'], 1);

        if ($path === null) {
            return null;
        }

        // Each channel is published from its own branch, so the branch in a raw
        // GitHub address has to move along with the filename. Without this the
        // dev feed resolves to the copy left on main by the last merge, which is
        // whatever version was current back then - the one thing an update check
        // must never read.
        if (strcasecmp((string) $parts['host'], 'raw.githubusercontent.com') === 0) {
            $segments = explode('/', ltrim($path, '/'));

            // <owner>/<repo>/<ref>/<path...>
            if (count($segments) >= 4 && isset(self::BRANCHES[$channel])) {
                $segments[2] = self::BRANCHES[$channel];
                $path = '/' . implode('/', $segments);
            }
        }

        $port = isset($parts['port']) ? ':' . $parts['port'] : '';

        return $parts['scheme'] . '://' . $parts['host'] . $port . $path;
    }
}
