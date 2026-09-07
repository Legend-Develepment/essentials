<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

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
use LegendDevelopment\Theme\Support\Attention;
use LegendDevelopment\Theme\Support\Backups as Store;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Which of somebody's own servers needs attention.
 *
 * **Not a second server list**, which is the first thing to be sure of: Pelican's
 * is good, it is already searchable and filterable server side, and there is no
 * hook inside a card. Building another would be the fourth entry on the list of
 * features this plugin undid for duplicating the panel.
 *
 * This asks the question that list cannot: not *what are my servers* but *which
 * of them is behind*. Sorted by the answer rather than by name, so the top row
 * is the thing somebody came to find out. It is the same relationship the admin
 * Backups overview has to Pelican's per-server backup page - and it exists
 * because that overview needs a permission, so the person whose servers they are
 * cannot see it.
 *
 * **Every column is a database column.** No node is contacted and no game server
 * is queried, which is deliberate rather than incidental: a page that lists forty
 * servers and asks each one who is playing opens forty sockets before it draws
 * anything. Who is playing is on the server's own page, where it is one question
 * about one server; whether a machine is answering is the watchdog's, which asks
 * on a timer and tells the owner.
 *
 * No permission of its own, for the same reason the warning above the list has
 * none: it reports on servers somebody can already open, and every row links to
 * Pelican's own page for that server. A permission here would take away a
 * warning rather than a capability.
 */
class MyServers extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-alert-triangle';

    protected static ?string $slug = 'my-servers';

    protected static ?int $navigationSort = 88;

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::MY_BACKUPS);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('myservers.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('myservers.subheading', ['days' => Store::days()]);
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('myservers.nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.my-servers';
    }

    /**
     * How many stopped schedules each server has.
     *
     * One pass over this person's own schedules, kept for the render, rather
     * than a question per row - a table of forty rows asking forty times is the
     * shape of a page that is slow for no reason anybody can see.
     *
     * @return array<int, int>
     */
    public function stopped(): array
    {
        static $held = null;

        if ($held !== null) {
            return $held;
        }

        $out = [];

        foreach (Attention::schedules() as $row) {
            $id = (int) ($row['server_id'] ?? 0);

            if ($id > 0) {
                $out[$id] = ($out[$id] ?? 0) + 1;
            }
        }

        return $held = $out;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Store::query())
            ->defaultPaginationPageOption(25)
            /*
             * Never backed up first, then oldest. Ascending puts null before
             * every date on every database this panel runs on, which is the
             * order somebody wants and not a coincidence worth relying on
             * silently - hence this comment rather than a bare defaultSort.
             */
            ->defaultSort('ld_last', 'asc')
            ->columns([
                TextColumn::make('name')
                    ->label(Theme::trans('myservers.column_server'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                /*
                 * The answer, as a word rather than a date. "Never" and "9 days
                 * ago" are the two things somebody is looking for, and a column
                 * of timestamps makes both of them something to work out.
                 */
                TextColumn::make('ld_last')
                    ->label(Theme::trans('myservers.column_last'))
                    ->sortable()
                    ->badge()
                    ->tooltip(static fn (Server $record): ?string => $record->ld_last)
                    ->formatStateUsing(static function (?string $state): string {
                        if ($state === null) {
                            return Theme::trans('myservers.never');
                        }

                        try {
                            return CarbonImmutable::parse($state)->diffForHumans();
                        } catch (Throwable) {
                            return $state;
                        }
                    })
                    ->color(static fn (Server $record): string => match (Store::stale($record->ld_last)) {
                        null => 'danger',
                        true => 'warning',
                        false => 'success',
                    }),

                TextColumn::make('ld_kept')
                    ->label(Theme::trans('myservers.column_kept'))
                    ->sortable()
                    // Against the server's own limit, because "3" means nothing
                    // and "3 / 3" means the next scheduled one will fail.
                    ->formatStateUsing(static fn (?int $state, Server $record): string => (int) $state
                        . ((int) $record->backup_limit > 0 ? ' / ' . (int) $record->backup_limit : ''))
                    ->color(static fn (?int $state, Server $record): string => (int) $record->backup_limit > 0
                        && (int) $state >= (int) $record->backup_limit ? 'warning' : 'gray'),

                TextColumn::make('id')
                    ->label(Theme::trans('myservers.column_schedules'))
                    ->badge()
                    ->formatStateUsing(fn (Server $record): string => (string) ($this->stopped()[(int) $record->id] ?? 0))
                    ->color(fn (Server $record): string => ($this->stopped()[(int) $record->id] ?? 0) > 0 ? 'danger' : 'gray'),
            ])
            ->filters([
                /*
                 * Filtered in the query rather than on the aliases, the way the
                 * admin overview learned to: a HAVING on an aggregate
                 * sub-select's alias is MySQL being generous about something the
                 * standard forbids, and this panel also runs on PostgreSQL and
                 * SQLite.
                 */
                Filter::make('ld_none')
                    ->label(Theme::trans('myservers.filter_none'))
                    ->query(static fn (Builder $query): Builder => $query->whereDoesntHave(
                        'backups',
                        static fn (Builder $q) => $q->where('is_successful', true),
                    )),

                Filter::make('ld_stale')
                    ->label(Theme::trans('myservers.filter_stale'))
                    ->query(static fn (Builder $query): Builder => $query->whereDoesntHave(
                        'backups',
                        static fn (Builder $q) => $q->where('is_successful', true)
                            ->where('completed_at', '>=', now()->subDays(Store::days())),
                    )),
            ])
            ->recordActions([
                /*
                 * To Pelican's own page for that server, not to a copy of it.
                 * Everything worth doing to a backup already exists there,
                 * complete with the limits and the daemon calls.
                 */
                Action::make('ld_open')
                    ->label(Theme::trans('myservers.open'))
                    ->icon('tabler-external-link')
                    ->color('gray')
                    ->url(static fn (Server $record): string => rtrim(url('/server'), '/')
                        . '/' . $record->uuid_short . '/backups'),
            ])
            ->emptyStateHeading(Theme::trans('myservers.empty'))
            ->emptyStateDescription(Theme::trans('myservers.empty_body'))
            ->emptyStateIcon('tabler-shield-check');
    }
}
