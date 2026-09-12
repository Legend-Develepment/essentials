{{--
    What customers have asked.

    The table and nothing else: a conversation opens in a window of its own,
    which is what Read does. Reading one pulls whatever the far end has to say
    first, so it is always the freshest view there is.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
