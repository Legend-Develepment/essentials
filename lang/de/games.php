<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Speichern',
    'saved' => 'Gespeichert',
    'restart' => 'Das Spiel liest diese Datei beim Start, also starte den Server neu, damit die Änderung wirkt.',
    'failed' => 'Speichern fehlgeschlagen',
    'failed_write' => 'Der Daemon hat den Schreibvorgang abgelehnt. Prüfe, ob der Server erreichbar ist und die Datei nicht schreibgeschützt.',
    'read_only' => 'Du darfst diese Datei lesen, aber nicht schreiben, also lässt sich hier nichts ändern.',
    'missing' => 'Dieser Server hat noch keine Einstellungsdatei. Das Spiel schreibt sie beim ersten Start, starte den Server also einmal und diese Seite füllt sich.',
    'keeps' => 'Alles andere in der Datei - die Kommentare, die Leerzeilen, die Reihenfolge und jeder Schlüssel, den dieses Plugin nicht kennt - bleibt beim Speichern genau so.',
    'raw' => 'Die Namen hier sind die Namen des Spiels, in der Reihenfolge der Datei. Nichts wird übersetzt und nichts gruppiert, denn diese Seite liest die Datei statt einer Liste, die jemand aufgeschrieben hat - sie zeigt also jede Einstellung, die das Spiel kennt.',
    'unset' => 'Nicht gesetzt. Das Spiel nennt sie als Beispiel; ausfüllen fügt sie hinzu.',
    'group_all' => 'Einstellungen',
    'group_all_helper' => 'Alles, was diese Datei nennt.',
    'subheading' => 'Aus :files gelesen statt aus einer Liste, die jemand aufgeschrieben hat.',
];
