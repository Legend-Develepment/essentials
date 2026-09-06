/*
 * Which release outranks which.
 *
 * One line decides whether a panel is offered an update - Channels.php:595,
 * `version_compare($latest, $installed, '>')` - and roadmap/README.md spends
 * three paragraphs on the ordering that line has to produce. Nothing checked
 * that the two agree.
 *
 * The ordering is not obvious, and it is not alphabetical. PHP ranks the
 * suffixes dev < alpha < beta < RC < (no suffix) < pl, which means
 * `2.47.7-dev` sorts BELOW `2.47.7-beta` even though "beta" comes first in a
 * dictionary. Getting that backwards would offer every panel on a channel an
 * update that never goes away, which is exactly what 2.50.0 did to 2.49.2-dev
 * minutes after the rule was first written down.
 *
 * So this ports PHP's own algorithm rather than approximating it, and then
 * asserts the three claims the roadmap makes, and the rule build.ps1 enforces.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ------------------------------------------------- PHP's version_compare -- */

/*
 * Canonicalise the way PHP does: the three separators become dots, and a dot is
 * inserted wherever the string crosses between digits and letters. So
 * "2.47.7-beta" becomes ["2","47","7","beta"].
 */
function parts(version) {
    let out = '';
    const digit = (c) => c >= '0' && c <= '9';

    for (let i = 0; i < version.length; i++) {
        const c = version[i];

        if (c === '-' || c === '_' || c === '+') {
            out += '.';
            continue;
        }

        if (i > 0 && digit(c) !== digit(version[i - 1]) && version[i - 1] !== '.') {
            out += '.';
        }

        out += c;
    }

    return out.split('.').filter((part) => part !== '');
}

/*
 * What each kind of part is worth. A number is '#', and anything unrecognised
 * sorts below even dev - which is what makes a typo lose rather than win.
 */
function order(part) {
    if (/^[0-9]+$/.test(part)) { return 4; }

    switch (part.toLowerCase()) {
        case 'dev': return 0;
        case 'alpha': case 'a': return 1;
        case 'beta': case 'b': return 2;
        case 'rc': return 3;
        case 'pl': case 'p': return 5;
        default: return -1;
    }
}

function compare(a, b) {
    const left = parts(a);
    const right = parts(b);
    const shared = Math.min(left.length, right.length);

    for (let i = 0; i < shared; i++) {
        const x = left[i];
        const y = right[i];

        if (/^[0-9]+$/.test(x) && /^[0-9]+$/.test(y)) {
            const difference = Number(x) - Number(y);

            if (difference !== 0) { return difference < 0 ? -1 : 1; }

            continue;
        }

        const difference = order(x) - order(y);

        if (difference !== 0) { return difference < 0 ? -1 : 1; }
    }

    if (left.length === right.length) { return 0; }

    /*
     * One ran out. The longer one wins only if what it has next ranks at or
     * above a number - so 1.0.1 beats 1.0, and 1.0-dev loses to 1.0.
     */
    if (left.length > right.length) { return order(left[shared]) < 4 ? -1 : 1; }

    return order(right[shared]) < 4 ? 1 : -1;
}

const below = (a, b) => compare(a, b) === -1;

/** The rule Channels.php applies: an update is offered only when it outranks. */
const offers = (latest, installed) => compare(latest, installed) > 0;

/** And the rule build.ps1 applies, which ignores the suffix entirely. */
const numeric = (version) => version.replace(/-.*$/, '').split('.').map(Number);

function outranks(mine, stable) {
    const a = numeric(mine);
    const b = numeric(stable);

    for (let i = 0; i < Math.max(a.length, b.length); i++) {
        const x = a[i] || 0;
        const y = b[i] || 0;

        if (x !== y) { return x > y; }
    }

    return false;
}

console.log('release ordering\n');

/* ------------------------------------------------------ the pieces of it -- */

