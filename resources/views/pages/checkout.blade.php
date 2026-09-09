{{--
    One package, its total, and the button.

    The coupon field is wired with wire:model.live, so a code that works changes
    the total under it as it is typed and a code that does not gets a line
    saying so. Nothing is written until Buy is pressed, and Buy checks
    everything again - the quote on this page is arithmetic, not a reservation.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $quote = $this->quote();
    $refusal = $this->refusal();
    $terms = $this->terms();
    $questions = $this->questions();

    $words = [
        'gone' => Theme::trans('shop.refused_gone'),
        'sold_out' => Theme::trans('shop.refused_sold_out'),
        'coupon' => Theme::trans('shop.coupon'),
        'asks' => Theme::trans('shop.asks'),
        'upload_help' => Theme::trans('shop.upload_help'),
        'upload_busy' => Theme::trans('shop.upload_busy'),
        'what' => Theme::trans('shop.what_is_this'),
        'leave' => Theme::trans('shop.leave_as_is'),
        'optional' => Theme::trans('shop.asks_optional'),
        'coupon_placeholder' => Theme::trans('shop.coupon_placeholder'),
        'coupon_bad' => Theme::trans('shop.coupon_bad'),
        'coupon_good' => Theme::trans('shop.coupon_good'),
        'subtotal' => Theme::trans('invoices.doc_subtotal'),
        'discount' => Theme::trans('invoices.doc_discount'),
        'total' => Theme::trans('invoices.doc_total'),
        'buy' => Theme::trans('shop.place_order'),
        'buy_note' => Theme::trans('shop.place_order_note'),
        'agree' => Theme::trans('shop.agree'),
        'terms' => Theme::trans('shop.terms'),
        'back' => Theme::trans('shop.back_to_store'),
    ];
@endphp

<x-filament-panels::page>
    @if ($quote === null || $refusal !== null)
        <div class="ld-shop-empty">
            <strong>{{ $refusal === 'sold_out' ? $words['sold_out'] : $words['gone'] }}</strong>
            <a href="{{ \LegendDevelopment\Theme\Filament\App\Pages\Store::getUrl() }}">{{ $words['back'] }}</a>
        </div>
    @else
        <div class="ld-checkout">
            <h2>{{ $this->heading() }}</h2>

            <table class="ld-checkout-lines">
                @foreach ($quote['lines'] as $line)
                    <tr>
                        <td>{{ $line['text'] }}</td>
                        <td class="ld-checkout-money">{{ $quote['money']((int) $line['amount']) }}</td>
                    </tr>
                @endforeach

                <tr class="ld-checkout-sub">
                    <td>{{ $words['subtotal'] }}</td>
                    <td class="ld-checkout-money">{{ $quote['subtotal'] }}</td>
                </tr>

                @if ($quote['discount'] !== null)
                    <tr>
                        <td>{{ $words['discount'] }}</td>
                        <td class="ld-checkout-money">-{{ $quote['discount'] }}</td>
                    </tr>
                @endif

                @if ($quote['tax'] !== null)
                    <tr>
                        <td>{{ $quote['tax_label'] }}</td>
                        <td class="ld-checkout-money">{{ $quote['tax'] }}</td>
                    </tr>
                @endif

                <tr class="ld-checkout-total">
                    <td>{{ $words['total'] }}</td>
                    <td class="ld-checkout-money">
                        {{ $quote['total'] }}
                        <span>{{ $this->period() }}</span>
                    </td>
                </tr>
            </table>

            {{-- The commitment, under the money and above the button. --}}
            @if ($this->term() !== null)
                <p class="ld-checkout-term">{{ $this->term() }}</p>
            @endif

            {{-- The package's own questions, when it has any. Drawn before the
                 coupon box because they are part of what is being bought
                 rather than part of what it costs. --}}
            @if (count($questions) > 0 || $this->wantsFile())
                <div class="ld-checkout-asks">
                    <h3>{{ $words['asks'] }}</h3>
                    <p class="ld-checkout-hint ld-checkout-optional">{{ $words['optional'] }}</p>

                    @foreach ($questions as $question)
                        <div class="ld-checkout-ask">
                            <label for="ld-ask-{{ $question['name'] }}">{{ $question['label'] }}</label>

                            {{-- The control the egg's own rules ask for. A
                                 variable that lists its values gets those values
                                 and nothing else; one that wants a number gets a
                                 number field. Every one of them may be left
                                 alone, and leaving it alone keeps whatever the
                                 egg already had - which is what the first option
                                 and the placeholder both say. --}}
                            @if ($question['kind'] === 'choice')
                                <select id="ld-ask-{{ $question['name'] }}"
                                        wire:model="answers.{{ $question['name'] }}"
                                        @if ($question['help'] !== '') aria-describedby="ld-ask-{{ $question['name'] }}-help" @endif>
                                    <option value="">{{ $words['leave'] }}</option>

                                    @foreach ($question['options'] as $option)
                                        <option value="{{ $option }}" @selected($question['value'] === $option)>{{ $option }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $question['kind'] === 'number' ? 'number' : 'text' }}"
                                       id="ld-ask-{{ $question['name'] }}"
                                       wire:model="answers.{{ $question['name'] }}"
                                       value="{{ $question['value'] }}"
                                       maxlength="{{ $question['max'] }}"
                                       placeholder="{{ $question['default'] !== '' ? $question['default'] : $words['leave'] }}"
                                       autocomplete="off"
                                       @if ($question['help'] !== '') aria-describedby="ld-ask-{{ $question['name'] }}-help" @endif>
                            @endif

                            {{-- Folded away. An egg's description can be three
                                 sentences with two URLs in it, and nine of those
                                 in a column is a wall nobody reads - but the one
                                 somebody is stuck on is the one they open. --}}
                            @if ($question['help'] !== '')
                                <details id="ld-ask-{{ $question['name'] }}-help" class="ld-checkout-why">
                                    <summary>{{ $words['what'] }}</summary>
                                    <p>{{ $question['help'] }}</p>
                                </details>
                            @endif
                        </div>
                    @endforeach

                    @if ($this->wantsFile())
                        <div class="ld-checkout-ask">
                            <label for="ld-ask-file">{{ $this->fileLabel() }}</label>

                            <input type="file"
                                   id="ld-ask-file"
                                   accept=".zip,application/zip"
                                   wire:model="upload">

                            <p class="ld-checkout-hint" wire:loading.remove wire:target="upload">{{ $words['upload_help'] }}</p>
                            <p class="ld-checkout-hint" wire:loading wire:target="upload">{{ $words['upload_busy'] }}</p>
                        </div>
                    @endif
                </div>
            @endif

            @if ($this->couponsOn())
                <label class="ld-checkout-coupon">
                    <span>{{ $words['coupon'] }}</span>
                    <input type="text"
                           wire:model.live.debounce.400ms="code"
                           placeholder="{{ $words['coupon_placeholder'] }}"
                           maxlength="32"
                           autocomplete="off">
                </label>

                @if ($this->badCode())
                    <p class="ld-checkout-bad">{{ $words['coupon_bad'] }}</p>
                @elseif ($this->coupon() !== null)
                    <p class="ld-checkout-good">{{ $words['coupon_good'] }}</p>
                @endif
            @endif

            @if ($terms !== null)
                {{-- A real checkbox rather than a sentence under the button, and
                     the button is dead until it is ticked. Agreeing to terms is
                     something somebody does on purpose.

                     One Alpine scope around both: a checkbox bound outside the
                     x-data that reads it binds to nothing, and the button would
                     stay disabled however many times it was ticked. --}}
                <div x-data="{ agreed: false }">
                    <label class="ld-checkout-terms">
                        <input type="checkbox" x-model="agreed">
                        <span>
                            {{ $words['agree'] }}
                            <a href="{{ $terms }}" target="_blank" rel="noopener">{{ $words['terms'] }}</a>
                        </span>
                    </label>

                    <button type="button"
                            class="ld-checkout-buy"
                            x-bind:disabled="!agreed"
                            wire:click="buy"
                            wire:loading.attr="disabled">
                        {{ $words['buy'] }}
                    </button>
                </div>
            @else
                <button type="button"
                        class="ld-checkout-buy"
                        wire:click="buy"
                        wire:loading.attr="disabled">
                    {{ $words['buy'] }}
                </button>
            @endif

            <p class="ld-checkout-note">{{ $words['buy_note'] }}</p>
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
