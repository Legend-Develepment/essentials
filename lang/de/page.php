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

    'update' => 'Aktualisieren',
    'update_available' => 'Eine Aktualisierung ist verfügbar',
    'update_confirm' => 'Das Panel lädt die neue Version, baut seine Assets neu und leert seine Caches. Deine Einstellungen bleiben erhalten.',
    'update_started' => 'Aktualisierung gestartet',
    'update_background' => 'Sie läuft im Hintergrund und dauert ein bis zwei Minuten.',
    'update_failed' => 'Das Theme konnte nicht aktualisiert werden',
    'update_done' => 'Theme aktualisiert',

    'check' => 'Nach Aktualisierungen suchen',
    'check_failed' => 'Der Update-Feed konnte nicht gelesen werden',
    'check_failed_body' => 'Das Panel hat ihn nicht erreicht, oder er hat kein gültiges JSON zurückgegeben.',
    'up_to_date' => 'Du bist auf der neuesten Version',
    'reinstall' => 'Neu installieren',

    'auto_on' => 'Aktualisierungen installieren sich selbst',

    /*
     * Was die letzte automatische Prüfung getan hat. Jede dieser Zeilen nennt
     * die Stelle, die man ansehen müsste — aus dem Browser sehen die drei Arten,
     * wie das schiefgeht, nämlich alle gleich aus: eine Zahl, die herunterzählt.
     */
    'auto_never' => 'Es lief noch keine Prüfung. Automatische Aktualisierungen brauchen den Scheduler des Panels — den Cron-Eintrag, der jede Minute php artisan schedule:run ausführt. Ohne ihn geschieht überhaupt nichts Geplantes.',
    'auto_ago' => 'Zuletzt geprüft :ago',
    'auto_just_now' => 'gerade eben',
    'auto_minutes' => 'Minuten her',
    'auto_current' => 'nichts Neueres in diesem Channel.',
    'auto_installed' => 'v:version wurde hier installiert, von der geplanten Prüfung selbst. Das tut sie, wenn kein Queue-Worker antwortet, die Aktualisierung geschieht also so oder so — aber ein Panel ohne Worker ist eines, auf dem auch die übrige eingereihte Arbeit nicht geschieht.',
    'auto_queued' => 'v:version wurde an den Queue-Worker übergeben. Ändert sich die Version oben nicht innerhalb weniger Minuten, nimmt der Worker zwar Aufträge an, scheitert aber an diesem hier — ihn neu zu starten hilft meistens, und der Grund steht in storage/logs.',
    'auto_unreachable' => 'der Update-Feed war nicht lesbar. Er wird über das Internet geholt, das ist also meist ein Netz- oder DNS-Problem auf dem Panel-Host.',
    'auto_error' => 'die Prüfung ist fehlgeschlagen. Der Grund steht in storage/logs.',

    /*
     * Der Queue-Worker, der eine Aktualisierung tatsächlich ausführt. Getrennt
     * von der Prüfung oben genannt, weil beide getrennt ausfallen und jeweils
     * anders zu beheben sind.
     */
    'worker_missing' => 'Es hat kein Queue-Worker geantwortet. Aktualisierungen und Modpack-Installationen werden eingereiht und von einem Worker-Prozess ausgeführt — solange keiner läuft, werden sie aufgeschrieben und nie ausgeführt, ohne dass irgendwo ein Fehler erscheint. Entweder läuft kein Worker, oder es läuft einer, der vor der Installation dieses Plugins gestartet wurde und dessen Code nicht laden kann. Beides behebt ein Neustart des Workers auf dem Panel-Host. Stelle seinen Dienst so ein, dass er sich selbst neu startet, sonst kommt das nach jeder Aktualisierung wieder.',

    'next_check' => 'Nächste Prüfung in',
    'due_now' => 'jetzt fällig',

    /*
     * Nach der Ursache benannt statt nach dem Symptom — das Symptom ist „es ist
     * nichts passiert", und genau das machte es so schwer einzuordnen.
     */
    'storage_failed' => 'Das Panel konnte nicht in sein storage-Verzeichnis schreiben, deshalb wurde das hier nicht gespeichert. Prüfe, ob storage/app dem Benutzer gehört, unter dem das Panel läuft. Der Grund steht in storage/logs.',

    /*
     * Nach jeder fehlgeschlagenen Aktualisierung gesagt, nicht nur nach einer
     * Namensabweichung: die Meldung oben nennt die Ursache, diese nennt das
     * eine Mittel, das sich aus „erwartet X, bekommen Y" nicht ableiten lässt.
     */
    'update_renamed' => 'Steht hier, dass zwei IDs nicht übereinstimmen, wurde das Plugin umbenannt — und darüber kommt keine Aktualisierung hinweg, denn Pelican kennt ein installiertes Plugin an seiner ID. Deinstalliere den alten Eintrag unter Admin → Plugins und installiere dieses hier frisch. Deine Einstellungen überleben das: sie liegen in .env und in storage/app/private/legend-theme, und keines von beiden hängt an der ID.',
];
