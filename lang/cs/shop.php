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
];
