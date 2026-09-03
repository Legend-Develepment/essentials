<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * "Swap", "Load average", "Wings" en "PHP" blijven staan. Dat zijn namen van
 * dingen die op een Linux-host precies zo heten; wie ze opzoekt zoekt die
 * woorden, en "wisselbestand" helpt daar niemand mee.
 */

return [
    'title' => 'Systeemstatus',
    'nav_label' => 'Systeemstatus',
    'subheading' => 'De machine waarop het panel zelf draait, wat daarop draait, en elke node die je ernaast hebt gevraagd.',

    'options' => 'Opties',
    'enabled' => 'In de zijbalk tonen',
    'enabled_helper' => 'Uit haalt de regel uit de zijbalk. De pagina houdt zijn eigen adres, dus hij is er altijd om weer aan te zetten.',

    'refresh' => 'Opnieuw lezen elke',
    'refresh_helper' => 'De hele pagina wordt op dit interval opnieuw opgevraagd. Uit laat hem staan zoals hij was toen je hem opende.',
    'refresh_off' => 'Alleen als ik hem open',
    'refresh_seconds' => ':seconds seconden',

    'blocks' => 'Tonen',
    'blocks_helper' => 'Aangevinkt is zichtbaar. Schijf is één kaart per bestandssysteem, zodat een volle root-partitie niet verstopt zit achter een halflege datamount.',
    'block_cpu' => 'Processor',
    'block_memory' => 'Geheugen',
    'block_swap' => 'Swap',
    'block_disk' => 'Schijf',
    'block_load' => 'Load average',
    'block_uptime' => 'Draaitijd',
    'block_system' => 'Systeem',
    'block_version' => 'Panelversie',
    'block_node' => 'Node',

    'nodes' => 'Nodes om te tonen',
    'nodes_helper' => 'Elk een eigen kaart, naast de host van het panel. Niets aangevinkt toont er geen — het dashboard heeft al een blok met alle nodes erin. Elke node wordt aan zijn eigen daemon gevraagd, dus een kort interval met een lange lijst is veel verzoeken.',

    'section_usage' => 'Gebruik',
    'section_host' => 'Dit panel',
    'section_nodes' => 'Nodes',

    'disk_panel' => 'Hier staat het panel',
    'wings' => 'Wings :version',

    'version_installed' => 'Geïnstalleerd',
    'version_latest' => 'Nieuwste',
    'version_current' => 'Bij',
    'version_update' => 'Update beschikbaar',
    'version_unknown' => 'Kon niet controleren',

    'load_cores' => ':percent% van :cores processors',
    'load_windows' => ':five over 5 min · :fifteen over 15 min',
    'uptime_since' => 'Sinds :date',
    'unavailable' => 'Niet beschikbaar op deze host',

    'fact_os' => 'Besturingssysteem',
    'fact_hostname' => 'Hostnaam',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processors',
    'fact_processes' => 'Processen',
];
