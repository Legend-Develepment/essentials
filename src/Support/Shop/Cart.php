<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Illuminate\Support\Str;
use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What somebody has picked out and not paid for yet.
 *
 * Kept in the session rather than in a table, and that is a decision worth
 * writing down. A basket is not a record of anything: it is what a person is
 * thinking about right now, it is worthless the moment they close the tab, and
 * a table of them is a table that grows for ever and has to be swept. The
 * moment it becomes a fact - money owed - it stops being a basket and becomes
 * an order and an invoice, which are rows.
 *
 * What it holds per item is the package and the answers to that package's own
 * questions, because those are asked per package and cannot be shared. An
 * upload is held as the path it was already stored at, so a file is copied in
 * once rather than on every look at the basket.
 *
 * Everything is checked again when Buy is pressed. This is a list of
 * intentions, and an intention has no claim on the last one in stock - see
 * Purchase::placeMany(), which asks about every one of them with the row held.
 */
class Cart
{
    /**
     * Where it lives in the session. Namespaced like everything else this
     * plugin puts there, so it cannot collide with the panel's own keys.
     */
    private const KEY = 'essentials.cart';

    /**
     * The basket as it was read this request, or null before it was.
     *
     * Dropped by every method that writes, so nothing here can answer with what
     * the basket held a moment ago - see put() and clear().
     *
     * @var array<string, array{key: string, package: Package, answers: array<string, mixed>, upload: ?string}>|null
     */
    private static ?array $read = null;

    /**
     * How many things one basket may hold.
     *
     * Not a business rule - it is a guard on the session, which travels in a
     * cookie or a file on every request. Somebody who wants forty servers is
     * somebody to talk to rather than somebody to let fill a cookie.
     */
    public const MAX = 20;

    /**
     * Whether this shop has a basket at all.
     *
     * Asked in one place and read everywhere - the button on checkout, the link
     * in the shop, and the basket page itself - because a switch that is only
     * honoured by the parts somebody remembered is not a switch.
     */
    public static function allowed(): bool
    {
        return (bool) Theme::config('shop_basket', false);
    }

    /**
     * Add a package, with what was filled in for it.
     *
     * Every add is its own line, on purpose. Two of the same package are two
     * servers with two sets of answers, not one line with a quantity - and a
     * quantity would have to be undone the moment somebody wants different
     * answers on the second one.
     *
     * @param  array<string, mixed>  $answers
     * @param  array<int|string, mixed>  $extras  Addon id to quantity.
     */
    public static function add(
        Package $package,
        array $answers = [],
        ?string $upload = null,
        array $extras = [],
    ): bool {
        if (!self::allowed()) {
            return false;
        }

        $items = self::raw();

        if (count($items) >= self::MAX) {
            return false;
        }

        $items[Str::random(12)] = [
            'package' => (int) $package->id,
            'answers' => $answers,
            'upload' => $upload,
            /*
             * And the extras ticked with it.
             *
             * Kept per line rather than per basket, because they are a decision
             * about one package: two of the same server can be bought with
             * different extras, and the one thing they must never do is share
             * a set.
             *
             * They were not kept at all for four releases, and it cost exactly
             * what a dropped field always costs: the extras were chosen, the
             * basket forgot them, the invoice did not bill them and the server
             * was built without them. Nothing anywhere said so.
             */
            'extras' => self::ticked($extras),
        ];

        return self::put($items);
    }

    public static function remove(string $key): bool
    {
        $items = self::raw();

        if (!array_key_exists($key, $items)) {
            return false;
        }

        unset($items[$key]);

        return self::put($items);
    }

    public static function clear(): void
    {
        self::$read = null;

        try {
            session()->forget(self::KEY);
        } catch (Throwable) {
            // A session that will not answer is a basket nobody can empty by
            // hand, and it empties itself when they leave.
        }
    }

    public static function count(): int
    {
        // Through items() rather than the session, so a basket that is switched
        // off counts nothing and one holding a deleted package counts what is
        // actually still buyable.
        return count(self::items());
    }

    public static function has(): bool
    {
        return self::count() > 0;
    }

