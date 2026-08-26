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
    private const PATH = 'legend-theme/layouts.json';

    public const MAX_ITEMS = 200;

    /** @var array<string, array<string, array{o?: int, h?: bool}>>|null */
    private static ?array $cached = null;

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
     * @return array<string, array{o?: int, h?: bool}>
     */
    public static function for(string $path): array
    {
        return self::all()[self::pageKey($path)] ?? [];
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
     */
    public static function save(string $page, array $items): void
    {
        $layouts = self::all();
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

        self::$cached = $layouts;

        try {
            Storage::disk('local')->put(self::PATH, (string) json_encode($layouts, JSON_PRETTY_PRINT));
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

    /**
     * @return array<string, array<string, array{o?: int, h?: bool}>>
     */
    private static function all(): array
    {
        if (self::$cached !== null) {
            return self::$cached;
        }

        self::$cached = [];

        try {
            $disk = Storage::disk('local');

            if ($disk->exists(self::PATH)) {
                $decoded = json_decode((string) $disk->get(self::PATH), true);

                if (is_array($decoded)) {
                    self::$cached = $decoded;
                }
            }
        } catch (Throwable) {
            self::$cached = [];
        }

        return self::$cached;
    }
}
