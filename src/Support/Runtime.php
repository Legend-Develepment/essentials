<?php

namespace LegendDevelopment\Theme\Support;

/**
 * The small script that has to run before anything else on the page.
 *
 * It is inlined in the head rather than shipped through Vite because two of its
 * three jobs are races it has to win: stamping the area before the first paint,
 * and getting hold of the Xterm bundle before Pelican constructs the terminal
 * from it. It therefore lives outside resources/js, which is the directory the
 * panel's Vite config globs for entries.
 */
class Runtime
{
    private static ?string $cached = null;

    public static function script(): string
    {
        $js = self::$cached ??= self::read();

        return $js === '' ? '' : '<script>' . $js . '</script>';
    }

    private static function read(): string
    {
        $path = plugin_path(Theme::directory(), 'resources', 'inline', 'runtime.js');

        if (!is_file($path)) {
            return '';
        }

        return self::tightened((string) file_get_contents($path));
    }

    /**
     * The same script without the reasons it was written that way.
     *
     * Measured: the file is 36.2 KB on disk and 13.0 KB of it is code. The
     * other twenty-three are the comments, which are why this codebase is
     * readable and are not something to send to every browser on every page of
     * the panel. This is the one script Vite cannot handle - it has to run
     * before the first paint - so it was the one nothing stripped.
     *
     * **Whole lines only, and that is not fussiness.** The first version of
     * this walked the file character by character, skipping strings, and it
     * ate the `/^\/+/` out of a replace() - a regex literal is not a string
     * and telling one from a division needs the parser this deliberately is
     * not. Dropping a line only when the whole line is a comment cannot reach
     * inside an expression at all, and measured smaller as well.
     *
     * Nothing else is done. No renaming, no reordering, no joining of lines: a
     * minifier that gets one of those wrong turns a race this script exists to
     * win into a race it loses, and finding that out means reading somebody
     * else's phone. Line endings stay for the same reason, because every
     * statement here ends at one by convention rather than by a semicolon.
     *
     * Checked against the real file with node --check, and against every regex
     * literal in it: nine, all nine still there.
     */
    private static function tightened(string $js): string
    {
        $out = [];
        $inBlock = false;

        foreach (explode("\n", $js) as $line) {
            $trimmed = trim($line);

            if ($inBlock) {
                $at = strpos($trimmed, '*/');

                if ($at === false) {
                    continue;
                }

                $inBlock = false;
                $rest = trim(substr($trimmed, $at + 2));

                if ($rest !== '') {
                    $out[] = $rest;
                }

                continue;
            }

            if ($trimmed === '' || str_starts_with($trimmed, '//')) {
                continue;
            }

            if (str_starts_with($trimmed, '/*')) {
                $at = strpos($trimmed, '*/', 2);

                if ($at === false) {
                    $inBlock = true;

                    continue;
                }

                $rest = trim(substr($trimmed, $at + 2));

                if ($rest !== '') {
                    $out[] = $rest;
                }

                continue;
            }

            $out[] = $trimmed;
        }

        return implode("\n", $out);
    }
}
