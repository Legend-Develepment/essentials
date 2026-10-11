/*
 * The page arranger.
 *
 * Only the editing happens here. The saved arrangement itself is applied by CSS
 * that the server emits, so a visitor never runs any of this and never sees the
 * blocks jump into place.
 *
 * Dragging reassigns the `order` of the grid items directly, which is why the
 * page rearranges under the cursor as you drag: what you see during the drag is
 * exactly what gets saved.
 *
 * **Not one word on screen is written in this file.** Every one of them arrives
 * in config.words, translated by PHP into the reader's own language, because a
 * panel that answers in thirty-two languages everywhere else and in English
 * inside its arranger is a panel that answers in English. The language is the
 * reason the script refuses to start without them: a toolbar of blank buttons
 * would be a worse way to find that out than no toolbar at all.
 */

const config = window.__ldArrange;

if (config?.canEdit && config.words) {
    start(config);
}

function start(config) {
    let arranging = false;

    /*
     * Which arrangement is being edited: your own, or the one everybody starts
     * from. Your own by default even for somebody who may set both - changing
     * what every other person sees should be the thing you ask for, not the
     * thing you get for not noticing.
     */
    let scope = 'me';
    let layout = source(scope);
    let toolbar = null;

    /*
     * One word, in the reader's language, with :name style placeholders filled
     * in - the same shape Laravel's own replacements take, so a translator
     * moving one to the other end of a sentence needs to know nothing about
     * this file.
     *
     * The key itself when there is no such word. It cannot happen while PHP
     * hands the whole table over, and if it ever does then the key names the
     * string that went missing, which is the thing somebody needs to know.
     */
    function said(key, replace = {}) {
        let text = config.words[key] ?? key;

        for (const [name, value] of Object.entries(replace)) {
            text = text.split(':' + name).join(value);
        }

        return text;
    }

    /*
     * Editing your own starts from what is actually on the screen - the shared
     * arrangement, your roles' and yours already over it - because that is what
     * you are rearranging. Editing one of the others starts from that one
     * alone, so what is on screen is what saving would write.
     */
    function source(which) {
        if (which === 'shared') {
            return { ...(config.shared || {}) };
        }

        const role = roleOf(which);

        if (role !== null) {
            return { ...((config.roleLayouts || {})[role] || {}) };
        }

        return { ...(config.merged || {}) };
    }

    /*
     * The role id in a scope, or null. Mirrors Layouts::roleOf().
     *
     * One match, and its first group is the id.
     */
    function roleOf(which) {
        const found = String(which || '').match(/^role:([1-9][0-9]{0,9})$/);

        return found === null ? null : found[1];
    }

    /* The name of a role, or a stand-in for one the picker no longer knows. */
    function roleName(role) {
        return (config.roles || {})[role] || said('that_role');
    }

    /* What the toolbar says it is editing. */
    function saying(which) {
        if (which === 'shared') {
            return said('editing_shared');
        }

        const role = roleOf(which);

        if (role !== null) {
            return said('editing_role', { role: roleName(role) });
        }

        return said('editing_own');
    }

    /* ------------------------------------------------------------- items - */

    function keyOf(element) {
        const partial = element.getAttribute('wire:partial');

        if (partial?.startsWith('schema-component::')) {
            return 'partial|' + partial.slice('schema-component::'.length);
        }

        const key = element.getAttribute('wire:key');

        // A Livewire key is "<componentId>.<path>", and the id changes every
        // request - so only the path is kept. Anything without a path of its own
        // (".container" and friends) cannot be addressed later, so it is left
        // out rather than saved under a name that will not match.
        if (key && key.split('.').length >= 3) {
            return 'key|' + key.slice(key.indexOf('.') + 1);
        }

        return null;
    }

    function items() {
        return [...document.querySelectorAll('.fi-page .fi-grid > .fi-grid-col')].filter(
            (element) => keyOf(element) !== null,
        );
    }

    function siblings(element) {
        return [...element.parentElement.children]
            .filter((child) => child.classList.contains('fi-grid-col') && keyOf(child) !== null)
            .sort((a, b) => (Number(a.style.order) || 0) - (Number(b.style.order) || 0));
    }

    /* ------------------------------------------------------------ layout - */

    function apply() {
        for (const element of items()) {
            const entry = layout[keyOf(element)];

            element.style.order = entry?.o ?? '';
            element.classList.toggle('fi-ld-hidden-block', Boolean(entry?.h));
        }
    }

    function record(list) {
        list.forEach((element, index) => {
            const key = keyOf(element);

            element.style.order = index + 1;
            layout[key] = { ...(layout[key] || {}), o: index + 1 };
        });
    }

    /* ------------------------------------------------------------ handles - */

    function decorate() {
        for (const element of items()) {
            if (element.querySelector(':scope > .fi-ld-handle')) {
                continue;
            }

            const handle = document.createElement('div');
            handle.className = 'fi-ld-handle';

            /*
             * Built rather than written as one string of markup, because two of
             * the four values in it are now words from a catalogue. A title
             * somebody translated is text, and text goes in through an attribute
             * rather than through innerHTML.
             */
            const grip = document.createElement('span');
            grip.className = 'fi-ld-grip';
            grip.title = said('drag_to_move');
            grip.textContent = '⠿';

            const hide = document.createElement('button');
            hide.type = 'button';
            hide.className = 'fi-ld-hide';
            hide.title = said('show_or_hide');
            hide.textContent = '👁';

            hide.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();

                const key = keyOf(element);
                const hidden = !layout[key]?.h;

                layout[key] = { ...(layout[key] || {}), h: hidden };

                if (!hidden) {
                    delete layout[key].h;
                }

                element.classList.toggle('fi-ld-hidden-block', hidden);
            });

            grip.addEventListener('pointerdown', (event) => drag(event, element));

            handle.append(grip, hide);
            element.appendChild(handle);
        }
    }

    function undecorate() {
        for (const handle of document.querySelectorAll('.fi-ld-handle')) {
            handle.remove();
        }
    }

    /* --------------------------------------------------------------- drag - */

    function drag(event, element) {
        event.preventDefault();

        const list = siblings(element);

        record(list);

        element.classList.add('fi-ld-dragging');
        document.documentElement.classList.add('fi-ld-dragging-now');

        const move = (moveEvent) => {
            const current = siblings(element);
            const from = current.indexOf(element);

            let to = from;

            current.forEach((other, index) => {
                if (other === element) {
                    return;
                }

                const box = other.getBoundingClientRect();
                const overIt =
                    moveEvent.clientY > box.top &&
                    moveEvent.clientY < box.bottom &&
                    moveEvent.clientX > box.left &&
                    moveEvent.clientX < box.right;

                if (overIt) {
                    to = index;
                }
            });

            if (to !== from) {
                current.splice(to, 0, ...current.splice(from, 1));
                record(current);
            }
        };

        const stop = () => {
            element.classList.remove('fi-ld-dragging');
            document.documentElement.classList.remove('fi-ld-dragging-now');
            window.removeEventListener('pointermove', move);
            window.removeEventListener('pointerup', stop);
            window.removeEventListener('pointercancel', stop);
        };

        window.addEventListener('pointermove', move);
        window.addEventListener('pointerup', stop);
        window.addEventListener('pointercancel', stop);
    }

    /* ------------------------------------------------------------ toolbar - */

    function button(label, className) {
        const element = document.createElement('button');

        element.type = 'button';
        element.className = 'fi-ld-btn ' + className;
        element.textContent = label;

        return element;
    }

    /*
     * textContent rather than innerHTML, and that is not a formality here: the
     * label of a role option is a name somebody typed on the roles page.
     */
    function option(value, label) {
        const element = document.createElement('option');

        element.value = value;
        element.textContent = label;

        return element;
    }

    function buildToolbar() {
        toolbar = document.createElement('div');
        toolbar.className = 'fi-ld-toolbar';

        const status = document.createElement('span');
        status.className = 'fi-ld-status';
        status.textContent = said('hint');

        const save = button(said('save_layout'), 'fi-ld-save');
        const reset = button(said('reset_page'), 'fi-ld-reset');
        const done = button(said('done'), 'fi-ld-done');

        save.addEventListener('click', async () => {
            status.textContent = said('saving');
            const role = roleOf(scope);

            status.textContent = (await store(layout))
                ? scope === 'shared'
                    ? said('saved_everyone')
                    : role !== null
                      ? said('saved_role', { role: roleName(role) })
                      : said('saved_own')
                : said('save_failed');
        });

        reset.addEventListener('click', async () => {
            layout = {};
            apply();
            status.textContent = (await store({})) ? said('reset_done') : said('save_failed');
        });

        done.addEventListener('click', () => toggle(false));

        toolbar.append(status);

        /*
         * The scope picker, and only for somebody who may set both. With one
         * scope available there is nothing to choose, and a control with one
         * option is a control that only makes the toolbar longer.
         */
        if (config.canShare) {
            const picker = document.createElement('select');

            picker.className = 'fi-ld-scope';

            /*
             * One flat list rather than a scope picker and a role picker beside
             * it. There is one question here - who is this arrangement for -
             * and two controls to answer it would be one control too many.
             *
             * The role names come from the server, so they go in as text
             * rather than as markup: a role called <b>Staff</b> is a role
             * somebody named, not markup this file should run.
             */
            picker.append(option('me', said('scope_me')), option('shared', said('scope_shared')));

            for (const [id, name] of Object.entries(config.roles || {})) {
                picker.append(option('role:' + id, said('scope_role', { role: name })));
            }

            picker.addEventListener('change', () => {
                scope = picker.value;
                // Reload from the scope now being edited, so what is on screen
                // is what saving would write rather than what another one held.
                layout = source(scope);
                apply();
                status.textContent = saying(scope);
            });

            toolbar.append(picker);
        }

        toolbar.append(reset, save, done);
        document.body.appendChild(toolbar);
    }

    async function store(items) {
        try {
            const response = await fetch(config.url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN':
                        document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ page: config.page, scope, items }),
            });

            if (!response.ok) {
                console.error('[legend-theme] saving the layout failed', response.status);
            }

            return response.ok;
        } catch (error) {
            console.error('[legend-theme] saving the layout failed', error);

            return false;
        }
    }

    /* -------------------------------------------------------------- mode - */

    function toggle(on) {
        arranging = on ?? !arranging;

        document.documentElement.classList.toggle('fi-ld-arranging', arranging);

        if (arranging) {
            decorate();
            buildToolbar();
        } else {
            undecorate();
            toolbar?.remove();
            toolbar = null;
            apply();
        }
    }

    /*
     * Whether this page has anything that can be moved.
     *
     * The arranger works by setting `order` on Filament's grid cells, so a page
     * not built from that grid has nothing for it to do - the console and the
     * file manager are the two that matter. The button used to appear on those
     * anyway and opened an editor with nothing in it, which reads as the
     * feature being broken rather than as not applying here.
     *
     * Blocks hidden by an earlier arrangement still count. They are in the
     * document with a key, just not drawn, and a page where everything was
     * hidden is exactly the page somebody needs the arranger on.
     */
    function arrangeable() {
        return items().length > 0;
    }

    /*
     * Whether the panel still offers this, asked of the page rather than of the
     * variable.
     *
     * The settings are read once, when this file loads, and a panel navigates
     * without reloading - so that copy outlives the page it came from and every
     * page after it. Switching the arranger off stops the server sending the
     * settings and does nothing at all about the copy already in memory: the
     * button came back on every page for the rest of the session, on a panel
     * where the feature was off and the server was sending nothing.
     *
     * The element is what the server stops sending, so the element is what to
     * ask. A page that does not carry it is a page where this is not offered.
     */
    function offered() {
        return document.getElementById('ld-arrange') !== null;
    }

    function mount() {
        const existing = document.querySelector('.fi-ld-launch');

        if (!offered()) {
            existing?.remove();

            // And put the page back, in case the editor was open when the
            // switch went off underneath it.
            if (arranging) {
                toggle(false);
            }

            return;
        }

        if (!arrangeable()) {
            existing?.remove();

            return;
        }

        if (existing) {
            return;
        }

        const launch = button(said('launch'), 'fi-ld-launch');

        launch.addEventListener('click', () => toggle(true));
        document.body.appendChild(launch);
    }

    mount();

    // Filament navigates without reloading, so the button has to be looked at
    // again and arrange mode has to close - the new page has different blocks.
    document.addEventListener('livewire:navigated', () => {
        if (arranging) {
            toggle(false);
        }

        /*
         * Looked at more than once, because the blocks arrive after the event.
         * A single check right on navigation reads an empty page and takes the
         * button away from one that was about to have plenty.
         *
         * Three fixed moments rather than watching the document: the console
         * streams output continuously, and a MutationObserver over the body
         * there would run this on every line that arrives, for ever, to answer
         * a question that settles in half a second.
         */
        mount();
        setTimeout(mount, 150);
        setTimeout(mount, 600);
    });
}
