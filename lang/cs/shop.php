<?php

/*
 * Čeština. Psáno ručně.
 *
 * Nastavení obchodu a později obchod sám.
 *
 * Tento soubor záměrně sdílejí dva čtenáři. Polovinu s nastavením čte správce;
 * veřejnou a zákaznickou polovinu - přidávané, jak obchod roste - čtou lidé,
 * kteří o Pelicanu možná nikdy neslyšeli, a každá věta tam musí být napsaná
 * pro ně.
 */

return [
    'title' => 'Nastavení obchodu',
    'nav_label' => 'Nastavení obchodu',
    'subheading' => 'Měna, daň, číslování faktur a to, co říká veřejná stránka. Co se prodává, je na stránce Balíčky.',

    // ---- kde je ----------------------------------------------------------
    'address' => 'Veřejný obchod je na',
    'address_off' => 'Veřejná stránka je vypnutá. Zapněte „Veřejná stránka obchodu" v seznamu funkcí na stránce Nastavení Essentials a odpoví na :url.',

    // ---- obecné ----------------------------------------------------------
    'section_general' => 'Peníze',
    'section_general_helper' => 'Jedna měna pro celý obchod. Každá cena každého balíčku je číslo v ní.',
    'currency' => 'Měna',
    'currency_helper' => 'Změna nic nepřepočítá: ceny na balíčcích jsou čísla a po změně jsou to čísla v nové měně.',
    'tax' => 'Daň',
    'tax_helper' => 'Procento přidané ke každé faktuře jako vlastní řádek. Ceny na balíčcích jsou bez daně. Nula je žádná.',
    'tax_suffix' => '%',
    'prefix' => 'Čísla faktur začínají',
    'prefix_helper' => 'Následuje rostoucí číslo. INV- dá INV-000001.',

    // ---- obnovy ----------------------------------------------------------
    'section_renewals' => 'Obnovy',
    'section_renewals_helper' => 'Pro balíčky účtované měsíčně, čtvrtletně nebo ročně. Jednorázového balíčku se tohle nikdy nedotkne.',
    'notice_days' => 'Fakturovat tolik dní před koncem období',
    'notice_days_helper' => 'Kdy vznikne další faktura a zákazník se o ní dozví.',
    'grace' => 'Pozastavit tolik dní po splatnosti faktury',
    'grace_helper' => 'Nezaplacená faktura po této lhůtě pozastaví server — vlastním pozastavením Pelicanu, zrušeným, jakmile je faktura zaplacena. Obchod nikdy nic nemaže.',
    'days' => 'dní',

    // ---- veřejná stránka -------------------------------------------------
    'section_public' => 'Veřejná stránka',
    'section_public_helper' => 'Čtou ji lidé bez účtu. Zda se vůbec zobrazuje, určuje přepínač „Veřejná stránka obchodu" v seznamu funkcí.',
    'heading' => 'Nadpis',
    'heading_helper' => 'Ponechaný prázdný — použije se název samotného panelu.',
    'note' => 'Řádek nad balíčky',
    'note_helper' => 'Aby bylo řečeno, kdo jste nebo co koupě přináší. Prostý text.',
    'terms_url' => 'Podmínky',
    'terms_url_helper' => 'Adresa https. Je-li nastavena, koupě znamená zaškrtnout políčko, které na ni odkazuje.',

    // ---- platba ručně ----------------------------------------------------
    'section_manual' => 'Platba bez poskytovatele',
    'section_manual_helper' => 'Zobrazeno na nezaplacené faktuře, dokud není zapnutý žádný platební poskytovatel: bankovní údaje nebo kam poslat peníze. Prostý text.',
    'pay_note' => 'Jak zaplatit',
    'pay_note_helper' => 'Nechte prázdné a nezaplacená faktura řekne jen, že je nezaplacená.',

    // ---- tlačítka --------------------------------------------------------
    'save' => 'Uložit',
    'saved' => 'Uloženo',
    'save_failed' => 'Nic nebylo uloženo',

    /* ---------------------------------------------------------------------
     * Samotný obchod, odsud dolů.
     *
     * Úplně jiný čtenář: někdo, kdo si kupuje server, kdo možná o Pelicanu
     * nikdy neslyšel a neví, co je egg. Nic níže nepoužívá slova panelu a každá
     * věta odpovídá na otázku, kterou zákazník na tom místě stránky opravdu má.
     * ------------------------------------------------------------------- */

    // ---- obchod ----------------------------------------------------------
    'store_title' => 'Obchod',
    'store_nav_label' => 'Obchod',
    'store_subheading' => 'Vyber si server. Vytvoří se ti, jakmile bude faktura zaplacená.',
    'store_empty' => 'Právě teď se nic neprodává',
    'store_empty_body' => 'Přijď později, nebo se zeptej toho, kdo tenhle panel spravuje.',

    'buy' => 'Koupit',
    'sold_out' => 'Vyprodáno',
    'plus_setup' => 'plus :amount jednorázově',

    'spec_memory' => 'Paměť: :amount MiB',
    'spec_disk' => 'Disk: :amount MiB',
    'spec_cpu' => 'CPU: :amount%',
    'spec_backups' => 'Záloh: :count',
    'spec_databases' => 'Databází: :count',

    // ---- veřejná stránka -------------------------------------------------
    'public_empty' => 'Právě teď se nic neprodává',
    'public_empty_body' => 'Přijď později.',
    'to_panel' => 'Přihlásit se',
    'terms' => 'Podmínky',
    'sign_in_note' => 'Vyber si server níže. Pro dokončení se přihlásíš a server vznikne, jakmile bude faktura zaplacená.',

    // ---- objednání -------------------------------------------------------
    'checkout_title' => 'Objednávka',
    'tax_line' => 'DPH (:rate%)',
    'coupon' => 'Slevový kód',
    'coupon_placeholder' => 'Pokud nějaký máš',
    'coupon_bad' => 'Tenhle kód tady neplatí.',
    'coupon_good' => 'Kód použit.',
    'agree' => 'Souhlasím s',
    'place_order' => 'Odeslat objednávku',
    'place_order_note' => 'Tímhle se vypíše faktura. Nic se nestrhává, dokud nezaplatíš, a server vznikne, jakmile bude zaplaceno.',
    'back_to_store' => 'Zpět do obchodu',

    'placed' => 'Objednávka odeslána',
    'placed_body' => 'Faktura :number čeká na tvé stránce plateb.',

    'refused' => 'Tohle se koupit nepodařilo',
    'refused_gone' => 'Už se to neprodává.',
    'refused_sold_out' => 'Poslední je pryč.',
    'refused_bad_coupon' => 'Slevový kód se na tohle nevztahuje.',
    'refused_failed' => 'Při zápisu objednávky se něco pokazilo. Nic nebylo strženo. Zkus to znovu a řekni to tomu, kdo panel spravuje, pokud se to bude opakovat.',

    // ---- platby ----------------------------------------------------------
    'billing_title' => 'Platby',
    'billing_nav_label' => 'Platby',
    'billing_subheading' => 'Co sis koupil a co dlužíš.',
    'your_orders' => 'Tvoje objednávky',
    'your_invoices' => 'Tvoje faktury',
    'no_orders' => 'Zatím sis nic nekoupil',
    'no_orders_body' => 'Všechno, co si koupíš, se tu objeví se svým serverem a daty.',
    'no_invoices' => 'Zatím žádné faktury',
    'to_store' => 'Do obchodu',
    'renews' => 'Obnovuje se',
    'ask_how_to_pay' => 'Zeptej se toho, kdo tenhle panel spravuje, jak zaplatit. Zatím to sem nenapsal.',
    'order_pending' => 'Čeká na zaplacení faktury. Hned potom se server vytvoří.',
    'order_suspended' => 'Zastaveno kvůli nezaplacené faktuře. Zaplacení server zase spustí - nic nebylo smazáno.',

    // ---- placení ---------------------------------------------------------
    'pay_with' => 'Zaplatit přes',
    'pay_now' => 'Zaplatit',
    'pay_description' => 'Faktura :number',
    'pay_thanks' => 'Děkujeme. Faktura je zaplacená.',
    'pay_pending' => 'Poskytovatel to ještě nepotvrdil. Tahle stránka se obnoví, jakmile to udělá.',
    'pay_refused' => 'Tohle se nerozjelo',
    'pay_refused_body' => 'Platbu se nepodařilo otevřít. Zkus to jinak, nebo se zeptej toho, kdo tenhle panel spravuje.',
    'gateway_mollie' => 'Mollie',

    // ---- nastavení poskytovatele -----------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Přijímá iDEAL, karty, Bancontact a zbytek přes jeden účet. Test a ostrý provoz jsou totéž nastavení: sám klíč říká, ke kterému účtu patří.',
    'mollie_on' => 'Nabízet Mollie',
    'mollie_on_helper' => 'Vypnuto sundá tlačítko z každé faktury. Co je zaplacené, zůstává zaplacené.',
    'mollie_key' => 'API klíč',
    'mollie_key_helper' => 'Ze sekce Developers ve tvém Mollie panelu. Nikdy se nezapisuje do exportovaného souboru nastavení.',
    'mollie_hook' => 'Adresa webhooku',
    'mollie_hook_helper' => 'Mollie se ozve na :url - tvůj panel tam musí být dosažitelný z internetu.',
];
