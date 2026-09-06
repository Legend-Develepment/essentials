/*
 * The status feature's pure logic, which had none of this and should have.
 *
 * These two routes are the only thing this plugin serves to somebody who is not
 * signed in, and the snapshot logic behind them was repaired three times in
 * three releases:
 *
 *  - a read that handed back whatever was cached until it expired, so the page
 *    counted down from sixty and got the same figures back four times running;
 *  - a forget() that dropped the snapshot and left the lock standing, which
 *    answered with nothing for a minute after saving - a blank page, and a 404
 *    on a user page;
 *  - an interval that had to stop being one constant for every page.
 *
 * Every one of those is arithmetic. Every one would have failed a test before
 * it reached a panel. So the freshness rules are the point of this file and the
 * rest is the sanitising around them, which is the other half of what a public
 * page has to get right.
 *
 * Two patterns are read out of the PHP rather than retyped - the slug and the
 * reserved list - for the reason tools/check-classes.js exists: a test that
 * reproduces the code cannot catch the code being wrong.
 */
const fs = require('fs');
const path = require('path');

let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

const read = (file) => fs.readFileSync(path.join(__dirname, '..', 'src', 'Support', 'Status', file), 'utf8');

/* ------------------------------------------------------------- the slug -- */

const pagesSource = read('Pages.php');

/* The real pattern, out of the real file. */
const slugPattern = (() => {
    const found = /preg_match\('\/(.+?)\/D',\s*\$slug\)/.exec(pagesSource);

    if (found === null) {
        console.error('  FAIL  the slug pattern could not be read from Pages.php');
        process.exit(1);
    }

    return new RegExp(found[1]);
})();

