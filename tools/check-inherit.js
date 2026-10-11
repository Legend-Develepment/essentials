/*
 * What a class inherits, and what it owes.
 *
 * **This gate exists because of one line.** A page declared
 * `abstract protected function pull()`. Livewire's Component has a concrete
 * pull(), PHP refuses to make an inherited non-abstract method abstract, and
 * the whole panel answered 500 from the moment the file was loaded. The queue
 * worker crash-looped on the same fatal until systemd gave up on it, and the
 * queue then stayed down for thirteen hours: no backups, no scheduled reboots.
 *
 * Nothing saw it. `php -l` parses that file perfectly, because the file IS
 * valid PHP; the fault is in how the class composes against its parent, which
 * is decided when the class is loaded. Every other gate here reasons about the
 * source text from the outside and none of them has ever seen Livewire. The
 * build machine has no PHP, no composer and no vendor directory, so it cannot
 * simply ask.
 *
 * So this asks two questions that can be answered from source text alone.
 *
 * **One: a name declared abstract or static on a class whose parent is not in
 * this repository has to be a name somebody decided on.** The parent's methods
 * are unknowable from here, so the check is an allowlist: the names below are
 * the ones in the tree today, each of them a deliberate part of a contract this
 * plugin wrote. A new name fails until it is added, and adding it is the moment
 * somebody asks "does the parent already have one of these". That is exactly
 * the question nobody asked about pull().
 *
 * **Two: a class that is not abstract has to satisfy every abstract method and
 * every interface method declared inside this repository.** That one needs no
 * allowlist at all, because both halves are here to be read. Eight pages extend
 * GameConfig and it declares seven abstract methods; adding an eighth means
 * editing eight files, and until now nothing counted them.
 *
 * `tools/class-load.php` answers both properly, by loading all 262 classes on a
 * panel with vendor present. It stays the ground truth. It also has to be run
 * by hand, which is why it did not run that night.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const src = path.join(root, 'src');

/* --------------------------------------------------------- what is there -- */

/** Every PHP file under src, deepest last, in a repeatable order. */
function found(dir) {
    const out = [];

    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const at = path.join(dir, entry.name);

        if (entry.isDirectory()) { out.push(...found(at)); continue; }

        if (entry.isFile() && entry.name.endsWith('.php')) { out.push(at); }
    }

    return out.sort();
}

/*
 * The names this plugin declares abstract or static on a class it does not own
 * the parent of.
 *
 * Every one is part of a contract written here, and the comment beside it is
 * what a reader needs in order to add the next one honestly: the question to
 * ask is not "is this name free" but "does Filament, Livewire or Eloquent
 * already have a method called this".
 */
const KNOWN = {
    // GameConfig's contract, answered by the eight game settings pages.
    words: 'GameConfig: which lang file names this page',
    knows: 'GameConfig: whether this server is this game',
    paths: 'GameConfig: which files this game keeps',
    contentsOf: 'GameConfig: read one of them',
    saveTo: 'GameConfig: write one of them',
    offered: 'GameConfig: what settings a file holds',
    rewrite: 'GameConfig: put changed values back',

    // SettingsPage's contract, answered by the seven admin settings pages.
    groups: 'SettingsPage: the sections this page draws',
    key: 'SettingsPage: which settings group this page is',

    // Statics Filament itself asks for, answered rather than invented.
    canAccess: 'Filament asks this before routing to a page',
    canView: 'Filament asks this before drawing a widget',
    getNavigationLabel: 'Filament: the sidebar row text',
    getNavigationIcon: 'Filament: the sidebar row icon',
    getNavigationGroup: 'Filament: which group the row sits in',
    getNavigationBadge: 'Filament: the count beside the row',
    // Declared `string | array | null` on Page, so a child that narrows it to
    // ?string is a fatal. This check is what said so.
    getNavigationBadgeColor: 'Filament: what colour that count is drawn in',
    shouldRegisterNavigation: 'Filament: whether the row appears at all',

    // This plugin's own statics on pages, which no framework declares.
    asLanding: 'whether this page is the panel landing page',
    windowUrl: 'the address a timed look preview opens',
};

