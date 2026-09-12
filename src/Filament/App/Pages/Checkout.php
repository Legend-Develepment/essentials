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
use LegendDevelopment\Theme\Models\Coupon;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Cart;
use LegendDevelopment\Theme\Support\Shop\Coupons;
use LegendDevelopment\Theme\Support\Shop\Delivery;
use LegendDevelopment\Theme\Support\Shop\Invoices;
use LegendDevelopment\Theme\Support\Shop\Addons;
use LegendDevelopment\Theme\Support\Shop\Customers;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Throwable;

/**
 * One package, what it costs, and the button that buys it.
 *
 * A single page for a single package rather than a basket. Somebody buying two
 * servers buys them one after the other, which is two orders, two invoices and
 * two servers - and is what they wanted anyway. A basket would exist to make
 * one invoice cover two orders, and an invoice covering two orders is a
 * refund, a suspension and a renewal that all have to decide which half they
 * mean.
 *
 * The total on this page comes from Purchase::quote(), which is the same
 * function that writes the invoice - so the number somebody agrees to is the
 * number on the document. Everything is checked again when Buy is pressed:
 * a page open for ten minutes has no claim on the last one in stock.
 */
class Checkout extends Page implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-shopping-cart';

    protected static ?string $slug = 'checkout';

    /** Reached from the store, not from the sidebar. */
    protected static bool $shouldRegisterNavigation = false;

    /** Which package. Comes in on the query string from the store page. */
    public ?int $package = null;

    /**
     * The buyer's VAT number, from their own details.
     *
     * Not a field on this page. It is a property of the customer rather than of
     * this purchase, it lives on their own details where they can correct it,
     * and a business asked for it at every till is a business that mistypes it
     * once.
     */
    public ?string $vat = null;

    /** What was typed in the coupon field, if anything. */
    public string $code = '';

    /**
     * What the customer filled in for the package's own questions, by env name.
     *
     * A plain array bound field by field, the way the coupon box is: this page
     * has never had a Filament form on it and one variable per package is not
     * the reason to give it one.
     *
     * @var array<string, string>
     */
    public array $answers = [];

    /**
     * The extras ticked, as addon id to quantity.
     *
     * Bound to the form rather than worked out from it, so a page reloaded
     * mid-thought keeps what was chosen. Everything in here is checked again
     * when the button is pressed - a form is where a mistake is prevented, not
     * where a rule is kept.
     *
     * @var array<int|string, mixed>
     */
    public array $extras = [];

    /** The zip, while it is still in the browser's hands. */
    public mixed $upload = null;

    /**
     * A ceiling on the upload, in megabytes.
     *
     * PHP's own upload_max_filesize almost always binds first and is the number
     * to change on a panel that needs more; this is here so a misconfigured PHP
     * cannot let somebody post a gigabyte at the panel's disk.
     */
    public const MAX_MB = 512;

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
        return Theme::trans('shop.checkout_title');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.checkout';
    }

    public function mount(): void
    {
        $this->package = (int) request()->integer('package');
        $this->vat = (string) (Customers::profile((int) (user()?->id ?? 0))->vat ?? '');
    }

    /** The package, if it is one and it is on sale. */
    public function item(): ?Package
    {
        if ($this->package === null || $this->package <= 0) {
            return null;
        }

        try {
            $package = Package::query()->find($this->package);
        } catch (Throwable) {
            return null;
        }

        return $package instanceof Package && $package->live ? $package : null;
    }

    /**
     * What this costs, with whatever is in the coupon field applied.
     *
     * Recomputed on every render, which is what makes the coupon field feel
     * like it does something. Nothing is written.
     *
     * @return array<string, mixed>|null
     */
    public function quote(): ?array
    {
        $package = $this->item();

        if ($package === null) {
            return null;
        }

        $quote = Purchase::quote($package, $this->coupon(), (string) $this->vat, 1, $this->extras);

        return [
            'lines' => $quote['lines'],
            'subtotal' => Money::format($quote['subtotal'], $quote['currency']),
            'discount' => $quote['discount'] > 0
                ? Money::format($quote['discount'], $quote['currency'])
                : null,
            'tax' => $quote['tax_rate'] > 0
                ? Money::format($quote['tax'], $quote['currency'])
                : null,
            'tax_label' => Theme::trans('shop.tax_line', [
                'rate' => rtrim(rtrim(number_format($quote['tax_rate'] / 100, 2, '.', ''), '0'), '.'),
            ]),
            'total' => Money::format($quote['total'], $quote['currency']),
            'currency' => $quote['currency'],
            'money' => static fn (int $minor): string => Money::format($minor, $quote['currency']),
        ];
    }

    /**
     * The extras on offer with this package, ready to draw.
     *
     * The price is what it costs every time it is charged, and the wording
     * beside it says which of the two kinds it is - a customer choosing between
     * "5.00 with every renewal" and "5.00 once" is choosing between two quite
     * different things.
     *
     * @return array<int, array<string, mixed>>
     */
    public function addons(): array
    {
        $package = $this->item();
        $currency = Packages::currency();
        $out = [];

        foreach (Addons::forPackage($package) as $addon) {
            $out[] = [
                'id' => (int) $addon->id,
                'name' => (string) $addon->name,
                'description' => (string) ($addon->description ?? ''),
                'price' => Money::format((int) $addon->price, $currency),
                'billing' => Theme::trans($addon->recurring() ? 'addons.billing_with' : 'addons.billing_once'),
                // One is a tick; more than one is a number to type.
                'max' => max(1, (int) $addon->max),
            ];
        }

        return $out;
    }

    /**
     * The package's own questions, ready to draw.
     *
     * From the egg's variables rather than from anything this plugin stores, so
     * the label and the help are the ones the egg's author wrote and a customer
     * reads the same sentence they would inside the panel.
     *
     * @return array<int, array<string, mixed>>
     */
    public function questions(): array
    {
        $package = $this->item();

        if ($package === null) {
            return [];
        }

        $wanted = Packages::asked($package);

        if ($wanted === []) {
            return [];
        }

        $out = [];

        try {
            foreach (($package->egg?->variables ?? []) as $variable) {
                $name = trim((string) $variable->env_variable);

                if ($name === '' || !in_array($name, $wanted, true)) {
                    continue;
                }

                $field = Packages::field(is_array($variable->rules) ? $variable->rules : []);

                $out[] = [
                    'name' => $name,
                    'label' => trim((string) $variable->name) ?: $name,
                    'help' => trim((string) $variable->description),
                    'value' => (string) ($this->answers[$name] ?? ''),
                    /*
                     * What the egg says the value can be. A variable listing
                     * two values gets a dropdown with two options rather than a
                     * box somebody types 'yes' into and a server that will not
                     * start.
                     */
                    'kind' => $field['kind'],
                    'options' => $field['options'],
                    'max' => $field['max'],
                    // Shown as the placeholder, so leaving a question alone is
                    // visibly the same as choosing what the egg already had.
                    'default' => (string) ($variable->default_value ?? ''),
                ];
            }
        } catch (Throwable) {
            return [];
        }

        return $out;
    }

    /** Whether this package wants a file, and what to call it on the page. */
    public function wantsFile(): bool
    {
        return $this->item()?->wantsUpload() === true;
    }

    public function fileLabel(): string
    {
        $own = trim((string) $this->item()?->upload_label);

        return $own !== '' ? $own : Theme::trans('shop.upload_default');
    }

    /** The code in the field, if it is a good one for this package. */
    public function coupon(): ?Coupon
    {
        if (!Features::enabled(Features::COUPONS) || trim($this->code) === '') {
            return null;
        }

        return Coupons::find($this->code, $this->item());
    }

    /** Whether a code was typed and is not one. Drawn as a red line, not a throw. */
    public function badCode(): bool
    {
        return Features::enabled(Features::COUPONS)
            && trim($this->code) !== ''
            && $this->coupon() === null;
    }

    public function couponsOn(): bool
    {
        return Features::enabled(Features::COUPONS);
    }

    /** The terms to agree to, if the panel has any. */
    public function terms(): ?string
    {
        $url = trim((string) Theme::config('shop_terms_url', ''));

        return $url === '' ? null : $url;
    }

    /** Why this cannot be bought right now, or null. */
    public function refusal(): ?string
    {
        $package = $this->item();

        if ($package === null) {
            return Purchase::GONE;
        }

        return Purchase::refusal($package);
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('ld_back')
                ->label(Theme::trans('shop.back_to_store'))
                ->icon('tabler-arrow-left')
                ->color('gray')
                ->url(Store::getUrl()),
        ];
    }

    /**
     * Buy it.
     *
     * Confirmation first, and the terms checkbox is part of that when the
     * panel has terms - agreeing to something is a thing somebody does on
     * purpose, not a checkbox they scrolled past.
     */
    /**
     * Put this package in the basket and go back for another.
     *
     * The same page, the same questions and the same upload as buying it - a
     * basket that asked its own questions would be a second place for the
     * per-package form to live, and the second one always drifts. So the answers
     * are filled in here, once, and travel with the item.
     *
     * Nothing is checked for stock here on purpose. A basket is a list of
     * intentions and an intention cannot hold the last one in stock; the till
     * asks about every item with the row held, which is where the question can
     * actually be answered.
     */
    public function basket(): void
    {
        abort_unless(self::canAccess() && Cart::allowed(), 403);

        $package = $this->item();

        if ($package === null) {
            $this->refuse(Purchase::GONE);

            return;
        }

        // The file first, for the same reason buy() takes it first: it is the
        // one thing that can be refused for a reason somebody can fix.
        $stored = null;

        if ($package->wantsUpload() && $this->upload !== null) {
            $stored = $this->keep();

            if ($stored === null) {
                return;
            }
        }

        // With the extras that were ticked on it. They used to be dropped here,
        // which meant choosing a package and its extras and then putting it in
        // the basket bought the package alone - unbilled, unbuilt and unsaid.
        if (!Cart::add($package, $this->answers, $stored, $this->extras)) {
            Notification::make()
                ->title(Theme::trans('shop.basket_full', ['count' => (string) Cart::MAX]))
                ->warning()
                ->send();

            return;
        }

        Notification::make()
            ->title(Theme::trans('shop.basket_added', ['name' => (string) $package->name]))
            ->success()
            ->send();

        $this->redirect(Store::getUrl());
    }

    /**
     * What is being bought, in the words the shop's own card used.
     *
     * The checkout used to name the package in a heading and say nothing else
     * about it - no picture, no specification, nothing a customer could check
     * they had clicked the right thing. A shop that shows you the product right
     * up until the moment you pay, and then stops, is a shop that makes people
     * go back a page to be sure.
     *
     * Read through the same helpers the store card uses, so the two cannot
     * describe one package differently.
     *
     * @return array<string, mixed>|null
     */
    public function product(): ?array
    {
        $package = $this->item();

        if ($package === null) {
            return null;
        }

        $now = Packages::priceNow($package);
        $list = max(0, (int) $package->price);

        return [
            'name' => (string) $package->name,
            'description' => trim((string) $package->description),
            'art' => Packages::art($package),
            'specs' => Packages::specs($package),
            'term' => Packages::termLabel($package),
            // What an offer takes off this one, for the line under the total.
            // Nought when there is no offer, or when it waits for a fuller
            // basket - which from this page it always does.
            'saved' => max(0, $list - $now),
        ];
    }

    /** Whether to draw the second button at all. */
    public function basketAllowed(): bool
    {
        return Cart::allowed();
    }

    public function buy(): void
    {
        abort_unless(self::canAccess(), 403);

        $package = $this->item();
        $user = user();

        if ($package === null || !$user instanceof User) {
            $this->refuse(Purchase::GONE);

            return;
        }

        /*
         * The file first, because it is the one thing that can be refused for a
         * reason the customer can fix. An order written and then a bad zip is
         * an order to unpick.
         */
        $stored = null;

        /*
         * Only when something was actually chosen. A package that asks for a
         * file is offering somewhere to put one, not demanding one before it
         * will sell - an administrator can always put a world in afterwards,
         * and refusing the sale is the worse of the two.
         */
        if ($package->wantsUpload() && $this->upload !== null) {
            $stored = $this->keep();

            if ($stored === null) {
                return;
            }
        }

        $result = Purchase::place(
            $user,
            $package,
            $this->code,
            $this->answers,
            $stored,
            (string) $this->vat,
            $this->extras,
        );

        if ($result['state'] !== Purchase::OK || $result['invoice'] === null) {
            $this->refuse($result['state']);

            return;
        }

        /*
         * A coupon that covered the whole of it leaves nothing to pay, and
         * nothing is not an amount any provider will take - so this one is
         * settled here rather than sent to a page offering cards it would then
         * have to refuse. Same road as a real payment: markPaid() is what
         * builds the server and tells the customer.
         */
        if (Invoices::settleFree($result['invoice'])) {
            Notification::make()
                ->title(Theme::trans('shop.free_done'))
                ->body(Theme::trans('shop.free_done_body'))
                ->success()
                ->persistent()
                ->send();

            $this->redirect(Billing::getUrl());

            return;
        }

        Notification::make()
            ->title(Theme::trans('shop.placed'))
            ->body(Theme::trans('shop.placed_body', ['number' => (string) $result['invoice']->number]))
            ->success()
            ->persistent()
            ->send();

        /*
         * To the payment page, not the printable document.
         *
         * Somebody who has just ordered wants to pay; the document is a link
         * on the page they land on. Sending them to the paper version first
         * was a step that read as "done" when it was not.
         */
        $this->redirect(Pay::getUrl(['invoice' => (int) $result['invoice']->id]));
    }

    /**
     * Put the customer's zip somewhere private until their server exists.
     *
     * On the local disk, never the public one: this is somebody's world save,
     * and a public disk is a directory the web server hands to anyone who asks.
     * Delivery gives the daemon a signed address for it instead.
     *
     * Answers null when there is nothing usable, having already said why.
     */
    private function keep(): ?string
    {
        $file = $this->upload;

        // Nothing chosen is not an error - buy() only calls this when there is
        // something. Something that is not a file is.
        if (!$file instanceof TemporaryUploadedFile) {
            $this->refuse(Purchase::NOT_ZIP);

            return null;
        }

        if (mb_strtolower((string) $file->getClientOriginalExtension()) !== 'zip') {
            $this->refuse(Purchase::NOT_ZIP);

            return null;
        }

        if ($file->getSize() > self::MAX_MB * 1024 * 1024) {
            $this->refuse(Purchase::TOO_BIG);

            return null;
        }

        try {
            $path = $file->store(Delivery::FOLDER, Delivery::DISK);
        } catch (Throwable $exception) {
            report($exception);

            $this->refuse(Purchase::NO_FILE);

            return null;
        }

        return is_string($path) && $path !== '' ? $path : null;
    }

    /** One sentence per way this can go wrong, all of them ordinary. */
    private function refuse(string $why): void
    {
        Notification::make()
            ->title(Theme::trans('shop.refused'))
            ->body(Theme::trans('shop.refused_' . $why))
            ->warning()
            ->persistent()
            ->send();
    }

    /** The package's own words, for the page heading. */
    public function heading(): string
    {
        $package = $this->item();

        return $package === null
            ? Theme::trans('shop.checkout_title')
            : (string) $package->name;
    }

    /**
     * The minimum term, when the package has one.
     *
     * Shown on this page rather than only on the card, because this is the
     * page with the button on it: somebody agreeing to a year should read the
     * word "year" on the screen where they agree.
     */
    public function term(): ?string
    {
        $package = $this->item();

        return $package === null ? null : Packages::termLabel($package);
    }

    /** "a month", "once" - the period, spelled out under the total. */
    public function period(): string
    {
        $package = $this->item();

        return $package === null
            ? ''
            : Theme::trans('packages.per_' . Packages::period($package->period));
    }
}
