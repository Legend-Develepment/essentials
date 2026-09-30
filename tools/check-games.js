/*
 * A game is wired into nine places, and nothing was checking that.
 *
 * Adding one means: a class under Support\Games, an entry in config, a read and
 * a write in Settings, a section in Fields\Eggs, a line in Theme::using(), a
 * mention in Modules::waitingFor(), a heading in lang/en/settings.php, and - if
 * the game has a settings page - that page registered in ThemePlugin with its
 * own lang file beside it.
 *
 * Nine places is nine chances to wire eight of them. None of the eight failures
 * is loud: the page renders, the class loads, the gates pass, and the one thing
 * that is missing only shows up when somebody uses it. A game left out of
 * Theme::using() keeps its cached egg list through a preview, so the preview
 * shows the wrong panel. A game left out of Modules::waitingFor() reports itself
 * as working while it has no eggs and therefore no page. A game with no heading
 * in settings.php shows `essentials::settings.groups.<name>` as a section title,
 * which shipped once and was found by somebody looking at a screenshot.
 *
 * So the list of games is read out of the source rather than kept here: a game
 * added tomorrow is checked tomorrow, whether or not anybody remembers this
 * file. The rule for what counts as one is the thing they all do - ask
 * configuration which eggs are this game:
 *
 *     $stored = Theme::config('<name>_eggs', '');
 *
 * Minecraft is deliberately not in this. It is its own feature with its own
 * pages and its own settings group, and the two only look alike from here.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const read = (file) => fs.readFileSync(path.join(root, file), 'utf8');
const exists = (file) => fs.existsSync(path.join(root, file));

/* ------------------------------------------------------- what a game is -- */

const games = [];

