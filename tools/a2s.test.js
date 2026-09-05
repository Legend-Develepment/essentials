/*
 * Support\Games\A2S, ported, against packets rather than against hope.
 *
 * This parses a few hundred bytes that arrived over UDP from a machine on the
 * internet which may not be running the game at all - may not be running a game
 * - and turns them into two numbers a public status page prints. Everything
 * about that says the parser is the part to test and the socket is not.
 *
 * The Minecraft ping earned this the hard way: three of its tests failed on the
 * first run, two because the expectation was wrong and one because a declared
 * length was longer than the body it described. That last one is the whole
 * reason this file exists.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ---------------------------------------------------------- building one -- */

const HEAD = '\xFF\xFF\xFF\xFF';

/** A2S_INFO reply, assembled the way a real server does. */
function info({ name = 'Test', map = 'Procedural', folder = 'rust', game = 'Rust', online = 0, max = 100, id = 252490 } = {}) {
    let out = HEAD + 'I' + '\x11';

    out += name + '\x00' + map + '\x00' + folder + '\x00' + game + '\x00';
    out += String.fromCharCode(id & 0xff, (id >> 8) & 0xff);
    out += String.fromCharCode(online, max, 0);
    out += 'd' + 'l' + '\x00' + '\x00';
    out += '2020.1.1' + '\x00';

    return out;
}

/* --------------------------------------------------------- the port of it -- */

function challenge(reply) {
    if (reply.length < 9 || reply[4] !== 'A') { return null; }
    return reply.slice(5, 9);
}

function readable(reply) {
    if (typeof reply !== 'string' || reply.length < 5) { return null; }
    return reply.startsWith(HEAD) ? reply : null;
}

function str(reply, at) {
    const end = reply.indexOf('\x00', at.i);
    if (end === -1) { return null; }
    const value = reply.slice(at.i, end);
    at.i = end + 1;
    return value;
}

function clean(value) {
    // Control characters, and the same range the PHP strips.
    const stripped = value.replace(new RegExp('[' + '\\u0000-\\u001F\\u007F' + ']+', 'g'), ' ');
    return stripped.replace(/\s+/g, ' ').trim().slice(0, 60);
}

function parse(reply) {
    if (reply.length < 6 || reply[4] !== 'I') { return null; }

    const at = { i: 6 };

    const name = str(reply, at);
    const map = str(reply, at);
    const folder = str(reply, at);
    const game = str(reply, at);

    if (name === null || map === null || folder === null || game === null) { return null; }

    at.i += 2;

    if (at.i + 2 >= reply.length) { return null; }

    const online = reply.charCodeAt(at.i);
    const max = reply.charCodeAt(at.i + 1);

    if (max > 0 && online > max) { return null; }

    return { online, max, name: clean(name), map: clean(map) };
}

console.log('Valve server query\n');

/* -------------------------------------------------------------- the happy -- */

check('an empty server', parse(info({ online: 0, max: 100 })), { online: 0, max: 100, name: 'Test', map: 'Procedural' });
check('a busy one', parse(info({ online: 87, max: 100 })), { online: 87, max: 100, name: 'Test', map: 'Procedural' });
check('a full one', parse(info({ online: 100, max: 100 })), { online: 100, max: 100, name: 'Test', map: 'Procedural' });
check('the name comes through', parse(info({ name: 'L3G3 CLAN | Rust' })).name, 'L3G3 CLAN | Rust');
check('and the map', parse(info({ map: 'TheIsland' })).map, 'TheIsland');

// A slot count of zero is what a few games report rather than a real maximum,
// and it must not be mistaken for "full".
check('no maximum reported', parse(info({ online: 4, max: 0 })), { online: 4, max: 0, name: 'Test', map: 'Procedural' });

/* ------------------------------------------------------- and the unhappy -- */

check('not a reply at all', readable('hello'), null);
check('too short to be one', readable(HEAD), null);
check('a real one is readable', readable(info()), info());

check('a challenge is spotted', challenge(HEAD + 'A' + 'wxyz'), 'wxyz');
check('an answer is not a challenge', challenge(info()), null);
check('a truncated challenge is not one', challenge(HEAD + 'A' + 'wx'), null);

// The reply to a question this did not ask.
check('a player-list reply is refused', parse(HEAD + 'D' + '\x00'), null);
check('a challenge reaching the parser is refused', parse(HEAD + 'A' + 'wxyz'), null);

/*
 * A string with no terminator.
 *
 * The failure that matters: without the check, this returns the rest of the
 * packet as a name and leaves the cursor past the end, and the two numbers come
 * from whatever was there.
 */
check('an unterminated name is refused', parse(HEAD + 'I' + '\x11' + 'no terminator here'), null);
check('a reply that stops mid-way is refused', parse(HEAD + 'I' + '\x11' + 'a\x00b\x00c\x00d\x00'), null);

/*
 * More players than slots.
 *
 * Some other protocol whose bytes happen to land in the right places. Refused
 * rather than shown, because a public page saying 214/3 is worse than one
 * saying nothing.
 */
check('more players than slots is refused', parse(info({ online: 214, max: 3 })), null);

/* ------------------------------------------------------------- the names -- */

// Typed by whoever runs the server, and printed on a page.
check('colour codes and control characters go', clean('\x01Red\x02 Server\x03'), 'Red Server');
check('runs of whitespace collapse', clean('Rust    |    EU'), 'Rust | EU');
check('a very long name is cut', clean('x'.repeat(200)).length, 60);
check('an empty name stays empty', clean('   '), '');

console.log('\nValve server query: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
