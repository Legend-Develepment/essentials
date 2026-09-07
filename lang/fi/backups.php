<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Varmuuskopiot koko paneelin osalta.
 *
 * Pelican vastaa kysymykseen ”mitä varmuuskopioita tällä palvelimella on”. Tämä
 * sivu vastaa käänteiseen, joka on se kysymys, joka ylläpitäjällä oikeasti on
 * ja jolle paneelissa ei ole paikkaa: millä minun palvelimistani ei ole yhtään.
 */

return [
    'title' => 'Varmuuskopiot',
    'nav_label' => 'Varmuuskopiot',
    'subheading' => 'Jokainen tavoittamasi palvelin ja se, kuinka kauan se on ollut ilman. Palvelimet, joita ei ole koskaan varmuuskopioitu, ovat ylimpänä; kaikki yli :days päivän ikäinen lasketaan vanhentuneeksi.',

    // ---- taulukko ---------------------------------------------------------
    'column_server' => 'Palvelin',
    'column_last' => 'Viimeisin kopio',
    'column_kept' => 'Säilytetään',
    'column_size' => 'Koko',
    'column_failed' => 'Epäonnistuneet',

    'never' => 'Ei koskaan',

    'filter_none' => 'Ei koskaan kopioitu',
    'filter_stale' => 'Vanhentunut',
    'filter_failed' => 'Epäonnistuu',

    'open' => 'Avaa Pelicanissa',
];
