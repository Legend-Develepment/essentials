<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Pelitiloja ja vaikeustasoja ei käännetä. Minecraft näyttää ne pelin sisällä
 * nimillä Survival, Creative, Peaceful ja Hard — ja asetus, joka on eri
 * niminen kuin se ruutu, josta se tulee, on asetus jonka etsii kahdesti.
 *
 * Sama koskee niitä ilmauksia, jotka lukevat itse server.properties-tiedostossa:
 * whitelist, operator, seed, chunk, RCON, query, resource pack ja the Nether.
 */

return [
    /* ------------------------------------------------ ylläpitovälilehti -- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft-asetukset',
    'subheading' => 'Tämän palvelimen oma server.properties, lomakkeena tekstitiedoston sijaan.',

    /*
     * Itse otsikko ei ole täällä. Jokainen asetusosio ottaa otsikkonsa
     * kohdasta settings.groups.<nimi>, jonka group() rakentaa.
     */
    'section_helper' => 'Mitä eggejä se koskee, ja kaikki muu, mitä tämä lisäosa Minecraftin ympärillä tekee.',

    'live' => 'Kysy palvelimilta, ketkä pelaavat',
    'live_helper' => 'Lisää Pelaajat-sivulle elävän listan yhteydessä olevista, samalla kädenpuristuksella jolla Minecraft-asiakas piirtää palvelimen omaan listaansa. Pois oletuksena, koska se on täällä ainoa asia, joka avaa yhteyden paneelista suoraan pelin porttiin: jos paneelisi ja nodesi ovat verkoissa, jotka eivät tavoita toisiaan, mikään ei vastaa eikä rivi yksinkertaisesti ilmesty. Itse pelipalvelimella ei tarvitse laittaa mitään päälle.',

    'eggs' => 'Mitkä eggit ovat Minecraft',
    'eggs_helper' => 'Rastita ne eggit, jotka ajavat Minecraft-palvelinta — Vanilla, Paper, Purpur, Fabric, Forge, ja miksi omasi muuten onkaan nimetty. Sivu ilmestyy niitä käyttävien palvelinten sisään eikä minnekään muualle. Mitään ei ole rastitettu aluksi, ja se on tarkoituksella: lisäosa ei voi tietää, miksi olet eggisi nimennyt, ja arvattu lista olisi väärä jonkun paneelissa jo julkaisuviikollaan.',

    /* ---------------------------------------------------- palvelinsivu --- */

    'groups' => [
        'general' => 'Palvelin',
        'players' => 'Pelaajat',
        'world' => 'Maailma',
        'performance' => 'Suorituskyky',
        'access' => 'Pääsy ja lisät',
        'other' => 'Kaikki muu tiedostossa',
    ],

    'other_helper' => 'Luettu tiedostosta server.properties ja jätetty täsmälleen ennalleen. Modit ja modpackit lisäävät tänne omat asetuksensa; ne näytetään, jotta näet niiden olevan olemassa, ja niitä muutetaan tiedostonhallinnan kautta. Tämän sivun tallentaminen ei koske niihin koskaan.',

    'reload' => 'Lue tiedosto uudelleen',

    'saved' => 'Tallennettu tiedostoon server.properties',
    'saved_helper' => 'Se tulee voimaan, kun palvelin seuraavan kerran käynnistyy.',

    'running' => 'Palvelin on käynnissä',
    'running_helper' => 'Minecraft lukee server.properties-tiedoston käynnistyessään ja kirjoittaa sen takaisin pysähtyessään, joten nyt tallennettu ylikirjoitettaisiin ulos mentäessä. Pysäytä palvelin ja tallenna uudelleen.',

    'missing' => 'server.properties-tiedostoa ei löytynyt',
    'missing_helper' => 'Tiedosto ilmestyy, kun palvelin käynnistetään ensimmäisen kerran. Käynnistä se kerran, ja tule sitten takaisin.',

    'failed' => 'Tallennus ei onnistunut',
    'failed_helper' => 'Daemon torjui kirjoituksen. Palvelin on ehkä käynnistynyt, kun tämä sivu oli auki.',

    /* ------------------------------------- mitä kukin avain tarkoittaa --- */

    'keys' => [
        'motd' => 'Viesti palvelinlistalla',
        'gamemode' => 'Pelitila',
        'difficulty' => 'Vaikeustaso',
        'hardcore' => 'Hardcore — kuolema on lopullinen',
        'force_gamemode' => 'Palauta kaikki oletustilaan sisään tullessa',
        'pvp' => 'Pelaajat voivat vahingoittaa toisiaan',

        'max_players' => 'Enintään pelaajia yhtä aikaa',
        'white_list' => 'Vain whitelist',
        'enforce_whitelist' => 'Heitä ulos kaikki, jotka eivät ole whitelistillä',
        'online_mode' => 'Tarkista tilit Mojangilta',
        'player_idle_timeout' => 'Heitä ulos näin monen toimettoman minuutin jälkeen',
        'op_permission_level' => 'Mitä operator saa tehdä (1–4)',

        'level_name' => 'Maailmakansio',
        'level_seed' => 'Seed',
        'level_type' => 'Maailman tyyppi',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Hirviöitä ilmestyy',
        'spawn_protection' => 'Suojattuja lohkoja spawnin ympärillä',

        'view_distance' => 'Näkyvyysetäisyys chunkeina',
        'simulation_distance' => 'Simulointietäisyys chunkeina',
        'max_tick_time' => 'Watchdog, millisekunteina (-1 sammuttaa sen)',
        'sync_chunk_writes' => 'Kirjoita chunkit suoraan levylle',

        'enable_command_block' => 'Komentolohkot',
        'allow_flight' => 'Salli lentäminen',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Resource packin osoite',
        'require_resource_pack' => 'Resource pack vaaditaan',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
