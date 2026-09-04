<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Egg;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use LegendDevelopment\Theme\Jobs\FetchArtwork;
use LegendDevelopment\Theme\Support\Artwork\Artwork;
use LegendDevelopment\Theme\Support\Artwork\Igdb;
use LegendDevelopment\Theme\Support\Artwork\Steam;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Every egg, and whether it has a picture.
 *
 * A fresh Pelican draws the same grey bird on every server card, and the
 * artwork for nearly all of them exists somewhere public. This is the page that
 * goes and gets it.
 *
 * A real table rather than the hand-built lists elsewhere in this plugin, and
 * the difference is that these are real records. The Minecraft pages draw JSON
 * read off a daemon, where a table builder would buy sorting and filtering that
 * mean nothing; eggs are rows, a panel can have four hundred of them, and
 * search and pagination are exactly what somebody wants.
 */
class EggArtwork extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-photo';

    protected static ?string $slug = 'egg-artwork';

    protected static ?int $navigationSort = 60;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::ARTWORK);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('artwork.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('artwork.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('artwork.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        // Every page this plugin adds sits under one heading, named after the
        // plugin itself - read from plugin.json, so renaming the plugin renames
        // the heading rather than leaving five classes saying the old one.
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.egg-artwork';
    }

    /** Whether this viewer may change anything, rather than only look. */
    private function mayEdit(): bool
    {
        try {
            return Features::mayManage(Features::ARTWORK);
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * The IGDB credentials, on the page they are for.
     *
     * Not in the main settings form, and that is the same argument as the icon
     * upload: a setting belongs where the thing it configures is, not three
     * pages away under a heading somebody has to guess at. Anyone standing here
     * looking at four hundred eggs with no artwork is exactly the person who
     * needs to know IGDB exists and what it costs to switch on.
     *
     * @return array<int, Action>
     */
    protected function getHeaderActions(): array
    {
        if (!$this->mayEdit()) {
            return [];
        }

        return [
            Action::make('ld_igdb_keys')
                ->label(Theme::trans('artwork.credentials'))
                ->icon('tabler-key')
                ->color('gray')
                ->modalDescription(Theme::trans('artwork.credentials_helper'))
                ->fillForm(static fn (): array => Settings::artworkData())
                ->schema([
                    Section::make(Theme::trans('artwork.credentials'))
                        ->description(Theme::trans('artwork.credentials_where'))
                        ->columns(2)
                        ->schema([
                            TextInput::make('igdb_client_id')
                                ->label(Theme::trans('artwork.client_id'))
                                ->maxLength(128)
                                // Revealable rather than plain: these are
                                // pasted from another window and a field that
                                // cannot be read back is a field nobody can
                                // check they pasted correctly.
                                ->password()
                                ->revealable(),
                            TextInput::make('igdb_client_secret')
                                ->label(Theme::trans('artwork.client_secret'))
                                ->maxLength(128)
                                ->password()
                                ->revealable(),
                        ]),
                ])
                ->action(function (array $data): void {
                    abort_unless(Features::mayManage(Features::ARTWORK), 403);

                    try {
                        Settings::persistArtwork($data);

                        // The held token belongs to the old credentials. Left
                        // in place, changing a key would appear to do nothing
                        // until the cache expired a day later.
                        Igdb::forget();
                    } catch (Throwable $exception) {
                        report($exception);

                        Notification::make()
                            ->title(Theme::trans('artwork.credentials_failed'))
                            ->body($exception->getMessage())
                            ->danger()
                            ->persistent()
                            ->send();

                        return;
                    }

                    Notification::make()
                        ->title(Theme::trans('artwork.credentials_saved'))
                        ->success()
                        ->send();
                }),
        ];
    }

    public function table(Table $table): Table
    {
        $editable = $this->mayEdit();

        return $table
            ->query(Egg::query())
            ->defaultPaginationPageOption(25)
            ->columns([
                /*
                 * No fallback picture, deliberately.
                 *
                 * An empty cell is the answer to the question this page exists
                 * to ask. Drawing Pelican's own bird here would make a row with
                 * no artwork look like a row with artwork, which is the one
                 * distinction the whole table is for.
                 */
                ImageColumn::make('icon')
                    ->label('')
                    ->imageSize(40)
                    ->getStateUsing(static fn (Egg $record): ?string => Artwork::hasImage($record) ? $record->icon : null),

                TextColumn::make('name')
                    ->label(Theme::trans('artwork.column_name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('ld_steam')
                    ->label(Theme::trans('artwork.column_steam'))
                    ->getStateUsing(static function (Egg $record): string {
                        $id = Artwork::steamAppId($record);

                        return $id === null ? '—' : (string) $id;
                    }),

                TextColumn::make('ld_locked')
                    ->label(Theme::trans('artwork.column_locked'))
                    ->badge()
                    ->getStateUsing(static fn (Egg $record): string => Artwork::isProtected($record)
                        ? Theme::trans('artwork.locked')
                        : Theme::trans('artwork.unlocked'))
                    ->color(static fn (Egg $record): string => Artwork::isProtected($record) ? 'success' : 'gray'),
            ])
            ->recordActions($editable ? [
                Action::make('ld_steam')
                    ->label(Theme::trans('artwork.fetch_steam'))
                    ->icon('tabler-brand-steam')
                    ->color('gray')
                    ->schema([
                        TextInput::make('app_id')
                            ->label(Theme::trans('artwork.app_id'))
                            ->helperText(Theme::trans('artwork.app_id_helper'))
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->default(static fn (Egg $record): ?int => Artwork::steamAppId($record)),
                    ])
                    ->action(function (Egg $record, array $data): void {
                        $this->report(Steam::byAppId($record, (int) ($data['app_id'] ?? 0)));
                    }),

                Action::make('ld_igdb')
                    ->label(Theme::trans('artwork.fetch_igdb'))
                    ->icon('tabler-device-gamepad-2')
                    ->color('gray')
                    // Not merely disabled: with no credentials this cannot work
                    // at all, and an action that explains why it is greyed out
                    // is a worse answer than one that is not offered.
                    ->visible(static fn (): bool => Igdb::configured())
                    ->schema([
                        TextInput::make('term')
                            ->label(Theme::trans('artwork.search_term'))
                            ->helperText(Theme::trans('artwork.search_term_helper'))
                            ->required()
                            ->maxLength(120)
                            ->default(static fn (Egg $record): string => (string) $record->name),
                    ])
                    ->action(function (Egg $record, array $data): void {
                        $this->report(Igdb::byName($record, (string) ($data['term'] ?? '')));
                    }),

                Action::make('ld_lock')
                    ->label(static fn (Egg $record): string => Artwork::isProtected($record)
                        ? Theme::trans('artwork.unlock')
                        : Theme::trans('artwork.lock'))
                    ->icon(static fn (Egg $record): string => Artwork::isProtected($record)
                        ? 'tabler-lock-open'
                        : 'tabler-lock')
                    ->color(static fn (Egg $record): string => Artwork::isProtected($record) ? 'warning' : 'success')
                    ->action(function (Egg $record): void {
                        $locked = Artwork::isProtected($record);

                        $locked ? Artwork::unprotect($record) : Artwork::protect($record);

                        Notification::make()
                            ->title(Theme::trans($locked ? 'artwork.unlocked_done' : 'artwork.locked_done'))
                            ->success()
                            ->send();
                    }),

                Action::make('ld_clear')
                    ->label(Theme::trans('artwork.clear'))
                    ->icon('tabler-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans('artwork.clear_confirm'))
                    ->action(function (Egg $record): void {
                        Artwork::clear($record);

                        Notification::make()
                            ->title(Theme::trans('artwork.cleared'))
                            ->success()
                            ->send();
                    }),
            ] : [])
            ->toolbarActions($editable ? [
                Action::make('ld_bulk')
                    ->label(Theme::trans('artwork.bulk'))
                    ->icon('tabler-download')
                    ->requiresConfirmation()
                    ->modalDescription(Theme::trans(
                        Igdb::configured() ? 'artwork.bulk_confirm_both' : 'artwork.bulk_confirm_steam',
                    ))
                    ->action(fn () => $this->bulk()),
            ] : []);
    }

    /**
     * Hand the whole library to the queue.
     *
     * Not done here, and that is the one real departure from the plugin this
     * grew out of. Four hundred eggs at two network calls each is twenty
     * minutes; PHP's own time limit ends that long before the eggs do, and what
     * is left is an unfinished run and no way to know where it stopped.
     */
    private function bulk(): void
    {
        try {
            FetchArtwork::dispatch(
                user()?->id === null ? null : (int) user()->id,
                Igdb::configured(),
            );
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('artwork.bulk_failed'))
                ->body(Theme::trans('artwork.bulk_failed_queue'))
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('artwork.bulk_started'))
            ->body(Theme::trans('artwork.bulk_started_body'))
            ->success()
            ->send();
    }

    /**
     * One outcome, said in words.
     *
     * The support classes answer with null or a short reason, so the reason is
     * a translation key and the page never has to know what went wrong - only
     * that something did, and what it is called. A fetch that failed because
     * the id was a typo and one that failed because the disk is full should not
     * both say "failed".
     */
    private function report(?string $problem): void
    {
        if ($problem === null) {
            Notification::make()
                ->title(Theme::trans('artwork.fetched'))
                ->success()
                ->send();

            return;
        }

        $why = match ($problem) {
            'bad_id' => Theme::trans('artwork.why_bad_id'),
            'not_found' => Theme::trans('artwork.why_not_found'),
            'no_match' => Theme::trans('artwork.why_no_match'),
            'no_name' => Theme::trans('artwork.why_no_name'),
            'no_token' => Theme::trans('artwork.why_no_token'),
            'not_configured' => Theme::trans('artwork.why_not_configured'),
            'empty' => Theme::trans('artwork.why_empty'),
            'large' => Theme::trans('artwork.why_large'),
            'not_an_image' => Theme::trans('artwork.why_not_an_image'),
            'wrong_format' => Theme::trans('artwork.why_wrong_format'),
            'unwritable' => Theme::trans('artwork.why_unwritable'),
            default => Theme::trans('artwork.why_unknown'),
        };

        Notification::make()
            ->title(Theme::trans('artwork.failed'))
            ->body($why)
            ->danger()
            ->send();
    }
}
