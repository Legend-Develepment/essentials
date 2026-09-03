/*
 * Every Theme::trans() key must exist in lang/en.
 *
 * Written after two keys shipped that did not, and rendered on screen as their
 * own names: `essentials::servers.favourites_tab` in the server-list tab bar,
 * and `essentials::settings.groups.minecraft` as the heading of the Minecraft
 * tab. Laravel's trans() returns the key when it cannot resolve it, so a wrong
 * key is not an error anywhere - it is a label that reads like a stack trace,
 * and only where somebody happens to look.
 *
 * Two of the four broken keys had been wrong since the favourites feature
 * shipped. They were tooltips, so nothing ever showed them plainly and nobody
 * noticed. That is the argument for checking this at build time rather than
 * trusting a walk through the panel.
 *
 * Only literal keys are checked. A key built at runtime - 'settings.channel.' .
 * $name - cannot be resolved from here, and guessing at what the variable might
 * hold would produce failures that are not real. Those are listed at the end so
 * the number is known rather than merely absent.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const langDir = path.join(root, 'lang', 'en');

/* ------------------------------------------------------- what exists ----- */

/*
 * Read the arrays without running PHP.
 *
 * Only the keys matter, so this walks the file tracking bracket depth and the
 * key at each level. It handles the escaped apostrophes these files are full of
 * ('person\'s own choice'), which is the one thing a naive match gets wrong.
 */
function keysOf(file) {
    const source = fs.readFileSync(file, 'utf8');
    const found = new Set();
    const stack = [];

    let i = 0;
    let pendingKey = null;

    while (i < source.length) {
        const char = source[i];

        // Skip comments so a key named in prose is not taken for a real one.
        if (char === '/' && source[i + 1] === '*') {
            const end = source.indexOf('*/', i + 2);
            i = end === -1 ? source.length : end + 2;
            continue;
        }

        if (char === '/' && source[i + 1] === '/') {
            const end = source.indexOf('\n', i);
            i = end === -1 ? source.length : end + 1;
            continue;
        }

        if (char === "'" || char === '"') {
            const quote = char;
            let value = '';
            i += 1;

            while (i < source.length) {
                if (source[i] === '\\') {
                    value += source[i + 1] ?? '';
                    i += 2;
                    continue;
                }

                if (source[i] === quote) {
                    i += 1;
                    break;
                }

                value += source[i];
                i += 1;
            }

            // A string is a key only when what follows it is `=>`.
            const rest = source.slice(i, i + 4);

            if (/^\s*=>/.test(rest)) {
                pendingKey = value;
            }

            continue;
        }

        if (char === '[') {
            stack.push(pendingKey);
            pendingKey = null;
            i += 1;
            continue;
        }

        if (char === ']') {
            stack.pop();
            i += 1;
            continue;
        }

        if (char === ',' || char === ';') {
            if (pendingKey !== null) {
                const parts = [...stack.filter((part) => part !== null), pendingKey];
                found.add(parts.join('.'));
                pendingKey = null;
            }

            i += 1;
            continue;
        }

        i += 1;
    }

    // A nested array's own name is a resolvable key too - trans('settings.groups')
    // returns the array - but nothing here does that, so only leaves count.
    return found;
}

function keysIn(dir) {
    const found = new Set();

    for (const file of fs.readdirSync(dir).filter((name) => name.endsWith('.php'))) {
        const group = path.basename(file, '.php');

        for (const key of keysOf(path.join(dir, file))) {
            found.add(group + '.' + key);
        }
    }

    return found;
}

const available = keysIn(langDir);

/*
 * Every other language, against English.
 *
 * Two different things are checked and only one of them is a failure.
 *
 * A key that exists in a translation but not in English is a mistake: nothing
 * will ever ask for it, so it is dead weight at best, and at worst it is a
 * misspelling of a key that therefore never got translated at all - which looks
 * exactly like a translation that was simply not done yet. That fails the build.
 *
 * A key missing from a translation is not a mistake. Laravel falls back per key,
 * so a half-finished language is half in that language and half in English, and
 * works. The percentage is printed rather than enforced, because enforcing it
 * would mean no language could be added until it was finished.
 */
