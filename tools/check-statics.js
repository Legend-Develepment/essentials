/*
 * A page may not invent a static property Filament declares as an instance one.
 *
 * PHP refuses to compile a class that redeclares an inherited non-static
 * property as static:
 *
 *   Cannot redeclare non static Filament\Pages\BasePage::$maxContentWidth
 *   as static LegendDevelopment\Theme\...\ShopOverview::$maxContentWidth
 *
 * That is a fatal while the class is being compiled, which is a five hundred on
 * every page of the panel and - this is the part worth knowing - the one thing
 * ThemePlugin::guarded() cannot help with. It catches an Error thrown by code
 * that is running. This happens before any of it runs.
 *
 * There is no vendor directory here to read Filament's own declarations from,
 * so the rule is a proxy and deliberately a blunt one: **a static property on a
 * Filament page has to be one that another page in this repository already
 * declares.** Eight of them are used across a dozen pages and have been for a
 * long time, which is the evidence that Filament declares those static. A
 * ninth, appearing once, is a guess somebody made - and a guess is exactly what
 * this was.
 *
 * Adding a genuinely new one means adding it to KNOWN below, next to the reason
 * for believing it, having checked it against the Filament version in
 * composer.json rather than against a page that looked similar.
 */
const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..');
const PAGES = path.join(ROOT, 'src/Filament');

/*
 * Statics Filament itself declares, which we may therefore set.
 *
 * Each of these is in use on several pages here and none has ever produced this
 * fatal, which is the evidence. A name is added only after checking it against
 * the Filament version in composer.json - not because another page that looked
 * similar happened to have it, which is how $maxContentWidth got in.
 */
const INHERITED = new Set([
    'navigationIcon',
    'navigationLabel',
    'navigationGroup',
    'navigationSort',
    'activeNavigationIcon',
    'shouldRegisterNavigation',
    'slug',
    'title',
    'view',
    'routeMiddleware',
    'cluster',
    // Widgets rather than pages: Filament\Widgets\Widget declares both.
    'isLazy',
    'sort',
]);

/*
 * And statics this plugin declares for itself, which are a different question.
 *
 * These are per-request memos on one page each. They are safe because Filament
 * has no property of that name to disagree with - and that, rather than the
 * fact that they are private, is why they are safe: PHP raises the same fatal
 * whatever the visibility. So they are listed here by name, and a new one has
 * to be added deliberately after the same check.
 */
const OURS = new Set([
    'servers',
    'looked',
]);

const KNOWN = new Set([...INHERITED, ...OURS]);

/*
 * A property, not a method. The open bracket in the excluded set is what stops
 * this walking into a parameter list: without it, "public static function
 * asLanding(bool $landing = true)" reads as a static property called $landing,
 * and the check reports two dozen of those instead of the one real fault.
 */
const STATIC_PROP = /^\s*(?:protected|public|private)\s+static\s+(?!function\b)[^;=(]*?\$([A-Za-z_][A-Za-z0-9_]*)\s*[;=]/gm;

function walk(dir, out) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
            continue;
        }

        if (entry.name.endsWith('.php')) out.push(full);
    }

    return out;
}

const files = fs.existsSync(PAGES) ? walk(PAGES, []) : [];
const seen = new Map();

for (const file of files) {
    const src = fs.readFileSync(file, 'utf8');
    let m;

    STATIC_PROP.lastIndex = 0;

    while ((m = STATIC_PROP.exec(src)) !== null) {
        const name = m[1];
        const where = path.relative(ROOT, file);

        if (!seen.has(name)) seen.set(name, []);
        seen.get(name).push(where);
    }
}

const strange = [];

for (const [name, where] of seen) {
    if (KNOWN.has(name)) continue;

    strange.push({ name, where });
}

if (strange.length === 0) {
    console.log('Static property check: ' + seen.size + ' name(s) across ' + files.length + ' file(s), all of them known.');
    process.exit(0);
}

console.error('Static property check: ' + strange.length + ' static propert(ies) nothing else declares.');
console.error('');

for (const { name, where } of strange) {
    console.error('  $' + name + '  ' + where.join(', '));
}

console.error('');
console.error('Filament declares some of these on the page it inherits from, and not');
console.error('all of them are static. Redeclaring an instance property as static is a');
console.error('fatal while PHP compiles the class - a 500 on every page of the panel,');
console.error('and the one thing ThemePlugin::guarded() cannot catch, because nothing');
console.error('has started running yet.');
console.error('');
console.error('Check it against the Filament version in composer.json. If it really is');
console.error('static there, add it to KNOWN in this file with the reason.');

process.exit(1);
