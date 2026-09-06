/*
 * Support\IconPacks, the parts of it that are decisions.
 *
 * Nine hundred lines and the worst record in the project. Three faults shipped
 * from this one file, and every one of them was silent:
 *
 *   - A pack of icons exported from a design tool installed as sixty-one
 *     95-byte shells. The sanitiser dropped the one element each of them held,
 *     the upload said it worked, the picker listed them, and the sidebar drew
 *     eight blank rows. drawable() is the check that was missing.
 *   - drawable() then returned false for every icon for three releases, because
 *     an edit script turned the `\b` in its pattern into a literal backspace
 *     byte. check-controls exists because of that; this file is the other half.
 *   - The stylesheet cache was keyed only on the overrides, so a new pack did
 *     not invalidate it and the old icons kept drawing for a day.
 *
 * sanitise() has its own suite. What is here is everything else that decides
 * something: the name a file gets, whether what survived is worth keeping, and
 * the accounting in the install loop - which exists precisely so that a skipped
 * icon produces a number and a reason rather than silence.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);
const BACKSPACE = String.fromCharCode(8);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const MAX_FILES = 4000;
const MAX_SVG_BYTES = 262144;
const MAX_EXPANDED_BYTES = 536870912;

function slug(name) {
    name = String(name).toLowerCase().trim();
    name = name.replace(/[^a-z0-9._-]+/g, '-');
    name = name.replace(/^[-.]+/, '').replace(/[-.]+$/, '');

    return name === '' || name.length > 120 ? null : name;
}

// The pattern is read out of the PHP below rather than written here, so a
// control byte in it fails this file instead of shipping.
const drawablePattern = require('fs')
    .readFileSync(require('path').join(__dirname, '..', 'src/Support/IconPacks.php'), 'utf8')
    .match(/'#<\((path\|[^']*)\)[^']*'/);

const drawable = (svg) => new RegExp('<(path|image|circle|ellipse|rect|line|polyline|polygon|text|tspan)\\b', 'i').test(svg);

/*
 * The install loop, reduced to the order it decides things in.
 *
 * Each entry is { name, size, svg }. sanitise is a stand-in: null means the
 * sanitiser refused it.
 */
function install(entries, sanitise) {
    const icons = {};
    const skipped = { big: 0, unusable: 0, duplicate: 0, empty: 0 };
    let expanded = 0;
    let stopped = null;

    for (const entry of entries) {
        if (Object.keys(icons).length >= MAX_FILES) { stopped = 'files'; break; }

        if (!entry.name.toLowerCase().endsWith('.svg')) { continue; }

        if (entry.size > MAX_SVG_BYTES) { skipped.big++; continue; }

        expanded += entry.size;

        if (expanded > MAX_EXPANDED_BYTES) { stopped = 'size'; break; }

        const name = slug(entry.name.replace(/\.svg$/i, '').split('/').pop());

        if (name === null || name in icons) { skipped.duplicate++; continue; }

        const svg = sanitise(entry.svg);

        if (svg === null) { skipped.unusable++; continue; }

        if (!drawable(svg)) { skipped.empty++; continue; }

        icons[name] = svg;
    }

    return { icons: Object.keys(icons).sort(), skipped, stopped };
}

const keeps = (svg) => svg;
const entry = (name, svg, size) => ({ name, svg: svg === undefined ? '<svg><path d="M0 0"/></svg>' : svg, size: size === undefined ? 100 : size });

console.log('icon packs\n');

/* -------------------------------------------------------------- the name -- */

/*
 * A file name becomes part of a CSS selector and part of a storage path. Both
 * of those are reasons it cannot be whatever was in the zip.
 */
check('an ordinary name', slug('server'), 'server');
check('upper case comes down', slug('Server'), 'server');
check('a space becomes a dash', slug('my icon'), 'my-icon');
check('several become one', slug('my    icon'), 'my-icon');
check('dots and underscores are kept', slug('brand_icon.v2'), 'brand_icon.v2');
check('surrounding space', slug('  server  '), 'server');

/*
 * The path traversal case, and the reason install() also takes only basename():
 * two defences, because this one writes to disk.
 */
check('a traversal', slug('../../etc/passwd'), 'etc-passwd');
check('a leading slash', slug('/etc/passwd'), 'etc-passwd');
check('a windows path', slug('..' + String.fromCharCode(92) + 'x'), 'x');
check('nothing but dots', slug('...'), null);
check('nothing but dashes', slug('---'), null);
check('a name that is only punctuation', slug('!!!'), null);
check('empty', slug(''), null);

// It also ends up in a CSS selector, so what could end one has to go.
check('a quote', slug('a"b'), 'a-b');
check('a brace', slug('a{b}'), 'a-b');
check('an angle bracket', slug('<script>'), 'script');

check('exactly a hundred and twenty is kept', slug('a'.repeat(120)).length, 120);
check('a hundred and twenty-one is refused', slug('a'.repeat(121)), null);

/* --------------------------------------------------- is there anything in it */

/*
 * The check whose absence cost a day, and which then cost three releases by
 * being broken itself.
 */
check('a path draws', drawable('<svg><path d="M0 0"/></svg>'), true);
check('a circle draws', drawable('<svg><circle r="1"/></svg>'), true);
check('an image draws', drawable('<svg><image href="data:image/png;base64,x"/></svg>'), true);
check('a rect draws', drawable('<svg><rect width="1"/></svg>'), true);
check('upper case still draws', drawable('<svg><PATH d="M0 0"/></svg>'), true);
check('a newline before the attribute', drawable('<svg><path' + NEWLINE + 'd="M0 0"/></svg>'), true);

