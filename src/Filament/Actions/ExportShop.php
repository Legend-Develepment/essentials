<?php

namespace LegendDevelopment\Theme\Filament\Actions;

use Filament\Actions\Action;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Shop\Export;
use LegendDevelopment\Theme\Support\Theme;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * The Export button on the shop's invoices, orders and customers pages.
 *
 * For whoever may read that list, because the file holds nothing the page does
 * not already show them. Asked again when it runs: the button is drawn once and
 * pressed later, by which time a role may have lost the grant.
 *
 * Behind a confirmation that says what is in the file, because it is every
 * customer's name and address in one download, and the one thing worth saying
 * before somebody saves that to a shared folder is that it is exactly that.
 */
class ExportShop
{
    /**
     * @param  string  $what     One of Export's INVOICES, ORDERS or CUSTOMERS.
     * @param  string  $feature  The Features key that decides who may read the list.
     */
    public static function make(string $what, string $feature): Action
    {
        return Action::make('ld_export')
            ->label(Theme::trans('shop.export'))
            ->icon('tabler-download')
            ->color('gray')
            ->requiresConfirmation()
            ->modalIcon('tabler-download')
            ->modalHeading(Theme::trans('shop.export'))
            ->modalDescription(Theme::trans('shop.export_helper'))
            ->modalSubmitActionLabel(Theme::trans('shop.export'))
            ->visible(static fn (): bool => Features::maySee($feature))
            ->action(static function () use ($what, $feature): StreamedResponse {
                abort_unless(Features::maySee($feature), 403);

                return Export::download($what);
            });
    }
}
