<?php

namespace LegendDevelopment\Theme\Support\Palworld;

/**
 * The one line in PalWorldSettings.ini that holds every world setting.
 *
 * The file looks like this, and the second line is a single line however many
 * settings are in it:
 *
 *   [/Script/Pal.PalGameWorldSettings]
 *   OptionSettings=(Difficulty=None,ExpRate=1.000000,ServerName="My Server",bIsPvP=False)
 *
 * Nothing here carries a list of what those settings are, and that is the
 * design rather than a shortcut. Palworld adds settings with its updates; an
 * editor built around a fixed list shows a server's file through the list it was
 * written with, which means a setting added by the game last month is invisible
 * and a setting removed is offered for a file that has no place to put it. This
 * reads whatever the file holds, works out each value's type from the value
 * itself, and writes back everything it read - including the keys it made no
 * sense of, untouched and in the order they arrived.
 *
 * The format is Unreal's, and the rules are few: values are separated by commas,
 * a string is in double quotes and may contain a comma, True and False are
 * booleans, and anything else is a number or a bare word.
 */
class OptionSettings
{
    /** The line the settings live on. */
    private const PREFIX = 'OptionSettings=';

    public const BOOL = 'bool';

    public const NUMBER = 'number';

    public const TEXT = 'text';

    public const WORD = 'word';

    /**
     * The settings from a file, in the order the file has them.
     *
     * @return array<string, array{value: mixed, type: string, raw: string}>
     */
    public static function parse(string $file): array
    {
        $payload = self::payload($file);

        if ($payload === null) {
            return [];
        }

        $settings = [];

        foreach (self::split($payload) as $pair) {
            $at = strpos($pair, '=');

            if ($at === false) {
                continue;
            }

            $key = trim(substr($pair, 0, $at));
            $raw = trim(substr($pair, $at + 1));

            // A key has to look like one. Anything else is a line this does not
            // understand, and guessing at it is how a config file gets corrupted.
            if ($key === '' || preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $key) !== 1) {
                continue;
            }

            $settings[$key] = self::typed($raw);
        }

        return $settings;
    }

    /**
     * The file with new values in it, and everything else exactly as it was.
     *
     * Only the OptionSettings line is rewritten. The section headers, the
     * comments, any other line somebody put there and the file's own line
     * endings all survive, because this is somebody's server config and the
     * editor was asked to change four settings in it, not to reformat it.
     *
     * @param  array<string, mixed>  $changes  Key to new value, for known keys only.
     */
    public static function apply(string $file, array $changes): string
    {
        $current = self::parse($file);

        if ($current === []) {
            return $file;
        }

        $pairs = [];

        foreach ($current as $key => $setting) {
            $raw = array_key_exists($key, $changes)
                ? self::encode($changes[$key], $setting['type'], $setting['raw'])
                // Untouched keys are written back exactly as they were read,
                // not re-encoded: a number the file wrote as 1.000000 stays
                // 1.000000 rather than becoming 1.
                : $setting['raw'];

            $pairs[] = $key . '=' . $raw;
        }

        $line = self::PREFIX . '(' . implode(',', $pairs) . ')';

        $lines = preg_split('/(\r\n|\r|\n)/', $file, -1, PREG_SPLIT_DELIM_CAPTURE);

        if (!is_array($lines)) {
            return $file;
        }

        foreach ($lines as $index => $text) {
            if (str_starts_with(ltrim($text), self::PREFIX)) {
                $lines[$index] = $line;

                break;
            }
        }

        return implode('', $lines);
    }

    /**
     * A value and what kind of thing it is, from the value alone.
     *
     * @return array{value: mixed, type: string, raw: string}
     */
    private static function typed(string $raw): array
    {
        if (strlen($raw) >= 2 && str_starts_with($raw, '"') && str_ends_with($raw, '"')) {
            return [
                'value' => substr($raw, 1, -1),
                'type' => self::TEXT,
                'raw' => $raw,
            ];
        }

        $lower = strtolower($raw);

        if ($lower === 'true' || $lower === 'false') {
            return ['value' => $lower === 'true', 'type' => self::BOOL, 'raw' => $raw];
        }

        if (is_numeric($raw)) {
            return [
                'value' => str_contains($raw, '.') ? (float) $raw : (int) $raw,
                'type' => self::NUMBER,
                'raw' => $raw,
            ];
        }

        // A bare word: Difficulty=None, DeathPenalty=All. Offered as text with
        // whatever the file says already in it, because the set of words the
        // game accepts is the game's to change and inventing a shorter one here
        // would be an editor that refuses a value the server would have taken.
        return ['value' => $raw, 'type' => self::WORD, 'raw' => $raw];
    }

    /**
     * Back to the form the file wants, in the shape the value arrived in.
     */
    private static function encode(mixed $value, string $type, string $was): string
    {
        return match ($type) {
            self::BOOL => $value ? 'True' : 'False',
            self::NUMBER => self::number($value, $was),
            // Quotes stripped rather than escaped: Unreal has no escape for one
            // inside a quoted value, so a quote typed into a server name would
            // end the string early and shift every setting after it.
            self::TEXT => '"' . str_replace(['"', "\r", "\n", ','], ['', '', '', ' '], (string) $value) . '"',
            default => preg_replace('/[^A-Za-z0-9_.\-]/', '', (string) $value) ?? '',
        };
    }

    /**
     * A number in the shape this key already had.
     *
     * The file writes rates as 1.000000 and counts as 32, and a key keeps its
     * own convention: a rate changed to 3 is written 3.000000, while a port
     * changed to 8080 is written 8080 rather than 8080.000000. Working it out
     * from the value alone gets the port right and the rate wrong; working it
     * out from what was there gets both, and leaves a diff of the file showing
     * only what was actually changed.
     */
    private static function number(mixed $value, string $was): string
    {
        if (!is_numeric($value)) {
            return '0';
        }

        return str_contains($was, '.')
            ? number_format((float) $value, 6, '.', '')
            : (string) (int) round((float) $value);
    }

    /**
     * The bit between the outer brackets, or null when the line is not there.
     */
    private static function payload(string $file): ?string
    {
        foreach (preg_split('/\r\n|\r|\n/', $file) ?: [] as $line) {
            $line = trim($line);

            if (!str_starts_with($line, self::PREFIX)) {
                continue;
            }

            $value = trim(substr($line, strlen(self::PREFIX)));

            if (str_starts_with($value, '(') && str_ends_with($value, ')')) {
                return substr($value, 1, -1);
            }

            return null;
        }

        return null;
    }

    /**
     * Split on commas that are not inside a quoted value.
     *
     * A server name with a comma in it is the whole reason this is not
     * explode(','), and it is the kind of thing somebody types once and then
     * cannot work out why their world settings stopped applying.
     *
     * @return array<int, string>
     */
    private static function split(string $payload): array
    {
        $parts = [];
        $current = '';
        $inQuotes = false;

        foreach (str_split($payload) as $character) {
            if ($character === '"') {
                $inQuotes = !$inQuotes;
                $current .= $character;

                continue;
            }

            if ($character === ',' && !$inQuotes) {
                $parts[] = $current;
                $current = '';

                continue;
            }

            $current .= $character;
        }

        if (trim($current) !== '') {
            $parts[] = $current;
        }

        return $parts;
    }
}