// The exact shape the sixty-one shells had: a valid open and close tag and
// nothing whatever in between.
check('an empty shell does not', drawable('<svg xmlns="http://www.w3.org/2000/svg"></svg>'), false);
check('a title alone does not', drawable('<svg><title>Icon</title></svg>'), false);

/*
 * And the honest limit of it: a path inside <defs> counts, even though a defs
 * draws nothing until something references it. This is a pattern rather than a
 * parser, and the difference only matters for an icon whose entire content is
 * an unreferenced definition - which is not a thing design tools export. Worth
 * writing down so it is a known edge rather than a surprise.
 */
check('a path inside defs still counts, which is the limit of a regex',
    drawable('<svg><defs><path d="M0 0"/></defs></svg>'), true);
check('but a defs with nothing drawable in it does not',
    drawable('<svg><defs><linearGradient/></defs></svg>'), false);
check('a group alone does not', drawable('<svg><g></g></svg>'), false);
check('nothing at all does not', drawable(''), false);

/*
 * The word boundary is what stops a longer name matching. Without it
 * <pathological> would count as a path - and the boundary is exactly the
 * character an edit script once turned into a backspace byte.
 */
check('a longer element is not a path', drawable('<svg><pathological/></svg>'), false);
check('and not a circle either', drawable('<svg><circles/></svg>'), false);

// The pattern in the PHP, read rather than assumed, so a control byte in it
// fails here instead of shipping silently.
check('the pattern was found in the php', drawablePattern !== null, true);
check('and it carries no control byte',
    drawablePattern === null || !drawablePattern[0].includes(BACKSPACE), true);

/* ------------------------------------------------------- what got skipped -- */

/*
 * Each of these was a silent skip once. A pack that hit a limit installed as
 * far as it got with no word about the rest, and the only symptom was a picker
 * missing icons the person knew they had packed.
 */
{
    const out = install([entry('a.svg'), entry('b.svg')], keeps);

    check('two good icons', out.icons, ['a', 'b']);
    check('and nothing skipped', out.skipped, { big: 0, unusable: 0, duplicate: 0, empty: 0 });
    check('and nothing stopped it', out.stopped, null);
}

check('a file that is not an svg is passed over silently',
    install([entry('readme.txt'), entry('a.svg')], keeps).icons, ['a']);

check('one too big is counted',
    install([entry('a.svg', undefined, MAX_SVG_BYTES + 1)], keeps).skipped.big, 1);

check('one the sanitiser refuses is counted',
    install([entry('a.svg')], () => null).skipped.unusable, 1);

check('one with nothing left to draw is counted',
    install([entry('a.svg', '<svg></svg>')], keeps).skipped.empty, 1);

check('two names that slug the same are one icon and one skip',
    install([entry('my icon.svg'), entry('my-icon.svg')], keeps),
    { icons: ['my-icon'], skipped: { big: 0, unusable: 0, duplicate: 1, empty: 0 }, stopped: null });

/*
 * The order the conditions are checked in is behaviour, not detail: a file that
 * is both too big and a duplicate is counted as too big, because size is
 * checked before the name is even worked out.
 */
check('too big beats duplicate',
    install([entry('a.svg'), entry('a.svg', undefined, MAX_SVG_BYTES + 1)], keeps).skipped,
    { big: 1, unusable: 0, duplicate: 0, empty: 0 });

// And unusable beats empty, because a refused file never reaches drawable().
check('unusable beats empty',
    install([entry('a.svg', '<svg></svg>')], () => null).skipped,
    { big: 0, unusable: 1, duplicate: 0, empty: 0 });

/* ------------------------------------------------------------ the limits -- */

/*
 * A few kilobytes of zip can hold a gigabyte of repeated whitespace, so the
 * guard is on what the entries expand to rather than on what was uploaded.
 *
 * The two caps interact, and the way they do is worth stating: no single entry
 * can trip the expanded cap, because the per-file cap is two thousand times
 * smaller and is checked first. The only way to reach half a gigabyte is a very
 * large number of very large icons, which is what a zip bomb looks like from
 * here.
 */
check('one entry cannot reach the expanded cap on its own',
    install([entry('a.svg', undefined, MAX_EXPANDED_BYTES)], keeps),
    { icons: [], skipped: { big: 1, unusable: 0, duplicate: 0, empty: 0 }, stopped: null });

{
    // Two thousand and forty-nine at the per-file maximum: the first 2048 come
    // to exactly the cap, and the next one passes it.
    const each = MAX_SVG_BYTES;
    const needed = Math.floor(MAX_EXPANDED_BYTES / each) + 1;
    const heavy = [];

    for (let i = 0; i < needed; i++) { heavy.push(entry('icon-' + i + '.svg', undefined, each)); }

    const out = install(heavy, keeps);

    check('enough of them together does stop it', out.stopped, 'size');
    check('and it keeps everything taken before that', out.icons.length, needed - 1);
}

// Accumulated before the check, so a run of files adds up rather than each
// being measured on its own.
check('right up to the cap is not past it',
    install([entry('a.svg', undefined, MAX_SVG_BYTES)], keeps).stopped, null);

{
    const many = [];

    for (let i = 0; i < MAX_FILES + 5; i++) { many.push(entry('icon-' + i + '.svg')); }

    const out = install(many, keeps);

    check('it stops at the file count', out.stopped, 'files');
    check('with exactly the cap taken', out.icons.length, MAX_FILES);
}

console.log(NEWLINE + 'icon packs: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
