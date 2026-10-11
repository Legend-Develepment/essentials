<?php

namespace LegendDevelopment\Theme\Support\Fields;

use App\Enums\EditorLanguages;
use App\Filament\Components\Forms\Fields\MonacoEditor;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Actions;
use LegendDevelopment\Theme\Support\Areas;
use LegendDevelopment\Theme\Support\CustomCss;
use LegendDevelopment\Theme\Support\Theme;

/**
 * The Advanced page: a stylesheet of your own, and where things sit.
 *
 * Two sections, and both of them are ways to say "not like that". The
 * custom stylesheet is the escape hatch for anything this plugin does not offer a
 * switch for; the areas are which parts of the panel it is allowed to touch.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Advanced
{
    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function groups(): array
    {
        return [
            // Both start open when they hold something: on a page of folded
            // headings that is the only sign anything was set there at all.
            Part::section('advanced', 'tabler-code', self::advancedFields())
                ->description(fn () => Theme::trans('settings.groups.advanced_helper'))
                ->collapsed(fn (): bool => CustomCss::get() === ''),
            Part::section('areas', 'tabler-layout-grid', self::areaFields())
                ->description(fn () => Theme::trans('settings.groups.areas_helper'))
                ->collapsed(fn (): bool => Areas::rows() === []),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function advancedFields(): array
    {
        return [
            Actions::make([
                Action::make('css_reference')
                    ->label(fn () => Theme::trans('settings.advanced.reference'))
                    ->icon('tabler-code')
                    ->color('gray')
                    ->modalHeading(fn () => Theme::trans('settings.advanced.reference'))
                    ->modalDescription(fn () => Theme::trans('settings.advanced.reference_helper'))
                    ->modalContent(fn () => view(Theme::id() . '::css-reference'))
                    ->modalSubmitAction(false)
                    ->slideOver(),
            ]),
            self::cssField(),
        ];
    }

    /**
     * Pelican ships a Monaco field, which gives syntax highlighting and is
     * already themed by this plugin. If that class ever moves, a plain textarea
     * keeps the setting usable.
     */
    public static function cssField(): mixed
    {
        $label = fn () => Theme::trans('settings.advanced.css');
        $helper = fn () => Theme::trans('settings.advanced.css_helper');

        if (class_exists(MonacoEditor::class) && enum_exists(EditorLanguages::class)) {
            return MonacoEditor::make('custom_css')
                ->label($label)
                ->helperText($helper)
                ->language(EditorLanguages::css)
                ->columnSpanFull();
        }

        return Textarea::make('custom_css')
            ->label($label)
            ->helperText($helper)
            ->rows(14)
            ->columnSpanFull();
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function areaFields(): array
    {
        return [
            Repeater::make('areas')
                ->hiddenLabel()
                ->addActionLabel(fn () => Theme::trans('settings.areas.add'))
                ->maxItems(count(Areas::names()))
                ->columns(['default' => 1, 'sm' => 2, 'lg' => 4])
                ->schema([
                    Select::make('area')
                        ->label(fn () => Theme::trans('settings.areas.area'))
                        ->options(fn () => collect(Areas::names())
                            ->mapWithKeys(fn (string $area): array => [
                                $area => Theme::trans("settings.areas.names.{$area}"),
                            ])
                            ->all())
                        ->required()
                        ->distinct()
                        ->columnSpan(2),
                    Select::make('radius')
                        ->label(fn () => Theme::trans('settings.areas.radius'))
                        ->placeholder(fn () => Theme::trans('settings.areas.inherit'))
                        ->options(fn () => [
                            'sharp' => Theme::trans('settings.areas.radius_sharp'),
                            'normal' => Theme::trans('settings.areas.radius_normal'),
                            'round' => Theme::trans('settings.areas.radius_round'),
                        ]),
                    Select::make('density')
                        ->label(fn () => Theme::trans('settings.density.label'))
                        ->placeholder(fn () => Theme::trans('settings.areas.inherit'))
                        ->options(fn () => [
                            'comfortable' => Theme::trans('settings.density.comfortable'),
                            'compact' => Theme::trans('settings.density.compact'),
                        ]),
                    ColorPicker::make('accent')
                        ->label(fn () => Theme::trans('settings.accent.label'))
                        ->placeholder(fn () => Theme::trans('settings.areas.inherit'))
                        ->hex()
                        ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/')
                        ->columnSpan(2),
                    ColorPicker::make('surface')
                        ->label(fn () => Theme::trans('settings.areas.surface'))
                        ->helperText(fn () => Theme::trans('settings.areas.surface_helper'))
                        ->placeholder(fn () => Theme::trans('settings.areas.inherit'))
                        ->hex()
                        ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/')
                        ->columnSpan(2),
                ]),
        ];
    }
}
