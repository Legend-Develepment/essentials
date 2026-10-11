<?php

/*
 * Čeština. Psáno rukou.
 *
 * Stránka modulů.
 *
 * Vlastní soubor místo kouta v settings.php, který už je největším
 * jazykovým souborem tohoto pluginu.
 */

return [
    'title' => 'Moduly',
    'nav_label' => 'Moduly',
    'subheading' => 'Čím tenhle plugin na tomhle panelu je. Všechno tady jde vypnout a vypnutí nikdy nesmaže to, co už bylo zapsáno.',

    'first_title' => 'K čemu je tenhle panel?',
    'first_helper' => 'Odpověz jednou a části, které k tomu patří, se zapnou. Nic se tím neuzavírá: každý přepínač níž je pořád tvůj a vypnout něco nikdy nesmaže to, co už zapsalo.',
    'first_look' => 'Hlavně jak vypadá',
    'first_look_helper' => 'Barvy, přihlašovací obrazovka, oznámení, tvoje odkazy a stránky, kde se to mění. Nic, co prodává, odpovídá nebo sahá ven.',
    'first_run' => 'Provozovat servery, pro sebe nebo pro partu',
    'first_run_helper' => 'Vzhled, plus co ukazuje server a co je plné nebo stojí. Žádný obchod, žádná přepážka s tikety a nic, co posílá poštu podle času.',
    'first_sell' => 'Prodávat hosting zákazníkům',
    'first_sell_helper' => 'Všechno. Obchod bez místa, kde se odpovídá na otázky, a bez čehokoli, co hlídá nody, je poloviční obchod.',
    'first_skip' => 'Vyberu si sám',

    'first_left' => 'Ponecháno, jak bylo. Přepínače jsou všechny níž.',
    'go' => 'Nastavit',

    'state_on' => 'Zapnuto',
    'state_part' => 'Zčásti zapnuto',
    'state_off' => 'Vypnuto',

    'count' => '{1} zapnuto :on z :of části|[2,*] zapnuto :on z :of částí',
    'parts' => '{1} Jediná část|[2,*] Všechny části (:count)',

    'health_tables' => 'Jeho tabulky tu ještě nejsou. Uložení čehokoli na této stránce je vytvoří.',
    'health_missing' => '{1} Jedna část potřebuje něco, co je vypnuté|[2,*] Části, které potřebují něco vypnutého: :count',
    'health_waiting' => '{1} Jedna část je zapnutá a zatím nic neukazuje|[2,*] Zapnutých částí, které zatím nic neukazují: :count',

    'left_access' => '{1} Jeden člověk má stále server přidělený odsud|[2,*] Lidí, kteří mají stále servery přidělené odsud: :count',
    'left_public_status' => '{1} Jedna zveřejněná stránka a její adresa zůstávají|[2,*] Zveřejněných stránek a jejich adres, které zůstávají: :count',
    'left_arranger' => '{1} Jedno uložené uspořádání zůstává|[2,*] Uložených uspořádání, která zůstávají: :count',
    'left_user_themes' => '{1} Zvolený styl jednoho člověka zůstává|[2,*] Zvolených stylů, které zůstávají: :count',
    'left_unknown' => 'Něco tu zůstalo a panel nedokázal přečíst kolik.',
    'cleared' => '{1} Jedno vzato zpět|[2,*] Vzato zpět: :count',
    'clear_failed' => 'Tohle se nepodařilo uklidit',

    'turn_on' => 'Zapnout',
    'turn_off' => 'Vypnout',

    'saved' => 'Uloženo',
    'brought' => 'Zapnuto spolu s ní, protože bez toho tu nic nefunguje: :names.',
    'save_failed' => 'Tohle se nepodařilo uložit',
    'read_only' => 'Můžeš se na to dívat, ale nemůžeš to měnit. Měnit, co panel nabízí, vyžaduje širší oprávnění k tomuto pluginu.',
];
