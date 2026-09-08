{{--
    The public shop.

    A whole document rather than a panel page, for the same reason the status
    page is one: it is served to somebody who has not signed in and has no panel
    around them. Its own small stylesheet, one colour carried over from the
    theme, and nothing that needs JavaScript to read a price.

    Every key is written out in full below rather than through a helper.
    tools/check-lang.js can only verify a literal, and a shorthand would hide
    every key on this page from the check.
--}}
@php
    use LegendDevelopment\Theme\Support\Theme;

    $words = [
        'sold_out' => Theme::trans('shop.sold_out'),
        'buy' => Theme::trans('shop.buy'),
        'empty' => Theme::trans('shop.public_empty'),
        'empty_body' => Theme::trans('shop.public_empty_body'),
        'panel' => Theme::trans('shop.to_panel'),
        'terms' => Theme::trans('shop.terms'),
        'sign_in_note' => Theme::trans('shop.sign_in_note'),
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mode="{{ $mode }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <style>
        :root {
            --accent: {{ $accent }};
            --bg: {{ $surface }};
            --card: {{ $card }};
            --line: {{ $line }};
            --radius: {{ $radius }};
            --ink: #e8eaed;
            --dim: #9aa0a8;
        }

        html[data-mode='light'] {
            --bg: #f7f8fa;
            --card: #ffffff;
            --line: #e3e6ea;
            --ink: #16181d;
            --dim: #5c636b;
        }

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

        .wrap { max-width: 62rem; margin: 0 auto; }

        h1 { margin: 0 0 0.25rem; font-size: 1.6rem; }

        .lede { margin: 0 0 2rem; color: var(--dim); white-space: pre-line; }

        /* One column on a phone, and as many as fit after that. A shop with
           three packages should not stretch them across a desktop. */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(16rem, 1fr));
            gap: 1rem;
        }

        .card {
            display: flex;
            flex-direction: column;
            padding: 1.25rem;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--card);
        }

        .card h2 { margin: 0 0 0.35rem; font-size: 1.1rem; }

        /* Full bleed, so it reads as the card's own picture rather than
           something sitting inside it. The negative margins are the card's
           padding, and the ratio is fixed so a grid of packages whose art came
           from three different places still lines up. */
        .art {
            display: block;
            width: calc(100% + 2.5rem);
            margin: -1.25rem -1.25rem 1rem;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            border-radius: var(--radius) var(--radius) 0 0;
            background: var(--line);
        }

        .card .about {
            margin: 0 0 1rem;
            color: var(--dim);
            font-size: 0.9375rem;
            white-space: pre-line;
        }

        .price {
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 0 0.35rem;
            margin-bottom: 0.25rem;
        }

        .price strong {
            color: var(--accent);
            font-size: 1.6rem;
            line-height: 1.1;
            font-variant-numeric: tabular-nums;
        }

        .price .per { color: var(--dim); font-size: 0.9375rem; }

        .setup { margin: 0 0 1rem; color: var(--dim); font-size: 0.875rem; }

        .specs {
            margin: 0 0 1.25rem;
            padding: 0;
            list-style: none;
            color: var(--dim);
            font-size: 0.9375rem;
        }

        .specs li { padding: 0.15rem 0; }

        /* Pushed to the bottom so buttons line up across cards of different
           heights, which is the difference between a grid and a pile. */
        .buy {
            margin-top: auto;
            display: block;
            padding: 0.6rem 1rem;
            border: 0;
            border-radius: var(--radius);
            background: var(--accent);
            color: #fff;
            font: inherit;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }

        .buy:hover { filter: brightness(1.08); }

        .buy[aria-disabled='true'] {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--dim);
            font-weight: 500;
            pointer-events: none;
        }

        .empty {
            padding: 3rem 1rem;
            border: 1px dashed var(--line);
            border-radius: var(--radius);
            color: var(--dim);
            text-align: center;
        }

        .empty strong { display: block; color: var(--ink); margin-bottom: 0.35rem; }

        .foot {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem 1rem;
            margin-top: 2rem;
            color: var(--dim);
            font-size: 0.875rem;
        }

        .foot a { color: var(--dim); }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>{{ $title }}</h1>

        @if ($note !== '')
            <p class="lede">{{ $note }}</p>
        @else
            <p class="lede">{{ $words['sign_in_note'] }}</p>
        @endif

        @if (count($cards) === 0)
            <div class="empty">
                <strong>{{ $words['empty'] }}</strong>
                {{ $words['empty_body'] }}
            </div>
        @else
            <div class="grid">
                @foreach ($cards as $card)
                    <article class="card">
                        @if ($card['art'] !== null)
                            <img class="art" src="{{ $card['art'] }}" alt="" loading="lazy">
                        @endif

                        <h2>{{ $card['name'] }}</h2>

                        @if ($card['description'] !== '')
                            <p class="about">{{ $card['description'] }}</p>
                        @endif

                        <p class="price">
                            <strong>{{ $card['price'] }}</strong>
                            <span class="per">{{ $card['per'] }}</span>
                        </p>

                        @if ($card['setup'] !== null)
                            <p class="setup">{{ $card['setup'] }}</p>
                        @endif

                        @if ($card['term'] !== null)
                            <p class="setup">{{ $card['term'] }}</p>
                        @endif

                        <ul class="specs">
                            @foreach ($card['specs'] as $spec)
                                <li>{{ $spec }}</li>
                            @endforeach
                        </ul>

                        @if ($card['sold_out'])
                            <span class="buy" aria-disabled="true">{{ $words['sold_out'] }}</span>
                        @else
                            <a class="buy" href="{{ $card['url'] }}">{{ $words['buy'] }}</a>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif

        <p class="foot">
            <a href="{{ $panelUrl }}">{{ $words['panel'] }}</a>

            @if ($terms !== null)
                <a href="{{ $terms }}" rel="noopener">{{ $words['terms'] }}</a>
            @endif
        </p>
    </div>
</body>
</html>
