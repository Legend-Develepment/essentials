<?php

namespace LegendDevelopment\Theme\Support\Status;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Other things worth knowing are up: a website, an API, a Discord bot's health
 * endpoint.
 *
 * A game panel is not the only thing a community runs, and a status page that
 * covers the servers and not the site everybody visits first is half a status
 * page. So this asks an address whether it answers, and puts the result beside
 * the servers.
 *
 * **Administrators only, and that is a security decision rather than a
 * convenience.** A monitor makes the panel issue an HTTP request to an address
 * somebody typed. Let an ordinary user add one and the panel becomes a probe
 * they can point at anything it can reach - a database on the internal network,
 * a cloud metadata endpoint, a neighbour's admin interface - and read the answer
 * from whether the row says up or down. That is a server-side request forgery
 * with a display, and the fact that it only leaks one bit at a time does not
 * make it acceptable. So monitors live behind the same permission as the rest of
 * the panel-wide status page, and per-user pages (Status\Pages) cannot have any.
 *
 * An administrator adding one is different in kind: somebody who can edit the
 * panel's settings can already reach further than this by other means.
 *
 * Kept in a file rather than in .env, like the announcements and the sidebar
 * links: a URL and a name per row is a list, and .env holds values.
 */
class Monitors
{
    private const PATH = 'legend-theme/status/monitors.json';

    /** Enough for a community's own services; not a monitoring product. */
    public const MAX = 20;

    /** Long enough for a slow site, short enough that ten of them are quick. */
    private const TIMEOUT = 8;

    /** @var array<int, array{name: string, url: string, expect: int}>|null */
    private static ?array $cached = null;

    /**
     * @return array<int, array{name: string, url: string, expect: int}>
     */
    public static function rows(): array
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        $raw = null;

        try {
            $disk = Storage::disk('local');

            if ($disk->exists(self::PATH)) {
                $raw = json_decode((string) $disk->get(self::PATH), true);
            }
        } catch (Throwable) {
            // Unreadable storage is a status page with no monitors on it, not
            // one that will not draw.
        }

