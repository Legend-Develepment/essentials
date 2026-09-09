<?php

/*
 * Magyar. Kézzel írva.
 *
 * Csomagok: egy szerver, amit valaki megvehet.
 *
 * Az olvassa, aki a boltot berendezi. Itt minden szó a sablonról és az árról
 * szól; amit a vásárló lát, az a shop.php-ban van, mert a két olvasó más
 * mondatokat akar ugyanarról a sorról.
 *
 * Az „egg", „node", „swap", „io" és a Minecraft-szavak angolul maradnak: ezek a
 * Pelican saját szerverűrlapjának szavai, a csomag pedig ez az űrlap későbbre
 * eltéve.
 */

return [
    'title' => 'Csomagok',
    'nav_label' => 'Csomagok',
    'subheading' => 'Ami eladó. Mindegyik egy szerversablon, árral; a vásárló megvesz egyet, és a panel létrehozza a szervert.',

    // ---- a táblázat ------------------------------------------------------
    'column_name' => 'Csomag',
    'column_egg' => 'Egg',
    'column_price' => 'Ár',
    'column_stock' => 'Készlet',
    'column_live' => 'Eladó',
    'column_orders' => 'Eladva',

    'live' => 'Eladó',
    'offline' => 'Nem eladó',
    'no_egg' => 'Nincs egg — nem építhető fel',

    'stock_unlimited' => 'Korlátlan',
    'stock_left' => ':count maradt',
    'stock_out' => 'Elfogyott',

    // ---- időszakok -------------------------------------------------------
    'period_once' => 'Egyszeri',
    'period_month' => 'Havonta',
    'period_quarter' => 'Negyedévente',
    'period_year' => 'Évente',

    // Az ár után: „12,50 € havonta".
    'per_once' => 'egyszer',
    'per_month' => 'havonta',
    'per_quarter' => 'negyedévente',
    'per_year' => 'évente',

    // ---- műveletek -------------------------------------------------------
    'new' => 'Új csomag',
    'edit' => 'Szerkesztés',
    'duplicate' => 'Másolás',
    'copy_suffix' => ' (másolat)',
    'go_live' => 'Eladásra bocsátás',
    'go_offline' => 'Levétel az eladásról',
    'delete' => 'Törlés',
    'delete_confirm' => 'Eltávolítja a csomagot. Amit már megvettek, azt nem érinti — a rendelések megőrzik a saját másolatukat arról, amik voltak.',
    'delete_confirm_sold' => 'Ezt :count alkalommal adták el. Azokat a szolgáltatásokat semmi nem érinti: a rendelés megőrzi a saját másolatát mindarról, amivel eladták, így a szerverek futnak tovább, és a számlák továbbra is azt mondják, mit vettek. Csak a kép tűnik el a szolgáltatáskártyájukról, és a csomag nem lesz többé eladó.',
    'delete_refused' => 'Nem lett törölve',
    'delete_refused_body' => 'Erre a csomagra rendelések születtek, és rá mutatnak. Inkább vedd le az eladásról; megmarad a nyilvántartásban, és senki sem tudja megvenni.',
    'deleted' => 'Csomag törölve',
    'deleted_sold' => 'A belőle eladott :count szolgáltatás érintetlen, és fut tovább.',
    'saved' => 'Csomag mentve',
    'save_failed' => 'A csomagot nem sikerült menteni',
    'price_invalid' => 'Ez nem összeg. Írd így: 12.50 vagy 12,50.',

    // ---- az űrlap: mi ez -------------------------------------------------
    'section_basics' => 'A csomag',
    'section_basics_helper' => 'Amit a vásárló a kártyán lát.',
    'name' => 'Név',
    'name_helper' => 'Hogy hívják a boltban.',
    'slug' => 'Cím',
    'slug_helper' => 'Kisbetűk, számok és kötőjelek. Üresen hagyva a névből készül. Későbbi módosítása eltör egy linket, amit valaki elmentett.',
    'description' => 'Leírás',
    'description_helper' => 'Néhány sor a név alatt. Sima szöveg.',
    'live_field' => 'Eladó',
    'live_helper' => 'Kikapcsolva itt tartja a csomagot, és senkinek sem mutatja. Egg nélküli csomag sosem jelenik meg, bármi is áll itt.',
    'sort' => 'Sorrend',
    'sort_helper' => 'A kisebb kerül előbbre a boltban.',

    // ---- az űrlap: mivé lesz ---------------------------------------------
    'section_server' => 'A szerver, amivé lesz',
    'section_server_helper' => 'Ugyanazok a kérdések, amiket a Pelican tesz fel, amikor kézzel hozol létre szervert — itt egyszer megválaszolva és minden eladásnál felhasználva.',
    'egg' => 'Egg',
    'egg_helper' => 'Egy kiválasztása kitölti az image-et, az indítóparancsot és minden változót az egg saját alapértékeivel. Utána bármit átírhatsz.',
    'image' => 'Docker image',
    'image_helper' => 'Az egg által kínált image-ek egyike.',
    'image_default' => 'Az egg első image-e',
    'startup' => 'Indítóparancs',
    'startup_helper' => 'Az egg által kínált parancsok egyike.',
    'startup_default' => 'Az egg első parancsa',
    'environment' => 'Változók',
    'environment_helper' => 'Az egg változói és az értékük. Mindaz, amije az eggnek van és itt nem szerepel, az alapértékét kapja a szerver létrehozásakor.',
    'env_key' => 'Változó',
    'env_value' => 'Érték',
    'nodes' => 'Node-ok',
    'nodes_helper' => 'Hol jöhet létre szerver ebből a csomagból — ebben a sorrendben próbálva, amíg valamelyiken van szabad cím. Semmi bejelölve azt jelenti: bármelyik node.',

    // ---- az űrlap: korlátok ----------------------------------------------
    'section_limits' => 'Korlátok',
    'section_limits_helper' => 'Amit a szerver kap. Ugyanazok a mezők, mint a Pelican saját szerverűrlapján, ugyanazokban az egységekben.',
    'memory' => 'Memória',
    'disk' => 'Lemez',
    'cpu' => 'CPU',
    'cpu_helper' => 'Egy mag százaléka: 100 egy mag, 200 kettő, 0 nincs korlát.',
    'swap' => 'Swap',
    'swap_helper' => '0 nincs, -1 korlátlan.',
    'io' => 'Blokk-IO súly',
    'io_helper' => 'A Pelican alapértéke 500. Hagyd úgy, hacsak nem tudod, miért ne.',
    'threads' => 'CPU-rögzítés',
    'threads_helper' => 'Mely magok, ahogy a Pelican írja: 0,1 vagy 0-3. Üresen bármelyik.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Leállíthatja-e a kernel a szervert, ha elfogy a memóriája.',
    'databases' => 'Adatbázisok',
    'allocations' => 'További allocation-ök',
    'backups' => 'Biztonsági mentések',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- az űrlap: a pénz ------------------------------------------------
    'section_price' => 'Ár és készlet',
    'section_price_helper' => 'A bolt pénznemében, ami a Bolt beállításai oldalon van megadva. Adó nélkül — az adó külön sorként kerül a számlára.',
    'price' => 'Ár',
    'price_helper' => 'Időszakonként. Írd így: 12.50 vagy 12,50.',
    'setup_fee' => 'Beállítási díj',
    'setup_fee_helper' => 'Egyszer, az első számlán kerül felszámításra. Nulla, ha nincs.',
    'period' => 'Számlázás',
    'period_helper' => 'Az egyszeri egyszer fizetendő, és megmarad. A többi minden időszakban új számlát kap; a kifizetetlen a Bolt beállításai oldalon megadott türelmi idő után felfüggeszti a szervert.',
    'stock' => 'Készlet',
    'stock_helper' => 'Hány lehet egyszerre eladva, minden nem lemondott rendelést beszámítva. Üresen korlátlan.',
    'term' => 'Minimális futamidő',
    'term_helper' => 'Mennyi időre kötelezi el magát valaki, amikor megveszi. A nulla azt jelenti: semmire — lemondhatja, és a kifizetett időszak végén megáll.',
    'term_unit' => 'Miben számolva',
    'term_unit_helper' => 'Napokban, hónapokban vagy években. Egy lemondott rendelés kifut ennek a futamidőnek a végéig, és a szerver azon a napon törlődik.',
    'unit_day' => 'Napok',
    'unit_month' => 'Hónapok',
    'unit_year' => 'Évek',
    'term_day' => 'Minimális futamidő: :count nap',
    'term_month' => 'Minimális futamidő: :count hónap',
    'term_year' => 'Minimális futamidő: :count év',
    'section_art' => 'Kép',
    'section_art_helper' => 'A kép a csomag kártyáján, a boltban és a vásárló szolgáltatásainál. Hagyd mindkettőt üresen, és az egg saját grafikája kerül oda, ami a legtöbb csomagnak már megvan.',
    'art_file' => 'Kép feltöltése',
    'art_file_helper' => 'Inkább széles, mint magas: a kártya 16:9-re vágja. Legfeljebb 8 MB.',
    'art_url' => 'Vagy egy képcím',
    'art_url_helper' => 'Teljes https-cím. Akkor használjuk, ha fent nincs feltöltve semmi.',

    'empty' => 'Még nincsenek csomagok',
    'section_ask' => 'Kérdezd meg a vásárlót',
    'section_ask_helper' => 'Kérdések a rendelés oldalán, amelyekre a rendelés leadása előtt válaszol. A válaszok akkor jutnak el a szerverre, amikor az felépül.',
    'ask_vars' => 'Bekérendő változók',
    'ask_vars_helper' => 'Az egg saját változói. Jelölj be egyet, és a vásárló vásárlás közben tölti ki, a válasza pedig ennek a csomagnak az értéke helyett kerül felhasználásra. Ha semmit nem jelölsz be, senkitől nem kérdezünk semmit.',
    'upload_ask' => 'Kérj be egy fájlt',
    'upload_ask_helper' => 'Egy zip, amit a vásárló vásárlás közben tölt fel — egy világ, egy modpack, egy csomó beállítás. A szerverébe kerül, amikor az felépül, még mielőtt szólnánk neki, hogy kész.',
    'upload_label' => 'Hogy hívjuk',
    'upload_label_helper' => 'A fájlmező fölötti felirat, a saját szavaiddal. Üresen hagyva egy egyszerű felirat kerül oda.',
    'upload_dir' => 'Hol a szerveren belül',
    'upload_dir_helper' => 'Egy útvonal a szerveren belül, például / vagy /world. Használat előtt biztonságossá tesszük.',
    'upload_extract' => 'Csomagold ki',
    'upload_extract_helper' => 'Bekapcsolva a zip ott csomagolódik ki, ahová megérkezik, és maga az archívum törlődik — ez való egy világhoz vagy egy csomó beállításhoz. Kikapcsolva a zip fájlként marad, és pont ezt akarja az az egg, amelyik ilyenből telepít modpackot.',
    'empty_body' => 'Készíts egyet, és megjelenik a boltban, amint eladásra bocsátod.',
];
