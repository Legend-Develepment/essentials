{{--
    Who is on the server, for any game that answers Valve's query.

    Plain rows rather than a table builder, for the reason the Minecraft players
    page gives at more length: there is no Eloquent model behind this, only a UDP
    packet, and a table handed an array collection buys sorting nobody asked for
    while pretending these are records.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('empty') shorthand would hide every key on this page from
    the check that exists because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'empty' => Theme::trans('gameplayers.empty'),
        'unreachable' => Theme::trans('gameplayers.unreachable'),
        'score' => Theme::trans('gameplayers.score'),
        'count' => Theme::trans('gameplayers.count', ['count' => count($rows)]),
    ];
@endphp

<x-filament-panels::page>
    @if (!$answered)
        {{-- Could not ask, which is a different thing from nobody being on and
             must not be drawn as an empty list. The panel and the game port are
             often on networks that cannot reach each other. --}}
        <p class="ld-players__empty">{{ $words['unreachable'] }}</p>
    @elseif ($rows === [])
        <p class="ld-players__empty">{{ $words['empty'] }}</p>
    @else
        <p class="ld-players__how">{{ $words['count'] }}</p>

        <div class="ld-players__table">
            @foreach ($rows as $row)
                <div class="ld-players__row" wire:key="ld-gp-{{ md5($row['name']) }}">
                    <span class="ld-players__name">{{ $row['name'] }}</span>

                    @if ($row['score'] !== 0)
                        <span class="ld-players__reason">{{ $words['score'] }} {{ $row['score'] }}</span>
                    @endif

                    <span class="ld-players__reason">{{ $this->spell($row['minutes']) }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
