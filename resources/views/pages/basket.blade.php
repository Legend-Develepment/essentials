@php
    use LegendDevelopment\Theme\Support\Money;
    use LegendDevelopment\Theme\Support\Theme;

    $rows = $this->rows();
    $quote = $this->quote();
    $currency = (string) ($quote['currency'] ?? '');

    // The field is only worth showing where there is tax to take off.
    $taxed = \LegendDevelopment\Theme\Support\Shop\Purchase::taxRate() > 0;
    $saved = \LegendDevelopment\Theme\Support\Shop\Cart::saved();

    $words = [
        'empty' => Theme::trans('shop.basket_empty'),
        'empty_body' => Theme::trans('shop.basket_empty_body'),
        'store' => Theme::trans('shop.back_to_store'),
        'remove' => Theme::trans('shop.basket_remove'),
        'clear' => Theme::trans('shop.basket_clear'),
        'buy' => Theme::trans('shop.basket_buy'),
        'buy_note' => Theme::trans('shop.place_order_note'),
        'more' => Theme::trans('shop.basket_more'),
        'coupon' => Theme::trans('shop.coupon'),
        'coupon_placeholder' => Theme::trans('shop.coupon_placeholder'),
        'coupon_bad' => Theme::trans('shop.coupon_bad'),
        'coupon_good' => Theme::trans('shop.coupon_good'),
        'subtotal' => Theme::trans('invoices.doc_subtotal'),
        'discount' => Theme::trans('invoices.doc_discount'),
        'tax' => Theme::trans('shop.tax'),
        'vat' => Theme::trans('shop.vat_number'),
        'vat_placeholder' => Theme::trans('shop.vat_placeholder'),
        'reverse' => Theme::trans('shop.vat_reverse_line'),
        'saved' => Theme::trans('shop.you_save'),
        'total' => Theme::trans('invoices.doc_total'),
    ];
@endphp

