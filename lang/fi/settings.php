<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Egg”, ”node”, ”subuser”, ”Wings”, ”queue”, ”webhook”, ”topbar”, ”cron” ja
 * tiedostomuotojen nimet jäävät sellaisiksi kuin ovat: niillä nimillä ne löytää
 * Pelicanista, isäntäkoneelta ja kaikesta mitä niistä kirjoitetaan. Tyylien
 * nimiä ei myöskään käännetä — tyyli on nimeltään se mikä se on, ja käännetty
 * nimi olisi vain toinen nimi samalle.
 */

return [
    'css_warning' => 'Tallennettu, mutta tämä CSS näyttää virheelliseltä',
    'css_unclosed' => 'Rivillä :line avattua sääntöä ei koskaan suljeta. Kaikki sen jälkeen on sen säännön sisällä eikä vaikuta mihinkään.',
    'css_extra' => 'Rivillä :line on sulkeva aaltosulje ilman että mitään on auki. Kaikki sen jälkeen on jokaisen säännön ulkopuolella ja ohitetaan.',
    'css_comment' => 'Rivillä :line avattua kommenttia ei koskaan suljeta, joten loput tiedostosta on sen sisällä.',

    'groups' => [
        'appearance' => 'Ulkoasu',
        'servers' => 'Palvelinlista',
        'windows' => 'Tyylit kellonajan mukaan',
        'windows_helper' => 'Eri tyyli kahden vuorokaudenajan välillä. Mitään ei tapahdu ennen kuin lisäät sellaisen. Kello on paneelin oma, sen aikavyöhykeasetuksesta, eikä kunkin lukijan — paneeli, joka näyttäisi erilaiselta kahdelle ihmiselle samalla hetkellä, muistuttaisi rikkinäistä eikä suunniteltua. Ikkuna muuttaa sitä ulkoasua, joka paneelilla jo on, joten se ei tee mitään tyylin ollessa ”Ei mitään”. Tyyli, jonka joku on valinnut itselleen, voittaa sen yhä.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Kielet',
        'servers_helper' => 'Miten palvelinkortti piirretään. Se, näytetäänkö ne ruudukkona vai listana, on kunkin oma valinta kohdassa Tili → Yleisnäkymän asettelu.',
        'server_pages' => 'Palvelinsivut',
        'server_pages_helper' => 'Mitä jokainen palvelimen sisällä oleva sivu kantaa, oli se mikä sivu tahansa.',
        'console' => 'Konsolisivu',
        'console_helper' => 'Terminaalin oma fontti, koko ja korkeus ovat kunkin oma valinta kohdassa Tili.',
        'background' => 'Tausta',
        'background_helper' => 'Koskee koko paneelia, myös kirjautumisruutua.',
        'icons' => 'Kuvakkeet',
        'bars' => 'Resurssimittarit',
        'bars_helper' => 'Suorittimen, muistin ja levyn palkit palvelinkorteissa.',
        'updates' => 'Päivitykset',
        'updates_helper' => 'Mitä julkaisuja Teema-sivu tarjoaa, ja mistä se niitä etsii.',
        'brand' => 'Brändi',
        'login' => 'Kirjautumisruutu',
        'login_helper' => 'Koskee kirjautumisen, salasanan palautuksen ja kaksivaiheisen tunnistuksen ruutuja.',
        'advanced' => 'Oma CSS',
        'advanced_helper' => 'Kaikkeen, mitä yllä olevat asetukset eivät kata. Ladataan kaiken muun jälkeen, joten se voittaa.',
        'areas' => 'Alueittain',
        'areas_helper' => 'Kaikki yllä oleva koskee kaikkialla. Täällä voit erottaa yhden alueen; kaikki, minkä jätät tyhjäksi, seuraa yhä yhteistä asetusta.',
        'footer' => 'Sivupalkin alaosa',
        'footer_helper' => 'Sivupalkin alareuna, jonka Pelican jättää tyhjäksi. Kaikki täällä on pois, kunnes täytät sen.',
        'features' => 'Mitä tämä lisäosa lisää',
        'features_helper' => 'Jos poistat rastin jonkin kohdalta, se katoaa paneelista kokonaan. Sen asetukset säilytetään, ja sen sivu pitää osoitteensa, joten mitään ei menetetä sammuttamalla jokin nähdäkseen mitä se teki. Useimmilla on myös oma oikeutensa kohdassa Roolit, joten yhden voi antaa antamatta loppuja. Ei kaikilla: resurssimittarit, sivupalkin alaosa ja asetusten haku piirretään kaikille eikä niitä ohjaa kukaan, palvelinkortin tähti kuuluu sille joka sitä napsautti, ja Palworld- ja Minecraft-sivut palvelimen sisällä seuraavat sen palvelimen omia oikeuksia eivätkä näitä. Itse ulkoasu ei ole listalla — sillä on oma katkaisijansa, kohdassa Look → Ulkoasu → Tyyli → Ei mitään.',
        'identity' => 'Tämä lisäosa sivupalkissa',
        'identity_helper' => 'Se rivi, jonka tämä lisäosa lisää sivupalkkiin, ja sen kuva.',
    ],

    /*
     * Asetussivut, kukin rivi lisäosan omassa ryhmässä sivupalkissa. Ryhmitelty
     * sen kysymyksen mukaan, johon vastataan, eikä sen mukaan mikä luokka ne
     * tekee.
     */
    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Väri, muoto ja se, mikä paneelin nimi on.',
        'pages' => 'Sivut',
        'pages_helper' => 'Palvelinlista, palvelimen sisäiset sivut, ja terminaali.',
        'advanced' => 'Lisäasetukset',
        'advanced_helper' => 'Ne kaksi hätäuloskäyntiä: oma CSS, ja asetukset jotka koskevat vain yhtä aluetta.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Mitkä eggit ovat Minecraft, ja kaikki muu siitä.',
        'artwork' => 'Eggien kuvat',
        'artwork_helper' => 'Sivu, jolla on jokainen egg, ja tapa hakea pelin kuva sille Steamista tai IGDB:stä. Se kirjoittaa itse eggeihin — kuvan, ja kaksi tagia jotka merkitsevät mikä peli on kyseessä ja valittiinko kuva käsin — ja siksi sillä on oma oikeutensa.',
        'alerts' => 'Hälytykset',
        'alerts_helper' => 'Säännöllinen tarkistus siitä, mitä paneeli jo mittaa mutta ei kerro kenellekään: node joka lakkaa vastaamasta, täyttyvä levy, pysähtynyt queue worker, jäljessä oleva versio. Lähettää Discordiin, paneeliin tai sähköpostiin. Oma oikeutensa, sillä se tavoittaa jokaisen noden säännöllisesti ja lähettää osoitteeseen, jonka joku on kirjoittanut.',
        'backups' => 'Varmuuskopioiden yleiskuva',
        'backups_helper' => 'Sivu, jolla on jokainen palvelin ja se, kuinka kauan se on ollut ilman kopiota, järjestettynä niin että ilman yhtäkään olevat ovat ylimpänä. Vain luku — kaikki, mikä tekee jotain kopiolle, pysyy Pelicanin omalla sivulla sille palvelimelle. Oma oikeutensa, sillä lista on kartta siitä, missä reiät ovat.',
        'public_status' => 'Julkinen tilasivu',
        'public_status_helper' => 'Sivu, jonka kuka tahansa voi avata ilman tiliä ja joka näyttää, mitkä palvelimistasi ovat käynnissä ja montako niillä on paikalla. Mitään ei julkaista ennen kuin mainitset palvelimen, koneen tai palvelun — kaikki kolme listaa alkavat tyhjinä, ja niin kauan kuin ne ovat, osoite vastaa 404. Oma oikeutensa, sillä se ratkaisee, mikä lähtee paneelista.',
        'game_players' => 'Pelaajat, muut pelit',
        'capacity' => 'Kapasiteetti',
        'capacity_helper' => 'Mitä kullekin koneelle on luvattu verrattuna siihen mitä se saa jakaa, jotta näet mahtuuko vielä yksi palvelin. Pelicanin node-lista näyttää nimen ja palvelinten määrän, ja yleisnäkymän Koneet-lohko näyttää mikä on käynnissä - tämä on se kolmas kysymys, ja laskutapa on Pelicanin oma. Vain luku. Oma oikeutensa.',
        'schedules' => 'Ajastetut tehtävät',
        'schedules_helper' => 'Paneelin jokainen ajastettu tehtävä, ja se mitkä niistä ovat pysähtyneet: jumissa kesken ajon, myöhässä koska cron ei aja, tai ei koskaan ajettu. Pelican näyttää ajastukset kunkin palvelimen sisällä, eikä sen omalla tilalla ole sanaa yhdellekään noista tapauksista. Vain luku. Oma oikeutensa.',
        'activity' => 'Toiminta',
        'activity_helper' => 'Paneelin jokainen kirjaama tapahtuma yhtenä listana eikä yksi palvelin kerrallaan. Pelican pitää lokia ja näyttää sen palvelimittain; tämä kysyy samaa lokia toisin päin. Vain luku. Oma oikeutensa, sillä yleiskuva siitä kuka teki mitä on jotain, minkä antaa pois tarkoituksella.',
        'access' => 'Palvelinpääsy',
        'access_helper' => 'Sido rooli palvelimiin, jotta jokainen sen haltija voi tavoittaa ne. Se toimii pitämällä Pelicanin omat subuserit ajan tasalla, ja juuri niitä palvelinlista ja jokainen oikeustarkistus jo lukee. Oma oikeutensa, sillä se on täällä ainoa sivu, joka antaa ihmisille pääsyn johonkin.',
        'games' => 'Muut pelit',
        'games_helper' => 'Ne tiedostot, joita ARK ja Valheim pitävät maailmansa vieressä, lomakkeina: ARKin maailma-asetukset, ja Valheimin listat admineista, bannatuista ja sallituista. Se, mitkä palvelimet ne saavat, on sen sivun egg-lista, joten tyhjä lista on jo pelikohtainen katkaisija.',
        'game_players_helper' => 'Sivu Rustin, ARKin, Valheimin ja kaiken muun Valven kyselyyn vastaavan sisällä, joka näyttää ketkä ovat yhteydessä ja kuinka kauan he ovat olleet paikalla. Vain luku — se, mitä jollekulle voi tehdä, eroaa peleittäin, ja se on oma julkaisunsa. Se, mitkä eggit lasketaan, on sama lista jota tilasivu käyttää.',
        'api' => 'API',
        'api_helper' => 'Ne avaimet, joita ihmisillä on, kuka on pyytänyt sellaista, ja mitä kukin niistä saa nähdä.',
        'languages' => 'Kielet',
        'languages_helper' => 'Mitä kieliä tämä lisäosa vastaa.',
    ],

    'features' => [
        'look' => 'Look-asetukset',
        'look_helper' => 'Sivupalkin rivi värille, muodolle ja brändille.',
        'pages' => 'Sivuasetukset',
        'pages_helper' => 'Sivupalkin rivi palvelinlistalle, palvelinsivuille ja terminaalille.',
        'advanced' => 'Lisäasetukset',
        'advanced_helper' => 'Sivupalkin rivi omalle CSS:lle ja aluekohtaisille poikkeuksille.',
        'announcements' => 'Tiedotteet',
        'announcements_helper' => 'Nauha paneelin yläreunan poikki.',
        'nav_links' => 'Navigointilinkit',
        'nav_links_helper' => 'Omat rivisi sivupalkissa.',
        'login' => 'Kirjautumisruutu',
        'login_helper' => 'Kirjautumisruudun kuva, viesti ja linkit.',
        'bars' => 'Resurssimittarit',
        'bars_helper' => 'Suorittimen, muistin ja levyn väriä vaihtavat palkit.',
        'dashboard_status' => 'Versiorivi',
        'dashboard_status_helper' => 'Yleisnäkymän lohkon yläosa: mikä versio on asennettu, ja odottaako jokin.',
        'dashboard_nodes' => 'Koneet',
        'dashboard_nodes_helper' => 'Loput yleisnäkymän lohkosta: tämä paneeli ja jokainen node, ja mitä kukin käyttää.',
        'system_status' => 'Järjestelmän tila -sivu',
        'system_status_helper' => 'Sivu sille koneelle, jolla paneeli itse ajaa.',
        'sidebar_footer' => 'Sivupalkin alaosa',
        'sidebar_footer_helper' => 'Tekstirivisi, paneelin versio ja yksi linkki, sivupalkin alareunassa.',
        'api' => 'API',
        'api_helper' => 'Tie sisään paneelin ulkopuolelta: osoite, josta Discord-botti tai oma skriptisi voi kysyä sitä, minkä tämä lisäosa tietää — ketkä pelaavat, millä palvelimilla ei ole varmuuskopiota, mahtuuko nodelle vielä yksi. Pois ei rekisteröi reittiä lainkaan sen sijaan, että rekisteröisi sellaisen joka torjuu, mikä on vähemmän pinta-alaa eikä kohteliaampi määrä sitä. Kuka tahansa kirjautunut saa pyytää avainta, joka vastaa vain hänen omien palvelimiensa osalta; sellaisen antaminen, epääminen, jonkun toisen hallussa olevan peruuttaminen ja koko paneelia koskevan myöntäminen vaativat kaikki oikeuden.',
        'languages' => 'Kielet',
        'languages_helper' => 'Kullekin vastaaminen sillä kielellä, johon hänen tilinsä on asetettu, siellä missä tämä lisäosa on sille käännetty. Jos tämä on pois, kaikki saavat englantia.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Minecraft-välilehti sivupalkissa, ja sivu jokaisen Minecraft-palvelimen sisällä sen server.properties-tiedoston muokkaamiseen lomakkeena. Se, mitkä eggit lasketaan, on sinun sanottavissasi.',
        'palworld' => 'Palworld-asetukset',
        'palworld_helper' => 'Sivu Palworld-palvelimen sisällä sen maailma-asetusten muokkaamiseen. Se ei ilmesty millekään muulle palvelimelle, eikä koskaan sen palvelimen ollessa käynnissä.',
        'settings_search' => 'Asetusten haku',
        'settings_search_helper' => 'Näiden lomakkeiden yläpuolella oleva kenttä, joka kaventaa ne niihin osioihin, joissa kirjoittamasi esiintyy.',
        'preview' => 'Elävä esikatselu',
        'preview_helper' => 'Look-lomakkeen vieressä oleva laatikko, joka näyttää mitä värit, kulmat ja välit tekevät ennen kuin tallennat ne.',
        'duplicate' => 'Monista palvelin',
        'duplicate_helper' => 'Sivu, jolla voi asettaa toisen palvelimen täsmälleen kuten jo olemassa olevan, tai useamman kerralla. Tiedostoja ei koskaan kopioida.',
        'favourites' => 'Tähdellä merkityt palvelimet',
        'favourites_helper' => 'Tähti jokaisessa palvelinkortissa. Merkityt tulevat ensin, ja kunkin lista on paneelissa — joten tähdet seuraavat sinne, mistä seuraavaksi kirjautuu sisään. Se muuttaa sen, mitä itse näkee, eikä mitään muille. Se, että se on paneelissa, tarkoittaa tosin, että kyseessä on tiedosto storage-hakemistossa, jonka jokainen koneelle pääsevä voi lukea.',
        'artwork' => 'Eggien kuvat',
        'artwork_helper' => 'Ylläpitosivu, joka hakee kunkin eggin kuvan Steamista tai IGDB:stä ja kirjoittaa sen itse eggiin.',
        'alerts' => 'Hälytykset',
        'alerts_helper' => 'Säännöllinen tarkistus vastaamasta lakanneen noden, täyttyvän levyn, kuolleen queue workerin tai jäljessä olevan version varalta — ja se Discord-, paneeli- tai sähköpostiviesti, jonka se lähettää.',
        'backups' => 'Varmuuskopioiden yleiskuva',
        'backups_helper' => 'Ylläpitosivu, joka listaa jokaisen palvelimen sen mukaan, kuinka kauan se on ollut ilman kopiota. Vain luku.',
        'public_status' => 'Julkinen tilasivu',
        'public_status_helper' => 'Sivu, jonka kuka tahansa voi avata ilman tiliä. Jos se on pois, osoite vastaa 404 riippumatta siitä, mitä listalla on.',
        'game_players' => 'Pelaajat, muut pelit',
        'game_players_helper' => 'Sivu Rustin, ARKin, Valheimin ja kaiken muun Valven kyselyyn vastaavan sisällä, joka näyttää ketkä ovat yhteydessä ja kuinka kauan he ovat olleet paikalla.',
        'owner_alerts' => 'Kerro ihmisille, että heidän palvelimensa on alhaalla',
        'owner_alerts_helper' => 'Ainoa osa tästä lisäosasta, joka kirjoittaa muille kuin ylläpitäjille: ilmoitus paneelissa, kun jonkin heidän palvelimensa takana oleva kone lakkaa vastaamasta, ja yksi kun se palaa. Pois, kunnes se laitetaan päälle sekä täällä että Hälytykset-sivulla - se kirjoittaa asiakkaillesi, joten se vaatii kaksi päätöstä eikä yhtä.',
        'my_backups' => 'Kopiovaroitus palvelinlistalla',
        'my_backups_helper' => 'Rivi kunkin oman palvelinlistan yläpuolella, kun jollain heidän palvelimistaan ei ole koskaan ollut kopiota tai sellaista ei ole ollut vähään aikaan. Pelicanin kortti kertoo, mitä palvelin tekee nyt; mikään siellä ei kerro, ettei kopiota ole ajettu kolmeen viikkoon. Piirretään vain kun jokin on jäljessä, eikä se mainitse yhtäkään palvelinta, jota henkilö ei jo voisi avata.',
        'capacity' => 'Kapasiteetin yleiskuva',
        'capacity_helper' => 'Ylläpitosivu, joka näyttää muistin, levyn ja suorittimen luvattuna verrattuna saatavilla olevaan kullakin koneella, sekä ne palvelimet joilta ovat loppuneet kopiot, tietokannat tai allokaatiot. Luvattu eikä käytetty - node voi olla kiireinen ja tyhjä, tai hiljainen ja täysi.',
        'schedules' => 'Ajastettujen tehtävien yleiskuva',
        'schedules_helper' => 'Ylläpitosivu, joka listaa paneelin jokaisen ajastetun tehtävän, pahimmat ensin - jumissa, myöhässä, tai ei koskaan ajettu. Vain luku; kaikki mikä muuttaa tai ajaa sellaisen pysyy Pelicanin omalla sivulla sille palvelimelle.',
        'activity' => 'Paneelin toiminta',
        'activity_helper' => 'Ylläpitosivu, joka listaa paneelin jokaisen kirjatun tapahtuman, uusin ensin, ja kuka teki sen ja millä palvelimella. Vain luku - se ei poista mitään, ja Pelicanin oma asetus ratkaisee yhä, kuinka kauan rivit säilyvät.',
        'access' => 'Palvelinpääsy roolin mukaan',
        'access_helper' => 'Sivu roolin sitomiseksi palvelimiin, pidettynä totena Pelicanin omassa subuser-taulussa. Se ei anna mitään, ennen kuin kytket jotain. Sen sammuttaminen pysäyttää täsmäytyksen; jo annettu pääsy jää, ja sivulla on painike sen takaisin ottamiseen.',
        'scheduled' => 'Tyylit kellonajan mukaan',
        'scheduled_helper' => 'Look-sivun osio, joka antaa paneelille eri tyylin kahden vuorokaudenajan välillä. Se ei muuta mitään tallennettua — ikkuna asetetaan asetusten päälle sivua piirrettäessä ja päästetään heti perään irti — joten sen sammuttaminen palauttaa paneelin oman ulkoasun heti eikä hukkaa mitään.',
        'games' => 'Muut pelit',
        'games_helper' => 'ARKin maailma-asetukset ja Valheimin listat admineista, bannatuista ja sallituista, lomakkeina eikä tiedostoina tiedostonhallinnassa. Se, mitkä palvelimet ne saavat, on Muut pelit -sivun egg-lista.',
        'quick' => 'Siirry-valikko',
        'quick_helper' => 'Yksi kohta jokaisen sivun yläreunassa, jolla hyppää palvelimelle tai tähdellä merkitylle sivulle, ja hakukenttä koko palvelinlistaasi. Se korostaa myös sen sivun, jolla olet. Se, minkä joku sen kautta löytää, on se minkä hän jo tavoitti, joten se ei anna mitään - sen sammuttaminen vie oikotien ja Suosikit-sivun sen mukana.',
    ],

    /*
     * Asetuslomakkeiden yläpuolella oleva hakukenttä. Se suodattaa sitä, mikä on
     * jo sivulla selaimessa, eikä kysy palvelimelta mitään, joten kuvattavaa
     * ”hakee”-tilaa ei ole eikä ole tapaa, jolla se voisi epäonnistua.
     */
    /*
     * Esikatselu. Kaikki siinä on sijainen eikä näyte paneelistasi, ja
     * sanamuoto sanoo sen - laatikko, joka mainitsisi oikean palvelimen tai
     * oikean luvun, luettaisiin sellaisena.
     */
    'preview' => [
        'label' => 'Esikatselu',
        'card' => 'Kortti',
        'card_helper' => 'Piirretty samoilla säännöillä kuin paneeli, tällä sivulla olevilla asetuksilla eikä tallennetuilla.',
        'button' => 'Painike',
        'field' => 'Kenttä',
        'meter_ok' => 'Hyvä',
        'meter_warning' => 'Varoitus',
        'meter_danger' => 'Vaara',

        /*
         * Koko sivun esikatselu. Välilehti eikä kehys, sillä Pelican lähettää
         * X-Frame-Options: DENY ja kieltäytyy päästämästä itseään minkään
         * kehystämäksi, myös itsensä - katso Support\FullPreview.
         */
        'full' => 'Katso koko paneeli',
        'full_confirm' => 'Avaa paneelin piirrettynä tämän sivun asetuksista eikä tallennetuista. Mitään ei kirjoiteta — arvoja pidetään viisitoista minuuttia, ja paneeli palaa tavalliseen, kun poistut esikatselusta tai tallennat.',
        'full_go' => 'Näytä minulle',
        'full_failed' => 'Esikatselua ei saatu käyntiin',
        'bar' => 'Katselet asetuksia, joita ei ole tallennettu. Mitään siitä ei ole kirjoitettu.',
        'bar_back' => 'Takaisin asetuksiin',
    ],

    'search' => [
        'placeholder' => 'Etsi asetuksia',
        'label' => 'Etsi näistä asetuksista',
        'none' => 'Mikään tällä sivulla ei täsmää. Asetukset on jaettu neljälle sivulle — kokeile Look, Sivut, Lisäasetukset tai Essentials-asetukset.',
    ],

    'footer' => [
        'text' => 'Oma rivisi',
        'text_helper' => 'Tavallista tekstiä, enintään 120 merkkiä. Se escapetaan, aivan kuten tiedotenauha — tämä piirretään paneelin jokaiselle sivulle, mikä tekee siitä väärän paikan ottaa vastaan merkkausta.',
        'version' => 'Näytä paneelin versio',
        'version_helper' => 'Pelicanin versio, ei tämän lisäosan. Lisäosa kertoo omansa yleisnäkymässä; se, mitä ihmiset etsivät sivupalkin alareunasta, on mitä paneelia he katsovat.',
        'link_label' => 'Linkin teksti',
        'link_url' => 'Linkin osoite',
        'link_url_helper' => 'http- tai https-osoite, tai polku itse paneelissa kuten /account. Avautuu uuteen välilehteen.',
    ],

    'layout' => [
        'label' => 'Asettelu',
        'helper' => 'Miten paneeli on aseteltu, ei minkä värinen se on. Koskee ylläpito-osaa, palvelinlistaa ja asiakasosaa samalla tavalla. Se, missä navigointi on, on oletus: se, joka on asettanut omansa kohdassa Tili → Navigointi, pitää sen.',
        'default' => 'Sivupalkki — Pelicanin oma',
        'rail' => 'Kuvakekisko — kapea, avautuu osoittaessa',
        'top' => 'Navigointi ylhäällä — ei sivupalkkia',
        'mixed' => 'Yläpalkki ja sivupalkki — molemmat',
        'wide' => 'Leveä — sisältö käyttää koko ruudun',
        'focus' => 'Keskitetty — kapea palsta, sivupalkki taittuu kokoon',

        'nav_label' => 'Sivupalkin tyyli',
        'nav_helper' => 'Miten itse sivupalkki piirretään.',
        'nav_default' => 'Oletus',
        'nav_floating' => 'Kelluva — oma korttinsa',
        'nav_flat' => 'Litteä — ei taustaa lainkaan',
        'nav_bordered' => 'Reunallinen — viiva, ei pinta',

        'topbar_label' => 'Topbarin tyyli',
        'topbar_helper' => '”Piilotettu” koskee vain tietokonetta — puhelimessa topbar kantaa ainoan tien takaisin valikkoon.',
        'topbar_default' => 'Oletus',
        'topbar_floating' => 'Kelluva — irrallinen rivi',
        'topbar_flush' => 'Tasassa — litteä, ilman sumennusta',
        'topbar_hidden' => 'Piilotettu tietokoneella',

        'card_label' => 'Korttityyli',
        'card_helper' => 'Osiot, widgetit, palvelinkortit ja konsolin yläpuolella olevat lohkot.',
        'card_default' => 'Oletus — kohotettu pehmeällä reunalla',
        'card_flat' => 'Litteä — ilman kohotusta',
        'card_outline' => 'Ääriviiva — reuna eikä mitään takana',
        'card_glass' => 'Huurrettu — tausta kuultaa läpi',
        'card_sharp' => 'Terävä — suorat kulmat',
    ],

    'servers' => [
        /*
         * Kortin tähti. Annettu skriptille eikä kirjoitettu siihen, jotta
         * tekstit ovat se yksi paikka, jossa tekstit asuvat.
         */
        'favourite' => 'Merkitse tämä palvelin tähdellä',
        'favourited' => 'Merkitty — näytetään ensin',

        /*
         * Pilleri Pelicanin omien välilehtien vieressä. Nimetty sen mukaan,
         * mitä se tekee listalle, eikä neljänneksi välilehdeksi, koska se
         * suodattaa valittuna olevan välilehden eikä korvaa sitä.
         */
        'favourites_tab' => 'Suosikit',
        'favourites_empty' => 'Mitään ei ole merkitty tähdellä tällä sivulla. Käytä palvelinkortin tähteä lisätäksesi yhden — ja huomaa, että tämä suodattaa niitä palvelimia, jotka ovat jo täällä: myöhemmällä sivulla oleva merkitty palvelin ei piiloudu, se vain ei ole tällä.',
        'favourites_failed' => 'Tähdellä merkittyjä palvelimiasi ei saatu tallennettua, joten ne on palautettu siihen, mitä paneelilla viimeksi oli. Selaimen konsoli kertoo, mitä pyyntö vastasi.',

        'art' => 'Pelikuva',
        'art_helper' => 'Pelican piirtää eggin kuvan jokaiseen korttiin. Tämä ratkaisee, mitä sille tehdään.',
        'art_faded' => 'Haalistettu — hohde tekstin takana',
        'art_cover' => 'Peittävä — nimen takana, häivähtää pois',
        'art_off' => 'Pois',
        'art_dim' => 'Tummenna kuvaa',
        'art_dim_helper' => 'Yhden pelin kuva on kirkas taivas, ja toisen on luola.',

        'status' => 'Tilamerkki',
        'status_helper' => 'Missä käynnissä/käynnistyy/pysäytetty-väri näkyy.',
        'status_bar' => 'Palkki — vasenta reunaa pitkin',
        'status_edge' => 'Reuna — yläreunan poikki',
        'status_dot' => 'Piste — kulmassa',
        'status_off' => 'Pois',

        'density' => 'Kortin korkeus',
        'density_comfortable' => 'Väljä',
        'density_compact' => 'Tiivis — monelle palvelimelle',

        'filter_label' => 'Laita teksti suodatinpainikkeeseen',
        'filter_label_helper' => 'Pelican suodattaa tätä listaa jo eggin ja omistajan mukaan, kaikkien sivujen yli - mutta tie sisään on tekstitön kuvake hakukentän vieressä. Tämä laittaa siihen sanan.',
        'filter_button' => 'Suodattimet',

        'columns' => 'Kortteja vierekkäin leveällä ruudulla',
        'columns_helper' => 'Koskee vain ruudukkoa, ja vain 1280px:stä ylöspäin. Pelicanin oma katto on kaksi.',
    ],

    'controls' => [
        'mode' => 'Konsolipainike jokaisella palvelinsivulla',
        'mode_helper' => 'Yksi kelluva painike, palvelimen jokaisella sivulla. Se avaa konsolin sen päälle, mitä olit tekemässä, ja sen otsakkeessa ovat tila ja virtapainikkeet — se tavoittaa noden suoraan, kuten palvelinlista tekee, eikä konsolisivun websocketin kautta. Se ei koskaan ilmesty konsolisivulle, jolla on jo kaikki.',
        'mode_full' => 'Konsoli ja virtapainikkeet',
        'mode_console' => 'Vain konsoli',
        'mode_off' => 'Pois',

        'label' => 'Painike näyttää',
        'label_text' => 'Kuvakkeen ja nimen',
        'label_icon' => 'Vain kuvakkeen',

        'position' => 'Missä se kelluu',
        'position_helper' => 'Sitä reunaa kohti, jota epätodennäköisimmin luet.',
        'position_top' => 'Ylhäällä',
        'position_right' => 'Oikealla',
        'position_bottom' => 'Alhaalla',
    ],

    'console' => [
        'stats' => 'Lohkot konsolin yläpuolella',
        'stats_helper' => 'Pelican näyttää nimen, tilan, osoitteen ja kolme käyttölukua terminaalin yläpuolella. Niiden piilottaminen antaa konsolille korkeuden takaisin.',
        'stats_tiles' => 'Laatat — selite, luku ja kuvake',
        'stats_plain' => 'Yksinkertaiset — kuten Pelican ne piirtää',
        'stats_off' => 'Piilotettu',
    ],

    'terminal' => [
        'helper' => 'Annetaan terminaalille itselleen, joten ne tulevat voimaan seuraavalla sivunlatauksella eikä sillä hetkellä, kun ne tallennetaan.',

        'renderer' => 'Piirtäjä',
        'renderer_helper' => 'Pelican piirtää terminaalin GPU:lla, mikä on paljon nopeampaa vyöryvän tulosteen seinän edessä. Selain pitää vain tietyn määrän GPU-konteksteja elossa kerrallaan — puhelimessa vähemmän — ja poistaa vanhimman rajan ylittyessä; terminaali ei silloin piirrä mitään lainkaan, ilman virhettä. Jos konsolisi tyhjenee samalla kun kaikki muu siinä näyttää oikealta, tätä asetusta muutetaan.',
        'renderer_webgl' => 'GPU — Pelicanin oma, nopeampi',
        'renderer_dom' => 'Selain — hitaampi, piirtää aina',

        'scheme' => 'Väriteema',
        'scheme_helper' => 'Ainoa terminaaliasetus, jota Pelican ei tarjoa. ”Seuraa teemaa” johtaa värit korostuksesta, ja siksi tämä ylipäätään on olemassa.',
        'scheme_theme' => 'Seuraa teemaa',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kohdistin',
        'cursor_helper' => 'Konsoli ei ota vastaan näppäilyä — komentokenttä on sen alla — joten tämä on se, mihin tuloste pysähtyi, eikä se, missä sinä olet.',
        'cursor_underline' => 'Alaviiva — Pelicanin oma',
        'cursor_block' => 'Lohko',
        'cursor_bar' => 'Viiva',

        'blink' => 'Vilkkuva kohdistin',

        'scrollback' => 'Vierityshistoria',
        'scrollback_helper' => 'Kuinka pitkälle taaksepäin konsolia voi vierittää. Jokainen rivi pidetään selaimessa, joten puhelias palvelin korkealla asetuksella on oikeaa muistia sillä koneella, joka lukee mukana.',
        'scrollback_lines' => ':lines riviä',
    ],

    'notice' => [
        'text' => 'Viesti',
        'text_helper' => 'Yksi rivi, enintään 200 merkkiä. Se escapetaan sisään tullessa ja ulos mennessä, joten se ei voi kantaa merkkausta sivulle, jonka muut ihmiset lataavat.',
        'style' => 'Sävy',
        'style_info' => 'Tieto',
        'style_warning' => 'Varoitus',
        'style_danger' => 'Kiireellinen',
        'style_accent' => 'Korostusväri',
        'scope' => 'Näytetään',
        'scope_all' => 'Kaikille',
        'scope_client' => 'Vain ylläpito-osan ulkopuolella',
        'scope_admin' => 'Vain ylläpito-osassa',
        'link_label' => 'Painikkeen teksti',
        'link_url' => 'Painikkeen osoite',
        'link_url_helper' => 'https:// tai polku tämän paneelin sisällä, esimerkiksi /account. Kaikki muu jätetään huomiotta — linkki jokaisen sivun nauhassa ei ole paikka odottamattomalle protokollalle.',
        'dismissible' => 'Voidaan sulkea',
        'dismissible_helper' => 'Sulkeminen muistetaan selainkohtaisesti, ja vain tälle viestille: muuta tekstiä, niin se palaa kaikille.',
        'dismiss' => 'Sulje',
    ],

    'preset' => [
        'label' => 'Tyyli',
        'helper' => 'Valitse ulkoasu, josta lähteä. Se täyttää kaiken alla olevan, jota voit sitten muuttaa. ”Ei mitään” sammuttaa teeman ja jättää paneelin täsmälleen sellaiseksi kuin Pelican sen toimittaa.',
        'options' => [
            'none' => 'Ei mitään - ei teemaa',
            'legend' => 'Legend - punaista tulta siniseksi salamaksi',
            'ember' => 'Ember - lämmin musta, oranssi korostus',
            'midnight' => 'Midnight - syvänsininen, rauhallinen',
            'crimson' => 'Crimson - punainen, terävät kulmat, tiivis',
            'forest' => 'Forest - vihreä, pyöreä, ilman hohdetta',
            'nebula' => 'Nebula - violetti liukuvärillä taustassa',
            'terminal' => 'Terminal - vihreää mustalla, tasalevyinen, terävä',
            'console' => 'Console - pyöreä ja väljä, tabletille',
            'nord' => 'Nord - Nord-paletti, vaimennettu',
            'solarized' => 'Solarized - Solarized dark, syaani korostus',
            'paper' => 'Paper - vaalea, korkea kontrasti, litteä',
            'daylight' => 'Daylight - vaalea ja lämmin, pehmeällä hohteella',
            'mono' => 'Mono - harmaasävyt, litteä ja tiheä',
        ],

        'save' => 'Tallenna tyylinä',
        'save_confirm' => 'Säilyttää ne värit, kulmat, taustan, fontin, kuvakkeet ja mittarirajat, jotka sinulla on ruudulla juuri nyt — nimellä, jonka itse valitset, valitsimessa sisäänrakennettujen vieressä. Se tallentaa sen, mikä on sivulla, eikä sitä mikä viimeksi tallennettiin.',
        'save_name' => 'Nimi',
        'save_name_helper' => 'Miksi se tulee valitsimessa nimetyksi. Aiemmin käyttämälläsi nimellä tallentaminen korvaa sen.',
        'saved' => 'Tyyli tallennettu',
        'save_failed' => 'Sitä tyyliä ei saatu tallennettua',
        'save_full' => 'Omia tyylejä mahtuu :max. Poista ensin yksi.',

        'delete' => 'Poista tyyli',
        'delete_which' => 'Mikä',
        'delete_confirm' => 'Vain omat tyylisi voi poistaa; sisäänrakennettuja ei. Mikään paneelin nykyisessä ulkoasussa ei muutu — tyyli on lähtökohta, ja jokainen sen asettama arvo on jo alla olevissa asetuksissa.',
        'deleted' => 'Tyyli poistettu',
        'deleted_current' => 'Se oli se, mihin tämä paneeli oli asetettu. Sen asetukset ovat muuttumattomat ja yhä tällä sivulla — valitse tyyli, tai tallenna ne uudelleen nimellä.',
    ],

    'user_themes' => [
        'label' => 'Tyylit, jotka ihmiset saavat itse valita',
        'helper' => 'Rastitetut tyylit ilmestyvät asiakasosan Ulkoasu-sivulle, jossa jokainen kirjautunut voi valita itselleen yhden. Se muuttaa sen, mitä he itse näkevät, eikä mitään muille. Ei rasteja tarkoittaa, ettei kukaan valitse mitään ja että paneeli pitää yhden ulkoasun — mitä se nyt tekee.',
    ],

    'mode' => [
        'label' => 'Paneelin tila',
        'helper' => 'Missä tilassa paneeli avautuu. Se, joka ei ole itse valinnut, saa tämän; käyttäjävalikon valitsin antaa heidän yhä muuttaa sen, ellet lukitse sitä alla.',
        'dark' => 'Tumma',
        'light' => 'Vaalea',
        'system' => 'Järjestelmä — seuraa kävijän omaa asetusta',
    ],

    'font' => [
        'label' => 'Paneelin fontti',
        'helper' => 'Jokainen vaihtoehto on perhe, joka käyttöjärjestelmällä jo on — mitään ei haeta fonttipalvelusta. Terminaali ei muutu: sen fontti on kunkin oma valinta kohdassa Tili.',
        'default' => 'Oletus - Pelicanin oma',
        'mono' => 'Tasalevyinen',
        'rounded' => 'Pyöristetty',
        'serif' => 'Antiikva',
        'system' => 'Järjestelmä - tämän koneen käyttämä',
    ],

    'surface' => [
        'label' => 'Pinnan väri',
        'helper' => 'Kortit ja paneelit. Vaaleammat ja tummemmat sävyt johdetaan siitä.',
        'placeholder' => 'Seuraa teemaa',
    ],

    'radius' => [
        'label' => 'Kulmat',
    ],

    'accent' => [
        'label' => 'Korostusväri',
        'helper' => 'Käytetään painikkeisiin, linkkeihin, aktiiviseen navigointikohtaan ja kohdistusrenkaisiin.',

        /*
         * Sanottu, ei pakotettu. Väri, josta tämä varoittaa, tallennetaan silti:
         * se on jonkun paneeli, luku mittaa yhtä asiaa, ja on hyviä syitä haluta
         * korostusta, joka pärjää huonosti. Valitsin kertoo mitä se näkee, ja
         * väistää.
         */
        'contrast_dark' => 'Luettavuus: :ratio tummaa paneelia vasten. Alle 3 on korostus, jota on vaikea lukea painikkeena tai linkkinä — vaaleampi nostaa sen.',
        'contrast_light' => 'Luettavuus: :ratio vaaleaa paneelia vasten. Alle 3 on korostus, jota on vaikea lukea painikkeena tai linkkinä — tummempi nostaa sen.',
    ],
    'density' => [
        'label' => 'Tiheys',
        'helper' => 'Tiivis kiristää välejä, jotta ruudulle mahtuu enemmän rivejä.',
        'comfortable' => 'Väljä',
        'compact' => 'Tiivis',
    ],
    'force_dark' => [
        'label' => 'Pakota tumma tila',
        'helper' => 'Piilottaa valitsimen vaalean ja tumman väliltä ja pitää jokaisen käyttäjän tummassa teemassa.',
    ],
    'glass' => [
        'label' => 'Huurrettu topbar',
        'helper' => 'Sumentaa topbarin ja ikkunoiden takana olevan taustan. Sammuta heikommilla laitteilla.',
    ],
    'glow' => [
        'label' => 'Korostushohde',
        'helper' => 'Pehmeä korostusvarjo tärkeimmissä painikkeissa, aktiivisessa navigoinnissa ja kirjautumiskortissa.',
    ],

    'background' => [
        'label' => 'Taustan tyyppi',
        'helper' => 'Aurora on teeman oma tausta: korostushohdetta hienolla rakeisuudella.',
        'aurora' => 'Aurora (oletus)',
        'solid' => 'Yksi väri',
        'gradient' => 'Liukuväri',
        'image' => 'Kuva',
        'color' => 'Väri',
        'base' => 'Väri hohteen takana',
        'base_helper' => 'Se, minkä päällä sivu lepää ennen kuin korostushohde maalataan sen yli. Jätä tyhjäksi säilyttääksesi paneelin oletuksen, joka on melkein musta tummassa ja melkein valkoinen vaaleassa. Jos asetat sen, teema säilyttää oman yövärinsä ja tulee silti valaistuksi.',
        'color_end' => 'Toinen väri',
        'angle' => 'Suunta',
        'upload' => 'Lataa kuva',
        'upload_helper' => 'Enintään 8 Mt. Ladattu kuva menee alla olevan osoitteen edelle.',
        'url' => 'Tai URL',
        'url_helper' => 'On alettava https:// ja oltava tavoitettavissa ulkopuolelta.',
        'dim' => 'Himmennä',
        'dim_helper' => 'Ilman himmennystä valkoinen teksti vaalealla kuvalla on lukukelvotonta.',
        'blur' => 'Sumennus',
    ],

    'channel' => [
        'installed' => 'asennettu',
        'version' => 'Asenna tietty versio',
        'version_helper' => 'Mikä tahansa tämän kanavan julkaisu, ei vain uusin — palataksesi taaksepäin, kun jokin uusi osoittautuu huonommaksi, tai eteenpäin siihen buildiin, jota joku on pyytänyt kokeilemaan. Vain silloin, kun päivitykset eivät asenna itseään: sen ollessa päällä valintasi kestäisi vain seuraavaan tarkistukseen.',
        'version_placeholder' => 'Valitse versio',
        'version_install' => 'Asenna tämä versio',
        'version_confirm' => 'Paneeli lataa sen julkaisun, rakentaa assettinsa uudelleen ja tyhjentää välimuistinsa. Asetuksesi säilyvät. Vanhempaan versioon saa palata, eikä mitään peruta puolestasi — valitse uudempi uudelleen mennäksesi eteenpäin.',
        'label' => 'Päivityskanava',
        'helper' => 'Mitä julkaisuja Teema-sivu tarjoaa. Beta saa uudet versiot ensin, ja terävät reunat myös ensin.',
        'stable' => 'Vakaa',
        'beta' => 'Beta',
        'dev' => 'Dev (työhaara)',
        'auto' => [
            'label' => 'Asenna päivitykset automaattisesti',
            'helper' => 'Pois jättää päivityksen sinun huoleksesi. Päällä saa paneelin tarkistamaan valitun kanavan ja asentamaan kaiken uudemman - se rakentaa assettinsa uudelleen sillä välin ja on saavuttamattomissa pari minuuttia, joten päivittäin ja viikoittain ajetaan klo 4.00. Vaatii, että paneelin cron ajaa.',
            'interval' => 'Tarkista joka',
            'minute' => 'Joka minuutti',
            'five_minutes' => 'Joka 5. minuutti',
            'ten_minutes' => 'Joka 10. minuutti',
            'thirty_minutes' => 'Joka 30. minuutti',
            'hourly' => 'Joka tunti',
            'daily' => 'Joka päivä (4.00)',
            'weekly' => 'Joka viikko (maanantaisin 4.00)',
        ],
    ],

    /*
     * Kielet-välilehti.
     *
     * Varovasti sen kanssa, mitä se väittää. Pelican antaa jo kunkin valita
     * kielen koko tililleen ja käyttää sitä jo; mikään täällä ei muuta sitä
     * eikä pidä muuttaa. Tämä ratkaisee vain sen, seuraavatko tämän lisäosan
     * omat tekstit sitä valintaa.
     */
    'languages' => [
        'section_helper' => 'Pelican antaa jo kunkin valita kielen tililleen, ja tämä lisäosa seuraa sitä siellä, missä se on käännetty. Täällä päätät, mitä niistä se seuraa. Useimmat kielet ovat matalalla prosentilla tarkoituksella: ensin käännetään se osa, jonka kaikki näkevät jokaisella sivulla — konsolin yläpuolella olevat virtapainikkeet ja nodemittarit — ja loput tulevat sitä mukaa kuin ihmiset osallistuvat.',
        'panel' => 'Anna tämän ratkaista koko paneelin kieli',
        'panel_helper' => 'Päällä kieli, jota tämä lisäosa ei kanna — tai joka on alla sammutettu — asettaa koko paneelin englanniksi sille lukijalle, ei vain näitä sivuja. Pois vain tämä lisäosa seuraa listaa, ja Pelican jatkaa puhumista sillä kielellä, johon tili on asetettu, mikä tarkoittaa että lukija voi kohdata kaksi kieltä yhdellä ruudulla. Yhtäkään tiliä ei muuteta kumpaankaan suuntaan: laita kieli takaisin päälle, niin he saavat sen takaisin.',
        'label' => 'Kielet, joita vastataan',
        'helper' => 'Rastin poistaminen lähettää ne lukijat, joilla se on tilillään, takaisin englantiin pelkästään tämän lisäosan osalta — loput paneelista puhuu yhä heidän kieltään. Englanti ei ole listalla, koska kaikki putoaa takaisin siihen.',
        'under' => 'ei tarjota ennen kuin se on edennyt pidemmälle — rastita tarjotaksesi sitä silti',
        'done' => ':percent % käännetty',
        'main' => 'Pääkieli',
        'main_helper' => 'Se, minkä lukija saa, kun hänen omaa kieltään ei voi käyttää — joko tämä lisäosa ei kanna sitä, tai sitä ei ole rastitettu alla. Se oli aina englanti; tiimissä, joka ei työskentele englanniksi, se oli väärä vastaus annettuna varmasti. Rastia ei voi poistaa alla, koska kaikki putoaa takaisin siihen.',
        'labels' => 'Miksi kukin kieli on nimetty',
        'labels_helper' => 'Nimi, jonka lukijat ja ylläpitäjät näkevät valitsimissa. Jätä yksi tyhjäksi säilyttääksesi sen nimen, jolla tämä lisäosa sen tuntee. Itse keksimälläsi nimellä ladatulla kielellä ei ole sellaista, joten se olisi koodinsa kanssa, kunnes annat sille sellaisen täällä.',
        'labels_code' => 'Koodi',
        'labels_name' => 'Näytetään nimellä',
        'download' => 'Lataa käännöstiedosto',
        'download_from' => 'Aloita kohdasta',
        'download_from_helper' => 'JSON, jossa on tämän lisäosan jokainen teksti. Valitse englanti kielelle, jota kukaan ei ole aloittanut, tai olemassa oleva rakentaaksesi jo käännetyn päälle.',
        'code' => 'Kielikoodi',
        'code_helper' => 'Se koodi, jota tiedosto koskee. Oikea locale, sellaisena kuin tilit niitä käyttävät — fr, de, pt_BR — tavoittaa ne lukijat, joilla se on asetettu, ja sen on täsmättävä tarkalleen, tai se ei tavoita. Itse keksimäsi nimi, kuten Gaming-FI, on sallittu ja toimii toisin: Pelican antaa tilillä olla vain oikean localen, joten kukaan ei voi valita sinun. Se on tavoitettavissa yllä olevana pääkielenä, mikä on se, minkä kaikki saavat kun oma ei kelpaa.',
        'url' => 'Tai hae se osoitteesta',
        'url_helper' => 'https-osoite, jonka paneeli tavoittaa — CDN, bucket, raakatiedosto repositoriosta. Se haetaan kerran tallentaessasi ja kirjoitetaan samalla tavalla kuin ladattu, joten tiedoston muuttaminen siinä osoitteessa myöhemmin ei tee mitään ennen kuin tallennat uudelleen. Yllä valittu tiedosto voittaa tähän kenttään jääneen osoitteen.',
        'upload' => 'Lataa käännöstiedosto',
        'upload_helper' => 'Yltä ladattu JSON-tiedosto, arvot käännettyinä. Se kirjoitetaan lisäosan ulkopuolelle, joten päivitys ei heitä sitä pois, ja se asetetaan englannin päälle avain avaimelta — tiedosto, jossa on puolet teksteistä, antaa sinulle puolikkaan kielen ja englantia lopuille.',
        'uploaded' => ':count tekstiä asennettu kieleen :code',
        'uploaded_halves' => 'Niistä :mine on tämän lisäosan omia tekstejä ja :panel on paneelin. Nolla toisella puolella tarkoittaa, ettei tiedoston se puolisko sisältänyt mitään — lisäosan avaimet alkavat essentials:: ja paneelin eivät.',
        'uploaded_skipped' => 'Ohitettu :count: tyhjiä, tai avaimia joita tällä lisäosalla ei ole. Ensimmäiset: :keys',
        'upload_failed' => 'Tuota tiedostoa ei saatu luettua',
        'upload_failed_body' => 'Sen on oltava yllä olevan latauksen JSON-tiedosto — litteä objekti avaimia ja tekstejä. Tarkista, ettei editori ole tallentanut sitä joksikin muuksi.',
    ],

    'windows' => [
        'add' => 'Lisää ikkuna',
        'from' => 'Alkaen',
        'to' => 'Asti',
        'to_helper' => 'Alkua aiempi tarkoittaa, että se ylittää keskiyön — 22.00–06.00 on yö.',
        'preset' => 'Tyyli',
        'days' => 'Päivät',
        'days_helper' => 'Jätä kaikki rastittamatta tarkoittamaan joka päivää. Keskiyön ylittävä ikkuna kuuluu sille päivälle, jona se alkaa, joten perjantai 22.00–06.00 kattaa lauantaiaamun.',
        'day_mon' => 'Maanantai',
        'day_tue' => 'Tiistai',
        'day_wed' => 'Keskiviikko',
        'day_thu' => 'Torstai',
        'day_fri' => 'Perjantai',
        'day_sat' => 'Lauantai',
        'day_sun' => 'Sunnuntai',
    ],

    'arranger' => [
        'label' => 'Sivun järjestäjä',
        'helper' => 'Painike ”Järjestä sivu”, paneelin jokaisella sivulla. Jokainen Järjestä-oikeuden haltija saa sen ja voi myös asettaa sen järjestyksen, josta kaikki muut lähtevät, tai yhden roolille. Pois piilottaa sen kaikilta; jo tallennetut järjestykset jäävät sinne, missä ovat.',
        'roles' => 'Järjestys ei ole oikeus. Lohko, jonka rooli piilottaa, on yhä lohko, jonka joku voisi tavoittaa kirjoittamalla osoitteen — sen pysäyttävät Pelicanin omat oikeudet, roolisivulla. Kolme kerrosta asetetaan tässä järjestyksessä: se, josta kaikki lähtevät, sitten lukijan rooli, ja sitten se, mitä he itse ovat siirtäneet.',
        'users' => 'Anna kaikkien järjestää omat sivunsa',
        'users_helper' => 'Päällä antaa jokaisen kirjautuneen siirtää ja piilottaa lohkoja niillä sivuilla, jotka he jo näkevät, vain itselleen — se ei muuta mitään muille. Sen järjestyksen asettaminen, josta kaikki lähtevät, jää Järjestä-oikeudelle.',
    ],

    'brand' => [
        'logo_height' => 'Logon korkeus',
        'logo_height_helper' => 'Pelican toimittaa 2rem. Suuremmat arvot tekevät sivupalkin otsikosta korkeamman samalla.',
        'logo_url' => 'Korvaa logo',
        'logo_url_helper' => 'Jätä tyhjäksi säilyttääksesi sen, mihin Pelicanin omat asetukset osoittavat.',
    ],

    'login' => [
        'image' => 'Taustakuva',
        'image_helper' => 'Vain kirjautumisruutuun. Ilman sitä se näyttää yhä paneelin taustan.',
        'url' => 'Tai URL',
        'blur' => 'Kortin sumennus',
        'blur_helper' => 'Huurtaa kortin, jotta takana oleva kuva kuultaa läpi.',
        'width' => 'Kortin leveys',
        'position' => 'Kuvan rajaus',
        'position_helper' => 'Mikä osa kuvasta selviää ruutuun rajaamisesta.',
        'position_center' => 'Keskellä',
        'position_top' => 'Ylhäällä',
        'position_bottom' => 'Alhaalla',
        'position_left' => 'Vasemmalla',
        'position_right' => 'Oikealla',
        'align' => 'Kortin sijainti',
        'align_helper' => 'Missä kirjautumiskortti istuu ruudun poikki.',
        'align_center' => 'Keskellä',
        'align_start' => 'Vasemmalla',
        'align_end' => 'Oikealla',
        'opacity' => 'Kortin peittävyys',
        'opacity_helper' => 'Matalampi päästää kortin läpi enemmän kuvaa.',
        'glow' => 'Korostushohde',
        'glow_helper' => 'Sädekehä kortin ympärillä. Pois säilyttää sen reunan ja syvyyden.',
        'hide_heading' => 'Piilota otsikko',
        'hide_heading_helper' => 'Poistaa otsikon lomakkeen yläpuolelta ja jättää lomakkeen yksin.',
        'hide_footer' => 'Piilota alaosa',
        'hide_footer_helper' => 'Poistaa kortin alta rivin, joka linkittää osoitteeseen pelican.dev.',
        'above' => 'Rivi lomakkeen yläpuolella',
        'above_helper' => 'Yksi rivi, näytetään jokaiselle kirjautumisruudulle tulevalle. Jätä tyhjäksi, niin ei näytetä mitään.',
        'notice' => 'Viesti kortin alla',
        'notice_helper' => 'Yksi rivi, näytetään jokaiselle kirjautumisruudulle tulevalle. Jätä tyhjäksi, niin ei näytetä mitään.',
    ],

    'advanced' => [
        'css' => 'Oma CSS',
        'css_helper' => 'Enintään 100 kt. Tallennetaan storage-hakemistoon, ei .env-tiedostoon.',
        'reference' => 'CSS-hakemisto',
        'reference_helper' => 'Jokainen muuttuja ja luokka, jonka tämä teema ja paneeli tarjoavat.',
    ],

    'areas' => [
        'add' => 'Lisää alue',
        'area' => 'Alue',
        'inherit' => 'Yhteinen',
        'radius' => 'Kulmat',
        'radius_sharp' => 'Terävät',
        'radius_normal' => 'Normaalit',
        'radius_round' => 'Pyöreät',
        'surface' => 'Pinnan väri',
        'surface_helper' => 'Tämän alueen sisällä olevat kortit ja paneelit; vaaleammat ja tummemmat sävyt johdetaan siitä.',
        'names' => [
            'terminal' => 'Terminaali',
            'console' => 'Konsoli (loput sivusta)',
            'files' => 'Tiedostosivu',
            'edit' => 'Muokkaussivu',
            'server' => 'Muut palvelinsivut ja välilehdet',
        ],
    ],

    'bars' => [
        'base' => 'Perusväri',
        'base_green' => 'Vihreä',
        'base_accent' => 'Korostusväri',
        'warning' => 'Meripihka alkaen',
        'danger' => 'Punainen alkaen',
    ],

    'icons' => [
        'stroke' => 'Viivan paksuus',
        'stroke_thin' => 'Ohut',
        'stroke_normal' => 'Normaali',
        'stroke_bold' => 'Paksu',
        'scale' => 'Koko',
        'accent' => 'Valikkokuvakkeet korostusvärillä',
        'accent_helper' => 'Koskee sivupalkin ja topbarin kuvakkeita.',
        'pack' => 'Kuvakepaketti',
        'pack_helper' => 'Mistä joukosta alla oleva valitsin hakee. Jokainen palvelimelle asennettu kuvakejoukko tarjotaan, sekä tämän lisäosan mukana tuleva Essentials-joukko ja jokainen lataamasi paketti. Yksi ero on tietämisen arvoinen: viivakuvake piirretään valikon värillä ja seuraa osoitusta ja aktiivista riviä, kun taas Essentials-kuvakkeet ovat kuvia ja säilyttävät sen sijaan omat värinsä. Sen ratkaisee se, mikä tiedosto on, eikä se, mistä joukosta se tuli.',
        'pack_custom' => 'Ladattu paketti',
        'pack_shipped' => 'Essentials-kuvakkeet',
        'use_shipped' => 'Käytä Essentials-kuvakkeita kaikkialla',
        'use_shipped_confirm' => 'Asettaa paketiksi Essentials-kuvakkeet ja täyttää jokaisen alla olevan valikkorivin sille piirretyllä kuvakkeella — konsoli saa terminaalin, käynnistys saa käynnistyspainikkeen, ja niin edelleen. Se korvaa nykyiset rivisi, eikä mitään tallenneta ennen kuin painat Tallenna, joten sivun sulkeminen peruu sen.',
        'pack_upload' => 'Lataa paketti',
        'pack_upload_helper' => '.zip, jossa on SVG-tiedostoja. Jokaisesta tiedostosta tulee sen mukaan nimetty kuvake — logo.svg:stä tulee custom-logo. Lataaminen korvaa nyt paikallaan olevan paketin. Yli 256 kt:n tiedostot ja kaikki yli 4 000 kuvakkeen jätetään pois, ja saat tietää kuinka monta: mittatikuksi koko Tabler-joukko on lähes kuusituhatta kuvaketta noin kolmessa megatavussa, joten paljon suurempi paketti kantaa jotain muuta kuin kuvakkeita, ja suurin osa siitä ohitetaan. Iso lataus voidaan myös torjua ennen kuin tämä kenttä sanoo mitään, paneelin isäntäkoneen php.ini-tiedoston asetuksilla upload_max_filesize ja post_max_size — mikään asetus täällä ei voi nostaa niitä.',
        'pack_partial' => ':count kuvaketta asennettu, mutta ei kaikkia',
        'pack_partial_body' => 'Ohitettu: :big liian isoa kuvakkeeksi, :unusable käyttökelvotonta SVG:nä, :duplicate nimellä joka on jo varattu, :empty jäi ilman piirrettävää siivottuina. Yli 256 kt:n SVG on lähes aina kuva sellaisen sisään pakattuna eikä piirros — vie se kuvakekokoisena, niin siitä tulee pari kilotavua. Kuvake, joka jää ilman piirrettävää, sisälsi vain sellaista, mitä tämä ei tarjoile — jos kyseessä on kokonainen paketti, se on ilmoittamisen arvoista.',
        'pack_stopped_files' => 'Se pysähtyi myös rajaan siitä, kuinka monta kuvaketta paketti saa sisältää.',
        'pack_stopped_size' => 'Se pysähtyi myös siksi, että loppu paketista avautuu suuremmaksi kuin paneeli voi pitää muistissa kerralla — zip voi olla sitä pienempi, sillä SVG pakkautuu noin viisi yhteen.',
        'overrides' => 'Korvaa kuvakkeita',
        'overrides_helper' => 'Yksi rivi kutakin kuvaketta kohti, jonka haluat muutettavan. Valitse valikkokohta, ja valitse sitten kuvake yllä olevasta paketista, anna osoite, tai lataa oma kuva. Jos useampi kuin yksi on täytetty, lataus voittaa, sitten osoite, sitten paketti.',
        'overrides_key' => 'Valikkokohta',
        'overrides_value' => 'Kuvake paketista',
        'overrides_url' => 'Tai osoite',
        'overrides_url_helper' => 'https-osoite itse isännöimääsi kuvaan — CDN, bucket, mikä tahansa minne selain yltää. Paneeliin ei kopioida mitään, joten tiedoston vaihtaminen siinä osoitteessa muuttaa kuvakkeen koskematta tähän sivuun; kääntöpuoli on kuvake, joka katoaa kun osoite katoaa. Se säilyttää omat värinsä, kuten ladattu kuva.',
        'overrides_file' => 'Tai lataa kuva',
        /*
         * Kertoo, mikä ero oikeasti on, sillä se ei ole itsestään selvä ja se on
         * se syy, jonka vuoksi valitaan toinen eikä toista.
         */
        'overrides_file_helper' => 'PNG, SVG tai ICO. Paketista tuleva kuvake piirretään valikon omalla värillä ja seuraa osoitusta ja aktiivista riviä; ladattu kuva säilyttää omat värinsä eikä tee niin. Logolle se on yleensä se, mitä halutaan.',
        'overrides_add' => 'Korvaa vielä yksi kuvake',
        'overrides_search' => 'Kirjoita nimi, tai valikkokohta…',
    ],

    /*
     * Ei brändin alla. Brändi koskee sitä, miltä paneeli näyttää; tämä koskee
     * sitä, miten tämä lisäosa näyttäytyy siinä, ja se on eri kysymys, johon
     * vastataan eri sivulla.
     */
    'identity' => [
        'nav_icon' => 'Kuvake riville ”Essentials-asetukset”',
        'nav_icon_helper' => 'PNG, SVG tai ICO, enintään 8 Mt. Korvaa kuvakkeen juuri sillä yhdellä sivupalkin rivillä; jätä tyhjäksi saadaksesi sen, jonka tämä lisäosa toimittaa. Se piirretään kuvana eikä kuvakkeena, joten se säilyttää omat värinsä eikä seuraa tekstiä — mikä on yleensä se, mitä logo haluaa. Tiedosto tarjoillaan eikä upoteta, joten jokainen selain hakee sen kerran, mutta silti kannattaa viedä jotain pientä: pari kilotavua riittää hyvin kahdenkymmenen pikselin riville. Jos lataus epäonnistuu ennen kuin tämä kenttä sanoo mitään, raja johon se osui on upload_max_filesize paneelin php.ini-tiedostossa.',
    ],
];
