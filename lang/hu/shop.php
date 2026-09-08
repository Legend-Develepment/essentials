<?php

/*
 * Magyar. Kézzel írva.
 *
 * A bolt beállításai, később pedig maga a bolt.
 *
 * Ezt a fájlt szándékosan két olvasó osztja meg. A beállítás-felét a
 * rendszergazda olvassa; a nyilvános és a vásárlói felét - amik a bolt
 * növekedésével kerülnek ide - olyanok olvassák, akik talán sosem hallottak a
 * Pelicanról, és ott minden mondatot nekik kell írni.
 */

return [
    'title' => 'Bolt beállításai',
    'nav_label' => 'Bolt beállításai',
    'subheading' => 'A pénznem, az adó, a számlák sorszámozása és az, amit a nyilvános oldal mond. Ami eladó, az a Csomagok oldalon van.',

    // ---- hol van ---------------------------------------------------------
    'address' => 'A nyilvános bolt itt van:',
    'address_off' => 'A nyilvános oldal ki van kapcsolva. Kapcsold be a „Nyilvános boltoldal" funkciót az Essentials beállításai oldal funkciólistájában, és itt válaszol: :url.',

    // ---- általános -------------------------------------------------------
    'section_general' => 'Pénz',
    'section_general_helper' => 'Egy pénznem az egész boltra. Minden csomag minden ára egy szám ebben.',
    'currency' => 'Pénznem',
    'currency_helper' => 'A módosítás semmit sem vált át: a csomagok árai számok, és a módosítás után az új pénznemben számok.',
    'tax' => 'Adó',
    'tax_helper' => 'Százalék, ami minden számlára külön sorként kerül. A csomagok árai adó nélküliek. Nulla, ha nincs.',
    'tax_suffix' => '%',
    'prefix' => 'A számlaszámok ezzel kezdődnek',
    'prefix_helper' => 'Utána egy növekvő szám. INV- ebből INV-000001 lesz.',

    // ---- megújítások -----------------------------------------------------
    'section_renewals' => 'Megújítások',
    'section_renewals_helper' => 'A havonta, negyedévente vagy évente számlázott csomagokhoz. Egyszeri csomagot ez sosem érint.',
    'notice_days' => 'Ennyi nappal az időszak vége előtt számlázzon',
    'notice_days_helper' => 'Mikor készül a következő számla, és mikor kap róla értesítést a vásárló.',
    'grace' => 'Ennyi nappal a számla esedékessége után függessze fel',
    'grace_helper' => 'Az ezen túl kifizetetlen számla felfüggeszti a szervert — a Pelican saját felfüggesztésével, ami a számla kifizetésekor azonnal megszűnik. A bolt sosem töröl semmit.',
    'days' => 'nap',

    // ---- a nyilvános oldal -----------------------------------------------
    'section_public' => 'A nyilvános oldal',
    'section_public_helper' => 'Fiók nélküli emberek olvassák. Hogy egyáltalán kiszolgálja-e, azt a funkciólista „Nyilvános boltoldal" kapcsolója dönti el.',
    'heading' => 'Címsor',
    'heading_helper' => 'Üresen hagyva a panel saját neve kerül ide.',
    'note' => 'Egy sor a csomagok fölött',
    'note_helper' => 'Hogy elmondd, ki vagy, vagy mit ad a vásárlás. Sima szöveg.',
    'terms_url' => 'Feltételek',
    'terms_url_helper' => 'Egy https-cím. Ha meg van adva, a vásárlás egy erre mutató jelölőnégyzet bepipálásával jár.',

    // ---- kézi fizetés ----------------------------------------------------
    'section_manual' => 'Fizetés szolgáltató nélkül',
    'section_manual_helper' => 'Kifizetetlen számlán jelenik meg, amíg nincs bekapcsolva fizetési szolgáltató: banki adatok, vagy hová kell küldeni a pénzt. Sima szöveg.',
    'pay_note' => 'Hogyan fizess',
    'pay_note_helper' => 'Hagyd üresen, és egy kifizetetlen számla csak annyit mond, hogy kifizetetlen.',

    // ---- a gombok --------------------------------------------------------
    'save' => 'Mentés',
    'saved' => 'Mentve',
    'save_failed' => 'Semmi sem lett mentve',

    /* ---------------------------------------------------------------------
     * Maga a bolt, innen lefelé.
     *
     * Egészen más olvasó: valaki, aki szervert vásárol, aki talán soha nem
     * hallott a Pelicanról, és nem tudja, mi az az egg. Lent semmi sem
     * használja a panel szavait, és minden mondat arra a kérdésre válaszol,
     * amely a vásárlóban az oldal adott pontján tényleg felmerül.
     * ------------------------------------------------------------------- */

    // ---- a bolt ----------------------------------------------------------
    'store_title' => 'Bolt',
    'store_nav_label' => 'Bolt',
    'store_subheading' => 'Válassz egy szervert. Létrejön neked, amint a számla ki van fizetve.',
    'store_empty' => 'Jelenleg semmi nincs eladó',
    'store_empty_body' => 'Nézz vissza később, vagy kérdezd meg azt, aki ezt a panelt viszi.',

    'buy' => 'Megveszem',
    'sold_out' => 'Elfogyott',
    'plus_setup' => 'plusz :amount egyszer',

    'spec_memory' => ':amount MiB memória',
    'spec_disk' => ':amount MiB tárhely',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count mentés',
    'spec_databases' => ':count adatbázis',

    // ---- a nyilvános oldal -----------------------------------------------
    'public_empty' => 'Jelenleg semmi nincs eladó',
    'public_empty_body' => 'Nézz vissza később.',
    'to_panel' => 'Bejelentkezés',
    'terms' => 'Feltételek',
    'sign_in_note' => 'Válassz alább egy szervert. A befejezéshez bejelentkezel, és a szerver akkor jön létre, amikor a számla ki van fizetve.',

    // ---- a rendelés ------------------------------------------------------
    'checkout_title' => 'Rendelés',
    'tax_line' => 'Adó (:rate%)',
    'coupon' => 'Kuponkód',
    'coupon_placeholder' => 'Ha van',
    'coupon_bad' => 'Ez a kód itt nem érvényes.',
    'coupon_good' => 'A kód érvényesítve.',
    'agree' => 'Elfogadom a',
    'place_order' => 'Rendelés leadása',
    'place_order_note' => 'Ez számlát ír. Semmit nem terhelünk, amíg nem fizetsz, és a szerver akkor jön létre, amikor a számla ki van fizetve.',
    'back_to_store' => 'Vissza a boltba',

    'placed' => 'A rendelés leadva',
    'placed_body' => 'A(z) :number számla ott vár a számlázási oldaladon.',

    'refused' => 'Ezt nem lehetett megvenni',
    'refused_gone' => 'Már nincs eladó.',
    'refused_sold_out' => 'Az utolsó is elkelt.',
    'refused_bad_coupon' => 'A kuponkód erre nem érvényes.',
    'refused_failed' => 'Valami hiba történt a rendelés rögzítésekor. Semmit nem terheltünk. Próbáld újra, és szólj annak, aki ezt a panelt viszi, ha újra előfordul.',

    // ---- számlázás -------------------------------------------------------
    'billing_title' => 'Számlázás',
    'billing_nav_label' => 'Számlázás',
    'billing_subheading' => 'Amit vettél, és amivel tartozol.',
    'your_orders' => 'A rendeléseid',
    'your_invoices' => 'A számláid',
    'no_orders' => 'Még nem vettél semmit',
    'no_orders_body' => 'Minden, amit veszel, itt jelenik meg a szerverével és a dátumaival együtt.',
    'no_invoices' => 'Még nincsenek számlák',
    'to_store' => 'Irány a bolt',
    'renews' => 'Megújul',
    'ask_how_to_pay' => 'Kérdezd meg attól, aki ezt a panelt viszi, hogyan fizethetsz. Ide még nem írta le.',
    'order_pending' => 'A számla kifizetésére vár. Rögtön utána létrejön a szerver.',
    'order_suspended' => 'Kifizetetlen számla miatt megállítva. A kifizetése újraindítja a szervert - semmi sem lett törölve.',

    // ---- fizetés ---------------------------------------------------------
    'pay_with' => 'Fizetés ezzel:',
    'pay_now' => 'Fizetés',
    'pay_description' => ':number számla',
    'pay_thanks' => 'Köszönjük. A számla ki van fizetve.',
    'pay_pending' => 'A szolgáltató még nem erősítette meg. Ez az oldal frissül, amint megteszi.',
    'pay_refused' => 'Ez nem indult el',
    'pay_refused_body' => 'A fizetést nem sikerült megnyitni. Próbáld máshogy, vagy kérdezd azt, aki ezt a panelt viszi.',
    'gateway_mollie' => 'Mollie',

    // ---- a szolgáltató beállításai ---------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Egyetlen fiókon át fogadja az iDEAL-t, a kártyákat, a Bancontactot és a többit. A teszt és az éles ugyanaz a beállítás: maga a kulcs mondja meg, melyik fiókhoz tartozik.',
    'mollie_on' => 'Mollie felkínálása',
    'mollie_on_helper' => 'Kikapcsolva minden számláról leveszi a gombot. Ami már ki van fizetve, kifizetve marad.',
    'mollie_key' => 'API-kulcs',
    'mollie_key_helper' => 'A Mollie vezérlőpultod Developers részéből. Soha nem kerül bele exportált beállításfájlba.',
    'mollie_hook' => 'Webhook-cím',
    'mollie_hook_helper' => 'A Mollie ide jelez: :url - a panelednek elérhetőnek kell lennie ott az internetről.',
];
