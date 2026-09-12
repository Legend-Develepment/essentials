<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Egg", „daemon", „SteamID64" og „PlayFab ID" bliver stående på engelsk: det
 * er Pelicans ord og spillets egne, og det er under de navne, man finder dem
 * igen.
 */

return [
    /* ---------------------------------------------- administratorfanen --- */

    'section_helper' => 'Hvilke eggs der kører Valheim. Ikke andet - en Valheim-server sættes op med dens startvariabler, og Pelicans egen Start-side redigerer dem allerede.',

    'eggs' => 'Hvilke eggs er Valheim',
    'eggs_helper' => 'Sæt hak ved de eggs, der kører en Valheim-server. Inde i de servere, der bruger dem, dukker en side med Spillerlister op, og ingen andre steder. Hvor de lister ligger, er forskelligt fra egg til egg, så det findes frem server for server ved at kigge de steder, spillet bruger. Der er ikke sat hak ved noget til at begynde med, og det er med vilje - et plugin kan ikke vide, hvad du har kaldt dine eggs.',

    /* ------------------------------------------------------ serverside --- */

    'nav_label' => 'Spillerlister',
    'title' => 'Valheims spillerlister',
    'subheading' => 'Administratorer, bandlyste og listen over tilladte, som tre lister frem for tre tekstfiler.',

    'admin' => 'Administratorer',
    'admin_helper' => 'Alle her kan bruge administratorkommandoerne inde i spillet.',
    'banned' => 'Bandlyste',
    'banned_helper' => 'Alle her bliver afvist, når de prøver at komme ind.',
    'permitted' => 'Tilladte',
    'permitted_helper' => 'Er der nogen på denne liste, må kun disse folk komme ind. En tom liste lukker alle ind - og det er, hvad de fleste servere vil have, så lad den stå tom, medmindre du mener det.',

    'ids' => 'Spiller-id\'er',
    'ids_placeholder' => 'Indsæt et id og tryk mellemrum',

    'how' => 'Ét id pr. spiller - et SteamID64 på en Steam-server, et PlayFab ID på en med crossplay. Indsæt dem og tryk mellemrum, tabulator eller komma. Det, spillet har skrevet som kommentar over listen, bliver, hvor det er.',
    'where' => 'Læst fra :dir.',
    'missing' => 'Denne server har endnu ingen af disse filer. Spillet skriver dem, første gang det får brug for dem, og at gemme her opretter dem, du udfylder.',
    'read_only' => 'Du må læse disse filer, men ikke skrive dem, så intet her kan ændres.',

    'save' => 'Gem',
    'saved' => 'Gemt',
    'saved_reload' => 'Valheim læser disse lister, mens det kører, så ændringen gælder uden genstart.',
    'unchanged' => 'Intet var ændret, så der blev ikke skrevet noget',
    'failed' => 'Kunne ikke gemme',
    'failed_lists' => 'Daemonen afviste skrivningen for: :lists. Tjek, at serveren kan nås, og at filerne ikke er skrivebeskyttede.',
];
