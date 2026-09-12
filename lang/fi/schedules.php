<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Cron” jää paikalleen: se on paneelin isäntäkoneella ajettavan asian nimi, ja
 * sitä etsivä hakee juuri sillä sanalla.
 */

return [
    'nav_label' => 'Ajastukset',
    'title' => 'Mikä ajastus on pysähtynyt',
    'subheading' => 'Jokainen paneelin ajastettu tehtävä, pahin ensin - jumissa yli :hours tuntia, myöhässä, tai ei koskaan ajettu.',

    'how' => 'Pelican näyttää ajastukset kunkin palvelimen sisällä, ja sen omalla tilalla on niille kolme sanaa: pois, käsittelee, aktiivinen. Yksikään niistä ei ole ”tämä pysähtyi”. Kesken kaatunut ajo jää ikuisesti tilaan käsittelee ja näyttää täsmälleen samalta kuin nyt ajossa oleva; ajastus, jonka aika meni tunteja sitten cronin kuoltua, on yhä nimeltään aktiivinen. Tämä sivu kysyy sen toisen kysymyksen. Vain luku - kaikki, mikä muokkaa, ajaa tai poistaa ajastuksen, pysyy Pelicanin omalla sivulla sille palvelimelle.',

    'column_state' => 'Tila',
    'column_name' => 'Ajastus',
    'column_server' => 'Palvelin',
    'column_last' => 'Viimeisin ajo',
    'column_next' => 'Seuraava ajo',

    /*
     * Viisi tuomiota. Kirjoitettu siksi, mikä on totta, eikä ohjeeksi, koska
     * kolme niistä on katsomisen arvoisia ja kaksi ei.
     */
    'state_stuck' => 'Jumissa',
    'state_overdue' => 'Myöhässä',
    'state_never' => 'Ei koskaan ajettu',
    'state_healthy' => 'Kunnossa',
    'state_off' => 'Pois',

    'filter_stuck' => 'Jumissa',
    'filter_overdue' => 'Myöhässä',
    'filter_never' => 'Ei koskaan ajettu',
    'filter_off' => 'Sammutettu',

    'open' => 'Avaa palvelimella',

    'empty' => 'Ei ajastuksia yhdelläkään tavoittamallasi palvelimella - tai ei yhtään pysähtynyttä, jos suodatin on päällä.',
];
