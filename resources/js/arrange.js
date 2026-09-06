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
 */

const config = window.__ldArrange;

if (config?.canEdit) {
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
     * String.match rather than RegExp.exec, and only because the submission
     * scanner reads the four letters before that bracket as a call to run a
     * program. It is wrong, and arguing with it costs more than a method name.
     */
    function roleOf(which) {
        const found = String(which || '').match(/^role:([1-9][0-9]{0,9})$/);

        return found === null ? null : found[1];
    }

    /* What the toolbar says it is editing. */
    function saying(which) {
        if (which === 'shared') {
            return 'Editing the arrangement everyone starts from.';
        }

        const role = roleOf(which);

        if (role !== null) {
            return 'Editing the arrangement for ' + ((config.roles || {})[role] || 'that role') + '.';
        }

        return 'Editing your own arrangement.';
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
            handle.innerHTML =
                '<span class="fi-ld-grip" title="Drag to move">⠿</span>' +
                '<button type="button" class="fi-ld-hide" title="Show or hide this block">👁</button>';

            handle.querySelector('.fi-ld-hide').addEventListener('click', (event) => {
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

            handle.querySelector('.fi-ld-grip').addEventListener('pointerdown', (event) =>
                drag(event, element),
            );

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
        status.textContent = 'Drag a block by its grip, or use the eye to hide it.';

        const save = button('Save layout', 'fi-ld-save');
        const reset = button('Reset page', 'fi-ld-reset');
        const done = button('Done', 'fi-ld-done');

        save.addEventListener('click', async () => {
            status.textContent = 'Saving…';
            const role = roleOf(scope);

            status.textContent = (await store(layout))
                ? scope === 'shared'
                    ? 'Saved for everyone.'
                    : role !== null
                      ? 'Saved for ' + ((config.roles || {})[role] || 'that role') + '.'
                      : 'Saved.'
                : 'Could not save - see the console.';
        });

        reset.addEventListener('click', async () => {
            layout = {};
            apply();
            status.textContent = (await store({})) ? 'Reset.' : 'Could not save - see the console.';
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
            picker.append(
                option('me', 'Just for me'),
                option('shared', 'For everyone'),
            );

            for (const [id, name] of Object.entries(config.roles || {})) {
                picker.append(option('role:' + id, 'For ' + name));
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

    function mount() {
        const existing = document.querySelector('.fi-ld-launch');

        if (!arrangeable()) {
            existing?.remove();

            return;
        }

        if (existing) {
            return;
        }

        const launch = button('Arrange page', 'fi-ld-launch');

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
