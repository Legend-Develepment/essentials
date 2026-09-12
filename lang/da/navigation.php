<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Siden med navigationslinks. Ved siden af meddelelserne frem for inde i
 * temaets indstillinger: ingen af dem handler om, hvordan panelet ser ud. Den
 * ene er, hvad det siger, og denne er, hvor det fører hen.
 */

return [
    'title' => 'Navigationslinks',
    'nav_label' => 'Navigationslinks',
    'subheading' => 'Dine egne punkter i sidebjælken - en Discord-invitation, en statusside, en vidensbase. De går gennem Filaments egen navigation, så de opfører sig som alle andre punkter: de står under en overskrift, og de følger sidebjælken, uanset om den er en smal skinne eller flyttet op.',

    'add' => 'Tilføj et link',
    'enabled' => 'Til',
    'off' => 'fra',

    'label' => 'Navn',
    'icon' => 'Ikon',
    'url' => 'Adresse',
    'url_helper' => 'https:// eller en sti inde i dette panel, for eksempel /account. Alt andet ignoreres - et punkt i navigationen er ikke et sted til et skema, ingen venter sig.',
    'scope' => 'Vises i',
    'scope_all' => 'Alle steder',
    'scope_client' => 'Kun uden for administrationsdelen',
    'scope_admin' => 'Kun i administrationsdelen',
    'scope_login' => 'Under login-formularen',
    'group' => 'Gruppe',
    'group_helper' => 'Lad feltet stå tomt for at sætte det over den første overskrift. Skriv det samme navn på to links, og de står sammen under den.',
    'new_tab' => 'Åbn i ny fane',

    'favicon' => 'Brug webstedets eget ikon',
    'favicon_helper' => 'Hentes én gang, når du gemmer - aldrig mens nogen indlæser en side. Svarer webstedet ikke, bliver det ikon, der er valgt ovenfor, stående.',
    'icon_fallback' => 'Bruges kun, hvis webstedet ikke har sit eget ikon.',

    'saved' => 'Navigationslinks gemt',
    'failed' => 'Navigationslinkene kunne ikke gemmes',
];
