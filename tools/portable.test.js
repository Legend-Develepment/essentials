/*
 * Support\Portable, ported.
 *
 * Export and import. A bug here does not draw wrong - it silently replaces
 * settings somebody spent an afternoon on, or quietly fails to replace the ones
 * they meant. tools/check-export.js proves every setting is *listed* by a
 * persister; nothing proved that a file round-trips, that a foreign file is
 * refused, or that the diff shown before writing tells the truth.
 *
 * Two of the rules here exist because of something that already went wrong.
 *
 * The settings file carried sixty-one settings out of seventy-eight for twelve
 * releases, and neither an announcement nor a sidebar link at all, because it
 * asked Settings::data() alone - the main form and nothing else. That fault is
 * check-export's now, but the shape it left behind is here: settings() merges
 * every group, and anything with a persist() belongs in it.
 *
 * And some settings deliberately do not travel. The monitors are addresses this
 * panel fetches on a timer, and importing somebody else's list would point your
 * panel at their services, on a schedule, from your address - which is not what
 * somebody copying a colour scheme is agreeing to.
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

const MARKER = 'legend-theme-settings';

// Stands in for the panel's current settings. The names are real ones; what
// matters is the shape - a scalar, a boolean, a list, an empty string.
const CURRENT = {
    accent: '#ffa500',
    preset: 'ember',
    glass: true,
    logo_height: 2,
    footer_text: '',
    icon_overrides: [{ from: 'a', to: 'b' }],
    announcements: [],
};

function parse(json, current) {
    let decoded;

    try {
        decoded = JSON.parse(json);
    } catch {
        return {};
    }

    if (decoded === null || typeof decoded !== 'object' || Array.isArray(decoded)) { return {}; }

    // A bare settings object is accepted too: somebody who edited the file down
    // to the part they wanted should not be told it is the wrong file.
    const settings = (decoded.settings !== undefined && decoded.settings !== null
        && typeof decoded.settings === 'object' && !Array.isArray(decoded.settings))
        ? decoded.settings
        : decoded;

    if ((decoded.marker === undefined ? MARKER : decoded.marker) !== MARKER) { return {}; }

    const out = {};

    for (const key of Object.keys(current)) {
        if (key in settings) { out[key] = settings[key]; }
    }

    return out;
}

// PHP's == between a scalar from JSON and one from a form. '2' and 2 are the
// same setting, and reporting that as a change would fill the list with
// entries that do nothing.
function loose(a, b) {
    if (Array.isArray(a) || Array.isArray(b)
        || (a !== null && typeof a === 'object') || (b !== null && typeof b === 'object')) {
        return JSON.stringify(a) === JSON.stringify(b);
    }

    if (typeof a === 'boolean' || typeof b === 'boolean') { return Boolean(a) === Boolean(b); }

    return String(a) === String(b);
}

function describe(value) {
    if (typeof value === 'boolean') { return value ? 'on' : 'off'; }
    if (value === null || value === '') { return '-'; }

    if (Array.isArray(value) || (typeof value === 'object')) {
        const count = Array.isArray(value) ? value.length : Object.keys(value).length;

        return count === 1 ? '1 entry' : count + ' entries';
    }

    const text = String(value);

    return text.length > 40 ? text.slice(0, 40) + '…' : text;
}

function changes(incoming, current) {
    const out = [];

    for (const [key, value] of Object.entries(incoming)) {
        if (!(key in current)) { continue; }
        if (loose(current[key], value)) { continue; }

        out.push({ key, from: describe(current[key]), to: describe(value) });
    }

    return out;
}

const file = (settings, marker) => JSON.stringify({
    marker: marker === undefined ? MARKER : marker,
    plugin: 'essentials',
    version: '2.75.1-dev',
    exported_at: '2026-09-06T12:00:00+00:00',
    settings,
});

console.log('settings file\n');

/* ---------------------------------------------------------- the round trip */

