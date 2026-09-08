<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Facturen: het document, de pagina met de lijst en de mail.
 *
 * Drie lezers delen dit bestand. Een beheerder leest de tabel en drukt op
 * "markeer als betaald"; een klant leest het afdrukbare document en de mail; en
 * het document zelf wordt maanden later gelezen door iemand die de boekhouding
 * doet. Dat laatste is waarom de doc_-regels zakelijk en droog zijn - een
 * factuur is niet de plek voor de toon van de rest van het paneel.
 */

return [
    'title' => 'Facturen',
    'nav_label' => 'Facturen',
    'subheading' => 'Wat openstaat en wat betaald is. Hier op betaald zetten doet alles wat betalen zou doen: de server wordt gebouwd, een stilgezette komt terug.',

    // ---- de tabel --------------------------------------------------------
    'column_number' => 'Factuur',
    'column_customer' => 'Klant',
    'column_order' => 'Bestelling',
    'column_total' => 'Totaal',
    'column_state' => 'Toestand',
    'column_due' => 'Vervalt',

    'kind_order' => 'Eerste factuur',
    'kind_renewal' => 'Verlenging',

    'state_unpaid' => 'Onbetaald',
    'state_paid' => 'Betaald',
    'state_cancelled' => 'Ingetrokken',

    'no_order' => 'Geen bestelling',
    'no_due' => 'Geen datum',
    'gone_customer' => 'Account verwijderd',
    'discount_of' => ':amount korting met :code',
    'paid_via' => 'via :how',
    'emailed' => 'Gemaild',
    'not_emailed' => 'Niet gemaild',
    'filter_overdue' => 'Over tijd',

    // ---- de knoppen ------------------------------------------------------
    'open' => 'Openen',
    'mark_paid' => 'Markeer als betaald',
    'mark_paid_confirm' => 'Legt vast dat het geld binnen is. De server wordt gebouwd, een stilgezette start weer en de volgende termijn schuift op - net alsof een betaaldienst het gezegd had.',
    'paid' => 'Op betaald gezet',
    'paid_body' => 'Alles wat op deze factuur wachtte is onderweg.',
    'already_paid' => 'Die was al betaald',

    'withdraw' => 'Intrekken',
    'withdraw_confirm' => 'Haalt de factuur uit de boeken. Alleen een onbetaalde kan ingetrokken worden; een betaalde factuur is de vastlegging van geld dat van eigenaar wisselde.',
    'withdrawn' => 'Ingetrokken',
    'withdraw_refused' => 'Alleen een onbetaalde factuur kan ingetrokken worden',

    'empty' => 'Nog geen facturen',
    'empty_body' => 'Er wordt er een geschreven zodra iemand koopt, en daarna elke termijn voor alles wat verlengt.',

    // ---- het document ----------------------------------------------------
    'doc_title' => 'Factuur',
    'doc_number' => 'Nummer',
    'doc_issued' => 'Opgemaakt',
    'doc_due' => 'Vervaldatum',
    'doc_paid_on' => 'Betaald',
    'doc_billed_to' => 'Gefactureerd aan',
    'doc_from' => 'Van',
    'doc_description' => 'Omschrijving',
    'doc_amount' => 'Bedrag',
    'doc_subtotal' => 'Subtotaal',
    'doc_discount' => 'Korting',
    'doc_total' => 'Totaal',
    'doc_how_to_pay' => 'Hoe te betalen',
    'doc_print' => 'Afdrukken of als pdf opslaan',
    'doc_back' => 'Terug naar het paneel',

    // ---- de mail ---------------------------------------------------------
    'mail_subject' => 'Factuur :number',
    'mail_hello' => 'Hallo :name,',
    'mail_intro' => 'Hierbij factuur :number.',
    'mail_open' => 'Factuur openen',
    'mail_foot' => 'Je kunt deze factuur altijd teruglezen op je facturenpagina.',

    // ---- de bel ----------------------------------------------------------
    'bell_new' => 'Factuur :number',
    'bell_new_body' => ':total staat open. Open je facturenpagina om te betalen.',
];
