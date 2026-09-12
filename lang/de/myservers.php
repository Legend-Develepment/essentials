<?php

/*
 * Die Seite, die die Frage „welcher von meinen hängt hinterher“ beantwortet.
 * Geschrieben für den, dem die Server gehören, nicht für den, der das Panel
 * betreibt - deshalb ist hier von Nodes keine Rede, und deshalb steht hier
 * keine Zahl, mit der er nichts anfangen kann. Jede Zeile nennt entweder
 * einen Server, den er öffnen kann, oder sagt, was mit ihm zu tun ist.
 */

return [
    'title' => 'Braucht Aufmerksamkeit',
    'nav_label' => 'Braucht Aufmerksamkeit',
    'subheading' => 'Deine Server, nach dem sortiert, was im Rückstand ist, und nicht nach dem Namen. Ein Backup gilt nach :days Tagen als veraltet.',
    'column_server' => 'Server',
    'column_last' => 'Letztes Backup',
    'column_kept' => 'Vorhanden',
    'column_schedules' => 'Stehen gebliebene Aufgaben',
    'never' => 'Nie',
    'filter_none' => 'Nie gesichert',
    'filter_stale' => 'Backup ist veraltet',
    'open' => 'Backups',
    'empty' => 'Nichts ist im Rückstand',
    'empty_body' => 'Jeder Server, den du erreichst, hat ein aktuelles Backup und keine stehen gebliebenen Aufgaben. Diese Seite füllt sich von selbst, sobald das nicht mehr stimmt.',
];