/* And the real reserved list. */
const reserved = (() => {
    const block = /private const RESERVED = \[([\s\S]*?)\];/.exec(pagesSource);

    if (block === null) {
        console.error('  FAIL  the reserved list could not be read from Pages.php');
        process.exit(1);
    }

    return new Set([...block[1].matchAll(/'([^']+)'/g)].map((m) => m[1]));
})();

const slug = (value) => {
    const lowered = typeof value === 'string' ? value.trim().toLowerCase() : '';

    if (!slugPattern.test(lowered)) { return null; }

    return reserved.has(lowered) ? null : lowered;
};

console.log('status pages\n');

check('an ordinary one', slug('bryan'), 'bryan');
check('digits are fine', slug('l3g3'), 'l3g3');
check('hyphens in the middle', slug('l3g3-clan'), 'l3g3-clan');
check('case is not kept', slug('Bryan'), 'bryan');
check('surrounding space is not part of it', slug('  bryan  '), 'bryan');

// Three characters or more, and never starting or ending on a hyphen - which is
// what the pattern says and is easy to get wrong when reading it.
check('two characters is too few', slug('ab'), null);
check('three is enough', slug('abc'), 'abc');
check('a leading hyphen', slug('-bryan'), null);
check('a trailing hyphen', slug('bryan-'), null);
check('a hyphen on its own', slug('---'), null);
check('a slash', slug('a/b'), null);
check('a dot', slug('a.b'), null);
check('a space inside', slug('l3g3 clan'), null);
check('an accent', slug('bryané'), null);
check('empty', slug(''), null);
check('not a string', slug(null), null);
check('thirty-three characters', slug('a'.repeat(33)), null);
check('thirty-two characters', slug('a'.repeat(32)), 'a'.repeat(32));

/*
 * Reserved words.
 *
 * Not a security boundary - none of these would collide with a real route. It
 * is that /status/admin should not read, to a visitor, as something the panel
 * put there.
 */
check('admin is reserved', slug('admin'), null);
check('status is reserved', slug('status'), null);
check('so is api', slug('api'), null);
check('but adminx is not', slug('adminx'), 'adminx');

/* ----------------------------------------------------------- the index --- */

/*
 * One person, one slug. Ported from Pages::available() and reindex().
 */
function makeIndex() {
    let index = {};

    return {
        all: () => index,

        available(want, userId) {
            const clean = slug(want);

            if (clean === null) { return false; }

            const held = index[clean];

            return held === undefined || held === userId;
        },

        put(want, userId) {
            const clean = slug(want);

            if (clean === null) { return 'slug'; }
            if (!this.available(clean, userId)) { return 'taken'; }

            for (const [held, owner] of Object.entries(index)) {
                if (owner === userId) { delete index[held]; }
            }

            index[clean] = userId;

            return null;
        },

        forget(userId) {
            for (const [held, owner] of Object.entries(index)) {
                if (owner === userId) { delete index[held]; }
            }
        },
    };
}

{
    const i = makeIndex();

    check('a free slug is taken', i.put('bryan', 1), null);
    check('and resolves', i.all().bryan, 1);

    // The one that is easy to get wrong: saving your own page again must not
    // report your own slug as taken by somebody.
    check('re-saving your own is not taken', i.put('bryan', 1), null);

    check('somebody else cannot have it', i.put('bryan', 2), 'taken');

    // Changing it has to free the old one, or a person accumulates addresses.
    check('changing frees the old one', i.put('bryanroy', 1), null);
    check('the old one is gone', i.all().bryan, undefined);
    check('and is free for somebody else', i.put('bryan', 2), null);

    check('a bad slug is refused before anything else', i.put('ab', 3), 'slug');
    check('a reserved one too', i.put('admin', 3), 'slug');

    i.forget(1);
    check('taking a page down frees its slug', i.all().bryanroy, undefined);
    check('and leaves everybody else alone', i.all().bryan, 2);
}

/* ------------------------------------------------------------ freshness -- */

/*
 * Publish::read() and build(), which is where this broke three times.
 *
 * The clock is a variable rather than a call, because every rule here is about
 * elapsed time and a test that had to sleep for it is a test nobody runs.
 */
function makePublish(every = 60) {
    let clock = 1000;
    let snapshot = null;
    let lock = 0;
    let builds = 0;

    const self = {
        tick: (seconds) => { clock += seconds; },
        builds: () => builds,

        read() {
            if (snapshot !== null && clock - snapshot.at < snapshot.every) {
                return snapshot;
            }

            return self.build();
        },

        build() {
            // A build already running, or one that finished inside the
            // interval. Either way the answer is what is stored.
            if (lock > clock) {
                return snapshot ?? { at: clock, every, servers: [], empty: true };
            }

            lock = clock + every;
            builds += 1;
            snapshot = { at: clock, every, servers: ['one'] };

            return snapshot;
        },

        forget() {
            snapshot = null;
            // The half that was missed: without it, build() answers with
            // nothing while the lock stands.
            lock = 0;
        },
    };

    return self;
}

console.log('');

{
    const p = makePublish(60);

    p.read();
    check('the first read builds', p.builds(), 1);

    p.tick(30);
    p.read();
    check('a fresh snapshot does not', p.builds(), 1);

    p.tick(31);
    p.read();
    check('one past its interval does', p.builds(), 2);
}

{
    // The fault that made the countdown a lie: reading only rebuilt when the
    // cache expired, which was five minutes on a sixty-second countdown.
    const p = makePublish(60);

    p.read();

    for (let minute = 0; minute < 5; minute++) {
        p.tick(61);
        p.read();
    }

    check('five intervals produce five more builds', p.builds(), 6);
}

{
    // Forty visitors in one interval. The lock is what makes on-demand
    // rebuilding safe rather than a way to have a busy page take a panel down.
    const p = makePublish(60);

    p.tick(200);

    for (let visitor = 0; visitor < 40; visitor++) {
        p.read();
    }

    check('forty readers, one build', p.builds(), 1);
}

{
    /*
     * forget(), and the second half of it.
     *
     * Dropping the snapshot without the lock left build() answering with
     * nothing for the rest of the interval - a blank page after saving, and a
     * 404 on a user page, because an empty list is how that page says there is
     * nothing to show.
     */
    const p = makePublish(60);

    p.read();
    p.tick(5);
    p.forget();

    const after = p.read();

    check('a settings change rebuilds at once', p.builds(), 2);
    check('and the page is not empty', after.empty, undefined);
    check('it has content', after.servers, ['one']);
}

{
    // An interval is per page, so a page set to an hour is not rebuilt by
    // somebody visiting it every minute.
    const p = makePublish(3600);

    p.read();

    for (let minute = 0; minute < 30; minute++) {
        p.tick(60);
        p.read();
    }

    check('half an hour on an hourly page', p.builds(), 1);

    p.tick(1900);
    p.read();
    check('past the hour it rebuilds', p.builds(), 2);
}

/* -------------------------------------------------------- the countdown -- */

const due = (at, every, now) => Math.max(0, every - Math.max(0, now - at));

check('a fresh snapshot has the whole interval', due(1000, 60, 1000), 60);
check('halfway through', due(1000, 60, 1030), 30);
check('exactly due', due(1000, 60, 1060), 0);
check('overdue is not negative', due(1000, 60, 5000), 0);
// A clock that went backwards - a panel whose time was corrected. It must not
// hand back more than the interval.
check('a backwards clock is capped', due(1000, 60, 900), 60);

/* --------------------------------------------------------- the monitors -- */

console.log('');

const url = (value) => {
    if (typeof value !== 'string') { return null; }

    const trimmed = value.trim();

    if (trimmed === '' || trimmed.length > 300) { return null; }
    if (!trimmed.toLowerCase().startsWith('https://')) { return null; }

    try {
        return new URL(trimmed).host === '' ? null : trimmed;
    } catch {
        return null;
    }
};

check('an https address', url('https://l3g3clan.nl'), 'https://l3g3clan.nl');
check('with a path', url('https://l3g3clan.nl/health'), 'https://l3g3clan.nl/health');
check('surrounding space is trimmed', url('  https://l3g3clan.nl  '), 'https://l3g3clan.nl');

/*
 * http is refused, and not for tidiness.
 *
 * A panel fetching plain http on a timer tells anybody on the path which of its
 * services exist.
 */
check('plain http', url('http://l3g3clan.nl'), null);
check('a scheme that is not a scheme', url('javascript:alert(1)'), null);
check('a bare host', url('l3g3clan.nl'), null);
check('a file address', url('file:///etc/passwd'), null);
check('empty', url(''), null);
check('not a string', url(42), null);
check('longer than three hundred', url('https://a.nl/' + 'x'.repeat(300)), null);

/* What counts as answering. */
const state = (status, expect = 0) => {
    if (expect > 0) { return status === expect ? 'up' : 'down'; }

    return status > 0 && status < 500 ? 'up' : 'down';
};

check('200 is up', state(200), 'up');
// The ones people get wrong: a program that answered is a program that is
// running, whatever it decided.
check('a redirect is up', state(301), 'up');
check('403 is up', state(403), 'up');
check('401 is up', state(401), 'up');
check('404 is up', state(404), 'up');
check('500 is down', state(500), 'down');
check('502 is down', state(502), 'down');
check('no answer at all is down', state(0), 'down');

check('an exact code that matches', state(200, 200), 'up');
check('an exact code that does not', state(301, 200), 'down');
// Set too strictly, a monitor is red for ever on a service that is fine. The
// test is here so the behaviour is a choice rather than a surprise.
check('an exact code refuses a redirect', state(302, 200), 'down');
check('an exact code can be a 5xx', state(503, 503), 'up');

/* ------------------------------------------------------ what is served -- */

console.log('');

/*
 * Publish::published(), which decides whether the address answers at all.
 *
 * It asked only about the servers. A panel with a machine and two monitors
 * saved and no servers was told "nothing is being served yet" and answered 404
 * on the address - while the settings page showed the machine and the monitors
 * sitting right there. All three draw their own section on the page, so any one
 * of them is a page worth serving.
 */
const published = (servers, nodes, monitors) =>
    servers.length > 0 || nodes.length > 0 || monitors.length > 0;

const A = [{ id: 1, name: 'one' }];

check('nothing at all', published([], [], []), false);
check('a server', published(A, [], []), true);

// The three that were reported. Each on its own is a page.
check('a machine and nothing else', published([], A, []), true);
check('a monitor and nothing else', published([], [], A), true);
check('a machine and a monitor', published([], A, A), true);

check('all three', published(A, A, A), true);
check('servers and machines', published(A, A, []), true);
check('servers and monitors', published(A, [], A), true);

/*
 * A row with no name is not a row - pairs() drops it - so a list holding only
 * one of those is still an empty list, and the address still answers 404.
 */
const pairs = (stored) => {
    const out = {};

    for (const pair of String(stored).split('|')) {
        const at = pair.indexOf(':');
        const id = parseInt(at === -1 ? pair : pair.slice(0, at), 10) || 0;
        const name = at === -1 ? '' : pair.slice(at + 1).trim();

        if (id <= 0 || name === '') { continue; }

        out[id] = { id, name: name.slice(0, 60) };
    }

    return Object.values(out).slice(0, 50);
};

check('a named machine counts', published([], pairs('7:Hetzner DE 1'), []), true);
check('a machine with no name does not', published([], pairs('7:'), []), false);
check('an empty setting does not', published([], pairs(''), []), false);
check('one named among unnamed counts', published([], pairs('7:|8:Hetzner DE 2'), []), true);

console.log('\nstatus feature: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
