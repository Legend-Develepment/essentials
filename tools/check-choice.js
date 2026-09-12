/*
 * Counting sentences, and the placeholders a translation is not allowed to drop.
 *
 * Two things that go wrong quietly, both of them found on a panel that reported
 * every language at a hundred per cent.
 *
 * A choice string written as "one|many" leaves the pick to the locale's plural
 * index, and the index is not two everywhere. Turkish has one form, so it never
 * reaches the half after the bar and says "one of your servers is offline" for
 * nine of them. Russian has three, so the index runs off the end of a two part
 * message and Laravel falls back to the first - the singular - for five, eleven
 * and twenty-one. Written with conditions, {1} and [2,*], the message answers
 * for itself and no rule comes into it.
 *
 * And a placeholder that only English has is a sentence that was rewritten on
 * one side. orders.cancel_confirm gained a :date when cancelling learned to
 * name the day the server goes; thirty translations kept the old sentence, which
 * said the opposite - that the server is left standing. Both files parsed, every
 * key resolved, and the language check read a hundred per cent.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const langs = path.join(root, 'lang');

/**
 * Key to value, for one file.
 *
 * The same scan check-lang.js uses to find keys, kept to the point where the
 * value is still in hand. Nested arrays join with a dot, comments are skipped so
 * a key named in prose is not read as a real one, and anything that is not a
 * plain string - a number, a nested array's own name - is left out.
 */
function valuesOf(file) {
    const source = fs.readFileSync(file, 'utf8');
    const found = new Map();
    const stack = [];

    let i = 0;
    let pendingKey = null;
    let pendingValue = null;

    while (i < source.length) {
        const char = source[i];

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

            if (/^\s*=>/.test(source.slice(i, i + 4))) {
                pendingKey = value;
                pendingValue = null;
            } else if (pendingKey !== null) {
                pendingValue = value;
            }

            continue;
        }

        if (char === '[') {
            stack.push(pendingKey);
            pendingKey = null;
            pendingValue = null;
            i += 1;
            continue;
        }

        if (char === ']') {
            stack.pop();
            i += 1;
            continue;
        }

        if (char === ',' || char === ';') {
            if (pendingKey !== null && pendingValue !== null) {
                found.set([...stack.filter((part) => part !== null), pendingKey].join('.'), pendingValue);
            }

            pendingKey = null;
            pendingValue = null;
            i += 1;
            continue;
        }

        i += 1;
    }

    return found;
}

function groupsIn(locale) {
    const dir = path.join(langs, locale);

    if (!fs.existsSync(dir)) {
        return new Map();
    }

    const out = new Map();

    for (const name of fs.readdirSync(dir)) {
        if (name.endsWith('.php')) {
            out.set(name.slice(0, -4), valuesOf(path.join(dir, name)));
        }
    }

    return out;
}

const locales = fs
    .readdirSync(langs)
    .filter((name) => name !== 'en' && fs.statSync(path.join(langs, name)).isDirectory())
    .sort();

const english = groupsIn('en');
const problems = [];

let choices = 0;
let checked = 0;

// A bar means a count decides which half is read, so the halves must say when.
for (const [locale, groups] of [['en', english], ...locales.map((l) => [l, groupsIn(l)])]) {
    for (const [group, values] of groups) {
        for (const [key, value] of values) {
            if (!value.includes('|')) {
                continue;
            }

            choices += 1;

            if (!/^\s*[{[]/.test(value)) {
                problems.push(
                    `${locale}/${group}.${key} counts without conditions - write it as "{1} one|[2,*] :count many"`,
                );
            }
        }
    }
}

// And a placeholder English carries is a thing the sentence promises to say.
const holders = (value) => new Set((value.match(/:[a-zA-Z][a-zA-Z0-9_]*/g) ?? []).map((h) => h.slice(1)));

for (const locale of locales) {
    const groups = groupsIn(locale);

    for (const [group, values] of english) {
        const theirs = groups.get(group);

        if (theirs === undefined) {
            continue;
        }

        for (const [key, value] of values) {
            const mine = theirs.get(key);

            if (mine === undefined) {
                continue;
            }

            checked += 1;

            const missing = [...holders(value)].filter((name) => !holders(mine).has(name));

            if (missing.length > 0) {
                problems.push(`${locale}/${group}.${key} never says :${missing.join(', :')}`);
            }
        }
    }
}

if (problems.length > 0) {
    console.error(`Choice check: ${problems.length} problem(s).`);
    problems.forEach((line) => console.error('  ' + line));
    process.exit(1);
}

console.log(
    `Choice check: ${choices} counting sentence(s), all with conditions; ` +
        `${checked} translated string(s), none missing a placeholder.`,
);
