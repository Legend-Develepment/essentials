<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * "Overallocatie" blijft dicht bij Pelicans eigen woord, want dat is het veld
 * dat je op de node-pagina invult.
 */

return [
    'nav_label' => 'Capaciteit',
    'title' => 'Of er nog een server bij past',
    'subheading' => 'Wat er op elke node beloofd is, tegenover wat hij mag uitdelen.',

    'how' => 'Beloofd, niet gebruikt. Een node kan voor twintig procent bezig zijn en toch helemaal vol, want vol gaat over wat er uitgedeeld is en niet over wat er draait — het Machines-blok op het dashboard is de andere vraag en blijft waar het is. Het rekenwerk hier is dat van Pelican zelf, uit de methode die bepaalt of een server überhaupt aangemaakt mag worden: capaciteit maal één plus de overallocatie, tegenover de som van wat elke server op die node beloofd is. Een capaciteit van nul betekent onbeperkt en een overallocatie onder nul ook — daarom hebben sommige rijen geen percentage in plaats van een volle of een lege balk.',

    'column_node' => 'Machine',
    'column_fullest' => 'Volste',
    'column_memory' => 'Geheugen',
    'column_disk' => 'Schijf',
    'column_cpu' => 'Processor',
    'column_at_limit' => 'Op een grens',

    'servers' => ':count servers',

    'filter_tight' => 'Bijna vol',

    'open' => 'Machine openen',

    'empty' => 'Geen machines die je kunt bereiken.',
];
