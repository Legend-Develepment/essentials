{{--
    The plugin's block on the dashboard: what it is, and what the machines are
    doing. One card rather than two, because two cards carrying the same
    plugin's name was one too many.

    The countdown ticks in the browser from a timestamp the server worked out
    once. A clock does not need a request per second, and this sits on the page
    everyone lands on.
--}}
<x-filament-widgets::widget>
    <div class="ld-status">
        @if ($status)
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
                    {{-- Beside the update button: "what would that update
                         actually do" is asked while looking at it. --}}
                    {{ $this->changelogAction }}
                    {{ $this->updateAction }}
                </div>
            </div>

            @if ($auto)
                {{--
                    The timestamp is an attribute, read on every tick, rather
                    than a value baked into x-data. That is the whole fix.

                    Alpine evaluates an x-data expression once, when it builds
                    the component. Livewire morphing the widget updates the
                    attribute in the DOM but never re-initialises the component,
                    so a timestamp captured in x-data stays at whatever it was on
                    first paint: the countdown reached zero, asked the server for
                    the next boundary, was handed one - and went on counting
                    against the old one, saying "due now" for ever.
                --}}
                <p class="ld-status__auto"
                   data-ld-until="{{ $nextRun }}"
                   @if ($nextRun)
                       x-data="{
                           left: '',
                           timer: null,
                           asked: 0,

                           init() {
                               this.tick();
                               this.timer = setInterval(() => this.tick(), 1000);
                           },

                           destroy() {
                               clearInterval(this.timer);
                           },

                           tick() {
                               const until = Number(this.$el.dataset.ldUntil || 0);
                               const seconds = until - Math.floor(Date.now() / 1000);

                               if (seconds > 0) {
                                   const d = Math.floor(seconds / 86400);
                                   const h = Math.floor(seconds % 86400 / 3600);
                                   const m = Math.floor(seconds % 3600 / 60);
                                   const s = seconds % 60;

                                   this.left = d ? d + 'd ' + h + 'h ' + m + 'm'
                                       : h ? h + 'h ' + m + 'm ' + s + 's'
                                       : m + 'm ' + s + 's';

                                   return;
                               }

                               this.left = '{{ \LegendDevelopment\Theme\Support\Theme::trans('page.due_now') }}';

                               // Asked once per boundary, keyed on the one that
                               // just passed: a refresh that hands back a new
                               // timestamp arms this again, and one that hands
                               // back the same cannot loop. Five seconds late,
                               // so the run it was waiting for has happened.
                               if (this.asked !== until) {
                                   this.asked = until;
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
        @endif

        @if ($machines !== [])
            {{-- The machines: the panel's own host first, then every node. --}}
            <div class="ld-nodes">
                @foreach ($machines as $node)
                    <div class="ld-nodes__row">
                        <span class="ld-nodes__name">{{ $node['name'] }}</span>

                        @if ($node['maintenance'])
                            <span class="ld-nodes__flag ld-nodes__flag--maintenance">{{ $words['maintenance'] }}</span>
                        @elseif (!$node['reachable'])
                            {{-- Said plainly. A node that cannot be reached showing
                                 zeroes would read as a very idle machine. --}}
                            <span class="ld-nodes__flag ld-nodes__flag--offline">{{ $words['offline'] }}</span>
                        @endif

                        @if ($node['reachable'])
                            <div class="ld-nodes__meters">
                                <div class="ld-nodes__meter" data-level="{{ $node['cpu_level'] }}">
                                    <span class="ld-nodes__label">{{ $words['cpu'] }}</span>
                                    <span class="ld-nodes__bar" style="--ld-fill: {{ min(100, $node['cpu'] ?? 0) }}%"></span>
                                    <span class="ld-nodes__figure">{{ $node['cpu_label'] }}</span>
                                </div>

                                <div class="ld-nodes__meter" data-level="{{ $node['memory_level'] }}">
                                    <span class="ld-nodes__label">{{ $words['memory'] }}</span>
                                    <span class="ld-nodes__bar" style="--ld-fill: {{ $node['memory_percent'] ?? 0 }}%"></span>
                                    <span class="ld-nodes__figure">{{ $node['memory_label'] }}</span>
                                </div>

                                <div class="ld-nodes__meter" data-level="{{ $node['disk_level'] }}">
                                    <span class="ld-nodes__label">{{ $words['disk'] }}</span>
                                    <span class="ld-nodes__bar" style="--ld-fill: {{ $node['disk_percent'] ?? 0 }}%"></span>
                                    <span class="ld-nodes__figure">{{ $node['disk_label'] }}</span>
                                </div>
                            </div>

                            @if ($node['load'] !== null)
                                <span class="ld-nodes__load">{{ $words['load'] }} {{ $node['load'] }}</span>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-filament-widgets::widget>
