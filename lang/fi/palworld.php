<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Palworldin maailma-asetukset sivulla tiedoston sijaan.
 *
 * Mikään täällä ei nimeä yksittäistä asetusta. Jokainen selite sillä sivulla
 * päätellään avaimesta, joka palvelimen omassa tiedostossa on - katso
 * Support\Palworld\Palworld::label() miksi nimilista olisi pahempi kuin ei
 * mitään.
 *
 * ”Pal” ja ”guild” jäävät paikalleen: ne ovat pelin omia sanoja, ja niitä
 * pelissä näkee.
 */

return [
    'title' => 'Palworld-asetukset',
    'nav_label' => 'Palworld',
    'subheading' => 'Maailma-asetukset tämän palvelimen omasta PalWorldSettings.ini-tiedostosta, luettu kun avasit tämän sivun. Muokattavissa vain palvelimen ollessa pysäytettynä.',

    'reload' => 'Lue tiedosto uudelleen',

    'save_confirm' => 'Tiedosto kirjoitetaan uudelleen näillä arvoilla. Jokainen asetus, jota tämä sivu ei näyttänyt, kirjoitetaan takaisin täsmälleen sellaisena kuin se oli, ja niin kirjoitetaan kaikki muukin tiedostossa.',
    'saved' => 'Asetukset tallennettu',
    'saved_body' => 'Ne tulevat voimaan, kun palvelin seuraavan kerran käynnistyy.',
    'save_failed' => 'Tiedostoa ei saatu kirjoitettua',

    'running' => 'Palvelin on käynnissä',
    'running_body' => 'Palworld pitää nämä asetukset muistissa ja kirjoittaa tiedoston ulos uudelleen pysähtyessään, joten nyt tallennettu muutos peruuntuisi sanaakaan sanomatta. Pysäytä palvelin ensin.',

    'groups' => [
        'server' => 'Palvelin ja yhteys',
        'world' => 'Maailma ja kertoimet',
        'pals' => 'Palit',
        'players' => 'Pelaajat',
        'building' => 'Rakentaminen, esineet ja kerääminen',
        'guild' => 'Guildit',
        'other' => 'Muut',
    ],
];
