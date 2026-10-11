/*
 * Support\Games\Words, ported.
 *
 * A settings page drawn from a file has no list of labels to read from, so the
 * label is worked out from the key. That is the whole reason a game costs a
 * reader and a heading instead of six hundred and forty strings, and it is also
 * the part of it that can quietly get worse: a rule added for one game changes
 * every label on every other page, and nothing on screen says which rule turned
 * `mAutoPause` into what it now reads as.
 *
 * So the rules are written down here as what they produce. Two of them were
 * already added after the fact - PvP, which the capital splitter cut in half,
 * and Unreal's m prefix, which Satisfactory's Game.ini is almost entirely made
 * of - and both are the kind of thing that is only ever noticed by looking at a
 * real page.
 */
let pass = 0;
let fail = 0;

const check = (label, got, want) => {
    if (got === want) { pass++; return; }
    fail++;
    console.error('  FAIL  ' + label + '\n        got  ' + JSON.stringify(got) + '\n        want ' + JSON.stringify(want));
};

/* -------------------------------------------------------------- the port -- */

const MENDED = { 'Pv P': 'PvP', 'Pv E': 'PvE' };

function of(key) {
    const short = key.includes('.') ? key.slice(key.lastIndexOf('.') + 1) : key;

    const name = /^[bm][A-Z]/.test(short) ? short.slice(1) : short;

    let spaced = name.replace(/[_-]/g, ' ')
        .replace(/([a-z0-9])([A-Z])/g, '$1 $2')
        .replace(/([A-Z]+)([A-Z][a-z])/g, '$1 $2');

    for (const [from, to] of Object.entries(MENDED)) {
        spaced = spaced.split(from).join(to);
    }

    spaced = spaced.replace(/\s+/g, ' ').trim();

    if (spaced === '') { return key; }

    return spaced.charAt(0).toUpperCase() + spaced.slice(1);
}

console.log('Words\n');

/* ------------------------------------------------------- nothing to do --- */

/*
 * One lowercase run cannot be split without a dictionary, so it is not guessed
 * at. The page prints the raw key beside the label only where the two differ,
 * which is what keeps a key like this from reading twice.
 */
check('one lowercase word is only capitalised', of('maxplayers'), 'Maxplayers');
check('a word already capitalised is left alone', of('Port'), 'Port');
check('an empty key comes back as itself', of(''), '');

/* ------------------------------------------------------- the separators -- */

check('an underscore is a space', of('max_players'), 'Max players');
check('a hyphen is too', of('autosave-interval'), 'Autosave interval');
check('and several in a row are one', of('a__b'), 'A b');
check('a trailing separator leaves no gap', of('name_'), 'Name');

/* ----------------------------------------------------------- the capitals -- */

check('a capital after a lowercase starts a word', of('ServerPassword'), 'Server Password');
check('a capital after a digit does too', of('Slot2Name'), 'Slot2 Name');

/*
 * The rule that is not the obvious one. Splitting before every capital turns
 * XPMultiplier into "X P Multiplier": a run of capitals is one word, and the
 * split belongs before its last letter rather than before each of them.
 */
check('a run of capitals is one word', of('XPMultiplier'), 'XP Multiplier');
check('and so is a longer one', of('RCONServerGameLogBuffer'), 'RCON Server Game Log Buffer');
check('a run with nothing after it stays whole', of('MaxHP'), 'Max HP');
check('all capitals stay all capitals', of('MOTD'), 'MOTD');

/* --------------------------------------------------------- Unreal itself -- */

/*
 * Two prefixes that are Unreal's convention rather than part of the name: b
 * marks a boolean and m marks a member variable. A Satisfactory Game.ini is
 * almost entirely the second, which is what added it.
 */
check('a boolean loses its b', of('bIsPvP'), 'Is PvP');
check('a member loses its m', of('mAutoPause'), 'Auto Pause');
check('and keeps the rest of itself', of('mAutoSaveInterval'), 'Auto Save Interval');

/*
 * Only before a capital. A key that begins with one of those letters as an
 * ordinary word keeps every letter it was written with.
 */
check('a word starting with b keeps it', of('banlist'), 'Banlist');
check('a word starting with m keeps it', of('mods'), 'Mods');
check('and so does one that is capitalised', of('Bandwidth'), 'Bandwidth');
check('b before a digit is not a prefix', of('b2Player'), 'B2 Player');

/* ------------------------------------------------------------ the mending -- */

/*
 * The capital splitter cuts PvP in half, because P after v is exactly the shape
 * of a new word. Repaired after the split rather than protected before it: any
 * placeholder that survives a rule about capital letters is a placeholder that
 * can collide with a real setting.
 */
check('PvP survives the splitter', of('PvPEnabled'), 'PvP Enabled');
check('and PvE does', of('PvEStructureDecay'), 'PvE Structure Decay');
check('even on its own', of('pvp'), 'Pvp');
check('and after a b', of('bPvPEnabled'), 'PvP Enabled');

/* ---------------------------------------------------------- the sections -- */

/*
 * A sectioned INI puts the heading in the key and a nested JSON puts the parent
 * in it. Either way the field only needs the last step: the section is already
 * the heading over it, and the raw key is printed beside the label anyway.
 */
check('a section is dropped', of('ServerSettings.ServerPassword'), 'Server Password');
check('a nested json key keeps only its leaf', of('visibility.public'), 'Public');
check('however deep it goes', of('a.b.c.maxPlayers'), 'Max Players');
check('an Unreal section is dropped whole', of('/Script/Engine.GameSession.MaxPlayers'), 'Max Players');

/*
 * A key that is all section and no leaf has nothing to show, so it comes back
 * as itself rather than as an empty label.
 */
check('a key ending in a dot comes back whole', of('Section.'), 'Section.');

/* ------------------------------------------------------ what is not done -- */

/*
 * Not lowercased, which is the other half of the same decision. XP, PvP, HP and
 * RCON are capitals somebody typed on purpose, and "Xp multiplier" reads as a
 * mistake rather than as a label.
 */
check('an existing capital in the middle is kept', of('serverXP'), 'Server XP');
check('a lowercase first letter is raised', of('serverName'), 'Server Name');

console.log('\nWords: ' + pass + ' passed, ' + fail + ' failed');
process.exit(fail ? 1 : 0);
