<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Modpack", „loader", „egg", „daemon", „mods" og „config" bliver stående på
 * engelsk: det er de ord, der står på Modrinth, i filhåndteringen og i enhver
 * vejledning, man finder om det.
 */

return [
    'nav_label' => 'Modpakker',
    'title' => 'Modpakker',
    'subheading' => 'Installér en modpakke fra Modrinth på denne server.',

    'section' => 'Find en pakke',
    'section_helper' => 'Kun Modrinth, og kun pakker til server. Den kræver hverken konto eller API-nøgle, og derfor er den den eneste kilde her — de andre vil have en nøgle indsat et sted, før der overhovedet dukker noget op.',

    'search' => 'Søg',
    'search_helper' => 'Lad feltet stå tomt for de mest hentede. En søgning spørger Modrinth, så den sker, når du forlader feltet, og ikke mens du skriver.',

    'pack' => 'Pakke',
    'pack_helper' => 'Kun pakker, der siger, at de kører på en server, er med på listen.',

    'version' => 'Version',
    'version_helper' => 'Spilversionen og loaderen står ved siden af hver enkelt. Vælg den loader, denne servers egg allerede kører — det her installerer filer og ændrer hverken dit egg eller din startkommando.',

    'downloads' => 'hentninger',

    'install' => 'Installér denne pakke',
    'install_go' => 'Installér den',
    'install_confirm' => 'Pakkens filer lægges til denne server. **Der slettes ikke noget** — ikke din verden, ikke dine gamle mods, ikke en config. En pakke installeret oven på en anden efterlader begge, så fjern selv den forrige pakkes mods først, hvis det er det, du vil. Serveren skal være stoppet, og den bliver stoppet.',

    'started' => 'Installerer',
    'started_helper' => 'Pakken hentes og pakkes ud. Et par hundrede filer tager et par minutter, og du får en besked, når det er færdigt — det fortsætter, selv om du forlader denne side.',

    'running' => 'Serveren kører',
    'running_helper' => 'Minecraft indlæser sine mods, når det starter, så en pakke installeret nu ville efterlade en server, der hverken er den gamle eller den nye pakke, før den genstarter. Stop den og prøv igen.',

    'done' => ':pack installeret',
    'done_body' => ':files filer hentet og :overrides ting fra pakkens egen mappe lagt på plads. Start serveren, når du er klar.',
    'done_refused' => ':count filer blev sprunget over, fordi pakken bad om dem fra et sted, der ikke hentes fra her.',

    'failed' => 'Pakken blev ikke installeret',
    'failed_fetch' => 'Pakken kunne ikke hentes eller pakkes ud. Daemonen kan være uden for rækkevidde, eller serveren kan være løbet tør for disk.',
    'failed_index' => 'Pakken blev hentet, men havde intet læsbart indeks i sig, så der var intet at installere.',
    'failed_version' => 'Den version har ikke længere en pakkefil at hente. Vælg en anden.',
    'failed_queue' => 'Installationen kunne ikke sættes i kø. Det kræver en queue worker, der kører på panelet.',
];
