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
    'when_helper' => 'Az ellenőrzések a háttérben futnak, tehát queue worker kell hozzájuk. Anélkül semmi sem megy el, és semmi sem szól — használd a „Küldj egy próbát” gombot, amely nem a soron megy keresztül.',

    'every' => 'Ellenőrzés minden',
    'every_helper' => 'Minden ellenőrzés eléri az egyes node-ok daemonját, tehát node-onként és körönként egy kérés. Tizenöt perc elég ahhoz, hogy egy kiesésről akkor halljunk, amikor még kiesés.',
    'every_off' => 'Ki — semmilyen ellenőrzés',
    'every_five' => '5 perc',
    'every_fifteen' => '15 perc',
    'every_thirty' => '30 perc',
    'every_hourly' => 'Óra',
    'every_daily' => 'Nap',

    'repeat' => 'Emlékeztess, amíg tart',
    'repeat_helper' => 'Egy üzenet megy, ha valami megváltozik, és még egy, ha rendbe jön. Ez emlékeztetőt tesz hozzá addig, amíg a gond még tart. A nulla azt jelenti, hogy nincs emlékeztető — egy csatorna, amely negyedóránként ismétli magát, olyan csatorna, amelyet az emberek elnémítanak.',
    'hours' => 'óra',

    // ---- hová --------------------------------------------------------------
    'where' => 'Csatornák',
    'where_helper' => 'Egynél több ésszerű. Másképp romlanak el.',

    'discord' => 'Discord',
    'discord_helper' => 'Ahol egy üzenetet tényleg elolvas olyasvalaki, aki nem ül a panel előtt.',
    'webhook' => 'Webhook-cím',
    'webhook_helper' => 'A Discordban: Szerverbeállítások → Integrációk → Webhookok → Új webhook → Webhook URL másolása. Https-re korlátozva, mert ez nyilvánosságra hozza, melyik géped van lent, és mennyire tele a lemeze.',

    'panel' => 'A panelen',
    'panel_helper' => 'Értesítés mindenkinek, akinek megvan ez a jogosultsága. Mindig működik, nem kell hozzá beállítás, és láthatatlan mindenkinek, aki nincs bejelentkezve.',

    'email' => 'E-mail',
    'email_helper' => 'Vesszővel elválasztva. A panel saját mailerét használja — megbízható, ha be van állítva, és teljesen néma, ha nincs, és ez az az egy hiba, amelyet egy őrkutya nem engedhet meg magának. Hagyd üresen a kikapcsolásához.',

    // ---- mit ---------------------------------------------------------------
    'what' => 'Mit tart szemmel',
    'what_helper' => 'Itt minden leolvasás olyan, amelyet a panel amúgy is elvégez. Ezen az oldalon semmi sem nyit olyan kapcsolatot, amelyet a Rendszerállapot ne nyitna.',

    'percent_helper' => 'A nulla kikapcsolja ezt az ellenőrzést.',
    'disk' => 'Riasztás, ha egy node lemeze több mint',
    'memory' => 'Riasztás, ha egy node memóriája több mint',

    'maintenance' => 'Riasztás olyan karbantartásról, amely tovább tart, mint',
    'maintenance_helper' => 'Egy karbantartás alatt álló node-ot minden más ellenőrzés kihagy, és ez így helyes — és így felejtődik el egy tizennégy napra. A nulla kikapcsolja.',

    'versions' => 'A panel és a Wings verziói',
    'versions_helper' => 'Egy üzenet, ha valami lemaradt, és egy, ha újra naprakész. Nincs emlékeztető — egy verzió nem kiesés.',

    'backups' => 'Lemaradt mentések',
    'backups_helper' => 'Egy üzenet, amely megnevezi a szervereket, nem pedig szerverenként egy — amikor egy ütemezett feladat megáll, minden szerver egyszerre avul el, és negyven külön üzenet egyetlen okról olyan csatorna, amelyet az emberek elnémítanak. Alapból ki: egy panel, amely kézzel ment és nem ütemezés szerint, mindennap hallana róla.',
    'backup_days' => 'Egy mentés akkor elavult, ha eltelt',
    'backup_days_helper' => 'Ezt használja a Mentések oldal is. Egy hetente mentett szervert nem szabad nyolc nap után jelenteni.',
    'days' => 'nap',

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
    'hint_email_sender' => 'Az SMTP-szervered azt a címet utasította el, amelyről a panel küld, nem azt, amelyre küldött. Az Admin → Beállítások → E-mail alatt a Feladó címnek olyan postafióknak kell lennie, amelyként az SMTP-fiókod küldhet. Ennek semmi köze ehhez a bővítményhez — a Pelican saját próbalevele azon az oldalon pontosan ugyanígy bukik el.',
    'hint_email' => 'Nézd meg az Admin → Beállítások → E-mail alatt. A próbalevél gombja azon az oldalon ugyanezeket a beállításokat használja, és ugyanezt mondja.',
    'hint_discord_url' => 'A Discord nem ismerte fel azt a webhookot. Törölték, újra létrehozták, vagy hiányosan illesztették be — hozz létre újat a Szerverbeállítások → Integrációk → Webhookok alatt, és másold ki a teljes URL-t.',
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

    'for_unknown' => 'egy ideje',
    'for_minutes' => ':count perce',
    'for_hours' => ':count órája',
    'for_days' => ':count napja',

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
    'node_maintenance_body' => 'A(z) :node több mint :hours órája karbantartás alatt van. Közben semmi mást nem ellenőriz rajta, és pontosan ez a lényeg — de érdemes tudni, hogy még mindig így áll.',
    'node_maintenance_over' => 'A(z) :node kikerült a karbantartásból',

    'wings_behind' => 'A Wings a(z) :node node-on elavult',
    'wings_behind_body' => 'A(z) :node a Wings :installed verzióját futtatja, és a :latest már kint van. Magán a node-on frissítsd — a panelnek erre semmilyen módja nincs.',
    'wings_current' => 'A Wings a(z) :node node-on naprakész',

    'panel_behind' => 'A panel elavult',
    'panel_behind_body' => 'Ez a panel a(z) :installed verziót futtatja, és a :latest már kint van.',
    'panel_current' => 'A panel naprakész',

    'and_more' => 'és még :count',

    'owners' => 'Szólj az embereknek, ha a saját szerverük mögötti gép lent van',
    'owners_helper' => 'Az egyetlen ellenőrzés itt, amely nem neked ír. Egy válaszolni megszűnt gépen lévő minden szerver tulajdonosa egy értesítést kap a panelen — a harangot, soha nem e-mailt — és egyet, amikor visszatér. Közben soha nem emlékeztetőt: egy forgalmas node-on ezt negyedóránként mindenkinek megismételni az a mód, ahogy egy panel riasztásait többé nem olvassák. A subuserek nem kapnak szót; a tulajdonos az, aki eldönti, mit kell tenni. A gépet nem említi nekik, ugyanabból az okból, amiért az állapotoldal sem hozza nyilvánosságra.',

    'owner_down' => 'Az egyik szervered lent van|:count szervered lent van',
    'owner_down_body' => 'A gép, amelyen vannak, felhagyott a válaszolással. Valakinek szóltunk. Érintett: :servers',
    'owner_up' => 'A szervered visszatért|:count szervered visszatért',
    'owner_up_body' => 'A gép újra válaszol. Vissza: :servers',

    'schedules' => 'Megállt ütemezett feladatok',
    'schedules_helper' => 'Egy feladat, amely egy futás közepén ragadt be, egy, amelynek az ideje lejárt, mert a cron nem fut, vagy egy, amely soha nem futott. A Pelicannak egyikre sincs szava — egy elszállt futás örökre „feldolgoz” marad, és pontosan úgy rajzolódik ki, mint egy most futó. Minden ellenőrzésnél a panel összes aktív ütemezett feladatát elolvassa.',

    'schedule_stopped' => ':count ütemezett feladat megállt',
    'schedule_stopped_body' => 'Több mint :hours órája beragadva, késésben, vagy soha nem futott: :schedules',
    'schedule_running' => 'Minden ütemezett feladat újra fut',

    'backup_none' => ':count szerverről soha nem készült mentés',
    'backup_none_body' => 'Soha nem készült mentés ezekről: :servers',
    'backup_none_over' => 'Most már minden szervernek van mentése',

    'backup_stale' => ':count szerverről egy ideje nem készült mentés',
    'backup_stale_body' => 'Nincs sikeres mentés :days napja ezekről: :servers',
    'backup_stale_over' => 'Minden szerverről készült mentés a közelmúltban',

    'backup_failed' => 'A mentések :count szerveren hibáznak',
    'backup_failed_body' => 'Egy mentés eredménytelenül ért véget ezeken: :servers',
    'backup_failed_over' => 'Egyetlen mentés sem hibázik többé',

    'worker_missing' => 'Semmi sem dolgozik a soron',
    'worker_missing_body' => 'Egy munka sorba került, és semmi sem vette fel. A bővítményfrissítések, a modpack-telepítések és ezek az ellenőrzések mind megállnak, amíg nem fut egy worker — próbáld a systemctl status pelican-queue parancsot a panel gépén.',
    'worker_back' => 'A soron újra folyik a munka',
];
