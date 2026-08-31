<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Rows of your own in the panel's navigation: a Discord invite, a status page,
 * a knowledge base, a billing portal.
 *
 * Through Filament's own navigationItems(), not a render hook, so they behave
 * like every other entry does - they sit in a group, they follow the sidebar
 * whether it is a rail or a topbar, and they are drawn by the panel rather than
 * pasted into it. Which also means they cost nothing to keep working when
 * Filament changes how a sidebar looks.
 *
 * Stored as JSON in storage for the reason the announcements are: a list of
 * records is not a shape .env can hold.
 */
class NavLinks
{
    private const PATH = 'legend-theme/navigation.json';

    /**
     * Where a link appears.
     *
     * 'login' is the odd one and deliberately so: a link is a label and an
     * address wherever it is put, and the sign-in screen wanting three of them
     * is not a reason for a second list to keep them in. It simply means "not
     * in the navigation, under the sign-in form instead".
     */
    private const SCOPES = ['all', 'client', 'admin', 'login'];

    public const LOGIN = 'login';

    /**
     * Where a menu item is found, in the sidebar and in the topbar. The same
     * pair the icon overrides match on.
     *
     * @var array<int, string>
     */
    private const SELECTORS = ['.fi-sidebar-item-btn', '.fi-topbar-item-btn'];

    /**
     * A ceiling. Every one of these is a row in a sidebar that already has
     * plenty, and a navigation nobody can scan is worse than one link short.
     */
    public const MAX_ROWS = 12;

    /** @var array<int, array<string, mixed>>|null */
    private static ?array $cached = null;

    /**
     * @return array<int, array<string, mixed>>
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
            // Unreadable storage is a panel without extra links, not a panel
            // that will not render.
        }

        return self::$cached = self::clean(is_array($raw) ? $raw : []);
    }

    /**
     * @param  array<int|string, mixed>  $rows
     */
    public static function save(array $rows): void
    {
        $rows = self::withFavicons(self::clean($rows), self::rows());

        try {
            Storage::disk('local')->put(self::PATH, json_encode(
                $rows,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ));
        } catch (Throwable) {
            // Nothing to do: the list simply does not stick.
        }

        self::$cached = $rows;
    }

    /**
     * Hands the links to one panel.
     *
     * Called from the plugin's register(), which runs once per panel, so which
     * panel this is can be read straight off the argument - no guessing from a
     * request that might be a Livewire round trip.
     */
    public static function apply(Panel $panel): void
    {
        try {
            $admin = $panel->getId() === 'admin';
            $items = [];

            foreach (self::rows() as $index => $row) {
                if (!$row['enabled'] || !self::inScope($row['scope'], $admin)) {
                    continue;
                }

                $item = NavigationItem::make($row['label'])
                    ->url($row['url'], shouldOpenInNewTab: $row['new_tab'])
                    // Never marked active: these go somewhere else, and a
                    // sidebar that highlights a link to another site is lying
                    // about where you are.
                    ->isActiveWhen(fn (): bool => false)
                    ->sort($index);

                $icon = self::iconFor($row);

                if ($icon !== '') {
                    $item->icon($icon);
                }

                if ($row['group'] !== '') {
                    $item->group($row['group']);
                }

                $items[] = $item;
            }

            if ($items !== []) {
                $panel->navigationItems($items);
            }
        } catch (Throwable) {
            // A link that cannot be built is a link that is not there. The
            // panel is not worth losing over one.
        }
    }

    /**
     * The icon this row is drawn with - or rather, the icon element it is drawn
     * with, since a fetched favicon is painted over that element by the
     * stylesheet.
     *
     * Which is why a link asking for the site's own icon still needs one here.
     * Filament renders no icon element at all for an item with no icon, and a
     * background has to go on something. A globe is the right thing to be left
     * with anyway: it is what an off-site link is.
     */
    private static function iconFor(array $row): string
    {
        if ($row['icon'] !== '') {
            return $row['icon'];
        }

        return $row['favicon'] ? 'tabler-world' : '';
    }

    /* ------------------------------------------------------------ favicons */

    /** As big as a favicon is allowed to be once it is a data URI in a rule. */
    private const MAX_ICON_BYTES = 24576;

