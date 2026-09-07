{{--
    One line above somebody's own server list: which of theirs has no backup.

    Drawn at all only when something is behind - canView() answers false
    otherwise - so this template never has to say "everything is fine". A widget
    that always says something is one people stop reading.

    Three parts, in the order somebody needs them: what is wrong, which servers,
    what to do. The third moves beside the first two once the box is wide enough
    to take it, and that is asked of the box rather than of the window - see the
    container query in theme.css.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('open') shorthand would hide it from the check that exists
    because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'open' => Theme::trans('mybackups.open'),
    ];

    $names = $this->names();
    $more = $this->more();
@endphp

<div class="ld-mine">
    <span class="ld-mine__icon" aria-hidden="true">
        <x-filament::icon icon="tabler-database-off" />
    </span>

    <div class="ld-mine__body">
        <p class="ld-mine__line">{{ $this->sentence() }}</p>

        {{--
            A list, because it is one. Six names run together behind commas is a
            sentence to read before you can find yours in it; six of these is a
            row to scan, and the eye may stop at any of them. Marked up as a list
            rather than only drawn as one, so a screen reader announces six
            things and not one long line.
        --}}
        @if ($names !== [])
            <ul class="ld-mine__names">
                @foreach ($names as $name)
                    <li class="ld-mine__name">{{ $name }}</li>
                @endforeach

                @if ($more !== '')
                    <li class="ld-mine__name ld-mine__name--more">{{ $more }}</li>
                @endif
            </ul>
        @endif
    </div>

    {{--
        No link to a page of this plugin's own. Making a backup is on Pelican's
        page for that server, and one more click through a list here would be a
        step between somebody and the thing they came to do.
    --}}
    <p class="ld-mine__how">{{ $words['open'] }}</p>
</div>
