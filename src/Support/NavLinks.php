<?php

namespace LegendDevelopment\Theme\Support;

use Filament\Navigation\NavigationItem;
use Filament\Panel;
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

    /** Which panels a link appears in. */
    private const SCOPES = ['all', 'client', 'admin'];

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
        $rows = self::clean($rows);

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

                if ($row['icon'] !== '') {
                    $item->icon($row['icon']);
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
            $options[$scope] = Theme::trans('settings.notice.scope_' . $scope);
        }

        return $options;
    }

    private static function inScope(string $scope, bool $admin): bool
    {
        return match ($scope) {
            'admin' => $admin,
            'client' => !$admin,
            default => true,
        };
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
