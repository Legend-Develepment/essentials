/*
 * A page that draws the shared save bar has to say when it may be pressed.
 *
 * `resources/views/pages/theme-settings.blade.php` is rendered by seven page
 * classes and draws one save button wired to `save`. It used to decide for all
 * of them with a single condition - the broad `update legendTheme` grant - and
 * the seven guard their own saves seven different ways. Two faults came out of
 * that gap and neither was visible from either file on its own:
 *
 *  - A role granted only `look legendTheme` opened the Look page, got an
 *    editable form, and had no button to save it. The form is enabled by
 *    `Features::mayManage()`; the button was not.
 *  - The modpacks page drew the button for anybody holding the broad grant, and
 *    that class has no `save()` at all. It installs; there was nothing for the
 *    button to call.
 *
 * So the view asks `$this->maySave()` and every page answers for itself. This
 * refuses a page that renders the view without one, because the failure it
 * would cause is a Livewire error on somebody else's panel rather than anything
 * visible here.
 *
 * **And every other view that draws the same bar**, which is the half this was
 * missing. It watched one file, and three pages with a view of their own -
 * announcements, the login screen, the navigation links - kept drawing the bar
 * on the broad `update legendTheme` grant for four releases after the shared
 * one stopped. The fault was the one this file was written for and it sat one
 * directory away the whole time. So the rule is the bar, wherever it is drawn:
 * a view holding `fi-ld-save-bar` decides with something that names a feature,
 * never with the grant that covers everything.
 */

const fs = require('fs');
const path = require('path');

const root = path.resolve(__dirname, '..');

/** The view they share, as the pages name it. */
const VIEW = 'pages.theme-settings';

const SKIP = new Set(['.git', 'node_modules', 'no-git', 'dist', 'release', 'vendor']);

function walk(dir, out = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (SKIP.has(entry.name)) {
            continue;
        }

        const full = path.join(dir, entry.name);

        if (entry.isDirectory()) {
            walk(full, out);
            continue;
        }

        if (entry.name.endsWith('.php')) {
            out.push(full);
        }
    }

    return out;
}

const problems = [];
const drawing = [];

for (const file of walk(path.join(root, 'src'))) {
    const source = fs.readFileSync(file, 'utf8');

    if (!source.includes(VIEW)) {
        continue;
    }

    drawing.push(path.relative(root, file));

    /*
     * Declared on the class itself or inherited from one that is also in this
     * list. Only one level of inheritance is followed, which is all this
     * codebase uses and all it should: a save rule two parents away is a save
     * rule nobody reads.
     */
    if (/function\s+maySave\s*\(/.test(source)) {
        continue;
    }

    const parent = source.match(/class\s+\w+\s+extends\s+(\w+)/);
    const inherited = parent === null
        ? false
        : walk(path.join(root, 'src')).some((other) => {
            const text = fs.readFileSync(other, 'utf8');

            return new RegExp('class\\s+' + parent[1] + '\\b').test(text)
                && /function\s+maySave\s*\(/.test(text);
        });

    if (!inherited) {
        problems.push(
            `${path.relative(root, file)} renders ${VIEW} and has no maySave(), `
                + 'so the save bar would be drawn on a guess',
        );
    }
}

const blade = path.join(root, 'resources', 'views', 'pages', 'theme-settings.blade.php');

if (fs.existsSync(blade) && !fs.readFileSync(blade, 'utf8').includes('$this->maySave()')) {
    problems.push(
        'resources/views/pages/theme-settings.blade.php no longer asks the page: '
            + 'the save bar is being decided somewhere the pages cannot answer',
    );
}

/*
 * Every view that draws the bar, and what it decides with.
 *
 * Three answers are allowed and they are the three that name what is being
 * saved: the page's own maySave(), Features::mayManage() with a feature beside
 * it, or a mayEdit() belonging to the page. The one that is refused is
 * PERMISSION_UPDATE, because it is the grant that covers the whole plugin and
 * the pages behind these bars each guard their save with one feature.
 *
 * A view with no condition at all is left alone. Two of them are server pages
 * where the whole page is already behind the permission that owns it, and a
 * second test there would be a second place to keep in step.
 */
const views = path.join(root, 'resources', 'views', 'pages');
const bars = [];

for (const name of fs.existsSync(views) ? fs.readdirSync(views) : []) {
    if (!name.endsWith('.blade.php')) {
        continue;
    }

    const source = fs.readFileSync(path.join(views, name), 'utf8');

    if (!source.includes('fi-ld-save-bar')) {
        continue;
    }

    bars.push(name);

    // The condition is the @if directly above the bar, if there is one.
    const at = source.indexOf('fi-ld-save-bar');
    const before = source.slice(0, at);
    const guard = before.slice(before.lastIndexOf('@if'));

    if (!guard.startsWith('@if') || guard.length > 400) {
        continue;
    }

    if (/PERMISSION_UPDATE/.test(guard)) {
        problems.push(
            `resources/views/pages/${name} draws the save bar on PERMISSION_UPDATE, `
                + 'which is wider than the feature its page guards save() with',
        );
    }
}

if (problems.length > 0) {
    console.error(`Save check: ${problems.length} problem(s).\n`);
    problems.forEach((line) => console.error('  ' + line));
    process.exit(1);
}

console.log(
    `Save check: ${drawing.length} page(s) render ${VIEW} and ${bars.length} view(s) draw the bar, `
        + 'every one of them says when.',
);
