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
];
