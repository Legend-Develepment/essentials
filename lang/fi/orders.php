<?php

/*
 * Suomi. Kirjoitettu käsin.
 *
 * Tilaukset: mitä joku on ostanut ja mitä siitä tuli.
 *
 * Neljä tilaa alla puhuvat rahasta, eivät palvelimesta. Käykö palvelin juuri
 * nyt, on Pelicanin oma kysymys, ja siihen vastataan Pelicanin omilla sivuilla.
 * Sanat täällä pitävät nämä kaksi erillään.
 */

return [
    'title' => 'Tilaukset',
    'nav_label' => 'Tilaukset',
    'subheading' => 'Kaikki mitä on ostettu, palvelin joka siitä tuli, ja miten asiat ovat.',

    // ---- taulukko --------------------------------------------------------
    'column_order' => 'Tilaus',
    'column_customer' => 'Asiakas',
    'column_package' => 'Paketti',
    'column_server' => 'Palvelin',
    'column_state' => 'Tila',
    'column_due' => 'Seuraava eräpäivä',

    'no_server' => 'Ei vielä rakennettu',
    'no_due' => 'Kertamaksu',
    'gone_customer' => 'Tili poistettu',
    'gone_package' => 'Paketti poistettu',
    'overdue_days' => 'Myöhässä :days päivää',

    'state_pending' => 'Odottaa',
    'state_active' => 'Käytössä',
    'state_suspended' => 'Keskeytetty',
    'state_cancelled' => 'Peruttu',

    // ---- painikkeet ------------------------------------------------------
    'retry' => 'Rakenna uudelleen',
    'retry_confirm' => 'Asettaa rakentamisen jonoon vielä kerran. Mikään muu ei muutu, ja lasku pysyy maksettuna.',
    'retrying' => 'Asetettu jonoon',

    'suspend' => 'Keskeytä',
    'suspend_confirm' => 'Pysäyttää palvelimen Pelicanin omalla keskeytyksellä. Tiedostot, tietokannat ja varmuuskopiot jäävät paikoilleen, ja laskun maksaminen poistaa keskeytyksen.',
    'suspended' => 'Keskeytetty',

    'unsuspend' => 'Poista keskeytys',
    'unsuspended' => 'Käy taas',

    'change_due' => 'Muuta eräpäivää',
    'change_due_helper' => 'Milloin seuraava lasku kirjoitetaan. Tyhjä tarkoittaa ei koskaan - tilaus lakkaa uusiutumasta ilman että se on peruttu.',

    'cancel' => 'Peru',
    'cancel_confirm' => 'Lopettaa uusiutumiset ja antaa paikan varastossa takaisin. Palvelin jää: sen poistaminen tehdään Pelicanissa, jonne se kuuluu.',
    'cancelled' => 'Peruttu',

    'saved' => 'Tallennettu',
    'refused' => 'Mikään ei muuttunut',
    'refused_body' => 'Tilaus ei ole sellaisessa tilassa, jossa tuo onnistuisi. Lataa sivu uudelleen ja katso vielä kerran.',

    // ---- mitä asiakas kuulee ---------------------------------------------
    'bell_ready' => 'Palvelimesi on valmis',
    'bell_ready_body' => ':server on luotu ja odottaa, että käynnistät sen.',
    'bell_suspended' => 'Palvelimesi on keskeytetty',
    'bell_suspended_body' => 'Lasku jäi maksamatta yli maksuajan. Maksaminen käynnistää palvelimen taas; mitään ei ole poistettu.',

    // ---- mitä ylläpitäjä kuulee ------------------------------------------
    'bell_failed' => 'Tilausta :number ei saatu rakennettua',
    'no_allocation' => 'Yhdelläkään tämän paketin node-koneella ei ole vapaata allocationia. Lisää yksi ja rakenna uudelleen.',
    'no_reason' => 'Paneeli kieltäytyi sanomatta miksi.',

    // ---- palvelin joka siitä syntyy --------------------------------------
    'server_description' => 'Ostettu kaupasta, tilaus :number.',
    'server_fallback' => 'Palvelin',

    'empty' => 'Mitään ei ole vielä ostettu',
    'empty_body' => 'Tilaukset ilmestyvät tänne heti kun joku ostaa paketin.',

    // ---- uusimiset -------------------------------------------------------
    'filter_late' => 'Laskun kanssa myöhässä',
    'run_renewals' => 'Aja uusimiset nyt',
    'run_renewals_confirm' => 'Tekee sen mitä yöllinen ajo tekee: kirjoittaa seuraavan laskun kaikelle, minkä eräpäivä lähestyy, ja pysäyttää palvelimet, joiden takana on lasku joka jäi maksamatta yli maksuajan.',
    'renewals_queued' => 'Asetettu jonoon',
    'renewals_queued_body' => 'Se ajetaan jonossa. Lataa sivu hetken päästä uudelleen nähdäksesi mikä muuttui.',
];
