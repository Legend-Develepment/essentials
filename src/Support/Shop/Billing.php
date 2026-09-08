<?php

namespace LegendDevelopment\Theme\Support\Shop;

use App\Models\User;
use Filament\Notifications\Notification;
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
                static fn (User $user): bool => $user->can(Theme::PERMISSION_VIEW)
                    || $user->can(Features::permission(Features::ORDERS)),
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
