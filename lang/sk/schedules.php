<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Cron" ostáva po anglicky: tak sa volá na hostiteľovi aj v dokumentácii
 * Pelicanu, a presne to treba vedieť, keď táto stránka hovorí, že nebeží.
 */

return [
    'nav_label' => 'Naplánované úlohy',
    'title' => 'Ktorá naplánovaná úloha zastala',
    'subheading' => 'Všetky naplánované úlohy panela, najhoršie hore — zaseknuté dlhšie ako :hours hodín, oneskorené, alebo nikdy nespustené.',

    'how' => 'Pelican ukazuje naplánované úlohy vnútri každého servera a jeho vlastný stav má pre ne tri slová: neaktívna, spracúva sa, aktívna. Ani jedno nehovorí „táto zastala". Beh, ktorý spadol v polovici, ostane „spracúva sa" navždy a kreslí sa presne ako ten, ktorý práve ide; úloha, ktorej čas uplynul pred hodinami, lebo cron umrel, sa stále volá aktívna. Táto stránka kladie tú druhú otázku. Len na čítanie — všetko, čo úlohu upravuje, spúšťa alebo maže, ostáva na stránke Pelicanu pre ten server.',

    'column_state' => 'Stav',
    'column_name' => 'Úloha',
    'column_server' => 'Server',
    'column_last' => 'Posledný beh',
    'column_next' => 'Ďalší beh',

    /*
     * Päť verdiktov. Napísané ako to, čo je pravda, nie ako pokyn, lebo tri z
     * nich sú veci na pozretie a dve nie.
     */
    'state_stuck' => 'Zaseknutá',
    'state_overdue' => 'Oneskorená',
    'state_never' => 'Nikdy nespustená',
    'state_healthy' => 'V poriadku',
    'state_off' => 'Neaktívna',

    'filter_stuck' => 'Zaseknuté',
    'filter_overdue' => 'Oneskorené',
    'filter_never' => 'Nikdy nespustené',
    'filter_off' => 'Vypnuté',

    'open' => 'Otvoriť na serveri',

    'empty' => 'Žiadne naplánované úlohy na serveroch, na ktoré dosiahnete — alebo žiadna zastavená, ak máte zapnutý filter.',
];
