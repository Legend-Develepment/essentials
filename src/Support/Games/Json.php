<?php

namespace LegendDevelopment\Theme\Support\Games;

/**
 * A JSON settings file, read and written back without reformatting it.
 *
 * **The obvious version of this is wrong, and it is wrong quietly.** Decode the
 * file, change a value, encode it again: the result is valid JSON that says the
 * same thing and is not the same file. Key order is gone, indentation is
 * whatever the encoder felt like, a number written `1.000000` comes back `1`,
 * and anything the game wrote that this plugin does not understand has been
 * rewritten in a shape the game may or may not read. That is the same mistake
 * `Support\Games\Ini` was written to avoid for ARK, arriving in a format where
 * it is easier to make.
 *
 * So this never encodes the document. It scans the text, remembers where each
 * value begins and ends, and splices the new ones in at those exact places. The
 * bytes on either side are untouched by construction rather than by care.
 *
 * **It answers scalars only**, by a dotted path: `Difficulty`,
 * `GameSettings.DayTimeSpeedRate`, `AdminList.0`. An object or an array is a
 * place rather than a setting, and a form has nothing to put in it.
 *
 * **A value keeps the shape it had.** A number stays a number, a string stays a
 * string, a boolean stays a boolean. Where the new value cannot be written in
 * that shape - letters typed into a number - the original is left exactly where
 * it was rather than written as something else. A game reading `"maxPlayers":
 * "twenty"` is a game that will not start, and a settings page has no business
 * being the cause of that.
 *
 * Seven games in roadmap/games.md share this format, which is why it is worth a
 * class of its own rather than a special case in one of them.
 */
class Json
{
    /**
     * Every scalar in the file, by its path.
     *
     * Nothing at all from a document that is not JSON, which is the important
     * half. The scanner is a scanner: handed something that is nearly JSON it
     * keeps going and reports whatever it recognises, and what it recognised in
     * a file carrying a `// how many` comment was three settings named 0, 1 and
     * 2 holding `//`, `how` and `many`. That is worse than reading nothing,
     * because those three are offered as fields somebody can edit, and editing
     * one splices text into the middle of a comment.
     *
     * It came up while surveying games this plugin does not have. Starbound
     * writes a documented JSON superset with comments in it; the games that are
     * built here do not, but a person adding a note to their own config file
     * does, and nothing stopped that.
     *
     * @return array<string, string> Path to the value as a person would type it.
     */
    public static function parse(string $text): array
    {
        if (!self::sound($text)) {
            return [];
        }

        $out = [];

        foreach (self::scan($text) as $path => $at) {
            $out[$path] = $at['said'];
        }

        return $out;
    }

