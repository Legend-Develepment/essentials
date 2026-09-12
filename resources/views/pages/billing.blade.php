{{--
    Somebody's own invoices.

    What they hold is on the services page. That split is not tidying: "what do
    I have" is asked when a server is misbehaving and "what do I owe" is asked
    once a month, and one column holding both made each harder to find.

    While no payment provider is switched on, an unpaid invoice shows whatever
    the administrator wrote about how to pay. That is a supported way to run this
    rather than a placeholder.
--}}
@php
    use LegendDevelopment\Theme\Support\Money;
    use LegendDevelopment\Theme\Support\Theme;

    $invoices = $this->invoices();
    $payNote = $this->payNote();
    $storeUrl = $this->storeUrl();
    $payable = $this->payable();
    $credit = $this->credit();

    $words = [
        'no_invoices' => Theme::trans('shop.no_invoices'),
        'no_invoices_body' => Theme::trans('shop.no_invoices_body'),
        'to_store' => Theme::trans('shop.to_store'),
        'open' => Theme::trans('invoices.open'),
        'how_to_pay' => Theme::trans('invoices.doc_how_to_pay'),
        'ask' => Theme::trans('shop.ask_how_to_pay'),
        'pay' => Theme::trans('shop.pay_now'),
        'credit' => Theme::trans('credit.yours'),
        'credit_body' => Theme::trans('credit.yours_body'),
    ];
@endphp

<x-filament-panels::page>
    {{-- Only while nothing can be paid from a button, which is the ordinary
         case on a panel taking bank transfers. --}}
    @if ($this->owing() && !$payable)
        <div class="ld-bill-pay">
            <strong>{{ $words['how_to_pay'] }}</strong>
            <p>{{ $payNote !== '' ? $payNote : $words['ask'] }}</p>
        </div>
    @endif

    {{-- What the shop is holding for this customer.

         Above the invoices, because it changes what the invoices below mean:
         somebody looking at a bill for five euro when they have five euro here
         needs to be told that before they read the bill, not after. Drawn only
         when there is something to draw. --}}
    @if ($credit['held'] > 0)
        <div class="ld-bill-credit">
            <div>
                <strong>{{ $words['credit'] }}</strong>
                <span>{{ $words['credit_body'] }}</span>
            </div>

            <span class="ld-bill-credit-sum">
                {{ Money::format($credit['held'], $credit['currency']) }}
            </span>
        </div>
    @endif

    <section class="ld-bill">
        @if (count($invoices) === 0)
            <div class="ld-shop-empty">
                <strong>{{ $words['no_invoices'] }}</strong>
                <span>{{ $words['no_invoices_body'] }}</span>

                @if ($storeUrl !== null)
                    <a href="{{ $storeUrl }}">{{ $words['to_store'] }}</a>
                @endif
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

                        {{-- One link across to the payment page, and none at
                             all when no provider is on. --}}
                        @if ($invoice['open'] && $payable)
                            <div class="ld-bill-pay-row">
                                <a class="ld-bill-pay-btn" href="{{ $this->payUrl($invoice['id']) }}">
                                    {{ $words['pay'] }}
                                </a>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <x-filament-actions::modals />
</x-filament-panels::page>
