<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Schedule" bleibt stehen, wo es um Pelicans eigenen Tab geht - so heißt der
 * Bildschirm, auf den man geschickt wird. Die Cron-Zeile wird nicht übersetzt:
 * das sind fünf Felder aus der Datei selbst.
 */

return [
    'nav_label' => 'Schedules',
    'title' => 'Welche Planung stehen geblieben ist',
    'subheading' => 'Jede geplante Aufgabe des Panels, die schlimmste zuerst - über :hours Stunden hängend, überfällig oder nie gelaufen.',

    'how' => 'Pelican zeigt Schedules innerhalb jedes Servers, und sein eigener Status kennt dafür drei Wörter: aus, in Arbeit, aktiv. Keines davon heißt „das ist stehen geblieben". Ein Durchlauf, der mittendrin abgestürzt ist, bleibt für immer auf „in Arbeit" und sieht genauso aus wie einer, der gerade läuft; eine Planung, deren Zeit vor Stunden verstrichen ist, weil der Cron nicht mehr lief, heißt weiterhin aktiv. Diese Seite stellt die andere Frage. Nur lesend - alles, was eine Planung ändert, startet oder löscht, bleibt auf Pelicans eigener Seite für diesen Server.',

    'column_state' => 'Zustand',
    'column_name' => 'Planung',
    'column_server' => 'Server',
    'column_last' => 'Letzter Lauf',
    'column_next' => 'Nächster Lauf',

    /*
     * Die fünf Urteile. Als Feststellung geschrieben und nicht als Anweisung,
     * denn drei davon sind etwas zum Ansehen und zwei nicht.
     */
    'state_stuck' => 'Hängt',
    'state_overdue' => 'Überfällig',
    'state_never' => 'Nie gelaufen',
    'state_healthy' => 'In Ordnung',
    'state_off' => 'Aus',

    'filter_stuck' => 'Hängt',
    'filter_overdue' => 'Überfällig',
    'filter_never' => 'Nie gelaufen',
    'filter_off' => 'Ausgeschaltet',

    'open' => 'Auf dem Server öffnen',

    'empty' => 'Keine Schedules auf einem Server, den du erreichst - oder keine, die stehen geblieben sind, falls ein Filter aktiv ist.',
];
