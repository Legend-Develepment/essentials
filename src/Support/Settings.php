<?php

namespace LegendDevelopment\Theme\Support;

use App\Enums\EditorLanguages;
use App\Filament\Components\Forms\Fields\MonacoEditor;
use App\Traits\EnvironmentWriterTrait;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Arr;
use LegendDevelopment\Theme\Jobs\UpdateFromChannel;
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
            'font' => Typography::current(),
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

            'server_art' => ServerList::artwork(),
            'server_art_dim' => ServerList::dim(),
            'server_status' => ServerList::status(),
            'server_density' => ServerList::density(),
            'server_columns' => ServerList::columns(),
            'server_filter_label' => ServerList::labelFilters(),
            'server_controls' => ServerControls::mode(),
            'server_controls_label' => ServerControls::label(),
            'server_controls_position' => ServerControls::position(),

            'console_stats' => ServerConsole::stats(),
            'terminal_renderer' => Terminal::renderer(),
            'terminal_scheme' => Terminal::scheme(),
            'terminal_cursor' => Terminal::cursor(),
            'terminal_blink' => Terminal::blink(),
            'terminal_scrollback' => Terminal::scrollback(),

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
            'arranger_users' => (bool) Theme::config('arranger_users', false),
            'logo_height' => (string) Theme::config('logo_height', '2'),
            'logo_url' => (string) Theme::config('logo_url', ''),

            // The sign-in screen's own settings are not here: they have a page
            // of their own, and a key written from two forms is a key the
            // second one to be saved silently puts back. See persistLogin().
            'custom_css' => CustomCss::get(),

            'footer_text' => SidebarFooter::text(),
            'footer_version' => SidebarFooter::showVersion(),
            'footer_link_label' => SidebarFooter::linkLabel(),
            'footer_link_url' => SidebarFooter::linkUrl(),

            'areas' => Areas::rows(),

            // Ticked is on. What is stored is the inverse - see Features for
            // why - and the form never has to know that.
            'features' => Features::current(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function fields(): array
    {
        /*
         * Everything, for Admin -> Plugins -> Settings, which is one modal and
         * has nowhere to send you.
         *
         * The sidebar splits the same sections across four pages instead - see
         * the three group methods below and mainGroups(). A page is a better
         * home for eleven foldable sections than a single scroll was: the row
         * you want is in the sidebar, named, one click away, rather than
         * somewhere down a page you have to hunt.
         */
        return array_merge(
            self::mainGroups(),
            self::lookGroups(),
            self::pageGroups(),
            self::advancedGroups(),
        );
    }

    /**
     * The plugin's own page: which releases it follows, and what it adds.
     *
     * These two stay together and stay off the sidebar as rows of their own.
     * Everything else answers "what does the panel look like"; these answer
     * "what is this plugin doing", which is one question.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function mainGroups(): array
    {
        return [
            self::group('updates', 'tabler-cloud-download', self::channelFields())
                ->description(fn () => Theme::trans('settings.groups.updates_helper'))
                ->columns(2),

            /*
             * A tick list rather than a switch per row: the question is "which
             * of these do I want", and seven switches down a page is a worse
             * way to read the answer than seven boxes you can take in at once.
             */
            self::group('features', 'tabler-toggle-right', [
                CheckboxList::make('features')
                    ->hiddenLabel()
                    ->options(fn () => Features::options())
                    ->descriptions(fn () => Features::descriptions())
                    ->bulkToggleable()
                    ->columns(2),
            ])
                ->description(fn () => Theme::trans('settings.groups.features_helper')),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function lookGroups(): array
    {
        return [
            self::group('appearance', 'tabler-palette', self::appearanceFields())
                ->columns(2),
            self::group('brand', 'tabler-tag', self::brandFields())
                ->columns(2)
                ->collapsed(),
            self::group('background', 'tabler-photo', self::backgroundFields())
                ->description(fn () => Theme::trans('settings.groups.background_helper'))
                ->columns(2)
                ->collapsed(),
            self::group('icons', 'tabler-icons', self::iconFields())
                ->columns(2)
                ->collapsed(),
            self::group('footer', 'tabler-layout-bottombar', self::footerFields())
                ->description(fn () => Theme::trans('settings.groups.footer_helper'))
                ->columns(2)
                ->collapsed(),
        ];
    }

    /**
     * One row of the style picker: three colours, then the name.
     *
     * Built from the preset's own values rather than from artwork, so a preset
     * added later draws itself. The colours are inline because that is the only
     * place they can be - the stylesheet cannot know them, and this markup is
     * the picker's own.
     */
    private static function presetOption(string $preset): string
    {
        $label = e($preset === Presets::NONE
            ? Theme::trans('settings.preset.options.none')
            : Presets::label($preset));
        $swatch = Presets::swatch($preset);

        if ($swatch === null) {
            // "None" has no colours, because it is the absence of them.
            return $label;
        }

        $chip = static fn (string $colour, string $radius): string => '<span style="'
            . 'display:inline-block;width:0.85rem;height:0.85rem;'
            . 'border-radius:' . e($radius) . ';'
            . 'background:' . e($colour) . ';'
            . 'box-shadow:inset 0 0 0 1px rgba(255,255,255,0.15);'
            . '"></span>';

        return '<span style="display:inline-flex;align-items:center;gap:0.4rem;">'
            . $chip($swatch['background'], $swatch['radius'])
            . $chip($swatch['surface'], $swatch['radius'])
            . $chip($swatch['accent'], $swatch['radius'])
            . '<span>' . $label . '</span>'
            . '</span>';
    }

    /**
     * The bottom of the sidebar. Empty in Pelican, and empty here until
     * something is put in it.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function footerFields(): array
    {
        return [
            TextInput::make('footer_text')
                ->label(fn () => Theme::trans('settings.footer.text'))
                ->helperText(fn () => Theme::trans('settings.footer.text_helper'))
                ->maxLength(120)
                ->columnSpanFull(),

            Toggle::make('footer_version')
                ->label(fn () => Theme::trans('settings.footer.version'))
                ->helperText(fn () => Theme::trans('settings.footer.version_helper'))
                ->columnSpanFull(),

            TextInput::make('footer_link_label')
                ->label(fn () => Theme::trans('settings.footer.link_label'))
                ->placeholder('Support')
                ->maxLength(40),

            TextInput::make('footer_link_url')
                ->label(fn () => Theme::trans('settings.footer.link_url'))
                ->helperText(fn () => Theme::trans('settings.footer.link_url_helper'))
                ->placeholder('https://…')
                ->maxLength(300),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function pageGroups(): array
    {
        return [
            self::group('servers', 'tabler-server', self::serverFields())
                ->description(fn () => Theme::trans('settings.groups.servers_helper'))
                ->columns(2),
            self::group('server_pages', 'tabler-layout-navbar', self::serverPageFields())
                ->description(fn () => Theme::trans('settings.groups.server_pages_helper'))
                ->columns(2)
                ->collapsed(),
            self::group('console', 'tabler-terminal-2', self::consoleFields())
                ->description(fn () => Theme::trans('settings.groups.console_helper'))
                ->columns(2)
                ->collapsed(),
            self::group('bars', 'tabler-chart-bar', self::barFields())
                ->description(fn () => Theme::trans('settings.groups.bars_helper'))
                ->columns(3)
                ->collapsed(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function advancedGroups(): array
    {
        return [
            // Both start open when they hold something: on a page of folded
            // headings that is the only sign anything was set there at all.
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

            /*
             * Any release on the channel, not only the newest - for going back
             * when something new turns out to be worse, or forward to a build
             * you were told to try.
             *
             * Only while updates are not installing themselves, and that is not
             * tidiness either: pinning a version with auto-update on would last
             * until the next run, which on "every minute" is a minute. Rather
             * than have the two fight, the picker is not there while the other
             * one is in charge.
             */
            Select::make('install_version')
                ->label(fn () => Theme::trans('settings.channel.version'))
                ->helperText(fn () => Theme::trans('settings.channel.version_helper'))
                ->options(fn () => Channels::releaseOptions())
                ->placeholder(fn () => Theme::trans('settings.channel.version_placeholder'))
                ->searchable()
                ->live()
                ->visible(fn (Get $get): bool => !$get('auto_update_enabled')
                    && Channels::releaseOptions() !== [])
                ->columnSpanFull(),

            Actions::make([
                Action::make('install_version')
                    ->label(fn () => Theme::trans('settings.channel.version_install'))
                    ->icon('tabler-download')
                    ->requiresConfirmation()
                    ->modalDescription(fn () => Theme::trans('settings.channel.version_confirm'))
                    ->disabled(fn (Get $get): bool => blank($get('install_version')))
                    ->action(fn (Get $get) => self::install($get('install_version'))),
            ])
                ->visible(fn (Get $get): bool => !$get('auto_update_enabled')
                    && Channels::releaseOptions() !== []),
        ];
    }

    /**
     * Install one particular release.
     *
     * The value is the download address itself rather than a version string, so
     * what gets installed can only be something releaseOptions() offered - the
     * list is built from the releases, and a value that is not in it is refused
     * here rather than fetched.
     */
    private static function install(mixed $url): void
    {
        $url = is_string($url) ? $url : '';
        $options = Channels::releaseOptions();

        if (!user()?->can(Theme::PERMISSION_UPDATE) || !array_key_exists($url, $options)) {
            return;
        }

        $version = '?';

        foreach (Channels::releases() as $release) {
            if ($release['download_url'] === $url) {
                $version = $release['version'];

                break;
            }
        }

        UpdateFromChannel::dispatch(user()?->id, $url, $version);

        Notification::make()
            ->title(Theme::trans('page.update_started'))
            ->body(Theme::trans('page.update_background'))
            ->success()
            ->send();
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
            Toggle::make('arranger_users')
                ->label(fn () => Theme::trans('settings.arranger.users'))
                ->helperText(fn () => Theme::trans('settings.arranger.users_helper'))
                ->visible(fn (Get $get): bool => (bool) $get('arranger'))
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
            TextInput::make('login_above')
                ->label(fn () => Theme::trans('settings.login.above'))
                ->helperText(fn () => Theme::trans('settings.login.above_helper'))
                ->maxLength(160)
                ->columnSpanFull(),
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
                        $preset => self::presetOption($preset),
                    ])
                    ->all())
                // The swatches are markup, and the picker has to be told so.
                // Same as the icon picker, which draws the icon beside its name
                // for the same reason: a name alone is hard to picture.
                ->allowHtml()
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

            Select::make('font')
                ->label(fn () => Theme::trans('settings.font.label'))
                ->helperText(fn () => Theme::trans('settings.font.helper'))
                ->options(fn () => Typography::options())
                ->selectablePlaceholder(false)
                ->required(),
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
    private static function serverFields(): array
    {
        return [
            Select::make('server_art')
                ->label(fn () => Theme::trans('settings.servers.art'))
                ->helperText(fn () => Theme::trans('settings.servers.art_helper'))
                ->options(fn () => ServerList::artworkOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->live(),
            TextInput::make('server_art_dim')
                ->label(fn () => Theme::trans('settings.servers.art_dim'))
                ->helperText(fn () => Theme::trans('settings.servers.art_dim_helper'))
                ->numeric()
                ->minValue(0)
                ->maxValue(80)
                ->suffix('%')
                // Only the cover uses it; the faded wash has a dim of its own.
                ->visible(fn (Get $get): bool => $get('server_art') === 'cover'),
            Select::make('server_status')
                ->label(fn () => Theme::trans('settings.servers.status'))
                ->helperText(fn () => Theme::trans('settings.servers.status_helper'))
                ->options(fn () => ServerList::statusOptions())
                ->selectablePlaceholder(false)
                ->required(),
            Select::make('server_density')
                ->label(fn () => Theme::trans('settings.servers.density'))
                ->options(fn () => ServerList::densityOptions())
                ->selectablePlaceholder(false)
                ->required(),
            Toggle::make('server_filter_label')
                ->label(fn () => Theme::trans('settings.servers.filter_label'))
                ->helperText(fn () => Theme::trans('settings.servers.filter_label_helper'))
                ->columnSpanFull(),
            Select::make('server_columns')
                ->label(fn () => Theme::trans('settings.servers.columns'))
                ->helperText(fn () => Theme::trans('settings.servers.columns_helper'))
                ->options(fn () => ServerList::columnOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->columnSpanFull(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function serverPageFields(): array
    {
        return [
            Select::make('server_controls')
                ->label(fn () => Theme::trans('settings.controls.mode'))
                ->helperText(fn () => Theme::trans('settings.controls.mode_helper'))
                ->options(fn () => ServerControls::options())
                ->selectablePlaceholder(false)
                ->live()
                ->required()
                ->columnSpanFull(),

            Select::make('server_controls_position')
                ->label(fn () => Theme::trans('settings.controls.position'))
                ->helperText(fn () => Theme::trans('settings.controls.position_helper'))
                ->options(fn () => ServerControls::positionOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->visible(fn (Get $get): bool => $get('server_controls') !== ServerControls::OFF),

            Select::make('server_controls_label')
                ->label(fn () => Theme::trans('settings.controls.label'))
                ->options(fn () => ServerControls::labelOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->visible(fn (Get $get): bool => $get('server_controls') !== ServerControls::OFF),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function consoleFields(): array
    {
        return [
            Select::make('console_stats')
                ->label(fn () => Theme::trans('settings.console.stats'))
                ->helperText(fn () => Theme::trans('settings.console.stats_helper'))
                ->options(fn () => ServerConsole::statsOptions())
                ->selectablePlaceholder(false)
                ->required()
                ->columnSpanFull(),

            // The terminal is a different thing from the page around it - these
            // reach xterm, everything above reaches the browser - so they are
            // set apart rather than mixed into the same run of dropdowns.
            Section::make(fn () => Theme::trans('settings.areas.names.terminal'))
                ->description(fn () => Theme::trans('settings.terminal.helper'))
                ->columns(2)
                ->columnSpanFull()
                ->schema([
                    Select::make('terminal_renderer')
                        ->label(fn () => Theme::trans('settings.terminal.renderer'))
                        ->helperText(fn () => Theme::trans('settings.terminal.renderer_helper'))
                        ->options(fn () => Terminal::rendererOptions())
                        ->selectablePlaceholder(false)
                        ->required()
                        ->columnSpanFull(),

                    Select::make('terminal_scheme')
                        ->label(fn () => Theme::trans('settings.terminal.scheme'))
                        ->helperText(fn () => Theme::trans('settings.terminal.scheme_helper'))
                        ->options(fn () => Terminal::schemeOptions())
                        ->selectablePlaceholder(false)
                        ->required()
                        ->columnSpanFull(),

                    Select::make('terminal_cursor')
                        ->label(fn () => Theme::trans('settings.terminal.cursor'))
                        ->helperText(fn () => Theme::trans('settings.terminal.cursor_helper'))
                        ->options(fn () => Terminal::cursorOptions())
                        ->selectablePlaceholder(false)
                        ->required(),

                    Select::make('terminal_scrollback')
                        ->label(fn () => Theme::trans('settings.terminal.scrollback'))
                        ->helperText(fn () => Theme::trans('settings.terminal.scrollback_helper'))
                        ->options(fn () => Terminal::scrollbackOptions())
                        ->selectablePlaceholder(false)
                        ->required(),

                    Toggle::make('terminal_blink')
                        ->label(fn () => Theme::trans('settings.terminal.blink'))
                        ->columnSpanFull(),
                ]),
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
            'LEGEND_THEME_FONT' => Typography::sanitise($data['font'] ?? null),
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

            'LEGEND_THEME_SERVER_ART' => ServerList::sanitiseArtwork($data['server_art'] ?? null),
            'LEGEND_THEME_SERVER_ART_DIM' => (string) self::clamp($data['server_art_dim'] ?? null, 0, 80, 35),
            'LEGEND_THEME_SERVER_STATUS' => ServerList::sanitiseStatus($data['server_status'] ?? null),
            'LEGEND_THEME_SERVER_DENSITY' => ServerList::sanitiseDensity($data['server_density'] ?? null),
            'LEGEND_THEME_SERVER_FILTER_LABEL' => ($data['server_filter_label'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_SERVER_CONTROLS' => ServerControls::sanitise($data['server_controls'] ?? null),
            'LEGEND_THEME_SERVER_CONTROLS_LABEL' => ServerControls::sanitiseLabel($data['server_controls_label'] ?? null),
            'LEGEND_THEME_SERVER_CONTROLS_POSITION' => ServerControls::sanitisePosition($data['server_controls_position'] ?? null),

            'LEGEND_THEME_CONSOLE_STATS' => ServerConsole::sanitiseStats($data['console_stats'] ?? null),
            'LEGEND_THEME_SERVER_COLUMNS' => ServerList::sanitiseColumns($data['server_columns'] ?? null),

            'LEGEND_THEME_TERMINAL_RENDERER' => Terminal::sanitiseRenderer($data['terminal_renderer'] ?? null),
            'LEGEND_THEME_TERMINAL_SCHEME' => Terminal::sanitiseScheme($data['terminal_scheme'] ?? null),
            'LEGEND_THEME_TERMINAL_CURSOR' => Terminal::sanitiseCursor($data['terminal_cursor'] ?? null),
            'LEGEND_THEME_TERMINAL_BLINK' => ($data['terminal_blink'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_TERMINAL_SCROLLBACK' => Terminal::sanitiseScrollback($data['terminal_scrollback'] ?? null),

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
            'LEGEND_THEME_ARRANGER_USERS' => ($data['arranger_users'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGO_HEIGHT' => (string) self::clampFloat($data['logo_height'] ?? null, 1, 8, 2),
            'LEGEND_THEME_LOGO_URL' => self::path($data['logo_url'] ?? null),
            'LEGEND_THEME_FOOTER_TEXT' => mb_substr(trim((string) ($data['footer_text'] ?? '')), 0, 120),
            'LEGEND_THEME_FOOTER_VERSION' => ($data['footer_version'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_FOOTER_LABEL' => mb_substr(trim((string) ($data['footer_link_label'] ?? '')), 0, 40),
            'LEGEND_THEME_FOOTER_URL' => self::url($data['footer_link_url'] ?? null),

            'LEGEND_THEME_AREAS' => Areas::toStorage((array) ($data['areas'] ?? [])),

            // Ticked is on, and what is written is what is off. This form
            // offers every feature, so unticked really does mean off here -
            // unlike the one on the System status page, which changes one and
            // leaves the rest as they were.
            'LEGEND_THEME_FEATURES_OFF' => Features::sanitise($data['features'] ?? []),
        ]);

        // Not an environment value: a stylesheet does not survive a .env round
        // trip, so it goes to storage instead.
        CustomCss::put(is_string($data['custom_css'] ?? null) ? $data['custom_css'] : '');


        self::installIconPack($data['icon_pack_file'] ?? null);
    }

    /**
     * The sign-in screen's own settings, written on their own.
     *
     * persist() writes every key it knows about, taking a missing one as "set
     * it to the default". That is right when the whole form is on one page and
     * ruinous when it is not: saving the sign-in page would reset the accent,
     * the layout and everything else to their defaults. So the page that owns
     * these keys writes these keys.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function persistLogin(array $data): void
    {
        (new self())->writeToEnvironment([
            'LEGEND_THEME_LOGIN_IMAGE' => self::storedPath($data['login_image'] ?? null),
            'LEGEND_THEME_LOGIN_URL' => self::url($data['login_image_url'] ?? null),
            'LEGEND_THEME_LOGIN_DIM' => (string) self::clamp($data['login_dim'] ?? null, 0, 90, 45),
            'LEGEND_THEME_LOGIN_BLUR' => (string) self::clamp($data['login_blur'] ?? null, 0, 24, 0),
            'LEGEND_THEME_LOGIN_WIDTH' => (string) self::clamp($data['login_width'] ?? null, 20, 60, 28),
            'LEGEND_THEME_LOGIN_POSITION' => Login::sanitisePosition($data['login_position'] ?? null),
            'LEGEND_THEME_LOGIN_ALIGN' => Login::sanitiseAlign($data['login_align'] ?? null),
            'LEGEND_THEME_LOGIN_OPACITY' => (string) self::clamp($data['login_opacity'] ?? null, 30, 100, 92),
            'LEGEND_THEME_LOGIN_GLOW' => ($data['login_glow'] ?? true) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_HIDE_HEADING' => ($data['login_hide_heading'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_HIDE_FOOTER' => ($data['login_hide_footer'] ?? false) ? 'true' : 'false',
            'LEGEND_THEME_LOGIN_ABOVE' => self::line($data['login_above'] ?? null),
            'LEGEND_THEME_LOGIN_NOTICE' => self::line($data['login_notice'] ?? null),
        ]);
    }

    /**
     * The system status page's own three settings, written on their own.
     *
     * Same reason as persistLogin(): a form that does not carry every key must
     * not write every key.
     *
     * @param  array<mixed, mixed>  $data
     */
    public static function persistSystemStatus(array $data): void
    {
        (new self())->writeToEnvironment([
            // Through Features, so this switch and the one on the Features tab
            // are the same switch. withOne() leaves the rest of the list alone,
            // which matters because this form does not show the rest of it.
            'LEGEND_THEME_FEATURES_OFF' => Features::withOne(
                Features::SYSTEM_STATUS,
                (bool) ($data['system_status'] ?? true),
            ),
            'LEGEND_THEME_SYSTEM_REFRESH' => SystemStatus::sanitiseRefresh($data['system_status_refresh'] ?? null),
            'LEGEND_THEME_SYSTEM_HIDDEN' => SystemStatus::sanitiseBlocks($data['system_status_blocks'] ?? null),
            'LEGEND_THEME_SYSTEM_NODES' => SystemStatus::sanitiseNodes($data['system_status_nodes'] ?? null),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function loginData(): array
    {
        return [
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
            'login_above' => (string) Theme::config('login_above', ''),
            'login_notice' => (string) Theme::config('login_notice', ''),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function loginSection(): array
    {
        return self::loginFields();
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
