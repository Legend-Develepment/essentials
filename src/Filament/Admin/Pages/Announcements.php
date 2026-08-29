<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Notice;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Writing an announcement is a job, not a preference, so it gets a page of its
 * own rather than a section halfway down the theme's settings.
 *
 * It also wants a list: one that stays up, one that runs for an hour, one
 * written three days before the maintenance window it is about. That is a list
 * of records with dates on them, which is not a shape the settings page - a
 * form of single values written to .env - can hold.
 *
 * @property Schema $form
 */
class Announcements extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-speakerphone';

    protected static ?string $slug = 'announcements';

    protected static ?int $navigationSort = 11;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return user()?->can(Theme::PERMISSION_VIEW) ?? false;
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.announcements';
    }

    public function getTitle(): string
    {
        return Theme::trans('announcements.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('announcements.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('announcements.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        // Beside the theme's own page, and beside Pelican's advanced pages -
        // but no invented heading if that translation ever goes away.
        return trans()->has('admin/dashboard.advanced') ? trans('admin/dashboard.advanced') : null;
    }

    public function mount(): void
    {
        $this->form->fill(['rows' => Notice::rows()]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('rows')
                    ->label('')
                    ->schema(self::fields())
                    ->addActionLabel(fn () => Theme::trans('announcements.add'))
                    ->maxItems(Notice::MAX_ROWS)
                    ->reorderable()
                    ->collapsible()
                    ->collapsed()
                    ->cloneable()
                    // The message itself, so a folded list reads as what it
                    // announces rather than as "Item 1".
                    ->itemLabel(fn (array $state): ?string => self::summary($state))
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
                ->label(fn () => Theme::trans('announcements.enabled'))
                ->default(true)
                ->columnSpanFull(),

            TextInput::make('text')
                ->label(fn () => Theme::trans('settings.notice.text'))
                ->helperText(fn () => Theme::trans('settings.notice.text_helper'))
                ->maxLength(200)
                ->required()
                ->live(onBlur: true)
                ->columnSpanFull(),

            Select::make('style')
                ->label(fn () => Theme::trans('settings.notice.style'))
                ->options(fn () => Notice::styleOptions())
                ->default('info')
                ->selectablePlaceholder(false)
                ->required(),

            Select::make('scope')
                ->label(fn () => Theme::trans('settings.notice.scope'))
                ->options(fn () => Notice::scopeOptions())
                ->default('all')
                ->selectablePlaceholder(false)
                ->required(),

            /*
             * Both ends optional and independent: up from a date, down at a
             * date, both, or neither. Empty means no bound in that direction,
             * which is what "leave it up" looks like.
             */
            DateTimePicker::make('starts_at')
                ->label(fn () => Theme::trans('announcements.starts_at'))
                ->helperText(fn () => Theme::trans('announcements.starts_at_helper'))
                ->seconds(false)
                ->native(false),

            DateTimePicker::make('ends_at')
                ->label(fn () => Theme::trans('announcements.ends_at'))
                ->helperText(fn () => Theme::trans('announcements.ends_at_helper'))
                ->seconds(false)
                ->native(false)
                ->after('starts_at'),

            TextInput::make('link_label')
                ->label(fn () => Theme::trans('settings.notice.link_label'))
                ->maxLength(40),

            TextInput::make('link_url')
                ->label(fn () => Theme::trans('settings.notice.link_url'))
                ->helperText(fn () => Theme::trans('settings.notice.link_url_helper'))
                ->maxLength(300),

            Toggle::make('dismissible')
                ->label(fn () => Theme::trans('settings.notice.dismissible'))
                ->helperText(fn () => Theme::trans('settings.notice.dismissible_helper'))
                ->default(true)
                ->columnSpanFull(),
        ];
    }

    /**
     * @param  array<string, mixed>  $state
     */
    private static function summary(array $state): ?string
    {
        $text = trim((string) ($state['text'] ?? ''));

        if ($text === '') {
            return null;
        }

        $text = mb_strimwidth($text, 0, 70, '…');

        // Said in the label rather than found by opening it: a list of folded
        // announcements is read to find the one that is off or over.
        if (!($state['enabled'] ?? true)) {
            return $text . ' — ' . Theme::trans('announcements.off');
        }

        return $text;
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

            Notice::save(is_array($state['rows'] ?? null) ? $state['rows'] : []);

            // Read back rather than kept: saving drops the ones with no message
            // and normalises the dates, and the form should show what is now
            // actually stored.
            $this->form->fill(['rows' => Notice::rows()]);

            Notification::make()
                ->title(Theme::trans('announcements.saved'))
                ->success()
                ->send();
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('announcements.failed'))
                ->danger()
                ->send();
        }
    }
}
