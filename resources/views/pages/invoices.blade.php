{{--
    What is owed and what has been paid.

    Nothing above the table. Marking an invoice paid is a row action with a
    confirmation on it, deliberately - it is the button that decides money
    arrived, and a page that offered it in a header bar would offer it before
    anybody had read which invoice they were about to settle.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
