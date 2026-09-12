<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Steam App ID”, ”IGDB”, ”Twitch client ID” ja ”client secret” jäävät
 * englanniksi: ne ovat täsmälleen ne sanat, jotka lukevat niillä sivuilla,
 * joilta arvot haetaan.
 */

return [
    'title' => 'Eggien kuvat',
    'nav_label' => 'Eggien kuvat',
    'subheading' => 'Pelikuvat eggeillesi, haettuna Steamista ja IGDB:stä. Egg ilman kuvaa näyttää Pelicanin oman linnun jokaisessa sitä käyttävässä palvelinkortissa.',

    // ---- taulukko --------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Lukittu',

    'locked' => 'Lukittu',
    'unlocked' => 'Auki',

    // ---- mitä yhdelle riville voi tehdä ----------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Numero pelin Steam-kaupan osoitteessa - store.steampowered.com/app/892970 on 892970. Tunnuksella hakeminen lukitsee kuvan, koska numeron kirjoittaminen on päätös eikä myöhempi massa-ajo saa kumota sitä.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Hae',
    'search_term_helper' => 'Eggin nimi on täytetty valmiiksi, mutta se on harvoin pelin nimi - ”Paper 1.20.4” on Minecraft. Kirjoita peli.',

    'lock' => 'Lukitse',
    'unlock' => 'Avaa lukitus',
    'locked_done' => 'Lukittu - massahaku jättää tämän rauhaan',
    'unlocked_done' => 'Lukitus avattu - massahaku saa korvata tämän kuvan',

    'clear' => 'Tyhjennä',
    'clear_confirm' => 'Poistaa kuvan ja Steam App ID:n. Egg palaa Pelicanin omaan lintuun, ja seuraava massahaku yrittää uudelleen.',
    'cleared' => 'Kuva poistettu',

    // ---- lopputulokset ---------------------------------------------------
    'fetched' => 'Kuva tallennettu',
    'failed' => 'Yhtään kuvaa ei tallennettu',

    /*
     * Yksi syy kullekin, koska ne ovat eri ongelmia.
     *
     * Kirjoitusvirheeseen kaatunut haku ja täyden levyn takia kaatunut haku
     * eivät saa molemmat sanoa ”epäonnistui” - ensimmäinen korjataan katsomalla
     * numeroa, toinen katsomalla palvelinta.
     */
    'why_bad_id' => 'Tuo ei ole Steam App ID.',
    'why_not_found' => 'Steamilla ei ole mitään siinä osoitteessa. Tarkista App ID - pelillä, jolla ei ole kauppasivua, ei ole otsikkokuvaakaan.',
    'why_no_match' => 'Sillä nimellä ei löytynyt mitään. Kokeile sitä, mikä pelin nimi oikeasti on, sen sijaan mikä eggin nimi on.',
    'why_no_name' => 'Ei ole mitään, mitä hakea.',
    'why_no_token' => 'Twitch ei suostunut antamaan tokenia. Tarkista client ID ja secret kohdasta Tunnukset.',
    'why_not_configured' => 'IGDB tarvitsee Twitchin client ID:n ja secretin. Aseta ne kohdassa Tunnukset.',
    'why_empty' => 'Vastaus oli tyhjä.',
    'why_large' => 'Se kuva on paljon kuvaketta suurempi eikä sitä tallennettu.',
    'why_not_an_image' => 'Se, mikä tuli takaisin, ei ole kuva. Se tarkoittaa yleensä, että virhesivu vastasi onnistumiskoodilla.',
    'why_wrong_format' => 'Se kuva on muodossa, jota tämä paneeli ei säilytä. Pelican pitää PNG:n, JPEG:n ja WebP:n.',
    'why_unwritable' => 'Kuvaa ei saatu kirjoitettua. Tarkista, että storage/app/public kuuluu sille käyttäjälle, jona paneeli ajaa, ja että php artisan storage:link on ajettu.',
    'why_unknown' => 'Se ei onnistunut, eikä syy ole sellainen, jolle tällä olisi nimi.',

    // ---- kaikki kerralla -------------------------------------------------
    'bulk' => 'Hae kaikki puuttuvat',
    'bulk_confirm_steam' => 'Hakee Steamista nimellä jokaiselle eggille, jolla ei ole kuvaa eikä lukitusta. Lukitut eggit ja eggit, joilla on jo kuva, jätetään rauhaan. Tämä ajetaan taustalla - saat tiedon, kun se on valmis.',
    'bulk_confirm_both' => 'Hakee Steamista nimellä jokaiselle eggille, jolla ei ole kuvaa eikä lukitusta, ja kokeilee sitten IGDB:tä sille, mitä Steam ei löytänyt. Lukitut eggit ja eggit, joilla on jo kuva, jätetään rauhaan. Tämä ajetaan taustalla - saat tiedon, kun se on valmis.',

    'bulk_started' => 'Haetaan taustalla',
    'bulk_started_body' => 'Tämä voi kestää useita minuutteja isolla paneelilla. Saat ilmoituksen, kun se on valmis, ja voit poistua tältä sivulta.',

    'bulk_done' => 'Eggien kuvat valmiit',
    'bulk_done_body' => ':fetched haettu, :skipped jätetty rauhaan, :failed ilman löytöä. Egg jätetään rauhaan, kun se on lukittu tai sillä on jo kuva.',

    'bulk_failed' => 'Massahakua ei ajettu',
    'bulk_failed_queue' => 'Sitä ei saatu annettua jonolle. Tämä vaatii queue workerin - tarkista, että pelican-queue on käynnissä.',

    // ---- IGDB-tunnukset --------------------------------------------------
    'credentials' => 'Tunnukset',
    'credentials_helper' => 'Steam toimii ilman mitään näistä. Nämä ovat vain IGDB:tä varten, joka kattaa ne pelit, joista Steam ei ole koskaan kuullut - Minecraftin ja jokaisen sen haaran, kaiken mikä on julkaistu konsolille, useimmat modatut eggit.',
    'credentials_where' => 'Luo sovellus osoitteessa dev.twitch.tv/console, generoi client secret, ja liitä molemmat tähän. Se on ilmaista.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Tunnukset tallennettu',
    'credentials_failed' => 'Tunnuksia ei saatu tallennettua',
];