    /**
     * Whether this is JSON at all.
     *
     * PHP's own decoder rather than a second opinion from the scanner, because
     * the two failing differently is the whole point: the scanner is lenient by
     * construction and this is not. Nothing of what it decodes is kept - the
     * splicing still works off the scan - so key order, spacing and number
     * formatting are as untouched as they were.
     *
     * An empty file is not JSON and is not a fault either. It is a server that
     * has not written its configuration yet, which the page already says.
     */
    private static function sound(string $text): bool
    {
        if (trim($text) === '') {
            return false;
        }

        json_decode($text, true, 512, JSON_INVALID_UTF8_SUBSTITUTE);

        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * The file back, with those paths changed and nothing else.
     *
     * @param  array<string, mixed>  $changes  Paths as parse() gives them.
     */
    public static function apply(string $text, array $changes): string
    {
        /*
         * The same refusal as parse(), and for a stronger reason.
         *
         * Reading a file this cannot account for shows nonsense; writing one
         * splices into it. A document that is not JSON goes back exactly as it
         * arrived.
         */
        if (!self::sound($text)) {
            return $text;
        }

        $found = self::scan($text);
        $edits = [];

        foreach ($changes as $path => $value) {
            if (!isset($found[$path])) {
                continue;
            }

            $written = self::written($found[$path]['kind'], $value);

            if ($written === null) {
                // Cannot be said in the shape this value had. Left alone.
                continue;
            }

            $edits[] = [$found[$path]['from'], $found[$path]['to'], $written];
        }

        /*
         * Back to front, so an earlier edit cannot move a later one.
         *
         * Every offset was measured against the text as it came in, and
         * replacing a value changes the length of everything after it. Working
         * from the end means each offset is still correct when it is used.
         */
        usort($edits, static fn (array $a, array $b): int => $b[0] <=> $a[0]);

        foreach ($edits as [$from, $to, $written]) {
            $text = substr($text, 0, $from) . $written . substr($text, $to);
        }

        return $text;
    }

    /**
     * The new value in the old one's shape, or null if it will not go.
     *
     * @param  mixed  $value
     */
    private static function written(string $kind, mixed $value): ?string
    {
        $said = is_bool($value) ? ($value ? 'true' : 'false') : trim((string) $value);

        if ($kind === 'bool') {
            return match (mb_strtolower($said)) {
                'true', '1', 'yes', 'on' => 'true',
                'false', '0', 'no', 'off' => 'false',
                default => null,
            };
        }

        if ($kind === 'number') {
            /*
             * Written as it was typed rather than through a cast.
             *
             * These files are full of numbers like 1.000000, and a round trip
             * through (float) and back would write 1 - which is the same number
             * and a different file, and the whole of this class is about that
             * distinction.
             */
            return preg_match('/^-?(0|[1-9][0-9]*)(\.[0-9]+)?([eE][-+]?[0-9]+)?$/', $said) === 1
                ? $said
                : null;
        }

        if ($kind === 'null') {
            // Nothing was there. Anything typed becomes a string, which is the
            // only shape that cannot be wrong about what the game expects.
            return $said === '' ? 'null' : self::quoted($said);
        }

        return self::quoted($said);
    }

    /** A JSON string, escaped the way the format requires and no further. */
    private static function quoted(string $said): string
    {
        $out = json_encode($said, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return $out === false ? '""' : $out;
    }

    /**
     * Where every scalar lives, and what it is.
     *
     * A hand-written scan rather than a decode, because a decode throws the
     * positions away and the positions are the whole point. It is the smaller
     * half of a JSON parser: enough to know where one value ends and the next
     * begins, and deliberately not enough to have an opinion about whether the
     * document is valid. A file this cannot follow yields nothing, which leaves
     * the page saying there are no settings rather than writing a wrong one.
     *
     * @return array<string, array{from: int, to: int, said: string, kind: string}>
     */
    private static function scan(string $text): array
    {
        $out = [];
        $path = [];
        $at = 0;
        $length = strlen($text);

        // What the container at each depth is, and how far an array has counted.
        $stack = [];
        $key = null;

        while ($at < $length) {
            $char = $text[$at];

            if ($char === ' ' || $char === "\t" || $char === "\n" || $char === "\r" || $char === ',' || $char === ':') {
                $at++;

                continue;
            }

            if ($char === '{' || $char === '[') {
                /*
                 * Measured before the step down, not after it.
                 *
                 * This is where a container remembers how long the path was
                 * when it opened, so that closing it can put the path back. The
                 * first version counted after pushing its own name, so a
                 * container never let go of itself: everything after an object
                 * was still reported as being inside it, and a change aimed at
                 * a top-level setting silently found nothing.
                 */
                $depth = count($path);

                if ($key !== null) {
                    $path[] = $key;
                    $key = null;
                } elseif ($stack !== [] && end($stack)['list']) {
                    $path[] = (string) $stack[count($stack) - 1]['next']++;
                }

                $stack[] = ['list' => $char === '[', 'next' => 0, 'depth' => $depth];
                $at++;

                continue;
            }

            if ($char === '}' || $char === ']') {
                $held = array_pop($stack);

                if ($held !== null) {
                    $path = array_slice($path, 0, $held['depth']);
                }

                $at++;

                continue;
            }

            if ($char === '"') {
                $end = self::endOfString($text, $at);

                if ($end === null) {
                    return $out;
                }

                $raw = substr($text, $at, $end - $at);
                $inside = end($stack);

                // A string before a colon is a key, and only inside an object.
                if ($inside !== false && !$inside['list'] && $key === null && self::next($text, $end) === ':') {
                    $key = (string) json_decode($raw, true);
                    $at = $end;

                    continue;
                }

                $out[self::where($path, $key, $stack)] = [
                    'from' => $at,
                    'to' => $end,
                    'said' => (string) json_decode($raw, true),
                    'kind' => 'text',
                ];

                $key = null;
                $at = $end;

                continue;
            }

            // A bare value: a number, true, false or null.
            $end = $at;

            while ($end < $length && strpos(" \t\n\r,}]", $text[$end]) === false) {
                $end++;
            }

            $raw = substr($text, $at, $end - $at);

            if ($raw !== '') {
                $out[self::where($path, $key, $stack)] = [
                    'from' => $at,
                    'to' => $end,
                    'said' => $raw,
                    'kind' => match ($raw) {
                        'true', 'false' => 'bool',
                        'null' => 'null',
                        default => 'number',
                    },
                ];

                $key = null;
            }

            $at = max($end, $at + 1);
        }

        return $out;
    }

    /**
     * The dotted path of the value about to be recorded.
     *
     * @param  array<int, string>  $path
     * @param  array<int, array{list: bool, next: int, depth: int}>  $stack
     */
    private static function where(array $path, ?string $key, array &$stack): string
    {
        $last = $key;

        if ($last === null && $stack !== []) {
            $last = (string) $stack[count($stack) - 1]['next']++;
        }

        $parts = $path;

        if ($last !== null) {
            $parts[] = $last;
        }

        return implode('.', $parts);
    }

    /** One past the closing quote of the string starting at $at, or null. */
    private static function endOfString(string $text, int $at): ?int
    {
        $length = strlen($text);
        $index = $at + 1;

        while ($index < $length) {
            if ($text[$index] === '\\') {
                $index += 2;

                continue;
            }

            if ($text[$index] === '"') {
                return $index + 1;
            }

            $index++;
        }

        return null;
    }

    /** The next character that is not a space, or an empty string. */
    private static function next(string $text, int $at): string
    {
        $length = strlen($text);

        while ($at < $length && ($text[$at] === ' ' || $text[$at] === "\t" || $text[$at] === "\n" || $text[$at] === "\r")) {
            $at++;
        }

        return $at < $length ? $text[$at] : '';
    }
}
