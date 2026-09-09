<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Invoice;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Gateways;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * One invoice, and every way there is to pay it.
 *
 * This used to be three buttons in a row under a line in a list, which is fine
 * for somebody who already knows what they are doing and wrong for everybody
 * else. Paying is a decision - how much, by what means - and a decision gets a
 * page rather than a corner of a list.
 *
 * Each way to pay is a card that says what it actually covers, because "Mollie"
 * and "Stripe" are the names of companies rather than the names of anything a
 * customer recognises. What they recognise is a card, their bank, or the PayPal
 * they already have an account with, and the cards say so.
 *
 * **Nothing about the payment is decided here.** The page draws what
 * Gateways::enabled() answers with and hands the chosen one an invoice; the
 * provider classes do the rest. A provider added in a later release appears on
 * this page without it being touched.
 *
 * No permission of its own, like the rest of the client side. It shows one
 * invoice, and the query that finds it is scoped to whoever is signed in.
 */
class Pay extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-credit-card';

    protected static ?string $slug = 'pay';

    /** Reached from an invoice, not from the sidebar. */
    protected static bool $shouldRegisterNavigation = false;

    /** Which invoice. Comes in on the query string. */
    public ?int $invoice = null;

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::SHOP) && Tables::ready() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('shop.pay_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('shop.pay_subheading');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.pay';
    }

    public function mount(): void
    {
        $this->invoice = (int) request()->integer('invoice');
    }

    /**
     * The invoice, if it exists and belongs to whoever is asking.
     *
     * Someone else's invoice answers null rather than 403, and the page then
     * says the same thing it says for an invoice that was never there. An id
     * in an address is an id somebody will edit, and telling them apart would
     * let them count how many invoices this panel has written.
     */
    public function item(): ?Invoice
    {
        if ($this->invoice === null || $this->invoice <= 0) {
            return null;
        }

        try {
            $row = Invoice::query()->find($this->invoice);
        } catch (Throwable) {
            return null;
        }

        if (!$row instanceof Invoice) {
            return null;
        }

        return (int) $row->user_id === $this->userId() ? $row : null;
    }

    /**
     * What is owed, laid out the way the invoice itself lays it out.
     *
     * Read from the invoice's own snapshot rather than recomputed, because the
     * document is the agreement: whatever the package costs today, this is what
     * this customer is being asked for.
     *
     * @return array<string, mixed>|null
     */
    public function summary(): ?array
    {
        $invoice = $this->item();

        if ($invoice === null) {
            return null;
        }

        $currency = (string) $invoice->currency;
        $rate = (int) $invoice->tax_rate;

        return [
            'number' => (string) $invoice->number,
            'kind' => Theme::trans('invoices.kind_' . $invoice->kind),
            'lines' => is_array($invoice->lines) ? $invoice->lines : [],
            'subtotal' => Money::format((int) $invoice->subtotal, $currency),
            'discount' => (int) $invoice->discount > 0
                ? Money::format((int) $invoice->discount, $currency)
                : null,
            'coupon' => (string) ($invoice->coupon_code ?? ''),
            'tax' => $rate > 0 ? Money::format((int) $invoice->tax, $currency) : null,
            'tax_label' => Theme::trans('shop.tax_line', [
                'rate' => rtrim(rtrim(number_format($rate / 100, 2, '.', ''), '0'), '.'),
            ]),
            'total' => Money::format((int) $invoice->total, $currency),
            'due' => $invoice->due_at?->toFormattedDateString(),
            'paid' => $invoice->paid(),
            'cancelled' => $invoice->state === Invoice::CANCELLED,
            'open' => $invoice->open(),
            'money' => static fn (int $minor): string => Money::format($minor, $currency),
            'url' => Invoices::address($invoice),
        ];
    }

    /**
     * The ways to pay, as cards.
     *
     * Each carries what a customer recognises rather than the provider's own
     * name alone - a card, a bank, the PayPal account they already have. The
     * note comes from the language files, so a provider added later has a
     * sentence in every language before it has a card here.
     *
     * @return array<int, array<string, string>>
     */
    public function ways(): array
    {
        // Nothing to pay is not a choice of how to pay it. The view offers the
        // one button that finishes instead.
        if ($this->item()?->free() === true) {
            return [];
        }

        $out = [];

        foreach (array_keys(Gateways::enabled()) as $key) {
            $out[] = [
                'key' => $key,
                'name' => Gateways::label($key),
                'note' => Gateways::note($key),
                'provider' => Gateways::provider($key),
                'icon' => Gateways::icon($key),
            ];
        }

        return $out;
    }

    /** Whether this invoice costs nothing, and so needs no provider at all. */
    public function nothingToPay(): bool
    {
        return $this->item()?->free() === true;
    }

    /**
     * Finish an invoice that costs nothing.
     *
     * The same checks the provider path makes - it is theirs, it is still
     * unpaid - and then the same markPaid() a real payment would reach, so the
     * server is built and the customer told by the one road rather than by a
     * shortcut written beside it.
     */
    public function settle(): void
    {
        abort_unless(self::canAccess(), 403);

        $invoice = $this->item();

        if ($invoice === null || !$invoice->open() || !$invoice->free()) {
            $this->refuse();

            return;
        }

        if (!Invoices::settleFree($invoice)) {
            $this->refuse();

            return;
        }

        Notification::make()
            ->title(Theme::trans('shop.free_done'))
            ->body(Theme::trans('shop.free_done_body'))
            ->success()
            ->send();

        $this->redirect(Billing::getUrl());
    }

    /** What an administrator wrote about paying without a provider. */
    public function payNote(): string
    {
        return trim((string) Theme::config('shop_pay_note', ''));
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('ld_back')
                ->label(Theme::trans('shop.back_to_billing'))
                ->icon('tabler-arrow-left')
                ->color('gray')
                ->url(Billing::getUrl()),
        ];
    }

    /**
     * Send this person to a provider.
     *
     * Everything is checked again rather than trusted from the button: the
     * invoice is theirs, it is still unpaid, and the provider is still on. A
     * page left open in a tab has no claim on any of the three.
     */
    public function start(string $gateway): void
    {
        abort_unless(self::canAccess(), 403);

        $invoice = $this->item();
        $provider = Gateways::get($gateway);
        $user = user();

        if ($invoice === null || $provider === null || !$user instanceof User) {
            $this->refuse();

            return;
        }

        if (!$invoice->open()) {
            $this->refuse();

            return;
        }

        try {
            $url = $provider->start(
                $invoice,
                url('/essentials/pay/' . $gateway . '/return/' . (int) $invoice->id),
                url('/essentials/pay/' . $gateway . '/webhook'),
            );
        } catch (Throwable $exception) {
            report($exception);

            $url = null;
        }

        if ($url === null) {
            /*
             * A provider that is on but misconfigured is a sentence, never a
             * 500. The customer is told to try another way; the administrator
             * finds the reason on the Payments page and in the log.
             */
            $this->refuse();

            return;
        }

        $this->redirect($url);
    }

    private function refuse(): void
    {
        Notification::make()
            ->title(Theme::trans('shop.pay_refused'))
            ->body(Theme::trans('shop.pay_refused_body'))
            ->warning()
            ->persistent()
            ->send();
    }

    private function userId(): int
    {
        return (int) (user()?->id ?? 0);
    }
}
