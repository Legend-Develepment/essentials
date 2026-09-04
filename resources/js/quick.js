/*
 * The top bar's switcher: which server, or which page, next.
 *
 * The markup comes from the panel (Support\Quick) and is in the first response.
 * This is what makes it open, search and star. Nothing is fetched until it is
 * opened, so a person who never touches it costs nothing on any page.
 *
 * Four things about how it is written, each learned somewhere else in this
 * plugin and repeated here on purpose:
 *
 *  1. Every listener is on the document, in the capture phase, and bound once
 *     for the life of the script. Filament navigates with wire:navigate, which
 *     replaces the body - so the button this drives is a *different* button
 *     after every navigation, and anything bound to the old one is gone. This
 *     is the same fix as the star on the server cards, which opened the server
 *     instead of starring it for exactly this reason.
 *  2. Server names go in through textContent, never innerHTML. They are typed
 *     by whoever made the server.
 *  3. The search asks the panel rather than filtering a list held here. An
 *     administrator can see thousands of servers; a list capped at some number
 *     with a filter over it looks like it works right up until the one you want
 *     is past the cap, and then it simply says nothing found.
 *  4. Anything unexpected leaves a button that opens an empty box. This sits in
 *     Pelican's own top bar, and a script that throws there would take the bar
 *     with it.
 */
