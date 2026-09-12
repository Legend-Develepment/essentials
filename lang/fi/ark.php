<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”GameUserSettings.ini” ja ”Startup” kirjoitetaan niin kuin ne pelissä ja
 * Pelicanissa lukevat - ne ovat ne nimet, joita etsitään.
 */

return [
    /* ------------------------------------------------ ylläpitovälilehti -- */

    /*
     * Itse otsikko ei ole täällä. Jokainen asetusosio ottaa otsikkonsa
     * kohdasta settings.groups.<nimi>, jonka group() rakentaa.
     */
    'section_helper' => 'Mitkä eggit ajavat ARKia. Ei muuta - loput ARK-palvelimesta asetetaan sen käynnistysmuuttujilla, ja Pelicanin oma Startup-sivu muokkaa jo niitä.',

    'eggs' => 'Mitkä eggit ovat ARK',
    'eggs_helper' => 'Rastita ne eggit, jotka ajavat ARK-palvelinta. Maailma-asetusten sivu ilmestyy niitä käyttävien palvelinten sisään eikä minnekään muualle. Tämä on eri kysymys kuin tilasivun vastaava: se kysyy, mitkä eggit vastaavat Valven kyselyyn, mitä Rust ja Valheim tekevät myös, ja tämä kysyy, mitkä eggit pitävät GameUserSettings.ini-tiedostoa siellä, missä ARK sen pitää, mitä vain ARK tekee. Mitään ei ole rastitettu aluksi, tarkoituksella - lisäosa ei voi tietää, miksi olet eggisi nimennyt.',

    /* --------------------------------------------------- palvelimen sivu - */

    'nav_label' => 'Maailma-asetukset',
    'title' => 'ARKin maailma-asetukset',
    'subheading' => 'Ne asetukset, joita ihmiset oikeasti muuttavat, tiedostosta GameUserSettings.ini.',

    'group_server' => 'Palvelin',
    'group_server_helper' => 'Mikä palvelimen nimi on, ketkä saavat liittyä, ja kuinka monta.',
    'group_rates' => 'Kertoimet',
    'group_rates_helper' => 'Kuinka nopeasti asiat tapahtuvat. 1.0 on peli sellaisena kuin se tulee; 2.0 on kaksi kertaa nopeampi.',
    'group_rules' => 'Säännöt',
    'group_rules_helper' => 'Mitä pelaajat saavat tehdä ja mitä peli heille näyttää.',

    'keeps' => 'Viisitoista asetusta tiedostosta, jossa niitä on satoja. Kaikki muu siinä - mod-asetuksesi, avaimet joista tämä lisäosa ei ole koskaan kuullut, kommentit ja kaiken järjestys - jätetään täsmälleen ennalleen, kun tallennat.',
    'missing' => 'Tällä palvelimella ei ole vielä GameUserSettings.ini-tiedostoa. Peli kirjoittaa sen ensimmäisellä ajokerralla, joten käynnistä palvelin kerran, niin tämä sivu täyttyy.',
    'read_only' => 'Saat lukea tätä tiedostoa mutta et kirjoittaa sitä, joten mitään täällä ei voi muuttaa.',

    'save' => 'Tallenna',
    'saved' => 'Tallennettu',
    'saved_restart' => 'ARK lukee tämän tiedoston käynnistyessään, joten käynnistä palvelin uudelleen, jotta muutos tulee voimaan.',
    'failed' => 'Tallennus ei onnistunut',
    'failed_write' => 'Daemon torjui kirjoituksen. Tarkista, että palvelin on tavoitettavissa ja ettei tiedosto ole kirjoitussuojattu.',
];
