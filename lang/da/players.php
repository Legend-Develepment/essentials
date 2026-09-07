<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Whitelist" og „operator" bliver stående på engelsk: det er de ord,
 * Minecraft selv skriver i server.properties, i whitelist.json og i ops.json,
 * og det er dem, man taster tilbage i konsollen.
 */

return [
    'nav_label' => 'Spillere',
    'title' => 'Spillere',
    'subheading' => 'Whitelisten, operators, bandlysningerne og alle, denne server har set.',

    /*
     * Sagt én gang, oppe i toppen, fordi det forklarer både, hvad siden kan, og
     * hvorfor den ene ting, den ikke kan, ikke er en fejl. Hver ændring sendes
     * som en konsolkommando, og det er sådan, Minecraft skal have besked -
     * spillet foretager ændringen og skriver sin egen fil, så de to aldrig er
     * uenige.
     */
    'how' => 'Ændringerne sendes til serveren som konsolkommandoer, så det er spillet, der foretager dem og skriver sine egne filer. Det kræver, at serveren kører.',
    'needs_running' => 'Serveren skal køre. Disse ændringer laves af spillet, ikke ved at rette i dets filer under det.',

    'name' => 'Spillernavn',
    'reason' => 'Årsag (valgfri)',

    'whitelist' => 'Føj til whitelist',
    'unwhitelist' => 'Fjern fra whitelist',
    'op' => 'Gør til operator',
    'deop' => 'Fjern operator',
    'ban' => 'Bandlys',
    'pardon' => 'Ophæv bandlysning',
    'kick' => 'Smid ud',

    'sent' => 'Kommando sendt',
    'sent_body' => 'Serveren fører den ud i livet og opdaterer sine egne filer. Genindlæs siden for at se listerne ændre sig.',
    'refused' => 'Det blev ikke sendt',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'På whitelisten',
    'flag_banned' => 'Bandlyst',
    'flag_seen' => 'Har spillet her',

    'online' => 'Online nu',
    'online_count' => ':online af :max',
    'online_none' => 'Ingen er tilsluttet.',

    'players' => 'Spillere',
    'ips' => 'Bandlyste adresser',
    'ips_empty' => 'Ingen adresser er bandlyst.',

    /*
     * Hvad en tom side betyder, og det er som regel ikke „ingen spillere", men
     * „denne server er aldrig startet". Minecraft opretter ingen af disse filer,
     * før den har kørt første gang.
     */
    'empty' => 'Der er endnu intet at vise. Minecraft skriver disse lister selv, og det opretter dem ikke, før serveren er startet første gang.',

    'level' => 'Niveau :level',

    /*
     * Den ene ting, denne side ikke gør, sagt frem for overladt til at blive
     * opdaget. En status i realtid kræver endnu en forbindelse til selve
     * spillet, og det er en anden funktion med sine egne krav.
     */
    'not_live' => 'Dette er, hvad serveren har skrevet ned, ikke hvem der er på lige nu.',
];