    /**
     * The basket with its packages read, and anything gone dropped.
     *
     * A package can be deleted or taken off sale while it is sitting in
     * somebody's basket. Dropping it here rather than at the till means they
     * find out while they are still looking at the basket, which is the moment
     * they can do something about it.
     *
     * @return array<string, array{key: string, package: Package, answers: array<string, mixed>, upload: ?string, price: int, was: ?int, saved: int}>
     */
    public static function items(): array
    {
        // Switched off after somebody filled one is an empty basket, not a
        // basket that still quietly sells things. The session keeps what it
        // has and means nothing until the switch comes back.
        if (!self::allowed()) {
            return [];
        }

        /*
         * Read once per request, and this is not a micro-optimisation.
         *
         * One render of the basket page asks for this five or six times over -
         * the list, the total, the coupon, whether the coupon was refused, the
         * count in the shop's header - and each ask was its own trip to the
         * database. Nothing in the basket can change between two of those asks:
         * they are all drawing the same page, and adding or removing something
         * is a round trip that starts a new request.
         *
         * Which is the same argument Channels::once() makes about the update
         * feed, in the same words, for the same reason.
         */
        if (self::$read !== null) {
            return self::$read;
        }

        $items = self::raw();

        if ($items === []) {
            return self::$read = [];
        }

        try {
            $packages = Package::query()
                ->whereIn('id', array_map(static fn (array $item): int => (int) $item['package'], $items))
                /*
                 * With the egg and its variables, because the basket page names
                 * every answer somebody filled in - "Redis Password" rather than
                 * SERVER_PASSWORD - and that name lives on the variable. Read
                 * lazily it is two queries per line; read here it is two for the
                 * whole basket however long it is.
                 */
                ->with(['egg.variables'])
                ->get()
                ->keyBy('id');
        } catch (Throwable) {
            return [];
        }

        $out = [];
        $kept = [];

        foreach ($items as $key => $item) {
            $package = $packages->get((int) $item['package']);

            if (!$package instanceof Package || !$package->live) {
                continue;
            }

            $out[$key] = [
                'key' => $key,
                'package' => $package,
                'answers' => (array) ($item['answers'] ?? []),
                'upload' => $item['upload'] ?? null,
                /*
                 * Resolved against the package every time it is read, not
                 * stored as resolved. An addon taken off sale, or one that
                 * never belonged to this package, is dropped here rather than
                 * being allowed to reach a price or an order.
                 */
                'extras' => self::fits($package, (array) ($item['extras'] ?? [])),
            ];

            $kept[$key] = $item;
        }

        /*
         * And what each line costs, now that the basket's size is known.
         *
         * A second pass, because an offer can depend on how full the basket is
         * and that cannot be answered until the whole of it has been read. The
         * first pass was working it out per line with a count of one, which is
         * why the total said 15.00 while the line above it said 10.00.
         */
        // Its own name. This was $items, which is what the raw basket is
        // called four lines down - and count() on an int is a TypeError, so
        // the page went white the moment anything was in the basket.
        $howMany = count($out);

        foreach ($out as $key => $row) {
            $package = $row['package'];
            $now = Packages::priceNow($package, $howMany);
            $list = max(0, (int) $package->price);

            $out[$key]['price'] = $now;
            // Only when there is something to strike out. A price crossed
            // through with the same number beside it is noise.
            $out[$key]['was'] = $now < $list ? $list : null;
            $out[$key]['saved'] = max(0, $list - $now);

        }

        // Written back, so a package that went away goes away once rather than
        // being looked up and discarded on every page for ever.
        if (count($kept) !== count($items)) {
            self::put($kept);
        }

        return self::$read = $out;
    }

    /**
     * What the basket costs, through the same function that writes the invoice.
     *
     * @return array<string, mixed>
     */
    public static function quote(?Coupon $coupon = null, string $vat = ''): array
    {
        return Purchase::quoteMany(
            array_values(array_map(
                static fn (array $item): Package => $item['package'],
                self::items(),
            )),
            $coupon,
            $vat,
            // By position, the same way placeMany() reads them, so what the
            // basket says and what the invoice bills are one sum.
            self::extras(),
        );
    }

