{{--
    One line above somebody's own server list: which of theirs has no backup.

    Drawn at all only when something is behind - canView() answers false
    otherwise - so this template never has to say "everything is fine". A widget
    that always says something is one people stop reading.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('open') shorthand would hide it from the check that exists
    because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'open' => Theme::trans('mybackups.open'),
    ];
@endphp

<div class="ld-mine">
    <span class="ld-mine__icon" aria-hidden="true">
        <x-filament::icon icon="tabler-database-off" />
    </span>

    <div class="ld-mine__text">
        <p class="ld-mine__line">{{ $this->sentence() }}</p>
        <p class="ld-mine__names">{{ $this->names() }}</p>
    </div>

    {{--
        No link to a page of this plugin's own. Making a backup is on Pelican's
        page for that server, and one more click through a list here would be a
        step between somebody and the thing they came to do.
    --}}
    <span class="ld-mine__how">{{ $words['open'] }}</span>
</div>
