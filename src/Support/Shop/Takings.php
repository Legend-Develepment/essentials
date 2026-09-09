<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * How the shop is doing, in the four numbers somebody actually wants.
 *
 * Every other page here is a list of things that happened: orders, invoices,
 * payments, one row each. None of them answers "how much came in this month",
 * "how much is owed", "what is this worth every month" or "what is about to
 * stop" - and those are the questions somebody running a shop asks first and
 * currently answers by exporting a table.
 *
 * **Read, never written.** Nothing here caches a total in a column. Every
 * figure is a query over the invoices and the orders as they stand, so a
 * number on this page cannot drift away from what the tables say - which is the
 * failure mode of every dashboard that stores its own copy.
 *
 * **Paid means paid.** Turnover counts invoices in the paid state by the day
 * they were paid, not by the day they were written. An invoice written in March
 * and settled in April is April's money, because that is when it arrived.
 *
 * Every method answers zero rather than throwing. A shop page that will not
 * draw because one query failed tells an administrator less than a row of
 * zeroes and a working page around it.
 */
class Takings
{
    /** How far ahead "due soon" looks, and how many rows any list here holds. */
    public const SOON = 14;

    public const ROWS = 8;

    /** How many months the chart looks back over, this one included. */
    public const MONTHS = 12;

    /**
     * Everything the overview shows, in one call.
     *
     * One method rather than eight, because the page draws them together and
     * eight round trips to build one screen is eight chances for half of it to
     * disagree with the other half.
     *
     * @return array<string, mixed>
     */
    public static function all(): array
    {
        $currency = Packages::currency();

        return [
            'currency' => $currency,
            'month' => self::paidBetween(self::monthStart(), now()),
            'previous' => self::paidBetween(self::monthStart()->subMonthNoOverflow(), self::monthStart()),
            'outstanding' => self::outstanding(),
            'overdue' => self::overdue(),
            'recurring' => self::recurring(),
            'services' => self::services(),
            'ending' => self::ending(),
            'pending' => self::pending(),
            'soon' => self::dueSoon(),
            'low' => self::lowStock(),
        ];
    }

    /**
     * What was settled in each of the last twelve months, oldest first.
     *
     * The four figures at the top of the page say what is true today and
     * nothing about whether that is good. A year of months beside them is the
     * cheapest thing that answers it: one bad month reads as one bad month
     * rather than as a business in trouble, and three in a row reads as three
     * in a row.
     *
     * One query rather than twelve. Grouped in PHP after a single pass over
     * the paid invoices of that year, because a date_format() written for
     * MySQL is a date_format() that is wrong on the panel running SQLite.
     *
     * @return array<int, array{key: string, label: string, total: int}>
     */
    public static function history(): array
    {
        $start = now()->startOfMonth()->subMonthsNoOverflow(self::MONTHS - 1);

        // Every month in the window, in order and empty, so a month with no
        // sales is a gap in the chart rather than a month that is missing.
        $months = [];

        for ($i = 0; $i < self::MONTHS; $i++) {
            $when = $start->copy()->addMonthsNoOverflow($i);

            $months[$when->format('Y-m')] = [
                'key' => $when->format('Y-m'),
                'label' => $when->translatedFormat('M'),
                'total' => 0,
            ];
        }

        try {
            $paid = Invoice::query()
                ->where('state', Invoice::PAID)
                ->whereNotNull('paid_at')
                ->where('paid_at', '>=', $start)
                ->get(['paid_at', 'total']);

            foreach ($paid as $invoice) {
                $when = $invoice->paid_at;

                if (!$when instanceof Carbon) {
                    continue;
                }

                $key = $when->format('Y-m');

                if (array_key_exists($key, $months)) {
                    $months[$key]['total'] += max(0, (int) $invoice->total);
                }
            }
        } catch (Throwable) {
            // An empty year draws an empty chart, which says the same thing a
            // missing one would and takes no page down.
        }

        return array_values($months);
    }

    /** The first moment of this month, in the panel's own timezone. */
    private static function monthStart(): Carbon
    {
        return now()->startOfMonth();
    }

    /**
     * What was actually settled in a window.
     *
     * By paid_at, which is why this takes two dates rather than a month: the
     * same question is asked of this month and of the one before it, and the
     * comparison is the only thing that makes a number mean anything.
     */
    public static function paidBetween(Carbon $from, Carbon $to): int
    {
        try {
            return (int) Invoice::query()
                ->where('state', Invoice::PAID)
                ->whereNotNull('paid_at')
                ->where('paid_at', '>=', $from)
                ->where('paid_at', '<', $to)
                ->sum('total');
        } catch (Throwable) {
            return 0;
        }
    }

