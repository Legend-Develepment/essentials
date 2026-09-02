/*
 * Ping's VarInt codec and response parser, against the values from the protocol
 * documentation and against responses shaped like the ones real servers send.
 *
 * Ported faithfully from the PHP:
 *  - varInt() masks to 32 bits and shifts with a logical shift, which is what
 *    the `& 0x01FFFFFF` after `>> 7` is doing - PHP's >> is arithmetic, so a
 *    negative value would otherwise shift in ones for ever and never terminate.
 *  - takeVarInt() gives up after five bytes.
 *
 * The negative case is not academic: the handshake sends protocol version -1,
 * so if varInt() looped or truncated on a negative number, nothing would work
 * at all.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    const a = JSON.stringify(got);
    const b = JSON.stringify(want);
    if (a === b) { pass++; return; }
    fail++;
    console.log('  FAIL ' + label + '\n    got  ' + a + '\n    want ' + b);
};

/* ------------------------------------------------------------- varInt --- */

const varInt = (value) => {
    const out = [];
    let v = value >>> 0;              // & 0xFFFFFFFF, unsigned

    do {
        const byte = v & 0x7f;
        v = (v >>> 7) & 0x01ffffff;   // logical shift, as the PHP forces
        out.push(v !== 0 ? (byte | 0x80) : byte);
    } while (v !== 0);

    return Buffer.from(out);
};

const hex = (buffer) => buffer.toString('hex');

// The reference values from the protocol's own table.
check('varInt 0', hex(varInt(0)), '00');
check('varInt 1', hex(varInt(1)), '01');
check('varInt 2', hex(varInt(2)), '02');
check('varInt 127', hex(varInt(127)), '7f');
check('varInt 128', hex(varInt(128)), '8001');
check('varInt 255', hex(varInt(255)), 'ff01');
// 25565 is 0x63DD: low seven bits 93 -> 0xDD, next seven 71 -> 0xC7, then 1.
check('varInt 25565', hex(varInt(25565)), 'ddc701');
check('varInt 2097151', hex(varInt(2097151)), 'ffff7f');
check('varInt 2147483647', hex(varInt(2147483647)), 'ffffffff07');
check('varInt -1', hex(varInt(-1)), 'ffffffff0f');
check('varInt -2147483648', hex(varInt(-2147483648)), '8080808008');

/* ---------------------------------------------------------- takeVarInt --- */

const takeVarInt = (buffer, at) => {
    let value = 0;
    let shift = 0;

    while (shift < 35) {
        if (at.i >= buffer.length) return null;

        const byte = buffer[at.i];
        at.i += 1;

        value |= (byte & 0x7f) << shift;

        if ((byte & 0x80) === 0) return value;

        shift += 7;
    }

    return null;
};

const read = (hexString) => {
    const at = { i: 0 };
    return { value: takeVarInt(Buffer.from(hexString, 'hex'), at), at: at.i };
};

check('read 0', read('00'), { value: 0, at: 1 });
check('read 127', read('7f'), { value: 127, at: 1 });
check('read 128', read('8001'), { value: 128, at: 2 });
check('read 25565', read('ddc701'), { value: 25565, at: 3 });
check('read 2147483647', read('ffffffff07'), { value: 2147483647, at: 5 });
check('read runs out mid-number', read('80'), { value: null, at: 1 });
check('read empty', read(''), { value: null, at: 0 });
// Six continuation bytes is not a VarInt, and must not be read as one.
check('read refuses a sixth byte', read('8080808080 80'.replace(/ /g, '')), { value: null, at: 5 });
check('cursor advances past a prefix', (() => {
    const at = { i: 0 };
    const buffer = Buffer.from('8001' + 'ff', 'hex');
    const v = takeVarInt(buffer, at);
    return { value: v, next: buffer[at.i] };
})(), { value: 128, next: 255 });

/* ----------------------------------------------------------- responses --- */

const nameOk = (v) => typeof v === 'string' && /^[A-Za-z0-9_]{1,16}$/.test(v.trim())
    ? v.trim() : null;

