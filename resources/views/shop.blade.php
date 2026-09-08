{{--
    The public shop.

    A whole document rather than a panel page, for the same reason the status
    page is one: it is served to somebody who has not signed in and has no panel
    around them. So it carries a header of its own, built from the same tokens
    the panel is painted with - the accent, the surface, the corner rounding -
    and it reads as the front of the same building rather than as a list of
    prices somebody left on a table.

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
        'account' => Theme::trans('shop.to_account'),
        'terms' => Theme::trans('shop.terms'),
        'sign_in_note' => Theme::trans('shop.sign_in_note'),
        'filter_all' => Theme::trans('shop.filter_all'),
        'filter_label' => Theme::trans('shop.filter_label'),
        'includes' => Theme::trans('shop.includes'),
        'count' => Theme::trans('shop.public_count', ['count' => count($cards)]),
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
            --head: color-mix(in oklab, {{ $surface }} 86%, transparent);
        }

        html[data-mode='light'] {
            --bg: #f7f8fa;
            --card: #ffffff;
            --line: #e3e6ea;
            --ink: #16181d;
            --dim: #5c636b;
            --head: rgba(247, 248, 250, 0.86);
        }

        @media (prefers-color-scheme: light) {
            html[data-mode='auto'] {
                --bg: #f7f8fa;
                --card: #ffffff;
                --line: #e3e6ea;
                --ink: #16181d;
                --dim: #5c636b;
                --head: rgba(247, 248, 250, 0.86);
            }
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font: 15px/1.6 system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }

        /* Nothing on this page is reachable by keyboard without one, and it is
           served to people the panel has never seen. */
        a:focus-visible,
        button:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        /* ---------------------------------------------------------- header -- */

        /*
         * The panel's own bar, rebuilt.
         *
         * It cannot be Filament's - this page is served outside the panel - so
         * it is drawn from the same tokens instead: the surface behind it, the
         * hairline under it, the accent on the one button that matters. Sticky
         * and translucent, because a shop is a page people scroll.
         */
        .top {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--line);
            background: var(--head);
            backdrop-filter: blur(10px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-right: auto;
            color: var(--ink);
            font-weight: 600;
            text-decoration: none;
        }

        .brand img {
            display: block;
            height: {{ $logoHeight }}rem;
            width: auto;
        }

        .top nav {
            display: flex;
            align-items: center;
            gap: 0.35rem 1rem;
        }

        .top nav a {
            color: var(--dim);
            font-size: 0.9375rem;
            text-decoration: none;
        }

        .top nav a:hover { color: var(--ink); }

        .top nav a.cta {
            padding: 0.45rem 0.9rem;
            border-radius: var(--radius);
            background: var(--accent);
            color: #fff;
            font-weight: 600;
        }

        .top nav a.cta:hover { filter: brightness(1.08); }

        /* ------------------------------------------------------------ hero -- */

        .wrap { max-width: 72rem; margin: 0 auto; padding: 0 1.25rem 4rem; }

        .hero { padding: 2.5rem 0 1.5rem; max-width: 44rem; }

        h1 { margin: 0 0 0.5rem; font-size: 2rem; line-height: 1.2; }

        .lede { margin: 0; color: var(--dim); white-space: pre-line; }

        /* --------------------------------------------------------- filters -- */

        /*
         * One row per game, when there is more than one.
         *
         * A shop with four Minecraft packages needs no filter and gets none;
         * one with four games and twelve packages is a list nobody reads to the
         * bottom. Without JavaScript every card stays visible, which is the
         * behaviour to fall back to.
         */
        .filters {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
            margin: 0 0 1.5rem;
        }

        .filters .label {
            margin-right: 0.25rem;
            color: var(--dim);
            font-size: 0.875rem;
        }

        .filters button {
            padding: 0.35rem 0.8rem;
            border: 1px solid var(--line);
            border-radius: 999px;
            background: transparent;
            color: var(--dim);
            font: inherit;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .filters button:hover { color: var(--ink); }

        .filters button[aria-pressed='true'] {
            border-color: transparent;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
        }

        .count { margin: 0 0 1.5rem; color: var(--dim); font-size: 0.875rem; }

        /* ----------------------------------------------------------- cards -- */

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(17rem, 1fr));
            gap: 1.25rem;
        }

        .card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--card);
            transition: border-color 0.15s, transform 0.15s;
        }

        .card:hover {
            border-color: color-mix(in oklab, var(--accent) 45%, var(--line));
            transform: translateY(-2px);
        }

        .card[hidden] { display: none; }

        /* The picture, and the badge that sits on it. A fixed ratio because the
           art comes from an upload, a URL or an egg, and a row of cards that
           each chose their own height is not a grid. */
        .shot {
            position: relative;
            aspect-ratio: 16 / 9;
            background: linear-gradient(135deg,
                color-mix(in oklab, var(--accent) 22%, var(--card)),
                var(--card));
        }

        .shot img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .flag {
            position: absolute;
            top: 0.6rem;
            right: 0.6rem;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.65);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .game {
            position: absolute;
            bottom: 0.6rem;
            left: 0.75rem;
            color: #fff;
            font-size: 0.8125rem;
            font-weight: 600;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
        }

        .body { display: flex; flex-direction: column; flex: 1; padding: 1.1rem 1.25rem 1.25rem; }

        .card h2 { margin: 0 0 0.35rem; font-size: 1.1rem; }

        .about {
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
            font-size: 1.7rem;
            line-height: 1.1;
            font-variant-numeric: tabular-nums;
        }

        .price .per { color: var(--dim); font-size: 0.9375rem; }

        .setup { margin: 0 0 0.35rem; color: var(--dim); font-size: 0.875rem; }

        .term { margin: 0 0 0.35rem; color: var(--accent); font-size: 0.875rem; font-weight: 600; }

        .heading {
            margin: 1rem 0 0.5rem;
            color: var(--dim);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

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
            padding: 0.65rem 1rem;
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
            padding: 4rem 1rem;
            border: 1px dashed var(--line);
            border-radius: var(--radius);
            color: var(--dim);
            text-align: center;
        }

        .empty strong { display: block; color: var(--ink); margin-bottom: 0.35rem; font-size: 1.1rem; }

        .foot {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem 1.25rem;
            max-width: 72rem;
            margin: 0 auto;
            padding: 1.25rem;
            border-top: 1px solid var(--line);
            color: var(--dim);
            font-size: 0.875rem;
        }

        .foot a { color: var(--dim); }
    </style>
