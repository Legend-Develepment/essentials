{{--
    The settings for the one page this plugin serves without a login.

    The address is drawn at the top rather than left to be worked out, because
    the first thing anybody wants after saving this is to open it and look - and
    the second is to paste it into a Discord.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'address' => Theme::trans('status.address'),
        'address_off' => Theme::trans('status.address_off'),
    ];
@endphp

<x-filament-panels::page>
    <div class="ld-status">
        @if ($this->live())
            <p class="ld-status__how">{{ $words['address'] }}</p>
            <a class="ld-status__link" href="{{ $this->address() }}" target="_blank" rel="noopener noreferrer">{{ $this->address() }}</a>
        @else
            {{-- Said plainly. A page that is not being served is not a failure,
                 it is the default, and somebody should not have to open it in a
                 private window to find that out. --}}
            <p class="ld-status__how">{{ $words['address_off'] }}</p>
        @endif
    </div>

    {{ $this->form }}

    <x-filament-actions::modals />
</x-filament-panels::page>
