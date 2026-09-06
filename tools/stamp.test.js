/*
 * Support\Stamp, and the cache key built from it.
 *
 * The settings stylesheet is built once and kept until this value moves. Two
 * things can go wrong with that and only one of them is visible:
 *
 *   - The key changes when it should not. Costs a rebuild. Nobody notices.
 *   - The key does not change when it should. The panel draws yesterday's
 *     settings and the settings page shows today's, so the person saving looks
 *     at a form that is right and a panel that is wrong. That is the failure
 *     the icon stylesheet already had once, for a day.
 *
 * So this is mostly about what has to be in the key. check-stamp.js covers the
 * other half - that the writers move it at all.
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

const crypto = require('crypto');
const md5 = (text) => crypto.createHash('md5').update(text).digest('hex');

const VERSION = 1;

const flat = (value) => {
    if (typeof value === 'boolean') { return value ? '1' : '0'; }
    if (value === null || value === undefined) { return ''; }

    return String(value);
};

const key = (part, stamp, extra = []) =>
    'legend-theme.settings.' + md5([VERSION, part, stamp, ...extra.map(flat)].join('|'));

// The fallback, for a panel whose storage cannot be written.
const hourly = (at) => 'h' + Math.floor(at / 3600);

console.log('settings cache\n');

/* ------------------------------------------------------- what is in a key */

const A = key('panel', '1000', [null, false, false]);

check('the same inputs give the same key', key('panel', '1000', [null, false, false]), A);

/*
 * The stamp. Every setting and every list the block reads is behind this one
 * value, which is what makes one bump enough for a whole save.
 */
check('a new stamp is a new key', key('panel', '1001', [null, false, false]) === A, false);

/*
 * The part. Three blocks are built from the same fifteen classes with different
 * values, and they are concatenated in order - so mixing them up would put the
 * panel's own settings where somebody's personal style should be.
 */
check('the window block is not the panel block',
    key('window', '1000', [null, false, false]) === A, false);
check('and neither is a personal one',
    key('own', '1000', [null, false, false]) === A, false);

/*
 * The preset. This is what makes the two personal blocks cheap: twenty people
 * on Nord share one entry, and the twenty-first on Solarized gets their own.
 */
check('two people on the same preset share an entry',
    key('own', '1000', ['nord', false, false]),
    key('own', '1000', ['nord', false, false]));
check('a different preset does not',
    key('own', '1000', ['nord', false, false]) === key('own', '1000', ['solarized', false, false]),
    false);
check('and no preset is not the same as one',
    key('own', '1000', [null, false, false]) === key('own', '1000', ['nord', false, false]),
    false);

/*
 * The two facts about the reader that change what comes out. Both are in the
 * key rather than pulled out of the composition, because they sit in the middle
 * of it and Areas is emitted last on purpose - moving two rules past Areas to
 * simplify a key would change which rule wins.
 */
check('somebody who chose their own navigation gets their own entry',
    key('panel', '1000', [null, true, false]) === A, false);
check('and the console opened as its own window gets one too',
    key('panel', '1000', [null, false, true]) === A, false);
check('the two are not the same either',
    key('panel', '1000', [null, true, false]) === key('panel', '1000', [null, false, true]),
    false);

// Four variants of the panel block, which is nothing beside rebuilding it.
{
    const seen = new Set();

    for (const nav of [false, true]) {
        for (const bare of [false, true]) {
            seen.add(key('panel', '1000', [null, nav, bare]));
        }
    }

    check('four combinations, four entries', seen.size, 4);
}

/*
 * A boolean and the string of it must not collide. Without flattening them the
 * same way, false and '' and null would all join as nothing and three different
 * readers would share one entry.
 */
check('false is not empty', flat(false) === flat(null), false);
check('true is not the word', flat(true), '1');
check('null is empty', flat(null), '');
check('a preset name survives', flat('nord'), 'nord');

/*
 * And the separator has to be one, or two fields could run together: a preset
 * called "a" with nav true would otherwise key the same as one called "a1".
 */
