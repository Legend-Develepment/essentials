/*
 * Narrows a settings page to the sections holding what you type.
 *
 * There are seventy-odd settings across four pages and nine folded sections,
 * and until now the only way to find one was to remember which page it was on.
 *
 * Everything here happens in the browser. The text is already in the document -
 * a folded section is hidden, not absent - so matching is a string comparison
 * over what is on the page, and searching writes nothing, asks the server for
 * nothing, and cannot cost a setting when it goes wrong.
 */
(() => {
    const BOX = '[data-ld-search]';
    const INPUT = '[data-ld-search-input]';
    const NONE = '[data-ld-search-none]';

    /*
     * Folded sections are opened by CSS while a search is running, not by
     * clicking their headers.
     *
     * Filament remembers the folded state per section (persistCollapsed), so
     * clicking to open one would be a permanent change to how the page looks
     * afterwards - a search that rearranges the panel is not a search. The class
     * this adds is undone the moment the box is cleared, and Filament's own
     * state was never touched, so every section goes back to exactly how it was
     * left. See the rules under `.ld-searching` in theme.css.
     */
    const SEARCHING = 'ld-searching';

    const HIDDEN = 'ld-search-hide';

    const sectionsIn = (root) =>
        [...root.querySelectorAll('.fi-section')].filter(
            // Top level only. A section inside another is shown or hidden with
            // its parent, which is what "this section holds it" means.
            (section) => !section.parentElement?.closest('.fi-section'),
        );

    const start = () => {
        const box = document.querySelector(BOX);

        if (!box || box.dataset.ldReady === '1') {
            return;
        }

        const input = box.querySelector(INPUT);
        const none = box.querySelector(NONE);

        // The page around the box, which is what holds the form. Reading it from
        // the box rather than naming a container means this keeps working if the
        // page wrapper is ever renamed.
        const root = box.parentElement;

        if (!input || !root) {
            return;
        }

        box.dataset.ldReady = '1';

        let busy = false;

        const apply = () => {
            const query = input.value.trim().toLowerCase();

            busy = true;

            root.classList.toggle(SEARCHING, query !== '');

            let hits = 0;

            for (const section of sectionsIn(root)) {
                const hit =
                    query === '' ||
                    (section.textContent || '').toLowerCase().includes(query);

                section.classList.toggle(HIDDEN, !hit);

                if (hit) {
                    hits++;
                }
            }

            if (none) {
                none.hidden = query === '' || hits > 0;
            }

            busy = false;
        };

        input.addEventListener('input', apply);

        input.addEventListener('keydown', (event) => {
            /*
             * The page is a form with wire:submit="save" on it, so Enter in this
             * box would save every setting on the page. Nothing about typing a
             * search says "write this to .env".
             */
            if (event.key === 'Enter') {
                event.preventDefault();

                return;
            }

            if (event.key === 'Escape' && input.value !== '') {
                event.preventDefault();
                input.value = '';
                apply();
            }
        });

        /*
         * Livewire replaces parts of the form when a field changes something
         * else on the page, and a replaced section comes back without the class
         * that was hiding it. Re-applying on mutation is cheaper than tracking
         * which of Livewire's hooks exist in which version, and it is correct
         * for any of them.
         *
         * The guard matters: applying the filter is itself a mutation, so
         * without it this observer feeds itself.
         */
        const observer = new MutationObserver(() => {
            if (busy || input.value.trim() === '') {
                return;
            }

            apply();
        });

        observer.observe(root, { childList: true, subtree: true });

        apply();
    };

    document.addEventListener('DOMContentLoaded', start);
    document.addEventListener('livewire:navigated', start);

    if (document.readyState !== 'loading') {
        start();
    }
})();
