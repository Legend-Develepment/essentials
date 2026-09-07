<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Cron" zůstává anglicky: tak se jmenuje na hostiteli i v dokumentaci
 * Pelicanu, a přesně to je potřeba vědět, když tahle stránka říká, že neběží.
 */

return [
    'nav_label' => 'Naplánované úlohy',
    'title' => 'Která naplánovaná úloha se zastavila',
    'subheading' => 'Všechny naplánované úlohy panelu, nejhorší nahoře — zaseknuté déle než :hours hodin, zpožděné, nebo nikdy nespuštěné.',

    'how' => 'Pelican ukazuje naplánované úlohy uvnitř každého serveru a jeho vlastní stav pro ně má tři slova: neaktivní, zpracovává se, aktivní. Ani jedno neříká „tahle se zastavila". Běh, který spadl v polovině, zůstane „zpracovává se" navždy a kreslí se přesně jako ten, který právě jede; úloha, jejíž čas uplynul před hodinami, protože cron umřel, se pořád jmenuje aktivní. Tahle stránka klade tu druhou otázku. Jen ke čtení — všechno, co úlohu upravuje, spouští nebo maže, zůstává na stránce Pelicanu pro ten server.',

    'column_state' => 'Stav',
    'column_name' => 'Úloha',
    'column_server' => 'Server',
    'column_last' => 'Poslední běh',
    'column_next' => 'Příští běh',

    /*
     * Pět verdiktů. Napsané jako to, co je pravda, ne jako pokyn, protože tři z
     * nich jsou věci k prohlédnutí a dvě ne.
     */
    'state_stuck' => 'Zaseknutá',
    'state_overdue' => 'Zpožděná',
    'state_never' => 'Nikdy nespuštěná',
    'state_healthy' => 'V pořádku',
    'state_off' => 'Neaktivní',

    'filter_stuck' => 'Zaseknuté',
    'filter_overdue' => 'Zpožděné',
    'filter_never' => 'Nikdy nespuštěné',
    'filter_off' => 'Vypnuté',

    'open' => 'Otevřít na serveru',

    'empty' => 'Žádné naplánované úlohy na serverech, na které dosáhnete — nebo žádná zastavená, pokud máte zapnutý filtr.',
];
