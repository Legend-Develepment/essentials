/*
 * Support\Games\Ini, ported.
 *
 * ARK's GameUserSettings.ini is mostly keys this plugin has never heard of -
 * mods add their own - and a settings page that wiped them would be a settings
 * page that broke somebody's server the first time they used it. So the promise
 * is a round trip: change one value, and every comment, every blank line, every
 * unknown key and the order of all of it comes back exactly as it went in.
 *
 * That promise is what most of this file tests. The rest is the section
 * handling, which is the one thing this format has that server.properties does
 * not, and the one thing the obvious implementation gets wrong: the same key
 * appears under two headings with different meanings, and a new key put after
 * the file's last line lands under whatever heading happened to be last.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const lines = (contents) => contents.split(/\r\n|\r|\n/);

const sectionOf = (line) => {
    const t = line.trim();

    if (t.length < 3 || t[0] !== '[' || !t.endsWith(']')) { return null; }

    const name = t.slice(1, -1).trim();

    return /^[A-Za-z0-9_./-]{1,80}$/.test(name) ? name : null;
};

const validKey = (key) => /^[A-Za-z0-9_.[\]-]{1,80}$/.test(key);

const keyOf = (line) => {
    const t = line.trim();

    if (t === '' || t[0] === ';' || t[0] === '#') { return null; }

    const at = t.indexOf('=');

    if (at === -1 || at === 0) { return null; }

    const key = t.slice(0, at).replace(/\s+$/, '');

    return validKey(key) ? key : null;
};

const text = (value) => {
    if (typeof value === 'boolean') { return value ? 'True' : 'False'; }

    return String(value).replace(/\r\n|\r|\n/g, ' ').trim();
};

function parse(contents) {
    const values = {};
    let section = '';

    for (const line of lines(contents)) {
        const heading = sectionOf(line);

        if (heading !== null) { section = heading; continue; }

        const key = keyOf(line);

        if (key === null) { continue; }

        values[(section === '' ? '' : section + '.') + key] =
            line.trim().slice(line.trim().indexOf('=') + 1).trim();
    }

    return values;
}

function apply(contents, changes) {
    const out = lines(contents);
    const endOf = {};
    const written = {};
    let section = '';

    out.forEach((line, index) => {
        const heading = sectionOf(line);

        if (heading !== null) { section = heading; endOf[section] = index; return; }

        endOf[section] = index;

        const key = keyOf(line);

        if (key === null) { return; }

        const full = (section === '' ? '' : section + '.') + key;

        if (!(full in changes)) { return; }

        out[index] = key + '=' + text(changes[full]);
        written[full] = true;
    });

    const adding = {};

    for (const [full, value] of Object.entries(changes)) {
        if (written[full]) { continue; }

        const at = full.lastIndexOf('.');
        const s = at === -1 ? '' : full.slice(0, at);
        const key = at === -1 ? full : full.slice(at + 1);

        if (!validKey(key)) { continue; }

        (adding[s] ??= []).push(key + '=' + text(value));
    }

    // Furthest down the file first, or an earlier splice moves the later one.
    const order = Object.keys(adding).sort((a, b) => (endOf[b] ?? -1) - (endOf[a] ?? -1));

    for (const s of order) {
        if (s in endOf) {
            out.splice(endOf[s] + 1, 0, ...adding[s]);
            continue;
        }

        out.push('', '[' + s + ']', ...adding[s]);
    }

    return out.join(NEWLINE);
}

console.log('ARK ini\n');

/* -------------------------------------------------------------- reading -- */

const sample = [
    '; A comment at the top',
    '[ServerSettings]',
    'ServerPassword=hunter2',
    'DifficultyOffset=1.0',
    '',
    '[SessionSettings]',
    'SessionName=L3G3 CLAN',
    'Port=7777',
].join(NEWLINE);

check('a value under its section', parse(sample)['ServerSettings.ServerPassword'], 'hunter2');
check('another section', parse(sample)['SessionSettings.SessionName'], 'L3G3 CLAN');
check('a comment is not a key', parse(sample)['; A comment at the top'], undefined);
check('how many settings', Object.keys(parse(sample)).length, 4);

// The reason a section is part of the key at all.
{
    const both = ['[A]', 'Port=1', '[B]', 'Port=2'].join(NEWLINE);

    check('the same key in two sections', [parse(both)['A.Port'], parse(both)['B.Port']], ['1', '2']);
}

