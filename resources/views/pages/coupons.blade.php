{{--
    Discount codes.

    The table and the two buttons that make and change one. Everything a code
    can be - a percentage or an amount, which packages, until when, how many
    times - is in the slide-over form rather than on this page.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
