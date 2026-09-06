/*
 * Every feature in Features::ALL has a label and a description in lang/en.
 *
 * check-lang.js cannot see these. It reads Theme::trans() calls with a literal
 * key, and these two are built in a loop:
 *
 *     $options[$key] = Theme::trans('settings.features.' . $key);
 *
 * So the keys exist only at runtime, and the gate that would have caught a
 * missing one reports them as "built at runtime and not checkable" instead.
 *
 * It shipped, of course. Five features - the egg artwork, the alerts, the
 * backups overview, the public status page and the players page - had their
 * label and helper written into settings.pages and never into
 * settings.features, so the checkbox list on the Theme settings page offered
 * five rows reading "essentials::settings.features.artwork" and the like. They
 * were in that state for five releases, because every one of those features was
 * added by somebody who wrote the sidebar row's label and stopped.
 *
 * This is the same trick as sanitise.test.js: read the list out of the PHP
 * rather than keeping a copy here, so a feature added tomorrow is checked
 * tomorrow without anybody remembering this file exists.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

/* ------------------------------------------------- what the plugin has -- */

const features = read('src/Support/Features.php');

// public const LOOK = 'look';
const constants = {};

for (const m of features.matchAll(/public const ([A-Z_0-9]+) = '([a-z_0-9]+)';/g)) {
    constants[m[1]] = m[2];
}

const all = features.match(/public const ALL = \[([\s\S]*?)\];/);

if (all === null) {
    console.error('check-features: Features::ALL is not where this expects it.');
    console.error('If it has been renamed or reshaped, this gate needs the new shape -');
    console.error('it must not be deleted, or five labels go missing again.');
    process.exit(1);
}

const keys = [];

for (const m of all[1].matchAll(/self::([A-Z_0-9]+)/g)) {
    const key = constants[m[1]];

    if (key === undefined) {
        console.error('check-features: Features::ALL names self::' + m[1] + ', which is not a constant here.');
        process.exit(1);
    }

    keys.push(key);
}

if (keys.length === 0) {
    console.error('check-features: read Features::ALL and found nothing in it.');
    process.exit(1);
}

/* --------------------------------------------------- what English says -- */

const settings = read('lang/en/settings.php');

/*
 * The 'features' block only, not the whole file.
 *
 * That distinction is the entire fault: every one of the five missing keys was
 * present in the file, under 'pages', which is a different block for a
 * different purpose. A grep of the whole file would have said all five were
 * fine.
 */
const block = settings.match(/\n    'features' => \[([\s\S]*?)\n    \],/);

if (block === null) {
    console.error("check-features: no 'features' block in lang/en/settings.php.");
    process.exit(1);
}

const defined = new Set();

for (const m of block[1].matchAll(/'([a-z_0-9]+)' =>/g)) {
    defined.add(m[1]);
}

/* --------------------------------------------------------- the verdict -- */

const missing = [];

for (const key of keys) {
    if (!defined.has(key)) {
        missing.push("settings.features." + key);
    }

    if (!defined.has(key + '_helper')) {
        missing.push("settings.features." + key + '_helper');
    }
}

if (missing.length > 0) {
    console.error('Feature label check: ' + missing.length + ' key(s) with nothing behind them.\n');

    for (const key of missing) {
        console.error('  ' + key);
    }

    console.error('\nFeatures::options() and ::descriptions() build these from Features::ALL,');
    console.error('so a missing one is a row in the on/off list reading like');
    console.error('"essentials::settings.features.artwork" on somebody\'s screen.');
    console.error('They go in the \'features\' block of lang/en/settings.php - the');
    console.error("'pages' block is the sidebar row's label, which is a different thing.");
    process.exit(1);
}

console.log('Feature label check: ' + keys.length + ' features, every one has a label and a description.');