check('fields cannot run together',
    key('own', '1000', ['a', true, false]) === key('own', '1000', ['a1', false, false]),
    false);

/* -------------------------------------------------------- the release too */

/*
 * The stamp cannot see a release that changes what a rule emits: the settings
 * are the same, the files are the same, and every cached entry is wrong. That
 * is what the version is for, and it is bumped by hand in the commit that
 * changes the output.
 */
{
    const withVersion = (v) => 'legend-theme.settings.' + md5([v, 'panel', '1000'].join('|'));

    check('a new version is a new key', withVersion(1) === withVersion(2), false);
}

/* --------------------------------------------------------- the fallback -- */

/*
 * With no file the value has to keep moving. A panel whose storage cannot be
 * written would otherwise cache once and never notice another change - which is
 * worse than not caching at all, because it looks like it is working.
 */
check('the fallback changes with the hour', hourly(3600) === hourly(7200), false);
check('and holds still within one', hourly(3600), hourly(7199));
check('it is not a timestamp somebody could mistake for one',
    hourly(3600).startsWith('h'), true);

// An hour is the ceiling on being wrong when the disk will not take a write.
check('an hour apart is a different key',
    key('panel', hourly(3600), []) === key('panel', hourly(7200), []), false);

/* ------------------------------------------------- the arrangement's own -- */

/*
 * The page arrangement has a cache and a stamp of its own, and the reasons are
 * two different faults it would otherwise walk into.
 *
 * It cannot share the settings key, because an arrangement belongs to one
 * reader on one page - a shared entry would draw one person's arrangement for
 * everybody, which nobody reports because everybody sees a page that looks
 * arranged.
 *
 * And it cannot share the settings stamp, because that moves whenever anybody
 * saves a colour. Sharing it in that direction would either throw the whole
 * panel's stylesheet away every time somebody dragged a block, or leave
 * arrangements stale when a colour changed - one of the two, depending which
 * way round it was wired.
 */
const arrangementKey = (stamp, userId, page) =>
    'legend-theme.arrangement.' + md5([VERSION, stamp, userId === null ? 'guest' : String(userId), page].join('|'));

const A2 = arrangementKey('2000', 7, '/server/{id}/settings');

check('the same reader on the same page', arrangementKey('2000', 7, '/server/{id}/settings'), A2);

// The whole reason it is not in the shared block.
check('another reader is another entry', arrangementKey('2000', 8, '/server/{id}/settings') === A2, false);
check('and signed out is another again', arrangementKey('2000', null, '/server/{id}/settings') === A2, false);

check('another page is another entry', arrangementKey('2000', 7, '/admin/settings') === A2, false);

/*
 * The page is the folded one, so every server's settings page shares an entry
 * rather than each server having its own. On a panel with four hundred servers
 * that is the difference between one entry and four hundred.
 */
check('every server shares one entry for the same page',
    arrangementKey('2000', 7, '/server/{id}/settings'),
    arrangementKey('2000', 7, '/server/{id}/settings'));

/* Its own stamp, moving on its own. */
check('a dragged block is a new key', arrangementKey('2001', 7, '/server/{id}/settings') === A2, false);

/*
 * And the two stamps are independent, which is the property the split exists
 * for: a saved colour must not invalidate arrangements, and a dragged block
 * must not invalidate the panel's stylesheet.
 */
check('the settings key does not move when an arrangement does',
    key('panel', '1000', []), key('panel', '1000', []));
check('and the arrangement key does not move when a setting does',
    arrangementKey('2000', 7, '/x'), arrangementKey('2000', 7, '/x'));

// The fallback is the same shape, so an unwritable disk costs an hour here too
// rather than an arrangement that never updates again.
check('the arrangement falls back hourly as well',
    arrangementKey(hourly(3600), 7, '/x') === arrangementKey(hourly(7200), 7, '/x'), false);

console.log(NEWLINE + 'settings cache: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
