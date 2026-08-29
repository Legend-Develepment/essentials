{{--
    The band across the top of the console's own window: what the server is
    doing, what it is called, where it is, and the buttons that change it.

    In the page's flow rather than fixed over it - this component is not lazy,
    so it is part of the first response, and nothing below it has to be pushed
    out of the way later. It is also why nothing here can land on top of
    anything else, which the six blocks and the page header managed between
    them.
--}}
<div class="ld-controls ld-controls--strip" @if ($poll) wire:poll.15s @endif>
    @if ($status)
        {{-- The colour is the panel's own name for it - success, warning,
             danger - which the stylesheet maps onto Filament's ramps. --}}
        <span class="ld-controls__state" data-color="{{ $status->getColor() }}">
            <span class="ld-controls__dot"></span>
            <span class="ld-controls__state-label">{{ $status->getLabel() }}</span>
        </span>
    @endif

    <span class="ld-controls__name">{{ $serverName }}</span>

    @if ($address)
        <span class="ld-controls__address">{{ $address }}</span>
    @endif

    @if ($buttons)
        @include(\LegendDevelopment\Theme\Support\Theme::id() . '::livewire.server-controls-power', ['buttons' => $buttons])
    @endif
</div>
