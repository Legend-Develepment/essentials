/*
 * Every action needs an icon, because on some panels the label is not drawn.
 *
 * Pelican stores a button style per person - `ButtonStyle` is one of the nine
 * preferences in App\Enums\CustomizationKey - and one of the choices is icons
 * only. On a panel set that way, an action with a label and no icon renders as
 * an empty box with a tooltip: present, clickable, correctly wired, and
 * invisible.
 *
 * That shipped. The Alerts page had four header actions; three carried icons
 * and Save did not, so the most important button on the page was a blank
 * rectangle. Nothing was wrong with the code, nothing threw, and it looked
 * perfectly fine on a panel with the default button style - which is to say on
 * the machine it was written on.
 *
 * So: an Action must set an icon. The check reads the whole chain rather than
 * the line, because the icon is often set from a closure several lines down.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

function files(dir) {
    const out = [];

    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            out.push(...files(full));
        } else if (entry.name.endsWith('.php')) {
            out.push(full);
        }
    }

    return out;
}

/*
 * The extent of one fluent chain.
 *
 * From `Action::make(`, forward until the bracket depth returns to where it
 * started and the next character ends a statement or a list element. Strings are
 * skipped, because a comma inside one is not a comma, and this codebase writes
 * a great deal of prose inside its labels.
 */
function chain(source, from) {
    let depth = 0;
    let i = from;

    while (i < source.length) {
        const char = source[i];

        if (char === "'" || char === '"') {
            const quote = char;

            i += 1;

            while (i < source.length) {
                if (source[i] === '\\') {
                    i += 2;
                    continue;
                }

                if (source[i] === quote) {
                    break;
                }

                i += 1;
            }

            i += 1;
            continue;
        }

        if (char === '(' || char === '[' || char === '{') {
            depth += 1;
        } else if (char === ')' || char === ']' || char === '}') {
            depth -= 1;

            // Fell out of the list this action sits in.
            if (depth < 0) {
                return source.slice(from, i);
            }
        } else if (depth === 0 && (char === ',' || char === ';')) {
            return source.slice(from, i);
        }

        i += 1;
    }

    return source.slice(from);
}

const problems = [];
let checked = 0;

for (const file of files(path.join(root, 'src'))) {
    const source = fs.readFileSync(file, 'utf8');
    const relative = path.relative(root, file).split(path.sep).join('/');

    for (const match of source.matchAll(/\bAction::make\(\s*'([^']*)'/g)) {
        checked += 1;

        const body = chain(source, match.index + 'Action::make'.length);

        if (body.includes('->icon(')) {
            continue;
        }

        /*
         * Two exemptions, both real.
         *
         * An action that hides itself entirely draws nothing to be invisible,
         * and one that is only ever a modal's submit button is drawn by the
         * modal with its own wording rather than as a button in a bar.
         */
        if (body.includes('->hidden(true)') || body.includes('->modalSubmitAction(')) {
            continue;
        }

        problems.push(
            relative + ':' + source.slice(0, match.index).split('\n').length
            + "  Action::make('" + match[1] + "') has no icon",
        );
    }
}

if (problems.length > 0) {
    console.error('Icon check: ' + problems.length + ' action' + (problems.length === 1 ? '' : 's') + ' without one.\n');

    for (const problem of problems) {
        console.error('  ' + problem);
    }

    console.error(
        '\nPelican lets each person set their buttons to icons only, and on such a panel'
        + '\nan action with no icon is an empty box with a tooltip - present, clickable and'
        + '\ninvisible. It looks correct on the default style, which is where it gets'
        + '\nwritten and never where it gets found.',
    );

    process.exit(1);
}

console.log('Icon check: ' + checked + ' actions, every one has an icon.');
