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
    'save' => 'Uložit',
    'saved' => 'Uloženo',
    'restart' => 'Hra čte tento soubor při startu, takže restartujte server, aby se změna projevila.',
    'failed' => 'Uložení se nezdařilo',
    'failed_write' => 'Démon odmítl zápis. Zkontrolujte, zda je server dostupný a soubor není jen pro čtení.',
    'read_only' => 'Tento soubor můžete číst, ale ne zapisovat, takže zde nelze nic změnit.',
    'missing' => 'Tento server zatím nemá soubor s nastavením. Hra jej vytvoří při prvním spuštění, takže server jednou spusťte a stránka se naplní.',
    'keeps' => 'Vše ostatní v souboru - komentáře, prázdné řádky, pořadí a každý klíč, který tento plugin nezná - zůstane při uložení přesně tak, jak bylo.',
    'raw' => 'Názvy zde jsou názvy hry, v pořadí souboru. Nic se nepřekládá ani neseskupuje, protože stránka čte soubor místo ručně psaného seznamu: ukáže každé nastavení, kterému hra rozumí.',
    'unset' => 'Nenastaveno. Hra jej uvádí jako příklad; vyplnění jej přidá.',
    'group_all' => 'Nastavení',
    'group_all_helper' => 'Vše, co tento soubor uvádí.',
    'subheading' => 'Sestaveno z :files, ne ze seznamu, který někdo sepsal.',
];
