<?php

namespace LegendDevelopment\Theme\Support\Shop;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use LegendDevelopment\Theme\Models\Customer;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * The customer's own details, inside the profile page's Account tab.
 *
 * They began as a button on the billing page, then briefly as a tab of their
 * own beside Account and 2FA. Both were wrong for the same reason: an address
 * is not something you do per invoice, and it is not big enough to be its own
 * chapter either. It belongs with your username, in a section you can fold
 * shut, on a page that already has eight tabs and does not need a ninth.
 *
 * **The fields ride Pelican's own save button.** They are named `ld_*` so they
 * cannot collide with a column on the user table, they are filled in
 * `fill()` and taken back out in `save()`, and what is left is the payload
 * Pelican expected. Taking them out is not optional politeness: anything still
 * in that array is handed to the user record, and a key that is not a column
 * there is an SQL error on somebody changing their password.
 *
 * This class only builds and moves the fields. The page that carries them is
 * `LegendDevelopment\Theme\Filament\Profile\Profile`, because reaching a tab
 * Pelican builds itself means subclassing the page - `registerCustomTabs()`
 * appends whole tabs and nothing appends to one.
 */
class Profile
{
    /**
     * The form keys, without their prefix.
     *
     * One list, because three things walk it and a field added to the schema
     * but not to this list is a field that fills blank and saves nothing.
     *
     * @var array<int, string>
     */
    private const FIELDS = ['company', 'address', 'postcode', 'city', 'country', 'phone', 'vat'];

    private const PREFIX = 'ld_';

    /**
     * What to add to the Account tab, or nothing at all.
     *
     * Folded shut on arrival. Somebody opening their profile is nearly always
     * there for their password or their language, and a block of seven empty
     * boxes above the fold makes that page longer for everybody so that it can
     * be shorter for the people who buy something.
     *
     * @return array<int, Section>
     */
    public static function components(): array
    {
        if (!Features::enabled(Features::SHOP)) {
            return [];
        }

        return [
            Section::make(Theme::trans('shop.details'))
                ->description(Theme::trans('shop.details_helper'))
                ->icon('tabler-address-book')
                ->collapsible()
                ->collapsed()
                ->schema([
                    /*
                     * What the shop is holding for them, above the fields.
                     *
                     * Read-only, and here rather than on a page of its own: this
                     * section is already the place where somebody's own money
                     * arrangements live, and a balance is the shortest thing to
                     * say about them. Adding to it is on the billing page, which
                     * the sentence under it points at.
                     */
                    Placeholder::make('ld_credit')
                        ->label(Theme::trans('credit.held'))
                        ->visible(static fn (): bool => Features::enabled(Features::CREDIT))
                        ->content(static fn (): string => Money::format(
                            Credits::mine(),
                            Packages::currency(),
                        ))
                        ->helperText(Theme::trans('credit.held_helper')),

                    TextInput::make(self::PREFIX . 'company')
                        ->label(Theme::trans('shop.details_company'))
                        ->helperText(Theme::trans('shop.details_company_helper'))
                        ->prefixIcon('tabler-building')
                        ->maxLength(191),

                    Textarea::make(self::PREFIX . 'address')
                        ->label(Theme::trans('shop.details_address'))
                        ->helperText(Theme::trans('shop.details_address_helper'))
                        ->rows(3)
                        ->maxLength(600),

                    TextInput::make(self::PREFIX . 'postcode')
                        ->label(Theme::trans('shop.details_postcode'))
                        ->prefixIcon('tabler-mailbox')
                        ->maxLength(32),

                    TextInput::make(self::PREFIX . 'city')
                        ->label(Theme::trans('shop.details_city'))
                        ->prefixIcon('tabler-building-community')
                        ->maxLength(120),

                    TextInput::make(self::PREFIX . 'country')
                        ->label(Theme::trans('shop.details_country'))
                        ->helperText(Theme::trans('shop.details_country_helper'))
                        ->prefixIcon('tabler-flag')
                        ->maxLength(2),

                    TextInput::make(self::PREFIX . 'phone')
                        ->label(Theme::trans('shop.details_phone'))
                        ->prefixIcon('tabler-phone')
                        ->tel()
                        ->maxLength(40),

                    TextInput::make(self::PREFIX . 'vat')
                        ->label(Theme::trans('shop.vat_number'))
                        ->helperText(Theme::trans('shop.details_vat_helper'))
                        ->prefixIcon('tabler-receipt-tax')
                        ->maxLength(32),
                ]),
        ];
    }

    /**
     * The saved details, as the form expects to read them.
     *
     * The address goes back as the text it was typed as: lines in the database,
     * a box on the screen, which are the same thing said two ways.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function fill(array $data): array
    {
        if (!Features::enabled(Features::SHOP)) {
            return $data;
        }

        try {
            $mine = Customers::profile((int) (user()?->id ?? 0));

            foreach (self::FIELDS as $field) {
                $data[self::PREFIX . $field] = $field === 'address'
                    ? implode("\n", $mine->lines())
                    : (string) ($mine->{$field} ?? '');
            }
        } catch (Throwable) {
            // A panel between the file swap and the install has no table to
            // read. Empty boxes are the honest answer; nothing is known yet.
        }

        return $data;
    }

    /**
     * Take our fields back out of the payload, and keep what was in them.
     *
     * The removal happens first and cannot fail, because everything left in
     * this array is about to be written to the user record. Saving our own half
     * is what is allowed to go wrong, and if it does the customer is told while
     * the rest of their profile still saves - losing a language change because
     * a postcode would not store is a worse trade than the one it prevents.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function save(array $data): array
    {
        $mine = [];

        foreach (self::FIELDS as $field) {
            $key = self::PREFIX . $field;

            if (array_key_exists($key, $data)) {
                $mine[$field] = $data[$key];
                unset($data[$key]);
            }
        }

        if ($mine === [] || !Features::enabled(Features::SHOP)) {
            return $data;
        }

        $id = (int) (user()?->id ?? 0);

        if ($id === 0) {
            return $data;
        }

        try {
            if (!Customers::save($id, $mine)) {
                Notification::make()
                    ->title(Theme::trans('shop.details_failed'))
                    ->danger()
                    ->send();
            }
        } catch (Throwable $exception) {
            report($exception);
        }

        return $data;
    }
}
