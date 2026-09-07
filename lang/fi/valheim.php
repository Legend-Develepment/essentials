<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”SteamID64” ja ”PlayFab ID” kirjoitetaan täsmälleen niin kuin ne on kirjoitettu
 * niissä paikoissa, joista ne haetaan. ”Admin” jää sekin paikalleen: se on
 * pelin oman tiedoston sana.
 */

return [
    /* ------------------------------------------------ ylläpitovälilehti -- */

    'section_helper' => 'Mitkä eggit ajavat Valheimia. Ei muuta — Valheim-palvelin asetetaan käynnistysmuuttujillaan, ja Pelicanin oma Startup-sivu muokkaa jo niitä.',

    'eggs' => 'Mitkä eggit ovat Valheim',
    'eggs_helper' => 'Rastita ne eggit, jotka ajavat Valheim-palvelinta. Pelaajalistat-sivu ilmestyy niitä käyttävien palvelinten sisään eikä minnekään muualle. Se, missä listat sijaitsevat, eroaa eggeittäin, joten se päätellään palvelinkohtaisesti katsomalla niistä paikoista, joita peli käyttää. Mitään ei ole rastitettu aluksi, tarkoituksella — lisäosa ei voi tietää, miksi olet eggisi nimennyt.',

    /* --------------------------------------------------- palvelimen sivu - */

    'nav_label' => 'Pelaajalistat',
    'title' => 'Valheimin pelaajalistat',
    'subheading' => 'Adminit, bannit ja sallittujen lista, kolmena listana kolmen tekstitiedoston sijaan.',

    'admin' => 'Adminit',
    'admin_helper' => 'Kaikki täällä voivat käyttää adminkomentoja pelissä.',
    'banned' => 'Bannatut',
    'banned_helper' => 'Kaikki täällä torjutaan, kun he yrittävät liittyä.',
    'permitted' => 'Sallitut',
    'permitted_helper' => 'Jos tällä listalla on ketään, vain he saavat liittyä. Tyhjä lista päästää kaikki sisään — mitä useimmat palvelimet haluavat, joten jätä se tyhjäksi ellet tarkoita muuta.',

    'ids' => 'Pelaajatunnukset',
    'ids_placeholder' => 'Liitä tunnus ja paina välilyöntiä',

    'how' => 'Yksi tunnus pelaajaa kohti — SteamID64 Steam-palvelimella, PlayFab ID crossplay-palvelimella. Liitä ne ja paina välilyöntiä, sarkainta tai pilkkua. Kaikki, mitä peli kirjoitti kommentiksi listan yläpuolelle, jää paikalleen.',
    'where' => 'Luettu hakemistosta :dir.',
    'missing' => 'Tällä palvelimella ei ole vielä yhtäkään näistä tiedostoista. Peli kirjoittaa ne, kun se niitä ensi kerran tarvitsee, ja täällä tallentaminen luo ne, jotka täytät.',
    'read_only' => 'Saat lukea näitä tiedostoja mutta et kirjoittaa niitä, joten mitään täällä ei voi muuttaa.',

    'save' => 'Tallenna',
    'saved' => 'Tallennettu',
    'saved_reload' => 'Valheim lukee nämä listat ajon aikana, joten muutos tulee voimaan ilman uudelleenkäynnistystä.',
    'unchanged' => 'Mikään ei ollut muuttunut, joten mitään ei kirjoitettu',
    'failed' => 'Tallennus ei onnistunut',
    'failed_lists' => 'Daemon torjui kirjoituksen näille: :lists. Tarkista, että palvelin on tavoitettavissa ja etteivät tiedostot ole kirjoitussuojattuja.',
];
