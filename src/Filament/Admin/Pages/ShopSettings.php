<?php

namespace LegendDevelopment\Theme\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
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
