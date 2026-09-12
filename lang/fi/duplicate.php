<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * ”Egg” ja ”allokaatio” jäävät paikalleen: ne ovat Pelicanin sanat, ja niitä
 * node-sivulta etsitään.
 */

return [
    'title' => 'Monista palvelin',
    'nav_label' => 'Monista palvelin',
    'subheading' => 'Toinen palvelin asetettuna täsmälleen kuten jo olemassa oleva, tai useampi kerralla.',

    'section' => 'Mitä kopioidaan',
    'section_helper' => 'Omistaja, egg, käynnistyskomento, rajat ja jokainen muuttuja kopioidaan. Tiedostot, tietokannat, varmuuskopiot ja ajastukset eivät - käynnissä olevan palvelimen tiedostojen kopio on kopio sen tilasta, ja se on harvoin se, mitä ”toinen tällainen” tarkoittaa.',

    'source' => 'Kopioi palvelimesta',
    'source_helper' => 'Kopiot päätyvät samalle nodelle kuin tämä palvelin, koska siellä sen vapaat osoitteet ovat.',

    'name' => 'Nimeä kopio',
    'name_helper' => 'Useamman kuin yhden tekeminen numeroi ne: ”Botti 1”, ”Botti 2”, ja niin edelleen.',

    'copies' => 'Kuinka monta',
    'copies_helper' => 'Valitse ensin palvelin.',
    'room' => 'Vapaita osoitteita nodella :node: :count, joten enempää ei juuri nyt voi tehdä.',
    'no_room' => 'Nodella :node ei ole yhtään vapaata osoitetta jäljellä. Kopio tarvitsee oman, joten lisää sille nodelle ensin allokaatio.',

    /*
     * Onnistumiset laskettuina eikä lueteltuina ja epäonnistumiset lueteltuina,
     * ja se on se päin, joka auttaa: kymmenen onnistunutta nimeä on tekstiseinä,
     * jota kukaan ei lue, ja se yksi epäonnistunut on ainoa lukemisen arvoinen.
     */
    'made' => 'Kopioita tehty: :count',
    'partly_failed' => 'Kopioita, joita ei voitu tehdä: :count',
    'failed' => 'Mitään ei kopioitu',
];
