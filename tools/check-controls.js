/*
 * No control characters in source. None.
 *
 * This exists because of one byte, and that byte broke every icon this plugin
 * draws for three releases.
 *
 * IconPacks::drawable() is a regex asking whether a sanitised SVG has anything
 * in it worth drawing. It was written as:
 *
 *     '#<(path|image|circle|...|tspan)\b#i'
 *
 * and what reached the file was that pattern with a literal backspace - 0x08 -
 * where the \b should have been. The tooling that wrote it treated \b as a
 * JavaScript escape rather than as two characters destined for PCRE. So the
 * pattern demanded a backspace character immediately after every SVG tag name,
 * no SVG has ever contained one, and drawable() answered false for every icon
 * in existence.
 *
 * What that looked like: the console's stat cards drew six coloured tiles with
 * nothing in them, the power buttons lost their icons, and the picker went
 * empty. Nothing threw. The file parsed. lint-php reported 190 files fine. The
 * unit test passed, because it re-implemented the regex in JavaScript from what
 * the pattern was *meant* to be rather than reading what the file said - which
 * is the trap this check is really about.
 *
 * A control character in source is never deliberate. Tab, newline and carriage
 * return are the exceptions and everything else is a tool having mangled
 * something on its way to disk. There is no way to see one by reading.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

/* Text this project writes by hand. Binaries and vendored blobs are not ours. */
const EXTENSIONS = ['.php', '.js', '.css', '.json', '.ps1', '.sh', '.md', '.blade.php'];

const SKIP = ['node_modules', '.git', 'dist', 'release', 'no-git', 'pelican-panel-files', 'vendor'];

/*
 * Tab, line feed and carriage return only.
 *
 * The rest of C0, plus DEL, plus the Unicode characters that are invisible and
 * change meaning: a zero-width space or a right-to-left override in a string is
 * the same class of problem arriving a different way.
 */
const FORBIDDEN = new RegExp('[' + '\\u0000-\\u0008\\u000B\\u000C\\u000E-\\u001F\\u007F' + '\\u200B-\\u200F\\u2028\\u2029\\u202A-\\u202E\\u2066-\\u2069\\uFEFF' + ']', 'g');

function named(code) {
    const names = {
        0x00: 'NUL', 0x07: 'BEL', 0x08: 'BACKSPACE', 0x0B: 'VERTICAL TAB',
        0x0C: 'FORM FEED', 0x1B: 'ESCAPE', 0x7F: 'DELETE', 0xFEFF: 'BYTE ORDER MARK',
        0x200B: 'ZERO WIDTH SPACE', 0x200E: 'LEFT-TO-RIGHT MARK', 0x200F: 'RIGHT-TO-LEFT MARK',
        0x202E: 'RIGHT-TO-LEFT OVERRIDE',
    };

    return names[code] ?? 'U+' + code.toString(16).toUpperCase().padStart(4, '0');
}

function files(dir) {
    const out = [];

    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (SKIP.includes(entry.name)) {
            continue;
        }

        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            out.push(...files(full));
        } else if (EXTENSIONS.some((ext) => entry.name.endsWith(ext))) {
            out.push(full);
        }
    }

    return out;
}

const problems = [];
let checked = 0;

for (const file of files(root)) {
    checked += 1;

    const source = fs.readFileSync(file, 'utf8');

    for (const match of source.matchAll(FORBIDDEN)) {
        const before = source.slice(0, match.index);
        const line = before.split('\n').length;
        const column = match.index - before.lastIndexOf('\n');

        problems.push(
            path.relative(root, file).split(path.sep).join('/')
            + ':' + line + ':' + column + '  ' + named(match[0].codePointAt(0)),
        );
    }
}

if (problems.length > 0) {
    console.error('Control character check: ' + problems.length + ' found.\n');

    for (const problem of problems.slice(0, 40)) {
        console.error('  ' + problem);
    }

    if (problems.length > 40) {
        console.error('  ...and ' + (problems.length - 40) + ' more');
    }

    console.error(
        '\nNone of these are typed on purpose. They are what a tool leaves behind when an'
        + '\nescape sequence is read by the wrong layer - and they are invisible in every'
        + '\neditor, so nothing about the file looks wrong.',
    );

    process.exit(1);
}

console.log('Control character check: ' + checked + ' files, none.');
