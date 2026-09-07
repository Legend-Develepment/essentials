/*
 * A column count must say what it wants on a phone.
 *
 * `->columns(2)` does not mean "two on a wide screen and one on a narrow one".
 * It means two at every width, including 360 pixels, and Filament does not fold
 * it for you - Pelican's own code writes `'default' => N` explicitly, a hundred
 * and fourteen times, which is what settled this.
 *
 * Forty-one of these had shipped here. Two fields side by side on a phone is two
 * fields you cannot read the labels of; a repeater at `->columns(4)` is four.
 * And it was invisible from the machine it was written on, which is the whole
 * shape of this class of fault - the same one 2.76's phone pass was about, and
 * the same one the release before this claimed was already handled. It was
 * claimed on an assumption nobody had checked.
 *
 * So: no bare integer. Write the array, and say what a phone gets.
 *
 *     ->columns(['default' => 1, 'sm' => 2])
 *
 * This cannot check that the numbers are *good* - whether two columns at `sm`
 * reads well is a judgement that needs a phone, which is the half of the phone
 * pass that cannot be done from here. What it can do is refuse the form that
 * silently answers "the same everywhere".
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

function walk(dir, out = []) {
    if (!fs.existsSync(dir)) {
        return out;
    }

    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
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

for (const file of walk(path.join(root, 'src'))) {
    const rel = path.relative(root, file).split(path.sep).join('/');
    const source = fs.readFileSync(file, 'utf8');

    source.split('\n').forEach((line, i) => {
        const trimmed = line.trim();

        // Not in a comment. This file's own explanation writes the bad form.
        if (trimmed.startsWith('*') || trimmed.startsWith('//') || trimmed.startsWith('/*')) {
            return;
        }

        const match = line.match(/->columns\(\s*(\d+)\s*\)/);

        if (match !== null) {
            problems.push(rel + ':' + (i + 1) + '  ->columns(' + match[1] + ')'
                + '\n    ' + trimmed.slice(0, 80)
                + '\n    That is ' + match[1] + ' columns at every width, including a phone.');
        }
    });

    checked += (source.match(/->columns\(/g) ?? []).length;
}

if (problems.length > 0) {
    console.error('Column check: ' + problems.length + ' count(s) that do not say what a phone gets.\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error(
        "Filament does not fold an integer for you - Pelican's own code writes\n" +
        "'default' => N explicitly everywhere, which is what settled this. Write\n" +
        "the array instead: ->columns(['default' => 1, 'sm' => 2]). Nothing was built."
    );

    process.exit(1);
}

console.log('Column check: ' + checked + ' column count(s), every one says what a phone gets.');
