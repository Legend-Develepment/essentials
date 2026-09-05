{{--
    GameUserSettings.ini as a form.

    Its own file rather than the shared settings view, for two reasons. The
    shared one draws its save bar for anyone holding this plugin's update
    permission, which is the wrong question here - who may write this file is a
    subuser permission on the server it belongs to, and mayEdit() is what asks
    it. And this page has a state that page does not: a server that has never
    started has no file yet, and that is a sentence rather than an empty form.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('missing') shorthand would hide every key on this page
    from the check that exists because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'missing' => Theme::trans('ark.missing'),
        'read_only' => Theme::trans('ark.read_only'),
        'keeps' => Theme::trans('ark.keeps'),
        'save' => Theme::trans('ark.save'),
    ];
@endphp

<x-filament-panels::page>
    @if (!$this->found())
        {{-- The game writes this file on its first run, so a freshly installed
             server simply does not have one yet. Saying so beats an empty form
             that looks like a server with no settings. --}}
        <p class="ld-config__note">{{ $words['missing'] }}</p>
    @else
        @if (!$this->mayEdit())
            <p class="ld-config__note">{{ $words['read_only'] }}</p>
        @endif

        <p class="ld-config__note">{{ $words['keeps'] }}</p>

        {{ $this->form }}

        @if ($this->mayEdit())
            {{-- Within reach of what you were typing. Three sections is a long
                 way back to the page header, and on a phone that header is off
                 screen the moment the keyboard opens. --}}
            <div class="fi-ld-save-bar">
                <x-filament::button
                    wire:click="save"
                    wire:target="save"
                    wire:loading.attr="disabled"
                    icon="tabler-device-floppy"
                    size="lg"
                >
                    {{ $words['save'] }}
                </x-filament::button>
            </div>
        @endif
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
