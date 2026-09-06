/*
 * Support\Games\Names, ported.
 *
 * Valheim's three lists are one file three times: a header of `//` comment
 * lines the game itself writes, then one identifier per line. The game writes
 * that header, and it is the instructions the next person to open the file in a
 * text editor is going to read - so a page that saved the list back without it
 * would quietly delete them. Keeping it is the promise, and most of this file
 * tests that.
 *
 * The rest is the two decisions that are not obvious. An identifier is
 * validated by what it could not possibly be rather than by what a SteamID64
 * looks like, because a crossplay server writes PlayFab ids and a modded one
 * writes whatever its mod uses. And the list is a set rather than lines,
 * because two of the same admin is a mistake rather than a preference - which
 * is also why same() compares as a set and not as text.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);
const RETURN = String.fromCharCode(13);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const VALID = /^[A-Za-z0-9_.:@-]{1,64}$/;

const valid = (name) => VALID.test(name);

const isComment = (line) => line.startsWith('//') || line.startsWith('#') || line.startsWith(';');

const lines = (contents) => contents.split(/\r\n|\r|\n/);

function parse(contents) {
    const names = [];
    const seen = {};

    for (let line of lines(contents)) {
        line = line.trim();

        if (line === '' || isComment(line)) { continue; }

        const at = line.indexOf('//');

        if (at !== -1) { line = line.slice(0, at).replace(/\s+$/, ''); }

        if (line === '' || !valid(line) || seen[line]) { continue; }

        seen[line] = true;
        names.push(line);
    }

    return names;
}

function header(contents) {
    const out = [];

    for (const line of lines(contents)) {
        const trimmed = line.trim();

        if (trimmed === '') { out.push(''); continue; }

        if (!isComment(trimmed)) { break; }

        out.push(line.replace(/[\r\n]+$/, ''));
    }

    while (out.length > 0 && out[out.length - 1].trim() === '') { out.pop(); }

    return out;
}

function render(contents, names) {
    const out = header(contents);
    const seen = {};

    for (let name of names) {
        name = typeof name === 'object' || name === undefined || name === null ? '' : String(name).trim();

        if (name === '' || !valid(name) || seen[name]) { continue; }

        seen[name] = true;
        out.push(name);
    }

    return out.join(NEWLINE) + NEWLINE;
}

function same(contents, names) {
    const before = parse(contents).slice().sort();
    const after = parse(names.map((n) => (n === undefined || n === null ? '' : String(n))).join(NEWLINE)).slice().sort();

    return JSON.stringify(before) === JSON.stringify(after);
}

console.log('valheim lists\n');

/* -------------------------------------------------------------- reading -- */

const sample = [
    '// List admin players ID  ONE per line',
    '76561198000000001',
    '76561198000000002',
].join(NEWLINE);

check('the names', parse(sample), ['76561198000000001', '76561198000000002']);
check('the header is not a name', parse(sample).length, 2);
check('an empty file has nobody in it', parse(''), []);
check('a file that is only a header', parse('// nobody yet'), []);

check('blank lines are skipped', parse('1234' + NEWLINE + NEWLINE + '5678'), ['1234', '5678']);
check('whitespace around a name', parse('  1234  '), ['1234']);
check('a hash comment', parse('# note' + NEWLINE + '1234'), ['1234']);
check('a semicolon comment', parse('; note' + NEWLINE + '1234'), ['1234']);
check('carriage returns', parse('1234' + RETURN + NEWLINE + '5678'), ['1234', '5678']);

// People annotate these files, and the annotation is worth reading past rather
// than refusing the line over.
check('a note after the id', parse('76561198000000001 // Bryan'), ['76561198000000001']);
check('a note with no space', parse('1234// Bryan'), ['1234']);

check('the same id twice is once', parse('1234' + NEWLINE + '1234'), ['1234']);

/*
 * What is refused is what could not be an identifier, rather than what is not
 * seventeen digits: a PlayFab id is not, and neither is whatever a mod writes.
 */
