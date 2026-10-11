{{--
    The list, and a Save that stays within reach of it - the same bar the theme
    settings use, for the same reason: a long list is a long way back to the
    top of the page, and on a phone the top is off screen the moment you start
    typing. It is the page's only Save; see maySave().
--}}
<x-filament-panels::page
    id="form"
    :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
    wire:submit="save"
>
    {{ $this->form }}

    @if ($this->maySave())
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
