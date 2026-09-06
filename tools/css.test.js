/*
 * CustomCss::check(), ported.
 *
 * The custom CSS field goes into the page exactly as typed - that is the point
 * of it - so a stray brace swallows every rule after itself and the panel's
 * styling is broken until somebody finds it. It has been a known rough edge in
 * the backlog since the backlog was written.
 *
 * The check is deliberately not a parser. It counts two things, and the tests
 * that matter are the ones where counting naively gets it wrong: a brace inside
 * a string, a brace inside a comment, and a quote that was never closed. Those
 * are the false alarms that would make somebody stop reading the warning, which
 * is worse than not having one.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------- the port -- */

const NEWLINE = String.fromCharCode(10);
const BACKSLASH = String.fromCharCode(92);

/** Past a quoted string, or back where it started if it never ends. */
function past(css, at, quote) {
    for (let i = at + 1; i < css.length; i++) {
        if (css[i] === BACKSLASH) { i++; continue; }
        if (css[i] === NEWLINE) { return at; }
        if (css[i] === quote) { return i; }
    }

    return at;
}

/** null when nothing is obviously wrong, otherwise 'unclosed:N', 'extra:N' or 'comment:N'. */
function inspect(css) {
    let depth = 0;
    let openedAt = 0;
    let line = 1;

    for (let at = 0; at < css.length; at++) {
        const char = css[at];

        if (char === NEWLINE) { line++; continue; }

        if (char === '/' && css[at + 1] === '*') {
            const end = css.indexOf('*/', at + 2);

            if (end === -1) { return 'comment:' + line; }

            line += css.slice(at, end).split(NEWLINE).length - 1;
            at = end + 1;
            continue;
        }

        if (char === '"' || char === "'") {
            at = past(css, at, char);
            continue;
        }

        if (char === '{') {
            if (depth === 0) { openedAt = line; }
            depth++;
        } else if (char === '}') {
            depth--;
            if (depth < 0) { return 'extra:' + line; }
        }
    }

    return depth > 0 ? 'unclosed:' + openedAt : null;
}

console.log('custom css\n');

/* ------------------------------------------------------- nothing wrong --- */

check('empty', inspect(''), null);
check('one rule', inspect('body { color: red; }'), null);
check('two rules', inspect('a { color: red; }' + NEWLINE + 'b { color: blue; }'), null);
check('nested, as a media query is', inspect('@media (min-width: 40rem) { body { color: red; } }'), null);
check('a rule with no declarations', inspect('body {}'), null);
check('only a comment', inspect('/* nothing here */'), null);

/* ------------------------------------------------------- what it is for -- */

// The fault that actually happens.
check('a rule left open', inspect('body { color: red'), 'unclosed:1');
check('and it says which line', inspect(NEWLINE + NEWLINE + 'body { color: red'), 'unclosed:3');
check('the outer one of two', inspect('@media screen { body { color: red; }'), 'unclosed:1');

check('one brace too many', inspect('body { color: red; } }'), 'extra:1');
check('reported where it is', inspect('a { }' + NEWLINE + 'b { }' + NEWLINE + '}'), 'extra:3');

check('a comment left open', inspect('body { color: red; }' + NEWLINE + '/* what was I'), 'comment:2');

/* --------------------------------------------------- and the false alarms - */

/*
 * Everything below would be a warning on a naive count, and every one of them
 * is valid CSS somebody writes. A check that cries wolf here is a check people
 * stop reading, which is worse than not having one.
 */
check('a brace inside a string', inspect('a::after { content: "}"; }'), null);
check('two of them', inspect('a::before { content: "{"; } a::after { content: "}"; }'), null);
check('single quotes too', inspect("a::after { content: '}'; }"), null);
check('a brace inside a comment', inspect('/* } */ body { color: red; }'), null);
check('a rule commented out', inspect('/* body { color: red; */ a { color: blue; }'), null);
check('an escaped quote inside a string', inspect('a::after { content: "say ' + BACKSLASH + '"hi' + BACKSLASH + '""; }'), null);
check('a brace in a url', inspect('body { background: url("a{b.png"); }'), null);

/*
 * A quote that is never closed.
 *
 * The parser must not then read the rest of the file as a string and miss every
 * brace in it - that would turn one typo into silence about a second. CSS
 * strings cannot span a line unescaped, so the line ending gives up and the
 * counting carries on.
 */
check('an unterminated quote does not swallow the file',
    inspect('a { content: "oops' + NEWLINE + 'b { color: red;'), 'unclosed:1');

// Lines are counted inside comments too, or every warning after a long comment
// block points at the wrong place.
check('lines inside a comment still count',
    inspect('/*' + NEWLINE + NEWLINE + NEWLINE + '*/' + NEWLINE + 'body { color: red'), 'unclosed:5');

console.log(NEWLINE + 'custom css: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