const translations = [];
const strays = [];

for (const entry of fs.readdirSync(path.join(root, 'lang'), { withFileTypes: true })) {
    if (!entry.isDirectory() || entry.name === 'en') {
        continue;
    }

    const theirs = keysIn(path.join(root, 'lang', entry.name));
    const done = [...theirs].filter((key) => available.has(key)).length;

    for (const key of theirs) {
        if (!available.has(key)) {
            strays.push(entry.name + '  ' + key);
        }
    }

    translations.push(
        entry.name + ' ' + Math.round(done / available.size * 100) + '% (' + done + '/' + available.size + ')',
    );
}

if (strays.length > 0) {
    console.error('Language check: ' + strays.length + ' translated key(s) that English does not have.\n');

    for (const entry of strays) {
        console.error('  ' + entry);
    }

    console.error('\nNothing will ever ask for these. Most often it is a misspelling of a real');
    console.error('key, which means that key is not actually translated and looks as though it');
    console.error('merely has not been done yet.');
    process.exit(1);
}

/* ------------------------------------------------------- what is used ---- */

function walk(dir, out = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
        } else if (/\.(php|blade\.php|js)$/.test(entry.name)) {
            out.push(full);
        }
    }

    return out;
}

const sources = [
    ...walk(path.join(root, 'src')),
    ...walk(path.join(root, 'resources', 'views')),
];

const missing = [];
let dynamic = 0;
let checked = 0;

for (const file of sources) {
    const source = fs.readFileSync(file, 'utf8');
    const pattern = /Theme::trans\(\s*(['"])([^'"]*)\1(\s*\.)?/g;

    let match;

    while ((match = pattern.exec(source)) !== null) {
        // trans('settings.channel.' . $name) - the literal is a prefix, not a
        // key. So is trans("settings.areas.names.{$area}"), where the variable
        // is interpolated rather than concatenated and the string therefore
        // looks complete.
        if (match[3] || match[2].includes('$')) {
            dynamic += 1;
            continue;
        }

        checked += 1;

        if (!available.has(match[2])) {
            const line = source.slice(0, match.index).split('\n').length;

            missing.push(`${path.relative(root, file)}:${line}  ${match[2]}`);
        }
    }
}

/* ---------------------------------------------- the settings headings ---- */

/*
 * group('minecraft', ...) builds `settings.groups.minecraft` inside a helper,
 * so the pass above sees a prefix and a variable and rightly says nothing.
 *
 * That is the one dynamic key worth resolving by hand, because it is how every
 * heading on every settings page is written and because it is the one that got
 * through: the Minecraft tab shipped titled `essentials::settings.groups.
 * minecraft`. The literal is right there in the call - only the joining is
 * dynamic.
 */
for (const file of sources) {
    const source = fs.readFileSync(file, 'utf8');
    const pattern = /\bgroup\(\s*'([a-z_]+)'/g;

    let match;

    while ((match = pattern.exec(source)) !== null) {
        const key = 'settings.groups.' + match[1];

        checked += 1;

        if (!available.has(key)) {
            const line = source.slice(0, match.index).split('\n').length;

            missing.push(`${path.relative(root, file)}:${line}  ${key}`);
        }
    }
}

if (missing.length > 0) {
    console.error('Language check: ' + missing.length + ' key(s) with nothing behind them.\n');

    for (const entry of missing) {
        console.error('  ' + entry);
    }

    console.error('\nLaravel renders an unresolved key as its own name, so each of these');
    console.error('is a label that reads like "essentials::group.key" on somebody\'s screen.');
    process.exit(1);
}

console.log(
    'Language check: ' + checked + ' keys resolved, ' +
    available.size + ' defined, ' + dynamic + ' built at runtime and not checkable.' +
    (translations.length > 0 ? '\n  Translations: ' + translations.join(', ') : ''),
);
