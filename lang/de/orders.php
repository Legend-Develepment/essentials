<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * Bestellungen: was jemand gekauft hat und was daraus geworden ist.
 *
 * Die vier Zustände unten betreffen das Geld, nicht den Server. Ob der Server
 * gerade läuft, ist Pelicans eigene Frage und wird auf Pelicans eigenen Seiten
 * beantwortet. Die Worte hier halten beides auseinander.
 */

return [
    'title' => 'Bestellungen',
    'nav_label' => 'Bestellungen',
    'subheading' => 'Alles, was gekauft wurde, der Server, der daraus entstand, und wie es darum steht.',

    // ---- die Tabelle -----------------------------------------------------
    'column_order' => 'Bestellung',
    'column_customer' => 'Kunde',
    'column_package' => 'Paket',
    'column_server' => 'Server',
    'column_state' => 'Zustand',
    'column_due' => 'Nächste Fälligkeit',

    'no_server' => 'Noch nicht gebaut',
    'no_due' => 'Einmalig',
    'gone_customer' => 'Konto gelöscht',
    'gone_package' => 'Paket gelöscht',
    'overdue_days' => ':days Tage überfällig',

    'state_pending' => 'Wartet',
    'state_active' => 'Aktiv',
    'state_suspended' => 'Gesperrt',
    'state_cancelled' => 'Storniert',

    // ---- die Schaltflächen -----------------------------------------------
    'retry' => 'Erneut bauen',
    'retry_confirm' => 'Stellt den Bau noch einmal in die Warteschlange. Sonst ändert sich nichts, und die Rechnung bleibt bezahlt.',
    'retrying' => 'In die Warteschlange gestellt',

    'suspend' => 'Sperren',
    'suspend_confirm' => 'Hält den Server mit Pelicans eigener Sperre an. Dateien, Datenbanken und Backups bleiben, wo sie sind, und das Bezahlen der Rechnung hebt es wieder auf.',
    'suspended' => 'Gesperrt',

    'unsuspend' => 'Entsperren',
    'unsuspended' => 'Läuft wieder',

    'change_due' => 'Fälligkeit ändern',
    'change_due_helper' => 'Wann die nächste Rechnung geschrieben wird. Leer heißt nie - die Bestellung verlängert sich nicht mehr, ohne storniert zu sein.',

    'cancel' => 'Stornieren',
    'cancel_confirm' => 'Beendet die Verlängerungen und gibt den Platz im Bestand zurück. Der Server bleibt stehen: gelöscht wird er in Pelican, wo das hingehört.',
    'cancelled' => 'Storniert',

    'saved' => 'Gespeichert',
    'refused' => 'Nichts hat sich geändert',
    'refused_body' => 'Die Bestellung ist nicht in einem Zustand, in dem das ginge. Lade die Seite neu und sieh sie dir noch einmal an.',

    // ---- was der Kunde hört ----------------------------------------------
    'bell_ready' => 'Dein Server ist bereit',
    'bell_ready_body' => ':server wurde angelegt und wartet darauf, dass du ihn startest.',
    'bell_suspended' => 'Dein Server wurde gesperrt',
    'bell_suspended_body' => 'Eine Rechnung blieb über die Kulanzfrist hinaus unbezahlt. Bezahlen startet den Server wieder; gelöscht wurde nichts.',

    // ---- was die Verwaltung hört -----------------------------------------
    'bell_failed' => 'Bestellung :number konnte nicht gebaut werden',
    'no_allocation' => 'Keine Node in diesem Paket hat eine freie allocation. Lege eine an und baue erneut.',
    'no_reason' => 'Das Panel hat es abgelehnt, ohne zu sagen warum.',

    // ---- der Server, der daraus wird -------------------------------------
    'server_description' => 'Im Shop gekauft, Bestellung :number.',
    'server_fallback' => 'Server',
    'state_ending' => 'Läuft aus',
    'ends_on' => 'Endet :date',
    'no_more_dues' => 'Wird nicht mehr berechnet',
    'cancel_confirm_open' => 'Beendet jetzt die Verlängerungen und gibt den Platz im Bestand zurück. Der Server läuft weiter: dieses Paket hat keine Mindestlaufzeit, es gibt also kein Datum, bis zu dem er laufen müsste. Lösche den Server in Pelican, wenn der Kunde ihn nicht mehr braucht.',
    'terminate' => 'Anhalten und löschen',
    'terminate_heading' => 'Diesen Server löschen?',
    'terminate_confirm' => 'Der Server wird jetzt gelöscht, mit seinen Dateien, seinen Datenbanken und seinen Backups. Es gibt kein Zurück und kein Warten auf das Ende des Vertrags. Storniere stattdessen, wenn der Kunde ihn bis zu dem Datum behalten soll, das ihm genannt wurde.',
    'terminate_go' => 'Löschen',
    'terminated' => 'Gelöscht',
    'terminated_body' => 'Der Server ist weg und die Bestellung ist abgeschlossen.',
    'bell_ending' => 'Dein :package endet am :date',
    'bell_ending_open' => 'Dein :package wurde storniert',
    'bell_ending_body' => 'Dir wird dafür nichts mehr berechnet. Alles auf dem Server wird gelöscht, wenn er anhält, also sichere dir vorher, was du behalten willst.',
    'bell_ended' => 'Dein :package ist beendet',
    'bell_ended_body' => 'Der Vertrag ist ausgelaufen und der Server wurde gelöscht.',
    'bell_undeleted' => 'Bestellung :number konnte nicht gelöscht werden',
    'bell_undeleted_body' => 'Das Panel hat es abgelehnt, den Server zu löschen. Die Bestellung ist abgeschlossen und wird niemandem berechnet, aber der Server steht noch da und muss in Pelican entfernt werden.',
    'bell_undelivered' => 'Die Datei zu Bestellung :number liegt noch hier',
    'bell_undelivered_body' => 'Der Server wurde gebaut, aber die hochgeladene Datei des Kunden ließ sich nicht hineinlegen. Sie liegt noch im Speicher des Panels, und der Grund steht in storage/logs.',
    'by_customer' => 'Vom Kunden beendet',
    'by_admin' => 'Hier beendet',
    'filter_by' => 'Wer beendet hat',
    'details' => 'Details',
    'details_of' => 'Bestellung :number',
    'close' => 'Schließen',
    'detail_package' => 'Paket',
    'detail_placed' => 'Bestellt',
    'detail_built' => 'Server gebaut',
    'detail_due' => 'Nächste Fälligkeit',
    'detail_ends' => 'Endet',
    'detail_suspended' => 'Gesperrt',
    'detail_cancelled' => 'Storniert',
    'detail_file_in' => 'Datei eingelegt',
    'detail_file_waiting' => 'Datei',
    'detail_file_waiting_value' => 'Hochgeladen, wartet auf den Bau des Servers.',
    'detail_note' => 'Letztes Problem',

    'empty' => 'Es wurde noch nichts gekauft',
    'empty_body' => 'Bestellungen erscheinen hier, sobald jemand ein Paket kauft.',

    // ---- Verlängerungen --------------------------------------------------
    'filter_late' => 'Mit einer Rechnung im Rückstand',
    'run_renewals' => 'Verlängerungen jetzt laufen lassen',
    'run_renewals_confirm' => 'Tut, was der nächtliche Durchlauf tut: schreibt die nächste Rechnung für alles, was bald fällig ist, und hält die Server an, hinter denen eine Rechnung über die Kulanzfrist hinaus unbezahlt blieb.',
    'renewals_queued' => 'In die Warteschlange gestellt',
    'renewals_queued_body' => 'Es läuft über die Warteschlange. Lade die Seite gleich neu, um zu sehen, was sich geändert hat.',
];
