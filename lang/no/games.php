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
    'save' => 'Lagre',
    'saved' => 'Lagret',
    'restart' => 'Spillet leser denne filen ved oppstart, så start serveren på nytt for at endringen skal tre i kraft.',
    'failed' => 'Kunne ikke lagre',
    'failed_write' => 'Daemonen avviste skrivingen. Sjekk at serveren er tilgjengelig og at filen ikke er skrivebeskyttet.',
    'read_only' => 'Du kan lese denne filen, men ikke skrive den, så ingenting her kan endres.',
    'missing' => 'Denne serveren har ennå ingen innstillingsfil. Spillet skriver den første gang det kjører, så start serveren en gang og siden fyller seg ut.',
    'keeps' => 'Alt annet i filen - kommentarene, de tomme linjene, rekkefølgen og hver nøkkel dette programtillegget ikke kjenner - står nøyaktig som det var når du lagrer.',
    'raw' => 'Navnene her er spillets egne, i filens rekkefølge. Ingenting oversettes eller grupperes, for siden leser filen fremfor en håndskrevet liste.',
    'unset' => 'Ikke satt. Spillet nevner den som eksempel; fyll den ut for å legge den til.',
    'group_all' => 'Innstillinger',
    'group_all_helper' => 'Alt denne filen nevner.',
    'subheading' => 'Bygget ut fra :files i stedet for en håndskrevet liste.',
];
