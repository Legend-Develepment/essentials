<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Tallenna',
    'saved' => 'Tallennettu',
    'restart' => 'Peli lukee tämän tiedoston käynnistyessään, joten käynnistä palvelin uudelleen jotta muutos tulee voimaan.',
    'failed' => 'Tallennus ei onnistunut',
    'failed_write' => 'Daemon hylkäsi kirjoituksen. Tarkista että palvelin on tavoitettavissa eikä tiedosto ole vain luku.',
    'read_only' => 'Voit lukea tämän tiedoston mutta et kirjoittaa siihen, joten täällä ei voi muuttaa mitään.',
    'missing' => 'Tällä palvelimella ei ole vielä asetustiedostoa. Peli kirjoittaa sen ensimmäisellä käynnistyksellä, joten käynnistä palvelin kerran ja sivu täyttyy.',
    'keeps' => 'Kaikki muu tiedostossa - kommentit, tyhjät rivit, järjestys ja jokainen avain jota tämä lisäosa ei tunne - jää tallennettaessa täsmälleen ennalleen.',
    'raw' => 'Nimet tässä ovat pelin omia, tiedoston järjestyksessä. Mitään ei käännetä eikä ryhmitellä, koska sivu lukee tiedoston käsin kirjoitetun listan sijaan.',
    'unset' => 'Ei asetettu. Peli mainitsee sen esimerkkinä; täyttäminen lisää sen.',
    'group_all' => 'Asetukset',
    'group_all_helper' => 'Kaikki mitä tämä tiedosto mainitsee.',
    'subheading' => 'Koottu tiedostosta :files eikä käsin kirjoitetusta luettelosta.',
];
