<?php

/*
 * Deutsch. Von Hand geschrieben.
 *
 * "Overallocation" bleibt stehen: so heißt das Feld, das du auf der Node-Seite
 * ausfüllst.
 */

return [
    'nav_label' => 'Kapazität',
    'title' => 'Ob noch ein Server hineinpasst',
    'subheading' => 'Was auf jeder Node zugesagt ist, gegen das, was sie vergeben darf.',

    'how' => 'Zugesagt, nicht verbraucht. Eine Node kann zu zwanzig Prozent ausgelastet und trotzdem randvoll sein, denn „voll" heißt hier vergeben und nicht in Betrieb - der Maschinen-Block auf dem Dashboard beantwortet die andere Frage und bleibt, wo er ist. Gerechnet wird wie bei Pelican selbst, mit der Methode, die entscheidet, ob ein Server überhaupt angelegt werden darf: Kapazität mal eins plus Overallocation, gegen die Summe dessen, was jedem Server auf der Node zugesagt wurde. Eine Kapazität von null bedeutet unbegrenzt, und eine Overallocation unter null ebenfalls - deshalb haben manche Zeilen gar keinen Prozentwert statt eines vollen oder leeren Balkens.',

    'column_node' => 'Maschine',
    'column_fullest' => 'Am vollsten',
    'column_memory' => 'Arbeitsspeicher',
    'column_disk' => 'Festplatte',
    'column_cpu' => 'Prozessor',
    'column_at_limit' => 'Am Limit',

    'servers' => ':count Server',

    'filter_tight' => 'Fast voll',

    'open' => 'Maschine öffnen',

    'empty' => 'Keine Maschinen, die du erreichen kannst.',
];