    /**
     * Fills in the site's own icon for the rows that asked for one.
     *
     * Done when the link is saved, never while a page renders. It is a request
     * to somebody else's server, and a sidebar is not a thing to hold up on a
     * stranger's network - nor to ask that stranger about once per visitor.
     *
     * An address that has not changed keeps the icon already fetched for it, so
     * saving the page again does not go back out to every site on it.
     *
     * @param  array<int, array<string, mixed>>  $rows
     * @param  array<int, array<string, mixed>>  $existing
     * @return array<int, array<string, mixed>>
     */
    private static function withFavicons(array $rows, array $existing): array
    {
        $known = [];

        foreach ($existing as $row) {
            if ($row['favicon_data'] !== '') {
                $known[$row['url']] = $row['favicon_data'];
            }
        }

        foreach ($rows as $index => $row) {
            if (!$row['favicon']) {
                $rows[$index]['favicon_data'] = '';

                continue;
            }

            $rows[$index]['favicon_data'] = $known[$row['url']]
                ?? self::fetchFavicon($row['url'])
                ?? '';
        }

        return $rows;
    }

    /**
     * The site's own icon, as a data URI, or nothing.
     *
     * Two ways in, in the order that costs least: the address every site is
     * expected to answer on, and then the page itself, which is where a site
     * that keeps its icon somewhere else says so.
     */
    private static function fetchFavicon(string $url): ?string
    {
        $host = self::reachableHost($url);

        if ($host === null) {
            return null;
        }

        $scheme = strtolower((string) (parse_url($url, PHP_URL_SCHEME) ?: 'https'));
        $root = $scheme . '://' . $host;

        return self::image($root . '/favicon.ico')
            ?? self::declaredIcon($url, $root);
    }

    /**
     * The icon a page names for itself, if it names one.
     */
    private static function declaredIcon(string $url, string $root): ?string
    {
        try {
            $response = Http::timeout(4)->withHeaders(['Accept' => 'text/html'])->get($url);

            if (!$response->successful()) {
                return null;
            }

            // The head is where the declaration is, and a page can be large.
            $head = substr($response->body(), 0, 200000);

            preg_match_all(
                '/<link[^>]+rel=["\'][^"\']*icon[^"\']*["\'][^>]*>/i',
                $head,
                $tags,
            );

            foreach ($tags[0] ?? [] as $tag) {
                if (preg_match('/href=["\']([^"\']+)["\']/i', $tag, $match) !== 1) {
                    continue;
                }

                $href = html_entity_decode($match[1], ENT_QUOTES);

                $candidate = str_starts_with($href, 'http')
                    ? $href
                    : $root . '/' . ltrim($href, '/');

                $data = self::image($candidate);

                if ($data !== null) {
                    return $data;
                }
            }
        } catch (Throwable) {
            // A site that will not answer keeps whatever icon was picked.
        }

        return null;
    }

    /**
     * One address, fetched and turned into a data URI - but only if what came
     * back is actually a small image. A page that answers /favicon.ico with its
     * own HTML is common, and none of that belongs in a stylesheet.
     */
    private static function image(string $url): ?string
    {
        if (self::reachableHost($url) === null) {
            return null;
        }

        try {
            $response = Http::timeout(4)->get($url);

            if (!$response->successful()) {
                return null;
            }

            $type = strtolower(trim(explode(';', (string) $response->header('Content-Type'))[0]));
            $body = $response->body();

            if (!str_starts_with($type, 'image/') || $body === '' || strlen($body) > self::MAX_ICON_BYTES) {
                return null;
            }

            return 'data:' . $type . ';base64,' . base64_encode($body);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * The host to fetch from, or nothing if it is not one this panel should be
     * asking.
     *
     * Only http and https, and nothing on the machine the panel is running on
     * or on the network around it. Whoever fills this in is an administrator,
     * but "the server will fetch any address you type" is a door worth keeping
     * shut even for them - the answer comes back from inside the network, and
     * the person reading it is not the one who typed it.
     */
    private static function reachableHost(string $url): ?string
    {
        $scheme = strtolower((string) (parse_url($url, PHP_URL_SCHEME) ?: ''));
        $host = strtolower((string) (parse_url($url, PHP_URL_HOST) ?: ''));

        if (!in_array($scheme, ['http', 'https'], true) || $host === '') {
            return null;
        }

        if (in_array($host, ['localhost', 'localhost.localdomain'], true)) {
            return null;
        }

        $ip = filter_var($host, FILTER_VALIDATE_IP) === false ? gethostbyname($host) : $host;

        // A name that does not resolve comes back unchanged; that is not an
        // address, and the request below simply will not connect.
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return $host;
        }

        $public = filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE,
        );

        return $public === false ? null : $host;
    }

    /**
     * A stored data URI, or nothing. Checked on the way back in as well, since
     * this ends up inside a CSS rule.
     */
    private static function dataUri(mixed $value): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        $value = trim((string) $value);

        if (strlen($value) > self::MAX_ICON_BYTES * 2) {
            return '';
        }

