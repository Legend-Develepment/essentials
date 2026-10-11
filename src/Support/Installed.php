<?php

namespace LegendDevelopment\Theme\Support;

use App\Models\Plugin;
use Throwable;

/**
 * Which version of this plugin Pelican has installed.
 *
 * Read from Pelican's own row for it rather than from plugin.json, because
 * the row is what the panel itself goes by. Nothing here checks for updates:
 * this plugin neither looks for nor installs any. See Support\AutoUpdater for
 * what is shown about updates, and when.
 */
class Installed
{
    /** @var array<string, mixed> */
    private static array $memo = [];

    /** The version of this plugin Pelican has installed. */
    public static function version(): string
    {
        return (string) (self::plugin()?->version ?? '0.0.0');
    }

    /**
     * The plugin's own row, read once. Sushi builds its table from the
     * plugin.json of every installed plugin, so this is not a lookup to make
     * several times for one page.
     */
    private static function plugin(): ?Plugin
    {
        if (!array_key_exists('plugin', self::$memo)) {
            try {
                self::$memo['plugin'] = Plugin::find(Theme::id());
            } catch (Throwable) {
                self::$memo['plugin'] = null;
            }
        }

        return self::$memo['plugin'];
    }

    /** Forget the row, for a process that outlives an install. */
    public static function forget(): void
    {
        self::$memo = [];
    }
}
