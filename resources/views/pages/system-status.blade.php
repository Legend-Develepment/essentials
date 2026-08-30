{{--
    The panel's own machine. Every figure is worked out in the page class, the
    same way the node health widget does it - a view that calls into the theme's
    own classes is a view that can fail in a place with no good way to report it.

    The whole page re-renders on the chosen interval rather than each card asking
    for itself: one request beats six, and every reading comes from the same
    moment that way.
--}}
<x-filament-panels::page>
    <div class="ld-system" @if ($refresh) wire:poll.{{ $refresh }}s @endif>
        @foreach ($cards as $card)
            <div class="ld-system__card">
                <p class="ld-system__label">{{ $card['label'] }}</p>

                @switch($card['kind'])
                    @case('meter')
                        <p class="ld-system__figure">{{ $card['figure'] }}</p>
                        <span class="ld-system__bar"
                              data-level="{{ $card['level'] }}"
                              style="--ld-fill: {{ $card['fill'] }}%"></span>

                        @foreach ($card['details'] as $detail)
                            <p class="ld-system__detail">{{ $detail }}</p>
                        @endforeach
                        @break

                    @case('text')
                        <p class="ld-system__figure">{{ $card['figure'] }}</p>

                        @foreach ($card['details'] as $detail)
                            <p class="ld-system__detail">{{ $detail }}</p>
                        @endforeach
                        @break

                    @case('facts')
                        <dl class="ld-system__facts">
                            @foreach ($card['facts'] as $fact)
                                <dt>{{ $fact['label'] }}</dt>
                                <dd title="{{ $fact['value'] }}">{{ $fact['value'] }}</dd>
                            @endforeach
                        </dl>
                        @break

                    @default
                        {{-- Said, rather than shown as nought. A processor
                             reading of zero is a claim, and a host that will not
                             be read has not made it. --}}
                        <p class="ld-system__missing">{{ $card['figure'] }}</p>
                @endswitch
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
