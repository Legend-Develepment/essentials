{{--
    Every egg, and whether it has a picture.

    A real Filament table rather than the hand-built rows the Minecraft pages
    use, because these are real records: eggs are rows in a table, a panel can
    have four hundred of them, and the search and pagination that come free are
    exactly what somebody wants here. The page itself is therefore nothing but
    the table and the modals its actions open.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    {{-- Without this the row actions open nothing: an action rendered in a page
         body has nowhere to put its modal unless the view says where. --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
