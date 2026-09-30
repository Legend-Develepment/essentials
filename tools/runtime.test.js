/*
 * Support\Runtime::tightened(), which is the only thing in this plugin that
 * rewrites code on its way to a browser.
 *
 * It exists because resources/inline/runtime.js is 36.2 KB on disk and 13.0 KB
 * of that is code: the other twenty-three are the comments that make it
 * readable, sent to every browser on every page of the panel. Vite cannot help
 * here - the script has to run before the first paint, so it is inlined - which
 * is why it was the one file nothing stripped.
 *
 * The first version of it walked the file character by character, skipping
 * strings, and ate the regex out of `.replace(/^\/+/, '')`. A regex literal is
 * not a string and telling one from a division needs a parser. So it drops
 * whole lines and only whole lines, which cannot reach inside an expression at
 * all - and the cases below are the ones that version got wrong.
 *
 * The model here is the PHP, rewritten once. When one changes the other has to,
 * which is the price of testing a thing written in a language this repository
 * has no runner for.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/** The same rules as Support\Runtime::tightened(). */
function tightened(js) {
    const out = [];
    let inBlock = false;

    for (const line of js.split(NEWLINE)) {
        const trimmed = line.trim();

        if (inBlock) {
            const at = trimmed.indexOf('*/');

            if (at === -1) { continue; }

            inBlock = false;

            const rest = trimmed.slice(at + 2).trim();

            if (rest !== '') { out.push(rest); }

            continue;
        }

        if (trimmed === '' || trimmed.startsWith('//')) { continue; }

        if (trimmed.startsWith('/*')) {
            const at = trimmed.indexOf('*/', 2);

            if (at === -1) { inBlock = true; continue; }

            const rest = trimmed.slice(at + 2).trim();

            if (rest !== '') { out.push(rest); }

            continue;
        }

        out.push(trimmed);
    }

    return out.join(NEWLINE);
}

console.log('runtime' + NEWLINE);

/* ------------------------------------------------------- what it removes -- */

check('a line comment', tightened('// why' + NEWLINE + 'var a = 1;'), 'var a = 1;');
check('a block comment on one line', tightened('/* why */' + NEWLINE + 'var a = 1;'), 'var a = 1;');
check('a block comment over lines',
    tightened('/*' + NEWLINE + ' * why' + NEWLINE + ' */' + NEWLINE + 'var a = 1;'), 'var a = 1;');
check('blank lines', tightened('var a = 1;' + NEWLINE + NEWLINE + NEWLINE + 'var b = 2;'),
    'var a = 1;' + NEWLINE + 'var b = 2;');
check('indentation', tightened('    var a = 1;'), 'var a = 1;');

/* ---------------------------------------------------- what it must leave -- */

/*
 * The one the character-by-character version got wrong, and the reason this
 * file exists. Everything below is inside a line, so nothing may touch it.
 */
check('a regex holding a slash',
    tightened("var rest = s.replace(/^\\/+/, '');"), "var rest = s.replace(/^\\/+/, '');");
check('a url in a string',
    tightened("var at = 'https://example.invalid/x';"), "var at = 'https://example.invalid/x';");
check('a comment opener inside a string',
    tightened("var s = '/* not a comment */';"), "var s = '/* not a comment */';");
check('a trailing comment stays with its line',
    tightened('var a = 1; // why'), 'var a = 1; // why');
check('a division that looks like nothing',
    tightened('var half = total / 2;'), 'var half = total / 2;');

/* ------------------------------------------------ and the awkward shapes -- */

check('code after a block closes',
    tightened('/* why */ var a = 1;'), 'var a = 1;');
check('code after a block that spanned lines',
    tightened('/*' + NEWLINE + ' * why' + NEWLINE + ' */ var a = 1;'), 'var a = 1;');
check('an unclosed block eats the rest, and says so by being empty',
    tightened('/*' + NEWLINE + ' * why' + NEWLINE + 'var a = 1;'), '');
check('nothing at all', tightened(''), '');
check('only comments', tightened('// one' + NEWLINE + '// two'), '');

/*
 * And the shape of the real file: a heading block, then code, repeatedly. If
 * this one breaks, the panel's first paint is what breaks with it.
 */
const real = [
    '/*',
    ' * Two jobs, both races.',
    ' */',
    '(function () {',
    '    var root = document.documentElement;',
    '',
    '    // stamp the area before the first paint',
    "    root.setAttribute('data-ld-area', area());",
    '}());',
].join(NEWLINE);

check('the shape of the real file', tightened(real), [
    '(function () {',
    'var root = document.documentElement;',
    "root.setAttribute('data-ld-area', area());",
    '}());',
].join(NEWLINE));

console.log(NEWLINE + 'runtime: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
