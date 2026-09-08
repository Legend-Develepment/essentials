<?php

namespace LegendDevelopment\Theme\Filament\App\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Collection;
use LegendDevelopment\Theme\Models\Package;
use LegendDevelopment\Theme\Support\Features;
use LegendDevelopment\Theme\Support\Money;
use LegendDevelopment\Theme\Support\Shop\Packages;
use LegendDevelopment\Theme\Support\Shop\Purchase;
use LegendDevelopment\Theme\Support\Shop\Tables;
use LegendDevelopment\Theme\Support\Theme;
use Throwable;

/**
 * What is for sale, to somebody who is signed in.
 *
 * The same list the public page shows, drawn inside the panel so that buying
 * is one click rather than a trip through a login. Nothing here is a decision:
 * every card leads to the checkout page, and the checkout page is where the
 * total and the terms are.
 *
 * No permission of its own, like the other client pages. What it shows is
 * public by definition - it is a shop - and gating it per role would mean an
 * administrator having to grant every customer the right to give them money.
 * The master switch is the shop feature, in one place.
 */
class Store extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'tabler-shopping-bag';

    protected static ?string $slug = 'store';

    protected static ?int $navigationSort = 80;

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
        return Theme::trans('shop.store_title');
    }

    public function getSubheading(): ?string
    {
        $note = trim((string) Theme::config('shop_note', ''));

        return $note !== '' ? $note : Theme::trans('shop.store_subheading');
    }

    public static function getNavigationLabel(): string
    {
        return Theme::trans('shop.store_nav_label');
    }

    public function getView(): string
    {
        return Theme::id() . '::pages.store';
    }

    /**
     * The cards, already answered.
     *
     * Everything the card needs is worked out here rather than in the view -
     * the price as a sentence, whether there is one left, where Buy goes - so
     * the Blade file is markup and the decisions are somewhere they can be
     * read.
     *
     * @return array<int, array<string, mixed>>
     */
    public function cards(): array
    {
        $currency = Packages::currency();
        $out = [];

        /** @var Collection<int, Package> $packages */
        $packages = Packages::live();

        foreach ($packages as $package) {
            $left = Packages::stockLeft($package);

            $out[] = [
                'id' => (int) $package->id,
                'name' => (string) $package->name,
                'description' => trim((string) $package->description),
                'price' => Money::format((int) $package->price, $currency),
                'per' => Theme::trans('packages.per_' . Packages::period($package->period)),
                'setup' => (int) $package->setup_fee > 0
                    ? Theme::trans('shop.plus_setup', [
                        'amount' => Money::format((int) $package->setup_fee, $currency),
                    ])
                    : null,
                'specs' => $this->specs($package),
                'left' => $left,
                'sold_out' => Purchase::refusal($package) !== null,
                'url' => Checkout::getUrl(['package' => (int) $package->id]),
            ];
        }

        return $out;
    }

    /**
     * The three or four numbers somebody actually compares.
     *
     * Memory, disk and CPU, in the units the panel uses everywhere else, plus
     * backups and databases when there are any. Not the whole limit list: a
     * card that lists eleven fields is a card nobody reads.
     *
     * @return array<int, string>
     */
    private function specs(Package $package): array
    {
        $out = [
            Theme::trans('shop.spec_memory', ['amount' => (int) $package->memory]),
            Theme::trans('shop.spec_disk', ['amount' => (int) $package->disk]),
            Theme::trans('shop.spec_cpu', ['amount' => (int) $package->cpu]),
        ];

        if ((int) $package->backup_limit > 0) {
            $out[] = Theme::trans('shop.spec_backups', ['count' => (int) $package->backup_limit]);
        }

        if ((int) $package->database_limit > 0) {
            $out[] = Theme::trans('shop.spec_databases', ['count' => (int) $package->database_limit]);
        }

        return $out;
    }
}
