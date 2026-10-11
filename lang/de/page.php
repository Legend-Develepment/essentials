<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Queue-Worker", "Scheduler", "Channel" und Pfade wie storage/app bleiben
 * stehen: das sind die Namen, unter denen man sie auf dem Server und in der
 * Pelican-Dokumentation wiederfindet, und genau das braucht man, wenn eine
 * dieser Meldungen erscheint.
 */

return [
    'title' => 'Essentials-Einstellungen',
    'nav_label' => 'Essentials-Einstellungen',

    'save' => 'Speichern',
    'saved' => 'Einstellungen gespeichert',
    'save_failed' => 'Die Einstellungen konnten nicht gespeichert werden',
    'secret_kept' => 'Gespeichert. Leer lassen, um ihn zu behalten, oder einen neuen eingeben.',

    'update_background' => 'Sie läuft im Hintergrund und dauert ein bis zwei Minuten.',

    /*
     * Der Queue-Worker und der Scheduler, von denen jeder Hintergrundauftrag
     * und jede zeitgesteuerte Aufgabe abhängt. Getrennt genannt, weil beide
     * getrennt ausfallen und jeweils anders zu beheben sind.
     */
    'worker_missing' => 'Es hat kein Queue-Worker geantwortet. Modpack-Installationen, Mails und andere Hintergrundaufträge werden eingereiht und von einem Worker-Prozess ausgeführt - solange keiner läuft, werden sie aufgeschrieben und nie ausgeführt, ohne dass irgendwo ein Fehler erscheint. Entweder läuft kein Worker, oder es läuft einer, der vor der Installation dieses Plugins gestartet wurde und dessen Code nicht laden kann. Beides behebt ein Neustart des Workers auf dem Panel-Host. Stelle seinen Dienst so ein, dass er sich selbst neu startet, sonst kommt das nach jeder Aktualisierung wieder.',
    'cron_missing' => 'Der Scheduler des Panels lief seit :for Minuten nicht. Verlängerungen und Watchdog-Prüfungen warten darauf. Die Cron-Zeile steht in der Pelican-Dokumentation.',

    /*
     * Nach der Ursache benannt statt nach dem Symptom - das Symptom ist „es ist
     * nichts passiert", und genau das machte es so schwer einzuordnen.
     */
    'storage_failed' => 'Das Panel konnte nicht in sein storage-Verzeichnis schreiben, deshalb wurde das hier nicht gespeichert. Prüfe, ob storage/app dem Benutzer gehört, unter dem das Panel läuft. Der Grund steht in storage/logs.',
];
