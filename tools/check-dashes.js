/*
 * No em dash, anywhere.
 *
 * The rule is the owner's and it is absolute: U+2014 never appears in this
 * repository, in code, in comments, in documentation or in anything a person
 * reads on screen. Use a hyphen, a colon, a semicolon, a comma or brackets.
 *
 * It needed a gate because it had quietly stopped being true. Seven thousand
 * four hundred and sixty-four of them had accumulated, seven thousand two
 * hundred in the language files alone and in every locale including the English
 * they were translated from, and nothing anywhere would have said so. One more
 * would have been invisible; seven thousand were.
 *
 * The en dash is refused too, but only with a space on each side, and the
 * difference is the whole point of checking it. Spaced, it is an em dash in a
 * false beard - the character somebody reaches for once the real one is taken
 * away, doing the same job in the same place. Between numbers it is a range,
 * which is what it is for: "1-4" would be read as a subtraction and a range written with it is
 * correct as it stands. So a range passes and a parenthetical does not.
 *
 * The characters are built from escapes rather than written out, so that this
 * file can say which ones it refuses without failing itself.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');

const EM = '\u2014';
const EN = '\u2013';
const BAR = '\u2015';

const SKIP = new Set(['.git', 'node_modules', 'no-git', 'dist', 'release', 'vendor']);

const READ = new Set(['.php', '.js', '.css', '.md', '.json', '.ps1', '.sh']);

function walk(dir, out = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (SKIP.has(entry.name)) {
            continue;
        }

        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
            continue;
        }

        if (READ.has(path.extname(entry.name))) {
            out.push(full);
        }
    }

    return out;
}

/** What is wrong with this line, or null. */
function fault(line) {
    if (line.includes(EM)) {
        return 'em dash';
    }

    if (line.includes(BAR)) {
        return 'horizontal bar';
    }

    if (line.includes(' ' + EN + ' ')) {
        return 'en dash used as a parenthetical';
    }

    return null;
}

const problems = [];
let looked = 0;
let ranges = 0;

for (const file of walk(root)) {
    looked += 1;

    const lines = fs.readFileSync(file, 'utf8').split(/\r?\n/);

    lines.forEach((line, index) => {
        const why = fault(line);

        if (why !== null) {
            // The line is printed as it stands, because the quickest way to see
            // which character is meant is to look at it.
            problems.push(
                `${path.relative(root, file)}:${index + 1}  ${why}\n      ${line.trim().slice(0, 140)}`,
            );

            return;
        }

        if (line.includes(EN)) {
            ranges += 1;
        }
    });
}

if (problems.length > 0) {
    console.error(`Dash check: ${problems.length} line(s) with a dash that should be a hyphen.\n`);
    problems.slice(0, 40).forEach((line) => console.error('  ' + line));

    if (problems.length > 40) {
        console.error(`\n  ...and ${problems.length - 40} more.`);
    }

    process.exit(1);
}

console.log(
    `Dash check: ${looked} files, not an em dash among them; ` +
        `${ranges} line(s) keep an en dash, all of them ranges.`,
);
