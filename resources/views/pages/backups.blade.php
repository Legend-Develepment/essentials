{{--
    Which of your servers has no backup.

    Nothing but the table: every figure is worked out in one query by
    Support\Backups, and every action on a row leads to Pelican's own page for
    that server rather than to a second copy of it here.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
