/*
 * A queued job starts by forgetting what the process remembers.
 *
 * Almost everything in this plugin memoises in a class-level static, which
 * under php-fpm is a per-request memo that manages itself: the static is born
 * and dies with the request. The queue worker is not that. It is one PHP
 * process running job after job for hours, and every static filled on the first
 * job is still filled on the five hundredth.
 *
 * It has cost real things twice. Alerts\State kept a Reset button from working
 * until it grew refresh(). And a credit balance read while the first renewal
 * invoice of the night was written is the balance every later invoice in that
 * pass gets settled against, whoever moved money in between - which is money,
 * quietly wrong, in a process nobody is watching.
 *
 * So the rule is uniform rather than clever: every job calls Held::forget()
 * before it does anything. Deciding per job which ones need it means knowing
 * every memo three calls down, and that answer changes every time somebody adds
 * one.
 *
 * This checks the shape only - that the call is there and that it is first. It
 * cannot check that Held::forget() drops the right things, which is why that
 * class carries the list and the reasons.
 */
const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');
const jobs = path.join(root, 'src', 'Jobs');

if (!fs.existsSync(jobs)) {
    console.log('Job check: no jobs to check.');
    process.exit(0);
}

const problems = [];
let checked = 0;

for (const name of fs.readdirSync(jobs).sort()) {
    if (!name.endsWith('.php')) {
        continue;
    }

    const file = path.join(jobs, name);
    const source = fs.readFileSync(file, 'utf8');
    const where = path.relative(root, file);

    const at = source.indexOf('public function handle(');

    if (at === -1) {
        problems.push(`${where} has no handle() - a job that does nothing, or a name that moved?`);

        continue;
    }

    checked += 1;

    const open = source.indexOf('{', at);

    if (open === -1) {
        problems.push(`${where} has a handle() this cannot read.`);

        continue;
    }

    /*
     * The first thing it does, ignoring blank lines and comments. A comment
     * above the call is welcome; anything that runs before it is not, because
     * it runs against whatever the last job left behind.
     */
    const body = source.slice(open + 1);
    const lines = body.split('\n');
    let first = null;

    for (const line of lines) {
        const trimmed = line.trim();

        if (trimmed === '' || trimmed.startsWith('//') || trimmed.startsWith('/*') || trimmed.startsWith('*')) {
            continue;
        }

        first = trimmed;

        break;
    }

    if (first !== 'Held::forget();') {
        problems.push(
            `${where} starts handle() with ${first === null ? 'nothing this can read' : first}` +
                '\n      It has to start with Held::forget(), so the job does not inherit what the last one left.',
        );
    }
}

if (problems.length > 0) {
    console.error(`Job check: ${problems.length} job(s) that would inherit the last one's memory.\n`);

    for (const line of problems) {
        console.error('  ' + line);
    }

    console.error('\nSee src/Support/Held.php for what is dropped and why.');
    process.exit(1);
}

console.log(`Job check: ${checked} job(s), every one starts by forgetting what the process held.`);