        return preg_match('#^data:image/[a-z0-9.+-]+;base64,[A-Za-z0-9+/=]+$#i', $value) === 1
            ? $value
            : '';
    }

    /**
     * The fetched icons, painted over the icon Filament rendered.
     *
     * The same route the icon overrides take - match the menu item on its link
     * and restyle the icon element - but as a background rather than a mask: a
     * favicon has its own colours, and a mask would throw them away.
     */
    public static function css(): string
    {
        $css = '';

        foreach (self::rows() as $row) {
            if (!$row['enabled'] || $row['favicon_data'] === '') {
                continue;
            }

            $href = str_replace(['\\', '"'], ['\\\\', '\\"'], $row['url']);

            $targets = array_map(
                static fn (string $selector): string => "{$selector}[href=\"{$href}\"]>.fi-icon",
                self::SELECTORS,
            );

            $hidden = implode(',', array_map(static fn (string $t): string => "{$t}>*", $targets));

            $css .= "{$hidden}{display:none;}";
            $css .= implode(',', $targets) . '{'
                . "background:url(\"{$row['favicon_data']}\") center/contain no-repeat;"
                // Rounded, because a favicon is a square picture sitting in a
                // row of line drawings and a hard edge is the thing that gives
                // that away.
                . 'border-radius:0.2rem;}';
        }

        return $css;
    }

    /**
     * @param  array<int|string, mixed>  $rows
     * @return array<int, array<string, mixed>>
     */
    private static function clean(array $rows): array
    {
        $clean = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $label = self::text($row['label'] ?? null, 40);
            $url = self::url($row['url'] ?? null);

            // A link with no name or nowhere to go is not one.
            if ($label === '' || $url === '') {
                continue;
            }

            $clean[] = [
                'enabled' => (bool) ($row['enabled'] ?? true),
                'label' => $label,
                'url' => $url,
                'icon' => self::icon($row['icon'] ?? null),
                'favicon' => (bool) ($row['favicon'] ?? false),
                // Kept as it was found, not taken from the form: it is fetched
                // when the link is saved, and a data URI is not something to
                // let a round trip through a browser rewrite.
                'favicon_data' => self::dataUri($row['favicon_data'] ?? null),
                'group' => self::text($row['group'] ?? null, 40),
                'scope' => self::oneOf($row['scope'] ?? null, self::SCOPES, 'all'),
                'new_tab' => (bool) ($row['new_tab'] ?? true),
            ];

            if (count($clean) >= self::MAX_ROWS) {
                break;
            }
        }

        return $clean;
    }

    /**
     * @return array<string, string>
     */
    public static function scopeOptions(): array
    {
        $options = [];

        foreach (self::SCOPES as $scope) {
            $options[$scope] = Theme::trans('navigation.scope_' . $scope);
        }

        return $options;
    }

    private static function inScope(string $scope, bool $admin): bool
    {
        return match ($scope) {
            'admin' => $admin,
            'client' => !$admin,
            // Not navigation at all. See Login::links().
            self::LOGIN => false,
            default => true,
        };
    }

    /**
     * The links meant for the sign-in screen rather than the navigation.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function forLogin(): array
    {
        return array_values(array_filter(
            self::rows(),
            static fn (array $row): bool => $row['enabled'] && $row['scope'] === self::LOGIN,
        ));
    }

    /**
     * An icon name, or nothing. Only the shape Blade Icons uses, so a value
     * that has been edited by hand cannot become anything else on its way into
     * a component.
     */
    private static function icon(mixed $value): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        $value = trim((string) $value);

        return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value) === 1 ? $value : '';
    }

    private static function text(mixed $value, int $max): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        $value = preg_replace('/[\x00-\x1f\x7f]+/u', ' ', (string) $value) ?? '';
        $value = preg_replace('/\s+/u', ' ', $value) ?? '';

        return mb_substr(trim($value), 0, $max);
    }

    /**
     * An address, or nothing. Only http and https, or a path inside this panel -
     * which rules out javascript: and data:, the two that turn a link into
     * something else. The same test the announcements use, for the same reason:
     * this ends up in the navigation of a panel other people log in to.
     */
    private static function url(mixed $value): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        $value = trim((string) $value);

        if ($value === '' || mb_strlen($value) > 300) {
            return '';
        }

        if (str_starts_with($value, '/') && !str_starts_with($value, '//')) {
            return $value;
        }

        $scheme = strtolower((string) (parse_url($value, PHP_URL_SCHEME) ?: ''));

        return in_array($scheme, ['http', 'https'], true) ? $value : '';
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        $value = is_scalar($value) ? (string) $value : '';

        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
