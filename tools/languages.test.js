/*
 * Support\Languages, and the rule that decides whether a translation is offered.
 *
 * Thirty of the thirty-one languages that ship here hold eighteen strings out of
 * nearly thirteen hundred, and every one of them arrived switched on. Somebody
 * whose account was set to German got an English panel with eighteen German
 * words scattered through it - which is harder to read than plain English and
 * looks like a fault rather than a gap. `completeness()` had been shown in the
 * settings list since it was written and decided nothing.
 *
 * It decides now, and the change brought one trap with it that these tests exist
 * for more than anything else: **a language under the threshold must not be
 * written to the off-list.** That list records a deliberate no. Putting an
 * unfinished language in it would mean the one somebody finishes translating
 * next month reaches a hundred percent and stays switched off, with no reason
 * to look in a list of exclusions for why.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const BASE = 'en';
const THRESHOLD = 60;

/* A stand-in panel: what each language is translated to. */
const DONE = { en: 100, nl: 100, de: 1, fr: 72, es: 45, pl: 60, ja: 0 };

const completeness = (code) => code === BASE ? 100 : (DONE[code] ?? 0);
const partial = (code) => code !== BASE && completeness(code) < THRESHOLD;

function enabled(code, { main = BASE, off = [], allowed = [] } = {}) {
    if (code === main || code === BASE) { return true; }
    if (off.includes(code)) { return false; }

    return completeness(code) >= THRESHOLD || allowed.includes(code);
}

/* The off-list, written from what was ticked. */
function sanitise(ticked, { main = BASE, available = Object.keys(DONE) } = {}) {
    const off = [];

    for (const code of available) {
        if (code === BASE || code === main || ticked.includes(code)) { continue; }

        // The trap. An unfinished language is governed by the exception list,
        // not by this one.
        if (partial(code)) { continue; }

        off.push(code);
    }

    return off;
}

/* And the exception list, written from the same ticks. */
const sanitisePartial = (ticked) => ticked.filter((code) => partial(code));

console.log('languages\n');

/* --------------------------------------------------- what is offered now -- */

check('a finished language is offered', enabled('nl'), true);
check('one well past the threshold', enabled('fr'), true);
check('exactly at it', enabled('pl'), true);

check('one under it is not', enabled('es'), false);
check('one barely started is not', enabled('de'), false);
check('and one with nothing at all', enabled('ja'), false);

/* ------------------------------------------------- what can never be off -- */

/*
 * Everything falls back to English, so a panel that had switched off its own
 * fallback would show its readers key names.
 */
check('English is always on', enabled('en', { off: ['en'] }), true);
check('and cannot be under a threshold', completeness('en'), 100);

// And the panel's chosen main language, for the same reason one step along.
check('the main language is always on', enabled('de', { main: 'de' }), true);
check('even though it is one percent done', completeness('de'), 1);

/* ------------------------------------------------------- the exception --- */

check('an administrator can offer it anyway', enabled('de', { allowed: ['de'] }), true);
check('but switching it off still wins', enabled('de', { off: ['de'], allowed: ['de'] }), false);
check('an exception for a finished language changes nothing', enabled('nl', { allowed: ['nl'] }), true);

/*
 * And the exception is only recorded for the ones that need one. A finished
 * language stored here would be a line saying nothing the moment somebody
 * finishes translating it.
 */
check('only the unfinished are recorded', sanitisePartial(['de', 'fr', 'nl']), ['de']);
check('several of them', sanitisePartial(['de', 'es', 'ja']), ['de', 'es', 'ja']);
check('none, on a panel that made no exception', sanitisePartial(['fr', 'nl']), []);

/* ----------------------------------------------- the trap, written down -- */

/*
 * The reason this file exists. Unticking a language that is under the threshold
 * must not record a deliberate no, because it was never a yes - it was simply
 * not far enough along.
 */
check('an unfinished language is not written off', sanitise(['nl', 'fr', 'pl']).includes('de'), false);
check('nor is one at nothing', sanitise(['nl', 'fr', 'pl']).includes('ja'), false);

// A finished one that somebody unticks *is* a deliberate no, and is recorded.
check('a finished one unticked is', sanitise(['nl', 'pl']), ['fr']);
check('and stays off once it is', enabled('fr', { off: ['fr'] }), false);

/*
 * The consequence, and the whole point: a language finished later becomes
 * available on its own, without anybody remembering to go and tick it.
 */
{
    const off = sanitise(['nl', 'fr', 'pl']);

    // German was 1% and unticked. Somebody translates it.
    DONE.de = 100;

    check('a language finished later offers itself', enabled('de', { off }), true);

    DONE.de = 1;
}

/*
 * Where it would have gone wrong. If unticking had written it off, finishing
 * the translation would have changed nothing.
 */
{
    const wrong = ['de'];

    DONE.de = 100;

    check('and would not have, had it been written off', enabled('de', { off: wrong }), false);

    DONE.de = 1;
}

/* --------------------------------------------------------- the threshold -- */

/*
 * Sixty, and the number is an argument rather than a preference: a third done
 * means every other sentence changes language mid-page. At sixty the panel
 * reads as translated with gaps, which is a state somebody can work in.
 */
