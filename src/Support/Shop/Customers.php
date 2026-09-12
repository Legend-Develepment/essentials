<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use LegendDevelopment\Theme\Models\Customer;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The shop, turned around to face the person instead of the row.
 *
 * Orders, invoices and payments are each a list of things that happened. This
 * is the same information asked a different question: who is this, what do
 * they hold, what have they paid, and what is still outstanding. That question
 * is the one somebody answering a support ticket actually has, and answering
 * it by reading three tables and doing the arithmetic in your head is how
 * mistakes get made in front of a customer.
 *
 * **Only people who have bought something.** A panel with four hundred users
 * and nine customers should show nine rows. The list is built from the orders
 * table rather than from the users table for that reason - a customer is
 * somebody who ordered, not somebody who signed up.
 *
 * Money is summed from paid invoices rather than from orders, because an order
 * is a price and an invoice is a payment. Somebody with a year-old order and
 * nothing paid has spent nothing, and this says so.
 */
class Customers
{
    /**
     * What each person's totals came to, for the length of one request.
     *
     * @var array<int, array<string, mixed>>
     */
    private static array $memo = [];

    /**
     * This person's own details, as a row that always answers.
     *
     * A customer who has never filled anything in gets an empty model rather
     * than null, so every caller can read `->country` without asking first.
     * Nothing is written until something is saved - an empty row for every
     * account that ever signed in is a table that grows for no reason.
     */
    public static function profile(int $userId): Customer
    {
        try {
            $found = Customer::query()->where('user_id', $userId)->first();

            if ($found instanceof Customer) {
                return $found;
            }
        } catch (Throwable) {
            // No table yet on a panel between the file swap and the install.
            // An unsaved model is the honest answer: nothing is known.
        }

        return new Customer(['user_id' => $userId]);
    }

