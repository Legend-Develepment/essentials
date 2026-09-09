<?php

/*
 * Čeština. Psáno ručně.
 *
 * Balíčky: server, který si někdo může koupit.
 *
 * Čte ten, kdo zařizuje obchod. Každé slovo tady je o šabloně a ceně; to, co
 * vidí zákazník, je v shop.php, protože oba čtenáři chtějí o témže řádku jiné
 * věty.
 *
 * „egg", „node", „swap", „io" a slova z Minecraftu zůstávají anglicky: jsou to
 * slova z vlastního formuláře serveru v Pelicanu a balíček je ten formulář
 * odložený na později.
 *
 * Číslo stojí za slovem, ne před ním: čeština skloňuje počítané podle čísla a
 * jeden tvar nesedí ke všem.
 */

return [
    'title' => 'Balíčky',
    'nav_label' => 'Balíčky',
    'subheading' => 'To, co se prodává. Každý je šablona serveru s cenou; zákazník si jeden koupí a panel server vytvoří.',

    // ---- tabulka ---------------------------------------------------------
    'column_name' => 'Balíček',
    'column_egg' => 'Egg',
    'column_price' => 'Cena',
    'column_stock' => 'Skladem',
    'column_live' => 'V prodeji',
    'column_orders' => 'Prodáno',

    'live' => 'V prodeji',
    'offline' => 'Není v prodeji',
    'no_egg' => 'Bez egg — nelze sestavit',

    'stock_unlimited' => 'Bez omezení',
    'stock_left' => 'Zbývá: :count',
    'stock_out' => 'Vyprodáno',

    // ---- období ----------------------------------------------------------
    'period_once' => 'Jednorázově',
    'period_month' => 'Měsíčně',
    'period_quarter' => 'Čtvrtletně',
    'period_year' => 'Ročně',

    // Za cenou: „12,50 € měsíčně".
    'per_once' => 'jednorázově',
    'per_month' => 'měsíčně',
    'per_quarter' => 'čtvrtletně',
    'per_year' => 'ročně',

    // ---- akce ------------------------------------------------------------
    'new' => 'Nový balíček',
    'edit' => 'Upravit',
    'duplicate' => 'Duplikovat',
    'copy_suffix' => ' (kopie)',
    'go_live' => 'Nabídnout k prodeji',
    'go_offline' => 'Stáhnout z prodeje',
    'delete' => 'Smazat',
    'delete_confirm' => 'Odstraní balíček. Co už bylo koupeno, zůstane netknuté — objednávky si drží vlastní kopii toho, čím byly.',
    'delete_confirm_sold' => 'Prodáno: :count. Ty služby zůstanou netknuté: objednávka si nese vlastní kopii všeho, s čím byla prodána, takže servery běží dál a faktury dál říkají, co bylo koupeno. Zmizí jen obrázek na kartě služby a balíček se přestane nabízet.',
    'delete_refused' => 'Nesmazáno',
    'delete_refused_body' => 'Na tento balíček byly zadány objednávky a ty na něj ukazují. Raději ho stáhněte z prodeje; zůstane v evidenci a nikdo ho nekoupí.',
    'deleted' => 'Balíček smazán',
    'deleted_sold' => 'Prodaných služeb: :count — jsou netknuté a běží dál.',
    'saved' => 'Balíček uložen',
    'save_failed' => 'Balíček se nepodařilo uložit',
    'price_invalid' => 'To není částka. Zapište ji jako 12.50 nebo 12,50.',

    // ---- formulář: co to je ----------------------------------------------
    'section_basics' => 'Balíček',
    'section_basics_helper' => 'To, co zákazník vidí na kartě.',
    'name' => 'Název',
    'name_helper' => 'Jak se jmenuje v obchodě.',
    'slug' => 'Adresa',
    'slug_helper' => 'Malá písmena, číslice a pomlčky. Ponechaná prázdná se vytvoří z názvu. Pozdější změna rozbije odkaz, který si někdo uložil.',
    'description' => 'Popis',
    'description_helper' => 'Pár řádků pod názvem. Prostý text.',
    'live_field' => 'V prodeji',
    'live_helper' => 'Vypnuto nechá balíček tady a nikomu ho neukáže. Balíček bez egg se neukáže nikdy, ať tu stojí cokoli.',
    'sort' => 'Pořadí',
    'sort_helper' => 'Nižší je v obchodě dřív.',

    // ---- formulář: čím se stane ------------------------------------------
    'section_server' => 'Server, kterým se stane',
    'section_server_helper' => 'Stejné otázky, jaké klade Pelican při ručním vytváření serveru, tady zodpovězené jednou a použité při každém prodeji.',
    'egg' => 'Egg',
    'egg_helper' => 'Výběr vyplní image, startovací příkaz a každou proměnnou výchozími hodnotami z egg. Potom změňte, co chcete.',
    'image' => 'Image Dockeru',
    'image_helper' => 'Jeden z image, které egg nabízí.',
    'image_default' => 'První image egg',
    'startup' => 'Startovací příkaz',
    'startup_helper' => 'Jeden z příkazů, které egg nabízí.',
    'startup_default' => 'První příkaz egg',
    'environment' => 'Proměnné',
    'environment_helper' => 'Proměnné egg a jejich hodnoty. Vše, co egg má a tady není, dostane při vytvoření serveru výchozí hodnotu.',
    'env_key' => 'Proměnná',
    'env_value' => 'Hodnota',
    'nodes' => 'Node',
    'nodes_helper' => 'Kde smí server z tohoto balíčku vzniknout, zkoušené v tomto pořadí, dokud některý nemá volnou adresu. Nic nezaškrtnutého znamená libovolný node.',

    // ---- formulář: limity ------------------------------------------------
    'section_limits' => 'Limity',
    'section_limits_helper' => 'Co server dostane. Stejná pole jako vlastní formulář serveru v Pelicanu, ve stejných jednotkách.',
    'memory' => 'Paměť',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Procento jednoho jádra: 100 je jedno jádro, 200 jsou dvě, 0 je bez limitu.',
    'swap' => 'Swap',
    'swap_helper' => '0 je žádný, -1 je neomezený.',
    'io' => 'Váha blokového IO',
    'io_helper' => 'Výchozí v Pelicanu je 500. Nechte to tak, pokud nevíte, proč ne.',
    'threads' => 'Přiřazení CPU',
    'threads_helper' => 'Která jádra, jak je zapisuje Pelican: 0,1 nebo 0-3. Prázdné je libovolné.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Zda smí jádro server ukončit, když mu dojde paměť.',
    'databases' => 'Databáze',
    'allocations' => 'Další allocation',
    'backups' => 'Zálohy',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formulář: peníze ------------------------------------------------
    'section_price' => 'Cena a sklad',
    'section_price_helper' => 'V měně obchodu, nastavené na stránce Nastavení obchodu. Bez daně — daň se na fakturu přidává jako vlastní řádek.',
    'price' => 'Cena',
    'price_helper' => 'Za období. Zapište ji jako 12.50 nebo 12,50.',
    'setup_fee' => 'Zřizovací poplatek',
    'setup_fee_helper' => 'Účtován jednou, na první faktuře. Nula je žádný.',
    'period' => 'Účtováno',
    'period_helper' => 'Jednorázově se zaplatí jednou a zůstane. Ostatní dostanou každé období novou fakturu; nezaplacená pozastaví server po ochranné lhůtě ze stránky Nastavení obchodu.',
    'stock' => 'Skladem',
    'stock_helper' => 'Kolik jich může být prodáno najednou, počítáno s každou nezrušenou objednávkou. Prázdné je bez omezení.',
    'term' => 'Minimální doba',
    'term_helper' => 'Na jak dlouho se někdo zaváže, jakmile koupí. Nula je bez závazku: může to zrušit a skončí to na konci období, které má zaplacené.',
    'term_unit' => 'Počítáno v',
    'term_unit_helper' => 'Dnech, měsících nebo letech. Zrušená objednávka doběhne do konce této doby a ten den se server smaže.',
    'unit_day' => 'Dny',
    'unit_month' => 'Měsíce',
    'unit_year' => 'Roky',
    'term_day' => 'Minimální doba: :count dní',
    'term_month' => 'Minimální doba: :count měsíců',
    'term_year' => 'Minimální doba: :count let',
    'section_art' => 'Obrázek',
    'section_art_helper' => 'Obrázek na kartě balíčku, v obchodě a u služeb zákazníka. Nechte obojí prázdné a použije se vlastní grafika egg, kterou většina balíčků už má.',
    'art_file' => 'Nahrát obrázek',
    'art_file_helper' => 'Spíš na šířku než na výšku: karta ho ořízne na 16:9. Až 8 MB.',
    'art_url' => 'Nebo adresa obrázku',
    'art_url_helper' => 'Celá adresa https. Použije se, když nahoře nic nahrané není.',

    'empty' => 'Zatím žádné balíčky',
    'section_ask' => 'Zeptat se zákazníka',
    'section_ask_helper' => 'Otázky položené u objednávky, zodpovězené dřív, než je odeslána. Odpovědi se dostanou na server, když se staví.',
    'ask_vars' => 'Proměnné, na které se zeptat',
    'ask_vars_helper' => 'Vlastní proměnné egg. Zaškrtněte jednu a zákazník ji při nákupu vyplní, a místo hodnoty z tohoto balíčku se použije jeho odpověď. Nechte vše nezaškrtnuté a nikdo se na nic neptá.',
    'upload_ask' => 'Požádat o soubor',
    'upload_ask_helper' => 'Zip, který zákazník nahraje při nákupu — svět, modpack, sada konfigurací. Vloží se mu do serveru, když se staví, dřív než se dozví, že je hotový.',
    'upload_label' => 'Jak tomu říkat',
    'upload_label_helper' => 'Popisek nad polem pro soubor, vlastními slovy. Prázdné použije obyčejný.',
    'upload_dir' => 'Kam v serveru',
    'upload_dir_helper' => 'Cesta uvnitř serveru, třeba / nebo /world. Před použitím se zabezpečí.',
    'upload_extract' => 'Rozbalit',
    'upload_extract_helper' => 'Zapnuto se zip rozbalí tam, kam dopadne, a samotný archiv se odstraní — to je správně pro svět nebo sadu konfigurací. Vypnuto zůstane zip souborem, a přesně to chce egg, který si z něj modpack instaluje sám.',
    'empty_body' => 'Vytvořte jeden a objeví se v obchodě, jakmile bude nabídnut k prodeji.',
];
