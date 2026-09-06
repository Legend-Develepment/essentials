{{--
    Which scheduled task has stopped.

    The note above the table folds away, like the other two overview pages: it
    explains why this page exists at all - Pelican's own status has no word for
    "stopped" - which is worth reading once and then in the way.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('how') shorthand would hide it from the check that exists
    because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'more' => Theme::trans('activity.more'),
        'how' => Theme::trans('schedules.how'),
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
