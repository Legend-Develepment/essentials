<?php

/*
 * Română. Scrisă de mână.
 *
 * „Cron” rămâne: este numele lucrului care rulează pe gazda panoului, iar cine
 * caută după el caută exact acel cuvânt.
 */

return [
    'nav_label' => 'Programări',
    'title' => 'Care programare s-a oprit',
    'subheading' => 'Fiecare sarcină programată de pe panou, cea mai rea prima - blocată de peste :hours ore, întârziată, sau niciodată rulată.',

    'how' => 'Pelicanul arată programările în interiorul fiecărui server, iar starea lui are trei cuvinte pentru ele: oprită, în procesare, activă. Niciunul nu înseamnă „aceasta s-a oprit”. O rulare care a căzut la jumătate rămâne în procesare pentru totdeauna și arată exact ca una care rulează acum; o programare a cărei oră a trecut de ore întregi pentru că a murit cronul se numește tot activă. Pagina aceasta pune cealaltă întrebare. Doar citire - tot ce editează, rulează sau șterge o programare rămâne pe pagina Pelicanului pentru acel server.',

    'column_state' => 'Stare',
    'column_name' => 'Programare',
    'column_server' => 'Server',
    'column_last' => 'Ultima rulare',
    'column_next' => 'Următoarea rulare',

    /*
     * Cele cinci verdicte. Scrise ca ceea ce este adevărat și nu ca instrucțiune,
     * pentru că trei dintre ele sunt lucruri de privit și două nu sunt.
     */
    'state_stuck' => 'Blocată',
    'state_overdue' => 'Întârziată',
    'state_never' => 'Niciodată rulată',
    'state_healthy' => 'În regulă',
    'state_off' => 'Oprită',

    'filter_stuck' => 'Blocată',
    'filter_overdue' => 'Întârziată',
    'filter_never' => 'Niciodată rulată',
    'filter_off' => 'Dezactivată',

    'open' => 'Deschide pe server',

    'empty' => 'Nicio programare pe vreun server la care ajungi - sau niciuna oprită, dacă ai un filtru pornit.',
];
