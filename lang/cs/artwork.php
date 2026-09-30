<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Steam App ID", „IGDB", „Twitch client ID" a „client secret" zůstávají
 * anglicky: to jsou přesně ta slova, která stojí na stránkách, odkud se ty
 * hodnoty berou.
 */

return [
    'title' => 'Obrázky eggs',
    'nav_label' => 'Obrázky eggs',
    'subheading' => 'Herní obrázky pro vaše eggs: z knihovny obrázků Essentials, ze Steamu nebo z IGDB, nebo váš vlastní. Egg bez obrázku ukazuje vlastního ptáka Pelicanu na každé kartě serveru, který ho používá.',

    // ---- tabulka ----------------------------------------------------------
    'column_name' => 'Egg',
    'column_library' => 'Knihovna',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Zamčeno',

    'locked' => 'Zamčeno',
    'unlocked' => 'Volné',
    'fetch_library' => 'Knihovna',
    'library_logo' => 'Logo',
    'library_logo_helper' => 'Pište pro hledání v knihovně obrázků Essentials. Logo s názvem tohoto egg se vyplní, pokud existuje. Výběr obrázek zamkne, takže ho hromadný průchod nevymění.',
    'upload' => 'Nahrát',
    'upload_file' => 'Obrázek',
    'upload_file_helper' => 'Jakýkoli obrázek do 4 MB, včetně kresby SVG; vše kromě PNG, JPEG a WebP se převede na WebP. Nahraný obrázek je zamčený, takže ho hromadný průchod nevymění.',

    // ---- co se dá udělat s řádkem -----------------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Číslo v adrese hry na Steamu - store.steampowered.com/app/892970 je 892970. Stažení podle identifikátoru obrázek zamkne, protože napsané číslo je rozhodnutí a pozdější hromadný průchod ho nemá vzít zpět.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Hledat',
    'search_term_helper' => 'Jméno egg je předvyplněné, ale jen zřídka je to název hry - „Paper 1.20.4" je Minecraft. Napište hru.',

    'lock' => 'Zamknout',
    'unlock' => 'Odemknout',
    'locked_done' => 'Zamčeno - hromadný průchod tenhle nechá být',
    'unlocked_done' => 'Odemčeno - hromadný průchod smí tenhle obrázek vyměnit',

    'clear' => 'Vymazat',
    'clear_confirm' => 'Odebere obrázek, Steam App ID a logo z knihovny. Egg se vrátí k vlastnímu ptákovi Pelicanu a příští hromadný průchod to zkusí znovu.',
    'cleared' => 'Obrázek odebrán',

    // ---- výsledky ---------------------------------------------------------
    'fetched' => 'Obrázek uložen',
    'failed' => 'Žádný obrázek se neuložil',

    /*
     * Po jednom důvodu pro každý případ, protože to jsou různé potíže.
     *
     * Stažení, které padlo na překlepu, a stažení, které padlo, protože je plný
     * disk, nemají obě říkat „nepovedlo se" - první se spraví pohledem na
     * číslo, druhé pohledem na server.
     */
    'why_bad_id' => 'Tohle není Steam App ID.',
    'why_not_found' => 'Steam na téhle adrese nic nemá. Zkontrolujte App ID - hra bez stránky v obchodě nemá ani hlavičkový obrázek.',
    'why_no_match' => 'Pod tímhle jménem se nic nenašlo. Zkuste, jak se hra doopravdy jmenuje, místo jména egg.',
    'why_no_name' => 'Není co hledat.',
    'why_no_token' => 'Twitch nevydal token. Zkontrolujte client ID a secret v „Přihlašovacích údajích".',
    'why_not_configured' => 'IGDB potřebuje Twitch client ID a secret. Zadejte je v „Přihlašovacích údajích".',
    'why_empty' => 'Odpověď byla prázdná.',
    'why_large' => 'Tenhle obrázek je mnohem větší než ikona a neuložil se.',
    'why_not_an_image' => 'To, co přišlo zpátky, není obrázek. Obvykle to znamená, že chybová stránka odpověděla kódem úspěchu.',
    'why_wrong_format' => 'Tenhle obrázek je ve formátu, který tenhle panel neuchovává. Pelican drží PNG, JPEG a WebP.',
    'why_unwritable' => 'Obrázek se nepodařilo zapsat. Zkontrolujte, že storage/app/public patří uživateli, pod kterým panel běží, a že se spustilo php artisan storage:link.',
    'why_unknown' => 'Nevyšlo to, a pro ten důvod tohle nezná jméno.',
    'why_library_gone' => 'Knihovna obrázků ten obrázek nevydala. Mohl být odstraněn, nebo se ke knihovně nepodařilo připojit.',

    // ---- všechno najednou -------------------------------------------------
    'bulk' => 'Stáhnout všechny chybějící',
    'bulk_confirm_steam' => 'Vyhledá v knihovně obrázků Essentials každý egg, který nemá obrázek a není zamčený, a potom hledá na Steamu podle jména to, co knihovna nemá. Zamčené eggs a ty, které obrázek už mají, se nechávají být. Tohle běží na pozadí - dáme vědět, až to skončí.',
    'bulk_confirm_both' => 'Vyhledá v knihovně obrázků Essentials každý egg, který nemá obrázek a není zamčený, hledá na Steamu podle jména to, co knihovna nemá, a potom zkusí IGDB pro to, co zbude. Zamčené eggs a ty, které obrázek už mají, se nechávají být. Tohle běží na pozadí - dáme vědět, až to skončí.',

    'bulk_started' => 'Stahuje se na pozadí',
    'bulk_started_body' => 'Na velkém panelu to může trvat několik minut. Až bude hotovo, dostanete upozornění, a z téhle stránky můžete odejít.',

    'bulk_done' => 'Obrázky eggs hotové',
    'bulk_done_body' => 'Staženo :fetched, ponecháno beze změny :skipped, bez nálezu :failed. Egg se nechává být, když je zamčený nebo už obrázek má.',

    'bulk_failed' => 'Hromadný průchod neproběhl',
    'bulk_failed_queue' => 'Nepodařilo se ho předat do fronty. K tomu je potřeba queue worker - zkontrolujte, že pelican-queue běží.',

    // ---- přihlašovací údaje IGDB ------------------------------------------
    'credentials' => 'Přihlašovací údaje',
    'credentials_helper' => 'Knihovna obrázků a Steam fungují i bez tohohle všeho. Tyhle údaje jsou jen pro IGDB, které pokrývá hry, které nemá ani jedno z nich - všechno, co vyšlo na konzoli, většinu eggs s mody.',
    'credentials_where' => 'Založte aplikaci na dev.twitch.tv/console, vygenerujte client secret a obojí sem vložte. Je to zdarma.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Přihlašovací údaje uloženy',
    'credentials_failed' => 'Přihlašovací údaje se nepodařilo uložit',
];
