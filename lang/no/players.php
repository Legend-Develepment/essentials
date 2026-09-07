<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Whitelist» og «operator» blir stående på engelsk: det er de ordene Minecraft
 * selv skriver i server.properties, i whitelist.json og i ops.json, og det er
 * dem man taster inn igjen i konsollen.
 */

return [
    'nav_label' => 'Spillere',
    'title' => 'Spillere',
    'subheading' => 'Whitelisten, operators, utestengelsene, og alle denne serveren har sett.',

    /*
     * Sagt én gang, høyt oppe, fordi det forklarer både hva siden kan og hvorfor
     * den ene tingen den ikke kan, ikke er en feil. Hver endring sendes som en
     * konsollkommando, og det er slik Minecraft skal få beskjed - spillet gjør
     * endringen og skriver sin egen fil, så de to er aldri uenige.
     */
    'how' => 'Endringene sendes til serveren som konsollkommandoer, så det er spillet som gjør dem og som skriver sine egne filer. Det krever at serveren kjører.',
    'needs_running' => 'Serveren må kjøre. Disse endringene gjøres av spillet, ikke ved å endre filene dens under det.',

    'name' => 'Spillernavn',
    'reason' => 'Grunn (valgfritt)',

    'whitelist' => 'Legg til i whitelisten',
    'unwhitelist' => 'Fjern fra whitelisten',
    'op' => 'Gjør til operator',
    'deop' => 'Fjern operator',
    'ban' => 'Utesteng',
    'pardon' => 'Opphev utestengelse',
    'kick' => 'Kast ut',

    'sent' => 'Kommando sendt',
    'sent_body' => 'Serveren setter den ut i livet og oppdaterer sine egne filer. Last siden på nytt for å se listene endre seg.',
    'refused' => 'Det ble ikke sendt',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'På whitelisten',
    'flag_banned' => 'Utestengt',
    'flag_seen' => 'Har spilt her',

    'online' => 'Pålogget nå',
    'online_count' => ':online av :max',
    'online_none' => 'Ingen er tilkoblet.',

    'players' => 'Spillere',
    'ips' => 'Utestengte adresser',
    'ips_empty' => 'Ingen adresser er utestengt.',

    /*
     * Hva en tom side betyr, og det er som regel ikke «ingen spillere», men
     * «denne serveren har aldri startet». Minecraft lager ingen av disse filene
     * før den har kjørt første gang.
     */
    'empty' => 'Det er ingenting å vise ennå. Minecraft skriver disse listene selv, og lager dem ikke før serveren har startet første gang.',

    'level' => 'Nivå :level',

    /*
     * Den ene tingen denne siden ikke gjør, sagt framfor overlatt til å bli
     * oppdaget. En status i sanntid krever en ny tilkobling til selve spillet,
     * og det er en annen funksjon med sine egne krav.
     */
    'not_live' => 'Dette er hva serveren har skrevet ned, ikke hvem som er på akkurat nå.',
];
