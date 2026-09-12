<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Navigointilinkit-sivu. Tiedotteiden vieressä eikä teeman asetusten sisällä:
 * kumpikaan ei koske sitä, miltä paneeli näyttää. Toinen on se, mitä se sanoo,
 * ja tämä on se, minne se vie.
 *
 * ”Topbar” jää paikalleen: se on sen nimi itse paneelissa.
 */

return [
    'title' => 'Navigointilinkit',
    'nav_label' => 'Navigointilinkit',
    'subheading' => 'Omia rivejäsi sivupalkissa - Discord-kutsu, tilasivu, tietokanta ohjeille. Ne kulkevat Filamentin oman navigoinnin kautta, joten ne käyttäytyvät kuten kaikki muutkin: ne ovat otsikon alla, ja ne seuraavat sivupalkkia oli se sitten kapea kisko tai yläpalkki.',

    'add' => 'Lisää linkki',
    'enabled' => 'Päällä',
    'off' => 'pois',

    'label' => 'Nimi',
    'icon' => 'Kuvake',
    'url' => 'Osoite',
    'url_helper' => 'https:// tai polku tämän paneelin sisällä, esimerkiksi /account. Kaikki muu jätetään huomiotta - navigoinnin rivi ei ole paikka odottamattomalle protokollalle.',
    'scope' => 'Näkyy',
    'scope_all' => 'Kaikkialla',
    'scope_client' => 'Vain ylläpito-osan ulkopuolella',
    'scope_admin' => 'Vain ylläpito-osassa',
    'scope_login' => 'Kirjautumislomakkeen alla',
    'group' => 'Ryhmä',
    'group_helper' => 'Jätä tyhjäksi asettaaksesi sen ensimmäisen otsikon yläpuolelle. Kirjoita sama nimi kahteen linkkiin, niin ne ovat yhdessä sen alla.',
    'new_tab' => 'Avaa uuteen välilehteen',

    'favicon' => 'Käytä sivuston omaa kuvaketta',
    'favicon_helper' => 'Haetaan kerran, kun tallennat - ei koskaan silloin, kun joku lataa sivua. Jos sivusto ei vastaa, yllä valittu kuvake jää voimaan.',
    'icon_fallback' => 'Käytetään vain, jos sivustolla ei ole omaa kuvaketta.',

    'saved' => 'Navigointilinkit tallennettu',
    'failed' => 'Navigointilinkkejä ei saatu tallennettua',
];
