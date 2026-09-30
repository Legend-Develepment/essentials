/*
 * The one check that is PHP's own opinion.
 *
 * Everything else in tools/ reasons about the source from the outside.
 * lint-php.js is honest about being a character scanner: it catches an
 * apostrophe that closes a string early and a brace that never closes, which
 * are the two mistakes a file full of English prose invites, and it cannot
 * catch anything else. check-uses.js asks whether a name resolves. None of them
 * is a parser, because the machine this is built on has no PHP, no
 * composer.json and no vendor directory.
 *
 * So a fatal reached a finished build with every gate green. Two classes in
 * Support/Fields were declared under names their own files already imported -
 * "Cannot declare class ... because the name is already in use" - which is not
 * a syntax error at all. It is a compile error, and the only thing that has an
 * opinion about those is PHP.
 *
 * This runs `php -l` over every file, eight at a time, which is six seconds for
 * seventeen hundred files. It needs a php binary and says exactly what to do
 * when there is not one, because there is no point in a check that fails on a
 * machine where it cannot run: the release workflow always has one, and a
 * developer's machine has one as soon as somebody unzips php.exe anywhere on
 * the PATH. Nothing else is needed - `-l` compiles and reports, and wants no
 * extensions, no ini and no vendor.
 *
 * Blade templates are left out. They are not PHP until Blade has compiled them,
 * and `@if` is a parse error in a file PHP is asked to read on its own.
 */
const { execFile } = require('child_process');
const fs = require('fs');
const os = require('os');
const path = require('path');

const root = path.resolve(__dirname, '..');
const dirs = ['src', 'config', 'database', 'lang'];

/** Where to look, in the order somebody would expect. */
function binary() {
    const named = process.env.PHP_BINARY;

    if (named && fs.existsSync(named)) {
        return named;
    }

    const windows = process.platform === 'win32';
    const exe = windows ? 'php.exe' : 'php';

    for (const dir of (process.env.PATH ?? '').split(path.delimiter)) {
        if (dir === '') {
            continue;
        }

        const full = path.join(dir, exe);

        try {
            if (fs.existsSync(full)) {
                return full;
            }
        } catch {
            // An unreadable entry on the PATH is not this check's business.
        }
    }

    return null;
}

const php = binary();

if (php === null) {
    console.log(
        'Parse check: no php binary, so PHP never saw this.\n' +
            '  Every other check here reasons about the source from the outside. This one is\n' +
            "  PHP's own opinion, and it is the only thing that catches a compile error -\n" +
            '  a class declared under a name the file imports, for instance, which parses.\n' +
            '  Put php on the PATH, or set PHP_BINARY, and it turns on. Nothing else is\n' +
            '  needed: -l wants no extensions, no ini and no vendor directory.',
    );

    process.exit(0);
}

const files = [];

(function collect() {
    const walk = (dir) => {
        for (const entry of fs.readdirSync(dir, { withFileTypes: true }).sort((a, b) => a.name.localeCompare(b.name))) {
            const full = path.join(dir, entry.name);

            if (entry.isDirectory()) {
                walk(full);
            } else if (entry.name.endsWith('.php') && !entry.name.endsWith('.blade.php')) {
                files.push(full);
            }
        }
    };

    for (const dir of dirs) {
        const full = path.join(root, dir);

        if (fs.existsSync(full)) {
            walk(full);
        }
    }
})();

/*
 * Eight at a time, or however many this machine has. One process per file is a
 * minute for this tree; eight at a time is six seconds, and the work is all
 * waiting on a process rather than on this one.
 */
const at_once = Math.max(2, Math.min(8, os.cpus().length));

const problems = [];
let next = 0;
let running = 0;
let done = 0;

function finish() {
    if (problems.length > 0) {
        console.error(`Parse check: ${problems.length} file(s) PHP will not compile.\n`);

        for (const line of problems) {
            console.error('  ' + line);
        }

        console.error('\nThis is PHP itself speaking, so the message above is the whole of it.');
        process.exit(1);
    }

    console.log(`Parse check: ${done} file(s), PHP compiles every one of them.`);
}

function take() {
    while (running < at_once && next < files.length) {
        const file = files[next++];

        running++;

        execFile(php, ['-n', '-l', file], { windowsHide: true }, (error, stdout, stderr) => {
            running--;
            done++;

            if (error) {
                const said = ((stderr || '') + (stdout || ''))
                    .split('\n')
                    .map((line) => line.trim())
                    .filter((line) => line !== '' && !line.startsWith('Errors parsing'))
                    .join('\n      ');

                problems.push(
                    path.relative(root, file).split(path.sep).join('/') + '\n      ' + said,
                );
            }

            if (next < files.length) {
                take();

                return;
            }

            if (running === 0) {
                finish();
            }
        });
    }
}

if (files.length === 0) {
    console.log('Parse check: nothing to read.');
} else {
    take();
}
