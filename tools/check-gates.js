/*
 * Every feature is in exactly one of the two lists that decide its permission.
 *
 * `ACTIONS` gives a feature a grant somebody can be handed; `UNGATED` says it
 * has none and why. A feature in neither falls through the `?? $key` in
 * `permission()` and gets a name invented for it - one `permissions()` never
 * emits and Pelican therefore never registers, which is a grant that cannot be
 * given to anybody. `waitlist` sat like that from the day the waiting list
 * shipped. It was harmless only because nothing asked: `Waiting::ready()` reads
 * `enabled()`, and the day something calls `maySee()` on it, it is a page
 * nobody can reach.
 *
 * A feature in both would be the other way round: a permission the role editor
 * offers and `maySee()` ignores.
 *
 * The counts in that file's own prose had drifted too - "these six", "thirty-six
 * long" - so this prints what is actually there and the comments can stop
 * carrying numbers.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const source = fs.readFileSync(path.join(root, 'src', 'Support', 'Features.php'), 'utf8');

/** The constants, as `NAME => 'key'`. */
const constants = new Map();

for (const match of source.matchAll(/public const ([A-Z_]+) = '([a-z0-9_]+)';/g)) {
    constants.set(match[1], match[2]);
}

/** One `self::NAME` list, by the constant it is assigned to. */
function names(listName) {
    const start = source.indexOf(`const ${listName} = [`);

    if (start === -1) {
        return null;
    }

    const end = source.indexOf('];', start);
    const body = source.slice(start, end);
    const found = new Set();

    for (const match of body.matchAll(/self::([A-Z_]+)/g)) {
        found.add(match[1]);
    }

    return found;
}

const all = names('ALL');
const actions = names('ACTIONS');
const ungated = names('UNGATED');

const problems = [];

if (all === null || actions === null || ungated === null) {
    console.error('Gate check: one of ALL, ACTIONS or UNGATED could not be read.');
    process.exit(1);
}

// Every declared feature is in ALL, or nothing iterates it.
for (const name of constants.keys()) {
    if (!all.has(name)) {
        problems.push(`${name} is declared but is not in ALL, so nothing offers it`);
    }
}

for (const name of all) {
    const inActions = actions.has(name);
    const inUngated = ungated.has(name);

    if (!inActions && !inUngated) {
        problems.push(
            `${name} is in neither ACTIONS nor UNGATED, so permission() invents a name `
                + 'nothing registers and nobody can be granted',
        );
    }

    if (inActions && inUngated) {
        problems.push(
            `${name} is in both ACTIONS and UNGATED: the role editor would offer a grant `
                + 'that maySee() never reads',
        );
    }
}

if (problems.length > 0) {
    console.error(`Gate check: ${problems.length} problem(s).\n`);
    problems.forEach((line) => console.error('  ' + line));
    process.exit(1);
}

console.log(
    `Gate check: ${all.size} features, ${actions.size} with a permission of their own, `
        + `${ungated.size} deliberately without one.`,
);
