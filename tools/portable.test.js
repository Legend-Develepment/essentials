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

/* ---------------------------------------------- styles of your own --- */

/*
 * Presets::withImported(). A file's styles are added to the ones here, never
 * put in their place, and a file from outside cannot use this to write a key
 * the picker would not draw, a field a style is not made of, or more styles
 * than saving one by hand is allowed.
 */
const MAX_CUSTOM = 20;
const CAPTURED = ['accent', 'surface', 'radius', 'density', 'glass', 'glow', 'font', 'mode',
    'background', 'background_color', 'background_color_end', 'background_angle',
    'icon_stroke', 'icon_scale', 'icon_accent', 'bar_base', 'bar_warning', 'bar_danger', 'force_dark'];

function withImported(rows, here) {
    const merged = { ...here };

    for (const [key, row] of Object.entries(rows)) {
        if (!/^my-[a-z0-9-]{1,24}$/.test(key) || row === null || typeof row !== 'object' || Array.isArray(row)
            || row.values === null || typeof row.values !== 'object') {
            continue;
        }

        if (!(key in merged) && Object.keys(merged).length >= MAX_CUSTOM) { continue; }

        const scalar = (v) => v === null || ['string', 'number', 'boolean'].includes(typeof v);
        const label = scalar(row.label) && row.label !== null ? String(row.label).slice(0, 40).trim() : '';
        const values = {};

        for (const [field, value] of Object.entries(row.values)) {
            if (CAPTURED.includes(field) && scalar(value)) { values[field] = value; }
        }

        merged[key] = { label: label !== '' ? label : key, values };
    }

    return merged;
}

const DUSK = { label: 'Dusk', values: { accent: '#ff6600', glass: true } };

check('a style from a file is added to the ones here',
    Object.keys(withImported({ 'my-dawn': { label: 'Dawn', values: { accent: '#ffcc00' } } }, { 'my-dusk': DUSK })),
    ['my-dusk', 'my-dawn']);

check('one with the same key replaces the one here',
    withImported({ 'my-dusk': { label: 'Dusk 2', values: { accent: '#000000' } } }, { 'my-dusk': DUSK })['my-dusk'],
    { label: 'Dusk 2', values: { accent: '#000000' } });

check('a key that is not one of ours is not written',
    withImported({ ember: DUSK, 'my-': DUSK, 'my-UPPER': DUSK, ['my-' + 'x'.repeat(25)]: DUSK }, {}), {});

check('a field a style is not made of is dropped',
    withImported({ 'my-dusk': { label: 'Dusk', values: { accent: '#ff6600', custom_css: 'body{}' } } }, {})['my-dusk'].values,
    { accent: '#ff6600' });

check('and so is a value that is not a plain one',
    withImported({ 'my-dusk': { label: 'Dusk', values: { accent: ['#ff6600'], glass: false } } }, {})['my-dusk'].values,
    { glass: false });

check('a row without values is not a style',
    withImported({ 'my-dusk': { label: 'Dusk' } }, {}), {});

check('a style without a name is called by its key',
    withImported({ 'my-dusk': { label: '   ', values: {} } }, {})['my-dusk'].label, 'my-dusk');

{
    const full = {};

    for (let i = 0; i < MAX_CUSTOM; i++) { full['my-' + i] = DUSK; }

    check('a new one is left out once there are twenty',
        Object.keys(withImported({ 'my-extra': DUSK }, full)).length, MAX_CUSTOM);
    check('but one already here is still replaced',
        withImported({ 'my-3': { label: 'Three', values: {} } }, full)['my-3'].label, 'Three');
}

/*
 * The preview compares what the list would become, not the file's list, so a
 * file carrying one style of a panel's three is not three entries becoming one.
 */
{
    const here = { 'my-dusk': DUSK, 'my-dawn': DUSK };
    const current = { custom_presets: here };
    const incoming = { custom_presets: { 'my-dusk': DUSK } };

    check('a style already here is not a change',
        changes({ custom_presets: withImported(incoming.custom_presets, here) }, current), []);
    check('a new one is counted as the list it makes',
        changes({ custom_presets: withImported({ 'my-noon': DUSK }, here) }, current)[0],
        { key: 'custom_presets', from: '2 entries', to: '3 entries' });
}

/* -------------------------------------------------------- pictures --- */

/*
 * Portable::present(). A picture that travels travels by name, and a name
 * this panel has no file for is left out rather than written - the sidebar
 * keeps the icon it had instead of pointing at nothing.
 */
const ON_DISK = new Set(['theme/icon.png']);

function present(value) {
    if (value === null) { return true; }
    if (typeof value !== 'string') { return false; }

    const trimmed = value.trim();

    if (trimmed === '' || trimmed.startsWith('https://') || trimmed.startsWith('http://')) { return true; }
    if (trimmed.includes('..')) { return false; }

    return ON_DISK.has(trimmed.replace(/^\/+/, ''));
}

check('a file this panel has', present('theme/icon.png'), true);
check('with a leading slash too', present('/theme/icon.png'), true);
check('one it does not have', present('theme/gone.png'), false);
check('an address is not a file here', present('https://cdn.example/icon.png'), true);
check('no picture is no picture', present(''), true);
check('a way out of the folder is refused', present('theme/../../.env'), false);
check('a list is not a name', present(['theme/icon.png']), false);
check('a protocol-relative address is looked for as a file', present('//evil.example/icon.png'), false);

console.log(NEWLINE + 'settings file: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
