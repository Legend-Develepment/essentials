<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Settings;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What applies to the whole shop: the currency, the tax, the numbering, the
 * words on the public page.
 *
 * Its own page rather than a section of the main settings, and its own
 * persist() rather than the main one, for the reason the alerts page gives:
 * these are read by the shop and by nobody else, and a settings file handed to
 * another administrator to copy a colour scheme has no business carrying an
 * invoice prefix. The payment providers join this page in later releases, and
 * their keys will be the half of it that never leaves the panel at all.
 *
 * @property Schema $form
 */
class ShopSettings extends Page implements HasSchemas
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-building-store';

    protected static ?string $slug = 'essentials-shop';

    protected static ?int $navigationSort = 9;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        try {
            return Features::maySee(Features::SHOP) && Tables::ready();
        } catch (Throwable) {
            return false;
        }
    }

    public static function shouldRegisterNavigation(): bool
    {
        return self::canAccess() && parent::shouldRegisterNavigation();
    }

    public function getTitle(): string
    {
        return Theme::trans('shop.title');
    }

    public function getSubheading(): ?string
    {
        return Theme::trans('shop.subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('shop.nav_label');
    }

    /**
     * Its own group, named after the plugin with CMS after it - the shop is a
     * different kind of thing from the theme and sits under a different word.
     */
    public static function getNavigationGroup(): ?string
    {
        return Theme::name() . ' CMS';
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.shop-settings';
    }

    public function mount(): void
    {
        $this->form->fill(Settings::shopData());
    }

    public function form(Schema $schema): Schema
    {
        $may = Features::mayManage(Features::SHOP);
        $keys = Features::mayManage(Features::PAYMENTS);

        $currencies = [];

        foreach (Money::CURRENCIES as $code => $symbol) {
            $currencies[$code] = $code . ' ' . $symbol;
        }

        return $schema
            ->components([
                Section::make(Theme::trans('shop.section_general'))
                    ->description(Theme::trans('shop.section_general_helper'))
                    ->schema([
                        Select::make('shop_currency')
                            ->label(Theme::trans('shop.currency'))
                            ->helperText(Theme::trans('shop.currency_helper'))
                            ->options($currencies)
                            ->selectablePlaceholder(false)
                            ->disabled(!$may),

                        TextInput::make('shop_tax')
                            ->label(Theme::trans('shop.tax'))
                            ->helperText(Theme::trans('shop.tax_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01)
                            ->suffix(Theme::trans('shop.tax_suffix'))
                            ->disabled(!$may),

                        TextInput::make('shop_invoice_prefix')
                            ->label(Theme::trans('shop.prefix'))
                            ->helperText(Theme::trans('shop.prefix_helper'))
                            ->maxLength(12)
                            ->disabled(!$may),
                    ])
                    ->columns(['default' => 1, 'sm' => 3]),

                Section::make(Theme::trans('shop.section_renewals'))
                    ->description(Theme::trans('shop.section_renewals_helper'))
                    ->schema([
                        TextInput::make('shop_notice_days')
                            ->label(Theme::trans('shop.notice_days'))
                            ->helperText(Theme::trans('shop.notice_days_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(90)
                            ->suffix(Theme::trans('shop.days'))
                            ->disabled(!$may),

                        TextInput::make('shop_grace_days')
                            ->label(Theme::trans('shop.grace'))
                            ->helperText(Theme::trans('shop.grace_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(365)
                            ->suffix(Theme::trans('shop.days'))
                            ->disabled(!$may),
                    ])
                    ->columns(['default' => 1, 'sm' => 2]),

                Section::make(Theme::trans('shop.section_public'))
                    ->description(Theme::trans('shop.section_public_helper'))
                    ->schema([
                        TextInput::make('shop_heading')
                            ->label(Theme::trans('shop.heading'))
                            ->helperText(Theme::trans('shop.heading_helper'))
                            ->maxLength(80)
                            ->disabled(!$may),

                        TextInput::make('shop_terms_url')
                            ->label(Theme::trans('shop.terms_url'))
                            ->helperText(Theme::trans('shop.terms_url_helper'))
                            ->url()
                            ->maxLength(300)
                            ->disabled(!$may),

                        Textarea::make('shop_note')
                            ->label(Theme::trans('shop.note'))
                            ->helperText(Theme::trans('shop.note_helper'))
                            ->rows(2)
                            ->maxLength(400)
                            ->columnSpanFull()
                            ->disabled(!$may),
                    ])
                    ->columns(['default' => 1, 'sm' => 2]),

                Section::make(Theme::trans('shop.section_manual'))
                    ->description(Theme::trans('shop.section_manual_helper'))
                    ->schema([
                        Textarea::make('shop_pay_note')
                            ->label(Theme::trans('shop.pay_note'))
                            ->helperText(Theme::trans('shop.pay_note_helper'))
                            ->rows(3)
                            ->maxLength(1000)
                            ->disabled(!$may),
                    ])
                    ->columns(['default' => 1]),

                /*
                 * Mollie.
                 *
                 * Behind the payments permission rather than the shop one:
                 * setting a currency and holding a key that can take somebody's
                 * money are different amounts of trust, and the role editor can
                 * tell them apart.
                 *
                 * There is no test-mode switch. A Mollie key says in its own
                 * first characters which account it belongs to, and a second
                 * switch beside it is a second thing to get out of step.
                 */
                Section::make(Theme::trans('shop.section_mollie'))
                    ->description(Theme::trans('shop.section_mollie_helper') . ' ' . Theme::trans('shop.mollie_hook_helper', [
                        'url' => url('/essentials/pay/mollie/webhook'),
                    ]))
                    ->visible(Features::maySee(Features::PAYMENTS))
                    ->schema([
                        Toggle::make('shop_mollie_on')
                            ->label(Theme::trans('shop.mollie_on'))
                            ->helperText(Theme::trans('shop.mollie_on_helper'))
                            ->inline(false)
                            ->disabled(!$keys),

                        TextInput::make('shop_mollie_key')
                            ->label(Theme::trans('shop.mollie_key'))
                            ->helperText(Theme::trans('shop.mollie_key_helper'))
                            ->password()
                            ->revealable()
                            ->maxLength(128)
                            ->disabled(!$keys),

                    ])
                    ->columns(['default' => 1, 'sm' => 2]),

                /*
                 * Stripe.
                 *
                 * Two secrets, and they are not interchangeable: the API key
                 * opens a payment, the signing secret proves an event is
                 * really theirs. A panel with the first and not the second
                 * can take money and cannot be told about it, which is why
                 * both sit here with their own words.
                 */
                Section::make(Theme::trans('shop.section_stripe'))
                    ->description(Theme::trans('shop.section_stripe_helper') . ' ' . Theme::trans('shop.stripe_hook_helper', [
                        'url' => url('/essentials/pay/stripe/webhook'),
                    ]))
                    ->visible(Features::maySee(Features::PAYMENTS))
                    ->schema([
                        Toggle::make('shop_stripe_on')
                            ->label(Theme::trans('shop.stripe_on'))
                            ->helperText(Theme::trans('shop.stripe_on_helper'))
                            ->inline(false)
                            ->disabled(!$keys),

                        TextInput::make('shop_stripe_key')
                            ->label(Theme::trans('shop.stripe_key'))
                            ->helperText(Theme::trans('shop.stripe_key_helper'))
                            ->password()
                            ->revealable()
                            ->maxLength(128)
                            ->disabled(!$keys),

                        TextInput::make('shop_stripe_hook')
                            ->label(Theme::trans('shop.stripe_hook'))
                            ->helperText(Theme::trans('shop.stripe_hook_key_helper'))
                            ->password()
                            ->revealable()
                            ->maxLength(128)
                            ->disabled(!$keys)
                            ->columnSpanFull(),
                    ])
                    ->columns(['default' => 1, 'sm' => 2]),

                /*
                 * PayPal.
                 *
                 * The only one of the three with a sandbox switch, because it
                 * is the only one whose test and live accounts share a shape:
                 * a Mollie or Stripe key says in its own first characters
                 * which it is, and a PayPal client id does not.
                 */
                Section::make(Theme::trans('shop.section_paypal'))
                    ->description(Theme::trans('shop.section_paypal_helper') . ' ' . Theme::trans('shop.paypal_hook_helper', [
                        'url' => url('/essentials/pay/paypal/webhook'),
                    ]))
                    ->visible(Features::maySee(Features::PAYMENTS))
                    ->schema([
                        Toggle::make('shop_paypal_on')
                            ->label(Theme::trans('shop.paypal_on'))
                            ->helperText(Theme::trans('shop.paypal_on_helper'))
                            ->inline(false)
                            ->disabled(!$keys),

                        Toggle::make('shop_paypal_sandbox')
                            ->label(Theme::trans('shop.paypal_sandbox'))
                            ->helperText(Theme::trans('shop.paypal_sandbox_helper'))
                            ->inline(false)
                            ->disabled(!$keys),

                        TextInput::make('shop_paypal_id')
                            ->label(Theme::trans('shop.paypal_id'))
                            ->helperText(Theme::trans('shop.paypal_id_helper'))
                            ->maxLength(128)
                            ->disabled(!$keys),

                        TextInput::make('shop_paypal_secret')
                            ->label(Theme::trans('shop.paypal_secret'))
                            ->helperText(Theme::trans('shop.paypal_secret_helper'))
                            ->password()
                            ->revealable()
                            ->maxLength(128)
                            ->disabled(!$keys),

                        TextInput::make('shop_paypal_hook')
                            ->label(Theme::trans('shop.paypal_hook'))
                            ->helperText(Theme::trans('shop.paypal_hook_id_helper'))
                            ->maxLength(128)
                            ->disabled(!$keys)
                            ->columnSpanFull(),
                    ])
                    ->columns(['default' => 1, 'sm' => 2]),
            ])
            ->statePath('data');
    }

    /** @return array<int, Action> */
    protected function getHeaderActions(): array
    {
        if (!Features::mayManage(Features::SHOP)) {
            return [];
        }

        return [
            Action::make('ld_save')
                ->label(Theme::trans('shop.save'))
                ->icon('tabler-device-floppy')
                ->action(fn () => $this->save()),
        ];
    }

    public function save(): void
    {
        abort_unless(Features::mayManage(Features::SHOP), 403);

        try {
            Settings::persistShop($this->form->getState());
        } catch (Throwable $exception) {
            report($exception);

            Notification::make()
                ->title(Theme::trans('shop.save_failed'))
                ->body($exception->getMessage())
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        Notification::make()->title(Theme::trans('shop.saved'))->success()->send();
    }
}