check('a plain version', parts('2.47.7'), ['2', '47', '7']);
check('a dev one', parts('2.47.1-dev'), ['2', '47', '1', 'dev']);
check('a beta one', parts('2.72.1-beta'), ['2', '72', '1', 'beta']);

/* ------------------------------------------------------ the three claims -- */

/*
 * Written out in roadmap/README.md, which is where somebody looks to decide
 * what number to put on the next release.
 */
check('a dev build is below a later beta', below('2.47.1-dev', '2.47.7-beta'), true);
check('a beta is below the stable of the same number', below('2.47.7-beta', '2.47.7'), true);
check('and stable of an earlier number is below a dev of a later one',
    below('2.47.0', '2.47.7-dev'), true);

/*
 * The consequence the roadmap draws from that, and the reason it is correct: a
 * panel on dev is not offered the stable release of its own cycle, because it
 * is already ahead of it. The next thing it is offered is the cycle after.
 */
check('a dev panel is not offered its own cycle\'s stable',
    offers('2.47.0', '2.47.7-dev'), false);
check('but it is offered the next cycle', offers('2.48.1-dev', '2.47.7-dev'), true);

/* ------------------------------------------------- the suffixes in order -- */

// The one that is not alphabetical, and the one worth knowing.
check('dev is below beta, not above it', below('2.72.1-dev', '2.72.1-beta'), true);
check('beta is below no suffix at all', below('2.72.1-beta', '2.72.1'), true);
check('dev is below no suffix at all', below('2.72.1-dev', '2.72.1'), true);
check('alpha sits between them', below('1.0-alpha', '1.0-beta'), true);
check('and dev is below alpha', below('1.0-dev', '1.0-alpha'), true);
check('rc is the last one before release', below('1.0-rc', '1.0'), true);

// A suffix nobody recognises loses, rather than winning by accident.
check('a suffix that is not one sorts below dev', below('1.0-nightly', '1.0-dev'), true);

/* --------------------------------------------------------- the numbers --- */

check('a higher patch', below('2.72.1', '2.72.2'), true);
check('a higher minor', below('2.72.9', '2.73.0'), true);
check('a higher major', below('2.99.9', '3.0.0'), true);
check('ten is above nine, as a number rather than as a word',
    below('2.9.0', '2.10.0'), true);
check('the same version is neither', compare('2.72.0', '2.72.0'), 0);

/* -------------------------------------------------- what an update means -- */

check('an update is offered when it is newer', offers('2.73.0', '2.72.0'), true);
check('and not when it is the same', offers('2.72.0', '2.72.0'), false);
check('and not when it is older', offers('2.71.0', '2.72.0'), false);

/*
 * The failure this ordering exists to prevent: a pre-release that does not
 * outrank stable is offered for ever, because installing it never satisfies
 * the check that offered it.
 */
check('a dev build below stable would be offered again after installing',
    offers('2.72.1-dev', '2.72.0') && offers('2.72.1-dev', '2.72.1-dev'), false);

/* ------------------------------------------------------- the build guard -- */

/*
 * build.ps1 refuses to build a pre-release that does not outrank stable, and it
 * compares with the suffix stripped - so 2.72.1-dev against stable 2.72.0 is
 * 2.72.1 against 2.72.0. That is deliberately blunter than version_compare, and
 * blunter in the safe direction.
 */
check('the current shape of the channels', outranks('2.75.1-dev', '2.72.0'), true);
check('a beta above stable', outranks('2.72.1-beta', '2.72.0'), true);
check('a dev equal to stable is refused', outranks('2.72.0-dev', '2.72.0'), false);
check('a dev below stable is refused', outranks('2.71.9-dev', '2.72.0'), false);

/*
 * And the case the guard cannot see from its side, which is why build.ps1 warns
 * about it after a stable build instead: a dev that was comfortably ahead stops
 * being ahead the moment stable overtakes it.
 */
check('stable overtaking a dev build', outranks('2.72.1-dev', '2.73.0'), false);

console.log(NEWLINE + 'release ordering: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