    /**
     * Write it back, and only the fields this is allowed to write.
     *
     * The country is stored upper case and two letters, because that is what
     * Vat::home() and the reverse-charge question compare against - a country
     * typed as "nl" that fails to match "NL" is a customer charged tax they did
     * not owe.
     *
     * @param  array<string, mixed>  $data
     */
    public static function save(int $userId, array $data): bool
    {
        try {
            Customer::query()->updateOrCreate(['user_id' => $userId], [
                'company' => self::line($data['company'] ?? null, 191),
                'address' => self::lines($data['address'] ?? null),
                'postcode' => self::line($data['postcode'] ?? null, 32),
                'city' => self::line($data['city'] ?? null, 120),
                'country' => mb_strtoupper(mb_substr(
                    preg_replace('/[^A-Za-z]/', '', (string) ($data['country'] ?? '')) ?? '',
                    0,
                    2,
                )),
                'phone' => self::line($data['phone'] ?? null, 40),
                // Normalised the way the VAT check reads it, so what is stored,
                // what is checked and what is printed are one string.
                'vat' => Vat::normalise($data['vat'] ?? null),
            ]);

            return true;
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * The shop's own note about somebody. Written separately from the rest
     * because it is the one field the customer may not touch.
     */
    public static function note(int $userId, mixed $note): bool
    {
        try {
            Customer::query()->updateOrCreate(
                ['user_id' => $userId],
                ['notes' => mb_substr(trim((string) $note), 0, 2000)],
            );

            return true;
        } catch (Throwable $exception) {
            report($exception);

            return false;
        }
    }

    /**
     * What an invoice should keep about this person, at the moment it is
     * written.
     *
     * One place, because three things write an invoice - a purchase, a basket
     * and a renewal - and a renewal already forgot the VAT number once. A
     * caller that has to remember five columns is a caller that will remember
     * four.
     *
     * @return array<string, mixed>
     */
    public static function snapshot(?User $user): array
    {
        if ($user === null) {
            return [];
        }

        $profile = self::profile((int) $user->id);

        return [
            // The company where there is one, and the person where there is
            // not: an invoice is addressed to whoever owes the money.
            'customer_name' => mb_substr(
                trim((string) $profile->company) ?: (string) $user->username,
                0,
                191,
            ),
            'customer_email' => mb_substr((string) $user->email, 0, 191),
            'customer_company' => self::line($profile->company, 191) ?: null,
            'customer_address' => self::document($profile),
            'customer_country' => mb_strtoupper((string) ($profile->country ?? '')) ?: null,
            'customer_vat' => trim((string) ($profile->vat ?? '')) ?: null,
        ];
    }

    /**
     * The address as it should print: the street lines, then postcode and city
     * on one line, the way a Dutch envelope is written.
     *
     * @return array<int, string>|null
     */
    private static function document(Customer $profile): ?array
    {
        $lines = $profile->lines();

        $town = trim(trim((string) $profile->postcode) . ' ' . trim((string) $profile->city));

        if ($town !== '') {
            $lines[] = $town;
        }

        return $lines === [] ? null : $lines;
    }

    private static function line(mixed $value, int $max): string
    {
        return mb_substr(trim((string) (is_scalar($value) ? $value : '')), 0, $max);
    }

    /**
     * A text box as the lines it holds, blank ones dropped.
     *
     * @return array<int, string>
     */
    private static function lines(mixed $value): array
    {
        $out = [];

        foreach (preg_split('/\r\n|\r|\n/', (string) (is_scalar($value) ? $value : '')) ?: [] as $line) {
            $line = trim($line);

            if ($line !== '') {
                $out[] = mb_substr($line, 0, 120);
            }
        }

        return array_slice($out, 0, 6);
    }

    /**
     * Users who have at least one order, newest customer first.
     *
     * A query rather than a collection, so the page can sort, search and page
     * through it the way every other table in this plugin does.
     *
     * @return Builder<User>
     */
    public static function query(): Builder
    {
        return User::query()->whereIn(
            'id',
            Order::query()->select('user_id')->distinct(),
        );
    }

    /**
     * What one person holds and owes, in one read each.
     *
     * Six small aggregates rather than loading their orders and invoices and
     * counting in PHP: a customer with two hundred orders would otherwise pull
     * two hundred rows to draw one line of a table.
     *
     * @return array{
     *     services: int, servers: int, orders: int,
     *     spent: int, outstanding: int, currency: string, since: ?string
     * }
     */
    public static function of(int $userId): array
    {
        /*
         * Answered once per person per request.
         *
         * A table row draws four columns from this, and each one asking again
         * would be twenty-four queries a row - so nine customers would cost
         * two hundred. The memo lives for the request, which is exactly as
         * long as one page of the table.
         */
        if (array_key_exists($userId, self::$memo)) {
            return self::$memo[$userId];
        }

        $out = [
            'services' => 0,
            'servers' => 0,
            'orders' => 0,
            'spent' => 0,
            'outstanding' => 0,
            'currency' => Packages::currency(),
            'since' => null,
        ];

        try {
            $orders = Order::query()->where('user_id', $userId);

            $out['orders'] = (clone $orders)->count();
            $out['services'] = (clone $orders)->whereIn('state', Order::OCCUPYING)->count();
            $out['servers'] = (clone $orders)->whereNotNull('server_id')->count();
            $out['since'] = (clone $orders)->min('created_at');

            $invoices = Invoice::query()->where('user_id', $userId);

            $out['spent'] = (int) (clone $invoices)->where('state', Invoice::PAID)->sum('total');
            $out['outstanding'] = (int) (clone $invoices)->where('state', Invoice::UNPAID)->sum('total');
        } catch (Throwable) {
            // A database that will not answer draws a row of zeroes rather
            // than taking the page with it.
        }

        self::$memo[$userId] = $out;

        return $out;
    }

    /**
     * One person's services, as lines a person can read.
     *
     * The order's own snapshot for the name, so a package renamed or deleted
     * since the sale still says what was bought.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function services(int $userId): array
    {
        $out = [];

        try {
            $orders = Order::query()
                ->where('user_id', $userId)
                ->with('server')
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($orders as $order) {
            $spec = is_array($order->spec) ? $order->spec : [];

            $out[] = [
                'id' => (int) $order->id,
                'name' => trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package'),
                'state' => Theme::trans('orders.state_' . $order->state),
                'colour' => match ($order->state) {
                    Order::ACTIVE => 'success',
                    Order::PENDING => 'warning',
                    Order::SUSPENDED => 'danger',
                    Order::ENDING => 'info',
                    default => 'gray',
                },
                'server' => $order->server?->name,
                'price' => Money::format((int) $order->price, (string) $order->currency)
                    . ' ' . Theme::trans('packages.per_' . $order->period),
                'due' => $order->next_due_at?->toFormattedDateString(),
            ];
        }

        return $out;
    }

    /**
     * One person's invoices, the same way.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function invoices(int $userId): array
    {
        $out = [];

        try {
            $invoices = Invoice::query()
                ->where('user_id', $userId)
                ->orderByDesc('id')
                ->limit(100)
                ->get();
        } catch (Throwable) {
            return [];
        }

        foreach ($invoices as $invoice) {
            $out[] = Invoices::row($invoice);
        }

        return $out;
    }
}
