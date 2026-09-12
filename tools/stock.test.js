/*
 * Watchdog::stock(), ported, because the part that decides what is news is the
 * part that cannot be checked by reading it.
 *
 * The check answers one question per package - is it gone, nearly gone, or
 * fine - and says something only when that answer moves. Three designs were
 * written for it and all three got the same thing wrong, which is why this file
 * exists:
 *
 *  1. A key meaning "anything in the shop is short" stands at bad for ever,
 *     because a shop nearly always has something permanently sold out, and
 *     State only speaks on a change. The next package to sell out is silence.
 *     So the memory is per package and only the sentence is shared.
 *
 *  2. Gone and nearly gone have to be separate levels. Under one "short" level
 *     a package going from two left to none has not changed, and that is the
 *     moment the shop starts refusing money.
 *
 *  3. The band that stops a package flapping has to be per package. Widened
 *     across the whole shop it lets in packages that never crossed the line,
 *     and then the key can never clear: one package resting just above the
 *     threshold holds the alert open for ever while the settings page says
 *     nothing is wrong.
 *
 *  4. And the band must not widen on the way back from sold out, or a package
 *     restocked to one above the threshold is announced as nearly sold out -
 *     a message contradicting the number the owner typed.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------- the port -- */

/*
 * Watchdog::level(). The whole of the hysteresis is the one ternary in it.
 *
 * Raise at or below the number the owner set, hold at one above it, and call it
 * well again at two above - but only while it is already low, because coming
 * back from nothing is not the same journey.
 */
const level = (left, limit, was) => {
    if (left === 0) return 'out';
    if (limit < 1) return 'fine';

    return left <= (was === 'low' ? limit + 1 : limit) ? 'low' : 'fine';
};

/*
 * Which of the three sentences a package belongs in, from where it was and
 * where it is now.
 *
 * Not the same thing as its level, and that is the fourth mistake: coming back
 * is only ever coming back from sold out. A package that dipped to the warning
 * line and climbed off it again was on sale the whole time, so "it is back on
 * sale" would be a plain untruth about it and it says nothing instead.
 */
const news = (was, now) => {
    if (was === now) return null;
    if (now === 'out') return 'out';
    if (was === 'out') return 'back';
    if (now === 'low') return 'low';

    return null;
};

/*
 * One package's memory, as the two state rows hold it.
 *
 * The pair is read back as a single level before the reading is taken, which is
 * what makes the band per package: the input to the decision is where this
 * package already was, never where the shop is.
 */
function makePackage(limit) {
    let out = false;
    let low = false;

    return {
        // Returns what should be said about it, or null for nothing.
        read(left) {
            const was = out ? 'out' : (limit > 0 && low ? 'low' : 'fine');
            const now = level(left, limit, was);

            out = now === 'out';
            low = now === 'low';

            return news(was, now);
        },
        level: () => (out ? 'out' : (low ? 'low' : 'fine')),
    };
}

/* ------------------------------------------------------------- the news -- */

check('nothing moved, nothing said', news('low', 'low'), null);
check('crossing the line is a warning', news('fine', 'low'), 'low');
check('selling the last one is news', news('fine', 'out'), 'out');
check('and so is selling it from low', news('low', 'out'), 'out');
check('climbing off the line quietly says nothing', news('low', 'fine'), null);
check('restocked from nothing is back on sale', news('out', 'fine'), 'back');
check('restocked to under the line is still back on sale', news('out', 'low'), 'back');

/* ---------------------------------------------------- the levels alone --- */

check('a cap with room is fine', level(9, 3, 'fine'), 'fine');
check('at the line is low', level(3, 3, 'fine'), 'low');
check('under the line is low', level(1, 3, 'fine'), 'low');
check('nothing left is out', level(0, 3, 'fine'), 'out');

// Nought left is gone whatever the warning is set to, including switched off.
check('nothing left is out even with the warning off', level(0, 0, 'fine'), 'out');
check('the warning off leaves everything else fine', level(1, 0, 'fine'), 'fine');

/* ------------------------------------------------------------- the band -- */

