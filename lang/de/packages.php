<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Pakete: ein Server, den jemand kaufen kann.
 *
 * Gelesen von dem, der den Shop einrichtet. Jedes Wort hier handelt von der
 * Vorlage und dem Preis; was ein Kunde sieht, steht in shop.php, weil die
 * beiden Leser andere Sätze über dieselbe Zeile wollen.
 *
 * „egg", „node", „swap", „io" und die Minecraft-Wörter bleiben Englisch: es sind
 * die Wörter auf Pelicans eigenem Serverformular, und ein Paket ist dieses
 * Formular, für später aufgehoben.
 */

return [
    'title' => 'Pakete',
    'nav_label' => 'Pakete',
    'subheading' => 'Was zum Verkauf steht. Jedes ist eine Servervorlage mit einem Preis darauf; ein Kunde kauft eines, und das Panel erstellt den Server.',

    // ---- die Tabelle -----------------------------------------------------
    'column_name' => 'Paket',
    'column_egg' => 'Egg',
    'column_price' => 'Preis',
    'column_stock' => 'Bestand',
    'column_live' => 'Im Verkauf',
    'column_orders' => 'Verkauft',

    'live' => 'Im Verkauf',
    'offline' => 'Nicht im Verkauf',
    'no_egg' => 'Kein Egg — kann nicht gebaut werden',

    'stock_unlimited' => 'Unbegrenzt',
    'stock_left' => 'Noch :count',
    'stock_out' => 'Ausverkauft',

    // ---- Zeiträume -------------------------------------------------------
    'period_once' => 'Einmalig',
    'period_month' => 'Monatlich',
    'period_quarter' => 'Vierteljährlich',
    'period_year' => 'Jährlich',

    // Hinter einem Preis: „€ 12,50 im Monat".
    'per_once' => 'einmalig',
    'per_month' => 'im Monat',
    'per_quarter' => 'im Quartal',
    'per_year' => 'im Jahr',

    // ---- Aktionen --------------------------------------------------------
    'new' => 'Neues Paket',
    'edit' => 'Bearbeiten',
    'duplicate' => 'Duplizieren',
    'copy_suffix' => ' (Kopie)',
    'go_live' => 'In den Verkauf nehmen',
    'go_offline' => 'Aus dem Verkauf nehmen',
    'delete' => 'Löschen',
    'delete_confirm' => 'Entfernt das Paket. Was bereits gekauft wurde, bleibt unberührt — Bestellungen behalten ihre eigene Kopie dessen, was sie waren.',
    'delete_refused' => 'Nicht gelöscht',
    'delete_refused_body' => 'Auf dieses Paket wurden Bestellungen aufgegeben, und sie zeigen darauf. Nimm es stattdessen aus dem Verkauf; es bleibt für die Unterlagen erhalten, und niemand kann es kaufen.',
    'deleted' => 'Paket gelöscht',
    'saved' => 'Paket gespeichert',
    'save_failed' => 'Das Paket konnte nicht gespeichert werden',
    'price_invalid' => 'Das ist kein Betrag. Schreib ihn wie 12.50 oder 12,50.',

    // ---- das Formular: was es ist ----------------------------------------
    'section_basics' => 'Das Paket',
    'section_basics_helper' => 'Was ein Kunde auf der Karte sieht.',
    'name' => 'Name',
    'name_helper' => 'Wie es im Shop heißt.',
    'slug' => 'Adresse',
    'slug_helper' => 'Kleinbuchstaben, Ziffern und Bindestriche. Leer gelassen wird sie aus dem Namen gebildet. Später ändern bricht einen Link, den jemand gespeichert hat.',
    'description' => 'Beschreibung',
    'description_helper' => 'Ein paar Zeilen unter dem Namen. Reiner Text.',
    'live_field' => 'Im Verkauf',
    'live_helper' => 'Aus behält das Paket hier und zeigt es niemandem. Ein Paket ohne Egg wird nie gezeigt, was auch immer hier steht.',
    'sort' => 'Reihenfolge',
    'sort_helper' => 'Niedriger kommt im Shop zuerst.',

    // ---- das Formular: was daraus wird -----------------------------------
    'section_server' => 'Der Server, der daraus wird',
    'section_server_helper' => 'Dieselben Fragen, die Pelican stellt, wenn du einen Server von Hand anlegst, hier einmal beantwortet und bei jedem Verkauf verwendet.',
    'egg' => 'Egg',
    'egg_helper' => 'Eines auswählen füllt das Image, den Startbefehl und jede Variable mit den eigenen Vorgaben des Eggs. Ändere danach, was du willst.',
    'image' => 'Docker-Image',
    'image_helper' => 'Eines der Images, die das Egg anbietet.',
    'image_default' => 'Das erste Image des Eggs',
    'startup' => 'Startbefehl',
    'startup_helper' => 'Einer der Befehle, die das Egg anbietet.',
    'startup_default' => 'Der erste Befehl des Eggs',
    'environment' => 'Variablen',
    'environment_helper' => 'Die Variablen des Eggs und worauf sie stehen. Alles, was das Egg hat und hier nicht aufgeführt ist, bekommt seine Vorgabe, wenn der Server erstellt wird.',
    'env_key' => 'Variable',
    'env_value' => 'Wert',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Wo ein Server aus diesem Paket erstellt werden darf, in dieser Reihenfolge probiert, bis eine eine freie Adresse hat. Nichts angehakt heißt jede Node.',

    // ---- das Formular: Grenzen -------------------------------------------
    'section_limits' => 'Grenzen',
    'section_limits_helper' => 'Was der Server bekommt. Dieselben Felder wie Pelicans eigenes Serverformular, in denselben Einheiten.',
    'memory' => 'Arbeitsspeicher',
    'disk' => 'Speicherplatz',
    'cpu' => 'CPU',
    'cpu_helper' => 'Prozent eines Kerns: 100 ist ein Kern, 200 sind zwei, 0 ist keine Grenze.',
    'swap' => 'Swap',
    'swap_helper' => '0 ist keiner, -1 ist unbegrenzt.',
    'io' => 'Block-IO-Gewicht',
    'io_helper' => 'Pelicans Vorgabe ist 500. Lass es dabei, wenn du nicht weißt, warum nicht.',
    'threads' => 'CPU-Pinning',
    'threads_helper' => 'Welche Kerne, wie Pelican sie schreibt: 0,1 oder 0-3. Leer ist jeder.',
    'oom_killer' => 'OOM-Killer',
    'oom_killer_helper' => 'Ob der Kernel den Server beenden darf, wenn ihm der Speicher ausgeht.',
    'databases' => 'Datenbanken',
    'allocations' => 'Zusätzliche Allocations',
    'backups' => 'Backups',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- das Formular: das Geld ------------------------------------------
    'section_price' => 'Preis und Bestand',
    'section_price_helper' => 'In der Währung des Shops, auf der Seite Shop-Einstellungen festgelegt. Ohne Steuer — die kommt als eigene Zeile auf die Rechnung.',
    'price' => 'Preis',
    'price_helper' => 'Je Zeitraum. Schreib ihn wie 12.50 oder 12,50.',
    'setup_fee' => 'Einrichtungsgebühr',
    'setup_fee_helper' => 'Einmal berechnet, auf der ersten Rechnung. Null für keine.',
    'period' => 'Abgerechnet',
    'period_helper' => 'Einmalig wird einmal bezahlt und behalten. Die anderen bekommen jeden Zeitraum eine neue Rechnung; eine unbezahlte sperrt den Server nach der Frist auf der Seite Shop-Einstellungen.',
    'stock' => 'Bestand',
    'stock_helper' => 'Wie viele gleichzeitig verkauft sein dürfen, jede nicht stornierte Bestellung mitgezählt. Leer ist unbegrenzt.',
    'term' => 'Mindestlaufzeit',
    'term_helper' => 'Wie lange sich jemand mit dem Kauf bindet. Null ist keine Bindung: er kann stornieren, und es endet am Ende des Zeitraums, den er bezahlt hat.',
    'term_unit' => 'Gezählt in',
    'term_unit_helper' => 'Tagen, Monaten oder Jahren. Eine stornierte Bestellung läuft bis zum Ende dieser Laufzeit, und an dem Tag wird der Server gelöscht.',
    'unit_day' => 'Tage',
    'unit_month' => 'Monate',
    'unit_year' => 'Jahre',
    'term_day' => 'Mindestlaufzeit: :count Tage',
    'term_month' => 'Mindestlaufzeit: :count Monate',
    'term_year' => 'Mindestlaufzeit: :count Jahre',
    'section_art' => 'Bild',
    'section_art_helper' => 'Das Bild auf der Paketkarte, im Shop und bei den Diensten eines Kunden. Lässt du beides leer, wird das eigene Bild des Eggs genommen, das die meisten Pakete ohnehin haben.',
    'art_file' => 'Ein Bild hochladen',
    'art_file_helper' => 'Eher breit als hoch: die Karte schneidet es auf 16:9. Bis zu 8 MB.',
    'art_url' => 'Oder eine Bildadresse',
    'art_url_helper' => 'Eine vollständige https-Adresse. Wird benutzt, wenn oben nichts hochgeladen ist.',

    'empty' => 'Noch keine Pakete',
    'empty_body' => 'Leg eines an, und es erscheint im Shop, sobald es in den Verkauf genommen wird.',
];
