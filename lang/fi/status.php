<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Julkinen tilasivu.
 *
 * Ainoa, mitä tämä lisäosa tarjoilee jollekulle, joka ei ole kirjautunut, ja
 * ainoa sivu, jonka sanat on luettava niin kuin vieras ne näkisi - sillä
 * sellainen ne näkee. Mikään täällä ei kerro, mikä node, mikä omistaja tai mikä
 * osoite; nimi, ajaako se, ja montako on paikalla.
 *
 * ”Node” esiintyy vain asetuksissa; itse julkisella sivulla lukee ”kone”, sillä
 * siellä sen lukee joku, joka ei ole koskaan kuullut Pelicanista.
 */

return [
    // ---- asetussivu --------------------------------------------------------
    'title' => 'Julkinen tilasivu',
    'nav_label' => 'Tilasivu',
    'subheading' => 'Sivu, jonka kuka tahansa voi avata ilman tiliä ja joka näyttää, mitkä palvelimistasi ovat käynnissä. Sille ei ilmesty mitään, ennen kuin mainitset alla palvelimen.',

    'address' => 'Tilasivusi on osoitteessa',
    'address_off' => 'Mitään ei vielä tarjoilla. Lisää alle palvelin, kone tai palvelu ja tallenna, niin osoite ilmestyy tähän.',

    'which' => 'Mitä julkaistaan',
    'which_helper' => 'Lista alkaa tyhjänä, eikä mikään ole julkista ennen kuin sillä on jotain. Vain palvelimia, jotka voit jo avata, tarjotaan.',
    'add' => 'Julkaise palvelin',
    'server' => 'Palvelin',
    'shown_as' => 'Näytetään nimellä',
    'shown_as_helper' => 'Se, minkä yleisö näkee. Kirjoita se itse sen sijaan, että antaisit paneelin käyttää oikeaa nimeä - ”mc-prod-3 (älä koske)” on muistilappu itsellesi, ei jotain, mitä laitetaan foorumille.',

    'look' => 'Sanamuoto',
    'look_helper' => 'Kaiken tällä sivulla lukevat ihmiset, joilla ei ole tiliä.',
    'heading' => 'Otsikko',
    'heading_helper' => 'Jos tyhjä, käytetään paneelin omaa nimeä.',
    'note' => 'Rivi listan yläpuolella',
    'note_helper' => 'Kertomaan mitä on meneillään - huoltoikkuna, tai mistä voi kysyä. Tavallista tekstiä.',
    'link' => 'Linkki paneeliin',
    'link_helper' => 'Tie takaisin sisään, sivun alareunassa. Sammuta se, jos et mieluusti paljasta, missä paneelisi on.',

    'save' => 'Tallenna',
    'saved' => 'Tallennettu',
    'save_failed' => 'Mitään ei tallennettu',
    'open' => 'Avaa sivu',

    // ---- pelaajaluvut ------------------------------------------------------
    'counts' => 'Pelaajaluvut',
    'counts_helper' => 'Mistä palvelimen vieressä olevat luvut tulevat. Minecraft-palvelimet vastaavat omaan kädenpuristukseensa ja asetetaan kohdassa Minecraft; kaikki alla oleva koskee niitä pelejä, jotka vastaavat Valven kyselyyn - Rust, ARK, Valheim, 7 Days to Die ja useimmat muut, jotka ajavat Sourcella tai Unrealilla.',
    'query_eggs' => 'Eggit, jotka vastaavat Valven kyselyyn',
    'query_eggs_helper' => 'Rastita noiden pelien eggit. Sama lista ratkaisee myös sen, mitkä palvelimet saavat Pelaajat-sivun paneelin sisään - yksi kysymys kahdesta syystä. Mitään ei kysytä ennen kuin sanot: tämä on täällä ainoa asia, joka avaa yhteyden paneelista suoraan pelin porttiin, joten se on valinta eikä jotain, mikä alkaa itsestään. Palvelin, jonka porttia paneeli ei tavoita, ei yksinkertaisesti näytä lukuja.',

    // ---- nodet -------------------------------------------------------------
    'nodes' => 'Koneet',
    'nodes_helper' => 'Ylhäällä tai alhaalla, eikä mitään muuta. Ei kuormaa eikä sitä, kuinka täysi levy on - se, joka kysyy pääseekö pelaamaan, ei tarvitse kapasiteettiraporttia raudastasi, ja sellaisen julkaiseminen on kartta siitä, missä on tiukkaa.',
    'add_node' => 'Julkaise kone',
    'node' => 'Kone',
    'node_shown_as_helper' => 'Kirjoita se itse. Node on yleensä nimeltään jotain tyyliin hetzner-fsn1-01, ja se on kokonainen lause siitä, missä koneesi ovat.',

    // ---- HTTP-valvonnat ----------------------------------------------------
    'monitors' => 'Muut palvelut',
    'monitors_helper' => 'Kaikki muu, minkä tietäminen ylhäällä olevaksi kannattaa: verkkosivustosi, API, botin health-päätepiste. Paneeli kysyy kultakin samaan tahtiin kuin palvelimilta. Vain ylläpitäjät - valvonta saa tämän paneelin hakemaan osoitteen, ja jos kuka tahansa saa lisätä sellaisen, siitä tulee luotain, jonka voi osoittaa minne haluaa.',
    'add_monitor' => 'Lisää palvelu',
    'monitor_name' => 'Nimi',
    'monitor_url' => 'Osoite',
    'monitor_url_helper' => 'Vain https. Jos tämä paneeli hakisi tavallista http:tä säännöllisin väliajoin, kaikki matkan varrella tietäisivät, mitkä palvelusi ovat olemassa.',
    'monitor_expect' => 'Odottaa',
    'monitor_expect_helper' => 'Jätä tyhjäksi tarkoittamaan ”mikä tahansa vastaus”, mikä sopii sivustolle, joka uudelleenohjaa tai vastaa 403 paljaaseen pyyntöön. Numero on sellaiselle päätepisteelle, joka on kirjoitettu sanomaan täsmälleen se eikä mitään muuta - liian tiukalle asetettuna rivi on ikuisesti punainen palvelulla, jossa ei ole mitään vikaa.',

    // ---- sivut käyttäjille -------------------------------------------------
    'users' => 'Sivut käyttäjillesi',
    'users_helper' => 'Saavatko ihmiset, joilla on palvelimia tässä paneelissa, julkaista oman tilasivunsa.',
    'user_pages' => 'Anna käyttäjien tehdä oma',
    'user_pages_helper' => 'Kukin saa oman osoitteensa polussa /status/heidän-nimensä, jossa ovat vain heidän omistamansa palvelimet, niillä nimillä jotka he itse kirjoittavat. Ei koneita eikä muita palveluja niissä - molemmat ovat yksin sinun. Kun tämä on päällä, he löytävät sen kohdasta Tilasivu tilivalikostaan, missä paneelissa sitten ovatkin.',

    // ---- ulkoasu -----------------------------------------------------------
    'every' => 'Tarkista joka',
    'every_helper' => 'Kuinka usein sivu rakennetaan uudelleen, ja kuinka usein se päivittää itsensä selaimessa. Sivu, jota ihmiset katsovat uudelleenkäynnistyksen aikana, haluaa sekunteja; sellainen, joka on linkitetty foorumilta eikä kenelläkään ole auki, haluaa tunnin, ja jokaisen noden kysyminen joka minuutti sen vuoksi on työtä, joka tehdään kenellekään.',
    'every_realtime' => 'Reaaliaika (10 sekuntia)',
    'every_30s' => '30 sekuntia',
    'every_1m' => '1 minuutti',
    'every_5m' => '5 minuuttia',
    'every_10m' => '10 minuuttia',
    'every_30m' => '30 minuuttia',
    'every_60m' => '60 minuuttia',

    'style' => 'Tyyli',
    'style_helper' => 'Yksi paneelin omista ulkoasuista, sovellettuna tälle sivulle: sen väri, sen pinnasta rakennetut harmaasävyt, ja kuinka pyöreitä kulmat ovat. ”Seuraa paneelia” tarkoittaa sitä, mikä on tänään asetettu, mukaan lukien kaikki myöhemmin muuttuva.',
    'style_mine_helper' => 'Ne tyylit, joita tämä paneeli tarjoaa, sovellettuna sivullesi: väri, siitä rakennetut harmaasävyt, ja kuinka pyöreitä kulmat ovat. Sen, mitkä tyylit listalla ovat, päättää paneelin omistaja - sama lista, josta voit valita kohdassa Ulkoasu. ”Seuraa paneelia” tarkoittaa sitä, mikä on asetettu.',
    'style_panel' => 'Seuraa paneelia',

    // ---- oma sivu ----------------------------------------------------------
    'mine_title' => 'Minun tilasivuni',
    'mine_nav_label' => 'Tilasivu',
    'mine_subheading' => 'Yksi osoite annettavaksi niille ihmisille, jotka pelaavat palvelimillasi. Se näyttää valitsemasi palvelimet eikä mitään muuta tästä paneelista.',
    'mine_address' => 'Osoitteesi',
    'mine_address_helper' => 'Valitse jotain lyhyttä. Sen muuttaminen myöhemmin rikkoo jokaisen linkin, jonka joku on jo tallentanut.',
    'mine_address_off' => 'Valitse alta osoite ja tallenna, niin sivusi ilmestyy tähän.',
    'slug' => 'Osoite',
    'slug_helper' => 'Pieniä kirjaimia, numeroita ja väliviivoja. Kolme merkkiä tai enemmän.',
    'mine_heading' => 'Otsikko',
    'mine_heading_helper' => 'Jos tyhjä, käytetään osoitettasi.',
    'mine_note_helper' => 'Kertomaan mitä on meneillään - uudelleenkäynnistys, tapahtuma, mistä sinut löytää. Tavallista tekstiä, ja sen lukevat kaikki, joilla on linkki.',
    'mine_which' => 'Palvelimesi',
    'mine_which_helper' => 'Vain itse omistamiasi palvelimia tarjotaan. Subuserina oleminen jossain muualla on pääsy koneelle, ei lupa julkaista sen olemassaoloa.',
    'mine_shown_as_helper' => 'Se, minkä kävijät näkevät. Kirjoita se itse sen sijaan, että käyttäisit paneelin nimeä, jos se nimi on muistilappu itsellesi.',
    'mine_look_helper' => 'Miltä sivusi näyttää niille, joille sen lähetät.',
    'mine_remove' => 'Ota sivuni alas',
    'mine_remove_confirm' => 'Ottaa sivusi alas ja vapauttaa osoitteen jollekulle muulle. Kaikki asettamasi menetetään; itse palvelimiin ei kosketa.',
    'mine_removed' => 'Sivusi on otettu alas',

    'why_slug' => 'Tuo osoite ei kelpaa. Pieniä kirjaimia, numeroita ja väliviivoja, kolme merkkiä tai enemmän - ja pari sanaa on varattu.',
    'why_taken' => 'Tuo osoite on jo jollakulla toisella.',
    'why_unwritable' => 'Sitä ei saatu kirjoitettua. Tarkista, että storage/app kuuluu sille käyttäjälle, jona paneeli ajaa.',

    // ---- otsikot itse sivulla ----------------------------------------------
    'section_servers' => 'Palvelimet',
    'section_nodes' => 'Koneet',
    'section_monitors' => 'Palvelut',

    // ---- itse sivu ---------------------------------------------------------
    'up' => 'Ylhäällä',
    'down' => 'Alhaalla',
    'starting' => 'Käynnistyy',

    /*
     * Ei ”alhaalla”, ja ero on julkisesti merkittävä.
     *
     * Paneeli ei tavoittanut palvelinta. Se on yleensä huollossa oleva node tai
     * uudelleen käynnistyvä daemon - se ei ole sama asia kuin että palvelin
     * olisi sammutettu, ja sadan pelaajan kertominen palvelimensa olevan
     * alhaalla sen ollessa käynnissä on pahempaa kuin myöntää, ettei tiedä.
     */
    'unknown' => 'Ei tiedossa',

    'players' => 'Pelaajat',
    'online_now' => 'pelaa juuri nyt',
    'checked' => 'Tarkistettu',
    'next_check' => 'seuraavaan tarkistukseen',
    'just_now' => 'juuri äsken',
    'seconds_ago' => ':count sekuntia sitten',
    'panel' => 'Kirjaudu sisään',

    'all_up' => 'Kaikki on käynnissä.',
    'some_down' => 'Jokin ei ole käynnissä.',
    'empty' => 'Täällä ei julkaista vielä mitään.',
];
