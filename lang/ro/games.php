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
    'save' => 'Salvează',
    'saved' => 'Salvat',
    'restart' => 'Jocul citește acest fișier la pornire, deci repornește serverul pentru ca schimbarea să aibă efect.',
    'failed' => 'Nu s-a putut salva',
    'failed_write' => 'Daemonul a refuzat scrierea. Verifică dacă serverul este accesibil și dacă fișierul nu este doar pentru citire.',
    'read_only' => 'Poți citi acest fișier dar nu îl poți scrie, deci nimic de aici nu poate fi schimbat.',
    'missing' => 'Acest server nu are încă fișier de setări. Jocul îl scrie la prima pornire, deci pornește serverul o dată și pagina se va umple.',
    'keeps' => 'Tot restul fișierului - comentariile, liniile goale, ordinea și fiecare cheie pe care acest plugin nu o cunoaște - rămâne exact cum era la salvare.',
    'raw' => 'Numele de aici sunt ale jocului, în ordinea fișierului. Nimic nu este tradus sau grupat, pentru că pagina citește fișierul, nu o listă scrisă de mână.',
    'unset' => 'Nesetat. Jocul îl menționează ca exemplu; completarea îl adaugă.',
    'group_all' => 'Setări',
    'group_all_helper' => 'Tot ce menționează acest fișier.',
    'subheading' => 'Construit din :files, nu dintr-o listă scrisă de mână.',
];
