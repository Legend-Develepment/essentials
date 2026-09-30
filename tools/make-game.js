/*
 * The part of adding a game that has no thinking in it.
 *
 * A game costs two classes and then thirty-one language files and nine wiring
 * edits, and only the two classes are about the game. The rest is the same
 * every time: the same six strings with a different name in them, the same nine
 * places that each go quiet when they are missed. tools/check-games.js is what
 * catches a miss; this is what stops there being one.
 *
 * **It writes no PHP class**, on purpose. Every class in src/ says why it is
 * shaped the way it is, and a generator can only produce a paragraph that is
 * true of nothing in particular. So the classes are written by whoever adds the
 * game, and this does the thirty-one files and the nine edits.
 *
 *     node tools/make-game.js <slug> <Class> "<Name>"
 *
 * slug   what configuration and the language files call it: lowercase, no
 *        separators, because it is a translation key and Laravel reads a dot
 *        in one as nesting
 * Class  the class under Support\Games, which the wiring names
 * Name   what a person sees, with its capitals and apostrophes as they should
 *        be printed
 *
 * The six strings come from the game that already has them, with the name
 * changed. That is not laziness about translation: the sentence is about the
 * page rather than about the game, it is already correct in thirty-one
 * languages, and re-translating it per game would be thirty-one new chances to
 * say something slightly different about the same page.
 *
 * It refuses a game that is already there rather than writing over it.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const at = (file) => path.join(root, file);
const read = (file) => fs.readFileSync(at(file), 'utf8');
const write = (file, text) => fs.writeFileSync(at(file), text);

/* ------------------------------------------------------------ the asking -- */

const [slug, cls, name] = process.argv.slice(2);

const stop = (said) => { console.error(said); process.exit(1); };

if (!slug || !cls || !name) {
    stop('usage: node tools/make-game.js <slug> <Class> "<Name>"\n'
        + '  e.g. node tools/make-game.js craftopia Craftopia Craftopia');
}

if (!/^[a-z][a-z0-9]*$/.test(slug)) {
    stop('The slug is a translation key and Laravel reads a dot in one as nesting,\n'
        + 'so it has to be lowercase letters and digits with nothing between them.\n'
        + `Got "${slug}".`);
}

if (!/^[A-Z][A-Za-z0-9]*$/.test(cls)) {
    stop(`The class name has to be StudlyCase. Got "${cls}".`);
}

if (fs.existsSync(at(`lang/en/${slug}.php`))) {
    stop(`lang/en/${slug}.php is already there, so this game already exists.\n`
        + 'Nothing was written. Delete it first if you mean to start it over.');
}

const SLUG = slug.toUpperCase();

/* --------------------------------------------------- the six strings x31 -- */

/*
 * Taken from V Rising, which has them in every language and whose sentence is
 * about the page rather than about V Rising. Its name is replaced twice over:
 * once as it is written, for the comment at the top, and once with its
 * apostrophe escaped, for the single-quoted strings below it.
 */
