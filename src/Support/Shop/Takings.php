<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Shop\Orders;
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

        /*
         * Three passes over two tables, not ten.
         *
         * Every figure below used to be its own query, and several of them were
         * two: what was taken this month and what was given back, what is owed
         * and what credit is already against it. Ten figures cost twelve
         * queries, and the page asked for all ten six times over. The windows
         * and the states are conditions inside the sums now, so this month and
         * last month are one pass, everything owed is one pass, and the order
         * counts are one pass.
         */
        $paid = self::netPaid([
            [self::monthStart(), now()],
            [self::monthStart()->subMonthNoOverflow(), self::monthStart()],
        ]);

        $owed = self::owedNow();
        $counts = self::orderCounts();

        return [
            'currency' => $currency,
            'month' => $paid[0] ?? 0,
            'previous' => $paid[1] ?? 0,
            'outstanding' => $owed['outstanding'],
            'overdue' => $owed['overdue'],
            'recurring' => self::recurring(),
            'services' => $counts['services'],
            'ending' => $counts['ending'],
            'pending' => $counts['pending'],
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
            /*
             * Credit notes come along and are taken off, the same way the
             * figure above the chart counts them.
             *
             * They did not used to. A credit note is a paid invoice in this
             * table, so a refund made the bar for that month go up while the
             * "this month" figure beside it went down - two numbers about the
             * same money disagreeing on the same screen, and the chart was the
             * one that was wrong.
             */
            $paid = Invoice::query()
                ->where('state', Invoice::PAID)
                ->whereNotNull('paid_at')
                ->where('paid_at', '>=', $start)
                ->get(['paid_at', 'total', 'kind']);

            foreach ($paid as $invoice) {
                $when = $invoice->paid_at;

                if (!$when instanceof Carbon) {
                    continue;
                }

                $key = $when->format('Y-m');

                if (!array_key_exists($key, $months)) {
                    continue;
                }

                $amount = max(0, (int) $invoice->total);

                $months[$key]['total'] += (string) $invoice->kind === Invoice::CREDIT
                    ? -$amount
                    : $amount;
            }

            // A month that gave back more than it took draws as empty rather
            // than as a bar pointing the wrong way.
            foreach ($months as $key => $month) {
                $months[$key]['total'] = max(0, (int) $month['total']);
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
        return self::netPaid([[$from, $to]])[0] ?? 0;
    }

    /**
     * What was actually taken in each of several windows, in one pass.
     *
     * Two windows is what the overview wants - this month and last - and each
     * of them needed two sums, because a credit note is a paid invoice in this
     * table. It has to be, or every list of documents would have to know about
     * a second kind of row. The figures on it are positive and mean the
     * opposite, which is why the subtraction is here and not a sign in the
     * database.
     *
     * Credit given and later spent nets out on its own: the note takes it off
     * the month it was written, and the invoice it eventually settles adds it
     * back to the month that one was paid. That is the right answer both times.
     *
     * **A top-up is not turnover, and it was counted as some.** Somebody buying
     * credit has handed the shop money it is holding for them rather than money
     * it has earned, and the earning happens later when that credit settles a
     * bill - which is counted, because that invoice's total is in the sum like
     * any other. Counting the top-up as well counted the same fifty twice: once
     * on the day it arrived and again, twenty at a time, as it was spent.
     *
     * So it is excluded here the same way a credit note is. The consequence
     * worth knowing: credit somebody buys and never spends shows in this figure
     * as nothing at all, which is what it is - the customer's money, on the
     * shop's account, still owed back to them.
     *
     * Written as conditional sums so the window is part of the arithmetic
     * rather than part of the where. Four separate sums meant four passes over
     * the same table to produce four numbers about it.
     *
     * @param  array<int, array{0: Carbon, 1: Carbon}>  $windows
     * @return array<int, int>
     */
    private static function netPaid(array $windows): array
    {
        $windows = array_values($windows);

        if ($windows === []) {
            return [];
        }

        try {
            $query = Invoice::query();

            foreach ($windows as $i => [$from, $to]) {
                $query
                    ->selectRaw(
                        'coalesce(sum(case when state = ? and kind <> ? and kind <> ?'
                            . ' and paid_at is not null and paid_at >= ? and paid_at < ?'
                            . ' then total else 0 end), 0) as took_' . $i,
                        [Invoice::PAID, Invoice::CREDIT, Invoice::TOPUP, $from, $to],
                    )
                    ->selectRaw(
                        'coalesce(sum(case when kind = ? and paid_at is not null'
                            . ' and paid_at >= ? and paid_at < ? then total else 0 end), 0) as gave_' . $i,
                        [Invoice::CREDIT, $from, $to],
                    );
            }

            $row = $query->first();
            $out = [];

            foreach (array_keys($windows) as $i) {
                $out[$i] = (int) ($row->{'took_' . $i} ?? 0) - (int) ($row->{'gave_' . $i} ?? 0);
            }

            return $out;
        } catch (Throwable) {
            return array_fill(0, count($windows), 0);
        }
    }

    /**
     * What is owed, and how much of that is late, in one pass.
     *
     * Both are the same subtraction over the same rows - what the invoices come
     * to, less the credit already put against them - narrowed differently, and
     * it was four queries to say so. The floor at nought stays per figure: an
     * invoice carrying more credit than it is worth is not a debt owed to the
     * customer, it is a rounding artefact of a note written too large.
     *
     * @return array{outstanding: int, overdue: int}
     */
    private static function owedNow(): array
    {
        try {
            $now = now();

            $row = Invoice::query()
                ->selectRaw(
                    'coalesce(sum(case when state = ? and kind <> ? then total else 0 end), 0) as owed_total',
                    [Invoice::UNPAID, Invoice::CREDIT],
                )
                ->selectRaw(
                    'coalesce(sum(case when state = ? and kind <> ? then credit else 0 end), 0) as owed_credit',
                    [Invoice::UNPAID, Invoice::CREDIT],
                )
                ->selectRaw(
                    'coalesce(sum(case when state = ? and kind <> ? and due_at is not null and due_at < ?'
                        . ' then total else 0 end), 0) as late_total',
                    [Invoice::UNPAID, Invoice::CREDIT, $now],
                )
                ->selectRaw(
                    'coalesce(sum(case when state = ? and kind <> ? and due_at is not null and due_at < ?'
                        . ' then credit else 0 end), 0) as late_credit',
                    [Invoice::UNPAID, Invoice::CREDIT, $now],
                )
                ->first();

            return [
                'outstanding' => max(0, (int) ($row->owed_total ?? 0) - (int) ($row->owed_credit ?? 0)),
                'overdue' => max(0, (int) ($row->late_total ?? 0) - (int) ($row->late_credit ?? 0)),
            ];
        } catch (Throwable) {
            return ['outstanding' => 0, 'overdue' => 0];
        }
    }

    /**
     * How many orders are in each state worth counting, in one pass.
     *
     * @return array{services: int, ending: int, pending: int}
     */
    private static function orderCounts(): array
    {
        try {
            $holding = implode(', ', array_fill(0, count(Order::OCCUPYING), '?'));

            $row = Order::query()
                ->selectRaw(
                    'coalesce(sum(case when state in (' . $holding . ') then 1 else 0 end), 0) as services',
                    Order::OCCUPYING,
                )
                ->selectRaw('coalesce(sum(case when state = ? then 1 else 0 end), 0) as ending', [Order::ENDING])

                ->first();

            return [
                'services' => (int) ($row->services ?? 0),
                'ending' => (int) ($row->ending ?? 0),
                /*
                 * Not every pending order, which is what this counted.
                 * The sentence it feeds says "have been paid for", and a
                 * basket abandoned at the payment page is a pending order
                 * that nobody has paid a penny towards.
                 */
                'pending' => Orders::unbuilt()->count(),
            ];
        } catch (Throwable) {
            return ['services' => 0, 'ending' => 0, 'pending' => 0];
        }
    }

    /**
     * Everything invoiced and not yet paid, cancelled invoices excluded.
     *
     * What is actually owed, so anything a customer's balance already covered
     * is not counted. An unpaid invoice for ten with five off it is five owed,
     * and the day somebody chases the difference is the day this mattered.
     */
    public static function outstanding(): int
    {
        return self::owedNow()['outstanding'];
    }

    /** The part of that which is already past its due date. */
    public static function overdue(): int
    {
        return self::owedNow()['overdue'];
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
        return self::orderCounts()['services'];
    }

    /** Of those, the ones with notice on them and a date to stop. */
    public static function ending(): int
    {
        return self::orderCounts()['ending'];
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
        return self::orderCounts()['pending'];
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
     * How many there are, which is not how many the list above holds.
     *
     * dueSoon() stops at ROWS because that list exists to fill eight rows on a
     * page. Counting the rows it came back with answered eight for a shop with
     * eight bills due and eight for a shop with forty, so the figure published
     * over the API saturated and never grew however far the shop fell behind.
     * A count and a list are different questions, so this one asks the same
     * predicate without the cap and without the customers - nothing here needs
     * a row, only how many of them there are.
     */
    public static function dueSoonCount(): int
    {
        try {
            return Invoice::query()
                ->where('state', Invoice::UNPAID)
                ->whereNotNull('due_at')
                ->where('due_at', '<=', now()->addDays(self::SOON))
                ->count();
        } catch (Throwable) {
            return 0;
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
            $packages = Packages::live();

            // One query for every package's remaining places, rather than one
            // per package: this walks the whole live list every time.
            $left = Packages::stockLeftMany($packages);

            foreach ($packages as $package) {
                $remaining = $left[(int) $package->id] ?? null;

                if ($remaining === null || $remaining > 3) {
                    continue;
                }

                $out[] = ['name' => (string) $package->name, 'left' => $remaining];
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
