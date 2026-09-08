<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Balíky: server, ktorý si niekto môže kúpiť.
 *
 * Číta ten, kto zariaďuje obchod. Každé slovo tu je o šablóne a cene; to, čo
 * vidí zákazník, je v shop.php, lebo obaja čitatelia chcú o tom istom riadku
 * iné vety.
 *
 * „egg", „node", „swap", „io" a slová z Minecraftu ostávajú po anglicky: sú to
 * slová z vlastného formulára servera v Pelicane a balík je ten formulár
 * odložený na neskôr.
 *
 * Číslo stojí za slovom, nie pred ním: slovenčina skloňuje počítané podľa
 * čísla a jeden tvar nesedí ku všetkým.
 */

return [
    'title' => 'Balíky',
    'nav_label' => 'Balíky',
    'subheading' => 'To, čo sa predáva. Každý je šablóna servera s cenou; zákazník si jeden kúpi a panel server vytvorí.',

    // ---- tabuľka ---------------------------------------------------------
    'column_name' => 'Balík',
    'column_egg' => 'Egg',
    'column_price' => 'Cena',
    'column_stock' => 'Na sklade',
    'column_live' => 'V predaji',
    'column_orders' => 'Predané',

    'live' => 'V predaji',
    'offline' => 'Nie je v predaji',
    'no_egg' => 'Bez egg — nedá sa zostaviť',

    'stock_unlimited' => 'Bez obmedzenia',
    'stock_left' => 'Zostáva: :count',
    'stock_out' => 'Vypredané',

    // ---- obdobia ---------------------------------------------------------
    'period_once' => 'Jednorazovo',
    'period_month' => 'Mesačne',
    'period_quarter' => 'Štvrťročne',
    'period_year' => 'Ročne',

    // Za cenou: „12,50 € mesačne".
    'per_once' => 'jednorazovo',
    'per_month' => 'mesačne',
    'per_quarter' => 'štvrťročne',
    'per_year' => 'ročne',

    // ---- akcie -----------------------------------------------------------
    'new' => 'Nový balík',
    'edit' => 'Upraviť',
    'duplicate' => 'Duplikovať',
    'copy_suffix' => ' (kópia)',
    'go_live' => 'Ponúknuť na predaj',
    'go_offline' => 'Stiahnuť z predaja',
    'delete' => 'Zmazať',
    'delete_confirm' => 'Odstráni balík. Čo už bolo kúpené, ostane nedotknuté — objednávky si držia vlastnú kópiu toho, čím boli.',
    'delete_refused' => 'Nezmazané',
    'delete_refused_body' => 'Na tento balík boli zadané objednávky a tie naň ukazujú. Radšej ho stiahnite z predaja; ostane v evidencii a nikto ho nekúpi.',
    'deleted' => 'Balík zmazaný',
    'saved' => 'Balík uložený',
    'save_failed' => 'Balík sa nepodarilo uložiť',
    'price_invalid' => 'To nie je suma. Zapíšte ju ako 12.50 alebo 12,50.',

    // ---- formulár: čo to je ----------------------------------------------
    'section_basics' => 'Balík',
    'section_basics_helper' => 'To, čo zákazník vidí na karte.',
    'name' => 'Názov',
    'name_helper' => 'Ako sa volá v obchode.',
    'slug' => 'Adresa',
    'slug_helper' => 'Malé písmená, číslice a pomlčky. Ponechaná prázdna sa vytvorí z názvu. Neskoršia zmena pokazí odkaz, ktorý si niekto uložil.',
    'description' => 'Popis',
    'description_helper' => 'Pár riadkov pod názvom. Obyčajný text.',
    'live_field' => 'V predaji',
    'live_helper' => 'Vypnuté nechá balík tu a nikomu ho neukáže. Balík bez egg sa neukáže nikdy, nech tu stojí čokoľvek.',
    'sort' => 'Poradie',
    'sort_helper' => 'Nižšie je v obchode skôr.',

    // ---- formulár: čím sa stane ------------------------------------------
    'section_server' => 'Server, ktorým sa stane',
    'section_server_helper' => 'Tie isté otázky, aké kladie Pelican pri ručnom vytváraní servera, tu zodpovedané raz a použité pri každom predaji.',
    'egg' => 'Egg',
    'egg_helper' => 'Výber vyplní image, štartovací príkaz a každú premennú predvolenými hodnotami z egg. Potom zmeňte, čo chcete.',
    'image' => 'Image Dockeru',
    'image_helper' => 'Jeden z image, ktoré egg ponúka.',
    'image_default' => 'Prvý image egg',
    'startup' => 'Štartovací príkaz',
    'startup_helper' => 'Jeden z príkazov, ktoré egg ponúka.',
    'startup_default' => 'Prvý príkaz egg',
    'environment' => 'Premenné',
    'environment_helper' => 'Premenné egg a ich hodnoty. Všetko, čo egg má a tu nie je, dostane pri vytvorení servera predvolenú hodnotu.',
    'env_key' => 'Premenná',
    'env_value' => 'Hodnota',
    'nodes' => 'Node',
    'nodes_helper' => 'Kde smie server z tohto balíka vzniknúť, skúšané v tomto poradí, kým niektorý nemá voľnú adresu. Nič nezaškrtnuté znamená ľubovoľný node.',

    // ---- formulár: limity ------------------------------------------------
    'section_limits' => 'Limity',
    'section_limits_helper' => 'Čo server dostane. Tie isté polia ako vlastný formulár servera v Pelicane, v tých istých jednotkách.',
    'memory' => 'Pamäť',
    'disk' => 'Disk',
    'cpu' => 'CPU',
    'cpu_helper' => 'Percento jedného jadra: 100 je jedno jadro, 200 sú dve, 0 je bez limitu.',
    'swap' => 'Swap',
    'swap_helper' => '0 je žiadny, -1 je neobmedzený.',
    'io' => 'Váha blokového IO',
    'io_helper' => 'Predvolené v Pelicane je 500. Nechajte to tak, ak neviete, prečo nie.',
    'threads' => 'Priradenie CPU',
    'threads_helper' => 'Ktoré jadrá, ako ich zapisuje Pelican: 0,1 alebo 0-3. Prázdne je ľubovoľné.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Či smie jadro server ukončiť, keď mu dôjde pamäť.',
    'databases' => 'Databázy',
    'allocations' => 'Ďalšie allocation',
    'backups' => 'Zálohy',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- formulár: peniaze -----------------------------------------------
    'section_price' => 'Cena a sklad',
    'section_price_helper' => 'V mene obchodu, nastavenej na stránke Nastavenia obchodu. Bez dane — daň sa na faktúru pridáva ako vlastný riadok.',
    'price' => 'Cena',
    'price_helper' => 'Za obdobie. Zapíšte ju ako 12.50 alebo 12,50.',
    'setup_fee' => 'Zriaďovací poplatok',
    'setup_fee_helper' => 'Účtovaný raz, na prvej faktúre. Nula je žiadny.',
    'period' => 'Účtované',
    'period_helper' => 'Jednorazovo sa zaplatí raz a ostane. Ostatné dostanú každé obdobie novú faktúru; nezaplatená pozastaví server po ochrannej lehote zo stránky Nastavenia obchodu.',
    'stock' => 'Na sklade',
    'stock_helper' => 'Koľko ich môže byť predaných naraz, počítajúc každú nezrušenú objednávku. Prázdne je bez obmedzenia.',
    'term' => 'Minimálna viazanosť',
    'term_helper' => 'Ako dlho je niekto viazaný, keď si to kúpi. Nula je bez záväzku: môže zrušiť a skončí to na konci obdobia, ktoré má zaplatené.',
    'term_unit' => 'Počíta sa v',
    'term_unit_helper' => 'Dni, mesiace alebo roky. Zrušená objednávka dobehne do konca tejto doby a v ten deň sa server zmaže.',
    'unit_day' => 'Dni',
    'unit_month' => 'Mesiace',
    'unit_year' => 'Roky',
    'term_day' => 'Minimálna viazanosť: :count dní',
    'term_month' => 'Minimálna viazanosť: :count mesiacov',
    'term_year' => 'Minimálna viazanosť: :count rokov',
    'section_art' => 'Obrázok',
    'section_art_helper' => 'Obrázok na karte balíka, v obchode a v službách zákazníka. Nechajte obe polia prázdne a použije sa vlastný obrázok egg-u, ktorý väčšina balíkov už má.',
    'art_file' => 'Nahrať obrázok',
    'art_file_helper' => 'Skôr široký ako vysoký: karta ho oreže na 16:9. Až 8 MB.',
    'art_url' => 'Alebo adresa obrázka',
    'art_url_helper' => 'Úplná adresa https. Použije sa, keď sa vyššie nič nenahrá.',

    'empty' => 'Zatiaľ žiadne balíky',
    'empty_body' => 'Vytvorte jeden a objaví sa v obchode, len čo bude ponúknutý na predaj.',
];
