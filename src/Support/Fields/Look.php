<?php

namespace LegendDevelopment\Theme\Support\Fields;

use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\IconPacks;
use LegendDevelopment\Theme\Support\Icons;
use LegendDevelopment\Theme\Support\Layout;
use LegendDevelopment\Theme\Support\Mode;
use LegendDevelopment\Theme\Support\NavIcon;
use LegendDevelopment\Theme\Support\Palette;
use LegendDevelopment\Theme\Support\Presets;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Typography;
use LegendDevelopment\Theme\Support\UserTheme;
use LegendDevelopment\Theme\Support\Windows;

/**
 * The Look page's form: what the panel is made of and what colour it is.
 *
 * Six sections and about six hundred lines, which is why it is a file
 * rather than a method. This is the form most panels spend their time in, and the
 * one that grows every time somebody wants one more thing configurable.
 *
 * Lifted out of Settings, which had every form in it and was three thousand
 * lines long. What stays there is what a setting *is*: read it, sanitise it,
 * write it. What moved here is what a setting *looks like*, which is a
 * different question and belongs next to the page that asks it.
 */
class Look
{
    /**
     * The contrast ratio below which an accent gets a word of warning.
     *
     * Three to one, which is what WCAG asks of a large heading or a control
     * against its background, and what the two sentences under the field have
     * always said: "Under 3 an accent is hard to read as a button or a link".
     *
     * It was read as self::CONTRAST_FLOOR here and declared on Settings, which
     * is a different class, so the line threw an Error rather than comparing
     * anything. The throw landed in the catch a few lines down, which is there
     * for a colour that cannot be parsed, so the warning was never drawn and
     * nothing anywhere said why. In the all-in-one plugin too, since the day it
     * was written. tools/check-uses.js now holds self::NAME to a declaration.
     */
    private const CONTRAST_FLOOR = 3.0;

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function groups(): array
    {
        return [
            Part::section('appearance', 'tabler-palette', self::appearanceFields())
                ->columns(['default' => 1, 'sm' => 2]),
            Part::section('brand', 'tabler-tag', self::brandFields())
                ->columns(['default' => 1, 'sm' => 2])
                ->collapsed(),
            Part::section('background', 'tabler-photo', self::backgroundFields())
                ->description(fn () => Theme::trans('settings.groups.background_helper'))
                ->columns(['default' => 1, 'sm' => 2])
                ->collapsed(),
            Part::section('icons', 'tabler-icons', self::iconFields())
                ->columns(['default' => 1, 'sm' => 2])
                ->collapsed(),
            Part::section('windows', 'tabler-clock-hour-10', self::windowFields())
                ->description(fn () => Theme::trans('settings.groups.windows_helper'))
                ->visible(fn (): bool => Features::enabled(Features::SCHEDULED))
                ->collapsed(fn (): bool => Windows::rows() === []),
            /*
             * Out of sight while the footer is switched off, like the timed
             * looks above it. Hidden fields are left out of the form's state,
             * and SettingsPage::save() lays that state over Settings::data(),
             * so what the section holds is kept rather than blanked.
             */
            Part::section('footer', 'tabler-layout-bottombar', self::footerFields())
                ->description(fn () => Theme::trans('settings.groups.footer_helper'))
                ->visible(fn (): bool => Features::enabled(Features::SIDEBAR_FOOTER))
                ->columns(['default' => 1, 'sm' => 2])
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
    public static function presetOption(string $preset): string
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
    public static function footerFields(): array
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
    public static function brandFields(): array
    {
        return [
            /*
             * The switch itself is in the features list now, with every other
             * one - two switches for one thing is worse than one, and the one
             * that was here made the list on the settings page a promise it
             * did not keep. What is left is the question that is not a switch:
             * whether ordinary users may arrange their own pages, or only the
             * roles holding the permission.
             */
            Toggle::make('arranger_users')
                ->label(fn () => Theme::trans('settings.arranger.users'))
                ->helperText(fn () => Theme::trans('settings.arranger.users_helper'))
                ->visible(fn (): bool => Features::enabled(Features::ARRANGER))
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
     * A different look between two times of day.
     *
     * The times are typed rather than picked from a control, and that is a
     * choice about what can be verified: a time picker's output format is
     * something this codebase cannot check against a vendor directory it does
     * not have, and a field that hands back "22:00:00" where the parser expects
     * "22:00" is a window that silently never opens. A text field hands back
     * what was typed.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function windowFields(): array
    {
        return [
            Repeater::make('theme_windows')
                ->label('')
                ->addActionLabel(fn () => Theme::trans('settings.windows.add'))
                ->maxItems(Windows::MAX)
                ->schema([
                    TextInput::make('from')
                        ->label(fn () => Theme::trans('settings.windows.from'))
                        ->placeholder('22:00')
                        ->rules(['regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'])
                        ->required(),

                    TextInput::make('to')
                        ->label(fn () => Theme::trans('settings.windows.to'))
                        ->helperText(fn () => Theme::trans('settings.windows.to_helper'))
                        ->placeholder('06:00')
                        ->rules(['regex:/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/'])
                        ->required(),

                    Select::make('preset')
                        ->label(fn () => Theme::trans('settings.windows.preset'))
                        ->options(fn () => collect(Presets::names())
                            ->mapWithKeys(fn (string $preset): array => [
                                $preset => self::presetOption($preset),
                            ])
                            ->all())
                        ->allowHtml()
                        ->searchable()
                        ->required(),

                    CheckboxList::make('days')
                        ->label(fn () => Theme::trans('settings.windows.days'))
                        ->helperText(fn () => Theme::trans('settings.windows.days_helper'))
                        ->options(fn (): array => Windows::dayOptions())
                        // Two across on a phone: "Wednesday" in a quarter of
                        // 360 pixels does not fit on one line.
                        ->columns(['default' => 2, 'sm' => 4])
                        ->bulkToggleable()
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'md' => 3])
                // Reorderable on purpose: the first window that covers a moment
                // wins, so the order is the answer to "which one applies", and
                // it has to be something somebody can see and move.
                ->reorderable()
                ->defaultItems(0),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function appearanceFields(): array
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

            /*
             * Which mode the panel opens in. Its own setting since 2.47: it
             * used to be half of "force dark", which picked the mode and took
             * the switcher away in one switch - fine while there was only one
             * mode worth having, and in the way of a light style.
             */
            Select::make('mode')
                ->label(fn () => Theme::trans('settings.mode.label'))
                ->helperText(fn () => Theme::trans('settings.mode.helper'))
                ->options(fn () => Mode::options())
                ->selectablePlaceholder(false)
                // Live so the preview flips with it. The box has no <html> of
                // its own to carry a mode, so it is told which one to draw.
                ->live()
                ->required(),

            Select::make('font')
                ->label(fn () => Theme::trans('settings.font.label'))
                ->helperText(fn () => Theme::trans('settings.font.helper'))
                ->options(fn () => Typography::options())
                ->selectablePlaceholder(false)
                ->required(),

            /*
             * Which of these styles a person may pick for themselves. Nothing
             * ticked means nobody picks anything and the panel keeps one look,
             * which is what an existing panel updating to this release keeps.
             *
             * Still shown when the feature is off, and the helper says so
             * instead, along with where the switch is: the Modules page, which
             * nothing on this page otherwise points at. The switch's own words
             * send you here for this question ("which styles are offered is on
             * the Look page"), so hiding it would leave that sentence pointing
             * at nothing - and setting the list up before switching it on is
             * the ordinary order to do it in. What it must not do is look like
             * it is working.
             */
            CheckboxList::make('user_themes')
                ->label(fn () => Theme::trans('settings.user_themes.label'))
                ->helperText(fn () => Theme::trans(
                    Features::enabled(Features::USER_THEMES)
                        ? 'settings.user_themes.helper'
                        : 'settings.user_themes.helper_off',
                ))
                ->options(fn () => UserTheme::options())
                ->bulkToggleable()
                ->columns(['default' => 1, 'sm' => 2])
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
                ->helperText(fn (Get $get): string => self::accentHelper($get('accent'), $get('surface')))
                ->hex()
                ->required()
                // onBlur rather than on every change: a colour picker emits a
                // new value for every pixel a cursor is dragged across, and a
                // readability figure is worth knowing once the colour is chosen
                // rather than four hundred times on the way there.
                ->live(onBlur: true)
                ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'),
            /*
             * These five and the accent above are live, and only these.
             *
             * They are what Support\Preview turns into tokens, so they are what
             * the box beside the form has to hear about. A select or a toggle is
             * one interaction and one round trip; the colour pickers wait for
             * blur, because a picker emits a new value for every pixel a cursor
             * is dragged across and four hundred round trips to move one slider
             * is exactly the cost the plan warned about.
             *
             * Nothing else on this page is live. A preview that answered to
             * every field would be a preview of things it cannot draw.
             */
            ColorPicker::make('surface')
                ->label(fn () => Theme::trans('settings.surface.label'))
                ->helperText(fn () => Theme::trans('settings.surface.helper'))
                ->placeholder(fn () => Theme::trans('settings.surface.placeholder'))
                ->hex()
                ->live(onBlur: true)
                ->rule('regex:/^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/'),
            Select::make('radius')
                ->label(fn () => Theme::trans('settings.radius.label'))
                ->options(fn () => [
                    'sharp' => Theme::trans('settings.areas.radius_sharp'),
                    'normal' => Theme::trans('settings.areas.radius_normal'),
                    'round' => Theme::trans('settings.areas.radius_round'),
                ])
                ->selectablePlaceholder(false)
                ->live()
                ->required(),
            Select::make('density')
                ->label(fn () => Theme::trans('settings.density.label'))
                ->helperText(fn () => Theme::trans('settings.density.helper'))
                ->options(fn () => [
                    'comfortable' => Theme::trans('settings.density.comfortable'),
                    'compact' => Theme::trans('settings.density.compact'),
                ])
                ->selectablePlaceholder(false)
                ->live()
                ->required(),
            Toggle::make('force_dark')
                ->label(fn () => Theme::trans('settings.force_dark.label'))
                ->helperText(fn () => Theme::trans('settings.force_dark.helper')),
            Toggle::make('glass')
                ->label(fn () => Theme::trans('settings.glass.label'))
                ->helperText(fn () => Theme::trans('settings.glass.helper'))
                ->live(),
            Toggle::make('glow')
                ->label(fn () => Theme::trans('settings.glow.label'))
                ->helperText(fn () => Theme::trans('settings.glow.helper'))
                ->live(),
        ];
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    public static function backgroundFields(): array
    {
        /*
          * Aurora takes a colour too now.
          *
          * The glows over it follow the accent and always did; the base under
          * them was hardcoded, which is why a scheme with a night colour of its
          * own - Nord's polar night, Solarized's base03 - had to give up the
          * backdrop entirely and go flat. Offering the colour here is the whole
          * of what lets those schemes have both.
          */
        $usesColor = fn (Get $get): bool => in_array($get('background'), ['aurora', 'solid', 'gradient'], true);
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
                // Each key on its own trans() call rather than one call with
                // the key chosen inside it: tools/check-lang.js reads a literal
                // sitting next to Theme::trans, and a key it cannot see is a key
                // nothing verifies.
                ->label(fn (Get $get): string => $get('background') === 'aurora'
                    ? Theme::trans('settings.background.base')
                    : Theme::trans('settings.background.color'))
                ->helperText(fn (Get $get): ?string => $get('background') === 'aurora'
                    ? Theme::trans('settings.background.base_helper')
                    : null)
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
    public static function iconFields(): array
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
                // Derived from the limit the unpacker enforces rather than
                // written out again. They were two numbers that had to agree
                // and nothing made them - so the form could start refusing a
                // pack the unpacker would have taken, which is what it did.
                ->maxSize((int) (IconPacks::MAX_ZIP_BYTES / 1024))
                // Kept as the upload rather than stored: it is unpacked on save
                // and the zip itself is of no further use.
                ->storeFiles(false)
                ->visible(fn (Get $get): bool => $get('icon_pack') === IconPacks::CUSTOM)
                ->columnSpanFull(),
            Actions::make([
                Action::make('use_shipped_icons')
                    ->label(fn () => Theme::trans('settings.icons.use_shipped'))
                    ->icon('tabler-wand')
                    ->color('gray')
                    ->visible(fn (): bool => IconPacks::suggestedRows() !== [])
                    ->requiresConfirmation()
                    ->modalDescription(fn () => Theme::trans('settings.icons.use_shipped_confirm'))
                    /*
                     * A button rather than something that happens when the
                     * set is chosen. Filling twelve rows is the thing
                     * somebody wants after picking this set, and doing it
                     * silently on a dropdown change would throw away
                     * whatever they had already set up - which is a poor
                     * way to be helpful.
                     */
                    ->action(function (Set $set): void {
                        $set('icon_pack', IconPacks::SHIPPED);
                        $set('icon_overrides', IconPacks::suggestedRows());
                    }),
            ])->columnSpanFull(),
            Repeater::make('icon_overrides')
                ->label(fn () => Theme::trans('settings.icons.overrides'))
                ->helperText(fn () => Theme::trans('settings.icons.overrides_helper'))
                ->addActionLabel(fn () => Theme::trans('settings.icons.overrides_add'))
                ->schema([
                    Select::make('match')
                        ->label(fn () => Theme::trans('settings.icons.overrides_key'))
                        ->options(fn (): array => Icons::TARGETS)
                        ->searchable()
                        /*
                         * A stored value that is not in the list still shows
                         * itself rather than emptying the row. The list is the
                         * pages Pelican ships; an override saved when this was
                         * a free-text box may name something else, and losing
                         * it silently on the next save would be worse than
                         * showing a name nobody recognises.
                         */
                        ->getOptionLabelUsing(fn (?string $value): ?string => $value === null
                            ? null
                            : (Icons::TARGETS[$value] ?? $value)),
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
                    TextInput::make('url')
                        ->label(fn () => Theme::trans('settings.icons.overrides_url'))
                        ->helperText(fn () => Theme::trans('settings.icons.overrides_url_helper'))
                        ->placeholder('https://cdn.example.com/console.png')
                        ->url()
                        ->maxLength(2048)
                        ->columnSpanFull(),
                    FileUpload::make('file')
                        ->label(fn () => Theme::trans('settings.icons.overrides_file'))
                        ->helperText(fn () => Theme::trans('settings.icons.overrides_file_helper'))
                        ->disk('public')
                        ->directory('theme')
                        ->acceptedFileTypes(NavIcon::MIMES)
                        ->maxFiles(1)
                        ->maxSize(8192)
                        // Its own row. Two pickers side by side read as a
                        // choice; a picker and an upload box side by side read
                        // as a cramped form.
                        ->columnSpanFull(),
                ])
                ->columns(['default' => 1, 'sm' => 2])
                ->reorderable(false)
                ->columnSpanFull(),
        ];
    }

    /**
     * The accent field's helper, with a word about readability when there is
     * one worth saying.
     *
     * Only for the mode the panel actually opens in. A panel set to dark has no
     * use for the news that its orange would be hard to read on white, and
     * saying it anyway would mean the theme's own default accent arrives with a
     * complaint attached - it scores 10.0 dark and 2.7 light. On "system" both
     * are real, so both are checked.
     */
    public static function accentHelper(mixed $accent, mixed $surface): string
    {
        $helper = Theme::trans('settings.accent.helper');

        try {
            $scores = Palette::readability(
                is_string($accent) ? $accent : '',
                is_string($surface) ? $surface : '',
            );

            $modes = match (Mode::current()) {
                Mode::LIGHT => ['light'],
                Mode::SYSTEM => ['dark', 'light'],
                default => ['dark'],
            };

            foreach ($modes as $mode) {
                if ($scores[$mode] >= self::CONTRAST_FLOOR) {
                    continue;
                }

                $helper .= ' ' . Theme::trans('settings.accent.contrast_' . $mode, [
                    'ratio' => number_format($scores[$mode], 1),
                ]);
            }
        } catch (\Throwable) {
            // A colour that could not be measured is not a reason to leave the
            // field without its helper text.
        }

        return $helper;
    }
}
