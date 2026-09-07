/*
 * A plugin migration may not guess the width of somebody else's column.
 *
 * `foreignId('user_id')->constrained('users')` is the modern Laravel idiom and
 * it is wrong here. It declares an `unsignedBigInteger`, and Pelican's `users`
 * table was created in 2016 with `$table->increments('id')` - which is
 * `int unsigned`, four bytes rather than eight. MySQL refuses a foreign key
 * between two different integer widths, and it refuses it with
 *
 *     SQLSTATE[HY000]: General error: 1005 Can't create table (errno: 150)
 *
 * which names neither column. Pelican wraps that in "Could not run migrations"
 * and the whole plugin fails to install.
 *
 * That shipped. It was the second fault in this repository's first real
 * migration and it was hidden behind the first: 3.0.1-dev could not even load
 * the file, so the foreign key never got as far as being attempted, and fixing
 * the load error in 3.1.2-dev simply uncovered this one. Two installs broken
 * for two reasons, in one file, on the same day.
 *
 * So: no `foreignId()` and no `constrained()` in a migration. Declare the
 * column to match what it points at and add the key by hand, which is what
 * Pelican's own migrations do - create_passkeys_table and
 * create_server_user_settings_table both write
 *
 *     $table->unsignedInteger('user_id');
 *     $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
 *
 * This cannot check that a width is *correct* - that would need the panel's
 * schema, which is not in this repository and must not be. What it can do is
 * refuse the one helper whose whole purpose is to choose a width for you, in a
 * plugin where the answer is never the one it chooses.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const dir = path.join(root, 'database', 'migrations');

/* The helpers that pick a type, and what to write instead. */
const BANNED = [
    ['foreignId', 'unsignedInteger(...) with a foreign() of its own'],
    ['foreignIdFor', 'unsignedInteger(...) with a foreign() of its own'],
    ['constrained', "foreign('col')->references('id')->on('table')"],
];

const problems = [];
let scanned = 0;

if (fs.existsSync(dir)) {
    for (const entry of fs.readdirSync(dir)) {
        if (!entry.endsWith('.php')) { continue; }

        scanned++;

        const rel = 'database/migrations/' + entry;
        const source = fs.readFileSync(path.join(dir, entry), 'utf8');

        source.split('\n').forEach((line, i) => {
            // Not in a comment. This file's own explanation names all three.
            const trimmed = line.trim();

            if (trimmed.startsWith('*') || trimmed.startsWith('//') || trimmed.startsWith('/*')) { return; }

            for (const [name, instead] of BANNED) {
                if (new RegExp('->' + name + '\\s*\\(').test(line)) {
                    problems.push(rel + ':' + (i + 1) + '  ->' + name + '()\n    ' + trimmed.slice(0, 90)
                        + '\n    Write ' + instead + ' instead.');
                }
            }
        });
    }
}

if (problems.length > 0) {
    console.error('Migration check: ' + problems.length + ' column(s) whose width was guessed.\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error(
        'These helpers declare an unsignedBigInteger. Pelican\'s users table is\n' +
        '`increments`, which is int unsigned - and MySQL refuses a foreign key\n' +
        'between two widths with "errno: 150", naming neither column. Pelican\n' +
        'reports it as "Could not run migrations" and the plugin will not install.\n' +
        'Nothing was built.'
    );

    process.exit(1);
}

console.log('Migration check: ' + scanned + ' migration(s), no column width guessed.');
