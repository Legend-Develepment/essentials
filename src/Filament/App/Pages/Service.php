<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Filament\Concerns\ManagesServices;
use LegendDevelopment\Theme\Models\Order;
use LegendDevelopment\Theme\Models\Ticket;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Renewals;
use LegendDevelopment\Theme\Support\Shop\Summary;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use LegendDevelopment\Theme\Support\Tickets\Board;
use Throwable;

/**
 * One service, and everything about it in one place.
 *
 * The list of cards answers "what do I have". This answers the question
 * somebody actually arrives with: *what is happening with this one.* A card
 * could carry the specs and a price, and every further question - what have I
 * been billed for it, what did I ask about it, what can I change, when does it
 * stop - was either squeezed onto the card or answered nowhere.
 *
 * **Nothing here is new work.** What a service is comes from Shop\Summary and
 * what can be done to one from the ManagesServices trait, both of which the
 * list page uses for exactly the same things. Pressing the same button in two
 * places cannot do two different things, and the two screens cannot describe
 * one service differently.
 *
 * **Reached by the query string, like Pay.** Filament would register a slug
 * with a parameter, but the route name would carry the braces, the navigation
 * builder resolves a page's address with no parameters at all, and there is
 * nothing constraining `/service/abc` to a number. A fixed slug and an id read
 * once in mount() is the pattern this panel already has, and it has it for
 * these reasons.
 *
 * **Somebody else's service answers the same as one that was never there.** An
 * id in an address is an id somebody will edit, and telling the two apart would
 * let them count how many services this panel has sold.
 */
class Service extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;
    use ManagesServices;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-server-2';

    protected static ?string $slug = 'service';

    /** Reached from a service, not from the sidebar. */
    protected static bool $shouldRegisterNavigation = false;

    /** Which service. Comes in on the query string. */
    public ?int $order = null;

    public static function canAccess(): bool
    {
        try {
            return Features::enabled(Features::SHOP) && Tables::ready() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function mount(): void
    {
        $this->order = (int) request()->integer('order');
    }

    public function getTitle(): string
    {
        $order = $this->item();

        if ($order === null) {
            return Theme::trans('shop.service_title');
        }

        $spec = is_array($order->spec) ? $order->spec : [];

        return trim((string) ($spec['name'] ?? '')) ?: Theme::trans('orders.gone_package');
    }

    public function getSubheading(): ?string
    {
        return $this->item() === null ? null : Theme::trans('shop.service_subheading');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.service';
    }

    /** The service, if it exists and is theirs. */
    public function item(): ?Order
    {
        return $this->mine((int) ($this->order ?? 0));
    }

    /**
     * The card, the way the list draws it.
     *
     * The same description, from the same place, so the two screens cannot
     * disagree about what a service is.
     *
     * @return array<string, mixed>|null
     */
    public function card(): ?array
    {
        $order = $this->item();

        if ($order === null) {
            return null;
        }

        $row = Summary::card($order);
        $row['ask'] = $this->askUrl($order);
        $row['stuck'] = Summary::stuck($order);

        return $row;
    }

    /**
     * What this service will be billed next time, before it is.
     *
     * Null for anything that is not going to be billed again - a one-off, a
     * cancelled service - because a date on a service that has no next bill is
     * a promise nobody made.
     *
     * @return array<string, mixed>|null
     */
    public function next(): ?array
    {
        $order = $this->item();
        $quote = $order === null ? null : Renewals::quote($order);

        if ($quote === null) {
            return null;
        }

        $currency = (string) ($order?->currency ?? '');
        $money = is_array($quote['money']) ? $quote['money'] : [];

        $lines = [];

        foreach ($quote['lines'] as $line) {
            $lines[] = [
                'text' => (string) ($line['text'] ?? ''),
                'amount' => Money::format((int) ($line['amount'] ?? 0), $currency),
            ];
        }

        return [
            'lines' => $lines,
            'total' => Money::format((int) ($money['total'] ?? 0), $currency),
            'due' => $quote['due_at']?->toFormattedDateString(),
            /*
             * Said out loud, because it is the one thing about a renewal that
             * surprises people: bills are bundled per customer, per currency,
             * per day, so somebody with two services falling due together gets
             * one document for both.
             */
            'bundled' => Theme::trans('shop.service_next_bundled'),
        ];
    }

    /**
     * What this service has been billed, and what came back off it.
     *
     * The share rather than the total wherever a bill covers more than this
     * one service: a basket or a bundled renewal is two services' money, and
     * adding totals up would tell somebody this service cost twice what it did.
     *
     * @return array<string, mixed>
     */
    public function bills(): array
    {
        $order = $this->item();

        if ($order === null) {
            return ['invoices' => [], 'notes' => [], 'owing' => false];
        }

        $invoices = Invoices::forOrder($order, null, [], 50);
        $rows = [];
        $owing = false;

        foreach ($invoices as $invoice) {
            $share = null;

            try {
                // Only where the pairing table knows this order's part of it.
                $pivot = $invoice->pivot;
                $share = $pivot === null ? null : (int) ($pivot->amount ?? 0);
            } catch (Throwable) {
                $share = null;
            }

            $rows[] = Invoices::row($invoice, $share);

            if ($invoice->open()) {
                $owing = true;
            }
        }

        $notes = [];

        foreach (Invoices::notesFor($invoices->pluck('id')->all()) as $note) {
            $notes[] = Invoices::row($note);
        }

        return ['invoices' => $rows, 'notes' => $notes, 'owing' => $owing];
    }

    /**
     * What has been asked about this service.
     *
     * Its own query rather than the customer's whole list filtered, because
     * that list is capped before anything is filtered.
     *
     * @return array<int, array<string, mixed>>
     */
    public function asked(): array
    {
        $order = $this->item();

        if ($order === null) {
            return [];
        }

        $out = [];

        foreach (Board::about((int) (user()?->id ?? 0), (int) $order->id) as $ticket) {
            $out[] = [
                'id' => (int) $ticket->id,
                'number' => $ticket->number(),
                'subject' => (string) $ticket->subject,
                'state' => Theme::trans('tickets.state_' . $ticket->state),
                /*
                 * The words the badge rules actually know. The customer's
                 * ticket list says amber and green, which fall through to grey
                 * because no rule was ever written for them.
                 */
                'colour' => match ($ticket->state) {
                    Ticket::OPEN => 'warning',
                    Ticket::ANSWERED => 'success',
                    default => 'gray',
                },
                'when' => $ticket->last_at?->diffForHumans(),
            ];
        }

        return $out;
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        $order = $this->item();

        $out = [
            Action::make('ld_back')
                ->label(Theme::trans('shop.service_back'))
                ->icon('tabler-arrow-left')
                ->color('gray')
                ->url(Services::getUrl()),
        ];

        // Straight into the server, where there is one to go into.
        $server = $order?->server;

        if ($server !== null) {
            try {
                $out[] = Action::make('ld_open_server')
                    ->label(Theme::trans('shop.open_server'))
                    ->icon('tabler-external-link')
                    ->url(url('/server/' . $server->uuid_short));
            } catch (Throwable) {
                // A link is the one part of this worth nothing on its own.
            }
        }

        $ask = $order === null ? null : $this->askUrl($order);

        if ($ask !== null) {
            $out[] = Action::make('ld_ask')
                ->label(Theme::trans('tickets.ask_about'))
                ->icon('tabler-lifebuoy')
                ->color('gray')
                ->url($ask);
        }

        return $out;
    }
}
