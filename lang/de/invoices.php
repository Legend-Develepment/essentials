<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Rechnungen: das Dokument, die Seite mit der Liste und die Mail.
 *
 * Drei Leser teilen sich diese Datei. Die Verwaltung liest die Tabelle und
 * drückt auf „als bezahlt markieren"; ein Kunde liest das druckbare Dokument
 * und die Mail; und das Dokument selbst liest Monate später jemand, der die
 * Buchhaltung macht. Deshalb sind die doc_-Zeilen nüchtern und förmlich - eine
 * Rechnung ist nicht der Ort für den Ton des übrigen Panels.
 */

return [
    'title' => 'Rechnungen',
    'nav_label' => 'Rechnungen',
    'subheading' => 'Was offen ist und was bezahlt wurde. Hier auf bezahlt zu setzen tut alles, was Bezahlen täte: der Server wird gebaut, ein gesperrter kommt zurück.',

    // ---- die Tabelle -----------------------------------------------------
    'column_number' => 'Rechnung',
    'column_customer' => 'Kunde',
    'column_order' => 'Bestellung',
    'column_total' => 'Gesamt',
    'column_state' => 'Zustand',
    'column_due' => 'Fällig',

    'kind_order' => 'Erste Rechnung',
    'kind_renewal' => 'Verlängerung',

    'state_unpaid' => 'Offen',
    'state_paid' => 'Bezahlt',
    'state_cancelled' => 'Zurückgezogen',

    'no_order' => 'Keine Bestellung',
    'no_due' => 'Kein Datum',
    'gone_customer' => 'Konto gelöscht',
    'discount_of' => ':amount Rabatt mit :code',
    'paid_via' => 'über :how',
    'emailed' => 'Gemailt',
    'not_emailed' => 'Nicht gemailt',
    'filter_overdue' => 'Überfällig',

    // ---- die Schaltflächen -----------------------------------------------
    'open' => 'Öffnen',
    'mark_paid' => 'Als bezahlt markieren',
    'mark_paid_confirm' => 'Hält fest, dass das Geld angekommen ist. Der Server wird gebaut, ein gesperrter startet wieder und die nächste Fälligkeit rückt vor - genau so, als hätte es ein Zahlungsanbieter gesagt.',
    'paid' => 'Als bezahlt markiert',
    'paid_body' => 'Alles, was auf diese Rechnung wartete, ist unterwegs.',
    'already_paid' => 'Sie war schon bezahlt',

    'withdraw' => 'Zurückziehen',
    'withdraw_confirm' => 'Nimmt die Rechnung aus den Büchern. Nur eine offene lässt sich zurückziehen; eine bezahlte Rechnung ist der Beleg über Geld, das den Besitzer gewechselt hat.',
    'withdrawn' => 'Zurückgezogen',
    'withdraw_refused' => 'Nur eine offene Rechnung lässt sich zurückziehen',

    'empty' => 'Noch keine Rechnungen',
    'empty_body' => 'Eine wird geschrieben, sobald jemand kauft, und danach jede Periode für alles, was sich verlängert.',

    // ---- das Dokument ----------------------------------------------------
    'doc_title' => 'Rechnung',
    'doc_number' => 'Nummer',
    'doc_issued' => 'Ausgestellt',
    'doc_due' => 'Fällig am',
    'doc_paid_on' => 'Bezahlt',
    'doc_billed_to' => 'Rechnung an',
    'doc_from' => 'Von',
    'doc_description' => 'Beschreibung',
    'doc_amount' => 'Betrag',
    'doc_subtotal' => 'Zwischensumme',
    'doc_discount' => 'Rabatt',
    'doc_total' => 'Gesamt',
    'doc_how_to_pay' => 'Wie zu zahlen ist',
    'doc_print' => 'Drucken oder als PDF speichern',
    'doc_back' => 'Zurück zum Panel',

    // ---- die Mail --------------------------------------------------------
    'mail_subject' => 'Rechnung :number',
    'mail_hello' => 'Hallo :name,',
    'mail_intro' => 'Hier ist Rechnung :number.',
    'mail_open' => 'Rechnung öffnen',
    'mail_foot' => 'Du kannst diese Rechnung jederzeit auf deiner Rechnungsseite nachlesen.',

    // ---- die Glocke ------------------------------------------------------
    'bell_new' => 'Rechnung :number',
    'bell_new_body' => ':total sind offen. Öffne deine Rechnungsseite, um zu bezahlen.',
];
