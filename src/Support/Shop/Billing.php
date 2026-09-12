<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use LegendDevelopment\Theme\Mail\InvoiceMail;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Telling people what happened to their money and their servers.
 *
 * Two channels, and they answer different needs. **The bell** is Filament's
 * database notification, which Pelican already draws in the top bar - it is
 * seen by somebody who is in the panel, which is where they will act. **Email**
 * is for somebody who is not, which for an invoice is most people, most of the
 * time.
 *
 * Everything here is wrapped so that nothing it does can fail a purchase. A
 * panel with no mailer configured is the normal case on a home server, and the
 * shop has to work there: an invoice that exists and was not emailed is a
 * customer who reads it on their billing page, while a purchase that threw
 * because SMTP was not set up is a customer with nothing at all.
 *
 * The subject lines and bodies come from the language files, so a customer
 * hears about their invoice in the language they read the panel in.
 */
class Billing
{
    /**
     * Who the invoice is from.
     *
     * Read here rather than in the document, because three things print it -
     * the invoice page, the PDF a customer saves and the mail it arrives in -
     * and an address that is right on two of those is worse than one that is
     * missing from all three.
     *
     * Every field falls back to nothing rather than to a placeholder. A blank
     * line is a line the document leaves out; the words "your company here" on
     * a real invoice are worse than no line at all.
     *
     * @return array<string, string|array<int, string>>
     */
    public static function issuer(): array
    {
        $name = trim((string) Theme::config('shop_company_name', ''));

        return [
            // The panel's own name is the fallback, which is what every invoice
            // written before this setting existed already showed.
            'name' => $name !== '' ? $name : (string) config('app.name', 'Panel'),
            'address' => self::lines((string) Theme::config('shop_company_address', '')),
            'vat' => trim((string) Theme::config('shop_company_vat', '')),
            'coc' => trim((string) Theme::config('shop_company_coc', '')),
            'email' => trim((string) Theme::config('shop_company_email', '')),
            'country' => mb_strtoupper(trim((string) Theme::config('shop_company_country', ''))),
        ];
    }

    /**
     * The VAT number this customer last gave, if any.
     *
     * Read from their own invoices rather than kept on their account, because
     * that is where it already is - snapshotted on every document they have
     * had. Somebody who has a VAT number has it on every order, and typing it
     * again each time is how it gets mistyped once.
     */
    public static function lastVat(): ?string
    {
        try {
            $vat = Invoice::query()
                ->where('user_id', (int) (user()?->id ?? 0))
                ->whereNotNull('customer_vat')
                ->orderByDesc('id')
                ->value('customer_vat');
        } catch (Throwable) {
            // No column yet on a panel between the file swap and the install.
            return null;
        }

        $vat = trim((string) $vat);

        return $vat === '' ? null : $vat;
    }

    /**
     * How long somebody has to pay a new order's invoice, in days.
     *
     * Clamped rather than trusted: a negative term is an invoice that was
     * already overdue when it was written, and a year is a term nobody meant
     * to type.
     */
    public static function dueDays(): int
    {
        $days = (int) Theme::config('shop_due_days', 0);

        return max(0, min(90, $days));
    }

    /**
     * A block of text as the lines it should print as, with the empty ones
     * dropped - so a trailing newline in a settings box is not a gap on a
     * document.
     *
     * @return array<int, string>
     */
    private static function lines(string $text): array
    {
        $out = [];

        foreach (preg_split('/\r\n|\r|\n/', $text) ?: [] as $line) {
            $line = trim($line);

            if ($line !== '') {
                $out[] = mb_substr($line, 0, 120);
            }
        }

        return array_slice($out, 0, 6);
    }

    /**
     * A new invoice: bell, then mail.
     *
     * Called once, from the moment the invoice is written. Marking it emailed
     * is the record of that, so a later pass can tell "sent" from "never
     * tried" without keeping a log.
     */
    public static function announce(Invoice $invoice): void
    {
        $user = self::user($invoice);

        if ($user === null) {
            return;
        }

        $title = Theme::trans('invoices.bell_new', ['number' => (string) $invoice->number]);
        $body = Theme::trans('invoices.bell_new_body', [
            'total' => Money::format((int) $invoice->total, (string) $invoice->currency),
        ]);

        self::bell($user, $title, $body);
        self::post($invoice, $user);
    }

    /**
     * One reminder, before the server stops.
     *
     * Between the invoice going unpaid and the grace period running out there
     * is currently nothing: the next thing a customer hears is a stopped
     * server. This is the sentence in between, and it says the date rather than
     * asking somebody to work it out - a warning that does not name the day is
     * a warning people read as soon as it is too late.
     */
    public static function remind(Invoice $invoice, Carbon $stops): void
    {
        $user = self::user($invoice);

        if ($user === null) {
            return;
        }

        self::bell(
            $user,
            Theme::trans('invoices.bell_reminder', ['number' => (string) $invoice->number]),
            Theme::trans('invoices.bell_reminder_body', [
                'total' => Money::format((int) $invoice->total, (string) $invoice->currency),
                'date' => $stops->toFormattedDateString(),
            ]),
        );

        self::post($invoice, $user);
    }

    /** The customer's server exists and is theirs to use. */
    public static function ready(Order $order, string $name): void
    {
        $user = $order->user;

        if (!$user instanceof User) {
            return;
        }

        self::bell(
            $user,
            Theme::trans('orders.bell_ready'),
            Theme::trans('orders.bell_ready_body', ['server' => $name]),
            true,
        );
    }

