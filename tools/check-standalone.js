/*
 * The three lists that hand a feature to a standalone module say the same thing.
 *
 * A module takes a feature over through three separate places in this plugin,
 * and none of them can see the other two:
 *
 *   Standalone::MODULES          which plugin ids exist, and how each says it is ready
 *   ThemePlugin::supportsStandalone()  which ids this version knows about at all
 *   Standalone::replacesFeature()      which feature each id takes
 *
 * Every one of them is a hand-written list, and a module is only actually
 * handed over when all three agree. Disagreeing is silent in both directions: a
 * module missing from supportsStandalone() refuses to start with a message
 * about updating the legacy plugin, and one missing from replacesFeature()
 * starts perfectly and takes nothing over, so the panel draws both copies.
 *
 * The marker check is the one that has already gone wrong. The marker was
 * picked by a two-way ternary on the id rather than stored per module, which
 * answered correctly only while there were exactly two of them; a third would
 * have been given the second one's readiness, and the legacy would have stood
 * down for a replacement that had not loaded anything.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const standalone = fs.readFileSync(path.join(root, 'src', 'Support', 'Standalone.php'), 'utf8');
const plugin = fs.readFileSync(path.join(root, 'src', 'ThemePlugin.php'), 'utf8');
const features = fs.readFileSync(path.join(root, 'src', 'Support', 'Features.php'), 'utf8');

const problems = [];

/* ------------------------------------------------------------- MODULES -- */

/**
 * What each module id declares: the namespace its plugin row has to carry, and
 * the container binding its Integration sets once it is running.
 */
const modules = new Map();

const holdsStart = standalone.indexOf('private const MODULES = [');

if (holdsStart === -1) {
    problems.push('Standalone has no MODULES list, so nothing can be handed over.');
} else {
    const body = standalone.slice(holdsStart, standalone.indexOf('\n    ];', holdsStart));

    for (const entry of body.matchAll(
        /'([a-z0-9-]+)' => \[\s*'namespace' => '([^']+)',\s*'marker' => '([^']+)',\s*\]/g,
    )) {
        modules.set(entry[1], { namespace: entry[2].replace(/\\\\/g, '\\'), marker: entry[3] });
    }

    // A line inside MODULES that the pattern above did not read is worse than a
    // missing entry: it would be counted as absent everywhere below and the
    // gate would report the opposite of the truth.
    const declared = [...body.matchAll(/^\s{8}'([a-z0-9-]+)' =>/gm)].map((m) => m[1]);

    for (const id of declared) {
        if (!modules.has(id)) {
            problems.push(
                `MODULES lists ${id} in a shape this check cannot read.` +
                    "\n      Expected 'namespace' => and 'marker' => on their own lines.",
            );
        }
    }
}

/**
 * The marker's name is a contract with code in another repository, which this
 * one cannot read. Deriving what it should be from the id is the only way to
 * catch a copied line that kept the previous module's binding.
 */
function expectedMarker(id) {
    return id.replace('-', '.') + '.active';
}

const markers = new Map();

for (const [id, module] of modules) {
    if (module.marker !== expectedMarker(id)) {
        problems.push(
            `${id} is ready when '${module.marker}' is bound, but its module binds ` +
                `'${expectedMarker(id)}'.`,
        );
    }

    if (markers.has(module.marker)) {
        problems.push(
            `${id} and ${markers.get(module.marker)} both read '${module.marker}',` +
                '\n      so whichever loads first answers for both.',
        );

        continue;
    }

    markers.set(module.marker, id);

    if (!module.namespace.startsWith('LegendDevelopment\\Essentials\\')) {
        problems.push(
            `${id} claims the namespace ${module.namespace}, which is not under ` +
                'LegendDevelopment\\Essentials.',
        );
    }
}

/* --------------------------------------------------- supportsStandalone -- */

/*
 * The best answer to two lists that must agree is one list.
 *
 * supportsStandalone() delegates to Standalone::knows(), which reads MODULES, so
 * they cannot disagree and there is nothing here to compare. That is not this
 * check giving up: a module added to one list and not the other refuses to start
 * on every panel that still has this plugin, and the delegation removes the
 * possibility rather than guarding against it.
 *
 * The literal form is still read, because it is the one that can drift, and a
 * third shape that is neither is reported rather than assumed correct.
 */
const delegates = /function supportsStandalone\(string \$id\): bool\s*\{[^}]*Standalone::knows\(\$id\)/.test(plugin);