/* ------------------------------------------------------------- the reading -- */

const files = found(src);
const classes = new Map();

const NAMESPACE = /^\s*namespace\s+([^;]+);/m;
const USE = /^\s*use\s+([A-Za-z0-9_\\]+)(?:\s+as\s+([A-Za-z0-9_]+))?\s*;/gm;
const DECLARE = /^\s*(abstract\s+|final\s+)?(?:readonly\s+)?(class|interface|trait|enum)\s+([A-Za-z0-9_]+)([^{]*)\{/m;

/*
 * A method, with enough of its shape to compare two of them.
 *
 * The body is not read and does not need to be: what matters here is the name,
 * whether it is abstract, whether it is static, and the text of its parameters
 * and return type.
 */
const METHOD = /^[ \t]*((?:(?:public|protected|private|abstract|final|static)\s+)*)function\s+&?([A-Za-z0-9_]+)\s*\(([^{;]*?)\)\s*(?::\s*([^{;]+?))?\s*[{;]/gm;

for (const file of files) {
    const text = fs.readFileSync(file, 'utf8');
    const declared = DECLARE.exec(text);

    if (declared === null) { continue; }

    const space = NAMESPACE.exec(text);
    const name = declared[3];
    const tail = declared[4] || '';

    /*
     * Imports, so a parent named by its short name can be resolved to the class
     * it actually is.
     *
     * This matters more than it looks. ThemePlugin says `implements
     * HasPluginSettings, Plugin`, and this repository has its own
     * Support\Fields\Plugin: matching on the short name alone reports a class
     * that fails to implement an interface it never claimed.
     */
    const imports = new Map();
    USE.lastIndex = 0;

    for (let m; (m = USE.exec(text)) !== null;) {
        const full = m[1].replace(/^\\/, '');
        imports.set(m[2] || full.split('\\').pop(), full);
    }

    const resolve = (short) => {
        const bare = short.trim().replace(/^\\/, '');

        if (bare === '') { return null; }

        if (bare.includes('\\')) { return bare; }

        if (imports.has(bare)) { return imports.get(bare); }

        return space === null ? bare : space[1].trim() + '\\' + bare;
    };

    const parent = /\bextends\s+([A-Za-z0-9_\\]+)/.exec(tail);
    const contracts = /\bimplements\s+([A-Za-z0-9_\\,\s]+)$/.exec(tail.replace(/\s+$/, ''));

    const methods = [];
    METHOD.lastIndex = 0;

    for (let m; (m = METHOD.exec(text)) !== null;) {
        const flags = (m[1] || '').split(/\s+/).filter(Boolean);

        methods.push({
            name: m[2],
            abstract: flags.includes('abstract') || declared[2] === 'interface',
            static: flags.includes('static'),
            visibility: flags.find((f) => ['public', 'protected', 'private'].includes(f)) || 'public',
            params: (m[3] || '').replace(/\s+/g, ' ').trim(),
            returns: (m[4] || '').replace(/\s+/g, ' ').trim(),
            line: text.slice(0, m.index).split('\n').length,
        });
    }

    const full = (space === null ? '' : space[1].trim() + '\\') + name;

    classes.set(full, {
        file: path.relative(root, file).split(path.sep).join('/'),
        name,
        kind: declared[2],
        abstract: (declared[1] || '').trim() === 'abstract',
        parent: parent === null ? null : resolve(parent[1]),
        contracts: contracts === null
            ? []
            : contracts[1].split(',').map((one) => resolve(one)).filter(Boolean),
        methods,
    });
}

if (classes.size === 0) {
    console.error('check-inherit: no classes found under src/.');
    console.error('If the tree has been reshaped, this gate needs the new shape');
    console.error('rather than being deleted: it is the only thing standing between');
    console.error('a class-composition fatal and a live panel.');
    process.exit(1);
}

const faults = [];

/** Everything a class must answer for, walking its own ancestry. */
function owed(cls, seen = new Set()) {
    const out = new Map();

    const take = (from) => {
        if (from === null || seen.has(from)) { return; }

        seen.add(from);

        const other = classes.get(from);

        if (other === undefined) { return; }

        for (const [name, method] of owed(other, seen)) { out.set(name, method); }

        for (const method of other.methods) {
            if (method.abstract) { out.set(method.name, { ...method, from: other.name }); continue; }

            // A concrete ancestor answers an obligation an earlier one set.
            out.delete(method.name);
        }
    };

    take(cls.parent);

    for (const contract of cls.contracts) { take(contract); }

    return out;
}

/* ------------------------------ one: names invented over an unknown parent -- */

/**
 * Whether this class's ancestry leaves the repository at some point.
 *
 * The direct parent is not the question. OnsetConfig extends GameConfig, which
 * is readable, and GameConfig extends Filament's Page, which is not - so a name
 * invented on OnsetConfig can collide with Page exactly as one invented on
 * GameConfig can. The first version of this gate asked only about the direct
 * parent and let a static declared on a grandchild straight through.
 */
function outermost(cls, seen = new Set()) {
    if (cls.parent === null) { return cls.name; }

    if (!classes.has(cls.parent)) { return cls.parent.split('\\').pop(); }

    if (seen.has(cls.parent)) { return cls.name; }

    seen.add(cls.parent);

    return outermost(classes.get(cls.parent), seen);
}

function reachesOutside(cls, seen = new Set()) {
    if (cls.parent === null) { return false; }

    if (!classes.has(cls.parent)) { return true; }

    if (seen.has(cls.parent)) { return false; }

    seen.add(cls.parent);

    return reachesOutside(classes.get(cls.parent), seen);
}

for (const [, cls] of classes) {
    if (!reachesOutside(cls)) { continue; }

    // A name that answers an obligation set inside this repository is already
    // accounted for: whoever wrote the abstract chose it, and it is in KNOWN.
    const answering = new Set([...owed(cls).keys()]);

    for (const method of cls.methods) {
        if (!method.abstract && !(method.static && method.visibility !== 'private')) { continue; }

        if (Object.prototype.hasOwnProperty.call(KNOWN, method.name)) { continue; }

        if (answering.has(method.name)) { continue; }

        faults.push({
            file: cls.file,
            line: method.line,
            what: `${cls.name} declares ${method.abstract ? 'abstract' : 'static'} ${method.name}(), `
                + `and its ancestry reaches ${outermost(cls)}, which is not in this repository`,
            fix: 'Check that nothing above it already has a method of that name, then add it to'
                + '\n      KNOWN in this file with a line saying what contract it belongs to.',
        });
    }
}

/* ------------------------------- two: contracts written here and not kept -- */

for (const [, cls] of classes) {
    if (cls.abstract || cls.kind === 'interface' || cls.kind === 'trait') { continue; }

    const mine = new Set(cls.methods.map((m) => m.name));

    for (const [name, method] of owed(cls)) {
        if (mine.has(name)) { continue; }

        faults.push({
            file: cls.file,
            line: 1,
            what: `${cls.name} does not declare ${name}(), which ${method.from} requires`,
            fix: 'Declare it, or mark this class abstract if it is not meant to be built.',
        });
    }
}

/* ------------------------------------------------------------- the answer -- */

if (faults.length > 0) {
    console.error(`Inheritance check: ${faults.length} thing(s) a class cannot be composed with.\n`);

    for (const fault of faults) {
        console.error(`  ${fault.file}:${fault.line}`);
        console.error(`      ${fault.what}`);
        console.error(`      ${fault.fix}\n`);
    }

    console.error('A fault of this shape is not a syntax error and php -l will not see it.');
    console.error('It is a fatal at the moment the class is first loaded, which on a panel');
    console.error('means every request and every queued job, at once.');
    process.exit(1);
}

const owing = [...classes.values()].filter((c) => c.methods.some((m) => m.abstract)).length;

console.log(
    `Inheritance check: ${classes.size} class(es), ${Object.keys(KNOWN).length} name(s) declared over `
    + `a parent this repository does not own, ${owing} contract(s) kept by everything that extends them.`
);
