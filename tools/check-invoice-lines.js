/*
 * Every line written onto an invoice has the key the invoice reads.
 *
 * The document, the email and the service page all read `text`. Four writers -
 * the addon charge, the upgrade charge, the top-up and the credit note - drifted
 * to `description` with a `quantity` beside it, and nothing said so: the array
 * is JSON in a column, so PHP never complained and the check-* gates had nothing
 * to compare. The result was an invoice with a price and an empty description,
 * which is a legal document that does not say what it is for. Five of them were
 * found on a live panel, one of them a credit note.
 *
 * So this reads the arrays assigned to an invoice's `lines` and insists on the
 * shape the readers use. The keys are few and the shape is stable, which is what
 * makes a check like this cheap to keep.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const shop = path.join(root, 'src', 'Support', 'Shop');

/** The keys a line may carry, and the one it must. */
const REQUIRED = 'text';
const ALLOWED = new Set(['text', 'amount']);

const problems = [];
let lines = 0;

/**
 * PHP with its comments blanked, so a shape written out in a docblock is not
 * read as code. Borrowed from check-uses.js, which needs the same thing.
 */
function code(source) {
    return source
        .replace(/\/\*[\s\S]*?\*\//g, (match) => match.replace(/[^\n]/g, ' '))
        .replace(/\/\/[^\n]*/g, (match) => ' '.repeat(match.length));
}

/**
 * The same text with everything inside round brackets blanked.
 *
 * What is left is the array's own shape. Counting depth rather than matching a
 * pair, because a call's arguments hold calls.
 */
function blankCalls(source) {
    const out = [...source];
    let depth = 0;

    for (let at = 0; at < out.length; at++) {
        if (out[at] === '(') {
            depth += 1;

            continue;
        }

        if (out[at] === ')') {
            depth = Math.max(0, depth - 1);

            continue;
        }

        if (depth > 0 && out[at] !== '\n') {
            out[at] = ' ';
        }
    }

    return out.join('');
}

/**
 * Every `'lines' => [ ... ]` in a file, as the text between the brackets.
 *
 * Bracket counting rather than a regex, because these arrays hold arrays and a
 * regex that stops at the first `]` reads half of one.
 */
function lineArrays(source) {
    const out = [];

    /*
     * Written straight onto the invoice, or built up in a `$lines` variable
     * first. The first version of this read only the former and so saw none of
     * the four writers that were actually wrong, every one of which builds the
     * array a few lines above and hands over the variable.
     */
    const opener = /(?:'lines'\s*=>|\$lines(?:\[\])?\s*=)\s*\[/g;
    let found;

    while ((found = opener.exec(source)) !== null) {
        let depth = 1;
        let at = opener.lastIndex;

        while (at < source.length && depth > 0) {
            if (source[at] === '[') { depth += 1; }
            if (source[at] === ']') { depth -= 1; }
            at += 1;
        }

        if (depth === 0) {
            out.push({
                body: source.slice(opener.lastIndex, at - 1),
                line: source.slice(0, found.index).split('\n').length,
            });
        }
    }

    return out;
}

for (const name of fs.readdirSync(shop)) {
    if (!name.endsWith('.php')) { continue; }

    const where = 'src/Support/Shop/' + name;
    const source = code(fs.readFileSync(path.join(shop, name), 'utf8'));

    for (const found of lineArrays(source)) {
        /*
         * A variable rather than a literal is somebody else's array, built
         * further up and checked where it was built. Only the ones written out
         * here can be read.
         *
         * Arguments are blanked first. A line's text is usually a Theme::trans()
         * call carrying its own named placeholders, and `['number' => ...]`
         * inside one of those is a word in a sentence rather than a key on the
         * line - which the first version of this reported as a fault.
         */
        const keys = [...blankCalls(found.body).matchAll(/'([a-z_]+)'\s*=>/g)].map((match) => match[1]);

        if (keys.length === 0) { continue; }

        lines += 1;

        if (!keys.includes(REQUIRED)) {
            problems.push(
                `${where}:${found.line}  a line with no '${REQUIRED}'` +
                    `\n      keys: ${keys.join(', ')}` +
                    '\n      The invoice document and the invoice email both read ' +
                    "`$line['text']`, so this line prints with an empty description.",
            );

            continue;
        }

        for (const key of keys) {
            if (!ALLOWED.has(key)) {
                problems.push(
                    `${where}:${found.line}  a line carrying '${key}'` +
                        `\n      Only ${[...ALLOWED].map((one) => `'${one}'`).join(' and ')} are read. ` +
                        'Anything else is stored for ever and shown to nobody.',
                );
            }
        }
    }
}

if (problems.length > 0) {
    console.error(`Invoice line check: ${problems.length} line(s) the invoice cannot print.\n`);

    for (const one of problems) {
        console.error('  ' + one);
    }

    console.error(
        "\nAn invoice line is `['text' => ..., 'amount' => ...]`. That is what " +
            'resources/views/invoice.blade.php and resources/views/mail/invoice.blade.php\nread, and ' +
            'what Purchase::lines() has always written.',
    );

    process.exit(1);
}

console.log(`Invoice line check: ${lines} invoice line shape(s), every one of them printable.`);
