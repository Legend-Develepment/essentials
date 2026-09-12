<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Whitelist" und "Operator" bleiben stehen: so heißen sie in Minecraft selbst,
 * auch in einem deutschen Client, und eine Einstellung, die anders heißt als das
 * Spiel sie nennt, ist eine, die man zweimal nachschlagen muss.
 */

return [
    'nav_label' => 'Spieler',
    'title' => 'Spieler',
    'subheading' => 'Die Whitelist, die Operatoren, die Sperren und alle, die dieser Server je gesehen hat.',

    /*
     * Einmal gesagt, weit oben, weil es beides erklärt: was die Seite kann und
     * warum das eine, was sie nicht kann, kein Fehler ist.
     */
    'how' => 'Änderungen gehen als Konsolenbefehle an den Server, das Spiel führt sie aus und schreibt seine eigenen Dateien. Dafür muss der Server laufen.',
    'needs_running' => 'Der Server muss laufen. Diese Änderungen macht das Spiel - nicht das Bearbeiten seiner Dateien hinter seinem Rücken.',

    'name' => 'Spielername',
    'reason' => 'Grund (optional)',

    'whitelist' => 'Zur Whitelist hinzufügen',
    'unwhitelist' => 'Von der Whitelist entfernen',
    'op' => 'Zum Operator machen',
    'deop' => 'Operator entziehen',
    'ban' => 'Sperren',
    'pardon' => 'Entsperren',
    'kick' => 'Kicken',

    'sent' => 'Befehl gesendet',
    'sent_body' => 'Der Server führt ihn aus und aktualisiert seine eigenen Dateien. Lade die Seite neu, um die Listen zu sehen.',
    'refused' => 'Das wurde nicht gesendet',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Auf der Whitelist',
    'flag_banned' => 'Gesperrt',
    'flag_seen' => 'War schon hier',

    'online' => 'Jetzt online',
    'online_count' => ':online von :max',
    'online_none' => 'Es ist niemand verbunden.',

    'players' => 'Spieler',
    'ips' => 'Gesperrte Adressen',
    'ips_empty' => 'Es sind keine Adressen gesperrt.',

    /*
     * Was eine leere Seite bedeutet - meist nicht „keine Spieler", sondern
     * „dieser Server ist nie gestartet".
     */
    'empty' => 'Noch nichts zu zeigen. Minecraft schreibt diese Listen selbst und legt sie erst an, wenn der Server zum ersten Mal gestartet ist.',

    'level' => 'Stufe :level',

    /*
     * Das eine, was diese Seite nicht tut - gesagt, statt es entdecken zu lassen.
     */
    'not_live' => 'Das ist, was der Server aufgeschrieben hat - nicht, wer gerade online ist.',
];
