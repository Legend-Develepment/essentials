{{--
    Whether another server fits.

    The note folds away like the other overviews: it says what these numbers are
    and, more usefully, what they are not - the dashboard block shows live usage
    and this shows what has been promised, and mistaking one for the other is
    how a node ends up full while looking idle.

    The key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('how') shorthand would hide it from the check that exists
    because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'more' => Theme::trans('activity.more'),
        'how' => Theme::trans('capacity.how'),
    ];
@endphp

<x-filament-panels::page>
    <details class="ld-config__more">
        <summary>{{ $words['more'] }}</summary>

        <p class="ld-config__note">{{ $words['how'] }}</p>
    </details>

    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
