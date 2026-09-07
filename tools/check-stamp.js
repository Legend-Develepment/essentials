/*
 * Everything the cached stylesheet reads has a writer that bumps the stamp.
 *
 * The panel's settings block is built once and kept until Support\Stamp moves.
 * That is the whole optimisation and it is also the whole risk: a writer that
 * changes what the block would say and does not move the stamp is a panel
 * drawing yesterday's settings, and saying nothing about it.
 *
 * This is not a hypothetical failure. The icon stylesheet was keyed on the
 * overrides alone, so installing a pack left the panel drawing the old icons
 * for a day - a fault nobody could see from the settings page, because the
 * settings page was right and the panel was not.
 *
 * So: for each class whose css() lands inside the cached block, if it writes to
 * storage, that write has to sit near a bump. Near rather than exactly beside,
 * because the writers guard their writes differently - some return false, some
 * throw - and pinning the line would be a gate that fails on tidying.
 *
 * Deliberately not checked here:
 *
 *   - Layouts. Its CSS is not in the settings block, precisely because it
 *     belongs to one reader on one page. It has a cache and a stamp of its own,
 *     so it must bump THAT and must not bump this one - doing so would throw
 *     away the panel's whole stylesheet cache every time anybody dragged a
 *     block, for a change only they can see.
 *   - CustomCss. Emitted by its own render hook, outside the cached block.
 *   - UserTheme and Windows. What they write changes which preset a block is
 *     built from, and the preset is part of the key already.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');

/*
 * Who has to bump, and why. Written down rather than derived: deriving it means
 * parsing settingsCss()'s call graph, and a gate whose own logic can be wrong in
 * the same way as the code is not a gate.
 */
const MUST_BUMP = {
    'src/Support/Notice.php': 'Notice::css() is inside the block',
    'src/Support/NavLinks.php': 'NavLinks::css() is inside the block',
    'src/Support/IconPacks.php': 'Icons::css() is inside the block and has a cache of its own',
    'src/Support/Presets.php': 'the window and personal blocks are built from a preset',
    'src/Support/Settings.php': 'persist() and persistLogin() write what the block reads',
};

/* And who must not, because their bump would cost the whole panel's cache. */
const MUST_NOT_BUMP = {
    'src/Support/Layouts.php': 'the arrangement has a cache and a stamp of its own',
};

/* Who bumps the arrangement stamp instead. */
const MUST_BUMP_ARRANGEMENT = {
    'src/Support/Layouts.php': 'its CSS is cached per reader and per page',
};

const problems = [];

/* ------------------------------------------------- the stamp itself first -- */

const stamp = read('src/Support/Stamp.php');

for (const needed of ['function current()', 'function bump()', 'function key(']) {
    if (!stamp.includes(needed)) {
        problems.push('src/Support/Stamp.php has no ' + needed
            + '\n    This gate checks callers against it, so it has to be there.');
    }
}

// With no file the value has to keep moving, or an unwritable storage directory
// is a panel frozen at whatever it looked like when the cache was filled.
if (!stamp.includes("'h' . floor(time() / 3600)")) {
    problems.push('Support\\Stamp has no hourly fallback.\n'
        + '    Without one, a storage directory the web user cannot write is a panel\n'
        + '    that never picks up a change again rather than one an hour behind.');
}

/*
 * And every persister in Settings.php answers for itself.
 *
 * The check below asks whether a FILE bumps somewhere. Settings.php has seven
 * persist methods and two bumps, so it passed while persistApi() - which writes
 * the setting that hides Pelican's own API keys tab, and that rule is inside the
 * cached block - did not bump at all. The toggle wrote .env, the settings page
 * read back what was saved, and the panel kept serving the stylesheet it
 * already had: right on the page, wrong in the browser, and silent about it.
 *
 * Which is the icon stylesheet fault again, one release after the gate meant to
 * end it. A file-level answer was the wrong question.
 *
 * So each persister either bumps or is named below with a reason. A new one
 * fails this until somebody decides which it is - the same shape as
 * check-export.js, and for the same reason: deciding is cheap and being
 * silently wrong is not.
 */
const NEED_NO_BUMP = {
    persistSystemStatus: 'the system status page builds its own block',
    persistStatus: 'the public status page builds its own',
    persistAlerts: 'the watchdog draws nothing',
    persistArtwork: 'egg artwork writes to eggs, not to the stylesheet',
};

const settingsSource = read('src/Support/Settings.php');

