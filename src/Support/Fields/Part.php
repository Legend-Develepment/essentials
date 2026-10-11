<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Schemas\Components\Section;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The one shape every settings form is built out of.
 *
 * One foldable section, and a single place that decides what one looks
 * like. Nine forms draw these and they have to agree: the same icon colour, the
 * same collapsing, and above all the same id, because that id is what the panel
 * remembers a section's open or closed state under.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Part
{
    /**
     * One foldable section, named after its translation key - which doubles as
     * the id the open/closed state is remembered under.
     *
     * @param  array<int, \Filament\Schemas\Components\Component>  $schema
     */
    public static function section(string $key, string $icon, array $schema): Section
    {
        return Section::make(fn () => Theme::trans('settings.groups.' . $key))
            ->icon($icon)
            ->iconColor('primary')
            ->collapsible()
            ->persistCollapsed()
            // What the open/closed state is remembered under, so it survives a
            // heading being renamed or a section moving up the page.
            ->id('ld-settings-' . $key)
            ->schema($schema);
    }
}
