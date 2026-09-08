<?php

/*
 * Magyar. Kézzel írva.
 *
 * Az „egg”, „node”, „subuser”, „Wings”, „queue”, „webhook”, „topbar”, „cron” és
 * a fájlformátumok nevei úgy maradnak, ahogy vannak: ezekkel a nevekkel találja
 * meg őket az ember a Pelicanban, a gazdagépen és mindenben, amit róluk írnak.
 * A stílusok nevét sem fordítjuk — egy stílus annak hívják, aminek hívják, és
 * egy lefordított név csak egy második név lenne ugyanarra.
 */

return [
    'css_warning' => 'Mentve, de ez a CSS hibásnak tűnik',
    'css_unclosed' => 'A(z) :line. sorban megnyitott szabály soha nem záródik le. Minden utána azon a szabályon belül van, és semmilyen hatása nincs.',
    'css_extra' => 'A(z) :line. sorban záró kapcsos zárójel áll anélkül, hogy bármi nyitva lenne. Minden utána minden szabályon kívül esik, és kimarad.',
    'css_comment' => 'A(z) :line. sorban megnyitott megjegyzés soha nem záródik le, így a fájl többi része azon belül van.',

    'groups' => [
        'appearance' => 'Megjelenés',
        'servers' => 'Szerverlista',
        'windows' => 'Stílusok idő szerint',
        'windows_helper' => 'Más stílus a nap két időpontja között. Semmi sem történik, amíg nem veszel fel egyet. Az óra a panel sajátja, az időzóna-beállításából, nem az egyes olvasóké — egy panel, amely ugyanabban a pillanatban két embernek másképp néz ki, inkább tűnne elromlottnak, mint szándékosnak. Egy ablak azt a megjelenést módosítja, amely a panelnek már megvan, tehát semmit sem tesz, amíg a stílus „Nincs” állásban van. Egy stílus, amelyet valaki magának választott, továbbra is felülírja.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Nyelvek',
        'servers_helper' => 'Hogyan rajzolódik ki egy szerverkártya. Az, hogy rácsként vagy listaként jelennek-e meg, mindenkinek a saját döntése a Fiók → Áttekintő elrendezése alatt.',
        'server_pages' => 'Szerveroldalak',
        'server_pages_helper' => 'Mit hordoz minden oldal egy szerveren belül, bármelyik oldalról is legyen szó.',
        'console' => 'Konzololdal',
        'console_helper' => 'A terminál saját betűtípusa, mérete és magassága mindenkinek a saját döntése a Fiók alatt.',
        'background' => 'Háttér',
        'background_helper' => 'Az egész panelre vonatkozik, a bejelentkezési képernyőre is.',
        'icons' => 'Ikonok',
        'bars' => 'Erőforrásmérők',
        'bars_helper' => 'A processzor, a memória és a lemez csíkjai a szerverkártyákon.',
        'updates' => 'Frissítések',
        'updates_helper' => 'Mely kiadásokat kínálja a Téma oldal, és hol keresi őket.',
        'brand' => 'Márka',
        'login' => 'Bejelentkezési képernyő',
        'login_helper' => 'A bejelentkezés, a jelszó-visszaállítás és a kétlépcsős azonosítás képernyőire vonatkozik.',
        'advanced' => 'Saját CSS',
        'advanced_helper' => 'Mindenre, amit a fenti beállítások nem fednek le. Minden más után töltődik be, tehát ő nyer.',
        'areas' => 'Területenként',
        'areas_helper' => 'Minden fenti mindenütt érvényes. Itt egy területet külön kezelhetsz; minden, amit üresen hagysz, továbbra is a közös beállítást követi.',
        'footer' => 'Az oldalsáv alja',
        'footer_helper' => 'Az oldalsáv alja, amelyet a Pelican üresen hagy. Itt minden ki van kapcsolva, amíg ki nem töltöd.',
        'features' => 'Mit ad hozzá ez a bővítmény',
        'features_helper' => 'Ha kiveszed a pipát valami mellől, teljesen eltűnik a panelről. A beállításai megmaradnak, és az oldala megtartja a címét, tehát semmi sem vész el azzal, hogy kikapcsolsz valamit, hogy lásd, mit csinált. A legtöbbnek saját jogosultsága is van a Szerepkörök alatt, tehát egyet oda lehet adni a többi nélkül. Nem mindnek: az erőforrásmérők, az oldalsáv alja és a beállítások keresője mindenkinek kirajzolódik, és senki sem vezérli őket, egy szerverkártya csillaga azé, aki rákattintott, a szerveren belüli Palworld- és Minecraft-oldalak pedig annak a szervernek a saját jogosultságait követik, nem ezek egyikét. Maga a megjelenés nincs a listán — annak saját kapcsolója van, a Look → Megjelenés → Stílus → Nincs alatt.',
        'identity' => 'Ez a bővítmény az oldalsávban',
        'identity_helper' => 'Az a sor, amelyet ez a bővítmény az oldalsávhoz ad, és a rajta lévő kép.',
    ],

    /*
     * A beállításoldalak, mindegyik egy sor a bővítmény saját csoportjában az
     * oldalsávban. Aszerint csoportosítva, milyen kérdésre válaszolsz, nem
     * aszerint, melyik osztály hozza létre őket.
     */
    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Szín, forma, és hogy hívják a panelt.',
        'pages' => 'Oldalak',
        'pages_helper' => 'A szerverlista, a szerveren belüli oldalak, és a terminál.',
        'advanced' => 'Haladó',
        'advanced_helper' => 'A két vészkijárat: a saját CSS-ed, és azok a beállítások, amelyek csak egy területre vonatkoznak.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Mely eggek a Minecraft, és minden más ezzel kapcsolatban.',
        'artwork' => 'Egg-képek',
        'artwork_helper' => 'Egy oldal minden egyes eggel, és egy mód arra, hogy letöltsd hozzá a játék képét a Steamről vagy az IGDB-ről. Magukba az eggekbe ír — a képet, és két címkét, amelyek feljegyzik, melyik játékról van szó, és hogy kézzel választották-e a képet — és ezért van saját jogosultsága.',
        'alerts' => 'Riasztások',
        'alerts_helper' => 'Rendszeres ellenőrzése annak, amit a panel amúgy is mér, de senkinek sem mond el: egy node, amely felhagy a válaszolással, egy telítődő lemez, egy megállt queue worker, egy lemaradt verzió. Discordra, a panelre vagy e-mailben küld. Saját jogosultsága van, mert rendszeresen eléri minden node-ot, és olyan címre küld, amelyet valaki beírt.',
        'backups' => 'Mentések áttekintése',
        'backups_helper' => 'Egy oldal minden egyes szerverrel, és azzal, mióta van mentés nélkül, úgy rendezve, hogy a mentés nélküliek legyenek felül. Csak olvasás — minden, ami tesz valamit egy mentéssel, a Pelican saját oldalán marad annál a szervernél. Saját jogosultsága van, mert a lista térkép arról, hol vannak a lyukak.',
        'public_status' => 'Nyilvános állapotoldal',
        'public_status_helper' => 'Egy oldal, amelyet bárki megnyithat fiók nélkül, és amely megmutatja, mely szervereid futnak, és hányan vannak rajtuk. Semmi sem kerül nyilvánosságra, amíg nem említesz meg egy szervert, egy gépet vagy egy szolgáltatást — mind a három lista üresen indul, és amíg így van, a cím 404-gyel felel. Saját jogosultsága van, mert ez dönti el, mi hagyja el a panelt.',
        'game_players' => 'Játékosok, más játékok',
        'capacity' => 'Kapacitás',
        'capacity_helper' => 'Mennyi van ígérve az egyes gépeken ahhoz képest, amennyit kioszthatnak, hogy lásd, elfér-e még egy szerver. A Pelican node-listája egy nevet és egy szerverszámot mutat, az áttekintő Gépek blokkja pedig azt, mi fut - ez a harmadik kérdés, és a számolás a Pelican sajátja. Csak olvasás. Saját jogosultsága van.',
        'schedules' => 'Ütemezett feladatok',
        'schedules_helper' => 'A panel minden egyes ütemezett feladata, azzal együtt, melyik állt meg: beragadt egy futás közepén, késésben van, mert a cron nem fut, vagy soha nem futott. A Pelican az ütemezéseket az egyes szervereken belül mutatja, és a saját állapotának egyik esetre sincs szava. Csak olvasás. Saját jogosultsága van.',
        'activity' => 'Tevékenység',
        'activity_helper' => 'A panel minden egyes naplózott eseménye, egy listában, nem egy szerver egyszerre. A Pelican vezeti a naplót, és szerverenként mutatja; ez ugyanazt a naplót kérdezi a másik irányból. Csak olvasás. Saját jogosultsága van, mert egy áttekintés arról, ki mit tett, olyasmi, amit szándékosan ad ki az ember.',
        'access' => 'Szerverhozzáférés',
        'access_helper' => 'Köss egy szerepkört szerverekhez, hogy minden birtokosa elérje őket. Úgy működik, hogy naprakészen tartja a Pelican saját subusereit, és pontosan azokat olvassa a szerverlista és minden jogosultságellenőrzés is. Saját jogosultsága van, mert ez az egyetlen oldal itt, amely hozzáférést ad az embereknek valamihez.',
        'games' => 'Más játékok',
        'games_helper' => 'Azok a fájlok, amelyeket az ARK és a Valheim a világuk mellett tartanak, űrlapként: az ARK világbeállításai, és a Valheim listái az adminokról, a bannoltakról és az engedélyezettekről. Az, hogy mely szerverek kapják meg őket, az adott oldal egg-listája, tehát egy üres lista már játékonkénti kapcsoló.',
        'game_players_helper' => 'Egy oldal a Ruston, az ARK-on, a Valheimen és minden máson belül, ami válaszol a Valve lekérdezésére, amely megmutatja, ki van csatlakozva, és mióta van fent. Csak olvasás — az, hogy mit lehet valakivel tenni, játékonként eltér, és az külön kiadás. Az, hogy mely eggek számítanak, ugyanaz a lista, amelyet az állapotoldal használ.',
        'api' => 'API',
        'api_helper' => 'A kulcsok, amelyek az embereknél vannak, ki kért egyet, és mit láthat mindegyikük.',
        'languages' => 'Nyelvek',
        'languages_helper' => 'Mely nyelveken válaszol ez a bővítmény.',
    ],

    'features' => [
        'look' => 'Look-beállítások',
        'look_helper' => 'Az oldalsáv sora a színhez, a formához és a márkához.',
        'pages' => 'Oldalbeállítások',
        'pages_helper' => 'Az oldalsáv sora a szerverlistához, a szerveroldalakhoz és a terminálhoz.',
        'advanced' => 'Haladó beállítások',
        'advanced_helper' => 'Az oldalsáv sora a saját CSS-hez és a területenkénti kivételekhez.',
        'announcements' => 'Közlemények',
        'announcements_helper' => 'A sáv a panel tetején.',
        'nav_links' => 'Navigációs linkek',
        'nav_links_helper' => 'Saját soraid az oldalsávban.',
        'login' => 'Bejelentkezési képernyő',
        'login_helper' => 'A bejelentkezési képernyő képe, üzenete és linkjei.',
        'bars' => 'Erőforrásmérők',
        'bars_helper' => 'A processzor, a memória és a lemez színt váltó csíkjai.',
        'dashboard_status' => 'Verziósor',
        'dashboard_status_helper' => 'Az áttekintő blokkjának teteje: melyik verzió van telepítve, és vár-e egy.',
        'dashboard_nodes' => 'Gépek',
        'dashboard_nodes_helper' => 'Az áttekintő blokkjának többi része: ez a panel és minden node, azzal, amit mindegyik használ.',
        'system_status' => 'Rendszerállapot oldal',
        'system_status_helper' => 'Az oldal annak a gépnek, amelyen maga a panel fut.',
        'sidebar_footer' => 'Az oldalsáv alja',
        'sidebar_footer_helper' => 'A szövegsorod, a panel verziója és egy link, az oldalsáv alján.',
        'api' => 'API',
        'api_helper' => 'Egy út befelé a panelen kívülről: egy cím, amelyen egy Discord-bot vagy egy saját szkript lekérdezheti azt, amit ez a bővítmény tud — kik játszanak, mely szervereknek nincs mentésük, elfér-e még egy node-on. A ki egyáltalán nem regisztrál útvonalat, ahelyett hogy olyat regisztrálna, amely elutasít, ami kevesebb felület, nem pedig ugyanannyi udvariasabban. Bárki, aki be van jelentkezve, kérhet olyan kulcsot, amely csak a saját szervereire válaszol; egyet megadni, elutasítani, valaki másét visszavonni és egész panelre szólót kiadni mind a jogosultságot kívánja.',
        'languages' => 'Nyelvek',
        'languages_helper' => 'Mindenkinek azon a nyelven válaszol, amelyre a fiókja be van állítva, ott, ahol ez a bővítmény le van rá fordítva. Ha ez ki van kapcsolva, mindenki angolt kap.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Egy Minecraft fül az oldalsávban, és egy oldal minden Minecraft-szerveren belül a server.properties fájljának űrlapként való szerkesztéséhez. Az, hogy mely eggek számítanak, a te dolgod.',
        'palworld' => 'Palworld-beállítások',
        'palworld_helper' => 'Egy oldal egy Palworld-szerveren belül a világbeállításainak szerkesztéséhez. Semmilyen más szerveren nem jelenik meg, és soha nem akkor, amikor az a szerver fut.',
        'settings_search' => 'Keresés a beállításokban',
        'settings_search_helper' => 'Az űrlapok fölötti mező, amely azokra a szakaszokra szűkíti őket, amelyek tartalmazzák, amit írsz.',
        'preview' => 'Élő előnézet',
        'preview_helper' => 'A Look-űrlap melletti doboz, amely megmutatja, mit tesznek a színek, a sarkok és a térközök, mielőtt elmentenéd őket.',
        'duplicate' => 'Szerver másolása',
        'duplicate_helper' => 'Egy oldal, amellyel még egy szervert állíthatsz be pontosan úgy, mint egy meglévőt, vagy többet egyszerre. Fájlok soha nem másolódnak.',
        'favourites' => 'Csillagozott szerverek',
        'favourites_helper' => 'Egy csillag minden szerverkártyán. A csillagozottak jönnek elöl, és mindenkinek a listája a panelen van — így a csillagok elkísérnek oda, ahol legközelebb bejelentkezel. Azt módosítja, amit magad látsz, és semmit másnak. Az, hogy a panelen van, ugyanakkor azt jelenti, hogy egy fájlról van szó a storage alatt, amelyet bárki elolvashat, aki hozzáfér a géphez.',
        'artwork' => 'Egg-képek',
        'artwork_helper' => 'Az adminoldal, amely minden egg képét letölti a Steamről vagy az IGDB-ről, és magába az eggbe írja.',
        'alerts' => 'Riasztások',
        'alerts_helper' => 'A rendszeres ellenőrzés a válaszolni megszűnt node, a telítődő lemez, a halott queue worker vagy a lemaradt verzió után — és az a Discord-, panel- vagy e-mail-üzenet, amelyet küld.',
        'backups' => 'Mentések áttekintése',
        'backups_helper' => 'Az adminoldal, amely minden szervert aszerint sorol fel, mióta van mentés nélkül. Csak olvasás.',
        'public_status' => 'Nyilvános állapotoldal',
        'public_status_helper' => 'Az oldal, amelyet bárki megnyithat fiók nélkül. Ha ki van kapcsolva, a cím 404-gyel felel, bármi is legyen a listán.',
        'game_players' => 'Játékosok, más játékok',
        'game_players_helper' => 'Egy oldal a Ruston, az ARK-on, a Valheimen és minden máson belül, ami válaszol a Valve lekérdezésére, amely megmutatja, ki van csatlakozva, és mióta van fent.',
        'owner_alerts' => 'Szólj az embereknek, hogy a szerverük lent van',
        'owner_alerts_helper' => 'Ennek a bővítménynek az egyetlen része, amely nem adminisztrátoroknak ír: egy értesítés a panelen, amikor az egyik szerverük mögötti gép felhagy a válaszolással, és egy, amikor visszatér. Kikapcsolva, amíg be nem kapcsolod itt is és a Riasztások oldalon is - az ügyfeleidnek ír, tehát két döntést kíván, nem egyet.',
        'my_backups' => 'Mentésfigyelmeztetés a szerverlistán',
        'my_backups_helper' => 'Egy sor mindenki saját szerverlistája fölött, ha valamelyik szerverükről soha nem készült mentés, vagy egy ideje nem készült. A Pelican kártyája azt mondja meg, mit csinál egy szerver most; ott semmi sem mondja meg, hogy három hete nem futott mentés. Csak akkor rajzolódik ki, ha valami lemaradt, és nem említ olyan szervert, amelyet az illető ne tudna amúgy is megnyitni.',
        'capacity' => 'Kapacitás áttekintése',
        'capacity_helper' => 'Az adminoldal, amely megmutatja a memóriát, a lemezt és a processzort ígértként az elérhetőhöz képest minden gépen, azokkal a szerverekkel együtt, amelyeknek elfogytak a mentései, adatbázisai vagy allokációi. Ígérve, nem használva - egy node lehet elfoglalt és üres, vagy csendes és tele.',
        'schedules' => 'Ütemezett feladatok áttekintése',
        'schedules_helper' => 'Az adminoldal, amely a panel minden ütemezett feladatát felsorolja, a legrosszabbat elöl - beragadt, késésben, vagy soha nem futott. Csak olvasás; minden, ami módosít vagy futtat egyet, a Pelican saját oldalán marad annál a szervernél.',
        'activity' => 'A panel tevékenysége',
        'activity_helper' => 'Az adminoldal, amely a panel minden naplózott eseményét felsorolja, a legújabbat elöl, azzal, ki tette és melyik szerveren. Csak olvasás - semmit sem töröl, és továbbra is a Pelican saját beállítása dönti el, meddig maradnak a sorok.',
        'access' => 'Szerverhozzáférés szerepkör szerint',
        'access_helper' => 'Egy oldal, amellyel szerepkört köthetsz szerverekhez, a Pelican saját subuser-táblájában érvényesítve. Semmit sem ad, amíg nem kötsz össze valamit. A kikapcsolása leállítja az összehangolást; a már megadott hozzáférés megmarad, és az oldalon van gomb a visszavételére.',
        'scheduled' => 'Stílusok idő szerint',
        'scheduled_helper' => 'A Look oldal szakasza, amely a nap két időpontja között más stílust ad a panelnek. Semmit sem módosít abból, ami el van mentve — az ablak a beállítások fölé kerül az oldal kirajzolásakor, és rögtön utána elengedi őket — tehát a kikapcsolása azonnal visszaadja a panel saját megjelenését, és semmit sem veszít el.',
        'games' => 'Más játékok',
        'games_helper' => 'Az ARK világbeállításai és a Valheim listái az adminokról, a bannoltakról és az engedélyezettekről, űrlapként, nem pedig fájlként a fájlkezelőben. Az, hogy mely szerverek kapják meg őket, a Más játékok oldal egg-listája.',
        'quick' => 'Az „Ugrás ide” menü',
        'quick_helper' => 'Egy elem minden oldal tetején, amellyel egy szerverre vagy egy csillagozott oldalra ugorhatsz, és egy keresőmező az egész szerverlistádhoz. Kiemeli azt az oldalt is, amelyen éppen vagy. Amit valaki rajta keresztül megtalál, azt már amúgy is elérte, tehát semmit sem ad - a kikapcsolása elveszi a rövidítést és vele a Kedvencek oldalt.',
        'shop' => 'Bolt',
        'shop_helper' => 'Szerverek eladása a panelből: a bolt és a pénztár az ügyfélterületen, mindenki saját számlázási oldala, valamint a Bolt beállításai oldal a pénznemhez, az adóhoz és a szövegekhez. A főkapcsoló — kikapcsolva senki sem tud venni vagy fizetni, a már eladottak pedig továbbra is az alábbi oldalakon kezelhetők.',
        'packages' => 'Csomagok',
        'packages_helper' => 'Az adminoldal, ahol meghatározzák, mi eladó: egy szerversablon árral, időszakkal és készlettel. Saját jogosultság, mert az árak megadása más munka, mint a számlák fizetettnek jelölése.',
        'orders' => 'Rendelések',
        'orders_helper' => 'Az adminoldal mindennel, amit megvettek, a szerverrel, amivé lett, és az állapotával — függőben, aktív, felfüggesztett, lemondott. Saját jogosultság.',
        'invoices' => 'Számlák',
        'invoices_helper' => 'Az adminoldal azzal, ami tartozás és ami ki lett fizetve, egy gombbal a számla kézi fizetettnek jelöléséhez. Saját jogosultság, mert ez a gomb az, ahol a pénzt könyvelik.',
        'payments' => 'Fizetések',
        'payments_helper' => 'A fizetési szolgáltatók — a kulcsaik és minden rajtuk keresztül tett kísérlet. Saját jogosultság, mert itt vannak a hitelesítő adatok: aki minden számlát láthat, annak nem kell látnia a titkot.',
        'coupons' => 'Kuponok',
        'coupons_helper' => 'Kódok, amelyek százalékot vagy fix összeget vonnak le az első számlából, lejárattal és felhasználási korláttal. Saját jogosultság.',
        'customers' => 'Ügyfelek',
        'customers_helper' => 'Az az adminisztrációs oldal, amelyik megfordítja a boltot: soronként egy ember, aki vásárolt, azzal, amije van, amit fizetett, és ami hátravan. Saját jog, mert ez a bolt egyetlen oldala, amelyik emberről szól, nem sorról - aki árat szab, annak nem kell egy ügyfél teljes története, aki hibajegyre válaszol, annak igen.',
        'public_shop' => 'Nyilvános boltoldal',
        'public_shop_helper' => 'Az oldal, amit bárki megnyithat fiók nélkül, az eladó dolgokkal. Semmit sem tesz közzé, amit egy bejelentkezett vásárló ne látna a boltban, ezért a be- vagy kikapcsolás az egész döntés — kikapcsolva 404-et ad, mint az állapotoldal.',
    ],

    /*
     * A beállításűrlapok fölötti keresőmező. Azt szűri, ami már az oldalon van a
     * böngészőben, és semmit sem kérdez a szervertől, tehát nincs leírandó
     * „keres” állapot, és nincs mód arra, hogy elromoljon.
     */
    /*
     * Az előnézet. Minden benne helyettes, nem pedig minta a te panelodról, és a
     * szóhasználat ezt mondja - egy doboz, amely valódi szervert vagy valódi
     * számot említene, annak is olvasódna.
     */
    'preview' => [
        'label' => 'Előnézet',
        'card' => 'Egy kártya',
        'card_helper' => 'Ugyanazokkal a szabályokkal kirajzolva, mint a panel, az ezen az oldalon lévő beállításokkal, nem a mentettekkel.',
        'button' => 'Egy gomb',
        'field' => 'Egy mező',
        'meter_ok' => 'Rendben',
        'meter_warning' => 'Figyelmeztetés',
        'meter_danger' => 'Veszély',

        /*
         * A teljes oldal előnézete. Egy fül, nem keret, mert a Pelican
         * X-Frame-Options: DENY fejlécet küld, és megtagadja, hogy bármi
         * keretbe foglalja, magát is beleértve - lásd Support\FullPreview.
         */
        'full' => 'Nézd meg az egész panelt',
        'full_confirm' => 'Megnyitja a panelt az ezen az oldalon lévő beállításokból kirajzolva, nem a mentettekből. Semmi sem íródik ki — az értékek tizenöt percig maradnak meg, és a panel visszatér a szokásoshoz, amikor elhagyod az előnézetet vagy mentesz.',
        'full_go' => 'Mutasd',
        'full_failed' => 'Az előnézetet nem sikerült elindítani',
        'bar' => 'Olyan beállításokat nézel, amelyek nincsenek elmentve. Semmi sem lett kiírva belőlük.',
        'bar_back' => 'Vissza a beállításokhoz',
    ],

    'search' => [
        'placeholder' => 'Keresés a beállításokban',
        'label' => 'Keresés ezekben a beállításokban',
        'none' => 'Ezen az oldalon semmi sem illik. A beállítások négy oldalon oszlanak el — próbáld a Look, Oldalak, Haladó vagy Essentials-beállítások oldalt.',
    ],

    'footer' => [
        'text' => 'A saját sorod',
        'text_helper' => 'Sima szöveg, legfeljebb 120 karakter. Escape-elődik, akárcsak a közleménysáv — ez a panel minden egyes oldalán kirajzolódik, ami rossz hellyé teszi jelölés fogadására.',
        'version' => 'Mutasd a panel verzióját',
        'version_helper' => 'A Pelican verziója, nem ezé a bővítményé. A bővítmény a sajátját az áttekintőn mondja meg; amit az emberek egy oldalsáv alján keresnek, az az, melyik panelt nézik.',
        'link_label' => 'Link szövege',
        'link_url' => 'Link címe',
        'link_url_helper' => 'Egy http- vagy https-cím, vagy egy útvonal magában a panelben, például /account. Új lapon nyílik meg.',
    ],

    'layout' => [
        'label' => 'Elrendezés',
        'helper' => 'Hogyan van felépítve a panel, nem az, milyen színű. Az admin területre, a szerverlistára és a kliensterületre egyaránt vonatkozik. Az, hol van a navigáció, alapértelmezés: aki a Fiók → Navigáció alatt a sajátját állította be, megtartja.',
        'default' => 'Oldalsáv — a Pelican sajátja',
        'rail' => 'Ikonsáv — keskeny, ráállásra nyílik',
        'top' => 'Navigáció felül — nincs oldalsáv',
        'mixed' => 'Felső sáv és oldalsáv — mindkettő',
        'wide' => 'Széles — a tartalom az egész képernyőt használja',
        'focus' => 'Fókuszált — keskeny hasáb, az oldalsáv összecsukódik',

        'nav_label' => 'Az oldalsáv stílusa',
        'nav_helper' => 'Hogyan rajzolódik ki maga az oldalsáv.',
        'nav_default' => 'Alapértelmezett',
        'nav_floating' => 'Lebegő — saját kártya',
        'nav_flat' => 'Lapos — egyáltalán nincs háttér',
        'nav_bordered' => 'Szegélyes — vonal, nem felület',

        'topbar_label' => 'A topbar stílusa',
        'topbar_helper' => 'A „rejtett” csak számítógépen érvényes — telefonon a topbar hordozza az egyetlen utat vissza a menübe.',
        'topbar_default' => 'Alapértelmezett',
        'topbar_floating' => 'Lebegő — különálló sor',
        'topbar_flush' => 'Egy síkban — lapos, elmosás nélkül',
        'topbar_hidden' => 'Rejtett számítógépen',

        'card_label' => 'Kártyastílus',
        'card_helper' => 'Szakaszok, widgetek, szerverkártyák és a konzol fölötti blokkok.',
        'card_default' => 'Alapértelmezett — kiemelt lágy szegéllyel',
        'card_flat' => 'Lapos — kiemelés nélkül',
        'card_outline' => 'Körvonal — szegély és semmi mögötte',
        'card_glass' => 'Fagyott — a háttér átdereng',
        'card_sharp' => 'Éles — egyenes sarkok',
    ],

    'servers' => [
        /*
         * A csillag egy kártyán. A szkriptnek átadva, nem beleírva, hogy a
         * szövegek az az egy hely legyenek, ahol a szövegek laknak.
         */
        'favourite' => 'Csillagozd meg ezt a szervert',
        'favourited' => 'Csillagozva — elöl jelenik meg',

        /*
         * A pirula a Pelican saját fülei mellett. Aszerint elnevezve, mit tesz a
         * listával, nem negyedik fülként, mert a kiválasztott fület szűri,
         * ahelyett hogy lecserélné.
         */
        'favourites_tab' => 'Kedvencek',
        'favourites_empty' => 'Ezen az oldalon semmi sincs megcsillagozva. Használd egy szerverkártya csillagát, hogy hozzáadj egyet — és vedd észre, hogy ez azokat a szervereket szűri, amelyek már itt vannak: egy későbbi oldalon lévő csillagozott szerver nem rejtőzik el, csak nincs ezen.',
        'favourites_failed' => 'A csillagozott szervereidet nem sikerült elmenteni, ezért visszaálltak arra, ami a panelen legutóbb volt. A böngésző konzolja megmondja, mit válaszolt a kérés.',

        'art' => 'Játékkép',
        'art_helper' => 'A Pelican minden kártyára kirajzolja az egg képét. Ez dönti el, mi történik vele.',
        'art_faded' => 'Halvány — derengés a szöveg mögött',
        'art_cover' => 'Fedő — a név mögött, elhalványul',
        'art_off' => 'Ki',
        'art_dim' => 'Sötétítsd a képet',
        'art_dim_helper' => 'Az egyik játék képe világos égbolt, a másiké barlang.',

        'status' => 'Állapotjelzés',
        'status_helper' => 'Hol jelenik meg a fut/indul/leállítva szín.',
        'status_bar' => 'Csík — a bal szél mentén',
        'status_edge' => 'Perem — a tetején végig',
        'status_dot' => 'Pont — a sarokban',
        'status_off' => 'Ki',

        'density' => 'Kártyamagasság',
        'density_comfortable' => 'Tágas',
        'density_compact' => 'Tömör — sok szerverhez',

        'filter_label' => 'Tegyél szöveget a szűrőgombra',
        'filter_label_helper' => 'A Pelican már szűri ezt a listát egg és tulajdonos szerint, minden oldalon át - de a bejárat egy szöveg nélküli ikon a keresőmező mellett. Ez ráteszi a szót.',
        'filter_button' => 'Szűrők',

        'columns' => 'Kártyák egymás mellett széles képernyőn',
        'columns_helper' => 'Csak a rácsra vonatkozik, és csak 1280px-től felfelé. A Pelican saját maximuma kettő.',
    ],

    'controls' => [
        'mode' => 'Konzolgomb minden szerveroldalon',
        'mode_helper' => 'Egy lebegő gomb, egy szerver minden egyes oldalán. Megnyitja a konzolt arra, amivel épp foglalkoztál, a fejlécében az állapottal és az energiagombokkal — közvetlenül éri el a node-ot, ahogy a szerverlista is teszi, nem a konzololdal websocketjén keresztül. Soha nem jelenik meg a konzololdalon, amelyen már minden ott van.',
        'mode_full' => 'Konzol és energiagombok',
        'mode_console' => 'Csak konzol',
        'mode_off' => 'Ki',

        'label' => 'A gomb mutat',
        'label_text' => 'Ikont és nevet',
        'label_icon' => 'Csak ikont',

        'position' => 'Hol lebeg',
        'position_helper' => 'Amelyik szélt a legkevésbé valószínű, hogy olvasod.',
        'position_top' => 'Felül',
        'position_right' => 'Jobbra',
        'position_bottom' => 'Alul',
    ],

    'console' => [
        'stats' => 'Blokkok a konzol fölött',
        'stats_helper' => 'A Pelican a nevet, az állapotot, a címet és a három használati számot mutatja a terminál fölött. Az elrejtésük visszaadja a konzolnak a magasságot.',
        'stats_tiles' => 'Csempék — címke, szám és ikon',
        'stats_plain' => 'Egyszerű — ahogy a Pelican rajzolja őket',
        'stats_off' => 'Rejtett',
    ],

    'terminal' => [
        'helper' => 'Magának a terminálnak adódik át, tehát a következő oldalbetöltéskor lép életbe, nem abban a pillanatban, amikor mentesz.',

        'renderer' => 'Kirajzolja',
        'renderer_helper' => 'A Pelican a GPU-n rajzolja ki a terminált, ami sokkal gyorsabb egy görgő kimenetfal esetén. Egy böngésző egyszerre csak bizonyos számú GPU-kontextust tart életben — telefonon kevesebbet — és a határ átlépésekor eltávolítja a legrégebbit; a terminál ilyenkor egyáltalán nem rajzol ki semmit, hibaüzenet nélkül. Ha a konzolod kiürül, miközben körülötte minden más rendben néz ki, ezt a beállítást kell módosítani.',
        'renderer_webgl' => 'A GPU — a Pelican sajátja, gyorsabb',
        'renderer_dom' => 'A böngésző — lassabb, mindig kirajzol',

        'scheme' => 'Színséma',
        'scheme_helper' => 'Az egyetlen terminálbeállítás, amelyet a Pelican nem kínál. A „Kövesse a témát” a színeket a kiemelésből vezeti le, és ezért létezik ez egyáltalán.',
        'scheme_theme' => 'Kövesse a témát',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kurzor',
        'cursor_helper' => 'A konzol nem fogad gépelést — a parancsmező alatta van — tehát ez az, ahol a kimenet megállt, nem az, ahol te vagy.',
        'cursor_underline' => 'Aláhúzás — a Pelican sajátja',
        'cursor_block' => 'Blokk',
        'cursor_bar' => 'Vonal',

        'blink' => 'Villogó kurzor',

        'scrollback' => 'Görgetési előzmény',
        'scrollback_helper' => 'Meddig lehet visszagörgetni a konzolt. Minden sor a böngészőben marad, tehát egy bőbeszédű szerver magas beállítással valódi memória azon a gépen, amely együtt olvas.',
        'scrollback_lines' => ':lines sor',
    ],

    'notice' => [
        'text' => 'Üzenet',
        'text_helper' => 'Egy sor, legfeljebb 200 karakter. Befelé és kifelé is escape-elődik, tehát nem vihet jelölést egy olyan oldalra, amelyet mások töltenek be.',
        'style' => 'Hangnem',
        'style_info' => 'Információ',
        'style_warning' => 'Figyelmeztetés',
        'style_danger' => 'Sürgős',
        'style_accent' => 'Kiemelőszín',
        'scope' => 'Megjelenik',
        'scope_all' => 'Mindenkinek',
        'scope_client' => 'Csak az admin területen kívül',
        'scope_admin' => 'Csak az admin területen',
        'link_label' => 'Gomb szövege',
        'link_url' => 'Gomb címe',
        'link_url_helper' => 'https:// vagy egy útvonal ezen a panelen belül, például /account. Minden mást figyelmen kívül hagy — egy link egy minden oldalon látszó sávban nem az a hely, ahol váratlan sémának helye van.',
        'dismissible' => 'Bezárható',
        'dismissible_helper' => 'A bezárását böngészőnként jegyzi meg, és csak erre az üzenetre: változtasd meg a szöveget, és mindenkinek visszatér.',
        'dismiss' => 'Bezárás',
    ],

    'preset' => [
        'label' => 'Stílus',
        'helper' => 'Válassz kinézetet, amelyből kiindulhatsz. Kitölti mindazt, ami lent van, amit aztán módosíthatsz. A „Nincs” kikapcsolja a témát, és pontosan úgy hagyja a panelt, ahogy a Pelican szállítja.',
        'options' => [
            'none' => 'Nincs - nincs téma',
            'legend' => 'Legend - vörös tűz kék villámba',
            'ember' => 'Ember - meleg fekete, narancs kiemelés',
            'midnight' => 'Midnight - mélykék, nyugodt',
            'crimson' => 'Crimson - vörös, éles sarkok, tömör',
            'forest' => 'Forest - zöld, kerek, derengés nélkül',
            'nebula' => 'Nebula - lila, színátmenetes háttérrel',
            'terminal' => 'Terminal - zöld feketén, fix szélességű, éles',
            'console' => 'Console - kerek és tágas, tablethez',
            'nord' => 'Nord - a Nord paletta, tompított',
            'solarized' => 'Solarized - Solarized dark, cián kiemelés',
            'paper' => 'Paper - világos, nagy kontraszt, lapos',
            'daylight' => 'Daylight - világos és meleg, lágy derengéssel',
            'mono' => 'Mono - szürkeárnyalatok, lapos és sűrű',
        ],

        'save' => 'Mentés stílusként',
        'save_confirm' => 'Megőrzi azokat a színeket, sarkokat, azt a hátteret, betűtípust, azokat az ikonokat és mérőhatárokat, amelyek éppen most a képernyőn vannak — egy általad választott néven, a választóban a beépítettek mellett. Azt menti el, ami az oldalon áll, nem azt, amit utoljára mentettek.',
        'save_name' => 'Név',
        'save_name_helper' => 'Így fog szerepelni a választóban. Ha olyan néven mentesz, amelyet már használtál, felülírja azt.',
        'saved' => 'Stílus elmentve',
        'save_failed' => 'Azt a stílust nem sikerült elmenteni',
        'save_full' => ':max saját stílusnak van hely. Előbb törölj egyet.',

        'delete' => 'Stílus törlése',
        'delete_which' => 'Melyiket',
        'delete_confirm' => 'Csak a saját stílusaidat lehet törölni; a beépítetteket nem. Semmi sem változik abban, ahogy a panel most kinéz — egy stílus kiindulópont, és minden érték, amelyet beállított, már ott van a lenti beállításokban.',
        'deleted' => 'Stílus törölve',
        'deleted_current' => 'Erre volt beállítva ez a panel. A beállításai változatlanok, és még mindig ezen az oldalon vannak — válassz stílust, vagy mentsd el őket újra egy néven.',
    ],

    'user_themes' => [
        'label' => 'Stílusok, amelyeket az emberek maguk választhatnak',
        'helper' => 'A kipipált stílusok megjelennek egy Megjelenés oldalon a kliensterületen, ahol minden bejelentkezett választhat magának egyet. Azt módosítja, amit maguk látnak, és semmit másnak. Ha nincs pipa, senki nem választ semmit, és a panel egy kinézetet tart — amit most is tesz.',
    ],

    'mode' => [
        'label' => 'Panelmód',
        'helper' => 'Milyen módban nyílik meg a panel. Aki nem választott magának, ezt kapja; a felhasználói menü választója továbbra is engedi nekik módosítani, hacsak nem zárolod lent.',
        'dark' => 'Sötét',
        'light' => 'Világos',
        'system' => 'Rendszer — kövesse a látogató saját beállítását',
    ],

    'font' => [
        'label' => 'A panel betűtípusa',
        'helper' => 'Minden lehetőség olyan család, amely az operációs rendszernek már megvan — semmi sem töltődik le betűtípus-szolgáltatótól. A terminált nem érinti: annak a betűtípusa mindenkinek a saját döntése a Fiók alatt.',
        'default' => 'Alapértelmezett - a Pelican sajátja',
        'mono' => 'Fix szélességű',
        'rounded' => 'Kerekített',
        'serif' => 'Talpas',
        'system' => 'Rendszer - amit ez a gép használ',
    ],

    'surface' => [
        'label' => 'Felület színe',
        'helper' => 'A kártyák és a panelek. A világosabb és sötétebb árnyalatok ebből vezetődnek le.',
        'placeholder' => 'Kövesse a témát',
    ],

    'radius' => [
        'label' => 'Sarkok',
    ],

    'accent' => [
        'label' => 'Kiemelőszín',
        'helper' => 'Gombokhoz, linkekhez, az aktív navigációs elemhez és a fókuszgyűrűkhöz használatos.',

        /*
         * Kimondva, nem kikényszerítve. Egy szín, amelyről ez figyelmeztet,
         * ettől még elmentődik: ez valakinek a panelje, a szám egy dolgot mér,
         * és van jó ok arra, hogy valaki rosszul pontozó kiemelést akarjon. A
         * választó megmondja, mit lát, és félreáll.
         */
        'contrast_dark' => 'Olvashatóság: :ratio sötét panelen. 3 alatt egy kiemelést nehéz gombként vagy linkként olvasni — egy világosabb feljebb emeli.',
        'contrast_light' => 'Olvashatóság: :ratio világos panelen. 3 alatt egy kiemelést nehéz gombként vagy linkként olvasni — egy sötétebb feljebb emeli.',
    ],
    'density' => [
        'label' => 'Sűrűség',
        'helper' => 'A tömör szűkíti a térközöket, hogy több sor férjen a képernyőre.',
        'comfortable' => 'Tágas',
        'compact' => 'Tömör',
    ],
    'force_dark' => [
        'label' => 'Kényszerített sötét mód',
        'helper' => 'Elrejti a világos és sötét közötti választót, és minden felhasználót a sötét témán tart.',
    ],
    'glass' => [
        'label' => 'Fagyott topbar',
        'helper' => 'Elmossa a topbart és a párbeszédablakok mögötti hátteret. Gyengébb eszközökön kapcsold ki.',
    ],
    'glow' => [
        'label' => 'Kiemelés derengése',
        'helper' => 'Lágy kiemelőárnyék a legfontosabb gombokon, az aktív navigáción és a bejelentkezési kártyán.',
    ],

    'background' => [
        'label' => 'Háttér típusa',
        'helper' => 'Az Aurora a téma saját háttere: kiemelésderengés finom szemcsézettséggel.',
        'aurora' => 'Aurora (alapértelmezett)',
        'solid' => 'Egy szín',
        'gradient' => 'Színátmenet',
        'image' => 'Kép',
        'color' => 'Szín',
        'base' => 'A derengés mögötti szín',
        'base_helper' => 'Az, amin az oldal nyugszik, mielőtt a kiemelésderengés ráfestődne. Hagyd üresen a panel alapértelmezésének megtartásához, ami sötétben majdnem fekete, világosban majdnem fehér. Ha beállítod, egy séma megtartja a saját éjszakai színét, és mégis megvilágosodik.',
        'color_end' => 'Második szín',
        'angle' => 'Irány',
        'upload' => 'Tölts fel egy képet',
        'upload_helper' => 'Legfeljebb 8 MB. Egy feltöltött kép megelőzi a lenti címet.',
        'url' => 'Vagy egy URL',
        'url_helper' => 'https:// előtaggal kell kezdődnie, és kívülről elérhetőnek kell lennie.',
        'dim' => 'Tompítás',
        'dim_helper' => 'Tompítás nélkül a fehér szöveg egy világos képen olvashatatlan.',
        'blur' => 'Elmosás',
    ],

    'channel' => [
        'installed' => 'telepítve',
        'version' => 'Telepíts egy adott verziót',
        'version_helper' => 'Ennek a csatornának bármelyik kiadása, nem csak a legújabb — hogy visszalépj, ha valami új rosszabbnak bizonyul, vagy előre egy buildhez, amelyet valaki kért, hogy próbálj ki. Csak akkor, amikor a frissítések nem települnek maguktól: ha az be van kapcsolva, a választásod csak a következő ellenőrzésig tartana.',
        'version_placeholder' => 'Válassz verziót',
        'version_install' => 'Telepítsd ezt a verziót',
        'version_confirm' => 'A panel letölti azt a kiadást, újraépíti az assetjeit, és kiüríti a gyorsítótárait. A beállításaid megmaradnak. Szabad régebbi verzióra visszatérni, és semmit sem gördít vissza helyetted — válaszd újra az újabbat, hogy előre lépj.',
        'label' => 'Frissítési csatorna',
        'helper' => 'Mely kiadásokat kínálja a Téma oldal. A béta kapja meg először az új verziókat, és először az éles peremeket is.',
        'stable' => 'Stabil',
        'beta' => 'Béta',
        'dev' => 'Dev (munkaág)',
        'auto' => [
            'label' => 'Frissítések automatikus telepítése',
            'helper' => 'A ki rád hagyja a frissítést. A be rábírja a panelt, hogy ellenőrizze a választott csatornát, és telepítsen mindent, ami újabb - közben újraépíti az assetjeit, és pár percig elérhetetlen, ezért a napi és a heti 4:00-kor fut. Ehhez a panel cronjának futnia kell.',
            'interval' => 'Ellenőrzés minden',
            'minute' => 'Percenként',
            'five_minutes' => '5 percenként',
            'ten_minutes' => '10 percenként',
            'thirty_minutes' => '30 percenként',
            'hourly' => 'Óránként',
            'daily' => 'Naponta (4:00)',
            'weekly' => 'Hetente (hétfőn 4:00)',
        ],
    ],

    /*
     * A Nyelvek fül.
     *
     * Óvatosan azzal, amit állít. A Pelican már engedi, hogy mindenki nyelvet
     * válasszon az egész fiókjához, és már használja is; itt semmi sem
     * változtat ezen, és nem is szabad. Ez csak azt dönti el, hogy ennek a
     * bővítménynek a saját szövegei követik-e azt a választást.
     */
    'languages' => [
        'section_helper' => 'A Pelican már engedi, hogy mindenki nyelvet válasszon a fiókjához, és ez a bővítmény követi ott, ahol le van fordítva. Itt azt döntöd el, melyeket követi. A legtöbb nyelv szándékosan áll alacsony százalékon: az fordul le először, amit mindenki lát minden egyes oldalon — a konzol fölötti energiagombok és a node-mérők — és a többi ahogy az emberek hozzáteszik.',
        'panel' => 'Ez döntse el az egész panel nyelvét',
        'panel_helper' => 'Bekapcsolva egy olyan nyelv, amelyet ez a bővítmény nem hordoz — vagy amelyet lent kikapcsoltak — az egész panelt angolra állítja annak az olvasónak, nem csak ezeket az oldalakat. Kikapcsolva csak ez a bővítmény követi a listát, és a Pelican továbbra is azt a nyelvet beszéli, amelyre a fiók be van állítva, ami azt jelenti, hogy egy olvasó két nyelvvel találkozhat egy képernyőn. Egyetlen fiók sem változik egyik irányba sem: kapcsolj vissza egy nyelvet, és megkapják.',
        'label' => 'Nyelvek, amelyeken válaszol',
        'helper' => 'A pipa kivétele azokat az olvasókat, akiknek ez van beállítva a fiókjukon, visszaküldi az angolhoz kizárólag ennél a bővítménynél — a panel többi része továbbra is az ő nyelvüket beszéli. Az angol nincs a listán, mert minden arra esik vissza.',
        'under' => 'nem kínálja fel, amíg nem jut tovább — pipáld ki, hogy mégis felkínáld',
        'done' => ':percent% lefordítva',
        'main' => 'Fő nyelv',
        'main_helper' => 'Amit egy olvasó kap, amikor a saját nyelve nem használható — vagy nem hordozza ez a bővítmény, vagy nincs kipipálva lent. Mindig az angol volt; egy csapatban, amely nem angolul dolgozik, ez magabiztosan adott rossz válasz volt. A pipát nem lehet kivenni lent, mert minden erre esik vissza.',
        'labels' => 'Hogy hívják az egyes nyelveket',
        'labels_helper' => 'A név, amelyet az olvasók és az adminisztrátorok látnak a választókban. Hagyj egyet üresen, hogy megtartsd azt a nevet, amelyen ez a bővítmény ismeri. Egy kitalált néven feltöltött nyelvnek nincs ilyenje, tehát a kódjával szerepelne, amíg itt nem adsz neki egyet.',
        'labels_code' => 'Kód',
        'labels_name' => 'Így jelenik meg',
        'download' => 'Tölts le egy fordításfájlt',
        'download_from' => 'Kiindulás innen',
        'download_from_helper' => 'Egy JSON ennek a bővítménynek minden szövegével. Válaszd az angolt egy olyan nyelvhez, amelyet még senki sem kezdett el, vagy egy meglévőt, hogy a már lefordítottra építs.',
        'code' => 'Nyelvkód',
        'code_helper' => 'Az a kód, amelyre a fájl vonatkozik. Egy valódi locale, ahogy a fiókok használják — fr, de, pt_BR — eléri azokat az olvasókat, akiknél be van állítva, és pontosan egyeznie kell, különben nem éri el. Egy kitalált név, mint a Gaming-HU, megengedett, és másképp működik: a Pelican csak valódi locale-t enged egy fióknak, tehát a tiédet senki sem tudja kiválasztani. A fenti fő nyelvként érhető el, ami az, amit mindenki kap, ha a sajátja nem használható.',
        'url' => 'Vagy töltsd le egy címről',
        'url_helper' => 'Egy https-cím, amelyet a panel elér — egy CDN, egy bucket, egy nyers fájl egy repóban. Egyszer töltődik le, amikor mentesz, és ugyanúgy íródik ki, mint egy feltöltött, tehát ha később megváltoztatod a fájlt azon a címen, az semmit sem tesz, amíg újra nem mentesz. Egy fent kiválasztott fájl megelőzi az ebben a mezőben maradt címet.',
        'upload' => 'Tölts fel egy fordításfájlt',
        'upload_helper' => 'A fenti letöltés JSON-fájlja, lefordított értékekkel. A bővítményen kívülre íródik, tehát egy frissítés nem dobja el, és kulcsonként az angolra rétegződik — egy fájl a szövegek felével fél nyelvet ad, a többihez pedig angolt.',
        'uploaded' => ':count szöveg telepítve ide: :code',
        'uploaded_halves' => 'Ebből :mine ennek a bővítménynek a saját szövege, :panel pedig a panelé. A nulla az egyik oldalon azt jelenti, hogy a fájlnak az a fele nem tartalmazott semmit — a bővítmény kulcsai essentials:: kezdetűek, a panelé nem.',
        'uploaded_skipped' => ':count kimaradt: üresek, vagy olyan kulcsok, amelyek ennek a bővítménynek nincsenek. Az elsők: :keys',
        'upload_failed' => 'Azt a fájlt nem sikerült olvasni',
        'upload_failed_body' => 'A fenti letöltés JSON-fájljának kell lennie — kulcsok és szövegek lapos objektuma. Ellenőrizd, hogy egy szerkesztő nem mentette-e el valami másként.',
    ],

    'windows' => [
        'add' => 'Ablak hozzáadása',
        'from' => 'Ettől',
        'to' => 'Eddig',
        'to_helper' => 'A kezdésnél korábbi azt jelenti, hogy átnyúlik éjfélen — a 22:00-tól 06:00-ig az éjszaka.',
        'preset' => 'Stílus',
        'days' => 'Napok',
        'days_helper' => 'Hagyd mindet pipa nélkül a minden nap értelemben. Egy éjfélen átnyúló ablak ahhoz a naphoz tartozik, amelyen kezdődik, tehát a péntek 22:00-tól 06:00-ig lefedi a szombat reggelt.',
        'day_mon' => 'Hétfő',
        'day_tue' => 'Kedd',
        'day_wed' => 'Szerda',
        'day_thu' => 'Csütörtök',
        'day_fri' => 'Péntek',
        'day_sat' => 'Szombat',
        'day_sun' => 'Vasárnap',
    ],

    'arranger' => [
        'label' => 'Oldalrendező',
        'helper' => 'Az „Oldal rendezése” gomb, a panel minden egyes oldalán. Minden Rendezés jogosultsággal rendelkező megkapja, és beállíthatja azt az elrendezést is, amelyből mindenki más kiindul, vagy egyet egy szerepkörhöz. A ki mindenki elől elrejti; a már elmentett elrendezések ott maradnak, ahol vannak.',
        'roles' => 'Egy elrendezés nem jogosultság. Egy blokk, amelyet egy szerepkör elrejt, továbbra is olyan blokk, amelyet valaki elérhet a cím beírásával — ezt a Pelican saját jogosultságai állítják meg, a szerepkörök oldalán. Három réteg rakódik egymásra ebben a sorrendben: az, amelyből mindenki kiindul, aztán az olvasó szerepköre, aztán az, amit ő maga mozgatott.',
        'users' => 'Hadd rendezze mindenki a saját oldalait',
        'users_helper' => 'Bekapcsolva minden bejelentkezett átrendezheti és elrejtheti a blokkokat azokon az oldalakon, amelyeket már lát, csak a maga számára — másnak semmit sem változtat. Annak az elrendezésnek a beállítása, amelyből mindenki kiindul, a Rendezés jogosultságnál marad.',
    ],

    'brand' => [
        'logo_height' => 'Logó magassága',
        'logo_height_helper' => 'A Pelican 2rem-et szállít. A nagyobb értékek az oldalsáv fejlécét is magasabbá teszik.',
        'logo_url' => 'Cseréld le a logót',
        'logo_url_helper' => 'Hagyd üresen, hogy megtartsd azt, amire a Pelican saját beállításai mutatnak.',
    ],

    'login' => [
        'image' => 'Háttérkép',
        'image_helper' => 'Csak a bejelentkezési képernyőhöz. Nélküle továbbra is a panel hátterét mutatja.',
        'url' => 'Vagy egy URL',
        'blur' => 'A kártya elmosása',
        'blur_helper' => 'Fagyottá teszi a kártyát, hogy a mögötte lévő kép átderengjen.',
        'width' => 'A kártya szélessége',
        'position' => 'A kép kivágása',
        'position_helper' => 'A kép mely része éli túl a képernyőre vágást.',
        'position_center' => 'Középen',
        'position_top' => 'Felül',
        'position_bottom' => 'Alul',
        'position_left' => 'Balra',
        'position_right' => 'Jobbra',
        'align' => 'A kártya helye',
        'align_helper' => 'Hol ül a bejelentkezési kártya a képernyőn keresztben.',
        'align_center' => 'Középen',
        'align_start' => 'Balra',
        'align_end' => 'Jobbra',
        'opacity' => 'A kártya fedettsége',
        'opacity_helper' => 'Az alacsonyabb több képet enged át a kártyán.',
        'glow' => 'Kiemelés derengése',
        'glow_helper' => 'A glória a kártya körül. A ki megtartja a szegélyét és a mélységét.',
        'hide_heading' => 'Cím elrejtése',
        'hide_heading_helper' => 'Eltávolítja a címet az űrlap fölül, és magára hagyja az űrlapot.',
        'hide_footer' => 'Lábléc elrejtése',
        'hide_footer_helper' => 'Eltávolítja a kártya alatti sort, amely a pelican.dev címre hivatkozik.',
        'above' => 'Sor az űrlap fölött',
        'above_helper' => 'Egy sor, mindenkinek megjelenik, aki a bejelentkezési képernyőre érkezik. Hagyd üresen, ha nem kell.',
        'notice' => 'Üzenet a kártya alatt',
        'notice_helper' => 'Egy sor, mindenkinek megjelenik, aki a bejelentkezési képernyőre érkezik. Hagyd üresen, ha nem kell.',
    ],

    'advanced' => [
        'css' => 'Saját CSS',
        'css_helper' => 'Legfeljebb 100 KB. A storage könyvtárba mentődik, nem az .env fájlba.',
        'reference' => 'CSS-hivatkozás',
        'reference_helper' => 'Minden változó és osztály, amelyet ez a téma és a panel kínál.',
    ],

    'areas' => [
        'add' => 'Terület hozzáadása',
        'area' => 'Terület',
        'inherit' => 'Közös',
        'radius' => 'Sarkok',
        'radius_sharp' => 'Élesek',
        'radius_normal' => 'Normálisak',
        'radius_round' => 'Kerekek',
        'surface' => 'Felület színe',
        'surface_helper' => 'A kártyák és panelek ezen a területen belül; a világosabb és sötétebb árnyalatok ebből vezetődnek le.',
        'names' => [
            'terminal' => 'Terminál',
            'console' => 'Konzol (az oldal többi része)',
            'files' => 'Fájloldal',
            'edit' => 'Szerkesztőoldal',
            'server' => 'Más szerveroldalak és fülek',
        ],
    ],

    'bars' => [
        'base' => 'Alapszín',
        'base_green' => 'Zöld',
        'base_accent' => 'Kiemelőszín',
        'warning' => 'Borostyán ettől',
        'danger' => 'Piros ettől',
    ],

    'icons' => [
        'stroke' => 'Vonalvastagság',
        'stroke_thin' => 'Vékony',
        'stroke_normal' => 'Normál',
        'stroke_bold' => 'Vastag',
        'scale' => 'Méret',
        'accent' => 'Menüikonok kiemelőszínben',
        'accent_helper' => 'Az oldalsáv és a topbar ikonjaira vonatkozik.',
        'pack' => 'Ikoncsomag',
        'pack_helper' => 'Melyik készletből válogat a lenti választó. Minden a szerverre telepített ikonkészletet felkínál, plusz az ezzel a bővítménnyel érkező Essentials-készletet és minden feltöltött csomagot. Egy különbséget érdemes tudni: egy vonalas ikon a menü színében rajzolódik ki, és követi a ráállást meg az aktív sort, míg az Essentials-ikonok képek, és helyette a saját színeiket tartják meg. Ezt az dönti el, mi a fájl, nem az, melyik készletből jött.',
        'pack_custom' => 'Feltöltött csomag',
        'pack_shipped' => 'Essentials-ikonok',
        'use_shipped' => 'Használd az Essentials-ikonokat mindenütt',
        'use_shipped_confirm' => 'A csomagot az Essentials-ikonokra állítja, és minden lenti menüsort feltölt a hozzá rajzolt ikonnal — a konzol a terminált kapja, az indítás az indítógombot, és így tovább. Lecseréli a jelenlegi sorokat, és semmi sem mentődik el, amíg meg nem nyomod a Mentést, tehát az oldal bezárása visszavonja.',
        'pack_upload' => 'Tölts fel egy csomagot',
        'pack_upload_helper' => 'Egy .zip SVG-fájlokkal. Minden fájlból ikon lesz, róla elnevezve — a logo.svg-ből custom-logo. A feltöltés lecseréli a jelenleg ott lévő csomagot. A 256 KB fölötti fájlok és minden 4000 ikon fölötti kimarad, és megtudod, hány: mércének a teljes Tabler-készlet közel hatezer ikon nagyjából három megabájtban, tehát egy sokkal nagyobb csomag nem ikonokat hordoz, és a nagy része kimarad. Egy nagy feltöltést az is elutasíthat, mielőtt ez a mező bármit mondana: a panel gazdagépének php.ini fájljában az upload_max_filesize és a post_max_size — ezeket itt semmilyen beállítás nem tudja megemelni.',
        'pack_partial' => ':count ikon telepítve, de nem mind',
        'pack_partial_body' => 'Kimaradt: :big túl nagy egy ikonhoz, :unusable SVG-ként használhatatlan, :duplicate olyan névvel, amely már foglalt, :empty megtisztítva semmit sem hagyott kirajzolni. Egy 256 KB fölötti SVG szinte mindig egy ilyenbe csomagolt kép, nem rajz — exportáld ikonméretben, és pár kilobájt lesz. Egy ikon, amely semmit sem hagy kirajzolni, csak olyat tartalmazott, amit ez nem szolgál ki — ha egy egész csomag ilyen, érdemes jelezni.',
        'pack_stopped_files' => 'Megállt annál a határnál is, hogy egy csomag hány ikont tartalmazhat.',
        'pack_stopped_size' => 'Azért is megállt, mert a csomag többi része többre bomlik ki, mint amennyit a panel egyszerre memóriában tarthat — a zip lehet ennél kisebb, mert az SVG nagyjából ötöd akkorára tömörödik.',
        'overrides' => 'Ikonok lecserélése',
        'overrides_helper' => 'Egy sor minden ikonhoz, amelyet módosítani szeretnél. Válaszd ki a menüelemet, majd válassz egy ikont a fenti csomagból, adj meg egy címet, vagy tölts fel egy saját képet. Ha egynél több van kitöltve, a feltöltés nyer, aztán a cím, aztán a csomag.',
        'overrides_key' => 'Menüelem',
        'overrides_value' => 'Ikon a csomagból',
        'overrides_url' => 'Vagy egy cím',
        'overrides_url_helper' => 'Egy https-cím egy magad által kiszolgált képhez — egy CDN, egy bucket, bárhol, ahová a böngésző elér. Semmi sem másolódik a panelre, tehát ha lecseréled a fájlt azon a címen, az ikon anélkül változik, hogy ehhez az oldalhoz nyúlnál; a hátulütője egy ikon, amely eltűnik, amikor a cím eltűnik. A saját színeit tartja meg, mint egy feltöltött kép.',
        'overrides_file' => 'Vagy tölts fel egy képet',
        /*
         * Megmondja, mi a különbség valójában, mert nem magától értetődő, és ez
         * az az ok, amiért az ember az egyiket választja a másik helyett.
         */
        'overrides_file_helper' => 'PNG, SVG vagy ICO. Egy csomagból való ikon a menü saját színében rajzolódik ki, és követi a ráállást meg az aktív sort; egy feltöltött kép a saját színeit tartja meg, és nem követi. Egy logóhoz rendszerint ez kell.',
        'overrides_add' => 'Cserélj le még egy ikont',
        'overrides_search' => 'Írj be egy nevet, vagy a menüelemet…',
    ],

    /*
     * Nem a márka alatt. A márka arról szól, hogyan néz ki a panel; ez arról,
     * hogyan mutatkozik meg benne ez a bővítmény, és ez más kérdés, amelyre más
     * oldalon válaszolunk.
     */
    'identity' => [
        'nav_icon' => 'Ikon az „Essentials-beállítások” sorhoz',
        'nav_icon_helper' => 'PNG, SVG vagy ICO, legfeljebb 8 MB. Lecseréli az ikont pontosan azon az egy soron az oldalsávban; hagyd üresen ahhoz, amellyel ez a bővítmény érkezik. Képként rajzolódik ki, nem ikonként, tehát a saját színeit tartja meg, ahelyett hogy a szöveget követné — ami rendszerint az, amit egy logó akar. A fájl kiszolgálódik, nem beágyazódik, tehát minden böngésző egyszer tölti le, de akkor is érdemes valami kicsit exportálni: pár kilobájt bőven elég egy húszpixeles sorhoz. Ha egy feltöltés azelőtt bukik el, hogy ez a mező bármit mondana, az a határ, amelybe ütközött, az upload_max_filesize a panel php.ini fájljában.',
    ],
];
