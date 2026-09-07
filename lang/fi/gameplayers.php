<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Ketkä ovat palvelimella niissä peleissä, jotka vastaavat Valven kyselyyn.
 *
 * Yksi sivu Rustille, ARKille, Valheimille ja muille, koska ne vastaavat samaan
 * pakettiin. Peleittäin eroaa se, mitä jollekulle voi tehdä - potkiminen on
 * yhdessä `kick "nimi"` ja toisessa `KickPlayer <id>` - ja siksi tämä sivu
 * lukee eikä toimi.
 */

return [
    'title' => 'Pelaajat',
    'nav_label' => 'Pelaajat',
    'subheading' => 'Ketkä ovat yhteydessä, kysytty peliltä itseltään eikä paneelilta.',

    'refresh' => 'Kysy uudelleen',

    'count' => 'Yhteydessä: :count',
    'score' => 'Pisteet',

    'just_joined' => 'liittyi juuri',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Kukaan ei ole tällä palvelimella.',

    /*
     * Ei ”kukaan ei ole paikalla”, ja ero on merkittävä.
     *
     * Paneeli ja peliportti ovat usein verkoissa, jotka eivät tavoita toisiaan,
     * ja sen piirtäminen tyhjäksi listaksi olisi tämän sivun väite asiasta,
     * jota se ei tiedä.
     */
    'unreachable' => 'Palvelin ei vastannut. Se voi olla käynnistymässä, tai paneeli ei ehkä tavoita sen peliporttia sieltä, missä se ajaa — se on eri asia kuin se, ettei kukaan ole paikalla.',
];
