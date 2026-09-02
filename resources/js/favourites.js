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
 *  3. The star must not be given a click handler of its own. It was, and that
 *     is what made it open the server instead: the handler was right, and the
 *     node it hung on is replaced every fifteen seconds by wire:poll, so after
 *     the first refresh the button was still there and its listener was not.
 *     Clicks fell through to the card. One capture-phase listener on the
 *     document now answers for every star, and outruns the card's own.
 *  4. Sorting only works in grid mode. Pelican calls contentGrid() with two
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
    const TAB_ON = 'ld-fav-tab--on';

    const config = window.__ldFav ?? {};

    /* Bound once, for the life of the page. Livewire navigations re-run start()
       without reloading this script, and a second document listener would
       toggle every star twice. */
    let listening = false;

    /* Showing starred only. Deliberately not stored: a filter that survived a
       reload invisibly would look like servers had gone missing. */
    let only = false;

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

    /* ---------------------------------------------------------------- tab */

    /*
     * A fourth pill beside My Servers / Others' Servers / All Servers.
     *
     * It cannot come from the server. Pelican builds those three in
     * ListServers::getTabs(), each with a query, and a starred list exists only
     * in the browser - there is no column to filter on and, by design, never
     * will be. So the pill is put into the bar here and filters what is already
     * on the page.
     *
     * Cloned from one of Pelican's own rather than built from scratch. Filament
     * decides what a tab and its badge look like, and a hand-written copy would
     * be a second opinion that drifts the first time either changes. Clone,
     * strip what makes it navigate, relabel.
     */
    function bar() {
        return document.querySelector('.fi-tabs');
    }

    function pill(container) {
        const existing = container.querySelector(':scope > .ld-fav-tab');

        if (existing) {
            return existing;
        }

        const model = [...container.querySelectorAll(':scope > .fi-tabs-item')]
            .filter((item) => !item.classList.contains('ld-fav-tab'))
            .pop();

        if (!model) {
            return null;
        }

        const tab = model.cloneNode(true);

        /*
         * Everything that would make it navigate, talk to Livewire, or claim to
         * be something it is not. What is left is a pill that looks right and
         * does nothing until we say so.
         *
         * `id` and `aria-current` are in the list for a reason found by testing
         * rather than by reading: the model cloned is the last tab, which is
         * often the selected one, so the copy arrived announcing itself as the
         * current page and carrying a duplicate of an id already in the
         * document.
         */
        for (const attribute of [...tab.attributes]) {
            if (/^(href|wire:|x-on:|@|x-data|x-bind|id$|aria-current$)/.test(attribute.name)) {
                tab.removeAttribute(attribute.name);
            }
        }

        tab.classList.add('ld-fav-tab');
        tab.classList.remove('fi-active');
        tab.setAttribute('wire:key', 'ld-fav-tab');

        /*
         * Removing href from the anchor Filament renders takes it out of the
         * tab order with it, so both have to be put back by hand. It is a
         * toggle rather than a link now, and says so: pressed rather than
         * current, and reachable by keyboard like the three beside it.
         */
        tab.setAttribute('role', 'button');
        tab.setAttribute('tabindex', '0');

        container.append(tab);

        return tab;
    }

    /* The label and the number, written into whatever elements the clone
       brought with it. If Filament renames either, the pill keeps its shape and
       loses its text rather than breaking the bar. */
    function label(tab, count) {
        const text = tab.querySelector('.fi-tabs-item-label');

        if (text) {
            text.textContent = config.tab ?? 'Favourites';
        }

        const badge = tab.querySelector('.fi-badge');

        if (badge) {
            const slot = [...badge.childNodes].find((node) => node.nodeType === 3 && node.textContent.trim() !== '');

            if (slot) {
                slot.textContent = String(count);
            } else {
                badge.textContent = String(count);
            }
        }
    }

    /*
     * What to say when the filter leaves nothing.
     *
     * An empty page with a lit pill above it reads as servers having gone
     * missing. It also has to admit what it cannot see: the filter works on the
     * cards that are on this page, so a starred server further down a paginated
     * list is not hidden by it - it was never here.
     */
    function note(show) {
        /*
         * Two queries rather than one selector list, because querySelector
         * returns the first match in document order and not in the order the
         * selectors were written. The outer container encloses the grid, so a
         * combined selector always answered with the outer one and put this
         * message beside the list instead of in it.
         */
        const list = document.querySelector('.fi-ta-content-grid')
            ?? document.querySelector('.fi-ta-ctn');
        const existing = list?.querySelector(':scope > .ld-fav-empty') ?? null;

        if (!show || !list) {
            existing?.remove();

            return;
        }

        if (existing) {
            return;
        }

        const message = document.createElement('p');

        message.className = 'ld-fav-empty';
        message.setAttribute('wire:key', 'ld-fav-empty');
        message.textContent = config.empty ?? 'No starred servers on this page.';

        list.append(message);
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

        /*
         * Keyed, and not decoration.
         *
         * Livewire's morph matches children by position when they have no key,
         * and this button is put at the front of a row whose first element in
         * the server's own HTML is Filament's condition icon - another button.
         * Unkeyed, the morph considered the two the same node and patched the
         * icon's markup straight into the star. A key it cannot find in the new
         * HTML makes it discard this instead, which is the outcome wanted: the
         * next pass puts a fresh one back.
         */
        button.setAttribute('wire:key', 'ld-fav-' + id);

        // No click handler here on purpose. See listen() at the bottom.

        return button;
    }

    function decorate() {
        if (busy) {
            return;
        }

        busy = true;

        try {
            const starred = read();
            const container = bar();

            if (container) {
                const tab = pill(container);

                if (tab) {
                    label(tab, starred.length);

                    /*
                     * Its own class rather than Filament's fi-active, because
                     * this is not a fourth tab.
                     *
                     * It filters whatever the chosen tab produced - starred
                     * servers among your own, or among all of them - so the tab
                     * you are on stays the tab you are on and stays lit. An
                     * earlier version took fi-active off Pelican's three while
                     * this was on, which meant restoring it afterwards, and
                     * restoring state a Livewire morph also writes is a fight
                     * with no end. Nothing of Pelican's is touched now.
                     */
                    tab.classList.toggle(TAB_ON, only);
                    tab.setAttribute('aria-pressed', only ? 'true' : 'false');
                }
            }

            let shown = 0;

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

                // The filter. Hidden on the element the grid lays out where
                // there is one, so a hidden card leaves no gap behind it.
                const hide = only && !on;

                (box ?? card).style.display = hide ? 'none' : '';

                if (!hide) {
                    shown += 1;
                }
            }

            note(shown === 0 && only);
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

    /* ------------------------------------------------------------ clicking */

    /*
     * One listener, on the document, in the capture phase. Not one per star.
     *
     * This is the fix for a star that opened the server instead of starring it.
     * The old handler was correct - preventDefault, stopPropagation - and it
     * was attached to a node Livewire replaces every fifteen seconds under
     * wire:poll. After the first morph the button was still on the page and its
     * handler was not, so the click sailed past it and reached the card's own
     * x-on:click. It worked, then quietly stopped working, which is why it read
     * as the star doing the wrong thing rather than as nothing being bound.
     *
     * Capture settles it for good. The card's listener is a bubble listener on
     * the card; a capture listener on the document runs before the event has
     * even reached it, so stopping it here means the card never hears the
     * click. And nothing is bound to an injected node at all, so there is
     * nothing left for a morph to take away.
     */
    function listen() {
        if (listening) {
            return;
        }

        listening = true;

        document.addEventListener('click', (event) => {
            const target = event.target instanceof Element ? event.target : null;

            if (target === null) {
                return;
            }

            // Our pill is a .fi-tabs-item too, so it has to be asked about
            // before the rule underneath sends every tab click to Pelican.
            if (target.closest('.ld-fav-tab')) {
                // Reached by mouse, and by keyboard through keys() below.
                event.preventDefault();
                event.stopPropagation();

                only = !only;
                decorate();

                return;
            }

            const button = target.closest('.' + MARK);

            if (button === null) {
                // Leaving the filter is any click on one of Pelican's own tabs:
                // asking for "my servers" is asking to stop looking at a subset
                // of them. Not stopped or prevented - Pelican's tab must do
                // exactly what it always did.
                // Pelican's own tabs are left entirely alone. The filter sits
                // on top of whichever one is chosen and survives changing it,
                // which is why the pill shows its state rather than relying on
                // anyone remembering it.
                return;
            }

            // The whole card navigates on click. A star that opened the server
            // would be a star nobody could use.
            event.preventDefault();
            event.stopPropagation();

            const id = button.dataset.ldFav;

            if (!id) {
                return;
            }

            const ids = read();
            const at = ids.indexOf(id);

            at === -1 ? ids.push(id) : ids.splice(at, 1);

            write(ids);
            decorate();
        }, true);

        /*
         * Enter and Space on the pill.
         *
         * The browser does this for free on a <button> and on an <a href>, and
         * the pill is neither: it is Filament's anchor with the href taken off,
         * which is what stops it navigating. role="button" tells a screen
         * reader what it is; it does not make the keys work. The star needs
         * none of this - it is a real button.
         *
         * Space is prevented because its default on a focused element is to
         * scroll the page, and a pill that filtered the list and jumped it down
         * a screen would be its own small bug.
         */
        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Enter' && event.key !== ' ' && event.key !== 'Spacebar') {
                return;
            }

            const target = event.target instanceof Element ? event.target : null;

            if (target === null || !target.closest('.ld-fav-tab')) {
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            only = !only;
            decorate();
        }, true);
    }

    function start() {
        listen();
        decorate();
        watch();
    }

    document.addEventListener('DOMContentLoaded', start);
    document.addEventListener('livewire:navigated', start);

    if (document.readyState !== 'loading') {
        start();
    }
})();
