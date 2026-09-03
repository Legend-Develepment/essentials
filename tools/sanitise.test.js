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

console.log('\nsvg sanitiser: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
