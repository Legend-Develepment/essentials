<?php

namespace LegendDevelopment\Theme\Support\Games;

/**
 * A file that is a list of players, one per line.
 *
 * Valheim keeps three of them - `adminlist.txt`, `banlist.txt` and
 * `permittedlist.txt` - and they are the same file three times: a header of
 * `//` comment lines the game itself writes, then one identifier per line.
 *
 * The same promise `Support\Games\Ini` makes, for the same reason. The game
 * writes that header, and a page that saved the list back without it would
 * quietly delete the instructions the next person to open the file in a text
 * editor was going to read. So the header comes back, and so does anything else
 * somebody put in there as a comment.
 *
 * What is not kept is the order of the identifiers themselves, because the page
 * hands them back as a set rather than as lines - that is what a list of players
 * is, and two of the same one is a mistake rather than a preference.
 */
class Names
{
    /**
     * What counts as an identifier.
     *
     * Valheim's own lists hold SteamID64s, which are seventeen digits, but a
     * crossplay server writes PlayFab ids and a modded one writes whatever its
     * mod uses. So the rule is what could not possibly be one rather than what
     * one looks like: no spaces, nothing that would end the line, and a length
     * a real identifier stays under.
     */
    private const VALID = '/^[A-Za-z0-9_.:@-]{1,64}$/D';

    /**
     * The identifiers in a list file.
     *
     * @return array<int, string>
     */
    public static function parse(string $contents): array
    {
        $names = [];

        foreach (self::lines($contents) as $line) {
            $line = trim($line);

            if ($line === '' || self::isComment($line)) {
                continue;
            }

            /*
             * The game writes an id alone on its line, but people annotate:
             * "76561198... // Bryan" is common enough in these files to be
             * worth reading rather than refusing. The note is not kept - it
             * belongs to a line this page is about to rewrite.
             */
            $at = strpos($line, '//');

            if ($at !== false) {
                $line = rtrim(substr($line, 0, $at));
            }

            if ($line === '' || !self::valid($line)) {
                continue;
            }

            $names[$line] = true;
        }

        return array_keys($names);
    }

    /**
     * The comment lines at the top of the file, exactly as they were.
     *
     * Only the ones above the first identifier. A comment further down was
     * written next to a line that is about to be rewritten, and moving it to
     * the top would attach it to the wrong thing.
     *
     * @return array<int, string>
     */
    public static function header(string $contents): array
    {
        $header = [];

        foreach (self::lines($contents) as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                $header[] = '';

                continue;
            }

            if (!self::isComment($trimmed)) {
                break;
            }

            $header[] = rtrim($line, "\r\n");
        }

        // A file that is nothing but comments has no list under it, so the
        // trailing blanks would pile up one per save.
        while ($header !== [] && trim((string) end($header)) === '') {
            array_pop($header);
        }

        return $header;
    }

    /**
     * The file to write: the header it had, then the names given.
     *
     * @param  array<int, mixed>  $names
     */
    public static function render(string $contents, array $names): string
    {
        $lines = self::header($contents);
        $seen = [];

        foreach ($names as $name) {
            $name = is_scalar($name) ? trim((string) $name) : '';

            if ($name === '' || !self::valid($name) || array_key_exists($name, $seen)) {
                continue;
            }

            $seen[$name] = true;
            $lines[] = $name;
        }

        // A trailing newline, because a file that ends mid-line is a file some
        // readers drop the last line of - and the game writes one.
        return implode("\n", $lines) . "\n";
    }

    /**
     * Whether a form's list differs from the file's, as a set.
     *
     * Saving a file that has not changed still restarts nothing and breaks
     * nothing, but it does rewrite somebody's file for no reason, and this is
     * cheaper than finding out afterwards.
     *
     * @param  array<int, mixed>  $names
     */
    public static function same(string $contents, array $names): bool
    {
        $before = self::parse($contents);
        $after = self::parse(implode("\n", array_map(
            static fn (mixed $name): string => is_scalar($name) ? (string) $name : '',
            $names,
        )));

        // SORT_STRING rather than the default, which compares two numeric
        // strings as numbers - so '01' and '1' would sort as equal and land in
        // whichever order they arrived in, and two lists holding the same set
        // would compare as different.
        sort($before, SORT_STRING);
        sort($after, SORT_STRING);

        return $before === $after;
    }

    public static function valid(string $name): bool
    {
        return preg_match(self::VALID, $name) === 1;
    }

    private static function isComment(string $line): bool
    {
        // Two slashes is what the game writes; the other two turn up because
        // people who have edited a configuration file before reach for them.
        return str_starts_with($line, '//')
            || str_starts_with($line, '#')
            || str_starts_with($line, ';');
    }

    /**
     * @return array<int, string>
     */
    private static function lines(string $contents): array
    {
        return explode("\n", str_replace(["\r\n", "\r"], "\n", $contents));
    }
}
