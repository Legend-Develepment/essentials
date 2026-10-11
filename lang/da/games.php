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
    'save' => 'Gem',
    'saved' => 'Gemt',
    'restart' => 'Spillet læser denne fil ved start, så genstart serveren for at ændringen træder i kraft.',
    'failed' => 'Kunne ikke gemme',
    'failed_write' => 'Daemonen afviste skrivningen. Tjek at serveren kan nås, og at filen ikke er skrivebeskyttet.',
    'read_only' => 'Du må læse denne fil, men ikke skrive den, så intet her kan ændres.',
    'missing' => 'Denne server har endnu ingen indstillingsfil. Spillet skriver den første gang det kører, så start serveren en gang, og siden fylder sig ud.',
    'keeps' => 'Alt andet i filen - kommentarerne, de tomme linjer, rækkefølgen og enhver nøgle dette plugin ikke kender - står præcis som det var, når du gemmer.',
    'raw' => 'Navnene her er spillets egne, i filens rækkefølge. Intet oversættes eller grupperes, for siden læser filen frem for en håndskrevet liste: den viser hver indstilling spillet forstår.',
    'unset' => 'Ikke sat. Spillet nævner den som eksempel; udfyld den for at tilføje den.',
    'group_all' => 'Indstillinger',
    'group_all_helper' => 'Alt hvad denne fil nævner.',
    'subheading' => 'Bygget ud fra :files i stedet for en håndskrevet liste.',
];
