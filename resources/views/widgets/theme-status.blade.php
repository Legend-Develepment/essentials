{{--
    The plugin's block on the dashboard: what it is, and what the machines are
    doing. One card rather than two, because two cards carrying the same
    plugin's name was one too many.

    This plugin checks for no updates. When the Essentials Auto Updater is
    installed, an update it reports as waiting is said here, with a link to it.
--}}
<x-filament-widgets::widget>
    <div class="ld-status">
        @if ($status)
            <div class="ld-status__head">
                <span class="ld-status__name">{{ $name }}</span>
                <span class="ld-status__version">v{{ $version }}</span>

                {{-- Only an update the Essentials Auto Updater reports, in its
                     own words. Nothing is claimed otherwise. --}}
                @if (($update['waiting'] ?? false) === true)
                    <span class="ld-status__state ld-status__state--update">{{ $update['sentence'] }}</span>

                    @if (($updater['url'] ?? null) !== null)
                        <div class="ld-status__actions">
                            <a href="{{ $updater['url'] }}" class="fi-link text-sm">{{ $updater['label'] }}</a>
                        </div>
                    @endif
                @endif
            </div>

            {{--
                Outside the block above on purpose.

                Everything that outlives a request goes through a queue worker -
                a modpack install, a mail, a watchdog notice - and without one
                they all do the same nothing.

                Only drawn when a probe has actually gone unanswered. A panel
                that has not been asked yet says nothing rather than guessing.
            --}}
            @if ($worker !== '')
                <p class="ld-status__auto ld-status__auto--warn">{{ $worker }}</p>
            @endif

            {{--
                And whether the cron is running at all.

                This is the one thing no scheduled check can tell you, because
                a panel whose scheduler has stopped has nothing left to run the
                check. The scheduler leaves a mark each tick; this reads it in
                a browser, which is proof that something other than cron is
                awake. Without it, renewals and watchdog passes quietly stop and
                the panel looks perfectly well.
            --}}
            @if ($cron !== '')
                <p class="ld-status__auto ld-status__auto--warn">{{ $cron }}</p>
            @endif
        @endif

        @if ($machines !== [])
            {{-- The machines: the panel's own host first, then every node.
                 Under a heading of their own, so the card says what the rows
                 are rather than leaving them to be read as part of the version
                 line above. The rule between the two halves sits above this
                 heading, not between it and its rows. --}}
            <div class="ld-status__head">
                <h3 class="ld-status__name">{{ $words['title'] }}</h3>
            </div>

            <div class="ld-nodes">
                @foreach ($machines as $node)
                    <div class="ld-nodes__row">
                        {{-- The name is the link, where there is one: the panel's
                             row to System status, a node's row to Capacity. Null
                             wherever that page is switched off or the reader may
                             not see it, and then it is a name rather than a link
                             to a 404. --}}
                        @if (($node['link'] ?? null) !== null)
                            <a class="ld-nodes__name ld-nodes__link" href="{{ $node['link'] }}">{{ $node['name'] }}</a>
                        @else
                            <span class="ld-nodes__name">{{ $node['name'] }}</span>
                        @endif

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
