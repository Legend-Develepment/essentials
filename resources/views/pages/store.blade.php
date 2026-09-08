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
        'buy' => Theme::trans('shop.buy'),
        'left' => Theme::trans('packages.stock_left'),
        'empty' => Theme::trans('shop.store_empty'),
        'empty_body' => Theme::trans('shop.store_empty_body'),
    ];
@endphp

<x-filament-panels::page>
    @if (count($cards) === 0)
        <div class="ld-shop-empty">
            <strong>{{ $words['empty'] }}</strong>
            <span>{{ $words['empty_body'] }}</span>
        </div>
    @else
        <div class="ld-shop-grid">
            @foreach ($cards as $card)
                <article class="ld-shop-card">
                    {{-- The picture, when the package or its egg has one. It is
                         decoration: alt is empty on purpose, because the name
                         is the next line and a screen reader reading both says
                         everything twice. --}}
                    @if ($card['art'] !== null)
                        <img class="ld-shop-art" src="{{ $card['art'] }}" alt="" loading="lazy">
                    @endif

                    <h2>{{ $card['name'] }}</h2>

                    @if ($card['description'] !== '')
                        <p class="ld-shop-about">{{ $card['description'] }}</p>
                    @endif

                    <p class="ld-shop-price">
                        <strong>{{ $card['price'] }}</strong>
                        <span>{{ $card['per'] }}</span>
                    </p>

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
                        <span class="ld-shop-buy ld-shop-buy--off">{{ $words['sold_out'] }}</span>
                    @else
                        <a class="ld-shop-buy" href="{{ $card['url'] }}">{{ $words['buy'] }}</a>
                    @endif
                </article>
            @endforeach
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
