/*
 * The page background reaches both modes.
 *
 * Every background rule in this plugin was scoped to `html.dark` - the backdrop
 * in the stylesheet, and all four kinds that Support\Background emits from the
 * settings. So a light panel got no backdrop, and a colour, a gradient or an
 * uploaded picture chosen on a light panel did nothing at all. Four settings
 * that silently had no effect, and the one preset built for light mode was the
 * one preset whose background was never painted.
 *
 * Nothing catches that on its own. A rule scoped to a mode does not fail - it
 * just quietly does nothing half the time, on the half of panels the person who
 * wrote it was not looking at. It is the same fault the backlog already records
 * from the release where nine surface tokens existed only under html.dark, made
 * again in the one place that sweep did not reach.
 *
 * So this checks the two halves that have to stay true:
 *
 *   1. the stylesheet paints `.fi-body` in dark AND in light, and
 *   2. Support\Background names no single mode in the CSS it emits.
 *
 * It deliberately does not check anything else for a light counterpart. Most
 * dark rules here are correct without one - light mode keeps Pelican's own
 * neutrals and only inherits the accent. It is the backdrop that has to be in
 * both, because the backdrop is the one thing a setting on the Look page points
 * at.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

const problems = [];

/* -------------------------------------------------------- the stylesheet -- */

const css = read('resources/css/theme.css');

// The two backdrop rules, by the selector each one has to carry. Matched on the
// selector rather than on a comment, so renaming a comment cannot pass this.
const DARK = ':is(html.dark, .ld-preview--dark) .fi-body {';
// Bare, and that is the point: it has to weigh exactly what the dark rule
// weighs, (0,2,1), or a chosen background loses to it on one side and wins on
// the other. See the comment above the rule itself.
const LIGHT = 'html:not(.dark) .fi-body {';

if (!css.includes(DARK)) {
    problems.push('resources/css/theme.css has no dark backdrop rule.\n    Expected a rule for: ' + DARK);
}

if (!css.includes(LIGHT)) {
    problems.push('resources/css/theme.css has no light backdrop rule.\n    Expected a rule for: ' + LIGHT);
}

/*
 * And the base is a token, not a literal.
 *
 * That is what lets a scheme with a night colour of its own - Nord's polar
 * night, Solarized's base03 - use the backdrop instead of giving it up and
 * going flat. Six of the twelve presets were flat for exactly that reason.
 */
const backdropRule = css.slice(css.indexOf(DARK), css.indexOf(DARK) + 400);

if (css.includes(DARK) && !backdropRule.includes('var(--ld-backdrop)')) {
    problems.push('The dark backdrop paints a colour of its own rather than var(--ld-backdrop).\n'
        + '    A preset with a base colour cannot then use it, which is what made six of them flat.');
}

/* ---------------------------------------------------------- the settings -- */

const php = read('src/Support/Background.php');

/*
 * Comments come out first. This file has to talk about html.dark at length -
 * it is explaining why it no longer emits it - and a check that could not tell
 * the difference would be a check nobody could write that explanation past.
 */
const code = php
    .replace(/\/\*[\s\S]*?\*\//g, '')
    .split('\n')
    .filter((line) => !line.trim().startsWith('//'))
    .join('\n');

const lines = code.split('\n');

lines.forEach((line, index) => {
    // The constants are the sanctioned use: they name both modes in one
    // selector, which is the whole point of them.
    if (line.includes('private const MODES') || line.includes('private const SIMPLE')) {
        return;
    }

    if (line.includes('html.dark') || line.includes("html:not(.dark)")) {
        problems.push('src/Support/Background.php:' + (index + 1) + ' names one mode in emitted CSS.\n'
            + '    ' + line.trim() + '\n'
            + '    Use self::MODES, which matches either mode at the weight the override needs.');
    }
});

/* --------------------------------------------------------------- verdict -- */

if (problems.length > 0) {
    console.error('Backdrop check: ' + problems.length + ' problem(s).\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error('A background scoped to one mode does not fail - it does nothing on the');
    console.error('other half of panels, and nobody notices until somebody switches.');
    process.exit(1);
}

console.log('Backdrop check: painted in both modes, and the base is a token.');
