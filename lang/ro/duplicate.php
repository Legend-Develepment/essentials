<?php

/*
 * Română. Scrisă de mână.
 *
 * „Egg” și „alocare” rămân: sunt cuvintele din Pelican și pe acelea le caută
 * omul în pagina node-ului.
 */

return [
    'title' => 'Duplică un server',
    'nav_label' => 'Duplică server',
    'subheading' => 'Încă un server configurat exact ca unul pe care îl ai deja, sau mai multe deodată.',

    'section' => 'Ce se copiază',
    'section_helper' => 'Proprietarul, egg-ul, comanda de pornire, limitele și fiecare variabilă se copiază. Fișierele, bazele de date, copiile de siguranță și programările nu — o copie a fișierelor unui server care rulează este o copie a stării lui, iar asta rareori înseamnă „încă unul ca acesta”.',

    'source' => 'Copiază din',
    'source_helper' => 'Copiile ajung pe același node ca acest server, pentru că acolo sunt adresele lui libere.',

    'name' => 'Numește copia',
    'name_helper' => 'Dacă faci mai multe, le numerotează: „Bot 1”, „Bot 2”, și așa mai departe.',

    'copies' => 'Câte',
    'copies_helper' => 'Alege mai întâi un server.',
    'room' => ':count adrese libere pe :node, deci atâtea se pot face acum.',
    'no_room' => 'Nu a mai rămas nicio adresă liberă pe :node. O copie are nevoie de una proprie, deci adaugă mai întâi o alocare acelui node.',

    /*
     * Reușitele numărate și nu enumerate, iar eșecurile enumerate - și aceasta
     * e ordinea care ajută: zece nume care au mers sunt un zid de text pe care
     * nimeni nu îl citește, iar cel care nu a mers este singurul care merită
     * citit.
     */
    'made' => ':count copii făcute',
    'partly_failed' => ':count copii nu au putut fi făcute',
    'failed' => 'Nu s-a copiat nimic',
];
