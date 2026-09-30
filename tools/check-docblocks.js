/*
 * A docblock documents the thing under it, and nothing gets in between.
 *
 * Adding a method to a class means picking a spot, and the spot that looks
 * right is the blank line above a method that does something similar. Which is
 * one line too high: it is between that method and its docblock. Nothing
 * breaks, nothing is highlighted, and the file now says that the thing you just
 * wrote is "The permission that governs one feature, as Pelican stores it" -
 * while the method that really does that, further down, says nothing at all.
 *
 * It happened forty-one times before anybody noticed, across twenty-five files,
 * over a hundred and twenty-seven releases. Features.php explained TERMINATE
 * above OVERVIEW. Theme.php put a @param array<string, mixed> $replace above a
 * method with no parameters. None of it is wrong code and all of it is wrong
 * documentation, which is worse than none: nobody re-reads a method that
 * already has an explanation above it.
 *
 * The shape is unmistakable and that is the whole check: a docblock that closes
 * with another opening on the very next line. Two docblocks in a row mean the
 * upper one lost what it was written for.
 *
 * What this cannot tell you is where the orphan belongs. That is a judgement
 * about what the sentence means, one file at a time, and it is the reason this
 * gate exists rather than a formatter.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const src = path.join(root, 'src');

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
})(src);

const problems = [];
let blocks = 0;

for (const file of files) {
    const where = path.relative(root, file).split(path.sep).join('/');
    const lines = fs.readFileSync(file, 'utf8').split('\n');

    for (let i = 0; i < lines.length; i++) {
        if (lines[i].trim() === '/**') {
            blocks += 1;
        }

        if (lines[i].trim() !== '*/' || i + 1 >= lines.length) {
            continue;
        }

        if (!lines[i + 1].trim().startsWith('/**')) {
            continue;
        }

        /*
         * The first line of the orphan, which is what the reader needs to find
         * where it belongs. Walk back to its opening rather than reporting the
         * close, because the close is the least useful line in it.
         */
        let opens = i;

        while (opens > 0 && lines[opens].trim() !== '/**') {
            opens -= 1;
        }

        const summary = (lines[opens + 1] || '').trim().replace(/^\*\s?/, '');

        problems.push(
            `${where}:${opens + 1}  ${summary || '(no first line)'}` +
                `\n      Closes at line ${i + 1} with another docblock opening on ${i + 2},` +
                '\n      so whatever this was written for is no longer under it.',
        );
    }
}

if (problems.length > 0) {
    console.error(`Docblock check: ${problems.length} docblock(s) separated from what they describe.\n`);

    for (const line of problems) {
        console.error('  ' + line);
    }

    console.error(
        '\nSomething was inserted between the docblock and its declaration. Move the' +
            '\ndocblock down onto what it describes, or delete it if that is gone.',
    );
    process.exit(1);
}

console.log(`Docblock check: ${blocks} docblock(s) across ${files.length} file(s), each one attached to what it describes.`);
