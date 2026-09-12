{{--
    The shop's settings: one form, and a Save within reach of it.

    The public address is not drawn here yet. The route that answers it
    arrives with the shop page itself in the next release, and a line pointing
    at an address that answers 404 is worse than no line.
--}}
<x-filament-panels::page
    id="form"
    :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
    wire:submit="save"
>
    {{ $this->form }}

    @if (\LegendDevelopment\Theme\Support\Features::mayManage(\LegendDevelopment\Theme\Support\Features::SHOP))
        <div class="fi-ld-save-bar">
            <x-filament::button
                wire:click="save"
                wire:target="save"
                wire:loading.attr="disabled"
                icon="tabler-device-floppy"
                size="lg"
            >
                {{ \LegendDevelopment\Theme\Support\Theme::trans('shop.save') }}
            </x-filament::button>
        </div>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
