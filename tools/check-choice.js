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

/*
 * And an English sentence that carries :count has to say when.
 *
 * The rule above only looks at strings with a bar in them, which means it can
 * only catch a counting sentence that already knows it is one. A sentence
 * written with no bar at all is invisible to it - and that is how
 * "1 scheduled tasks have stopped" went out to a Discord channel, and how
 * "Still going after 1 hours" would have followed it.
 *
 * Not every :count is a sentence. ":count left" under a package, ":count min"
 * on a player row and "of :count ordered" in a table column are fragments with
 * no verb to agree with and no article to get wrong, and writing conditions for
 * them would be noise. Those are named below, one line each, and the list only
 * shrinks: anything not on it has to count properly.
 *
 * The "(s)" forms are on it too, and they are a different thing again - a
 * deliberate dodge in a sentence long enough that two halves would mean
 * translating a paragraph twice. They are honest and they are not pretty; if
 * one is ever rewritten it comes off this list.
 */
const FRAGMENTS = new Set([
    // No verb, no article: a number with its unit, in a cell or beside a name.
    'capacity.servers',
    'coupons.some_packages',
    'coupons.some_users',
    'customers.of_orders',
    'gameplayers.count',
    'gameplayers.minutes',
    'gameplayers.hours',
    'invoices.order_count',
    'invoices.attempts_open',
    'overview.stock_left',
    'packages.column_flags_from',
    'packages.stock_left',
    'shop.public_count',
    'shop.offer_from',
    'alerts.and_more',
    'mybackups.and_more',
    'portable.summary_more',

    /*
     * Handed to the browser as a template and filled in there, so a bar would
     * be printed rather than picked - status.blade.php does words.ago.replace().
     * It also cannot be one: that line only draws from five seconds up, and
     * anything under it says "just now" instead.
     */
    'status.seconds_ago',

    // Written with "(s)" on purpose, in sentences too long to say twice.
    'addons.delete_sold',
    'alerts.failed_body',
    'overview.recurring_note',
    'overview.attention_pending',
    'packages.delete_confirm_sold',
    'packages.deleted_sold',
]);

for (const [group, values] of english) {
    for (const [key, value] of values) {
        if (!value.includes(':count') || value.includes('|')) {
            continue;
        }

        if (FRAGMENTS.has(group + '.' + key)) {
            continue;
        }

        problems.push(
            `en/${group}.${key} carries :count and never says when - ` +
                'write it as "{1} one|[2,*] :count many", or name it a fragment in check-choice.js',
        );
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

/*
 * And a counting sentence read with trans() prints itself, bar and all.
 *
 * Theme::trans() hands back the whole stored string; only Theme::choice() picks
 * a half. The modules page shipped its card headings as trans() and drew
 * "{1} 3 of 14 part on|[2,*] 3 of 14 parts on" on screen, which is the second
 * time this has happened here - the first was the watchdog telling an owner
 * their node was down. Nothing else notices: the key resolves, every language
 * has it, and the page renders.
 */
const counting = new Set();

for (const [group, values] of english) {
    for (const [key, value] of values) {
        if (value.includes('|')) {
            counting.add(group + '.' + key);
        }
    }
}

const sources = [];

(function walk(dir) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full);
            continue;
        }

        if (entry.name.endsWith('.php')) {
            sources.push(full);
        }
    }
})(path.join(root, 'src'));

walk_views: {
    const views = path.join(root, 'resources', 'views');

    if (fs.existsSync(views)) {
        (function walk(dir) {
            for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
                const full = path.join(dir, entry.name);

                if (entry.isDirectory()) {
                    walk(full);
                    continue;
                }

                if (entry.name.endsWith('.blade.php')) {
                    sources.push(full);
                }
            }
        })(views);
    }

    break walk_views;
}

let reads = 0;

for (const file of sources) {
    const source = fs.readFileSync(file, 'utf8');

    for (const match of source.matchAll(/Theme::trans\(\s*'([^']+)'/g)) {
        reads += 1;

        if (counting.has(match[1])) {
            const line = source.slice(0, match.index).split('\n').length;

            problems.push(
                `${path.relative(root, file)}:${line} reads ${match[1]} with trans() - ` +
                    'it counts, so it needs Theme::choice()',
            );
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
        `${checked} translated string(s), none missing a placeholder; ` +
        `${reads} plain read(s), none of them of a counting key.`,
);
