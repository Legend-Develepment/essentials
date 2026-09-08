<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Fakturaer: dokumentet, siden med listen og mailen.
 *
 * Tre læsere deler denne fil. En administrator læser tabellen og trykker
 * "markér som betalt"; en kunde læser det dokument, der kan printes, og mailen;
 * og selve dokumentet læses måneder senere af den, der fører regnskabet. Det er
 * derfor doc_-linjerne er tørre og formelle - en faktura er ikke stedet for
 * tonen i resten af panelet.
 */

return [
    'title' => 'Fakturaer',
    'nav_label' => 'Fakturaer',
    'subheading' => 'Hvad der skyldes, og hvad der er betalt. At markere en som betalt her gør alt det, betaling ville gøre: serveren bliver bygget, en suspenderet kommer tilbage.',

    // ---- tabellen --------------------------------------------------------
    'column_number' => 'Faktura',
    'column_customer' => 'Kunde',
    'column_order' => 'Ordre',
    'column_total' => 'I alt',
    'column_state' => 'Tilstand',
    'column_due' => 'Forfalder',

    'kind_order' => 'Første faktura',
    'kind_renewal' => 'Fornyelse',

    'state_unpaid' => 'Ubetalt',
    'state_paid' => 'Betalt',
    'state_cancelled' => 'Trukket tilbage',

    'no_order' => 'Ingen ordre',
    'no_due' => 'Ingen dato',
    'gone_customer' => 'Konto slettet',
    'discount_of' => ':amount i rabat med :code',
    'paid_via' => 'gennem :how',
    'emailed' => 'Sendt',
    'not_emailed' => 'Ikke sendt',
    'filter_overdue' => 'Over tiden',

    // ---- knapperne -------------------------------------------------------
    'open' => 'Åbn',
    'mark_paid' => 'Markér som betalt',
    'mark_paid_confirm' => 'Noterer, at pengene er kommet. Serveren bliver bygget, en suspenderet starter igen, og næste forfald rykker frem - præcis som hvis en betalingsudbyder havde sagt det.',
    'paid' => 'Markeret som betalt',
    'paid_body' => 'Alt, hvad der ventede på denne faktura, er på vej.',
    'already_paid' => 'Den var allerede betalt',

    'withdraw' => 'Træk tilbage',
    'withdraw_confirm' => 'Tager fakturaen ud af bøgerne. Kun en ubetalt kan trækkes tilbage; en betalt faktura er dokumentation for penge, der har skiftet hænder.',
    'withdrawn' => 'Trukket tilbage',
    'withdraw_refused' => 'Kun en ubetalt faktura kan trækkes tilbage',

    'empty' => 'Ingen fakturaer endnu',
    'empty_body' => 'Der skrives en, så snart nogen køber, og derefter en per periode for alt, der fornyer sig.',

    // ---- dokumentet ------------------------------------------------------
    'doc_title' => 'Faktura',
    'doc_number' => 'Nummer',
    'doc_issued' => 'Udstedt',
    'doc_due' => 'Forfaldsdato',
    'doc_paid_on' => 'Betalt',
    'doc_billed_to' => 'Faktureret til',
    'doc_from' => 'Fra',
    'doc_description' => 'Beskrivelse',
    'doc_amount' => 'Beløb',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Rabat',
    'doc_total' => 'I alt',
    'doc_how_to_pay' => 'Sådan betaler du',
    'doc_print' => 'Print eller gem som PDF',
    'doc_back' => 'Tilbage til panelet',

    // ---- mailen ----------------------------------------------------------
    'mail_subject' => 'Faktura :number',
    'mail_hello' => 'Hej :name,',
    'mail_intro' => 'Her er faktura :number.',
    'mail_open' => 'Åbn fakturaen',
    'mail_foot' => 'Du kan altid læse denne faktura igen på din faktureringsside.',

    // ---- klokken ---------------------------------------------------------
    'bell_new' => 'Faktura :number',
    'bell_new_body' => ':total skal betales. Åbn din faktureringsside for at betale.',
    'bell_reminder' => 'Faktura :number er over tiden',
    'bell_reminder_body' => 'Den står stadig åben på :total. Den server, den betaler for, stopper den :date, hvis den ikke er betalt til den tid, og der bliver ikke slettet noget på den, når det sker.',
];
