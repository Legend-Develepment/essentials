<?php

namespace LegendDevelopment\Theme\Support;

use App\Enums\EditorLanguages;
use App\Filament\Components\Forms\Fields\MonacoEditor;
use App\Traits\EnvironmentWriterTrait;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Arr;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * The theme's settings, in one place.
 *
 * Both entry points use this: the plugin settings modal under Admin -> Plugins
 * (which needs the panel-wide plugin permissions) and the dedicated Theme page
 * (which needs only this plugin's own permissions).
 */
class Settings
{
    use EnvironmentWriterTrait;

    private const BACKGROUNDS = ['aurora', 'solid', 'gradient', 'image'];

    /**
     * @return array<string, mixed>
     */
    public static function data(): array
    {
        return [
            'preset' => Presets::current(),
            'layout' => Layout::current(),
            'nav_style' => Layout::navStyle(),
            'topbar_style' => Layout::topbarStyle(),
            'card_style' => Layout::cardStyle(),
            'accent' => Palette::sanitize(Theme::config('accent')),
            'surface' => ($surface = (string) Theme::config('surface', '')) !== ''
                ? Palette::sanitize($surface, '')
                : null,
            'radius' => array_key_exists((string) Theme::config('radius'), Areas::RADII)
                ? (string) Theme::config('radius')
                : 'normal',
            'density' => Theme::config('density', 'comfortable') === 'compact' ? 'compact' : 'comfortable',
            'force_dark' => (bool) Theme::config('force_dark', false),
            'glass' => (bool) Theme::config('glass', true),
            'glow' => (bool) Theme::config('glow', true),

            'background' => in_array(Theme::config('background'), self::BACKGROUNDS, true)
                ? Theme::config('background')
                : 'aurora',
            'background_color' => Palette::sanitize(Theme::config('background_color'), '#14110e'),
            'background_color_end' => Palette::sanitize(Theme::config('background_color_end'), '#2b1c08'),
            'background_angle' => (string) Theme::config('background_angle', '160'),
            'background_image' => (string) Theme::config('background_image', ''),
            'background_image_url' => (string) Theme::config('background_image_url', ''),
            'background_dim' => (int) Theme::config('background_dim', 55),
            'background_blur' => (int) Theme::config('background_blur', 0),

            'bar_base' => Theme::config('bar_base', 'green') === 'accent' ? 'accent' : 'green',
            'bar_warning' => Bars::warning(),
            'bar_danger' => Bars::danger(),

            'icon_stroke' => (string) Theme::config('icon_stroke', '2'),
            'icon_scale' => (string) Theme::config('icon_scale', '1'),
            'icon_accent' => (bool) Theme::config('icon_accent', false),
            'icon_pack' => IconPacks::current(),
            'icon_pack_file' => null,
            'icon_overrides' => Icons::rows(),

            'channel' => Channels::current(),
            'auto_update_enabled' => Channels::autoUpdateEnabled(),
            'auto_update' => Channels::autoUpdateInterval(),
            'arranger' => Theme::arrangerEnabled(),
            'logo_height' => (string) Theme::config('logo_height', '2'),
            'logo_url' => (string) Theme::config('logo_url', ''),

            'login_image' => (string) Theme::config('login_image', ''),
            'login_image_url' => (string) Theme::config('login_image_url', ''),
            'login_dim' => (int) Theme::config('login_dim', 45),
            'login_blur' => (int) Theme::config('login_blur', 0),
            'login_width' => (int) Theme::config('login_width', 28),
            'login_position' => Login::position(),
            'login_align' => Login::align(),
            'login_opacity' => Login::opacity(),
            'login_glow' => Login::glow(),
            'login_hide_heading' => (bool) Theme::config('login_hide_heading', false),
            'login_hide_footer' => (bool) Theme::config('login_hide_footer', false),
            'login_notice' => (string) Theme::config('login_notice', ''),

            'custom_css' => CustomCss::get(),

            'areas' => Areas::rows(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function fields(): array
    {
        return [
            /*
             * Nine sections is a long page to scroll past to reach the one you
             * came for, so every one of them folds and remembers whether it was
             * open - per browser, so the page comes back the way it was left.
             * The two that answer "what does this panel look like" start open;
             * the rest are opened when they are wanted.
             *
             * The icons are not decoration: they are what makes a folded list of
             * nine headings scannable at a glance.
             */
            self::group('updates', 'tabler-cloud-download', self::channelFields())
                ->description(fn () => Theme::trans('settings.groups.updates_helper'))
                ->columns(2),
            self::group('appearance', 'tabler-palette', self::appearanceFields())
                ->columns(2),
            self::group('background', 'tabler-photo', self::backgroundFields())
                ->description(fn () => Theme::trans('settings.groups.background_helper'))
                ->columns(2)
                ->collapsed(),
            self::group('bars', 'tabler-chart-bar', self::barFields())
                ->description(fn () => Theme::trans('settings.groups.bars_helper'))
                ->columns(3)
                ->collapsed(),
            self::group('icons', 'tabler-icons', self::iconFields())
                ->columns(2)
                ->collapsed(),
            self::group('brand', 'tabler-tag', self::brandFields())
                ->columns(2)
                ->collapsed(),
            self::group('login', 'tabler-login', self::loginFields())
                ->description(fn () => Theme::trans('settings.groups.login_helper'))
                ->columns(2)
                ->collapsed(),
            // These two start open when they hold something, since that is the
            // only sign on a folded page that anything was set there.
            self::group('advanced', 'tabler-code', self::advancedFields())
                ->description(fn () => Theme::trans('settings.groups.advanced_helper'))
                ->collapsed(fn (): bool => CustomCss::get() === ''),
            self::group('areas', 'tabler-layout-grid', self::areaFields())
                ->description(fn () => Theme::trans('settings.groups.areas_helper'))
                ->collapsed(fn (): bool => Areas::rows() === []),
        ];
    }

    /**
     * One foldable section, named after its translation key - which doubles as
     * the id the open/closed state is remembered under.
     *
     * @param  array<int, \Filament\Schemas\Components\Component>  $schema
     */
    private static function group(string $key, string $icon, array $schema): Section
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

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function channelFields(): array
    {
        return [
            // Every feed is worked out from the stable one, branch included, so
            // there is no address to fill in and no field asking for one. The
            // address in use is named underneath instead - which also makes an
            // override left in .env visible rather than silently in charge.
            Select::make('channel')
                ->label(fn () => Theme::trans('settings.channel.label'))
                ->helperText(fn (): string => Theme::trans('settings.channel.helper')
                    . ' — ' . (Channels::feed() ?? '?'))
                ->options(fn () => Channels::options())
                ->selectablePlaceholder(false)
                ->required()
                ->live(),
            // A switch of its own rather than an "off" among the intervals: off
            // is a decision, and turning it back on should not mean choosing an
            // interval again.
            Toggle::make('auto_update_enabled')
                ->label(fn () => Theme::trans('settings.channel.auto.label'))
                ->helperText(fn () => Theme::trans('settings.channel.auto.helper'))
                ->live(),
            Select::make('auto_update')
                ->label(fn () => Theme::trans('settings.channel.auto.interval'))
                ->options(fn () => Channels::autoUpdateOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->visible(fn (Get $get): bool => (bool) $get('auto_update_enabled')),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function brandFields(): array
    {
        return [
            Toggle::make('arranger')
                ->label(fn () => Theme::trans('settings.arranger.label'))
                ->helperText(fn () => Theme::trans('settings.arranger.helper'))
                ->columnSpanFull(),
            TextInput::make('logo_height')
                ->label(fn () => Theme::trans('settings.brand.logo_height'))
                ->helperText(fn () => Theme::trans('settings.brand.logo_height_helper'))
                ->numeric()
                ->minValue(1)
                ->maxValue(8)
                ->step(0.25)
                ->suffix('rem'),
            TextInput::make('logo_url')
                ->label(fn () => Theme::trans('settings.brand.logo_url'))
                ->helperText(fn () => Theme::trans('settings.brand.logo_url_helper'))
                ->placeholder('/legend-logo.png')
                ->maxLength(2048),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function loginFields(): array
    {
        return [
            FileUpload::make('login_image')
                ->label(fn () => Theme::trans('settings.login.image'))
                ->helperText(fn () => Theme::trans('settings.login.image_helper'))
                ->disk('public')
                ->directory('theme')
                ->image()
                ->maxFiles(1)
                ->maxSize(8192)
                ->columnSpanFull(),
            TextInput::make('login_image_url')
                ->label(fn () => Theme::trans('settings.login.url'))
                ->url()
                ->maxLength(2048)
                ->columnSpanFull(),
            TextInput::make('login_dim')
                ->label(fn () => Theme::trans('settings.background.dim'))
                ->numeric()
                ->minValue(0)
                ->maxValue(90)
                ->suffix('%'),
            TextInput::make('login_blur')
                ->label(fn () => Theme::trans('settings.login.blur'))
                ->helperText(fn () => Theme::trans('settings.login.blur_helper'))
                ->numeric()
                ->minValue(0)
                ->maxValue(24)
                ->suffix('px'),
            TextInput::make('login_width')
                ->label(fn () => Theme::trans('settings.login.width'))
                ->numeric()
                ->minValue(20)
                ->maxValue(60)
                ->suffix('rem'),
            Select::make('login_position')
                ->label(fn () => Theme::trans('settings.login.position'))
                ->helperText(fn () => Theme::trans('settings.login.position_helper'))
                ->options(fn () => [
                    'center' => Theme::trans('settings.login.position_center'),
                    'top' => Theme::trans('settings.login.position_top'),
                    'bottom' => Theme::trans('settings.login.position_bottom'),
                    'left' => Theme::trans('settings.login.position_left'),
                    'right' => Theme::trans('settings.login.position_right'),
                ])
                ->selectablePlaceholder(false),
            Select::make('login_align')
                ->label(fn () => Theme::trans('settings.login.align'))
                ->helperText(fn () => Theme::trans('settings.login.align_helper'))
                ->options(fn () => [
                    'center' => Theme::trans('settings.login.align_center'),
                    'start' => Theme::trans('settings.login.align_start'),
                    'end' => Theme::trans('settings.login.align_end'),
                ])
                ->selectablePlaceholder(false),
            TextInput::make('login_opacity')
                ->label(fn () => Theme::trans('settings.login.opacity'))
                ->helperText(fn () => Theme::trans('settings.login.opacity_helper'))
                ->numeric()
                ->minValue(30)
                ->maxValue(100)
                ->suffix('%'),
            Toggle::make('login_glow')
                ->label(fn () => Theme::trans('settings.login.glow'))
                ->helperText(fn () => Theme::trans('settings.login.glow_helper')),
            Toggle::make('login_hide_heading')
                ->label(fn () => Theme::trans('settings.login.hide_heading'))
                ->helperText(fn () => Theme::trans('settings.login.hide_heading_helper')),
            Toggle::make('login_hide_footer')
                ->label(fn () => Theme::trans('settings.login.hide_footer'))
                ->helperText(fn () => Theme::trans('settings.login.hide_footer_helper')),
            TextInput::make('login_notice')
                ->label(fn () => Theme::trans('settings.login.notice'))
                ->helperText(fn () => Theme::trans('settings.login.notice_helper'))
                ->maxLength(160)
                ->columnSpanFull(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function advancedFields(): array
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
    private static function cssField(): mixed
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
    private static function areaFields(): array
    {
        return [
            Repeater::make('areas')
                ->hiddenLabel()
                ->addActionLabel(fn () => Theme::trans('settings.areas.add'))
                ->maxItems(count(Areas::names()))
                ->columns(4)
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

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function barFields(): array
    {
        return [
            Select::make('bar_base')
                ->label(fn () => Theme::trans('settings.bars.base'))
                ->options(fn () => [
                    'green' => Theme::trans('settings.bars.base_green'),
                    'accent' => Theme::trans('settings.bars.base_accent'),
                ])
                ->selectablePlaceholder(false),
            TextInput::make('bar_warning')
                ->label(fn () => Theme::trans('settings.bars.warning'))
                ->numeric()
                ->minValue(2)
                ->maxValue(98)
                ->suffix('%'),
            TextInput::make('bar_danger')
                ->label(fn () => Theme::trans('settings.bars.danger'))
                ->numeric()
                ->minValue(3)
                ->maxValue(99)
                ->suffix('%'),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function appearanceFields(): array
    {
        return [
            Select::make('preset')
                ->label(fn () => Theme::trans('settings.preset.label'))
                ->helperText(fn () => Theme::trans('settings.preset.helper'))
                ->options(fn () => collect([Presets::NONE, ...Presets::names()])
                    ->mapWithKeys(fn (string $preset): array => [
                        $preset => Theme::trans("settings.preset.options.{$preset}"),
                    ])
                    ->all())
                ->selectablePlaceholder(false)
                ->required()
                ->live()
                // Filling the fields in rather than hiding the values behind the
                // preset keeps it obvious what a preset actually changed.
                ->afterStateUpdated(function (mixed $state, Set $set): void {
                    foreach (Presets::values(is_string($state) ? $state : '') as $field => $value) {
                        $set($field, $value);
                    }
                })
                ->columnSpanFull(),
            /*
             * Where the navigation lives and how wide the content runs. Built
             * from Filament's own panel API rather than CSS fighting it, so a
             * layout keeps working when Pelican changes its markup - and it is
             * the one setting here that changes the shape of the panel rather
             * than its colour.
             */
            Select::make('layout')
                ->label(fn () => Theme::trans('settings.layout.label'))
                ->helperText(fn () => Theme::trans('settings.layout.helper'))
                ->options(fn () => Layout::options())
                ->selectablePlaceholder(false)
                ->required()
                ->columnSpanFull(),
            Select::make('nav_style')
                ->label(fn () => Theme::trans('settings.layout.nav_label'))
                ->helperText(fn () => Theme::trans('settings.layout.nav_helper'))
                ->options(fn () => Layout::navOptions())
                ->selectablePlaceholder(false)
                ->required(),
            Select::make('topbar_style')
                ->label(fn () => Theme::trans('settings.layout.topbar_label'))
                ->helperText(fn () => Theme::trans('settings.layout.topbar_helper'))
                ->options(fn () => Layout::topbarOptions())
                ->selectablePlaceholder(false)
                ->required(),
            Select::make('card_style')
                ->label(fn () => Theme::trans('settings.layout.card_label'))
                ->helperText(fn () => Theme::trans('settings.layout.card_helper'))
                ->options(fn () => Layout::cardOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->columnSpanFull(),
            ColorPicker::make('accent')
                ->label(fn () => Theme::trans('settings.accent.label'))
                ->helperText(fn () => Theme::trans('settings.accent.helper'))
                ->hex()
                ->required()
                ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'),
            ColorPicker::make('surface')
                ->label(fn () => Theme::trans('settings.surface.label'))
                ->helperText(fn () => Theme::trans('settings.surface.helper'))
                ->placeholder(fn () => Theme::trans('settings.surface.placeholder'))
                ->hex()
                ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'),
            Select::make('radius')
                ->label(fn () => Theme::trans('settings.radius.label'))
                ->options(fn () => [
                    'sharp' => Theme::trans('settings.areas.radius_sharp'),
                    'normal' => Theme::trans('settings.areas.radius_normal'),
                    'round' => Theme::trans('settings.areas.radius_round'),
                ])
                ->selectablePlaceholder(false)
                ->required(),
            Select::make('density')
                ->label(fn () => Theme::trans('settings.density.label'))
                ->helperText(fn () => Theme::trans('settings.density.helper'))
                ->options(fn () => [
                    'comfortable' => Theme::trans('settings.density.comfortable'),
                    'compact' => Theme::trans('settings.density.compact'),
                ])
                ->selectablePlaceholder(false)
                ->required(),
            Toggle::make('force_dark')
                ->label(fn () => Theme::trans('settings.force_dark.label'))
                ->helperText(fn () => Theme::trans('settings.force_dark.helper')),
            Toggle::make('glass')
                ->label(fn () => Theme::trans('settings.glass.label'))
                ->helperText(fn () => Theme::trans('settings.glass.helper')),
            Toggle::make('glow')
                ->label(fn () => Theme::trans('settings.glow.label'))
                ->helperText(fn () => Theme::trans('settings.glow.helper')),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function backgroundFields(): array
    {
        $usesColor = fn (Get $get): bool => in_array($get('background'), ['solid', 'gradient'], true);
        $usesGradient = fn (Get $get): bool => $get('background') === 'gradient';
        $usesImage = fn (Get $get): bool => $get('background') === 'image';

        return [
            Select::make('background')
                ->label(fn () => Theme::trans('settings.background.label'))
                ->helperText(fn () => Theme::trans('settings.background.helper'))
                ->options(fn () => [
                    'aurora' => Theme::trans('settings.background.aurora'),
                    'solid' => Theme::trans('settings.background.solid'),
                    'gradient' => Theme::trans('settings.background.gradient'),
                    'image' => Theme::trans('settings.background.image'),
                ])
                ->selectablePlaceholder(false)
                ->required()
                ->live()
                ->columnSpanFull(),
            ColorPicker::make('background_color')
                ->label(fn () => Theme::trans('settings.background.color'))
                ->hex()
                ->visible($usesColor)
                ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'),
            ColorPicker::make('background_color_end')
                ->label(fn () => Theme::trans('settings.background.color_end'))
                ->hex()
                ->visible($usesGradient)
                ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'),
            Select::make('background_angle')
                ->label(fn () => Theme::trans('settings.background.angle'))
                ->options([
                    '0' => '0° ↑',
                    '45' => '45° ↗',
                    '90' => '90° →',
                    '135' => '135° ↘',
                    '160' => '160° ↓',
                    '180' => '180° ↓',
                    '225' => '225° ↙',
                    '270' => '270° ←',
                    '315' => '315° ↖',
                ])
                ->selectablePlaceholder(false)
                ->visible($usesGradient),
            FileUpload::make('background_image')
                ->label(fn () => Theme::trans('settings.background.upload'))
                ->helperText(fn () => Theme::trans('settings.background.upload_helper'))
                ->disk('public')
                ->directory('theme')
                ->image()
                ->maxFiles(1)
                ->maxSize(8192)
                ->visible($usesImage)
                ->columnSpanFull(),
            TextInput::make('background_image_url')
                ->label(fn () => Theme::trans('settings.background.url'))
                ->helperText(fn () => Theme::trans('settings.background.url_helper'))
                ->url()
                ->maxLength(2048)
                ->visible($usesImage)
                ->columnSpanFull(),
            TextInput::make('background_dim')
                ->label(fn () => Theme::trans('settings.background.dim'))
                ->helperText(fn () => Theme::trans('settings.background.dim_helper'))
                ->numeric()
                ->minValue(0)
                ->maxValue(90)
                ->suffix('%')
                ->visible($usesImage),
            TextInput::make('background_blur')
                ->label(fn () => Theme::trans('settings.background.blur'))
                ->numeric()
                ->minValue(0)
                ->maxValue(24)
                ->suffix('px')
                ->visible($usesImage),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function iconFields(): array
    {
        return [
            Select::make('icon_stroke')
                ->label(fn () => Theme::trans('settings.icons.stroke'))
                ->options(fn () => [
                    '1.25' => Theme::trans('settings.icons.stroke_thin'),
                    '2' => Theme::trans('settings.icons.stroke_normal'),
                    '2.5' => Theme::trans('settings.icons.stroke_bold'),
                ])
                ->selectablePlaceholder(false),
            Select::make('icon_scale')
                ->label(fn () => Theme::trans('settings.icons.scale'))
                ->options([
                    '0.9' => '90%',
                    '1' => '100%',
                    '1.1' => '110%',
                    '1.25' => '125%',
                ])
                ->selectablePlaceholder(false),
            Toggle::make('icon_accent')
                ->label(fn () => Theme::trans('settings.icons.accent'))
                ->helperText(fn () => Theme::trans('settings.icons.accent_helper'))
                ->columnSpanFull(),
            /*
             * Which set the picker below draws from. Every icon set installed
             * on the server is offered, plus a pack of plain SVG files that can
             * be uploaded for a set nobody has packaged for Laravel.
             *
             * It only decides what the picker offers: names stay fully
             * qualified, so changing pack never repoints an icon already
             * chosen.
             */
            Select::make('icon_pack')
                ->label(fn () => Theme::trans('settings.icons.pack'))
                ->helperText(fn () => Theme::trans('settings.icons.pack_helper'))
                ->options(fn () => IconPacks::options())
                ->selectablePlaceholder(false)
                ->live()
                ->columnSpanFull(),
            FileUpload::make('icon_pack_file')
                ->label(fn () => Theme::trans('settings.icons.pack_upload'))
                ->helperText(fn () => Theme::trans('settings.icons.pack_upload_helper'))
                ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed', 'multipart/x-zip'])
                ->maxFiles(1)
                ->maxSize(8192)
                // Kept as the upload rather than stored: it is unpacked on save
                // and the zip itself is of no further use.
                ->storeFiles(false)
                ->visible(fn (Get $get): bool => $get('icon_pack') === IconPacks::CUSTOM)
                ->columnSpanFull(),
            Repeater::make('icon_overrides')
                ->label(fn () => Theme::trans('settings.icons.overrides'))
                ->helperText(fn () => Theme::trans('settings.icons.overrides_helper'))
                ->addActionLabel(fn () => Theme::trans('settings.icons.overrides_add'))
                ->schema([
                    TextInput::make('match')
                        ->label(fn () => Theme::trans('settings.icons.overrides_key'))
                        ->placeholder('files')
                        ->maxLength(60),
                    Select::make('icon')
                        ->label(fn () => Theme::trans('settings.icons.overrides_value'))
                        ->placeholder(fn () => Theme::trans('settings.icons.overrides_search'))
                        ->searchable()
                        // Several thousand icons is too many to put in a page,
                        // so the list is searched on the server and drawn with
                        // the icons themselves - a name alone is hard to picture.
                        ->getSearchResultsUsing(fn (string $search, Get $get): array => IconPacks::search(
                            $search,
                            (string) ($get('../../icon_pack') ?: IconPacks::current()),
                        ))
                        ->getOptionLabelUsing(fn (?string $value): ?string => $value === null
                            ? null
                            : IconPacks::label($value))
                        ->allowHtml(),
                ])
                ->columns(2)
                ->reorderable(false)
                ->columnSpanFull(),
        ];
    }

    /**
     * Writes to .env and clears the config cache, so a saved colour applies on
     * the next request without a rebuild.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function persist(array $data): void
    {
        $preset = $data['preset'] ?? null;
        $surface = is_string($data['surface'] ?? null) ? trim($data['surface']) : '';

        (new self())->writeToEnvironment([
            'LEGEND_THEME_PRESET' => ($preset === Presets::NONE || in_array($preset, Presets::names(), true))
                ? $preset
                : Presets::DEFAULT,
            'LEGEND_THEME_ACCENT' => Palette::sanitize($data['accent'] ?? null),
            'LEGEND_THEME_SURFACE' => $surface === '' ? '' : Palette::sanitize($surface, ''),
            'LEGEND_THEME_RADIUS' => array_key_exists($data['radius'] ?? '', Areas::RADII)
                ? $data['radius']
                : 'normal',
            'LEGEND_THEME_LAYOUT' => Layout::sanitise($data['layout'] ?? null),
            'LEGEND_THEME_NAV_STYLE' => Layout::sanitiseNav($data['nav_style'] ?? null),
            'LEGEND_THEME_TOPBAR_STYLE' => Layout::sanitiseTopbar($data['topbar_style'] ?? null),
            'LEGEND_THEME_CARD_STYLE' => Layout::sanitiseCard($data['card_style'] ?? null),
            'LEGEND_THEME_DENSITY' => ($data['density'] ?? null) === 'compact' ? 'compact' : 'comfortable',
            'LEGEND_THEME_FORCE_DARK' => ($data['force_dark'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_GLASS' => ($data['glass'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_GLOW' => ($data['glow'] ?? false) ? 'true' : 'false',

            'LEGEND_THEME_BACKGROUND' => in_array($data['background'] ?? null, self::BACKGROUNDS, true)
                ? $data['background']
                : 'aurora',
            'LEGEND_THEME_BG_COLOR' => Palette::sanitize($data['background_color'] ?? null, '#14110e'),
            'LEGEND_THEME_BG_COLOR_END' => Palette::sanitize($data['background_color_end'] ?? null, '#2b1c08'),
            'LEGEND_THEME_BG_ANGLE' => (string) self::clamp($data['background_angle'] ?? null, 0, 360, 160),
            'LEGEND_THEME_BG_IMAGE' => self::storedPath($data['background_image'] ?? null),
            'LEGEND_THEME_BG_URL' => self::url($data['background_image_url'] ?? null),
            'LEGEND_THEME_BG_DIM' => (string) self::clamp($data['background_dim'] ?? null, 0, 90, 55),
            'LEGEND_THEME_BG_BLUR' => (string) self::clamp($data['background_blur'] ?? null, 0, 24, 0),

            'LEGEND_THEME_BAR_BASE' => ($data['bar_base'] ?? null) === 'accent' ? 'accent' : 'green',
            'LEGEND_THEME_BAR_WARNING' => (string) self::clamp($data['bar_warning'] ?? null, 2, 98, Bars::DEFAULT_WARNING),
            'LEGEND_THEME_BAR_DANGER' => (string) self::clamp($data['bar_danger'] ?? null, 3, 99, Bars::DEFAULT_DANGER),

            'LEGEND_THEME_ICON_STROKE' => in_array($data['icon_stroke'] ?? null, ['1.25', '2', '2.5'], true)
                ? $data['icon_stroke']
                : '2',
            'LEGEND_THEME_ICON_SCALE' => in_array($data['icon_scale'] ?? null, ['0.9', '1', '1.1', '1.25'], true)
                ? $data['icon_scale']
                : '1',
            'LEGEND_THEME_ICON_ACCENT' => ($data['icon_accent'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_ICON_PACK' => self::iconPack($data['icon_pack'] ?? null),
            'LEGEND_THEME_ICONS' => Icons::toStorage((array) ($data['icon_overrides'] ?? [])),

            'LEGEND_THEME_CHANNEL' => self::channel($data['channel'] ?? null),
            'LEGEND_THEME_AUTO_UPDATE_ENABLED' => ($data['auto_update_enabled'] ?? false) ? 'true' : 'false',
            // The interval is hidden while the switch is off, and a hidden field
            // submits nothing - so keep what was chosen rather than writing it
            // away. Switching back on then finds the same interval.
            'LEGEND_THEME_AUTO_UPDATE' => self::keptInterval($data),
            // No longer on the form; kept so an override set by hand in .env is
            // not wiped by someone pressing Save on an unrelated setting.
            'LEGEND_THEME_BETA_URL' => self::keptUrl($data, 'beta_url'),
            'LEGEND_THEME_DEV_URL' => self::keptUrl($data, 'dev_url'),
            'LEGEND_THEME_ARRANGER' => ($data['arranger'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGO_HEIGHT' => (string) self::clampFloat($data['logo_height'] ?? null, 1, 8, 2),
            'LEGEND_THEME_LOGO_URL' => self::path($data['logo_url'] ?? null),

            'LEGEND_THEME_LOGIN_IMAGE' => self::storedPath($data['login_image'] ?? null),
            'LEGEND_THEME_LOGIN_URL' => self::url($data['login_image_url'] ?? null),
            'LEGEND_THEME_LOGIN_DIM' => (string) self::clamp($data['login_dim'] ?? null, 0, 90, 45),
            'LEGEND_THEME_LOGIN_BLUR' => (string) self::clamp($data['login_blur'] ?? null, 0, 24, 0),
            'LEGEND_THEME_LOGIN_WIDTH' => (string) self::clamp($data['login_width'] ?? null, 20, 60, 28),
            'LEGEND_THEME_LOGIN_POSITION' => self::oneOf(
                $data['login_position'] ?? null,
                ['center', 'top', 'bottom', 'left', 'right'],
                'center',
            ),
            'LEGEND_THEME_LOGIN_ALIGN' => self::oneOf(
                $data['login_align'] ?? null,
                ['center', 'start', 'end'],
                'center',
            ),
            'LEGEND_THEME_LOGIN_OPACITY' => (string) self::clamp($data['login_opacity'] ?? null, 30, 100, 92),
            'LEGEND_THEME_LOGIN_GLOW' => ($data['login_glow'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_HIDE_HEADING' => ($data['login_hide_heading'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_HIDE_FOOTER' => ($data['login_hide_footer'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_NOTICE' => self::line($data['login_notice'] ?? null),

            'LEGEND_THEME_AREAS' => Areas::toStorage((array) ($data['areas'] ?? [])),
        ]);

        // Not an environment value: a stylesheet does not survive a .env round
        // trip, so it goes to storage instead.
        CustomCss::put(is_string($data['custom_css'] ?? null) ? $data['custom_css'] : '');

        self::installIconPack($data['icon_pack_file'] ?? null);
    }

    /**
     * An uploaded icon pack, unpacked into storage. The zip itself is kept as
     * the upload rather than stored, so this is the only chance to read it.
     *
     * Failing here fails the save: the alternative is telling someone their
     * pack was accepted when the picker will still be empty.
     */
    private static function installIconPack(mixed $file): void
    {
        if (is_array($file)) {
            $file = Arr::first($file);
        }

        if ($file instanceof TemporaryUploadedFile) {
            IconPacks::install($file);
        }
    }

    /**
     * Filament normally hands over the path it saved the upload to, but the value
     * can also arrive as an array of files or as the temporary upload itself,
     * depending on where the form was submitted from - so all three are handled.
     */
    private static function storedPath(mixed $value): string
    {
        if (is_array($value)) {
            $value = Arr::first($value);
        }

        if ($value instanceof TemporaryUploadedFile) {
            $value = $value->store('theme', 'public');
        }

        return is_string($value) ? ltrim($value, '/') : '';
    }

    /**
     * @param  array<mixed, mixed>  $data
     */
    private static function keptInterval(array $data): string
    {
        $interval = Channels::autoUpdateValue($data['auto_update'] ?? null);

        return $interval === Channels::AUTO_OFF ? Channels::autoUpdateInterval() : $interval;
    }

    /**
     * A URL the form no longer asks about: what was submitted if anything was,
     * otherwise whatever is already configured.
     *
     * @param  array<mixed, mixed>  $data
     */
    private static function keptUrl(array $data, string $key): string
    {
        return array_key_exists($key, $data)
            ? self::url($data[$key])
            : self::url(Theme::config($key, ''));
    }

    /**
     * @param  array<int, string>  $allowed
     */
    private static function oneOf(mixed $value, array $allowed, string $fallback): string
    {
        return in_array($value, $allowed, true) ? (string) $value : $fallback;
    }

    private static function iconPack(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === IconPacks::CUSTOM) {
            return IconPacks::CUSTOM;
        }

        return array_key_exists($value, IconPacks::sets()) ? $value : '';
    }

    /**
     * One line of plain text bound for a .env value and, from there, a CSS
     * string. Newlines would end both early, and the angle brackets have no
     * business in either.
     */
    private static function line(mixed $value): string
    {
        $value = is_string($value) ? $value : '';
        $value = preg_replace('/[\r\n\t]+/', ' ', $value) ?? '';
        $value = str_replace(['<', '>'], '', $value);

        return trim(mb_substr($value, 0, 160));
    }

    private static function url(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === '') {
            return '';
        }

        return filter_var($value, FILTER_VALIDATE_URL) === false ? '' : $value;
    }

    private static function clamp(mixed $value, int $min, int $max, int $fallback): int
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return max($min, min($max, (int) $value));
    }

    /**
     * Dev is only storable on a panel that is allowed it, so a copied .env
     * cannot put another panel onto working-branch builds.
     */
    private static function channel(mixed $value): string
    {
        if ($value === Channels::DEV && Channels::devAllowed()) {
            return Channels::DEV;
        }

        return $value === Channels::BETA ? Channels::BETA : Channels::STABLE;
    }

    private static function clampFloat(mixed $value, float $min, float $max, float $fallback): float
    {
        if (!is_numeric($value)) {
            return $fallback;
        }

        return round(max($min, min($max, (float) $value)), 2);
    }

    /**
     * A logo path or URL. Same rules as the background: it ends up in an
     * attribute, so nothing that could break out of it survives.
     */
    private static function path(mixed $value): string
    {
        $value = is_string($value) ? trim($value) : '';

        if ($value === '') {
            return '';
        }

        $value = preg_replace('/[\s"\'<>]/', '', $value) ?? '';

        $isRelative = str_starts_with($value, '/');
        $isAbsolute = str_starts_with($value, 'https://') || str_starts_with($value, 'http://');

        return ($isRelative || $isAbsolute) ? $value : '';
    }
}
