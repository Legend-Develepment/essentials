/*
 * Every table this plugin makes has to be in the list that removes it, and in
 * an order the database will accept.
 *
 * Pelican gives a plugin one hook on the way out: rollbackPluginMigrations(),
 * the first thing uninstallPlugin() does. There is no second chance and no page
 * of ours in between. So the list in that down() is the whole cleanup, and it
 * is written in a migration while the tables are made by install tasks
 * somewhere else entirely - which is exactly the shape a list falls behind in.
 *
 * It did. The migration was written when the shop had seven tables, said "the
 * shop's five" in its own heading, and the plugin grew to sixteen. Nine were
 * missing, and that is worse than untidy: four of the nine hold foreign keys
 * into tables the list does drop, so MySQL refuses those drops, the refusal
 * lands in a catch whose comment says "a table left behind is tidied by hand",
 * and the panel ends up with half a shop it cannot remove.
 *
 * Two things are checked, and the second is the one a human gets wrong.
 *
 *  1. **Complete.** Every Schema::create() in src/ names a table, and every one
 *     of those names is in the list.
 *  2. **In order.** Every foreign key between two of this plugin's own tables
 *     is a rule about which has to go first, and the list has to respect all of
 *     them. A table is dropped before anything it points at.
 *
 * What this cannot check is the database's own opinion. Reading the foreign
 * keys out of the source is reading what the code intends to create; a panel
 * whose schema drifted from that is not something a build can see. The install
 * tasks ask the database what is there every time, for the same reason.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');

/** The migration that owns the teardown, being the last one to roll back. */
const MIGRATION = path.join(root, 'database', 'migrations', '2026_09_08_000000_essentials_shop.php');

const files = [];

(function walk(dir) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true }).sort((a, b) => a.name.localeCompare(b.name))) {
        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full);
        } else if (entry.name.endsWith('.php')) {
            files.push(full);
        }
    }
})(path.join(root, 'src'));

/*
 * Constant to table name, for the whole plugin.
 *
 * Schema::create() is handed a constant rather than a string - self::WAITLIST,
 * Order::TABLE - so the names have to be resolved before anything can be
 * compared with a list of literals.
 */
const named = new Map();

for (const file of files) {
    const source = fs.readFileSync(file, 'utf8');
    const owner = path.basename(file, '.php');

    for (const match of source.matchAll(/const\s+([A-Z_]+)\s*=\s*'(essentials_[a-z_]+)'/g)) {
        named.set(match[1], match[2]);
        named.set(owner + '::' + match[1], match[2]);
    }
}

/** What one Schema::create() or ->on() argument actually names. */
function table(expression, owner) {
    const text = expression.trim();

    const literal = text.match(/^'(essentials_[a-z_]+)'$/);

    if (literal !== null) {
        return literal[1];
    }

    const constant = text.match(/^(?:self|static)::([A-Z_]+)$/);

    if (constant !== null) {
        return named.get(owner + '::' + constant[1]) ?? named.get(constant[1]) ?? null;
    }

    const other = text.match(/^(\w+)::([A-Z_]+)$/);

    if (other !== null) {
        return named.get(other[1] + '::' + other[2]) ?? named.get(other[2]) ?? null;
    }

    return null;
}

const made = new Set();

/** child => the tables it points at */
const points = new Map();

for (const file of files) {
    const source = fs.readFileSync(file, 'utf8');
    const owner = path.basename(file, '.php');
    const lines = source.split('\n');

    let current = null;

    for (const line of lines) {
        const create = line.match(/Schema::create\(\s*([^,]+),/);

        if (create !== null) {
            current = table(create[1], owner);

            if (current !== null) {
                made.add(current);
            }

            continue;
        }

        const foreign = line.match(/->references\('\w+'\)->on\(([^)]+)\)/);

        if (foreign === null || current === null) {
            continue;
        }

        const parent = table(foreign[1], owner);

        // Pelican's own tables are not ours to drop and are no constraint here.
        if (parent === null || parent === current) {
            continue;
        }

        if (!points.has(current)) {
            points.set(current, new Set());
        }

        points.get(current).add(parent);
    }
}

const migration = fs.readFileSync(MIGRATION, 'utf8');
const body = migration.slice(migration.indexOf('public function down'));
const listed = [...body.matchAll(/'(essentials_[a-z_]+)'/g)].map((m) => m[1]);

const problems = [];

for (const name of [...made].sort()) {
    if (!listed.includes(name)) {
        problems.push(
            `${name} is created in src/ and is not in the teardown.\n` +
                '      Uninstalling would leave it behind, and anything pointing at it\n' +
                '      would refuse to be dropped at all.',
        );
    }
}

for (const name of listed) {
    if (!made.has(name)) {
        problems.push(
            `${name} is in the teardown and nothing in src/ creates it.\n` +
                '      Either it was renamed, or the plugin no longer owns it.',
        );
    }
}

const at = (name) => listed.indexOf(name);

for (const [child, parents] of [...points].sort()) {
    for (const parent of [...parents].sort()) {
        if (at(child) === -1 || at(parent) === -1) {
            continue;
        }

        if (at(child) > at(parent)) {
            problems.push(
                `${child} points at ${parent} and is dropped after it.\n` +
                    `      MySQL refuses that, so ${parent} survives the uninstall and so\n` +
                    '      does everything the catch swallowed after it.',
            );
        }
    }
}

if (problems.length > 0) {
    console.error(`Teardown check: ${problems.length} problem(s) with what uninstalling removes.\n`);

    for (const line of problems) {
        console.error('  ' + line);
    }

    console.error('\nSee the note on ' + path.relative(root, MIGRATION).split(path.sep).join('/') + '.');
    process.exit(1);
}

console.log(
    `Teardown check: ${made.size} table(s) this plugin makes, all of them in the teardown, ` +
        `${[...points.values()].reduce((n, set) => n + set.size, 0)} reference(s) respected.`,
);
