<?php

/*
 * Magyar. Kézzel írva.
 *
 * Egy út befelé kívülről.
 *
 * Kétféle olvasó egyetlen fájlban, és mindkettő mást akar. Az adminisztrátor,
 * aki ezt az oldalt olvassa, épp azt dönti el, meri-e valakire bízni egy
 * kulcsot, ezért itt minden sor azt mondja meg, meddig ér el egy kulcs, nem
 * azt, hogy hívják. Aki kér egyet, azt akarja tudni, mit kap a kezébe és mi
 * történik, ha elveszíti, és ezért nem lábjegyzet az a mondat, hogy egy kulcs
 * csak egyszer jelenik meg.
 *
 * Itt semmi sem mondja azt, hogy „token”. A „kulcs” az a szó a Pelican saját
 * fiókoldalán, és egy panel, amely ugyanazt kétféleképp nevezi, olyan panel,
 * ahol valaki rosszat keres.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Kulcsok, amelyekkel a panelen kívüli valami lekérdezheti azt, amit ez a bővítmény tud. Csak olvasás — itt semmi sem tud szervert indítani, leállítani vagy elérni.',

    'my_title' => 'API-hozzáférés',
    'my_nav_label' => 'API-hozzáférés',
    'my_subheading' => 'Egy saját kulcs, egy bothoz vagy egy szkripthez. Csak azokra a szerverekre válaszol, amelyeket már meg tudsz nyitni.',

    // ---- mi egy kulcs, egyszer kimondva, ott ahol számít ------------------
    'address' => 'A cím',
    'address_helper' => 'Küldd a kulcsot Authorization fejlécként: :example',

    /*
     * Az az egy dolog, amelyet valakinek el kell olvasnia, mielőtt bezárja az
     * ablakot. Annak írva, mit kell tenni, nem figyelmeztetésnek, mert a
     * „vigyázz rá jól” olyan tanács, amelyre senki nem tud cselekedni, az
     * „illeszd be oda, ahol a bot olvassa, most” pedig igen.
     */
    'once' => 'Ez az egyetlen alkalom, amikor ez a kulcs megjelenik',
    'once_body' => 'Hashként tárolódik, tehát senki — az sem, aki ezt a panelt üzemelteti — nem tudja visszaolvasni. Illeszd be oda, ahol a bot vagy a szkript olvassa, most. Ha elvész, vond vissza ezt, és kérj újat.',
    'copy' => 'Másolás',
    'copied' => 'Másolva',

    // ---- az állapotok ----------------------------------------------------
    'state' => 'Állapot',
    'state_pending' => 'Várakozik',
    'state_active' => 'Aktív',
    'state_refused' => 'Elutasítva',
    'state_revoked' => 'Visszavonva',

    'state_pending_body' => 'Valakinek engedélyt kell adnia, mielőtt bármire is válaszolna.',
    'state_refused_body' => 'Erre nemet mondtak. Semmi sem lett kiadva.',
    'state_revoked_body' => 'Ezt a kulcsot elvették, és már nem válaszol.',

    // ---- a hatókör -------------------------------------------------------
    'scope' => 'Meddig ér',
    'scope_person' => 'A saját szervereiig',
    'scope_panel' => 'Az egész panelig',

    'scope_person_helper' => 'Csak azokra a szerverekre válaszol, amelyeket a tulajdonos már meg tud nyitni, ugyanúgy lekérdezve, ahogy a panel kérdez. Ennek a kulcsnak az elvesztése semmit sem veszít el, amit a tulajdonos ne látna amúgy is.',
    'scope_panel_helper' => 'Azokra a kérdésekre válaszol, amelyek az egész panelt érintik — minden node, a kapacitás, az őrkutya, magának a panelnek a gazdagépe. Olyan bothoz, amely a panelről jelent, nem egy személy nevében.',

    // ---- a táblázat ------------------------------------------------------
    'column_name' => 'Mihez',
    'column_owner' => 'Kié',
    'column_prefix' => 'Kulcs',
    'column_asked' => 'Kérve',
    'column_used' => 'Utoljára használva',
    'column_expires' => 'Lejár',

    'never_used' => 'Soha',
    'no_expiry' => 'Visszavonásig',

    'tab_waiting' => 'Várakozik',
    'tab_active' => 'Aktívak',
    'tab_all' => 'Mind',

    'empty' => 'Még nincsenek kulcsok',
    'empty_body' => 'Senki sem kért egyet, és egy sem lett kiadva. Ez az oldal magától telik meg, ahogy az emberek megteszik.',

    'my_empty' => 'Nincs kulcsod',
    'my_empty_body' => 'Kérj egyet, és megjelenik itt azzal a válasszal együtt, amelyet kapott.',

    // ---- a kérés ---------------------------------------------------------
    'ask' => 'Kérj kulcsot',
    'ask_name' => 'Mire szolgál',
    'ask_name_helper' => 'Néhány szó, hogy később megkülönböztess két sajátot, és hogy aki engedélyt ad, tudja, mihez ad engedélyt.',
    'ask_reason' => 'Valami, amit érdemes hozzátenni',
    'ask_reason_helper' => 'Nem kötelező. Az olvassa, aki dönt.',
    'ask_sent' => 'Kérve',
    'ask_sent_body' => 'Megjelenik lent, amint valaki válaszolt.',
    'ask_granted' => 'Itt a kulcsod',
    'ask_open' => 'Már van egy, amely válaszra vár',
    'ask_open_body' => 'Egyszerre egy kérés. Vond vissza, ha tévedés volt.',
    'ask_failed' => 'A kérést nem sikerült elküldeni',

    'cancel' => 'Mégse',
    'cancel_confirm' => 'Visszavonja a kérést. Semmi sem lett kiadva, tehát semmi sem áll le működni.',

    // ---- a döntés --------------------------------------------------------
    'grant' => 'Engedély megadása',
    'grant_confirm' => 'Kiad egy kulcsot, amely ennek a személynek a saját szervereire válaszol, és egyszer megmutatja. Ő már mindent lát, amit az jelenteni fog — ez azt dönti el, hogy egy panelen kívüli valami kérdezhet-e a nevében.',
    'granted' => 'Megadva',

    'refuse' => 'Elutasítás',
    'refuse_answer' => 'Mit tudjanak meg',
    'refuse_answer_helper' => 'Nem kötelező, és a saját oldalukon jelenik meg. Egy indoklás nélküli elutasítás olyan, amelyet jövő héten újra kérnek.',
    'refused' => 'Elutasítva',

    'revoke' => 'Visszavonás',
    'revoke_confirm' => 'A kulcs azonnal felhagy a válaszolással, és a hashe eltűnik, tehát nem szerezhető vissza. Minden, ami használja, megáll. Kérj újat, ahelyett hogy ezt visszavonnád.',
    'revoked' => 'Visszavonva',

    'mint' => 'Új kulcs',
    'mint_body' => 'Bothoz, nem személyhez. Abban a pillanatban engedélyt kap, amikor létrejön, mert te vagy az, aki igent mondott volna rá.',
    'mint_owner' => 'Ki ő',
    'mint_owner_helper' => 'Egy kulcs valakiként válaszol. Egy egész panelre szóló kulcsnál ez csak az, ki felel érte; egy személyesnél az is, mit láthat a kulcs.',
    'minted' => 'Létrehozva',

    // ---- amit egy adminisztrátor beállít ---------------------------------
    'settings' => 'Így működik',
    'approval' => 'A kérések engedélyre várnak',
    'approval_helper' => 'Bekapcsolva a kulcsot kérő akkor kapja meg, ha valaki igent mond. Kikapcsolva azonnal megkapja — ami ésszerű egy olyan panelen, ahol mindenki, akinek fiókja van, már megbízható, és amit érdemes választani, nem pedig belesodródni.',
    'rate' => 'Kérés percenként, kulcsonként',
    'rate_helper' => 'Egy bot, amely negyven szervertől kérdezi meg, kik játszanak, negyven kérdés negyven játékszerverhez. Ez az a plafon, amely megakadályozza, hogy egy hajnali háromkor írt ciklus terheléspróbává váljon.',
    'days' => 'Egy megadott kulcs eltart',
    'days_helper' => 'Napokban. A nulla azt jelenti: visszavonásig, és ez az alapértelmezés — egy kulcs, amely úgy jár le, hogy senki sem figyel, olyan bot, amely éjjel megáll anélkül, hogy bárhol is megmondaná, miért.',
    'days_never' => 'Visszavonásig',

    /*
     * Az oldalon kimondva, nem felfedezésre hagyva. A Pelican visszagörgeti egy
     * bővítmény migrációit, amikor eltávolítják, és ennek a bővítménynek az
     * egyetlen táblája vele megy.
     */
    'uninstall_note' => 'Ennek a bővítménynek az eltávolítása minden kulcsot eltávolít vele. Ez szándékos — egy kulcs, amely túléli azt, ami válaszol rá, olyan bejelentkezés, amelyet senki sem tud visszavonni.',
];
