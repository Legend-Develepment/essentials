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
        'who' => Theme::trans('customers.who'),
        'vat' => Theme::trans('invoices.doc_vat'),
        'phone' => Theme::trans('shop.details_phone'),
        'their_services' => Theme::trans('customers.their_services'),
        'their_invoices' => Theme::trans('customers.their_invoices'),
        'no_services' => Theme::trans('customers.no_services'),
        'no_invoices' => Theme::trans('customers.no_invoices'),
        'server' => Theme::trans('orders.column_server'),
        'renews' => Theme::trans('shop.renews'),
        'open' => Theme::trans('invoices.open'),
        'credit' => Theme::trans('credit.held'),
        'no_credit' => Theme::trans('credit.none_held'),
        'movements' => Theme::trans('credit.movements'),
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

    {{-- Who they are, where they have said so.
         Above the lists because it answers a different question: those say what
         somebody has bought, this says who bought it - and a question about an
         invoice is usually really a question about this. Nothing is drawn for a
         customer who has filled nothing in; an empty block of labels is worse
         than no block. --}}
    @if ($profile->addressed() || ($profile->vat ?? '') !== '' || ($profile->company ?? '') !== '')
        <section class="ld-person-who">
            <h3>{{ $words['who'] }}</h3>

            <address>
                @if (($profile->company ?? '') !== '')
                    <strong>{{ $profile->company }}</strong>
                @endif

                @foreach ($profile->lines() as $line)
                    <span>{{ $line }}</span>
                @endforeach

                @if (trim(($profile->postcode ?? '') . ' ' . ($profile->city ?? '')) !== '')
                    <span>{{ trim(($profile->postcode ?? '') . ' ' . ($profile->city ?? '')) }}</span>
                @endif

                @if (($profile->country ?? '') !== '')
                    <span>{{ $profile->country }}</span>
                @endif
            </address>

            <dl>
                @if (($profile->vat ?? '') !== '')
                    <div>
                        <dt>{{ $words['vat'] }}</dt>
                        <dd>{{ $profile->vat }}</dd>
                    </div>
                @endif

                @if (($profile->phone ?? '') !== '')
                    <div>
                        <dt>{{ $words['phone'] }}</dt>
                        <dd>{{ $profile->phone }}</dd>
                    </div>
                @endif
            </dl>
        </section>
    @endif

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

    {{-- What the shop is holding for them, and every movement of it.

         Below the invoices rather than above, because it is the smaller
         question: most customers have none of this, and an empty block above
         the list they came here for would push it down for everybody. Drawn at
         all only when there is something to draw. --}}
    @if ($credit !== 0 || count($movements) > 0)
        <section class="ld-person-list">
            <h3>{{ $words['credit'] }}</h3>

            <p class="ld-person-credit">
                {{ $credit > 0 ? Money::format($credit, $currency) : $words['no_credit'] }}
            </p>

            @if (count($movements) > 0)
                <ul>
                    @foreach ($movements as $movement)
                        <li>
                            <div class="ld-bill-row">
                                <span class="ld-bill-name">
                                    {{ $movement->reason !== null && $movement->reason !== '' ? $movement->reason : $words['movements'] }}
                                </span>

                                {{-- The sign carries the meaning, so it is
                                     written out rather than left to a colour
                                     somebody may not be able to tell apart. --}}
                                <span class="ld-bill-badge ld-bill-badge--{{ $movement->added() ? 'green' : 'grey' }}">
                                    {{ $movement->added() ? '+' : '-' }}{{ Money::format(abs((int) $movement->amount), $currency) }}
                                </span>
                            </div>

                            <div class="ld-bill-meta">
                                <span>{{ $movement->created_at?->toFormattedDateString() }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif

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
