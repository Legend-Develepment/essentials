<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * SteamID64 en PlayFab blijven onvertaald: zo heten ze op de plek waar je ze
 * vandaan haalt, en een naam die alleen hier bestaat is een naam die niemand
 * kan opzoeken.
 */

return [
    /* ------------------------------------------------- het beheertabblad -- */

    'section_helper' => 'Welke eggs Valheim draaien. Verder niets — een Valheim-server wordt via de opstartvariabelen ingesteld, en Pelicans eigen Startup-pagina bewerkt die al.',

    'eggs' => 'Welke eggs zijn Valheim',
    'eggs_helper' => 'Vink de eggs aan die een Valheim-server draaien. Binnen servers die ze gebruiken verschijnt een pagina Spelerslijsten, en nergens anders. Waar die lijsten staan verschilt per egg, dus dat wordt per server uitgezocht door te kijken op de plekken die het spel gebruikt. Er staat om te beginnen niets aangevinkt, met opzet — een plugin kan niet weten hoe jij je eggs genoemd hebt.',

    /* -------------------------------------------- de pagina in de server -- */

    'nav_label' => 'Spelerslijsten',
    'title' => 'Valheim-spelerslijsten',
    'subheading' => 'Admins, bans en de toegestaan-lijst, als drie lijsten in plaats van drie tekstbestanden.',

    'admin' => 'Admins',
    'admin_helper' => 'Iedereen hier kan de admin-commando\'s in het spel gebruiken.',
    'banned' => 'Verbannen',
    'banned_helper' => 'Iedereen hier wordt geweigerd bij het verbinden.',
    'permitted' => 'Toegestaan',
    'permitted_helper' => 'Staat hier iemand in, dan mogen alleen deze mensen erin. Een lege lijst laat iedereen toe — en dat is wat de meeste servers willen, dus laat hem leeg tenzij je het meent.',

    'ids' => 'Speler-ID\'s',
    'ids_placeholder' => 'Plak een ID en druk op spatie',

    'how' => 'Eén ID per speler — een SteamID64 op een Steam-server, een PlayFab-ID op een crossplay-server. Plak ze erin en druk op spatie, tab of komma. Wat het spel als opmerking boven de lijst geschreven heeft blijft staan.',
    'where' => 'Gelezen uit :dir.',
    'missing' => 'Deze server heeft nog geen van deze bestanden. Het spel schrijft ze wanneer het ze nodig heeft, en opslaan maakt hier de bestanden aan die je invult.',
    'read_only' => 'Je mag deze bestanden lezen maar niet schrijven, dus hier valt niets te wijzigen.',

    'save' => 'Opslaan',
    'saved' => 'Opgeslagen',
    'saved_reload' => 'Valheim leest deze lijsten terwijl het draait, dus de wijziging gaat in zonder herstart.',
    'unchanged' => 'Er was niets veranderd, dus er is niets geschreven',
    'failed' => 'Kon niet opslaan',
    'failed_lists' => 'De daemon weigerde de schrijfactie voor: :lists. Controleer of de server bereikbaar is en de bestanden niet alleen-lezen zijn.',
];
