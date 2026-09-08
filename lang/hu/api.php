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
    'collect' => 'Mutasd a kulcsomat',
    'state_ready_body' => 'Megadva. Nyomd meg a Mutasd a kulcsomat gombot, hogy lásd — egyszer, mert hashként tárolódik, és utána nem olvasható vissza.',
    'replace' => 'Csere',
    'replace_confirm' => 'Ez a kulcs azonnal felhagy a működéssel, és egy új lép a helyére, egyszer megmutatva. A régit sehol nem lehet visszakeresni — sosem lett eltárolva —, így a csere az egyetlen válasz arra, hogy elveszett.',
    'granted_body' => 'Ő maga veszi át a saját API-hozzáférés oldalán. Itt nem jelenik meg: a kulcs azé, aki kérte, nem azé, aki igent mondott rá.',

    'revoke' => 'Visszavonás',
    'revoke_confirm' => 'A kulcs azonnal felhagy a válaszolással, és a hashe eltűnik, tehát nem szerezhető vissza. Minden, ami használja, megáll. Kérj újat, ahelyett hogy ezt visszavonnád.',
    'revoked' => 'Visszavonva',
    'forget' => 'Eltávolítás',
    'forget_confirm' => 'Végleg leveszi a sort erről az oldalról. Már felhagyott a válaszolással, tehát semmi működő nem áll meg - ez csak azt a nyomot törli, hogy létezett.',
    'forgotten' => 'Eltávolítva',

    'mint' => 'Új kulcs',
    'mint_body' => 'Bothoz, nem személyhez. Abban a pillanatban engedélyt kap, amikor létrejön, mert te vagy az, aki igent mondott volna rá.',
    'abilities' => 'Mit kérdezhet',
    'abilities_helper' => 'Kezdetben minden be van jelölve, mert ez volt egy kulcs, mielőtt ez létezett. A jelölés levétele a szándékos tett. Az engedélyezett lista tárolódik, tehát egy későbbi kiadásban hozzátett képesség ki van kapcsolva az azelőtt készült kulcsokon - amit senki sem jelölt be, azt senki sem adta meg.',
    'ability_health' => 'A kulcs működésének bizonyítása',
    'ability_health_helper' => 'Semmi máshoz nem ér el. Nyugodtan hívható időzítve.',
    'ability_me' => 'A saját szerverei',
    'ability_me_helper' => 'Azok a szerverek, amelyeket a tulajdonosa már meg tud nyitni, és azok mentései. Soha senki mást nem láthat.',
    'ability_panel' => 'Az egész panel',
    'ability_panel_helper' => 'Minden node, minden mentés, a megállt ütemezések, az őrkutya és a panel gazdagépe. Ehhez egész panelre szóló kulcs is kell.',
    'ability_live' => 'Közvetlen kérdés egy szerverhez',
    'ability_live_helper' => 'Ki játszik, és fut-e egy szerver. Az egyetlen kérdések, amelyek kerülnek valamibe — elérnek egy játékszervert vagy egy daemont, tizenöt-húsz másodpercig gyorsítótárazva.',
    'ability_connect' => 'Discord-fiókok összekötése panelfiókokkal',
    'ability_connect_helper' => 'Az egyetlen csoport, amely nem olvasás. Pelican API-kulcsokat hoz létre azok fiókján, akik kérik, és meg tud szüntetni egy összekötést. Csak annak a botnak add meg, amelyiknek kell.',
    'own_rate' => 'Kérés percenként ehhez a kulcshoz',
    'own_rate_helper' => 'Hagyd üresen, hogy a panel beállítását kövesse. Az ide írt szám csak erre a kulcsra vonatkozik. A nulla azt jelenti, hogy nincs plafon — ésszerű egy saját gépeden futó bothoz, és valódi módja annak, hogy megbánd, ha a kulcs máshová kerül.',
    'own_rate_default' => 'A panelt követi',
    'mint_owner' => 'Ki ő',
    'mint_owner_helper' => 'Egy kulcs valakiként válaszol. Egy egész panelre szóló kulcsnál ez csak az, ki felel érte; egy személyesnél az is, mit láthat a kulcs.',
    'minted' => 'Létrehozva',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Kulcs az Essentials API-hoz',
    'profile_make_helper' => 'Más API, mint a fenti: ez arra válaszol, amit ez a bővítmény tud — melyik szerverednek nincs mentése, ki játszik rajtuk, futnak-e. Mindig csak érted válaszol, és csak azokat a szervereket éri el, amelyeket már meg tudsz nyitni.',
    'profile_create' => 'Létrehozás',
    'profile_yours' => 'Az Essentials-kulcsaid',
    'profile_manage' => 'Egy kulcs visszavonása, annak megnézése, miért lett elutasítva, és a Discord összekötése mind az oldalsávban lévő API-hozzáférés oldalon van.',
    'discord' => 'Discord',
    'discord_body' => 'Kösd össze a Discord-fiókodat ezzel, hogy egy bot válaszolhasson a szervereidről, amikor megkéred rá. Amit kap, az egy kulcs, amely pontosan addig ér el, ameddig te, és tovább nem.',
    'discord_connect' => 'Discord összekötése',
    'discord_code' => 'Írd be ezt a Discordban tíz percen belül',
    'discord_code_body' => 'Küldd el a(z) :command parancsot egy csatornán, amelyet a bot olvashat. A kód egyszer működik. Csak az a fiók használhatja, amelyhez készült.',
    'discord_on' => ':name néven összekötve',
    'discord_since' => ':when óta',
    'discord_cut' => 'Szétkapcsolva',
    'discord_cut_confirm' => 'Megszünteti az összekötést, és törli a kulcsot, amit létrehozott, így a bot azonnal felhagy azzal, hogy helyetted válaszoljon. Bármikor újra összekötheted.',
    'discord_off' => 'Nincs összekötve',
    'discord_key_note' => 'Az összekötés létrehoz a fiókodon egy Pelican API-kulcsot Discord (Essentials) néven. A Fiók → API-kulcsok alatt láthatod és vissza is vonhatod — ez az oldal csak egy gyorsút ugyanahhoz.',
    'docs_title' => 'Hogyan használd ezt az API-t',
    'docs_subheading' => 'Mire válaszol ez a panel, és milyen címeken. Ugyanabból a leírásból íródott, amelyből az API épül, tehát nem lehet egy kiadással lemaradva.',
    'docs_base' => 'Hol található',
    'docs_endpoints' => 'Végpontok',
    'docs_answers' => 'Mi jön vissza',
    'docs_calls' => 'Mely kulcsok hívhatják',
    'docs_params' => 'Mit kell küldeni',
    'docs_required' => 'kötelező',
    'docs_optional' => 'nem kötelező',
    'docs_try' => 'Próbáld ki',
    'docs_errors' => 'Ha valami nincs rendben',
    'docs_hook' => 'Amit a panel küld neked',
    'docs_hook_body' => 'A másik irány, és ennek az egyetlen része, amely kérés nélkül érkezik. A Riasztások alatt kapcsolható be egy címmel és egy aláírási titokkal: egy JSON-küldés, amikor az őrkutya talál valamit, és egy, amikor rendeződik, hogy egy bot értesüljön a halott node-ról ahelyett, hogy percenként kérdezné, van-e ilyen.',
    'docs_hook_verify' => 'A törzs a te titkoddal van hashelve, és a hash az X-Essentials-Signature fejlécben utazik sha256=<hex> alakban. A nyers törzset hasheld, ne egy újra sorosított objektumot — a szóközök vagy a kulcsok sorrendjének bármilyen eltérése más hasht ad, és az eltérés inkább támadásnak látszik, mint hibának.',
    'docs_download_md' => 'Letöltés Markdownként',
    'docs_download_json' => 'Letöltés OpenAPI-ként',

    // ---- amit egy adminisztrátor beállít ---------------------------------
    'settings' => 'Így működik',
    'approval' => 'A kérések engedélyre várnak',
    'approval_helper' => 'Bekapcsolva a kulcsot kérő akkor kapja meg, ha valaki igent mond. Kikapcsolva azonnal megkapja — ami ésszerű egy olyan panelen, ahol mindenki, akinek fiókja van, már megbízható, és amit érdemes választani, nem pedig belesodródni.',
    'rate' => 'Kérés percenként, kulcsonként',
    'rate_helper' => 'Egy bot, amely negyven szervertől kérdezi meg, kik játszanak, negyven kérdés negyven játékszerverhez. Ez az a plafon, amely megakadályozza, hogy egy hajnali háromkor írt ciklus terheléspróbává váljon.',
    'days' => 'Egy megadott kulcs eltart',
    'days_helper' => 'Napokban. A nulla azt jelenti: visszavonásig, és ez az alapértelmezés — egy kulcs, amely úgy jár le, hogy senki sem figyel, olyan bot, amely éjjel megáll anélkül, hogy bárhol is megmondaná, miért.',
    'days_never' => 'Visszavonásig',
    'hide_pelican' => 'A panel saját API-kulcsok fülének eltávolítása',
    'hide_pelican_helper' => 'Teljesen leveszi az API-kulcsok fület a fiók profiljáról, így azon az oldalon csak egy dolgot hívnak API-kulcsoknak. Az oldalról törlődik, nem pedig el van fedve, tehát nem marad cím, amely elérné. Egyvalamit nem tud: a panel saját kliens-API-ja továbbra is készít fiókkulcsot bárminek, ami közvetlenül kéri — a fül az a hely, ahol az emberek kézzel készítenek egyet, és ez veszi el a kezet. A már meglévő kulcsok tovább működnek.',

    /*
     * Az oldalon kimondva, nem felfedezésre hagyva. A Pelican visszagörgeti egy
     * bővítmény migrációit, amikor eltávolítják, és ennek a bővítménynek az
     * egyetlen táblája vele megy.
     */
    'uninstall_note' => 'Ennek a bővítménynek az eltávolítása minden kulcsot eltávolít vele. Ez szándékos — egy kulcs, amely túléli azt, ami válaszol rá, olyan bejelentkezés, amelyet senki sem tud visszavonni.',
];
