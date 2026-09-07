<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Tie sisään ulkoa.
 *
 * Kahdenlaisia lukijoita yhdessä tiedostossa, ja he haluavat kumpikin eri
 * asian. Ylläpitäjä, joka lukee tätä sivua, on päättämässä uskaltaako hän
 * uskoa jollekulle avaimen, joten jokainen rivi täällä kertoo mihin avain
 * yltää eikä sitä mikä sen nimi on. Se, joka sellaista pyytää, haluaa tietää
 * mitä hän saa käteensä ja mitä tapahtuu jos hän kadottaa sen, ja siksi lause
 * siitä että avain näytetään vain kerran ei ole alaviite.
 *
 * Mikään täällä ei sano ”token”. ”Avain” on se sana Pelicanin omalla
 * tilisivulla, ja paneeli joka kutsuu samaa asiaa kahdella nimellä on paneeli
 * jossa joku etsii väärää.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Avaimia, joilla jokin paneelin ulkopuolinen voi kysyä sitä, minkä tämä lisäosa tietää. Vain luku — mikään täällä ei voi käynnistää, pysäyttää tai tavoittaa palvelinta.',

    'my_title' => 'API-pääsy',
    'my_nav_label' => 'API-pääsy',
    'my_subheading' => 'Oma avain, botille tai skriptille. Se vastaa vain niiden palvelinten osalta, jotka voit jo avata.',

    // ---- mitä avain on, sanottu kerran, siellä missä sillä on väliä ------
    'address' => 'Osoite',
    'address_helper' => 'Lähetä avain Authorization-otsakkeena: :example',

    /*
     * Se yksi asia, joka jonkun on täytynyt lukea ennen kuin ikkuna sulkeutuu.
     * Kirjoitettu siksi mitä pitää tehdä eikä varoitukseksi, koska ”pidä siitä
     * hyvää huolta” on neuvo, jonka mukaan kukaan ei voi toimia, ja ”liitä se
     * sinne missä botti sen lukee, nyt” on.
     */
    'once' => 'Tämä on ainoa kerta, kun tämä avain näytetään',
    'once_body' => 'Se tallennetaan tiivisteenä, joten kukaan — ei myöskään tätä paneelia pyörittävä — voi lukea sitä takaisin. Liitä se sinne, missä botti tai skripti sen lukee, nyt. Jos se katoaa, peruuta tämä ja pyydä uusi.',
    'copy' => 'Kopioi',
    'copied' => 'Kopioitu',

    // ---- tilat -----------------------------------------------------------
    'state' => 'Tila',
    'state_pending' => 'Odottaa',
    'state_active' => 'Aktiivinen',
    'state_refused' => 'Evätty',
    'state_revoked' => 'Peruutettu',

    'state_pending_body' => 'Jonkun on annettava lupa ennen kuin se vastaa mihinkään.',
    'state_refused_body' => 'Tähän sanottiin ei. Mitään ei myönnetty.',
    'state_revoked_body' => 'Tämä avain on otettu pois eikä se enää vastaa.',

    // ---- ulottuvuus ------------------------------------------------------
    'scope' => 'Ylettyy',
    'scope_person' => 'Omiin palvelimiinsa',
    'scope_panel' => 'Koko paneeliin',

    'scope_person_helper' => 'Vastaa vain niiden palvelinten osalta, jotka omistaja voi jo avata, kysyttynä samalla tavalla kuin paneeli kysyy. Tämän avaimen kadottaminen ei kadota mitään, mitä omistaja ei jo voisi nähdä.',
    'scope_panel_helper' => 'Vastaa niihin kysymyksiin, jotka koskevat koko paneelia — jokainen node, kapasiteetti, vahtikoira, paneelin oma isäntäkone. Botille, joka raportoi paneelista eikä henkilön puolesta.',

    // ---- taulukko --------------------------------------------------------
    'column_name' => 'Mihin',
    'column_owner' => 'Kenen',
    'column_prefix' => 'Avain',
    'column_asked' => 'Pyydetty',
    'column_used' => 'Viimeksi käytetty',
    'column_expires' => 'Vanhenee',

    'never_used' => 'Ei koskaan',
    'no_expiry' => 'Kunnes peruutetaan',

    'tab_waiting' => 'Odottaa',
    'tab_active' => 'Aktiiviset',
    'tab_all' => 'Kaikki',

    'empty' => 'Ei vielä avaimia',
    'empty_body' => 'Kukaan ei ole pyytänyt sellaista, eikä yhtäkään ole myönnetty. Tämä sivu täyttää itsensä sitä mukaa kuin ihmiset tekevät niin.',

    'my_empty' => 'Sinulla ei ole avainta',
    'my_empty_body' => 'Pyydä sellaista, niin se ilmestyy tähän sen vastauksen kanssa, jonka se sai.',

    // ---- pyytäminen ------------------------------------------------------
    'ask' => 'Pyydä avainta',
    'ask_name' => 'Mihin sitä käytetään',
    'ask_name_helper' => 'Pari sanaa, jotta erotat myöhemmin kaksi omaasi toisistaan ja jotta luvan antaja tietää, mihin hän antaa luvan.',
    'ask_reason' => 'Jotain lisäämisen arvoista',
    'ask_reason_helper' => 'Vapaaehtoinen. Sen lukee se, joka päättää.',
    'ask_sent' => 'Pyydetty',
    'ask_sent_body' => 'Se ilmestyy alle heti, kun joku on vastannut.',
    'ask_granted' => 'Tässä on avaimesi',
    'ask_open' => 'Sinulla on jo yksi vastausta odottamassa',
    'ask_open_body' => 'Yksi pyyntö kerrallaan. Peru se, jos se oli virhe.',
    'ask_failed' => 'Pyyntöä ei saatu tehtyä',

    'cancel' => 'Peru',
    'cancel_confirm' => 'Perii pyynnön. Mitään ei myönnetty, joten mikään ei myöskään lakkaa toimimasta.',

    // ---- päättäminen -----------------------------------------------------
    'grant' => 'Anna lupa',
    'grant_confirm' => 'Myöntää avaimen, joka vastaa tämän henkilön omien palvelinten osalta, ja näyttää sen kerran. Hän näkee jo kaiken, mitä se raportoi — tämä ratkaisee, saako jokin paneelin ulkopuolinen kysyä hänen puolestaan.',
    'granted' => 'Annettu',

    'refuse' => 'Epää',
    'refuse_answer' => 'Mitä heille kerrotaan',
    'refuse_answer_helper' => 'Vapaaehtoinen, ja näytetään heidän omalla sivullaan. Perusteeton epäys on sellainen, jota pyydetään uudelleen ensi viikolla.',
    'refused' => 'Evätty',

    'revoke' => 'Peruuta',
    'revoke_confirm' => 'Avain lakkaa vastaamasta heti, ja sen tiiviste poistetaan, joten sitä ei saa takaisin. Kaikki, mikä sitä käyttää, pysähtyy. Pyydä uusi sen sijaan, että perut tämän.',
    'revoked' => 'Peruutettu',

    'mint' => 'Uusi avain',
    'mint_body' => 'Botille eikä henkilölle. Se saa luvan samalla hetkellä kun se luodaan, sillä sinä olet se, joka olisi sanonut sille kyllä.',
    'mint_owner' => 'Kuka se on',
    'mint_owner_helper' => 'Avain vastaa jonakuna. Koko paneelia koskevalle avaimelle se on vain se, kuka siitä vastaa; henkilökohtaiselle se on myös se, mitä avain saa nähdä.',
    'minted' => 'Luotu',

    // ---- mitä ylläpitäjä asettaa -----------------------------------------
    'settings' => 'Näin tämä toimii',
    'approval' => 'Pyynnöt odottavat lupaa',
    'approval_helper' => 'Päällä avainta pyytävä saa sen, kun joku sanoo kyllä. Pois hän saa sen heti — mikä on järkevää paneelissa, jossa jokainen tilin haltija on jo luotettu, ja joka kannattaa valita eikä päätyä siihen.',
    'rate' => 'Pyyntöjä minuutissa, avainta kohti',
    'rate_helper' => 'Botti, joka kysyy neljältäkymmeneltä palvelimelta ketkä pelaavat, on neljäkymmentä kysymystä neljällekymmenelle pelipalvelimelle. Tämä on se katto, joka estää kolmelta yöllä kirjoitettua silmukkaa muuttumasta kuormitustestiksi.',
    'days' => 'Annettu avain kestää',
    'days_helper' => 'Päivinä. Nolla tarkoittaa kunnes peruutetaan, ja se on oletus — avain, joka vanhenee kenenkään katsomatta, on botti joka pysähtyy yöllä ilman että mikään kertoo miksi.',
    'days_never' => 'Kunnes peruutetaan',

    /*
     * Sanottu sivulla eikä jätetty löydettäväksi. Pelican peruu lisäosan
     * migraatiot, kun se poistetaan, ja tämän lisäosan ainoa taulu menee
     * mukana.
     */
    'uninstall_note' => 'Tämän lisäosan poistaminen poistaa jokaisen avaimen sen mukana. Se on tarkoituksellista — avain, joka elää pidempään kuin se, mikä siihen vastaa, on kirjautuminen jota kukaan ei voi perua.',
];
