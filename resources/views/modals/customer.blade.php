{{--
    One customer: what they hold, and what they have been billed.

    Four numbers across the top, then the two lists. The numbers are the answer
    to "who is this" at a glance; the lists are the answer to whatever the
    ticket is actually about.
--}}
@php
    use LegendDevelopment\Theme\Support\Money;
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'services' => Theme::trans('customers.column_services'),
        'servers' => Theme::trans('customers.servers'),
        'spent' => Theme::trans('customers.column_spent'),
        'outstanding' => Theme::trans('customers.column_outstanding'),
        'since' => Theme::trans('customers.since'),
        'their_services' => Theme::trans('customers.their_services'),
        'their_invoices' => Theme::trans('customers.their_invoices'),
        'no_services' => Theme::trans('customers.no_services'),
        'no_invoices' => Theme::trans('customers.no_invoices'),
        'server' => Theme::trans('orders.column_server'),
        'renews' => Theme::trans('shop.renews'),
        'open' => Theme::trans('invoices.open'),
    ];
@endphp

<div class="ld-person">
    <dl class="ld-person-figures">
        <div>
            <dt>{{ $words['services'] }}</dt>
            <dd>{{ $summary['services'] }}</dd>
        </div>

        <div>
            <dt>{{ $words['servers'] }}</dt>
            <dd>{{ $summary['servers'] }}</dd>
        </div>

        <div>
            <dt>{{ $words['spent'] }}</dt>
            <dd>{{ Money::format((int) $summary['spent'], $currency) }}</dd>
        </div>

        <div>
            <dt>{{ $words['outstanding'] }}</dt>
            <dd @class(['ld-person-owed' => (int) $summary['outstanding'] > 0])>
                {{ Money::format((int) $summary['outstanding'], $currency) }}
            </dd>
        </div>
    </dl>

    <section class="ld-person-list">
        <h3>{{ $words['their_services'] }}</h3>

        @if (count($services) === 0)
            <p class="ld-person-none">{{ $words['no_services'] }}</p>
        @else
            <ul>
                @foreach ($services as $service)
                    <li>
                        <div class="ld-bill-row">
                            <span class="ld-bill-name">{{ $service['name'] }}</span>
                            <span class="ld-bill-badge ld-bill-badge--{{ $service['colour'] }}">{{ $service['state'] }}</span>
                        </div>

                        <div class="ld-bill-meta">
                            <span>{{ $service['price'] }}</span>

                            @if ($service['server'] !== null)
                                <span>{{ $words['server'] }}: {{ $service['server'] }}</span>
                            @endif

                            @if ($service['due'] !== null)
                                <span>{{ $words['renews'] }} {{ $service['due'] }}</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="ld-person-list">
        <h3>{{ $words['their_invoices'] }}</h3>

        @if (count($invoices) === 0)
            <p class="ld-person-none">{{ $words['no_invoices'] }}</p>
        @else
            <ul>
                @foreach ($invoices as $invoice)
                    <li>
                        <div class="ld-bill-row">
                            <span class="ld-bill-name">{{ $invoice['number'] }}</span>
                            <span class="ld-bill-badge ld-bill-badge--{{ $invoice['colour'] }}">{{ $invoice['state'] }}</span>
                        </div>

                        <div class="ld-bill-meta">
                            <span>{{ $invoice['total'] }}</span>
                            <span>{{ $invoice['kind'] }}</span>

                            @if ($invoice['due'] !== null)
                                <span>{{ $invoice['due'] }}</span>
                            @endif

                            <a href="{{ $invoice['url'] }}" target="_blank" rel="noopener">{{ $words['open'] }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
