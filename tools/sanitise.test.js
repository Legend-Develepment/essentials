/*
 * IconPacks::sanitise(), ported faithfully, against the two things it has to get
 * right at once.
 *
 * It used to strip every <image> element. That is safe and it made the plugin's
 * own icon set draw nothing at all: an icon exported from a design tool is one
 * <image> holding a base64 picture and nothing else, so sanitising it left an
 * empty <svg> that installed, listed in the picker, and rendered as a blank
 * space. Sixty-one of them.
 *
 * So the rule is narrower now, and narrower rules are the ones worth testing:
 * an <image> whose source is an inert data: picture stays, and one carrying an
 * address - which would make a browser fetch something every time an icon is
 * drawn - still goes.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.log('  FAIL ' + label + '\n    got  ' + JSON.stringify(got) + '\n    want ' + JSON.stringify(want));
};

/* The PHP, line for line. */
const sanitise = (input) => {
    let svg = input.trim();

    if (svg === '' || !/<svg[\s>]/i.test(svg)) return null;

    const start = svg.toLowerCase().indexOf('<svg');
    if (start === -1) return null;

    svg = svg.slice(start);

    svg = svg.replace(/<script\b[^>]*>[\s\S]*?<\/script>/gi, '');
    svg = svg.replace(/<(script|foreignObject|iframe|use)\b[^>]*\/?>/gi, '');

    svg = svg.replace(/<image\b[^>]*\/?>/gi, (tag) =>
        /(href|xlink:href)\s*=\s*("|')data:image\/(png|jpe?g|gif|webp);base64,/i.test(tag) ? tag : '');

    svg = svg.replace(/\son[a-z-]+\s*=\s*("[^"]*"|'[^']*'|[^\s>]+)/gi, '');
    svg = svg.replace(/(href|xlink:href)\s*=\s*("|')?\s*javascript:[^"'>\s]*("|')?/gi, '');

    return svg.trim() === '' ? null : svg;
};

const has = (svg, needle) => svg !== null && svg.includes(needle);

/* ---------------------------------------------- the picture must stay ---- */

const picture = '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64">'
    + '<image width="64" height="64" href="data:image/png;base64,iVBORw0KGgo="/>'
    + '</svg>';

check('a base64 png survives', has(sanitise(picture), 'data:image/png;base64'), true);
check('and the svg is not emptied', sanitise(picture) === null, false);

for (const type of ['jpeg', 'jpg', 'gif', 'webp']) {
    const one = picture.replace('image/png', 'image/' + type);
    check(type + ' survives', has(sanitise(one), 'data:image/' + type), true);
}

check('single quotes', has(sanitise(picture.replace(/"/g, "'")), 'data:image/png'), true);
check('xlink:href', has(sanitise(picture.replace('href=', 'xlink:href=')), 'data:image/png'), true);

/* --------------------------------------------- and the address must go --- */

const remote = (src) => '<svg xmlns="http://www.w3.org/2000/svg"><image href="' + src + '"/><circle r="1"/></svg>';

check('http source dropped', has(sanitise(remote('http://evil.test/a.png')), '<image'), false);
check('https source dropped', has(sanitise(remote('https://evil.test/a.png')), '<image'), false);
check('protocol-relative dropped', has(sanitise(remote('//evil.test/a.png')), '<image'), false);
check('a bare path dropped', has(sanitise(remote('/etc/passwd')), '<image'), false);
check('javascript source dropped', has(sanitise(remote('javascript:alert(1)')), '<image'), false);
// An SVG inside an SVG is a second document, and there is no reason to take one.
check('nested svg data dropped', has(sanitise(remote('data:image/svg+xml;base64,PHN2Zz4=')), '<image'), false);
check('data but not an image dropped', has(sanitise(remote('data:text/html;base64,PGI+')), '<image'), false);
// The rest of the drawing is untouched either way.
check('the drawing survives a dropped image', has(sanitise(remote('http://evil.test/a.png')), '<circle'), true);

/* ------------------------------------- everything else still goes away --- */

check('script element', has(sanitise('<svg><script>alert(1)</script><circle/></svg>'), 'alert'), false);
check('use element', has(sanitise('<svg><use href="x"/><circle/></svg>'), '<use'), false);
check('foreignObject', has(sanitise('<svg><foreignObject/><circle/></svg>'), '<foreignObject'), false);
check('iframe', has(sanitise('<svg><iframe src="x"/></svg>'), '<iframe'), false);
check('onload handler', has(sanitise('<svg onload="alert(1)"><circle/></svg>'), 'onload'), false);
check('handler on an allowed image', has(
    sanitise('<svg><image href="data:image/png;base64,AA=" onload="alert(1)"/></svg>'), 'onload'), false);
check('the image survives that', has(
    sanitise('<svg><image href="data:image/png;base64,AA=" onload="alert(1)"/></svg>'), 'data:image/png'), true);

check('not an svg at all', sanitise('<html><body>x</body></html>'), null);
check('empty input', sanitise('   '), null);
check('xml declaration is dropped', sanitise('<?xml version="1.0"?><svg><circle/></svg>').startsWith('<svg'), true);

/* ------------------------------- nothing left to draw is not an icon ----- */

/*
 * The check that was missing, and whose absence cost a day.
 *
 * The sanitiser is fixed, so an <image> holding a base64 picture no longer
 * disappears - but that is exactly why this guard is tested on its own. The
 * next rule that turns out to be too broad should produce a number and a reason
 * on the upload, rather than sixty-one 95-byte files that install without
 * complaint, list in the picker, and draw a blank row in the sidebar.
 *
 * ---------------------------------------------------------------------------
 *
 * Read out of the PHP rather than written again here, and that is the whole
 * point of these fifteen lines.
 *
 * This test used to carry its own copy of the pattern, typed by hand from what
 * the pattern was meant to be. Meanwhile the pattern that reached IconPacks.php
 * had a literal backspace - 0x08 - where its \b should have been, put there by
 * tooling that read the escape one layer too early. So the regex demanded a
 * backspace immediately after every SVG tag name, drawable() answered false for
 * every icon in existence, and this file went on passing: it was testing an
 * idea, not a file.
 *
 * A test that reproduces the code cannot catch the code being wrong. Reading
 * the real pattern costs one regex and would have failed on the first run.
 */
const iconPacks = require('fs').readFileSync(
    require('path').join(__dirname, '..', 'src', 'Support', 'IconPacks.php'),
    'utf8',
);

const pattern = /private static function drawable[\s\S]*?'#(.*?)#i'/.exec(iconPacks);

if (pattern === null) {
    console.error('  FAIL  IconPacks::drawable() could not be read - has it been renamed?');
    process.exit(1);
}

const drawable = (svg) => new RegExp(pattern[1], 'i').test(svg);

check('a bare svg shell is not drawable', drawable('<svg width="128" height="128"></svg>'), false);
check('exactly what the old sanitiser left behind', drawable(
    sanitise('<svg width="128" height="128"><image href="http://evil.test/a.png"/></svg>')), false);

check('a data image is drawable', drawable('<svg><image href="data:image/png;base64,AA="/></svg>'), true);
check('a path is drawable', drawable('<svg><path d="M0 0"/></svg>'), true);
check('a circle is drawable', drawable('<svg><circle r="1"/></svg>'), true);

// Real SVG that puts no marks on a canvas. A pack of these is a pack of nothing,
// and it is the shape an over-broad rule leaves behind.
check('defs alone is not drawable', drawable('<svg><defs><linearGradient/></defs></svg>'), false);
check('a title alone is not drawable', drawable('<svg><title>Console</title></svg>'), false);
check('an empty group is not drawable', drawable('<svg><g></g></svg>'), false);

console.log('\nsvg sanitiser: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
