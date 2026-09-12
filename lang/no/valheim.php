<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Egg», «daemon», «SteamID64» og «PlayFab ID» blir stående på engelsk: det er
 * Pelicans ord og spillets egne, og det er under de navnene man finner dem
 * igjen.
 */

return [
    /* --------------------------------------------- administratorfanen ---- */

    'section_helper' => 'Hvilke eggs som kjører Valheim. Ikke noe mer - en Valheim-server settes opp med startvariablene sine, og Pelicans egen Start-side redigerer dem allerede.',

    'eggs' => 'Hvilke eggs er Valheim',
    'eggs_helper' => 'Kryss av for de eggs som kjører en Valheim-server. Inne i de serverne som bruker dem, dukker det opp en side med Spillerlister, og ingen andre steder. Hvor de listene ligger, er forskjellig fra egg til egg, så det finnes fram server for server ved å se på de stedene spillet bruker. Ingenting er krysset av til å begynne med, og det er med vilje - et plugin kan ikke vite hva du har kalt eggene dine.',

    /* ------------------------------------------------------- serversiden - */

    'nav_label' => 'Spillerlister',
    'title' => 'Valheims spillerlister',
    'subheading' => 'Administratorene, de utestengte og listen over tillatte, som tre lister framfor tre tekstfiler.',

    'admin' => 'Administratorer',
    'admin_helper' => 'Alle som står her, kan bruke administratorkommandoene inne i spillet.',
    'banned' => 'Utestengte',
    'banned_helper' => 'Alle som står her, blir avvist når de prøver å komme inn.',
    'permitted' => 'Tillatte',
    'permitted_helper' => 'Står det noen på denne listen, får bare disse folkene komme inn. En tom liste slipper alle inn - og det er det de fleste servere vil ha, så la den stå tom med mindre du mener det.',

    'ids' => 'Spiller-ID-er',
    'ids_placeholder' => 'Lim inn en ID og trykk mellomrom',

    'how' => 'Én ID per spiller - en SteamID64 på en Steam-server, en PlayFab ID på en med crossplay. Lim dem inn og trykk mellomrom, tabulator eller komma. Det spillet har skrevet som kommentar over listen, blir stående der det er.',
    'where' => 'Lest fra :dir.',
    'missing' => 'Denne serveren har ennå ingen av disse filene. Spillet skriver dem første gang det trenger dem, og å lagre her oppretter dem du fyller ut.',
    'read_only' => 'Du får lese disse filene, men ikke skrive dem, så ingenting her kan endres.',

    'save' => 'Lagre',
    'saved' => 'Lagret',
    'saved_reload' => 'Valheim leser disse listene mens det kjører, så endringen gjelder uten omstart.',
    'unchanged' => 'Ingenting var endret, så ingenting ble skrevet',
    'failed' => 'Kunne ikke lagre',
    'failed_lists' => 'Daemonen avviste skrivingen for: :lists. Sjekk at serveren kan nås, og at filene ikke er skrivebeskyttet.',
];
