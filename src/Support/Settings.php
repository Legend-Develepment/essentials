<?php

namespace LegendDevelopment\Theme\Support;

use App\Enums\EditorLanguages;
use App\Filament\Components\Forms\Fields\MonacoEditor;
use App\Traits\EnvironmentWriterTrait;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
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
            'icon_overrides' => Icons::overrides(),

            'channel' => Channels::current(),
            'auto_update' => Channels::autoUpdate(),
            'beta_url' => (string) Theme::config('beta_url', ''),
            'dev_url' => (string) Theme::config('dev_url', ''),
            'arranger' => Theme::arrangerEnabled(),
            'logo_height' => (string) Theme::config('logo_height', '2'),
            'logo_url' => (string) Theme::config('logo_url', ''),

            'login_image' => (string) Theme::config('login_image', ''),
            'login_image_url' => (string) Theme::config('login_image_url', ''),
            'login_dim' => (int) Theme::config('login_dim', 45),
            'login_blur' => (int) Theme::config('login_blur', 0),
            'login_width' => (int) Theme::config('login_width', 28),

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
            Section::make(fn () => Theme::trans('settings.groups.updates'))
                ->description(fn () => Theme::trans('settings.groups.updates_helper'))
                ->columns(2)
                ->schema(self::channelFields()),
            Section::make(fn () => Theme::trans('settings.groups.appearance'))
                ->columns(2)
                ->schema(self::appearanceFields()),
            Section::make(fn () => Theme::trans('settings.groups.background'))
                ->description(fn () => Theme::trans('settings.groups.background_helper'))
                ->columns(2)
                ->schema(self::backgroundFields()),
            Section::make(fn () => Theme::trans('settings.groups.bars'))
                ->description(fn () => Theme::trans('settings.groups.bars_helper'))
                ->columns(3)
                ->schema(self::barFields()),
            Section::make(fn () => Theme::trans('settings.groups.icons'))
                ->columns(2)
                ->schema(self::iconFields()),
            Section::make(fn () => Theme::trans('settings.groups.brand'))
                ->columns(2)
                ->schema(self::brandFields()),
            Section::make(fn () => Theme::trans('settings.groups.login'))
                ->description(fn () => Theme::trans('settings.groups.login_helper'))
                ->columns(2)
                ->collapsible()
                ->collapsed()
                ->schema(self::loginFields()),
            Section::make(fn () => Theme::trans('settings.groups.advanced'))
                ->description(fn () => Theme::trans('settings.groups.advanced_helper'))
                ->collapsible()
                ->collapsed(fn (): bool => CustomCss::get() === '')
                ->schema(self::advancedFields()),
            Section::make(fn () => Theme::trans('settings.groups.areas'))
                ->description(fn () => Theme::trans('settings.groups.areas_helper'))
                ->collapsible()
                ->collapsed(fn (): bool => Areas::rows() === [])
                ->schema(self::areaFields()),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function channelFields(): array
    {
        return [
            Select::make('channel')
                ->label(fn () => Theme::trans('settings.channel.label'))
                ->helperText(fn () => Theme::trans('settings.channel.helper'))
                ->options(fn () => Channels::options())
                ->selectablePlaceholder(false)
                ->required()
                ->live(),
            Select::make('auto_update')
                ->label(fn () => Theme::trans('settings.channel.auto.label'))
                ->helperText(fn () => Theme::trans('settings.channel.auto.helper'))
                ->options(fn () => Channels::autoUpdateOptions())
                ->selectablePlaceholder(false)
                ->required(),
            // Both feeds are worked out from the stable one, so these stay empty
            // unless a channel is published somewhere that cannot be guessed.
            // The placeholder is the address that is actually being read, not an
            // example: seeing it is the quickest way to tell whether it is right.
            TextInput::make('beta_url')
                ->label(fn () => Theme::trans('settings.channel.beta_url'))
                ->helperText(fn () => Theme::trans('settings.channel.beta_url_helper'))
                ->placeholder(fn (): string => Channels::derive(Channels::BETA) ?? '')
                ->url()
                ->maxLength(2048)
                ->visible(fn (Get $get): bool => $get('channel') === Channels::BETA)
                ->columnSpanFull(),
            TextInput::make('dev_url')
                ->label(fn () => Theme::trans('settings.channel.dev_url'))
                ->helperText(fn () => Theme::trans('settings.channel.dev_url_helper'))
                ->placeholder(fn (): string => Channels::derive(Channels::DEV) ?? '')
                ->url()
                ->maxLength(2048)
                ->visible(fn (Get $get): bool => $get('channel') === Channels::DEV)
                ->columnSpanFull(),
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
            KeyValue::make('icon_overrides')
                ->label(fn () => Theme::trans('settings.icons.overrides'))
                ->helperText(fn () => Theme::trans('settings.icons.overrides_helper'))
                ->keyLabel(fn () => Theme::trans('settings.icons.overrides_key'))
                ->valueLabel(fn () => Theme::trans('settings.icons.overrides_value'))
                ->keyPlaceholder('files')
                ->valuePlaceholder('tabler-folder')
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
            'LEGEND_THEME_ICONS' => Icons::toStorage((array) ($data['icon_overrides'] ?? [])),

            'LEGEND_THEME_CHANNEL' => self::channel($data['channel'] ?? null),
            'LEGEND_THEME_AUTO_UPDATE' => in_array(
                $data['auto_update'] ?? null,
                [Channels::AUTO_HOURLY, Channels::AUTO_DAILY, Channels::AUTO_WEEKLY],
                true,
            ) ? $data['auto_update'] : Channels::AUTO_OFF,
            'LEGEND_THEME_BETA_URL' => self::url($data['beta_url'] ?? null),
            'LEGEND_THEME_DEV_URL' => self::url($data['dev_url'] ?? null),
            'LEGEND_THEME_ARRANGER' => ($data['arranger'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGO_HEIGHT' => (string) self::clampFloat($data['logo_height'] ?? null, 1, 8, 2),
            'LEGEND_THEME_LOGO_URL' => self::path($data['logo_url'] ?? null),

            'LEGEND_THEME_LOGIN_IMAGE' => self::storedPath($data['login_image'] ?? null),
            'LEGEND_THEME_LOGIN_URL' => self::url($data['login_image_url'] ?? null),
            'LEGEND_THEME_LOGIN_DIM' => (string) self::clamp($data['login_dim'] ?? null, 0, 90, 45),
            'LEGEND_THEME_LOGIN_BLUR' => (string) self::clamp($data['login_blur'] ?? null, 0, 24, 0),
            'LEGEND_THEME_LOGIN_WIDTH' => (string) self::clamp($data['login_width'] ?? null, 20, 60, 28),

            'LEGEND_THEME_AREAS' => Areas::toStorage((array) ($data['areas'] ?? [])),
        ]);

        // Not an environment value: a stylesheet does not survive a .env round
        // trip, so it goes to storage instead.
        CustomCss::put(is_string($data['custom_css'] ?? null) ? $data['custom_css'] : '');
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