check('a key before any heading', parse('Loose=yes')['Loose'], 'yes');
check('spaces around the equals', parse('[A]' + NEWLINE + 'Key = value')['A.Key'], 'value');
check('a semicolon comment', parse('[A]' + NEWLINE + '; Key=value')['A.Key'], undefined);
check('a hash comment', parse('[A]' + NEWLINE + '# Key=value')['A.Key'], undefined);
check('a value containing an equals', parse('[A]' + NEWLINE + 'K=a=b')['A.K'], 'a=b');
check('an empty value', parse('[A]' + NEWLINE + 'K=')['A.K'], '');

/* --------------------------------------------------------- the round trip */

// The promise. One value changed, everything else identical.
{
    const after = apply(sample, { 'ServerSettings.ServerPassword': 'newone' });

    check('the change landed', parse(after)['ServerSettings.ServerPassword'], 'newone');
    check('nothing else moved', after.split(NEWLINE).length, sample.split(NEWLINE).length);
    check('the comment survived', after.split(NEWLINE)[0], '; A comment at the top');
    check('the blank line survived', after.split(NEWLINE)[4], '');
    check('the other section is untouched', parse(after)['SessionSettings.Port'], '7777');
}

check('changing nothing changes nothing', apply(sample, {}), sample);

// Windows line endings are normalised, and that is the only rewriting done.
check('crlf comes back as lf',
    apply('[A]\r\nK=1', { 'A.K': '2' }), '[A]' + NEWLINE + 'K=2');

/* ------------------------------------------------------------ new values -- */

/*
 * A key the file does not have goes inside its own section.
 *
 * Appending it to the end of the file would put it under whatever heading
 * happens to be last, and a setting under the wrong heading is a setting ARK
 * will not read. This is the failure the obvious implementation has.
 */
{
    const after = apply(sample, { 'ServerSettings.NewOne': 'yes' });
    const rows = after.split(NEWLINE);

    check('the new key is in its section', parse(after)['ServerSettings.NewOne'], 'yes');
    check('and not in the other one', parse(after)['SessionSettings.NewOne'], undefined);
    check('it sits before the next heading', rows.indexOf('NewOne=yes') < rows.indexOf('[SessionSettings]'), true);
}

// Two sections at once, which is where a top-down splice puts the second one in
// the wrong place.
{
    const after = apply(sample, { 'ServerSettings.One': '1', 'SessionSettings.Two': '2' });

    check('both land in their own section', [
        parse(after)['ServerSettings.One'],
        parse(after)['SessionSettings.Two'],
    ], ['1', '2']);

    check('and nothing crossed over', [
        parse(after)['SessionSettings.One'],
        parse(after)['ServerSettings.Two'],
    ], [undefined, undefined]);
}

{
    const after = apply(sample, { 'NewSection.Key': 'v' });

    check('a section the file lacks is added', parse(after)['NewSection.Key'], 'v');
    check('with its heading', after.includes('[NewSection]'), true);
    check('after everything that was there', after.indexOf('[NewSection]') > after.indexOf('Port=7777'), true);
}

/* ----------------------------------------------------------- the values -- */

check('a boolean is capitalised the way Unreal reads it',
    parse(apply('[A]' + NEWLINE + 'K=False', { 'A.K': true }))['A.K'], 'True');
check('and false too',
    parse(apply('[A]' + NEWLINE + 'K=True', { 'A.K': false }))['A.K'], 'False');
check('a number', parse(apply('[A]' + NEWLINE + 'K=1', { 'A.K': 2.5 }))['A.K'], '2.5');

/*
 * A newline in a value would turn one setting into two, which is the only thing
 * here that can change what the file means. Nothing else is escaped: Unreal
 * takes the rest of the line as the value, quotes and semicolons and all.
 */
check('a newline in a value becomes a space',
    parse(apply('[A]' + NEWLINE + 'K=x', { 'A.K': 'a' + NEWLINE + 'b' }))['A.K'], 'a b');
check('a quote is left alone',
    parse(apply('[A]' + NEWLINE + 'K=x', { 'A.K': 'say "hi"' }))['A.K'], 'say "hi"');
check('a semicolon is left alone',
    parse(apply('[A]' + NEWLINE + 'K=x', { 'A.K': 'a;b' }))['A.K'], 'a;b');

check('a key that is not one is refused', apply('[A]' + NEWLINE + 'K=1', { 'A.bad key': 'v' }),
    '[A]' + NEWLINE + 'K=1');

console.log(NEWLINE + 'ARK ini: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
