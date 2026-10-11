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
    'save' => 'Išsaugoti',
    'saved' => 'Išsaugota',
    'restart' => 'Žaidimas skaito šį failą paleidžiant, todėl perkraukite serverį, kad pakeitimas įsigaliotų.',
    'failed' => 'Nepavyko išsaugoti',
    'failed_write' => 'Demonas atmetė rašymą. Patikrinkite, ar serveris pasiekiamas ir ar failas nėra tik skaitymui.',
    'read_only' => 'Šį failą galite skaityti, bet ne rašyti, todėl čia nieko pakeisti negalima.',
    'missing' => 'Šis serveris dar neturi nustatymų failo. Žaidimas jį sukuria per pirmą paleidimą, tad paleiskite serverį kartą ir puslapis užsipildys.',
    'keeps' => 'Visa kita faile - komentarai, tuščios eilutės, tvarka ir kiekvienas raktas, kurio šis papildinys nežino - išsaugojus lieka lygiai taip pat.',
    'raw' => 'Pavadinimai čia yra paties žaidimo, failo tvarka. Niekas neverčiama ir negrupuojama, nes puslapis skaito failą, o ne ranka rašytą sąrašą.',
    'unset' => 'Nenustatyta. Žaidimas mini kaip pavyzdį; užpildžius bus pridėta.',
    'group_all' => 'Nustatymai',
    'group_all_helper' => 'Viskas, ką šis failas mini.',
    'subheading' => 'Sudaryta iš :files, o ne iš ranka rašyto sąrašo.',
];
