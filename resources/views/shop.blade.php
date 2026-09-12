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
        'offer' => Theme::trans('shop.offer_flag'),
        'popular' => Theme::trans('shop.popular_flag'),
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
        /* The toolbar, shaped like the panel's own. */
        .tools {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
            margin-bottom: 1rem;
        }

        .tools .search { flex: 1 1 14rem; }

        .tools input,
        .tools select {
            width: 100%;
            padding: 0.55rem 0.75rem;
            border: 1px solid color-mix(in oklab, var(--ink) 15%, transparent);
            border-radius: 0.55rem;
            background: var(--card);
            color: inherit;
            font: inherit;
            font-size: 0.9375rem;
        }

        .tools .sort {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            color: color-mix(in oklab, var(--ink) 65%, transparent);
            font-size: 0.875rem;
        }

        .tools .sort select { width: auto; }

        .tools input:focus-visible,
        .tools select:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 1px;
        }

        /* A card comes forward when it is being considered - the one thing that
           makes a grid feel like a shop rather than a table. */
        .card {
            transition: transform 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .card:hover,
        .card:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px -12px color-mix(in oklab, var(--accent) 40%, transparent);
        }

        .card.off { opacity: 0.65; }

        .card.off:hover,
        .card.off:focus-within {
            transform: none;
            box-shadow: none;
        }

        .shot {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16 / 9;
            background: linear-gradient(135deg,
                color-mix(in oklab, var(--accent) 22%, var(--card)),
                var(--card));
        }

        .shot img {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .shot img.back {
            position: absolute;
            inset: 0;
            object-fit: cover;
            transform: scale(1.2);
            filter: blur(18px) saturate(1.15) brightness(0.55);
        }

        .flag.offer,
        .flag.popular {
            display: inline-flex;
            gap: 0.3rem;
            align-items: center;
        }

        .flag-icon {
            width: 0.9rem;
            height: 0.9rem;
            flex: 0 0 auto;
        }

        .flag.offer {
            background: var(--accent);
            color: #fff;
        }

        /* Gold, because it is a crown, and because the one card somebody should
           look at first must not be the quietest thing on the page - which is
           what it was when it borrowed the card's own colours. */
        .flag.popular {
            background: linear-gradient(135deg, #f6c344, #e0a106);
            color: #3b2600;
            box-shadow: 0 2px 10px -4px rgb(224 161 6 / 0.8);
        }

        .was {
            margin-right: 0.35rem;
            color: color-mix(in oklab, var(--ink) 55%, transparent);
            font-size: 0.9375rem;
            font-weight: 400;
        }

        .saved {
            margin: 0 0 0.5rem;
            color: #16a34a;
            font-size: 0.875rem;
            font-weight: 700;
        }

        .offerfrom {
            margin: 0 0 0.5rem;
            color: var(--accent);
            font-size: 0.8125rem;
            font-weight: 600;
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
                {{-- Search and sort, beside the groups. Hidden until the
                     script shows them, so a reader without JavaScript is never
                     handed a box that does nothing - the same rule the panel's
                     own store follows, from the same partial. --}}
                <div class="tools" id="ld-tools" hidden>
                    <label class="search">
                        <input type="search" data-shop-search placeholder="{{ Theme::trans('shop.search') }}" aria-label="{{ Theme::trans('shop.search') }}">
                    </label>

                    <label class="sort">
                        <span>{{ Theme::trans('shop.sort') }}</span>

                        <select data-shop-sort>
                            <option value="">{{ Theme::trans('shop.sort_featured') }}</option>
                            <option value="price-up">{{ Theme::trans('shop.sort_price_up') }}</option>
                            <option value="price-down">{{ Theme::trans('shop.sort_price_down') }}</option>
                            <option value="name">{{ Theme::trans('shop.sort_name') }}</option>
                        </select>
                    </label>
                </div>

                <div class="empty" id="ld-none" hidden>
                    <strong>{{ Theme::trans('shop.search_none') }}</strong>
                    <span>{{ Theme::trans('shop.search_none_body') }}</span>
                </div>

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
                    <article class="card{{ $card['sold_out'] ? ' off' : '' }}"
                             data-game="{{ $card['group'] ?? '' }}"
                             data-name="{{ $card['name'] }}"
                             data-amount="{{ $card['amount'] }}">
                        <div class="shot">
                            @if ($card['art'] !== null)
                                {{-- Twice, and fetched once: blurred underneath
                                     to fill the box, whole on top. See the
                                     panel's own cards, which do the same. --}}
                                <img class="back" src="{{ $card['art'] }}" alt="" aria-hidden="true" loading="lazy">
                                <img src="{{ $card['art'] }}" alt="" loading="lazy">
                            @endif

                            @if ($card['sold_out'])
                                <span class="flag">{{ $words['sold_out'] }}</span>
                            @elseif ($card['on_offer'])
                                {{-- The icons are drawn here rather than
                                     called for. This page is served without the
                                     panel around it, so there is no component
                                     to ask - and two paths of markup are a
                                     smaller price than a dependency on a
                                     framework that is not loaded. --}}
                                <span class="flag offer">
                                    <svg class="flag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 15l6 -6" /><path d="M9 9.5a.5 .5 0 1 0 1 0a.5 .5 0 1 0 -1 0" /><path d="M14 14.5a.5 .5 0 1 0 1 0a.5 .5 0 1 0 -1 0" /><path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7a2.2 2.2 0 0 0 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1a2.2 2.2 0 0 0 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" /></svg>
                                    {{ $words['offer'] }}
                                </span>
                            @elseif ($card['popular'])
                                <span class="flag popular">
                                    <svg class="flag-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4l4 -6" /></svg>
                                    {{ $words['popular'] }}
                                </span>
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
                                @if ($card['was'] !== null)
                                    <s class="was">{{ $card['was'] }}</s>
                                @endif

                                <strong>{{ $card['price'] }}</strong>
                                <span class="per">{{ $card['per'] }}</span>
                            </p>

                            @if ($card['saved'] !== null)
                                <p class="saved">{{ $card['saved'] }}</p>
                            @endif

                            @if ($card['offer_from'] !== null)
                                <p class="offerfrom">{{ $card['offer_from'] }}</p>
                            @endif

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
        {{-- One partial, both shops. The group buttons, the search box and
             the sort are read by the same apply() there, so they narrow one
             list together instead of each undoing the other. --}}
        @include(\LegendDevelopment\Theme\Support\Theme::id() . '::partials.shop-tools')
    @endif
</body>
</html>
