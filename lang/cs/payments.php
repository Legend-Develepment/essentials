<?php

/*
 * Čeština. Psáno rukou.
 *
 * Platby: každý pokus zaplatit a to, co o něm řekl poskytovatel.
 *
 * Jeden řádek na pokus, ne na fakturu, protože tak to proběhlo. Slovo, které
 * tahle stránka pořád opakuje, je „pokus": neúspěšná platba je fakt, který
 * stojí za uchování, ne chyba na schování.
 */

return [
    'title' => 'Platby',
    'nav_label' => 'Platby',
    'subheading' => 'Každý pokus zaplatit, u každého poskytovatele. Ověřit znovu se poskytovatele zeptá ještě jednou - přesně to, co dělá jejich webhook, když dorazí.',

    // ---- tabulka ---------------------------------------------------------
    'column_invoice' => 'Faktura',
    'column_gateway' => 'Poskytovatel',
    'column_reference' => 'Jejich značka',
    'column_amount' => 'Částka',
    'column_state' => 'Stav',
    'column_updated' => 'Naposledy slyšeno',

    'gone_invoice' => 'Faktura smazána',

    'state_open' => 'Čeká',
    'state_paid' => 'Zaplaceno',
    'state_failed' => 'Neúspěch',
    'state_cancelled' => 'Opuštěno',

    // ---- tlačítka --------------------------------------------------------
    'recheck' => 'Ověřit znovu',
    'rechecked' => 'Zeptáno znovu',
    'rechecked_body' => 'Poskytovatel stále neříká, že je zaplaceno. Nic se nezměnilo.',
    'settled' => 'Je zaplaceno',
    'settled_body' => 'Faktura je vyrovnaná a všechno, co na ni čekalo, je na cestě.',
    'recheck_failed' => 'Zeptat se nešlo',
    'recheck_failed_body' => 'Poskytovatel neodpověděl. Zkus to za minutu; pokud se to opakuje, zkontroluj klíč na stránce Nastavení obchodu.',
    'no_gateway' => 'Ten poskytovatel je vypnutý',
    'no_gateway_body' => 'Zapni ho zpátky, aby se dalo na tuhle platbu zeptat, nebo označ fakturu jako zaplacenou ručně.',

    'answer' => 'Jejich odpověď',
    'no_answer' => 'Nic zaznamenáno',
    'close' => 'Zavřít',

    'empty' => 'Přes poskytovatele zatím nikdo nezaplatil',
    'empty_body' => 'Pokusy se tu objeví ve chvíli, kdy někdo stiskne Zaplatit - ať to dotáhne, nebo ne.',
];