for (const file of fs.readdirSync(path.join(root, 'src/Support/Games'))) {
    if (!file.endsWith('.php')) { continue; }

    const source = read('src/Support/Games/' + file);
    const asked = source.match(/Theme::config\('([a-z_0-9]+)_eggs'/);

    if (asked === null) { continue; }

    games.push({
        cls: file.slice(0, -4),
        slug: asked[1],
        source,
        // The shared player query is a list of eggs and nothing else: no page,
        // no file, no reader. It is wired differently on purpose.
        shared: asked[1] === 'query',
    });
}

if (games.length === 0) {
    console.error('check-games: no game classes found under src/Support/Games.');
    console.error('Every one of them asks Theme::config for its egg list. If that has');
    console.error('changed shape, this gate needs the new shape rather than deleting.');
    process.exit(1);
}

/**
 * The nine settings classes Settings handed its bodies to, by path.
 *
 * Read from the directory rather than listed, so a tenth is watched from the
 * moment somebody puts it there.
 */
function savedFiles() {
    const dir = path.join(root, 'src/Support/Saved');

    if (!fs.existsSync(dir)) {
        return [];
    }

    return fs.readdirSync(dir)
        .filter((name) => name.endsWith('.php'))
        .map((name) => 'src/Support/Saved/' + name);
}

/* ------------------------------------------------- where they are wired -- */

const config = read('config/essentials.php');
/*
 * Settings, and the files its bodies moved into.
 *
 * A game's eggs used to be read and written in Settings.php; the public status
 * page's pair is in Support/Saved/Status.php now. This gate went red the day
 * that moved, which is the right way round - it said the wiring was gone
 * rather than pretending it was still there - and the fix is to look where the
 * wiring went instead of where it used to be.
 */
const settings = [
    read('src/Support/Settings.php'),
    ...savedFiles().map((file) => read(file)),
].join('\n');
const eggs = read('src/Support/Fields/Eggs.php');
const theme = read('src/Support/Theme.php');
const modules = read('src/Support/Modules.php');
const plugin = read('src/ThemePlugin.php');
const groups = read('lang/en/settings.php');

const faults = [];

const want = (game, ok, place, what) => {
    if (ok) { return; }

    faults.push({ game: game.cls, place, what });
};

for (const game of games) {
    const slug = game.slug;
    const SLUG = slug.toUpperCase();

    /*
     * The store. Without this the setting has no default, so Theme::config
     * answers null and the game is off on every panel that never saved the
     * settings page - which is every panel that installed and left it alone.
     */
    want(game, config.includes(`'${slug}_eggs' => env('LEGEND_THEME_${SLUG}_EGGS'`),
        'config/essentials.php', `'${slug}_eggs' => env('LEGEND_THEME_${SLUG}_EGGS', '')`);

    // The way out of the store and the way back in. One without the other is a
    // form that forgets what you ticked, or one that cannot be ticked at all.
    want(game, new RegExp(`'${slug}_eggs' => ${game.cls}::eggs\\(\\)`).test(settings),
        'src/Support/Settings.php or src/Support/Saved/', `'${slug}_eggs' => ${game.cls}::eggs()`);

    want(game, new RegExp(`'LEGEND_THEME_${SLUG}_EGGS' => ${game.cls}::sanitise\\(`).test(settings),
        'src/Support/Settings.php or src/Support/Saved/', `'LEGEND_THEME_${SLUG}_EGGS' => ${game.cls}::sanitise(...)`);

    /*
     * Letting go of what was decided against configuration. Theme::using()
     * swaps the configuration under a request to render a preview, and a game
     * that kept its memoised egg list through that shows the wrong answer for
     * the rest of the request.
     */
    want(game, theme.includes(`Games\\${game.cls}::forget();`),
        'src/Support/Theme.php', `${game.cls}::forget() in using()`);

    if (game.shared) { continue; }

    // The administrator's question: which eggs are this game.
    want(game, eggs.includes(`Part::section('${slug}'`),
        'src/Support/Fields/Eggs.php', `Part::section('${slug}', ...)`);

    want(game, eggs.includes(`CheckboxList::make('${slug}_eggs')`),
        'src/Support/Fields/Eggs.php', `CheckboxList::make('${slug}_eggs')`);

    /*
     * The heading over that section. A missing one does not fail: it renders
     * the key itself, `essentials::settings.groups.<name>`, as the title.
     */
    want(game, new RegExp(`'${slug}' => '`).test(groups),
        'lang/en/settings.php', `'${slug}' => '...' under groups`);

    /*
     * Whether the Games feature has anything to do yet. A game left out here
     * makes the modules page say the feature is working while this particular
     * game has no eggs, and therefore no page anywhere.
     */
    want(game, modules.includes(`self::listed('${slug}_eggs')`),
        'src/Support/Modules.php', `self::listed('${slug}_eggs') in waitingFor()`);
}

/* ------------------------------------------------- and the other way -- */

/*
 * The same question from the other end: a store entry with no class behind it.
 *
 * Everything above starts from the class, so a game that was half added - the
 * wiring written, the class never - is a game this gate cannot see and
 * therefore says nothing about. tools/make-game.js writes the wiring and leaves
 * the classes to be written by hand, which makes that the likely half rather
 * than an unlikely one.
 */
const known = new Set(games.map((game) => game.slug));

for (const m of config.matchAll(/'([a-z_0-9]+)_eggs' => env\('LEGEND_THEME_([A-Z_0-9]+)_EGGS'/g)) {
    const slug = m[1];

    // Minecraft is its own feature with its own pages, and only looks alike.
    if (slug === 'minecraft' || known.has(slug)) { continue; }

    faults.push({
        game: slug,
        place: 'src/Support/Games/',
        what: `a class asking Theme::config('${slug}_eggs', ''), which the store has and nothing reads`,
    });
}

/*
 * And the icon, which tools/make-game.js deliberately leaves unwritable.
 *
 * A default icon would be a wrong icon on every game rather than a missing one
 * on the game being added, so the generator writes a name that cannot resolve
 * and this is what says so.
 */
for (const m of eggs.matchAll(/Part::section\('([a-z_0-9]+)', '([^']*)'/g)) {
    if (/^tabler-[a-z0-9-]+$/.test(m[2])) { continue; }

    faults.push({
        game: m[1],
        place: 'src/Support/Fields/Eggs.php',
        what: `a real icon name instead of '${m[2]}', from vendor/secondnetwork/blade-tabler-icons`,
    });
}

/* ------------------------------------------------------------ the pages -- */

/*
 * A game with a settings page has more to get right, and the page is the half
 * a person actually sees. Found by the page rather than by the game, so a page
 * for a game that no longer exists is caught too.
 */
const pages = [];

for (const file of fs.readdirSync(path.join(root, 'src/Filament/Server/Pages'))) {
    if (!file.endsWith('Config.php') || file === 'GameConfig.php') { continue; }

    const source = read('src/Filament/Server/Pages/' + file);

    if (!/extends GameConfig\b/.test(source)) { continue; }

    const words = source.match(/function words\(\): string\s*\{\s*return '([a-z_0-9]+)';/);

    pages.push({ cls: file.slice(0, -4), words: words === null ? null : words[1], source });
}

for (const page of pages) {
    if (page.words === null) {
        faults.push({
            game: page.cls,
            place: 'src/Filament/Server/Pages/' + page.cls + '.php',
            what: 'a words() returning a literal, which is what names every string on the page',
        });

        continue;
    }

    /*
     * Registered, or it is a page that exists and cannot be reached. The class
     * needs its import as well as its place in the list: one without the other
     * does not boot.
     */
    want(page, plugin.includes(`use LegendDevelopment\\Theme\\Filament\\Server\\Pages\\${page.cls};`),
        'src/ThemePlugin.php', `use ...Pages\\${page.cls};`);

    want(page, new RegExp(`${page.cls}::class`).test(plugin),
        'src/ThemePlugin.php', `${page.cls}::class in $panel->pages([...])`);

    // The six strings the page asks for by name, in the language they are
    // written in. check-lang.js sees the rest of them across all 31 languages.
    const file = `lang/en/${page.words}.php`;

    if (!exists(file)) {
        faults.push({ game: page.cls, place: file, what: 'the page names it in words(), and it is not there' });

        continue;
    }

    const said = read(file);

    for (const key of ['section_helper', 'eggs', 'eggs_helper', 'nav_label', 'title']) {
        want(page, said.includes(`'${key}' =>`), file, `'${key}' => '...'`);
    }
}

/* ------------------------------------------------------------ the answer -- */

if (faults.length > 0) {
    console.error('Game check: ' + faults.length + ' thing(s) a game needs and does not have.\n');

    for (const fault of faults) {
        console.error('  ' + fault.game + ' - ' + fault.place);
        console.error('      wants ' + fault.what + '\n');
    }

    console.error('A game is wired into nine places and every one of them is quiet when it');
    console.error('is missing. Add what is listed, or if this game is meant to be wired');
    console.error('differently, say so here rather than leaving the gate wrong.');
    process.exit(1);
}

console.log(
    'Game check: ' + games.length + ' game(s) and ' + pages.length
    + ' settings page(s), every one wired everywhere it has to be.'
);
