<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Extras, die neben einem Paket verkauft werden.
 *
 * Zwei Dinge werden hier auseinandergehalten. Was ein Extra *kostet*, ist sein
 * Preis, und der wird jedes Mal berechnet. Was es *heute* kostet, ist ein Teil
 * davon, denn wer mitten im Monat eines kauft, zahlt einen halben Monat. Die
 * Texte für den Kunden sagen immer, welches von beiden gemeint ist.
 *
 * „Fügt dem Server nichts hinzu" ist eine echte Antwort und wird ausgeschrieben
 * statt leer gelassen: bevorzugter Support ist etwas ganz Gewöhnliches zum
 * Verkaufen, und eine leere Zelle liest sich wie ein Fehler.
 */

return [
    'title' => 'Extras',
    'nav_label' => 'Extras',
    'subheading' => 'Dinge, die neben einem Paket verkauft werden: mehr Speicher, noch ein Backup-Slot, oder etwas, das nur eine Zeile auf der Rechnung ist.',

    // ---- die Tabelle ------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Preis',
    'column_adds' => 'Fügt hinzu',
    'column_sold' => 'In Gebrauch',
    'column_live' => 'Im Verkauf',
    'adds_nothing' => 'Nichts am Server',

    // ---- das Formular -----------------------------------------------------
    'section_what' => 'Was es ist',
    'section_what_helper' => 'Der Name und der Preis, die ein Kunde sieht, und zu welchen Paketen es gekauft werden kann.',
    'name' => 'Name',
    'price' => 'Preis',
    'price_helper' => 'Was es jedes Mal kostet, wenn es berechnet wird. Wird es mitten in einer Periode gekauft, zahlt ein Kunde einen Teil davon und ab der nächsten Verlängerung den ganzen Preis.',
    'billing' => 'Berechnet',
    'billing_helper' => 'Mit dem Dienst heißt, es kommt bei jeder Verlängerung wieder, solange sie es behalten. Einmalig heißt, es steht auf der Rechnung, die es zuerst trägt, und danach nie wieder.',
    'billing_with' => 'Bei jeder Verlängerung',
    'billing_once' => 'Einmalig',
    'max' => 'Höchstens je Dienst',
    'max_helper' => 'Wie viele davon jemand halten darf. Eines ist der gewöhnliche Fall; setz es höher für etwas, das nach Gigabyte verkauft wird.',
    'description' => 'Beschreibung',
    'description_helper' => 'Eine Zeile unter dem Namen an der Kasse. Sag, was es tut, nicht wie es heißt.',
    'packages' => 'Pakete',
    'packages_helper' => 'Zu welchen Paketen sich das kaufen lässt. Nichts angehakt heißt zu allen, und das ist eine Support-Option oder ein Backup-Slot meistens.',

    'section_adds' => 'Was es dem Server hinzufügt',
    'section_adds_helper' => 'Das kommt zu dem dazu, was das Paket schon gibt, und steht nicht an dessen Stelle: 4096 bei Speicher macht den Server 4 GiB größer. Zwei gleiche Extras zählen zusammen. Lass alles auf null für etwas, das nur eine Zeile auf der Rechnung ist. Eine negative Zahl nimmt etwas weg, das ist erlaubt und ab und zu genau das, was jemand will.',
    'sort' => 'Reihenfolge',
    'sort_helper' => 'Niedriger kommt an der Kasse zuerst. Bei gleichen Zahlen zählt der Preis.',
    'live' => 'Im Verkauf',
    'live_helper' => 'Aus wird es nirgends angeboten. Wer es schon hat, behält es und zahlt weiter dafür.',

    // ---- die Schaltflächen ------------------------------------------------
    'new' => 'Neues Extra',
    'edit' => 'Bearbeiten',
    'delete' => 'Löschen',
    'delete_confirm' => 'Niemand hat dieses. Löschen nimmt es endgültig von der Liste.',
    'delete_sold' => ':count Dienste haben dieses. Sie behalten es, behalten die Grenzen, die es ihnen gab, und zahlen weiter dafür - weg ist der Eintrag auf der Liste, damit es niemand Neues mehr kaufen kann.',
    'go_live' => 'In den Verkauf nehmen',
    'go_offline' => 'Aus dem Verkauf nehmen',
    'saved' => 'Gespeichert',
    'deleted' => 'Das Extra ist weg',
    'save_failed' => 'Nicht gespeichert',
    'save_failed_body' => 'Es wurde nichts geschrieben. Versuch es noch einmal, und sieh ins Log, wenn es weiter vorkommt.',
    'invalid' => 'Ein Extra braucht einen Namen und einen Preis.',
    'empty' => 'Noch keine Extras',
    'empty_body' => 'Ein Extra ist etwas, das neben einem Paket verkauft wird: noch ein Gigabyte, ein zweiter Backup-Slot, oder ein Dienst, der dem Server überhaupt nichts hinzufügt.',

    // ---- was ein Kunde sieht ----------------------------------------------
    'choose' => 'Extras',
    'choose_helper' => 'Freiwillig, und du kannst sie später dazunehmen oder weglassen.',
    'yours' => 'Extras zu diesem Dienst',
    'add' => 'Extra hinzufügen',
    'add_helper' => 'Du zahlst jetzt für den Rest dieser Periode und ab der nächsten Verlängerung den ganzen Preis.',
    'add_to' => ':name hinzufügen',
    'add_confirm' => ':name zu diesem Dienst hinzufügen?',
    'drop' => 'Entfernen',
    'drop_confirm' => ':name entfernen? Der ungenutzte Teil dessen, was du bezahlt hast, geht zurück auf dein Konto, und dein Server ändert sich sofort.',
    'costs_now' => ':amount jetzt',
    'free_now' => 'Jetzt nichts zu zahlen',
    'then' => 'danach :amount je Verlängerung',
    'once_only' => ':amount, einmalig',
    'each' => 'je Stück',
    'added' => ':name hinzugefügt',
    'added_body' => 'Dein Server hat bekommen, was es hinzufügt.',
    'dropped' => ':name entfernt',
    'dropped_body' => 'Was du bezahlt und nicht gebraucht hast, liegt auf deinem Konto.',

    // ---- und wenn es nicht geht -------------------------------------------
    'refused' => 'Das ging nicht',
    'refused_off' => 'Extras sind für dieses Panel ausgeschaltet.',
    'refused_not_active' => 'Nur einem laufenden Dienst lassen sich Extras hinzufügen.',
    'refused_gone' => 'Dieses Extra steht nicht mehr zum Verkauf.',
    'refused_wrong_package' => 'Dieses Extra wird zu diesem Paket nicht verkauft.',
    'refused_enough' => 'Du hast schon so viele davon, wie dieser Dienst halten darf.',
    'refused_failed' => 'Es wurde nichts festgehalten, also hat sich nichts geändert. Versuch es noch einmal, und sag es dem, der dieses Panel betreibt, wenn es weiter vorkommt.',
    'refused_server' => 'Der Server wollte die neuen Grenzen nicht annehmen, es wurde also nichts geändert und nichts berechnet.',
    'refused_not_yours' => 'Dieses Extra gehört nicht zu diesem Dienst.',

    // ---- was auf den Dokumenten steht -------------------------------------
    'line' => ':name × :many, für die verbleibenden :days Tage dieser Periode',
    'credit_reason' => 'Entfernt: :name',
    'bell_failed' => 'Ein Extra konnte dem Server bei Bestellung :number nicht gegeben werden',

    // ---- Einheiten, für die Verwaltungstabelle ----------------------------
    'unit_memory' => 'MiB Arbeitsspeicher',
    'unit_swap' => 'MiB Swap',
    'unit_disk' => 'MiB Speicherplatz',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'Datenbanken',
    'unit_allocation_limit' => 'Allocations',
    'unit_backup_limit' => 'Backups',
];
