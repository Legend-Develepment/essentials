{{--
    The controls bar, on every page inside a server except the console, which
    has its own.

    Plain buttons rather than Filament actions: the bar is rendered into a hook
    on every page in the panel, and a plain button cannot pull a schema, a modal
    stack or an action lifecycle in behind it. Everything it looks like is the
    theme's own stylesheet.
--}}
<div class="ld-controls" @if ($poll) wire:poll.15s @endif>
    @if ($status)
        {{-- The colour is the panel's own name for it - success, warning,
             danger - which the stylesheet maps onto Filament's ramps. --}}
        <span class="ld-controls__state" data-color="{{ $status->getColor() }}">
            <span class="ld-controls__dot"></span>
            <span class="ld-controls__state-label">{{ $status->getLabel() }}</span>
        </span>
    @endif

    @if ($console)
        <a class="ld-controls__console" href="{{ $console }}" wire:navigate>
            @if ($consoleIcon)
                {!! $consoleIcon !!}
            @endif
            <span>{{ $consoleLabel }}</span>
        </a>
    @endif

    @if ($buttons)
        <div class="ld-controls__power">
            @foreach ($buttons as $button)
                <button
                    type="button"
                    class="ld-controls__button ld-controls__button--{{ $button['action'] }}"
                    wire:click="power('{{ $button['action'] }}')"
                    wire:loading.attr="disabled"
                    @if ($button['confirm']) wire:confirm="{{ $button['confirm'] }}" @endif
                    title="{{ $button['label'] }}"
                >
                    @if ($button['icon'])
                        {!! $button['icon'] !!}
                    @endif
                    <span class="ld-controls__label">{{ $button['label'] }}</span>
                </button>
            @endforeach
        </div>
    @endif
</div>
