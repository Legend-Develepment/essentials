{{--
    Everything that has been bought.

    The table is the page. What an order needs said about it - which server, how
    late, why the build failed - is said in the row rather than in a panel above
    it, because an administrator opening this page is looking for one order
    among many.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    {{-- Without this the row actions open nothing: an action rendered on a page
         has nowhere to put its modal unless the view says where. --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
