<?php

namespace LegendDevelopment\Theme\Support\Shop;

use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
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
     * The code, if it is one and it is good for this package and this account.
     *
     * Null for every kind of no: not a code, not live, expired, used up, for
     * other packages, or somebody else's. The caller says "that code will not
     * work here" without being told which of the six it was, because the
     * difference is of no use to a customer and telling them turns the field
     * into a way to enumerate the codes that exist.
     *
     * The account is whoever is asking. A caller that knows nobody passes
     * null, and a code tied to accounts then says no - see Coupon::mayUse().
     */
    public static function find(mixed $code, ?Package $package = null, ?int $userId = null): ?Coupon
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

        // A code that is somebody else's is, as far as this customer is told,
        // simply a code that does not work.
        if (!$coupon->mayUse($userId)) {
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

    /**
     * The codes tied to one account that it could use right now.
     *
     * Only the tied ones. A code open to everybody is still something the
     * administrator hands out on purpose - a newsletter, a stream - and listing
     * every one of them to every customer would give them away.
     *
     * Read and filtered here rather than with a JSON query: the table holds a
     * few dozen rows on any real panel, and mayUse() and usable() are then the
     * same two rules this list and the checkout both ask, so the list cannot
     * offer a code the checkout would refuse.
     *
     * @return array<int, array{code: string, off: string, packages: array<int, string>, until: ?string}>
     */
    public static function forUser(int $userId, string $currency): array
    {
        if ($userId <= 0 || !Features::enabled(Features::COUPONS)) {
            return [];
        }

        try {
            $coupons = Coupon::query()->whereNotNull('user_ids')->orderBy('expires_at')->orderBy('code')->get();
            $names = Package::query()->pluck('name', 'id')->all();
        } catch (Throwable) {
            return [];
        }

        $out = [];

        foreach ($coupons as $coupon) {
            $ids = is_array($coupon->user_ids) ? $coupon->user_ids : [];

            if ($ids === [] || !$coupon->usable() || !$coupon->mayUse($userId)) {
                continue;
            }

            $packages = [];

            foreach (is_array($coupon->package_ids) ? $coupon->package_ids : [] as $id) {
                if (isset($names[(int) $id])) {
                    $packages[] = (string) $names[(int) $id];
                }
            }

            $out[] = [
                'code' => (string) $coupon->code,
                'off' => $coupon->kind === Coupon::PERCENT
                    ? (int) $coupon->value . '%'
                    : Money::format((int) $coupon->value, $currency),
                'packages' => $packages,
                'until' => $coupon->expires_at?->translatedFormat('j F Y'),
            ];
        }

        return $out;
    }

    /** How a code reads on an invoice line: the code and what it did. */
    public static function label(Coupon $coupon, string $currency): string
    {
        return $coupon->kind === Coupon::PERCENT
            ? $coupon->code . ' (' . (int) $coupon->value . '%)'
            : $coupon->code . ' (' . Money::format((int) $coupon->value, $currency) . ')';
    }
}
