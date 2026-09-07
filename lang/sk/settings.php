<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Egg", „uzol", „subuser", „Wings", „queue", „webhook", „topbar", „cron" a
 * názvy formátov súborov ostávajú, ako sú: pod týmito menami sa nájdu v
 * samotnom Pelicane, na hostiteľovi a vo všetkom, čo sa o nich píše. Názvy
 * štýlov sa tiež neprekladajú — štýl sa volá, ako sa volá, a preložené meno by
 * bolo druhým menom tej istej veci.
 */

return [
    'css_warning' => 'Uložené, ale toto CSS vyzerá zle',
    'css_unclosed' => 'Pravidlo otvorené na riadku :line sa nikdy nezatvára. Všetko po ňom stojí vnútri toho pravidla a neuplatní sa.',
    'css_extra' => 'Na riadku :line je zatváracia zátvorka, hoci nič nie je otvorené. Všetko po nej stojí mimo akéhokoľvek pravidla a preskočí sa.',
    'css_comment' => 'Komentár otvorený na riadku :line sa nikdy nezatvára, takže zvyšok súboru stojí vnútri neho.',

    'groups' => [
        'appearance' => 'Vzhľad',
        'servers' => 'Zoznam serverov',
        'windows' => 'Štýly podľa času',
        'windows_helper' => 'Iný štýl medzi dvoma hodinami dňa. Nič sa nedeje, kým jeden nepridáte. Hodiny sú hodiny samotného panela, z jeho nastavenia časového pásma, nie hodiny každého čitateľa: panel, ktorý by v tú istú chvíľu vyzeral dvom ľuďom inak, by vyzeral pokazene, nie naplánovane. Okno mení vzhľad, ktorý panel už má, takže nerobí nič, kým štýl stojí na „Žiadny". Štýl, ktorý si niekto vybral sám, aj tak vyhráva.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Jazyky',
        'servers_helper' => 'Ako sa kreslí karta servera. Či sa ukazujú v mriežke alebo v zozname, je voľba každého, v Účet → Rozloženie nástenky.',
        'server_pages' => 'Stránky servera',
        'server_pages_helper' => 'Čo nesie každá stránka vnútri servera, nech je to ktorá chce.',
        'console' => 'Stránka konzoly',
        'console_helper' => 'Písmo terminálu, jeho veľkosť a výška sú voľba každého, v Účte.',
        'background' => 'Pozadie',
        'background_helper' => 'Týka sa celého panela, vrátane prihlasovacej obrazovky.',
        'icons' => 'Ikony',
        'bars' => 'Ukazovatele zdrojov',
        'bars_helper' => 'Pásy procesora, pamäte a disku na kartách serverov.',
        'updates' => 'Aktualizácie',
        'updates_helper' => 'Ktoré vydania stránka motívu ponúka a kde ich hľadá.',
        'brand' => 'Značka',
        'login' => 'Prihlasovacia obrazovka',
        'login_helper' => 'Týka sa obrazoviek prihlásenia, obnovy hesla a druhého faktora.',
        'advanced' => 'Vlastné CSS',
        'advanced_helper' => 'Na všetko, čo nastavenia vyššie nepokrývajú. Načítava sa po všetkom ostatnom, takže vyhráva.',
        'areas' => 'Podľa oblasti',
        'areas_helper' => 'Všetko vyššie platí všade. Tu sa dá jedna oblasť vyčleniť; čo necháte prázdne, sa ďalej riadi všeobecným nastavením.',
        'footer' => 'Päta bočného panela',
        'footer_helper' => 'Spodok bočného panela, ktorý Pelican necháva prázdny. Všetko tu je vypnuté, kým to nevyplníte.',
        'features' => 'Čo tento plugin pridáva',
        'features_helper' => 'Odškrtnúť niečo znamená vziať to z panela úplne preč. Jeho nastavenia ostávajú a jeho stránka si necháva adresu, takže sa nič nestratí, keď niečo vypnete, aby ste videli, čo to robilo. Väčšina má navyše vlastné oprávnenie v Rolách, aby sa dalo odovzdať jedno bez toho, aby sa odovzdal zvyšok. Nie všetko: ukazovatele zdrojov, päta bočného panela a hľadanie v nastaveniach sa kreslia všetkým a nikto ich nespravuje, hviezdička na karte servera patrí tomu, kto na ňu klikol, a stránky Palworldu a Minecraftu vnútri servera sa riadia oprávneniami toho servera, nie jedným z týchto. Samotný vzhľad v tomto zozname nie je — má vlastný vypínač, v Vzhľad → Vzhľad → Štýl → Žiadny.',
        'identity' => 'Tento plugin v bočnom paneli',
        'identity_helper' => 'Položka, ktorú tento plugin do bočného panela pridáva, a obrázok na nej.',
    ],

    /*
     * Stránky nastavení, každá ako položka vo vlastnej skupine pluginu v bočnom
     * paneli. Zoskupené podľa otázky, na ktorú sa odpovedá, nie podľa triedy,
     * ktorá ich realizuje.
     */
    'pages' => [
        'look' => 'Vzhľad',
        'look_helper' => 'Farba, tvar a to, ako sa panel volá.',
        'pages' => 'Stránky',
        'pages_helper' => 'Zoznam serverov, stránky vnútri servera a terminál.',
        'advanced' => 'Pokročilé',
        'advanced_helper' => 'Dva núdzové východy: vlastné CSS a nastavenia, ktoré platia len v jednej oblasti.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Ktoré eggs sú Minecraft a všetko ostatné k tomu.',
        'artwork' => 'Obrázky eggs',
        'artwork_helper' => 'Stránka so všetkými eggs a spôsob, ako stiahnuť obrázok hry zo Steamu alebo z IGDB. Zapisuje priamo do eggs — obrázok a dva štítky, ktoré si pamätajú, o ktorú hru ide a či bol obrázok vybraný ručne — a preto nesie vlastné oprávnenie.',
        'alerts' => 'Upozornenia',
        'alerts_helper' => 'Pravidelná kontrola vecí, ktoré panel aj tak meria, ale nikomu nehovorí: uzol prestal odpovedať, plní sa disk, queue worker sa zastavil, verzia zaostala. Posiela na Discord, do panela alebo e-mailom. Vlastné oprávnenie, lebo to pravidelne dosahuje na každý uzol a publikuje na adresu, ktorú niekto napísal.',
        'backups' => 'Prehľad záloh',
        'backups_helper' => 'Stránka so všetkými servermi a s tým, ako dlho je každý bez zálohy, zoradená tak, aby tie bez jedinej stáli hore. Len na čítanie — všetko, čo so zálohou pracuje, ostáva na stránke Pelicanu pre ten server. Vlastné oprávnenie, lebo ten zoznam je mapa toho, kde sú diery.',
        'public_status' => 'Verejná stránka stavu',
        'public_status_helper' => 'Stránka, ktorú môže otvoriť ktokoľvek bez účtu a na ktorej vidno, ktoré z vašich serverov bežia a koľko ľudí na nich je. Nič sa nezverejňuje, kým nepomenujete server, stroj alebo službu — všetky tri zoznamy začínajú prázdne, a kým také sú, adresa odpovedá 404. Vlastné oprávnenie, lebo rozhoduje o tom, čo z panela von.',
        'game_players' => 'Hráči, ďalšie hry',
        'capacity' => 'Kapacita',
        'capacity_helper' => 'Koľko je sľúbené na každom stroji proti tomu, koľko smie rozdať, aby bolo vidieť, či sa zmestí ešte jeden server. Zoznam uzlov Pelicanu ukazuje meno a počet serverov a blok Stroje na nástenke ukazuje, čo beží - toto je tretia otázka a počet je vlastný, Pelicanov. Len na čítanie. Vlastné oprávnenie.',
        'schedules' => 'Naplánované úlohy',
        'schedules_helper' => 'Všetky naplánované úlohy panela aj to, ktoré z nich zastali: zaseknuté uprostred behu, oneskorené, lebo cron nebeží, alebo nikdy nespustené. Pelican ukazuje úlohy vnútri každého servera a jeho vlastný stav nemá slovo pre žiadny z tých prípadov. Len na čítanie. Vlastné oprávnenie.',
        'activity' => 'Aktivita',
        'activity_helper' => 'Každá udalosť, ktorú panel zaznamenáva, v jednom zozname namiesto po jednom serveri. Pelican záznam vedie a ukazuje ho po serveroch; tu sa ten istý záznam pýta z druhej strany. Len na čítanie. Vlastné oprávnenie, lebo záznam o tom, kto čo urobil, sa odovzdáva vedome.',
        'access' => 'Prístup k serverom',
        'access_helper' => 'Zviazať rolu so servermi, aby na ne každý jej držiteľ dosiahol. Funguje to udržiavaním subusers samotného Pelicanu v aktuálnom stave, ktoré aj tak číta zoznam serverov aj každá kontrola oprávnení. Vlastné oprávnenie, lebo je to jediná tunajšia stránka, ktorá ľuďom dáva prístup k veciam.',
        'games' => 'Ďalšie hry',
        'games_helper' => 'Súbory, ktoré si ARK a Valheim držia vedľa svojho sveta, ako formuláre: nastavenia sveta ARKu a zoznamy administrátorov, banov a povolených pri Valheime. Ktoré servery ich dostanú, hovorí zoznam eggs na tej stránke, takže prázdny zoznam je už vypínač pre danú hru.',
        'game_players_helper' => 'Stránka vnútri Rustu, ARKu, Valheimu a všetkého, čo odpovedá na dopyt Valve, ktorá ukazuje, kto je pripojený a ako dlho. Len na čítanie — čo sa dá s niekým urobiť, sa hra od hry líši, a to je samostatné vydanie. Ktoré eggs sa počítajú, je ten istý zoznam, ktorý používa stránka stavu.',
        'languages' => 'Jazyky',
        'languages_helper' => 'V akých jazykoch tento plugin odpovedá.',
    ],

    'features' => [
        'look' => 'Nastavenia vzhľadu',
        'look_helper' => 'Položka bočného panela pre farbu, tvar a značku.',
        'pages' => 'Nastavenia stránok',
        'pages_helper' => 'Položka bočného panela pre zoznam serverov, stránky servera a terminál.',
        'advanced' => 'Pokročilé nastavenia',
        'advanced_helper' => 'Položka bočného panela pre vlastné CSS a výnimky podľa oblasti.',
        'announcements' => 'Oznamy',
        'announcements_helper' => 'Pás cez hornú časť panela.',
        'nav_links' => 'Navigačné odkazy',
        'nav_links_helper' => 'Vaše vlastné položky v bočnom paneli.',
        'login' => 'Prihlasovacia obrazovka',
        'login_helper' => 'Obrázok, hláška a odkazy prihlasovacej obrazovky.',
        'bars' => 'Ukazovatele zdrojov',
        'bars_helper' => 'Prefarbené pásy procesora, pamäte a disku.',
        'dashboard_status' => 'Riadok verzie',
        'dashboard_status_helper' => 'Vrch bloku na nástenke: ktorá verzia je nainštalovaná a či nejaká nečaká.',
        'dashboard_nodes' => 'Stroje',
        'dashboard_nodes_helper' => 'Zvyšok bloku na nástenke: tento panel a každý uzol s tým, koľko každý spotrebúva.',
        'system_status' => 'Stránka stavu systému',
        'system_status_helper' => 'Stránka stroja, na ktorom beží samotný panel.',
        'sidebar_footer' => 'Päta bočného panela',
        'sidebar_footer_helper' => 'Váš riadok textu, verzia panela a jeden odkaz, celkom dole v bočnom paneli.',
        'languages' => 'Jazyky',
        'languages_helper' => 'Odpovedať každému v jazyku nastavenom na jeho účte, tam, kde je tento plugin preložený. Vypnuté — každý dostane angličtinu.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Karta Minecraft v bočnom paneli a stránka vnútri každého servera Minecraftu na úpravu jeho server.properties ako formulára. Ktoré eggs sa počítajú, hovoríte vy.',
        'palworld' => 'Nastavenia Palworldu',
        'palworld_helper' => 'Stránka vnútri servera Palworldu na úpravu jeho nastavení sveta. Na žiadnom inom serveri sa neobjaví, a nikdy, kým ten server beží.',
        'settings_search' => 'Hľadanie v nastaveniach',
        'settings_search_helper' => 'Pole nad týmito formulármi, ktoré ich zúži na sekcie obsahujúce to, čo napíšete.',
        'preview' => 'Živý náhľad',
        'preview_helper' => 'Rámček vedľa formulára Vzhľad, ktorý ukazuje, čo farby, rohy a rozostupy robia ešte pred uložením.',
        'duplicate' => 'Duplikácia servera',
        'duplicate_helper' => 'Stránka na postavenie ďalšieho servera presne ako toho, ktorý už máte, alebo rovno niekoľkých. Súbory sa nikdy nekopírujú.',
        'favourites' => 'Označené servery',
        'favourites_helper' => 'Hviezdička na každej karte servera. Označené idú prvé a zoznam každého sa drží v paneli — takže jeho hviezdičky idú s ním tam, kde sa nabudúce prihlási. Mení to, čo vidí on, a pre ostatných nič. Byť v paneli však znamená, že je to súbor v storage, ktorý si môže prečítať každý, kto má prístup k stroju.',
        'artwork' => 'Obrázky eggs',
        'artwork_helper' => 'Administrátorská stránka, ktorá sťahuje obrázok každého egg zo Steamu alebo z IGDB a zapisuje ho priamo do egg.',
        'alerts' => 'Upozornenia',
        'alerts_helper' => 'Pravidelná kontrola uzla, ktorý prestal odpovedať, plniaceho sa disku, mŕtveho queue workera alebo zaostávajúcej verzie — a správa na Discord, do panela alebo e-mailom, ktorú pošle.',
        'backups' => 'Prehľad záloh',
        'backups_helper' => 'Administrátorská stránka, ktorá vypisuje každý server podľa toho, ako dlho je bez zálohy. Len na čítanie.',
        'public_status' => 'Verejná stránka stavu',
        'public_status_helper' => 'Stránka, ktorú môže otvoriť ktokoľvek bez účtu. Vypnuté — adresa odpovedá 404, nech je v zozname čokoľvek.',
        'game_players' => 'Hráči, ďalšie hry',
        'game_players_helper' => 'Stránka vnútri Rustu, ARKu, Valheimu a všetkého, čo odpovedá na dopyt Valve, ktorá ukazuje, kto je pripojený a ako dlho.',
        'owner_alerts' => 'Hovoriť ľuďom, že ich server je offline',
        'owner_alerts_helper' => 'Jediná časť tohto pluginu, ktorá píše ľuďom, ktorí nie sú administrátori: upozornenie v paneli, keď stroj jedného z ich serverov prestane odpovedať, a ďalšie, keď sa vráti. Vypnuté, kým sa to nezapne tu aj na stránke Upozornenia, na oboch miestach - píše to vašim zákazníkom, takže to chce dve rozhodnutia, nie jedno.',
        'my_backups' => 'Upozornenie na zálohy v zozname serverov',
        'my_backups_helper' => 'Riadok nad vlastným zoznamom serverov každého človeka, keď niektorý z jeho serverov nikdy nemal zálohu alebo ju dlhšie nemá. Karty Pelicanu hovoria, čo server robí teraz; nič tam nehovorí, že záloha nebežala tri týždne. Kreslí sa len vtedy, keď niečo zaostáva, a nepomenúva žiadny server, ktorý by ten človek aj tak nemohol otvoriť.',
        'capacity' => 'Prehľad kapacity',
        'capacity_helper' => 'Administrátorská stránka, ktorá ukazuje pamäť, disk a procesor sľúbené proti dostupným na každom stroji, spolu so servermi, ktorým došli zálohy, databázy alebo alokácie. Sľúbené, nie spotrebované - uzol môže byť vyťažený a prázdny, alebo nečinný a plný.',
        'schedules' => 'Prehľad naplánovaných úloh',
        'schedules_helper' => 'Administrátorská stránka, ktorá vypisuje všetky naplánované úlohy panela, najhoršie hore - zaseknuté, oneskorené, alebo nikdy nespustené. Len na čítanie; všetko, čo úlohu upravuje alebo spúšťa, ostáva na stránke Pelicanu pre ten server.',
        'activity' => 'Aktivita panela',
        'activity_helper' => 'Administrátorská stránka, ktorá vypisuje každú zaznamenanú udalosť panela, najnovšiu hore, spolu s tým, kto ju vykonal a na ktorom serveri. Len na čítanie - nič nemaže, a ako dlho sa riadky uchovávajú, ďalej rozhoduje nastavenie samotného Pelicanu.',
        'access' => 'Prístup k serverom podľa roly',
        'access_helper' => 'Stránka na zviazanie roly so servermi, udržiavaná v súlade v tabuľke subusers samotného Pelicanu. Nič neprideľuje, kým niečo nepriradíte. Vypnutie zastaví zosúlaďovanie; už pridelený prístup ostáva, a stránka má tlačidlo, ktorým sa dá vziať späť.',
        'scheduled' => 'Štýly podľa času',
        'scheduled_helper' => 'Sekcia na stránke Vzhľad, ktorá panelu dáva iný štýl medzi dvoma hodinami dňa. Nemení nič z uloženého — okno sa položí cez nastavenia vo chvíli, keď sa stránka kreslí, a hneď nato sa pustí — takže vypnutie vráti vlastný vzhľad panela okamžite a nič nestratí.',
        'games' => 'Ďalšie hry',
        'games_helper' => 'Nastavenia sveta ARKu a zoznamy administrátorov, banov a povolených pri Valheime ako formuláre namiesto súborov v správcovi súborov. Ktoré servery ich dostanú, hovorí zoznam eggs na stránke Ďalšie hry.',
        'quick' => 'Ponuka „Prejsť na"',
        'quick_helper' => 'Jeden prvok hore na každej stránke na skok na server alebo na označenú stránku, s vyhľadávacím poľom cez celý váš zoznam serverov. Označuje aj tú stránku, na ktorej práve stojíte. To, čo cez neho niekto nájde, mohol aj tak otvoriť, takže to nič neprideľuje - vypnutie vezme túto skratku a stránku Obľúbené spolu s ňou.',
    ],

    /*
     * Vyhľadávacie pole nad formulármi nastavení. Preosieva to, čo už na stránke
     * v prehliadači je, a servera sa na nič nepýta, takže nie je žiadny stav
     * „hľadám", ktorý by sa dal opísať, ani spôsob, ako by to mohlo zlyhať.
     */
    /*
     * Rámček náhľadu. Všetko v ňom je náhrada, nie vzorka vášho panela, a slová
     * to hovoria - rámček, ktorý by pomenoval skutočný server alebo skutočné
     * číslo, by sa tak aj čítal.
     */
    'preview' => [
        'label' => 'Náhľad',
        'card' => 'Karta',
        'card_helper' => 'Nakreslená tými istými pravidlami ako panel, len s nastaveniami z tejto stránky namiesto uložených.',
        'button' => 'Tlačidlo',
        'field' => 'Pole',
        'meter_ok' => 'V poriadku',
        'meter_warning' => 'Varovanie',
        'meter_danger' => 'Nebezpečenstvo',

        /*
         * Náhľad cez celú stránku. Karta, nie panel, lebo Pelican posiela
         * X-Frame-Options: DENY a odmieta sa nechať vložiť do rámu čímkoľvek,
         * vrátane seba samého - pozri Support\FullPreview.
         */
        'full' => 'Zobraziť celý panel',
        'full_confirm' => 'Otvorí panel nakreslený z nastavení tejto stránky namiesto z uložených. Nič sa nezapisuje — hodnoty sa držia pätnásť minút a panel sa vráti do normálu, keď z náhľadu odídete alebo uložíte.',
        'full_go' => 'Ukázať',
        'full_failed' => 'Náhľad sa nepodarilo spustiť',
        'bar' => 'Pozeráte sa na neuložené nastavenia. Nič z tohto sa nezapísalo.',
        'bar_back' => 'Späť do nastavení',
    ],

    'search' => [
        'placeholder' => 'Hľadať v nastaveniach',
        'label' => 'Hľadať v týchto nastaveniach',
        'none' => 'Na tejto stránke nič nesedí. Nastavenia sú rozložené na štyroch stránkach — skúste Vzhľad, Stránky, Pokročilé alebo Nastavenia Essentials.',
    ],

    'footer' => [
        'text' => 'Váš vlastný riadok',
        'text_helper' => 'Obyčajný text, najviac 120 znakov. Escapuje sa, rovnako ako pás oznamov — toto sa vykresľuje na každej stránke panela, takže je to zlé miesto na prijímanie značiek.',
        'version' => 'Zobraziť verziu panela',
        'version_helper' => 'Verziu Pelicanu, nie tohto pluginu. Plugin svoju vlastnú hlási na nástenke; dole v bočnom paneli ľudia hľadajú odpoveď na to, ktorý panel majú pred sebou.',
        'link_label' => 'Text odkazu',
        'link_url' => 'Adresa odkazu',
        'link_url_helper' => 'Adresa http alebo https, alebo cesta samotného panela, napríklad /account. Otvára sa v novej karte.',
    ],

    'layout' => [
        'label' => 'Rozloženie',
        'helper' => 'Ako je panel usporiadaný, nie akú má farbu. Platí rovnako pre administrátorskú časť, zoznam serverov aj klientsku časť. Kam ide navigácia, je predvolená hodnota: kto si svoju nastavil v Účet → Navigácia, tomu ostane.',
        'default' => 'Bočný panel — vlastný Pelicanu',
        'rail' => 'Lišta ikon — úzka, rozbaľuje sa nabehnutím',
        'top' => 'Navigácia hore — bez bočného panela',
        'mixed' => 'Horný aj bočný — oboje',
        'wide' => 'Široké — obsah zaberá celú obrazovku',
        'focus' => 'Sústredené — úzky stĺpec, bočný panel sa skladá',

        'nav_label' => 'Štýl bočného panela',
        'nav_helper' => 'Ako sa kreslí samotný bočný panel.',
        'nav_default' => 'Predvolený',
        'nav_floating' => 'Plávajúci — vlastná karta',
        'nav_flat' => 'Plochý — bez akéhokoľvek pozadia',
        'nav_bordered' => 'S rámčekom — čiara, nie plocha',

        'topbar_label' => 'Štýl topbaru',
        'topbar_helper' => '„Skryté" platí len na počítači — na telefóne nesie topbar jedinú cestu späť do ponuky.',
        'topbar_default' => 'Predvolený',
        'topbar_floating' => 'Plávajúci — odsadený pás',
        'topbar_flush' => 'Zarovnaný — plochý, bez rozostrenia',
        'topbar_hidden' => 'Skrytý na počítači',

        'card_label' => 'Štýl kariet',
        'card_helper' => 'Sekcie, widgety, karty serverov a bloky nad konzolou.',
        'card_default' => 'Predvolený — nadvihnutá, s mäkkým okrajom',
        'card_flat' => 'Plochá — bez nadvihnutia',
        'card_outline' => 'Obrys — rámček a za ním nič',
        'card_glass' => 'Matná — pozadie presvitá',
        'card_sharp' => 'Ostrá — pravé uhly',
    ],

    'servers' => [
        /*
         * Hviezdička na karte. Odovzdaná skriptu, nie vpísaná doň, aby texty
         * ostali na tom jedinom mieste, kde texty bývajú.
         */
        'favourite' => 'Označiť tento server',
        'favourited' => 'Označené — zobrazuje sa prvé',

        /*
         * Pilulka vedľa vlastných kariet Pelicanu. Pomenovaná podľa toho, čo
         * robí so zoznamom, nie ako štvrtá karta, lebo preosieva tú vybranú
         * namiesto toho, aby ju nahrádzala.
         */
        'favourites_tab' => 'Obľúbené',
        'favourites_empty' => 'Na tejto stránke nie je nič označené. Použite hviezdičku na karte servera, nech niečo pridáte — a všimnite si, že toto preosieva servery, ktoré tu už sú vypísané: označený server na ďalšej stránke sa neschováva, jednoducho na tejto nie je.',
        'favourites_failed' => 'Vaše označené servery sa nepodarilo uložiť, takže sa vrátili k tomu, čo mal panel naposledy. V konzole prehliadača vidno, čo požiadavka odpovedala.',

        'art' => 'Obrázok hry',
        'art_helper' => 'Pelican kreslí obrázok egg na každú kartu. Toto rozhoduje, čo sa s ním urobí.',
        'art_faded' => 'Vyblednutý — závoj za textom',
        'art_cover' => 'Krycí — za menom, stráca sa',
        'art_off' => 'Vypnuté',
        'art_dim' => 'Stmaviť obrázok',
        'art_dim_helper' => 'Obrázok jednej hry je svetlá obloha a inej jaskyňa.',

        'status' => 'Značka stavu',
        'status_helper' => 'Kde sa ukazuje farba beží / spúšťa sa / zastavené.',
        'status_bar' => 'Pás — pozdĺž ľavého okraja',
        'status_edge' => 'Hrana — naprieč vrchom',
        'status_dot' => 'Bodka — v rohu',
        'status_off' => 'Vypnuté',

        'density' => 'Výška kariet',
        'density_comfortable' => 'Pohodlná',
        'density_compact' => 'Kompaktná — keď je serverov veľa',

        'filter_label' => 'Popísať tlačidlo filtra',
        'filter_label_helper' => 'Pelican tento zoznam aj tak preosieva podľa egg a podľa vlastníka, na všetkých stránkach - lenže vstup je nepopísaná ikona vedľa vyhľadávacieho poľa. Toto na ňu dá to slovo.',
        'filter_button' => 'Filtre',

        'columns' => 'Kariet vedľa seba na širokej obrazovke',
        'columns_helper' => 'Platí len pre mriežku, a až od 1280px. Vlastný strop Pelicanu sú dve.',
    ],

    'controls' => [
        'mode' => 'Tlačidlo konzoly na každej stránke servera',
        'mode_helper' => 'Jedno plávajúce tlačidlo, na každej stránke vnútri servera. Otvorí konzolu cez to, čo ste práve robili, so stavom a tlačidlami napájania v hlavičke — dosiahne na uzol rovno, ako to robí zoznam serverov, nie cez websocket stránky konzoly. Na samotnej stránke konzoly sa neobjaví nikdy: tam už toto všetko je.',
        'mode_full' => 'Konzola a tlačidlá napájania',
        'mode_console' => 'Len konzola',
        'mode_off' => 'Vypnuté',

        'label' => 'Na tlačidle je',
        'label_text' => 'Ikona a meno',
        'label_icon' => 'Len ikona',

        'position' => 'Kde pláva',
        'position_helper' => 'Pri tom okraji, ktorý práve najskôr nečítate.',
        'position_top' => 'Hore',
        'position_right' => 'Vpravo',
        'position_bottom' => 'Dole',
    ],

    'console' => [
        'stats' => 'Bloky nad konzolou',
        'stats_helper' => 'Pelican nad terminálom ukazuje meno, stav, adresu a tri čísla využitia. Keď sa skryjú, konzola dostane výšku späť.',
        'stats_tiles' => 'Dlaždice — popis, číslo a ikona',
        'stats_plain' => 'Jednoducho — tak, ako ich kreslí Pelican',
        'stats_off' => 'Skryté',
    ],

    'terminal' => [
        'helper' => 'Odovzdávajú sa samotnému terminálu, takže začnú platiť pri ďalšom načítaní stránky, nie vo chvíli uloženia.',

        'renderer' => 'Kreslí',
        'renderer_helper' => 'Pelican kreslí terminál na GPU, a to je pri stene rolujúceho výstupu oveľa rýchlejšie. Prehliadač drží nažive len niekoľko GPU kontextov naraz — na telefóne menej — a pri prekročení limitu ten najstarší odoberie; terminál potom nekreslí vôbec nič, a to bez jedinej chyby. Keď sa vám konzola vybieli, kým všetko ostatné vyzerá správne, je to toto nastavenie, ktoré sa mení.',
        'renderer_webgl' => 'GPU — vlastný variant Pelicanu, rýchlejší',
        'renderer_dom' => 'Prehliadač — pomalší, kreslí vždy',

        'scheme' => 'Farebná schéma',
        'scheme_helper' => 'Jediné nastavenie terminálu, ktoré Pelican neponúka. „Riadiť sa motívom" odvodzuje farby z akcentu, a práve preto toto vôbec existuje.',
        'scheme_theme' => 'Riadiť sa motívom',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kurzor',
        'cursor_helper' => 'Konzola písanie neprijíma — pole na príkazy je pod ňou — takže toto je miesto, kde sa výstup zastavil, nie miesto, kde ste vy.',
        'cursor_underline' => 'Podčiarknutie — vlastný variant Pelicanu',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Čiarka',

        'blink' => 'Blikajúci kurzor',

        'scrollback' => 'História rolovania',
        'scrollback_helper' => 'Ako ďaleko späť sa dá v konzole rolovať. Každý riadok sa drží v prehliadači, takže ukecaný server pri vysokom nastavení je naozajstná pamäť na tom stroji, ktorý to číta.',
        'scrollback_lines' => 'riadkov: :lines',
    ],

    'notice' => [
        'text' => 'Správa',
        'text_helper' => 'Jeden riadok, až 200 znakov. Escapuje sa na vstupe aj na výstupe, takže nemôže zaniesť značky na stránku, ktorú načítavajú iní ľudia.',
        'style' => 'Tón',
        'style_info' => 'Informácia',
        'style_warning' => 'Varovanie',
        'style_danger' => 'Naliehavé',
        'style_accent' => 'Akcentná farba',
        'scope' => 'Zobraziť',
        'scope_all' => 'Všetkým',
        'scope_client' => 'Len mimo administrátorskej časti',
        'scope_admin' => 'Len v administrátorskej časti',
        'link_label' => 'Text tlačidla',
        'link_url' => 'Adresa tlačidla',
        'link_url_helper' => 'https:// alebo cesta vnútri tohto panela, napríklad /account. Všetko ostatné sa ignoruje — odkaz v páse, ktorý je na každej stránke, nie je miesto pre schému, ktorú nikto nečaká.',
        'dismissible' => 'Dá sa zavrieť',
        'dismissible_helper' => 'Že sa zavrela, si pamätá každý prehliadač zvlášť, a len pre túto správu: zmeňte text a vráti sa všetkým.',
        'dismiss' => 'Zavrieť',
    ],

    'preset' => [
        'label' => 'Štýl',
        'helper' => 'Vyberte vzhľad, od ktorého začať. Vyplní všetko nižšie, čo potom môžete meniť. „Žiadny" motív vypne a nechá panel presne taký, aký ho Pelican dodáva.',
        'options' => [
            'none' => 'Žiadny - bez motívu',
            'legend' => 'Legend - červený oheň prechádzajúci v modrý blesk',
            'ember' => 'Ember - teplá čierna, oranžový akcent',
            'midnight' => 'Midnight - hlboká modrá, pokojná',
            'crimson' => 'Crimson - červená, ostré rohy, kompaktné',
            'forest' => 'Forest - zelená, zaguľatená, bez žiary',
            'nebula' => 'Nebula - fialová s prechodovým pozadím',
            'terminal' => 'Terminal - zelená na čiernej, neproporcionálne, ostro',
            'console' => 'Console - okrúhle a priestranné, na tablet',
            'nord' => 'Nord - paleta Nord, tlmená',
            'solarized' => 'Solarized - Solarized dark, azúrový akcent',
            'paper' => 'Paper - svetlý, silný kontrast, plochý',
            'daylight' => 'Daylight - svetlý a teplý, s mäkkým závojom',
            'mono' => 'Mono - odtiene sivej, ploché a husté',
        ],

        'save' => 'Uložiť ako štýl',
        'save_confirm' => 'Nechá si farby, rohy, pozadie, písmo, ikony a prahy ukazovateľov, ktoré máte práve teraz na obrazovke — pod vlastným menom, vo výbere vedľa vstavaných. Ukladá to, čo je na stránke, nie to, čo sa uložilo naposledy.',
        'save_name' => 'Názov',
        'save_name_helper' => 'Ako sa bude vo výbere volať. Uloženie pod už použitým menom ten štýl nahradí.',
        'saved' => 'Štýl uložený',
        'save_failed' => 'Tento štýl sa nepodarilo uložiť',
        'save_full' => 'Miesta je na vlastných štýlov: :max. Najprv jeden zmažte.',

        'delete' => 'Zmazať štýl',
        'delete_which' => 'Ktorý',
        'delete_confirm' => 'Zmazať sa dajú len vlastné štýly; vstavané nie. Na súčasnom vzhľade panela sa nič nemení — štýl je východiskový bod a každá hodnota, ktorú nastavil, už je v nastaveniach nižšie.',
        'deleted' => 'Štýl zmazaný',
        'deleted_current' => 'To bol ten, na ktorý bol tento panel nastavený. Jeho nastavenia sú nezmenené a stále sú na tejto stránke — vyberte štýl, alebo ich uložte znova pod menom.',
    ],

    'user_themes' => [
        'label' => 'Štýly, ktoré si ľudia môžu vybrať pre seba',
        'helper' => 'Zaškrtnuté štýly sa objavia na stránke Vzhľad v klientskej časti, kde si každý prihlásený môže jeden vybrať pre seba. Mení to, čo vidí on, a pre ostatných nič. Nič zaškrtnuté znamená, že si nikto nič nevyberá a panel drží jeden vzhľad — čo je to, čo robí teraz.',
    ],

    'mode' => [
        'label' => 'Režim panela',
        'helper' => 'V akom režime sa panel otvára. Kto si nevybral sám, dostane tento; prepínač v používateľskej ponuke mu stále dovolí to zmeniť, ak to nižšie nezamknete.',
        'dark' => 'Tmavý',
        'light' => 'Svetlý',
        'system' => 'Systémový — riadiť sa nastavením návštevníka',
    ],

    'font' => [
        'label' => 'Písmo panela',
        'helper' => 'Každá možnosť je rodina, ktorú operačný systém už má — od poskytovateľa písem sa nič nesťahuje. Terminálu sa to netýka: jeho písmo je voľba každého, v Účte.',
        'default' => 'Predvolené - vlastné Pelicanu',
        'mono' => 'Neproporcionálne',
        'rounded' => 'Zaguľatené',
        'serif' => 'Pätkové',
        'system' => 'Systémové - to, ktoré používa tento stroj',
    ],

    'surface' => [
        'label' => 'Farba plôch',
        'helper' => 'Karty a panely. Svetlejšie a tmavšie odtiene sa z nej odvodzujú.',
        'placeholder' => 'Riadiť sa motívom',
    ],

    'radius' => [
        'label' => 'Rohy',
    ],

    'accent' => [
        'label' => 'Akcentná farba',
        'helper' => 'Používa sa pri tlačidlách, odkazoch, aktívnej položke navigácie a prstencoch fokusu.',

        /*
         * Povedané, nie vynútené. Farba, pred ktorou toto varuje, sa aj tak
         * uloží: je to niečí panel, číslo meria jednu vec a sú dobré dôvody
         * chcieť akcent, ktorý dopadne zle. Výber povie, čo vidí, a ide z cesty.
         */
        'contrast_dark' => 'Čitateľnosť: :ratio na tmavom paneli. Pod 3 sa akcent zle číta ako tlačidlo alebo odkaz — svetlejší ho zdvihne.',
        'contrast_light' => 'Čitateľnosť: :ratio na svetlom paneli. Pod 3 sa akcent zle číta ako tlačidlo alebo odkaz — tmavší ho zdvihne.',
    ],
    'density' => [
        'label' => 'Hustota',
        'helper' => 'Kompaktná stiahne rozostupy, nech sa na obrazovku zmestí viac riadkov.',
        'comfortable' => 'Pohodlná',
        'compact' => 'Kompaktná',
    ],
    'force_dark' => [
        'label' => 'Vynútiť tmavý režim',
        'helper' => 'Skryje prepínač svetlý/tmavý a drží všetkých používateľov na tmavom motíve.',
    ],
    'glass' => [
        'label' => 'Matný topbar',
        'helper' => 'Rozostrí topbar a pozadia modálnych okien. Na slabších zariadeniach vypnite.',
    ],
    'glow' => [
        'label' => 'Akcentná žiara',
        'helper' => 'Mäkký akcentný tieň na hlavných tlačidlách, aktívnej navigácii a prihlasovacej karte.',
    ],

    'background' => [
        'label' => 'Typ pozadia',
        'helper' => 'Aurora je vlastné pozadie motívu: akcentné žiary s jemným zrnom.',
        'aurora' => 'Aurora (predvolené)',
        'solid' => 'Jedna farba',
        'gradient' => 'Prechod',
        'image' => 'Obrázok',
        'color' => 'Farba',
        'base' => 'Farba pod žiarami',
        'base_helper' => 'To, na čom stránka leží, kým sa cez ňu namaľujú akcentné žiary. Nechajte prázdne, nech ostane predvolená hodnota panela, takmer čierna v tmavom a takmer biela vo svetlom. Nastavte ju a schéma si nechá vlastnú nočnú farbu a aj tak bude nasvietená.',
        'color_end' => 'Druhá farba',
        'angle' => 'Smer',
        'upload' => 'Nahrať obrázok',
        'upload_helper' => 'Až 8 MB. Nahraný obrázok má prednosť pred adresou nižšie.',
        'url' => 'Alebo adresa URL',
        'url_helper' => 'Musí začínať https:// a byť dostupná zvonka.',
        'dim' => 'Stmavenie',
        'dim_helper' => 'Bez stmavenia sa biely text na svetlej fotke nedá čítať.',
        'blur' => 'Rozostrenie',
    ],

    'channel' => [
        'installed' => 'nainštalovaná',
        'version' => 'Nainštalovať konkrétnu verziu',
        'version_helper' => 'Akékoľvek vydanie tohto kanála, nie len to najnovšie — na vrátenie sa späť, keď sa nové ukáže horšie, alebo dopredu na build, ktorý vám odporučili skúsiť. Len kým sa aktualizácie neinštalujú samy: so zapnutým týmto by vybrané vydržalo do ďalšej kontroly.',
        'version_placeholder' => 'Vyberte verziu',
        'version_install' => 'Nainštalovať túto verziu',
        'version_confirm' => 'Panel stiahne to vydanie, prestavia svoje assets a vyprázdni cache. Vaše nastavenia ostávajú. Vrátiť sa k staršej verzii je dovolené a samo sa to nevracia späť — vyberte tú novšiu znova, nech sa pohnete dopredu.',
        'label' => 'Kanál aktualizácií',
        'helper' => 'Ktoré vydania stránka motívu ponúka. Beta dostáva nové verzie prvá, a ostré hrany tiež prvá.',
        'stable' => 'Stabilný',
        'beta' => 'Beta',
        'dev' => 'Dev (pracovná vetva)',
        'auto' => [
            'label' => 'Inštalovať aktualizácie automaticky',
            'helper' => 'Vypnuté necháva aktualizovanie na vás. Zapnuté — panel kontroluje vybraný kanál a inštaluje všetko novšie; pritom prestavia svoje assets a je pár minút nedostupný, preto denné a týždenné ide o 04:00. Potrebuje bežiaci cron panela.',
            'interval' => 'Kontrolovať každých',
            'minute' => 'Každú minútu',
            'five_minutes' => 'Každých 5 minút',
            'ten_minutes' => 'Každých 10 minút',
            'thirty_minutes' => 'Každých 30 minút',
            'hourly' => 'Každú hodinu',
            'daily' => 'Každý deň (04:00)',
            'weekly' => 'Každý týždeň (pondelok 04:00)',
        ],
    ],

    /*
     * Karta Jazyky.
     *
     * Opatrná v tom, čo tvrdí. Pelican už každému dovoľuje vybrať jazyk pre celý
     * účet a už ho uplatňuje; nič tu to nemení ani by nemalo. Tu sa rozhoduje
     * len o tom, či tento výber sledujú vlastné texty tohto pluginu.
     */
    'languages' => [
        'section_helper' => 'Pelican už každému dovoľuje vybrať jazyk pre jeho účet a tento plugin ho sleduje všade, kde je preložený. Tu rozhodujete, ktoré z nich poslúchne. Väčšina jazykov stojí na nízkom percente naschvál: prvá sa prekladá tá časť, ktorú každý vidí na každej stránke — tlačidlá napájania nad konzolou a ukazovatele uzlov — a zvyšok prichádza, ako ho ľudia dopisujú.',
        'panel' => 'Nechať toto rozhodovať o jazyku celého panela',
        'panel_helper' => 'Zapnuté — jazyk, ktorý tento plugin nenesie, alebo vypnutý nižšie, prepne pre toho čitateľa do angličtiny celý panel, nie len tieto stránky. Vypnuté — zoznam sleduje len tento plugin a Pelican ďalej hovorí tým, čo je nastavené na účte, čo znamená, že čitateľ môže na jednej obrazovke stretnúť dva jazyky. Žiadny účet sa tak ani tak nemení: zapnite jazyk späť a zase ho má.',
        'label' => 'Jazyky, ktorými odpovedať',
        'helper' => 'Odškrtnutie pošle späť k angličtine — len pre tento plugin — tých čitateľov, ktorí ho majú nastavený na účte; zvyšok panela ďalej hovorí ich jazykom. Angličtina v zozname nie je, lebo všetko padá na ňu.',
        'under' => 'neponúka sa, kým nepostúpi ďalej — zaškrtnite, nech sa ponúka aj tak',
        'done' => 'preložené na :percent %',
        'main' => 'Hlavný jazyk',
        'main_helper' => 'To, čo čitateľ dostane, keď sa jeho vlastný jazyk použiť nedá — buď ho tento plugin nenesie, alebo je nižšie odškrtnutý. Vždy to bola angličtina; v tíme, ktorý v angličtine nepracuje, to bola zlá odpoveď podaná s istotou. Nižšie sa odškrtnúť nedá, lebo všetko padá na ňu.',
        'labels' => 'Ako sa ktorý jazyk volá',
        'labels_helper' => 'Meno, ktoré čitatelia a administrátori vidia vo výberoch. Nechajte jedno prázdne, nech ostane meno, pod ktorým ho tento plugin pozná. Jazyk nahraný pod vlastným menom žiadne nemá, takže by sa vypisoval svojím kódom, kým mu tu meno nedáte.',
        'labels_code' => 'Kód',
        'labels_name' => 'Zobrazovať ako',
        'download' => 'Stiahnuť súbor s prekladom',
        'download_from' => 'Vyjsť z',
        'download_from_helper' => 'JSON so všetkými textami tohto pluginu. Vezmite angličtinu pre jazyk, ktorý nikto nezačal, alebo existujúci, nech nadviažete na to, čo už je preložené.',
        'code' => 'Kód jazyka',
        'code_helper' => 'Kód, ku ktorému súbor patrí. Skutočná locale tak, ako ju používajú účty — fr, de, pt_BR — dôjde k čitateľom, ktorí ju majú nastavenú, a musí sedieť presne, inak nedôjde. Vlastné meno, napríklad Gaming-SK, je dovolené a funguje inak: Pelican nechá účet držať len skutočnú locale, takže to vaše si nikto nevyberie. Dostupné je ako hlavný jazyk vyššie, čo je to, čo dostane každý, ktorého jazyk sa použiť nedá.',
        'url' => 'Alebo ho stiahnuť z adresy',
        'url_helper' => 'Adresa https, na ktorú panel dosiahne — CDN, bucket, holý súbor v repozitári. Stiahne sa raz pri uložení a zapíše sa rovnako ako nahraný, takže zmeniť súbor na tej adrese neskôr nič nerobí, kým znova neuložíte. Súbor vybraný vyššie vyhráva nad adresou ponechanou v tomto poli.',
        'upload' => 'Nahrať súbor s prekladom',
        'upload_helper' => 'Ten JSON zhora, s preloženými hodnotami. Zapisuje sa mimo pluginu, takže ho aktualizácia nezahodí, a zlieva sa cez angličtinu kľúč po kľúči — súbor s polovicou textov vám dá polovičný jazyk a angličtinu na zvyšok.',
        'uploaded' => 'Nainštalovaných textov pre :code: :count',
        'uploaded_halves' => 'Z toho :mine sú vlastné texty tohto pluginu a :panel patria panelu. Nula na jednej zo strán znamená, že tá polovica súboru nič neobsahovala — kľúče pluginu začínajú na essentials:: a kľúče panela nie.',
        'uploaded_skipped' => 'Preskočených :count: prázdne alebo kľúče, ktoré tento plugin nemá. Prvé z nich: :keys',
        'upload_failed' => 'Tento súbor sa nepodarilo prečítať',
        'upload_failed_body' => 'Musí to byť ten JSON zo stiahnutia vyššie — plochý objekt kľúčov a textov. Skontrolujte, že ho editor neuložil ako niečo iné.',
    ],

    'windows' => [
        'add' => 'Pridať okno',
        'from' => 'Od',
        'to' => 'Do',
        'to_helper' => 'Skôr než začiatok znamená, že to prechádza cez polnoc — od 22:00 do 06:00 je noc.',
        'preset' => 'Štýl',
        'days' => 'Dni',
        'days_helper' => 'Nechajte ich všetky nezaškrtnuté, nech to platí každý deň. Okno prechádzajúce cez polnoc patrí tomu dňu, ktorým začína, takže piatok od 22:00 do 06:00 pokrýva sobotné ráno.',
        'day_mon' => 'Pondelok',
        'day_tue' => 'Utorok',
        'day_wed' => 'Streda',
        'day_thu' => 'Štvrtok',
        'day_fri' => 'Piatok',
        'day_sat' => 'Sobota',
        'day_sun' => 'Nedeľa',
    ],

    'arranger' => [
        'label' => 'Usporiadanie stránok',
        'helper' => 'Tlačidlo „Usporiadať stránku", na každej stránke panela. Kto má oprávnenie Usporiadať, ten ho dostane a môže navyše nastaviť usporiadanie, od ktorého začínajú všetci ostatní, alebo usporiadanie pre rolu. Vypnuté ho skryje všetkým; už uložené usporiadania ostávajú na mieste.',
        'roles' => 'Usporiadanie nie je oprávnenie. Blok, ktorý rola skryje, ostáva blokom, na ktorý by sa niekto dostal napísaním adresy — tomu bránia vlastné oprávnenia Pelicanu, na stránke rolí. Vrstvia sa tri vrstvy v tomto poradí: spoločná východisková, potom rola čitateľa, potom to, čo si posunul sám.',
        'users' => 'Nechať každého usporiadať si vlastné stránky',
        'users_helper' => 'Zapnuté — každý prihlásený smie preskladať a skrývať bloky na stránkach, ktoré aj tak vidí, len pre seba; pre nikoho iného to nič nemení. Nastavenie spoločného východiskového usporiadania ostáva pri oprávnení Usporiadať.',
    ],

    'brand' => [
        'logo_height' => 'Výška loga',
        'logo_height_helper' => 'Pelican dodáva 2rem. Väčšie hodnoty dvíhajú spolu s ním aj hlavičku bočného panela.',
        'logo_url' => 'Nahradiť logo',
        'logo_url_helper' => 'Nechajte prázdne, nech ostane to, na čo mieria vlastné nastavenia Pelicanu.',
    ],

    'login' => [
        'image' => 'Obrázok na pozadí',
        'image_helper' => 'Len pre prihlasovaciu obrazovku. Bez neho ďalej ukazuje pozadie panela.',
        'url' => 'Alebo adresa URL',
        'blur' => 'Rozostrenie karty',
        'blur_helper' => 'Zmatní kartu, nech obrázok za ňou presvitá.',
        'width' => 'Šírka karty',
        'position' => 'Výrez obrázka',
        'position_helper' => 'Ktorá časť obrázka prežije orez na obrazovku.',
        'position_center' => 'Stred',
        'position_top' => 'Hore',
        'position_bottom' => 'Dole',
        'position_left' => 'Vľavo',
        'position_right' => 'Vpravo',
        'align' => 'Umiestnenie karty',
        'align_helper' => 'Kde prihlasovacia karta stojí naprieč obrazovkou.',
        'align_center' => 'Stred',
        'align_start' => 'Vľavo',
        'align_end' => 'Vpravo',
        'opacity' => 'Krytie karty',
        'opacity_helper' => 'Nižšie púšťa kartou viac obrázka.',
        'glow' => 'Akcentná žiara',
        'glow_helper' => 'Svätožiara okolo karty. Vypnuté jej necháva okraj aj hĺbku.',
        'hide_heading' => 'Skryť nadpis',
        'hide_heading_helper' => 'Odoberie nadpis nad formulárom a nechá formulár samotný.',
        'hide_footer' => 'Skryť pätu',
        'hide_footer_helper' => 'Odoberie riadok pod kartou, ktorý vedie na pelican.dev.',
        'above' => 'Riadok nad formulárom',
        'above_helper' => 'Jeden riadok, ukázaný každému, kto dorazí na prihlasovaciu obrazovku. Nechajte prázdne, nech tam žiadny nie je.',
        'notice' => 'Hláška pod kartou',
        'notice_helper' => 'Jeden riadok, ukázaný každému, kto dorazí na prihlasovaciu obrazovku. Nechajte prázdne, nech tam žiadna nie je.',
    ],

    'advanced' => [
        'css' => 'Vlastné CSS',
        'css_helper' => 'Až 100 KB. Ukladá sa do storage, nie do .env.',
        'reference' => 'Prehľad CSS',
        'reference_helper' => 'Každá premenná a každá trieda, ktoré tento motív a panel sprístupňujú.',
    ],

    'areas' => [
        'add' => 'Pridať oblasť',
        'area' => 'Oblasť',
        'inherit' => 'Všeobecné',
        'radius' => 'Rohy',
        'radius_sharp' => 'Ostré',
        'radius_normal' => 'Normálne',
        'radius_round' => 'Zaguľatené',
        'surface' => 'Farba plôch',
        'surface_helper' => 'Karty a panely vnútri tejto oblasti; svetlejšie a tmavšie odtiene sa z nej odvodzujú.',
        'names' => [
            'terminal' => 'Terminál',
            'console' => 'Konzola (zvyšok stránky)',
            'files' => 'Stránka súborov',
            'edit' => 'Stránka úprav',
            'server' => 'Ostatné stránky a karty servera',
        ],
    ],

    'bars' => [
        'base' => 'Základná farba',
        'base_green' => 'Zelená',
        'base_accent' => 'Akcentná farba',
        'warning' => 'Jantárová od',
        'danger' => 'Červená od',
    ],

    'icons' => [
        'stroke' => 'Hrúbka čiary',
        'stroke_thin' => 'Tenká',
        'stroke_normal' => 'Normálna',
        'stroke_bold' => 'Silná',
        'scale' => 'Veľkosť',
        'accent' => 'Ikony ponuky v akcentnej farbe',
        'accent_helper' => 'Týka sa ikon v bočnom paneli a v topbare.',
        'pack' => 'Balíček ikon',
        'pack_helper' => 'Z ktorej sady čerpá výber nižšie. Ponúka sa každá sada ikon nainštalovaná na serveri, k tomu sada Essentials, ktorá prichádza s týmto pluginom, a akýkoľvek balíček, ktorý nahráte. Jeden rozdiel stojí za to vedieť: čiarová ikona sa kreslí farbou ponuky a ide za nabehnutím aj aktívnou položkou, kým ikony Essentials sú obrázky a držia si vlastné farby. Rozhoduje o tom, čím súbor je, nie to, z ktorej sady prišiel.',
        'pack_custom' => 'Nahraný balíček',
        'pack_shipped' => 'Ikony Essentials',
        'use_shipped' => 'Použiť ikony Essentials všade',
        'use_shipped_confirm' => 'Nastaví balíček na ikony Essentials a vyplní každú položku ponuky nižšie tou ikonou, ktorá je pre ňu nakreslená — konzola dostane terminál, spustenie dostane tlačidlo štartu a tak ďalej. Nahradí to položky, ktoré máte teraz, a nič sa neukladá, kým nestlačíte Uložiť, takže zavrieť stránku to vráti.',
        'pack_upload' => 'Nahrať balíček',
        'pack_upload_helper' => 'Archív .zip so súbormi SVG. Každý súbor sa stane ikonou pomenovanou po ňom — logo.svg sa stane custom-logo. Nahranie nahradí balíček, ktorý je tam teraz. Súbory nad 256 KB a všetko nad 4 000 ikon ostane vonku a dozviete sa koľko: pre mierku, celá sada Tabler je takmer šesťtisíc ikon zhruba v troch megabajtoch, takže balíček výrazne väčší nesie niečo iné než ikony a väčšina sa preskočí. Veľké nahranie môže byť odmietnuté ešte skôr, než toto pole čokoľvek povie — hodnotami upload_max_filesize a post_max_size v php.ini hostiteľa panela, a žiadne nastavenie odtiaľto ich nezvýši.',
        'pack_partial' => 'Nainštalovaných ikon: :count, ale nie všetky',
        'pack_partial_body' => 'Preskočené: :big priveľké na ikonu, :unusable nepoužiteľné ako SVG, :duplicate s menom, ktoré je už zabraté, :empty po vyčistení nie je čo kresliť. SVG nad 256 KB je takmer vždy obrázok zabalený do SVG, nie kresba — vyexportujte ho vo veľkosti ikony a bude mať pár kilobajtov. Ikona, pri ktorej nie je čo kresliť, obsahovala len niečo, čo sa tu nepodáva — ak je to celý balíček, stojí za to to nahlásiť.',
        'pack_stopped_files' => 'Zastavilo sa to aj na limite, koľko ikon smie balíček obsahovať.',
        'pack_stopped_size' => 'Zastavilo sa to aj preto, že zvyšok balíčka po rozbalení presahuje to, čo panel udrží naraz v pamäti — samotný zip môže byť menší, lebo SVG sa komprimuje zhruba päť k jednej.',
        'overrides' => 'Nahradiť ikony',
        'overrides_helper' => 'Jeden riadok na každú ikonu, ktorú chcete zmeniť. Vyberte položku ponuky, potom vezmite ikonu z balíčka vyššie, zadajte adresu, alebo nahrajte vlastný obrázok. Keď je vyplnené viac než jedno, vyhráva nahranie, potom adresa, potom balíček.',
        'overrides_key' => 'Položka ponuky',
        'overrides_value' => 'Ikona z balíčka',
        'overrides_url' => 'Alebo adresa',
        'overrides_url_helper' => 'Adresa https obrázka, ktorý hostujete sami — CDN, bucket, kamkoľvek prehliadač dosiahne. Do panela sa nič nekopíruje, takže vymeniť súbor na tej adrese zmení ikonu bez toho, aby sa siahlo na túto stránku; rub toho je, že ikona zmizne, len čo zmizne adresa. Drží si vlastné farby, ako nahraný obrázok.',
        'overrides_file' => 'Alebo nahrať obrázok',
        /*
         * Hovorí, v čom ten rozdiel naozaj je, lebo zjavný nie je a práve preň
         * si človek vyberie jedno namiesto druhého.
         */
        'overrides_file_helper' => 'PNG, SVG alebo ICO. Ikona z balíčka sa kreslí farbou ponuky a ide za nabehnutím aj aktívnou položkou; nahraný obrázok si drží vlastné farby a to nerobí. Pri logu sa obyčajne chce práve toto.',
        'overrides_add' => 'Nahradiť ďalšiu ikonu',
        'overrides_search' => 'Napíšte názov alebo položku ponuky…',
    ],

    /*
     * Nie pod „Značkou". Značka je o tom, ako panel vyzerá; toto je o tom, ako
     * sa v ňom objavuje tento plugin, čo je iná otázka a odpovedá na ňu iná
     * stránka.
     */
    'identity' => [
        'nav_icon' => 'Ikona pre položku „Nastavenia Essentials"',
        'nav_icon_helper' => 'PNG, SVG alebo ICO, až 8 MB. Nahradí ikonu tej jednej položky v bočnom paneli; nechajte prázdne, nech sa vezme tá, ktorú plugin prináša so sebou. Kreslí sa ako obrázok, nie ako ikona, takže si drží vlastné farby namiesto toho, aby išla za textom — a to logo obyčajne chce. Súbor sa podáva, nie vkladá, takže si ho každý prehliadač stiahne raz, ale aj tak stojí za to vyexportovať niečo malé: pre položku vysokú dvadsať pixelov pár kilobajtov bohato stačí. Ak nahranie spadne skôr, než toto pole čokoľvek povie, limit, o ktorý narazilo, je upload_max_filesize v php.ini panela.',
    ],
];
