/*
 * Support\Games\Json, ported.
 *
 * Seven games in roadmap/games.md keep their settings in JSON, and the obvious
 * way to edit one is wrong quietly: decode, change, encode again, and the
 * result is valid JSON that says the same thing and is not the same file. Key
 * order gone, indentation whatever the encoder felt like, a number written
 * 1.000000 come back as 1, and everything the game wrote that this plugin does
 * not understand rewritten in a shape it may or may not read.
 *
 * So the class never encodes the document. It scans the text, remembers where
 * each value begins and ends, and splices new ones in at those exact places.
 * That is what this tests: the round trip, and the two things the scan has to
 * get right for the round trip to be aimed at the correct value.
 *
 * The first of those two was wrong when it was written, which is why it is the
 * first test here. A container recorded how deep the path was *after* pushing
 * its own name, so closing it never let go of itself: everything after an
 * object was still reported as being inside it, and a change aimed at a
 * top-level setting silently found nothing and was dropped.
 */
const NEWLINE = String.fromCharCode(10);

let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const SPACE = ' \t\n\r';

const endOfString = (text, at) => {
    let index = at + 1;

    while (index < text.length) {
        if (text[index] === '\\') { index += 2; continue; }
        if (text[index] === '"') { return index + 1; }
        index++;
    }

    return null;
};

const next = (text, at) => {
    while (at < text.length && SPACE.includes(text[at])) { at++; }

    return at < text.length ? text[at] : '';
};

const where = (path, key, stack) => {
    let last = key;

    if (last === null && stack.length > 0) {
        last = String(stack[stack.length - 1].next++);
    }

    return (last === null ? path : path.concat([last])).join('.');
};

const scan = (text) => {
    const out = {};
    let path = [];
    let at = 0;
    const stack = [];
    let key = null;

    while (at < text.length) {
        const char = text[at];

        if (SPACE.includes(char) || char === ',' || char === ':') { at++; continue; }

        if (char === '{' || char === '[') {
            const depth = path.length;

            if (key !== null) { path = path.concat([key]); key = null; }
            else if (stack.length > 0 && stack[stack.length - 1].list) {
                path = path.concat([String(stack[stack.length - 1].next++)]);
            }

            stack.push({ list: char === '[', next: 0, depth });
            at++;
            continue;
        }

        if (char === '}' || char === ']') {
            const held = stack.pop();

            if (held !== undefined) { path = path.slice(0, held.depth); }

            at++;
            continue;
        }

        if (char === '"') {
            const end = endOfString(text, at);

            if (end === null) { return out; }

            const raw = text.slice(at, end);
            const inside = stack.length > 0 ? stack[stack.length - 1] : null;

            if (inside !== null && !inside.list && key === null && next(text, end) === ':') {
                key = JSON.parse(raw);
                at = end;
                continue;
            }

            out[where(path, key, stack)] = { from: at, to: end, said: JSON.parse(raw), kind: 'text' };
            key = null;
            at = end;
            continue;
        }

        let end = at;

        while (end < text.length && !(SPACE + ',}]').includes(text[end])) { end++; }

        const raw = text.slice(at, end);

        if (raw !== '') {
            out[where(path, key, stack)] = {
                from: at,
                to: end,
                said: raw,
                kind: raw === 'true' || raw === 'false' ? 'bool' : (raw === 'null' ? 'null' : 'number'),
            };
            key = null;
        }

        at = Math.max(end, at + 1);
    }

    return out;
};

const NUMBER = /^-?(0|[1-9][0-9]*)(\.[0-9]+)?([eE][-+]?[0-9]+)?$/;

const written = (kind, value) => {
    const said = String(value).trim();

    if (kind === 'bool') {
        const low = said.toLowerCase();
        if (['true', '1', 'yes', 'on'].includes(low)) { return 'true'; }
        if (['false', '0', 'no', 'off'].includes(low)) { return 'false'; }
        return null;
    }

    if (kind === 'number') { return NUMBER.test(said) ? said : null; }

    if (kind === 'null') { return said === '' ? 'null' : JSON.stringify(said); }

    return JSON.stringify(said);
};

/*
 * Whether this is JSON at all, asked of something other than the scanner.
 *
 * The scanner is lenient by construction: handed something that is nearly JSON
 * it keeps going and reports what it recognised. In a file carrying a
 * `// how many` comment that was three settings named 0, 1 and 2 holding `//`,
 * `how` and `many` - three fields somebody can edit, each of which splices text
 * into the middle of a comment when they do.
 *
 * So the question is asked of a strict parser, and the answer only gates the
 * scan. Nothing decoded here is kept, so key order, spacing and the way numbers
 * are written are as untouched as they ever were.
 */
const sound = (text) => {
    if (text.trim() === '') { return false; }

    try { JSON.parse(text); } catch { return false; }

    return true;
};

const apply = (text, changes) => {
    // Reading a file this cannot account for shows nonsense; writing one
    // splices into it. A document that is not JSON goes back as it arrived.
    if (!sound(text)) { return text; }

    const found = scan(text);
    const edits = [];

    for (const [path, value] of Object.entries(changes)) {
        if (found[path] === undefined) { continue; }

        const out = written(found[path].kind, value);

        if (out === null) { continue; }

        edits.push([found[path].from, found[path].to, out]);
    }

    edits.sort((a, b) => b[0] - a[0]);

    for (const [from, to, out] of edits) {
        text = text.slice(0, from) + out + text.slice(to);
    }

    return text;
};

const parse = (text) => (sound(text)
    ? Object.fromEntries(Object.entries(scan(text)).map(([k, v]) => [k, v.said]))
    : {});

