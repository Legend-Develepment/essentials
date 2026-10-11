<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Illuminate\Support\Carbon;
use LegendDevelopment\Theme\Models\Customer;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Money;
use SplFileObject;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * The invoices, the orders and the customers, each as a CSV file.
 *
 * So what the shop knows can leave the panel: for an accountant, a move to
 * other billing software, or a copy kept somewhere else.
 *
 * **As the database holds it, not as a page draws it.** Amounts are plain
 * numbers with a point and two decimals, dates are ISO 8601 and states are
 * their stored names, because the file is read by a spreadsheet or a script,
 * and both would have to undo whatever this panel's locale did to a number.
 * The headings are not translated for the same reason.
 *
 * **Written while it is read**, two hundred rows at a time, so a shop with
 * years of invoices never has every one of them loaded as a model at once.
 * The text itself is held once: the button is a Livewire action, and Livewire
 * hands a download back inside its own response. A row is a few hundred
 * bytes, so that is the cheap half.
 */
final class Export
{
    public const INVOICES = 'invoices';

    public const ORDERS = 'orders';

    public const CUSTOMERS = 'customers';

    private const CHUNK = 200;

    public static function download(string $what): StreamedResponse
    {
        $what = in_array($what, [self::INVOICES, self::ORDERS, self::CUSTOMERS], true) ? $what : self::INVOICES;

        return response()->streamDownload(static function () use ($what): void {
            // So a spreadsheet opens the file as UTF-8 rather than guessing,
            // which it gets wrong for every name with an accent in it.
            echo "\xEF\xBB\xBF";

            /*
             * Rows go straight into the response through php://output, the
             * same buffer echo writes to, so the mark above stays first and no
             * copy of the file is ever written to disk.
             */
            $out = new SplFileObject('php://output', 'w');

            match ($what) {
                self::ORDERS => self::orders($out),
                self::CUSTOMERS => self::customers($out),
                default => self::invoices($out),
            };
        }, 'shop-' . $what . '-' . now()->format('Y-m-d') . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * One cell, as the file writes it.
     *
     * A cell that starts with =, +, - or @ is read as a formula by every
     * spreadsheet, and a name or an address is typed by a customer. Such a
     * cell gets a leading apostrophe, which the spreadsheet shows as text. A
     * tab or a carriage return at the start is treated the same, because some
     * spreadsheets skip either and read the formula after it.
     *
     * A number is left as it is: a negative balance of credit is an amount,
     * not a formula, and an apostrophe would make it text in every sum.
     */
    public static function cell(mixed $cell): string
    {
        $text = $cell === null ? '' : (is_scalar($cell) ? (string) $cell : '');

        return $text !== '' && !is_numeric($text) && in_array($text[0], ['=', '+', '-', '@', "\t", "\r"], true)
            ? "'" . $text
            : $text;
    }

    private static function invoices(SplFileObject $out): void
    {
        self::row($out, [
            'number', 'id', 'kind', 'state', 'currency',
            'subtotal', 'discount', 'tax', 'tax_rate_percent', 'total', 'credit_used',
            'coupon', 'order_id', 'user_id',
            'customer_name', 'customer_email', 'customer_company', 'customer_vat', 'customer_country', 'customer_address',
            'created_at', 'due_at', 'paid_at', 'paid_via',
        ]);

        Invoice::query()->chunkById(self::CHUNK, static function ($invoices) use ($out): void {
            foreach ($invoices as $invoice) {
                self::row($out, [
                    $invoice->number,
                    $invoice->id,
                    $invoice->kind,
                    $invoice->state,
                    $invoice->currency,
                    self::money($invoice->subtotal),
                    self::money($invoice->discount),
                    self::money($invoice->tax),
                    // Basis points, as a percentage: 2100 is 21.00.
                    number_format(((int) $invoice->tax_rate) / 100, 2, '.', ''),
                    self::money($invoice->total),
                    self::money($invoice->credit),
                    $invoice->coupon_code,
                    $invoice->order_id,
                    $invoice->user_id,
                    $invoice->customer_name,
                    $invoice->customer_email,
                    $invoice->customer_company,
                    $invoice->customer_vat,
                    $invoice->customer_country,
                    self::lines($invoice->customer_address),
                    $invoice->created_at?->toIso8601String(),
                    $invoice->due_at?->toIso8601String(),
                    $invoice->paid_at?->toIso8601String(),
                    $invoice->paid_via,
                ]);
            }
        });
    }

    private static function orders(SplFileObject $out): void
    {
        self::row($out, [
            'id', 'state', 'user_id', 'username', 'email', 'package', 'server_uuid', 'server_name', 'hostname',
            'period', 'currency', 'price', 'setup_fee',
            'created_at', 'provisioned_at', 'next_due_at', 'suspended_at', 'cancelled_at', 'ends_at',
        ]);

        Order::query()
            ->with(['user', 'package', 'server'])
            ->chunkById(self::CHUNK, static function ($orders) use ($out): void {
                foreach ($orders as $order) {
                    self::row($out, [
                        $order->id,
                        $order->state,
                        $order->user_id,
                        $order->user?->username,
                        $order->user?->email,
                        $order->package?->name,
                        $order->server?->uuid,
                        $order->server?->name,
                        $order->hostname,
                        $order->period,
                        $order->currency,
                        self::money($order->price),
                        self::money($order->setup_fee),
                        $order->created_at?->toIso8601String(),
                        $order->provisioned_at?->toIso8601String(),
                        $order->next_due_at?->toIso8601String(),
                        $order->suspended_at?->toIso8601String(),
                        $order->cancelled_at?->toIso8601String(),
                        $order->ends_at?->toIso8601String(),
                    ]);
                }
            });
    }

    /**
     * Everybody the customers page lists, with the same totals it shows.
     *
     * Customers::query() is that page's own query, so the two cannot disagree
     * about who is a customer or what they have spent.
     */
    private static function customers(SplFileObject $out): void
    {
        self::row($out, [
            'user_id', 'username', 'email', 'company', 'address', 'postcode', 'city', 'country', 'phone', 'vat',
            'orders', 'active_services', 'servers', 'customer_since', 'currency', 'spent', 'outstanding', 'credit',
        ]);

        $currency = Packages::currency();

        Customers::query()->chunkById(self::CHUNK, static function ($users) use ($out, $currency): void {
            $details = Customer::query()
                ->whereIn('user_id', $users->pluck('id'))
                ->get()
                ->keyBy('user_id');

            /** @var User $user */
            foreach ($users as $user) {
                $detail = $details->get($user->id);

                self::row($out, [
                    $user->id,
                    $user->username,
                    $user->email,
                    $detail?->company,
                    self::lines($detail?->address),
                    $detail?->postcode,
                    $detail?->city,
                    $detail?->country,
                    $detail?->phone,
                    $detail?->vat,
                    $user->ld_orders,
                    $user->ld_services,
                    $user->ld_servers,
                    self::date($user->ld_since),
                    $currency,
                    self::money($user->ld_spent),
                    self::money($user->ld_outstanding),
                    self::money($user->ld_credit),
                ]);
            }
        }, 'users.id', 'id');
    }

    /**
     * One line of the file, every cell through cell().
     *
     * An empty escape character, so a backslash in somebody's address is a
     * backslash and a quote is doubled the way RFC 4180 and every spreadsheet
     * expect, rather than PHP's own escaping that nothing else reads.
     *
     * @param  array<int, mixed>  $cells
     */
    private static function row(SplFileObject $out, array $cells): void
    {
        $out->fputcsv(array_map(self::cell(...), $cells), ',', '"', '');
    }

    /**
     * A date a sub-select handed back as the database writes it, in the same
     * ISO 8601 as every other date in these files.
     */
    private static function date(mixed $value): ?string
    {
        return is_string($value) && $value !== '' ? Carbon::parse($value)->toIso8601String() : null;
    }

    private static function money(mixed $minor): string
    {
        return Money::decimal((int) $minor);
    }

    /** An address kept as lines, as one cell. */
    private static function lines(mixed $lines): string
    {
        if (is_string($lines)) {
            return $lines;
        }

        if (!is_array($lines)) {
            return '';
        }

        $kept = [];

        foreach ($lines as $line) {
            $line = is_scalar($line) ? trim((string) $line) : '';

            if ($line !== '') {
                $kept[] = $line;
            }
        }

        return implode(', ', $kept);
    }
}