        return self::$cached = self::clean(is_array($raw) ? $raw : []);
    }

    /**
     * Returns whether the list actually reached the disk.
     *
     * @param  array<int|string, mixed>  $rows
     */
    public static function save(array $rows): bool
    {
        $rows = self::clean($rows);

        try {
            $written = Storage::disk('local')->put(
                self::PATH,
                (string) json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            ) !== false;
        } catch (Throwable) {
            $written = false;
        }

        // Only when the disk agreed. A memo filled in before the write is a
        // promise the disk did not make.
        if ($written) {
            self::$cached = $rows;
        }

        return $written;
    }

    /**
     * @param  array<int|string, mixed>  $rows
     * @return array<int, array{name: string, url: string, expect: int}>
     */
    private static function clean(array $rows): array
    {
        $clean = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $url = self::url($row['url'] ?? null);
            $name = is_string($row['name'] ?? null) ? trim($row['name']) : '';
            $name = trim(preg_replace('/[[:cntrl:]]+/u', ' ', $name) ?? '');

            if ($url === null || $name === '') {
                continue;
            }

            $clean[] = [
                'name' => mb_substr($name, 0, 40),
                'url' => $url,
                /*
                 * What counts as answering.
                 *
                 * Nought means "any answer at all", which is right for a site
                 * that redirects, returns 403 to a bare GET, or answers 401
                 * because it wants a key. A specific code is for an endpoint
                 * written to say 200 and nothing else. Getting this wrong in
                 * the strict direction is a monitor that is red for ever on a
                 * service that is perfectly fine.
                 */
                'expect' => max(0, min(599, (int) ($row['expect'] ?? 0))),
            ];
        }

        return array_slice($clean, 0, self::MAX);
    }

    /**
     * An address this will agree to ask.
     *
     * https only. Not for tidiness: a status page reports on services a
     * community reaches over the internet, and a panel making plain-http
     * requests on a timer is a panel leaking which of its services exist to
     * anybody on the path. An administrator who genuinely needs http can put a
     * proxy in front of it - and if the service is on the panel's own machine,
     * it is not what this feature is for.
     */
    public static function url(mixed $value): ?string
    {
        $url = is_string($value) ? trim($value) : '';

        if ($url === '' || mb_strlen($url) > 300) {
            return null;
        }

        if (!str_starts_with(strtolower($url), 'https://')) {
            return null;
        }

        return filter_var($url, FILTER_VALIDATE_URL) === false ? null : $url;
    }

    /**
     * A floor of its own, under the page's.
     *
     * A page can be set to rebuild every ten seconds, and these are requests to
     * somebody else's website. Six an hour is a monitor; six a minute is
     * something their logs will notice and their rate limiter may act on - and
     * a status page that gets its own subject to block it is worse than no
     * status page.
     *
     * A minute is also past the point where the answer changes: an outage is
     * not usually over in forty seconds, and one that is will be caught by the
     * next round.
     */
    private const FLOOR = 60;

    private const RESULT = 'legend-theme.status.monitors';

    /**
     * Ask every monitor, once - or hand back what they said a moment ago.
     *
     * Called from Publish::build(), which is itself behind a lock, so this is
     * already off the request path. The cache here is about the *page's*
     * interval rather than about visitors: a page rebuilding every ten seconds
     * must not turn into ten times the traffic at somebody's site.
     *
     * @return array<int, array{name: string, state: string}>
     */
    public static function check(): array
    {
        $rows = self::rows();

        if ($rows === []) {
            return [];
        }

        try {
            /*
             * Keyed on the list itself.
             *
             * So editing a monitor is answered at once rather than a minute
             * later - the same reasoning as the icon pack's stamp, and the same
             * fault avoided: a cache whose key says nothing about its inputs is
             * a cache that goes on being confidently wrong.
             */
            return cache()->remember(
                self::RESULT . '.' . md5(serialize($rows)),
                now()->addSeconds(self::FLOOR),
                static fn (): array => self::askAll($rows),
            );
        } catch (Throwable) {
            return self::askAll($rows);
        }
    }

    /**
     * @param  array<int, array{name: string, url: string, expect: int}>  $rows
     * @return array<int, array{name: string, state: string}>
     */
    private static function askAll(array $rows): array
    {
        $out = [];

        foreach ($rows as $row) {
            $out[] = ['name' => $row['name'], 'state' => self::ask($row['url'], $row['expect'])];
        }

        return $out;
    }

    /**
     * One address.
     *
     * A HEAD first, because a status check has no use for the body and some of
     * these are megabytes. A server that refuses HEAD - and plenty do, with 405
     * - gets a GET, which is the only way to tell "does not support HEAD" from
     * "is down".
     */
    private static function ask(string $url, int $expect): string
    {
        try {
            $response = Http::timeout(self::TIMEOUT)
                ->withoutRedirecting()
                ->head($url);

            if ($response->status() === 405) {
                $response = Http::timeout(self::TIMEOUT)->withoutRedirecting()->get($url);
            }

            $status = $response->status();

            if ($expect > 0) {
                return $status === $expect ? 'up' : 'down';
            }

            /*
             * Any answer below 500 is a service that is running.
             *
             * A 301, a 403, a 401 - all of them are a program that received a
             * request and decided something, which is what "is it up" asks. A
             * 5xx is the service failing to do its own job, and that is the one
             * worth calling down.
             */
            return $status > 0 && $status < 500 ? 'up' : 'down';
        } catch (Throwable) {
            /*
             * Down rather than unknown, and this is the one place in the status
             * feature where that is right.
             *
             * A game server behind a firewall the panel cannot cross is a
             * reachability problem and says nothing about the server. A public
             * https address that will not answer a request from a machine on
             * the internet *is* the outage - that is exactly what a visitor
             * would experience.
             */
            return 'down';
        }
    }
}
