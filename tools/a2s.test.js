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


/* ------------------------------------------------------------- A2S_PLAYER -- */

/*
 * The second question, and the one with a length field in it.
 *
 * A2S_INFO has no counted list; this does, and the count is one byte from a
 * machine on the internet. A parser that loops on it reads past the end of the
 * packet the moment it disagrees with what follows - which is the same fault
 * the Minecraft ping had, found by a test, and the reason this file exists.
 */

/** A2S_PLAYER reply, assembled the way a real server does. */
function playerReply(players, declared) {
    let out = HEAD + 'D' + String.fromCharCode(declared ?? players.length);

    for (const p of players) {
        out += String.fromCharCode(0);
        out += p.name + '\x00';
        out += le32(p.score ?? 0);
        out += f32(p.seconds ?? 0);
    }

    return out;
}

function le32(value) {
    const buffer = Buffer.alloc(4);
    buffer.writeInt32LE(value);
    return buffer.toString('latin1');
}

function f32(value) {
    const buffer = Buffer.alloc(4);
    buffer.writeFloatLE(value);
    return buffer.toString('latin1');
}

/** Ported from A2S::parsePlayers(). */
function parsePlayers(reply) {
    if (reply.length < 6 || reply[4] !== 'D') { return null; }

    const count = reply.charCodeAt(5);
    const at = { i: 6 };
    const out = [];

    for (let i = 0; i < count && at.i < reply.length; i++) {
        at.i += 1;

        const name = str(reply, at);

        if (name === null || at.i + 8 > reply.length) { break; }

        const bytes = Buffer.from(reply.slice(at.i, at.i + 8), 'latin1');
        const score = bytes.readInt32LE(0);
        const seconds = bytes.readFloatLE(4);

        at.i += 8;

        const clean_ = clean(name);

        if (clean_ === '') { continue; }

        out.push({ name: clean_, score, minutes: Math.max(0, Math.round(seconds / 60)) });
    }

    return out;
}

check('nobody on', parsePlayers(playerReply([])), []);

check('one player', parsePlayers(playerReply([{ name: 'Bryan', score: 12, seconds: 3600 }])),
    [{ name: 'Bryan', score: 12, minutes: 60 }]);

check('three of them', parsePlayers(playerReply([
    { name: 'a', score: 1, seconds: 60 },
    { name: 'b', score: 2, seconds: 120 },
    { name: 'c', score: 3, seconds: 180 },
])).length, 3);

// Seconds are a float and nobody reads "4187 seconds".
check('seconds become minutes', parsePlayers(playerReply([{ name: 'a', seconds: 4187 }]))[0].minutes, 70);
check('under a minute rounds to nought', parsePlayers(playerReply([{ name: 'a', seconds: 20 }]))[0].minutes, 0);

// Rust reports a negative score for a player who has died more than they killed.
check('a negative score survives', parsePlayers(playerReply([{ name: 'a', score: -5 }]))[0].score, -5);

/*
 * The count is read and then not trusted.
 *
 * A byte that says twelve on a packet holding two is what a parser looping on
 * the count reads past the end of. The loop stops at whichever comes first.
 */
check('a count larger than the data', parsePlayers(playerReply([{ name: 'a' }, { name: 'b' }], 12)).length, 2);
check('a count of nought with data in it', parsePlayers(playerReply([{ name: 'a' }], 0)).length, 0);
check('an entry cut off mid-way', parsePlayers(HEAD + 'D' + String.fromCharCode(1) + '\x00' + 'abc\x00' + 'xx').length, 0);
check('a name with no terminator', parsePlayers(HEAD + 'D' + String.fromCharCode(1) + '\x00' + 'no end here').length, 0);

// A slot rather than a person: Rust reports one while somebody is connecting.
check('a nameless entry is skipped', parsePlayers(playerReply([{ name: '' }, { name: 'b' }])),
    [{ name: 'b', score: 0, minutes: 0 }]);

check('an info reply is not a player reply', parsePlayers(info()), null);
check('a challenge is not either', parsePlayers(HEAD + 'A' + 'wxyz'), null);
check('too short', parsePlayers(HEAD + 'D'), null);

// Names come from players rather than from an administrator, and go on a page.
check('a colour-coded name is cleaned',
    parsePlayers(playerReply([{ name: String.fromCharCode(1) + 'Red' + String.fromCharCode(2) + ' Player' }]))[0].name,
    'Red Player');

console.log('\nValve server query: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
