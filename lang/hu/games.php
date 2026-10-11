<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Mentés',
    'saved' => 'Mentve',
    'restart' => 'A játék indításkor olvassa ezt a fájlt, ezért indítsd újra a szervert, hogy a változás érvénybe lépjen.',
    'failed' => 'A mentés nem sikerült',
    'failed_write' => 'A daemon elutasította az írást. Ellenőrizd, hogy a szerver elérhető és a fájl nem csak olvasható.',
    'read_only' => 'Ezt a fájlt olvashatod, de nem írhatod, így itt semmi nem módosítható.',
    'missing' => 'Ennek a szervernek még nincs beállításfájlja. A játék az első futáskor írja meg, indítsd el egyszer és az oldal feltöltődik.',
    'keeps' => 'A fájl minden más része - a megjegyzések, az üres sorok, a sorrend és minden kulcs, amit ez a bővítmény nem ismer - mentéskor pontosan úgy marad.',
    'raw' => 'Az itteni nevek a játék saját nevei, a fájl sorrendjében. Semmi nincs lefordítva vagy csoportosítva, mert ez az oldal a fájlt olvassa, nem egy kézzel írt listát.',
    'unset' => 'Nincs beállítva. A játék példaként említi; kitöltve hozzáadódik.',
    'group_all' => 'Beállítások',
    'group_all_helper' => 'Minden, amit ez a fájl említ.',
    'subheading' => ':files alapján készül, nem egy kézzel írt lista alapján.',
];
