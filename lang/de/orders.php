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

    'empty' => 'Es wurde noch nichts gekauft',
    'empty_body' => 'Bestellungen erscheinen hier, sobald jemand ein Paket kauft.',

    // ---- Verlängerungen --------------------------------------------------
    'filter_late' => 'Mit einer Rechnung im Rückstand',
    'run_renewals' => 'Verlängerungen jetzt laufen lassen',
    'run_renewals_confirm' => 'Tut, was der nächtliche Durchlauf tut: schreibt die nächste Rechnung für alles, was bald fällig ist, und hält die Server an, hinter denen eine Rechnung über die Kulanzfrist hinaus unbezahlt blieb.',
    'renewals_queued' => 'In die Warteschlange gestellt',
    'renewals_queued_body' => 'Es läuft über die Warteschlange. Lade die Seite gleich neu, um zu sehen, was sich geändert hat.',
];
