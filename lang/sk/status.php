<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Verejná stránka stavu.
 *
 * Jediné, čo tento plugin podáva niekomu neprihlásenému, a jediná stránka,
 * ktorej slová treba čítať tak, akoby ich videl cudzí človek - lebo uvidí. Nič
 * tu nehovorí, ktorý uzol, ktorý vlastník ani aká adresa; len meno, či to beží,
 * a koľko ľudí je vnútri.
 *
 * „Uzol" sa objavuje len v nastaveniach; na samotnej verejnej stránke stojí
 * „stroj", lebo tam číta niekto, kto o Pelicane nikdy nepočul.
 */

return [
    // ---- stránka nastavení ------------------------------------------------
    'title' => 'Verejná stránka stavu',
    'nav_label' => 'Stránka stavu',
    'subheading' => 'Stránka, ktorú môže otvoriť ktokoľvek bez účtu a na ktorej vidno, ktoré z vašich serverov bežia. Nič sa na nej neobjaví, kým dole nepomenujete server.',

    'address' => 'Vaša stránka stavu je dostupná na adrese',
    'address_off' => 'Zatiaľ sa nič nepodáva. Pridajte dole server, stroj alebo službu a uložte - potom sa tu objaví adresa.',

    'which' => 'Čo sa zverejňuje',
    'which_helper' => 'Zoznam začína prázdny a nič nie je verejné, kým v ňom nič nie je. Ponúkajú sa len servery, ktoré aj tak môžete otvoriť.',
    'add' => 'Zverejniť server',
    'server' => 'Server',
    'shown_as' => 'Zobrazovať ako',
    'shown_as_helper' => 'To, čo vidí verejnosť. Napíšte to sami, nech panel neberie skutočné meno - „mc-prod-3 (nesiahať)" je poznámka pre vás, nie niečo, čo sa dáva na fórum.',

    'look' => 'Text',
    'look_helper' => 'Všetko na tejto stránke čítajú ľudia, ktorí účet nemajú.',
    'heading' => 'Nadpis',
    'heading_helper' => 'Keď necháte prázdne, vezme sa meno samotného panela.',
    'note' => 'Riadok nad zoznamom',
    'note_helper' => 'Aby sa povedalo, čo sa deje - servisné okno alebo kam sa pýtať. Obyčajný text.',
    'link' => 'Odkaz na panel',
    'link_helper' => 'Cesta späť dnu, dole na stránke. Vypnite, ak radšej nechcete prezradiť, kde váš panel stojí.',

    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'save_failed' => 'Nič sa neuložilo',
    'open' => 'Otvoriť stránku',

    // ---- počty hráčov -----------------------------------------------------
    'counts' => 'Počty hráčov',
    'counts_helper' => 'Odkiaľ sa berú čísla vedľa servera. Servery Minecraftu odpovedajú na vlastný handshake a nastavujú sa pod Minecraftom; všetko nižšie je pre hry, ktoré odpovedajú na dopyt Valve - Rust, ARK, Valheim, 7 Days to Die a väčšinu ďalšieho, čo beží na Source alebo Unreale.',
    'query_eggs' => 'Eggs, ktoré odpovedajú na dopyt Valve',
    'query_eggs_helper' => 'Zaškrtnite eggs tých hier. Ten istý zoznam tiež rozhoduje, ktoré servery dostanú vnútri panela stránku Hráči - jedna otázka položená z dvoch dôvodov. Nič sa nepýta, kým to nepoviete: toto je jediná vec tu, ktorá otvára spojenie z panela rovno na herný port, takže je to voľba, nie niečo, čo sa samo rozbehne. Server, na ktorého port panel nedosiahne, jednoducho žiadne číslo neukáže.',

    // ---- uzly -------------------------------------------------------------
    'nodes' => 'Stroje',
    'nodes_helper' => 'Beží alebo nebeží, a nič viac. Ani záťaž, ani ako je plný disk - kto sa pýta, či si môže zahrať, nepotrebuje správu o kapacite vášho železa, a zverejniť ju znamená nakresliť mapu toho, kde to tlačí.',
    'add_node' => 'Zverejniť stroj',
    'node' => 'Stroj',
    'node_shown_as_helper' => 'Napíšte to sami. Uzol sa obyčajne volá nejako ako hetzner-fsn1-01, a to je celá veta o tom, kde vaše stroje stoja.',

    // ---- HTTP monitory ----------------------------------------------------
    'monitors' => 'Ďalšie služby',
    'monitors_helper' => 'Čokoľvek ďalšie, o čom stojí za to vedieť, že beží: váš web, API, health endpoint bota. Panel sa každej pýta v rovnakom rytme ako serverov. Len administrátori - monitor prinúti tento panel chodiť na nejakú adresu, a nechať kohokoľvek jeden pridať z neho robí sondu, ktorú možno namieriť, kam sa komu zachce.',
    'add_monitor' => 'Pridať službu',
    'monitor_name' => 'Názov',
    'monitor_url' => 'Adresa',
    'monitor_url_helper' => 'Len https. Keby tento panel pravidelne chodil na obyčajné http, každý po ceste by vedel, ktoré z vašich služieb existujú.',
    'monitor_expect' => 'Očakáva sa',
    'monitor_expect_helper' => 'Nechajte prázdne pre „akúkoľvek odpoveď", čo sedí webu, ktorý presmerúva alebo na holú požiadavku odpovie 403. Číslo je pre endpoint napísaný tak, aby hovoril presne toto a nič iné - nastavené prísne nechá riadok navždy červený pri službe, ktorej nič nie je.',

    // ---- stránky pre používateľov -----------------------------------------
    'users' => 'Stránky pre vašich používateľov',
    'users_helper' => 'Či ľudia so servermi v tomto paneli smú zverejniť vlastnú stránku stavu.',
    'user_pages' => 'Nechať používateľov spraviť si vlastnú',
    'user_pages_helper' => 'Každý dostane vlastnú adresu na /status/jeho-skratka, kde sú len servery, ktoré vlastní, pod menami, ktoré si napíše. Žiadne stroje a žiadne ďalšie služby na nich - oboje patrí len vám. Keď je toto zapnuté, nájdu to pod „Stránka stavu" v ponuke svojho účtu, v ktoromkoľvek paneli práve sú.',

    // ---- vzhľad -----------------------------------------------------------
    'every' => 'Kontrolovať každých',
    'every_helper' => 'Ako často sa stránka stavia znova a ako často sa sama obnovuje v prehliadači. Stránka, na ktorú sa ľudia pozerajú počas reštartu, chce sekundy; stránka odkázaná z fóra, ktorú nikto nemá otvorenú, chce hodinu, a pýtať sa kvôli nej každú minútu každého uzla je práca urobená pre nikoho.',
    'every_realtime' => 'V reálnom čase (10 sekúnd)',
    'every_30s' => '30 sekúnd',
    'every_1m' => '1 minúta',
    'every_5m' => '5 minút',
    'every_10m' => '10 minút',
    'every_30m' => '30 minút',
    'every_60m' => '60 minút',

    'style' => 'Štýl',
    'style_helper' => 'Jeden zo vzhľadov samotného panela, použitý na tejto stránke: jeho farba, sivé tóny postavené z jeho povrchu a ako zaguľatené sú rohy. „Riadiť sa panelom" znamená ten, ktorý je v ňom dnes nastavený, vrátane neskorších zmien.',
    'style_mine_helper' => 'Štýly, ktoré tento panel ponúka, použité na vašej stránke: farba, sivé tóny z nej postavené a ako zaguľatené sú rohy. Ktoré štýly sú v tomto zozname, rozhoduje majiteľ panela - ten istý zoznam, z ktorého si vyberáte pod Vzhľadom. „Riadiť sa panelom" znamená ten, ktorý je nastavený.',
    'style_panel' => 'Riadiť sa panelom',

    // ---- niečia vlastná stránka -------------------------------------------
    'mine_title' => 'Moja stránka stavu',
    'mine_nav_label' => 'Stránka stavu',
    'mine_subheading' => 'Jedna adresa, ktorú dáte ľuďom, čo hrajú na vašich serveroch. Ukazuje servery, ktoré vyberiete, a nič ďalšie o tomto paneli.',
    'mine_address' => 'Vaša adresa',
    'mine_address_helper' => 'Vezmite niečo krátke. Zmeniť ju neskôr rozbije každý odkaz, ktorý si už niekto uložil.',
    'mine_address_off' => 'Vyberte dole adresu a uložte - potom sa tu vaša stránka objaví.',
    'slug' => 'Adresa',
    'slug_helper' => 'Malé písmená, číslice a pomlčky. Tri znaky alebo viac.',
    'mine_heading' => 'Nadpis',
    'mine_heading_helper' => 'Keď necháte prázdne, vezme sa vaša adresa.',
    'mine_note_helper' => 'Aby sa povedalo, čo sa deje - reštart, akcia, kde vás nájsť. Obyčajný text, a číta ho každý, kto má odkaz.',
    'mine_which' => 'Vaše servery',
    'mine_which_helper' => 'Ponúkajú sa len servery, ktoré vlastníte. Byť inde subuser je prístup k stroju, nie povolenie zverejniť, že existuje.',
    'mine_shown_as_helper' => 'To, čo vidia návštevníci. Napíšte to sami namiesto mena z panela, ak je to meno poznámka pre vás.',
    'mine_look_helper' => 'Ako vaša stránka vyzerá ľuďom, ktorým ju posielate.',
    'mine_remove' => 'Stiahnuť moju stránku',
    'mine_remove_confirm' => 'Stiahne vašu stránku a uvoľní adresu pre niekoho iného. Všetko, čo ste nastavili, je preč; samotných serverov sa to nedotkne.',
    'mine_removed' => 'Vaša stránka bola stiahnutá',

    'why_slug' => 'Táto adresa nepôjde. Malé písmená, číslice a pomlčky, tri znaky alebo viac - a pár slov je vyhradených.',
    'why_taken' => 'Túto adresu už má niekto iný.',
    'why_unwritable' => 'Nepodarilo sa to zapísať. Skontrolujte, že storage/app patrí používateľovi, pod ktorým panel beží.',

    // ---- nadpisy na samotnej stránke --------------------------------------
    'section_servers' => 'Servery',
    'section_nodes' => 'Stroje',
    'section_monitors' => 'Služby',

    // ---- samotná stránka --------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Spúšťa sa',

    /*
     * Nie „offline", a na verejnosti je ten rozdiel dôležitý.
     *
     * Panel na server nedosiahol. Obyčajne je to uzol v údržbe alebo daemon,
     * ktorý sa reštartuje - nie je to to isté ako vypnutý server, a povedať
     * stovke hráčov, že im server spadol, keď beží, je horšie než priznať, že to
     * človek nevie.
     */
    'unknown' => 'Neznáme',

    'players' => 'Hráči',
    'online_now' => 'práve hrá',
    'checked' => 'Skontrolované',
    'next_check' => 'do ďalšej kontroly',
    'just_now' => 'práve teraz',
    'seconds_ago' => 'pred :count sekundami',
    'panel' => 'Prihlásiť sa',

    'all_up' => 'Všetko beží.',
    'some_down' => 'Niečo nebeží.',
    'empty' => 'Tu sa zatiaľ nič nezverejňuje.',
];
