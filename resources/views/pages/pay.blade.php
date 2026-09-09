{{--
    One invoice, and every way there is to pay it.

    Two halves. The invoice on the left is what is being agreed to; the ways to
    pay on the right are the decision. On a phone they stack, invoice first,
    because reading what you owe before choosing how to pay it is the order
    anybody would do it in.

    Each way is a card with the provider's name and a line saying what it
    actually covers - a card, a bank, PayPal - because the company name alone
    tells a customer nothing.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $summary = $this->summary();
    $ways = $this->ways();
    $payNote = $this->payNote();

    $words = [
        'gone' => Theme::trans('shop.pay_gone'),
        'gone_body' => Theme::trans('shop.pay_gone_body'),
        'back' => Theme::trans('shop.back_to_billing'),
        'paid' => Theme::trans('shop.pay_already'),
        'paid_body' => Theme::trans('shop.pay_already_body'),
        'cancelled' => Theme::trans('shop.pay_withdrawn'),
        'cancelled_body' => Theme::trans('shop.pay_withdrawn_body'),
        'choose' => Theme::trans('shop.pay_choose'),
        'choose_body' => Theme::trans('shop.pay_choose_body'),
        'none' => Theme::trans('shop.pay_no_ways'),
        'free' => Theme::trans('shop.free'),
        'free_body' => Theme::trans('shop.free_body'),
        'free_go' => Theme::trans('shop.free_go'),
        'ask' => Theme::trans('shop.ask_how_to_pay'),
        'how' => Theme::trans('invoices.doc_how_to_pay'),
        'subtotal' => Theme::trans('invoices.doc_subtotal'),
        'discount' => Theme::trans('invoices.doc_discount'),
        'total' => Theme::trans('invoices.doc_total'),
        'due' => Theme::trans('invoices.doc_due'),
        'open_doc' => Theme::trans('invoices.open'),
        'safe' => Theme::trans('shop.pay_safe'),
    ];
@endphp

<x-filament-panels::page>
    @if ($summary === null)
        <div class="ld-shop-empty">
            <strong>{{ $words['gone'] }}</strong>
            <span>{{ $words['gone_body'] }}</span>
            <a href="{{ \LegendDevelopment\Theme\Filament\App\Pages\Billing::getUrl() }}">{{ $words['back'] }}</a>
        </div>
    @else
        <div class="ld-pay">
            {{-- What is owed. --}}
            <section class="ld-pay-invoice">
                <div class="ld-pay-head">
                    <h2>{{ $summary['number'] }}</h2>
                    <span>{{ $summary['kind'] }}</span>
                </div>

                <table class="ld-checkout-lines">
                    @foreach ($summary['lines'] as $line)
                        <tr>
                            <td>{{ $line['text'] ?? '' }}</td>
                            <td class="ld-checkout-money">{{ $summary['money']((int) ($line['amount'] ?? 0)) }}</td>
                        </tr>
                    @endforeach

                    <tr class="ld-checkout-sub">
                        <td>{{ $words['subtotal'] }}</td>
                        <td class="ld-checkout-money">{{ $summary['subtotal'] }}</td>
                    </tr>

                    @if ($summary['discount'] !== null)
                        <tr>
                            <td>
                                {{ $words['discount'] }}
                                @if ($summary['coupon'] !== '')
                                    ({{ $summary['coupon'] }})
                                @endif
                            </td>
                            <td class="ld-checkout-money">-{{ $summary['discount'] }}</td>
                        </tr>
                    @endif

                    @if ($summary['tax'] !== null)
                        <tr>
                            <td>{{ $summary['tax_label'] }}</td>
                            <td class="ld-checkout-money">{{ $summary['tax'] }}</td>
                        </tr>
                    @endif

                    <tr class="ld-checkout-total">
                        <td>{{ $words['total'] }}</td>
                        <td class="ld-checkout-money">{{ $summary['total'] }}</td>
                    </tr>
                </table>

                <p class="ld-pay-meta">
                    @if ($summary['due'] !== null && $summary['open'])
                        <span>{{ $words['due'] }} {{ $summary['due'] }}</span>
                    @endif

                    <a href="{{ $summary['url'] }}" target="_blank" rel="noopener">{{ $words['open_doc'] }}</a>
                </p>
            </section>

            {{-- And how to settle it. --}}
            <section class="ld-pay-ways">
                @if ($summary['paid'])
                    <div class="ld-pay-done">
                        <strong>{{ $words['paid'] }}</strong>
                        <span>{{ $words['paid_body'] }}</span>
                    </div>
                @elseif ($summary['cancelled'])
                    <div class="ld-pay-done ld-pay-done--quiet">
                        <strong>{{ $words['cancelled'] }}</strong>
                        <span>{{ $words['cancelled_body'] }}</span>
                    </div>
                {{-- Nothing to pay: a coupon took it all, or it never cost
                     anything. One button that finishes it, rather than a row of
                     providers none of which will accept nought. --}}
                @elseif ($this->nothingToPay())
                    <h2>{{ $words['free'] }}</h2>
                    <p class="ld-pay-lede">{{ $words['free_body'] }}</p>

                    <button type="button" class="ld-pay-free" wire:click="settle" wire:loading.attr="disabled">
                        {{ $words['free_go'] }}
                    </button>
                @elseif (count($ways) > 0)
                    <h2>{{ $words['choose'] }}</h2>
                    <p class="ld-pay-lede">{{ $words['choose_body'] }}</p>

                    <ul class="ld-pay-methods">
                        @foreach ($ways as $way)
                            <li>
                                {{-- The whole card is the button. A row where
                                     only three words at the end are clickable is
                                     a row people click the wrong part of. --}}
                                <button type="button"
                                        wire:click="start('{{ $way['key'] }}')"
                                        wire:loading.attr="disabled">
                                    <x-filament::icon :icon="$way['icon']" class="ld-pay-method-icon" />

                                    <span class="ld-pay-method-text">
                                        <strong>
                                            {{ $way['name'] }}

                                            {{-- The company behind it, small.
                                                 A customer is choosing "Card";
                                                 whoever runs the panel wants to
                                                 see which account that lands
                                                 in. --}}
                                            <em>{{ $way['provider'] }}</em>
                                        </strong>

                                        @if ($way['note'] !== '')
                                            <span>{{ $way['note'] }}</span>
                                        @endif
                                    </span>

                                    <x-filament::icon icon="tabler-arrow-right" class="ld-pay-method-go" />
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <p class="ld-pay-safe">
                        <x-filament::icon icon="tabler-lock" class="ld-pay-safe-icon" />
                        {{ $words['safe'] }}
                    </p>
                @else
                    {{-- No provider is switched on. That is a supported way to
                         run a shop, so the page says how instead of saying no. --}}
                    <h2>{{ $words['how'] }}</h2>

                    <div class="ld-bill-pay">
                        <p>{{ $payNote !== '' ? $payNote : $words['ask'] }}</p>
                    </div>

                    <p class="ld-pay-lede">{{ $words['none'] }}</p>
                @endif
            </section>
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
