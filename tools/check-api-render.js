/*
 * Everything the documentation array carries has to reach both downloads.
 *
 * `check-api-docs.js` beside this one guards the array against the code: every
 * address, status code and ability the controller knows has to appear in
 * Docs::endpoints() and Docs::errors(). It never looks at what is made *from*
 * that array, and the two things made from it are the files people actually
 * take away - a Markdown copy for the repository beside a bot, and an OpenAPI
 * file for Postman.
 *
 * So both could be silently short, and both were. Every endpoint has carried an
 * `ability` since keys could be narrowed, and neither download ever said which
 * one an endpoint needed - a bot author was told a key can be held to six
 * groups and never told which group any particular call falls in. The webhook
 * has carried a list of every event name it can send, built, checked by nothing
 * and emitted nowhere: a receiver knew one event name, the one in the example.
 *
 * Neither was a wrong sentence, which is why reading the file did not catch it.
 * A key that is built and never read leaves nothing behind to notice.
 *
 * What this checks is only structural, and deliberately: whether each renderer
 * *mentions* each key. It cannot tell whether it mentions it usefully. That is
 * the same bargain every gate here makes, and it is worth taking, because the
 * failure it catches is the silent one.
 */

const fs = require('fs');
const path = require('path');

const file = path.join(__dirname, '..', 'src', 'Support', 'Api', 'Docs.php');

if (!fs.existsSync(file)) {
    console.error('API render check: src/Support/Api/Docs.php is gone.'
        + '\n    This gate reads it by name. If it moved, this gate needs the new one.');
    process.exit(1);
}

// Read with plain newlines whatever the checkout wrote. Every pattern below
// ends a method at `\n    }`, and a Windows checkout with core.autocrlf hands
// the file over with \r\n, which made this gate refuse a correct Docs.php.
const source = fs.readFileSync(file, 'utf8').replace(/\r\n/g, '\n');
const problems = [];

/**
 * One method's body, from its signature to the closing brace at its own indent.
 *
 * Braces rather than a blank line, because several of these hold nested arrays
 * with blank lines in them. Four spaces is the indent every method here sits
 * at, so `\n    }` is the end of one and nothing else.
 */
function body(name) {
    const start = source.indexOf('function ' + name + '(');

    if (start < 0) {
        problems.push('Docs::' + name + '() is gone, and this gate reads it by name.'
            + '\n    If it was renamed, this gate needs the new name - it must not be deleted.');

        return '';
    }

    const end = source.indexOf('\n    }', start);

    return end < 0 ? source.slice(start) : source.slice(start, end);
}

const endpoints = body('endpoints');
const webhook = body('webhook');
const markdown = body('markdown');
const openapi = body('openapi');

/**
 * The keys of one entry, by their indent.
 *
 * An endpoint entry sits at twelve spaces and its keys at sixteen; anything
 * deeper is inside an `answers` or a `params`, which is example data rather
 * than a field of the entry. Matching the indent exactly is what tells the two
 * apart without parsing PHP.
 */
function keysAt(text, indent) {
    const found = new Set();
    const pattern = new RegExp('^ {' + indent + "}'([a-z_]+)' =>", 'gm');

    for (const match of text.matchAll(pattern)) {
        found.add(match[1]);
    }

    return found;
}

const entryKeys = keysAt(endpoints, 16);
const hookKeys = keysAt(webhook, 12);

if (entryKeys.size === 0 || hookKeys.size === 0) {
    problems.push('No keys were found in Docs::endpoints() or Docs::webhook().'
        + '\n    This gate reads them by indent, so a reformat can blind it. Check the'
        + '\n    indentation before assuming there is nothing to find.');
}

/* --------------------------------------------- what each endpoint carries -- */

for (const key of entryKeys) {
    for (const [where, text] of [['the Markdown', markdown], ['the OpenAPI file', openapi]]) {
        if (!text.includes("['" + key + "']")) {
            problems.push('Every endpoint carries `' + key + '` and ' + where + ' never reads it.'
                + '\n    Docs::endpoints() is the only description of this API there is, so a field'
                + '\n    built into it and left out of a download is a field nobody downloading'
                + '\n    will ever know about. Emit it, or take it out of the array.');
        }
    }
}

/* ----------------------------------------------- what the webhook carries -- */

for (const key of hookKeys) {
    if (!markdown.includes("$hook['" + key + "']")) {
        problems.push('Docs::webhook() carries `' + key + '` and the Markdown never emits it.'
            + '\n    The person who needs this is writing the receiver, and the Markdown is'
            + '\n    where they are reading. Everything the webhook knows belongs in it.');
    }
}

/* --------------------------------------------------- the errors that pair -- */

/*
 * Two errors share the status code 404, and both renderers used to key on the
 * code alone: the Markdown printed the same heading twice and the OpenAPI file
 * kept whichever was written last. A name apiece is what tells them apart, so
 * every error needs one.
 */
const errors = body('errors');
const codes = [...errors.matchAll(/'code' => (\d{3}),\n\s*'name' => '([^']+)'/g)];
const declared = [...errors.matchAll(/'code' => (\d{3})/g)];

if (codes.length !== declared.length) {
    problems.push((declared.length - codes.length) + ' error(s) in Docs::errors() have no `name`.'
        + '\n    Two of these share a status code. Without a name the Markdown prints the same'
        + "\n    heading twice and the OpenAPI file keeps only the last one written, so one of"
        + '\n    the pair is published nowhere. Give every error a short name.');
}

const names = new Map();

for (const [, code, name] of codes) {
    const seen = names.get(code) ?? [];

    if (seen.includes(name)) {
        problems.push('Two errors answer ' + code + ' under the same name, ' + name + '.'
            + '\n    They are told apart by it, so it has to differ.');
    }

    names.set(code, [...seen, name]);
}

/* --------------------------------------------------------------- verdict -- */

if (problems.length > 0) {
    console.error('API render check: ' + problems.length + ' problem(s).\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error('Both downloads are built from one array, and have to spend all of it. Nothing was built.');
    process.exit(1);
}

console.log('API render check: ' + entryKeys.size + ' endpoint field(s) and ' + hookKeys.size
    + ' webhook field(s), every one of them in both downloads.');
