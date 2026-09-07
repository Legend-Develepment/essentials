{{--
    Every package, and the buttons that make, change and retire them.

    Nothing above the table: the settings that apply to every package - the
    currency, the tax - are on the Shop settings page, and a form here would be
    a second place for them. The table is the page.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    {{-- Without this the header actions open nothing: an action rendered on a
         page has nowhere to put its modal unless the view says where. --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
