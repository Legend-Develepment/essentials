<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Takings;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The shop in four numbers, and the three short lists that explain them.
 *
 * Every other page in this group is a list of things that happened. This one
 * is the question those lists are read to answer: what came in, what is owed,
 * what is this worth every month, and what needs looking at today. Somebody
 * doing that by exporting the invoices table and adding it up in a spreadsheet
 * is somebody who will do it once a quarter instead of once a week.
 *
 * **First in the group**, because it is the page to open rather than the page
 * to look something up in.
 *
 * Nothing here is stored. Every figure is read from the invoices and the orders
 * on each render - see Shop\Takings - so a number on this page cannot drift
 * from what the tables say, which is what happens to every dashboard that keeps
 * its own copy of a total.
 */
class ShopOverview extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-chart-bar';

    protected static ?string $slug = 'essentials-overview';

    /**
     * What this page has already worked out while drawing itself.
     *
     * The view asks for six things and three of them ask again: allClear() has
     * to know whether the headline, the chasing list and the stock list are all
     * empty before it can say so, and asking is how it finds out. Every one of
     * those calls was a fresh trip to the database, and Takings::all() is ten
     * aggregates. Measured on a live panel: a hundred and seventeen queries to
     * draw one page, a hundred of them this plugin's, where seventeen would do.
     *
     * On the instance rather than on the class, deliberately. A Livewire
     * component is built for one render and thrown away, so this cannot outlive
     * the request it belongs to - which is the whole failing of a static in a
     * queue worker, and the reason Alerts\State had to grow a refresh().
     *
     * @var array<string, mixed>
     */
    private array $asked = [];

    /** Nought, so it sits above the lists it summarises. */
    protected static ?int $navigationSort = 0;

    /**
     * Work this out once while the page is being drawn.
     *
     * @template T
     *
     * @param  callable(): T  $work
     * @return T
     */
    private function once(string $key, callable $work): mixed
    {
        if (!array_key_exists($key, $this->asked)) {
            $this->asked[$key] = $work();
        }

        return $this->asked[$key];
    }

    /**
     * The month, the previous month, what is owed and what is late.
     *
     * @return array<string, mixed>
     */
    private function takings(): array
    {
        return $this->once('takings', static fn (): array => Takings::all());
    }

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::OVERVIEW) && Tables::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public static function shouldRegisterNavigation(): bool
    {
        return self::canAccess();
    }

    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('overview.nav_label');
    }

    public function getTitle(): string
    {
        return Theme::trans('overview.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('overview.subheading');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.overview';
    }

    /**
     * The four figures across the top.
     *
     * Each one carries its own second line rather than a bare number, because
     * a total with nothing beside it is a number somebody has to remember the
     * meaning of. "Turnover" is this month against last; "outstanding" is how
     * much of it is already late.
     *
     * @return array<int, array<string, mixed>>
     */
    public function figures(): array
    {
        $t = $this->takings();
        $currency = $t['currency'];

        $change = Takings::change($t['month'], $t['previous']);

        return [
            [
                'label' => Theme::trans('overview.turnover'),
                'value' => Money::format($t['month'], $currency),
                'note' => $change === null
                    ? Theme::trans('overview.turnover_first')
                    : Theme::trans($change < 0 ? 'overview.turnover_down' : 'overview.turnover_up', [
                        'percent' => abs($change),
                        'amount' => Money::format($t['previous'], $currency),
                    ]),
                'tone' => $change !== null && $change < 0 ? 'warning' : 'success',
                'icon' => 'tabler-cash',
                /*
                 * The one figure with a direction, so it gets the arrow. The
                 * others are a state rather than a movement - "what is owed" is
                 * not up or down on anything.
                 */
                'trend' => $change === null ? null : ($change < 0 ? 'down' : 'up'),
                'trend_text' => $change === null ? null : ($change > 0 ? '+' : '') . $change . '%',
            ],
            [
                'label' => Theme::trans('overview.recurring'),
                'value' => Money::format($t['recurring'], $currency),
                'note' => Theme::trans('overview.recurring_note', ['count' => $t['services']]),
                'tone' => 'accent',
                'icon' => 'tabler-repeat',
                'trend' => null,
                'trend_text' => null,
            ],
            [
                'label' => Theme::trans('overview.outstanding'),
                'value' => Money::format($t['outstanding'], $currency),
                'note' => $t['overdue'] > 0
                    ? Theme::trans('overview.outstanding_late', [
                        'amount' => Money::format($t['overdue'], $currency),
                    ])
                    : Theme::trans('overview.outstanding_none'),
                'tone' => $t['overdue'] > 0 ? 'danger' : 'plain',
                'icon' => 'tabler-file-invoice',
                'trend' => null,
                'trend_text' => null,
            ],
            [
                'label' => Theme::trans('overview.services'),
                'value' => (string) $t['services'],
                'note' => $t['ending'] > 0
                    ? Theme::choice('overview.services_ending', (int) $t['ending'])
                    : Theme::trans('overview.services_none_ending'),
                'tone' => $t['ending'] > 0 ? 'warning' : 'plain',
                'icon' => 'tabler-server-2',
                'trend' => null,
                'trend_text' => null,
            ],
        ];
    }

    /**
     * A year of months, as bars measured against the best of them.
     *
     * Heights as a percentage of the tallest rather than of some fixed ceiling,
     * because a shop taking fifty euros a month and one taking five thousand
     * both want to see their own shape. A month at nothing still gets a sliver,
     * so the row reads as twelve months rather than as nine.
     *
     * @return array<string, mixed>
     */
    public function chart(): array
    {
        $currency = $this->takings()['currency'];
        $months = Takings::history();

        $best = 0;

        foreach ($months as $month) {
            $best = max($best, (int) $month['total']);
        }

        $bars = [];
        $thisMonth = now()->format('Y-m');

        foreach ($months as $month) {
            $total = (int) $month['total'];

            $bars[] = [
                'label' => (string) $month['label'],
                'amount' => Money::format($total, $currency),
                // Two percent for an empty month: a bar you can see is a month
                // you can hover, and a month you can hover is one that can tell
                // you it took nothing.
                'height' => $best > 0 ? max(2, (int) round($total / $best * 100)) : 2,
                'now' => $month['key'] === $thisMonth,
                'empty' => $total === 0,
            ];
        }

        return ['bars' => $bars, 'any' => $best > 0];
    }

    /**
     * Whether there is genuinely nothing to look at.
     *
     * A page that draws four numbers and then stops leaves somebody wondering
     * whether the lists failed to load. One sentence saying everything is
     * settled is shorter than that doubt.
     */
    public function allClear(): bool
    {
        return $this->headline() === null && $this->chasing() === [] && $this->stock() === [];
    }

    /** The one sentence worth putting above everything, when there is one. */
    public function headline(): ?string
    {
        return $this->once('headline', function (): ?string {
            $t = $this->takings();

            return Takings::headline($t['pending'], $t['overdue']);
        });
    }

    /**
     * Invoices to chase, soonest first.
     *
     * @return array<int, array<string, mixed>>
     */
    public function chasing(): array
    {
        return $this->once('chasing', function (): array {
            $currency = $this->takings()['currency'];
            $out = [];

            // Out of what was already fetched: all() carries this list.
            foreach ($this->takings()['soon'] as $invoice) {
                $due = $invoice->due_at;
                $late = $due !== null && $due->isPast();

                $out[] = [
                    'number' => (string) $invoice->number,
                    'who' => (string) ($invoice->customer_name !== '' ? $invoice->customer_name : $invoice->user?->username),
                    'amount' => Money::format((int) $invoice->total, $currency),
                    'when' => $due?->toFormattedDateString() ?? '',
                    'late' => $late,
                    'url' => $this->invoiceUrl($invoice),
                ];
            }

            return $out;
        });
    }

    /** The printable invoice, when this reader may open one. */
    private function invoiceUrl(Invoice $invoice): ?string
    {
        try {
            return Features::maySee(Features::INVOICES)
                ? url('/essentials/invoice/' . (int) $invoice->id)
                : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Packages about to run out, or already out.
     *
     * @return array<int, array<string, mixed>>
     */
    public function stock(): array
    {
        return $this->once('stock', function (): array {
            $out = [];

            // The same list all() already asked for, rather than a second walk
            // over every live package.
            foreach ($this->takings()['low'] as $row) {
                $out[] = [
                    'name' => $row['name'],
                    'note' => $row['left'] === 0
                        ? Theme::trans('overview.stock_gone')
                        : Theme::trans('overview.stock_left', ['count' => $row['left']]),
                    'gone' => $row['left'] === 0,
                ];
            }

            return $out;
        });
    }

    /** Where the numbers came from, for somebody who wants the rows. */
    public function links(): array
    {
        $out = [];

        foreach ([
            [Features::ORDERS, ShopOrders::class, 'overview.to_orders'],
            [Features::INVOICES, ShopInvoices::class, 'overview.to_invoices'],
            [Features::CUSTOMERS, ShopCustomers::class, 'overview.to_customers'],
            [Features::PACKAGES, ShopPackages::class, 'overview.to_packages'],
        ] as [$feature, $page, $key]) {
            try {
                if (!Features::maySee($feature) || !$page::canAccess()) {
                    continue;
                }

                $out[] = ['label' => Theme::trans($key), 'url' => $page::getUrl()];
            } catch (Throwable) {
                // A page that will not answer for its own address is left out
                // rather than drawn as a link to nowhere.
            }
        }

        return $out;
    }
}
