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

        return (string) file_get_contents($path);
    }
}
