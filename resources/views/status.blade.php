{{--
    The public status page.

    A whole document rather than a panel page, because it is served to somebody
    who is not signed in and has no panel around it. And its own small stylesheet
    rather than the theme's: that file is built by the panel's Vite and is a
    hundred kilobytes of rules for components none of which are here, on a page
    whose entire job is to answer one question quickly for somebody on mobile
    data during an outage. One colour is carried over, which is enough for it to
    look like yours.

    Every key is written out in full below rather than through a helper.
    tools/check-lang.js can only verify a literal, and a $t('up') shorthand would
    hide every key on this page from the check that exists because two of them
    once shipped broken and rendered as their own names.
--}}
@php
    use Carbon\CarbonImmutable;
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'up' => Theme::trans('status.up'),
        'down' => Theme::trans('status.down'),
        'starting' => Theme::trans('status.starting'),
        'unknown' => Theme::trans('status.unknown'),
        'players' => Theme::trans('status.players'),
        'checked' => Theme::trans('status.checked'),
        'empty' => Theme::trans('status.empty'),
        'panel' => Theme::trans('status.panel'),
        'all_up' => Theme::trans('status.all_up'),
        'some_down' => Theme::trans('status.some_down'),
        'section_servers' => Theme::trans('status.section_servers'),
        'section_nodes' => Theme::trans('status.section_nodes'),
        'section_monitors' => Theme::trans('status.section_monitors'),
    ];

    /*
     * One sentence at the top, from everything on the page.
     *
     * A visitor's question is "is anything broken", and answering it once above
     * the list saves them reading three sections to find out. Only 'down'
     * counts - an unknown is the panel admitting it could not check, and
     * turning that into "something is not running" would be the page guessing
     * in public.
     */
    $down = collect($servers)->where('state', 'down')->count()
        + collect($nodes)->where('state', 'down')->count()
        + collect($monitors)->where('state', 'down')->count();

    /* Headings only where there is more than one kind of thing. A page with
       four servers and nothing else does not need to be told they are servers. */
    $sections = (count($servers) > 0 ? 1 : 0)
        + (count($nodes) > 0 ? 1 : 0)
        + (count($monitors) > 0 ? 1 : 0);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mode="{{ $mode }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- Not indexed. A status page is for people who were given the address,
         and a search result for "is <your clan> down" that answers with a
         snapshot from three weeks ago helps nobody. --}}
    <meta name="robots" content="noindex, nofollow">

    <style>
        /*
         * Dark is the default and light is a swap of five tokens.
         *
         * The states keep their colours in both: green, red and amber mean the
         * same thing to somebody who has never seen this page before, and
         * tuning them per mode would be a lot of care spent on making an
         * outage slightly prettier.
         */
        /*
         * Every colour here has been through Palette::sanitize(), and the greys
         * through Palette::shift() - the same function the panel's own
         * stylesheet uses to build a raised and a sunken tone from one surface.
         * So a page set to a style looks like the panel set to that style,
         * rather than like a separate page that happens to share an accent.
         *
         * Light is a swap of five tokens. The states keep their colours in both:
         * green, red and amber mean the same thing to somebody who has never
         * seen this page, and tuning them per mode would be care spent on making
         * an outage slightly prettier.
         */
        :root {
            --accent: {{ $accent }};
            --bg: {{ $surface }};
            --card: {{ $card }};
            --line: {{ $line }};
            --radius: {{ $radius }};
            --ink: #e8eaed;
            --dim: #9aa0a8;
            --up: #3ba55d;
            --down: #ed4245;
            --wait: #faa61a;
        }

        html[data-mode='light'] {
            --bg: #f7f8fa;
            --card: #ffffff;
            --line: #e3e6ea;
            --ink: #16181d;
            --dim: #5c636b;
        }

        /* Auto follows the reader rather than the person who made the page,
           which is the whole point of offering it. */
        @media (prefers-color-scheme: light) {
            html[data-mode='auto'] {
                --bg: #f7f8fa;
                --card: #ffffff;
                --line: #e3e6ea;
                --ink: #16181d;
                --dim: #5c636b;
            }
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 2rem 1rem 3rem;
            background: var(--bg);
            color: var(--ink);
            font: 15px/1.6 system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        .wrap { max-width: 44rem; margin: 0 auto; }

        h1 { margin: 0 0 0.25rem; font-size: 1.6rem; }

        .lede { margin: 0 0 1.5rem; color: var(--dim); }

        h2 {
            margin: 1.75rem 0 0.5rem;
            color: var(--dim);
            font-size: 0.6875rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        h2:first-of-type { margin-top: 0; }

        .note {
            margin: 0 0 1.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid var(--line);
            border-left: 3px solid var(--accent);
            border-radius: var(--radius);
            background: var(--card);
        }

        .row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--card);
        }

        .row + .row { margin-top: 0.5rem; }

        /* min-width: 0 so one long unbroken name cannot widen the row past the
           screen - the same rule every list in this plugin needs. */
        .name { flex: 1 1 auto; min-width: 0; font-weight: 600; overflow-wrap: anywhere; }

        .players { flex: none; color: var(--dim); font-size: 0.875rem; font-variant-numeric: tabular-nums; }

        .state {
            flex: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .dot { width: 0.55rem; height: 0.55rem; border-radius: 50%; background: currentColor; }

        .state--up { color: var(--up); }
        .state--down { color: var(--down); }
        .state--starting { color: var(--wait); }
        .state--unknown { color: var(--dim); }

        footer { margin-top: 2rem; color: var(--dim); font-size: 0.8125rem; }
        footer a { color: var(--accent); }

        @media (max-width: 26rem) {
            /* The count drops below the name rather than squeezing it. */
            .row { flex-wrap: wrap; }
            .players { order: 3; flex-basis: 100%; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>{{ $title }}</h1>
        <p class="lede">{{ $down === 0 ? $words['all_up'] : $words['some_down'] }}</p>

        @if ($note !== '')
            <p class="note">{{ $note }}</p>
        @endif

        @if (count($servers) > 0)
            @if ($sections > 1)
                <h2>{{ $words['section_servers'] }}</h2>
            @endif

            @foreach ($servers as $server)
                <div class="row">
                    <span class="name">{{ $server['name'] }}</span>

                    {{-- Only where there is a number. A blank is better than a
                         confident zero on a server the panel could not ask. --}}
                    @if ($server['online'] !== null)
                        <span class="players">{{ $words['players'] }} {{ $server['online'] }}@if ($server['max'])/{{ $server['max'] }}@endif</span>
                    @endif

                    <span class="state state--{{ $server['state'] }}">
                        <span class="dot"></span>
                        @switch($server['state'])
                            @case('up')       {{ $words['up'] }}       @break
                            @case('down')     {{ $words['down'] }}     @break
                            @case('starting') {{ $words['starting'] }} @break
                            @default          {{ $words['unknown'] }}
                        @endswitch
                    </span>
                </div>
            @endforeach
        @endif

        {{-- Machines, up or down and nothing else. Not the load, not how full
             the disk is - a visitor asking whether they can play does not need
             a capacity report on somebody's hardware, and publishing one is a
             map of where the pressure is. --}}
        @if (count($nodes) > 0)
            @if ($sections > 1)
                <h2>{{ $words['section_nodes'] }}</h2>
            @endif

            @foreach ($nodes as $node)
                <div class="row">
                    <span class="name">{{ $node['name'] }}</span>
                    <span class="state state--{{ $node['state'] }}">
                        <span class="dot"></span>
                        @switch($node['state'])
                            @case('up')   {{ $words['up'] }}   @break
                            @case('down') {{ $words['down'] }} @break
                            @default      {{ $words['unknown'] }}
                        @endswitch
                    </span>
                </div>
            @endforeach
        @endif

        @if (count($monitors) > 0)
            @if ($sections > 1)
                <h2>{{ $words['section_monitors'] }}</h2>
            @endif

            @foreach ($monitors as $monitor)
                <div class="row">
                    <span class="name">{{ $monitor['name'] }}</span>
                    <span class="state state--{{ $monitor['state'] }}">
                        <span class="dot"></span>
                        {{ $monitor['state'] === 'up' ? $words['up'] : $words['down'] }}
                    </span>
                </div>
            @endforeach
        @endif

        @if ($sections === 0)
            <p class="lede">{{ $words['empty'] }}</p>
        @endif

        <footer>
            {{ $words['checked'] }} {{ CarbonImmutable::createFromTimestamp($at)->diffForHumans() }}

            @if ($panelUrl !== null)
                &middot; <a href="{{ $panelUrl }}">{{ $words['panel'] }}</a>
            @endif
        </footer>
    </div>
</body>
</html>