    /**
     * Somebody answered their question.
     *
     * Beside the shop's own bells rather than in the ticket code, because this
     * is the one place in the plugin that knows how to reach a customer and a
     * second implementation of it would drift from this one the day Pelican
     * changes what a notification is.
     */
    /**
     * Something they asked to be told about is for sale again.
     *
     * The body says how many there are and that they go to whoever buys first,
     * because that is what is true: nothing is held. A message that said "it is
     * back" and nothing else would be a promise to everybody but one of them.
     *
     * A bell and not an email, like every other thing this plugin tells a
     * customer. Two hundred of these can land on one pass, and the mailer here
     * sends in the foreground.
     */
    public static function restocked(User $user, string $package, ?int $left): void
    {
        self::bell(
            $user,
            Theme::trans('waitlist.bell_back', ['name' => $package]),
            $left === null
                ? Theme::trans('waitlist.bell_back_any')
                : Theme::choice('waitlist.bell_back_body', max(1, $left)),
            true,
        );
    }

    public static function answered(User $user, string $subject): void
    {
        self::bell(
            $user,
            Theme::trans('tickets.bell_answered'),
            Theme::trans('tickets.bell_answered_body', ['subject' => $subject]),
            true,
        );
    }

    /** A server this plugin stopped, and why. */
    public static function suspended(Order $order): void
    {
        $user = $order->user;

        if (!$user instanceof User) {
            return;
        }

        self::bell(
            $user,
            Theme::trans('orders.bell_suspended'),
            Theme::trans('orders.bell_suspended_body'),
        );
    }

    /**
     * Notice has been given, and this is the day it stops.
     *
     * Told to the customer rather than left to be discovered, because a
     * service that quietly disappears on a date nobody mentioned is the worst
     * version of this feature. A null date means it stopped renewing and the
     * server stays, which is a different sentence.
     */
    public static function ending(Order $order, ?Carbon $ends): void
    {
        $user = $order->user;

        if (!$user instanceof User) {
            return;
        }

        $name = self::bought($order);

        self::bell(
            $user,
            $ends === null
                ? Theme::trans('orders.bell_ending_open', ['package' => $name])
                : Theme::trans('orders.bell_ending', [
                    'package' => $name,
                    'date' => $ends->toFormattedDateString(),
                ]),
            Theme::trans('orders.bell_ending_body'),
        );
    }

    /**
     * What the customer thinks they bought.
     *
     * From the order's own snapshot rather than the package row, because a
     * package that was renamed or deleted last month does not change what
     * somebody's invoice said when they paid it.
     */
    private static function bought(Order $order): string
    {
        $spec = is_array($order->spec) ? $order->spec : [];

        return trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package');
    }

    /** It has stopped, and the server has gone with it. */
    public static function ended(Order $order): void
    {
        $user = $order->user;

        if (!$user instanceof User) {
            return;
        }

        self::bell(
            $user,
            Theme::trans('orders.bell_ended', ['package' => self::bought($order)]),
            Theme::trans('orders.bell_ended_body'),
        );
    }

    /**
     * Something went wrong that only an administrator can fix.
     *
     * To whoever holds the orders permission rather than to every
     * administrator: a panel where the person who reads about a failed build
     * is the person who can retry it is a panel where it gets retried.
     */
    public static function trouble(string $title, string $body): void
    {
        try {
            $users = User::query()->get()->filter(
                // Either half, for the same reason the watchdog uses both:
                // hearing that an order came in is being shown it.
                static fn (User $user): bool => $user->can(Theme::PERMISSION_VIEW)
                    || $user->can(Features::permission(Features::ORDERS))
                    || $user->can(Features::viewPermission(Features::ORDERS)),
            );

            if ($users->isEmpty()) {
                return;
            }

            Notification::make()
                ->title($title)
                ->body($body)
                ->warning()
                ->persistent()
                ->sendToDatabase($users);
        } catch (Throwable) {
            // Nobody was told. The order still carries the reason on its own
            // row, which is where somebody looking for it will look.
        }
    }

    /** One person, one bell. */
    private static function bell(User $user, string $title, string $body, bool $good = false): void
    {
        try {
            $notification = Notification::make()->title($title)->body($body);

            ($good ? $notification->success() : $notification->info())
                ->persistent()
                ->sendToDatabase($user);
        } catch (Throwable) {
            // The panel's own notifications table is not this plugin's to fix.
        }
    }

    /**
     * The invoice, in the customer's inbox.
     *
     * A mailable with its own view rather than Mail::raw, because this one is
     * a document: it has lines and totals and a link to the printable version,
     * and a plain-text version of that is a worse thing than an unstyled HTML
     * one.
     */
    private static function post(Invoice $invoice, User $user): void
    {
        $to = trim((string) $user->email);

        if ($to === '') {
            return;
        }

        try {
            Mail::to($to)->send(new InvoiceMail($invoice));

            $invoice->forceFill(['emailed_at' => now()])->save();
        } catch (Throwable) {
            /*
             * Silence here is deliberate and is not silence everywhere: the
             * invoice keeps a null emailed_at, which the admin page shows, so
             * a panel whose mailer has never worked says so on the page rather
             * than in a log nobody opens.
             */
        }
    }

    private static function user(Invoice $invoice): ?User
    {
        try {
            $user = $invoice->user;

            return $user instanceof User ? $user : null;
        } catch (Throwable) {
            return null;
        }
    }
}
