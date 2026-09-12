{{--
    The shop, inside the panel.

    The same cards as the public page, drawn with the panel's own tokens so it
    belongs to whatever theme the reader is looking at. Every decision - the
    price sentence, whether there is one left, where Buy goes - is made in the
    page class; this file is markup.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $cards = $this->cards();

    $words = [
        'sold_out' => Theme::trans('shop.sold_out'),
        'wait_join' => Theme::trans('shop.wait_join'),
        'wait_listed' => Theme::trans('shop.wait_listed'),
        'wait_leave' => Theme::trans('shop.wait_leave'),
        'buy' => Theme::trans('shop.buy'),
        'left' => Theme::trans('packages.stock_left'),
        'empty' => Theme::trans('shop.store_empty'),
        'empty_body' => Theme::trans('shop.store_empty_body'),
        'search' => Theme::trans('shop.search'),
        'sort' => Theme::trans('shop.sort'),
        'sort_featured' => Theme::trans('shop.sort_featured'),
        'sort_price_up' => Theme::trans('shop.sort_price_up'),
        'sort_price_down' => Theme::trans('shop.sort_price_down'),
        'sort_name' => Theme::trans('shop.sort_name'),
        'none' => Theme::trans('shop.search_none'),
        'none_body' => Theme::trans('shop.search_none_body'),
        'basket' => Theme::trans('shop.basket_title'),
        'offer' => Theme::trans('shop.offer_flag'),
        'popular' => Theme::trans('shop.popular_flag'),
    ];

    $waiting = \LegendDevelopment\Theme\Support\Shop\Cart::count();
    $countLine = Theme::id() . '::shop.search_count';

    // Said once, above the grid's loop, because it is the same answer on every
    // card - and null when there is no tax at all, where the word would be a
    // sentence about nothing.
    $taxWord = \LegendDevelopment\Theme\Support\Shop\Purchase::taxRate() > 0
        ? Theme::trans(\LegendDevelopment\Theme\Support\Shop\Purchase::inclusive() ? 'shop.price_with_tax' : 'shop.price_without_tax')
        : null;
@endphp

<x-filament-panels::page>
    {{-- The way back to what is already picked out. Only when there is
         something in it: a basket with nothing in it is not news, and a link
         that is always there teaches people to stop seeing it. --}}
    @if ($waiting > 0)
        <p class="ld-store-basket-row">
            <a class="ld-store-basket" href="{{ \LegendDevelopment\Theme\Filament\App\Pages\Basket::getUrl() }}">
                <x-filament::icon icon="tabler-basket" class="ld-store-basket-icon" />
                {{ $words['basket'] }} ({{ $waiting }})
            </a>
        </p>
    @endif

    @if (count($cards) === 0)
        <div class="ld-shop-empty">
            <strong>{{ $words['empty'] }}</strong>
            <span>{{ $words['empty_body'] }}</span>
        </div>
    @else
        {{-- Hidden until the script shows it. Controls that do nothing are
             worse than no controls: somebody types into the box, nothing
             happens, and they conclude the shop is broken rather than that
             their browser is. --}}
        <div class="ld-shop-tools" id="ld-tools" hidden>
            <label class="ld-shop-search">
                <x-filament::icon icon="tabler-search" class="ld-shop-search-icon" />
                <input type="search" data-shop-search placeholder="{{ $words['search'] }}" aria-label="{{ $words['search'] }}">
            </label>

            <label class="ld-shop-sort">
                <span>{{ $words['sort'] }}</span>

                <select data-shop-sort>
                    <option value="">{{ $words['sort_featured'] }}</option>
                    <option value="price-up">{{ $words['sort_price_up'] }}</option>
                    <option value="price-down">{{ $words['sort_price_down'] }}</option>
                    <option value="name">{{ $words['sort_name'] }}</option>
                </select>
            </label>

            <p class="ld-shop-count" id="ld-count">{{ trans_choice($countLine, count($cards), ['count' => count($cards)]) }}</p>
        </div>

        {{-- Only ever shown by the script, and only when a search matched
             nothing. --}}
        <div class="ld-shop-empty" id="ld-none" hidden>
            <strong>{{ $words['none'] }}</strong>
            <span>{{ $words['none_body'] }}</span>
        </div>

        <div class="ld-shop-grid" id="ld-grid">
            @foreach ($cards as $card)
                <article class="ld-shop-card{{ $card['sold_out'] ? ' ld-shop-card--off' : '' }}{{ $card['on_offer'] ? ' ld-shop-card--offer' : '' }}"
                         data-name="{{ $card['name'] }}"
                         data-amount="{{ $card['amount'] }}">

                    {{-- One flag at most, and the offer wins: a package that is
                         both on offer and the popular one is on offer, and two
                         badges on one corner is a corner nobody reads. --}}
                    @if ($card['on_offer'])
                        <span class="ld-shop-flag ld-shop-flag--offer">
                            <x-filament::icon icon="tabler-rosette-discount" class="ld-shop-flag-icon" />
                            {{ $words['offer'] }}
                        </span>
                    @elseif ($card['popular'])
                        <span class="ld-shop-flag ld-shop-flag--popular">
                            <x-filament::icon icon="tabler-crown" class="ld-shop-flag-icon" />
                            {{ $words['popular'] }}
                        </span>
                    @endif
                    {{-- The picture, when the package or its egg has one. It is
                         decoration: alt is empty on purpose, because the name
                         is the next line and a screen reader reading both says
                         everything twice. --}}
                    @if ($card['art'] !== null)
                        {{-- The same picture twice, and the browser fetches it
                             once. The one underneath is blurred and cropped to
                             fill the box; the one on top is shown whole. That
                             is what lets a square logo and a wide banner sit in
                             one row without either being cut in half or
                             stretched - the space around it is filled with
                             itself rather than left as a bar. --}}
                        <div class="ld-shop-shot">
                            <img class="ld-shop-art-back" src="{{ $card['art'] }}" alt="" aria-hidden="true" loading="lazy">
                            <img class="ld-shop-art" src="{{ $card['art'] }}" alt="" loading="lazy">
                        </div>
                    @endif

                    <h2>{{ $card['name'] }}</h2>

                    @if ($card['description'] !== '')
                        <p class="ld-shop-about">{{ $card['description'] }}</p>
                    @endif

                    {{-- The price, and then everything else. A shop is a row of
                         prices somebody is comparing, so it is the biggest thing
                         on the card and it sits in the same place on every one
                         of them - which is what makes a row of cards readable
                         at a glance instead of one at a time. --}}
                    <p class="ld-shop-price">
                        @if ($card['was'] !== null)
                            <s class="ld-shop-was">{{ $card['was'] }}</s>
                        @endif

                        <strong>{{ $card['price'] }}</strong>
                        <span>{{ $card['per'] }}</span>

                        {{-- Whether the tax is in that number or goes on top of
                             it. A price with no such word beside it is a price
                             somebody has to guess at, and half of them guess
                             the way that suits them. --}}
                        @if ($taxWord !== null)
                            <span class="ld-shop-taxword">{{ $taxWord }}</span>
                        @endif
                    </p>

                    @if ($card['saved'] !== null)
                        <p class="ld-shop-saved">{{ $card['saved'] }}</p>
                    @endif

                    @if ($card['offer_from'] !== null)
                        <p class="ld-shop-offerfrom">{{ $card['offer_from'] }}</p>
                    @endif

                    @if ($card['setup'] !== null)
                        <p class="ld-shop-setup">{{ $card['setup'] }}</p>
                    @endif

                    {{-- The minimum term, when there is one. Above the specs
                         rather than beside the price: it is a commitment, and
                         somebody should read it before they decide, not after
                         they have already worked out what it costs. --}}
                    @if ($card['term'] !== null)
                        <p class="ld-shop-term">{{ $card['term'] }}</p>
                    @endif

                    <ul class="ld-shop-specs">
                        @foreach ($card['specs'] as $spec)
                            <li>{{ $spec }}</li>
                        @endforeach
                    </ul>

                    {{-- Only when it is limited and getting low. A card that says
                         "unlimited" on every package is noise; one that says
                         "two left" is the reason somebody decides today. --}}
                    @if ($card['left'] !== null && !$card['sold_out'])
                        <p class="ld-shop-left">{{ Theme::trans('packages.stock_left', ['count' => $card['left']]) }}</p>
                    @endif

                    @if ($card['sold_out'])
                        <span class="ld-shop-buy ld-shop-buy--off">
                            <x-filament::icon icon="tabler-ban" class="ld-shop-buy-icon" />
                            {{ $words['sold_out'] }}
                        </span>

                        {{-- And somewhere to ask about it, which is the whole
                             point of a card that cannot be bought. Leaving is
                             offered whenever they are on the list, even where
                             joining is closed, so nobody is ever stuck on
                             one. --}}
                        @if ($card['waiting'])
                            <p class="ld-shop-wait-note">
                                {{ $words['wait_listed'] }}

                                <button type="button"
                                        class="ld-shop-wait"
                                        wire:click="unwait({{ $card['id'] }})">
                                    {{ $words['wait_leave'] }}
                                </button>
                            </p>
                        @elseif ($card['waitable'])
                            <p class="ld-shop-wait-note">
                                <button type="button"
                                        class="ld-shop-wait"
                                        wire:click="wait({{ $card['id'] }})">
                                    <x-filament::icon icon="tabler-bell-plus" class="ld-shop-buy-icon" />
                                    {{ $words['wait_join'] }}
                                </button>
                            </p>
                        @endif
                    @else
                        <a class="ld-shop-buy" href="{{ $card['url'] }}">
                            <x-filament::icon icon="tabler-shopping-cart" class="ld-shop-buy-icon" />
                            {{ $words['buy'] }}
                        </a>
                    @endif
                </article>
            @endforeach
        </div>
    @endif

    @include(\LegendDevelopment\Theme\Support\Theme::id() . '::partials.shop-tools')

    <x-filament-actions::modals />
</x-filament-panels::page>
