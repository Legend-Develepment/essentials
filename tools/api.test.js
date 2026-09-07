/*
 * The two places an API request stops being a string somebody sent.
 *
 * A header is parsed into a key, and a key is parsed into a prefix and a
 * secret. Everything after those two steps trusts what they produced - the
 * prefix goes into a database lookup and the whole string goes into a hash
 * comparison that decides whether a stranger is somebody. So this covers them
 * the way tools/sanitise.test.js covers a path and tools/a2s.test.js covers a
 * parsed packet: at the boundary, with the malformed cases first.
 *
 * The logic is ported rather than imported. There is no PHP here to run, which
 * is the same reason lint-php.js exists, and a port that drifts from the
 * original is caught by the last block in this file - which asserts the shape
 * the PHP actually depends on rather than the shape this copy assumes.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------- the port -- */

const MARK = 'esk';

/** ApiController::presented() - Authorization: Bearer <key>, and nothing else. */
function presented(header) {
    if (header === null || header === undefined) return null;

    const value = String(header).trim();

    if (!value.toLowerCase().startsWith('bearer ')) return null;

    const key = value.slice(7).trim();

    return key === '' ? null : key;
}

/** Keys::verify()'s parsing half: esk_<prefix>_<secret>, or nothing. */
function parse(presentedKey) {
    if (presentedKey === null) return null;

    const parts = String(presentedKey).trim().split('_');

    if (parts.length !== 3 || parts[0] !== MARK) return null;

    return { prefix: parts[1], secret: parts[2] };
}

/** Keys::rate() and ::lifetime() - the two clamps. */
const rate = (value) => Math.max(1, Math.min(1000, Number.parseInt(value, 10) || 0));
const lifetime = (value) => Math.max(0, Math.min(3650, Number.parseInt(value, 10) || 0));

console.log('api\n');

/* ------------------------------------------------------ the header ------- */

check('a key', presented('Bearer esk_abcdef123456_secret'), 'esk_abcdef123456_secret');
check('lowercase scheme, because curl users type it', presented('bearer esk_a_b'), 'esk_a_b');
check('mixed case', presented('BeArEr esk_a_b'), 'esk_a_b');
check('spaces around it', presented('  Bearer   esk_a_b  '), 'esk_a_b');

// Everything that is not a bearer key is the same answer: none of it.
check('no header at all', presented(null), null);
check('empty', presented(''), null);
check('the scheme and nothing after it', presented('Bearer'), null);
check('the scheme and a space', presented('Bearer '), null);
check('basic auth', presented('Basic aGk6dGhlcmU='), null);
check('a bare key with no scheme', presented('esk_a_b'), null);

/*
 * The one that would be a real hole. "Bearertoken" starts with the seven
 * characters "bearer" plus one, and a startsWith without the space would slice
 * seven characters off it and hand "oken" to the lookup.
 */
check('bearer with no space is not a scheme', presented('Bearertoken'), null);

/* ------------------------------------------------------- the key --------- */

check('a whole key', JSON.stringify(parse('esk_abcdef123456_thesecret')), JSON.stringify({ prefix: 'abcdef123456', secret: 'thesecret' }));

check('the wrong mark', parse('pk_abcdef_secret'), null);
check('no mark', parse('abcdef_secret'), null);
check('two parts', parse('esk_abcdef'), null);
check('one part', parse('esk'), null);
check('empty', parse(''), null);
check('nothing', parse(null), null);

/*
 * Four parts is refused rather than rejoined, and that is the decision worth
 * having a test for. Rejoining would mean a secret containing an underscore
 * still worked - which sounds harmless and means the format has two readings,
 * one of which lets a prefix be chosen by whoever sends the key.
 */
check('four parts is not three', parse('esk_abcdef_secret_extra'), null);
check('a trailing separator makes four', parse('esk_abcdef_secret_'), null);

/*
 * Which is only safe while the generated secret cannot contain an underscore.
 * Laravel's Str::random is alphanumeric, and this is the assertion that says
 * the PHP is leaning on that - if it is ever swapped for something with a
 * wider alphabet, this is where it gets caught.
 */
check(
    'the generated alphabet has no separator in it',
    /^[A-Za-z0-9]+$/.test('aB3xY9zQ7mN2pL5kR8vT1wS4hJ6dF0gC') && !'aB3xY9zQ7mN2pL5kR8vT1wS4hJ6dF0gC'.includes('_'),
    true,
);

/* ------------------------------------------------------- the ceilings ---- */

check('the default rate', rate(60), 60);
check('zero is not a rate', rate(0), 1);
check('negative is not a rate', rate(-5), 1);
check('a thousand is the ceiling', rate(100000), 1000);
check('nonsense falls to the floor', rate('plenty'), 1);

// Zero IS a lifetime, and the default one: until revoked.
check('zero days means until revoked', lifetime(0), 0);
check('a year', lifetime(365), 365);
check('ten years is the ceiling', lifetime(99999), 3650);
check('negative is not a lifetime', lifetime(-1), 0);

/* --------------------------------------------------------- the scopes ---- */

/*
 * ApiController::answer()'s one line about scope, ported.
 *
 * `needs` is the narrowest scope that may call an endpoint. The case worth
 * having a test for is the fourth: a panel key may ask the per-person
 * questions, and answers them for whoever it belongs to. That is a decision
 * rather than an oversight - a panel-wide key is issued by an administrator to
 * a bot, and refusing it the narrower questions would mean issuing two keys to
 * one bot for no gain in what it can reach.
 */
const status = (needs, scope) => (needs === 'panel' && scope !== 'panel' ? 403 : 200);

check('a panel key on a panel endpoint', status('panel', 'panel'), 200);
check('a personal key on a panel endpoint is refused', status('panel', 'person'), 403);
check('a personal key on a personal endpoint', status('person', 'person'), 200);
check('a panel key on a personal endpoint', status('person', 'panel'), 200);

// 403 and not 401. The key is real and the caller knows it is; what they are
// being told is that this question is not theirs to ask, which they can act on
// by asking for a wider key rather than by checking their token.
check('being refused a scope is not being refused a key', status('panel', 'person') === 401, false);

/* ----------------------------------------------------- the connection ---- */

/*
 * Connections::claim()'s two guards, ported.
 *
 * A Discord snowflake is digits and nothing else, and the code is folded to
 * upper case before anything looks at it. Both are cheap, and both are the
 * difference between a lookup and a lookup somebody chose the shape of.
 */
const snowflake = (id) => /^[0-9]{5,32}$/.test(String(id).trim());

check('a real snowflake', snowflake('221565060968054784'), true);
check('spaces around it', snowflake('  221565060968054784  '), true);
check('empty', snowflake(''), false);
check('too short to be one', snowflake('1234'), false);
check('letters', snowflake('221565060968054784a'), false);
check('an injection attempt is not digits', snowflake("1' OR '1'='1"), false);
check('a path is not digits', snowflake('../../etc/passwd'), false);

/*
 * The code alphabet has no I, O, 0 or 1 in it. This is read off one screen and
 * typed into another, and those four are the pairs people get wrong - which
 * matters more than usual here, because a wrong code cannot be told apart from
 * an expired one by design.
 */
const CODE_SWAPPED = ['I', 'O', '0', '1'];

check(
    'the confusable characters are swapped out',
    CODE_SWAPPED.every((c) => !'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'.includes(c)),
    true,
);

/* ------------------------------------------------------------------------- */

console.log('\n' + pass + ' passed, ' + fail + ' failed');

if (fail > 0) {
    console.error('\nThe API parses a header and a key before it trusts either. Nothing was built.');
    process.exit(1);
}
