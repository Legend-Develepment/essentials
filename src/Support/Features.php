<?php

namespace LegendDevelopment\Theme\Support;

/**
 * Which parts of the plugin are switched on.
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
    public const ANNOUNCEMENTS = 'announcements';

    public const NAV_LINKS = 'nav_links';

    public const LOGIN = 'login';

    public const BARS = 'bars';

    public const DASHBOARD_STATUS = 'dashboard_status';

    public const DASHBOARD_NODES = 'dashboard_nodes';

    public const SYSTEM_STATUS = 'system_status';

    /** Every feature, in the order the settings page offers them. */
    public const ALL = [
        self::ANNOUNCEMENTS,
        self::NAV_LINKS,
        self::LOGIN,
        self::BARS,
        self::DASHBOARD_STATUS,
        self::DASHBOARD_NODES,
        self::SYSTEM_STATUS,
    ];

    public static function enabled(string $key): bool
    {
        return !in_array($key, self::disabled(), true);
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
