<?php

/*
 * Čeština. Psáno rukou.
 *
 * Zákazníci: obchod, jen otočený k člověku místo k řádku.
 *
 * Objednávky, faktury a platby jsou každá seznam toho, co se stalo. Tahle
 * stránka klade otázku, kterou má někdo odpovídající na požadavek doopravdy:
 * kdo to je, co má, co zaplatil a co zbývá zaplatit.
 */

return [
    'title' => 'Zákazníci',
    'nav_label' => 'Zákazníci',
    'subheading' => 'Všichni, kdo si něco koupili, s tím, co mají, co zaplatili a co ještě dluží.',

    // ---- tabulka ---------------------------------------------------------
    'column_customer' => 'Zákazník',
    'column_services' => 'Služby',
    'column_spent' => 'Zaplaceno',
    'column_outstanding' => 'K zaplacení',

    'of_orders' => 'z :count objednaných',
    'nothing_owed' => 'Nic',

    'filter_owing' => 'Něco dluží',
    'filter_active' => 'Má aktivní službu',

    // ---- jeden z nich ----------------------------------------------------
    'open' => 'Otevřít',
    'close' => 'Zavřít',
    'servers' => 'Servery',
    'since' => 'Zákazníkem od',
    'their_services' => 'Služby',
    'their_invoices' => 'Faktury',
    'no_services' => 'Nic aktivního a nic, co by čekalo na postavení.',
    'no_invoices' => 'Pro tenhle účet nebyla vypsána žádná faktura.',

    'empty' => 'Zatím si nikdo nic nekoupil',
    'empty_body' => 'Tady jsou ti, kdo objednali, ne každý s účtem - takže se to naplní první prodejem.',
    'who' => 'Kdo to je',
];
