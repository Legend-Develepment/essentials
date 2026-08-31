<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * The settings as a file: out, and back in again.
 *
 * What it is for. Moving a look from a test panel to a live one without setting
 * sixty fields twice; keeping a copy before trying something, so there is
 * something to go back to; handing your look to somebody else.
 *
 * What it deliberately leaves out is the uploads - the sign-in picture, the
 * background, the icon pack. Those are files on a disk, and a settings file that
 * quietly did not include them would be worse than one that says so: you would
 * import it, see the picture missing, and have no way to tell whether it had
 * been left out or lost.
 *
 * An imported file is a file from outside. Nothing here writes anything: it
 * produces a settings array which goes through Settings::persist(), the same
 * path the form uses, so every value meets the same sanitiser it would have met
 * had it been typed in. Import is the third caller of those sanitisers and is
 * not given a path of its own.
 */
class Portable
{
    /** What the file says it is, so a wrong file can be turned away as one. */
    private const MARKER = 'legend-theme-settings';

    /**
     * Settings that name a file rather than holding a value.
     *
     * icon_pack_file is the upload field itself and is never a stored value.
     */
    private const EXCLUDED = ['login_image', 'background_image', 'icon_pack_file'];

    /** A settings file is a few kilobytes; anything larger is not one. */
    public const MAX_BYTES = 262144;

    /**
     * @return array<string, mixed>
     */
    public static function export(): array
    {
        return [
            'marker' => self::MARKER,
            'plugin' => Theme::id(),
            // Not used on the way back in - a file from an older release is
            // still worth importing, and the sanitisers decide what survives -
            // but worth having when somebody opens the file to read it.
            'version' => Channels::installedVersion(),
            'exported_at' => now()->toIso8601String(),
            'settings' => self::settings(),
        ];
    }

    public static function filename(): string
    {
        return 'pelican-essentials-' . now()->format('Y-m-d-His') . '.json';
    }

    /**
     * The current settings, minus the ones that are files.
     *
     * @return array<string, mixed>
     */
    public static function settings(): array
    {
        $data = Settings::data();

        foreach (self::EXCLUDED as $key) {
            unset($data[$key]);
        }

        return $data;
    }

    /**
     * A file, turned into settings this panel recognises.
     *
     * Unknown keys are dropped rather than passed along. persist() writes an
     * explicit list of environment variables, so an unknown key would be
     * ignored anyway - but dropping it here is what lets changes() report
     * honestly on what the file will actually do.
     *
     * @return array<string, mixed>
     */
    public static function parse(string $json): array
    {
        try {
            $decoded = json_decode($json, true);
        } catch (Throwable) {
            return [];
        }

        if (!is_array($decoded)) {
            return [];
        }

        // A bare settings object is accepted too: somebody who edited the file
        // down to the part they wanted should not be told it is the wrong file.
        $settings = is_array($decoded['settings'] ?? null) ? $decoded['settings'] : $decoded;

        if (($decoded['marker'] ?? self::MARKER) !== self::MARKER) {
            return [];
        }

        $known = array_keys(self::settings());

        return array_intersect_key($settings, array_flip($known));
    }

    /**
     * What importing this would change, and to what.
     *
     * Shown before anything is written, because a settings file can undo an
     * afternoon's work and "sixty settings replaced" is not something to find
     * out afterwards.
     *
     * @param  array<string, mixed>  $incoming
     * @return array<int, array{key: string, from: string, to: string}>
     */
    public static function changes(array $incoming): array
    {
        $current = self::settings();
        $changes = [];

        foreach ($incoming as $key => $value) {
            if (!array_key_exists($key, $current)) {
                continue;
            }

            // Loose, on purpose: '2' from a JSON file and 2 from the form are
            // the same setting, and reporting that as a change would fill the
            // list with entries that do nothing.
            if ($current[$key] == $value) {
                continue;
            }

            $changes[] = [
                'key' => $key,
                'from' => self::describe($current[$key]),
                'to' => self::describe($value),
            ];
        }

        return $changes;
    }

    /**
     * A value, in a few words.
     *
     * Lists are counted rather than printed: the icon overrides can hold fifty
     * rows, and a diff nobody can read is a diff nobody reads.
     */
    private static function describe(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'on' : 'off';
        }

        if ($value === null || $value === '') {
            return '—';
        }

        if (is_array($value)) {
            $count = count($value);

            return $count === 1 ? '1 entry' : $count . ' entries';
        }

        $value = (string) $value;

        return mb_strlen($value) > 40 ? mb_substr($value, 0, 40) . '…' : $value;
    }
}
