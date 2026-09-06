<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Die Steuerleiste auf einer Serverseite. Eine eigene Datei statt einer Ecke in
 * der settings.php, denn das hier lesen die Leute, die das Panel benutzen, und
 * nicht der, der das Theme einrichtet.
 *
 * Der Zustand neben den Schaltflächen ist Pelicans eigenes Wort dafür, aus dem
 * Enum ContainerStatus - Leiste und Konsolenseite sind sich also nie uneins
 * darüber, was ein Server gerade tut.
 *
 * "Kill" bleibt stehen: so heißt Pelicans Schaltfläche und so heißt der Befehl,
 * und es ist etwas anderes als Stoppen.
 */

return [
    'console' => 'Konsole',
    'full_page' => 'Neues Fenster',
    'close' => 'Schließen',

    'start' => 'Starten',
    'restart' => 'Neu starten',
    'stop' => 'Stoppen',
    'kill' => 'Kill',

    'kill_confirm' => 'Kill stoppt den Container sofort. Alles, was der Server noch nicht auf die Festplatte geschrieben hat, geht verloren. Fortfahren?',

    'sent_title' => 'Energieaktion',
    'sent_body' => ':action wurde an :name gesendet.',
    'failed' => 'Die Node war nicht erreichbar.',
];
