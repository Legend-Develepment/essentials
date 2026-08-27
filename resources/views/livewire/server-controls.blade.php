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
        @if ($popout)
            <button type="button" class="ld-controls__console" wire:click="$set('open', true)">
                @if ($consoleIcon)
                    {!! $consoleIcon !!}
                @endif
                <span>{{ $consoleLabel }}</span>
            </button>
        @else
            {{-- No websocket permission, so there is nothing to open here. The
                 page itself explains that properly. --}}
            <a class="ld-controls__console" href="{{ $console }}" wire:navigate>
                @if ($consoleIcon)
                    {!! $consoleIcon !!}
                @endif
                <span>{{ $consoleLabel }}</span>
            </a>
        @endif
    @endif

    @if ($buttons)
        @include(\LegendDevelopment\Theme\Support\Theme::id() . '::livewire.server-controls-power', ['buttons' => $buttons])
    @endif

    @if ($open)
        {{--
            The pop-out. Pelican's own console widget goes inside it rather than
            a copy of one: it brings its own websocket, its own token refresh,
            its own command history and its own xterm. A second implementation
            would be a second thing to keep in step with the panel.

            Rendered only while it is open, so no page that is not showing a
            console is holding a socket open to a node.
        --}}
        <div
            class="ld-pop"
            x-data
            x-on:keydown.escape.window="$wire.set('open', false)"
            role="dialog"
            aria-modal="true"
            aria-label="{{ $serverName }}"
        >
            <div class="ld-pop__backdrop" wire:click="$set('open', false)"></div>

            <div class="ld-pop__card">
                <div class="ld-pop__head">
                    @if ($status)
                        <span class="ld-controls__state" data-color="{{ $status->getColor() }}">
                            <span class="ld-controls__dot"></span>
                            <span class="ld-controls__state-label">{{ $status->getLabel() }}</span>
                        </span>
                    @endif

                    <span class="ld-pop__title">{{ $serverName }}</span>

                    @if ($buttons)
                        @include(\LegendDevelopment\Theme\Support\Theme::id() . '::livewire.server-controls-power', ['buttons' => $buttons])
                    @endif

                    <a class="ld-pop__link" href="{{ $console }}" wire:navigate title="{{ $expandLabel }}">
                        @if ($expandIcon)
                            {!! $expandIcon !!}
                        @endif
                        <span class="ld-controls__label">{{ $expandLabel }}</span>
                    </a>

                    <button
                        type="button"
                        class="ld-pop__close"
                        wire:click="$set('open', false)"
                        title="{{ $closeLabel }}"
                        aria-label="{{ $closeLabel }}"
                    >
                        @if ($closeIcon)
                            {!! $closeIcon !!}
                        @endif
                    </button>
                </div>

                <div class="ld-pop__body">
                    @if ($consoleWidget)
                        @livewire($consoleWidget, ['server' => $serverModel, 'user' => user()], 'ld-pop-console-' . $serverId)
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
