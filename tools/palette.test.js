/*
 * Support\Palette, ported.
 *
 * The most arithmetic in the plugin and the least tested: a colour ramp built in
 * OKLCH, a WCAG contrast ratio in sRGB, and a conversion pair that has to
 * round-trip exactly. Every one of those is pure, and every one of them is the
 * kind of thing that can be a little bit wrong for a year.
 *
 * Two claims in that file are load-bearing and nothing checked either of them:
 *
 *   - "its own conversion rather than Filament's, so that this and hex() below
 *     are one pair that round-trips exactly - checked against #ffa500, #4f46e5,
 *     #1f6feb, #f5f5f5 and black, each of which comes back unchanged." Checked
 *     once, by hand, in the release that wrote it.
 *   - The readability warning measures the shade the panel paints rather than
 *     the colour that was typed. The backlog records the numbers that made that
 *     necessary - 1.97 for the naive reading, 2.73 for the real one - and those
 *     numbers are the whole argument.
 *
 * So this file is mostly those two, plus the input normaliser, which is the
 * function that stands between a text field and a stylesheet.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

const near = (label, got, want, slack) => {
    if (Math.abs(got - want) <= slack) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + got + '\n        want ' + want + ' (within ' + slack + ')');
};

/* -------------------------------------------------------------- the port -- */

const DEFAULT_ACCENT = '#ffa500';

const RAMP = {
    50: [0.19, 0.12],
    100: [0.16, 0.25],
    200: [0.12, 0.45],
    300: [0.08, 0.7],
    400: [0.04, 0.88],
    500: [0.0, 1.0],
    600: [-0.09, 0.97],
    700: [-0.18, 0.88],
    800: [-0.3, 0.74],
    900: [-0.38, 0.6],
    950: [-0.55, 0.35],
};

const PAPER = '#ffffff';
const INK = '#1c1917';

