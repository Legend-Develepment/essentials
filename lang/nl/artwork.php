<?php

/*
 * Spelafbeeldingen voor eggs, van Steam en IGDB.
 *
 * Zie Support\Artwork voor waar de twee gegevens per egg blijven, en waarom in
 * tags.
 */

return [
    'title' => 'Egg-afbeeldingen',
    'nav_label' => 'Egg-afbeeldingen',
    'subheading' => 'Spelafbeeldingen voor je eggs, opgehaald bij Steam en IGDB. Een egg zonder afbeelding toont op elke serverkaart de vogel van Pelican zelf.',

    // ---- de tabel --------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Vast',

    'locked' => 'Vast',
    'unlocked' => 'Vrij',

    // ---- wat je met één rij kunt doen ------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Het nummer in het Steam-winkeladres van een spel — store.steampowered.com/app/892970 is 892970. Ophalen op id zet de afbeelding vast, want een nummer intypen is een keuze en een latere bulkronde mag die niet ongedaan maken.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Zoeken op',
    'search_term_helper' => 'De naam van de egg staat er alvast in, maar dat is zelden hoe het spel heet — "Paper 1.20.4" is Minecraft. Typ het spel.',

    'lock' => 'Vastzetten',
    'unlock' => 'Vrijgeven',
    'locked_done' => 'Vastgezet — een bulkronde laat deze met rust',
    'unlocked_done' => 'Vrijgegeven — een bulkronde mag deze afbeelding vervangen',

    'clear' => 'Wissen',
    'clear_confirm' => 'Haalt de afbeelding en de Steam App ID weg. De egg valt terug op de vogel van Pelican, en de volgende bulkronde probeert het opnieuw.',
    'cleared' => 'Afbeelding verwijderd',

    // ---- uitkomsten ------------------------------------------------------
    'fetched' => 'Afbeelding opgeslagen',
    'failed' => 'Er is geen afbeelding opgeslagen',

    /*
     * Eén reden per geval, want het zijn verschillende problemen. Een mislukking
     * door een typefout en een door een volle schijf horen niet allebei "mislukt"
     * te zeggen — de eerste los je op door naar het nummer te kijken, de tweede
     * door naar de server te kijken.
     */
    'why_bad_id' => 'Dat is geen Steam App ID.',
    'why_not_found' => 'Steam heeft niets op dat adres. Controleer de App ID — een spel zonder winkelpagina heeft ook geen kopafbeelding.',
    'why_no_match' => 'Onder die naam is niets gevonden. Probeer hoe het spel echt heet in plaats van hoe de egg heet.',
    'why_no_name' => 'Er valt niets te zoeken.',
    'why_no_token' => 'Twitch wilde geen token geven. Controleer de client-ID en het secret onder Inloggegevens.',
    'why_not_configured' => 'IGDB heeft een Twitch client-ID en secret nodig. Zet die onder Inloggegevens.',
    'why_empty' => 'Het antwoord was leeg.',
    'why_large' => 'Die afbeelding is veel groter dan een icoon en is niet opgeslagen.',
    'why_not_an_image' => 'Wat terugkwam is geen afbeelding. Meestal betekent dat een foutpagina met een succescode erop.',
    'why_wrong_format' => 'Die afbeelding heeft een formaat dat dit panel niet bewaart. Pelican houdt PNG, JPEG en WebP.',
    'why_unwritable' => 'De afbeelding kon niet worden weggeschreven. Controleer of storage/app/public van de gebruiker is waaronder het panel draait, en of php artisan storage:link is gedraaid.',
    'why_unknown' => 'Het lukte niet, en de reden heeft hier geen naam.',

    // ---- alles tegelijk --------------------------------------------------
    'bulk' => 'Alles ophalen wat ontbreekt',
    'bulk_confirm_steam' => 'Zoekt op Steam op naam voor elke egg zonder afbeelding die niet vastgezet is. Vastgezette eggs en eggs die al een afbeelding hebben blijven met rust. Dit draait op de achtergrond — je krijgt bericht als het klaar is.',
    'bulk_confirm_both' => 'Zoekt op Steam op naam voor elke egg zonder afbeelding die niet vastgezet is, en probeert daarna IGDB voor wat Steam niet vond. Vastgezette eggs en eggs die al een afbeelding hebben blijven met rust. Dit draait op de achtergrond — je krijgt bericht als het klaar is.',

    'bulk_started' => 'Bezig op de achtergrond',
    'bulk_started_body' => 'Op een groot panel kan dit een paar minuten duren. Je krijgt een melding als het klaar is, en je kunt deze pagina gewoon verlaten.',

    'bulk_done' => 'Egg-afbeeldingen klaar',
    'bulk_done_body' => ':fetched opgehaald, :skipped met rust gelaten, :failed waarvoor niets gevonden is. Een egg wordt met rust gelaten als hij vastgezet is of al een afbeelding heeft.',

    'bulk_failed' => 'De bulkronde is niet gestart',
    'bulk_failed_queue' => 'Hij kon niet aan de wachtrij worden gegeven. Hiervoor is een queue worker nodig — controleer of pelican-queue draait.',

    // ---- IGDB-inloggegevens ----------------------------------------------
    'credentials' => 'Inloggegevens',
    'credentials_helper' => 'Steam werkt zonder dit alles. Dit is alleen voor IGDB, dat de spellen dekt waar Steam nooit van gehoord heeft — Minecraft en elke fork ervan, alles wat op een console uitkwam, de meeste modded eggs.',
    'credentials_where' => 'Maak een applicatie op dev.twitch.tv/console, genereer een client secret, en plak beide hier. Het is gratis.',
    'client_id' => 'Twitch client-ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Inloggegevens opgeslagen',
    'credentials_failed' => 'De inloggegevens konden niet worden opgeslagen',
];
