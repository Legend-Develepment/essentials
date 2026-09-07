<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Yleisnäkymän lohko: kone, jolla paneeli itse on, ja jokainen node.
 *
 * Nodejen luvut ovat Pelicanin omia, luettu kunkin noden daemonilta.
 * Paneelirivi luetaan /proc-hakemistosta, mikä on eri kysymys - katso
 * Support\SystemStatus.
 *
 * ”Node” jää paikalleen: se on Pelicanin sana kaikkialla, ja käännös olisi vain
 * toinen nimi samalle asialle.
 */

return [
    // Lohkon otsikko on lisäosan oma nimi, luettu ajon aikana, joten sille ei
    // ole merkkijonoa täällä.
    'panel' => 'Tämä paneeli',
    'offline' => 'ei vastaa',
    'maintenance' => 'huolto',
    'cpu' => 'Suoritin',
    'memory' => 'Muisti',
    'disk' => 'Levy',
    'load' => 'Kuorma',
];
