<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Lisät, joita myydään paketin rinnalla.
 *
 * Kaksi asiaa pidetään täällä erillään. Se mitä lisä *maksaa* on sen hinta,
 * ja juuri se veloitetaan joka kerta. Se mitä se maksaa *tänään* on osuus
 * siitä, koska kesken kuukauden ostava maksaa puolesta kuukaudesta. Asiakkaalle
 * näkyvä teksti sanoo aina kummasta on kyse.
 *
 * "Ei lisää palvelimelle mitään" on oikea vastaus ja se sanotaan ääneen sen
 * sijaan että jätettäisiin tyhjäksi, koska etusija tuessa on aivan tavallinen
 * myytävä asia ja tyhjä solu näyttää virheeltä.
 */

return [
    'title' => 'Lisät',
    'nav_label' => 'Lisät',
    'subheading' => 'Asioita joita myydään paketin rinnalla: lisää muistia, toinen varmuuskopiopaikka, tai jotain mikä on vain rivi laskulla.',

    // ---- taulukko ---------------------------------------------------------
    'column_name' => 'Lisä',
    'column_price' => 'Hinta',
    'column_adds' => 'Lisää',
    'column_sold' => 'Käytössä',
    'column_live' => 'Myynnissä',
    'adds_nothing' => 'Ei mitään palvelimelle',

    // ---- lomake -----------------------------------------------------------
    'section_what' => 'Mikä se on',
    'section_what_helper' => 'Nimi ja hinta jotka asiakas näkee, ja se minkä pakettien kanssa sen voi ostaa.',
    'name' => 'Nimi',
    'price' => 'Hinta',
    'price_helper' => 'Mitä se maksaa joka kerta kun se veloitetaan. Kesken jakson ostettuna asiakas maksaa osuuden tästä ja koko summan seuraavasta uusinnasta alkaen.',
    'billing' => 'Veloitetaan',
    'billing_helper' => 'Palvelun mukana tarkoittaa, että se palaa jokaisella uusinnalla niin kauan kuin hän sen pitää. Kerran tarkoittaa, että se veloitetaan sillä laskulla joka kantaa sen ensimmäisenä, eikä koskaan enää.',
    'billing_with' => 'Jokaisella uusinnalla',
    'billing_once' => 'Kerran',
    'max' => 'Enintään palvelua kohti',
    'max_helper' => 'Kuinka monta tätä yksi ihminen saa pitää. Yksi on tavallinen tapaus; nosta sitä sellaiselle, jota myydään gigatavuittain.',
    'description' => 'Kuvaus',
    'description_helper' => 'Yksi rivi nimen alla tilaussivulla. Sano mitä se tekee, älä mikä sen nimi on.',
    'packages' => 'Paketit',
    'packages_helper' => 'Minkä pakettien kanssa tämän voi ostaa. Ei mitään rastittuna tarkoittaa kaikkia, ja sellainen tukivaihtoehto tai varmuuskopiopaikka yleensä on.',

    'section_adds' => 'Mitä se lisää palvelimelle',
    'section_adds_helper' => 'Nämä lisätään siihen mitä paketti jo antaa, niitä ei aseteta sen tilalle: 4096 muistissa tekee palvelimesta 4 GiB isomman. Kaksi samaa lisää lasketaan yhteen. Jätä kaikki nollaan sellaiselle, joka on vain rivi laskulla. Negatiivinen luku ottaa jotain pois, mikä on sallittua ja toisinaan juuri sitä mitä joku haluaa.',
    'sort' => 'Järjestys',
    'sort_helper' => 'Pienempi tulee ensin tilaussivulla. Yhtä suurissa ratkaisee hinta.',
    'live' => 'Myynnissä',
    'live_helper' => 'Pois päältä sitä ei tarjota missään. Se jolla se jo on pitää sen ja sitä laskutetaan siitä edelleen.',

    // ---- painikkeet -------------------------------------------------------
    'new' => 'Uusi lisä',
    'edit' => 'Muokkaa',
    'delete' => 'Poista',
    'delete_confirm' => 'Kenelläkään ei ole tätä. Poistaminen vie sen listalta lopullisesti.',
    'delete_sold' => 'Palveluita joilla tämä on: :count. He pitävät sen, pitävät ne rajat jotka se antoi ja heitä laskutetaan siitä edelleen - se mikä lähtee on rivi listalta, jottei kukaan uusi voi ostaa sitä.',
    'go_live' => 'Aseta myyntiin',
    'go_offline' => 'Ota pois myynnistä',
    'saved' => 'Tallennettu',
    'deleted' => 'Lisä on poissa',
    'save_failed' => 'Ei tallennettu',
    'save_failed_body' => 'Mitään ei kirjoitettu. Yritä uudelleen, ja katso lokiin jos se jatkuu.',
    'invalid' => 'Lisä tarvitsee nimen ja hinnan.',
    'empty' => 'Ei vielä lisiä',
    'empty_body' => 'Lisä on jotain mitä myydään paketin rinnalla: gigatavu lisää, toinen varmuuskopiopaikka, tai palvelu joka ei lisää palvelimelle yhtään mitään.',

    // ---- mitä asiakas näkee -----------------------------------------------
    'choose' => 'Lisät',
    'choose_helper' => 'Vapaaehtoisia, ja voit lisätä tai poistaa niitä myöhemmin.',
    'yours' => 'Tämän palvelun lisät',
    'add' => 'Lisää lisä',
    'add_helper' => 'Maksat nyt siitä mitä tästä jaksosta on jäljellä, ja koko hinnan seuraavasta uusinnasta alkaen.',
    'add_to' => 'Lisää :name',
    'add_confirm' => 'Lisätäänkö :name tähän palveluun?',
    'drop' => 'Poista',
    'drop_confirm' => 'Poistetaanko :name? Käyttämätön osa siitä mitä olet maksanut palautuu tilillesi, ja palvelimesi muuttuu heti.',
    'costs_now' => ':amount nyt',
    'free_now' => 'Ei mitään maksettavaa nyt',
    'then' => 'sitten :amount uusinnalta',
    'once_only' => ':amount, kerran',
    'each' => 'kappale',
    'added' => ':name lisätty',
    'added_body' => 'Palvelimesi on saanut sen mitä se lisää.',
    'dropped' => ':name poistettu',
    'dropped_body' => 'Se minkä olit maksanut mutta et käyttänyt on tililläsi.',

    // ---- ja kun se ei onnistu ---------------------------------------------
    'refused' => 'Sitä ei voitu tehdä',
    'refused_off' => 'Lisät ovat pois päältä tässä paneelissa.',
    'refused_not_active' => 'Vain käynnissä olevaan palveluun voi lisätä lisiä.',
    'refused_gone' => 'Tuo lisä ei ole enää myynnissä.',
    'refused_wrong_package' => 'Tuota lisää ei myydä tämän paketin kanssa.',
    'refused_enough' => 'Sinulla on niitä jo niin monta kuin tämä palvelu saa pitää.',
    'refused_failed' => 'Mitään ei kirjattu ylös, joten mikään ei ole muuttunut. Yritä uudelleen, ja kerro sille joka pitää tätä paneelia jos se jatkuu.',
    'refused_server' => 'Palvelin ei ottanut uusia rajoja vastaan, joten mitään ei muutettu eikä mitään veloitettu.',
    'refused_not_yours' => 'Tuo lisä ei ole tässä palvelussa.',

    // ---- mitä asiakirjoissa lukee -----------------------------------------
    'line' => ':name × :many, tämän jakson jäljellä olevilta :days päivältä',
    'credit_reason' => 'Poistettu: :name',
    'bell_failed' => 'Lisää ei saatu annettua palvelimelle tilauksessa :number',

    // ---- yksiköt, ylläpitäjän taulukkoon ----------------------------------
    'unit_memory' => 'MiB muistia',
    'unit_swap' => 'MiB swappia',
    'unit_disk' => 'MiB levyä',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'tietokantaa',
    'unit_allocation_limit' => 'allokaatiota',
    'unit_backup_limit' => 'varmuuskopiota',
];
