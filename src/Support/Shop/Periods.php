<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Package;

/**
 * How long the period a service is in the middle of is, and how much of it is
 * left.
 *
 * Pulled out of Upgrades when addons needed the same two answers. Two copies of
 * this would have been two copies of the bug below, and only one of them would
 * ever have been fixed.
 *
 * **Days, not moments.** That is the whole of what this class is careful about.
 * A service due in fifteen days is due at some o'clock fifteen days from when
 * that date was set; `now()` is always a fraction past that o'clock, so
 * comparing the instants gave 14.999 and a cast to int made it fourteen. Every
 * pro-rata figure in the shop was a day short, silently, until a probe against
 * the live panel caught it. Both ends are taken to the start of their day here,
 * because a period is measured in days and its two ends are dates.
 */
class Periods
{
    /** What a period is taken to be when no date can say. */
    private const FALLBACK = [
        Package::MONTH => 30,
        Package::QUARTER => 91,
        Package::YEAR => 365,
    ];

    /**
     * How long this order's current period is.
     *
     * Measured off the real dates rather than taken from the table above,
     * because months are not the same length: a customer who buys something in
     * February should not be charged as though it had thirty-one days.
     */
    public static function length(Order $order): int
    {
        $due = $order->next_due_at;
        $period = Packages::period($order->period);

        if (!$due instanceof Carbon) {
            return self::FALLBACK[$period] ?? 30;
        }

        $start = match ($period) {
            Package::QUARTER => $due->copy()->subMonths(3),
            Package::YEAR => $due->copy()->subYear(),
            default => $due->copy()->subMonth(),
        };

        return max(1, self::between($start, $due));
    }

    /**
     * How much of it is left, never more than the whole and never below
     * nothing.
     *
     * An overdue service has nought days left, which makes every pro-rata
     * figure nought: changing or extending a service you have not paid for
     * costs the difference from the next invoice rather than from this one.
     */
    public static function left(Order $order, ?Carbon $today = null): int
    {
        $due = $order->next_due_at;

        if (!$due instanceof Carbon || !$order->recurring()) {
            return 0;
        }

        return max(0, min(self::length($order), self::between($today ?? Carbon::now(), $due)));
    }

    /**
     * Whole days from one date to another, counted as dates.
     *
     * Negative where the second is in the past, because an overdue service has
     * to be able to say so. The caller clamps; this does not.
     */
    public static function between(Carbon $from, Carbon $to): int
    {
        return (int) round($from->copy()->startOfDay()->diffInDays($to->copy()->startOfDay(), false));
    }
}