const parse = (body) => {
    const at = { i: 0 };

    const id = takeVarInt(body, at);
    if (id !== 0) return null;

    const length = takeVarInt(body, at);
    if (length === null || length < 2 || length > body.length - at.i) return null;

    let data;
    try {
        data = JSON.parse(body.subarray(at.i, at.i + length).toString('utf8'));
    } catch { return null; }

    if (data === null || typeof data !== 'object' || Array.isArray(data)) return null;

    const players = (data.players && typeof data.players === 'object') ? data.players : {};
    const names = [];

    for (const entry of Array.isArray(players.sample) ? players.sample : []) {
        if (!entry || typeof entry !== 'object') continue;
        const n = nameOk(entry.name);
        if (n !== null) names.push(n);
    }

    const version = (data.version && typeof data.version.name === 'string')
        ? data.version.name.replace(/\p{Cc}/gu, ' ').trim().slice(0, 40)
        : null;

    return {
        online: Math.max(0, parseInt(players.online, 10) || 0),
        max: Math.max(0, parseInt(players.max, 10) || 0),
        names: [...new Set(names)].slice(0, 100),
        version: version !== '' ? version : null,
    };
};

/* Build a status response the way a server would. */
const response = (object) => {
    const json = Buffer.from(JSON.stringify(object), 'utf8');
    return Buffer.concat([varInt(0), varInt(json.length), json]);
};

check('a normal server', parse(response({
    version: { name: '1.21.1', protocol: 767 },
    players: { online: 3, max: 20, sample: [{ name: 'Notch' }, { name: 'jeb_' }] },
    description: { text: 'A Minecraft Server' },
})), { online: 3, max: 20, names: ['Notch', 'jeb_'], version: '1.21.1' });

check('empty server', parse(response({
    version: { name: 'Paper 1.20.4' },
    players: { online: 0, max: 100 },
})), { online: 0, max: 100, names: [], version: 'Paper 1.20.4' });

check('no players block at all', parse(response({ version: { name: 'x' } })),
    { online: 0, max: 0, names: [], version: 'x' });

// A sample entry that is not a name. The server is not trusted: these strings
// come off a machine the panel does not control and end up beside buttons that
// build console commands.
check('hostile sample is dropped', parse(response({
    players: {
        online: 4, max: 4, sample: [
            { name: 'Notch' },
            { name: 'evil\nstop' },
            { name: 'way_too_long_a_name_here' },
            { name: '' },
            { name: 42 },
            { nope: 'x' },
            'not an object',
            { name: 'Notch' },
        ],
    },
})), { online: 4, max: 4, names: ['Notch'], version: null });

check('counts are clamped, not trusted', parse(response({
    players: { online: -5, max: -1 },
})), { online: 0, max: 0, names: [], version: null });

check('online given as a string', parse(response({
    players: { online: '7', max: '20' },
})), { online: 7, max: 20, names: [], version: null });

check('version with control characters is cleaned', parse(response({
    version: { name: 'Spigot\n1.8' },
})), { online: 0, max: 0, names: [], version: 'Spigot 1.8' });

/* --------------------------------------------------------- bad bodies --- */

check('wrong packet id', parse(Buffer.concat([varInt(1), varInt(2), Buffer.from('{}')])), null);
check('not json', parse(Buffer.concat([varInt(0), varInt(5), Buffer.from('hello')])), null);
check('json that is not an object', parse(Buffer.concat([varInt(0), varInt(2), Buffer.from('[]')])), null);
check('length longer than the body', parse(Buffer.concat([varInt(0), varInt(900), Buffer.from('{}')])), null);
check('empty body', parse(Buffer.alloc(0)), null);
check('id but nothing after', parse(varInt(0)), null);

/* ------------------------------------------------- the handshake bytes --- */

const string = (s) => {
    const b = Buffer.from(s, 'utf8');
    return Buffer.concat([varInt(b.length), b]);
};

const handshake = (host, port) => {
    const body = Buffer.concat([
        varInt(0), varInt(-1), string(host),
        Buffer.from([(port >> 8) & 0xff, port & 0xff]),
        varInt(1),
    ]);
    return Buffer.concat([varInt(body.length), body]);
};

// Byte for byte, what a client sends for localhost:25565.
check('handshake for 127.0.0.1:25565',
    hex(handshake('127.0.0.1', 25565)),
    // 19 bytes of body: 1 id + 5 protocol + 1 length + 9 host + 2 port + 1 state.
    '13' + '00' + 'ffffffff0f' + '09' + Buffer.from('127.0.0.1').toString('hex') + '63dd' + '01');

check('status request', hex(Buffer.concat([varInt(1), varInt(0)])), '0100');

console.log('\nping protocol: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
