/*
 * The stylesheets are one file per part, and no two of them style the same thing.
 *
 * They were one 272 KB theme.css holding every part of this plugin, which meant
 * that extracting any part into a plugin of its own started with a selector
 * audit rather than a file move. Split by owner, that becomes a copy.
 *
 * What made the split safe is the thing this checks: while everything sat in
 * one file the last rule won, and once each part ships its own file the loading
 * order decides instead - and that order is not the same one. A selector styled
 * from two files could therefore flip. At the time of the split there were none
 * across 1,147 selectors, and a new one would flip silently, so it is worth a
 * gate rather than a comment.
 *
 * It also holds the list in ThemeServiceProvider against what is on disk. A
 * file that is never emitted is a part of the panel that stops being drawn, and
 * an emitted file that does not exist is a Vite build that fails.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const cssDir = path.join(root, 'resources', 'css');
const provider = fs.readFileSync(path.join(root, 'src', 'Providers', 'ThemeServiceProvider.php'), 'utf8');

const problems = [];

/* ------------------------------------------------- what is emitted, in order -- */

const listed = [];
const start = provider.indexOf('private const STYLESHEETS = [');

if (start === -1) {
    problems.push('ThemeServiceProvider has no STYLESHEETS list, so nothing says what to emit.');
} else {
    for (const match of provider.slice(start, provider.indexOf('];', start)).matchAll(/'([^']+\.css)'/g)) {
        listed.push(match[1]);
    }
}

// The look defines the tokens every other file reads, so it cannot arrive after
// one of them.
if (listed.length > 0 && listed[0] !== 'theme.css') {
    problems.push(
        `theme.css holds the tokens the others read and is emitted ${listed.indexOf('theme.css') === -1 ? 'not at all' : 'after ' + listed[0]}.`,
    );
}

const onDisk = fs.readdirSync(cssDir).filter((name) => name.endsWith('.css')).sort();

for (const file of listed) {
    if (!onDisk.includes(file)) {
        problems.push(`STYLESHEETS emits ${file}, which is not in resources/css.`);
    }
}

for (const file of onDisk) {
    if (!listed.includes(file)) {
        problems.push(
            `resources/css/${file} is never emitted, so nothing it styles is drawn.` +
                '\n      Add it to ThemeServiceProvider::STYLESHEETS or delete it.',
        );
    }
}

/* --------------------------------------------- nothing styled from two files -- */

/**
 * Every selector a file styles, media queries included.
 *
 * Nesting is walked rather than skipped: a rule inside @media is still a rule,
 * and a responsive override is exactly the kind that would be written twice.
 */
function selectorsIn(css) {
    const found = new Set();

    // Comments out first. A selector is whatever sits between the previous
    // closing brace and the next opening one, and a comment in that gap would
    // otherwise be read as part of the name.
    (function walk(text) {
        let depth = 0;
        let open = 0;

        for (let i = 0; i < text.length; i++) {
            if (text[i] === '{') {
                if (depth === 0) {
                    open = i;
                }

                depth += 1;
            } else if (text[i] === '}') {
                depth -= 1;

                if (depth !== 0) {
                    continue;
                }

                const before = text.slice(0, open);
                const head = before.slice(before.lastIndexOf('}') + 1).trim().replace(/\s+/g, ' ');
                const body = text.slice(open + 1, i);

                if (head.startsWith('@')) {
                    // Keep the condition with what is inside it: the same
                    // selector under two different widths is two selectors.
                    for (const inner of selectorsIn(body)) {
                        found.add(head + ' { ' + inner);
                    }

                    continue;
                }

                for (const one of head.split(',')) {
                    const clean = one.trim();

                    if (clean !== '') {
                        found.add(clean);
                    }
                }
            }
        }
    })(css);

    return found;
}

const owners = new Map();
let total = 0;

for (const file of onDisk) {
    const selectors = selectorsIn(
        fs.readFileSync(path.join(cssDir, file), 'utf8').replace(/\/\*[\s\S]*?\*\//g, ''),
    );

    total += selectors.size;

    for (const selector of selectors) {
        if (owners.has(selector)) {
            problems.push(
                `${selector.length > 70 ? selector.slice(0, 67) + '...' : selector}` +
                    `\n      is styled from both ${owners.get(selector)} and ${file}.` +
                    '\n      Which one wins depends on the loading order, which changes when' +
                    '\n      either becomes a plugin of its own. Put it in one file.',
            );

            continue;
        }

        owners.set(selector, file);
    }
}

/* ------------------------------------------------------------------------- */

if (problems.length > 0) {
    console.error(`Stylesheet check: ${problems.length} problem(s).\n`);
    problems.forEach((line) => console.error('  ' + line));
    process.exit(1);
}

console.log(
    `Stylesheet check: ${listed.length} file(s) emitted in order, ` +
        `${owners.size} selector(s) each styled from one of them.`,
);
