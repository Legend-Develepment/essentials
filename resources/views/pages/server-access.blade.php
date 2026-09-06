{{--
    Which servers a role gets.

    Two sentences before the form, and both are there because everything this
    page does happens out of sight. The first says what it writes to, since that
    is Pelican's own table and not this plugin's. The second is what the last run
    actually did - without it a settings page whose only effect is elsewhere is
    one nobody can tell is working.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('warning') shorthand would hide every key on this page from
    the check that exists because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'more' => Theme::trans('access.more'),
        'warning' => Theme::trans('access.warning'),
        'timing' => Theme::trans('access.timing'),
        'never' => Theme::trans('access.never'),
    ];

    $run = $this->lastRun();
@endphp

<x-filament-panels::page>
    <div class="ld-access">
        {{--
            Folded, because it is a hundred words that are read once and then
            in the way for ever - and on a phone it was the whole screen before
            the form. What is left outside it is the line that changes.
        --}}
        <details class="ld-config__more">
            <summary>{{ $words['more'] }}</summary>

            <p class="ld-config__note">{{ $words['warning'] }}</p>
            <p class="ld-config__note">{{ $words['timing'] }}</p>
        </details>

        @if ($run !== null)
            <p class="ld-config__note">{{ $run }}</p>
        @else
            {{-- Not a failure. It is what a panel says before the timer has
                 come round once, and before anything has been mapped. --}}
            <p class="ld-config__note">{{ $words['never'] }}</p>
        @endif
    </div>

    {{ $this->form }}

    <x-filament-actions::modals />
</x-filament-panels::page>
