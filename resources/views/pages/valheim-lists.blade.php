{{--
    Valheim's three name lists.

    Its own file rather than the shared settings view, for the same reason the
    ARK page has one: who may write these files is a subuser permission on the
    server they belong to rather than this plugin's update permission, and a
    server that has never written them is a sentence rather than three empty
    boxes that look like three empty lists.

    Every key is written out in full. tools/check-lang.js can only verify a
    literal, and a $t('missing') shorthand would hide every key on this page
    from the check that exists because two of them once shipped broken.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'missing' => Theme::trans('valheim.missing'),
        'read_only' => Theme::trans('valheim.read_only'),
        'how' => Theme::trans('valheim.how'),
        'where' => Theme::trans('valheim.where', ['dir' => $this->where()]),
        'save' => Theme::trans('valheim.save'),
    ];
@endphp

<x-filament-panels::page>
    @if (!$this->found())
        {{-- None of the three files exist. The game writes them when it first
             needs them, and saving here will create one - so this is a note
             rather than a refusal, and the form stays. --}}
        <p class="ld-config__note">{{ $words['missing'] }}</p>
    @endif

    @if (!$this->mayEdit())
        <p class="ld-config__note">{{ $words['read_only'] }}</p>
    @endif

    <p class="ld-config__note">{{ $words['how'] }}</p>

    @if ($this->found())
        <p class="ld-config__note">{{ $words['where'] }}</p>
    @endif

    {{ $this->form }}

    @if ($this->mayEdit())
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

    <x-filament-actions::modals />
</x-filament-panels::page>
