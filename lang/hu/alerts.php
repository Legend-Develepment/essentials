<?php

/*
 * Magyar. Kézzel írva.
 *
 * Az őrkutya.
 *
 * Minden innen érkező üzenetet telefonon olvasnak, hajnali háromkor, olyan
 * valaki, aki egy perce még aludt. Mindegyik megmondja, melyik gép, mi a baj,
 * és semmi többet - a részlet arra az oldalra való, amelyet utána megnyit, nem
 * abba a sorba, amely felébresztette.
 *
 * Az, hogy valami rendbe jött, hírként van megírva, nem lábjegyzetként. A
 * „Visszajött már?” az a kérdés, amiért különben valaki felkelne.
 *
 * A „node”, „Wings”, „daemon”, „webhook”, „queue”, „Discord” és „SMTP” angolul
 * marad: ezekkel a nevekkel találja meg őket az ember a Pelicanban, a
 * gazdagépen, és mindenben, amit róluk írnak.
 */

return [
    'title' => 'Riasztások',
    'nav_label' => 'Riasztások',
    'subheading' => 'A panel már tudja, mikor hagy fel egy node a válaszolással, mikor telik meg egy lemez, vagy mikor áll meg a sor. Ez az, ami elmondja neked.',

    // ---- a csatornák, és mit tettek utoljára ------------------------------
    'channels' => 'Hová mennek az üzenetek',
    'channels_helper' => 'Mit tett az egyes csatornák akkor, amikor utoljára küldeni kellett valamit. Egy csatorna, amely be van kapcsolva és csendben elutasít, pontosan úgy néz ki, mint egy panel, amellyel semmi baj sincs, és ezért van ez az oldal elején.',

    'state_off' => 'Ki',
    'state_untried' => 'Még semmi sem lett elküldve',
    'state_ok' => 'Kézbesítve',
    'state_failed' => 'Elutasítva',

    // ---- mikor -------------------------------------------------------------
    'when' => 'Milyen gyakran',
    'when_helper' => 'Az ellenőrzések a háttérben futnak, tehát queue worker kell hozzájuk. Anélkül semmi sem megy el, és semmi sem szól - használd a „Küldj egy próbát” gombot, amely nem a soron megy keresztül.',

    'every' => 'Ellenőrzés minden',
    'every_helper' => 'Minden ellenőrzés eléri az egyes node-ok daemonját, tehát node-onként és körönként egy kérés. Tizenöt perc elég ahhoz, hogy egy kiesésről akkor halljunk, amikor még kiesés.',
    'every_off' => 'Ki - semmilyen ellenőrzés',
    'every_five' => '5 perc',
    'every_fifteen' => '15 perc',
    'every_thirty' => '30 perc',
    'every_hourly' => 'Óra',
    'every_daily' => 'Nap',

    'repeat' => 'Emlékeztess, amíg tart',
    'repeat_helper' => 'Egy üzenet megy, ha valami megváltozik, és még egy, ha rendbe jön. Ez emlékeztetőt tesz hozzá addig, amíg a gond még tart. A nulla azt jelenti, hogy nincs emlékeztető - egy csatorna, amely negyedóránként ismétli magát, olyan csatorna, amelyet az emberek elnémítanak.',
    'hours' => 'óra',

    // ---- hová --------------------------------------------------------------
    'where' => 'Csatornák',
    'where_helper' => 'Egynél több ésszerű. Másképp romlanak el.',

    'discord' => 'Discord',
    'discord_helper' => 'Ahol egy üzenetet tényleg elolvas olyasvalaki, aki nem ül a panel előtt.',
    'webhook' => 'Webhook-cím',
    'webhook_helper' => 'A Discordban: Szerverbeállítások → Integrációk → Webhookok → Új webhook → Webhook URL másolása. Https-re korlátozva, mert ez nyilvánosságra hozza, melyik géped van lent, és mennyire tele a lemeze.',
    'bot' => 'Saját bot',
    'bot_helper' => 'Egyetlen aláírt JSON-küldés egy általad üzemeltetett címre, hogy a panelen kívül valami értesüljön egy halott node-ról ahelyett, hogy percenként kérdezné, van-e ilyen. A Pelicanhoz adott webhookok ezt nem tudják vinni: modellekre és a tevékenységnaplóra sülnek el, egy válaszolni megszűnt node pedig egyikbe sem ír.',
    'bot_url' => 'Hová menjen',
    'bot_url_helper' => 'Https-re korlátozva, mert ez azt küldi el egy internetes címre, melyik géped van lent.',
    'bot_secret' => 'Aláírási titok',
    'bot_secret_helper' => 'Megosztva azzal, ami ezt fogadja. A törzs ezzel van hashelve, és a hash az X-Essentials-Signature fejlécben utazik sha256=<hex> alakban, így a botod visszautasíthat mindent, ami nem ebből a panelből jött. Amíg ez üres, semmi sem megy el - az az aláírás, amelyik nem kötelező, olyan, amit senki sem ellenőriz.',
    'facts' => 'Szólj a botnak akkor is, ha történik valami',
    'facts_helper' => 'Minden fenti hiba. Ezek nem: ezek olyan dolgok, amelyek egyszerűen megtörténtek. Mindegyik ki van kapcsolva, amíg be nem jelölöd, így a frissítés nem változtat semmin, és csak a bothoz mennek, soha nem a Discordra, a csengőre vagy az e-mailre.',

    'panel' => 'A panelen',
    'panel_helper' => 'Értesítés mindenkinek, akinek megvan ez a jogosultsága. Mindig működik, nem kell hozzá beállítás, és láthatatlan mindenkinek, aki nincs bejelentkezve.',

    'email' => 'E-mail',
    'email_helper' => 'Vesszővel elválasztva. A panel saját mailerét használja - megbízható, ha be van állítva, és teljesen néma, ha nincs, és ez az az egy hiba, amelyet egy őrkutya nem engedhet meg magának. Hagyd üresen a kikapcsolásához.',

    // ---- mit ---------------------------------------------------------------
    'what' => 'Mit tart szemmel',
    'what_helper' => 'Itt minden leolvasás olyan, amelyet a panel amúgy is elvégez. Ezen az oldalon semmi sem nyit olyan kapcsolatot, amelyet a Rendszerállapot ne nyitna.',

    'percent_helper' => 'A nulla kikapcsolja ezt az ellenőrzést.',
    'disk' => 'Riasztás, ha egy node lemeze több mint',
    'memory' => 'Riasztás, ha egy node memóriája több mint',

    'maintenance' => 'Riasztás olyan karbantartásról, amely tovább tart, mint',
    'maintenance_helper' => 'Egy karbantartás alatt álló node-ot minden más ellenőrzés kihagy, és ez így helyes - és így felejtődik el egy tizennégy napra. A nulla kikapcsolja.',

    'versions' => 'A panel és a Wings verziói',
    'versions_helper' => 'Egy üzenet, ha valami lemaradt, és egy, ha újra naprakész. Nincs emlékeztető - egy verzió nem kiesés.',

    'backups' => 'Lemaradt mentések',
    'backups_helper' => 'Egy üzenet, amely megnevezi a szervereket, nem pedig szerverenként egy - amikor egy ütemezett feladat megáll, minden szerver egyszerre avul el, és negyven külön üzenet egyetlen okról olyan csatorna, amelyet az emberek elnémítanak. Alapból ki: egy panel, amely kézzel ment és nem ütemezés szerint, mindennap hallana róla.',
    'backup_days' => 'Egy mentés akkor elavult, ha eltelt',
    'backup_days_helper' => 'Ezt használja a Mentések oldal is. Egy hetente mentett szervert nem szabad nyolc nap után jelenteni.',
    'days' => 'nap',

    'stock' => 'Fogyóban lévő csomagok',

    'unbuilt_switch_helper' => 'Olyan rendelés, amelynek a számlája ki van fizetve, a kiszolgálóját pedig egy csomópont elutasította. Az egyetlen ellenőrzés itt, ahol valaki pénz nélkül maradt és semmi nem mondja: minden más ezen a listán egy leállt gép. Kikapcsolva, amíg be nem kapcsolja, mint a többi.',

    'unbuilt_switch' => 'Kifizetve, de nem készült el',
    'stock_helper' => 'Egy üzenet, amely megnevezi a csomagokat, nem pedig csomagonként egy, és soha nem emlékeztető: az, hogy valami elfogyott, egy bolt hétköznapi állapota és nem kiesés, négyóránként hallani róla pedig pontosan az a mód, ahogy ezt többé nem olvassák. Csak azokat a csomagokat nézi, amelyeknek van darabszámkorlátja, tehát egy bolt, amely mindent korlát nélkül árul, semmibe sem kerül szemmel tartani. Alapból ki, mint a többi.',
    'modules_switch' => 'Bekapcsolt modul, ami nem működik',
    'modules_switch_helper' => 'Modulonként egy üzenet, nem pedig egy az összesről, mert mindegyiknél más a baj, és a mondatnak meg kell mondania, melyik. Két dolgot jelent: olyan modult, amelynek hiányoznak a táblái, ami egy félbemaradt telepítés, és olyan modult, amelynek bekapcsolt részei arra várnak, hogy valamit kitölts. A Modulok oldal mindkettőt kiírja a kártyán; ez azoknak a paneleknek szól, ahová soha senki nem néz be. Alapból ki, mint a többi.',
    'module_tables_title' => 'A(z) :module be van kapcsolva, és hiányoznak a táblái',
    'module_tables' => 'A(z) :module oldalai elrejtik magukat, mert a táblák, amelyekből olvasnak, nincsenek meg, ami rendszerint egy félbemaradt telepítés. Nyisd meg a Modulok oldalt, kapcsold ki és vissza, és a táblák elkészülnek.',
    'module_waiting_title' => 'A(z) :module be van kapcsolva, és egy része vár',
    'module_waiting' => '{1} A(z) :module egyik része be van kapcsolva, és addig nem mutat semmit, amíg ki nem töltesz valamit - az eggs-eket, amelyekre vonatkozik, a választható stílusokat, a szervereket, amelyeket egy nyilvános oldalnak mutatnia kell. A Modulok oldal a kártyán megmondja, melyiket.|[2,*] A(z) :module :count része be van kapcsolva, és addig nem mutat semmit, amíg ki nem töltesz valamit - az eggs-eket, amelyekre vonatkoznak, a választható stílusokat, a szervereket, amelyeket egy nyilvános oldalnak mutatnia kell. A Modulok oldal a kártyán megmondja, melyeket.',
    'module_cleared' => 'A(z) :module újra működik',
    'ports_switch' => 'Fogyóban lévő portok',
    'ports_switch_helper' => 'Csomagonként egy üzenet, nem pedig egy az összesről, mert a tartomány és a darabszám a hasznos rész, egy névsor pedig nem. Csak azokat a csomagokat nézi, amelyekhez be van állítva porttartomány, tehát egy bolt, amely hagyja, hogy a vásárlások bármelyik szabad portot elvigyék, semmibe sem kerül szemmel tartani. Alapból ki, mint a többi.',
    'stock_left' => 'Riasztás, ha már csak ennyi maradt',
    'stock_left_helper' => 'A csomagra beállított korláthoz mérve. Egy csomagnak e számra kell esnie ahhoz, hogy szóljon róla, és kettővel fölé kell kapaszkodnia ahhoz, hogy újra rendben lévőnek számítson, tehát az, amelyet egy vásárlás és egy lemondás ide-oda tologat, meg sem szólal. A nulla itt szám és nem hiány: csendben tartja a figyelmeztetést, és csak azt az üzenetet hagyja meg, amely azt mondja, hogy egy csomag elfogyott.',
    'stock_left_suffix' => 'maradt',

    'worker' => 'Queue worker',
    'worker_helper' => 'Hogy egyáltalán végzi-e valami ennek a bővítménynek a háttérmunkáját. Vedd észre a kört: maga az ellenőrzés a soron fut, tehát egy panel, amelynek soha nem volt workere, nem tudja ezt jelenteni. Az oldal tetején lévő sor viszont igen.',

    // ---- a gombok ----------------------------------------------------------
    'save' => 'Mentés',
    'saved' => 'Mentve',
    'save_failed' => 'Semmi sem lett elmentve',

    'test' => 'Küldj egy próbát',
    'test_one' => 'Próba',
    'test_off' => 'Az a csatorna ki van kapcsolva',
    'test_off_body' => 'Kapcsold be és ments, és a többivel együtt kipróbálja.',
    'test_title' => 'Próbaüzenet',
    'test_body' => 'Ha ezt olvasod, a Pelican-paneled riasztásai ide érkeznek. Semmi baj nincs.',
    'test_sent' => 'Elküldve minden bekapcsolt csatornára',
    'test_failed' => 'Legalább egy csatorna elutasította',
    'test_none' => 'Nincs hová küldeni',
    'test_none_body' => 'Egy csatorna sincs bekapcsolva, tehát egy valódi riasztás sem jutna sehová.',

    /*
     * Mit kezdjünk egy elutasítással.
     *
     * Egy szolgáltató saját indoklása rövid és helyes, és önmagában
     * használhatatlan. Az a kettő, amely szinte mindig felbukkan, néven van
     * nevezve, mert egyiket sem lehet kitalálni a kódból: az 553 a feladóról
     * szól és nem a címzettről, egy 401 a Discordtól pedig visszavont vagy
     * elgépelt URL.
     */
    'hint_email_sender' => 'Az SMTP-szervered azt a címet utasította el, amelyről a panel küld, nem azt, amelyre küldött. Az Admin → Beállítások → E-mail alatt a Feladó címnek olyan postafióknak kell lennie, amelyként az SMTP-fiókod küldhet. Ennek semmi köze ehhez a bővítményhez - a Pelican saját próbalevele azon az oldalon pontosan ugyanígy bukik el.',
    'hint_email' => 'Nézd meg az Admin → Beállítások → E-mail alatt. A próbalevél gombja azon az oldalon ugyanezeket a beállításokat használja, és ugyanezt mondja.',
    'hint_discord_url' => 'A Discord nem ismerte fel azt a webhookot. Törölték, újra létrehozták, vagy hiányosan illesztették be - hozz létre újat a Szerverbeállítások → Integrációk → Webhookok alatt, és másold ki a teljes URL-t.',
    'hint_discord' => 'A panel nem érte el a Discordot. Ha ez a panel olyan tűzfal mögött van, amely blokkolja a kimenő kéréseket, ez a csatorna innen nem működhet.',
    'hint_panel' => 'Senkinek sincs erre jogosultsága, vagy az értesítést nem sikerült elmenteni. Nézd meg a Szerepkörök alatt.',

    'run_now' => 'Futtasd az ellenőrzéseket most',
    'run_started' => 'Ellenőrzés a háttérben',
    'run_failed' => 'Az ellenőrzéseket nem sikerült elindítani',

    'reset' => 'Felejtse el, amit tud',
    'reset_confirm' => 'Kiüríti azt, amit az egyes ellenőrzések utoljára mondtak. A következő kör a nulláról tanul és semmit sem küld, tehát egy még tartó gondot az azt követő körben jelenti. Akkor használd, miután kivontál a forgalomból egy node-ot, amelyről az őrkutya tovább szól.',
    'reset_done' => 'Kiürítve',

    // ---- maguk az üzenetek -------------------------------------------------
    'still' => 'Már :for tart.',
    'cleared_body' => ':for állt így.',
    'ports_title' => 'A(z) :game portjai fogyóban',
    'ports_body' => 'A(z) :game vásárlásai a :from és :to közötti portokra kerülnek, és a :total portból már csak :free szabad. Az a vásárlás, amelyik egyet sem talál, előbb ki lesz fizetve, aztán elutasítva, tehát vegyél fel allocation-öket a node-on, vagy szélesítsd ki a csomag porttartományát, mielőtt ez megtörténik.',
    'ports_none_title' => 'A(z) :game portjai elfogytak',
    'ports_none' => 'A(z) :game vásárlásai a :from és :to közötti portokra kerülnek, és mind a :total foglalt. Ennek a játéknak a következő vásárlása ki lesz fizetve, aztán allocation híján elutasítva. Vegyél fel allocation-öket a node-on, vagy szélesítsd ki a porttartományt magán a csomagon.',
    'ports_empty_title' => 'A(z) :game egyetlen portja sem létezik',
    'ports_empty' => 'A(z) :game vásárlásai a :from és :to közötti portokra kerülnek, és a használható node-ok egyikén sincs egyetlen allocation sem ebben a tartományban. Ennek a játéknak minden vásárlása ki lesz fizetve, aztán elutasítva. Hozd létre az allocation-öket a node-on, vagy szélesítsd ki a tartományt magán a csomagon.',
    'ports_cleared' => 'A(z) :game portjai újra szabadok',

    'for_unknown' => 'egy ideje',
    'for_minutes' => '{1} egy perce|[2,*] :count perce',
    'for_hours' => '{1} egy órája|[2,*] :count órája',
    'for_days' => '{1} egy napja|[2,*] :count napja',

    'node_down' => 'A(z) :node nem válaszol',
    'node_down_body' => 'A panel nem éri el a daemont a(z) :node node-on. Az azon lévő szerverek addig nem indulnak, nem állnak le és nem jelentenek semmit, amíg vissza nem jön.',
    'node_up' => 'A(z) :node újra válaszol',

    'node_disk' => 'A(z) :node lemeze fogyóban',
    'node_disk_body' => 'A(z) :node lemeze :percent %-ban tele van, ami több a beállított :limit %-nál. A mentések és a szervertelepítések buknak el elsőként, amikor ez betelik.',
    'node_disk_over' => 'A(z) :node lemeze újra a határ alatt van',

    'node_memory' => 'A(z) :node memóriája fogyóban',
    'node_memory_body' => 'A(z) :node memóriájának :percent %-a használatban van, ami több a beállított :limit %-nál. A rajta lévő szervereket a kernel megölheti, mielőtt bármi is jelentene egy gondot.',
    'node_memory_over' => 'A(z) :node memóriája újra a határ alatt van',

    'node_maintenance' => 'A(z) :node régóta karbantartás alatt van',
    'node_maintenance_body' => 'A(z) :node több mint :hours órája karbantartás alatt van. Közben semmi mást nem ellenőriz rajta, és pontosan ez a lényeg - de érdemes tudni, hogy még mindig így áll.',
    'node_maintenance_over' => 'A(z) :node kikerült a karbantartásból',

    'wings_behind' => 'A Wings a(z) :node node-on elavult',
    'wings_behind_body' => 'A(z) :node a Wings :installed verzióját futtatja, és a :latest már kint van. Magán a node-on frissítsd - a panelnek erre semmilyen módja nincs.',
    'wings_current' => 'A Wings a(z) :node node-on naprakész',

    'panel_behind' => 'A panel elavult',
    'panel_behind_body' => 'Ez a panel a(z) :installed verziót futtatja, és a :latest már kint van.',
    'panel_current' => 'A panel naprakész',

    'and_more' => 'és még :count',


    'owner_down' => '{1} Az egyik szervered lent van|[2,*] :count szervered lent van',
    'owner_down_body' => 'A gép, amelyen vannak, felhagyott a válaszolással. Valakinek szóltunk. Érintett: :servers',
    'owner_up' => '{1} A szervered visszatért|[2,*] :count szervered visszatért',
    'owner_up_body' => 'A gép újra válaszol. Vissza: :servers',

    'schedules' => 'Megállt ütemezett feladatok',
    'schedules_helper' => 'Egy feladat, amely egy futás közepén ragadt be, egy, amelynek az ideje lejárt, mert a cron nem fut, vagy egy, amely soha nem futott. A Pelicannak egyikre sincs szava - egy elszállt futás örökre „feldolgoz” marad, és pontosan úgy rajzolódik ki, mint egy most futó. Minden ellenőrzésnél a panel összes aktív ütemezett feladatát elolvassa.',

    'schedule_stopped' => '{1} Egy ütemezett feladat leállt|[2,*] :count ütemezett feladat leállt',
    'schedule_stopped_body' => 'Több mint :hours órája beragadt, lejárt, sosem futott, vagy egyáltalán nincs benne feladat: :schedules',
    'schedule_running' => 'Minden ütemezett feladat újra fut',

    'unbuilt_over' => 'Minden kifizetett rendelésnek megvan a kiszolgálója',

    'unbuilt_body' => 'Valaki fizetett és nem kapott semmit. Nyissa meg a Rendeléseket és hozza létre őket, vagy nézze meg, miért utasították el: :orders',

    'unbuilt' => '{1} Egy kifizetett rendelés kiszolgáló nélkül|[2,*] :count kifizetett rendelés kiszolgáló nélkül',

    'stock_out' => '{1} Egy csomag elfogyott|[2,*] :count csomag elfogyott',
    'stock_out_body' => 'Még mindig eladó, és nincs belőle egy sem: :packages',
    'stock_low' => '{1} Egy csomag majdnem elfogyott|[2,*] :count csomag majdnem elfogyott',
    'stock_low_body' => 'Legfeljebb :limit maradt ezekből: :packages',
    'stock_back' => '{1} Egy csomag újra kapható|[2,*] :count csomag újra kapható',
    'stock_back_body' => 'Megint van mit eladni ezekből: :packages',

    'backup_none' => '{1} Egy kiszolgálóról soha nem készült mentés|[2,*] :count kiszolgálóról soha nem készült mentés',
    'backup_none_body' => 'Soha nem készült mentés ezekről: :servers',
    'backup_none_over' => 'Most már minden szervernek van mentése',

    'backup_stale' => '{1} Egy kiszolgálóról régen készült mentés|[2,*] :count kiszolgálóról régen készült mentés',
    'backup_stale_body' => 'Nincs sikeres mentés :days napja ezekről: :servers',
    'backup_stale_over' => 'Minden szerverről készült mentés a közelmúltban',

    'backup_failed' => '{1} Egy kiszolgálón hibára futnak a mentések|[2,*] :count kiszolgálón hibára futnak a mentések',
    'backup_failed_body' => 'Egy mentés eredménytelenül ért véget ezeken: :servers',
    'backup_failed_over' => 'Egyetlen mentés sem hibázik többé',

    'worker_missing' => 'Semmi sem dolgozik a soron',
    'worker_missing_body' => 'Egy munka sorba került, és semmi sem vette fel. A bővítményfrissítések, a modpack-telepítések és ezek az ellenőrzések mind megállnak, amíg nem fut egy worker - próbáld a systemctl status pelican-queue parancsot a panel gépén.',
    'worker_back' => 'A soron újra folyik a munka',
    'failed_title' => '{1} Egy feladat hibára futott a legutóbbi ellenőrzés óta|[2,*] :count feladat futott hibára a legutóbbi ellenőrzés óta',
    'failed_body' => 'Valami, amit a panelnek el kellett volna végeznie, nem történt meg, és nem lesz újrapróbálva - egy meg nem épült szerver, egy meg nem írt számla, egy el nem küldött levél. A failed_jobs táblában vannak; a `php artisan queue:retry all` visszateszi őket, amint az megszűnt, ami megállította őket.',
    'failed_back' => 'A legutóbbi ellenőrzés óta semmi sem hibázott',
    'failed' => 'Szólj, ha egy sorba állított munka hibázik',
    'failed_helper' => 'A Laravel feljegyzi azt a munkát, amelyet feladott, és semmit sem mond róla. Ez mond. Megszámolva, nem felsorolva: húsz hiba egy éjszaka alatt általában egyetlen okra megy vissza.',

    'health_interval_off' => 'A riasztások be vannak kapcsolva, de az időköz Ki értékre van állítva, ezért az őrkutya sosem fut.',
    'health_owners_unwatched' => 'A tulajdonosi riasztások be vannak kapcsolva, de az őrkutya nem fut, ezért a tulajdonosok sosem értesülnek a leállásról.',
    'health_no_channel' => 'Az őrkutya fut, de minden értesítési mód ki van kapcsolva.',
    'health_discord' => 'A Discord-riasztások be vannak kapcsolva, de nincs mentve érvényes https webhook.',
    'health_bot' => 'A bot-riasztások be vannak kapcsolva, de hiányzik a https-cím vagy az aláíró titok.',
    'health_email' => 'A riasztó e-mailek be vannak kapcsolva, de nincs érvényes cím, vagy a panel levélküldője csak a naplójába ír.',
];
