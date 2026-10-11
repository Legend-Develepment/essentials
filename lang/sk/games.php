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
    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'restart' => 'Hra číta tento súbor pri štarte, takže reštartujte server, aby sa zmena prejavila.',
    'failed' => 'Uloženie zlyhalo',
    'failed_write' => 'Démon odmietol zápis. Skontrolujte, či je server dostupný a súbor nie je len na čítanie.',
    'read_only' => 'Tento súbor môžete čítať, ale nie zapisovať, takže sa tu nedá nič zmeniť.',
    'missing' => 'Tento server ešte nemá súbor s nastaveniami. Hra ho vytvorí pri prvom spustení, tak server raz spustite a stránka sa naplní.',
    'keeps' => 'Všetko ostatné v súbore - komentáre, prázdne riadky, poradie a každý kľúč, ktorý tento plugin nepozná - zostane po uložení presne rovnaké.',
    'raw' => 'Názvy tu sú názvy samotnej hry, v poradí súboru. Nič sa neprekladá ani nezoskupuje, lebo stránka číta súbor, nie ručne písaný zoznam.',
    'unset' => 'Nenastavené. Hra to uvádza ako príklad; vyplnenie to pridá.',
    'group_all' => 'Nastavenia',
    'group_all_helper' => 'Všetko, čo tento súbor uvádza.',
    'subheading' => 'Zostavené z :files, nie zo zoznamu, ktorý niekto spísal.',
];