</head>
<body>
    <header class="top">
        <a class="brand" href="{{ $panelUrl }}">
            @if ($logo !== null)
                <img src="{{ $logo }}" alt="">
            @endif

            <span>{{ $brand }}</span>
        </a>

        <nav>
            @if ($terms !== null)
                <a href="{{ $terms }}" rel="noopener">{{ $words['terms'] }}</a>
            @endif

            <a class="cta" href="{{ $panelUrl }}">{{ $signedIn ? $words['account'] : $words['panel'] }}</a>
        </nav>
    </header>

    <main class="wrap">
        <section class="hero">
            <h1>{{ $title }}</h1>

            <p class="lede">{{ $note !== '' ? $note : $words['sign_in_note'] }}</p>
        </section>

        @if (count($cards) === 0)
            <div class="empty">
                <strong>{{ $words['empty'] }}</strong>
                {{ $words['empty_body'] }}
            </div>
        @else
            @if (count($groups) > 1)
                <div class="filters" id="ld-filters">
                    <span class="label">{{ $words['filter_label'] }}</span>

                    <button type="button" data-for="" aria-pressed="true">{{ $words['filter_all'] }}</button>

                    @foreach ($groups as $group)
                        <button type="button" data-for="{{ $group }}" aria-pressed="false">{{ $group }}</button>
                    @endforeach
                </div>
            @endif

            <p class="count" id="ld-count">{{ $words['count'] }}</p>

            <div class="grid" id="ld-grid">
                @foreach ($cards as $card)
                    <article class="card" data-game="{{ $card['group'] ?? '' }}">
                        <div class="shot">
                            @if ($card['art'] !== null)
                                <img src="{{ $card['art'] }}" alt="" loading="lazy">
                            @endif

                            @if ($card['sold_out'])
                                <span class="flag">{{ $words['sold_out'] }}</span>
                            @endif

                            @if ($card['group'] !== null)
                                <span class="game">{{ $card['group'] }}</span>
                            @endif
                        </div>

                        <div class="body">
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
                                <p class="term">{{ $card['term'] }}</p>
                            @endif

                            <p class="heading">{{ $words['includes'] }}</p>

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
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="foot">
        <a href="{{ $panelUrl }}">{{ $signedIn ? $words['account'] : $words['panel'] }}</a>

        @if ($terms !== null)
            <a href="{{ $terms }}" rel="noopener">{{ $words['terms'] }}</a>
        @endif
    </footer>

    @if (count($groups) > 1)
        {{--
            Show one game's packages, or all of them.

            Everything it needs is already in the document: the buttons carry
            the name to match and the cards carry their own. Nothing is fetched
            and nothing is stored, so a reader who blocks scripts sees every
            card, which is the right thing to fall back to.

            The count under the filters is rewritten from the template on the
            element itself, so the sentence stays the translated one.
        --}}
        <script>
            (function () {
                var row = document.getElementById('ld-filters');
                var grid = document.getElementById('ld-grid');
                var count = document.getElementById('ld-count');

                if (!row || !grid) { return; }

                var cards = Array.prototype.slice.call(grid.children);
                var buttons = Array.prototype.slice.call(row.querySelectorAll('button'));
                var template = count ? count.textContent : '';
                var total = String(cards.length);

                row.addEventListener('click', function (event) {
                    var button = event.target.closest('button');

                    if (!button) { return; }

                    var want = button.getAttribute('data-for');
                    var shown = 0;

                    buttons.forEach(function (other) {
                        other.setAttribute('aria-pressed', other === button ? 'true' : 'false');
                    });

                    cards.forEach(function (card) {
                        var match = want === '' || card.getAttribute('data-game') === want;

                        card.hidden = !match;

                        if (match) { shown++; }
                    });

                    if (count) {
                        count.textContent = template.replace(total, String(shown));
                    }
                });
            })();
        </script>
    @endif
</body>
</html>
