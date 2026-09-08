<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Zahlungen: jeder Versuch zu bezahlen und was der Anbieter dazu gesagt hat.
 *
 * Eine Zeile pro Versuch statt pro Rechnung, denn das ist, was geschehen ist.
 * Das Wort, das diese Seite immer wieder sagt, ist „Versuch": eine
 * fehlgeschlagene Zahlung ist eine Tatsache, die es zu behalten lohnt, kein
 * Fehler zum Verstecken.
 */

return [
    'title' => 'Zahlungen',
    'nav_label' => 'Zahlungen',
    'subheading' => 'Jeder Zahlungsversuch, über jeden Anbieter. Erneut prüfen fragt den Anbieter noch einmal - genau das, was ihr Webhook tut, wenn er ankommt.',

    // ---- die Tabelle -----------------------------------------------------
    'column_invoice' => 'Rechnung',
    'column_gateway' => 'Anbieter',
    'column_reference' => 'Ihre Referenz',
    'column_amount' => 'Betrag',
    'column_state' => 'Zustand',
    'column_updated' => 'Zuletzt gehört',

    'gone_invoice' => 'Rechnung gelöscht',

    'state_open' => 'Wartet',
    'state_paid' => 'Bezahlt',
    'state_failed' => 'Fehlgeschlagen',
    'state_cancelled' => 'Abgebrochen',

    // ---- die Schaltflächen -----------------------------------------------
    'recheck' => 'Erneut prüfen',
    'rechecked' => 'Noch einmal gefragt',
    'rechecked_body' => 'Der Anbieter sagt weiterhin nicht, dass bezahlt wurde. Es hat sich nichts geändert.',
    'settled' => 'Sie ist bezahlt',
    'settled_body' => 'Die Rechnung ist beglichen, und alles, was darauf wartete, ist unterwegs.',
    'recheck_failed' => 'Nachfragen ging nicht',
    'recheck_failed_body' => 'Der Anbieter hat nicht geantwortet. Versuche es in einer Minute noch einmal; passiert es weiter, prüfe den Schlüssel auf der Seite Shop-Einstellungen.',
    'no_gateway' => 'Dieser Anbieter ist aus',
    'no_gateway_body' => 'Schalte ihn wieder ein, um nach dieser Zahlung zu fragen, oder markiere die Rechnung von Hand als bezahlt.',

    'answer' => 'Ihre Antwort',
    'no_answer' => 'Nichts festgehalten',
    'close' => 'Schließen',

    'empty' => 'Noch hat niemand über einen Anbieter bezahlt',
    'empty_body' => 'Versuche erscheinen hier, sobald jemand auf Bezahlen drückt - ob sie zu Ende gehen oder nicht.',
];
