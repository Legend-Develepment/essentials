<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Kto je na serveri, pre hry, ktoré odpovedajú na dopyt Valve.
 *
 * Jedna stránka pre Rust, ARK, Valheim aj ostatné, lebo odpovedajú na ten istý
 * paket. Medzi hrami sa líši to, čo sa dá s niekým urobiť - vyhodiť je `kick
 * "meno"` v jednej a `KickPlayer <id>` v druhej - a práve preto táto stránka
 * číta a nekoná.
 */

return [
    'title' => 'Hráči',
    'nav_label' => 'Hráči',
    'subheading' => 'Kto je pripojený - spýtané samotnej hry, nie panela.',

    'refresh' => 'Spýtať sa znova',

    'count' => 'Pripojených: :count',
    'score' => 'Skóre',

    'just_joined' => 'práve prišiel',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Na tomto serveri nikto nie je.',

    /*
     * Nie „nikto tu nie je", a ten rozdiel je dôležitý.
     *
     * Panel a herný port bývajú v sieťach, ktoré na seba nedosiahnu, a nakresliť
     * to ako prázdny zoznam by znamenalo povedať niečo, čo táto stránka nevie.
     */
    'unreachable' => 'Server neodpovedal. Možno sa spúšťa, alebo panel nedosiahne na jeho herný port odtiaľ, kde beží - a to nie je to isté ako že vnútri nikto nie je.',
];