check('a PlayFab-shaped id is kept', parse('Steam_76561198000000001'), ['Steam_76561198000000001']);
check('an id with a space in it is refused', parse('76561198 000000001'), []);
check('something far too long is refused', parse('x'.repeat(65)), []);
check('exactly sixty-four is kept', parse('x'.repeat(64)), ['x'.repeat(64)]);
check('a quote is refused', parse('12"34'), []);

/* ----------------------------------------------------------- the header -- */

check('the header comes back', header(sample), ['// List admin players ID  ONE per line']);
check('a file with no header has none', header('1234'), []);
check('two header lines', header('// one' + NEWLINE + '// two' + NEWLINE + '1234'), ['// one', '// two']);

// A comment below the list belongs to the line it sits next to, and that line
// is about to be rewritten - so it is not lifted to the top.
check('a comment under the list is not header',
    header('// top' + NEWLINE + '1234' + NEWLINE + '// under'), ['// top']);

// Otherwise a file that is nothing but a header grows a blank line per save.
check('trailing blanks are not kept',
    header('// top' + NEWLINE + NEWLINE + NEWLINE), ['// top']);

check('a blank inside the header is kept',
    header('// one' + NEWLINE + NEWLINE + '// two' + NEWLINE + '1234'), ['// one', '', '// two']);

/* --------------------------------------------------------- the round trip */

// The promise: the game's own instructions survive a save.
{
    const after = render(sample, parse(sample));

    check('the header survived', after.split(NEWLINE)[0], '// List admin players ID  ONE per line');
    check('and so did the names', parse(after), ['76561198000000001', '76561198000000002']);
    check('saving what was read changes nothing', after, sample + NEWLINE);
}

check('a name added', parse(render(sample, ['76561198000000001', '76561198000000002', '99'])),
    ['76561198000000001', '76561198000000002', '99']);
check('a name removed', parse(render(sample, ['76561198000000002'])), ['76561198000000002']);
check('emptied, and the header stays', render(sample, []),
    '// List admin players ID  ONE per line' + NEWLINE);

check('a duplicate from the form is written once',
    parse(render('', ['1234', '1234'])), ['1234']);
check('an invalid one from the form is dropped',
    parse(render('', ['1234', 'has a space'])), ['1234']);
check('whitespace from the form is trimmed',
    parse(render('', ['  1234  '])), ['1234']);

/*
 * A file that ends mid-line is a file some readers drop the last line of, and
 * the game writes one - so the last admin is not the one who stops working.
 */
check('it ends with a newline', render('', ['1234']).endsWith(NEWLINE), true);
check('an empty list with no header is one newline', render('', []), NEWLINE);

/* ------------------------------------------------------- what to skip --- */

/*
 * Three writes on every save would rewrite two files nobody touched, and one of
 * those is a ban list.
 */
check('the same set in the same order', same(sample, ['76561198000000001', '76561198000000002']), true);
check('the same set reordered', same(sample, ['76561198000000002', '76561198000000001']), true);
check('one added', same(sample, ['76561198000000001', '76561198000000002', '3']), false);
check('one removed', same(sample, ['76561198000000001']), false);
check('a duplicate is not a change', same(sample, ['76561198000000001', '76561198000000002', '76561198000000001']), true);
check('an invalid addition is not a change', same(sample, ['76561198000000001', '76561198000000002', 'not valid']), true);
check('empty against empty', same('', []), true);
check('empty against a name', same('', ['1234']), false);
check('a header-only file counts as empty', same('// nobody', []), true);

/*
 * Two ids that a numeric sort would call equal.
 *
 * The PHP sorts with SORT_STRING for this: the default compares numeric strings
 * as numbers, '01' and '1' tie, and two lists holding the same set land in
 * whichever order they arrived in and compare as different.
 */
check('leading zeros, same set', same('01' + NEWLINE + '1', ['1', '01']), true);
check('leading zeros, different set', same('01' + NEWLINE + '1', ['1']), false);

console.log(NEWLINE + 'valheim lists: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
