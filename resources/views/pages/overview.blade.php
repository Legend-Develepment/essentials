{{--
    The shop, in the four numbers somebody asks for first.

    Every decision - which figure, what its second line says, whether a list is
    worth drawing at all - is made in the page class. This file is markup, and
    the empty cases are the point: a shop with nothing overdue draws no chasing
    list rather than an empty box saying there is nothing in it.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $figures = $this->figures();
    $headline = $this->headline();
    $chart = $this->chart();
    $chasing = $this->chasing();
    $stock = $this->stock();
    $links = $this->links();
    $clear = $this->allClear();

    $words = [
        'chasing' => Theme::trans('overview.chasing'),
        'late' => Theme::trans('overview.late'),
        'stock' => Theme::trans('overview.stock'),
        'open' => Theme::trans('overview.open_invoice'),
        'chart' => Theme::trans('overview.chart'),
        'chart_none' => Theme::trans('overview.chart_none'),
        'clear' => Theme::trans('overview.clear'),
        'clear_body' => Theme::trans('overview.clear_body'),
    ];
@endphp

<x-filament-panels::page>
    @if ($headline !== null)
        <p class="ld-over-headline">{{ $headline }}</p>
    @endif

    <div class="ld-over-figures">
        @foreach ($figures as $figure)
            <article class="ld-over-figure ld-over-figure--{{ $figure['tone'] }}">
                <span class="ld-over-label">
                    <x-filament::icon :icon="$figure['icon']" class="ld-over-icon" />
                    {{ $figure['label'] }}
                </span>

                <strong class="ld-over-value">
                    {{ $figure['value'] }}

                    {{-- Only the one figure that is a movement rather than a
                         state. "What is owed" is not up or down on anything. --}}
                    @if ($figure['trend'] !== null)
                        <span class="ld-over-trend ld-over-trend--{{ $figure['trend'] }}">
                            {{ $figure['trend'] === 'up' ? '▲' : '▼' }} {{ $figure['trend_text'] }}
                        </span>
                    @endif
                </strong>

                <span class="ld-over-note">{{ $figure['note'] }}</span>
            </article>
        @endforeach
    </div>

    {{-- A year of months. Bars rather than a line, because twelve points is a
         count of months and not a curve, and a bar can be pointed at. --}}
    <section class="ld-over-chart">
        <h2>{{ $words['chart'] }}</h2>

        @if ($chart['any'])
            <div class="ld-over-bars">
                @foreach ($chart['bars'] as $bar)
                    <div class="ld-over-bar {{ $bar['now'] ? 'ld-over-bar--now' : '' }}"
                         title="{{ $bar['label'] }} — {{ $bar['amount'] }}">
                        <span class="ld-over-stem" style="height: {{ $bar['height'] }}%"></span>
                        <span class="ld-over-month">{{ $bar['label'] }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="ld-over-quiet">{{ $words['chart_none'] }}</p>
        @endif
    </section>

    @if ($clear)
        <div class="ld-over-clear">
            <strong>{{ $words['clear'] }}</strong>
            <span>{{ $words['clear_body'] }}</span>
        </div>
    @endif

    <div class="ld-over-lists">
        {{-- Only when there is something to chase. An empty box that says
             "nothing here" is a box somebody stops reading. --}}
        @if (count($chasing) > 0)
            <section class="ld-over-list">
                <h2>{{ $words['chasing'] }}</h2>

                <ul>
                    @foreach ($chasing as $row)
                        <li>
                            <span class="ld-over-who">
                                {{ $row['who'] }}
                                <small>{{ $row['number'] }}</small>
                            </span>

                            <span class="ld-over-when {{ $row['late'] ? 'ld-over-when--late' : '' }}">
                                {{ $row['late'] ? $words['late'] : '' }} {{ $row['when'] }}
                            </span>

                            <span class="ld-over-amount">
                                @if ($row['url'] !== null)
                                    <a href="{{ $row['url'] }}" title="{{ $words['open'] }}">{{ $row['amount'] }}</a>
                                @else
                                    {{ $row['amount'] }}
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        @if (count($stock) > 0)
            <section class="ld-over-list">
                <h2>{{ $words['stock'] }}</h2>

                <ul>
                    @foreach ($stock as $row)
                        <li>
                            <span class="ld-over-who">{{ $row['name'] }}</span>
                            <span class="ld-over-when {{ $row['gone'] ? 'ld-over-when--late' : '' }}">{{ $row['note'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>

    @if (count($links) > 0)
        <p class="ld-over-links">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
            @endforeach
        </p>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
