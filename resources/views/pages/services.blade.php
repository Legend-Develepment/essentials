{{--
    What this customer is paying for.

    Cards rather than a table, because a service is a thing you go to rather
    than a row you scan: the whole point of this page is the link into the
    server, and a link at the end of a table row is the hardest place to put it.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $services = $this->services();

    $words = [
        'empty' => Theme::trans('shop.no_orders'),
        'empty_body' => Theme::trans('shop.no_orders_body'),
        'to_store' => Theme::trans('shop.to_store'),
        'open' => Theme::trans('shop.open_server'),
        'building' => Theme::trans('shop.no_server_yet'),
        'renews' => Theme::trans('shop.renews'),
    ];

    $storeUrl = \LegendDevelopment\Theme\Filament\App\Pages\Store::canAccess()
        ? \LegendDevelopment\Theme\Filament\App\Pages\Store::getUrl()
        : null;
@endphp

<x-filament-panels::page>
    @if (count($services) === 0)
        <div class="ld-shop-empty">
            <strong>{{ $words['empty'] }}</strong>
            <span>{{ $words['empty_body'] }}</span>

            @if ($storeUrl !== null)
                <a href="{{ $storeUrl }}">{{ $words['to_store'] }}</a>
            @endif
        </div>
    @else
        <div class="ld-shop-grid">
            @foreach ($services as $service)
                <article class="ld-shop-card">
                    <div class="ld-bill-row">
                        <span class="ld-bill-name">{{ $service['name'] }}</span>
                        <span class="ld-bill-badge ld-bill-badge--{{ $service['colour'] }}">{{ $service['state'] }}</span>
                    </div>

                    <ul class="ld-shop-specs">
                        @foreach ($service['specs'] as $spec)
                            <li>{{ $spec }}</li>
                        @endforeach
                    </ul>

                    <p class="ld-shop-setup">
                        {{ $service['price'] }}

                        @if ($service['due'] !== null)
                            &middot; {{ $words['renews'] }} {{ $service['due'] }}
                        @endif
                    </p>

                    @if ($service['note'] !== null)
                        <p class="ld-bill-note">{{ $service['note'] }}</p>
                    @endif

                    @if ($service['url'] !== null)
                        <a class="ld-shop-buy" href="{{ $service['url'] }}">{{ $words['open'] }}</a>
                    @else
                        <span class="ld-shop-buy ld-shop-buy--off">{{ $words['building'] }}</span>
                    @endif
                </article>
            @endforeach
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
