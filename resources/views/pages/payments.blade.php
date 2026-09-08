{{--
    Every attempt to pay.

    The table is the page. Where the provider keys live is the Shop settings
    page, deliberately: reading what people tried to pay and holding the key
    that can move their money are different amounts of trust, and they are two
    pages behind two permissions.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
