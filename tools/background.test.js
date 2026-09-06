/*
 * Support\Background, ported.
 *
 * Every rule this class emits was scoped to `html.dark`. All four kinds of
 * background, and the sign-in picture with them. So on a light panel a chosen
 * colour did nothing, a gradient did nothing, an uploaded photograph did
 * nothing, and neither did the one preset built for light mode - four settings
 * that silently had no effect for anybody who had moved their panel.
 *
 * It is the same fault the backlog records once already, in the release where
 * nine surface tokens existed only under html.dark. It was made again in the one
 * place that sweep did not reach, and nothing would have caught it, because
 * "this rule is scoped to a mode" is not something a stylesheet fails at - it
 * just quietly does nothing half the time.
 *
 * So most of this file is about which selector comes out, and the rest is the
 * two things that turn a setting into CSS: a URL written straight into a url(),
 * and numbers written straight into a rule.
 */
let pass = 0;
let fail = 0;

const NEWLINE = String.fromCharCode(10);
const BS = String.fromCharCode(92);

const check = (label, got, want) => {
    if (JSON.stringify(got) === JSON.stringify(want)) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const MODES = ':is(html.dark,html:not(.dark))';

const clamp = (value, min, max, fallback) => {
    if (value === '' || value === null || value === undefined || isNaN(Number(value))) { return fallback; }

    return Math.max(min, Math.min(max, parseInt(Number(value), 10)));
};

function sanitiseUrl(url) {
    // Anything that could close the url() or the <style> block goes, rather
    // than being escaped: this string is written straight into a stylesheet.
    url = String(url).replace(new RegExp('[\\s"\'()<>' + BS + BS + ']', 'g'), '');

    if (url === '') { return null; }

    const relative = url.startsWith('/');
    const absolute = url.startsWith('https://') || url.startsWith('http://');

    return (relative || absolute) ? url : null;
}

// Stands in for Palette::sanitize(), which has its own suite coming.
const colour = (value, fallback) => /^#[0-9a-fA-F]{6}$/.test(String(value)) ? String(value).toLowerCase() : fallback;

function css(settings) {
    const kind = settings.background || 'aurora';

    if (kind === 'solid') {
        const c = colour(settings.background_color, '#14110e');

        return MODES + ' .fi-body{background-color:' + c + ';background-image:none;}' + neutralise();
    }

    if (kind === 'gradient') {
        const from = colour(settings.background_color, '#14110e');
        const to = colour(settings.background_color_end, '#2b1c08');
        const angle = clamp(settings.background_angle, 0, 360, 160);

        return MODES + ' .fi-body{background-color:' + from
            + ';background-image:linear-gradient(' + angle + 'deg,' + from + ',' + to
            + ');background-attachment:fixed;}' + neutralise();
    }

    if (kind === 'image') {
        const url = sanitiseUrl(settings.background_image_url || '');

        if (url === null) { return ''; }

        const dim = clamp(settings.background_dim, 0, 90, 55);
        const blur = clamp(settings.background_blur, 0, 24, 0);

        if (blur === 0) {
            return MODES + ' .fi-body{background-image:linear-gradient(rgb(0 0 0 / ' + dim
                + '%),rgb(0 0 0 / ' + dim + '%)),url("' + url + '");'
                + 'background-size:cover,cover;background-position:center,center;'
                + 'background-attachment:fixed,fixed;background-repeat:no-repeat,no-repeat;}' + neutralise();
        }

        return MODES + ' .fi-body{background-image:none;}'
            + MODES + ' .fi-body::before{blur:' + blur + '}'
            + MODES + ' .fi-body::after{dim:' + dim + '}' + neutralise();
    }

    // aurora: the glows are the stylesheet's, in whichever mode. Only the base
    // is a setting, and only when one was chosen.
    const base = String(settings.background_color || '').trim();

    return base === '' ? '' : ':root{--ld-backdrop:' + colour(base, '#14110e') + ';}';
}

const neutralise = () => MODES + ' .fi-simple-layout{background-color:transparent;background-image:none;}';

console.log('page background\n');

/* ------------------------------------------------------- both modes, always */

/*
 * The whole point of the file. Every selector this emits has to reach a light
 * panel as well as a dark one, and it has to weigh the same as the stylesheet
 * rule it is overriding - which is scoped to a mode and therefore (0,2,1).
 * A bare `.fi-body` is (0,1,0) and would lose however late it came.
 */
const kinds = [
    ['solid', { background: 'solid', background_color: '#112233' }],
    ['gradient', { background: 'gradient', background_color: '#112233' }],
    ['an image', { background: 'image', background_image_url: 'https://l3g3clan.nl/a.png' }],
    ['a blurred image', { background: 'image', background_image_url: 'https://l3g3clan.nl/a.png', background_blur: 8 }],
];

for (const [name, settings] of kinds) {
    const out = css(settings);

    check(name + ' reaches light as well as dark', out.includes(MODES), true);
    check(name + ' names no mode on its own', /html\.dark\s+\.fi-body/.test(out), false);
    check(name + ' clears the sign-in layer in both too',
        out.includes(MODES + ' .fi-simple-layout'), true);
}

/* ---------------------------------------------------------------- aurora -- */

/*
 * Aurora emits no rule of its own - the glows are in the stylesheet, which has
 * a dark form and a light one. All it contributes is the colour underneath, and
 * only when somebody chose one.
 */
check('aurora with nothing chosen emits nothing', css({ background: 'aurora' }), '');
check('and so does an empty colour', css({ background: 'aurora', background_color: '   ' }), '');

check('aurora with a base emits only the token',
    css({ background: 'aurora', background_color: '#2e3440' }),
    ':root{--ld-backdrop:#2e3440;}');

// A token on :root reaches both modes without this class knowing which is
// showing, which is why the base is a token rather than a rule.
check('the base names no mode at all',
    css({ background: 'aurora', background_color: '#2e3440' }).includes('html'), false);

check('a base that is not a colour falls back',
    css({ background: 'aurora', background_color: 'red; }' }),
    ':root{--ld-backdrop:#14110e;}');

/* ----------------------------------------------------------- the numbers -- */

check('a dim in range', clamp(40, 0, 90, 55), 40);
check('too much dim', clamp(300, 0, 90, 55), 90);
check('negative dim', clamp(-5, 0, 90, 55), 0);
check('no dim', clamp('', 0, 90, 55), 55);
check('a dim that is not a number', clamp('dark', 0, 90, 55), 55);
check('an angle', clamp(135, 0, 360, 160), 135);
check('an angle past the circle', clamp(400, 0, 360, 160), 360);

/*
 * The angle goes straight into a linear-gradient. A clamp that let a string
 * through would be a way to write a declaration of somebody's choosing into
 * every page of the panel.
 */
check('an angle cannot carry anything else',
    css({ background: 'gradient', background_color: '#000000', background_angle: '90;}html{x:y' })
        .includes('160deg'), true);

/* ------------------------------------------------------------- the url --- */

check('an https address', sanitiseUrl('https://l3g3clan.nl/a.png'), 'https://l3g3clan.nl/a.png');
check('a path on this panel', sanitiseUrl('/storage/theme/a.png'), '/storage/theme/a.png');
check('plain http, which is allowed here', sanitiseUrl('http://l3g3clan.nl/a.png'), 'http://l3g3clan.nl/a.png');

/*
 * What the sanitiser promises, and it is narrower than "this looks like a URL".
 *
 * The address is written into url("…") inside a <style> element, so the only
 * things that could turn it into something else are the ones that end a CSS
 * string, end the url(), or end the element: quotes, brackets, whitespace,
 * angle brackets and a backslash. Those are stripped rather than escaped, and
 * then what is left has to still start like an address.
 *
 * A brace is deliberately not on that list. Inside a quoted CSS string it is an
 * ordinary character, and it cannot get out of the quotes because the quote
 * itself is gone. The test below proves that rather than assuming it.
 */
check('a quote', sanitiseUrl('https://a.nl/"a.png'), 'https://a.nl/a.png');
check('a space', sanitiseUrl('https://a.nl/a b.png'), 'https://a.nl/ab.png');
check('a bracket', sanitiseUrl('https://a.nl/a)b.png'), 'https://a.nl/ab.png');
check('an angle bracket', sanitiseUrl('https://a.nl/<script>'), 'https://a.nl/script');
check('a backslash', sanitiseUrl('https://a.nl/a' + BS + 'b.png'), 'https://a.nl/ab.png');
check('a scheme that is not one', sanitiseUrl('javascript:alert(1)'), null);
check('a data url', sanitiseUrl('data:text/html,x'), null);
check('a bare host', sanitiseUrl('l3g3clan.nl/a.png'), null);
check('empty', sanitiseUrl(''), null);
check('nothing but the stripped characters', sanitiseUrl('")}<>'), null);

/*
 * The property that actually matters: whatever was typed, the emitted rule
 * still has exactly one url(), still quoted, and the <style> element is intact.
 */
{
    const nasty = 'https://a.nl/a.png")}html{display:none}</style><script>alert(1)</script>';
    const out = css({ background: 'image', background_image_url: nasty });

    // split rather than a regex: a backslash in this file has been eaten by
    // the tooling more than once, and counting substrings needs neither.
    check('one url, still quoted', out.split('url("').length - 1, 1);
    check('no quote escaped out of it', out.includes('.png")'), false);
    check('the style element survives', out.toLowerCase().includes('</style'), false);
    check('and no script came with it', out.toLowerCase().includes('<script'), false);
}

// No address is no rule at all, rather than a rule with an empty url() in it.
check('an image with no address emits nothing', css({ background: 'image' }), '');

console.log(NEWLINE + 'page background: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
