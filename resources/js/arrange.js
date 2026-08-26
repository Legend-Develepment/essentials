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
    let layout = { ...(config.layout || {}) };
    let toolbar = null;

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
            status.textContent = (await store(layout)) ? 'Saved.' : 'Could not save - see the console.';
        });

        reset.addEventListener('click', async () => {
            layout = {};
            apply();
            status.textContent = (await store({})) ? 'Reset.' : 'Could not save - see the console.';
        });

        done.addEventListener('click', () => toggle(false));

        toolbar.append(status, reset, save, done);
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
                body: JSON.stringify({ page: config.page, items }),
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

    function mount() {
        if (document.querySelector('.fi-ld-launch')) {
            return;
        }

        const launch = button('Arrange page', 'fi-ld-launch');

        launch.addEventListener('click', () => toggle(true));
        document.body.appendChild(launch);
    }

    mount();

    // Filament navigates without reloading, so the button has to come back and
    // arrange mode has to close - the new page has different blocks.
    document.addEventListener('livewire:navigated', () => {
        if (arranging) {
            toggle(false);
        }

        mount();
    });
}
