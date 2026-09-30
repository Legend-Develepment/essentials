<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Asetukset tiedostona: ulos ja takaisin sisään.
 *
 * Ladatut tiedostot eivät ole siinä mukana tarkoituksella - katso
 * Support\Portable miksi sen sanominen on parempi kuin niiden hiljainen pois
 * jättäminen.
 */

return [
    'export' => 'Vie asetukset',
    'records' => 'Vie tietueet',
    'records_helper' => 'Kaikki paketit, tilaukset, laskut, maksut ja tiketit yhtenä tiedostona. Tämän laajennuksen poistaminen hävittää ne kaikki eikä Pelican kysy mitään etukäteen, joten tämä on se kopio joka otetaan ennen sitä. API-avaimet eivät ole mukana: avainta ei palauteta tiedostosta, se myönnetään uudelleen.',
    'import' => 'Tuo asetukset',
    'apply' => 'Tuo',

    'file' => 'Asetustiedosto',
    'file_helper' => 'Tästä lisäosasta viety tiedosto. Kuvat ja kuvakepaketit eivät ole siinä - ne ovat tiedostoja levyllä, ja ne jäävät sellaisiksi kuin ovat.',

    'summary' => 'Mitä tämä muuttaisi',
    'summary_none' => 'Valitse tiedosto nähdäksesi, mitä se muuttaisi.',
    'summary_unreadable' => 'Tämä ei ole tämän lisäosan asetustiedosto, tai siinä ei ole mitään, minkä tämä paneeli tunnistaisi.',
    'summary_same' => 'Ei mitään. Jokainen asetus siinä tiedostossa vastaa jo tätä paneelia.',
    'summary_count' => '{1} Yksi asetus muuttuisi.|[2,*] :count asetusta muuttuisi.',
    'summary_more' => '· ja :count muuta',

    'imported' => 'Asetukset tuotu',
    'missing' => 'Näitä kuvia ei ole tässä paneelissa, joten ne jätetään pois: :files',
    'failed' => 'Tiedostoa ei saatu tuotua',
    'no_file' => 'Yhtään tiedostoa ei saapunut. Paneeli siivoaa pois latauksen, joka odottaa liian kauan ennen kuin Tuo-painiketta painetaan - valitse tiedosto uudelleen ja tuo se heti perään.',
    'denied' => 'Sinulla ei ole oikeutta muuttaa näitä asetuksia.',
];
