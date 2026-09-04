/*
 * Support\Artwork, ported, against the two things it decides.
 *
 * **The tags.** Two facts per egg live in Pelican's `tags` array column: which
 * Steam game this is, and whether somebody chose the picture by hand. The
 * plugin this grew out of wrote that column from four places with four slightly
 * different copies of the same code, and one of them used array_filter without
 * array_values - which leaves a PHP array with a gap in its keys, and json_encode
 * turns a gapped array into an object rather than a list. An egg whose tags
 * column had become {"1":"steam:892970"} instead of ["steam:892970"] is one
 * Pelican's own egg editor cannot read.
 *
 * So there is one writer now, and this is what it has to keep true.
 *
 * **The bytes.** Anything downloaded is checked before it reaches the disk. The
 * version that trusted the status code wrote CDN error pages to storage as
 * <uuid>.jpg: the egg then had an icon, the panel drew a broken image, and
 * nothing said why.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* ------------------------------------------------------------- the tags -- */

const PROTECTED = 'icon:protected';
const STEAM = 'steam:';

/* Artwork::tags() - the column holds whatever has ever been put in it. */
const tags = (egg) => Array.isArray(egg.tags) ? egg.tags.filter((t) => typeof t === 'string') : [];

/* Artwork::write() - one read, one filter, one save. */
const write = (egg, keep, add = null) => {
    const before = tags(egg);
    const after = before.filter(keep);

    if (add !== null) { after.push(add); }

    // The no-op check compares values, the way PHP's === does on two lists.
    if (JSON.stringify(after) === JSON.stringify(before)) { return { egg, saved: false }; }

    return { egg: { ...egg, tags: after }, saved: true };
};

const setSteam = (egg, id) => id <= 0
    ? { egg, saved: false }
    : write(egg, (t) => !t.startsWith(STEAM), STEAM + id);

const steamId = (egg) => {
    for (const t of tags(egg)) {
        if (t.startsWith(STEAM)) {
            const n = parseInt(t.slice(STEAM.length), 10) || 0;
            return n > 0 ? n : null;
        }
    }
    return null;
};

const isProtected = (egg) => tags(egg).includes(PROTECTED);
const protect = (egg) => isProtected(egg) ? { egg, saved: false } : write(egg, () => true, PROTECTED);
const unprotect = (egg) => write(egg, (t) => t !== PROTECTED);

console.log('egg artwork\n');

/* A list stays a list. This is the bug the one-writer rule exists to prevent. */
check('removing the first tag leaves a list', unprotect({ tags: [PROTECTED, 'java'] }).egg.tags, ['java']);
check('removing the middle tag leaves a list', unprotect({ tags: ['java', PROTECTED, 'paper'] }).egg.tags, ['java', 'paper']);
check('removing the only tag leaves an empty list', unprotect({ tags: [PROTECTED] }).egg.tags, []);

/* Replacing rather than accumulating. */
check('a second app id replaces the first', setSteam({ tags: ['steam:1'] }, 2).egg.tags, ['steam:2']);
check('an app id keeps the other tags', setSteam({ tags: ['java', 'steam:1'] }, 2).egg.tags, ['java', 'steam:2']);
check('an app id is added when there is none', setSteam({ tags: ['java'] }, 892970).egg.tags, ['java', 'steam:892970']);

/* A save that changes nothing does not happen. */
check('unprotecting what is not protected does not save', unprotect({ tags: ['java'] }).saved, false);
check('protecting what is protected does not save', protect({ tags: [PROTECTED] }).saved, false);
check('protecting what is not does save', protect({ tags: ['java'] }).saved, true);
check('protect appends', protect({ tags: ['java'] }).egg.tags, ['java', PROTECTED]);

/* Reading back. */
check('an app id is read back', steamId({ tags: ['java', 'steam:892970'] }), 892970);
check('no app id reads as none', steamId({ tags: ['java'] }), null);
check('a zero app id reads as none', steamId({ tags: ['steam:0'] }), null);
check('rubbish after the prefix reads as none', steamId({ tags: ['steam:abc'] }), null);
// Two eggs on one panel had this. It has to answer, not throw.
check('a non-string tag is ignored', steamId({ tags: [null, 7, 'steam:5'] }), 5);
check('a missing column is ignored', steamId({}), null);
check('a column that is not an array is ignored', steamId({ tags: 'steam:5' }), null);

/* An id that is not one is refused rather than written. */
check('a zero app id is not written', setSteam({ tags: ['java'] }, 0).egg.tags, ['java']);
check('a negative app id is not written', setSteam({ tags: ['java'] }, -3).egg.tags, ['java']);

/* Protection and the app id are separate facts. */
check('setting an app id does not protect', isProtected(setSteam({ tags: [] }, 5).egg), false);
check('protecting does not remove an app id', steamId(protect({ tags: ['steam:5'] }).egg), 5);

/* ------------------------------------------------------------ the bytes -- */

/*
 * Artwork::store()'s decision, without the disk.
 *
 * `type` stands in for getimagesizefromstring(), which answers with what the
 * bytes actually are rather than with what the address claimed - the whole
 * reason the check is here and not on the URL.
 */
const MAX = 4194304;

const store = (length, type) => {
    if (length === 0) { return 'empty'; }
    if (length > MAX) { return 'large'; }
    if (type === null) { return 'not_an_image'; }

    return ({ jpeg: 'jpg', png: 'png', webp: 'webp' })[type] ?? 'wrong_format';
};

check('a jpeg is written as jpg', store(40000, 'jpeg'), 'jpg');
check('a png is written as png', store(40000, 'png'), 'png');
check('a webp is written as webp', store(40000, 'webp'), 'webp');

check('an empty answer is refused', store(0, 'jpeg'), 'empty');
// A CDN answering 200 with an HTML error page. This is the one that shipped.
check('an error page is refused', store(1200, null), 'not_an_image');
check('something enormous is refused', store(MAX + 1, 'jpeg'), 'large');
check('exactly the cap is allowed', store(MAX, 'jpeg'), 'jpg');
// Real pictures Pelican has nowhere to put. Refused rather than converted:
// converting would mean this plugin depending on an image library.
check('a gif is refused', store(40000, 'gif'), 'wrong_format');
check('a bmp is refused', store(40000, 'bmp'), 'wrong_format');
// Size is checked before type, so a huge error page is reported as huge.
check('size is checked before type', store(MAX + 1, null), 'large');

console.log('\negg artwork: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
