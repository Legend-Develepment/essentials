<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Järjestelmän tila -sivu: isäntäkone, jolla paneeli itse ajaa, ja jokainen
 * node, jota on pyydetty sen viereen.
 *
 * Ei sama kone kuin nodet millään asennuksella, jossa ne ovat erillään, ja
 * siksi molemmat voivat olla sivulla.
 *
 * ”Swap”, ”Wings”, ”PHP” ja ”uptime” jäävät paikalleen: niin ne kirjoitetaan
 * isäntäkoneella ja kaikissa työkaluissa, joihin vertaisi.
 */

return [
    'title' => 'Järjestelmän tila',
    'nav_label' => 'Järjestelmän tila',
    'subheading' => 'Kone, jolla paneeli itse ajaa, mitä se ajaa, ja jokainen pyytämäsi node sen vieressä.',

    'options' => 'Valinnat',
    'enabled' => 'Näytä sivupalkissa',
    'enabled_helper' => 'Pois ottaa rivin pois sivupalkista. Sivu pitää oman osoitteensa, joten se on aina siellä takaisin päälle laitettavaksi.',

    'refresh' => 'Lue uudelleen joka',
    'refresh_helper' => 'Koko sivu pyydetään uudelleen tällä välillä. Pois jättää sen sellaiseksi kuin se oli, kun avasit sen.',
    'refresh_off' => 'Vain kun avaan sen',
    'refresh_seconds' => ':seconds sekuntia',

    'blocks' => 'Näytä',
    'blocks_helper' => 'Rastitettu näytetään. Levy on yksi kortti tiedostojärjestelmää kohti, joten täysi juuriosio ei jää puolityhjän datalevyn taakse piiloon.',
    'block_cpu' => 'Suoritin',
    'block_memory' => 'Muisti',
    'block_swap' => 'Swap',
    'block_disk' => 'Levy',
    'block_load' => 'Kuormituksen keskiarvo',
    'block_uptime' => 'Uptime',
    'block_system' => 'Järjestelmä',
    'block_version' => 'Paneelin versio',
    // Ei koskaan näytetä - node-kortti ottaa noden oman nimen - mutta blank()
    // kysyy sitä, ja puuttuva avain, joka tulostaa oman nimensä, on huono
    // varasuunnitelma.
    'block_node' => 'Node',

    'nodes' => 'Näytettävät nodet',
    'nodes_helper' => 'Kortti kullekin, paneelin isäntäkoneen viereen. Mitään rastittamatta ei näytä yhtäkään - yleisnäkymässä on jo lohko, jossa on jokainen node. Kutakin kysytään sen omalta daemonilta, joten lyhyt väli ja pitkä lista on paljon pyyntöjä.',

    'section_usage' => 'Käyttö',
    'section_host' => 'Tämä paneeli',
    'section_nodes' => 'Nodet',

    'disk_panel' => 'Paneeli asuu täällä',
    'wings' => 'Wings :version',
    'version_installed' => 'Asennettu',
    'version_latest' => 'Uusin',
    'version_current' => 'Ajan tasalla',
    'version_update' => 'Päivitys saatavilla',
    'version_unknown' => 'Ei saatu tarkistettua',

    /*
     * Mitä jäljessä oleva kortti tarjoaa.
     *
     * Linkki julkaisuun eikä painike, joka suorittaisi päivityksen, koska
     * täältä ei ole päivitystä suoritettavaksi: Pelicanilla ei ole
     * päivityskomentoa, eikä Wingsillä ole päätepistettä, joka korvaisi sen
     * oman binäärin. Vihje kertoo, missä työ oikeasti tehdään, jottei kukaan
     * lähde etsimään painiketta, joka ei koskaan ollut mahdollinen.
     */
    'version_release' => 'Mitä uutta',
    'version_how_panel' => 'Avaa julkaisutiedot. Paneelin päivittäminen tehdään sillä koneella, jolla se ajaa - paneeli ei voi korvata omia tiedostojaan, eikä yksikään lisäosa saa ajaa kuorikomentoja.',
    'version_how_wings' => 'Avaa julkaisutiedot. Wings päivitetään itse nodella - paneelilla ei ole kanavaa toisella koneella ajavaan ohjelmaan.',

    'wings_latest' => 'Uusin :version',
    'load_cores' => ':percent % / :cores suoritinta',
    'load_windows' => ':five 5 min · :fifteen 15 min',
    'uptime_since' => 'Alkaen :date',
    'unavailable' => 'Ei saatavilla tällä isäntäkoneella',

    'fact_os' => 'Käyttöjärjestelmä',
    'fact_hostname' => 'Konenimi',
    'fact_php' => 'PHP',
    'fact_cores' => 'Suorittimia',
    'fact_processes' => 'Prosesseja',
];
