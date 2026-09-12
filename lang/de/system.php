<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Swap", "Load average", "Wings", "Node" und "Uptime" bleiben stehen: das sind
 * die Namen, unter denen man sie auf dem Host und in Pelicans eigener
 * Oberfläche wiederfindet.
 */

return [
    'title' => 'Systemstatus',
    'nav_label' => 'Systemstatus',
    'subheading' => 'Die Maschine, auf der das Panel selbst läuft, was darauf läuft, und daneben jede Node, die du angefordert hast.',

    'options' => 'Optionen',

    'enabled' => 'In der Sidebar anzeigen',
    'enabled_helper' => 'Aus nimmt den Eintrag aus der Sidebar. Die Seite behält ihre eigene Adresse und ist also immer da, um sie wieder einzuschalten.',

    'refresh' => 'Neu lesen alle',
    'refresh_helper' => 'Die ganze Seite wird in diesem Abstand erneut angefordert. Aus lässt sie so, wie sie beim Öffnen war.',
    'refresh_off' => 'Nur wenn ich sie öffne',
    'refresh_seconds' => ':seconds Sekunden',

    'blocks' => 'Anzeigen',
    'blocks_helper' => 'Angehakt heißt sichtbar. „Festplatte" ist eine Karte je Dateisystem - eine volle Root-Partition verschwindet so nicht hinter einem halbleeren Datenmount.',
    'block_cpu' => 'Prozessor',
    'block_memory' => 'Arbeitsspeicher',
    'block_swap' => 'Swap',
    'block_disk' => 'Festplatte',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'System',
    'block_version' => 'Panel-Version',
    // Wird nie angezeigt - eine Node-Karte trägt den Namen der Node selbst -
    // aber blank() fragt danach, und ein fehlender Schlüssel, der seinen
    // eigenen Namen ausgibt, ist ein schlechter Ersatz.
    'block_node' => 'Node',

    'nodes' => 'Anzuzeigende Nodes',
    'nodes_helper' => 'Je eine Karte, neben dem Panel-Host. Nichts angehakt zeigt keine - das Dashboard hat bereits einen Block mit jeder Node darauf. Jede wird bei ihrer eigenen Daemon erfragt: ein kurzer Abstand und eine lange Liste sind also viele Anfragen.',

    'section_usage' => 'Auslastung',
    'section_host' => 'Dieses Panel',
    'section_nodes' => 'Nodes',

    'disk_panel' => 'Hier liegt das Panel',

    'wings' => 'Wings :version',
    'version_installed' => 'Installiert',
    'version_latest' => 'Neueste',
    'version_current' => 'Aktuell',
    'version_update' => 'Aktualisierung verfügbar',
    'version_unknown' => 'Konnte nicht geprüft werden',

    /*
     * Was eine Karte anbietet, die hinterherhinkt: ein Link auf das Release und
     * keine Schaltfläche, die aktualisiert - denn von hier aus gibt es nichts zu
     * aktualisieren. Pelican hat keinen Upgrade-Befehl, und Wings hat keinen
     * Endpunkt, der seine eigene Binärdatei ersetzt.
     */
    'version_release' => 'Was neu ist',
    'version_how_panel' => 'Öffnet die Release-Notizen. Das Panel wird auf der Maschine aktualisiert, auf der es läuft - es kann seine eigenen Dateien nicht ersetzen, und kein Plugin darf Shell-Befehle ausführen.',
    'version_how_wings' => 'Öffnet die Release-Notizen. Wings wird auf der Node selbst aktualisiert - das Panel hat keinen Weg zu einem Programm, das auf einer anderen Maschine läuft.',
    'wings_latest' => 'Neueste :version',

    'load_cores' => ':percent % von :cores Prozessoren',
    'load_windows' => ':five über 5 Min. · :fifteen über 15 Min.',
    'uptime_since' => 'Seit :date',

    'unavailable' => 'Auf diesem Host nicht verfügbar',

    'fact_os' => 'Betriebssystem',
    'fact_hostname' => 'Hostname',
    'fact_php' => 'PHP',
    'fact_cores' => 'Prozessoren',
    'fact_processes' => 'Prozesse',
];
