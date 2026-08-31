<?php

namespace LegendDevelopment\Theme\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * A style of somebody's own, rather than the panel's.
 *
 * The roadmap had this down as undecided, and the open question was where a
 * choice per person could live. Both answers it listed were bad: localStorage
 * flashes the administrator's colours before the browser applies yours, and a
 * user preference on the server was read as meaning a table and a migration -
 * which this plugin has stayed away from so that uninstalling leaves nothing
 * behind.
 *
 * The page arranger answered it in passing. It keeps a file per person under
 * storage/app/legend-theme, no table and no migration, and a request reads only
 * its own reader's. The same shape works here, and there is no flash: the choice
 * is read on the server and the stylesheet is built from it before the page is
 * sent.
 *
 * Two rules, and they are separate on purpose. **Which styles may be chosen is
 * the administrator's** - an empty list means nobody chooses anything, so a
 * panel that updates to this release does not suddenly let everyone repaint it.
 * **Which of them a person picks is theirs**, and affects nobody else.
 */
class UserTheme
{
    private const PATH = 'legend-theme/themes/%d.json';

    /** @var array<int, string|null> */
    private static array $cached = [];

    /**
     * The styles this panel offers, in the order the picker shows them.
     *
     * Stored as what is allowed rather than what is not - the opposite of
     * Features, and for the opposite reason. A feature added later should arrive
     * switched on; a style added later should not arrive as something everyone
     * may suddenly repaint their panel with. This one is a list the
     * administrator wrote, and it stays the list they wrote.
     *
     * @return array<int, string>
     */
    public static function allowed(): array
    {
        $stored = Theme::config('user_themes', '');
        $stored = is_string($stored) ? array_filter(array_map('trim', explode(',', $stored))) : [];

        // Intersected with what exists, so a style deleted since it was allowed
        // falls out rather than being offered and then failing to apply.
        return array_values(array_intersect(Presets::names(), $stored));
    }

    public static function enabled(): bool
    {
        return self::allowed() !== [];
    }

    /**
     * @param  mixed  $value
     */
    public static function sanitiseAllowed(mixed $value): string
    {
        $value = is_array($value) ? $value : [];

        return implode(',', array_values(array_intersect(Presets::names(), $value)));
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (Presets::names() as $preset) {
            $options[$preset] = Presets::label($preset);
        }

        return $options;
    }

    /* ------------------------------------------------------- one person - */

    /**
     * What this person chose, or null for the panel's own.
     *
     * Null covers three different situations that all mean the same thing here:
     * nobody is signed in, they never chose, or what they chose is no longer on
     * the list. The last one matters - an administrator narrowing the list has
     * to take back the styles they removed, not leave people on them.
     */
    public static function choice(?int $userId = null): ?string
    {
        $userId ??= self::currentUser();

        if ($userId === null || !self::enabled()) {
            return null;
        }

        if (array_key_exists($userId, self::$cached)) {
            return self::$cached[$userId];
        }

        $chosen = self::read($userId);

        return self::$cached[$userId] = in_array($chosen, self::allowed(), true) ? $chosen : null;
    }

    public static function save(?string $preset): bool
    {
        $userId = self::currentUser();

        if ($userId === null) {
            return false;
        }

        // Only from the list, checked here rather than trusted from the form:
        // the value arrives from a browser.
        $preset = $preset !== null && in_array($preset, self::allowed(), true) ? $preset : null;

        self::$cached[$userId] = $preset;

        try {
            $file = sprintf(self::PATH, $userId);

            if ($preset === null) {
                Storage::disk('local')->delete($file);

                return true;
            }

            Storage::disk('local')->put($file, (string) json_encode(['preset' => $preset]));

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The stylesheet, built from this person's style instead of the panel's.
     *
     * Empty for anyone who has not chosen one, which is most people most of the
     * time - and empty means the panel's own block is the only one on the page,
     * exactly as before this existed.
     *
     * @param  callable(): string  $build
     */
    public static function css(callable $build): string
    {
        $preset = self::choice();

        if ($preset === null) {
            return '';
        }

        $values = Presets::values($preset);

        if ($values === []) {
            return '';
        }

        return Theme::using($values, function () use ($build, $values): string {
            /*
             * Filament's own palette as well as this theme's tokens. Filament
             * writes --primary-* from what $panel->colors() was handed, and that
             * was handed the panel's accent long before anyone was signed in -
             * so without this the buttons keep the administrator's colour while
             * everything around them changes, which reads as a broken page
             * rather than as a choice.
             */
            $accent = Palette::sanitize($values['accent'] ?? null);

            return Palette::variables($accent) . $build();
        });
    }

    private static function currentUser(): ?int
    {
        try {
            $id = user()?->id;

            return is_numeric($id) ? (int) $id : null;
        } catch (Throwable) {
            return null;
        }
    }

    private static function read(int $userId): ?string
    {
        try {
            $disk = Storage::disk('local');
            $file = sprintf(self::PATH, $userId);

            if (!$disk->exists($file)) {
                return null;
            }

            $decoded = json_decode((string) $disk->get($file), true);

            $preset = is_array($decoded) ? ($decoded['preset'] ?? null) : null;

            return is_string($preset) && $preset !== '' ? $preset : null;
        } catch (Throwable) {
            return null;
        }
    }
}
