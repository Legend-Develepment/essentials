<?php

namespace LegendDevelopment\Theme\Support\Minecraft;

/**
 * server.properties, read and written back without losing anything.
 *
 * The format is a line each of `key=value`, `#` for a comment, and blanks. That
 * is simple enough to parse in twenty lines and simple enough to get wrong in
 * one: the obvious version reads it into an array, writes the array back out,
 * and silently drops every comment, every blank line, the order somebody put
 * things in, and every key this plugin has never heard of.
 *
 * A modpack's server.properties is full of keys this plugin has never heard of.
 * So the file is kept as its lines, and saving replaces the value on the lines
 * it recognises and leaves everything else exactly where it was. A key that is
 * genuinely new is appended at the end rather than inserted somewhere it might
 * look deliberate.
 *
 * Java writes this file with escapes - \n, \t, \: and \= among them - and
 * Minecraft's own writer escapes very little in practice. Values are unescaped
 * on the way in and escaped on the way out for the four characters that would
 * otherwise change what the line means, and left alone otherwise. Doing more
 * would rewrite files this plugin was only asked to edit one line of.
 */
class Properties
{
    /**
     * Every key and value in the file.
     *
     * @return array<string, string>
     */
    public static function parse(string $contents): array
    {
        $values = [];

        foreach (self::lines($contents) as $line) {
            $key = self::keyOf($line);

            if ($key === null) {
                continue;
            }

            $values[$key] = self::unescape(substr($line, strpos($line, '=') + 1));
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
        $written = [];

        foreach ($lines as $index => $line) {
            $key = self::keyOf($line);

            if ($key === null || !array_key_exists($key, $changes)) {
                continue;
            }

            $lines[$index] = $key . '=' . self::escape(self::text($changes[$key]));
            $written[$key] = true;
        }

        // Anything the file did not already have goes at the end. Guessing a
        // place for it in the middle would make an addition look like it had
        // always been there.
        foreach ($changes as $key => $value) {
            if (!array_key_exists($key, $written) && self::validKey((string) $key)) {
                $lines[] = $key . '=' . self::escape(self::text($value));
            }
        }

        return implode("\n", $lines);
    }

    /**
     * @return array<int, string>
     */
    private static function lines(string $contents): array
    {
        // Written by a Java program on whatever platform the server runs on, so
        // all three line endings turn up. They are normalised on the way in and
        // the file is written back with \n, which every reader of this format
        // accepts.
        return explode("\n", str_replace(["\r\n", "\r"], "\n", $contents));
    }

    /**
     * The key on this line, or null if the line is a comment, blank, or not a
     * setting at all.
     */
    private static function keyOf(string $line): ?string
    {
        $trimmed = ltrim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#') || str_starts_with($trimmed, '!')) {
            return null;
        }

        $at = strpos($line, '=');

        if ($at === false || $at === 0) {
            return null;
        }

        $key = trim(substr($line, 0, $at));

        return self::validKey($key) ? $key : null;
    }

    /**
     * Minecraft's own keys are lowercase words joined by dashes or dots; a
     * modpack's are the same shape. Anything else is not a key this should be
     * writing, and refusing it is what keeps a form value from becoming a line
     * of its own choosing.
     */
    private static function validKey(string $key): bool
    {
        return $key !== '' && preg_match('/^[A-Za-z0-9][A-Za-z0-9._-]*$/', $key) === 1;
    }

    private static function text(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return is_scalar($value) ? (string) $value : '';
    }

    private static function unescape(string $value): string
    {
        return str_replace(
            ['\\n', '\\t', '\\:', '\\=', '\\\\'],
            ["\n", "\t", ':', '=', '\\'],
            trim($value),
        );
    }

    /**
     * Only what would otherwise change the meaning of the line. A newline would
     * end it early, and a backslash would eat the character after it.
     */
    private static function escape(string $value): string
    {
        return str_replace(
            ['\\', "\n", "\r", "\t"],
            ['\\\\', '\\n', '', '\\t'],
            $value,
        );
    }
}
