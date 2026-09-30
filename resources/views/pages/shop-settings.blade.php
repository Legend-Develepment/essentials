{{--
    The shop's settings: one form, and a Save within reach of it.

    The bar is the page's only Save, as on the other settings pages, which is
    also where the sticky styling for it comes from. It asks what the form's
    disabled state and save() ask, so the button is only there for somebody who
    can use it.

    The public address is not drawn here. /shop answers only while the public
    shop is switched on, and that switch is on the modules page with the rest of
    the shop's parts, not on this one.
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
