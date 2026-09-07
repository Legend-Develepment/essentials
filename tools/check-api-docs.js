/*
 * The API and what it says about itself have to agree.
 *
 * Two halves, and the second exists because the first could not have caught
 * what this gate was asked to catch.
 *
 * **Paths**, which is the drift that loses a bot to a 404: an endpoint that
 * ships undocumented, or one documented after it stopped existing. That was the
 * whole of this check for several releases.
 *
 * **And every other name the code uses.** Two releases added abilities, a
 * ceiling per key and a second shape of 403, and the documentation described
 * none of them while this reported everything in order - which it was, because
 * everything it looked at was. A gate that is right about its own question and
 * silent about the one that matters is worse than none, because it is mistaken
 * for coverage.
 *
 * What a script cannot check is whether a sentence is *true*. What it can check
 * is whether every name the code uses appears in the documentation at all: each
 * status code it can answer, each error string it emits, each ability a key can
 * be narrowed to. A name the code knows and the documentation has never heard
 * of is drift, every time.
 *
 * It reads the source rather than booting Laravel, like every other gate here:
 * there is no PHP on the machine this is built on.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

const PROVIDER = 'src/Providers/ThemeServiceProvider.php';
const CONTROLLER = 'src/Http/ApiController.php';
const DOCS = 'src/Support/Api/Docs.php';

const provider = read(PROVIDER);
const controller = read(CONTROLLER);
const docs = read(DOCS);

const problems = [];

/* ------------------------------------------------------- what is routed --- */

/*
 * Only inside registerApiRoutes(). The provider also registers the arranger's
 * endpoint, the favourites one, the go-to menu and both status pages, and none
 * of those are the API - documenting them here would be as wrong as missing one
 * that is.
 */
const from = provider.indexOf('private function registerApiRoutes');
const slice = from === -1 ? '' : provider.slice(from, from + 4000);

const routed = [];

// ->get('/api/essentials/' . ApiController::CONTRACT . '/health', ...)
for (const m of slice.matchAll(/->(get|post|put|patch|delete)\(\s*'[^']*'\s*\.\s*[\w:\\]*CONTRACT\s*\.\s*'([^']+)'/g)) {
    routed.push(m[1].toUpperCase() + ' ' + m[2]);
}

// Route::get($base . '/nodes', ...) - the form once there is more than one.
for (const m of slice.matchAll(/Route::(get|post|put|patch|delete)\(\s*\$base\s*\.\s*'([^']+)'/g)) {
    routed.push(m[1].toUpperCase() + ' ' + m[2]);
}

// And the plainest form, in case an address is ever written out in one string.
for (const m of slice.matchAll(/->(get|post|put|patch|delete)\(\s*'\/api\/essentials\/v\d+([^']+)'/g)) {
    routed.push(m[1].toUpperCase() + ' ' + m[2]);
}

/* ---------------------------------------------------- what is documented -- */

const from2 = docs.indexOf('public static function endpoints');
const until = docs.indexOf('public static function abilities');
const slice2 = from2 === -1 ? '' : docs.slice(from2, until > from2 ? until : docs.length);

const documented = [];

for (const m of slice2.matchAll(/'method'\s*=>\s*'([A-Z]+)'\s*,\s*\n\s*'path'\s*=>\s*'([^']+)'/g)) {
    documented.push(m[1] + ' ' + m[2]);
}

if (from === -1) {
    problems.push('registerApiRoutes() is not in ' + PROVIDER + '.'
        + '\n    If it was renamed, this gate needs the new name - it must not be deleted.');
}

if (from2 === -1) {
    problems.push('Docs::endpoints() is not in ' + DOCS + '.'
        + '\n    If it was renamed, this gate needs the new name - it must not be deleted.');
}

for (const route of routed) {
    if (!documented.includes(route)) {
        problems.push(route + ' is registered and not documented.'
            + '\n    Add it to Docs::endpoints() - the page, the Markdown and the OpenAPI'
            + '\n    file are all rendered from there, so one entry does all three.');
    }
}

for (const entry of documented) {
    if (!routed.includes(entry)) {
        problems.push(entry + ' is documented and not registered.'
            + '\n    Somebody is writing a bot against an address that answers 404. Either'
            + '\n    register it in registerApiRoutes() or take it out of Docs::endpoints().');
    }
}

/* ------------------------------------------ what the controller can say --- */

/* Status codes: response()->json([...], NNN), and abort(NNN). */
const codes = new Set();

for (const m of controller.matchAll(/\]\s*,\s*(\d{3})\s*\)/g)) {
    codes.add(m[1]);
}

for (const m of controller.matchAll(/\babort\(\s*(\d{3})/g)) {
    codes.add(m[1]);
}

const explained = new Set();

for (const m of docs.matchAll(/'code'\s*=>\s*(\d{3})/g)) {
    explained.add(m[1]);
}

for (const code of codes) {
    if (!explained.has(code)) {
        problems.push('The API can answer ' + code + ', and Docs::errors() does not mention it.'
            + '\n    A bot branches on these. One that is not written down is one somebody'
            + '\n    meets for the first time in production.');
    }
}

for (const code of explained) {
    if (!codes.has(code)) {
        problems.push(code + ' is documented and the controller never answers it.'
            + '\n    Either it stopped being possible, in which case take it out, or it moved'
            + '\n    somewhere this cannot see, in which case this gate needs to know where.');
    }
}

/* The error strings themselves, which is what a bot actually matches on. */
for (const m of controller.matchAll(/'error'\s*=>\s*'([a-z_]+)'/g)) {
    if (!docs.includes("'" + m[1] + "'")) {
        problems.push('The API emits the error ' + m[1] + ' and the documentation never names it.'
            + '\n    Add it to the matching entry in Docs::errors(), with its body - prose about'
            + '\n    a status code is not something anybody can branch on.');
    }
}

/*
 * Abilities. A key can be narrowed to these, so each has to be explained where
 * the person deciding will read it - which is the notes, not the label on a
 * checkbox they have already ticked. Bold, because that is how the note names
 * them and it is what makes this checkable at all.
 */
const abilities = new Set();

for (const m of docs.matchAll(/'ability'\s*=>\s*'([a-z]+)'/g)) {
    abilities.add(m[1]);
}

for (const ability of abilities) {
    if (!docs.includes('**' + ability + '**')) {
        problems.push('A key can be narrowed to ' + ability + ', and the notes do not explain it.'
            + '\n    Somebody ticking that box needs to know what it lets through. Name it in'
            + '\n    bold in the note about what a key may ask about.');
    }
}

/* --------------------------------------------------------------- verdict -- */

if (problems.length > 0) {
    console.error('API documentation check: ' + problems.length + ' problem(s).\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error('The API and what it says about itself have to agree. Nothing was built.');
    process.exit(1);
}

console.log('API documentation check: ' + routed.length + ' endpoint(s), '
    + codes.size + ' status code(s) and ' + abilities.size + ' ability group(s), all documented.');
