/*
 * No class declares the same method twice.
 *
 * PHP refuses to compile one that does - "Cannot redeclare X::y()" - and that
 * is a fatal on every page the class is loaded for. It happened twice in one
 * session: a method was added beside one that already existed further down the
 * file, and nothing here noticed, because there is no PHP on the machine this
 * is built on. tools/lint-php.js reads the text and checks the shape of it; a
 * duplicate is perfectly well-shaped.
 *
 * So this counts them. Brace depth tells it which methods belong to the class
 * rather than to a closure inside one, and the name is taken from the line
 * that declares it - which is enough, because a class body is the only place
 * PHP allows the word "function" after a visibility keyword.
 *
 * Interfaces and traits are read the same way and for the same reason.
 */
const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..');

/* A line that opens a class, an interface, a trait or an enum. */
const OPENS = /^\s*(?:abstract\s+|final\s+|readonly\s+)*(class|interface|trait|enum)\s+([A-Za-z_][A-Za-z0-9_]*)/;

/* And one that declares a method: a visibility or a modifier, then function. */
const METHOD = /^\s*(?:(?:public|protected|private|static|abstract|final)\s+)+function\s+([A-Za-z_][A-Za-z0-9_]*)\s*\(/;

function walk(dir, out) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
            continue;
        }

        if (entry.name.endsWith('.php')) out.push(full);
    }

    return out;
}

/*
 * Count braces outside strings and comments.
 *
 * Crude on purpose. A brace inside a string would throw the depth off, so both
 * kinds of quote are skipped, and so is everything after // or # and anything
 * between a block comment's markers. That is enough for this repository, where
 * every file is written by hand in one style - and a file it got wrong would
 * report a duplicate that is not one, which somebody would look at rather than
 * a fatal nobody sees until a page is opened.
 */
function depthOf(line, state) {
    let depth = 0;

    for (let i = 0; i < line.length; i++) {
        const c = line[i];
        const next = line[i + 1];

        if (state.block) {
            if (c === '*' && next === '/') { state.block = false; i++; }
            continue;
        }

        if (state.quote) {
            if (c === '\\') { i++; continue; }
            if (c === state.quote) state.quote = null;
            continue;
        }

        if (c === '/' && next === '*') { state.block = true; i++; continue; }
        if (c === '/' && next === '/') break;
        if (c === '#') break;
        if (c === "'" || c === '"') { state.quote = c; continue; }

        if (c === '{') depth++;
        if (c === '}') depth--;
    }

    return depth;
}

const files = walk(path.join(ROOT, 'src'), []);
const found = [];
let methods = 0;

for (const file of files) {
    const lines = fs.readFileSync(file, 'utf8').split(/\r?\n/);
    const state = { quote: null, block: false };

    let depth = 0;
    let classAt = null;
    // The class body opens on the line after its name, so the depth on the
    // declaration line is still the depth outside it. Without this the class
    // is closed again the moment it is opened.
    let inside = false;
    let seen = new Map();

    lines.forEach((line, index) => {
        const opens = OPENS.exec(line);

        if (opens && classAt === null) {
            classAt = depth;
            inside = false;
            seen = new Map();
        }

        // A method is one written at exactly one brace inside the class body.
        const method = classAt !== null && depth === classAt + 1 ? METHOD.exec(line) : null;

        if (method) {
            methods++;
            const name = method[1];

            if (seen.has(name)) {
                found.push({
                    file: path.relative(ROOT, file),
                    name,
                    first: seen.get(name) + 1,
                    again: index + 1,
                });
            } else {
                seen.set(name, index);
            }
        }

        depth += depthOf(line, state);

        if (classAt !== null && depth > classAt) inside = true;

        if (classAt !== null && inside && depth <= classAt) classAt = null;
    });
}

if (found.length === 0) {
    console.log('Duplicate method check: ' + methods + ' method(s) across ' + files.length + ' file(s), each declared once.');
    process.exit(0);
}

console.error('Duplicate method check: ' + found.length + ' method(s) declared twice.');
console.error('');

for (const row of found) {
    console.error('  ' + row.file + '  ' + row.name + '() at line ' + row.first + ' and again at ' + row.again);
}

console.error('');
console.error('PHP refuses to compile a class that declares a method twice, so this');
console.error('is a fatal on every page that loads it. Nothing else here catches it:');
console.error('lint-php reads the shape of the file, and a duplicate is well-shaped.');
console.error('');
console.error('Usually the second one was added without noticing the first, which is');
console.error('further down the file - so the fix is to fold what the new one does');
console.error('into the one that was already there.');

process.exit(1);