check('one above the line does not clear a low package', level(4, 3, 'low'), 'low');
check('two above the line clears it', level(5, 3, 'low'), 'fine');
check('one above the line never raises a fine package', level(4, 3, 'fine'), 'fine');

// The fourth mistake. Restocked from nothing to one above the line is back on
// sale, not nearly sold out, because the band belongs to the low state only.
check('back from sold out to one above the line is fine', level(4, 3, 'out'), 'fine');
check('back from sold out to the line itself is low', level(3, 3, 'out'), 'low');

/* ------------------------------------------------- one package over time -- */

let p = makePackage(3);

check('a full package says nothing', p.read(10), null);
check('and says nothing again', p.read(9), null);
check('crossing the line is news', p.read(3), 'low');
check('staying low is not news', p.read(2), null);
check('selling the last one is news', p.read(0), 'out');
check('staying sold out is not news', p.read(0), null);
check('one back is back on sale, not a warning', p.read(1), 'back');
check('climbing inside the band says nothing', p.read(4), null);
check('and climbing clear of it says nothing either', p.read(5), null);

/* --------------------------------------------------------- the flapping -- */

/*
 * The case the owner asked about by name: one sale and one cancellation, over
 * and over, on a package sitting on the line. Without the band that is a
 * message every pass, for ever.
 */
p = makePackage(3);
p.read(3);

let said = 0;

for (let i = 0; i < 20; i++) {
    if (p.read(i % 2 === 0 ? 4 : 3) !== null) said++;
}

check('a package flapping across the line says nothing', said, 0);
check('and it is still remembered as low', p.level(), 'low');

/*
 * The band is a delay and not a mute, so the level does move. It is only the
 * sentence that is withheld, because there is no true one to send.
 */
check('a real restock moves the level', p.read(6), null);
check('and the package is fine again', p.level(), 'fine');

/* ------------------------------------------------------ the latching bug -- */

/*
 * A package the owner deliberately caps at two, with the warning at three. It
 * is low from the day it is created and stays low for ever, which is correct
 * and should be said exactly once.
 *
 * Under a key meaning "anything is short" this package would hold that key at
 * bad for ever, and the second package below would never be heard from. Per
 * package, it cannot.
 */
const scarce = makePackage(3);
const ordinary = makePackage(3);

check('the scarce package is announced once', scarce.read(2), 'low');
check('and not again', scarce.read(2), null);
check('and not again after that', scarce.read(2), null);

check('the ordinary one is quiet while it has room', ordinary.read(50), null);
check('and is still heard when it runs low', ordinary.read(3), 'low');
check('and when it sells out', ordinary.read(0), 'out');

/* ------------------------------------------- turning the warning off ----- */

/*
 * Nought means keep quiet until a package is gone. A package that was low when
 * the owner turned the warning off must not announce itself as back on sale:
 * nothing about it has changed except the setting.
 */
const muted = makePackage(0);

check('with the warning off a low package says nothing', muted.read(2), null);
check('and the same package selling out is still news', muted.read(0), 'out');
check('and coming back is still news', muted.read(2), 'back');

/* ------------------------------------------------------------ the digest - */

/*
 * Six packages selling out in the same pass is one sentence, not six messages.
 * The count in the title and the names in the body, which is what backups()
 * does for the same reason.
 */
const digest = (moves) => {
    const out = [];
    const low = [];
    const back = [];

    for (const [name, what] of moves) {
        if (what === 'out') out.push(name);
        else if (what === 'low') low.push(name);
        else if (what === 'back') back.push(name);
    }

    return [out, low, back].filter((set) => set.length > 0).length;
};

check('six sold out together is one message', digest([
    ['a', 'out'], ['b', 'out'], ['c', 'out'], ['d', 'out'], ['e', 'out'], ['f', 'out'],
]), 1);

check('one gone and one back is two', digest([['a', 'out'], ['b', 'back']]), 2);
check('nothing moved is nothing said', digest([]), 0);
check('all three kinds is three', digest([['a', 'out'], ['b', 'low'], ['c', 'back']]), 3);
check('a package that quietly recovered adds nothing', digest([['a', 'out'], ['b', null]]), 1);

console.log('\nstock alerts: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
