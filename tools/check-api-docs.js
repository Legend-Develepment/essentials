/*
 * Every endpoint the API registers is documented, and every documented one
 * exists.
 *
 * Documentation kept beside the code it describes drifts from it the first time
 * somebody is in a hurry. This plugin now renders three things from one array
 * in Support\Api\Docs - the page in the panel, a Markdown file and an OpenAPI
 * file - which removes the risk of those three disagreeing with each other and
 * does nothing at all about the risk that matters: all three disagreeing with
 * the routes.
 *
 * So this reads the routes registered in ThemeServiceProvider and the paths in
 * Docs::endpoints(), and fails the build when either has something the other
 * does not. A new endpoint cannot ship undocumented, and a documented one
 * cannot quietly stop existing - which is the failure that would be worst,
 * because somebody would be writing a bot against a page that describes an
 * address answering 404.
 *
 * It reads the source rather than booting Laravel, like every other gate here:
 * there is no PHP on the machine this is built on.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

const PROVIDER = 'src/Providers/ThemeServiceProvider.php';
const DOCS = 'src/Support/Api/Docs.php';

/* ------------------------------------------------------- what is routed --- */

const provider = read(PROVIDER);

/*
 * Only inside registerApiRoutes(). The provider registers the arranger's
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

const docs = read(DOCS);

const from2 = docs.indexOf('public static function endpoints');
const slice2 = from2 === -1 ? '' : docs.slice(from2, docs.indexOf('public static function base'));

const documented = [];

for (const m of slice2.matchAll(/'method'\s*=>\s*'([A-Z]+)'\s*,\s*\n\s*'path'\s*=>\s*'([^']+)'/g)) {
    documented.push(m[1] + ' ' + m[2]);
}

/* ------------------------------------------------------------- compare ---- */

const problems = [];

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

/* --------------------------------------------------------------- verdict -- */

if (problems.length > 0) {
    console.error('API documentation check: ' + problems.length + ' problem(s).\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error('The API and what it says about itself have to agree. Nothing was built.');
    process.exit(1);
}

console.log('API documentation check: ' + routed.length + ' endpoint(s), every one documented.');
