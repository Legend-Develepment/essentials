<?php

/*
 * Suomi. Kirjoitettu käsin.
 *
 * Maksut: jokainen yritys maksaa ja se, mitä palveluntarjoaja siitä sanoi.
 *
 * Yksi rivi yritystä kohden laskun sijaan, koska niin se meni. Sana, jota tämä
 * sivu toistaa, on "yritys": epäonnistunut maksu on säilyttämisen arvoinen
 * tosiasia, ei virhe jota piilotella.
 */

return [
    'title' => 'Maksut',
    'nav_label' => 'Maksut',
    'subheading' => 'Jokainen yritys maksaa, jokaisen palveluntarjoajan kautta. Tarkista uudelleen kysyy tarjoajalta vielä kerran - juuri sen, mitä heidän webhookinsa tekee saapuessaan.',

    // ---- taulukko --------------------------------------------------------
    'column_invoice' => 'Lasku',
    'column_gateway' => 'Palveluntarjoaja',
    'column_reference' => 'Heidän viitteensä',
    'column_amount' => 'Määrä',
    'column_state' => 'Tila',
    'column_updated' => 'Viimeksi kuultu',

    'gone_invoice' => 'Lasku poistettu',

    'state_open' => 'Odottaa',
    'state_paid' => 'Maksettu',
    'state_failed' => 'Epäonnistui',
    'state_cancelled' => 'Hylätty',

    // ---- painikkeet ------------------------------------------------------
    'recheck' => 'Tarkista uudelleen',
    'rechecked' => 'Kysyttiin uudelleen',
    'rechecked_body' => 'Palveluntarjoaja ei edelleenkään sano sitä maksetuksi. Mikään ei muuttunut.',
    'settled' => 'Se on maksettu',
    'settled_body' => 'Lasku on selvitetty, ja kaikki sitä odottanut on matkalla.',
    'recheck_failed' => 'Kysyminen ei onnistunut',
    'recheck_failed_body' => 'Palveluntarjoaja ei vastannut. Yritä minuutin päästä; jos se jatkuu, tarkista avain Kaupan asetukset -sivulta.',
    'no_gateway' => 'Tuo palveluntarjoaja on pois päältä',
    'no_gateway_body' => 'Kytke se takaisin päälle kysyäksesi tästä maksusta, tai merkitse lasku maksetuksi käsin.',

    'answer' => 'Heidän vastauksensa',
    'no_answer' => 'Ei mitään kirjattuna',
    'close' => 'Sulje',

    'empty' => 'Kukaan ei ole vielä maksanut palveluntarjoajan kautta',
    'empty_body' => 'Yritykset ilmestyvät tänne sillä hetkellä, kun joku painaa Maksa - vietiinpä se loppuun tai ei.',
];
