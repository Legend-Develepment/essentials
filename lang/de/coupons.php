<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Gutscheine: Codes, die etwas von der ersten Rechnung abziehen.
 *
 * Nur von der ersten, mit Absicht, und der Text sagt das dort, wo es zählt.
 * Ein Code, der auch jede Verlängerung vergünstigte, wäre eine Preisänderung
 * mit Ablaufdatum, und wer das will, sollte den Preis ändern.
 */

return [
    'title' => 'Gutscheine',
    'nav_label' => 'Gutscheine',
    'subheading' => 'Codes, die einen Prozentsatz oder einen Betrag von der ersten Rechnung abziehen. Verlängerungen laufen zum Paketpreis.',

    // ---- die Tabelle -----------------------------------------------------
    'column_code' => 'Code',
    'column_value' => 'Wert',
    'column_uses' => 'Verwendet',
    'column_expires' => 'Läuft ab',
    'column_packages' => 'Gilt für',
    'column_live' => 'Aktiv',

    'never_expires' => 'Kein Enddatum',
    'all_packages' => 'Alles',
    'some_packages' => ':count Pakete',
    'usable' => 'Kann gerade verwendet werden',
    'unusable' => 'Aus, abgelaufen oder aufgebraucht',

    // ---- die Schaltflächen -----------------------------------------------
    'new' => 'Neuer Gutschein',
    'edit' => 'Bearbeiten',
    'delete' => 'Löschen',
    'delete_confirm' => 'Entfernt den Code. Rechnungen, die ihn schon genutzt haben, behalten ihren Rabatt - jede speichert selbst, was abgezogen wurde.',
    'deleted' => 'Gutschein gelöscht',
    'saved' => 'Gutschein gespeichert',
    'save_failed' => 'Der Gutschein konnte nicht gespeichert werden',
    'taken' => 'Etwas anderes verwendet diesen Code bereits.',
    'invalid' => 'Ein Prozentsatz ist eine ganze Zahl von 1 bis 100. Einen Betrag schreibst du als 12.50 oder 12,50.',

    // ---- das Formular ----------------------------------------------------
    'section_code' => 'Der Code',
    'section_code_helper' => 'Was ein Kunde an der Kasse eintippt.',
    'code' => 'Code',
    'code_helper' => 'Wird in Großbuchstaben ohne Leerzeichen gespeichert und verglichen, damit er funktioniert, wie auch immer jemand ihn tippt.',
    'live' => 'Aktiv',
    'live_helper' => 'Aus lässt den Code nicht mehr wirken, ohne ihn zu löschen - er ist außer Gebrauch, während der Rabatt, den er gab, auf den Rechnungen stehen bleibt.',

    'section_worth' => 'Was er abzieht',
    'section_worth_helper' => 'Nur von der ersten Rechnung. Er bringt eine Rechnung nie unter null.',
    'kind' => 'Art',
    'kind_helper' => 'Ein Anteil des Preises oder ein fester Betrag.',
    'kind_percent' => 'Prozentsatz',
    'kind_fixed' => 'Fester Betrag',
    'value' => 'Wert',
    'value_percent_helper' => 'Eine ganze Zahl von 1 bis 100.',
    'value_fixed_helper' => 'In der Währung des Shops. Schreibe ihn als 12.50 oder 12,50.',

    'section_limits' => 'Grenzen',
    'section_limits_helper' => 'Alles hier ist freiwillig. Ein Code ohne eine davon gilt für alles, für jeden, für immer.',
    'max_uses' => 'Wie oft er verwendet werden darf',
    'max_uses_helper' => 'Wird beim Aufgeben der Bestellung gezählt, nicht beim Bezahlen der Rechnung - sonst ließe sich ein Code mit zehn Einlösungen über Nacht hundertmal aufgeben.',
    'expires' => 'Läuft ab',
    'expires_helper' => 'Nach diesem Zeitpunkt wirkt der Code nicht mehr. Leer heißt, dass das nie geschieht.',
    'packages' => 'Pakete',
    'packages_helper' => 'Nichts angehakt heißt jedes Paket, jetzt und später.',

    'empty' => 'Noch keine Gutscheine',
    'empty_body' => 'Lege einen an, und er wirkt an der Kasse, sobald er aktiv ist.',
];
