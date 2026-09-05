{{--
    Somebody's own status page, set up by them.

    The address is drawn at the top rather than described, because the first
    thing anybody wants after saving is to open it, and the second is to paste it
    into a Discord.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'address' => Theme::trans('status.address'),
        'mine_address_off' => Theme::trans('status.mine_address_off'),
    ];
@endphp

<x-filament-panels::page>
    <div class="ld-status">
        @if ($this->address() !== null)
            <p class="ld-status__how">{{ $words['address'] }}</p>
            <a class="ld-status__link" href="{{ $this->address() }}" target="_blank" rel="noopener noreferrer">{{ $this->address() }}</a>
        @else
            <p class="ld-status__how">{{ $words['mine_address_off'] }}</p>
        @endif
    </div>

    {{ $this->form }}

    <x-filament-actions::modals />
</x-filament-panels::page>
