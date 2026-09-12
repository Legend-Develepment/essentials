<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Vahtikoira.
 *
 * Jokainen viesti täältä luetaan puhelimesta, kolmelta yöllä, ihmisen toimesta
 * joka nukkui minuutti sitten. Kukin kertoo minkä koneen, mikä on vialla, eikä
 * enempää - yksityiskohta kuuluu sille sivulle, jonka hän avaa jälkeenpäin, ei
 * siihen riviin joka hänet herätti.
 *
 * Se, että jokin on korjaantunut, on kirjoitettu uutisena eikä alaviitteenä.
 * ”Onko se jo takaisin” on se kysymys, jonka vuoksi joku muuten nousisi ylös.
 *
 * ”Node”, ”Wings”, ”daemon”, ”webhook”, ”queue”, ”Discord” ja ”SMTP” jäävät
 * englanniksi: niillä nimillä ne löytää Pelicanista, isäntäkoneelta ja kaikesta
 * mitä niistä kirjoitetaan.
 */

return [
    'title' => 'Hälytykset',
    'nav_label' => 'Hälytykset',
    'subheading' => 'Paneeli tietää jo, milloin node lakkaa vastaamasta, milloin levy täyttyy, tai milloin jono pysähtyy. Tämä on se, mikä kertoo siitä sinulle.',

    // ---- kanavat ja mitä ne viimeksi tekivät ------------------------------
    'channels' => 'Minne viestit menevät',
    'channels_helper' => 'Mitä kukin kanava teki viimeksi, kun sitä pyydettiin lähettämään jotain. Kanava, joka on päällä ja torjuu hiljaa, näyttää täsmälleen samalta kuin paneeli jossa ei ole mitään vikaa, ja siksi tämä on sivulla ensimmäisenä.',

    'state_off' => 'Pois',
    'state_untried' => 'Mitään ei ole vielä lähetetty',
    'state_ok' => 'Toimitettu',
    'state_failed' => 'Torjuttu',

    // ---- milloin -----------------------------------------------------------
    'when' => 'Kuinka usein',
    'when_helper' => 'Tarkistukset ajetaan taustalla, joten ne vaativat queue workerin. Ilman sellaista mitään ei lähetetä, eikä mikään kerro siitä - käytä ”Lähetä koe”, joka ei kulje jonon kautta.',

    'every' => 'Tarkista joka',
    'every_helper' => 'Jokainen tarkistus tavoittaa kunkin noden daemonin, joten se on yksi pyyntö nodea ja kierrosta kohti. Viisitoista minuuttia riittää kuulemaan katkoksesta, kun se on vielä katkos.',
    'every_off' => 'Pois - ei tarkistuksia lainkaan',
    'every_five' => '5 minuuttia',
    'every_fifteen' => '15 minuuttia',
    'every_thirty' => '30 minuuttia',
    'every_hourly' => 'Tunti',
    'every_daily' => 'Vuorokausi',

    'repeat' => 'Muistuta minua niin kauan kuin se kestää',
    'repeat_helper' => 'Viesti lähetetään, kun jokin muuttuu, ja toinen kun se korjaantuu. Tämä lisää muistutuksen niin kauaksi aikaa kuin ongelma on yhä käynnissä. Nolla tarkoittaa ei muistutuksia - kanava, joka toistaa itseään vartin välein, on kanava jonka ihmiset vaimentavat.',
    'hours' => 'tuntia',

    // ---- minne -------------------------------------------------------------
    'where' => 'Kanavat',
    'where_helper' => 'Useampi kuin yksi on järkevää. Ne pettävät eri tavoin.',

    'discord' => 'Discord',
    'discord_helper' => 'Paikka, jossa viestin oikeasti lukee joku, joka ei istu katsomassa paneelia.',
    'webhook' => 'Webhook-osoite',
    'webhook_helper' => 'Discordissa: Palvelimen asetukset → Integraatiot → Webhookit → Uusi webhook → Kopioi webhookin URL. Rajattu https:ään, sillä tämä julkaisee, mikä koneistasi on alhaalla ja kuinka täysi sen levy on.',
    'bot' => 'Oma botti',
    'bot_helper' => 'Yksi allekirjoitettu JSON-lähetys osoitteeseen, jota itse pyörität, jotta jokin paneelin ulkopuolinen kuulee kuolleesta nodesta sen sijaan, että kysyisi joka minuutti onko sellaista. Pelicanin omat webhookit eivät pysty kantamaan tätä: ne laukeavat malleista ja toimintalokista, eikä vastaamasta lakannut node kirjoita kumpaakaan.',
    'bot_url' => 'Mihin se lähetetään',
    'bot_url_helper' => 'Rajattu https:ään, sillä tämä lähettää sen, mikä koneistasi on alhaalla, osoitteeseen internetissä.',
    'bot_secret' => 'Allekirjoituksen salaisuus',
    'bot_secret_helper' => 'Jaettu sen kanssa, mikä tämän vastaanottaa. Runko tiivistetään sillä, ja tiiviste kulkee X-Essentials-Signature-otsakkeessa muodossa sha256=<hex>, joten bottisi voi kieltäytyä kaikesta, mikä ei tullut tästä paneelista. Mitään ei lähetetä niin kauan kuin tämä on tyhjä - allekirjoitus, joka on vapaaehtoinen, on sellainen jota kukaan ei tarkista.',

    'panel' => 'Paneelissa',
    'panel_helper' => 'Ilmoitus kaikille, joilla on tämä oikeus. Toimii aina, ei vaadi asetuksia, ja on näkymätön kaikille, jotka eivät ole kirjautuneet.',

    'email' => 'Sähköposti',
    'email_helper' => 'Pilkuilla eroteltuina. Käyttää paneelin omaa mailer-asetusta - luotettava kun se on asetettu, ja täysin hiljainen kun ei ole, ja se on se yksi vika, jota vahtikoiralla ei saa olla. Jätä tyhjäksi sammuttaaksesi sen.',

    // ---- mitä --------------------------------------------------------------
    'what' => 'Mitä pidetään silmällä',
    'what_helper' => 'Jokainen lukema täällä on sellainen, jonka paneeli jo ottaa. Mikään tällä sivulla ei avaa yhteyttä, jota Järjestelmän tila ei avaa.',

    'percent_helper' => 'Nolla sammuttaa tämän tarkistuksen.',
    'disk' => 'Hälytä, kun noden levy on yli',
    'memory' => 'Hälytä, kun noden muisti on yli',

    'maintenance' => 'Hälytä huollosta, joka on kestänyt yli',
    'maintenance_helper' => 'Huollossa oleva node ohitetaan kaikissa muissa tarkistuksissa, ja se on oikein - ja niin sellainen myös unohtuu neljäksitoista päiväksi. Nolla sammuttaa sen.',

    'versions' => 'Paneelin ja Wingsin versiot',
    'versions_helper' => 'Yksi viesti, kun jokin on jäljessä, ja yksi kun se on taas ajan tasalla. Ei muistutuksia - versio ei ole katkos.',

    'backups' => 'Jäljessä olevat varmuuskopiot',
    'backups_helper' => 'Yksi viesti, joka mainitsee palvelimet, eikä yhtä palvelinta kohti - kun ajastettu tehtävä pysähtyy, kaikki palvelimet vanhentuvat kerralla, ja neljäkymmentä erillistä viestiä yhdestä syystä on kanava, jonka ihmiset vaimentavat. Pois oletuksena: paneeli, joka kopioi käsin eikä ajastuksella, saisi kuulla siitä joka päivä.',
    'backup_days' => 'Kutsu kopiota vanhentuneeksi',
    'backup_days_helper' => 'Se on myös se, mitä Varmuuskopiot-sivu käyttää. Viikoittain kopioitavaa palvelinta ei pidä ilmoittaa kahdeksan päivän jälkeen.',
    'days' => 'päivän jälkeen',

    'stock' => 'Loppumassa olevat paketit',
    'stock_helper' => 'Yksi viesti, joka mainitsee paketit, eikä yhtä pakettia kohti, eikä koskaan muistutusta: se, että jokin on loppuunmyyty, on kaupan tavallinen tila eikä katkos, ja siitä kuuleminen neljän tunnin välein on se tapa, jolla tämä lakkaa tulemasta luetuksi. Katsotaan vain paketteja, joilla on yläraja, joten kauppa, joka myy kaiken ilman rajaa, ei maksa mitään pitää silmällä. Pois oletuksena, kuten muutkin.',
    'stock_left' => 'Hälytä, kun jäljellä on enää',
    'stock_left_helper' => 'Lasketaan paketin ylärajaa vasten. Paketin on pudottava tähän lukuun tai sen alle tullakseen ilmoitetuksi, ja noustava kaksi sen yli tullakseen taas terveeksi kutsutuksi, joten sellainen, jota osto ja peruutus työntävät edestakaisin, ei sano mitään. Nolla on tässä luku eikä puuttuva arvo: se pitää varoituksen hiljaisena ja jättää jäljelle vain sen viestin, joka kertoo paketin loppuneen.',
    'stock_left_suffix' => 'tai vähemmän',

    'worker' => 'Queue worker',
    'worker_helper' => 'Tekeekö mikään tämän lisäosan taustatyötä. Huomaa kehä: itse tarkistus ajetaan jonossa, joten paneeli, jolla ei ole koskaan ollut workeria, ei voi ilmoittaa siitä. Rivi tämän sivun yläreunassa voi.',

    // ---- painikkeet --------------------------------------------------------
    'save' => 'Tallenna',
    'saved' => 'Tallennettu',
    'save_failed' => 'Mitään ei tallennettu',

    'test' => 'Lähetä koe',
    'test_one' => 'Kokeile',
    'test_off' => 'Se kanava on pois päältä',
    'test_off_body' => 'Laita se päälle ja tallenna, niin sitä kokeillaan muiden mukana.',
    'test_title' => 'Koeviesti',
    'test_body' => 'Jos luet tätä, hälytykset Pelican-paneelistasi tulevat tänne. Mitään ei ole vialla.',
    'test_sent' => 'Lähetetty jokaiselle päällä olevalle kanavalle',
    'test_failed' => 'Ainakin yksi kanava torjui sen',
    'test_none' => 'Ei ole minnekään lähettää',
    'test_none_body' => 'Yksikään kanava ei ole päällä, joten oikeakaan hälytys ei päätyisi minnekään.',

    /*
     * Mitä torjunnalle tehdään.
     *
     * Palveluntarjoajan oma perustelu on lyhyt ja oikea ja yksinään
     * hyödytön. Ne kaksi, jotka nousevat esiin lähes joka kerta, mainitaan
     * nimeltä, sillä kumpaakaan ei voi arvata koodista: 553 koskee lähettäjää
     * eikä vastaanottajaa, ja 401 Discordilta on peruttu tai väärin kirjoitettu
     * URL.
     */
    'hint_email_sender' => 'SMTP-palvelimesi torjui sen osoitteen, josta paneeli lähettää, ei sitä johon se lähetti. Kohdassa Admin → Asetukset → Sähköposti Lähettäjä-osoitteen on oltava postilaatikko, jona SMTP-tilisi saa lähettää. Sillä ei ole mitään tekemistä tämän lisäosan kanssa - Pelicanin oma koesähköposti sillä sivulla epäonnistuu täsmälleen samalla tavalla.',
    'hint_email' => 'Katso kohdasta Admin → Asetukset → Sähköposti. Koesähköpostin painike sillä sivulla käyttää samoja asetuksia ja sanoo saman.',
    'hint_discord_url' => 'Discord ei tunnistanut sitä webhookia. Se on poistettu, luotu uudelleen, tai liitetty vaillinaisena - luo uusi kohdasta Palvelimen asetukset → Integraatiot → Webhookit, ja kopioi koko URL.',
    'hint_discord' => 'Paneeli ei tavoittanut Discordia. Jos tämä paneeli on palomuurin takana, joka estää ulospäin lähtevät pyynnöt, tämä kanava ei voi toimia täältä.',
    'hint_panel' => 'Kenelläkään ei ole tähän oikeutta, tai ilmoitusta ei saatu tallennettua. Katso kohdasta Roolit.',

    'run_now' => 'Aja tarkistukset nyt',
    'run_started' => 'Tarkistetaan taustalla',
    'run_failed' => 'Tarkistuksia ei saatu käyntiin',

    'reset' => 'Unohda mitä se tietää',
    'reset_confirm' => 'Tyhjentää sen, mitä kukin tarkistus viimeksi sanoi. Seuraava kierros oppii tyhjästä eikä lähetä mitään, joten yhä käynnissä oleva ongelma ilmoitetaan sitä seuraavalla kierroksella. Käytä tätä sen jälkeen, kun olet ottanut pois käytöstä noden, josta vahtikoira jatkaa jankuttamista.',
    'reset_done' => 'Tyhjennetty',

    // ---- itse viestit ------------------------------------------------------
    'still' => 'Kestänyt: :for.',
    'cleared_body' => 'Se oli ollut niin: :for.',

    'for_unknown' => 'jonkin aikaa',
    'for_minutes' => ':count minuuttia',
    'for_hours' => ':count tuntia',
    'for_days' => ':count päivää',

    'node_down' => ':node ei vastaa',
    'node_down_body' => 'Paneeli ei tavoita daemonia nodella :node. Sen palvelimet eivät käynnisty, pysähdy eivätkä ilmoita mitään ennen kuin se on takaisin.',
    'node_up' => ':node vastaa taas',

    'node_disk' => ':node on loppumassa levytila',
    'node_disk_body' => 'Levy nodella :node on :percent % täynnä, yli asettamasi :limit %. Varmuuskopiot ja palvelinasennukset ovat ensimmäiset, jotka pettävät kun tämä tulee täyteen.',
    'node_disk_over' => 'Levy nodella :node on taas rajan alla',

    'node_memory' => ':node on loppumassa muisti',
    'node_memory_body' => 'Muisti nodella :node on :percent % käytössä, yli asettamasi :limit %. Ydin voi tappaa sen palvelimet ennen kuin mikään ilmoittaa ongelmasta.',
    'node_memory_over' => 'Muisti nodella :node on taas rajan alla',

    'node_maintenance' => ':node on ollut huollossa pitkään',
    'node_maintenance_body' => ':node on ollut huollossa yli :hours tuntia. Sillä välin siitä ei tarkisteta mitään muuta, ja se on koko pointti - mutta on tietämisen arvoista, että se on yhä niin.',
    'node_maintenance_over' => ':node on pois huollosta',

    'wings_behind' => 'Wings nodella :node on vanhentunut',
    'wings_behind_body' => ':node ajaa Wingsiä :installed, ja :latest on ulkona. Päivitä se itse nodella - paneelilla ei ole mitään tapaa tehdä sitä.',
    'wings_current' => 'Wings nodella :node on ajan tasalla',

    'panel_behind' => 'Paneeli on vanhentunut',
    'panel_behind_body' => 'Tämä paneeli ajaa versiota :installed, ja :latest on ulkona.',
    'panel_current' => 'Paneeli on ajan tasalla',

    'and_more' => 'ja :count muuta',

    'owners' => 'Kerro ihmisille, kun heidän oman palvelimensa takana oleva kone on alhaalla',
    'owners_helper' => 'Ainoa tarkistus täällä, joka kirjoittaa jollekulle muulle kuin sinulle. Jokaisen vastaamasta lakanneella koneella olevan palvelimen omistaja saa yhden ilmoituksen paneelissa - kellon, ei koskaan sähköpostia - ja yhden, kun se palaa. Ei koskaan muistutusta väliin: sen toistaminen vartin välein kaikille kiireisellä nodella on se tapa, jolla paneelin hälytykset lakkaavat tulemasta luetuiksi. Subusereille ei kerrota; omistaja on se, joka päättää mitä tehdä. Konetta ei mainita heille, samasta syystä kuin tilasivu ei julkaise sitä.',

    'owner_down' => '{1} Yksi palvelimistasi on alhaalla|[2,*] Palvelimiasi alhaalla: :count',
    'owner_down_body' => 'Kone, jolla ne ovat, on lakannut vastaamasta. Jollekulle on kerrottu. Koskee: :servers',
    'owner_up' => '{1} Palvelimesi on takaisin|[2,*] Palvelimiasi takaisin: :count',
    'owner_up_body' => 'Kone vastaa taas. Takaisin: :servers',

    'schedules' => 'Pysähtyneet ajastetut tehtävät',
    'schedules_helper' => 'Tehtävä, joka on jumissa kesken ajon, sellainen jonka aika meni koska cron ei aja, tai sellainen jota ei ole koskaan ajettu. Pelicanilla ei ole sanaa yhdellekään niistä - kaatunut ajo jää ikuisesti tilaan ”käsittelee” ja piirretään täsmälleen kuten nyt ajossa oleva. Lukee paneelin jokaisen aktiivisen ajastetun tehtävän joka tarkistuksella.',

    'schedule_stopped' => 'Pysähtyneitä ajastettuja tehtäviä: :count',
    'schedule_stopped_body' => 'Jumissa yli :hours tuntia, myöhässä, tai ei koskaan ajettu: :schedules',
    'schedule_running' => 'Kaikki ajastetut tehtävät ajavat taas',

    'stock_out' => '{1} Yksi paketti on loppuunmyyty|[2,*] Loppuunmyytyjä paketteja: :count',
    'stock_out_body' => 'Yhä myynnissä, eikä myytävää ole jäljellä: :packages',
    'stock_low' => '{1} Yksi paketti on melkein loppuunmyyty|[2,*] Melkein loppuunmyytyjä paketteja: :count',
    'stock_low_body' => 'Jäljellä :limit tai vähemmän: :packages',
    'stock_back' => '{1} Yksi paketti on taas myynnissä|[2,*] Taas myynnissä olevia paketteja: :count',
    'stock_back_body' => 'Myytävää on taas: :packages',

    'backup_none' => 'Palvelimia ilman yhtäkään varmuuskopiota: :count',
    'backup_none_body' => 'Kopiota ei ole koskaan otettu näistä: :servers',
    'backup_none_over' => 'Jokaisella palvelimella on nyt kopio',

    'backup_stale' => 'Palvelimia ilman kopiota jo jonkin aikaa: :count',
    'backup_stale_body' => 'Ei onnistunutta kopiota :days päivään näistä: :servers',
    'backup_stale_over' => 'Jokaisella palvelimella on ollut kopio äskettäin',

    'backup_failed' => 'Varmuuskopiot epäonnistuvat, palvelimia: :count',
    'backup_failed_body' => 'Kopio päättyi tuloksetta näissä: :servers',
    'backup_failed_over' => 'Yksikään varmuuskopio ei enää epäonnistu',

    'worker_missing' => 'Mikään ei tee työtä jonossa',
    'worker_missing_body' => 'Työ laitettiin jonoon, eikä mikään ottanut sitä. Lisäosien päivitykset, modpack-asennukset ja nämä tarkistukset kaikki pysähtyvät, kunnes worker ajaa - kokeile systemctl status pelican-queue paneelin koneella.',
    'worker_back' => 'Jonossa tehdään taas työtä',
    'failed_title' => 'Töitä on epäonnistunut edellisen tarkistuksen jälkeen: :count',
    'failed_body' => 'Jokin, mitä paneelin käskettiin tehdä, jäi tekemättä eikä sitä yritetä uudelleen - palvelin jota ei rakennettu, lasku jota ei kirjoitettu, viesti jota ei lähetetty. Ne ovat failed_jobs-taulussa; `php artisan queue:retry all` palauttaa ne takaisin, kun se mikä ne pysäytti on korjattu.',
    'failed_back' => 'Mikään ei ole epäonnistunut edellisen tarkistuksen jälkeen',
    'failed' => 'Kerro minulle, kun jonossa oleva työ epäonnistuu',
    'failed_helper' => 'Laravel kirjaa ylös työn, josta se on luovuttanut, eikä sano siitä mitään. Tämä sanoo. Laskettu eikä lueteltu: kaksikymmentä epäonnistumista yhdessä yössä johtuu yleensä yhdestä syystä.',
];
