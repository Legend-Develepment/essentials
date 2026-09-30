/*
 * Every feature is in exactly one module, and every module is offered.
 *
 * The modules page draws what `Modules::HOLDS` says it holds. A feature that is
 * in no module is one the page never offers, which is the old problem in a new
 * shape: a switch that exists and cannot be found. There were fifty-three of
 * them in one alphabetical list precisely because nothing made anybody put a
 * new one anywhere.
 *
 * A feature in two modules is the other half: it would be drawn twice, and
 * switching it in one place would silently move it in the other.
 *
 * And a module named in ALL but holding nothing draws an empty card, while one
 * that holds something and is not in ALL is a group of switches that cannot be
 * reached at all.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const modules = fs.readFileSync(path.join(root, 'src', 'Support', 'Modules.php'), 'utf8');
const features = fs.readFileSync(path.join(root, 'src', 'Support', 'Features.php'), 'utf8');

/** Every feature this plugin declares, by constant name. */
const declared = new Set();

for (const match of features.matchAll(/public const ([A-Z_]+) = '[a-z0-9_]+';/g)) {
    declared.add(match[1]);
}

/** The module constants, so a typo in HOLDS is not read as a new module. */
const moduleNames = new Set();

for (const match of modules.matchAll(/public const ([A-Z_]+) = '[a-z]+';/g)) {
    if (match[1] !== 'ON' && match[1] !== 'PART' && match[1] !== 'OFF') {
        moduleNames.add(match[1]);
    }
}

/** What ALL offers. */
function listed(name) {
    const start = modules.indexOf(`const ${name} = [`);

    if (start === -1) {
        return [];
    }

    return [...modules.slice(start, modules.indexOf('];', start)).matchAll(/self::([A-Z_]+)/g)]
        .map((m) => m[1]);
}

const offered = listed('ALL');

/** Which features each module holds, from the HOLDS block. */
const holds = new Map();
const holdsStart = modules.indexOf('private const HOLDS = [');
const holdsBody = holdsStart === -1 ? '' : modules.slice(holdsStart, modules.indexOf('\n    ];', holdsStart));

for (const block of holdsBody.matchAll(/self::([A-Z_]+) => \[([^\]]*)\]/g)) {
    holds.set(block[1], [...block[2].matchAll(/Features::([A-Z_]+)/g)].map((m) => m[1]));
}

const problems = [];
const seen = new Map();

for (const [module, inside] of holds) {
    if (!moduleNames.has(module)) {
        problems.push(`HOLDS names ${module}, which is not a module constant`);
    }

    if (!offered.includes(module)) {
        problems.push(`${module} holds ${inside.length} feature(s) and is not in ALL, so nothing offers it`);
    }

    for (const feature of inside) {
        if (!declared.has(feature)) {
            problems.push(`${module} holds ${feature}, which is not a feature`);
            continue;
        }

        if (seen.has(feature)) {
            problems.push(`${feature} is in both ${seen.get(feature)} and ${module}`);
            continue;
        }

        seen.set(feature, module);
    }
}

for (const module of offered) {
    if (!holds.has(module)) {
        problems.push(`${module} is offered and holds nothing, so its card would be empty`);
    }
}

for (const feature of declared) {
    if (!seen.has(feature)) {
        problems.push(`${feature} is in no module, so the modules page would never offer it`);
    }
}

/*
 * And what a switched-off part leaves behind has to have words for it.
 *
 * Leftovers::WATCHED is a list keyed by feature, and the card builds its
 * translation key at runtime - 'modules.left_' . $feature - which is exactly
 * the shape check-lang.js says in its own header it cannot follow. Add a
 * sixth leftover without a sentence and the card draws the key itself at
 * somebody, in the one place the panel is supposed to be explaining itself.
 */
const leftovers = fs.readFileSync(path.join(root, 'src', 'Support', 'Leftovers.php'), 'utf8');

/** The features named inside one of Leftovers' lists. */
function leftoverList(name) {
    const start = leftovers.indexOf(`const ${name} = [`);

    if (start === -1) {
        return [];
    }

    const body = leftovers.slice(start, leftovers.indexOf('];', start));

    return [...body.matchAll(/Features::([A-Z_]+)/g)].map((m) => m[1]);
}

const words = fs.readFileSync(path.join(root, 'lang', 'en', 'modules.php'), 'utf8');
const watched = leftoverList('WATCHED');

for (const feature of watched) {
    const key = features.match(new RegExp(`public const ${feature} = '([a-z0-9_]+)';`));

    if (key === null) {
        problems.push(`Leftovers watches ${feature}, which is not a feature.`);

        continue;
    }

    if (!words.includes(`'left_${key[1]}'`)) {
        problems.push(
            `Leftovers watches ${feature} and lang/en/modules.php has no left_${key[1]}.` +
                '\n      The card would draw the key itself as a sentence.',
        );
    }
}

for (const feature of leftoverList('CLEARS')) {
    if (!watched.includes(feature)) {
        problems.push(
            `Leftovers clears ${feature} without watching it, so nothing would ever offer the button.`,
        );
    }
}

if (problems.length > 0) {
    console.error(`Module check: ${problems.length} problem(s).\n`);
    problems.forEach((line) => console.error('  ' + line));
    process.exit(1);
}

console.log(
    `Module check: ${declared.size} features across ${holds.size} modules, each in exactly one.`,
);
