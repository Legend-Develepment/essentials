/*
 * Resources::filename() and Resources::folder(), against names chosen to write
 * or delete outside the folder they were supposed to be in.
 *
 * This is the boundary worth testing hardest on that page, because the name is
 * the one part an attacker could choose and one of its two uses is deleteFiles.
 * The name arrives from a Livewire action argument - which is to say, from the
 * browser - and the list it was drawn from is no guarantee of anything.
 *
 * PHP semantics reproduced: trim() takes " \t\n\r\0\x0B", mb_strlen counts
 * characters, and str_ends_with(strtolower(...)) is a byte comparison after a
 * lowercase.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.log('  FAIL ' + label + '\n    got  ' + JSON.stringify(got) + '\n    want ' + JSON.stringify(want));
};

const phpTrim = (s) => {
    const chars = ' \t\n\r\0\v';
    let a = 0;
    let b = s.length;
    while (a < b && chars.includes(s[a])) a++;
    while (b > a && chars.includes(s[b - 1])) b--;
    return s.slice(a, b);
};

const filename = (value) => {
    if (typeof value !== 'string') return null;

    const name = phpTrim(value);

    if (name === '' || [...name].length > 200) return null;
    if (name.includes('/') || name.includes('\\') || name.includes('\0')) return null;
    if (!name.toLowerCase().endsWith('.jar')) return null;

    return name;
};

/*
 * A null-prototype object, because a PHP array is one and a JavaScript object
 * literal is not.
 *
 * Written as `{ mod: ..., plugin: ... }` first, and the two cases at the bottom
 * of the folder block caught it: FOLDERS['__proto__'] handed back
 * Object.prototype and FOLDERS['constructor'] handed back a function, neither
 * of which is null, so `?? null` let both through. PHP has no prototype chain
 * and returns null for both, so the code under test was never affected - but a
 * harness that is more permissive than the thing it checks is a harness that
 * will one day pass something real.
 */
const FOLDERS = Object.assign(Object.create(null), { mod: 'mods', plugin: 'plugins' });
const folder = (type) => (typeof type === 'string' ? (FOLDERS[type] ?? null) : null);

/* --------------------------------------------------------- accepted ----- */

check('a plain jar', filename('vault.jar'), 'vault.jar');
check('version in the name', filename('EssentialsX-2.20.1.jar'), 'EssentialsX-2.20.1.jar');
check('uppercase extension', filename('Vault.JAR'), 'Vault.JAR');
check('mixed extension', filename('Vault.Jar'), 'Vault.Jar');
check('spaces inside', filename('my plugin.jar'), 'my plugin.jar');
check('padded', filename('  vault.jar  '), 'vault.jar');
check('unicode name', filename('モッド.jar'), 'モッド.jar');
check('plus and brackets', filename('mod[1.20]+fabric.jar'), 'mod[1.20]+fabric.jar');

/* ---------------------------------------------------------- refused ----- */

// The whole reason this function exists: it is joined to a folder and handed to
// the daemon as a path to write to or delete.
check('parent directory', filename('../server.properties'), null);
check('parent with jar', filename('../evil.jar'), null);
check('deep traversal', filename('../../../../etc/passwd.jar'), null);
check('absolute', filename('/etc/passwd.jar'), null);
check('windows separator', filename('..\\evil.jar'), null);
check('windows absolute', filename('C:\\evil.jar'), null);
check('subfolder', filename('nested/evil.jar'), null);
check('null byte truncation', filename('good.jar\0../evil'), null);
check('null byte before extension', filename('evil\0.jar'), null);

check('bare dot', filename('.'), null);
check('bare dotdot', filename('..'), null);
check('empty', filename(''), null);
check('only spaces', filename('   '), null);
check('no extension', filename('vault'), null);
check('wrong extension', filename('server.properties'), null);
check('disabled jar is not a jar', filename('vault.jar.disabled'), null);
check('jar in the middle', filename('vault.jar.txt'), null);
check('too long', filename('x'.repeat(198) + '.jar'), null);
check('exactly two hundred', filename('x'.repeat(196) + '.jar'), 'x'.repeat(196) + '.jar');
check('not a string', filename(['vault.jar']), null);
check('null', filename(null), null);
check('number', filename(42), null);

