<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Contracts\HasSchemas;
use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Addons;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Cart;
use LegendDevelopment\Theme\Support\Shop\Customers;
use LegendDevelopment\Theme\Support\Shop\Coupons;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Shop\Vat;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * Everything somebody picked out, and one button that buys the lot.
 *
 * The shop sold one package at a time for its first several releases, and the
 * reason is written on Checkout: an invoice covering two orders has to decide
 * what a refund, a suspension and a renewal each mean. Those are answered now -
 * a shared bill is one debt, so it suspends everything on it; a cancelled
 * service comes off any bill that has not been paid; and a renewal covers the
 * services that fall due on the same day. With those three settled, a basket is
 * just a list.
 *
 * The questions a package asks are not asked here. They are asked on Checkout,
 * once, and travel with the item - see Cart. A basket that asked them again
 * would be a second copy of a form that already exists, and the second copy is
 * always the one that falls behind.
 *
 * No permission of its own, like the rest of the client side. It shows what is
 * in this person's own session and buys it for the account they are signed in
 * as.
 */
class Basket extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-basket';

    protected static ?string $slug = 'basket';

    /** Reached from the store and from checkout, not from the sidebar. */
    protected static bool $shouldRegisterNavigation = false;

    /** What was typed in the coupon field, if anything. */
    public ?string $code = null;

    /**
     * A VAT number, for a business in another member state.
     *
     * Filled in by the customer and remembered from their last invoice, because
     * somebody who has one has it on every order and typing it again each time
     * is how it ends up mistyped once.
     */
    public ?string $vat = null;

    /** The code coupon() last went to the database for, and what it found. */
    private ?string $looked = null;

    private ?Coupon $found = null;

    public static function canAccess(): bool
    {
        try {
            return Cart::allowed() && Features::enabled(Features::SHOP) && Tables::ready() && user() !== null;
        } catch (Throwable) {
            return false;
        }
    }

    public function getTitle(): string
    {
        return Theme::trans('shop.basket_title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('shop.basket_subheading');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.basket';
    }

    public function mount(): void
    {
        /*
         * From the customer's own details rather than from their last invoice.
         *
         * Reading it back off a document was a way of remembering it before
         * there was anywhere to keep it. Now there is, and it is the same field
         * they can correct - a number recovered from an old invoice cannot be
         * corrected anywhere, which is exactly what somebody wants to do the
         * moment they notice a typo in it.
         */
        $this->vat = (string) (Customers::profile((int) (user()?->id ?? 0))->vat ?? '');
    }

    /**
     * What the page draws.
     *
     * @return array<string, mixed>
     */
    public function rows(): array
    {
        return Cart::items();
    }

    /**
     * The extras ticked on one item, priced.
     *
     * Through Addons::quoteLines(), which is the same method the quote itself
     * uses, so the line under a package and the total at the bottom cannot say
     * different things about the same extra.
     *
     * @param  array{package: Package, extras?: array<int, int>}  $item
     * @return array<int, array{text: string, amount: string}>
     */
    public function extras(array $item): array
    {
        $out = [];
        $currency = Packages::currency();

        foreach (Addons::quoteLines($item['package'], (array) ($item['extras'] ?? [])) as $line) {
            $out[] = [
                'text' => (string) $line['text'],
                'amount' => Money::format((int) $line['amount'], $currency),
            ];
        }

        return $out;
    }

    /**
     * What was filled in for one item, as something worth reading.
     *
     * Two things happen here. The egg's own name for a variable replaces the
     * env name, because SERVER_PASSWORD is what a server calls it and "Redis
     * Password" is what a person does. And anything that looks like a secret
     * is shown as dots.
     *
     * The masking is on the name rather than on anything the egg declares,
     * because an egg has no way to say "this one is a secret" - there is no
     * such rule in Pelican's variable rules, only text, a number or a choice.
     * So the name is the only signal there is, and a basket page is not worth
     * printing somebody's password on the screen behind them.
     *
     * @param  array{package: Package, answers: array<string, mixed>}  $item
     * @return array<int, array{label: string, value: string}>
     */
    public function answers(array $item): array
    {
        $answers = array_filter(
            $item['answers'],
            static fn (mixed $value): bool => trim((string) $value) !== '',
        );

        if ($answers === []) {
            return [];
        }

        $labels = [];

        try {
            foreach (($item['package']->egg?->variables ?? []) as $variable) {
                $name = trim((string) $variable->env_variable);

                if ($name !== '') {
                    $labels[$name] = trim((string) $variable->name) ?: $name;
                }
            }
        } catch (Throwable) {
            // No egg, or none readable. The env names are still true, they are
            // just uglier - which is better than a page that will not draw.
        }

        $out = [];

        foreach ($answers as $name => $value) {
            $out[] = [
                'label' => (string) ($labels[(string) $name] ?? $name),
                'value' => self::secret((string) $name)
                    ? str_repeat('•', min(12, max(4, mb_strlen((string) $value))))
                    : (string) $value,
            ];
        }

        return $out;
    }

    /** Whether a variable's name says it holds something private. */
    private static function secret(string $name): bool
    {
        foreach (['PASSWORD', 'SECRET', 'TOKEN', 'KEY', 'PASS', 'AUTH'] as $word) {
            if (str_contains(mb_strtoupper($name), $word)) {
                return true;
            }
        }

        return false;
    }

    /**
     * The total, through the same function that writes the invoice - so the
     * number somebody agrees to is the number on the document.
     *
     * @return array<string, mixed>
     */
    public function quote(): array
    {
        return Cart::quote($this->coupon(), (string) $this->vat);
    }

    /**
     * What the page says under the VAT field.
     *
     * Three answers rather than valid and invalid: nothing typed, a number this
     * shop will take the tax off for, and a number it will not. The third is
     * the one worth a sentence - a business that expected no VAT and is charged
     * it wants to know why before they pay, not after.
     */
    public function vatWord(): ?string
    {
        $vat = Vat::normalise($this->vat);

        if ($vat === '') {
            return null;
        }

        if (!Vat::looksValid($vat)) {
            return Theme::trans('shop.vat_shape');
        }

        if (!Vat::reverses($vat)) {
            // A domestic number, or a shop that has not said where it sells
            // from. Either way the tax is charged, and neither is an error.
            return Theme::trans('shop.vat_home');
        }

        return Vat::check($vat)
            ? Theme::trans('shop.vat_reverse')
            : Theme::trans('shop.vat_unknown');
    }

    /** Whether the sentence above is bad news, for the colour of it. */
    public function vatRefused(): bool
    {
        $vat = Vat::normalise($this->vat);

        return $vat !== '' && (!Vat::looksValid($vat) || (Vat::reverses($vat) && !Vat::check($vat)));
    }

    /**
     * The typed code, if it is one and it covers everything in the basket.
     *
     * Held for the code it was looked up for, because one render asks three
     * times - the total, the "code applied" line, and whether to say the code
     * was refused - and a discount code does not become a different code
     * between two of those. Keyed on what was typed, so a keystroke in the
     * field is a new question rather than a stale answer.
     */
    public function coupon(): ?Coupon
    {
        $typed = Coupons::normalise($this->code);

        if ($typed === '') {
            return null;
        }

        if ($this->looked === $typed) {
            return $this->found;
        }

        $this->looked = $typed;
        $this->found = null;

        $coupon = Coupons::find($typed);

        if ($coupon === null) {
            return null;
        }

        /*
         * The same rule placeMany() applies, asked here so the page can say no
         * while somebody is still looking at the field. A code tied to one
         * package cannot come off a total that covers three without inventing
         * a rule about which third of it - so it applies to all of the basket
         * or to none of it.
         */
        foreach (Cart::items() as $item) {
            if (!$coupon->covers((int) $item['package']->id)) {
                return null;
            }
        }

        return $this->found = $coupon;
    }

    /** Whether a code was typed and refused, which is what the page says. */
    public function badCode(): bool
    {
        return Coupons::normalise($this->code) !== '' && $this->coupon() === null;
    }

    public function remove(string $key): void
    {
        abort_unless(self::canAccess(), 403);

        Cart::remove($key);
    }

    public function empty(): void
    {
        abort_unless(self::canAccess(), 403);

        Cart::clear();
    }

    /**
     * Buy everything in it, on one invoice.
     *
     * Everything is checked again in here: a basket open in a tab for ten
     * minutes has no claim on the last one in stock, and placeMany() asks about
     * every item with its package row held.
     */
    public function buy(): void
    {
        abort_unless(self::canAccess(), 403);

        $user = user();
        $items = Cart::forPurchase();

        if (!$user instanceof User || $items === []) {
            $this->refuse(Purchase::EMPTY_BASKET);

            return;
        }

        $result = Purchase::placeMany($user, $items, $this->code, (string) $this->vat);

        if ($result['state'] !== Purchase::OK || $result['invoice'] === null) {
            $this->refuse($result['state']);

            return;
        }

        // Bought is out of the basket. Before the redirect, so a customer who
        // presses back does not find the same things sitting there waiting to
        // be bought a second time.
        Cart::clear();

        /*
         * A coupon that covered the whole of it leaves nothing to pay, and
         * nothing is not an amount any provider will take - so this one is
         * settled here rather than sent to a page offering cards it would then
         * have to refuse. Same road as a real payment: markPaid() is what
         * builds the servers and tells the customer.
         */
        if (Invoices::settleFree($result['invoice'])) {
            Notification::make()
                ->title(Theme::trans('shop.free_done'))
                ->success()
                ->send();

            $this->redirect(Billing::getUrl());

            return;
        }

        $this->redirect(Pay::getUrl(['invoice' => (int) $result['invoice']->id]));
    }

    /**
     * Why not, in a sentence the customer can act on.
     *
     * The states are the ones placeMany() answers with, and each has a line of
     * its own: "something went wrong" is not a thing anybody can do anything
     * about.
     */
    private function refuse(string $state): void
    {
        Notification::make()
            ->title(Theme::trans('shop.refused_' . $state))
            ->warning()
            ->persistent()
            ->send();
    }
}
