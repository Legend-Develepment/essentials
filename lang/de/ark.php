<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Die Namen der Einstellungen selbst werden nicht übersetzt. Sie stehen wörtlich
 * in der GameUserSettings.ini, und das Formular macht daraus nur lesbare Wörter -
 * eine Einstellung, die anders heißt als die Zeile in der Datei, aus der sie
 * kommt, ist eine, die man zweimal nachschlagen muss.
 */

return [
    /* ------------------------------------------------- das Admin-Tab ----- */

    'section_helper' => 'Welche Eggs ARK fahren. Sonst nichts - der Rest eines ARK-Servers wird über die Startvariablen eingestellt, und Pelicans eigene Startup-Seite bearbeitet die bereits.',

    'eggs' => 'Welche Eggs sind ARK',
    'eggs_helper' => 'Hake die Eggs an, die einen ARK-Server fahren. In Servern, die sie nutzen, erscheint dann eine Seite „Welteinstellungen" - und sonst nirgends. Das ist eine andere Frage als die auf der Statusseite: die fragt, welche Eggs Valves Query beantworten, was Rust und Valheim auch tun, und diese fragt, welche Eggs die GameUserSettings.ini dort ablegen, wo ARK sie ablegt - was nur ARK tut. Zu Beginn ist absichtlich nichts angehakt: ein Plugin kann nicht wissen, wie du deine Eggs genannt hast.',

    /* ------------------------------------------- die Seite im Server ----- */

    'nav_label' => 'Welteinstellungen',
    'title' => 'ARK-Welteinstellungen',
    'subheading' => 'Die Einstellungen, die Leute wirklich ändern, aus der GameUserSettings.ini.',

    'group_server' => 'Der Server',
    'group_server_helper' => 'Wie der Server heißt, wer beitreten darf und mit wie vielen.',
    'group_rates' => 'Raten',
    'group_rates_helper' => 'Wie schnell Dinge geschehen. 1.0 ist das Spiel, wie es ausgeliefert wird; 2.0 ist doppelt so schnell.',
    'group_rules' => 'Regeln',
    'group_rules_helper' => 'Was Spieler dürfen und was das Spiel ihnen zeigt.',

    'keeps' => 'Fünfzehn Einstellungen aus einer Datei mit Hunderten. Alles andere darin - deine Mod-Einstellungen, Schlüssel, von denen dieses Plugin nie gehört hat, die Kommentare und die Reihenfolge des Ganzen - bleibt beim Speichern genau so, wie es ist.',
    'missing' => 'Dieser Server hat noch keine GameUserSettings.ini. Das Spiel schreibt sie beim ersten Lauf; starte den Server also einmal, dann füllt sich diese Seite.',
    'read_only' => 'Du darfst diese Datei lesen, aber nicht schreiben - hier lässt sich also nichts ändern.',

    'save' => 'Speichern',
    'saved' => 'Gespeichert',
    'saved_restart' => 'ARK liest diese Datei beim Start. Starte den Server also neu, damit die Änderung greift.',
    'failed' => 'Konnte nicht gespeichert werden',
    'failed_write' => 'Die Daemon hat den Schreibvorgang abgelehnt. Prüfe, ob der Server erreichbar und die Datei nicht schreibgeschützt ist.',
];
