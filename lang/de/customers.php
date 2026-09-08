<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Kunden: der Shop, nur auf die Person gerichtet statt auf die Zeile.
 *
 * Bestellungen, Rechnungen und Zahlungen sind je eine Liste dessen, was
 * geschehen ist. Diese Seite stellt die Frage, die jemand mit einem Ticket vor
 * sich wirklich hat: wer ist das, was hat er, was wurde bezahlt und was ist
 * noch offen. Die Worte hier sind für diesen Moment gewählt, nicht für einen
 * Bericht.
 */

return [
    'title' => 'Kunden',
    'nav_label' => 'Kunden',
    'subheading' => 'Alle, die etwas gekauft haben, mit dem, was sie halten, was sie bezahlt haben und was noch offen ist.',

    // ---- die Tabelle -----------------------------------------------------
    'column_customer' => 'Kunde',
    'column_services' => 'Dienste',
    'column_spent' => 'Bezahlt',
    'column_outstanding' => 'Offen',

    'of_orders' => 'von :count bestellt',
    'nothing_owed' => 'Nichts',

    'filter_owing' => 'Hat noch etwas offen',
    'filter_active' => 'Hat einen aktiven Dienst',

    // ---- einer von ihnen -------------------------------------------------
    'open' => 'Öffnen',
    'close' => 'Schließen',
    'servers' => 'Server',
    'since' => 'Kunde seit',
    'their_services' => 'Dienste',
    'their_invoices' => 'Rechnungen',
    'no_services' => 'Nichts aktiv, und nichts, das noch gebaut werden müsste.',
    'no_invoices' => 'Für dieses Konto wurden keine Rechnungen geschrieben.',

    'empty' => 'Noch hat niemand etwas gekauft',
    'empty_body' => 'Hier stehen Leute, die bestellt haben, nicht alle mit einem Konto - es füllt sich also mit dem ersten Verkauf.',
];