<x-filament-panels::page>
    @if (count($rows) === 0)
        {{-- An empty basket is not a failure and does not get an error's
             colours. It gets the one thing there is to do from here. --}}
        <div class="ld-shop-empty">
            <strong>{{ $words['empty'] }}</strong>
            <p>{{ $words['empty_body'] }}</p>

            <a class="ld-basket-more"
               href="{{ \LegendDevelopment\Theme\Filament\App\Pages\Store::getUrl() }}">
                <x-filament::icon icon="tabler-shopping-cart" class="ld-basket-icon" />
                {{ $words['store'] }}
            </a>
        </div>
    @else
        <div class="ld-basket">
            <ul class="ld-basket-items">
                @foreach ($rows as $row)
                    @php
                        $package = $row['package'];
                        $answers = $this->answers($row);
                        $extras = $this->extras($row);
                    @endphp

                    <li class="ld-basket-item">
                        <div class="ld-basket-item-text">
                            <strong>{{ $package->name }}</strong>

                            <span class="ld-basket-item-period">
                                {{ Theme::trans('packages.period_' . \LegendDevelopment\Theme\Support\Shop\Packages::period($package->period)) }}
                            </span>

                            {{-- What was filled in for this one, because two of
                                 the same package are two different servers and
                                 the answers are the only thing that says so. --}}
                            @if ($answers !== [])
                                <span class="ld-basket-item-answers">
                                    @foreach ($answers as $answer)
                                        <span class="ld-basket-answer">
                                            <span>{{ $answer['label'] }}</span>
                                            <strong>{{ $answer['value'] }}</strong>
                                        </span>
                                    @endforeach
                                </span>
                            @endif

                            {{-- And the extras ticked with it. On the line
                                 rather than only in the total, because an
                                 extra nobody can see on the thing they chose
                                 it for is an extra nobody checks. --}}
                            @if ($extras !== [])
                                <span class="ld-basket-item-answers">
                                    @foreach ($extras as $extra)
                                        <span class="ld-basket-answer">
                                            <span>{{ $extra['text'] }}</span>
                                            <strong>{{ $extra['amount'] }}</strong>
                                        </span>
                                    @endforeach
                                </span>
                            @endif
                        </div>

                        <div class="ld-basket-item-money">
                            {{-- What it was, where an offer has taken something
                                 off it. The line used to print the package's
                                 list price while the total below already had
                                 the offer in it - fifteen euros of total under
                                 ten euros of line, and nothing to say why. --}}
                            @if ($row['was'] !== null)
                                <s class="ld-basket-was">{{ Money::format((int) $row['was'], $currency) }}</s>
                            @endif

                            <span>{{ Money::format((int) $row['price'], $currency) }}</span>

                            @if ((int) $package->setup_fee > 0)
                                <span class="ld-basket-item-setup">
                                    {{ Theme::trans('packages.setup_fee') }}
                                    {{ Money::format((int) $package->setup_fee, $currency) }}
                                </span>
                            @endif
                        </div>

                        {{-- Named for a screen reader through aria-label
                             rather than a hidden span. The span carried
                             Tailwind's sr-only, which the panel only generates
                             for its own sources - so in a plugin's view it is
                             a class that does not exist, and the words sat in
                             the middle of the row in plain sight. --}}
                        <button type="button"
                                class="ld-basket-remove"
                                wire:click="remove('{{ $row['key'] }}')"
                                wire:loading.attr="disabled"
                                title="{{ $words['remove'] }}"
                                aria-label="{{ $words['remove'] }}">
                            <x-filament::icon icon="tabler-x" class="ld-basket-icon" />
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="ld-basket-sums">
                <label class="ld-basket-coupon">
                    <span class="ld-basket-coupon-label">{{ $words['coupon'] }}</span>

                    <input type="text"
                           wire:model.live.debounce.500ms="code"
                           placeholder="{{ $words['coupon_placeholder'] }}">

                    @if ($this->badCode())
                        <span class="ld-basket-coupon-bad">{{ $words['coupon_bad'] }}</span>
                    @elseif ($this->coupon() !== null)
                        <span class="ld-basket-coupon-good">{{ $words['coupon_good'] }}</span>
                    @endif
                </label>

                {{-- A business in another member state accounts for the tax
                     itself. Under the coupon because it is the same kind of
                     thing: something typed in that changes the total under it
                     as it is typed. --}}
                @if ($taxed)
                    <label class="ld-basket-coupon">
                        <span class="ld-basket-coupon-label">{{ $words['vat'] }}</span>

                        <input type="text"
                               wire:model.live.debounce.700ms="vat"
                               placeholder="{{ $words['vat_placeholder'] }}">

                        @if ($this->vatWord() !== null)
                            <span class="{{ $this->vatRefused() ? 'ld-basket-coupon-bad' : 'ld-basket-coupon-good' }}">
                                {{ $this->vatWord() }}
                            </span>
                        @endif
                    </label>
                @endif

                <dl>
                    <div>
                        <dt>{{ $words['subtotal'] }}</dt>
                        <dd>{{ Money::format((int) $quote['subtotal'], $currency) }}</dd>
                    </div>

                    @if ((int) $quote['discount'] > 0)
                        <div>
                            <dt>{{ $words['discount'] }}</dt>
                            <dd>−{{ Money::format((int) $quote['discount'], $currency) }}</dd>
                        </div>
                    @endif

                    @if ((int) $quote['tax'] > 0)
                        <div>
                            <dt>{{ $words['tax'] }}</dt>
                            <dd>{{ Money::format((int) $quote['tax'], $currency) }}</dd>
                        </div>
                    @elseif ($quote['reverse'] ?? false)
                        {{-- No amount beside it, because there is none: the tax
                             is the customer's to account for. --}}
                        <div>
                            <dt>{{ $words['reverse'] }}</dt>
                            <dd></dd>
                        </div>
                    @endif

                    <div class="ld-basket-total">
                        <dt>{{ $words['total'] }}</dt>
                        <dd>{{ Money::format((int) $quote['total'], $currency) }}</dd>
                    </div>

                    {{-- The one line somebody actually wants to read. A
                         discount nobody can see did not persuade anybody of
                         anything, and a shop that gives away a quarter of a
                         price should get the credit for it. --}}
                    @if ($saved > 0)
                        <div class="ld-basket-saved">
                            <dt>{{ $words['saved'] }}</dt>
                            <dd>{{ Money::format($saved, $currency) }}</dd>
                        </div>
                    @endif
                </dl>

                <button type="button"
                        class="ld-basket-buy"
                        wire:click="buy"
                        wire:loading.attr="disabled">
                    <x-filament::icon icon="tabler-file-invoice" class="ld-basket-icon" />
                    {{ $words['buy'] }}
                </button>

                <p class="ld-basket-note">{{ $words['buy_note'] }}</p>

                {{-- Both of these are buttons rather than words in a row. They
                     do things - one leaves the page, one throws the basket
                     away - and a thing that acts should look like it. The
                     second is quieter than the first, and quieter still than
                     Buy, because throwing away what somebody just picked out
                     is not the button they came here for. --}}
                <div class="ld-basket-links">
                    <a class="ld-basket-more"
                       href="{{ \LegendDevelopment\Theme\Filament\App\Pages\Store::getUrl() }}">
                        <x-filament::icon icon="tabler-plus" class="ld-basket-icon" />
                        {{ $words['more'] }}
                    </a>

                    <button type="button"
                            class="ld-basket-clear"
                            wire:click="empty"
                            wire:loading.attr="disabled">
                        <x-filament::icon icon="tabler-trash" class="ld-basket-icon" />
                        {{ $words['clear'] }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
