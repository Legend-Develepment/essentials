/*
 * Finding one server among the ones already on screen.
 *
 * Not a replacement for Pelican's own search, which asks the server and can
 * reach every page. This is for the twelve servers already in front of you: it
 * hides the cards that do not match as you type, without a round trip, and says
 * how many are left.
 *
 * It therefore only ever sees this page, and the count says so rather than
 * pretending otherwise.
 *
 * Nothing here touches the server, and nothing is stored. Closing the page
 * forgets it.
 */

const TOOLBAR = '.fi-ld-servers';
const RECORD = '.fi-ta-record';

/** The list a toolbar belongs to: the nearest table content after it. */
function contentFor(toolbar) {
    const wrapper = toolbar.closest('.fi-ta') ?? toolbar.parentElement;

    return wrapper?.querySelector('.fi-ta-content') ?? null;
}

function records(toolbar) {
    const content = contentFor(toolbar);

    return content ? Array.from(content.querySelectorAll(`:scope > ${RECORD}`)) : [];
}

/*
 * A card's name is in its heading, but a server is also found by its address or
 * its description - so the whole card's text is searched. It is a dozen short
 * strings, read once per keystroke.
 */
function haystack(record) {
    return (record.textContent ?? '').toLowerCase();
}

function apply(toolbar) {
    const term = (toolbar.querySelector('.fi-ld-servers-input')?.value ?? '')
        .trim()
        .toLowerCase();

    const all = records(toolbar);
    let shown = 0;

    all.forEach((record) => {
        const matches = term === '' || haystack(record).includes(term);

        // hidden rather than display, so a card that comes back does not have to
        // be laid out from scratch.
        record.hidden = !matches;

        if (matches) {
            shown += 1;
        }
    });

    const count = toolbar.querySelector('.fi-ld-servers-count');

    if (count) {
        count.textContent = term === ''
            ? ''
            : count.dataset.template.replace('{shown}', shown).replace('{total}', all.length);
    }

    toolbar.classList.toggle('fi-ld-servers-filtering', term !== '');
}

function wire(toolbar) {
    if (toolbar.dataset.ldWired) {
        return;
    }

    toolbar.dataset.ldWired = '1';

    const input = toolbar.querySelector('.fi-ld-servers-input');
    const clear = toolbar.querySelector('.fi-ld-servers-clear');

    input?.addEventListener('input', () => apply(toolbar));

    input?.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && input.value !== '') {
            // Clear before the panel gets the key: on a page with a modal
            // behind it, Escape would otherwise close that instead.
            event.stopPropagation();
            input.value = '';
            apply(toolbar);
        }
    });

    clear?.addEventListener('click', () => {
        if (input) {
            input.value = '';
            input.focus();
        }

        apply(toolbar);
    });
}

/*
 * The cards are Livewire components that poll, and the table itself re-renders
 * on a tab or a page change - so a card can come back visible after being
 * hidden. Re-applying costs a text scan of what is on screen.
 */
function refresh() {
    document.querySelectorAll(TOOLBAR).forEach((toolbar) => {
        wire(toolbar);
        apply(toolbar);
    });
}

refresh();

document.addEventListener('livewire:navigated', refresh);

document.addEventListener('livewire:init', () => {
    if (typeof window.Livewire?.hook !== 'function') {
        return;
    }

    window.Livewire.hook('morphed', refresh);
});
