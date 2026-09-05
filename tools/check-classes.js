/*
 * One short name, one namespace, across the whole plugin.
 *
 * This exists because of a class that does not exist.
 *
 * A new page imported Filament\Schemas\Components\Repeater. The real one is
 * Filament\Forms\Components\Repeater, and every other file here already said
 * so - four of them. The wrong import is perfectly well formed: it parses, it
 * is namespaced, and check-imports.js is satisfied by it. It fails at the
 * moment Filament reflects on the class to build the navigation, which is on
 * every page of the admin panel, as a 500.
 *
 * There is no vendor directory to check an import against, so this cannot ask
 * whether a class is real. What it can ask is whether this codebase has made up
 * its mind - and it turns out that is nearly as good, because the mistake is
 * almost always a name being written from memory in one place while four others
 * have it right.
 *
 * Two names are allowed to disagree and are listed below. Both are cases where
 * two genuinely different classes share a short name, which is the thing an
 * alias exists for.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

/*
 * Only within one vendor, and never within this plugin's own namespace.
 *
 * The first version of this flagged three things, and all three were correct
 * code: App\Models\Plugin beside Filament\Contracts\Plugin, and two of this
 * plugin's own pairs where a support class and the page that draws it share a
 * name on purpose. A check that is right about the mechanism and wrong about
 * every instance is one somebody switches off in a week.
 *
 * The real signal is narrower than "two namespaces". It is **the same vendor,
 * two paths** - Filament\Forms\Components\Repeater against
 * Filament\Schemas\Components\Repeater - because that is what writing a path
 * from memory produces. Two different vendors sharing a short name are two
 * different libraries, which is ordinary.
 *
 * And this plugin's own classes are skipped entirely. Those files are in this
 * repository, so a name that does not exist is a name lint-php never parsed -
 * the risk being checked for here is specifically a path into somebody else's
 * package that cannot be verified from inside this repository.
 */
const OURS = 'LegendDevelopment';

/** Short names where one vendor genuinely publishes two, so the check is off. */
const ALLOWED = new Set([]);

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

/** short name => { fqcn => [files] } */
const seen = new Map();
let imports = 0;

for (const file of files(path.join(root, 'src'))) {
    const source = fs.readFileSync(file, 'utf8');
    const relative = path.relative(root, file).split(path.sep).join('/');

    for (const match of source.matchAll(/^use\s+([A-Za-z_][\w\\]*)(?:\s+as\s+(\w+))?\s*;/gm)) {
        const fqcn = match[1];

        // An alias is a deliberate statement that this name means something
        // else here, which is the opposite of the mistake being looked for.
        if (match[2]) {
            continue;
        }

        imports += 1;

        const short = fqcn.split('\\').pop();
        const root = fqcn.split('\\')[0];

        if (ALLOWED.has(short) || root === OURS) {
            continue;
        }

        if (!seen.has(short)) {
            seen.set(short, new Map());
        }

        const places = seen.get(short);

        if (!places.has(fqcn)) {
            places.set(fqcn, []);
        }

        places.get(fqcn).push(relative);
    }
}

const problems = [];

for (const [short, places] of seen) {
    if (places.size < 2) {
        continue;
    }

    // Two vendors publishing a class of the same name is two libraries, not a
    // mistake. Only one vendor disagreeing with itself is worth reporting.
    const roots = new Set([...places.keys()].map((fqcn) => fqcn.split('\\')[0]));

    if (roots.size > 1) {
        continue;
    }

    /*
     * The odd one out is named, not just the disagreement.
     *
     * Nearly always one file has it wrong and several have it right, so saying
     * which is which turns a puzzle into a one-line fix.
     */
    const ranked = [...places.entries()].sort((a, b) => b[1].length - a[1].length);

    problems.push({ short, ranked });
}

if (problems.length > 0) {
    console.error('Class name check: ' + problems.length + ' name'
        + (problems.length === 1 ? '' : 's') + ' imported from more than one namespace.\n');

    for (const { short, ranked } of problems) {
        console.error('  ' + short + ':');

        for (const [fqcn, where] of ranked) {
            console.error('    ' + fqcn + '  (' + where.length + ') ' + where.join(', '));
        }
    }

    console.error(
        '\nOne of these is a class that does not exist. A wrong import parses, is'
        + '\nnamespaced, and satisfies check-imports - it fails when Filament reflects on'
        + '\nit to build the navigation, as a 500 on every page of the panel.'
        + '\n\nIf two genuinely different classes share a name, alias one of them or add the'
        + '\nname to ALLOWED in tools/check-classes.js.',
    );

    process.exit(1);
}

console.log('Class name check: ' + imports + ' imports, no name means two things.');
