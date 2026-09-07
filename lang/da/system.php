<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Swap", „Load average", „Wings" og „Uptime" bliver stående på engelsk: det er
 * under de navne, man finder dem på værten og i Pelicans egen flade.
 */

return [
    'title' => 'Systemstatus',
    'nav_label' => 'Systemstatus',
    'subheading' => 'Maskinen, panelet selv kører på, hvad der kører på den, og ved siden af hver node, du har bedt om.',

    'options' => 'Valgmuligheder',
    'enabled' => 'Vis i sidebjælken',
    'enabled_helper' => 'Fra tager punktet ud af sidebjælken. Siden beholder sin egen adresse, så den er altid der til at slå til igen.',

    'refresh' => 'Læs igen hver',
    'refresh_helper' => 'Hele siden hentes igen med dette mellemrum. Fra lader den stå, som den var, da du åbnede den.',
    'refresh_off' => 'Kun når jeg åbner den',
    'refresh_seconds' => ':seconds sekunder',

    'blocks' => 'Vis',
    'blocks_helper' => 'Hak betyder synlig. „Disk" er ét kort pr. filsystem, så en fuld rodpartition gemmer sig ikke bag et halvtomt datamount.',
    'block_cpu' => 'Processor',
    'block_memory' => 'Hukommelse',
    'block_swap' => 'Swap',
    'block_disk' => 'Disk',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'System',
    'block_version' => 'Panelversion',
    // Vises aldrig - et nodekort bærer nodens eget navn - men blank() spørger
    // efter den, og en manglende nøgle, der udskriver sit eget navn, er en
    // dårlig nødløsning.
    'block_node' => 'Node',

    'nodes' => 'Noder, der skal vises',
    'nodes_helper' => 'Ét kort hver, ved siden af panelets vært. Intet hak viser ingen — oversigten har allerede en blok med hver node på. Hver enkelt spørges hos sin egen daemon, så et kort mellemrum og en lang liste er mange forespørgsler.',

    'section_usage' => 'Forbrug',
    'section_host' => 'Dette panel',
    'section_nodes' => 'Noder',

    'disk_panel' => 'Her bor panelet',
    'wings' => 'Wings :version',
    'version_installed' => 'Installeret',
    'version_latest' => 'Nyeste',
    'version_current' => 'Opdateret',
    'version_update' => 'Opdatering klar',
    'version_unknown' => 'Kunne ikke tjekkes',

    /*
     * Hvad et kort, der er bagud, tilbyder.
     *
     * Et link til udgivelsen frem for en knap, der opdaterer, fordi der ikke er
     * noget at opdatere herfra: Pelican har ingen opgraderingskommando, og Wings
     * har intet endpoint, der udskifter sin egen binærfil. Hjælpeteksten siger,
     * hvor arbejdet faktisk foregår, så ingen leder efter en knap, der aldrig
     * var mulig.
     */
    'version_release' => 'Hvad er nyt',
    'version_how_panel' => 'Åbner udgivelsesnoterne. Panelet opgraderes på den maskine, det kører på - panelet kan ikke udskifte sine egne filer, og intet plugin må køre shell-kommandoer.',
    'version_how_wings' => 'Åbner udgivelsesnoterne. Wings opdateres på selve noden - panelet har ingen kanal til et program, der kører på en anden maskine.',

    'wings_latest' => 'Nyeste :version',
    'load_cores' => ':percent % af :cores processorer',
    'load_windows' => ':five over 5 min · :fifteen over 15 min',
    'uptime_since' => 'Siden :date',
    'unavailable' => 'Ikke til rådighed på denne vært',

    'fact_os' => 'Styresystem',
    'fact_hostname' => 'Værtsnavn',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processorer',
    'fact_processes' => 'Processer',
];