/* ----------------------------------------------------------- folder ----- */

check('mod', folder('mod'), 'mods');
check('plugin', folder('plugin'), 'plugins');
check('unknown type', folder('shader'), null);
check('empty type', folder(''), null);
check('traversal as a type', folder('../..'), null);
check('prototype pollution attempt', folder('constructor'), null);
check('__proto__', folder('__proto__'), null);
check('not a string', folder(null), null);

/*
 * The property that matters: whatever comes out of these two, joined the way
 * install() and remove() join them, is a path one level below a known folder
 * and nowhere else.
 */
for (const [type, name] of [
    ['mod', 'vault.jar'],
    ['plugin', 'EssentialsX.jar'],
    ['mod', '../evil.jar'],
    ['shader', 'vault.jar'],
    ['mod', '/etc/passwd.jar'],
    ['plugin', 'a\0b.jar'],
]) {
    const f = folder(type);
    const n = filename(name);
    const path = (f === null || n === null) ? null : f + '/' + n;

    check(
        'path for ' + JSON.stringify(type) + ' ' + JSON.stringify(name),
        path === null ? 'refused' : (/^(mods|plugins)\/[^/\\\0]+\.jar$/i.test(path) ? 'safe' : 'ESCAPED: ' + path),
        path === null ? 'refused' : 'safe',
    );
}


/* ----------------------------------------------------------- ledger ----- */

/*
 * Two more strings that become something with authority: the project slug goes
 * into a Modrinth URL, and the server uuid becomes a filename under
 * storage/app. Both are read back out of a JSON file on disk - which is a file
 * a person can edit - so neither is trusted for having been written by this
 * plugin in the first place.
 */
const slugOk = (v) => (typeof v === 'string'
    && /^[A-Za-z0-9!@$()`.+,_"-]{1,100}$/.test(v)) ? v : null;

check('plain slug', slugOk('essentialsx'), 'essentialsx');
check('hyphenated slug', slugOk('fabric-api'), 'fabric-api');
check('slug with a dot', slugOk('mod.name'), 'mod.name');
check('slug with a plus', slugOk('mod+extra'), 'mod+extra');

check('slug with a slash', slugOk('../../etc/passwd'), null);
check('slug that is a path', slugOk('a/b'), null);
check('slug with a backslash', slugOk('a' + String.fromCharCode(92) + 'b'), null);
check('slug with a space', slugOk('two words'), null);
check('slug with a newline', slugOk('good' + String.fromCharCode(10) + 'bad'), null);
check('empty slug', slugOk(''), null);
check('slug too long', slugOk('x'.repeat(101)), null);
check('slug not a string', slugOk(null), null);
check('slug with a colon', slugOk('http://x'), null);

const uuidOk = (v) => /^[0-9a-fA-F-]{8,64}$/.test(String(v)) ? v : null;

check('a real uuid', uuidOk('9f1c2b3d-4e5f-6071-8293-a4b5c6d7e8f9'), '9f1c2b3d-4e5f-6071-8293-a4b5c6d7e8f9');
check('short uuid', uuidOk('9f1c2b3d'), '9f1c2b3d');
check('uuid with traversal', uuidOk('../../../evil'), null);
check('uuid with a slash', uuidOk('a/b/c/d/e/f/g/h'), null);
check('uuid with a dot', uuidOk('9f1c2b3d.json'), null);
check('empty uuid', uuidOk(''), null);
check('uuid too long', uuidOk('a'.repeat(65)), null);
check('uuid with a null byte', uuidOk('9f1c2b3d' + String.fromCharCode(0)), null);

console.log('\nresource path safety: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
