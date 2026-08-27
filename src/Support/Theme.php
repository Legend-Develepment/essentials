<?php

namespace LegendDevelopment\Theme\Support;

/**
 * The plugin's own identity, derived from where it is installed.
 *
 * Pelican ties three things to the plugin id: the folder under plugins/, the
 * config namespace, and the translation namespace. Reading the id off the
 * install path instead of hard coding it means renaming the folder (and the
 * matching id in plugin.json plus the config filename) cannot leave a stale
 * literal behind somewhere in the code.
 */
class Theme
{
    /**
     * Permission names are stored in the database against roles, so unlike the
     * id they are a fixed literal: renaming the plugin folder must not silently
     * revoke what an administrator already granted.
     */
    public const PERMISSION_MODEL = 'legendTheme';

    public const PERMISSION_VIEW = 'view ' . self::PERMISSION_MODEL;

    public const PERMISSION_UPDATE = 'update ' . self::PERMISSION_MODEL;

    /**
     * Rearranging pages is its own permission: it changes what everyone sees,
     * without giving away the theme's colours and settings.
     */
    public const PERMISSION_ARRANGE = 'arrange ' . self::PERMISSION_MODEL;

    /**
     * Whether the page arranger is available at all, regardless of who is asking.
     */
    public static function arrangerEnabled(): bool
    {
        return (bool) self::config('arranger', true);
    }

    public static function canArrange(): bool
    {
        return self::arrangerEnabled() && (user()?->can(self::PERMISSION_ARRANGE) ?? false);
    }

    /**
     * Both are worked out from where this file sits, which cannot change while
     * the process runs - and config(), trans() and every settings read go
     * through them, so it is worth not walking the path a few hundred times a
     * request.
     */
    private static ?string $directory = null;

    private static ?string $id = null;

    /**
     * The id as Pelican registers it - lowercased, matching config() and trans().
     */
    public static function id(): string
    {
        return self::$id ??= strtolower(self::directory());
    }

    /**
     * The folder name as it is on disk, which is what Vite resolves against.
     */
    public static function directory(): string
    {
        return self::$directory ??= basename(dirname(__DIR__, 2));
    }

    public static function config(string $key, mixed $default = null): mixed
    {
        return config(self::id() . '.' . $key, $default);
    }

    /**
     * @param  array<string, mixed>  $replace
     */
    public static function trans(string $key, array $replace = []): string
    {
        return trans(self::id() . '::' . $key, $replace);
    }
}
