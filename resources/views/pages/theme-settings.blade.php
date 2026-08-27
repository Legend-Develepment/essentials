{{--
    The form, and a Save that stays within reach of it.

    Nine sections is a long way back to the button in the page header, and on a
    phone that header is off screen the moment you start typing. This one sticks
    to the bottom of the viewport, so whatever you are editing, saving it is one
    tap away. The header action stays as well - and so does ctrl/cmd+S.
--}}
<x-filament-panels::page
    id="form"
    :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
    wire:submit="save"
>
    {{ $this->form }}

    @if (user()?->can(\LegendDevelopment\Theme\Support\Theme::PERMISSION_UPDATE))
        <div class="fi-ld-save-bar">
            <x-filament::button
                wire:click="save"
                wire:target="save"
                wire:loading.attr="disabled"
                icon="tabler-device-floppy"
                size="lg"
            >
                {{ \LegendDevelopment\Theme\Support\Theme::trans('page.save') }}
            </x-filament::button>
        </div>
    @endif
</x-filament-panels::page>
