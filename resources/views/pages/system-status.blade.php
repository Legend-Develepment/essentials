{{--
    The panel's own machine, and any node you asked to see beside it.

    Every figure is worked out in the page class, the same way the node health
    widget does it - a view that calls into the theme's own classes is a view
    that can throw halfway through the markup, which is the one place there is
    no good way to report it.

    The whole page re-renders on the chosen interval rather than each card
    asking for itself: one request beats six, and every reading comes from the
    same moment that way.
--}}
<x-filament-panels::page>
    <div class="ld-system" @if ($refresh) wire:poll.{{ $refresh }}s @endif>
        @foreach ($sections as $section)
            <section class="ld-system__section">
                {{-- The heading earns its place only when there is a second
                     section for it to tell apart. --}}
                @if (count($sections) > 1)
                    <h2 class="ld-system__heading">{{ $section['title'] }}</h2>
                @endif

                <div class="ld-system__grid">
                    @foreach ($section['cards'] as $card)
                        <article @class([
                            'ld-system__card',
                            'ld-system__card--wide' => $card['wide'] ?? false,
                        ]) data-level="{{ $card['level'] }}">
                            <header class="ld-system__head">
                                <x-filament::icon :icon="$card['icon']" class="ld-system__icon" />
                                <h3 class="ld-system__label">{{ $card['label'] }}</h3>

                                @foreach ($card['flags'] as $flag)
                                    <span class="ld-system__flag ld-system__flag--{{ $flag['kind'] }}">{{ $flag['text'] }}</span>
                                @endforeach

                                {{-- Beside the badge, because it belongs to it:
                                     the badge says something is out of date and
                                     this is what you do about it. Under the
                                     readings it would read as a note about the
                                     numbers. --}}
                                @if ($card['link'] ?? null)
                                    <a class="ld-system__update" href="{{ $card['link']['url'] }}"
                                       target="_blank" rel="noopener noreferrer"
                                       title="{{ $card['link']['hint'] }}">{{ $card['link']['text'] }}</a>
                                @endif
                            </header>

                            @if ($card['kind'] === 'facts')
                                <dl class="ld-system__facts">
                                    @foreach ($card['facts'] as $fact)
                                        <dt>{{ $fact['label'] }}</dt>
                                        <dd title="{{ $fact['value'] }}">{{ $fact['value'] }}</dd>
                                    @endforeach
                                </dl>
                            @elseif ($card['kind'] === 'missing')
                                <p class="ld-system__missing">{{ $card['figure'] }}</p>
                            @else
                                @if ($card['figure'] !== '')
                                    <p class="ld-system__figure">{{ $card['figure'] }}<span
                                        class="ld-system__unit">{{ $card['unit'] }}</span></p>
                                @endif

                                {{-- Pinned to the bottom, so the bars of a row
                                     of cards sit on one line however many lines
                                     of detail each of them carries. --}}
                                <div class="ld-system__foot">
                                    @if ($card['kind'] === 'meter')
                                        <span class="ld-system__bar" style="--ld-fill: {{ $card['fill'] }}%"></span>
                                    @endif

                                    @foreach ($card['details'] as $detail)
                                        <p class="ld-system__detail">{{ $detail }}</p>
                                    @endforeach

                                    {{-- Their own box, so a card given the full
                                         width can lay them out side by side
                                         instead of stretching each bar across
                                         the screen. --}}
                                    @if ($card['meters'] !== [])
                                        <div class="ld-system__meters">
                                            @foreach ($card['meters'] as $meter)
                                                <div class="ld-system__sub" data-level="{{ $meter['level'] }}">
                                                    <span class="ld-system__sub-label">{{ $meter['label'] }}</span>
                                                    <span class="ld-system__bar ld-system__bar--sub"
                                                          style="--ld-fill: {{ $meter['fill'] }}%"></span>
                                                    <span class="ld-system__sub-value">{{ $meter['value'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-filament-panels::page>