    /** Everything invoiced and not yet paid, cancelled invoices excluded. */
    public static function outstanding(): int
    {
        try {
            return (int) Invoice::query()->where('state', Invoice::UNPAID)->sum('total');
        } catch (Throwable) {
            return 0;
        }
    }

    /** The part of that which is already past its due date. */
    public static function overdue(): int
    {
        try {
            return (int) Invoice::query()
                ->where('state', Invoice::UNPAID)
                ->whereNotNull('due_at')
                ->where('due_at', '<', now())
                ->sum('total');
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * What the live services are worth every month.
     *
     * Each order's own price, brought to a monthly figure by its period - a
     * yearly service is a twelfth of its price each month, a quarterly one a
     * third. One-off orders are worth nothing here on purpose: they were paid
     * once and they are not income next month.
     *
     * Summed in PHP rather than in SQL. The arithmetic is four cases and the
     * rows are the live orders of one panel, and a CASE expression written
     * three ways for three database engines is a bug looking for the one panel
     * that runs the third.
     */
    public static function recurring(): int
    {
        try {
            $total = 0;

            $orders = Order::query()
                ->whereIn('state', [Order::ACTIVE, Order::SUSPENDED, Order::ENDING])
                ->where('period', '!=', Package::ONCE)
                ->get(['price', 'period']);

            foreach ($orders as $order) {
                $price = max(0, (int) $order->price);

                $total += match ((string) $order->period) {
                    Package::YEAR => intdiv($price, 12),
                    Package::QUARTER => intdiv($price, 3),
                    Package::MONTH => $price,
                    default => 0,
                };
            }

            return $total;
        } catch (Throwable) {
            return 0;
        }
    }

    /** Services that exist right now, whatever state they are in. */
    public static function services(): int
    {
        return self::count(static fn ($query) => $query->whereIn('state', Order::OCCUPYING));
    }

    /** Of those, the ones with notice on them and a date to stop. */
    public static function ending(): int
    {
        return self::count(static fn ($query) => $query->where('state', Order::ENDING));
    }

    /**
     * Bought and not yet built.
     *
     * Worth its own number rather than being folded into the services: a
     * pending order that stays pending is somebody who paid and has nothing,
     * and that is the one thing on this page that needs looking at today.
     */
    public static function pending(): int
    {
        return self::count(static fn ($query) => $query->where('state', Order::PENDING));
    }

    /** @param callable(mixed): mixed $narrow */
    private static function count(callable $narrow): int
    {
        try {
            return (int) $narrow(Order::query())->count();
        } catch (Throwable) {
            return 0;
        }
    }

    /**
     * Unpaid invoices with a date close enough to matter, soonest first.
     *
     * Overdue ones are in here too, and they sort to the top by being the most
     * overdue - the list is "what needs chasing", and something three weeks
     * late needs chasing more than something due on Friday.
     *
     * @return Collection<int, Invoice>
     */
    public static function dueSoon(): Collection
    {
        try {
            return Invoice::query()
                ->with('user')
                ->where('state', Invoice::UNPAID)
                ->whereNotNull('due_at')
                ->where('due_at', '<=', now()->addDays(self::SOON))
                ->orderBy('due_at')
                ->limit(self::ROWS)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    /**
     * Packages nearly gone, and packages gone.
     *
     * Only the ones on sale with a stock figure, because a package that is
     * unlimited or already off sale cannot run out in a way anybody needs
     * warning about. Sold out first: that is a package the shop is showing and
     * refusing, which costs a sale every time somebody clicks it.
     *
     * @return array<int, array{name: string, left: int}>
     */
    public static function lowStock(): array
    {
        try {
            $out = [];

            foreach (Packages::live() as $package) {
                $left = Packages::stockLeft($package);

                if ($left === null || $left > 3) {
                    continue;
                }

                $out[] = ['name' => (string) $package->name, 'left' => $left];
            }

            usort($out, static fn (array $a, array $b): int => $a['left'] <=> $b['left']);

            return array_slice($out, 0, self::ROWS);
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * This month against last month, as a whole percentage.
     *
     * Null when there is nothing to compare against, which is a first month and
     * a shop that took nothing last month. A percentage of zero is infinity,
     * and "up 0%" beside a real number is worse than no number at all.
     */
    public static function change(int $now, int $before): ?int
    {
        if ($before <= 0) {
            return null;
        }

        return (int) round((($now - $before) / $before) * 100);
    }

    /** A short sentence for the top of the page, or nothing to say. */
    public static function headline(int $pending, int $overdue): ?string
    {
        if ($pending > 0) {
            return Theme::trans('overview.attention_pending', ['count' => $pending]);
        }

        return $overdue > 0 ? Theme::trans('overview.attention_overdue') : null;
    }
}