/*
 * The promise: what comes out goes back in unchanged, and reports no change
 * against the panel it came from. Everything else in this file is a way that
 * can fail.
 */
{
    const out = parse(file(CURRENT), CURRENT);

    check('every setting survives the journey', out, CURRENT);
    check('and importing it changes nothing', changes(out, CURRENT), []);
}

check('a bare settings object is a file too',
    parse(JSON.stringify(CURRENT), CURRENT), CURRENT);

/* ----------------------------------------------------- what is refused --- */

check('a file from something else', parse(file(CURRENT, 'some-other-plugin'), CURRENT), {});
check('a marker that is empty', parse(file(CURRENT, ''), CURRENT), {});
check('a marker that is not a string', parse(file(CURRENT, 7), CURRENT), {});

check('not json at all', parse('not json', CURRENT), {});
check('json that is a number', parse('42', CURRENT), {});
check('json that is a string', parse('"hello"', CURRENT), {});
check('json that is a list', parse('[1,2,3]', CURRENT), {});
check('nothing', parse('', CURRENT), {});

/*
 * A key the panel does not have is dropped rather than carried. persist()
 * writes an explicit list of environment variables so it would be ignored
 * anyway - but dropping it here is what lets the diff report honestly on what
 * the file will actually do.
 */
check('an unknown setting is dropped',
    parse(file({ accent: '#000000', invented_setting: 'x' }, undefined), CURRENT),
    { accent: '#000000' });

check('and it is not counted as a change',
    changes(parse(file({ invented_setting: 'x' }), CURRENT), CURRENT), []);

/*
 * The excluded ones never leave, so a file cannot carry them back in even if
 * somebody adds them by hand: they are not in the current set, so parse() drops
 * them with everything else it does not know.
 */
check('a monitor list added by hand is dropped',
    parse(file({ status_monitors: [{ url: 'https://someone-elses.example' }] }), CURRENT), {});

/* ------------------------------------------------------------ the diff --- */

check('a changed colour', changes({ accent: '#000000' }, CURRENT),
    [{ key: 'accent', from: '#ffa500', to: '#000000' }]);

check('the same colour is not a change', changes({ accent: '#ffa500' }, CURRENT), []);

// Loose, on purpose: JSON gives back 2 and a form gives back '2'.
check('a number as a string is not a change', changes({ logo_height: '2' }, CURRENT), []);
check('a boolean as a boolean is not a change', changes({ glass: true }, CURRENT), []);
check('but a real change to it is', changes({ glass: false }, CURRENT).length, 1);

check('a switch reads as on and off',
    changes({ glass: false }, CURRENT)[0], { key: 'glass', from: 'on', to: 'off' });

check('an empty value reads as a dash',
    changes({ footer_text: 'Hello' }, CURRENT)[0].from, '-');

// Lists are counted rather than printed: the icon overrides can hold fifty
// rows, and a diff nobody can read is a diff nobody reads.
check('one entry', describe([{ a: 1 }]), '1 entry');
check('several entries', describe([1, 2, 3]), '3 entries');
check('none', describe([]), '0 entries');

check('a long value is cut', describe('x'.repeat(60)), 'x'.repeat(40) + '…');
check('exactly forty is not', describe('x'.repeat(40)), 'x'.repeat(40));
check('null reads as a dash', describe(null), '-');

check('several changes at once',
    changes({ accent: '#000000', glass: false, preset: 'nord' }, CURRENT).length, 3);

/*
 * A list that differs is a change, and one that matches is not - which is the
 * comparison most likely to be wrong, because two arrays are never identical
 * by reference.
 */
check('the same list is not a change',
    changes({ icon_overrides: [{ from: 'a', to: 'b' }] }, CURRENT), []);
check('a different list is',
    changes({ icon_overrides: [{ from: 'a', to: 'c' }] }, CURRENT).length, 1);
check('an emptied list is',
    changes({ icon_overrides: [] }, CURRENT).length, 1);

console.log(NEWLINE + 'settings file: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
