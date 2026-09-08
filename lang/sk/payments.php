<?php

/*
 * Slovenčina. Písané rukou.
 *
 * Platby: každý pokus zaplatiť a to, čo o ňom povedal poskytovateľ.
 *
 * Jeden riadok na pokus, nie na faktúru, lebo tak to prebehlo. Slovo, ktoré
 * táto stránka stále opakuje, je „pokus": neúspešná platba je fakt, ktorý stojí
 * za uchovanie, nie chyba na skrytie.
 */

return [
    'title' => 'Platby',
    'nav_label' => 'Platby',
    'subheading' => 'Každý pokus zaplatiť, u každého poskytovateľa. Overiť znova sa poskytovateľa spýta ešte raz - presne to, čo robí ich webhook, keď dorazí.',

    // ---- tabuľka ---------------------------------------------------------
    'column_invoice' => 'Faktúra',
    'column_gateway' => 'Poskytovateľ',
    'column_reference' => 'Ich značka',
    'column_amount' => 'Suma',
    'column_state' => 'Stav',
    'column_updated' => 'Naposledy počuté',

    'gone_invoice' => 'Faktúra zmazaná',

    'state_open' => 'Čaká',
    'state_paid' => 'Zaplatené',
    'state_failed' => 'Neúspech',
    'state_cancelled' => 'Opustené',

    // ---- tlačidlá --------------------------------------------------------
    'recheck' => 'Overiť znova',
    'rechecked' => 'Spýtané znova',
    'rechecked_body' => 'Poskytovateľ stále nehovorí, že je zaplatené. Nič sa nezmenilo.',
    'settled' => 'Je zaplatené',
    'settled_body' => 'Faktúra je vyrovnaná a všetko, čo na ňu čakalo, je na ceste.',
    'recheck_failed' => 'Spýtať sa nedalo',
    'recheck_failed_body' => 'Poskytovateľ neodpovedal. Skús to o minútu; ak sa to opakuje, skontroluj kľúč na stránke Nastavenia obchodu.',
    'no_gateway' => 'Ten poskytovateľ je vypnutý',
    'no_gateway_body' => 'Zapni ho späť, aby sa dalo na túto platbu spýtať, alebo označ faktúru ako zaplatenú ručne.',

    'answer' => 'Ich odpoveď',
    'no_answer' => 'Nič zaznamenané',
    'close' => 'Zavrieť',

    'empty' => 'Cez poskytovateľa zatiaľ nikto nezaplatil',
    'empty_body' => 'Pokusy sa tu objavia vo chvíli, keď niekto stlačí Zaplatiť - či to dotiahne, alebo nie.',
];
