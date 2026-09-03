<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Icon styling, and per menu item icon replacement.
 *
 * Filament reads a page's navigation icon from a static property on the page
 * class, so a plugin cannot swap it through configuration. What a plugin can do
 * is hide the rendered SVG's paths and mask the element with a different icon -
 * the result still inherits currentColor, so hover and active states keep
 * working. The chosen icon is rendered server side through Blade Icons, the same
 * factory Pelican itself uses to validate icon names.
 */
class Icons
{
    /**
     * The navigation rows this can replace, and what they are called.
     *
     * A list rather than a free-text box, which is what this was. The field
     * matched part of a link, so it accepted anything and quietly did nothing
     * when what you typed was not a row - and there was no way to find out what
     * was, short of reading the help text underneath. These are the pages
     * Pelican puts inside a server.
     *
     * The key is the segment matched against the link, so it is also what is
     * stored: an override saved before this became a list still resolves.
     */
    public const TARGETS = [
        'console' => 'Console',
        'files' => 'Files',
        'databases' => 'Databases',
        'schedules' => 'Schedules',
        'users' => 'Users',
        'backups' => 'Backups',
        'network' => 'Network',
        'startup' => 'Startup',
        'mounts' => 'Mounts',
        'activity' => 'Activity',
        'settings' => 'Settings',
        'webhooks' => 'Webhooks',
    ];

    /**
     * Menu items are matched on part of their link, which is stable across
     * languages and server names.
     */
    private const SELECTORS = [
        '.fi-sidebar-item-btn',
        '.fi-topbar-item-btn',
    ];

    public static function css(): string
    {
        $stroke = self::oneOf(Theme::config('icon_stroke'), ['1.25', '2', '2.5'], '2');
        $scale = self::oneOf(Theme::config('icon_scale'), ['0.9', '1', '1.1', '1.25'], '1');

        $css = ":root{--ld-icon-stroke:{$stroke};--ld-icon-scale:{$scale};}";

        if (Theme::config('icon_accent', false)) {
            $css .= 'html.dark .fi-sidebar-item-btn>.fi-icon,html.dark .fi-topbar-item-btn>.fi-icon{color:var(--primary-400);}';
        }

        return $css . self::overrideCss();
    }

    /**
     * @return array<string, string>
     */
    public static function overrides(): array
    {
        $map = [];

        foreach (explode('|', (string) Theme::config('icon_overrides', '')) as $pair) {
            [$match, $icon] = array_pad(explode(':', $pair, 2), 2, null);

            $match = self::sanitiseMatch((string) $match);
            $icon = self::sanitiseIcon((string) $icon);

            if ($match === null || $icon === null) {
                continue;
            }

            $map[$match] = $icon;
        }

        return $map;
    }

    /**
     * The same pairs as rows, which is what a repeater of two fields hands
     * back - one row per replaced icon, so each can have a picker of its own.
     *
     * Which of the two fields a stored value goes back into depends on what
     * it is: a path belongs in the upload box and a name in the picker, and
     * putting a path in the picker would show a row whose icon field holds
     * something the picker cannot resolve.
     *
     * @return array<int, array{match: string, icon: string|null, file: array<int, string>}>
     */
    public static function rows(): array
    {
        $rows = [];

        foreach (self::overrides() as $match => $icon) {
            $uploaded = str_contains($icon, '/');

            $rows[] = [
                'match' => $match,
                'icon' => $uploaded ? null : $icon,
                'file' => $uploaded ? [$icon] : [],
            ];
        }

        return $rows;
    }

    /**
     * Accepts either shape: rows from the repeater, or the flat map the older
     * key/value field produced - a saved .env from before this changed still
     * round-trips.
     *
     * @param  array<mixed, mixed>  $rows
     */
    public static function toStorage(array $rows): string
    {
        $pairs = [];

        foreach ($rows as $key => $row) {
            if (is_array($row)) {
                $match = self::sanitiseMatch((string) ($row['match'] ?? ''));

                /*
                 * An upload wins over a picked icon, the same way it does for
                 * the background and the login picture. Somebody who uploads a
                 * file after choosing an icon means the file; leaving the
                 * picker set is not a change of mind, it is a field they did
                 * not think to clear.
                 */
                $file = self::path($row['file'] ?? null);

                $icon = $file ?? self::sanitiseIcon((string) ($row['icon'] ?? ''));
            } else {
                $match = self::sanitiseMatch((string) $key);
                $icon = self::sanitiseIcon(is_string($row) ? $row : '');
            }

            if ($match === null || $icon === null) {
                continue;
            }

            $pairs[] = "{$match}:{$icon}";
        }

        return implode('|', array_unique($pairs));
    }

    private static function overrideCss(): string
    {
        $overrides = self::overrides();

        if ($overrides === []) {
            return '';
        }

        // Each icon is read off disk to build its data URI, so the result is
        // cached against the settings that produced it - and a cache that
        // cannot answer costs that work again, not the page it was rendering.
        try {
            return cache()->remember(
                'legend-theme.icons.' . md5(serialize($overrides)),
                now()->addDay(),
                static fn (): string => self::buildOverrideCss($overrides),
            );
        } catch (Throwable $exception) {
            report($exception);

            return self::buildOverrideCss($overrides);
        }
    }

