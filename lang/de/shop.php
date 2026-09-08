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

    /* ---------------------------------------------------------------------
     * Der Shop selbst, ab hier nach unten.
     *
     * Ein ganz anderer Leser: jemand, der einen Server kauft, vielleicht nie
     * von Pelican gehört hat und nicht weiß, was ein egg ist. Nichts hierunter
     * benutzt die Worte des Panels, und jeder Satz beantwortet die Frage, die
     * ein Kunde an dieser Stelle der Seite tatsächlich hat.
     * ------------------------------------------------------------------- */

    // ---- der Shop --------------------------------------------------------
    'store_title' => 'Shop',
    'store_nav_label' => 'Shop',
    'store_subheading' => 'Wähle einen Server. Er wird für dich angelegt, sobald die Rechnung bezahlt ist.',
    'store_empty' => 'Gerade ist nichts im Verkauf',
    'store_empty_body' => 'Komm später wieder, oder frage, wer dieses Panel betreibt.',

    'buy' => 'Kaufen',
    'sold_out' => 'Ausverkauft',
    'plus_setup' => 'zuzüglich :amount einmalig',

    'spec_memory' => ':amount MiB Arbeitsspeicher',
    'spec_disk' => ':amount MiB Speicherplatz',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count Backups',
    'spec_databases' => ':count Datenbanken',

    // ---- die öffentliche Seite -------------------------------------------
    'public_empty' => 'Gerade ist nichts im Verkauf',
    'public_empty_body' => 'Komm später wieder.',
    'to_panel' => 'Anmelden',
    'terms' => 'Bedingungen',
    'sign_in_note' => 'Wähle unten einen Server. Zum Abschließen meldest du dich an, und er wird angelegt, sobald die Rechnung bezahlt ist.',

    // ---- die Kasse -------------------------------------------------------
    'checkout_title' => 'Kasse',
    'tax_line' => 'Steuer (:rate%)',
    'coupon' => 'Gutscheincode',
    'coupon_placeholder' => 'Falls du einen hast',
    'coupon_bad' => 'Dieser Code wirkt hier nicht.',
    'coupon_good' => 'Code angewendet.',
    'agree' => 'Ich stimme den',
    'place_order' => 'Bestellung aufgeben',
    'place_order_note' => 'Das schreibt eine Rechnung. Es wird nichts abgebucht, bis du bezahlst, und der Server wird angelegt, sobald das geschehen ist.',
    'back_to_store' => 'Zurück zum Shop',

    'placed' => 'Bestellung aufgegeben',
    'placed_body' => 'Rechnung :number liegt auf deiner Rechnungsseite bereit.',

    'refused' => 'Das ließ sich nicht kaufen',
    'refused_gone' => 'Es ist nicht mehr im Verkauf.',
    'refused_sold_out' => 'Der letzte ist weg.',
    'refused_bad_coupon' => 'Der Gutscheincode gilt dafür nicht.',
    'refused_failed' => 'Beim Schreiben der Bestellung ging etwas schief. Es wurde nichts abgebucht. Versuche es noch einmal und sage es dem, der dieses Panel betreibt, wenn es weiter passiert.',

    // ---- Rechnungen ------------------------------------------------------
    'billing_title' => 'Rechnungen',
    'billing_nav_label' => 'Rechnungen',
    'billing_subheading' => 'Was du gekauft hast und was offen ist.',
    'your_orders' => 'Deine Bestellungen',
    'your_invoices' => 'Deine Rechnungen',
    'no_orders' => 'Du hast noch nichts gekauft',
    'no_orders_body' => 'Alles, was du kaufst, steht hier mit seinem Server und seinen Daten.',
    'no_invoices' => 'Noch keine Rechnungen',
    'to_store' => 'Zum Shop',
    'renews' => 'Verlängert sich',
    'ask_how_to_pay' => 'Frage, wer dieses Panel betreibt, wie du bezahlen kannst. Hier steht es noch nicht.',
    'order_pending' => 'Wartet darauf, dass die Rechnung bezahlt wird. Gleich danach wird der Server angelegt.',
    'order_suspended' => 'Wegen einer offenen Rechnung angehalten. Bezahlen startet den Server wieder - gelöscht wurde nichts.',

    // ---- bezahlen --------------------------------------------------------
    'pay_with' => 'Bezahlen mit',
    'pay_now' => 'Bezahlen',
    'pay_description' => 'Rechnung :number',
    'pay_thanks' => 'Danke. Die Rechnung ist bezahlt.',
    'pay_pending' => 'Der Anbieter hat es noch nicht bestätigt. Diese Seite aktualisiert sich, sobald er es tut.',
    'pay_refused' => 'Das ist nicht gestartet',
    'pay_refused_body' => 'Die Zahlung ließ sich nicht öffnen. Versuche einen anderen Weg, oder frage, wer dieses Panel betreibt.',
    'gateway_mollie' => 'Mollie',

    // ---- die Einstellungen des Anbieters ---------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Nimmt iDEAL, Karten, Bancontact und den Rest über ein Konto an. Test und live sind dieselbe Einstellung: der Schlüssel selbst sagt, zu welchem Konto er gehört.',
    'mollie_on' => 'Mollie anbieten',
    'mollie_on_helper' => 'Aus lässt die Schaltfläche auf jeder Rechnung weg. Was bezahlt ist, bleibt bezahlt.',
    'mollie_key' => 'API-Schlüssel',
    'mollie_key_helper' => 'Aus dem Bereich Developers deines Mollie-Dashboards. Er wird nie in eine exportierte Einstellungsdatei geschrieben.',
    'mollie_hook' => 'Webhook-Adresse',
    'mollie_hook_helper' => 'Mollie meldet sich bei :url - diese Adresse muss dein Panel aus dem Internet erreichen können.',
];
