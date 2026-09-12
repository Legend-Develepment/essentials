<?php

/*
 * Română. Scris de mână.
 *
 * Coduri de reducere: coduri care scad ceva din prima factură.
 *
 * Doar din prima, intenționat, iar textul o spune acolo unde contează. Un cod
 * care ar ieftini și fiecare reînnoire ar fi o schimbare de preț cu dată de
 * final, iar cine vrea asta ar trebui să schimbe prețul.
 */

return [
    'title' => 'Coduri de reducere',
    'nav_label' => 'Coduri de reducere',
    'subheading' => 'Coduri care scad un procent sau o sumă din prima factură. Reînnoirile merg la prețul pachetului.',

    // ---- tabelul ---------------------------------------------------------
    'column_code' => 'Cod',
    'column_value' => 'Valoare',
    'column_uses' => 'Folosit',
    'column_expires' => 'Expiră',
    'column_packages' => 'Se aplică la',
    'column_live' => 'Activ',

    'never_expires' => 'Fără dată de final',
    'all_packages' => 'Tot',
    'some_packages' => ':count pachete',
    'usable' => 'Poate fi folosit chiar acum',
    'unusable' => 'Oprit, expirat sau epuizat',

    // ---- butoanele -------------------------------------------------------
    'new' => 'Cod nou',
    'edit' => 'Editează',
    'delete' => 'Șterge',
    'delete_confirm' => 'Scoate codul. Facturile care l-au folosit deja își păstrează reducerea - fiecare păstrează singură ce i s-a scăzut.',
    'deleted' => 'Cod șters',
    'saved' => 'Cod salvat',
    'save_failed' => 'Codul nu a putut fi salvat',
    'taken' => 'Altceva folosește deja codul acesta.',
    'invalid' => 'Un procent este un număr întreg de la 1 la 100. O sumă se scrie 12.50 sau 12,50.',

    // ---- formularul ------------------------------------------------------
    'section_code' => 'Codul',
    'section_code_helper' => 'Ce tastează clientul la comandă.',
    'code' => 'Cod',
    'code_helper' => 'Se păstrează și se compară cu majuscule și fără spații, ca să meargă oricum l-ar scrie cineva.',
    'live' => 'Activ',
    'live_helper' => 'Oprit face ca acest cod să nu mai funcționeze fără a-l șterge: iese din uz, în timp ce reducerea pe care a dat-o rămâne pe facturile care au avut-o.',

    'section_worth' => 'Cât scade',
    'section_worth_helper' => 'Doar din prima factură. Nu duce niciodată o factură sub zero.',
    'kind' => 'Fel',
    'kind_helper' => 'O parte din preț, sau o sumă fixă.',
    'kind_percent' => 'Procent',
    'kind_fixed' => 'Sumă fixă',
    'value' => 'Valoare',
    'value_percent_helper' => 'Un număr întreg de la 1 la 100.',
    'value_fixed_helper' => 'În moneda magazinului. Scrie-o ca 12.50 sau 12,50.',

    'section_limits' => 'Limite',
    'section_limits_helper' => 'Totul aici este opțional. Un cod fără niciuna dintre ele este valabil pentru tot, pentru oricine, pentru totdeauna.',
    'max_uses' => 'De câte ori poate fi folosit',
    'max_uses_helper' => 'Se numără la plasarea comenzii, nu la plata facturii - altfel un cod de zece folosiri ar putea fi plasat de o sută de ori într-o noapte.',
    'expires' => 'Expiră',
    'expires_helper' => 'După acest moment codul nu mai funcționează. Gol înseamnă că asta nu se întâmplă niciodată.',
    'packages' => 'Pachete',
    'packages_helper' => 'Nimic bifat înseamnă fiecare pachet, acum și mai târziu.',

    'empty' => 'Încă nu există coduri',
    'empty_body' => 'Fă unul și funcționează la comandă de îndată ce e activ.',
];
