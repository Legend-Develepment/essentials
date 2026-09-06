<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Egg", "Node" und "Allocation" bleiben stehen: so heißen sie überall sonst im
 * Panel, und ein eigenes Wort dafür wäre eines, das man dort nicht wiederfindet.
 */

return [
    'title' => 'Server duplizieren',
    'nav_label' => 'Server duplizieren',
    'subheading' => 'Noch ein Server, genau wie einer, den du schon hast — oder gleich mehrere.',

    'section' => 'Was kopiert wird',
    'section_helper' => 'Eigentümer, Egg, Startbefehl, Limits und jede Variable werden kopiert. Dateien, Datenbanken, Backups und Schedules nicht — eine Kopie der Dateien eines laufenden Servers ist eine Kopie seines Zustands, und das ist selten gemeint, wenn jemand „noch so einen" sagt.',

    'source' => 'Kopieren von',
    'source_helper' => 'Die Kopien landen auf derselben Node wie dieser Server, denn dort liegen seine freien Adressen.',

    'name' => 'Name der Kopie',
    'name_helper' => 'Mehr als eine zu erzeugen nummeriert sie: „Bot 1", „Bot 2" und so weiter.',

    'copies' => 'Wie viele',
    'copies_helper' => 'Wähle zuerst einen Server.',

    'room' => ':count freie Adressen auf :node — mehr lassen sich im Moment also nicht anlegen.',
    'no_room' => 'Auf :node ist keine Adresse mehr frei. Jede Kopie braucht eine eigene; füge dieser Node also zuerst eine Allocation hinzu.',

    /*
     * Erfolge gezählt, Fehlschläge aufgezählt — herum ist das die hilfreiche
     * Richtung: zehn Namen, die geklappt haben, liest niemand, und der eine, der
     * es nicht tat, ist das Einzige, was zu lesen lohnt.
     */
    'made' => ':count Kopien angelegt',
    'partly_failed' => ':count Kopien konnten nicht angelegt werden',
    'failed' => 'Es wurde nichts kopiert',
];
