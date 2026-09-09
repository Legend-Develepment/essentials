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
        'give' => Theme::trans('shop.give'),
        'give_end' => Theme::trans('shop.give_end'),
        'give_end_open' => Theme::trans('shop.give_end_open'),
        'give_now' => Theme::trans('shop.give_now'),
        'give_now_confirm' => Theme::trans('shop.give_now_confirm'),
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
                    @if ($service['art'] !== null)
                        <img class="ld-shop-art" src="{{ $service['art'] }}" alt="" loading="lazy">
                    @endif

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

                    {{-- What the panel knows about the machine, when that is
                         something other than "it is running". An order can be
                         active while its server is still installing. --}}
                    @if ($service['server_state'] !== null)
                        <p class="ld-bill-note">{{ $service['server_state'] }}</p>
                    @endif

                    @if ($service['note'] !== null)
                        <p class="ld-bill-note">{{ $service['note'] }}</p>
                    @endif

                    @if ($service['url'] !== null)
                        <a class="ld-shop-buy" href="{{ $service['url'] }}">{{ $words['open'] }}</a>
                    @else
                        <span class="ld-shop-buy ld-shop-buy--off">{{ $words['building'] }}</span>
                    @endif

                    {{-- And the way out, when the panel offers one.
                         Two of them, folded away: ending is the ordinary one
                         and stopping now is not, so neither is a button
                         somebody reaches by accident next to Open the
                         server. --}}
                    {{-- The way out, as a button rather than a grey line.
                         It was a summary that read like a caption and nobody
                         found it. Still shut until it is pressed, because the
                         two choices behind it are not things to put beside
                         Open the server - but the thing you press to see them
                         now looks like something you press. --}}
                    @if ($service['may_cancel'])
                        <details class="ld-bill-give">
                            <summary>
                                <x-filament::icon icon="tabler-circle-x" class="ld-bill-give-icon" />
                                {{ $words['give'] }}
                            </summary>

                            <p>
                                @if ($service['ends_on'] !== null)
                                    {{ Theme::trans('shop.give_end_body', ['date' => $service['ends_on']]) }}
                                @else
                                    {{ $words['give_end_open'] }}
                                @endif
                            </p>

                            @if ($service['ends_on'] !== null)
                                <button type="button"
                                        class="ld-bill-give-end"
                                        wire:click="give({{ $service['id'] }}, 'end')"
                                        wire:confirm="{{ Theme::trans('shop.give_end_confirm', ['date' => $service['ends_on']]) }}">
                                    {{ Theme::trans('shop.give_end_on', ['date' => $service['ends_on']]) }}
                                </button>
                            @endif

                            <button type="button"
                                    class="ld-bill-give-now"
                                    wire:click="give({{ $service['id'] }}, 'now')"
                                    wire:confirm="{{ $words['give_now_confirm'] }}">
                                {{ $words['give_now'] }}
                            </button>
                        </details>
                    @endif
                </article>
            @endforeach
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
