<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Die Einstellungen des Shops, und später der Shop selbst.
 *
 * Zwei Leser teilen sich diese Datei mit Absicht. Die Einstellungshälfte liest
 * der Administrator; die öffentliche und die Kundenhälfte - die dazukommen,
 * während der Shop wächst - lesen Leute, die vielleicht nie von Pelican gehört
 * haben, und jeder Satz dort muss für sie geschrieben sein.
 */

return [
    'title' => 'Shop-Einstellungen',
    'nav_label' => 'Shop-Einstellungen',
    'subheading' => 'Die Währung, die Steuer, wie Rechnungen nummeriert werden und was die öffentliche Seite sagt. Was zum Verkauf steht, ist auf der Seite Pakete.',

    // ---- wo er ist -------------------------------------------------------
    'address' => 'Der öffentliche Shop ist unter',
    'address_off' => 'Die öffentliche Seite ist ausgeschaltet. Schalte „Öffentliche Shop-Seite" in der Funktionsliste auf der Seite Essentials-Einstellungen ein, und sie antwortet unter :url.',

    // ---- allgemein -------------------------------------------------------
    'section_general' => 'Geld',
    'section_general_helper' => 'Eine Währung für den ganzen Shop. Jeder Preis auf jedem Paket ist eine Zahl darin.',
    'currency' => 'Währung',
    'currency_helper' => 'Ändern rechnet nichts um: die Preise auf den Paketen sind Zahlen, und nach einer Änderung sind es Zahlen in der neuen Währung.',
    'tax' => 'Steuer',
    'tax_helper' => 'Ein Prozentsatz, der jeder Rechnung als eigene Zeile hinzugefügt wird. Preise auf den Paketen sind ohne Steuer. Null für keine.',
    'tax_suffix' => '%',
    'prefix' => 'Rechnungsnummern beginnen mit',
    'prefix_helper' => 'Gefolgt von einer hochzählenden Nummer. INV- ergibt INV-000001.',

    // ---- Verlängerungen --------------------------------------------------
    'section_renewals' => 'Verlängerungen',
    'section_renewals_helper' => 'Für Pakete, die monatlich, vierteljährlich oder jährlich abgerechnet werden. Ein einmaliges Paket wird davon nie berührt.',
    'notice_days' => 'So viele Tage vor Ende des Zeitraums in Rechnung stellen',
    'notice_days_helper' => 'Wann die nächste Rechnung erstellt und der Kunde darüber informiert wird.',
    'grace' => 'So viele Tage nach Fälligkeit einer Rechnung sperren',
    'grace_helper' => 'Eine unbezahlte Rechnung jenseits davon sperrt den Server — Pelicans eigene Sperre, aufgehoben, sobald die Rechnung bezahlt ist. Der Shop löscht nie etwas.',
    'days' => 'Tage',

    // ---- die öffentliche Seite -------------------------------------------
    'section_public' => 'Die öffentliche Seite',
    'section_public_helper' => 'Gelesen von Leuten ohne Konto. Ob sie überhaupt ausgeliefert wird, ist der Schalter „Öffentliche Shop-Seite" in der Funktionsliste.',
    'heading' => 'Überschrift',
    'heading_helper' => 'Leer gelassen wird der Name des Panels selbst verwendet.',
    'note' => 'Eine Zeile über den Paketen',
    'note_helper' => 'Um zu sagen, wer du bist oder was ein Kauf jemandem bringt. Reiner Text.',
    'terms_url' => 'Bedingungen',
    'terms_url_helper' => 'Eine https-Adresse. Ist sie gesetzt, heißt Kaufen ein Häkchen setzen, das darauf verweist.',

    // ---- Bezahlen von Hand -----------------------------------------------
    'section_manual' => 'Bezahlen ohne Anbieter',
    'section_manual_helper' => 'Auf einer unbezahlten Rechnung gezeigt, solange kein Zahlungsanbieter eingeschaltet ist: Bankverbindung, oder wohin das Geld soll. Reiner Text.',
    'pay_note' => 'Wie bezahlt wird',
    'pay_note_helper' => 'Leer gelassen sagt eine unbezahlte Rechnung nur, dass sie unbezahlt ist.',

    // ---- die Schaltflächen -----------------------------------------------
    'save' => 'Speichern',
    'saved' => 'Gespeichert',
    'save_failed' => 'Es wurde nichts gespeichert',
];
