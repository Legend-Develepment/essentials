{{--
    The shop, facing the person instead of the row.

    The table is the page. Everything about one customer is behind Open, in a
    slide-over, because a row wide enough to hold somebody's whole history is a
    row nobody can read.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
