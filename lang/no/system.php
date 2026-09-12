<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Swap», «Load average», «Wings» og «Uptime» blir stående på engelsk: det er
 * under de navnene man finner dem på verten og i Pelicans eget grensesnitt.
 */

return [
    'title' => 'Systemstatus',
    'nav_label' => 'Systemstatus',
    'subheading' => 'Maskinen panelet selv kjører på, hva som kjører på den, og ved siden av hver node du har bedt om.',

    'options' => 'Valg',
    'enabled' => 'Vis i sidefeltet',
    'enabled_helper' => 'Av tar punktet ut av sidefeltet. Siden beholder sin egen adresse, så den er alltid der til å slå på igjen.',

    'refresh' => 'Les på nytt hvert',
    'refresh_helper' => 'Hele siden hentes på nytt med dette mellomrommet. Av lar den stå som den var da du åpnet den.',
    'refresh_off' => 'Bare når jeg åpner den',
    'refresh_seconds' => ':seconds sekunder',

    'blocks' => 'Vis',
    'blocks_helper' => 'Kryss betyr synlig. «Disk» er ett kort per filsystem, så en full rotpartisjon gjemmer seg ikke bak et halvtomt datamount.',
    'block_cpu' => 'Prosessor',
    'block_memory' => 'Minne',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'System',
    'block_version' => 'Panelversjon',
    // Vises aldri - et nodekort bærer nodens eget navn - men blank() spør etter
    // den, og en manglende nøkkel som skriver ut sitt eget navn er en dårlig
    // nødløsning.
    'block_node' => 'Node',

    'nodes' => 'Noder som skal vises',
    'nodes_helper' => 'Ett kort hver, ved siden av panelets vert. Ingen kryss viser ingen - oversikten har allerede en blokk med hver node på. Hver enkelt spørres hos sin egen daemon, så et kort mellomrom og en lang liste er mange forespørsler.',

    'section_usage' => 'Bruk',
    'section_host' => 'Dette panelet',
    'section_nodes' => 'Noder',

    'disk_panel' => 'Her bor panelet',
    'wings' => 'Wings :version',
    'version_installed' => 'Installert',
    'version_latest' => 'Nyeste',
    'version_current' => 'Oppdatert',
    'version_update' => 'Oppdatering klar',
    'version_unknown' => 'Kunne ikke sjekkes',

    /*
     * Hva et kort som ligger etter, tilbyr.
     *
     * En lenke til utgivelsen framfor en knapp som oppdaterer, fordi det ikke er
     * noe å oppdatere herfra: Pelican har ingen oppgraderingskommando, og Wings
     * har ingen endepunkt som bytter ut sin egen binærfil. Hjelpeteksten sier
     * hvor arbeidet faktisk foregår, så ingen leter etter en knapp som aldri
     * var mulig.
     */
    'version_release' => 'Hva som er nytt',
    'version_how_panel' => 'Åpner utgivelsesnotatene. Panelet oppgraderes på maskinen det kjører på - panelet kan ikke bytte ut sine egne filer, og ingen plugins får kjøre shell-kommandoer.',
    'version_how_wings' => 'Åpner utgivelsesnotatene. Wings oppdateres på selve noden - panelet har ingen kanal til et program som kjører på en annen maskin.',

    'wings_latest' => 'Nyeste :version',
    'load_cores' => ':percent % av :cores prosessorer',
    'load_windows' => ':five over 5 min · :fifteen over 15 min',
    'uptime_since' => 'Siden :date',
    'unavailable' => 'Ikke tilgjengelig på denne verten',

    'fact_os' => 'Operativsystem',
    'fact_hostname' => 'Vertsnavn',
    'fact_php' => 'PHP',
    'fact_cores' => 'Prosessorer',
    'fact_processes' => 'Prosesser',
];
