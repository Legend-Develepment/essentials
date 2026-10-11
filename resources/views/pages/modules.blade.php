{{--
    Seven cards, one per module.

    A card says what the module is for, how much of it is on, when it does its
    work, and what is still holding it back. The features inside sit in a
    details element that starts closed: somebody deciding whether they want a
    webshop is not reading fourteen switch names, and somebody tuning one wants
    them one click away rather than on another page.
--}}
@php
    use LegendDevelopment\Theme\Support\Modules;
    use LegendDevelopment\Theme\Support\Theme;

    $may = $this->mayChange();
@endphp

<x-filament-panels::page>
    {{-- Asked once, on a panel that had never seen this plugin before, and
         gone the moment somebody answers or waves it away. A panel that was
         already running never sees it: acting on "what is this panel for"
         where the answer is a year of orders is a way to switch off a shop
         somebody is using. --}}
    @if ($may && $shapes = $this->shapes())
        <section class="ld-first">
            <h2 class="ld-first__title">{{ Theme::trans('modules.first_title') }}</h2>

            <p class="ld-first__about">{{ Theme::trans('modules.first_helper') }}</p>

            <div class="ld-first__shapes">
                @foreach ($shapes as $shape)
                    <button
                        type="button"
                        class="ld-first__shape"
                        wire:click="chooseShape('{{ $shape['key'] }}')"
                        wire:target="chooseShape"
                        wire:loading.attr="disabled"
                    >
                        <span class="ld-first__name">{{ $shape['name'] }}</span>
                        <span class="ld-first__said">{{ $shape['about'] }}</span>
                        <span class="ld-first__count">
                            {{ Theme::choice('modules.count', $shape['of'], ['on' => $shape['on'], 'of' => $shape['of']]) }}
                        </span>
                    </button>
                @endforeach
            </div>

            <button type="button" class="ld-first__skip" wire:click="chooseNone">
                {{ Theme::trans('modules.first_skip') }}
            </button>
        </section>
    @endif

    <div class="ld-modules">
        @foreach ($this->cards() as $card)
            <section class="ld-module ld-module--{{ $card['state'] }}">
                <header class="ld-module__top">
                    <div class="ld-module__said">
                        {{-- The state beside the name rather than below it: it
                             is part of what this card is, not a fact about it. --}}
                        <h2 class="ld-module__name">
                            {{ $card['name'] }}

                            <span class="ld-module__pill ld-module__pill--{{ $card['state'] }}">
                                {{ Theme::trans('modules.state_' . $card['state']) }}
                            </span>
                        </h2>

                        <p class="ld-module__about">{{ $card['about'] }}</p>

                        <p class="ld-module__facts">
                            <span class="ld-module__count">
                                {{ Theme::choice('modules.count', $card['of'], ['on' => $card['on'], 'of' => $card['of']]) }}
                            </span>

                            <span class="ld-module__cost">{{ $card['cost'] }}</span>

                            {{-- Only for the modules that have one place to go.
                                 Drawn beside the count rather than as a button
                                 of its own: it is a way out of this page, not a
                                 thing to do on it. --}}
                            @if ($card['url'] !== null)
                                <a class="ld-module__go" href="{{ $card['url'] }}">
                                    {{ Theme::trans('modules.go') }}
                                </a>
                            @endif
                        </p>

                        {{-- Only when there is something to say. A card that
                             draws "everything is fine" on every visit is a line
                             people stop reading, and then it is a line that
                             cannot warn them. --}}
                        @foreach ($card['health'] as $line)
                            <p class="ld-module__health ld-module__health--{{ $line['tone'] }}">
                                {{ $line['said'] }}
                            </p>
                        @endforeach
                    </div>

                    {{-- One press for the whole group. Off when any of it is on,
                         so the button always does the thing the card is not. --}}
                    @if ($may)
                        <x-filament::button
                            wire:click="toggleModule('{{ $card['key'] }}', {{ $card['state'] === Modules::ON ? 'false' : 'true' }})"
                            wire:target="toggleModule"
                            wire:loading.attr="disabled"
                            :color="$card['state'] === Modules::ON ? 'gray' : 'primary'"
                            :icon="$card['state'] === Modules::ON ? 'tabler-toggle-left' : 'tabler-toggle-right'"
                            class="ld-module__switch"
                        >
                            {{ Theme::trans($card['state'] === Modules::ON ? 'modules.turn_off' : 'modules.turn_on') }}
                        </x-filament::button>
                    @endif
                </header>

                {{-- What this module left behind, for the parts of it that
                     are off. A sentence for what is only sitting on disk,
                     and a button only where something is still happening. --}}
                @foreach ($card['leftovers'] as $left)
                    <div class="ld-module__left ld-module__left--{{ $left['tone'] }}">
                        <p class="ld-module__leftsaid">{{ $left['said'] }}</p>

                        @if ($left['clear'])
                            <x-filament::button
                                wire:click="clearLeftover('{{ $left['feature'] }}')"
                                wire:target="clearLeftover"
                                wire:loading.attr="disabled"
                                wire:confirm="{{ Theme::trans('access.revoke_confirm_helper') }}"
                                color="danger"
                                size="sm"
                                class="ld-module__leftdo"
                            >
                                {{ $left['clear'] }}
                            </x-filament::button>
                        @endif
                    </div>
                @endforeach

                <details class="ld-module__parts">
                    <summary class="ld-module__more">
                        {{ Theme::choice('modules.parts', $card['of']) }}
                    </summary>

                    <ul class="ld-module__list">
                        @foreach ($card['parts'] as $part)
                            <li class="ld-module__part {{ $part['on'] ? '' : 'ld-module__part--off' }}">
                                <div class="ld-module__partsaid">
                                    <span class="ld-module__partname">{{ $part['name'] }}</span>

                                    <span class="ld-module__partabout">{{ $part['about'] }}</span>

                                    @if ($part['needs'])
                                        <span class="ld-module__warn">{{ $part['needs'] }}</span>
                                    @endif

                                    @if ($part['lessens'])
                                        <span class="ld-module__note">{{ $part['lessens'] }}</span>
                                    @endif

                                    @if ($part['waiting'])
                                        <span class="ld-module__note">{{ $part['waiting'] }}</span>
                                    @endif
                                </div>

                                {{-- A switch that says which way it is, rather
                                     than an icon with a label meant only for a
                                     screen reader. That label was drawn on screen
                                     on a phone, in the accent colour, wrapped over
                                     six lines down the side of every row. --}}
                                @if ($may)
                                    <button
                                        type="button"
                                        class="ld-module__tick ld-module__tick--{{ $part['on'] ? 'on' : 'off' }}"
                                        wire:click="toggleFeature('{{ $part['key'] }}', {{ $part['on'] ? 'false' : 'true' }})"
                                        wire:target="toggleFeature"
                                        wire:loading.attr="disabled"
                                        role="switch"
                                        aria-checked="{{ $part['on'] ? 'true' : 'false' }}"
                                        aria-label="{{ $part['name'] }}"
                                    >
                                        <span class="ld-module__track" aria-hidden="true">
                                            <span class="ld-module__knob"></span>
                                        </span>

                                        <span class="ld-module__word">
                                            {{ Theme::trans($part['on'] ? 'modules.state_on' : 'modules.state_off') }}
                                        </span>
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </details>
            </section>
        @endforeach
    </div>

    @unless ($may)
        <p class="ld-module__readonly">{{ Theme::trans('modules.read_only') }}</p>
    @endunless
</x-filament-panels::page>
