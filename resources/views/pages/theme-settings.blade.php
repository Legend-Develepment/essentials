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
    {{--
        Narrows the page to the sections holding what you type.

        Deliberately not a form field. A field would join the form's state,
        travel to the server on every keystroke and be handed to persist() on
        save - none of which a search box has any business doing. It is a plain
        input that only the browser reads, so searching writes nothing, asks the
        server for nothing, and cannot fail in a way that costs a setting.
    --}}
    @if (\LegendDevelopment\Theme\Support\Features::maySee(\LegendDevelopment\Theme\Support\Features::SETTINGS_SEARCH))
        <div class="ld-search" data-ld-search>
            <span class="ld-search__icon" aria-hidden="true">
                <x-filament::icon icon="tabler-search" />
            </span>

            <input
                type="search"
                class="ld-search__input"
                data-ld-search-input
                autocomplete="off"
                spellcheck="false"
                placeholder="{{ \LegendDevelopment\Theme\Support\Theme::trans('settings.search.placeholder') }}"
                aria-label="{{ \LegendDevelopment\Theme\Support\Theme::trans('settings.search.label') }}"
            >

            <p class="ld-search__none" data-ld-search-none hidden>
                {{ \LegendDevelopment\Theme\Support\Theme::trans('settings.search.none') }}
            </p>
        </div>
    @endif

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
