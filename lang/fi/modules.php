<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Moduulisivu.
 *
 * Oma tiedostonsa eikä nurkka settings.php:stä, joka on jo tämän
 * lisäosan suurin kielitiedosto.
 */

return [
    'title' => 'Moduulit',
    'nav_label' => 'Moduulit',
    'subheading' => 'Mitä tämä lisäosa on tässä paneelissa. Kaiken täällä voi kytkeä pois, eikä pois kytkeminen koskaan poista sitä, mikä on jo kirjattu.',

    'first_title' => 'Mihin tämä paneeli on?',
    'first_helper' => 'Vastaa kerran, niin siihen sopivat osat kytketään päälle. Mitään ei lyödä lukkoon: jokainen alla oleva kytkin on yhä sinun, eikä pois kytkeminen koskaan poista sitä, mikä on jo kirjattu.',
    'first_look' => 'Lähinnä miltä se näyttää',
    'first_look_helper' => 'Värit, kirjautumisnäkymä, tiedotteet, omat linkkisi ja sivut joilla niitä muutetaan. Ei mitään joka myy, vastaa tai ulottuu ulos.',
    'first_run' => 'Palvelinten pyörittäminen, itselle tai porukalle',
    'first_run_helper' => 'Ulkonäkö, sekä se mitä palvelin näyttää ja mikä on täynnä tai pysähtynyt. Ei kauppaa, ei tikettitiskiä eikä mitään joka lähettää postia ajastimella.',
    'first_sell' => 'Hostingin myyminen asiakkaille',
    'first_sell_helper' => 'Kaikki. Kauppa ilman paikkaa vastata kysymyksiin, ja ilman mitään joka katsoo solmuja, on puolikas kauppa.',
    'first_skip' => 'Valitsen itse',

    'first_left' => 'Jätettiin ennalleen. Kytkimet ovat kaikki alla.',
    'go' => 'Määritä asetukset',

    'state_on' => 'Päällä',
    'state_part' => 'Osittain päällä',
    'state_off' => 'Pois',

    'count' => '{1} :on / :of osa päällä|[2,*] :on / :of osaa päällä',
    'parts' => '{1} Ainoa osa|[2,*] Kaikki :count osaa',

    'health_tables' => 'Sen taulut puuttuvat vielä. Minkä tahansa tallentaminen tällä sivulla luo ne.',
    'health_missing' => '{1} Yksi osa tarvitsee jotain, joka on pois päältä|[2,*] :count osaa tarvitsee jotain, joka on pois päältä',
    'health_waiting' => '{1} Yksi osa on päällä eikä näytä vielä mitään|[2,*] :count osaa on päällä eivätkä näytä vielä mitään',

    'left_access' => '{1} Yhdellä on yhä täältä annettu palvelin|[2,*] :count henkilöllä on yhä täältä annettuja palvelimia',
    'left_public_status' => '{1} Yksi julkaistu sivu ja sen osoite jäävät|[2,*] :count julkaistua sivua ja niiden osoitteet jäävät',
    'left_arranger' => '{1} Yksi tallennettu järjestys jää|[2,*] :count tallennettua järjestystä jää',
    'left_user_themes' => '{1} Yhden ihmisen valitsema tyyli jää|[2,*] :count ihmisen valitsemat tyylit jäävät',
    'left_unknown' => 'Tänne jäi jotain, eikä paneeli saanut luettua kuinka paljon.',
    'cleared' => '{1} Yksi otettu takaisin|[2,*] :count otettu takaisin',
    'clear_failed' => 'Sitä ei saatu siivottua',

    'turn_on' => 'Kytke päälle',
    'turn_off' => 'Kytke pois',

    'saved' => 'Tallennettu',
    'brought' => 'Kytkettiin päälle samalla, koska ilman niitä täällä ei toimi mikään: :names.',
    'save_failed' => 'Sitä ei voitu tallentaa',
    'read_only' => 'Saat katsoa tätä mutta et muuttaa sitä. Sen muuttaminen, mitä paneeli tarjoaa, vaatii laajemman oikeuden tähän lisäosaan.',
];
