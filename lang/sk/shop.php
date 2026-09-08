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

    /* ---------------------------------------------------------------------
     * Samotný obchod, odtiaľto dole.
     *
     * Úplne iný čitateľ: niekto, kto si kupuje server, kto možno o Pelicane
     * nikdy nepočul a nevie, čo je egg. Nič nižšie nepoužíva slová panela a
     * každá veta odpovedá na otázku, ktorú zákazník na tom mieste stránky
     * naozaj má.
     * ------------------------------------------------------------------- */

    // ---- obchod ----------------------------------------------------------
    'store_title' => 'Obchod',
    'store_nav_label' => 'Obchod',
    'store_subheading' => 'Vyber si server. Vytvorí sa ti, len čo bude faktúra zaplatená.',
    'store_empty' => 'Práve teraz sa nič nepredáva',
    'store_empty_body' => 'Príď neskôr, alebo sa spýtaj toho, kto tento panel spravuje.',

    'buy' => 'Kúpiť',
    'sold_out' => 'Vypredané',
    'plus_setup' => 'plus :amount jednorazovo',

    'spec_memory' => 'Pamäť: :amount MiB',
    'spec_disk' => 'Disk: :amount MiB',
    'spec_cpu' => 'CPU: :amount%',
    'spec_backups' => 'Záloh: :count',
    'spec_databases' => 'Databáz: :count',

    // ---- verejná stránka -------------------------------------------------
    'public_empty' => 'Práve teraz sa nič nepredáva',
    'public_empty_body' => 'Príď neskôr.',
    'to_panel' => 'Prihlásiť sa',
    'terms' => 'Podmienky',
    'sign_in_note' => 'Vyber si server nižšie. Na dokončenie sa prihlásiš a server vznikne, len čo bude faktúra zaplatená.',

    // ---- objednanie ------------------------------------------------------
    'checkout_title' => 'Objednávka',
    'tax_line' => 'DPH (:rate%)',
    'coupon' => 'Zľavový kód',
    'coupon_placeholder' => 'Ak nejaký máš',
    'coupon_bad' => 'Tento kód tu neplatí.',
    'coupon_good' => 'Kód použitý.',
    'agree' => 'Súhlasím s',
    'place_order' => 'Odoslať objednávku',
    'place_order_note' => 'Týmto sa vypíše faktúra. Nič sa nestrháva, kým nezaplatíš, a server vznikne, len čo bude zaplatené.',
    'back_to_store' => 'Späť do obchodu',

    'placed' => 'Objednávka odoslaná',
    'placed_body' => 'Faktúra :number čaká na tvojej stránke platieb.',

    'refused' => 'Toto sa kúpiť nepodarilo',
    'refused_gone' => 'Už sa to nepredáva.',
    'refused_sold_out' => 'Posledný je preč.',
    'refused_bad_coupon' => 'Zľavový kód sa na toto nevzťahuje.',
    'refused_failed' => 'Pri zápise objednávky sa niečo pokazilo. Nič nebolo strhnuté. Skús to znova a povedz to tomu, kto panel spravuje, ak sa to bude opakovať.',

    // ---- platby ----------------------------------------------------------
    'billing_title' => 'Platby',
    'billing_nav_label' => 'Platby',
    'billing_subheading' => 'Čo si kúpil a čo dlhuješ.',
    'your_orders' => 'Tvoje objednávky',
    'your_invoices' => 'Tvoje faktúry',
    'no_orders' => 'Zatiaľ si si nič nekúpil',
    'no_orders_body' => 'Všetko, čo si kúpiš, sa tu objaví so svojím serverom a dátumami.',
    'no_invoices' => 'Zatiaľ žiadne faktúry',
    'to_store' => 'Do obchodu',
    'renews' => 'Obnovuje sa',
    'ask_how_to_pay' => 'Spýtaj sa toho, kto tento panel spravuje, ako zaplatiť. Zatiaľ to sem nenapísal.',
    'order_pending' => 'Čaká na zaplatenie faktúry. Hneď potom sa server vytvorí.',
    'order_suspended' => 'Zastavené pre nezaplatenú faktúru. Zaplatenie server zase spustí - nič nebolo zmazané.',

    // ---- platenie --------------------------------------------------------
    'pay_with' => 'Zaplatiť cez',
    'pay_now' => 'Zaplatiť',
    'pay_description' => 'Faktúra :number',
    'pay_thanks' => 'Ďakujeme. Faktúra je zaplatená.',
    'pay_pending' => 'Poskytovateľ to ešte nepotvrdil. Táto stránka sa obnoví, len čo to urobí.',
    'pay_refused' => 'Toto sa nerozbehlo',
    'pay_refused_body' => 'Platbu sa nepodarilo otvoriť. Skús to inak, alebo sa spýtaj toho, kto tento panel spravuje.',
    'gateway_mollie' => 'Mollie',

    // ---- nastavenia poskytovateľa ----------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Prijíma iDEAL, karty, Bancontact a zvyšok cez jeden účet. Test a ostrá prevádzka sú to isté nastavenie: sám kľúč hovorí, ku ktorému účtu patrí.',
    'mollie_on' => 'Ponúkať Mollie',
    'mollie_on_helper' => 'Vypnuté zloží tlačidlo z každej faktúry. Čo je zaplatené, zostáva zaplatené.',
    'mollie_key' => 'API kľúč',
    'mollie_key_helper' => 'Zo sekcie Developers v tvojom Mollie paneli. Nikdy sa nezapisuje do exportovaného súboru nastavení.',
    'mollie_hook' => 'Adresa webhooku',
    'mollie_hook_helper' => 'Mollie sa ozve na :url - tvoj panel tam musí byť dosiahnuteľný z internetu.',

    'gateway_stripe' => 'Karta',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Prijíma karty na stránke, ktorú kreslí sám Stripe, takže číslo karty sa k tomuto panelu nikdy nedostane. Test a ostrá prevádzka sú v predpone kľúča, nie v prepínači.',
    'stripe_on' => 'Ponúkať Stripe',
    'stripe_on_helper' => 'Vypnuté zloží tlačidlo z každej faktúry. Čo je zaplatené, zostáva zaplatené.',
    'stripe_key' => 'Tajný kľúč',
    'stripe_key_helper' => 'Ten začínajúci sk_, z Developers, API keys. Nikdy sa nezapisuje do exportovaného súboru nastavení.',
    'stripe_hook' => 'Podpisové tajomstvo',
    'stripe_hook_key_helper' => 'Hodnota whsec_, ktorú Stripe ukáže po pridaní adresy nižšie. Bez nej sa ich správy nedajú dokázať ako pravé a ignorujú sa.',
    'stripe_hook_helper' => 'Pridaj :url ako endpoint v Developers, webhooks, pre udalosť checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Jediný poskytovateľ, u ktorého sa peniaze pohnú až pri návrate zákazníka, nie keď je ešte na PayPale - zatvorená záložka tak nechá nezaplatenú faktúru, nie stratenú platbu.',
    'paypal_on' => 'Ponúkať PayPal',
    'paypal_on_helper' => 'Vypnuté zloží tlačidlo z každej faktúry. Čo je zaplatené, zostáva zaplatené.',
    'paypal_sandbox' => 'Testovacie prostredie',
    'paypal_sandbox_helper' => 'Hovorí s testovacím účtom PayPalu namiesto so skutočným. Ich client id vyzerajú v oboch prípadoch rovnako, a práve preto tento prepínač existuje.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Z aplikácie, ktorú si založil v Apps & Credentials. Skontroluj, že záložka zodpovedá prepínaču vyššie.',
    'paypal_secret_helper' => 'Vedľa client ID, za tlačidlom Show. Nikdy sa nezapisuje do exportovaného súboru nastavení.',
    'paypal_hook' => 'ID webhooku',
    'paypal_hook_id_helper' => 'ID, ktoré PayPal webhooku pridelí po jeho pridaní - nie adresa. Bez neho sa ich správy u nich nedajú overiť a ignorujú sa.',
    'paypal_hook_helper' => 'Pridaj :url ako webhook v tej aplikácii, pre PAYMENT.CAPTURE.COMPLETED, a vlož sem pridelené ID.',

    // ---- platobná stránka ------------------------------------------------
    'pay_title' => 'Zaplatiť',
    'pay_subheading' => 'Čo dlhuješ a ako to vyrovnať.',
    'pay_choose' => 'Ako chceš zaplatiť?',
    'pay_choose_body' => 'Nech si vyberieš čokoľvek, dokončíš to na ich vlastnej stránke a hneď potom sa vrátiš sem.',
    'pay_safe' => 'Na zaplatenie ťa pošleme k poskytovateľovi. Údaje tvojej karty sa k tomuto panelu nikdy nedostanú.',
    'pay_no_ways' => 'Len čo peniaze dorazia, faktúra sa označí ako zaplatená a tvoj server sa pripraví.',
    'pay_gone' => 'Taká faktúra nie je',
    'pay_gone_body' => 'Mohla byť stiahnutá, alebo je adresa zle.',
    'pay_already' => 'Táto je zaplatená',
    'pay_already_body' => 'Nič ďalšie netreba. Všetko, čo na ňu čakalo, je už na ceste.',
    'pay_withdrawn' => 'Táto bola stiahnutá',
    'pay_withdrawn_body' => 'Je mimo účtovníctva a platiť sa nemusí. Ak ti to príde divné, spýtaj sa toho, kto panel spravuje.',
    'back_to_billing' => 'Späť na platby',

    'gateway_mollie_note' => 'iDEAL, Bancontact, karta a ďalšie',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Tvoj zostatok na PayPale alebo karta cez PayPal',

    // ---- služby a faktúry, zvlášť ----------------------------------------
    'services_title' => 'Moje služby',
    'services_nav_label' => 'Moje služby',
    'services_subheading' => 'To, za čo platíš, a server, ktorý z každej služby vznikol.',
    'open_server' => 'Otvoriť server',
    'no_server_yet' => 'Pripravuje sa',

    'invoices_title' => 'Faktúry',
    'invoices_subheading' => 'Čo ti bolo vyúčtované a čo zostáva zaplatiť.',
    'no_invoices_body' => 'Všetko, čo si kúpiš, sa tu vyúčtuje a zostane tu aj po zaplatení.',

    // ---- obchod ako úvodná stránka ---------------------------------------
    'section_landing' => 'Kde obchod sedí',
    'section_landing_helper' => 'Či človek po prihlásení pristane na obchode, alebo na svojich serveroch.',
    'landing' => 'Otvoriť najprv obchod',
    'landing_helper' => 'Zapnuté: obchod je prvá stránka po prihlásení a zoznam serverov sa posunie vedľa. Tvoje služby a faktúry zostávajú na jedno kliknutie, v hlavičke obchodu a v ponuke účtu. Vypnuté: nič sa neposunie a obchod je stránka ako každá iná.',
];
