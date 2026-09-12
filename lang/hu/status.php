<?php

/*
 * Magyar. Kézzel írva.
 *
 * A nyilvános állapotoldal.
 *
 * Az egyetlen dolog, amelyet ez a bővítmény olyasvalakinek szolgál ki, aki nincs
 * bejelentkezve, és az egyetlen oldal, amelynek a szavait úgy kell olvasni,
 * ahogy egy idegen látná - mert egy idegen látni is fogja. Itt semmi sem mondja
 * meg, melyik node, melyik tulajdonos vagy melyik cím; egy név, hogy fut-e, és
 * hányan vannak fent.
 *
 * A „node” csak a beállításokban fordul elő; magán a nyilvános oldalon „gép”
 * áll, mert ott olyan olvassa, aki soha nem hallott a Pelicanról.
 */

return [
    // ---- a beállítások oldala ----------------------------------------------
    'title' => 'Nyilvános állapotoldal',
    'nav_label' => 'Állapotoldal',
    'subheading' => 'Egy oldal, amelyet bárki megnyithat fiók nélkül, és amely megmutatja, mely szervereid futnak. Semmi sem jelenik meg rajta, amíg lent nem említesz meg egy szervert.',

    'address' => 'Az állapotoldalad itt van',
    'address_off' => 'Még semmi sincs kiszolgálva. Adj hozzá lent egy szervert, egy gépet vagy egy szolgáltatást, és ments, és a cím megjelenik itt.',

    'which' => 'Mi kerül nyilvánosságra',
    'which_helper' => 'A lista üresen indul, és semmi sem nyilvános, amíg nincs rajta valami. Csak olyan szerverek kínálódnak fel, amelyeket már meg tudsz nyitni.',
    'add' => 'Szerver nyilvánosságra hozatala',
    'server' => 'Szerver',
    'shown_as' => 'Így jelenik meg',
    'shown_as_helper' => 'Amit a közönség lát. Írd meg magad, ahelyett hogy a panelre bíznád a valódi nevet - az „mc-prod-3 (ne nyúlj hozzá)” emlékeztető magadnak, nem olyasmi, amit fórumra tesznek.',

    'look' => 'Szóhasználat',
    'look_helper' => 'Ezen az oldalon mindent olyan emberek olvasnak, akiknek nincs fiókjuk.',
    'heading' => 'Cím',
    'heading_helper' => 'Ha üres, a panel saját nevét használja.',
    'note' => 'Egy sor a lista fölött',
    'note_helper' => 'Hogy elmondd, mi történik - egy karbantartási ablak, vagy hogy hol lehet kérdezni. Sima szöveg.',
    'link' => 'Link a panelre',
    'link_helper' => 'Egy út vissza befelé, az oldal alján. Kapcsold ki, ha inkább nem árulnád el, hol van a paneled.',

    'save' => 'Mentés',
    'saved' => 'Mentve',
    'save_failed' => 'Semmi sem lett elmentve',
    'open' => 'Oldal megnyitása',

    // ---- játékosszámok -----------------------------------------------------
    'counts' => 'Játékosszámok',
    'counts_helper' => 'Honnan jönnek a szerver melletti számok. A Minecraft-szerverek a saját kézfogásukra válaszolnak, és a Minecraft alatt lehet őket beállítani; minden lentebbi azokra a játékokra vonatkozik, amelyek a Valve lekérdezésére válaszolnak - Rust, ARK, Valheim, 7 Days to Die és a legtöbb más, ami Source-on vagy Unrealen fut.',
    'query_eggs' => 'Eggek, amelyek válaszolnak a Valve lekérdezésére',
    'query_eggs_helper' => 'Pipáld ki azoknak a játékoknak az eggjeit. Ugyanez a lista dönti el azt is, mely szerverek kapnak Játékosok oldalt a panelen belül - egy kérdés két okból. Semmit sem kérdez, amíg nem szólsz: ez itt az egyetlen dolog, amely a paneltől közvetlenül egy játékporthoz nyit kapcsolatot, tehát ez választás, nem valami, ami magától elindul. Egy szerver, amelynek a portját a panel nem éri el, egyszerűen nem mutat számokat.',

    // ---- a node-ok ---------------------------------------------------------
    'nodes' => 'Gépek',
    'nodes_helper' => 'Fent vagy lent, és semmi más. Nem a terhelés és nem az, mennyire tele a lemez - akit az érdekel, játszhat-e, annak nincs szüksége kapacitásjelentésre a vasadról, és egy ilyet nyilvánosságra hozni térkép arról, hol szorít.',
    'add_node' => 'Gép nyilvánosságra hozatala',
    'node' => 'Gép',
    'node_shown_as_helper' => 'Írd meg magad. Egy node rendszerint valami olyat visel névként, mint a hetzner-fsn1-01, és ez egy egész mondat arról, hol vannak a gépeid.',

    // ---- HTTP-figyelők -----------------------------------------------------
    'monitors' => 'Más szolgáltatások',
    'monitors_helper' => 'Minden más, amiről érdemes tudni, hogy fent van: a weboldalad, egy API, egy bot health végpontja. A panel mindegyiket ugyanolyan ütemben kérdezi, mint a szervereket. Csak adminisztrátoroknak - egy figyelő rábírja ezt a panelt, hogy lehívjon egy címet, és ha bárki hozzáadhat egyet, szondává válik, amelyet oda irányítasz, ahová akarsz.',
    'add_monitor' => 'Szolgáltatás hozzáadása',
    'monitor_name' => 'Név',
    'monitor_url' => 'Cím',
    'monitor_url_helper' => 'Csak https. Ha ez a panel rendszeres időközönként sima http-t hívna le, mindenki az útvonalon tudná, mely szolgáltatásaid léteznek.',
    'monitor_expect' => 'Elvárt',
    'monitor_expect_helper' => 'Hagyd üresen a „bármilyen válasz” értelemben, ami illik egy olyan oldalhoz, amely átirányít, vagy 403-mal felel egy csupasz kérésre. A szám olyan végponthoz való, amelyet pontosan ennek a kimondására írtak és semmi másra - ha túl szorosra állítod, a sor örökre piros marad egy szolgáltatásnál, amellyel semmi baj sincs.',

    // ---- oldalak a felhasználóknak -----------------------------------------
    'users' => 'Oldalak a felhasználóidnak',
    'users_helper' => 'Hogy azok, akiknek szerverük van ezen a panelen, közzétehetik-e a saját állapotoldalukat.',
    'user_pages' => 'Hadd készítsenek sajátot a felhasználók',
    'user_pages_helper' => 'Mindenki saját címet kap a /status/a-nevük alatt, ahol csak az általa birtokolt szerverek szerepelnek, olyan néven, amilyet ő maga ír. Gépek és más szolgáltatások nem kerülnek rájuk - mindkettő egyedül a tiéd. Ha ez be van kapcsolva, az Állapotoldal alatt találják meg a fiókmenüjükben, bármelyik panelen is vannak.',

    // ---- a megjelenés ------------------------------------------------------
    'every' => 'Ellenőrzés minden',
    'every_helper' => 'Milyen gyakran épül újra az oldal, és milyen gyakran frissíti magát a böngészőben. Egy oldal, amelyet emberek néznek egy újraindítás alatt, másodperceket akar; egy, amelyre fórumról hivatkoznak, és amelyet senki sem tart nyitva, egy órát akar, és minden node megkérdezése percenként a kedvéért olyan munka, amelyet senkiért végzel.',
    'every_realtime' => 'Valós idő (10 másodperc)',
    'every_30s' => '30 másodperc',
    'every_1m' => '1 perc',
    'every_5m' => '5 perc',
    'every_10m' => '10 perc',
    'every_30m' => '30 perc',
    'every_60m' => '60 perc',

    'style' => 'Stílus',
    'style_helper' => 'A panel egyik saját kinézete, erre az oldalra alkalmazva: a színe, a felületéből épített szürkeárnyalatai, és hogy mennyire kerekek a sarkok. A „Kövesse a panelt” azt jelenti, amire ma be van állítva, beleértve mindent, ami később változik.',
    'style_mine_helper' => 'Azok a stílusok, amelyeket ez a panel kínál, a te oldaladra alkalmazva: egy szín, a belőle épített szürkeárnyalatok, és hogy mennyire kerekek a sarkok. Azt, mely stílusok szerepelnek a listán, a panel tulajdonosa dönti el - ugyanaz a lista, amelyből a Megjelenés alatt választhatsz. A „Kövesse a panelt” azt jelenti, amire be van állítva.',
    'style_panel' => 'Kövesse a panelt',

    // ---- a saját oldal -----------------------------------------------------
    'mine_title' => 'Az én állapotoldalam',
    'mine_nav_label' => 'Állapotoldal',
    'mine_subheading' => 'Egy cím, amelyet azoknak adhatsz, akik a szervereiden játszanak. A választott szervereidet mutatja, és semmi mást erről a panelről.',
    'mine_address' => 'A címed',
    'mine_address_helper' => 'Válassz valami rövidet. Ha később megváltoztatod, minden linket eltörsz, amelyet valaki már elmentett.',
    'mine_address_off' => 'Válassz lent egy címet, és ments, és az oldalad megjelenik itt.',
    'slug' => 'Cím',
    'slug_helper' => 'Kisbetűk, számok és kötőjelek. Három karakter vagy több.',
    'mine_heading' => 'Cím',
    'mine_heading_helper' => 'Ha üres, a címedet használja.',
    'mine_note_helper' => 'Hogy elmondd, mi történik - egy újraindítás, egy esemény, hol találnak meg. Sima szöveg, és mindenki olvassa, akinek megvan a link.',
    'mine_which' => 'A szervereid',
    'mine_which_helper' => 'Csak olyan szerverek kínálódnak fel, amelyeket magad birtokolsz. Ha máshol subuser vagy, az hozzáférés egy géphez, nem engedély arra, hogy nyilvánosságra hozd a létezését.',
    'mine_shown_as_helper' => 'Amit a látogatók látnak. Írd meg magad, ahelyett hogy a panelbeli nevet használnád, ha az a név emlékeztető magadnak.',
    'mine_look_helper' => 'Hogyan néz ki az oldalad azoknak, akiknek elküldöd.',
    'mine_remove' => 'Vedd le az oldalamat',
    'mine_remove_confirm' => 'Leveszi az oldaladat, és felszabadítja a címet valaki másnak. Minden, amit beállítottál, elvész; magukhoz a szerverekhez nem nyúl.',
    'mine_removed' => 'Az oldalad le van véve',

    'why_slug' => 'Az a cím nem jó. Kisbetűk, számok és kötőjelek, három karakter vagy több - és néhány szó foglalt.',
    'why_taken' => 'Azt a címet már valaki más birtokolja.',
    'why_unwritable' => 'Nem sikerült kiírni. Ellenőrizd, hogy a storage/app azé a felhasználóé-e, amelyként a panel fut.',

    // ---- címek magán az oldalon --------------------------------------------
    'section_servers' => 'Szerverek',
    'section_nodes' => 'Gépek',
    'section_monitors' => 'Szolgáltatások',

    // ---- maga az oldal -----------------------------------------------------
    'up' => 'Fent',
    'down' => 'Lent',
    'starting' => 'Indul',

    /*
     * Nem „lent”, és a különbség nyilvánosan számít.
     *
     * A panel nem érte el a szervert. Ez rendszerint egy karbantartás alatt
     * álló node vagy egy újrainduló daemon - nem ugyanaz, mintha a szerver ki
     * lenne kapcsolva, és száz játékosnak azt mondani, hogy a szerverük lent
     * van, miközben fut, rosszabb, mint bevallani, hogy nem tudjuk.
     */
    'unknown' => 'Ismeretlen',

    'players' => 'Játékosok',
    'online_now' => 'játszik éppen most',
    'checked' => 'Ellenőrizve',
    'next_check' => 'a következő ellenőrzésig',
    'just_now' => 'épp most',
    'seconds_ago' => ':count másodperce',
    'panel' => 'Bejelentkezés',

    'all_up' => 'Minden fut.',
    'some_down' => 'Valami nem fut.',
    'empty' => 'Itt még semmi sincs nyilvánosságra hozva.',
];
