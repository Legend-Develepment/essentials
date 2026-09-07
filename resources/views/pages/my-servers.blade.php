{{--
    Which of somebody's own servers is behind.

    Nothing but the table. Every figure in it comes from one query built by
    Support\Backups, and every row leads to Pelican's own page for that server
    rather than to a second copy of it here.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