const FROM = 'V Rising';
const quoted = name.replace(/'/g, "\\'");

// English is the one language here whose article depends on the next sound.
const article = /^[AEIOU]/i.test(name) ? 'an' : 'a';

const languages = fs.readdirSync(at('lang')).filter(
    (dir) => fs.statSync(at('lang/' + dir)).isDirectory() && fs.existsSync(at(`lang/${dir}/vrising.php`))
);

if (languages.length === 0) {
    stop('No lang/*/vrising.php to take the six strings from. If that game has been\n'
        + 'renamed or removed, this script needs a new one to copy.');
}

for (const lang of languages) {
    const source = read(`lang/${lang}/vrising.php`);
    const cut = source.indexOf('return [');

    if (cut === -1) {
        stop(`lang/${lang}/vrising.php is not shaped the way this expects.`);
    }

    let said = source.slice(0, cut).split(FROM).join(name)
        + source.slice(cut).split(FROM).join(quoted);

    if (lang === 'en' && article === 'an') {
        said = said.split(`a ${quoted} server`).join(`an ${quoted} server`);
    }

    write(`lang/${lang}/${slug}.php`, said);
}

/* ------------------------------------------------------------ the wiring -- */

/*
 * Every edit is anchored on a line that is already there and inserts beside it,
 * so a file that has been reshaped since fails loudly here rather than writing
 * something into the wrong place.
 */
const edits = new Map();
let wired = 0;

/*
 * Held as one text per file rather than one entry per edit. Four of the nine go
 * into Settings.php and two into ThemePlugin.php, and an edit that starts from
 * the file on disk rather than from the edit before it silently throws the
 * earlier one away - which is exactly what the first version of this did, and
 * what a dry run on a copy found.
 */
const put = (file, anchor, added, where) => {
    const text = edits.has(file) ? edits.get(file) : read(file);
    const found = text.split(anchor).length - 1;

    if (found !== 1) {
        stop(`Cannot wire ${file}: the line this anchors on appears ${found} time(s).\n`
            + `  anchor: ${anchor.trim()}\n`
            + 'The file has been reshaped since this script was written. Fix the anchor\n'
            + 'rather than guessing, and check what has already been written above.');
    }

    edits.set(file, text.replace(anchor, where === 'before' ? added + anchor : anchor + added));
    wired++;
};

// The store, so the setting has a default on a panel that never saved the page.
put('config/essentials.php',
    "    'valheim_eggs' => env('LEGEND_THEME_VALHEIM_EGGS', ''),",
    `    '${slug}_eggs' => env('LEGEND_THEME_${SLUG}_EGGS', ''),\n\n`,
    'before');

// The way out of the store, and the way back into it.
put('src/Support/Settings.php',
    "            'valheim_eggs' => Valheim::eggs(),",
    `            '${slug}_eggs' => ${cls}::eggs(),\n`,
    'before');

put('src/Support/Settings.php',
    "            'LEGEND_THEME_VALHEIM_EGGS' => Valheim::sanitise($data['valheim_eggs'] ?? []),",
    `            'LEGEND_THEME_${SLUG}_EGGS' => ${cls}::sanitise($data['${slug}_eggs'] ?? []),\n`,
    'before');

put('src/Support/Settings.php',
    'use LegendDevelopment\\Theme\\Support\\Games\\Valheim;',
    `use LegendDevelopment\\Theme\\Support\\Games\\${cls};\n`,
    'before');

// Letting go of what was decided against configuration, for previews.
put('src/Support/Theme.php',
    '        \\LegendDevelopment\\Theme\\Support\\Games\\Valheim::forget();',
    `        \\LegendDevelopment\\Theme\\Support\\Games\\${cls}::forget();\n`,
    'before');

// Whether the Games feature has anything to do yet.
put('src/Support/Modules.php',
    "self::listed('valheim_eggs')",
    `self::listed('${slug}_eggs') || `,
    'before');

// The page, which has to be imported as well as listed.
put('src/ThemePlugin.php',
    'use LegendDevelopment\\Theme\\Filament\\Server\\Pages\\ValheimLists;',
    `use LegendDevelopment\\Theme\\Filament\\Server\\Pages\\${cls}Config;\n`,
    'before');

put('src/ThemePlugin.php',
    '                ValheimLists::class,',
    `                ${cls}Config::class,\n`,
    'before');

for (const [file, text] of edits) {
    write(file, text);
}

/*
 * The administrator's question, which needs an icon and therefore a decision.
 * Left to be written by hand rather than given a default: an icon that is
 * wrong on every game is worse than an icon that is missing on one, and
 * check-games.js says so straight away.
 */
const section =
`            Part::section('${slug}', 'tabler-CHOOSE-AN-ICON', [
                CheckboxList::make('${slug}_eggs')
                    ->label(fn () => Theme::trans('${slug}.eggs'))
                    ->helperText(fn () => Theme::trans('${slug}.eggs_helper'))
                    ->options(fn (): array => Games::eggOptions())
                    ->bulkToggleable()
                    ->searchable()
                    ->columns(['default' => 1, 'sm' => 2])
                    ->columnSpanFull(),
            ])
                ->description(fn () => Theme::trans('${slug}.section_helper')),
`;

{
    const file = 'src/Support/Fields/Eggs.php';
    const anchor = "            Part::section('valheim',";
    const text = read(file);

    if (text.split(anchor).length - 1 !== 1) {
        stop(`Cannot wire ${file}: its Valheim section is not where this expects it.`);
    }

    write(file, text.replace(anchor, section + anchor));
}

/* ------------------------------------------- the heading, in every language -- */

/*
 * A proper noun, so it is the same in all thirty-one. A missing one does not
 * fail: it renders the key itself as the section title, which is how one of
 * these was found - on a screenshot.
 */
let headings = 0;

for (const lang of fs.readdirSync(at('lang'))) {
    const file = `lang/${lang}/settings.php`;

    if (!fs.existsSync(at(file))) { continue; }

    const text = read(file);
    const anchor = "        'valheim' => ";

    if (text.split(anchor).length - 1 !== 1) {
        stop(`Cannot wire ${file}: its Valheim heading is not where this expects it.`);
    }

    write(file, text.replace(anchor, `        '${slug}' => '${quoted}',\n` + anchor));
    headings++;
}

/* ------------------------------------------------------------- the answer -- */

console.log(`${name}: ${languages.length} language file(s), ${headings} heading(s), ${wired + 1} wiring edit(s).

Still to write by hand, because they are the part that is about this game:

  src/Support/Games/${cls}.php
      PATH or PATHS, and a docblock saying what the file is and why the
      reader can be believed about it. Copy the shape from Enshrouded
      (one file) or Satisfactory (more than one).

  src/Filament/Server/Pages/${cls}Config.php
      Four answers and a name. Copy the shape from EnshroudedConfig.

  src/Support/Fields/Eggs.php
      the icon, which is written 'tabler-CHOOSE-AN-ICON' and has to be
      a real name from vendor/secondnetwork/blade-tabler-icons.

Then: node tools/check-games.js`);