/* ------------------------------------------------------------- the tests -- */

const FILE = [
    '{',
    '    "Name": "V Rising Server",',
    '    "Port": 9876,',
    '    "Secure": true,',
    '    "Rcon": {',
    '        "Enabled": false,',
    '        "Password": ""',
    '    },',
    '    "AdminList": ["alice", "bob"],',
    '    "Rate": 1.000000',
    '}',
].join('\n');

/* A setting after a nested object belongs to the document, not to the object. */
check('a path lets go of the object it followed', Object.keys(parse(FILE)), [
    'Name', 'Port', 'Secure', 'Rcon.Enabled', 'Rcon.Password', 'AdminList.0', 'AdminList.1', 'Rate',
]);

check('an array counts its own places', parse(FILE)['AdminList.1'], 'bob');
check('a nested value keeps its parent', parse(FILE)['Rcon.Enabled'], 'false');

/* The round trip, which is the whole promise. */
check('nothing changed is nothing moved', apply(FILE, {}), FILE);

check('a number keeps the zeros it was written with',
    apply(FILE, { Rate: '2.500000' }).includes('"Rate": 2.500000'), true);

check('a number is not rewritten by a cast',
    apply(FILE, { Rate: '1.000000' }), FILE);

check('a boolean says true or false, not 1',
    apply(FILE, { Secure: '0' }).includes('"Secure": false'), true);

check('a string is quoted and escaped',
    apply(FILE, { Name: 'He said "hi"' }).includes('"Name": "He said \\"hi\\""'), true);

/* The refusal, which is the other half of the promise. */
check('letters in a number are refused rather than written',
    apply(FILE, { Port: 'nine thousand' }).includes('"Port": 9876'), true);

check('a word that is not a boolean is refused',
    apply(FILE, { Secure: 'perhaps' }).includes('"Secure": true'), true);

check('a path the file does not have changes nothing',
    apply(FILE, { Nonsense: 'x' }), FILE);

/* Several edits at once, which is what a form sends. */
const many = apply(FILE, { Name: 'Legend', 'Rcon.Password': 'secret', 'AdminList.0': 'carol', Port: '1234' });

check('every edit lands', [
    many.includes('"Name": "Legend"'),
    many.includes('"Password": "secret"'),
    many.includes('["carol", "bob"]'),
    many.includes('"Port": 1234'),
], [true, true, true, true]);

check('and the file is the same length in lines', many.split('\n').length, FILE.split('\n').length);
check('and it is still JSON', typeof JSON.parse(many), 'object');

/* Things a scan can be walked off the end by. */
/*
 * Nothing, and not a half-read value.
 *
 * The key is read, the value it points at never ends, and the scan gives up
 * where it stands. Recording the key with whatever text happened to follow it
 * would be the one outcome worth avoiding: a form would then offer that as a
 * setting, and saving it would write a value into a file the scan never
 * understood.
 */
check('an unterminated string is not a setting',
    Object.keys(parse('{"a": "unclosed')), []);

check('a comma inside a string is not a separator',
    parse('{"a": "one, two", "b": 3}'), { a: 'one, two', b: '3' });

check('a colon inside a string is not a key marker',
    parse('{"a": "10:30", "b": 3}'), { a: '10:30', b: '3' });

check('an escaped quote inside a string is not the end of it',
    parse('{"a": "say \\"no\\"", "b": 3}'), { a: 'say "no"', b: '3' });

check('an empty document yields nothing', parse('{}'), {});

/* ----------------------------------------------- what is not JSON at all -- */

/*
 * These came out of surveying games this plugin does not have. Starbound writes
 * a documented JSON superset with // and /* *\/ comments in it, and several
 * other candidates turned out to be JSON in a file named .cfg or .txt. The
 * games that are built here write strict JSON - but a person adding a note to
 * their own config file writes a comment, and until this was added the page
 * answered that with three editable fields named 0, 1 and 2.
 *
 * The rule is the same for both halves: nothing read, and nothing written.
 */
check('a comment makes the file unreadable rather than half readable',
    parse('{' + NEWLINE + '  // how many' + NEWLINE + '  "maxPlayers": 8' + NEWLINE + '}'), {});

check('a trailing comma too',
    parse('{"a": 1, "b": 2,}'), {});

check('and an unquoted key',
    parse('{a: 1}'), {});

check('and a single quoted string',
    parse("{'a': 1}"), {});

check('an empty file reads as nothing rather than as a fault',
    parse(''), {});

check('and so does one that is only whitespace',
    parse('   ' + NEWLINE + '  '), {});

const BROKEN = '{' + NEWLINE + '  // how many' + NEWLINE + '  "maxPlayers": 8' + NEWLINE + '}';

check('a file this cannot account for is written back byte for byte',
    apply(BROKEN, { maxPlayers: '12' }), BROKEN);

check('even when asked to change something it could see',
    apply('{"a": 1,}', { a: '2' }), '{"a": 1,}');

/*
 * And the other half of that promise: a real file still round trips. A guard
 * that refused everything would pass every check above and be useless.
 */
check('a real file is still read', Object.keys(parse(FILE)).length > 0, true);
check('and still written', apply(FILE, { Port: '1234' }).includes('"Port": 1234'), true);

/* --------------------------------------------------------------- verdict -- */

if (fail > 0) {
    console.error('\nJSON reader: ' + fail + ' failure(s). Nothing was built.');
    process.exit(1);
}

console.log('JSON reader: ' + pass + ' check(s), the round trip holds and a value that will not fit is refused.');