function sanitize(color, fallback) {
    fallback = fallback === undefined ? DEFAULT_ACCENT : fallback;

    if (typeof color !== 'string') { return fallback; }

    color = color.trim().replace(/^#+/, '');

    if (/^[0-9a-f]{3}$/i.test(color)) {
        color = color[0] + color[0] + color[1] + color[1] + color[2] + color[2];
    }

    if (!/^[0-9a-f]{6}$/i.test(color)) { return fallback; }

    return '#' + color.toLowerCase();
}

const byte = (hex, at) => parseInt(hex.substr(at, 2), 16);

function luminance(hex) {
    hex = sanitize(hex).replace('#', '');

    const channel = (value) => {
        const c = value / 255;

        return c <= 0.03928 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
    };

    return 0.2126 * channel(byte(hex, 0)) + 0.7152 * channel(byte(hex, 2)) + 0.0722 * channel(byte(hex, 4));
}

function contrast(a, b) {
    const first = luminance(a);
    const second = luminance(b);

    return Math.round(((Math.max(first, second) + 0.05) / (Math.min(first, second) + 0.05)) * 100) / 100;
}

function oklch(hex) {
    hex = hex.replace(/^#/, '');

    const linear = (value) => {
        const c = value / 255;

        return c <= 0.04045 ? c / 12.92 : Math.pow((c + 0.055) / 1.055, 2.4);
    };

    const r = linear(byte(hex, 0));
    const g = linear(byte(hex, 2));
    const b = linear(byte(hex, 4));

    const l = Math.cbrt(r * 0.4122214708 + g * 0.5363325363 + b * 0.0514459929);
    const m = Math.cbrt(r * 0.2119034982 + g * 0.6806995451 + b * 0.1073969566);
    const s = Math.cbrt(r * 0.0883024619 + g * 0.2817188376 + b * 0.6299787005);

    const lightness = 0.2104542553 * l + 0.7936177850 * m - 0.0040720468 * s;
    const a = 1.9779984951 * l - 2.4285922050 * m + 0.4505937099 * s;
    const bb = 0.0259040371 * l + 0.7827717662 * m - 0.8086757660 * s;

    const hue = Math.atan2(bb, a) * 180 / Math.PI;

    return [lightness, Math.sqrt(a * a + bb * bb), hue < 0 ? hue + 360 : hue];
}

function hex(lightness, chroma, hue) {
    const a = chroma * Math.cos(hue * Math.PI / 180);
    const b = chroma * Math.sin(hue * Math.PI / 180);

    const l = Math.pow(lightness + 0.3963377774 * a + 0.2158037573 * b, 3);
    const m = Math.pow(lightness - 0.1055613458 * a - 0.0638541728 * b, 3);
    const s = Math.pow(lightness - 0.0894841775 * a - 1.2914855480 * b, 3);

    const channels = [
        4.0767416621 * l - 3.3077115913 * m + 0.2309699292 * s,
        -1.2684380046 * l + 2.6097574011 * m - 0.3413193965 * s,
        -0.0041960863 * l - 0.7034186147 * m + 1.7076147010 * s,
    ];

    let out = '';

    for (let channel of channels) {
        channel = channel <= 0.0031308 ? 12.92 * channel : 1.055 * Math.pow(channel, 1 / 2.4) - 0.055;

        out += Math.round(Math.max(0, Math.min(1, channel)) * 255).toString(16).padStart(2, '0');
    }

    return '#' + out;
}

function shade(accent, level) {
    const [lightness, chroma, hue] = oklch(sanitize(accent));
    const [lightnessOffset, chromaMultiplier] = RAMP[level] || [0.0, 1.0];

    return hex(
        Math.max(0.1, Math.min(0.99, lightness + lightnessOffset)),
        Math.max(0.0, chroma * chromaMultiplier),
        hue,
    );
}

function readability(accent, surface) {
    accent = sanitize(accent);
    surface = sanitize(surface === undefined ? '' : surface, '');

    return {
        dark: contrast(shade(accent, 400), surface === '' ? INK : surface),
        light: contrast(shade(accent, 600), surface === '' ? PAPER : surface),
    };
}

console.log('colour\n');

/* ---------------------------------------------------- what reaches the CSS */

/*
 * sanitize() stands between a text field and a stylesheet. Everything else here
 * is arithmetic; this is the part where a wrong answer is a rule somebody else
 * wrote.
 */
check('six digits', sanitize('#ffa500'), '#ffa500');
check('without the hash', sanitize('ffa500'), '#ffa500');
check('upper case comes back lower', sanitize('#FFA500'), '#ffa500');
check('three digits expand', sanitize('#f50'), '#ff5500');
check('and without the hash', sanitize('f50'), '#ff5500');
check('surrounding space', sanitize('  #ffa500  '), '#ffa500');

check('empty falls back', sanitize(''), DEFAULT_ACCENT);
check('not a string', sanitize(null), DEFAULT_ACCENT);
check('a number', sanitize(16755200), DEFAULT_ACCENT);
check('a colour name', sanitize('orange'), DEFAULT_ACCENT);
check('four digits', sanitize('#ffa5'), DEFAULT_ACCENT);
check('seven digits', sanitize('#ffa5000'), DEFAULT_ACCENT);
check('not hex at all', sanitize('#gggggg'), DEFAULT_ACCENT);

// The one that matters: this value is written into a stylesheet unescaped.
check('a colour carrying a declaration', sanitize('#fff;}html{display:none'), DEFAULT_ACCENT);
check('a colour carrying a comment', sanitize('#fff/*'), DEFAULT_ACCENT);
check('rgb() is not a hex colour', sanitize('rgb(255,0,0)'), DEFAULT_ACCENT);

check('an empty fallback stays empty', sanitize('', ''), '');
check('and a chosen fallback is used', sanitize('nonsense', '#000000'), '#000000');

/* ------------------------------------------------------------ the ratios -- */

// The two ends of the scale, which are definitional rather than derived.
check('black on white', contrast('#000000', '#ffffff'), 21);
check('white on white', contrast('#ffffff', '#ffffff'), 1);
check('black on black', contrast('#000000', '#000000'), 1);
check('the order does not matter',
    contrast('#000000', '#ffffff'), contrast('#ffffff', '#000000'));

// Published figures, to catch a channel weight typed wrong.
near('mid grey on white', contrast('#767676', '#ffffff'), 4.54, 0.02);
near('a common link blue on white', contrast('#0000ff', '#ffffff'), 8.59, 0.02);

/* ------------------------------------------------------- the round trip -- */

/*
 * The claim the file makes about itself, checked. oklch() and hex() are their
 * own pair rather than Filament's forward with a borrowed reverse, precisely so
 * that a colour survives the journey - and a contrast warning built on a
 * conversion that is nearly right is a warning that is nearly right.
 */
for (const colour of ['#ffa500', '#4f46e5', '#1f6feb', '#f5f5f5', '#000000', '#ffffff', '#2e3440', '#002b36']) {
    const [l, c, h] = oklch(colour);

    check('round trip ' + colour, hex(l, c, h), colour);
}

// Shade 500 is the accent itself: the ramp anchors there with no offset and no
// multiplier, which is the whole reason the configured colour appears exactly.
for (const colour of ['#ffa500', '#4f46e5', '#22d36b']) {
    check('shade 500 is the accent, ' + colour, shade(colour, 500), colour);
}

check('a shade that is not one is treated as 500', shade('#ffa500', 42), '#ffa500');

/* --------------------------------------------------------- the clamps ---- */

// Lightness is held inside [0.1, 0.99] and chroma at or above nought, so no
// shade of any accent can come out as a colour the browser refuses.
for (const colour of ['#000000', '#ffffff', '#ffa500']) {
    for (const level of Object.keys(RAMP)) {
        const out = shade(colour, Number(level));

        check('shade ' + level + ' of ' + colour + ' is a hex colour',
            /^#[0-9a-f]{6}$/.test(out), true);
    }
}

/* ------------------------------------------------------- the readability -- */

/*
 * The numbers the backlog records, and the argument they carry.
 *
 * Measuring the colour as entered would have called the theme's own default
 * unreadable: #ffa500 on white is 1.97. The panel never paints that. On light it
 * paints shade 600 and on dark shade 400, and those are the two figures the
 * warning is actually about.
 */
near('the naive reading, which would have been wrong', contrast('#ffa500', PAPER), 1.97, 0.02);

{
    const orange = readability('#ffa500');

    near('the default accent on a light panel', orange.light, 2.73, 0.05);
    near('and on a dark one', orange.dark, 10.03, 0.05);

    // Which is why the shipped default does not trip the warning: the panel
    // opens dark, and only somebody who has moved it to light is told.
    check('dark is comfortably above the threshold', orange.dark > 3, true);
    check('light is below it, which is the true and useful thing to say',
        orange.light < 3, true);
}

{
    // A blue chosen for a light panel goes the other way, which is the check
    // that the two figures are not the same number twice.
    const blue = readability('#2563eb');

    check('a blue reads on white', blue.light > 3, true);
}

// A surface of one's own stands in for both defaults, so both figures move.
{
    const own = readability('#ffa500', '#000000');

    check('an accent on black reads in both', own.dark > 3 && own.light > 3, true);
    check('and the two are different shades of it', own.dark === own.light, false);
}

check('an unreadable pairing is reported as one',
    readability('#fefefe', '#ffffff').light < 1.5, true);

console.log(NEWLINE + 'colour: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
