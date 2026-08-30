{{--
    Every node, with what it is using. The bars share the server cards' own
    thresholds, so a number that is red here is red there.
--}}
<x-filament-widgets::widget>
    <div class="ld-nodes">
        <p class="ld-nodes__title">{{ $title }}</p>

        @foreach ($nodes as $node)
            <div class="ld-nodes__row">
                <span class="ld-nodes__name">{{ $node['name'] }}</span>

                @if ($node['maintenance'])
                    <span class="ld-nodes__flag ld-nodes__flag--maintenance">{{ $maintenance }}</span>
                @elseif (!$node['reachable'])
                    {{-- Said plainly. A node that cannot be reached showing
                         zeroes would read as a very idle machine. --}}
                    <span class="ld-nodes__flag ld-nodes__flag--offline">{{ $offline }}</span>
                @endif

                @if ($node['reachable'])
                    <div class="ld-nodes__meters">
                        <div class="ld-nodes__meter" data-level="{{ $node['cpu_level'] }}">
                            <span class="ld-nodes__label">{{ $cpu }}</span>
                            <span class="ld-nodes__bar" style="--ld-fill: {{ min(100, $node['cpu'] ?? 0) }}%"></span>
                            <span class="ld-nodes__figure">{{ $node['cpu'] }}%</span>
                        </div>

                        <div class="ld-nodes__meter" data-level="{{ $node['memory_level'] }}">
                            <span class="ld-nodes__label">{{ $memory }}</span>
                            <span class="ld-nodes__bar" style="--ld-fill: {{ $node['memory_percent'] ?? 0 }}%"></span>
                            <span class="ld-nodes__figure">{{ $node['memory_label'] }}</span>
                        </div>

                        <div class="ld-nodes__meter" data-level="{{ $node['disk_level'] }}">
                            <span class="ld-nodes__label">{{ $disk }}</span>
                            <span class="ld-nodes__bar" style="--ld-fill: {{ $node['disk_percent'] ?? 0 }}%"></span>
                            <span class="ld-nodes__figure">{{ $node['disk_label'] }}</span>
                        </div>
                    </div>

                    @if ($node['load'] !== null)
                        <span class="ld-nodes__load">{{ $load }} {{ $node['load'] }}</span>
                    @endif
                @endif
            </div>
        @endforeach
    </div>
</x-filament-widgets::widget>