(() => {
    const config = window.__ldQuick ?? {};

    /* Bound once. A second set of document listeners would open and close the
       box in the same click. */
    let listening = false;

    /* The open one, if any. Held rather than looked up, because the click that
       closes it may land anywhere on the page. */
    let box = null;

    /* What the panel last said. Kept between opens so re-opening is instant,
       and refreshed on every open so a server starred elsewhere shows up. */
    let favourites = null;
    let results = null;
    let more = false;
    let asking = false;
    let failed = false;

    /* Which row the arrow keys are on. An index into whatever is drawn, reset
       every time the list is redrawn under it. */
    let active = -1;

    let warned = false;

    /* ------------------------------------------------------------ the page */

    /*
     * Where we are, and what it is called.
     *
     * The name has to be read from the page because nothing on the panel can
     * work it out from the path: it would have to know every page every plugin
     * registers, in the reader's language, from a request that may be in a
     * different panel. The heading is what the person sees, which makes it the
     * right name for the thing they just starred.
     */
    function here() {
        const heading = document.querySelector('.fi-header-heading')
            ?? document.querySelector('main h1')
            ?? document.querySelector('h1');

        const label = (heading?.textContent ?? document.title ?? '').trim();

        return {
            path: window.location.pathname,
            label: label.slice(0, 80),
        };
    }

    /* Whether the page we are on is one of the starred ones. */
    function starredHere() {
        const path = window.location.pathname;

        return (favourites?.pages ?? []).some((page) => page.path === path);
    }

    /* ------------------------------------------------------------- asking */

    function ask(query) {
        if (!config.ask) {
            return;
        }

        asking = true;
        failed = false;
        draw();

        const url = config.ask + (query ? '?q=' + encodeURIComponent(query) : '');

        fetch(url, {
            headers: { Accept: 'application/json' },
            credentials: 'same-origin',
        })
            .then((response) => (response.ok
                ? response.json()
                : Promise.reject(new Error('The panel answered ' + response.status))))
            .then((body) => {
                results = Array.isArray(body.servers) ? body.servers : [];
                more = body.more === true;

                // Only the empty search carries them, so an answer without them
                // is a search result and must not wipe what is already known.
                if (body.favourites) {
                    favourites = body.favourites;
                }
            })
            .catch((error) => {
                failed = true;
                results = [];
                console.warn('[essentials] the switcher could not reach the panel.', error);
            })
            .finally(() => {
                asking = false;
                draw();
                // The list is a different height now, and on a short screen
                // that decides whether the footer is still on it.
                place();
            });
    }

    /*
     * Saving a starred page.
     *
     * The list goes over entire, the same way the stars on the server cards
     * send theirs: there is no merge to get wrong, and whatever comes back is
     * what gets drawn. Servers are left out of the request deliberately - the
     * endpoint treats a missing key as untouched, which is what keeps two
     * features writing to one file from clearing each other.
     */
    function save(pages) {
        if (!config.save) {
            return;
        }

        const before = favourites?.pages ?? [];

        favourites = { servers: favourites?.servers ?? [], pages };
        draw();

        fetch(config.save, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': config.token ?? '',
                Accept: 'application/json',
            },
            credentials: 'same-origin',
            body: JSON.stringify({ pages }),
        })
            .then((response) => (response.ok
                ? response.json()
                : Promise.reject(new Error('The panel answered ' + response.status))))
            .then((body) => {
                if (body && Array.isArray(body.pages)) {
                    favourites = { servers: favourites?.servers ?? [], pages: body.pages };
                    draw();
                }
            })
            .catch((error) => {
                // Back to what the panel last had. A star left lit over a write
                // that did not happen is the failure people only discover on
                // the next reload, which is the worst moment to discover it.
                favourites = { servers: favourites?.servers ?? [], pages: before };
                draw();

                console.warn('[essentials] a starred page could not be saved.', error);

                if (!warned) {
                    warned = true;
                    window.alert(config.failed ?? 'That could not be saved.');
                }
            });
    }

    function toggleHere() {
        const page = here();

        if (page.label === '') {
            return;
        }

        const pages = (favourites?.pages ?? []).filter((one) => one.path !== page.path);

        // Newest first: the thing just starred is the thing most likely wanted
        // again, and a list that grows downwards buries it.
        save(starredHere() ? pages : [page, ...pages]);
    }

    /* ------------------------------------------------------------ drawing */

    function row(text, href, kind) {
        const item = document.createElement('a');

        item.className = 'ld-quick__row ld-quick__row--' + kind;
        item.href = href;
        item.setAttribute('role', 'option');
        item.textContent = text;

        return item;
    }

    function heading(text) {
        const item = document.createElement('p');

        item.className = 'ld-quick__head';
        item.textContent = text;

        return item;
    }

    function note(text) {
        const item = document.createElement('p');

        item.className = 'ld-quick__note';
        item.textContent = text;

        return item;
    }

    function draw() {
        if (box === null) {
            return;
        }

        const list = box.querySelector('.ld-quick__list');
        const field = box.querySelector('.ld-quick__input');
        const star = box.querySelector('.ld-quick__star');

        if (star) {
            const on = starredHere();

            star.textContent = on
                ? (config.unstarPage ?? 'Unstar this page')
                : (config.starPage ?? 'Star this page');
            star.setAttribute('aria-pressed', on ? 'true' : 'false');
            star.classList.toggle('ld-quick__star--on', on);
        }

        if (!list) {
            return;
        }

        const query = (field?.value ?? '').trim();

        list.textContent = '';
        active = -1;

        if (failed) {
            list.append(note(config.failed ?? 'The panel could not be reached.'));

            return;
        }

        const origin = window.location.origin;
        const servers = config.serverBase ?? (origin + '/server');

        /*
         * Starred things first, and only when nothing has been typed.
         *
         * Once there is a search on, the list is the answer to that search:
         * keeping the favourites pinned above it would mean the top of the list
         * did not change as the letters went in, which reads as the search not
         * working.
         */
        if (query === '' && favourites) {
            const starred = favourites.servers ?? [];
            const pages = favourites.pages ?? [];

            if (starred.length > 0 || pages.length > 0) {
                list.append(heading(config.favourites ?? 'Favourites'));

                for (const server of starred) {
                    list.append(row(server.name, servers + '/' + server.id, 'server'));
                }

                for (const page of pages) {
                    list.append(row(page.label, origin + page.path, 'page'));
                }
            }
        }

        if (asking && results === null) {
            list.append(note(config.loading ?? 'Loading…'));

            return;
        }

        const found = results ?? [];

        if (found.length > 0) {
            list.append(heading(config.servers ?? 'Servers'));

            for (const server of found) {
                list.append(row(server.name, servers + '/' + server.id, 'server'));
            }

            if (more) {
                list.append(note(config.more ?? 'More matches than fit — keep typing.'));
            }
        } else if (query !== '' && !asking) {
            list.append(note(config.empty ?? 'Nothing found.'));
        }

        if (list.childElementCount === 0) {
            list.append(note(config.empty ?? 'Nothing found.'));
        }
    }

    /* ---------------------------------------------------------- the arrows */

    function rows() {
        return box === null ? [] : [...box.querySelectorAll('.ld-quick__row')];
    }

    function move(by) {
        const all = rows();

        if (all.length === 0) {
            return;
        }

        active = active === -1
            ? (by > 0 ? 0 : all.length - 1)
            : (active + by + all.length) % all.length;

        all.forEach((item, at) => {
            item.classList.toggle('ld-quick__row--on', at === active);

            if (at === active) {
                item.scrollIntoView({ block: 'nearest' });
            }
        });
    }

    /* ------------------------------------------------------- opening, shut */

    /*
     * Put the box where it fits, measured rather than assumed.
     *
     * Right-aligned under its button while there is room for that, and pinned
     * to the window's edges when there is not - which on a phone is always. The
     * list is then capped to whatever is left below the button, so the footer
     * with the star and the way to the full page stays on screen instead of
     * being pushed off the bottom.
     *
     * Called on open, and again on resize and on scroll while open: a fixed box
     * does not travel with its button, and an address bar sliding away on a
     * phone is a resize.
     */
    function place() {
        if (box === null) {
            return;
        }

        const pop = box.querySelector('.ld-quick__pop');
        const button = box.querySelector('.ld-quick__btn');

        if (!pop || !button) {
            return;
        }

        const edge = 12;
        const rect = button.getBoundingClientRect();
        const width = Math.min(pop.offsetWidth || 352, window.innerWidth - edge * 2);

        // Right-aligned to the button, then pushed back inside the window if
        // that would start it off the left edge.
        let left = rect.right - width;

        if (left < edge) {
            left = edge;
        }

        if (left + width > window.innerWidth - edge) {
            left = Math.max(edge, window.innerWidth - edge - width);
        }

        const top = rect.bottom + 8;

        pop.style.left = left + 'px';
        pop.style.right = 'auto';
        pop.style.top = top + 'px';
        pop.style.width = width + 'px';

        const list = pop.querySelector('.ld-quick__list');

        if (list) {
            // What is left below the button, minus the search field, the footer
            // and a margin off the bottom of the screen.
            const room = window.innerHeight - top - 140;

            list.style.maxHeight = Math.max(120, room) + 'px';
        }
    }

    function open(container) {
        const pop = container.querySelector('.ld-quick__pop');
        const button = container.querySelector('.ld-quick__btn');

        if (!pop) {
            return;
        }

        close();

        box = container;
        pop.hidden = false;
        button?.setAttribute('aria-expanded', 'true');

        const field = container.querySelector('.ld-quick__input');

        if (field) {
            field.value = '';
        }

        // Every open, not only the first. Something starred on another page in
        // another tab should be here when this is opened, and the alternative -
        // a list that is only right the first time - is the kind of wrong that
        // looks like the feature losing things.
        results = null;
        more = false;
        ask('');

        draw();

        // After the box is shown and after it is drawn: an element that is
        // still hidden has no size to measure, and a list that has not been
        // filled in yet is not the height it will be.
        place();

        /*
         * Focused, except under a finger.
         *
         * Focusing a text field on a phone opens the keyboard, which takes half
         * the screen and covers the list somebody has just asked to see. On a
         * pointer it is exactly what is wanted - the whole control is a search
         * box - so the two are told apart rather than one being chosen for
         * both.
         */
        if (!window.matchMedia('(pointer: coarse)').matches) {
            field?.focus();
        }
    }

    function close() {
        if (box === null) {
            return;
        }

        // The measured placement goes with it, so the next open starts from the
        // stylesheet rather than from where it happened to be last time.
        const pop = box.querySelector('.ld-quick__pop');

        if (pop) {
            pop.style.left = '';
            pop.style.right = '';
            pop.style.top = '';
            pop.style.width = '';

            const list = pop.querySelector('.ld-quick__list');

            if (list) {
                list.style.maxHeight = '';
            }
        }

        box.querySelector('.ld-quick__pop')?.setAttribute('hidden', '');
        box.querySelector('.ld-quick__btn')?.setAttribute('aria-expanded', 'false');

        box = null;
        active = -1;
    }

    /* ------------------------------------------------------------ bindings */

    let timer = null;

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

            const button = target.closest('.ld-quick__btn');

            if (button) {
                event.preventDefault();
                event.stopPropagation();

                const container = button.closest('[data-ld-quick]');

                if (container === null) {
                    return;
                }

                box === container ? close() : open(container);

                return;
            }

            if (target.closest('.ld-quick__star')) {
                event.preventDefault();
                event.stopPropagation();

                toggleHere();

                return;
            }

            // A click on a row is a link and is left alone - it should navigate
            // exactly as a link does, including with a modifier held.
            if (target.closest('.ld-quick__pop')) {
                if (target.closest('.ld-quick__row')) {
                    close();
                }

                return;
            }

            // Anywhere else on the page shuts it.
            close();
        }, true);

        /*
         * A fixed box does not move with its button.
         *
         * So anything that moves the button has to move the box: turning a
         * phone, a keyboard opening, an address bar sliding away - all of which
         * arrive as a resize - and scrolling the page under a top bar that is
         * not sticky.
         */
        window.addEventListener('resize', place);
        window.addEventListener('scroll', place, true);

        document.addEventListener('input', (event) => {
            const target = event.target instanceof Element ? event.target : null;

            if (target === null || !target.classList.contains('ld-quick__input')) {
                return;
            }

            const query = target.value.trim();

            // Debounced, because this is a request per keystroke otherwise and
            // the answers would arrive out of order as often as not.
            window.clearTimeout(timer);
            timer = window.setTimeout(() => ask(query), 200);
        }, true);

        document.addEventListener('keydown', (event) => {
            if (box === null) {
                return;
            }

            if (event.key === 'Escape') {
                event.preventDefault();

                const button = box.querySelector('.ld-quick__btn');

                close();
                // Focus goes back where it came from, or it lands on the body
                // and the next Tab starts from the top of the page.
                button?.focus();

                return;
            }

            if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                event.preventDefault();
                move(event.key === 'ArrowDown' ? 1 : -1);

                return;
            }

            if (event.key === 'Enter') {
                const all = rows();

                if (active >= 0 && all[active]) {
                    event.preventDefault();
                    all[active].click();
                }
            }
        }, true);
    }

    function start() {
        try {
            listen();

            // A navigation replaced the page under an open box; the element it
            // pointed at is no longer in the document.
            if (box !== null && !document.contains(box)) {
                box = null;
            }
        } catch {
            // A top bar that draws is worth more than a switcher that works.
        }
    }

    document.addEventListener('DOMContentLoaded', start);
    document.addEventListener('livewire:navigated', start);

    if (document.readyState !== 'loading') {
        start();
    }
})();
