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
use LegendDevelopment\Theme\Support\Shop\Coupons;
use LegendDevelopment\Theme\Support\Shop\Delivery;
use LegendDevelopment\Theme\Support\Shop\Invoices;
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

        $quote = Purchase::quote($package, $this->coupon());

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

                $out[] = [
                    'name' => $name,
                    'label' => trim((string) $variable->name) ?: $name,
                    'help' => trim((string) $variable->description),
                    'value' => (string) ($this->answers[$name] ?? $variable->default_value ?? ''),
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

        if ($package->wantsUpload()) {
            $stored = $this->keep();

            if ($stored === null) {
                return;
            }
        }

        $result = Purchase::place($user, $package, $this->code, $this->answers, $stored);

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

        if (!$file instanceof TemporaryUploadedFile) {
            $this->refuse(Purchase::NO_FILE);

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