for (const m of settingsSource.matchAll(/public static function (persist[A-Za-z]*)\s*\(/g)) {
    const name = m[1];

    if (name in NEED_NO_BUMP) {
        continue;
    }

    // The body, to the next function of any visibility - the same slice
    // check-export.js takes, and for the same reason.
    const at = m.index;
    const next = settingsSource.slice(at + 40).search(/\n\s*(?:public|protected|private)\s+(?:static\s+)?function\b/);
    const body = next < 0 ? settingsSource.slice(at) : settingsSource.slice(at, at + 40 + next);

    if (!body.includes('Stamp::bump()')) {
        problems.push('Settings::' + name + '() does not bump the stamp.'
            + '\n    The settings block is built once and kept until the stamp moves, so a'
            + '\n    write that changes what the block would say and leaves the stamp alone'
            + '\n    is a panel drawing yesterday. Add Stamp::bump(), or name ' + name
            + ' in NEED_NO_BUMP with the reason it draws nothing.');
    }
}

/* ------------------------------------------------------------ the writers -- */

for (const [file, why] of Object.entries(MUST_BUMP)) {
    const source = read(file);

    if (!source.includes('Stamp::bump()')) {
        problems.push(file + ' writes what the cached stylesheet reads and never bumps the stamp.'
            + '\n    ' + why
            + '\n    Add Stamp::bump() where the write succeeds.');
    }
}

for (const [file, why] of Object.entries(MUST_BUMP_ARRANGEMENT)) {
    if (!read(file).includes('Stamp::bumpArrangement()')) {
        problems.push(file + ' never bumps the arrangement stamp.'
            + '\n    ' + why
            + '\n    Without it a dragged block is a page that keeps drawing the old order'
            + '\n    until the cache ages out, which is a day.');
    }
}

for (const [file, why] of Object.entries(MUST_NOT_BUMP)) {
    /*
     * The exact call, not the prefix. Stamp::bumpArrangement() contains the
     * letters of Stamp::bump and is the right thing to be doing here - a check
     * on the substring would fail the correct code and pass nothing useful.
     */
    if (/Stamp::bump\s*\(\s*\)/.test(read(file))) {
        problems.push(file + ' bumps the stamp and must not.'
            + '\n    ' + why
            + '\n    Bumping here throws away the panel\'s whole cache whenever anybody'
            + '\n    moves a block on a page, for a change only they can see.');
    }
}

/* --------------------------------------------- and the split it depends on -- */

const provider = read('src/Providers/ThemeServiceProvider.php');

/*
 * The arrangement has to be outside the cached build. If it drifts back into
 * settingsCss() the cache becomes one person's arrangement served to everybody,
 * which is a fault nobody would report because everyone would see a page that
 * looks arranged.
 */
const build = provider.slice(
    provider.indexOf('private function settingsCss(): string'),
    provider.indexOf('The rules only, with no <style> around them'),
);

if (build.includes('Layouts::css(')) {
    problems.push('src/Providers/ThemeServiceProvider.php builds the arrangement inside settingsCss().'
        + '\n    That method is cached and shared between readers, so this would draw one'
        + "\n    person's arrangement for everybody. It belongs in settings(), after the"
        + '\n    blocks, where it is built live.');
}

if (!provider.includes('Stamp::key(')) {
    problems.push('src/Providers/ThemeServiceProvider.php does not key its cache on the stamp.'
        + '\n    Nothing then invalidates the settings block when a setting is saved.');
}

/*
 * And the arrangement on its own stamp, with the reader in the key. Keying it
 * on anything shared is the fault this whole split exists to avoid: one
 * person's arrangement drawn for everybody, which nobody reports because
 * everybody sees a page that looks arranged.
 */
if (!provider.includes('Stamp::arrangementKey(')) {
    problems.push('src/Providers/ThemeServiceProvider.php does not key the arrangement on its own stamp.'
        + '\n    A shared key here serves one reader\'s arrangement to the whole panel.');
}

/* --------------------------------------------------------------- verdict -- */

if (problems.length > 0) {
    console.error('Stamp check: ' + problems.length + ' problem(s).\n');

    for (const problem of problems) {
        console.error('  ' + problem + '\n');
    }

    console.error('A cache nothing invalidates is a panel that is right in the settings');
    console.error('and wrong on the screen, which is the hardest kind of wrong to report.');
    process.exit(1);
}

console.log('Stamp check: ' + Object.keys(MUST_BUMP).length
    + ' writers bump it, the arrangement stays out of the cache.');
