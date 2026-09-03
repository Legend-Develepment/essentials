/*
 * A string being built up must not be assigned over halfway through.
 *
 * ThemeServiceProvider::script() collects one line of configuration per feature
 * into a single $bootstrap: the stars on the server cards, the top bar's
 * switcher, the page arranger. Two of the three appended to it. The third
 * assigned to it, and so replaced both.
 *
 * It only misbehaved for somebody holding the arrange permission - an
 * administrator, and nobody testing as an ordinary user - which is why it sat
 * there for releases. What it looked like from the outside was starred servers
 * emptying themselves: window.__ldFav was never written, the script read no
 * starred list, and the first click saved that empty list back over the real
 * one. There was no error anywhere. The line was valid PHP doing exactly what
 * it said.
 *
 * The rule is narrow on purpose, so that it can be exact:
 *
 *   Once a variable has been appended to with .=, a later plain = on it is a
 *   mistake, unless it is being reset to an empty string.
 *
 * Resetting to '' is how a loop reuses an accumulator, so that stays allowed.
 * Everything else - assigning a fresh expression over a partly-built string -
 * throws away work that was deliberately done.
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
 * Comments and strings, blanked out.
 *
 * A '.=' inside a quoted string, or an assignment described in the prose above
 * a method, is not an assignment - and this codebase has a great deal of prose.
 * Replaced with spaces of the same length rather than removed, so every line
 * number still points where it did.
 */
function bare(source) {
    let out = '';
    let i = 0;

    const blank = (text) => text.replace(/[^\n]/g, ' ');

    while (i < source.length) {
        const two = source.slice(i, i + 2);

        if (two === '/*') {
            const end = source.indexOf('*/', i + 2);
            const stop = end === -1 ? source.length : end + 2;

            out += blank(source.slice(i, stop));
            i = stop;
            continue;
        }

        if (two === '//') {
            const end = source.indexOf('\n', i);
            const stop = end === -1 ? source.length : end;

            out += blank(source.slice(i, stop));
            i = stop;
            continue;
        }

        const char = source[i];

        if (char === "'" || char === '"') {
            let j = i + 1;

            while (j < source.length) {
                if (source[j] === '\\') {
                    j += 2;
                    continue;
                }

                if (source[j] === char) {
                    break;
                }

                j += 1;
            }

            const stop = Math.min(j + 1, source.length);

            // The quotes are kept so an assignment of '' can still be
            // recognised; only what is between them is blanked.
            out += char + blank(source.slice(i + 1, stop - 1)) + char;
            i = stop;
            continue;
        }

        out += char;
        i += 1;
    }

    return out;
}

/*
 * One method at a time, and that is not a refinement - it is the difference
 * between a check and a nuisance.
 *
 * Scoped to the file, this reported two perfectly correct pieces of code:
 * Notice::html() builds a $html, and Notice::bar() three lines later declares a
 * fresh $html of its own. Same name, different variable, no relationship at all.
 * A check that cries wolf twice on its first run is a check somebody switches
 * off, so it reads the braces.
 *
 * @return array<int, {body: string, from: number}>
 */
function bodies(source) {
    const out = [];

    for (const match of source.matchAll(/\bfunction\s+[A-Za-z_]\w*\s*\(/g)) {
        // Past the parameter list, whatever is in it.
        let i = match.index + match[0].length - 1;
        let depth = 0;

        while (i < source.length) {
            if (source[i] === '(') {
                depth += 1;
            } else if (source[i] === ')') {
                depth -= 1;

                if (depth === 0) {
                    break;
                }
            }

            i += 1;
        }

        // Then to the body, past any return type. An abstract or interface
        // method ends in a semicolon and has no body to check.
        const open = source.indexOf('{', i);
        const end = source.indexOf(';', i);

        if (open === -1 || (end !== -1 && end < open)) {
            continue;
        }

        depth = 0;

        let j = open;

        while (j < source.length) {
            if (source[j] === '{') {
                depth += 1;
            } else if (source[j] === '}') {
                depth -= 1;

                if (depth === 0) {
                    break;
                }
            }

            j += 1;
        }

        out.push({ body: source.slice(open, j), from: open });
    }

    return out;
}

const problems = [];
let watched = 0;

for (const file of files(path.join(root, 'src'))) {
    const source = bare(fs.readFileSync(file, 'utf8'));
    const relative = path.relative(root, file).split(path.sep).join('/');

    for (const method of bodies(source)) {
        // Every variable this method appends to, and where it first does so.
        const appended = new Map();

        for (const match of method.body.matchAll(/\$([A-Za-z_]\w*)\s*\.=/g)) {
            if (!appended.has(match[1])) {
                appended.set(match[1], match.index);
            }
        }

        watched += appended.size;

        for (const [name, first] of appended) {
            // A plain assignment: not .=, not ==, not =>, not >=, <= or !=.
            const assign = new RegExp('\\$' + name + '\\s*(?<![.!<>=])=(?![=>])', 'g');

            for (const match of method.body.matchAll(assign)) {
                if (match.index < first) {
                    continue;
                }

                const rest = method.body.slice(match.index + match[0].length).trimStart();

                // A reset is how a loop reuses one of these, and is fine.
                if (rest.startsWith("''") || rest.startsWith('""')) {
                    continue;
                }

                const at = method.from + match.index;

                problems.push({
                    where: relative + ':' + source.slice(0, at).split('\n').length,
                    name,
                });
            }
        }
    }
}

if (problems.length > 0) {
    console.error(
        'Accumulator check: ' + problems.length + ' assignment'
        + (problems.length === 1 ? '' : 's') + ' over a string that was being built up.\n',
    );

    for (const problem of problems) {
        console.error('  ' + problem.where + '  $' + problem.name + ' is appended to in this method, and assigned here');
    }

    console.error(
        '\nEverything appended before this line is discarded. If that is meant, reset it'
        + "\nwith = '' and then append; if it is not, this is the bug that emptied"
        + '\nwindow.__ldFav for every administrator.',
    );

    process.exit(1);
}

console.log('Accumulator check: ' + watched + ' built-up strings, none assigned over.');
