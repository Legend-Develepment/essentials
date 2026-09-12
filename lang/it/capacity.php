<?php

/*
 * Italiano. Scritto a mano.
 *
 * «Nodo» è la parola che Pelican usa in italiano per una macchina, ed è quella
 * ripresa qui; nelle pagine pubbliche, dove legge qualcuno che di Pelican non
 * ha mai sentito parlare, è «macchina».
 */

return [
    'nav_label' => 'Capacità',
    'title' => 'Se ci sta un altro server',
    'subheading' => 'Quanto è stato promesso su ogni nodo, contro quanto può distribuire.',

    'how' => 'Promesso, non consumato. Un nodo può essere occupato al venti per cento e completamente pieno, perché «pieno» parla di quanto è stato distribuito e non di quanto sta girando - il blocco Macchine della dashboard risponde all\'altra domanda, e resta dov\'è. Il conto fatto qui è quello di Pelican stesso, preso dal metodo che decide se un server può proprio essere creato: la capacità per uno più la sovrallocazione, contro la somma di quanto è stato promesso a ogni server del nodo. Una capacità di zero vuol dire illimitato, e anche una sovrallocazione sotto zero - da cui le righe senza percentuale, invece di una barra piena o vuota.',

    'column_node' => 'Macchina',
    'column_fullest' => 'Il più pieno',
    'column_memory' => 'Memoria',
    'column_disk' => 'Disco',
    'column_cpu' => 'Processore',
    'column_at_limit' => 'A un limite',

    'servers' => ':count server',

    'filter_tight' => 'Quasi piene',

    'open' => 'Apri la macchina',

    'empty' => 'Nessuna macchina che tu possa raggiungere.',
];
