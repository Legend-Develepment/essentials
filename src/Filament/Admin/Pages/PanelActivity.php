<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\ActivityLog;
use App\Models\Server;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Support\Activity;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What happened on this panel.
 *
 * Pelican logs every event panel-wide and shows it only per server. That is the
 * right page for one server and useless for forty: "who deleted that" is a
 * question about the panel, and answering it today means opening every server
 * in turn.
 *
 * So the same data, asked the other way round. Newest first, because the
 * question is nearly always about the last hour rather than about last month.
 *
 * The name is PanelActivity rather than Activity, and that is not preference:
 * Pelican already has an App\Filament\Server\Resources\Activities and this
 * plugin already has a Support\Activity behind this page. One short name
 * meaning two things is the fault tools/check-classes.js exists to catch.
 */
class PanelActivity extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-history';

    protected static ?string $slug = 'essentials-activity';

    protected static ?int $navigationSort = 13;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::ACTIVITY);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('activity.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('activity.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('activity.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.activity';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Activity::query())
            ->defaultPaginationPageOption(25)
            ->paginated([25, 50, 100])
            ->defaultSort('timestamp', 'desc')
            ->columns([
                /*
                 * The sentence Pelican would have written, on Pelican's own
                 * page, for this line.
                 *
                 * html() because those sentences carry markup - "Deleted API
                 * key <b>:identifier</b>" - and the values filled into them
                 * have already been stripped of tags by wrapProperties(). That
                 * is the same trust Pelican's own activity page accepts, and a
                 * second set of sentences for every event the panel can log is
                 * not a thing worth maintaining.
                 */
                TextColumn::make('event')
                    ->label(Theme::trans('activity.column_what'))
                    ->html()
                    ->wrap()
                    ->formatStateUsing(static fn (ActivityLog $record): string => Activity::label($record))
                    // The raw key underneath, because the sentence says what
                    // happened and the key says which event it was - and the
                    // key is what you filter on.
                    ->description(static fn (ActivityLog $record): string => (string) $record->event),

                TextColumn::make('actor_id')
                    ->label(Theme::trans('activity.column_who'))
                    ->formatStateUsing(static fn (ActivityLog $record): string => Activity::who($record))
                    // Through the model's own getIp(), which answers null unless
                    // the reader holds Pelican's seeIps permission. Reading the
                    // column here would publish what the panel hides.
                    ->tooltip(static fn (ActivityLog $record): ?string => Activity::ip($record))
                    ->grow(false),

                TextColumn::make('ld_server')
                    ->label(Theme::trans('activity.column_where'))
                    ->state(static function (ActivityLog $record): string {
                        $server = Activity::serverOf($record);

                        // A dash rather than "the panel": most lines are about a
                        // server, so the ones that are not read better as an
                        // absence than as a word repeated down the column.
                        return $server === null ? '—' : (string) $server->name;
                    })
                    ->grow(false),

                TextColumn::make('timestamp')
                    ->label(Theme::trans('activity.column_when'))
                    ->since()
                    ->tooltip(static fn (ActivityLog $record): ?string => $record->timestamp?->toDayDateTimeString())
                    ->sortable()
                    ->grow(false),
            ])
            ->filters([
                /*
                 * Two pickers and three switches, and the split is about what
                 * can be checked rather than about what would be nicest.
                 *
                 * The two pickers name real columns, which is the shape
                 * Pelican's own activity page uses and the only shape a
                 * SelectFilter is certain to take: whether SelectFilter honours
                 * a custom query() is not something this codebase can verify
                 * against a vendor directory it does not have, and a filter that
                 * quietly fell back to `where('ld_server', 7)` would be a 500
                 * the first time somebody used it.
                 *
                 * The three switches are Filter with query(), which the backups
                 * overview already proves. Between them they answer the
                 * questions a picker would have: which lines are about a server,
                 * which are about the panel, and what happened today.
                 */
                SelectFilter::make('event')
                    ->label(Theme::trans('activity.filter_event'))
                    ->options(fn (): array => Activity::eventOptions())
                    ->searchable(),

                SelectFilter::make('actor_id')
                    ->label(Theme::trans('activity.filter_who'))
                    ->options(fn (): array => Activity::actorOptions())
                    ->searchable(),

                Filter::make('ld_today')
                    ->label(Theme::trans('activity.filter_today'))
                    ->query(static fn (Builder $query): Builder => $query
                        ->where('timestamp', '>=', now()->subDay())),

                /*
                 * Which server a line is about lives in a pivot rather than in
                 * a column, because one line can be about several things at
                 * once - a subuser event names the subuser and the server both.
                 */
                Filter::make('ld_servers')
                    ->label(Theme::trans('activity.filter_servers'))
                    ->query(static fn (Builder $query): Builder => $query->whereHas(
                        'subjects',
                        static fn (Builder $subject): Builder => $subject
                            ->where('subject_type', Activity::serverType()),
                    )),

                Filter::make('ld_panel')
                    ->label(Theme::trans('activity.filter_panel'))
                    ->query(static fn (Builder $query): Builder => $query->whereDoesntHave(
                        'subjects',
                        static fn (Builder $subject): Builder => $subject
                            ->where('subject_type', Activity::serverType()),
                    )),
            ])
            ->recordActions([
                /*
                 * To Pelican's own page for that server, not to a copy of it.
                 *
                 * The same choice the backups overview makes: everything worth
                 * doing about a line - reading its full metadata, seeing it in
                 * context - is on the server's own Activity tab, and a second
                 * one here would be a second one to keep working.
                 */
                Action::make('ld_open')
                    ->label(Theme::trans('activity.open'))
                    ->icon('tabler-external-link')
                    ->color('gray')
                    ->visible(static fn (ActivityLog $record): bool => Activity::serverOf($record) instanceof Server)
                    ->url(static function (ActivityLog $record): string {
                        $server = Activity::serverOf($record);

                        return $server === null
                            ? '#'
                            : rtrim(url('/server'), '/') . '/' . $server->uuid_short . '/activity';
                    })
                    ->openUrlInNewTab(),
            ]);
    }
}
