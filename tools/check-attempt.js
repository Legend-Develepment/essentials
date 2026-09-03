/*
 * A call to attempt() must fit the attempt() it is calling.
 *
 * Four classes here define a method called attempt(): a render or a read that
 * is allowed to fail without taking the page with it. Three of them take a
 * fallback - attempt(callable, mixed): mixed - and for a long time the fourth,
 * in ThemeServiceProvider, did not: attempt(callable): string.
 *
 * Two calls in that fourth class were written in the shape of the other three,
 * with a fallback. Nothing complained, at any point:
 *
 *  - PHP does not object to extra arguments passed to a userland function, so
 *    the fallback was accepted and silently dropped.
 *  - The closure returned an array. The `: string` return type could not coerce
 *    it, so a TypeError was raised at the return statement.
 *  - That return statement is inside the method's own try block, so the
 *    TypeError was caught by the handler meant for a failing render.
 *  - The caller was handed '' where it expected a list, and '' is a perfectly
 *    good value to json_encode.
 *
 * The visible result was that every starred server disappeared on reload, and
 * then got saved over. There was no error in the log, no failing test and no
 * wrong-looking line of code - the call read exactly like its neighbours.
 *
 * So this counts arguments against parameters. It is a narrow check on purpose:
 * a general "does every call fit every signature" is a type checker, and this
 * is the one method in this codebase that exists four times with two shapes.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

/* ------------------------------------------------------------- reading --- */

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
 * Arguments in a call, counted at the top level.
 *
 * `from` is the index of the opening bracket. Commas inside nested brackets
 * belong to something else - a closure's own parameters, an array, a nested
 * call - and commas inside strings are not commas at all. Both are the reason
 * this is a scanner rather than a split.
 */
function countArguments(source, from) {
    let depth = 0;
    let args = 0;
    let seen = false;
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

            seen = true;
            i += 1;
            continue;
        }

        if (char === '(' || char === '[' || char === '{') {
            depth += 1;
            i += 1;

            if (depth === 1) {
                // Just opened the call itself; nothing counted yet.
                seen = false;
            } else {
                seen = true;
            }

            continue;
        }

        if (char === ')' || char === ']' || char === '}') {
            depth -= 1;

            // Anything since the last top-level comma is the final argument.
            // Nothing since it means the comma was trailing, which this
            // codebase writes on every multi-line call - and counting it as an
            // argument reported four calls that were perfectly correct.
            if (depth === 0) {
                return args + (seen ? 1 : 0);
            }

            i += 1;
            continue;
        }

        if (char === ',' && depth === 1) {
            args += 1;
            seen = false;
            i += 1;
            continue;
        }

        if (!/\s/.test(char)) {
            seen = true;
        }

        i += 1;
    }

    return null;
}

/* Parameters a signature declares, and how many of them are required. */
function signature(source, from) {
    const total = countArguments(source, from);

    if (total === null) {
        return null;
    }

    // The parameter list as written, so defaults can be spotted. Depth-aware
    // for the same reason the counter is.
    let depth = 0;
    let i = from;
    let text = '';

    while (i < source.length) {
        const char = source[i];

        if (char === '(') {
            depth += 1;

            if (depth === 1) {
                i += 1;
                continue;
            }
        }

        if (char === ')') {
            depth -= 1;

            if (depth === 0) {
                break;
            }
        }

        text += char;
        i += 1;
    }

    // Assignments only: => is an arrow, == and >= and != are comparisons, and
    // any of them counted here would report a required parameter as optional.
    const optional = (text.match(/(?<![=<>!])=(?![=>])/g) ?? []).length;

    return { total, required: total - optional };
}

/* ------------------------------------------------------------ checking --- */

const problems = [];
let checked = 0;

for (const file of files(path.join(root, 'src'))) {
    const source = fs.readFileSync(file, 'utf8');
    const declaration = source.indexOf('function attempt(');

    if (declaration === -1) {
        continue;
    }

    const shape = signature(source, declaration + 'function attempt'.length);

    if (shape === null) {
        continue;
    }

    const relative = path.relative(root, file).split(path.sep).join('/');

    for (const match of source.matchAll(/(?:\$this->|self::|static::)attempt\(/g)) {
        const at = match.index + match[0].length - 1;
        const args = countArguments(source, at);

        if (args === null) {
            continue;
        }

        checked += 1;

        if (args > shape.total || args < shape.required) {
            const line = source.slice(0, match.index).split('\n').length;

            problems.push(
                relative + ':' + line + ' passes ' + args + ' argument' + (args === 1 ? '' : 's')
                + ' to an attempt() that takes ' + shape.required
                + (shape.total === shape.required ? '' : '-' + shape.total),
            );
        }
    }
}

if (problems.length > 0) {
    console.error('attempt() check: ' + problems.length + ' call' + (problems.length === 1 ? ' does' : 's do') + ' not fit.\n');

    for (const problem of problems) {
        console.error('  ' + problem);
    }

    console.error(
        '\nPHP accepts extra arguments to a userland function without complaint, so this'
        + '\nis never an error at runtime - it is a value silently dropped, and then a'
        + '\nreturn type quietly coercing or throwing inside the method\'s own try.',
    );

    process.exit(1);
}

console.log('attempt() check: ' + checked + ' calls, all fit their signature.');
