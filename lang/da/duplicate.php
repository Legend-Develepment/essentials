<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Egg" bliver stående på engelsk: det er det ord, Pelican bruger i hele sin
 * flade, og en indstilling, der hedder noget andet end den skærm, den kommer
 * fra, er en, man slår op to gange.
 */

return [
    'title' => 'Kopiér en server',
    'nav_label' => 'Kopiér server',
    'subheading' => 'Endnu en server sat op præcis som en, du allerede har, eller flere på én gang.',

    'section' => 'Hvad der kopieres',
    'section_helper' => 'Ejeren, egg'."'".'et, startkommandoen, grænserne og alle variabler bliver kopieret. Filer, databaser, sikkerhedskopier og planlagte opgaver gør ikke — en kopi af en kørende servers filer er en kopi af dens tilstand, og det er sjældent det, „en mere som denne" betyder.',

    'source' => 'Kopiér fra',
    'source_helper' => 'Kopierne lander på den samme node som denne server, for det er der, dens ledige adresser er.',

    'name' => 'Navn på kopien',
    'name_helper' => 'Laver du mere end én, bliver de nummereret: „Bot 1", „Bot 2" og så videre.',

    'copies' => 'Hvor mange',
    'copies_helper' => 'Vælg en server først.',
    'room' => ':count ledige adresser på :node, så det er det højeste, der kan laves lige nu.',
    'no_room' => 'Der er ingen ledig adresse tilbage på :node. En kopi skal have sin egen, så læg først en tildeling til den node.',

    /*
     * Talt op frem for listet for det, der lykkedes, og listet for det, der
     * ikke gjorde — det er den vej rundt, der hjælper: ti navne, der virkede, er
     * en mur af tekst, ingen læser, og det ene, der ikke gjorde, er det eneste,
     * der er værd at læse.
     */
    'made' => ':count kopier lavet',
    'partly_failed' => ':count kopier kunne ikke laves',
    'failed' => 'Der blev ikke kopieret noget',
];
