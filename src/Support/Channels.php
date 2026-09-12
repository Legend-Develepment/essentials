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

    public const AUTO_MINUTE = 'minute';

    public const AUTO_FIVE_MINUTES = 'five_minutes';

    public const AUTO_TEN_MINUTES = 'ten_minutes';

    public const AUTO_THIRTY_MINUTES = 'thirty_minutes';

    public const AUTO_HOURLY = 'hourly';

    public const AUTO_DAILY = 'daily';

    public const AUTO_WEEKLY = 'weekly';

    /**
     * Every interval the automatic check can run at, in the order they are
     * offered. Off is not in here: it is the absence of a schedule.
     *
     * @var array<int, string>
     */
    public const AUTO_INTERVALS = [
        self::AUTO_MINUTE,
        self::AUTO_FIVE_MINUTES,
        self::AUTO_TEN_MINUTES,
        self::AUTO_THIRTY_MINUTES,
        self::AUTO_HOURLY,
        self::AUTO_DAILY,
        self::AUTO_WEEKLY,
    ];

    /**
     * Dev builds are only offered on panels served from this domain. They are
     * cut straight from the working branch, so anywhere else they would be a
     * trap rather than a choice.
     */
    public const DEV_DOMAIN = 'l3g3clan.nl';

    /**
     * The repository the dev channel is published from, and the branch in it.
     *
     * Stable and beta come out of the public repository named in plugin.json.
     * Dev comes out of one of its own, and that one is private: it carries the
     * working branch, and the whole point of the split is that the public
     * repository can be opened up without opening up what is half-finished with
     * it.
     *
     * A private repository does not answer a plain GET, so the dev channel is
     * read through the GitHub API with a token instead of from
     * raw.githubusercontent.com - see token(), headers() and derive().
     */
    public const DEV_REPO = 'Legend-Develepment/Essentials-dev';

    /**
     * Lower case, unlike the DEV branch the dev channel used while it lived
     * beside stable in the one repository. The branch is the repository's
     * default here, and a default branch that shouts is a default branch
     * somebody mistypes.
     */
    public const DEV_BRANCH = 'dev';

    /**
     * Which branch publishes which channel, for the two channels that share a
     * repository. Dev is not in here: it is a different repository as well as a
     * different branch, so it is built rather than derived - see derive().
     *
     * @var array<string, string>
     */
    private const BRANCHES = [
        self::STABLE => 'main',
        self::BETA => 'beta',
    ];

    /**
     * Why the last feed read failed, so "Check for updates" can say what went
     * wrong instead of only that something did. Set on the attempt itself, so
     * it stays null when the answer came from the cache.
     */
    private static ?string $lastError = null;

    /**
     * Reading the plugin row means booting a Sushi table off the plugins
     * directory, and the Theme page asks the same three questions from its
     * subheading and from every button's visibility - eight times over for one
     * render. None of it can change within a request: saving redirects.
     *
     * @var array<string, mixed>
     */
    private static array $memo = [];

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
     * The token the dev channel reads its repository with.
     *
     * Kept on the panel rather than in the package: a token shipped inside a
     * release is a token handed to everybody who downloads one. It needs read
     * access to the contents of the dev repository and to nothing else - see
     * README, "The dev channel".
     *
     * Empty on every panel that is not the development one, which is the
     * ordinary case: the dev channel is only offered on DEV_DOMAIN anyway.
     */
    public static function token(): string
    {
        return trim((string) Theme::config('dev_token', ''));
    }

    /**
     * Whether an address is one this panel may send the dev token to.
     *
     * Matched on the host and on the owner and repository in the path, rather
     * than by looking for the repository's name anywhere in the string. The dev
     * feed can be pointed elsewhere by hand, and a token that travels to
     * whatever address happens to be in a setting is a token given away by a
     * typo - or by anybody who can write that setting.
     */
    private static function isDevRepoUrl(string $url): bool
    {
        $parts = parse_url($url);

        if (!is_array($parts)) {
            return false;
        }

        $host = strtolower((string) ($parts['host'] ?? ''));

        // The API serves the private repository; raw.githubusercontent is here
        // for a dev_url set by hand, which is the only way one gets used now.
        if (!in_array($host, ['api.github.com', 'raw.githubusercontent.com'], true)) {
            return false;
        }

        $segments = array_values(array_filter(
            explode('/', (string) ($parts['path'] ?? '')),
            static fn (string $segment): bool => $segment !== '',
        ));

        // api.github.com/repos/<owner>/<repo>/..., and the raw host without the
        // /repos in front of it.
        if ($host === 'api.github.com') {
            if (($segments[0] ?? '') !== 'repos') {
                return false;
            }

            array_shift($segments);
        }

        // GitHub reads an owner and a repository name without regard to case,
        // so neither does this - what somebody types is not always how the
        // repository is spelled.
        return strcasecmp(($segments[0] ?? '') . '/' . ($segments[1] ?? ''), self::DEV_REPO) === 0;
    }

    /**
     * What a request for this address has to carry. Nothing at all for a public
     * one, which is every address on stable and beta.
     *
     * @return array<string, string>
     */
    private static function headers(string $url, string $accept): array
    {
        $token = self::token();

        if ($token === '' || !self::isDevRepoUrl($url)) {
            return [];
        }

        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => $accept,
            'X-GitHub-Api-Version' => '2022-11-28',
        ];
    }

    /**
     * The headers a download of this address needs, for the update job: empty
     * means Pelican's own downloader can fetch it, and anything else means it
     * cannot, because that one sends a plain GET with no credentials.
     *
     * @return array<string, string>
     */
    public static function downloadHeaders(string $url): array
    {
        /*
         * A release asset and a file in the tree come from two different
         * endpoints, and each wants its own media type: the asset endpoint
         * hands back JSON describing the asset unless asked for octet-stream,
         * and the contents endpoint hands back JSON with the file base64'd
         * inside it unless asked for raw. Either way what arrives is the zip.
         */
        return self::headers($url, str_contains($url, '/releases/assets/')
            ? 'application/octet-stream'
            : 'application/vnd.github.raw');
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
    /**
     * The schedule actually in force. Off whenever the switch is off, whatever
     * interval is set behind it.
     */
    public static function autoUpdate(): string
    {
        return self::autoUpdateEnabled() ? self::autoUpdateInterval() : self::AUTO_OFF;
    }

    /**
     * The switch. Separate from the interval so turning automatic updates off
     * and on again does not lose which interval was chosen - it stays the
     * administrator's setting either way.
     */
    public static function autoUpdateEnabled(): bool
    {
        $configured = Theme::config('auto_update_enabled');

        // Checked for null rather than passed as a default to config(): the key
        // exists and holds null until the switch is saved once, and a key that
        // exists never falls back to its default.
        if ($configured === null || $configured === '') {
            // Before the switch existed an interval on its own meant it was on,
            // so that is what an unset switch inherits: a panel that was
            // updating itself keeps updating itself.
            return self::autoUpdateValue(Theme::config('auto_update', self::AUTO_OFF)) !== self::AUTO_OFF;
        }

        return filter_var($configured, FILTER_VALIDATE_BOOL);
    }

    /**
     * The interval behind the switch, which always names one - there is no "off"
     * to choose here, that is what the switch is.
     */
    public static function autoUpdateInterval(): string
    {
        $interval = self::autoUpdateValue(Theme::config('auto_update', self::AUTO_DAILY));

        return $interval === self::AUTO_OFF ? self::AUTO_DAILY : $interval;
    }

    /**
     * Anything that is not one of the intervals means off, so a value typed into
     * .env by hand cannot put the panel on a schedule nobody recognises.
     */
    public static function autoUpdateValue(mixed $value): string
    {
        return in_array($value, self::AUTO_INTERVALS, true) ? (string) $value : self::AUTO_OFF;
    }

    /**
     * The intervals, with nothing for off - that is the switch's job.
     *
     * @return array<string, string>
     */
    public static function autoUpdateOptions(): array
    {
        $options = [];

        foreach (self::AUTO_INTERVALS as $interval) {
            $options[$interval] = Theme::trans('settings.channel.auto.' . $interval);
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
        return self::once('latest', static fn (): ?array => self::resolveLatest());
    }

    /**
     * @return array{version: string, download_url: string}|null
     */
    private static function resolveLatest(): ?array
    {
        $url = self::feed();

        if ($url === null) {
            return null;
        }

        /*
         * Said here rather than left to the 404 the request would come back
         * with. The dev repository is private, so a panel without a token is
         * told the feed does not exist - which is what a wrong address looks
         * like too, and sends whoever reads it looking in the wrong place.
         *
         * In front of the cache, so it is answered on every attempt: a missing
         * token is a thing somebody is in the middle of fixing.
         */
        if (self::token() === '' && self::isDevRepoUrl($url)) {
            self::$lastError = 'The dev channel is served from a private repository, so it needs a token. Set one under Updates, or LEGEND_THEME_DEV_TOKEN in .env.';

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
     * Written once rather than at both ends. The list and the button that drops
     * it are in different halves of this class, and a key spelled out twice is
     * a key that gets cleared in one place and kept in the other.
     */
    private static function releasesKey(string $url): string
    {
        return 'legend-theme.releases.' . self::current() . '.' . md5($url);
    }

    /**
     * One read of the feed, with no cache in the way.
     *
     * @return array{version: string, download_url: string}|null
     */
    private static function read(string $url): ?array
    {
        try {
            // Raw rather than JSON: on the private repository this address is
            // the contents endpoint, which wraps the file in an envelope and
            // base64s it unless asked for the file itself. A public feed adds
            // no headers at all, and there the address is the file.
            $response = Http::withHeaders(self::headers($url, 'application/vnd.github.raw'))
                ->timeout(5)
                ->connectTimeout(2)
                ->get($url);
        } catch (Throwable $exception) {
            self::$lastError = $exception->getMessage();

            return null;
        }

        if (!$response->successful()) {
            /*
             * With whatever the other end said about it.
             *
             * "HTTP 403" on its own sent somebody to check a token that was
             * fine; GitHub had answered "Resource not accessible by personal
             * access token" and named the permission it wanted in a header, and
             * neither reached the screen. A status code says that something was
             * refused. The sentence beside it says what to go and change.
             */
            $said = $response->json('message');

            self::$lastError = 'HTTP ' . $response->status()
                . (is_string($said) && $said !== '' ? ' - ' . $said : '')
                . (($needs = $response->header('x-accepted-github-permissions')) !== ''
                    ? ' (needs ' . $needs . ')'
                    : '');

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
     * Every release on this channel, newest first.
     *
     * The feed only ever names the latest one - that is what a feed is for - so
     * a list of what else exists has to come from the releases themselves. They
     * are read from the GitHub API, and the repository is worked out from the
     * feed address rather than configured, so there is still nothing to fill in
     * and nothing to keep in step.
     *
     * A panel whose feed has been pointed somewhere that is not GitHub gets an
     * empty list and no version picker, which is the honest answer: nothing
     * here knows how to enumerate an arbitrary host.
     *
     * @return array<int, array{version: string, download_url: string}>
     */
    public static function releases(): array
    {
        return self::once('releases', static fn (): array => self::resolveReleases());
    }

    /**
     * The release notes, newest first, for the channel this panel follows.
     *
     * From the releases themselves rather than a file in the plugin: a
     * changelog shipped inside a release can only ever describe the release it
     * shipped in, which is the one thing you already know. This is what has
     * happened since - including the versions you have not installed yet.
     *
     * The notes are Markdown from a remote source and are rendered as such, with
     * raw HTML stripped rather than trusted. It is this plugin's own repository
     * today, and the address is derived rather than fixed - so "today" is not a
     * good enough reason to hand it the panel's markup.
     *
     * @return array<int, array{version: string, notes: string, published_at: string}>
     */
    public static function changelog(int $limit = 15): array
    {
        $entries = [];

        foreach (self::releases() as $release) {
            if (($release['notes'] ?? '') === '') {
                // A release with no notes is a row saying nothing, which is
                // worse than one row fewer.
                continue;
            }

            $entries[] = [
                'version' => $release['version'],
                'notes' => (string) $release['notes'],
                'published_at' => (string) ($release['published_at'] ?? ''),
            ];

            if (count($entries) >= $limit) {
                break;
            }
        }

        return $entries;
    }

    /**
     * @return array<string, string>
     */
    public static function releaseOptions(): array
    {
        $options = [];
        $installed = self::installedVersion();

        foreach (self::releases() as $release) {
            $options[$release['download_url']] = $release['version'] === $installed
                ? $release['version'] . ' - ' . Theme::trans('settings.channel.installed')
                : $release['version'];
        }

        return $options;
    }

    /**
     * @return array<int, array{version: string, download_url: string}>
     */
    private static function resolveReleases(): array
    {
        $url = self::releasesUrl();

        if ($url === null) {
            return [];
        }

        try {
            return cache()->remember(
                self::releasesKey($url),
                now()->addMinutes(10),
                static fn (): array => self::readReleases($url),
            );
        } catch (Throwable) {
            // A cache that cannot be written must not stop the list, for the
            // same reason it must not stop the update check.
            return self::readReleases($url);
        }
    }

    /**
     * @return array<int, array{version: string, download_url: string}>
     */
    private static function readReleases(string $url): array
    {
        $headers = self::headers($url, 'application/vnd.github+json');

        try {
            $response = Http::withHeaders($headers)
                ->timeout(5)
                ->connectTimeout(2)
                ->get($url, ['per_page' => 40]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();
        } catch (Throwable) {
            return [];
        }

        if (!is_array($data)) {
            return [];
        }

        $suffix = self::current() === self::STABLE ? '' : '-' . self::current();
        $releases = [];

        foreach ($data as $release) {
            $row = self::readRelease(is_array($release) ? $release : [], $suffix, $headers !== []);

            if ($row !== null) {
                $releases[] = $row;
            }
        }

        return $releases;
    }

    /**
     * @param  array<string, mixed>  $release
     * @param  bool  $private  Whether these releases were read with a token, and
     *                         so whether their assets need one to download.
     * @return array{version: string, download_url: string}|null
     */
    private static function readRelease(array $release, string $suffix, bool $private = false): ?array
    {
        $tag = (string) ($release['tag_name'] ?? '');

        /*
         * The tag says which channel it is: v2.34.1-dev, v2.34.1-beta, v2.34.1.
         * Matching on it rather than on the prerelease flag, because that flag
         * says how GitHub displays a release and not which channel cut it.
         */
        if ($tag === '' || !str_ends_with($tag, $suffix)) {
            return null;
        }

        /*
         * The tag minus its v, with the channel left on.
         *
         * It used to be stripped, back when a version was 2.44.0 and the tag
         * added -dev to it. A version now carries its own channel - 2.47.1-dev -
         * so the tag and the manifest say the same thing, and taking the suffix
         * off here would make the picker unable to tell which of the releases it
         * lists is the one installed.
         */
        $version = ltrim($tag, 'v');

        if ($version === '' || ($suffix === '' && str_contains($version, '-'))) {
            // Stable takes no suffix, so it has to turn away the tags that
            // carry one rather than accept everything.
            return null;
        }

        foreach ((array) ($release['assets'] ?? []) as $asset) {
            $name = is_array($asset) ? (string) ($asset['name'] ?? '') : '';

            /*
             * browser_download_url is the address a browser follows, and on a
             * private repository a browser follows it while signed in. Nothing
             * here is signed in, and a token in a header does not help: that
             * address is not the API. The asset's own `url` is, and asked for
             * octet-stream it hands back the zip - so a private release is
             * downloaded from there and a public one from the address anybody
             * else would use.
             */
            $download = is_array($asset)
                ? (string) ($private ? ($asset['url'] ?? '') : ($asset['browser_download_url'] ?? ''))
                : '';

            if (str_ends_with($name, '.zip')
                && str_contains($name, Theme::id())
                && str_starts_with($download, 'https://')) {
                return [
                    'version' => $version,
                    'download_url' => $download,
                    // Carried along for the changelog. Read from the same call
                    // rather than a second one: the list of releases and the
                    // notes on them are the same request.
                    'notes' => trim((string) ($release['body'] ?? '')),
                    'published_at' => (string) ($release['published_at'] ?? ''),
                ];
            }
        }

        // A release with notes and no zip is a release nothing can install.
        return null;
    }

    /**
     * The GitHub releases address for this plugin, from the feed address.
     *
     * raw.githubusercontent.com/<owner>/<repo>/<branch>/update.json is what the
     * feed looks like, and the first two path segments are what the API wants.
     */
    private static function releasesUrl(): ?string
    {
        // Dev has a repository of its own, so its releases are there and not
        // beside stable's. Worked out from the constant rather than from the
        // feed, which may have been pointed somewhere by hand.
        if (self::current() === self::DEV) {
            return 'https://api.github.com/repos/' . self::DEV_REPO . '/releases';
        }

        $feed = self::derive(self::STABLE);

        if ($feed === null) {
            return null;
        }

        $parts = parse_url($feed);

        if (!is_array($parts) || ($parts['host'] ?? '') !== 'raw.githubusercontent.com') {
            return null;
        }

        $segments = array_values(array_filter(explode('/', (string) ($parts['path'] ?? ''))));

        if (count($segments) < 2) {
            return null;
        }

        return 'https://api.github.com/repos/' . $segments[0] . '/' . $segments[1] . '/releases';
    }

    /**
     * Drops the cached feed so the next read goes out to the network again -
     * what the "Check for updates" button is for, since the cache otherwise
     * holds for ten minutes.
     */
    public static function forget(): void
    {
        /*
         * Both halves, and that is the whole point of this comment.
         *
         * It used to drop the feed and leave the release list where it was, so
         * a panel that had just been given a working token was told the newest
         * version straight away and offered an empty version picker for another
         * ten minutes - with the Check button reporting success. The two are one
         * answer to the person pressing it; they have to be forgotten together.
         */
        $url = self::feed();
        $releases = self::releasesUrl();

        // The answers held for this request go too, or the Check button would
        // clear the cache and then hand back what it was about to replace.
        unset(self::$memo['latest'], self::$memo['releases']);

        foreach ([
            $url === null ? null : self::cacheKey($url),
            $releases === null ? null : self::releasesKey($releases),
        ] as $key) {
            if ($key === null) {
                continue;
            }

            try {
                cache()->forget($key);
            } catch (Throwable $exception) {
                // Same reasoning as latest(): a cache that misbehaves costs a
                // needless network read, not the button.
                report($exception);
            }
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
        return (string) (self::plugin()?->version ?? '0.0.0');
    }

    /**
     * The plugin's own row, read once. Sushi builds its table from the
     * plugin.json of every installed plugin, so this is not a lookup to make
     * eight times for one page.
     */
    private static function plugin(): ?Plugin
    {
        return self::once('plugin', static function (): ?Plugin {
            try {
                return Plugin::find(Theme::id());
            } catch (Throwable) {
                return null;
            }
        });
    }

    /**
     * @template T
     *
     * @param  callable(): T  $resolve
     * @return T
     */
    private static function once(string $key, callable $resolve): mixed
    {
        if (!array_key_exists($key, self::$memo)) {
            self::$memo[$key] = $resolve();
        }

        return self::$memo[$key];
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
        return self::once('feed', static fn (): ?string => self::resolveFeed());
    }

    private static function resolveFeed(): ?string
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
        $url = (string) (self::plugin()?->update_url ?? '');

        if ($url === '') {
            return null;
        }

        if ($channel === self::STABLE) {
            return $url;
        }

        /*
         * Dev does not come from the stable address at all any more. It is a
         * separate, private repository, read through the API because a private
         * one does not answer raw.githubusercontent - and the manifest it names
         * is fetched from the same place, so the two cannot drift apart.
         */
        if ($channel === self::DEV) {
            return self::devContents('update-dev.json');
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

    /**
     * A file in the dev repository, as the API address for it.
     *
     * The branch is named on every one of these. The contents endpoint answers
     * for the default branch when it is not, which is the same trap the branch
     * swap above was written for: it would quietly serve whatever the default
     * happens to be on the day rather than the branch the channel publishes.
     */
    public static function devContents(string $path): string
    {
        return 'https://api.github.com/repos/' . self::DEV_REPO
            . '/contents/' . ltrim($path, '/')
            . '?ref=' . self::DEV_BRANCH;
    }
}
