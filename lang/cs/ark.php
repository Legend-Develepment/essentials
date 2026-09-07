<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Egg", „GameUserSettings.ini" a „daemon" zůstávají anglicky: to jsou slova,
 * která jsou vidět v Pelicanu, ve správci souborů a ve všem, co se o ARKu píše.
 */

return [
    /* --------------------------------------------- karta administrátora -- */

    /*
     * Samotný nadpis sekce tu není. Každá sekce nastavení bere nadpis ze
     * settings.groups.<jméno>, a to staví group().
     */
    'section_helper' => 'Které eggs spouštějí ARK. Nic víc — zbytek serveru ARK se nastavuje jeho spouštěcími proměnnými, a stránka Spuštění v Pelicanu je už upravuje.',

    'eggs' => 'Které eggs jsou ARK',
    'eggs_helper' => 'Zaškrtněte eggs, které spouštějí server ARK. Uvnitř serverů, které je používají, se objeví stránka Nastavení světa, a nikde jinde. Není to táž otázka jako na stránce stavu: tam se ptáme, které eggs odpovídají na dotaz Valve, což dělá i Rust a Valheim, a tady, které eggs drží GameUserSettings.ini tam, kde ho drží ARK, což dělá jen ARK. Na začátku není zaškrtnuto nic, a to schválně: plugin nemůže vědět, jak jste své eggs pojmenovali.',

    /* ------------------------------------------------- stránka serveru --- */

    'nav_label' => 'Nastavení světa',
    'title' => 'Nastavení světa ARK',
    'subheading' => 'Nastavení, která lidé opravdu mění, z GameUserSettings.ini.',

    'group_server' => 'Server',
    'group_server_helper' => 'Jak se server jmenuje, kdo smí dovnitř a kolik jich.',
    'group_rates' => 'Poměry',
    'group_rates_helper' => 'Jak rychle se věci dějí. 1.0 je hra tak, jak vychází; 2.0 je dvakrát rychleji.',
    'group_rules' => 'Pravidla',
    'group_rules_helper' => 'Co hráči smějí a co jim hra ukazuje.',

    'keeps' => 'Patnáct nastavení ze souboru, kde jich jsou stovky. Všechno ostatní — nastavení vašich modů, klíče, o kterých tenhle plugin nikdy neslyšel, komentáře i pořadí toho všeho — zůstává při uložení přesně tak, jak je.',
    'missing' => 'Tenhle server ještě nemá GameUserSettings.ini. Hra ho zapíše při prvním běhu, tak server jednou spusťte a tahle stránka se naplní.',
    'read_only' => 'Tenhle soubor můžete číst, ale ne zapisovat, takže tady nejde nic změnit.',

    'save' => 'Uložit',
    'saved' => 'Uloženo',
    'saved_restart' => 'ARK čte tenhle soubor při startu, tak server restartujte, ať změna začne platit.',
    'failed' => 'Nepodařilo se uložit',
    'failed_write' => 'Daemon zápis odmítl. Zkontrolujte, že je server dostupný a že soubor není jen ke čtení.',
];
