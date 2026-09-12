<?php

/*
 * Svenska. Skriven för hand.
 *
 * Sidan Systemstatus: värden panelen själv kör på, och varje nod man har bett
 * om bredvid den.
 *
 * Inte samma maskin som noderna på någon installation där de är åtskilda, och
 * det är därför båda kan stå på sidan.
 *
 * «Swap», «Wings», «PHP» och «uptime» står kvar: det är vad de heter på värden
 * och i alla verktyg man skulle jämföra med.
 */

return [
    'title' => 'Systemstatus',
    'nav_label' => 'Systemstatus',
    'subheading' => 'Maskinen panelen själv kör på, vad den kör, och varje nod du bett om bredvid den.',

    'options' => 'Alternativ',
    'enabled' => 'Visa i sidofältet',
    'enabled_helper' => 'Av tar bort raden ur sidofältet. Sidan behåller sin egen adress, så den finns alltid kvar att slå på igen.',

    'refresh' => 'Läs om var',
    'refresh_helper' => 'Hela sidan begärs på nytt med det här intervallet. Av lämnar den som den var när du öppnade den.',
    'refresh_off' => 'Bara när jag öppnar den',
    'refresh_seconds' => ':seconds sekunder',

    'blocks' => 'Visa',
    'blocks_helper' => 'Ikryssat visas. Disk är ett kort per filsystem, så en full rotpartition göms inte bakom en halvtom datamontering.',
    'block_cpu' => 'Processor',
    'block_memory' => 'Minne',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Genomsnittlig last',
    'block_uptime' => 'Uptime',
    'block_system' => 'System',
    'block_version' => 'Panelversion',
    // Visas aldrig - ett nodkort tar nodens eget namn - men blank() frågar
    // efter den, och en nyckel som saknas och skriver ut sitt eget namn är en
    // dålig reserv.
    'block_node' => 'Nod',

    'nodes' => 'Noder att visa',
    'nodes_helper' => 'Ett kort var, bredvid panelens värd. Ingenting ikryssat visar ingen - översikten har redan ett block med varje nod på. Var och en frågas av sin egen daemon, så ett kort intervall och en lång lista blir många förfrågningar.',

    'section_usage' => 'Användning',
    'section_host' => 'Den här panelen',
    'section_nodes' => 'Noder',

    'disk_panel' => 'Panelen bor här',
    'wings' => 'Wings :version',
    'version_installed' => 'Installerad',
    'version_latest' => 'Senaste',
    'version_current' => 'Aktuell',
    'version_update' => 'Uppdatering finns',
    'version_unknown' => 'Gick inte att kontrollera',

    /*
     * Vad ett kort som ligger efter erbjuder.
     *
     * En länk till utgåvan i stället för en knapp som utför uppdateringen, för
     * det finns ingen uppdatering att utföra härifrån: Pelican har inget
     * uppgraderingskommando, och Wings har ingen endpoint som byter ut sin egen
     * binär. Hjälptexten säger var arbetet faktiskt sker, så att ingen letar
     * efter en knapp som aldrig var möjlig.
     */
    'version_release' => 'Vad som är nytt',
    'version_how_panel' => 'Öppnar versionsanteckningarna. Att uppgradera panelen görs på maskinen den kör på - panelen kan inte byta ut sina egna filer, och inget plugin får köra skalkommandon.',
    'version_how_wings' => 'Öppnar versionsanteckningarna. Wings uppdateras på själva noden - panelen har ingen kanal till programmet som kör på en annan maskin.',

    'wings_latest' => 'Senaste :version',
    'load_cores' => ':percent % av :cores processorer',
    'load_windows' => ':five över 5 min · :fifteen över 15 min',
    'uptime_since' => 'Sedan :date',
    'unavailable' => 'Inte tillgängligt på den här värden',

    'fact_os' => 'Operativsystem',
    'fact_hostname' => 'Värdnamn',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processorer',
    'fact_processes' => 'Processer',
];
