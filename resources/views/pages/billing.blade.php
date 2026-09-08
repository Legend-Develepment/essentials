{{--
    Somebody's own orders and invoices.

    Two lists rather than one. An order is a thing you have - a server, a state,
    a next date. An invoice is a thing you owe or have paid. Putting them in one
    table would mean a row that is sometimes about a server and sometimes about
    money, and neither reader would find what they came for.

    While no payment provider is switched on, an unpaid invoice shows whatever
    the administrator wrote about how to pay. That is a supported way to run this
    rather than a placeholder.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $orders = $this->orders();
    $invoices = $this->invoices();
    $payNote = $this->payNote();
    $storeUrl = $this->storeUrl();
    $ways = $this->ways();

    $words = [
        'orders' => Theme::trans('shop.your_orders'),
        'invoices' => Theme::trans('shop.your_invoices'),
        'no_orders' => Theme::trans('shop.no_orders'),
        'no_orders_body' => Theme::trans('shop.no_orders_body'),
        'no_invoices' => Theme::trans('shop.no_invoices'),
        'to_store' => Theme::trans('shop.to_store'),
        'due' => Theme::trans('shop.renews'),
        'server' => Theme::trans('orders.column_server'),
        'open' => Theme::trans('invoices.open'),
        'how_to_pay' => Theme::trans('invoices.doc_how_to_pay'),
        'ask' => Theme::trans('shop.ask_how_to_pay'),
        'pay_with' => Theme::trans('shop.pay_with'),
    ];
@endphp

<x-filament-panels::page>
    @if ($this->owing() && count($ways) === 0 && $payNote !== '')
        <div class="ld-bill-pay">
            <strong>{{ $words['how_to_pay'] }}</strong>
            <p>{{ $payNote }}</p>
        </div>
    @elseif ($this->owing() && count($ways) === 0)
        <div class="ld-bill-pay">
            <strong>{{ $words['how_to_pay'] }}</strong>
            <p>{{ $words['ask'] }}</p>
        </div>
    @endif

    <section class="ld-bill">
        <h2>{{ $words['orders'] }}</h2>

        @if (count($orders) === 0)
            <div class="ld-shop-empty">
                <strong>{{ $words['no_orders'] }}</strong>
                <span>{{ $words['no_orders_body'] }}</span>

                @if ($storeUrl !== null)
                    <a href="{{ $storeUrl }}">{{ $words['to_store'] }}</a>
                @endif
            </div>
        @else
            <ul class="ld-bill-list">
                @foreach ($orders as $order)
                    <li>
                        <div class="ld-bill-row">
                            <span class="ld-bill-name">{{ $order['name'] }}</span>
                            <span class="ld-bill-badge ld-bill-badge--{{ $order['colour'] }}">{{ $order['state'] }}</span>
                        </div>

                        <div class="ld-bill-meta">
                            <span>{{ $order['price'] }}</span>

                            @if ($order['server'] !== null)
                                <span>{{ $words['server'] }}: {{ $order['server'] }}</span>
                            @endif

                            @if ($order['due'] !== null)
                                <span>{{ $words['due'] }} {{ $order['due'] }}</span>
                            @endif
                        </div>

                        @if ($order['note'] !== null)
                            <p class="ld-bill-note">{{ $order['note'] }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="ld-bill">
        <h2>{{ $words['invoices'] }}</h2>

        @if (count($invoices) === 0)
            <div class="ld-shop-empty">
                <strong>{{ $words['no_invoices'] }}</strong>
            </div>
        @else
            <ul class="ld-bill-list">
                @foreach ($invoices as $invoice)
                    <li>
                        <div class="ld-bill-row">
                            <span class="ld-bill-name">{{ $invoice['number'] }}</span>
                            <span class="ld-bill-badge ld-bill-badge--{{ $invoice['colour'] }}">{{ $invoice['state'] }}</span>
                        </div>

                        <div class="ld-bill-meta">
                            <span>{{ $invoice['total'] }}</span>
                            <span>{{ $invoice['kind'] }}</span>

                            @if ($invoice['due'] !== null && $invoice['open'])
                                <span>{{ $invoice['due'] }}</span>
                            @endif

                            <a href="{{ $invoice['url'] }}" target="_blank" rel="noopener">{{ $words['open'] }}</a>
                        </div>

                        {{-- One button per provider, and none at all when there
                             are none - which is the ordinary case on a panel
                             taking bank transfers. --}}
                        @if ($invoice['open'] && count($ways) > 0)
                            <div class="ld-bill-pay-row">
                                <span>{{ $words['pay_with'] }}</span>

                                @foreach ($ways as $key => $name)
                                    <button type="button"
                                            class="ld-bill-pay-btn"
                                            wire:click="pay({{ $invoice['id'] }}, '{{ $key }}')"
                                            wire:loading.attr="disabled">
                                        {{ $name }}
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <x-filament-actions::modals />
</x-filament-panels::page>
