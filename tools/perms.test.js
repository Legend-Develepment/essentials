/*
 * Who may look, and who may change it.
 *
 * The plugin has had one permission per area for a while - announcements
 * without the panel's colours, the system status without anything to change -
 * and every one of them granted both halves at once. This is the split: the
 * name that already exists goes on meaning see-and-change, and a "view-" half
 * is added beside it that opens a page and saves nothing on it.
 *
 * Adding the narrow one rather than replacing the wide one is the whole of why
 * no existing role had to be touched, and the asserts below are what say so.
 * The rule that matters most is the last one: a view- grant must never let
 * anything be saved, because a permission that quietly does more than its name
 * is worse than no permission at all.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + NEWLINE + '        got  ' + JSON.stringify(got) + NEWLINE + '        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------- the port -- */

const MODEL = 'legendTheme';
const VIEW_PREFIX = 'view-';

const BROAD_VIEW = 'view ' + MODEL;
const BROAD_UPDATE = 'update ' + MODEL;

/** Features::permission() - the one that has always existed. */
const permission = (action) => action + ' ' + MODEL;

/** Features::viewPermission() - the half that only opens it. */
const viewPermission = (action) => VIEW_PREFIX + action + ' ' + MODEL;

/** Features::permissions() - what the role editor is handed. */
const permissions = (actions) => actions.flatMap((action) => [action, VIEW_PREFIX + action]);

/** Features::maySee(). */
function maySee(role, action, { enabled = true, gated = true } = {}) {
    if (!enabled) { return false; }
    if (!gated) { return true; }

    return role.includes(BROAD_VIEW)
        || role.includes(permission(action))
        || role.includes(viewPermission(action));
}

/** Features::mayManage(). */
function mayManage(role, action, { enabled = true, gated = true } = {}) {
    if (!enabled) { return false; }

    return role.includes(BROAD_UPDATE)
        || (gated && role.includes(permission(action)));
}

/* ------------------------------------------------------------- the pair -- */

check('a feature has two permissions', permissions(['notices']), ['notices', 'view-notices']);

check(
    'and they are emitted beside each other',
    permissions(['notices', 'orders']),
    ['notices', 'view-notices', 'orders', 'view-orders'],
);

/*
 * The prefix goes in front so Pelican's fallback label reads as a sentence: it
 * runs Str::headline over a permission it has no translation for, which turns
 * view-notices into "View Notices" and notices-view into "Notices View".
 */
check('the prefix is in front, for the label', viewPermission('notices'), 'view-notices legendTheme');

/* --------------------------------------------------- what each one opens -- */

const readOnly = ['view-notices legendTheme'];
const full = ['notices legendTheme'];

check('the view half opens the page', maySee(readOnly, 'notices'), true);
check('and saves nothing on it', mayManage(readOnly, 'notices'), false);

check('the old permission still opens the page', maySee(full, 'notices'), true);
check('and still saves, exactly as it did', mayManage(full, 'notices'), true);

// Being able to change something implies being able to look at it. The other
// way round would be a page somebody can save and cannot read.
check('changing implies looking', maySee(full, 'notices') && mayManage(full, 'notices'), true);

check('and neither half reaches another feature', [maySee(full, 'orders'), mayManage(readOnly, 'orders')], [false, false]);

/* ----------------------------------------------------------- the broad -- */

/*
 * The two wide permissions still open everything, and that is what kept this
 * from being a breaking change: a role that could reach the plugin before can
 * still reach all of it.
 */
check('the broad view opens every page', maySee([BROAD_VIEW], 'takings'), true);
check('and still saves nothing', mayManage([BROAD_VIEW], 'takings'), false);
check('the broad update saves everything', mayManage([BROAD_UPDATE], 'takings'), true);

/* ---------------------------------------------------- off, and ungated --- */

// A switched-off feature is not a permission question. Nobody sees it and
// nobody changes it, whatever they hold.
check('nothing opens a feature that is off', maySee([BROAD_VIEW], 'notices', { enabled: false }), false);
check('and nothing changes one', mayManage([BROAD_UPDATE], 'notices', { enabled: false }), false);

/*
 * An ungated feature is on or off and nothing else. This is the rule that got
 * a star on a server card wrong once: it was gated, so ordinary users with no
 * administrative rights got no stars at all - which is not a boundary, it is a
 * feature that did not work for the people it was for.
 */
check('an ungated feature needs nothing to be seen', maySee([], 'favourites', { gated: false }), true);

// Its settings still live on a settings page, and saving one is still the
// plugin's own update permission.
check('but its settings still need the update permission', mayManage([], 'favourites', { gated: false }), false);
check('which the broad update gives', mayManage([BROAD_UPDATE], 'favourites', { gated: false }), true);

/* -------------------------------------------- the shape of a delegation -- */

/*
 * The thing this was asked for, as one case: somebody who may read the takings
 * and the invoices, and touch neither, and see nothing else.
 */
const accountant = ['view-takings legendTheme', 'view-invoices legendTheme'];

check('the reader reads', [maySee(accountant, 'takings'), maySee(accountant, 'invoices')], [true, true]);
check('the reader changes nothing', [mayManage(accountant, 'takings'), mayManage(accountant, 'invoices')], [false, false]);
check('and sees nothing else', maySee(accountant, 'packages'), false);

/* ------------------------------------------------------------------------- */

console.log('Permissions: ' + pass + ' passed, ' + fail + ' failed.');
process.exit(fail === 0 ? 0 : 1);
