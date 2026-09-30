/*
 * A form that does not carry every key must not write every key.
 *
 * Each persist* method in Settings writes a fixed block of environment keys,
 * and reads every one of them out of the array it was handed with a default for
 * the key that is not there. That is right for a sanitiser and wrong for a
 * saver: hand it the state of a form holding three fields and it writes the
 * other seventy, each with the value nobody chose.
 *
 * Which is what the plugin's own settings page did. It shows an icon, a release
 * channel and a link, and its save button wrote out sixty-nine settings owned by
 * the Look pages - the accent, the background, the layout, the terminal, the
 * arranger - resetting every one of them to a default. Silently, because there
 * is nothing to see: the page it ruins is a different page.
 *
 * The fix is one line per call site and it is already the shape four of them
 * used: read what is stored, lay the form's answers over it, write that. So this
 * checks that every caller does, which is a thing a reader cannot hold in their
 * head across nine pages and a gate can check in a second.
 *
 * Two deliberate gaps. Settings.php itself is skipped, because that is where the
 * methods live. And persistFeatures() is skipped because it does not take a data
 * array at all - it takes the list of what is off, which is the whole answer and
 * cannot be partial.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const src = path.join(root, 'src');

/** Which stored settings each writer has to be given before it writes. */
const SOURCE = {
    persist: 'data',
    persistAlerts: 'alertsData',
    persistApi: 'apiData',
    persistArtwork: 'artworkData',
    persistFiles: 'filesData',
    persistLogin: 'loginData',
    persistShop: 'shopData',
    persistStatus: 'statusData',
    persistSystemStatus: 'systemStatusData',
    persistTickets: 'ticketsData',
};

/** Takes its answer whole rather than as a form's state. */
const WHOLE = ['persistFeatures'];

/*
 * The code, with the comments and the strings blanked out. Same helper as
 * check-uses.js, and here for the same reason: two of this gate's first three
 * findings were sentences about Settings::persist() rather than calls to it.
 * Every character is replaced by a space rather than removed, so a line number
 * counted in this copy is a line number in the file.
 */
function code(source) {
    const out = source.split('');
    let i = 0;

    while (i < source.length) {
        const two = source.slice(i, i + 2);

        if (two === '/*') {
            const end = source.indexOf('*/', i + 2);
            const stop = end === -1 ? source.length : end + 2;

            for (let j = i; j < stop; j++) {
                if (out[j] !== '\n') out[j] = ' ';
            }

            i = stop;

            continue;
        }

        if (two === '//' || source[i] === '#') {
            const end = source.indexOf('\n', i);
            const stop = end === -1 ? source.length : end;

            for (let j = i; j < stop; j++) out[j] = ' ';

            i = stop;

            continue;
        }

        const quote = source[i];

        if (quote === "'" || quote === '"') {
            let j = i + 1;

            while (j < source.length) {
                if (source[j] === '\\') {
                    j += 2;

                    continue;
                }

                if (source[j] === quote) break;

                j++;
            }

            for (let k = i; k <= j && k < source.length; k++) {
                if (out[k] !== '\n') out[k] = ' ';
            }

            i = j + 1;

            continue;
        }

        i++;
    }

    return out.join('');
}

const files = [];

(function walk(dir) {
    for (const name of fs.readdirSync(dir).sort()) {
        const full = path.join(dir, name);

        if (fs.statSync(full).isDirectory()) {
            walk(full);
        } else if (name.endsWith('.php')) {
            files.push(full);
        }
    }
})(src);

const problems = [];
let checked = 0;

for (const file of files) {
    const where = path.relative(root, file).split(path.sep).join('/');

    // Where they are defined, not called.
    if (where === 'src/Support/Settings.php') {
        continue;
    }

    const source = code(fs.readFileSync(file, 'utf8'));

    for (const match of source.matchAll(/Settings::(persist[A-Za-z]*)\(/g)) {
        const method = match[1];

        if (WHOLE.includes(method)) {
            continue;
        }

        const wants = SOURCE[method];

        if (wants === undefined) {
            problems.push(
                `${where} calls Settings::${method}(), which this check does not know.` +
                    '\n      Add it to SOURCE with the data() method that reads its settings back.',
            );

            continue;
        }

        checked += 1;

        const after = source.slice(match.index + match[0].length);
        const opens = `array_merge(Settings::${wants}(),`;

        if (!after.startsWith(opens)) {
            const line = source.slice(0, match.index).split('\n').length;

            problems.push(
                `${where}:${line} calls Settings::${method}() without what is already stored.` +
                    `\n      It has to start with ${opens} or it writes a default over every` +
                    '\n      setting the form on this page does not carry.',
            );
        }
    }
}

if (problems.length > 0) {
    console.error(`Persist check: ${problems.length} call(s) that would write over settings nobody touched.\n`);

    for (const line of problems) {
        console.error('  ' + line);
    }

    console.error('\nSee the note above Settings::persistSystemStatus() for the rule.');
    process.exit(1);
}

console.log(`Persist check: ${checked} call(s) to a settings writer, every one handed what is already stored.`);
