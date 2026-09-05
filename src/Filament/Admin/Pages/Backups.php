<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Server;
use BackedEnum;
use Carbon\CarbonImmutable;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Support\Backups as Store;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Which of your servers has no backup.
 *
 * Pelican answers the other question well - it shows a server its own backups -
 * and that is the right page for somebody looking after one server. It is no
 * help at all to somebody looking after forty, whose question is the inverse
 * and whose only way to answer it today is to open forty pages.
 *
 * So this list is sorted by the answer rather than by name: servers that have
 * never been backed up first, then the ones whose last backup is oldest. A page
 * whose top row is the thing you came to find out.
 *
 * Nothing here creates or deletes a backup. Every row links to Pelican's own
 * page for that server, because a second set of actions over the same data
 * would be a second set to keep in step - and Pelican's already handles the
 * locking, the limits and the daemon.
 */
class Backups extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-database-export';

    protected static ?string $slug = 'essentials-backups';

    protected static ?int $navigationSort = 10;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::BACKUPS);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('backups.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('backups.subheading', ['days' => Store::days()]);
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('backups.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.backups';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Store::query())
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('name')
                    ->label(Theme::trans('backups.column_server'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                /*
                 * The answer, as a word rather than a date.
                 *
                 * "Never" and "9 days ago" are the two things somebody is
                 * looking for, and a column of timestamps makes both of them
                 * something to work out. The date is still there as a tooltip
                 * for whoever wants it.
                 */
                TextColumn::make('ld_last')
                    ->label(Theme::trans('backups.column_last'))
                    ->sortable()
                    ->badge()
                    ->tooltip(static fn (Server $record): ?string => $record->ld_last)
                    ->formatStateUsing(static function (?string $state): string {
                        if ($state === null) {
                            return Theme::trans('backups.never');
                        }

                        try {
                            return CarbonImmutable::parse($state)->diffForHumans();
                        } catch (Throwable) {
                            return $state;
                        }
                    })
                    ->color(static function (Server $record): string {
                        $stale = Store::stale($record->ld_last);

                        return match ($stale) {
                            null => 'danger',
                            true => 'warning',
                            false => 'success',
                        };
                    }),

                TextColumn::make('ld_kept')
                    ->label(Theme::trans('backups.column_kept'))
                    ->sortable()
                    // Against the server's own limit, because "3" means nothing
                    // and "3 / 3" means the next scheduled one will fail.
                    ->formatStateUsing(static fn (?int $state, Server $record): string => (int) $state
                        . ((int) $record->backup_limit > 0 ? ' / ' . (int) $record->backup_limit : ''))
                    ->color(static fn (?int $state, Server $record): string => (int) $record->backup_limit > 0
                        && (int) $state >= (int) $record->backup_limit ? 'warning' : 'gray'),

                TextColumn::make('ld_bytes')
                    ->label(Theme::trans('backups.column_size'))
                    ->sortable()
                    ->formatStateUsing(static fn (?int $state): string => Store::size((int) $state)),

                TextColumn::make('ld_failed')
                    ->label(Theme::trans('backups.column_failed'))
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(static fn (?int $state): string => (int) $state === 0 ? '—' : (string) $state)
                    ->color(static fn (?int $state): string => (int) $state > 0 ? 'danger' : 'gray'),
            ])
            ->filters([
                /*
                 * Filtered in the query rather than on the aliases.
                 *
                 * A HAVING on an aggregate sub-select's alias is MySQL being
                 * generous about something the standard forbids, and Pelican
                 * runs on PostgreSQL and SQLite as well. whereDoesntHave and
                 * whereHas say the same thing portably.
                 */
                Filter::make('ld_none')
                    ->label(Theme::trans('backups.filter_none'))
                    ->query(static fn (Builder $query): Builder => $query->whereDoesntHave(
                        'backups',
                        static fn (Builder $q) => $q->where('is_successful', true),
                    )),

                Filter::make('ld_stale')
                    ->label(Theme::trans('backups.filter_stale'))
                    ->query(static fn (Builder $query): Builder => $query->whereDoesntHave(
                        'backups',
                        static fn (Builder $q) => $q->where('is_successful', true)
                            ->where('completed_at', '>=', now()->subDays(Store::days())),
                    )),

                Filter::make('ld_failed')
                    ->label(Theme::trans('backups.filter_failed'))
                    ->query(static fn (Builder $query): Builder => $query->whereHas(
                        'backups',
                        static fn (Builder $q) => $q->where('is_successful', false)
                            ->whereNotNull('completed_at')
                            ->where('completed_at', '>=', now()->subDays(Store::FAILURE_DAYS)),
                    )),
            ])
            ->recordActions([
                /*
                 * To Pelican's own page for that server, not to a copy of it.
                 *
                 * Everything worth doing to a backup - making one, locking it,
                 * restoring, downloading - already exists there, complete with
                 * the limits and the daemon calls. A second set here would be a
                 * second set to keep working.
                 */
                Action::make('ld_open')
                    ->label(Theme::trans('backups.open'))
                    ->icon('tabler-external-link')
                    ->color('gray')
                    ->url(static fn (Server $record): string => rtrim(url('/server'), '/')
                        . '/' . $record->uuid_short . '/backups')
                    ->openUrlInNewTab(),
            ]);
    }
}
