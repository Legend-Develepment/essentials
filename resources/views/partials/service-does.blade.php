{{--
    What a customer can do to one service.

    Its own file because two screens draw it: the card on the list of services
    and the page for a single one. The buttons below name methods on whichever
    page is drawing - extra(id, addon), unextra(id, line), change(id, package),
    give(id, when) - which all live in one trait for exactly the same reason.

    **Nothing checks a wire:click.** No gate reads a Blade file and the PHP
    parser never opens one, so a name that drifts between this file and the
    trait is found by a customer pressing a button that does nothing. That is
    the whole argument for there being one copy of each.

    Expects $service, one row of Shop\Summary::card().
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'give' => Theme::trans('shop.give'),
        'give_end_open' => Theme::trans('shop.give_end_open'),
        'give_now' => Theme::trans('shop.give_now'),
        'give_now_confirm' => Theme::trans('shop.give_now_confirm'),
        'change' => Theme::trans('upgrades.change'),
        'change_body' => Theme::trans('upgrades.change_body'),
        'change_free' => Theme::trans('upgrades.change_free'),
        'extras' => Theme::trans('addons.yours'),
        'add_extra' => Theme::trans('addons.add'),
        'add_extra_body' => Theme::trans('addons.add_helper'),
        'free_now' => Theme::trans('addons.free_now'),
        'drop' => Theme::trans('addons.drop'),
    ];
@endphp

    {{-- What this service already carries, and what else it
         could. Above the package change because it is the
         smaller decision and the one people come back for. --}}
    @if (count($service['extras']) > 0)
        <div class="ld-bill-extras">
            <strong>{{ $words['extras'] }}</strong>

            @foreach ($service['extras'] as $extra)
                <div class="ld-extra-mine">
                    <span>{{ $extra['name'] }}</span>

                    <span>
                        {{ $extra['price'] }} <small>{{ $extra['billing'] }}</small>

                        @if ($extra['may_drop'])
                            <button type="button"
                                    class="ld-extra-drop"
                                    wire:click="unextra({{ $service['id'] }}, {{ $extra['id'] }})"
                                    wire:confirm="{{ Theme::trans('addons.drop_confirm', ['name' => $extra['name']]) }}">
                                {{ $words['drop'] }}
                            </button>
                        @endif
                    </span>
                </div>
            @endforeach
        </div>
    @endif

    @if (count($service['offers']) > 0)
        <details class="ld-bill-change">
            <summary>
                <x-filament::icon icon="tabler-puzzle" class="ld-bill-give-icon" />
                {{ $words['add_extra'] }}
            </summary>

            <p>{{ $words['add_extra_body'] }}</p>

            <ul class="ld-change-list">
                @foreach ($service['offers'] as $offer)
                    <li>
                        <div class="ld-change-what">
                            <strong>{{ $offer['name'] }}</strong>

                            @if ($offer['description'] !== '')
                                <span>{{ $offer['description'] }}</span>
                            @endif

                            <span>{{ $offer['then'] }}</span>
                        </div>

                        <div class="ld-change-now">
                            <span class="ld-change-costs">
                                @if ($offer['now'] !== null)
                                    {{ Theme::trans('addons.costs_now', ['amount' => $offer['now']]) }}
                                @else
                                    {{ $words['free_now'] }}
                                @endif
                            </span>

                            <button type="button"
                                    class="ld-change-go"
                                    wire:click="extra({{ $service['id'] }}, {{ $offer['id'] }})"
                                    wire:confirm="{{ Theme::trans('addons.add_confirm', ['name' => $offer['name']]) }}">
                                {{ Theme::trans('addons.add_to', ['name' => $offer['name']]) }}
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </details>
    @endif

    {{-- Somewhere else to go.

         Above the way out, because it is the answer to the
         question that usually comes first: somebody who has
         outgrown their server is looking for a bigger one, and
         only finds the cancel button if there is nothing else.

         Each row says what it costs today rather than what the
         package costs, because those are different numbers and
         the one that matters is what happens if you press it. --}}
    @if ($service['waiting'] !== null)
        <p class="ld-bill-waiting">
            {{ Theme::trans('upgrades.waiting_for', ['name' => $service['waiting']]) }}
        </p>
    @elseif (count($service['changes']) > 0)
        <details class="ld-bill-change">
            <summary>
                <x-filament::icon icon="tabler-arrow-up-circle" class="ld-bill-give-icon" />
                {{ $words['change'] }}
            </summary>

            <p>{{ $words['change_body'] }}</p>

            <ul class="ld-change-list">
                @foreach ($service['changes'] as $change)
                    <li>
                        <div class="ld-change-what">
                            <strong>{{ $change['name'] }}</strong>
                            <span>{{ $change['price'] }}</span>
                        </div>

                        <div class="ld-change-now">
                            @if ($change['costs'])
                                <span class="ld-change-costs">
                                    {{ Theme::trans('upgrades.costs_now', ['amount' => $change['amount']]) }}
                                </span>
                            @elseif ($change['gives'])
                                <span class="ld-change-gives">
                                    {{ Theme::trans('upgrades.gives_back', ['amount' => $change['amount']]) }}
                                </span>
                            @else
                                <span>{{ $words['change_free'] }}</span>
                            @endif

                            <button type="button"
                                    class="ld-change-go"
                                    wire:click="change({{ $service['id'] }}, {{ $change['package'] }})"
                                    wire:confirm="{{ Theme::trans('upgrades.change_confirm', ['name' => $change['name']]) }}">
                                {{ Theme::trans('upgrades.change_to', ['name' => $change['name']]) }}
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </details>
    @endif

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
