<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Node» er ordet Pelican bruker på norsk om en maskin, og det er tatt med her;
 * på de offentlige sidene, der det leses av noen som aldri har hørt om Pelican,
 * står det «maskin».
 */

return [
    'nav_label' => 'Kapasitet',
    'title' => 'Om det er plass til en server til',
    'subheading' => 'Hva som er lovet bort på hver node, mot hva den har lov til å dele ut.',

    'how' => 'Lovet bort, ikke brukt. En node kan være tjue prosent belastet og helt full, fordi «full» handler om det som er delt ut og ikke om det som kjører - blokken Maskiner på oversikten svarer på det andre spørsmålet og blir der den er. Regnestykket her er Pelicans eget, hentet fra metoden som avgjør om en server i det hele tatt kan opprettes: kapasiteten ganger én pluss overallokeringen, mot summen av det hver server på noden fikk lovet. En kapasitet på null betyr ubegrenset, og det gjør en overallokering under null også - derfor er det rader uten prosent i stedet for en full eller tom stolpe.',

    'column_node' => 'Maskin',
    'column_fullest' => 'Mest fylt',
    'column_memory' => 'Minne',
    'column_disk' => 'Disk',
    'column_cpu' => 'Prosessor',
    'column_at_limit' => 'Ved en grense',

    'servers' => ':count servere',

    'filter_tight' => 'Nesten fulle',

    'open' => 'Åpne maskinen',

    'empty' => 'Ingen maskiner du kan nå.',
];
