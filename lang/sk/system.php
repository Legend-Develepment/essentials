<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Swap", „Load average", „Wings" a „Uptime" ostávajú po anglicky: pod týmito
 * menami sa nájdu na hostiteľovi aj v samotnom rozhraní Pelicanu.
 */

return [
    'title' => 'Stav systému',
    'nav_label' => 'Stav systému',
    'subheading' => 'Stroj, na ktorom beží samotný panel, čo na ňom beží, a vedľa každý uzol, o ktorý ste si povedali.',

    'options' => 'Voľby',
    'enabled' => 'Zobraziť v bočnom paneli',
    'enabled_helper' => 'Vypnuté vezme položku z bočného panela preč. Stránka si necháva vlastnú adresu, takže je vždy poruke, aby sa dala zase zapnúť.',

    'refresh' => 'Načítavať znova každých',
    'refresh_helper' => 'Celá stránka sa v tomto intervale vyžiada znova. Vypnuté ju nechá takú, aká bola pri otvorení.',
    'refresh_off' => 'Len keď ju otvorím',
    'refresh_seconds' => ':seconds sekúnd',

    'blocks' => 'Zobraziť',
    'blocks_helper' => 'Zaškrtnuté znamená vidieť. „Disk" je jedna karta na súborový systém, takže plný koreňový oddiel sa neschová za napoly prázdny dátový.',
    'block_cpu' => 'Procesor',
    'block_memory' => 'Pamäť',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Systém',
    'block_version' => 'Verzia panela',
    // Nikdy sa neukazuje - karta uzla nesie meno samotného uzla - ale blank() sa
    // naň pýta, a chýbajúci kľúč, ktorý vypíše vlastné meno, je slabá náhrada.
    'block_node' => 'Uzol',

    'nodes' => 'Ktoré uzly zobraziť',
    'nodes_helper' => 'Po jednej karte, vedľa hostiteľa panela. Nič zaškrtnuté neukáže žiadny - nástenka už blok so všetkými uzlami má. Každý sa pýta u svojho vlastného daemona, takže krátky interval a dlhý zoznam je veľa požiadaviek.',

    'section_usage' => 'Využitie',
    'section_host' => 'Tento panel',
    'section_nodes' => 'Uzly',

    'disk_panel' => 'Tu býva panel',
    'wings' => 'Wings :version',
    'version_installed' => 'Nainštalovaná',
    'version_latest' => 'Najnovšia',
    'version_current' => 'Aktuálna',
    'version_update' => 'Dostupná aktualizácia',
    'version_unknown' => 'Nepodarilo sa skontrolovať',

    /*
     * Čo ponúka karta, ktorá zaostala.
     *
     * Odkaz na vydanie namiesto tlačidla, ktoré aktualizuje, lebo odtiaľto nie
     * je čo aktualizovať: Pelican nemá príkaz na aktualizáciu a Wings nemá
     * koncový bod, ktorý by vymenil vlastnú binárku. Nápoveda hovorí, kde sa
     * práca naozaj odohráva, nech nikto nehľadá tlačidlo, ktoré nikdy nebolo
     * možné.
     */
    'version_release' => 'Čo je nové',
    'version_how_panel' => 'Otvorí poznámky k vydaniu. Panel sa aktualizuje na stroji, kde beží - panel nemôže vymeniť vlastné súbory a žiadny plugin nesmie spúšťať príkazy shellu.',
    'version_how_wings' => 'Otvorí poznámky k vydaniu. Wings sa aktualizuje na samotnom uzle - panel nemá žiadny kanál k programu bežiacemu na inom stroji.',

    'wings_latest' => 'Najnovšia :version',
    'load_cores' => ':percent % z :cores procesorov',
    'load_windows' => ':five za 5 min · :fifteen za 15 min',
    'uptime_since' => 'Od :date',
    'unavailable' => 'Na tomto hostiteľovi nie je k dispozícii',

    'fact_os' => 'Operačný systém',
    'fact_hostname' => 'Názov hostiteľa',
    'fact_php' => 'PHP',
    'fact_cores' => 'Procesory',
    'fact_processes' => 'Procesy',
];
