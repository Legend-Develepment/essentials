<?php

namespace LegendDevelopment\Theme\Support;

use Throwable;

/**
 * Which parts of the plugin are switched on, and who may see them.
 *
 * This covers what the plugin *adds* to the panel - the pages, the blocks, the
 * announcement bar - and not the styling. The styling has its own off switch
 * and has had one since the first release: Style -> None, which makes the panel
 * render completely untouched. Two switches for one thing is worse than one.
 *
 * What is stored is the list of features that are OFF, not the list that are on,
 * and that is the whole point of the design. A feature added in a later release
 * is absent from everybody's stored list, so it arrives switched on rather than
 * invisible to every panel that saved its settings before it existed. Storing
 * what is on has the opposite behaviour, and it is a quiet one: nothing appears,
 * nothing errors, and the setting that would explain it looks correct.
 */
class Features
{
    public const LOOK = 'look';

    public const PAGES = 'pages';

    public const ADVANCED = 'advanced';

    public const ANNOUNCEMENTS = 'announcements';

    public const NAV_LINKS = 'nav_links';

    public const LOGIN = 'login';

    public const BARS = 'bars';

    public const DASHBOARD_STATUS = 'dashboard_status';

    public const DASHBOARD_NODES = 'dashboard_nodes';

    public const SYSTEM_STATUS = 'system_status';

    public const SIDEBAR_FOOTER = 'sidebar_footer';

    public const PALWORLD = 'palworld';

    /** Every feature, in the order the settings page offers them. */
    public const ALL = [
        self::LOOK,
        self::PAGES,
        self::ADVANCED,
        self::ANNOUNCEMENTS,
        self::NAV_LINKS,
        self::LOGIN,
        self::BARS,
        self::DASHBOARD_STATUS,
        self::DASHBOARD_NODES,
        self::SYSTEM_STATUS,
        self::SIDEBAR_FOOTER,
        self::PALWORLD,
    ];

    public static function enabled(string $key): bool
    {
        return !in_array($key, self::disabled(), true);
    }

    /**
     * The action half of each feature's permission.
     *
     * One word each, and that is not tidiness. Pelican labels a permission with
     * Str::headline() of this action, and the role editor draws its sections
     * three across the page with the options two across inside that - about
     * sixty pixels per label. "Dashboard Status" in sixty pixels is broken up
     * one letter per line. "Version" fits.
     *
     * They are a map rather than the feature keys themselves because the keys
     * are also config values and translation keys, and those want to stay
     * explicit.
     */
    private const ACTIONS = [
        self::LOOK => 'look',
        self::PAGES => 'pages',
        self::ADVANCED => 'advanced',
        self::ANNOUNCEMENTS => 'notices',
        self::NAV_LINKS => 'links',
        self::LOGIN => 'login',
        self::BARS => 'meters',
        self::DASHBOARD_STATUS => 'version',
        self::DASHBOARD_NODES => 'machines',
        self::SYSTEM_STATUS => 'system',
        self::SIDEBAR_FOOTER => 'footer',
        self::PALWORLD => 'palworld',
    ];

    /**
     * The permission that governs one feature, as Pelican stores it.
     *
     * One per feature, so a role can be given the announcements without being
     * given the panel's colours, or the system status without being given
     * anything to change.
     */
    public static function permission(string $key): string
    {
        return (self::ACTIONS[$key] ?? $key) . ' ' . Theme::PERMISSION_MODEL;
    }

    /**
     * @return array<int, string>
     */
    public static function permissions(): array
    {
        return array_values(self::ACTIONS);
    }

    /**
     * May this person see the feature, and is it switched on at all.
     *
     * The broad "view" permission still opens everything, deliberately: adding
     * per-feature permissions must not quietly revoke what an administrator
     * already had. The feature permission is the narrow way in, for delegating
     * one thing without handing over the rest.
     */
    public static function maySee(string $key): bool
    {
        if (!self::enabled($key)) {
            return false;
        }

        try {
            $user = user();

            return $user !== null
                && ($user->can(Theme::PERMISSION_VIEW) || $user->can(self::permission($key)));
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The same, for changing it. Being granted a feature means being able to
     * manage it - there would be no point to a permission that let somebody
     * open the announcements page and not write one.
     */
    public static function mayManage(string $key): bool
    {
        if (!self::enabled($key)) {
            return false;
        }

        try {
            $user = user();

            return $user !== null
                && ($user->can(Theme::PERMISSION_UPDATE) || $user->can(self::permission($key)));
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The ones switched off, as stored.
     *
     * @return array<int, string>
     */
    public static function disabled(): array
    {
        $stored = Theme::config('features_off', '');
        $stored = is_string($stored) ? array_filter(array_map('trim', explode(',', $stored))) : [];

        return array_values(array_intersect(self::ALL, $stored));
    }

    /**
     * The ones switched on, which is what the form shows ticked.
     *
     * @return array<int, string>
     */
    public static function current(): array
    {
        return array_values(array_diff(self::ALL, self::disabled()));
    }

    /**
     * A form's ticked boxes, turned back into the stored "off" list.
     *
     * Anything unticked is off, including a key the form did not offer - which
     * is why the form has to offer all of them.
     */
    public static function sanitise(mixed $ticked): string
    {
        $ticked = is_array($ticked) ? $ticked : [];
        $on = array_values(array_intersect(self::ALL, $ticked));

        return implode(',', array_values(array_diff(self::ALL, $on)));
    }

    /**
     * The stored list with one feature changed and the rest left alone.
     *
     * For the switches that live next to the thing they switch - the System
     * status page has its own - so flipping one there cannot clear the others.
     */
    public static function withOne(string $key, bool $on): string
    {
        $off = self::disabled();

        if ($on) {
            $off = array_values(array_diff($off, [$key]));
        } elseif (!in_array($key, $off, true) && in_array($key, self::ALL, true)) {
            $off[] = $key;
        }

        return implode(',', array_values(array_intersect(self::ALL, $off)));
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::ALL as $key) {
            $options[$key] = Theme::trans('settings.features.' . $key);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function descriptions(): array
    {
        $descriptions = [];

        foreach (self::ALL as $key) {
            $descriptions[$key] = Theme::trans('settings.features.' . $key . '_helper');
        }

        return $descriptions;
    }
}
