<?php

/*
 * Čeština. Psáno rukou.
 *
 * Slevové kódy: kódy, které něco strhnou z první faktury.
 *
 * Jen z první, záměrně, a text to říká tam, kde na tom záleží. Kód, který by
 * zlevnil i každé obnovení, by byla změna ceny s datem konce, a kdo tohle chce,
 * má změnit cenu.
 */

return [
    'title' => 'Slevové kódy',
    'nav_label' => 'Slevové kódy',
    'subheading' => 'Kódy, které strhnou procenta nebo částku z první faktury. Obnovení jdou za cenu balíčku.',

    // ---- tabulka ---------------------------------------------------------
    'column_code' => 'Kód',
    'column_value' => 'Hodnota',
    'column_uses' => 'Použito',
    'column_expires' => 'Vyprší',
    'column_packages' => 'Platí pro',
    'column_live' => 'Aktivní',

    'never_expires' => 'Bez data konce',
    'all_packages' => 'Vše',
    'some_packages' => 'Balíčků: :count',
    'usable' => 'Právě teď se dá použít',
    'unusable' => 'Vypnutý, prošlý nebo vyčerpaný',

    // ---- tlačítka --------------------------------------------------------
    'new' => 'Nový kód',
    'edit' => 'Upravit',
    'delete' => 'Smazat',
    'delete_confirm' => 'Odebere kód. Faktury, které ho už použily, si slevu nechají - každá si sama pamatuje, co z ní bylo strženo.',
    'deleted' => 'Kód smazán',
    'saved' => 'Kód uložen',
    'save_failed' => 'Kód se nepodařilo uložit',
    'taken' => 'Ten kód už něco jiného používá.',
    'invalid' => 'Procento je celé číslo od 1 do 100. Částka se píše jako 12.50 nebo 12,50.',

    // ---- formulář --------------------------------------------------------
    'section_code' => 'Kód',
    'section_code_helper' => 'To, co zákazník napíše při objednání.',
    'code' => 'Kód',
    'code_helper' => 'Ukládá se a porovnává velkými písmeny bez mezer, aby fungoval, ať ho někdo napíše jakkoli.',
    'live' => 'Aktivní',
    'live_helper' => 'Vypnutí kód přestane používat, aniž by ho smazalo: vyjde z oběhu, zatímco sleva, kterou dal, zůstává na fakturách, které ji měly.',

    'section_worth' => 'Kolik strhne',
    'section_worth_helper' => 'Jen z první faktury. Nikdy nedostane fakturu pod nulu.',
    'kind' => 'Druh',
    'kind_helper' => 'Podíl z ceny, nebo pevná částka.',
    'kind_percent' => 'Procento',
    'kind_fixed' => 'Pevná částka',
    'value' => 'Hodnota',
    'value_percent_helper' => 'Celé číslo od 1 do 100.',
    'value_fixed_helper' => 'V měně obchodu. Napiš ji jako 12.50 nebo 12,50.',

    'section_limits' => 'Omezení',
    'section_limits_helper' => 'Všechno tady je nepovinné. Kód bez jediného z nich platí na všechno, pro každého, navždy.',
    'max_uses' => 'Kolikrát se dá použít',
    'max_uses_helper' => 'Počítá se při zadání objednávky, ne při zaplacení faktury - jinak by kód na deset použití šel zadat stokrát za noc.',
    'expires' => 'Vyprší',
    'expires_helper' => 'Po tomto okamžiku kód přestane fungovat. Prázdné znamená, že se to nikdy nestane.',
    'packages' => 'Balíčky',
    'packages_helper' => 'Nic zaškrtnuté znamená každý balíček, teď i později.',

    'empty' => 'Zatím žádné kódy',
    'empty_body' => 'Vytvoř jeden a bude fungovat při objednání, jakmile bude aktivní.',
];
