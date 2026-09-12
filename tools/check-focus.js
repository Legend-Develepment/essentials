/*
 * Every control this plugin draws itself has a visible focus ring.
 *
 * Filament's own components get one from a rule near the top of theme.css, and
 * they get it as an outline rather than a shadow for a reason worth repeating:
 * Filament draws focus as a box-shadow, and several rules here replace
 * box-shadow outright to get the hairline and the depth, so a shadow ring would
 * be silently overwritten. An outline is a property Filament never uses.
 *
 * None of that reaches the controls this plugin builds itself. They are not
 * Filament components, they inherit nothing, and seven of them had no ring at
 * all: the button that opens the console, the arranger's toolbar and its scope
 * picker, the drag handles, the link out of a favourite, the link on the
 * version block, and the fold above a settings form. Every one of them is on a
 * page where there is often nothing else to tab to.
 *
 * This is the checkable half of the backlog's focus-states entry. What it cannot
 * do is say whether a ring is visible *against what is behind it* - that needs
 * somebody looking at a screen, and it stays on the list.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

const css = read('resources/css/theme.css');

/* ------------------------------------------------ what takes focus at all -- */

/*
 * The classes this plugin puts on something a keyboard can land on. Listed
 * rather than scraped, and that is a deliberate trade: scraping the views for
 * <button class="..."> finds the ones that exist today and quietly misses the
 * one added in a Blade template written next month, which is exactly the case
 * this is for. A list fails loudly when somebody adds a control and does not
 * add it here - and adding it here is where they read why.
 *
 * A control is on this list if a keyboard can focus it: a button, a link with
 * an address, a select, an input, a summary. Not a row that happens to be
 * styled, and not something with a tabindex of -1.
 */
const CONTROLS = {
    'fi-ld-launch': 'the floating button that opens the console',
    'fi-ld-btn': "the arranger toolbar's buttons",
    'fi-ld-scope': 'the arranger scope picker',
    'fi-ld-handle': 'the drag handle on an arrangeable block',
    'ld-fav': 'the star on a server card',
    'ld-quick__btn': 'the go-to control in the topbar',
    'ld-quick__input': "the go-to menu's search box",
    'ld-quick__row': 'a row in the go-to menu',
    'ld-quick__star': 'the star in the go-to menu',
    'ld-quick__all': 'the show-all row in the go-to menu',
    'ld-search__input': 'the settings search box',
    'ld-favs__remove': 'the remove button on the favourites page',
    'ld-favs__link': 'a link out of the favourites page',
    'ld-status__link': 'the link on the version block',
    'ld-system__update': 'the update button on the system status page',
    'ld-alerts__test': 'the test button on the alerts page',
    'ld-controls__console': 'the console link in the floating controls',
    'ld-controls__power': 'a power button in the floating controls',
    'ld-config__more': 'the fold above a settings form',
    'ld-pop__close': 'the close button on a popup',
    'ld-players__add': 'the add button on the players page',
    'ld-say-add': 'the attach control on the ticket composer',
    'ld-say-pill': 'how urgent and which group, on the ticket composer',
    'ld-say-go': 'the send button on the ticket composer',
    'ld-shop-wait': 'asking to be told when a sold-out package is back',
};

/* --------------------------------------------------------- and what has it */

const missing = [];
const unused = [];

for (const [name, what] of Object.entries(CONTROLS)) {
    /*
     * Matched on the selector rather than on the class appearing anywhere:
     * `.ld-fav` inside `.ld-favs__row` is a different class, and a check that
     * could not tell them apart would pass on the wrong rule.
     */
    const focused = new RegExp('\\.' + name + '(\\s*>\\s*[a-z]+)?(:[a-z-]+)*:focus(-visible|-within)?', 'i');

    if (!focused.test(css)) {
        missing.push(name + ' - ' + what);
    }

    // And the other direction: a control that is no longer drawn is a line in
    // this list nobody will think to remove, and a rule in the stylesheet
    // matching nothing.
    if (!css.includes('.' + name)) {
        unused.push(name + ' - ' + what);
    }
}

/* ----------------------------------------- the ring itself, not a shadow -- */

/*
 * The one thing that would make every rule above useless. Filament draws focus
 * as a box-shadow and this file replaces box-shadow in several places, so a
 * ring written as a shadow is one that some of these controls would silently
 * lose. The shared rule has to be an outline.
 */
const shared = css.slice(css.indexOf('.fi-btn:focus-visible'), css.indexOf('.fi-btn:focus-visible') + 2400);

if (!shared.includes('outline: 2px solid var(--primary-500)')) {
    missing.push('the shared rule does not draw an outline.\n'
        + '    Filament draws focus as a box-shadow and this file replaces box-shadow,\n'
        + '    so a ring written as one is a ring that disappears without warning.');
}

/* --------------------------------------------------------------- verdict -- */

if (missing.length > 0 || unused.length > 0) {
    console.error('Focus check: ' + (missing.length + unused.length) + ' problem(s).\n');

    for (const one of missing) {
        console.error('  no focus ring: ' + one);
    }

    for (const one of unused) {
        console.error('  listed here but not in the stylesheet: ' + one
            + '\n    Either it was renamed, or it is gone and this line should go with it.');
    }

    console.error('\nAdd it to the shared focus rule in resources/css/theme.css. Everything');
    console.error('this plugin draws gets the same ring, because one that differs per');
    console.error('control is one people have to learn twice.');
    process.exit(1);
}

console.log('Focus check: ' + Object.keys(CONTROLS).length + ' controls, every one has a ring.');