    /**
     * @param  array<string, string>  $overrides
     */
    private static function buildOverrideCss(array $overrides): string
    {
        $css = '';

        foreach ($overrides as $match => $icon) {
            $picture = str_contains($icon, '/');
            $uri = $picture ? self::fileUrl($icon) : self::dataUri($icon);

            if ($uri === null) {
                continue;
            }

            /*
             * Inside a server, and nowhere else.
             *
             * The match is a segment of a link, and every one of these
             * words is also a page in the admin area: /admin/settings,
             * /admin/users, /admin/databases, /admin/mounts,
             * /admin/webhooks. Without the first condition, replacing the
             * icon on a server's Settings row replaced it on the panel's
             * Settings row too - a row this feature never meant to touch
             * and does not name.
             *
             * The server panel is mounted on /server, which is what makes
             * this exact rather than a guess: ServerPanelProvider calls
             * path('server'), so every page inside one is
             * /server/<id>/<page>.
             */
            $targets = array_map(
                fn (string $selector): string => "{$selector}[href*=\"/server/\"][href*=\"/{$match}\"]>.fi-icon",
                self::SELECTORS,
            );

            $hidden = implode(',', array_map(fn (string $target): string => "{$target}>*", $targets));
            $shown = implode(',', $targets);

            $css .= "{$hidden}{display:none;}";

            /*
             * A pack icon is masked and an uploaded picture is not, and the
             * difference is the whole reason this branches.
             *
             * A mask throws away everything but the shape and fills it with
             * currentColor, which is exactly right for a line icon: it then
             * follows the accent, the hover state and the active row without
             * knowing anything about them. Do that to a logo and you get a flat
             * silhouette in the text colour - every colour in it gone, which is
             * not what anybody uploads a logo for.
             *
             * So a picture is drawn as a background instead and keeps its own
             * colours. The cost is that it no longer responds to the row, which
             * is the same trade the sidebar's own icon makes.
             */
            $css .= $picture
                ? "{$shown}{background:url(\"{$uri}\") center/contain no-repeat;}"
                : "{$shown}{background-color:currentColor;"
                    . "-webkit-mask:url(\"{$uri}\") center/contain no-repeat;"
                    . "mask:url(\"{$uri}\") center/contain no-repeat;}";
        }

        return $css;
    }

    /**
     * The address of an uploaded picture, or null.
     *
     * The result goes inside url("...") in a stylesheet, so anything that could
     * end that string early ends the whole override instead. sanitiseIcon() has
     * already held the stored path to one directory and one filename; this
     * guards the URL the disk hands back, which is a different string and could
     * carry a base path nobody here chose.
     */
    private static function fileUrl(string $path): ?string
    {
        try {
            $url = Storage::disk('public')->url($path);
        } catch (Throwable) {
            return null;
        }

        if (!is_string($url) || $url === '') {
            return null;
        }

        return preg_match('/["\'()\\\\\s]/', $url) === 1 ? null : $url;
    }

    private static function dataUri(string $icon): ?string
    {
        // Whichever pack it came from - a registered Blade Icons set, or the
        // uploaded one. An unknown name leaves Pelican's own icon in place.
        $svg = IconPacks::svg($icon);

        if ($svg === null) {
            return null;
        }

        $svg = preg_replace('/\s+/', ' ', trim($svg)) ?? '';

        if ($svg === '') {
            return null;
        }

        return 'data:image/svg+xml,' . rawurlencode($svg);
    }

    /**
     * The stored path out of whatever a FileUpload hands back.
     *
     * Filament gives an array keyed by an internal id once the file is saved,
     * and an empty array when the field was left alone - so the first element
     * is the answer and its absence means there is not one.
     */
    private static function path(mixed $value): ?string
    {
        if (is_array($value)) {
            $value = reset($value);
        }

        if (!is_string($value) || trim($value) === '') {
            return null;
        }

        $path = self::sanitiseIcon($value);

        // Only a path counts here. A FileUpload cannot produce a bare name, so
        // one would mean something else got into this field.
        return $path !== null && str_contains($path, '/') ? $path : null;
    }

    private static function sanitiseMatch(string $match): ?string
    {
        $match = preg_replace('/[^a-z0-9\-_]/', '', strtolower(trim($match))) ?? '';

        return $match === '' ? null : $match;
    }

    /**
     * Either a name from an icon pack, or the path of an uploaded file.
     *
     * The two are told apart by the slash, which is why this is one function
     * rather than two: a stored value has to survive a round trip through .env
     * and come back as whichever it was.
     *
     * A pack name is lowercased - dots and underscores allowed as well as
     * dashes, because an uploaded pack is named after its files and those come
     * as they come. A path is not lowercased, because Livewire names an
     * uploaded file with mixed-case randomness and lowercasing it would point
     * at a file that does not exist. It is held to one directory and one
     * filename, with no traversal: this ends up inside url() in a stylesheet.
     */
    private static function sanitiseIcon(string $icon): ?string
    {
        $icon = trim($icon);

        if (str_contains($icon, '/')) {
            return preg_match('/^[A-Za-z0-9._-]+\/[A-Za-z0-9._-]+$/D', $icon) === 1
                && !str_contains($icon, '..')
                ? $icon
                : null;
        }

        $icon = strtolower($icon);

        return preg_match('/^[a-z0-9._-]+$/D', $icon) === 1 ? $icon : null;
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
