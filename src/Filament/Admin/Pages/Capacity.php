<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use App\Models\Node;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Support\Capacity as Store;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Whether another server fits.
 *
 * Nothing answers that today. Pelican's node list shows a name, an address and
 * a count of servers; the dashboard block this plugin draws shows live host
 * usage, which sounds the same and is a different question - a node can be
 * twenty percent used and completely full, because full is about what has been
 * handed out rather than about what is running.
 *
 * The figures are Pelican's own, from Node::isViable(), which is the method that
 * decides whether a server may be created at all. If this page and that method
 * ever disagree, this page is wrong.
 *
 * The class is Capacity and so is the store behind it, which is why the store is
 * imported as Store - the same shape the backups overview uses.
 */
class Capacity extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-gauge';

    protected static ?string $slug = 'essentials-capacity';

    protected static ?int $navigationSort = 15;

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::CAPACITY);
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('capacity.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('capacity.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('capacity.nav_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name();
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.capacity';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Store::query())
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('name')
                    ->label(Theme::trans('capacity.column_node'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->description(static fn (Node $record): string => Theme::trans(
                        'capacity.servers',
                        ['count' => (int) ($record->servers_count ?? 0)],
                    )),

                /*
                 * The tightest of the three, because that is what fills a node.
                 * isViable() refuses on any one of them, so a node with memory
                 * to spare and no disk left is a full node - and an average
                 * would draw it as comfortable.
                 */
                TextColumn::make('ld_worst')
                    ->label(Theme::trans('capacity.column_fullest'))
                    ->badge()
                    ->state(static fn (Node $record): string => self::percent(Store::worst($record)))
                    ->color(static fn (Node $record): string => Store::colour(Store::worst($record)))
                    ->grow(false),

                /*
                 * Two columns on a phone: the node and how full the fullest of
                 * its resources is. That pair answers "can another server go
                 * here", which is the whole question this page exists for; the
                 * breakdown into memory, disk and processor is what somebody
                 * reads once they have found the row worth reading.
                 */
                self::resource('memory', 'ld_memory', 'memory', 'memory_overallocate')->visibleFrom('md'),
                self::resource('disk', 'ld_disk', 'disk', 'disk_overallocate')->visibleFrom('md'),

                TextColumn::make('ld_cpu')
                    ->label(Theme::trans('capacity.column_cpu'))
                    ->state(static function (Node $record): string {
                        $limit = Store::limit($record->cpu, $record->cpu_overallocate);

                        // Percent of a core rather than MiB, so it gets its own
                        // column instead of the size formatter.
                        return $limit === null
                            ? (int) ($record->ld_cpu ?? 0) . '% / ∞'
                            : (int) ($record->ld_cpu ?? 0) . '% / ' . $limit . '%';
                    })
                    ->color(static fn (Node $record): string => Store::colour(
                        Store::percent($record->cpu, $record->cpu_overallocate, $record->ld_cpu ?? 0),
                    ))
                    ->grow(false)
                    ->visibleFrom('lg'),

                /*
                 * And the servers on it that have run out of something they are
                 * allowed to make - a backup, a database, an allocation. Those
                 * are the three the panel counts rather than measures, so they
                 * are the three it can be certain about.
                 */
                TextColumn::make('ld_at_limit')
                    ->label(Theme::trans('capacity.column_at_limit'))
                    ->state(static function (Node $record): string {
                        $count = Store::atLimit()[(int) $record->id] ?? 0;

                        return $count === 0 ? '-' : (string) $count;
                    })
                    ->color(static fn (Node $record): string => (Store::atLimit()[(int) $record->id] ?? 0) > 0
                        ? 'warning'
                        : 'gray')
                    ->grow(false),
            ])
            ->defaultSort('name')
            ->filters([
                Filter::make('ld_tight')
                    ->label(Theme::trans('capacity.filter_tight'))
                    /*
                     * The comparison is done in the database rather than on the
                     * worked-out percentage, because that percentage is a PHP
                     * value and there is nothing to sort or filter on. It is the
                     * same formula either way: used against capacity times one
                     * plus the overallocation.
                     */
                    ->query(static fn (Builder $query): Builder => $query->where(
                        static fn (Builder $q): Builder => $q
                            ->whereRaw(self::tighter('memory'))
                            ->orWhereRaw(self::tighter('disk'))
                            ->orWhereRaw(self::tighter('cpu')),
                    )),
            ])
            ->recordActions([
                Action::make('ld_open')
                    ->label(Theme::trans('capacity.open'))
                    ->icon('tabler-external-link')
                    ->color('gray')
                    ->url(static fn (Node $record): string => rtrim(url('/admin'), '/')
                        . '/nodes/' . (int) $record->id . '/edit')
                    ->openUrlInNewTab(),
            ]);
    }

    /**
     * One resource column: what is promised, against what may be.
     *
     * @param  string  $key  The translation key and the column name.
     */
    private static function resource(string $key, string $sum, string $capacity, string $over): TextColumn
    {
        return TextColumn::make($sum)
            ->label(Theme::trans('capacity.column_' . $key))
            ->state(static function (Node $record) use ($sum, $capacity, $over): string {
                $limit = Store::limit($record->{$capacity}, $record->{$over});

                return Store::size((int) ($record->{$sum} ?? 0))
                    . ' / ' . ($limit === null ? '∞' : Store::size($limit));
            })
            ->color(static fn (Node $record): string => Store::colour(
                Store::percent($record->{$capacity}, $record->{$over}, $record->{$sum} ?? 0),
            ))
            ->grow(false);
    }

    /** A percentage, or a dash for a resource with no limit. */
    private static function percent(?int $value): string
    {
        return $value === null ? '-' : $value . '%';
    }

    /**
     * The SQL for "this resource is past the tight mark".
     *
     * Written out rather than built from a query builder because it compares
     * one column against an expression over two others, which is the one shape
     * whereColumn cannot say. Every part of it is a column name from this
     * method's own list - nothing here comes from a request.
     */
    private static function tighter(string $resource): string
    {
        $sum = match ($resource) {
            'memory' => 'ld_memory',
            'disk' => 'ld_disk',
            default => 'ld_cpu',
        };

        return '(nodes.' . $resource . ' > 0 AND nodes.' . $resource . '_overallocate >= 0 AND '
            . 'COALESCE(' . $sum . ', 0) >= nodes.' . $resource
            . ' * (1 + nodes.' . $resource . '_overallocate / 100.0) * ' . (Store::TIGHT / 100) . ')';
    }
}
