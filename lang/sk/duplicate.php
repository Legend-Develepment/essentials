<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Egg" ostáva po anglicky: toto slovo Pelican používa v celom svojom rozhraní,
 * a nastavenie pomenované inak ako obrazovka, z ktorej pochádza, je nastavenie,
 * ktoré sa hľadá dvakrát.
 */

return [
    'title' => 'Zduplikovať server',
    'nav_label' => 'Zduplikovať server',
    'subheading' => 'Ďalší server postavený presne ako ten, ktorý už máte, alebo rovno niekoľko.',

    'section' => 'Čo sa kopíruje',
    'section_helper' => 'Kopíruje sa vlastník, egg, spúšťací príkaz, limity a všetky premenné. Súbory, databázy, zálohy a naplánované úlohy nie — kópia súborov bežiaceho servera je kópia jeho stavu, a to sa pod „ešte jeden taký" myslí len zriedka.',

    'source' => 'Kopírovať z',
    'source_helper' => 'Kópie skončia na tom istom uzle ako tento server, lebo tam sú jeho voľné adresy.',

    'name' => 'Názov kópie',
    'name_helper' => 'Keď ich urobíte viac, očíslujú sa: „Bot 1", „Bot 2" a tak ďalej.',

    'copies' => 'Koľko',
    'copies_helper' => 'Najprv vyberte server.',
    'room' => 'Voľných adries na :node: :count, toľko sa ich teraz najviac dá urobiť.',
    'no_room' => 'Na :node nezvýšila žiadna voľná adresa. Kópia potrebuje vlastnú, tak tomu uzlu najprv pridajte alokáciu.',

    /*
     * Úspechy spočítané, nie vypísané, a neúspechy vypísané — práve týmto smerom
     * to pomáha: desať mien, ktoré vyšli, je stena textu, ktorú nikto nečíta, a
     * to jedno, ktoré nevyšlo, je jediné, čo stojí za prečítanie.
     */
    'made' => 'Vytvorených kópií: :count',
    'partly_failed' => 'Nepodarilo sa vytvoriť kópií: :count',
    'failed' => 'Nič sa neskopírovalo',
];
