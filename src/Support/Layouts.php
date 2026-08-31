<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Saved page layouts: the order of the blocks on a page, and which are hidden.
 *
 * Filament stamps every schema component with a stable key - either
 * wire:partial="schema-component::form.APP_NAME" or a wire:key ending in that
 * same path - and those components are grid items. So a layout is nothing more
 * than an `order` per key, which means the saved arrangement is applied by plain
 * CSS: no JavaScript, and no flash of the original order on load. The editor
 * that produces those numbers is the only part that needs scripting.
 *
 * Two things this cannot do, both because it is CSS and not markup:
 * a block can only move within the container it already lives in, and `order`
 * changes the visual order while the keyboard and screen readers keep following
 * the original one.
 */
class Layouts
{
    /** The arrangement everyone starts from, set by someone who may share one. */
    private const PATH = 'legend-theme/layouts.json';

    /**
     * And one file per person for their own.
     *
     * A file each rather than one file holding everybody: a request reads the
     * shared arrangement and its own reader's, never anyone else's, so the read
     * stays the same size on a panel with four users and on one with four
     * hundred - and no cap has to be invented to stop a single file growing
     * without limit.
     */
    private const USER_PATH = 'legend-theme/layouts/%d.json';

    public const MAX_ITEMS = 200;

    /** Everyone's, as opposed to one person's. */
    public const SHARED = 'shared';

    public const OWN = 'me';

    /** @var array<string, array<string, array<string, array{o?: int, h?: bool}>>> */
    private static array $cached = [];

    /**
     * The page a path belongs to, with record ids folded away so one layout
     * covers every server and every record of the same page.
     */
    public static function pageKey(string $path): string
    {
        $segments = array_map(static function (string $segment): string {
            if (preg_match('/^\d+$/', $segment)) {
                return '{id}';
            }

            if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-/i', $segment)) {
                return '{id}';
            }

            // Short ids like a server's uuid_short: letters and digits mixed,
            // long enough not to be a word like "settings" or "backups".
            if (preg_match('/^(?=.*\d)[A-Za-z0-9]{6,}$/', $segment)) {
                return '{id}';
            }

            return $segment;
        }, explode('/', trim($path, '/')));

        return '/' . implode('/', $segments);
    }

    /**
     * What this person sees on this page: the shared arrangement, with their
     * own laid over it.
     *
     * Per key rather than all-or-nothing, so somebody who has moved one block
     * still gets the shared arrangement of the rest - and still gets a block
     * that was added to the shared one after they last arranged anything.
     *
     * @return array<string, array{o?: int, h?: bool}>
     */
    public static function for(string $path, ?int $userId = null): array
    {
        $page = self::pageKey($path);
        $userId ??= self::currentUser();

        $shared = self::read(self::PATH)[$page] ?? [];
        $own = $userId === null ? [] : (self::read(self::userPath($userId))[$page] ?? []);

        return array_merge($shared, $own);
    }

    /**
     * One scope on its own, for the editor to show what it is about to change
     * rather than the two of them added together.
     *
     * @return array<string, array{o?: int, h?: bool}>
     */
    public static function scoped(string $path, string $scope, ?int $userId = null): array
    {
        $page = self::pageKey($path);

        if ($scope === self::SHARED) {
            return self::read(self::PATH)[$page] ?? [];
        }

        $userId ??= self::currentUser();

        return $userId === null ? [] : (self::read(self::userPath($userId))[$page] ?? []);
    }

    public static function css(string $path): string
    {
        $css = '';

        foreach (self::for($path) as $key => $item) {
            $selector = self::selector($key);

            if ($selector === null) {
                continue;
            }

            if ($item['h'] ?? false) {
                $css .= $selector . '{display:none !important;}';

                continue;
            }

            if (isset($item['o'])) {
                $css .= $selector . '{order:' . (int) $item['o'] . ';}';
            }
        }

        return $css;
    }

    /**
     * @param  array<mixed, mixed>  $items
     * @param  string  $scope  SHARED for everyone, OWN for the person saving.
     */
    public static function save(string $page, array $items, string $scope = self::SHARED): void
    {
        if ($scope === self::SHARED) {
            $file = self::PATH;
        } else {
            $userId = self::currentUser();

            if ($userId === null) {
                return;
            }

            $file = self::userPath($userId);
        }

        $layouts = self::read($file);
        $clean = [];

        foreach (array_slice($items, 0, self::MAX_ITEMS, true) as $key => $item) {
            $key = self::sanitiseKey((string) $key);

            if ($key === null || !is_array($item)) {
                continue;
            }

            $entry = [];

            if (isset($item['o']) && is_numeric($item['o'])) {
                $entry['o'] = max(1, min(999, (int) $item['o']));
            }

            if (($item['h'] ?? false) === true) {
                $entry['h'] = true;
            }

            if ($entry !== []) {
                $clean[$key] = $entry;
            }
        }

        $page = self::pageKey($page);

        if ($clean === []) {
            unset($layouts[$page]);
        } else {
            $layouts[$page] = $clean;
        }

        self::$cached[$file] = $layouts;

        try {
            Storage::disk('local')->put($file, (string) json_encode($layouts, JSON_PRETTY_PRINT));
        } catch (Throwable) {
            // The arrangement simply does not stick; the panel keeps working.
        }
    }

    /**
     * A key carries where it came from, because the two sources need different
     * selectors: wire:partial holds the path outright, while wire:key is
     * prefixed with a Livewire id that changes on every request - so that one is
     * matched on its ending instead.
     */
    private static function selector(string $key): ?string
    {
        [$source, $path] = array_pad(explode('|', $key, 2), 2, null);

        if (!is_string($path) || $path === '') {
            return null;
        }

        return match ($source) {
            'partial' => '[wire\\:partial="schema-component::' . $path . '"]',
            'key' => '[wire\\:key$=".' . $path . '"]',
            default => null,
        };
    }

    private static function sanitiseKey(string $key): ?string
    {
        $key = trim($key);

        if (strlen($key) > 140 || !preg_match('/^(partial|key)\|[A-Za-z0-9_.\-]+$/', $key)) {
            return null;
        }

        return $key;
    }

    private static function userPath(int $userId): string
    {
        return sprintf(self::USER_PATH, $userId);
    }

    /**
     * Who is asking, or nobody.
     *
     * Nobody is a real answer here: the stylesheet is built on the sign-in
     * screen too, and there is no one there to have arranged anything.
     */
    private static function currentUser(): ?int
    {
        try {
            $id = user()?->id;

            return is_numeric($id) ? (int) $id : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * One file, read once per request.
     *
     * @return array<string, array<string, array{o?: int, h?: bool}>>
     */
    private static function read(string $file): array
    {
        if (array_key_exists($file, self::$cached)) {
            return self::$cached[$file];
        }

        self::$cached[$file] = [];

        try {
            $disk = Storage::disk('local');

            if ($disk->exists($file)) {
                $decoded = json_decode((string) $disk->get($file), true);

                if (is_array($decoded)) {
                    self::$cached[$file] = $decoded;
                }
            }
        } catch (Throwable) {
            self::$cached[$file] = [];
        }

        return self::$cached[$file];
    }
}
