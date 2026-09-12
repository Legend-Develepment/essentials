<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Node" er det ord, Pelican bruger på dansk om en maskine, og det er taget med
 * her; på de offentlige sider, hvor der læses af nogen, der aldrig har hørt om
 * Pelican, står der „maskine".
 */

return [
    'nav_label' => 'Kapacitet',
    'title' => 'Om der er plads til en server mere',
    'subheading' => 'Hvad der er lovet væk på hver node, over for hvad den må dele ud.',

    'how' => 'Lovet væk, ikke brugt. En node kan være tyve procent belastet og helt fuld, fordi „fuld" handler om det, der er delt ud, og ikke om det, der kører - blokken Maskiner på oversigten svarer på det andet spørgsmål og bliver, hvor den er. Regnestykket her er Pelicans eget, taget fra den metode, der afgør, om en server overhovedet må oprettes: kapaciteten gange én plus overallokeringen, over for summen af det, hver server på noden fik lovet. En kapacitet på nul betyder ubegrænset, og det gør en overallokering under nul også - derfor er der rækker uden procent i stedet for en fuld eller tom bjælke.',

    'column_node' => 'Maskine',
    'column_fullest' => 'Mest fyldt',
    'column_memory' => 'Hukommelse',
    'column_disk' => 'Disk',
    'column_cpu' => 'Processor',
    'column_at_limit' => 'Ved en grænse',

    'servers' => ':count servere',

    'filter_tight' => 'Næsten fulde',

    'open' => 'Åbn maskinen',

    'empty' => 'Ingen maskiner, du kan nå.',
];
