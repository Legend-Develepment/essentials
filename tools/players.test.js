/*
 * Players::name() and Players::reason(), ported faithfully, against input
 * chosen to get a second command onto a console.
 *
 * PHP semantics reproduced rather than approximated:
 *  - trim() removes exactly " \t\n\r\0\x0B" - notably NOT form feed - where
 *    JavaScript's trim also takes \f,   and non-breaking space. Using the
 *    JS one would make this test more permissive than the code it checks.
 *  - preg_match('/.../D') anchors $ at the true end, which is what a JS regex
 *    without the m flag already does.
 *  - [[:cntrl:]] under /u is Unicode category Cc.
 *  - mb_substr counts characters, not UTF-16 units.
 */
const phpTrim = (s) => {
    const chars = ' \t\n\r\0\v';
    let start = 0;
    let end = s.length;

    while (start < end && chars.includes(s[start])) start++;
    while (end > start && chars.includes(s[end - 1])) end--;

    return s.slice(start, end);
};

const name = (value) => {
    if (typeof value !== 'string') return null;

    const trimmed = phpTrim(value);

    return /^[A-Za-z0-9_]{1,16}$/.test(trimmed) ? trimmed : null;
};

const reason = (value, limit = 120) => {
    if (typeof value !== 'string') return '';

    const clean = value.replace(/\p{Cc}/gu, ' ');

    return phpTrim([...phpTrim(clean)].slice(0, limit).join(''));
};

let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.log('  FAIL ' + label + '\n    got  ' + JSON.stringify(got) + '\n    want ' + JSON.stringify(want));
};

/* ------------------------------------------------------ names: accepted -- */

check('plain', name('Notch'), 'Notch');
check('underscore', name('Some_One'), 'Some_One');
check('digits', name('Player123'), 'Player123');
check('one char', name('a'), 'a');
check('sixteen', name('abcdefghijklmnop'), 'abcdefghijklmnop');
check('padded is trimmed', name('  Notch  '), 'Notch');
check('trailing newline trimmed off', name('Notch\n'), 'Notch');

/* ------------------------------------------------------- names: refused -- */

check('seventeen', name('abcdefghijklmnopq'), null);
check('empty', name(''), null);
check('only spaces', name('   '), null);
check('hyphen', name('some-one'), null);
check('dot', name('some.one'), null);
check('at sign', name('a@b'), null);
check('slash prefix', name('/stop'), null);

// The reason this function exists at all.
check('newline command', name('notch\nstop'), null);
check('return command', name('notch\rstop'), null);
check('crlf command', name('notch\r\nstop'), null);
// A leading newline is trimmed off, leaving the perfectly valid name "stop".
// That is the right answer rather than a hole: one token is one token, and
// `pardon stop` pardons a player called stop. The guarantee here is not that
// alarming input is refused - it is that no input yields two lines, which is
// what the attack table below actually checks.
check('leading newline trims to a real name', name('\nstop'), 'stop');
check('space then command', name('notch stop'), null);
check('semicolon', name('notch;stop'), null);
check('null byte', name('notch\0stop'), null);
check('tab', name('notch\tstop'), null);
check('vertical tab', name('notch\vstop'), null);
check('form feed', name('notch\fstop'), null);
check('trailing form feed - php trim leaves it', name('notch\f'), null);
check('unicode line separator', name('notch' + String.fromCharCode(0x2028) + 'stop'), null);
check('not a string', name(['notch']), null);
check('null input', name(null), null);
check('number input', name(7), null);

/* ------------------------------------------------------------- reasons -- */

check('plain reason', reason('griefing spawn'), 'griefing spawn');
check('comma reason', reason('griefing spawn, third time'), 'griefing spawn, third time');
check('newline becomes space', reason('griefing\nstop'), 'griefing stop');
check('return becomes space', reason('griefing\rstop'), 'griefing stop');
check('crlf becomes two spaces', reason('a\r\nb'), 'a  b');
check('null byte becomes space', reason('a\0b'), 'a b');
check('trimmed', reason('   spaced   '), 'spaced');
check('empty stays empty', reason(''), '');
check('non string', reason(null), '');
check('array', reason(['x']), '');
check('length capped', [...reason('x'.repeat(400))].length, 120);
check('short limit', reason('abcdef', 3), 'abc');
check('accents survive', reason('was onaardig éè'), 'was onaardig éè');

/* -------------------------------------------- the line that gets built -- */

const VERBS = ['whitelist add', 'whitelist remove', 'op', 'deop', 'ban', 'pardon', 'kick'];

const line = (verb, rawName, rawReason) => {
    const safe = name(rawName);

    if (safe === null || !VERBS.includes(verb)) return null;

    return phpTrim(verb + ' ' + safe + ' ' + reason(rawReason));
};

check('ban with reason', line('ban', 'Notch', 'griefing'), 'ban Notch griefing');
check('ban without reason', line('ban', 'Notch', ''), 'ban Notch');
check('whitelist add', line('whitelist add', 'Notch', ''), 'whitelist add Notch');
check('unknown verb refused', line('stop', 'Notch', ''), null);
check('op', line('op', 'Notch', ''), 'op Notch');

/*
 * The property that matters more than any single case: nothing put through
 * either parameter may produce a line containing a control character, because
 * a control character is the only way to make the console see two commands.
 */
const LF = String.fromCharCode(10);
const CR = String.fromCharCode(13);
const NUL = String.fromCharCode(0);
const BELL = String.fromCharCode(7);
const LSEP = String.fromCharCode(0x2028);

const attacks = [
    ['ban', 'Notch' + LF + 'stop', 'x'],
    ['ban', 'Notch', 'griefing' + LF + 'stop'],
    ['kick', 'Notch', 'a' + CR + LF + 'say hacked'],
    ['pardon', LF + 'op attacker', ''],
    ['ban', 'Notch', 'why' + NUL + 'stop'],
    ['ban', 'Notch', 'why' + LSEP + 'stop'],
    ['op', 'Notch', BELL + 'bell'],
    ['ban', 'Not' + NUL + 'ch', 'x'],
];

for (const [verb, who, why] of attacks) {
    const built = line(verb, who, why);
    const controls = built === null ? 0 : (built.match(/\p{Cc}/gu) ?? []).length;

    check('single line: ' + verb + ' ' + JSON.stringify(who) + ' ' + JSON.stringify(why), controls, 0);
}

console.log('\nplayer command safety: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