const supports = new Set();
const supportsMatch = plugin.match(/function supportsStandalone\(string \$id\): bool\s*\{\s*return in_array\(\$id, \[([^\]]*)\]/);

if (!delegates && supportsMatch === null) {
    problems.push(
        'ThemePlugin::supportsStandalone() neither lists the ids nor asks Standalone::knows(),'
            + '\n      so this cannot tell whether a module would be allowed to start.',
    );
}

if (supportsMatch !== null) {
    for (const id of supportsMatch[1].matchAll(/'([a-z0-9-]+)'/g)) {
        supports.add(id[1]);
    }
}

if (!delegates) {
    for (const id of modules.keys()) {
        if (!supports.has(id)) {
            problems.push(
                `${id} is in MODULES and not in supportsStandalone(), so it refuses to start` +
                    '\n      on any panel that still has this plugin enabled.',
            );
        }
    }

    for (const id of supports) {
        if (!modules.has(id)) {
            problems.push(
                `supportsStandalone() names ${id} and MODULES does not, so it starts and` +
                    '\n      this plugin never stands down for it.',
            );
        }
    }
}

/* ------------------------------------------------------ replacesFeature -- */

const replaces = new Map();
const replacesStart = standalone.indexOf('function replacesFeature(');

if (replacesStart === -1) {
    problems.push('Standalone has no replacesFeature(), so no feature is ever handed over.');
} else {
    const whole = standalone.slice(replacesStart, standalone.indexOf('\n    }', replacesStart));

    /*
     * Without the comments, because an arm naming a dozen features is an arm
     * that has to be allowed to explain itself between them.
     *
     * The parser below runs from one Features:: name to the next through
     * whitespace only, so a comment in the middle of an arm ends the run: it
     * took the names after the comment and dropped the ones before it, and
     * said nothing. The count this gate prints went from 43 to 37 the day the
     * shop, the API and the game pages were handed over with a paragraph each
     * saying why.
     */
    const body = whole.replace(/\/\*[\s\S]*?\*\//g, '').replace(/\/\/[^\n]*/g, '');

    /*
     * One arm may name several features.
     *
     * A match arm in PHP takes a comma-separated list of conditions, and the
     * appearance module uses one: it does not take a feature over, it takes the
     * look, the panel pages, the advanced block, the navigation links and the
     * sign-in screen, all at once. This read only single-feature arms, so it saw
     * the last name in that list and none of the four above it, and reported
     * three features handed over where there were seven. Four features could
     * have been named here, never checked against Features.php, and quietly
     * dropped from the count this line prints.
     *
     * And one arm may name several owners.
     *
     * A feature that moved from one module to another is handed over to either
     * while a panel is midway, `self::owns('a') || self::owns('b')`, and each
     * of those modules takes it as far as this check is concerned.
     */
    let armsRead = 0;

    for (const arm of body.matchAll(
        /((?:Features::[A-Z_]+\s*,\s*)*Features::[A-Z_]+)\s*=>\s*((?:self::owns\('[a-z0-9-]+'\)\s*\|\|\s*)*self::owns\('[a-z0-9-]+'\))/g,
    )) {
        const named = [...arm[1].matchAll(/Features::([A-Z_]+)/g)].map((m) => m[1]);

        armsRead += named.length;

        for (const owner of arm[2].matchAll(/self::owns\('([a-z0-9-]+)'\)/g)) {
            if (!replaces.has(owner[1])) {
                replaces.set(owner[1], []);
            }

            replaces.get(owner[1]).push(...named);
        }
    }

    /*
     * And whether that read the whole method.
     *
     * Everything above trusts one regular expression to see every arm, and the
     * failure mode when it does not is the quiet one: a feature named in the
     * file, never checked against Features.php, never counted, and drawn twice
     * on any panel running both plugins. Counting the names the regex found
     * against every name in the method is the one question it can ask about
     * itself.
     */
    const all = [...body.matchAll(/Features::([A-Z_]+)/g)].map((m) => m[1]);
    const read = [...replaces.values()].flat();

    if (all.length !== armsRead) {
        const missed = all.filter((name) => !read.includes(name));

        problems.push(
            `replacesFeature() names ${all.length} feature(s) and this check read ${armsRead}.` +
                `\n      Unread: ${missed.join(', ') || 'none by name, so one is named twice'}` +
                '\n      The arm parser has stopped matching the way that method is written.',
        );
    }
}

/** Every feature this plugin declares, so an arm cannot name one that is gone. */
const declaredFeatures = new Set(
    [...features.matchAll(/public const ([A-Z_]+) = '[a-z0-9_]+';/g)].map((m) => m[1]),
);

for (const [id, taken] of replaces) {
    if (!modules.has(id)) {
        problems.push(`replacesFeature() hands ${taken.join(', ')} to ${id}, which is not in MODULES.`);
    }

    for (const feature of taken) {
        if (!declaredFeatures.has(feature)) {
            problems.push(`replacesFeature() names Features::${feature}, which does not exist.`);
        }
    }
}

/*
 * The modules that are installed and deliberately take nothing over.
 *
 * Read from the constant rather than listed here, so the exception lives beside
 * the thing it excepts. A shell with no page, no route and no render hook draws
 * nothing, so nothing is drawn twice; the day one of them starts drawing, its
 * id comes off that list and this asks for its features like every other.
 */
const coexistBlock = standalone.match(/const COEXIST = \[([\s\S]*?)\];/);

const coexist = new Set(
    coexistBlock ? [...coexistBlock[1].matchAll(/'([a-z0-9-]+)'/g)].map((m) => m[1]) : [],
);

for (const id of coexist) {
    if (!modules.has(id)) {
        problems.push(`COEXIST names ${id}, which is not in MODULES, so nothing loads it either way.`);
    }

    if (replaces.has(id)) {
        problems.push(
            `${id} is in COEXIST and takes ${[...replaces.get(id)].join(', ')}.`
                + '\n      A module that has started drawing is no longer one that draws nothing;'
                + '\n      take it off COEXIST.',
        );
    }
}

for (const id of modules.keys()) {
    if (!replaces.has(id) && !coexist.has(id)) {
        problems.push(
            `${id} is in MODULES and takes no feature, so it loads beside this plugin` +
                '\n      and both draw the same thing. If that is deliberate for now, say so' +
                '\n      by adding it to Standalone::COEXIST.',
        );
    }
}

/* ------------------------------------------------------------------------ */

if (problems.length > 0) {
    console.error(`Standalone check: ${problems.length} problem(s).\n`);
    problems.forEach((line) => console.error('  ' + line));
    process.exit(1);
}

const taken = new Set([...replaces.values()].flat()).size;

console.log(
    `Standalone check: ${modules.size} module(s) with a marker each, taking ${taken} feature(s).`,
);
