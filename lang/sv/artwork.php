<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Steam App ID», «IGDB», «Twitch client ID» och «client secret» står kvar på
 * engelska: det är exakt de ord som står på de sidor värdena kommer från.
 */

return [
    'title' => 'Egg-bilder',
    'nav_label' => 'Egg-bilder',
    'subheading' => 'Spelbilder till dina eggs, hämtade från Steam och IGDB. Ett egg utan bild visar Pelicans egen fågel på varje serverkort som använder det.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Låst',

    'locked' => 'Låst',
    'unlocked' => 'Öppet',

    // ---- vad man kan göra med en rad -------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Numret i ett spels adress i Steams butik — store.steampowered.com/app/892970 är 892970. Att hämta på id låser bilden, för att skriva in ett nummer är ett beslut, och en senare massköring får inte göra det ogjort.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Sök efter',
    'search_term_helper' => 'Eggets namn är ifyllt, men det är sällan vad spelet heter — «Paper 1.20.4» är Minecraft. Skriv spelet.',

    'lock' => 'Lås',
    'unlock' => 'Lås upp',
    'locked_done' => 'Låst — en masshämtning lämnar den här i fred',
    'unlocked_done' => 'Upplåst — en masshämtning får byta ut den här bilden',

    'clear' => 'Rensa',
    'clear_confirm' => 'Tar bort bilden och Steam App ID:t. Egget går tillbaka till Pelicans egen fågel, och nästa masshämtning försöker igen.',
    'cleared' => 'Bilden borttagen',

    // ---- utfall ----------------------------------------------------------
    'fetched' => 'Bilden sparad',
    'failed' => 'Ingen bild sparades',

    /*
     * En anledning var, för det är skilda problem.
     *
     * En hämtning som gick fel på ett skrivfel och en som gick fel för att
     * disken är full ska inte båda säga «misslyckades» — det första löses genom
     * att titta på numret, det andra genom att titta på servern.
     */
    'why_bad_id' => 'Det är inte ett Steam App ID.',
    'why_not_found' => 'Steam har ingenting på den adressen. Kontrollera App ID:t — ett spel utan butikssida har ingen headerbild heller.',
    'why_no_match' => 'Ingenting hittades under det namnet. Prova vad spelet faktiskt heter i stället för vad egget heter.',
    'why_no_name' => 'Det finns ingenting att söka efter.',
    'why_no_token' => 'Twitch ville inte utfärda en token. Kontrollera client ID och secret under Uppgifter.',
    'why_not_configured' => 'IGDB behöver ett Twitch client ID och en secret. Ställ in dem under Uppgifter.',
    'why_empty' => 'Svaret var tomt.',
    'why_large' => 'Den bilden är långt större än en ikon och sparades inte.',
    'why_not_an_image' => 'Det som kom tillbaka är ingen bild. Det betyder oftast att en felsida svarade med en lyckad kod.',
    'why_wrong_format' => 'Den bilden är i ett format den här panelen inte lagrar. Pelican behåller PNG, JPEG och WebP.',
    'why_unwritable' => 'Bilden kunde inte skrivas. Kontrollera att storage/app/public tillhör den användare panelen kör som, och att php artisan storage:link har körts.',
    'why_unknown' => 'Det gick inte, och anledningen är inte en som det här har ett namn på.',

    // ---- allt på en gång -------------------------------------------------
    'bulk' => 'Hämta alla som saknas',
    'bulk_confirm_steam' => 'Söker på Steam efter namn för varje egg som saknar bild och inte är låst. Låsta eggs och eggs som redan har en bild lämnas i fred. Det här körs i bakgrunden — du får veta när det är klart.',
    'bulk_confirm_both' => 'Söker på Steam efter namn för varje egg som saknar bild och inte är låst, och provar sedan IGDB för det Steam inte kunde hitta. Låsta eggs och eggs som redan har en bild lämnas i fred. Det här körs i bakgrunden — du får veta när det är klart.',

    'bulk_started' => 'Hämtar i bakgrunden',
    'bulk_started_body' => 'Det kan ta flera minuter på en stor panel. Du får en avisering när det är klart, och du kan lämna den här sidan.',

    'bulk_done' => 'Egg-bilderna klara',
    'bulk_done_body' => ':fetched hämtade, :skipped lämnade i fred, :failed utan att något hittades. Ett egg lämnas i fred när det är låst eller redan har en bild.',

    'bulk_failed' => 'Masshämtningen kördes inte',
    'bulk_failed_queue' => 'Den kunde inte lämnas till kön. Det här kräver en queue worker — kontrollera att pelican-queue kör.',

    // ---- IGDB-uppgifter --------------------------------------------------
    'credentials' => 'Uppgifter',
    'credentials_helper' => 'Steam fungerar utan något av det här. De här behövs bara för IGDB, som täcker de spel Steam aldrig har hört talas om — Minecraft och varenda avknoppning av det, allt som kom ut på en konsol, de flesta moddade eggs.',
    'credentials_where' => 'Skapa en applikation på dev.twitch.tv/console, generera en client secret, och klistra in båda här. Det är gratis.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Uppgifterna sparade',
    'credentials_failed' => 'Uppgifterna kunde inte sparas',
];
