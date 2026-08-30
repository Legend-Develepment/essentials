<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\IconPacks;
use LegendDevelopment\Theme\Support\NavLinks;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The same reasoning as the announcements: a list of records is a page, not a
 * section in a form of single values.
 *
 * It also belongs beside them rather than inside the theme's settings, because
 * neither of these is about what the panel looks like. One is what it says and
 * the other is where it goes.
 *
 * @property Schema $form
 */
class NavigationLinks extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-link';

    protected static ?string $slug = 'navigation-links';

    /** After the announcements, which are 1. See that page for why not lower. */
    protected static ?int $navigationSort = 2;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return user()?->can(Theme::PERMISSION_VIEW) ?? false;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.navigation-links';
    }

    public function getTitle(): string
    {
        return Theme::trans('navigation.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('navigation.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('navigation.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        // The top block, with Dashboard and Settings - and next to the links it
        // is about to add to that very sidebar.
        return null;
    }

    public function mount(): void
    {
        $this->form->fill(['rows' => NavLinks::rows()]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('rows')
                    ->label('')
                    ->schema(self::fields())
                    ->addActionLabel(fn () => Theme::trans('navigation.add'))
                    ->maxItems(NavLinks::MAX_ROWS)
                    ->reorderable()
                    ->collapsible()
                    ->collapsed()
                    ->cloneable()
                    // The order here is the order in the sidebar, so a folded
                    // row has to say which link it is.
                    ->itemLabel(fn (array $state): ?string => self::summary($state))
                    ->columns(2)
                    ->disabled(fn () => !user()?->can(Theme::PERMISSION_UPDATE)),
            ])
            ->statePath('data');
    }

    /**
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    private static function fields(): array
    {
        return [
            Toggle::make('enabled')
                ->label(fn () => Theme::trans('navigation.enabled'))
                ->default(true)
                ->columnSpanFull(),

            TextInput::make('label')
                ->label(fn () => Theme::trans('navigation.label'))
                ->placeholder('Discord')
                ->maxLength(40)
                ->required()
                ->live(onBlur: true),

            Select::make('icon')
                ->label(fn () => Theme::trans('navigation.icon'))
                ->placeholder(fn () => Theme::trans('settings.icons.overrides_search'))
                ->searchable()
                /*
                 * The same picker the icon overrides use: several thousand
                 * names are searched on the server and drawn with the icon
                 * itself, because a name alone is hard to picture.
                 */
                ->getSearchResultsUsing(fn (string $search): array => IconPacks::search(
                    $search,
                    IconPacks::current(),
                ))
                ->getOptionLabelUsing(fn (?string $value): ?string => $value === null
                    ? null
                    : IconPacks::label($value))
                ->allowHtml(),

            TextInput::make('url')
                ->label(fn () => Theme::trans('navigation.url'))
                ->helperText(fn () => Theme::trans('navigation.url_helper'))
                ->placeholder('https://discord.gg/…')
                ->maxLength(300)
                ->required()
                ->columnSpanFull(),

            Select::make('scope')
                ->label(fn () => Theme::trans('navigation.scope'))
                ->options(fn () => NavLinks::scopeOptions())
                ->default('all')
                ->selectablePlaceholder(false)
                ->required(),

            TextInput::make('group')
                ->label(fn () => Theme::trans('navigation.group'))
                ->helperText(fn () => Theme::trans('navigation.group_helper'))
                ->maxLength(40),

            Toggle::make('new_tab')
                ->label(fn () => Theme::trans('navigation.new_tab'))
                ->default(true)
                ->columnSpanFull(),
        ];
    }

    /**
     * @param  array<string, mixed>  $state
     */
    private static function summary(array $state): ?string
    {
        $label = trim((string) ($state['label'] ?? ''));

        if ($label === '') {
            return null;
        }

        return ($state['enabled'] ?? true)
            ? $label
            : $label . ' — ' . Theme::trans('navigation.off');
    }

    /**
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label(fn () => Theme::trans('page.save'))
                ->icon('tabler-device-floppy')
                ->action('save')
                ->visible(fn () => user()?->can(Theme::PERMISSION_UPDATE) ?? false),
        ];
    }

    public function save(): void
    {
        if (!user()?->can(Theme::PERMISSION_UPDATE)) {
            return;
        }

        try {
            $state = $this->form->getState();

            NavLinks::save(is_array($state['rows'] ?? null) ? $state['rows'] : []);

            // Read back rather than kept: saving drops the rows with no name or
            // no address, and the form should show what is now actually stored.
            $this->form->fill(['rows' => NavLinks::rows()]);

            Notification::make()
                ->title(Theme::trans('navigation.saved'))
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('navigation.failed'))
                ->danger()
                ->send();
        }
    }
}
