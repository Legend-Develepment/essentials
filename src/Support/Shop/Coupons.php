<?php

namespace LegendDevelopment\Theme\Support\Shop;

use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Money;
use Throwable;

/**
 * Discount codes, and the two questions worth asking about one.
 *
 * **Does it apply here.** A code is live or not, expired or not, used up or
 * not, and good for this package or not. All four are asked in one place, so
 * the checkout page and the thing that actually writes the invoice cannot come
 * to different conclusions about the same code.
 *
 * **What does it take off.** A percentage of the subtotal, or a fixed amount -
 * never more than the subtotal itself, because an invoice for less than nothing
 * is not a discount, it is a refund, and this release does not do refunds.
 *
 * Codes are stored and compared upper-case with the spaces taken out. Somebody
 * reading a code off a Discord message types it how they see it, and a code
 * that works in one case and not the other is a support ticket.
 */
class Coupons
{
    /** Long enough for anything readable, short enough to index. */
    public const MAX_LENGTH = 32;

    /** The stored form of whatever somebody typed. */
    public static function normalise(mixed $code): string
    {
        $code = is_scalar($code) ? (string) $code : '';

        return mb_substr(mb_strtoupper(preg_replace('/\s+/', '', $code) ?? ''), 0, self::MAX_LENGTH);
    }

    /**
     * The code, if it is one and it is good for this package.
     *
     * Null for every kind of no: not a code, not live, expired, used up, or
     * for other packages. The caller says "that code will not work here"
     * without being told which of the five it was, because the difference is
     * of no use to a customer and telling them turns the field into a way to
     * enumerate the codes that exist.
     */
    public static function find(mixed $code, ?Package $package = null): ?Coupon
    {
        $code = self::normalise($code);

        if ($code === '') {
            return null;
        }

        try {
            $coupon = Coupon::query()->where('code', $code)->first();
        } catch (Throwable) {
            return null;
        }

        if (!$coupon instanceof Coupon || !$coupon->usable()) {
            return null;
        }

        if ($package !== null && !$coupon->covers((int) $package->id)) {
            return null;
        }

        return $coupon;
    }

    /**
     * What comes off a subtotal, in minor units.
     *
     * Never negative and never more than the subtotal. A fixed code worth more
     * than the order takes the order to zero rather than owing anybody money.
     */
    public static function discount(?Coupon $coupon, int $subtotal): int
    {
        if ($coupon === null || $subtotal <= 0) {
            return 0;
        }

        $off = $coupon->kind === Coupon::PERCENT
            ? Money::percent($subtotal, (int) $coupon->value)
            : (int) $coupon->value;

        return max(0, min($subtotal, $off));
    }

    /**
     * Count one use.
     *
     * Called when an order is placed, not when its invoice is paid. A code
     * that only counts on payment can be placed a hundred times overnight and
     * still say it has uses left in the morning.
     */
    public static function spend(?Coupon $coupon): void
    {
        if ($coupon === null) {
            return;
        }

        try {
            $coupon->increment('uses');
        } catch (Throwable) {
            // The order is already placed and the discount is already on the
            // invoice. A counter that did not move is worth less than the sale.
        }
    }

    /** How a code reads on an invoice line: the code and what it did. */
    public static function label(Coupon $coupon, string $currency): string
    {
        return $coupon->kind === Coupon::PERCENT
            ? $coupon->code . ' (' . (int) $coupon->value . '%)'
            : $coupon->code . ' (' . Money::format((int) $coupon->value, $currency) . ')';
    }
}
