<?php

namespace LegendDevelopment\Theme\Support\Games;

/**
 * An INI file with sections, read and written back without losing anything.
 *
 * ARK keeps `GameUserSettings.ini`, and it is `server.properties` with one thing
 * added: a key belongs to the `[Section]` above it, and the same key appears in
 * more than one section with different meanings. So this is
 * `Support\Minecraft\Properties` with a section on the front of every key, and
 * it keeps the same promise for the same reason.
 *
 * **The file is kept as its lines.** The obvious version reads an INI into an
 * array, writes the array back, and silently drops every comment, every blank
 * line, the order somebody put things in, and every key this plugin has never
 * heard of. An ARK server's GameUserSettings.ini is mostly keys this plugin has
 * never heard of - mods add their own, and a wiped one is not a working one.
 *
 * So saving replaces the value on the lines it recognises and leaves everything
 * else exactly where it was. A key that is genuinely new is appended to its
 * section rather than to the end of the file, because a setting under the wrong
 * heading is a setting ARK will not read.
 *
 * No escaping, and that is not an oversight. Unreal's INI reader treats a value
 * as the rest of the line, quotes and semicolons and all, so escaping would
 * change files this plugin was only asked to edit one line of. What is refused
 * instead is a value containing a line ending, which is the only thing that
 * could turn one setting into two.
 */
class Ini
{
    /**
     * Every value in the file, keyed `Section.key`.
     *
     * A flat map rather than nested, because that is what a form binds to and
     * because the section is part of what identifies a setting here - two of
     * them genuinely differ only by which heading they sit under.
     *
     * @return array<string, string>
     */
    public static function parse(string $contents): array
    {
        $values = [];
        $section = '';

        foreach (self::lines($contents) as $line) {
            $heading = self::sectionOf($line);

            if ($heading !== null) {
                $section = $heading;

                continue;
            }

            $key = self::keyOf($line);

            if ($key === null) {
                continue;
            }

            // A key before any heading belongs to no section, which is legal
            // and is how a few games write their first few settings.
            $values[($section === '' ? '' : $section . '.') . $key]
                = trim(substr($line, strpos($line, '=') + 1));
        }

        return $values;
    }

    /**
     * The file with some values changed, and nothing else touched.
     *
     * @param  array<string, mixed>  $changes
     */
    public static function apply(string $contents, array $changes): string
    {
        $lines = self::lines($contents);
        $section = '';
        $written = [];

        // Where each section ends, so a new key can be put inside it rather
        // than after the file's last line - which would land it under whatever
        // heading happens to be last.
        $endOf = [];

        foreach ($lines as $index => $line) {
            $heading = self::sectionOf($line);

            if ($heading !== null) {
                $section = $heading;
                $endOf[$section] = $index;

                continue;
            }

            $key = self::keyOf($line);

            if ($key === null) {
                // A blank line at the end of a section still belongs to it, so
                // the insertion point moves past it either way.
                $endOf[$section] = $index;

                continue;
            }

            $endOf[$section] = $index;
            $full = ($section === '' ? '' : $section . '.') . $key;

            if (!array_key_exists($full, $changes)) {
                continue;
            }

            $lines[$index] = $key . '=' . self::text($changes[$full]);
            $written[$full] = true;
        }

        /*
         * Anything the file did not already have.
         *
         * Inserted at the end of its own section, working from the bottom up so
         * that inserting into one section does not move the recorded position
         * of the ones below it.
         */
        $adding = [];

        foreach ($changes as $full => $value) {
            if (array_key_exists($full, $written)) {
                continue;
            }

            [$section, $key] = self::split((string) $full);

            if (!self::validKey($key)) {
                continue;
            }

            $adding[$section][] = $key . '=' . self::text($value);
        }

        foreach (self::sorted($adding, $endOf) as $section => $rows) {
            if (array_key_exists($section, $endOf)) {
                array_splice($lines, $endOf[$section] + 1, 0, $rows);

                continue;
            }

            // A section the file does not have yet. Its heading goes with it.
            $lines[] = '';
            $lines[] = '[' . $section . ']';

            foreach ($rows as $row) {
                $lines[] = $row;
            }
        }

        return implode("\n", $lines);
    }

    /**
     * Sections in the order they must be spliced: furthest down the file first.
     *
     * Inserting into an earlier section shifts every line after it, so doing
     * them top-down would put the second insertion in the wrong place. Sections
     * the file does not have go last, where they are appended rather than
     * spliced.
     *
     * @param  array<string, array<int, string>>  $adding
     * @param  array<string, int>  $endOf
     * @return array<string, array<int, string>>
     */
    private static function sorted(array $adding, array $endOf): array
    {
        uksort($adding, static fn (string $a, string $b): int
            => ($endOf[$b] ?? -1) <=> ($endOf[$a] ?? -1));

        return $adding;
    }

    /**
     * @return array{0: string, 1: string}
     */
    private static function split(string $full): array
    {
        $at = strrpos($full, '.');

        return $at === false ? ['', $full] : [substr($full, 0, $at), substr($full, $at + 1)];
    }

    /**
     * @return array<int, string>
     */
    private static function lines(string $contents): array
    {
        // Written by a Windows program more often than not, so all three line
        // endings turn up. Normalised on the way in and written back with \n,
        // which Unreal's reader accepts.
        return explode("\n", str_replace(["\r\n", "\r"], "\n", $contents));
    }

    /** The section this line opens, or null. */
    private static function sectionOf(string $line): ?string
    {
        $line = trim($line);

        if (strlen($line) < 3 || $line[0] !== '[' || !str_ends_with($line, ']')) {
            return null;
        }

        $name = trim(substr($line, 1, -1));

        return preg_match('/^[A-Za-z0-9_.\/-]{1,80}$/D', $name) === 1 ? $name : null;
    }

    /**
     * The key on this line, or null if it is a comment, a blank, or not a
     * setting.
     *
     * Both comment markers, because INI files in the wild use `;` and files
     * written by people who learned on other formats use `#`.
     */
    private static function keyOf(string $line): ?string
    {
        $trimmed = trim($line);

        if ($trimmed === '' || $trimmed[0] === ';' || $trimmed[0] === '#') {
            return null;
        }

        $at = strpos($trimmed, '=');

        if ($at === false || $at === 0) {
            return null;
        }

        $key = rtrim(substr($trimmed, 0, $at));

        return self::validKey($key) ? $key : null;
    }

    private static function validKey(string $key): bool
    {
        return preg_match('/^[A-Za-z0-9_.\[\]-]{1,80}$/D', $key) === 1;
    }

    /**
     * A value, as one line.
     *
     * Booleans are written the way Unreal reads them, which is `True` and
     * `False` capitalised - lowercase works in most places and not in all, and
     * a settings page should not be the thing that finds out which.
     *
     * A line ending in a value would turn one setting into two, so it becomes a
     * space. Nothing else is touched: Unreal takes the rest of the line as the
     * value, quotes and semicolons included.
     */
    private static function text(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'True' : 'False';
        }

        $text = is_scalar($value) ? (string) $value : '';

        return trim(str_replace(["\r\n", "\r", "\n"], ' ', $text));
    }
}
