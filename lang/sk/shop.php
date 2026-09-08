<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Nastavenia obchodu a neskôr obchod sám.
 *
 * Tento súbor zámerne zdieľajú dvaja čitatelia. Polovicu s nastaveniami číta
 * správca; verejnú a zákaznícku polovicu - pridávané, ako obchod rastie -
 * čítajú ľudia, ktorí o Pelicane možno nikdy nepočuli, a každá veta tam musí
 * byť napísaná pre nich.
 */

return [
    'title' => 'Nastavenia obchodu',
    'nav_label' => 'Nastavenia obchodu',
    'subheading' => 'Mena, daň, číslovanie faktúr a to, čo hovorí verejná stránka. Čo sa predáva, je na stránke Balíky.',

    // ---- kde je ----------------------------------------------------------
    'address' => 'Verejný obchod je na',
    'address_off' => 'Verejná stránka je vypnutá. Zapnite „Verejná stránka obchodu" v zozname funkcií na stránke Nastavenia Essentials a odpovie na :url.',

    // ---- všeobecné -------------------------------------------------------
    'section_general' => 'Peniaze',
    'section_general_helper' => 'Jedna mena pre celý obchod. Každá cena každého balíka je číslo v nej.',
    'currency' => 'Mena',
    'currency_helper' => 'Zmena nič neprepočíta: ceny na balíkoch sú čísla a po zmene sú to čísla v novej mene.',
    'tax' => 'Daň',
    'tax_helper' => 'Percento pridané ku každej faktúre ako vlastný riadok. Ceny na balíkoch sú bez dane. Nula je žiadna.',
    'tax_suffix' => '%',
    'prefix' => 'Čísla faktúr začínajú',
    'prefix_helper' => 'Nasleduje rastúce číslo. INV- dá INV-000001.',

    // ---- obnovy ----------------------------------------------------------
    'section_renewals' => 'Obnovy',
    'section_renewals_helper' => 'Pre balíky účtované mesačne, štvrťročne alebo ročne. Jednorazového balíka sa toto nikdy nedotkne.',
    'notice_days' => 'Fakturovať toľko dní pred koncom obdobia',
    'notice_days_helper' => 'Kedy vznikne ďalšia faktúra a zákazník sa o nej dozvie.',
    'grace' => 'Pozastaviť toľko dní po splatnosti faktúry',
    'grace_helper' => 'Nezaplatená faktúra po tejto lehote pozastaví server — vlastným pozastavením Pelicanu, zrušeným, len čo je faktúra zaplatená. Obchod nikdy nič nemaže.',
    'days' => 'dní',

    // ---- verejná stránka -------------------------------------------------
    'section_public' => 'Verejná stránka',
    'section_public_helper' => 'Čítajú ju ľudia bez účtu. Či sa vôbec zobrazuje, určuje prepínač „Verejná stránka obchodu" v zozname funkcií.',
    'heading' => 'Nadpis',
    'heading_helper' => 'Ponechaný prázdny — použije sa názov samotného panelu.',
    'note' => 'Riadok nad balíkmi',
    'note_helper' => 'Aby bolo povedané, kto ste alebo čo kúpa prináša. Obyčajný text.',
    'terms_url' => 'Podmienky',
    'terms_url_helper' => 'Adresa https. Ak je nastavená, kúpa znamená zaškrtnúť políčko, ktoré na ňu odkazuje.',

    // ---- platba ručne ----------------------------------------------------
    'section_manual' => 'Platba bez poskytovateľa',
    'section_manual_helper' => 'Zobrazené na nezaplatenej faktúre, kým nie je zapnutý žiadny platobný poskytovateľ: bankové údaje alebo kam poslať peniaze. Obyčajný text.',
    'pay_note' => 'Ako zaplatiť',
    'pay_note_helper' => 'Nechajte prázdne a nezaplatená faktúra povie len, že je nezaplatená.',

    // ---- tlačidlá --------------------------------------------------------
    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'save_failed' => 'Nič sa neuložilo',
];
