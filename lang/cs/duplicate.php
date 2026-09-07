<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Egg" zůstává anglicky: tohle slovo Pelican používá v celém svém rozhraní, a
 * nastavení pojmenované jinak než obrazovka, ze které pochází, je nastavení,
 * které se hledá dvakrát.
 */

return [
    'title' => 'Zduplikovat server',
    'nav_label' => 'Zduplikovat server',
    'subheading' => 'Další server postavený přesně jako ten, který už máte, nebo rovnou několik.',

    'section' => 'Co se kopíruje',
    'section_helper' => 'Kopíruje se vlastník, egg, spouštěcí příkaz, limity a všechny proměnné. Soubory, databáze, zálohy a naplánované úlohy ne — kopie souborů běžícího serveru je kopie jeho stavu, a to se pod „ještě jeden takový" myslí jen zřídka.',

    'source' => 'Kopírovat z',
    'source_helper' => 'Kopie skončí na stejném uzlu jako tenhle server, protože tam jsou jeho volné adresy.',

    'name' => 'Název kopie',
    'name_helper' => 'Když jich uděláte víc, očíslují se: „Bot 1", „Bot 2" a tak dál.',

    'copies' => 'Kolik',
    'copies_helper' => 'Nejdřív vyberte server.',
    'room' => 'Volných adres na :node: :count, tolik se jich teď nejvýš dá udělat.',
    'no_room' => 'Na :node nezbyla žádná volná adresa. Kopie potřebuje vlastní, tak tomu uzlu nejdřív přidejte alokaci.',

    /*
     * Úspěchy spočítané, ne vypsané, a neúspěchy vypsané — právě tímhle směrem
     * to pomáhá: deset jmen, která vyšla, je zeď textu, kterou nikdo nečte, a to
     * jedno, které nevyšlo, je jediné, co stojí za přečtení.
     */
    'made' => 'Vytvořeno kopií: :count',
    'partly_failed' => 'Nepodařilo se vytvořit kopií: :count',
    'failed' => 'Nic se nezkopírovalo',
];
