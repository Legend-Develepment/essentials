{{--
    What happened on this panel.

    A line of prose above the table, and it earns its place: this page reads a
    log the panel already keeps, and the two things somebody needs to know
    before trusting it are that nothing here changes that log and that what they
    can see is scoped to what they can reach.

    The key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('how') shorthand would hide it from the check that exists
    because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'how' => Theme::trans('activity.how'),
        'ip_hidden' => Theme::trans('activity.ip_hidden'),
    ];
@endphp

<x-filament-panels::page>
    <p class="ld-config__note">{{ $words['how'] }}</p>

    {{-- Said rather than left as a tooltip that never appears. Pelican gates
         the address behind its own permission, and somebody hovering over the
         Who column expecting one deserves to know why there is nothing. --}}
    @unless (\LegendDevelopment\Theme\Support\Activity::showsIps())
        <p class="ld-config__note">{{ $words['ip_hidden'] }}</p>
    @endunless

    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
