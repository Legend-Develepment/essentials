/*
 * A class that calls self::something() has to have that something.
 *
 * Splitting Settings into nine files moved two methods per page and left the
 * private helpers they leaned on behind. `Saved\Shop::read()` went on calling
 * `self::unfold()` from a class that no longer had one, and three things in a
 * row said it was fine: php -l parses it, tools/class-load.php loads the class
 * without calling anything in it, and every other gate reads the source from
 * the outside. It took running the method on a real panel to find out, which is
 * both late and lucky.
 *
 * So this resolves them. For each class it collects the methods it declares and
 * the ones its traits bring, then checks every self:: and static:: call against
 * that list.
 *
 * **It only speaks when it is certain.** A class that extends something, or
 * uses a trait this file does not know the methods of, is skipped entirely:
 * the parent may well declare the method and guessing otherwise would be a
 * gate that cries wolf. That leaves it narrower than it looks, and still wide
 * enough for the fault it was written for - the nine settings classes, and
 * every other flat helper in src/Support.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');

/**
 * What a trait brings, for the traits this repository actually uses.
 *
 * Read from Pelican rather than guessed at would be better and is not possible
 * here: vendor/ is not in this repository and the build machine has no copy.
 * So the names are written down, and a trait that is not in this list makes the
 * class using it unanswerable rather than wrong.
 */
const TRAITS = {
    EnvironmentWriterTrait: ['writeToEnvironment'],
};

const SKIP = new Set(['.git', 'node_modules', 'no-git', 'dist', 'release', 'vendor']);

function walk(dir, out = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (SKIP.has(entry.name)) {
            continue;
        }

        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
        } else if (entry.name.endsWith('.php')) {
            out.push(full);
        }
    }

    return out;
}

const problems = [];
let checked = 0;
let calls = 0;

for (const file of walk(path.join(root, 'src'))) {
    const source = fs.readFileSync(file, 'utf8');
    const declared = /^(?:final\s+|abstract\s+)?class\s+(\w+)(\s+extends\s+\w+)?/m.exec(source);

    if (declared === null || declared[2]) {
        // No class here, or one with a parent that may declare the method.
        continue;
    }

    // The traits it uses, inside the class body: `use Foo;` at one indent.
    const used = [...source.matchAll(/^    use\s+([\w\\, ]+);/gm)]
        .flatMap((m) => m[1].split(','))
        .map((name) => name.trim().split('\\').pop())
        .filter(Boolean);

    if (used.some((name) => !(name in TRAITS))) {
        // A trait whose methods are unknown here. Saying nothing is the only
        // honest answer about a class half of whose methods are invisible.
        continue;
    }

    const has = new Set([
        ...[...source.matchAll(/function\s+(\w+)\s*\(/g)].map((m) => m[1]),
        ...used.flatMap((name) => TRAITS[name]),
    ]);

    checked += 1;

    for (const call of source.matchAll(/\b(?:self|static)::(\w+)\s*\(/g)) {
        calls += 1;

        if (has.has(call[1])) {
            continue;
        }

        const line = source.slice(0, call.index).split('\n').length;

        problems.push(
            `${path.relative(root, file).replace(/\\/g, '/')}:${line}  ${declared[1]} calls `
                + `self::${call[1]}() and has no such method`,
        );
    }
}

if (problems.length > 0) {
    console.error(`Self check: ${problems.length} call(s) with no method behind them.\n`);
    problems.forEach((line) => console.error('  ' + line));
    console.error(
        '\nphp -l parses this and class-load.php loads the class without calling it.\n'
        + 'It is a fatal at the moment the line runs, which is in front of somebody.',
    );
    process.exit(1);
}

console.log(
    `Self check: ${calls} self:: call(s) across ${checked} class(es) with nothing above them, `
        + 'every one resolved.',
);