check('a third is not enough', enabled('es'), false);
check('but two thirds is', enabled('fr'), true);
check('the boundary is inclusive', enabled('pl'), true);


/* --------------------------------------------------- what Restore puts back -- */

/*
 * Mirror::pull() writes into Laravel's override directory, and an override wins
 * over the plugin's own file. Proven on the live panel: a file holding one key
 * of a group replaced that key and left its siblings alone, so the override is
 * merged rather than swapped - narrower than it could have been, and still
 * enough to freeze whatever it does hold.
 *
 * So a restore of the thirty-one languages the plugin ships would pin every one
 * of them to the day it was pressed. Today's corrections - a cancellation notice
 * that had been saying the opposite in thirty languages, seven thousand em
 * dashes - would never have reached that panel, and nothing would have said why.
 *
 * The document on the far end cannot answer the question by itself: it is the
 * two halves already merged. So push() writes down whose language it is, and
 * pull() reads that back. The two fallbacks matter as much as the flag: a row
 * written before the flag existed has no answer in it, and a code the plugin
 * does not ship can only be somebody's own.
 */

const restores = (row, ships) => (row.own === true) || !ships;

check('a language somebody made comes back whole', restores({ own: true }, false), true);
check('one the plugin ships does not', restores({ own: false }, true), false);

// The legacy row, written before push() recorded any of this.
check('an old row for a shipped language is left alone', restores({}, true), false);
check('an old row for an uploaded language still comes back', restores({}, false), true);

/*
 * And the case that is both: somebody uploads their own Dutch over the shipped
 * one. push() saw it in the uploaded list and said so, and that must win over
 * the fact that the plugin also ships a Dutch.
 */
check('an override of a shipped language comes back whole', restores({ own: true }, true), true);


/* ------------------------------------------------- taking a language out -- */

/*
 * Removing an uploaded language deletes directories, and two of the three
 * directories in play are not this plugin's to delete.
 *
 * lang/vendor/essentials/<code>/ is ours: install() made it and nothing else
 * writes there. lang/<code>/ is the application's own, and for a locale Pelican
 * ships it is full of Pelican's files - deleting that would take the panel's
 * own translation with it and leave that language with nothing at all. And a
 * language the plugin carries is not anybody's to remove: it arrives again with
 * the next release, so the button would achieve nothing but a gap until then.
 *
 * So the decision is made before anything is deleted, and it is made from four
 * questions rather than from whether a directory happens to exist.
 */

const refuse = (code, world) => {
    if (!/^[A-Za-z][A-Za-z0-9_-]{1,31}$/.test(code)) return 'bad_code';
    if (world.ships) return 'shipped';
    if (!world.uploaded) return 'unknown';
    if (world.main) return 'in_use';

    return null;
};

// Whether the application's own directory goes with it.
const takesPanelHalf = (world) => !world.pelicanKnows;

const uploaded = { ships: false, uploaded: true, main: false, pelicanKnows: false };

check('an uploaded language of its own goes', refuse('Gaming-EN', uploaded), null);
check('and both halves with it', takesPanelHalf(uploaded), true);

check('a language the plugin ships is refused',
    refuse('nl', { ...uploaded, ships: true }), 'shipped');

check('a name nothing was uploaded under is refused',
    refuse('Gaming-DE', { ...uploaded, uploaded: false }), 'unknown');

check('the language the panel falls back to is refused',
    refuse('Gaming-EN', { ...uploaded, main: true }), 'in_use');

/*
 * The one that matters most. Somebody uploads a translation for a locale
 * Pelican itself ships but this plugin does not, and then removes it. Our half
 * goes; the application's directory is Pelican's and stays, because deleting it
 * would take Pelican's own translation of that locale with it.
 */
const overPelican = { ships: false, uploaded: true, main: false, pelicanKnows: true };

check('an upload over a Pelican locale may be removed', refuse('af', overPelican), null);
check('but only our half of it', takesPanelHalf(overPelican), false);

// A code is a directory name, so it is held to that shape and nothing else.
check('a traversal is refused', refuse('../../etc', uploaded), 'bad_code');
check('a path is refused', refuse('nl/../x', uploaded), 'bad_code');
check('a dot is refused', refuse('en.php', uploaded), 'bad_code');
check('an empty name is refused', refuse('', uploaded), 'bad_code');
check('one letter is refused', refuse('n', uploaded), 'bad_code');
check('a name that is all digits is refused', refuse('123', uploaded), 'bad_code');
check('a long name is refused', refuse('a'.repeat(33), uploaded), 'bad_code');
check('thirty-two characters is the most it may be', refuse('a'.repeat(32), uploaded), null);

/*
 * And the order. uploaded() answers by looking at the very directory the first
 * delete takes away, so every question has to be asked before any of them is
 * acted on. Asked afterwards, the second half of the removal would look at a
 * language that was no longer there and leave the application's directory
 * standing for ever.
 */
check('the shape is judged before anything is deleted',
    refuse('Gaming-EN', { ships: false, uploaded: false, main: false, pelicanKnows: false }),
    'unknown');

console.log(NEWLINE + 'languages: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
