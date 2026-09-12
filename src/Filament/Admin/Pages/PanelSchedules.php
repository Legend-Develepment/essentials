<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Schedule;
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
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Schedules;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Which scheduled task has stopped working.
 *
 * The third page in the family the backups overview started, and the one whose
 * column is a verdict rather than a figure. Pelican shows schedules per server
 * and its own status enum has three states, none of which is "this stopped":
 * a run that crashed part way stays Processing for ever and is drawn the same
 * as one running right now, and a schedule whose time passed hours ago because
 * the cron died is still called Active.
 *
 * So the answer comes first and the rows are sorted by it. Nothing here edits,
 * triggers or deletes a schedule - every row goes to Pelican's own page for that
 * server, which owns all of it and the cron with it.
 *
 * The name is PanelSchedules for the reason PanelActivity is: Pelican has a
 * Schedules resource and this plugin has a Support\Schedules behind this page.
 */
class PanelSchedules extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-clock-play';

    protected static ?string $slug = 'essentials-schedules';

    protected static ?int $navigationSort = 14;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::SCHEDULES);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('schedules.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('schedules.subheading', ['hours' => Schedules::STUCK_HOURS]);
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('schedules.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.schedules';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Schedules::query())
            ->defaultPaginationPageOption(25)
            ->paginated([25, 50, 100])
            ->columns([
                /*
                 * The answer, first and as a word.
                 *
                 * Sorted on next_run_at rather than on the verdict itself,
                 * because the verdict is worked out per row in PHP and a
                 * database cannot order by it. Oldest next run first puts the
                 * overdue at the top, which is most of the same thing - and the
                 * filters below are the exact version.
                 */
                TextColumn::make('ld_verdict')
                    ->label(Theme::trans('schedules.column_state'))
                    ->badge()
                    ->state(static fn (Schedule $record): string => Theme::trans(
                        'schedules.state_' . Schedules::verdict($record),
                    ))
                    ->color(static fn (Schedule $record): string => Schedules::colour(
                        Schedules::verdict($record),
                    ))
                    ->grow(false),

                TextColumn::make('name')
                    ->label(Theme::trans('schedules.column_name'))
                    ->searchable()
                    ->weight('medium')
                    // A schedule with no name is legal and common - Pelican
                    // defaults it to null - so the cron line stands in.
                    ->formatStateUsing(static fn (?string $state, Schedule $record): string => $state !== null
                        && trim($state) !== ''
                            ? $state
                            : Schedules::cron($record))
                    ->description(static fn (Schedule $record): string => Schedules::cron($record)),

                TextColumn::make('server.name')
                    ->label(Theme::trans('schedules.column_server'))
                    ->searchable()
                    ->grow(false)
                    /*
                     * Three columns on a phone, not five. The verdict and the
                     * name are what somebody opened this page for; which server
                     * it belongs to usually reads as a repeat of the schedule's
                     * own name, and when it last ran is history.
                     */
                    ->visibleFrom('md'),

                TextColumn::make('last_run_at')
                    ->label(Theme::trans('schedules.column_last'))
                    ->sortable()
                    ->formatStateUsing(static fn (?string $state): string => self::ago($state))
                    ->tooltip(static fn (?string $state): ?string => $state)
                    ->grow(false)

                    ->visibleFrom('lg'),

                TextColumn::make('next_run_at')
                    ->label(Theme::trans('schedules.column_next'))
                    ->sortable()
                    ->formatStateUsing(static fn (?string $state): string => self::ago($state))
                    ->tooltip(static fn (?string $state): ?string => $state)
                    ->grow(false),
            ])
            // Oldest next run first, which puts what has been waiting longest
            // at the top before anybody touches a filter.
            ->defaultSort('next_run_at', 'asc')
            ->filters([
                /*
                 * Filter with query(), which the backups overview proves. Each
                 * one is the database half of a verdict - the exact test is in
                 * Schedules::verdict(), and these narrow to the rows it could
                 * possibly apply to.
                 */
                Filter::make('ld_stuck')
                    ->label(Theme::trans('schedules.filter_stuck'))
                    ->query(static fn (Builder $query): Builder => $query
                        ->where('is_active', true)
                        ->where('is_processing', true)
                        ->where(static fn (Builder $q): Builder => $q
                            ->whereNull('last_run_at')
                            ->orWhere('last_run_at', '<', now()->subHours(Schedules::STUCK_HOURS)))),

                Filter::make('ld_overdue')
                    ->label(Theme::trans('schedules.filter_overdue'))
                    ->query(static fn (Builder $query): Builder => $query
                        ->where('is_active', true)
                        ->where('is_processing', false)
                        ->whereNotNull('next_run_at')
                        ->where('next_run_at', '<', now()->subMinutes(Schedules::OVERDUE_MINUTES))),

                Filter::make('ld_never')
                    ->label(Theme::trans('schedules.filter_never'))
                    ->query(static fn (Builder $query): Builder => $query
                        ->where('is_active', true)
                        ->whereNull('last_run_at')),

                Filter::make('ld_off')
                    ->label(Theme::trans('schedules.filter_off'))
                    ->query(static fn (Builder $query): Builder => $query->where('is_active', false)),
            ])
            ->recordActions([
                Action::make('ld_open')
                    ->label(Theme::trans('schedules.open'))
                    ->icon('tabler-external-link')
                    ->color('gray')
                    ->url(static function (Schedule $record): string {
                        $short = $record->server->uuid_short ?? null;

                        // schedules, plural, for the reason the activity link
                        // records at length: Filament builds a resource address
                        // from its class name pluralised and kebabed.
                        return $short === null
                            ? '#'
                            : rtrim(url('/server'), '/') . '/' . $short . '/schedules';
                    })
                    ->openUrlInNewTab(),
            ]);
    }

    /**
     * A date as "9 days ago", or a dash.
     *
     * The same choice the backups overview makes: "never" and "9 days ago" are
     * the two things somebody is looking for, and a column of timestamps makes
     * both of them something to work out. The date stays as a tooltip.
     */
    private static function ago(?string $state): string
    {
        if ($state === null || $state === '') {
            return '-';
        }

        try {
            return CarbonImmutable::parse($state)->diffForHumans();
        } catch (Throwable) {
            return $state;
        }
    }
}
