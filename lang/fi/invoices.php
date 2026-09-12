<?php

/*
 * Suomi. Kirjoitettu käsin.
 *
 * Laskut: asiakirja, listaava sivu ja sähköposti.
 *
 * Kolme lukijaa jakaa tämän tiedoston. Ylläpitäjä lukee taulukon ja painaa
 * "merkitse maksetuksi"; asiakas lukee tulostettavan asiakirjan ja
 * sähköpostin; ja itse asiakirjan lukee kuukausia myöhemmin se, joka hoitaa
 * kirjanpidon. Juuri siksi doc_-rivit ovat kuivia ja muodollisia - lasku ei ole
 * paikka paneelin muun osan sävylle.
 */

return [
    'title' => 'Laskut',
    'nav_label' => 'Laskut',
    'subheading' => 'Mikä on maksamatta ja mikä on maksettu. Laskun merkitseminen täällä tekee kaiken sen mitä maksaminen tekisi: palvelin rakennetaan, keskeytetty palaa.',

    // ---- taulukko --------------------------------------------------------
    'column_number' => 'Lasku',
    'column_customer' => 'Asiakas',
    'column_order' => 'Tilaus',
    'column_total' => 'Yhteensä',
    'column_state' => 'Tila',
    'column_due' => 'Eräpäivä',

    'kind_order' => 'Ensimmäinen lasku',
    'kind_renewal' => 'Uusiminen',
    'kind_credit' => 'Hyvityslasku',
    'kind_upgrade' => 'Paketin vaihto',
    'kind_topup' => 'Saldon lisäys',
    'kind_addon' => 'Lisä',

    'state_unpaid' => 'Maksamatta',
    'state_paid' => 'Maksettu',
    'state_cancelled' => 'Peruutettu',

    'no_order' => 'Ei tilausta',
    'order_count' => ':count palvelua',
    'no_due' => 'Ei päivää',
    'gone_customer' => 'Tili poistettu',
    'discount_of' => ':amount alennusta koodilla :code',
    'paid_via' => 'kautta :how',
    'column_attempts' => 'Maksu',
    'paid_by' => 'maksettu, :how',
    'paid_by_unknown' => 'maksettu',
    'paid_by_manual' => 'käsin',
    'paid_by_free' => 'ei maksettavaa',
    'attempts_none' => 'ei yritystä',
    'attempts_open' => 'yrityksiä :count - :how',
    'attempt_last' => 'viimeisin :when, :state',
    'attempt_open' => 'kesken',
    'attempt_paid' => 'maksettu',
    'attempt_cancelled' => 'peruutettu',
    'attempt_failed' => 'epäonnistui',
    'emailed' => 'Lähetetty',
    'not_emailed' => 'Ei lähetetty',
    'filter_overdue' => 'Myöhässä',

    // ---- painikkeet ------------------------------------------------------
    'open' => 'Avaa',
    'mark_paid' => 'Merkitse maksetuksi',
    'mark_paid_confirm' => 'Kirjaa, että rahat ovat tulleet. Palvelin rakennetaan, keskeytetty käynnistyy taas ja seuraava eräpäivä siirtyy eteenpäin - aivan kuin maksupalvelu olisi sanonut sen.',
    'paid' => 'Merkitty maksetuksi',
    'paid_body' => 'Kaikki mikä odotti tätä laskua on matkalla.',
    'already_paid' => 'Se oli jo maksettu',

    'withdraw' => 'Peruuta',
    'withdraw_confirm' => 'Poistaa laskun kirjanpidosta. Vain maksamattoman voi peruuttaa; maksettu lasku on merkintä rahasta, joka vaihtoi omistajaa.',
    'withdrawn' => 'Peruutettu',
    'withdraw_refused' => 'Vain maksamattoman laskun voi peruuttaa',

    'empty' => 'Ei vielä laskuja',
    'empty_body' => 'Yksi kirjoitetaan heti kun joku ostaa, ja sen jälkeen yksi kaudessa kaikelle mikä uusiutuu.',

    // ---- asiakirja -------------------------------------------------------
    'doc_title' => 'Lasku',
    'doc_number' => 'Numero',
    'doc_issued' => 'Päiväys',
    'doc_due' => 'Eräpäivä',
    'doc_paid_on' => 'Maksettu',
    'doc_billed_to' => 'Laskutetaan',
    'doc_from' => 'Myyjä',
    'doc_vat' => 'ALV-numero',
    'doc_coc' => 'Y-tunnus',
    'doc_description' => 'Kuvaus',
    'doc_amount' => 'Määrä',
    'doc_subtotal' => 'Veroton',
    'doc_discount' => 'Alennus',
    'doc_total' => 'Yhteensä',
    'doc_how_to_pay' => 'Näin maksat',
    'doc_print' => 'Tulosta tai tallenna PDF-tiedostoksi',
    'doc_back' => 'Takaisin paneeliin',

    // ---- sähköposti ------------------------------------------------------
    'mail_subject' => 'Lasku :number',
    'mail_hello' => 'Hei :name,',
    'mail_intro' => 'Tässä on lasku :number.',
    'mail_open' => 'Avaa lasku',
    'mail_foot' => 'Voit lukea tämän laskun milloin tahansa laskutussivultasi.',

    // ---- kello -----------------------------------------------------------
    'bell_new' => 'Lasku :number',
    'bell_new_body' => 'Maksettavana :total. Avaa laskutussivusi maksaaksesi.',
    'bell_reminder' => 'Lasku :number on myöhässä',
    'bell_reminder_body' => 'Avoinna on yhä :total. Palvelin, jota se maksaa, pysähtyy :date, jos sitä ei ole siihen mennessä maksettu, eikä siltä poisteta silloin mitään.',
];
