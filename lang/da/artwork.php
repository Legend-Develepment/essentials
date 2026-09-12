<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Steam App ID", „IGDB", „Twitch client ID" og „client secret" bliver stående
 * på engelsk: det er præcis de ord, der står på de sider, værdierne kommer fra.
 */

return [
    'title' => 'Egg-billeder',
    'nav_label' => 'Egg-billeder',
    'subheading' => 'Spilbilleder til dine eggs, hentet fra Steam og IGDB. Et egg uden billede viser Pelicans egen fugl på hvert eneste serverkort, der bruger det.',

    // ---- tabellen ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Låst',

    'locked' => 'Låst',
    'unlocked' => 'Åben',

    // ---- hvad man kan gøre ved en række -----------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Tallet i et spils Steam-adresse - store.steampowered.com/app/892970 er 892970. At hente på id låser billedet, for et indtastet tal er en beslutning, og et senere samlet gennemløb må ikke rulle den tilbage.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Søg efter',
    'search_term_helper' => 'Egg\'ets navn er udfyldt på forhånd, men det er sjældent det, spillet hedder - „Paper 1.20.4" er Minecraft. Skriv spillet.',

    'lock' => 'Lås',
    'unlock' => 'Lås op',
    'locked_done' => 'Låst - et samlet gennemløb lader denne være',
    'unlocked_done' => 'Låst op - et samlet gennemløb må udskifte dette billede',

    'clear' => 'Ryd',
    'clear_confirm' => 'Fjerner billedet og Steam App ID\'et. Egg\'et falder tilbage til Pelicans egen fugl, og næste samlede gennemløb prøver igen.',
    'cleared' => 'Billede fjernet',

    // ---- udfald -----------------------------------------------------------
    'fetched' => 'Billede gemt',
    'failed' => 'Der blev ikke gemt noget billede',

    /*
     * En grund til hver, fordi det er forskellige problemer.
     *
     * En hentning, der faldt på en tastefejl, og en, der faldt, fordi disken er
     * fuld, skal ikke begge sige „mislykkedes" - den første klares ved at kigge
     * på tallet, den anden ved at kigge på serveren.
     */
    'why_bad_id' => 'Det er ikke et Steam App ID.',
    'why_not_found' => 'Steam har intet på den adresse. Tjek App ID\'et - et spil uden butiksside har heller ikke noget topbillede.',
    'why_no_match' => 'Der blev ikke fundet noget under det navn. Prøv med det, spillet faktisk hedder, frem for med egg\'ets navn.',
    'why_no_name' => 'Der er ikke noget at søge efter.',
    'why_no_token' => 'Twitch ville ikke udstede et token. Tjek client ID og secret under Legitimation.',
    'why_not_configured' => 'IGDB skal bruge et Twitch client ID og et secret. Sæt dem ind under Legitimation.',
    'why_empty' => 'Svaret var tomt.',
    'why_large' => 'Det billede er langt større end et ikon og blev ikke gemt.',
    'why_not_an_image' => 'Det, der kom tilbage, er ikke et billede. Det betyder som regel, at en fejlside svarede med en succeskode.',
    'why_wrong_format' => 'Det billede er i et format, dette panel ikke gemmer. Pelican beholder PNG, JPEG og WebP.',
    'why_unwritable' => 'Billedet kunne ikke skrives. Tjek, at storage/app/public tilhører den bruger, panelet kører som, og at php artisan storage:link er kørt.',
    'why_unknown' => 'Det virkede ikke, og grunden er ikke en, det her har et navn til.',

    // ---- det hele på én gang ----------------------------------------------
    'bulk' => 'Hent alle de manglende',
    'bulk_confirm_steam' => 'Søger på Steam efter navn for hvert egg, der ikke har et billede og ikke er låst. Låste eggs og eggs, der allerede har et billede, bliver ladt i fred. Det her kører i baggrunden - du får besked, når det er færdigt.',
    'bulk_confirm_both' => 'Søger på Steam efter navn for hvert egg, der ikke har et billede og ikke er låst, og prøver derefter IGDB for det, Steam ikke fandt. Låste eggs og eggs, der allerede har et billede, bliver ladt i fred. Det her kører i baggrunden - du får besked, når det er færdigt.',

    'bulk_started' => 'Henter i baggrunden',
    'bulk_started_body' => 'På et stort panel kan det tage adskillige minutter. Du får en besked, når det er gjort, og du kan forlade denne side.',

    'bulk_done' => 'Egg-billeder færdige',
    'bulk_done_body' => ':fetched hentet, :skipped ladt i fred, :failed uden fund. Et egg lades i fred, når det er låst eller allerede har et billede.',

    'bulk_failed' => 'Det samlede gennemløb kørte ikke',
    'bulk_failed_queue' => 'Det kunne ikke sendes videre til køen. Det kræver en queue worker - tjek, at pelican-queue kører.',

    // ---- IGDB-legitimation ------------------------------------------------
    'credentials' => 'Legitimation',
    'credentials_helper' => 'Steam virker helt uden det her. Disse oplysninger er kun til IGDB, som dækker de spil, Steam aldrig har hørt om - Minecraft og hver eneste afart af det, alt hvad der udkom på en konsol, de fleste eggs med mods.',
    'credentials_where' => 'Opret et program på dev.twitch.tv/console, generér et client secret, og sæt begge dele ind her. Det er gratis.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Legitimation gemt',
    'credentials_failed' => 'Legitimationen kunne ikke gemmes',
];
