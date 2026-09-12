{{--
    Extras sold alongside a package.

    The table and the two buttons that make and change one. Everything an extra
    can be - what it costs, when it is charged, which packages it fits and what
    it adds to the server - is in the slide-over form rather than on this page.
--}}
<x-filament-panels::page>
    {{ $this->table }}

    <x-filament-actions::modals />
</x-filament-panels::page>
