<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Opslaan',
    'saved' => 'Opgeslagen',
    'restart' => 'Het spel leest dit bestand bij het starten, dus herstart de server om de wijziging te laten ingaan.',
    'failed' => 'Opslaan mislukt',
    'failed_write' => 'De daemon weigerde de schrijfactie. Controleer of de server bereikbaar is en het bestand niet alleen-lezen is.',
    'read_only' => 'Je mag dit bestand lezen maar niet schrijven, dus hier is niets te wijzigen.',
    'missing' => 'Deze server heeft nog geen instellingenbestand. Het spel schrijft het bij de eerste start, dus start de server een keer en deze pagina vult zich.',
    'keeps' => 'De rest van het bestand - het commentaar, de lege regels, de volgorde en elke sleutel die deze plugin niet kent - blijft bij het opslaan precies zoals het was.',
    'raw' => 'De namen hier zijn de namen die het spel gebruikt, in de volgorde van het bestand. Er wordt niets vertaald en niets gegroepeerd, want deze pagina leest het bestand in plaats van een lijst die iemand heeft opgeschreven - dus je ziet elke instelling die het spel kent, ook die na deze release zijn bijgekomen.',
    'unset' => 'Niet ingesteld. Het spel noemt hem als voorbeeld; dit invullen voegt hem toe.',
    'group_all' => 'Instellingen',
    'group_all_helper' => 'Alles wat dit bestand noemt.',
    'subheading' => 'Opgebouwd uit :files, niet uit een lijst die iemand heeft opgeschreven.',
];
