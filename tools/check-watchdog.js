/*
 * Nothing the watchdog reads may be scoped to whoever is looking.
 *
 * The watchdog is a queued job. There is no signed-in user in one, so
 * `user()` answers null - and a support method that scopes its query through
 * `user()?->accessibleServers()` does not fail there, it succeeds with an empty
 * list. Every check built on it then reports that there is nothing wrong,
 * for ever.
 *
 * That is exactly what happened to the backup alerts. They could be switched
 * on, given a threshold and a Discord address, and they never sent anything:
 * Backups::behind() went through the same query the admin page uses, the page
 * was right because a page has a reader, and the cron was empty because a cron
 * has none. Nothing logged and nothing threw. The only symptom was silence from
 * the one feature whose whole job is to break silence.
 *
 * So: for every Support class the watchdog calls, the method it calls must not
 * mention user(). A method that needs to know who is asking has no business
 * being asked by something nobody is running.
 *
 * **And it follows self:: calls, because the fault was two levels deep.** The
 * first draft of this gate checked only the method named in the watchdog, and
 * passed cleanly against the exact code that had shipped the bug: the watchdog
 * calls behind(), behind() calls query(), and query() is the one that asks
 * user(). A gate that proves nothing is worse than no gate, because it is
 * mistaken for a guarantee.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

const WATCHDOG = 'src/Support/Alerts/Watchdog.php';

/* ------------------------------------------------------- who it asks what -- */

const watchdog = read(WATCHDOG);

/*
 * Which class each short name is. Read from the imports rather than guessed, so
 * a class that moves is followed rather than silently skipped.
 */
const classes = {};

for (const m of watchdog.matchAll(/^use ([A-Za-z0-9_\\]+);/gm)) {
    const full = m[1];
    const short = full.split('\\').pop();

    // Only this plugin's own support classes: Pelican's models and Laravel's
    // facades are not where this fault lives, and following them would need a
    // vendor directory this codebase does not have.
    if (full.startsWith('LegendDevelopment\\Theme\\Support\\')) {
        classes[short] = 'src/' + full.replace('LegendDevelopment\\Theme\\', '').split('\\').join('/') + '.php';
    }
}

/* Every static call it makes into one of them. */
const calls = new Map();

for (const m of watchdog.matchAll(/\b([A-Z][A-Za-z0-9_]*)::([a-zA-Z_][A-Za-z0-9_]*)\s*\(/g)) {
    const [, short, method] = m;

    if (!(short in classes)) { continue; }

    // Constants read as Class::NAME( only when followed by a bracket, which a
    // constant never is - but skip the obvious ones anyway.
    if (method === method.toUpperCase()) { continue; }

    if (!calls.has(short)) { calls.set(short, new Set()); }

    calls.get(short).add(method);
}

/* ------------------------------------------------------ what each one does -- */

/**
 * One method's body, by matching braces from its signature.
 */
function body(source, method) {
    const at = source.search(new RegExp('function\\s+' + method + '\\s*\\('));

    if (at === -1) { return null; }

    const open = source.indexOf('{', at);

    if (open === -1) { return null; }

    let depth = 0;

    for (let i = open; i < source.length; i++) {
        if (source[i] === '{') { depth++; }
        if (source[i] === '}') { depth--; }

        if (depth === 0) { return source.slice(open, i + 1); }
    }

    return null;
}

/**
 * Whether a method reaches user(), directly or through the ones it calls.
 *
 * Within its own class only. Following across classes would need the imports of
 * every file it lands in, and the fault this exists for lives in one - a page's
 * query and a job's, side by side, one of them scoped. The visited set is what
 * stops two methods that call each other from going round for ever.
 *
 * Returns the name of the method that actually asks, so the message can say
 * where rather than only that.
 */
function scoped(source, method, seen) {
    if (seen.has(method)) { return null; }

    seen.add(method);

    const found = body(source, method);

    if (found === null) { return null; }

    if (/\buser\s*\(\s*\)/.test(found)) { return method; }

    for (const m of found.matchAll(/\bself::([a-zA-Z_][A-Za-z0-9_]*)\s*\(/g)) {
        const deeper = scoped(source, m[1], seen);

        if (deeper !== null) { return deeper; }
    }

    return null;
}

const problems = [];
let checked = 0;

for (const [short, methods] of calls) {
    const file = classes[short];

    if (!fs.existsSync(path.join(root, file))) {
        problems.push(WATCHDOG + ' calls ' + short + '::, and ' + file + ' is not there.'
            + '\n    This gate follows the imports, so a class that moved needs its import updating.');

        continue;
    }

    const source = read(file);

    for (const method of methods) {
        const found = body(source, method);

        if (found === null) {
            // An inherited or magic method. Not something to fail on.
            continue;
        }

        checked++;

        const via = scoped(source, method, new Set());

        if (via !== null) {
            problems.push(short + '::' + method + '() reaches whoever is looking, and the watchdog calls it.'
                + '\n    ' + file
                + (via === method ? '' : '\n    through ' + via + '()')
                + '\n    In a queued job user() is null, so this answers with an empty list rather'
                + '\n    than failing - and every check built on it reports that all is well, for ever.'
                + '\n    Give it a panel-wide pass and let the page add the viewer, the way'
                + '\n    Backups::all() and Backups::query() do.');
        }
    }
}

/* --------------------------------------------------------------- verdict -- */

if (problems.length > 0) {
    console.error('Watchdog check: ' + problems.length + ' problem(s).\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error('A check that silently has nothing to check is worse than no check:');
    console.error('it is switched on, configured, and reporting that nothing is wrong.');
    process.exit(1);
}

console.log('Watchdog check: ' + checked + ' method(s) it calls, none scoped to a reader.');
