<?php

/*
 * Čeština. Psáno ručně.
 *
 * Veřejná stránka stavu.
 *
 * Jediné, co tenhle plugin podává někomu nepřihlášenému, a jediná stránka,
 * jejíž slova je potřeba číst tak, jako by je viděl cizí člověk - protože uvidí.
 * Nic tady neříká, který uzel, který vlastník ani jaká adresa; jen jméno, jestli
 * to běží, a kolik lidí je uvnitř.
 *
 * „Uzel" se objevuje jen v nastavení; na samotné veřejné stránce stojí „stroj",
 * protože tam čte někdo, kdo o Pelicanu nikdy neslyšel.
 */

return [
    // ---- stránka nastavení ------------------------------------------------
    'title' => 'Veřejná stránka stavu',
    'nav_label' => 'Stránka stavu',
    'subheading' => 'Stránka, kterou může otevřít kdokoli bez účtu a na které je vidět, které z vašich serverů běží. Nic se na ní neobjeví, dokud dole nepojmenujete server.',

    'address' => 'Vaše stránka stavu je dostupná na adrese',
    'address_off' => 'Zatím se nic nepodává. Přidejte dole server, stroj nebo službu a uložte - pak se tu objeví adresa.',

    'which' => 'Co se zveřejňuje',
    'which_helper' => 'Seznam začíná prázdný a nic není veřejné, dokud v něm nic není. Nabízejí se jen servery, které stejně můžete otevřít.',
    'add' => 'Zveřejnit server',
    'server' => 'Server',
    'shown_as' => 'Zobrazovat jako',
    'shown_as_helper' => 'To, co vidí veřejnost. Napište to sami, ať panel nebere skutečné jméno - „mc-prod-3 (nesahat)" je poznámka pro vás, ne něco, co se dává na fórum.',

    'look' => 'Text',
    'look_helper' => 'Všechno na téhle stránce čtou lidé, kteří účet nemají.',
    'heading' => 'Nadpis',
    'heading_helper' => 'Když necháte prázdné, vezme se jméno samotného panelu.',
    'note' => 'Řádek nad seznamem',
    'note_helper' => 'Aby se řeklo, co se děje - servisní okno nebo kam se ptát. Prostý text.',
    'link' => 'Odkaz na panel',
    'link_helper' => 'Cesta zpátky dovnitř, dole na stránce. Vypněte, jestli radši nechcete vyzradit, kde váš panel stojí.',

    'save' => 'Uložit',
    'saved' => 'Uloženo',
    'save_failed' => 'Nic se neuložilo',
    'open' => 'Otevřít stránku',

    // ---- počty hráčů ------------------------------------------------------
    'counts' => 'Počty hráčů',
    'counts_helper' => 'Odkud se berou čísla vedle serveru. Servery Minecraftu odpovídají na vlastní handshake a nastavují se pod Minecraftem; všechno níž je pro hry, které odpovídají na dotaz Valve - Rust, ARK, Valheim, 7 Days to Die a většinu dalšího, co běží na Source nebo Unrealu.',
    'query_eggs' => 'Eggs, které odpovídají na dotaz Valve',
    'query_eggs_helper' => 'Zaškrtněte eggs těch her. Tentýž seznam taky rozhoduje, které servery dostanou uvnitř panelu stránku Hráči - jedna otázka položená ze dvou důvodů. Nic se neptá, dokud to neřeknete: tohle je jediná věc tady, která otevírá spojení z panelu rovnou na herní port, takže je to volba, ne něco, co se samo rozjede. Server, na jehož port panel nedosáhne, prostě žádné číslo neukáže.',

    // ---- uzly -------------------------------------------------------------
    'nodes' => 'Stroje',
    'nodes_helper' => 'Běží nebo neběží, a nic víc. Ani zátěž, ani jak je plný disk - kdo se ptá, jestli si může zahrát, nepotřebuje zprávu o kapacitě vašeho železa, a zveřejnit ji znamená nakreslit mapu toho, kde to tlačí.',
    'add_node' => 'Zveřejnit stroj',
    'node' => 'Stroj',
    'node_shown_as_helper' => 'Napište to sami. Uzel se obvykle jmenuje nějak jako hetzner-fsn1-01, a to je celá věta o tom, kde vaše stroje stojí.',

    // ---- HTTP monitory ----------------------------------------------------
    'monitors' => 'Další služby',
    'monitors_helper' => 'Cokoli dalšího, o čem stojí za to vědět, že běží: váš web, API, health endpoint bota. Panel se každé ptá ve stejném rytmu jako serverů. Jen administrátoři - monitor přiměje tenhle panel chodit na nějakou adresu, a nechat kohokoli jeden přidat z něj dělá sondu, kterou lze namířit, kam se komu zachce.',
    'add_monitor' => 'Přidat službu',
    'monitor_name' => 'Název',
    'monitor_url' => 'Adresa',
    'monitor_url_helper' => 'Jen https. Kdyby tenhle panel pravidelně chodil na obyčejné http, každý po cestě by věděl, které z vašich služeb existují.',
    'monitor_expect' => 'Očekává se',
    'monitor_expect_helper' => 'Nechte prázdné pro „jakoukoli odpověď", což sedí webu, který přesměrovává nebo na holý požadavek odpoví 403. Číslo je pro endpoint napsaný tak, aby říkal přesně tohle a nic jiného - nastavené moc přísně nechá řádek navždy červený u služby, které nic není.',

    // ---- stránky pro uživatele --------------------------------------------
    'users' => 'Stránky pro vaše uživatele',
    'users_helper' => 'Jestli lidé se servery v tomhle panelu smějí zveřejnit vlastní stránku stavu.',
    'user_pages' => 'Nechat uživatele udělat si vlastní',
    'user_pages_helper' => 'Každý dostane vlastní adresu na /status/jeho-zkratka, kde jsou jen servery, které vlastní, pod jmény, která si napíše. Žádné stroje a žádné další služby na nich - obojí patří jen vám. Když je tohle zapnuté, najdou to pod „Stránka stavu" v nabídce svého účtu, v kterémkoli panelu zrovna jsou.',

    // ---- vzhled -----------------------------------------------------------
    'every' => 'Kontrolovat každých',
    'every_helper' => 'Jak často se stránka staví znovu a jak často se sama obnovuje v prohlížeči. Stránka, na kterou se lidé dívají během restartu, chce sekundy; stránka odkázaná z fóra, kterou nikdo nemá otevřenou, chce hodinu, a ptát se kvůli ní každou minutu každého uzlu je práce udělaná pro nikoho.',
    'every_realtime' => 'V reálném čase (10 sekund)',
    'every_30s' => '30 sekund',
    'every_1m' => '1 minuta',
    'every_5m' => '5 minut',
    'every_10m' => '10 minut',
    'every_30m' => '30 minut',
    'every_60m' => '60 minut',

    'style' => 'Styl',
    'style_helper' => 'Jeden ze vzhledů samotného panelu, použitý na téhle stránce: jeho barva, šedé tóny postavené z jeho povrchu a jak zakulacené jsou rohy. „Řídit se panelem" znamená ten, který je v něm dnes nastaven, včetně pozdějších změn.',
    'style_mine_helper' => 'Styly, které tenhle panel nabízí, použité na vaší stránce: barva, šedé tóny z ní postavené a jak zakulacené jsou rohy. Které styly jsou v tomhle seznamu, rozhoduje majitel panelu - tentýž seznam, ze kterého si vybíráte pod Vzhledem. „Řídit se panelem" znamená ten, který je nastaven.',
    'style_panel' => 'Řídit se panelem',

    // ---- něčí vlastní stránka ---------------------------------------------
    'mine_title' => 'Moje stránka stavu',
    'mine_nav_label' => 'Stránka stavu',
    'mine_subheading' => 'Jedna adresa, kterou dáte lidem, co hrají na vašich serverech. Ukazuje servery, které vyberete, a nic dalšího o tomhle panelu.',
    'mine_address' => 'Vaše adresa',
    'mine_address_helper' => 'Vezměte něco krátkého. Změnit ji později rozbije každý odkaz, který si už někdo uložil.',
    'mine_address_off' => 'Vyberte dole adresu a uložte - pak se tu vaše stránka objeví.',
    'slug' => 'Adresa',
    'slug_helper' => 'Malá písmena, číslice a pomlčky. Tři znaky nebo víc.',
    'mine_heading' => 'Nadpis',
    'mine_heading_helper' => 'Když necháte prázdné, vezme se vaše adresa.',
    'mine_note_helper' => 'Aby se řeklo, co se děje - restart, akce, kde vás najít. Prostý text, a čte ho každý, kdo má odkaz.',
    'mine_which' => 'Vaše servery',
    'mine_which_helper' => 'Nabízejí se jen servery, které vlastníte. Být někde jinde subuser je přístup ke stroji, ne svolení zveřejnit, že existuje.',
    'mine_shown_as_helper' => 'To, co vidí návštěvníci. Napište to sami místo jména z panelu, jestli je to jméno poznámka pro vás.',
    'mine_look_helper' => 'Jak vaše stránka vypadá lidem, kterým ji posíláte.',
    'mine_remove' => 'Stáhnout moji stránku',
    'mine_remove_confirm' => 'Stáhne vaši stránku a uvolní adresu pro někoho jiného. Všechno, co jste nastavili, je pryč; samotných serverů se to nedotkne.',
    'mine_removed' => 'Vaše stránka byla stažena',

    'why_slug' => 'Tahle adresa nepůjde. Malá písmena, číslice a pomlčky, tři znaky nebo víc - a pár slov je vyhrazených.',
    'why_taken' => 'Tuhle adresu už má někdo jiný.',
    'why_unwritable' => 'Nepodařilo se to zapsat. Zkontrolujte, že storage/app patří uživateli, pod kterým panel běží.',

    // ---- nadpisy na samotné stránce ---------------------------------------
    'section_servers' => 'Servery',
    'section_nodes' => 'Stroje',
    'section_monitors' => 'Služby',

    // ---- samotná stránka --------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Spouští se',

    /*
     * Ne „offline", a na veřejnosti je ten rozdíl důležitý.
     *
     * Panel na server nedosáhl. Obvykle je to uzel v údržbě nebo daemon, který
     * se restartuje - není to totéž jako vypnutý server, a říct stovce hráčů, že
     * jim server spadl, když běží, je horší než přiznat, že to člověk neví.
     */
    'unknown' => 'Neznámé',

    'players' => 'Hráči',
    'online_now' => 'právě hraje',
    'checked' => 'Zkontrolováno',
    'next_check' => 'do příští kontroly',
    'just_now' => 'právě teď',
    'seconds_ago' => 'před :count sekundami',
    'panel' => 'Přihlásit se',

    'all_up' => 'Všechno běží.',
    'some_down' => 'Něco neběží.',
    'empty' => 'Tady se zatím nic nezveřejňuje.',
];
