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
    'state_ending' => 'Päättymässä',
    'ends_on' => 'Päättyy :date',
    'no_more_dues' => 'Ei enää laskuteta',
    'cancel_confirm_open' => 'Lopettaa uusiutumiset nyt ja antaa paikan varastossa takaisin. Palvelin jää käyntiin: tällä paketilla ei ole vähimmäisaikaa, joten ei ole päivää johon asti odottaa. Poista palvelin Pelicanissa, kun asiakas ei enää tarvitse sitä.',
    'terminate' => 'Pysäytä ja poista',
    'terminate_heading' => 'Poistetaanko tämä palvelin?',
    'terminate_confirm' => 'Palvelin poistetaan nyt, tiedostoineen, tietokantoineen ja varmuuskopioineen. Tätä ei voi perua eikä sopimuksen päättymistä odoteta. Peru tilaus sen sijaan, jos asiakkaan pitäisi saada pitää se siihen päivään asti, joka hänelle luvattiin.',
    'terminate_go' => 'Poista se',
    'terminated' => 'Poistettu',
    'terminated_body' => 'Palvelin on poissa ja tilaus on suljettu.',
    'bell_ending' => ':package päättyy :date',
    'bell_ending_open' => ':package on peruttu',
    'bell_ending_body' => 'Sitä ei laskuteta sinulta enää. Kaikki palvelimella poistetaan, kun se pysähtyy, joten kopioi talteen se, minkä haluat säilyttää.',
    'bell_ended' => ':package on päättynyt',
    'bell_ended_body' => 'Sopimus loppui ja palvelin on poistettu.',
    'bell_undeleted' => 'Tilausta :number ei saatu poistettua',
    'bell_undeleted_body' => 'Paneeli kieltäytyi poistamasta palvelinta. Tilaus on suljettu eikä siitä laskuteta ketään, mutta palvelin on yhä olemassa ja se on poistettava Pelicanissa.',
    'bell_undelivered' => 'Tilauksen :number tiedosto on yhä täällä',
    'bell_undelivered_body' => 'Palvelin rakennettiin, mutta asiakkaan lataamaa tiedostoa ei saatu vietyä sinne. Se on yhä paneelin tallennustilassa, ja syy on kansiossa storage/logs.',

    'empty' => 'Mitään ei ole vielä ostettu',
    'empty_body' => 'Tilaukset ilmestyvät tänne heti kun joku ostaa paketin.',

    // ---- uusimiset -------------------------------------------------------
    'filter_late' => 'Laskun kanssa myöhässä',
    'run_renewals' => 'Aja uusimiset nyt',
    'run_renewals_confirm' => 'Tekee sen mitä yöllinen ajo tekee: kirjoittaa seuraavan laskun kaikelle, minkä eräpäivä lähestyy, ja pysäyttää palvelimet, joiden takana on lasku joka jäi maksamatta yli maksuajan.',
    'renewals_queued' => 'Asetettu jonoon',
    'renewals_queued_body' => 'Se ajetaan jonossa. Lataa sivu hetken päästä uudelleen nähdäksesi mikä muuttui.',
];