    /**
     * The extras on one line that this package actually sells.
     *
     * @param  array<int, int>  $chosen
     * @return array<int, int>
     */
    private static function fits(Package $package, array $chosen): array
    {
        $out = [];

        foreach (Addons::picked($package, $chosen) as $pick) {
            $out[(int) $pick['addon']->id] = (int) $pick['quantity'];
        }

        return $out;
    }

    /**
     * The extras in this basket, by line position.
     *
     * By position because that is what Purchase::quoteMany() and placeMany()
     * both take: an extra belongs to the package it was ticked on, and the
     * basket is a list rather than a set.
     *
     * @return array<int, array<int, int>>
     */
    public static function extras(): array
    {
        return array_values(array_map(
            static fn (array $item): array => (array) ($item['extras'] ?? []),
            self::items(),
        ));
    }

    /**
     * What the offers in this basket take off it, in total.
     *
     * Said out loud on the page, because a discount nobody can see is a
     * discount that did not persuade anybody of anything - and a shopkeeper who
     * gives away a quarter of a price should get the credit for it.
     */
    public static function saved(): int
    {
        $saved = 0;

        foreach (self::items() as $item) {
            $saved += (int) ($item['saved'] ?? 0);
        }

        return $saved;
    }

    /**
     * The basket in the shape Purchase::placeMany() takes.
     *
     * @return array<int, array{package: Package, answers: array<string, mixed>, upload: ?string, extras: array<int, int>}>
     */
    public static function forPurchase(): array
    {
        return array_values(array_map(
            static fn (array $item): array => [
                'package' => $item['package'],
                'answers' => $item['answers'],
                'upload' => $item['upload'],
                'extras' => (array) ($item['extras'] ?? []),
            ],
            self::items(),
        ));
    }

    /**
     * The extras on a line, as ids and counts and nothing else.
     *
     * A session is a thing a person can be talked into writing, so what goes in
     * is reduced to two integers per entry here rather than checked for on the
     * way out. What they mean is decided later by Addons::picked(), against the
     * package, at the moment of buying.
     *
     * @param  array<int|string, mixed>  $extras
     * @return array<int, int>
     */
    private static function ticked(array $extras): array
    {
        $out = [];

        foreach ($extras as $id => $quantity) {
            $id = (int) $id;
            $quantity = (int) $quantity;

            if ($id > 0 && $quantity > 0) {
                $out[$id] = min($quantity, 99);
            }
        }

        return $out;
    }

    /**
     * What is actually in the session, unread.
     *
     * @return array<string, array{package: int, answers: array<string, mixed>, upload: ?string, extras: array<int, int>}>
     */
    private static function raw(): array
    {
        try {
            $items = session()->get(self::KEY);
        } catch (Throwable) {
            return [];
        }

        if (!is_array($items)) {
            return [];
        }

        $out = [];

        foreach ($items as $key => $item) {
            // Anything that is not the shape this writes is not from this, and
            // the session is a thing a browser sends.
            if (!is_string($key) || !is_array($item) || !isset($item['package'])) {
                continue;
            }

            $out[$key] = [
                'package' => (int) $item['package'],
                'answers' => is_array($item['answers'] ?? null) ? $item['answers'] : [],
                'upload' => is_string($item['upload'] ?? null) ? $item['upload'] : null,
                // A basket put there by an older release has no extras on it,
                // which is not a fault - it is a basket from before they were
                // kept, and an empty set is the honest reading of it.
                'extras' => self::ticked(is_array($item['extras'] ?? null) ? $item['extras'] : []),
            ];
        }

        return $out;
    }

    /**
     * @param  array<string, mixed>  $items
     */
    private static function put(array $items): bool
    {
        // Whatever was held is now out of date, whether or not the write below
        // succeeds - a memo that survives a failed write is worse than none.
        self::$read = null;

        try {
            if ($items === []) {
                session()->forget(self::KEY);

                return true;
            }

            session()->put(self::KEY, $items);

            return true;
        } catch (Throwable) {
            return false;
        }
    }
}
