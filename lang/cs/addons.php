<?php

/*
 * Čeština. Psáno rukou.
 *
 * Doplňky prodávané vedle balíčku.
 *
 * Dvě věci se tady drží od sebe. Kolik doplněk *stojí*, je jeho cena, a ta se
 * účtuje pokaždé. Kolik stojí *dneska*, je z ní jen podíl, protože kdo si ho
 * koupí v půlce měsíce, platí půl měsíce. Text pro zákazníka vždycky říká,
 * které z těch dvou čísel myslí.
 *
 * „Serveru nepřidává nic" je poctivá odpověď a je napsaná nahlas místo toho,
 * aby zůstalo prázdné políčko: přednostní podpora je úplně běžná věc na prodej
 * a prázdná buňka se čte jako chyba.
 */

return [
    'title' => 'Doplňky',
    'nav_label' => 'Doplňky',
    'subheading' => 'Věci prodávané vedle balíčku: víc paměti, další místo na zálohu, nebo něco, co je jen řádek na faktuře.',

    // ---- tabulka ----------------------------------------------------------
    'column_name' => 'Doplněk',
    'column_price' => 'Cena',
    'column_adds' => 'Přidává',
    'column_sold' => 'V užívání',
    'column_live' => 'V prodeji',
    'adds_nothing' => 'Serveru nic',

    // ---- formulář ---------------------------------------------------------
    'section_what' => 'Co to je',
    'section_what_helper' => 'Jméno a cena, které vidí zákazník, a ke kterým balíčkům se to dá koupit.',
    'name' => 'Jméno',
    'price' => 'Cena',
    'price_helper' => 'Kolik to stojí pokaždé, když se to účtuje. Při koupi uprostřed období zaplatí zákazník podíl z téhle částky a od dalšího obnovení celou.',
    'billing' => 'Účtuje se',
    'billing_helper' => 'Se službou znamená, že se to vrací s každým obnovením, dokud si to zákazník nechá. Jednorázově znamená, že se to naúčtuje na faktuře, která to nese poprvé, a už nikdy.',
    'billing_with' => 'S každým obnovením',
    'billing_once' => 'Jednorázově',
    'max' => 'Nejvíc na jednu službu',
    'max_helper' => 'Kolik kusů tohohle smí někdo mít. Jeden je běžný případ; zvyšte to u něčeho, co se prodává po gigabajtech.',
    'description' => 'Popis',
    'description_helper' => 'Jeden řádek pod jménem u pokladny. Napište, co to dělá, ne jak se to jmenuje.',
    'packages' => 'Balíčky',
    'packages_helper' => 'Ke kterým balíčkům se tohle dá koupit. Nic nezaškrtnutého znamená ke všem, což je obvykle případ podpory nebo místa na zálohu.',

    'section_adds' => 'Co to přidá serveru',
    'section_adds_helper' => 'Tohle se přičítá k tomu, co balíček dává už sám, nenastavuje se to místo toho: 4096 v paměti udělá server o 4 GiB větší. Dva stejné doplňky se sčítají. U něčeho, co je jen řádek na faktuře, nechte všude nulu. Záporné číslo něco ubere, což je dovolené a občas je to přesně to, co někdo chce.',
    'sort' => 'Pořadí',
    'sort_helper' => 'Nižší jde u pokladny první. Při shodě rozhoduje cena.',
    'live' => 'V prodeji',
    'live_helper' => 'Vypnuté se nikde nenabízí. Kdo to už má, tomu to zůstane a dál se mu za to účtuje.',

    // ---- tlačítka ---------------------------------------------------------
    'new' => 'Nový doplněk',
    'edit' => 'Upravit',
    'delete' => 'Smazat',
    'delete_confirm' => 'Tenhle nemá nikdo. Smazáním zmizí ze seznamu nadobro.',
    'delete_sold' => 'Tenhle doplněk má služeb: :count. Nechají si ho, nechají si limity, které jim dal, a dál se jim za něj účtuje - zmizí jen položka ze seznamu, takže si ho nikdo nový nekoupí.',
    'go_live' => 'Dát do prodeje',
    'go_offline' => 'Stáhnout z prodeje',
    'saved' => 'Uloženo',
    'deleted' => 'Doplněk je pryč',
    'save_failed' => 'Neuloženo',
    'save_failed_body' => 'Nic se nezapsalo. Zkuste to znovu, a jestli se to bude opakovat, mrkněte do logu.',
    'invalid' => 'Doplněk potřebuje jméno a cenu.',
    'empty' => 'Zatím žádné doplňky',
    'empty_body' => 'Doplněk je něco, co se prodává vedle balíčku: další gigabajt, druhé místo na zálohu, nebo služba, která serveru nepřidá vůbec nic.',

    // ---- co vidí zákazník -------------------------------------------------
    'choose' => 'Doplňky',
    'choose_helper' => 'Nepovinné, a můžeš je přidat nebo zrušit i později.',
    'yours' => 'Doplňky u téhle služby',
    'add' => 'Přidat doplněk',
    'add_helper' => 'Teď zaplatíš to, co zbývá z tohohle období, a od dalšího obnovení celou cenu.',
    'add_to' => 'Přidat :name',
    'add_confirm' => 'Přidat k téhle službě :name?',
    'drop' => 'Odebrat',
    'drop_confirm' => 'Odebrat :name? Nevyužitá část toho, co jsi zaplatil, se ti vrátí na účet a server se změní hned.',
    'costs_now' => ':amount teď',
    'free_now' => 'Teď není co platit',
    'then' => 'potom :amount za obnovení',
    'once_only' => ':amount, jednorázově',
    'each' => 'za kus',
    'added' => ':name přidán',
    'added_body' => 'Server dostal to, co doplněk přidává.',
    'dropped' => ':name odebrán',
    'dropped_body' => 'Co jsi zaplatil a nevyužil, máš na účtu.',

    // ---- a kdy to nepůjde -------------------------------------------------
    'refused' => 'Tohle nešlo udělat',
    'refused_off' => 'Doplňky jsou na tomhle panelu vypnuté.',
    'refused_not_active' => 'Doplňky se dají přidat jen k běžící službě.',
    'refused_gone' => 'Tenhle doplněk už není v prodeji.',
    'refused_wrong_package' => 'Tenhle doplněk se k tomuhle balíčku neprodává.',
    'refused_enough' => 'Tolik jich už máš, kolik jich tahle služba unese.',
    'refused_failed' => 'Nic se nezapsalo, takže se nic nezměnilo. Zkus to znovu, a jestli se to bude opakovat, řekni to tomu, kdo tenhle panel spravuje.',
    'refused_server' => 'Server nové limity nepřijal, takže se nic nezměnilo a nic se neúčtovalo.',
    'refused_not_yours' => 'Tenhle doplněk u téhle služby není.',

    // ---- co stojí na dokladech --------------------------------------------
    'line' => ':name × :many, za zbývající dny tohoto období: :days',
    'credit_reason' => 'Odebráno: :name',
    'bell_failed' => 'Doplněk se nepodařilo předat serveru u objednávky :number',

    // ---- jednotky do správcovské tabulky ----------------------------------
    'unit_memory' => 'MiB paměti',
    'unit_swap' => 'MiB swapu',
    'unit_disk' => 'MiB disku',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databází',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'záloh',
];
