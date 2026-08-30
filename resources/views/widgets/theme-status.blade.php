{{--
    The plugin's state on the dashboard.

    The countdown ticks in the browser from a timestamp the server worked out
    once. A clock does not need a request per second, and this sits on the page
    everyone lands on.
--}}
<x-filament-widgets::widget>
    <div class="ld-status">
        <div class="ld-status__head">
            <span class="ld-status__name">{{ $name }}</span>
            <span class="ld-status__version">v{{ $version }}</span>

            @if ($channel !== '')
                <span class="ld-status__channel">{{ $channel }}</span>
            @endif

            @if ($available)
                <span class="ld-status__state ld-status__state--update">
                    {{ \LegendDevelopment\Theme\Support\Theme::trans('page.update_available') }}@if ($latest) · v{{ $latest }} @endif
                </span>
            @elseif ($reachable)
                <span class="ld-status__state ld-status__state--ok">
                    {{ \LegendDevelopment\Theme\Support\Theme::trans('page.up_to_date') }}
                </span>
            @else
                {{-- Not the same as "no update": the feed could not be read, and
                     saying "up to date" here would be a guess dressed as a fact. --}}
                <span class="ld-status__state ld-status__state--unknown">
                    {{ \LegendDevelopment\Theme\Support\Theme::trans('page.check_failed') }}
                </span>
            @endif

            <div class="ld-status__actions">
                {{ $this->updateAction }}
            </div>
        </div>

        @if ($auto)
            <p class="ld-status__auto"
               @if ($nextRun)
                   {{--
                       init() and destroy() rather than x-init with a bare
                       setInterval. Livewire morphs this widget whenever
                       anything on the dashboard updates, and Alpine rebuilds
                       the component when it does - the old interval survived
                       that, kept writing to the scope that had been thrown
                       away, and the countdown froze on whatever second it had
                       reached. This one is cleared when its component goes.
                   --}}
                   x-data="{
                       until: {{ $nextRun }},
                       left: '',
                       timer: null,
                       asked: false,

                       init() {
                           this.tick();
                           this.timer = setInterval(() => this.tick(), 1000);
                       },

                       destroy() {
                           clearInterval(this.timer);
                       },

                       tick() {
                           const seconds = this.until - Math.floor(Date.now() / 1000);

                           if (seconds > 0) {
                               const d = Math.floor(seconds / 86400);
                               const h = Math.floor(seconds % 86400 / 3600);
                               const m = Math.floor(seconds % 3600 / 60);
                               const s = seconds % 60;

                               this.left = d ? `${d}d ${h}h ${m}m`
                                   : h ? `${h}h ${m}m ${s}s`
                                   : `${m}m ${s}s`;

                               return;
                           }

                           this.left = '{{ \LegendDevelopment\Theme\Support\Theme::trans('page.due_now') }}';

                           /*
                            * Reaching zero used to be the end of it: the block
                            * said 'due now' until somebody reloaded, however
                            * many checks had been and gone since. Ask the
                            * server for the next boundary instead - once, a
                            * few seconds late so the run it is waiting for has
                            * actually happened.
                            */
                           if (!this.asked) {
                               this.asked = true;
                               setTimeout(() => this.$wire.$refresh(), 5000);
                           }
                       },
                   }"
               @endif
            >
                <span>{{ \LegendDevelopment\Theme\Support\Theme::trans('page.auto_on') }} — {{ $auto }}</span>

                @if ($nextRun)
                    <span class="ld-status__countdown">
                        {{ \LegendDevelopment\Theme\Support\Theme::trans('page.next_check') }}
                        <strong x-text="left"></strong>
                    </span>
                @endif
            </p>
        @endif
    </div>
</x-filament-widgets::widget>
