<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „Steam App ID”, „IGDB”, „Twitch client ID” és „client secret” angolul
 * marad: pontosan ezek a szavak állnak azokon az oldalakon, ahonnan az értékek
 * származnak.
 */

return [
    'title' => 'Egg-képek',
    'nav_label' => 'Egg-képek',
    'subheading' => 'Játékképek az eggjeidhez, a Steamről és az IGDB-ről letöltve. Egy kép nélküli egg a Pelican saját madarát mutatja minden szerverkártyán, amely használja.',

    // ---- a táblázat ------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Zárolva',

    'locked' => 'Zárolva',
    'unlocked' => 'Nyitva',

    // ---- mit lehet egy sorral tenni --------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Az a szám a játék Steam-áruházbeli címében - a store.steampowered.com/app/892970 az 892970. Az azonosító alapján letöltés zárolja a képet, mert egy szám beírása döntés, és egy későbbi tömeges futásnak nem szabad visszavonnia.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Keresés erre',
    'search_term_helper' => 'Az egg neve ki van töltve, de ritkán ez a játék neve - a „Paper 1.20.4” a Minecraft. Írd be a játékot.',

    'lock' => 'Zárolás',
    'unlock' => 'Feloldás',
    'locked_done' => 'Zárolva - a tömeges letöltés békén hagyja',
    'unlocked_done' => 'Feloldva - a tömeges letöltés lecserélheti ezt a képet',

    'clear' => 'Törlés',
    'clear_confirm' => 'Eltávolítja a képet és a Steam App ID-t. Az egg visszatér a Pelican saját madarához, és a következő tömeges letöltés újra próbálkozik.',
    'cleared' => 'Kép eltávolítva',

    // ---- kimenetek -------------------------------------------------------
    'fetched' => 'Kép mentve',
    'failed' => 'Egy kép sem lett mentve',

    /*
     * Külön ok mindegyikhez, mert különböző gondok.
     *
     * Egy elgépelés miatt elbukott letöltés és egy tele lemez miatt elbukott
     * nem mondhatja mindkettő azt, hogy „sikertelen” - az elsőt a szám
     * megnézése orvosolja, a másodikat a szerveré.
     */
    'why_bad_id' => 'Ez nem Steam App ID.',
    'why_not_found' => 'A Steamen nincs semmi azon a címen. Ellenőrizd az App ID-t - egy játéknak, amelynek nincs áruházi oldala, fejlécképe sincs.',
    'why_no_match' => 'Azon a néven nem található semmi. Próbáld azt, ahogy a játékot valójában hívják, nem azt, ahogy az egget.',
    'why_no_name' => 'Nincs mire keresni.',
    'why_no_token' => 'A Twitch nem adott ki tokent. Ellenőrizd a client ID-t és a secretet az Adatok alatt.',
    'why_not_configured' => 'Az IGDB-hez Twitch client ID és secret kell. Állítsd be őket az Adatok alatt.',
    'why_empty' => 'A válasz üres volt.',
    'why_large' => 'Az a kép sokkal nagyobb egy ikonnál, ezért nem lett elmentve.',
    'why_not_an_image' => 'Ami visszaérkezett, az nem kép. Ez rendszerint azt jelenti, hogy egy hibaoldal válaszolt sikerkóddal.',
    'why_wrong_format' => 'Az a kép olyan formátumú, amelyet ez a panel nem tárol. A Pelican a PNG-t, a JPEG-et és a WebP-t tartja meg.',
    'why_unwritable' => 'A képet nem sikerült kiírni. Ellenőrizd, hogy a storage/app/public azé a felhasználóé-e, amelyként a panel fut, és hogy lefutott-e a php artisan storage:link.',
    'why_unknown' => 'Nem sikerült, és az ok nem olyan, amelyre ennek van neve.',

    // ---- minden egyszerre ------------------------------------------------
    'bulk' => 'Töltsd le az összes hiányzót',
    'bulk_confirm_steam' => 'Név szerint keres a Steamen minden olyan egghez, amelynek nincs képe és nincs zárolva. A zárolt eggeket és azokat, amelyeknek már van képe, békén hagyja. Ez a háttérben fut - értesítést kapsz, ha végzett.',
    'bulk_confirm_both' => 'Név szerint keres a Steamen minden olyan egghez, amelynek nincs képe és nincs zárolva, majd az IGDB-vel próbálkozik mindazzal, amit a Steam nem talált. A zárolt eggeket és azokat, amelyeknek már van képe, békén hagyja. Ez a háttérben fut - értesítést kapsz, ha végzett.',

    'bulk_started' => 'Letöltés a háttérben',
    'bulk_started_body' => 'Egy nagy panelen ez több percig is tarthat. Értesítést kapsz, ha kész, és elhagyhatod ezt az oldalt.',

    'bulk_done' => 'Az egg-képek elkészültek',
    'bulk_done_body' => ':fetched letöltve, :skipped békén hagyva, :failed esetben nem talált semmit. Egy egget akkor hagy békén, ha zárolva van, vagy már van képe.',

    'bulk_failed' => 'A tömeges letöltés nem futott le',
    'bulk_failed_queue' => 'Nem sikerült átadni a sornak. Ehhez queue worker kell - ellenőrizd, hogy fut-e a pelican-queue.',

    // ---- IGDB-adatok -----------------------------------------------------
    'credentials' => 'Adatok',
    'credentials_helper' => 'A Steam ezek nélkül is működik. Ezek csak az IGDB-hez kellenek, amely azokat a játékokat fedi le, amelyekről a Steam soha nem hallott - a Minecraftot és minden elágazását, mindent, ami konzolra jelent meg, a legtöbb moddolt egget.',
    'credentials_where' => 'Hozz létre egy alkalmazást a dev.twitch.tv/console címen, generálj egy client secretet, és illeszd be ide mindkettőt. Ingyenes.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Adatok mentve',
    'credentials_failed' => 'Az adatokat nem sikerült menteni',
];
