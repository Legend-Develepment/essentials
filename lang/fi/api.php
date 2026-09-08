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
    'collect' => 'Näytä avaimeni',
    'state_ready_body' => 'Myönnetty. Paina Näytä avaimeni nähdäksesi sen — kerran, sillä se on tallennettu tiivisteenä eikä sitä voi jälkeenpäin lukea takaisin.',
    'replace' => 'Korvaa',
    'replace_confirm' => 'Tämä avain lakkaa toimimasta heti ja uusi tulee sen tilalle, näytettynä kerran. Vanhaa ei ole mistään haettavissa — sitä ei koskaan tallennettu — joten korvaaminen on ainoa vastaus siihen, että se on kadonnut.',
    'granted_body' => 'Hän hakee sen itse omalta API-pääsy-sivultaan. Sitä ei näytetä täällä: avain kuuluu sille, joka sitä pyysi, eikä sille, joka sanoi kyllä.',

    'revoke' => 'Peruuta',
    'revoke_confirm' => 'Avain lakkaa vastaamasta heti, ja sen tiiviste poistetaan, joten sitä ei saa takaisin. Kaikki, mikä sitä käyttää, pysähtyy. Pyydä uusi sen sijaan, että perut tämän.',
    'revoked' => 'Peruutettu',
    'forget' => 'Poista',
    'forget_confirm' => 'Ottaa rivin pois tältä sivulta lopullisesti. Se on jo lakannut vastaamasta, joten mikään toimiva ei pysähdy - tämä poistaa vain merkinnän siitä, että se oli olemassa.',
    'forgotten' => 'Poistettu',

    'mint' => 'Uusi avain',
    'mint_body' => 'Botille eikä henkilölle. Se saa luvan samalla hetkellä kun se luodaan, sillä sinä olet se, joka olisi sanonut sille kyllä.',
    'abilities' => 'Mitä se saa kysyä',
    'abilities_helper' => 'Kaikki on aluksi valittuna, koska sitä avain oli ennen kuin tämä oli olemassa. Valinnan poistaminen on se tietoinen teko. Talletettuna on sallittujen lista, joten myöhemmässä julkaisussa lisätty oikeus on pois päältä sitä ennen tehdyillä avaimilla - oikeus, jota kukaan ei valinnut, on oikeus jota kukaan ei antanut.',
    'ability_health' => 'Todista että avain toimii',
    'ability_health_helper' => 'Ei ylety mihinkään muuhun. Turvallista kutsua ajastetusti.',
    'ability_me' => 'Omat palvelimensa',
    'ability_me_helper' => 'Ne palvelimet, jotka sen omistaja voi jo avata, ja niiden varmuuskopiot. Se ei voi koskaan nähdä ketään muuta.',
    'ability_panel' => 'Koko paneeli',
    'ability_panel_helper' => 'Jokainen node, jokainen varmuuskopio, pysähtyneet ajastukset, vahtikoira ja paneelin isäntäkone. Vaatii myös koko paneelia koskevan avaimen.',
    'ability_live' => 'Kysy suoraan palvelimelta',
    'ability_live_helper' => 'Ketkä pelaavat ja käykö palvelin. Ainoat kysymykset, jotka maksavat jotain — ne tavoittavat pelipalvelimen tai daemonin, välimuistissa viidestätoista kahteenkymmeneen sekuntia.',
    'ability_connect' => 'Yhdistä Discord-tilit paneelin tileihin',
    'ability_connect_helper' => 'Ainoa ryhmä, joka ei ole lukemista. Se luo Pelican-API-avaimia niiden ihmisten tileille, jotka sitä pyytävät, ja voi katkaista yhteyden. Anna se vain sille botille, joka sitä tarvitsee.',
    'own_rate' => 'Pyyntöjä minuutissa tälle avaimelle',
    'own_rate_helper' => 'Jätä tyhjäksi seurataksesi paneelin asetusta. Tähän kirjoitettu luku koskee vain tätä avainta. Nolla tarkoittaa ettei kattoa ole lainkaan — järkevää botille omalla koneellasi, ja oikea tapa katua, jos avain päätyy jonnekin muualle.',
    'own_rate_default' => 'Seuraa paneelia',
    'mint_owner' => 'Kuka se on',
    'mint_owner_helper' => 'Avain vastaa jonakuna. Koko paneelia koskevalle avaimelle se on vain se, kuka siitä vastaa; henkilökohtaiselle se on myös se, mitä avain saa nähdä.',
    'minted' => 'Luotu',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Avain Essentials-APIin',
    'profile_make_helper' => 'Eri API kuin yllä oleva: tämä vastaa siihen, minkä tämä lisäosa tietää — millä palvelimellasi ei ole varmuuskopiota, ketkä niillä pelaavat, käyvätkö ne. Se vastaa aina vain sinun osaltasi ja yltää vain niihin palvelimiin, jotka voit jo avata.',
    'profile_create' => 'Luo',
    'profile_yours' => 'Essentials-avaimesi',
    'profile_manage' => 'Avaimen peruuttaminen, sen katsominen miksi jokin evättiin, ja Discordin yhdistäminen ovat kaikki sivupalkin API-pääsy-sivulla.',
    'discord' => 'Discord',
    'discord_body' => 'Yhdistä Discord-tilisi tähän, jotta botti voi vastata palvelimiesi osalta kun sitä pyydät. Se saa avaimen, joka yltää täsmälleen sinne minne sinäkin, eikä yhtään pidemmälle.',
    'discord_connect' => 'Yhdistä Discord',
    'discord_code' => 'Kirjoita tämä Discordissa kymmenen minuutin sisällä',
    'discord_code_body' => 'Lähetä :command kanavalle, jonka botti voi lukea. Koodi toimii kerran. Vain se tili, jolle se tehtiin, voi käyttää sitä.',
    'discord_on' => 'Yhdistetty tilinä :name',
    'discord_since' => 'Alkaen :when',
    'discord_cut' => 'Yhteys katkaistu',
    'discord_cut_confirm' => 'Katkaisee yhteyden ja poistaa avaimen, jonka se teki, joten botti lakkaa vastaamasta puolestasi heti. Voit yhdistää uudelleen milloin haluat.',
    'discord_off' => 'Ei yhdistetty',
    'discord_key_note' => 'Yhdistäminen luo tilillesi Pelican-API-avaimen nimeltä Discord (Essentials). Näet sen ja voit peruuttaa sen kohdasta Tili → API-avaimet — tämä sivu on vain oikotie samaan asiaan.',
    'docs_title' => 'Miten tätä APIa käytetään',
    'docs_subheading' => 'Mihin tämä paneeli vastaa ja missä osoitteissa se vastaa. Kirjoitettu samasta kuvauksesta, josta API rakennetaan, joten se ei voi olla julkaisua jäljessä.',
    'docs_base' => 'Missä se sijaitsee',
    'docs_endpoints' => 'Päätepisteet',
    'docs_answers' => 'Mitä tulee takaisin',
    'docs_calls' => 'Avaimet jotka saavat kutsua sitä',
    'docs_params' => 'Mitä lähetetään',
    'docs_required' => 'pakollinen',
    'docs_optional' => 'valinnainen',
    'docs_try' => 'Kokeile',
    'docs_errors' => 'Kun jokin on pielessä',
    'docs_hook' => 'Mitä paneeli lähettää sinulle',
    'docs_hook_body' => 'Toinen suunta, ja ainoa osa tästä, joka saapuu ilman että sitä pyydetään. Kytketään päälle kohdassa Hälytykset osoitteella ja allekirjoituksen salaisuudella: yksi JSON-lähetys kun vahtikoira löytää jotain ja yksi kun se selviää, jotta botti kuulee kuolleesta nodesta sen sijaan että kysyisi joka minuutti onko sellaista.',
    'docs_hook_verify' => 'Runko tiivistetään salaisuudellasi, ja tiiviste kulkee X-Essentials-Signature-otsakkeessa muodossa sha256=<hex>. Tiivistä raaka runko, älä uudelleen sarjallistettua oliota — pieninkin ero välilyönneissä tai avainten järjestyksessä antaa eri tiivisteen, ja eroavaisuus näyttää hyökkäykseltä eikä virheeltä.',
    'docs_download_md' => 'Lataa Markdownina',
    'docs_download_json' => 'Lataa OpenAPIna',

    // ---- mitä ylläpitäjä asettaa -----------------------------------------
    'settings' => 'Näin tämä toimii',
    'approval' => 'Pyynnöt odottavat lupaa',
    'approval_helper' => 'Päällä avainta pyytävä saa sen, kun joku sanoo kyllä. Pois hän saa sen heti — mikä on järkevää paneelissa, jossa jokainen tilin haltija on jo luotettu, ja joka kannattaa valita eikä päätyä siihen.',
    'rate' => 'Pyyntöjä minuutissa, avainta kohti',
    'rate_helper' => 'Botti, joka kysyy neljältäkymmeneltä palvelimelta ketkä pelaavat, on neljäkymmentä kysymystä neljällekymmenelle pelipalvelimelle. Tämä on se katto, joka estää kolmelta yöllä kirjoitettua silmukkaa muuttumasta kuormitustestiksi.',
    'days' => 'Annettu avain kestää',
    'days_helper' => 'Päivinä. Nolla tarkoittaa kunnes peruutetaan, ja se on oletus — avain, joka vanhenee kenenkään katsomatta, on botti joka pysähtyy yöllä ilman että mikään kertoo miksi.',
    'days_never' => 'Kunnes peruutetaan',
    'hide_pelican' => 'Poista paneelin oma API-avaimet-välilehti',
    'hide_pelican_helper' => 'Ottaa API-avaimet-välilehden kokonaan pois tilin profiilista, jolloin sillä sivulla on vain yksi asia nimeltä API-avaimet. Se poistetaan sivulta eikä peitetä, joten jäljelle ei jää osoitetta joka sinne yltää. Yksi asia, jota se ei voi tehdä: paneelin oma client-API tekee yhä tiliavaimen kaikelle, mikä sitä suoraan pyytää — välilehti on se paikka, jossa ihmiset tekevät sellaisen käsin, ja tämä vie käden pois. Jo olemassa olevat avaimet toimivat edelleen.',

    /*
     * Sanottu sivulla eikä jätetty löydettäväksi. Pelican peruu lisäosan
     * migraatiot, kun se poistetaan, ja tämän lisäosan ainoa taulu menee
     * mukana.
     */
    'uninstall_note' => 'Tämän lisäosan poistaminen poistaa jokaisen avaimen sen mukana. Se on tarkoituksellista — avain, joka elää pidempään kuin se, mikä siihen vastaa, on kirjautuminen jota kukaan ei voi perua.',
];
