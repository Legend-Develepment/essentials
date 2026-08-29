{{--
    One floating button, on every page inside a server except the console,
    which has all of this already.

    Plain buttons rather than Filament actions: this is rendered into a hook on
    every page in the panel, and a plain button cannot pull a schema, a modal
    stack or an action lifecycle in behind it. Everything it looks like is the
    theme's own stylesheet.
--}}
<div
    @class([
        'ld-controls',
        // A strip across the top of the console's own window, or a floating
        // button everywhere else. Never both.
        'ld-controls--strip' => $bare,
        'ld-controls--floating' => !$bare,
        'ld-controls--' . $position => !$bare,
        'ld-controls--icon' => !$bare && $iconOnly,
    ])
    @if ($poll) wire:poll.15s @endif
>
    @if ($bare)
        @if ($status)
            <span class="ld-controls__state" data-color="{{ $status->getColor() }}">
                <span class="ld-controls__dot"></span>
                <span class="ld-controls__state-label">{{ $status->getLabel() }}</span>
            </span>
        @endif

        <span class="ld-controls__name">{{ $serverName }}</span>
    @endif

    @if ($console)
        @if ($inPopout)
            {{-- The resize is for the terminal inside: it may have been built
                 while the window was hidden, and a hidden box has no size to
                 measure against. --}}
            <button
                type="button"
                class="ld-controls__console"
                wire:click="openConsole"
                x-on:click="setTimeout(() => window.dispatchEvent(new Event('resize')), 90)"
                title="{{ $consoleLabel }}"
            >
                @if ($consoleIcon)
                    {!! $consoleIcon !!}
                @endif
                <span class="ld-controls__console-label">{{ $consoleLabel }}</span>

                {{-- The state rides on the button, because one button may as
                     well answer the question you would have opened it to ask.
                     The colour is the panel's own name for it - success,
                     warning, danger - which the stylesheet maps onto Filament's
                     ramps. --}}
                @if ($status)
                    <span class="ld-controls__state" data-color="{{ $status->getColor() }}">
                        <span class="ld-controls__dot"></span>
                    </span>
                @endif
            </button>
        @else
            {{-- No websocket permission, so there is nothing to open here. The
                 console page itself explains that properly, and has Pelican's
                 own power buttons on it. --}}
            <a class="ld-controls__console" href="{{ $console }}" wire:navigate title="{{ $consoleLabel }}">
                @if ($consoleIcon)
                    {!! $consoleIcon !!}
                @endif
                <span class="ld-controls__console-label">{{ $consoleLabel }}</span>
            </a>
        @endif
    @endif

    {{-- These live in the pop-out's header, rendered from the same partial.
         They only stay out here when there is no pop-out to put them in - see
         the component. --}}
    @if ($buttons && !$inPopout)
        @include(\LegendDevelopment\Theme\Support\Theme::id() . '::livewire.server-controls-power', ['buttons' => $buttons])
    @endif

    @if ($mount)
        {{--
            The pop-out. Pelican's own console widget goes inside it rather than
            a copy of one: it brings its own websocket, its own token refresh,
            its own command history and its own xterm. A second implementation
            would be a second thing to keep in step with the panel.

            Nothing is rendered until it is opened for the first time, so a page
            you never opened a console on never holds a socket. After that it
            stays and is only hidden - see $mounted on the component.
        --}}
        <div
            class="ld-pop @if (!$open) ld-pop--hidden @endif"
            x-data
            x-on:keydown.escape.window="$wire.closeConsole()"
            role="dialog"
            aria-modal="true"
            aria-label="{{ $serverName }}"
            @if (!$open) aria-hidden="true" @endif
        >
            <div class="ld-pop__backdrop" wire:click="closeConsole"></div>

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

                    {{--
                        A window of its own, so the console can sit beside the
                        page you were working on instead of replacing it.

                        Still an anchor underneath: middle-click, ctrl-click and
                        a browser that blocks the popup all fall through to
                        opening the console page, which is the honest fallback.
                    --}}
                    <a
                        class="ld-pop__link"
                        href="{{ $windowUrl }}"
                        target="_blank"
                        rel="noopener"
                        title="{{ $expandLabel }}"
                        x-on:click.prevent="window.open(
                            $el.getAttribute('href'),
                            'ld-console-{{ $serverId }}',
                            'popup=yes,width=1100,height=720,menubar=no,toolbar=no,location=no,status=no'
                        ) || window.open($el.getAttribute('href'), '_blank')"
                    >
                        @if ($expandIcon)
                            {!! $expandIcon !!}
                        @endif
                        <span class="ld-controls__label">{{ $expandLabel }}</span>
                    </a>

                    <button
                        type="button"
                        class="ld-pop__close"
                        wire:click="closeConsole"
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
