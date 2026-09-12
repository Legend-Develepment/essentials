{{--
    Search, sort, and the count under them - for both shops.

    The panel's store and the public page draw the same cards from two
    different stylesheets, and this is the one piece of behaviour they share.
    Included from both rather than written twice, because a filter that works
    on one page and not the other is the kind of difference nobody notices
    until a customer does.

    Everything here is plain DOM work on cards that are already on the page.
    Nothing is fetched, nothing is stored, and a reader with no JavaScript sees
    every card in the order the shop chose - which is the right thing to fall
    back to, and the reason the controls are added by the script rather than
    written into the markup.

    The public page's own group filters keep working beside this: apply() reads
    whichever of the three controls exist and asks all of them before it shows
    a card.
--}}
<script>
    (function () {
        var grid = document.getElementById('ld-grid');
        var tools = document.getElementById('ld-tools');

        if (!grid || !tools) { return; }

        var cards = Array.prototype.slice.call(grid.children);

        // Nothing to search through and nothing to sort. One card with a
        // toolbar over it looks like a shop that lost its stock.
        if (cards.length < 2) { return; }

        var search = tools.querySelector('[data-shop-search]');
        var sort = tools.querySelector('[data-shop-sort]');
        var count = document.getElementById('ld-count');
        var filters = document.getElementById('ld-filters');
        var template = count ? count.textContent : '';
        var total = String(cards.length);

        // The order the shop put them in, to go back to. A package's own sort
        // number is a decision somebody made on the packages page, so it is
        // what "Featured" means here rather than an alphabetical accident.
        cards.forEach(function (card, index) {
            card.dataset.shopOrder = String(index);
        });

        var group = '';

        var text = function (card) {
            return (card.getAttribute('data-name') || '').toLowerCase();
        };

        var amount = function (card) {
            return parseInt(card.getAttribute('data-amount') || '0', 10) || 0;
        };

        function apply() {
            var want = (search ? search.value : '').trim().toLowerCase();
            var shown = 0;

            cards.forEach(function (card) {
                var matches = (want === '' || text(card).indexOf(want) !== -1)
                    && (group === '' || card.getAttribute('data-game') === group);

                card.hidden = !matches;

                if (matches) { shown++; }
            });

            if (count) {
                count.textContent = template.replace(total, String(shown));
            }

            // Said out loud, because a grid that has quietly gone empty looks
            // like a page that failed to load.
            var none = document.getElementById('ld-none');

            if (none) { none.hidden = shown !== 0; }
        }

        function order() {
            var how = sort ? sort.value : '';

            var sorted = cards.slice().sort(function (a, b) {
                if (how === 'price-up') { return amount(a) - amount(b); }
                if (how === 'price-down') { return amount(b) - amount(a); }
                if (how === 'name') { return text(a).localeCompare(text(b)); }

                return Number(a.dataset.shopOrder) - Number(b.dataset.shopOrder);
            });

            // Appending a node that is already in the grid moves it, so this
            // reorders in place without anything being rebuilt or reloaded.
            sorted.forEach(function (card) {
                grid.appendChild(card);
            });
        }

        if (search) {
            search.addEventListener('input', apply);
        }

        if (sort) {
            sort.addEventListener('change', order);
        }

        /*
         * The group buttons, where there are any. Taken over from the script
         * that used to own them, so the group and the search narrow the same
         * list together instead of each undoing the other.
         */
        if (filters) {
            filters.addEventListener('click', function (event) {
                var button = event.target.closest('button');

                if (!button) { return; }

                group = button.getAttribute('data-for') || '';

                Array.prototype.forEach.call(filters.querySelectorAll('button'), function (other) {
                    other.setAttribute('aria-pressed', other === button ? 'true' : 'false');
                });

                apply();
            });
        }

        tools.hidden = false;
    })();
</script>
