<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Steam App ID», «IGDB», «Twitch client ID» og «client secret» blir stående på
 * engelsk: det er nøyaktig de ordene som står på de sidene verdiene kommer fra.
 */

return [
    'title' => 'Egg-bilder',
    'nav_label' => 'Egg-bilder',
    'subheading' => 'Spillbilder til eggene dine, hentet fra Steam og IGDB. Et egg uten bilde viser Pelicans egen fugl på hvert eneste serverkort som bruker det.',

    // ---- tabellen ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Låst',

    'locked' => 'Låst',
    'unlocked' => 'Åpen',

    // ---- hva man kan gjøre med en rad -------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Tallet i et spills Steam-adresse — store.steampowered.com/app/892970 er 892970. Å hente på id låser bildet, for et tall man har tastet inn er en avgjørelse, og en senere samlet runde skal ikke rulle den tilbake.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Søk etter',
    'search_term_helper' => 'Navnet på egget er fylt ut på forhånd, men det er sjelden det spillet heter — «Paper 1.20.4» er Minecraft. Skriv spillet.',

    'lock' => 'Lås',
    'unlock' => 'Lås opp',
    'locked_done' => 'Låst — en samlet runde lar denne være',
    'unlocked_done' => 'Låst opp — en samlet runde får bytte ut dette bildet',

    'clear' => 'Tøm',
    'clear_confirm' => 'Fjerner bildet og Steam App ID-en. Egget faller tilbake til Pelicans egen fugl, og neste samlede runde prøver igjen.',
    'cleared' => 'Bilde fjernet',

    // ---- utfall -----------------------------------------------------------
    'fetched' => 'Bilde lagret',
    'failed' => 'Det ble ikke lagret noe bilde',

    /*
     * Én grunn til hver, fordi det er forskjellige problemer.
     *
     * En henting som falt på en skrivefeil, og en som falt fordi disken er full,
     * skal ikke begge si «mislyktes» — den første ordnes ved å se på tallet, den
     * andre ved å se på serveren.
     */
    'why_bad_id' => 'Det er ikke en Steam App ID.',
    'why_not_found' => 'Steam har ingenting på den adressen. Sjekk App ID-en — et spill uten butikkside har heller ikke noe toppbilde.',
    'why_no_match' => 'Det ble ikke funnet noe under det navnet. Prøv med det spillet faktisk heter, framfor med navnet på egget.',
    'why_no_name' => 'Det er ingenting å søke etter.',
    'why_no_token' => 'Twitch ville ikke utstede et token. Sjekk client ID og secret under Legitimasjon.',
    'why_not_configured' => 'IGDB trenger en Twitch client ID og en secret. Legg dem inn under Legitimasjon.',
    'why_empty' => 'Svaret var tomt.',
    'why_large' => 'Det bildet er langt større enn et ikon og ble ikke lagret.',
    'why_not_an_image' => 'Det som kom tilbake, er ikke et bilde. Det betyr som regel at en feilside svarte med en suksesskode.',
    'why_wrong_format' => 'Det bildet er i et format dette panelet ikke lagrer. Pelican beholder PNG, JPEG og WebP.',
    'why_unwritable' => 'Bildet kunne ikke skrives. Sjekk at storage/app/public tilhører den brukeren panelet kjører som, og at php artisan storage:link er kjørt.',
    'why_unknown' => 'Det virket ikke, og grunnen er ikke en dette har et navn på.',

    // ---- alt på én gang ---------------------------------------------------
    'bulk' => 'Hent alle de manglende',
    'bulk_confirm_steam' => 'Søker på Steam etter navn for hvert egg som ikke har et bilde og ikke er låst. Låste eggs og eggs som allerede har et bilde, blir latt i fred. Dette kjører i bakgrunnen — du får beskjed når det er ferdig.',
    'bulk_confirm_both' => 'Søker på Steam etter navn for hvert egg som ikke har et bilde og ikke er låst, og prøver deretter IGDB for det Steam ikke fant. Låste eggs og eggs som allerede har et bilde, blir latt i fred. Dette kjører i bakgrunnen — du får beskjed når det er ferdig.',

    'bulk_started' => 'Henter i bakgrunnen',
    'bulk_started_body' => 'På et stort panel kan dette ta flere minutter. Du får et varsel når det er gjort, og du kan forlate denne siden.',

    'bulk_done' => 'Egg-bilder ferdige',
    'bulk_done_body' => ':fetched hentet, :skipped latt i fred, :failed uten funn. Et egg blir latt i fred når det er låst eller allerede har et bilde.',

    'bulk_failed' => 'Den samlede runden kjørte ikke',
    'bulk_failed_queue' => 'Den kunne ikke sendes videre til køen. Dette krever en queue worker — sjekk at pelican-queue kjører.',

    // ---- IGDB-legitimasjon ------------------------------------------------
    'credentials' => 'Legitimasjon',
    'credentials_helper' => 'Steam virker helt uten dette. Disse opplysningene er bare til IGDB, som dekker de spillene Steam aldri har hørt om — Minecraft og hver eneste avlegger av det, alt som kom ut på en konsoll, de fleste eggs med mods.',
    'credentials_where' => 'Lag en applikasjon på dev.twitch.tv/console, generer en client secret, og lim inn begge deler her. Det er gratis.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Legitimasjon lagret',
    'credentials_failed' => 'Legitimasjonen kunne ikke lagres',
];
