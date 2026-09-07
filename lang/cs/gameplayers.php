<?php

/*
 * Čeština. Psáno ručně.
 *
 * Kdo je na serveru, pro hry, které odpovídají na dotaz Valve.
 *
 * Jedna stránka pro Rust, ARK, Valheim i ostatní, protože odpovídají na stejný
 * paket. Mezi hrami se liší to, co se dá s někým udělat — vyhodit je `kick
 * "jméno"` v jedné a `KickPlayer <id>` v druhé — a právě proto tahle stránka
 * čte a nejedná.
 */

return [
    'title' => 'Hráči',
    'nav_label' => 'Hráči',
    'subheading' => 'Kdo je připojený — zeptáno samotné hry, ne panelu.',

    'refresh' => 'Zeptat se znovu',

    'count' => 'Připojeno: :count',
    'score' => 'Skóre',

    'just_joined' => 'právě přišel',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Na tomhle serveru nikdo není.',

    /*
     * Ne „nikdo tu není", a ten rozdíl je důležitý.
     *
     * Panel a herní port bývají v sítích, které na sebe nedosáhnou, a nakreslit
     * to jako prázdný seznam by znamenalo říct něco, co tahle stránka neví.
     */
    'unreachable' => 'Server neodpověděl. Možná se spouští, nebo panel nedosáhne na jeho herní port odtud, kde běží — a to není totéž jako že uvnitř nikdo není.',
];
