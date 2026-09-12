<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Steam App ID", „IGDB", „Twitch client ID" a „client secret" ostávajú po
 * anglicky: to sú presne tie slová, ktoré stoja na stránkach, odkiaľ sa tie
 * hodnoty berú.
 */

return [
    'title' => 'Obrázky eggs',
    'nav_label' => 'Obrázky eggs',
    'subheading' => 'Herné obrázky pre vaše eggs, stiahnuté zo Steamu a z IGDB. Egg bez obrázka ukazuje vlastného vtáka Pelicanu na každej karte servera, ktorý ho používa.',

    // ---- tabuľka ----------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Zamknuté',

    'locked' => 'Zamknuté',
    'unlocked' => 'Voľné',

    // ---- čo sa dá urobiť s riadkom ----------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Číslo v adrese hry na Steame - store.steampowered.com/app/892970 je 892970. Stiahnutie podľa identifikátora obrázok zamkne, lebo napísané číslo je rozhodnutie a neskorší hromadný prechod ho nemá vziať späť.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Hľadať',
    'search_term_helper' => 'Meno egg je predvyplnené, ale len zriedka je to názov hry - „Paper 1.20.4" je Minecraft. Napíšte hru.',

    'lock' => 'Zamknúť',
    'unlock' => 'Odomknúť',
    'locked_done' => 'Zamknuté - hromadný prechod tento nechá tak',
    'unlocked_done' => 'Odomknuté - hromadný prechod smie tento obrázok vymeniť',

    'clear' => 'Vymazať',
    'clear_confirm' => 'Odoberie obrázok a Steam App ID. Egg sa vráti k vlastnému vtákovi Pelicanu a najbližší hromadný prechod to skúsi znova.',
    'cleared' => 'Obrázok odobraný',

    // ---- výsledky ---------------------------------------------------------
    'fetched' => 'Obrázok uložený',
    'failed' => 'Žiadny obrázok sa neuložil',

    /*
     * Po jednom dôvode pre každý prípad, lebo to sú rôzne ťažkosti.
     *
     * Stiahnutie, ktoré padlo na preklepe, a stiahnutie, ktoré padlo, lebo je
     * plný disk, nemajú obe hovoriť „nepodarilo sa" - prvé sa spraví pohľadom na
     * číslo, druhé pohľadom na server.
     */
    'why_bad_id' => 'Toto nie je Steam App ID.',
    'why_not_found' => 'Steam na tejto adrese nič nemá. Skontrolujte App ID - hra bez stránky v obchode nemá ani hlavičkový obrázok.',
    'why_no_match' => 'Pod týmto menom sa nič nenašlo. Skúste, ako sa hra naozaj volá, namiesto mena egg.',
    'why_no_name' => 'Nie je čo hľadať.',
    'why_no_token' => 'Twitch nevydal token. Skontrolujte client ID a secret v „Prihlasovacích údajoch".',
    'why_not_configured' => 'IGDB potrebuje Twitch client ID a secret. Zadajte ich v „Prihlasovacích údajoch".',
    'why_empty' => 'Odpoveď bola prázdna.',
    'why_large' => 'Tento obrázok je oveľa väčší ako ikona a neuložil sa.',
    'why_not_an_image' => 'To, čo prišlo späť, nie je obrázok. Obyčajne to znamená, že chybová stránka odpovedala kódom úspechu.',
    'why_wrong_format' => 'Tento obrázok je vo formáte, ktorý tento panel neuchováva. Pelican drží PNG, JPEG a WebP.',
    'why_unwritable' => 'Obrázok sa nepodarilo zapísať. Skontrolujte, že storage/app/public patrí používateľovi, pod ktorým panel beží, a že sa spustilo php artisan storage:link.',
    'why_unknown' => 'Nevyšlo to, a pre ten dôvod toto nepozná meno.',

    // ---- všetko naraz -----------------------------------------------------
    'bulk' => 'Stiahnuť všetky chýbajúce',
    'bulk_confirm_steam' => 'Hľadá na Steame podľa mena pre každý egg, ktorý nemá obrázok a nie je zamknutý. Zamknuté eggs a tie, ktoré obrázok už majú, sa nechávajú tak. Toto beží na pozadí - dáme vedieť, keď to skončí.',
    'bulk_confirm_both' => 'Hľadá na Steame podľa mena pre každý egg, ktorý nemá obrázok a nie je zamknutý, a potom skúsi IGDB pre to, čo Steam nenašiel. Zamknuté eggs a tie, ktoré obrázok už majú, sa nechávajú tak. Toto beží na pozadí - dáme vedieť, keď to skončí.',

    'bulk_started' => 'Sťahuje sa na pozadí',
    'bulk_started_body' => 'Na veľkom paneli to môže trvať niekoľko minút. Keď bude hotovo, dostanete upozornenie, a z tejto stránky môžete odísť.',

    'bulk_done' => 'Obrázky eggs hotové',
    'bulk_done_body' => 'Stiahnutých :fetched, ponechaných bez zmeny :skipped, bez nálezu :failed. Egg sa nechá tak, keď je zamknutý alebo už obrázok má.',

    'bulk_failed' => 'Hromadný prechod neprebehol',
    'bulk_failed_queue' => 'Nepodarilo sa ho odovzdať do frontu. Na to treba queue worker - skontrolujte, že pelican-queue beží.',

    // ---- prihlasovacie údaje IGDB -----------------------------------------
    'credentials' => 'Prihlasovacie údaje',
    'credentials_helper' => 'Steam funguje aj bez tohto všetkého. Tieto údaje sú len pre IGDB, ktoré pokrýva hry, o ktorých Steam nikdy nepočul - Minecraft a každú jeho odnož, všetko, čo vyšlo na konzole, väčšinu eggs s modmi.',
    'credentials_where' => 'Založte aplikáciu na dev.twitch.tv/console, vygenerujte client secret a oboje sem vložte. Je to zadarmo.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Prihlasovacie údaje uložené',
    'credentials_failed' => 'Prihlasovacie údaje sa nepodarilo uložiť',
];
