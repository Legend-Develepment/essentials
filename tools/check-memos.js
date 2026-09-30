/*
 * A class that remembers something for the process must be told to stop.
 *
 * Two lists answered the same question and disagreed. `Theme::forgetDerived()`
 * dropped nineteen memos when a preview swapped the settings under a request;
 * `Held::forget()` dropped six when a queue worker picked up new work. Those
 * are the same question: a memo worked out from settings is a memo an hours-old
 * worker must not inherit. Nineteen of them were only ever cleared by the
 * preview, which is how a watchdog pass came to call `Ports::forget()` by hand
 * at the top of one check - a patch around a list that was missing an entry.
 *
 * Seven more were in neither, including both `Tables::ready()` memos: a worker
 * that asked before a module was switched on kept saying the tables were not
 * there, so the pages behind them stayed hidden for as long as it lived.
 *
 * So this reads the pairing rather than trusting it. Every class in src/ that
 * holds a static and offers a parameterless forget() or refresh() has to be
 * reached by one of the two, or be named below with why not.
 *
 * It cannot check that a memo is dropped at the right *moment* - only that
 * something drops it at all. That is the half a list can get wrong silently.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const src = path.join(root, 'src');

/*
 * Held is a worker picking up new work; forgetDerived is the settings being
 * swapped. Held calls forgetDerived, so between them they are one list.
 */
const FORGETTERS = [
    'src/Support/Held.php',
    'src/Support/Theme.php',
];

/**
 * The ones that are deliberately not on either list, and why.
 *
 * Each of these is a memo whose answer cannot go stale in a way that matters,
 * or one that is cleared by the thing that changes it. A new entry here is a
 * decision somebody has to write down rather than a line to add quietly.
 */
const ALLOWED = {
    Palette: 'keyed on the colour handed to it, so it is true whatever config says',
    Held: 'the forgetter itself',
    Theme: 'the forgetter itself',
    Stamp: 'a number that is bumped rather than read back',
    PelicanStrings: 'its static says the translator was handed the path in this process, and dropping it '
        + 'would hand it over twice; refresh() rewrites files rather than forgetting anything',
};

const SKIP = new Set(['.git', 'node_modules', 'no-git', 'dist', 'release', 'vendor']);

function walk(dir, out = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (SKIP.has(entry.name)) {
            continue;
        }

        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
        } else if (entry.name.endsWith('.php')) {
            out.push(full);
        }
    }

    return out;
}

/*
 * What the two forgetters name.
 *
 * Both spellings count: Theme writes its reach into sub-namespaces out in full
 * on purpose, and Held imports with an alias. The class name is the last
 * segment either way.
 */
const cleared = new Set();

for (const rel of FORGETTERS) {
    const source = fs.readFileSync(path.join(root, rel), 'utf8');

    for (const match of source.matchAll(/([\w\\]+)::(?:forget|forgetDerived|refresh)\(\s*\)/g)) {
        cleared.add(match[1].split('\\').filter(Boolean).pop());
    }

    // Held imports two of them under another name, so the alias has to resolve.
    for (const match of source.matchAll(/^use\s+[\w\\]*\\(\w+)\s+as\s+(\w+);/gm)) {
        if (cleared.has(match[2])) {
            cleared.add(match[1]);
        }
    }
}

const problems = [];
let holders = 0;

/*
 * And that the two are still one list.
 *
 * Everything below counts a memo as cleared when either forgetter names it,
 * which is right only while Held calls forgetDerived. Drop that one line and
 * the nineteen settings memos are cleared by a preview and by nothing a queue
 * worker does - the exact state this check was written for, and the one it
 * would otherwise report as fine.
 */
// The call, not a mention of it. The comment above that line names the method
// too, and matching on the name alone reported the file as fine with the call
// taken out - which is this check failing at the one thing it is for.
if (!/=>\s*Theme::forgetDerived\(\)/.test(fs.readFileSync(path.join(root, 'src/Support/Held.php'), 'utf8'))) {
    problems.push(
        'src/Support/Held.php  no longer calls Theme::forgetDerived(), so a queue worker '
            + 'keeps every memo worked out from settings',
    );
}

for (const file of walk(src)) {
    const source = fs.readFileSync(file, 'utf8');
    const declared = /^(?:final\s+|abstract\s+)?class\s+(\w+)/m.exec(source);

    if (declared === null) {
        continue;
    }

    const name = declared[1];

    // A static that is assigned a starting value and later written to: a memo.
    // A const is not one, and neither is a static that is only ever read.
    const holds = /(?:private|protected|public)\s+static\s+(?:\??[\w|\\]+\s+)?\$\w+\s*=/.test(source);

    /*
     * Parameterless and returning nothing, which is what a forgetter is.
     *
     * Keys::forget(Key $key) deletes a key and happens to share the name.
     * SystemStatus::refresh(): string returns how often the page reloads and
     * happens to share the other one. Both were reported until the shape was
     * written down properly: no argument, and `: void`.
     */
    const offers = /public\s+static\s+function\s+(?:forget|refresh)\s*\(\s*\)\s*:\s*void/.test(source);

    if (!holds || !offers) {
        continue;
    }

    holders += 1;

    if (cleared.has(name) || Object.prototype.hasOwnProperty.call(ALLOWED, name)) {
        continue;
    }

    problems.push(
        `${path.relative(root, file).replace(/\\/g, '/')}  ${name} holds a memo and offers a way `
            + 'to drop it, and neither forgetter calls it',
    );
}

if (problems.length > 0) {
    console.error(`Memo check: ${problems.length} memo(s) nothing drops.\n`);
    problems.forEach((line) => console.error('  ' + line));
    console.error(
        '\nAdd it to Theme::forgetDerived() when it is worked out from settings, or to\n'
        + 'Held::forget() when it is not, or to ALLOWED in this file with a line saying\n'
        + 'why its answer cannot go stale.',
    );
    process.exit(1);
}

console.log(
    `Memo check: ${holders} class(es) hold a memo, every one of them dropped by a forgetter `
        + `or named as safe.`,
);
