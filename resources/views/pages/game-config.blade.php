{{--
    A game's configuration file as a form, with the fields drawn from the file.

    One view for every game that edits a file this way, because there is nothing
    in it that is about any particular game: the sections, their headings and
    every field come from GameConfig reading what the server actually has. A
    game that wanted its own view would be a game whose page is not this one.

    Its own file rather than the shared settings view, for the reason the ARK
    one gives: the shared view draws its save bar for anyone holding this
    plugin's update permission, and who may write this file is a subuser
    permission on the server it belongs to. mayEdit() is what asks that.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('missing') shorthand would hide every key on this page
    from the check that exists because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'missing' => Theme::trans('games.missing'),
        'read_only' => Theme::trans('games.read_only'),
        'keeps' => Theme::trans('games.keeps'),
        'raw' => Theme::trans('games.raw'),
        'save' => Theme::trans('games.save'),
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

        {{-- Said before the form rather than after it. Somebody meeting a page
             of bare key names should be told why they are bare before they
             conclude it is broken. --}}
        <p class="ld-config__note">{{ $words['raw'] }}</p>
        <p class="ld-config__note">{{ $words['keeps'] }}</p>

        {{ $this->form }}

        @if ($this->mayEdit())
            {{-- Within reach of what you were typing. A file with forty
                 settings in it is a long way back to the page header, and on a
                 phone that header is off screen the moment the keyboard opens. --}}
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
