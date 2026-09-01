/*
 * A star on each server card, and the starred ones first.
 *
 * Kept in the viewer's own browser and nowhere else: no table, no migration, no
 * permission to hand out, nothing on the server that can go wrong. Which server
 * somebody looks at most is theirs, not the panel's.
 *
 * Three things made this harder than it looks, and each is answered below where
 * it happens:
 *
 *  1. There is no render hook inside a server card, so the star has to be put
 *     into Pelican's own markup by script. This is the first time this plugin
 *     does that to something that is not its own, so every step gives up rather
 *     than guesses: no card found, no star; no identity readable, no star for
 *     that one. The failure mode is Pelican's list exactly as it ships.
 *  2. Those cards carry wire:poll.15s and are replaced every fifteen seconds,
 *     taking anything injected with them. So this watches and puts them back
 *     rather than decorating once.
 *  3. Sorting only works in grid mode. Pelican calls contentGrid() with two
 *     columns for the grid layout and null for the list, so in grid mode the
 *     records are grid items and `order` moves them. In list mode they are not,
 *     and making them so would mean restructuring Pelican's list - so there the
 *     star marks and does not move. Better a feature that does half of what it
 *     says on one layout than one that rearranges somebody's page by force.
 */
(() => {
    const KEY = 'legend-theme.favourites';
    const MARK = 'ld-fav';
    const ON = 'ld-fav--on';

    const config = window.__ldFav ?? {};

    /* ------------------------------------------------------------ storage */

    function read() {
        try {
            const raw = JSON.parse(localStorage.getItem(KEY) ?? '[]');

            return Array.isArray(raw) ? raw.filter((id) => typeof id === 'string') : [];
        } catch {
            // A private window, cleared site data, or storage the browser
            // refuses. Nobody has starred anything, which is a true answer.
            return [];
        }
    }

    function write(ids) {
        try {
            localStorage.setItem(KEY, JSON.stringify(ids.slice(0, 200)));
        } catch {
            // The star will not stick past this page. Everything else keeps
            // working, and there is nothing here worth an error for.
        }
    }

    /* -------------------------------------------------------------- cards */

    function cards() {
        // The same structural match the stylesheet uses for these cards: the
        // only element with a colour bar as a direct child. They have no class
        // of their own to hold on to.
        return [...document.querySelectorAll('[wire\\:id]')].filter(
            (element) => element.querySelector(':scope > .fi-color'),
        );
    }

    /*
     * Which server a card is, read from where it sends you when clicked.
     *
     * The card's own attributes cannot say: wire:id is regenerated every
     * request. The click handler is Pelican's redirectUrl(), which carries the
     * server's short id, and that does not change.
     */
    function identify(card) {
        const click = card.getAttribute('x-on:click') ?? '';
        const match = click.match(/\/server\/([A-Za-z0-9-]{4,})/);

        return match ? match[1] : null;
    }

    /* The header row, found by the server's name rather than by a utility
       class - an h2 is what it is, `flex items-center gap-2` is how it looks. */
    function header(card) {
        return card.querySelector('h2')?.parentElement ?? null;
    }

    /* The cell this card sits in, which is what `order` has to move. Only grid
       mode has one. */
    function cell(card) {
        const grid = card.closest('.fi-ta-content-grid');

        if (!grid) {
            return null;
        }

        let node = card;

        while (node.parentElement && node.parentElement !== grid) {
            node = node.parentElement;
        }

        return node.parentElement === grid ? node : null;
    }

    /* ------------------------------------------------------------ drawing */

    let busy = false;

    function star(id, on) {
        const button = document.createElement('button');

        button.type = 'button';
        button.className = MARK + (on ? ' ' + ON : '');
        button.dataset.ldFav = id;
        button.title = on ? (config.on ?? 'Starred') : (config.off ?? 'Star this server');
        button.setAttribute('aria-label', button.title);
        button.setAttribute('aria-pressed', on ? 'true' : 'false');
        button.innerHTML =
            '<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">' +
            '<path d="M12 3.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8-5.2-2.7-5.2 2.7 1-5.8L3.5 9.7l5.9-.9z"/>' +
            '</svg>';

        button.addEventListener('click', (event) => {
            // The whole card navigates on click. A star that opened the server
            // would be a star nobody could use.
            event.preventDefault();
            event.stopPropagation();

            const ids = read();
            const at = ids.indexOf(id);

            at === -1 ? ids.push(id) : ids.splice(at, 1);

            write(ids);
            decorate();
        });

        return button;
    }

    function decorate() {
        if (busy) {
            return;
        }

        busy = true;

        try {
            const starred = read();

            for (const card of cards()) {
                const id = identify(card);
                const row = header(card);

                if (id === null || row === null) {
                    continue;
                }

                const on = starred.includes(id);
                const existing = row.querySelector(':scope > .' + MARK);

                if (existing) {
                    existing.classList.toggle(ON, on);
                    existing.setAttribute('aria-pressed', on ? 'true' : 'false');
                } else {
                    row.insertBefore(star(id, on), row.firstElementChild);
                }

                // Grid mode only. `order` on something that is not a grid item
                // does nothing, which is the honest outcome in list mode.
                const box = cell(card);

                if (box) {
                    box.style.order = on ? '-1' : '';
                }
            }
        } catch {
            // Anything unexpected leaves Pelican's list exactly as it ships,
            // which is the failure mode this feature was allowed to have.
        }

        busy = false;
    }

    /* ------------------------------------------------------------- living */

    let queued = false;

    function soon() {
        if (queued) {
            return;
        }

        queued = true;

        requestAnimationFrame(() => {
            queued = false;
            decorate();
        });
    }

    function watch() {
        const list = document.querySelector('.fi-ta-content-grid, .fi-ta-ctn');

        if (!list) {
            return;
        }

        // wire:poll.15s replaces every card on a timer, taking the stars with
        // them. Coalesced to one pass per frame: a replaced card is many
        // mutations, and re-reading the list once afterwards answers all of them.
        new MutationObserver(soon).observe(list, { childList: true, subtree: true });
    }

    function start() {
        decorate();
        watch();
    }

    document.addEventListener('DOMContentLoaded', start);
    document.addEventListener('livewire:navigated', start);

    if (document.readyState !== 'loading') {
        start();
    }
})();
