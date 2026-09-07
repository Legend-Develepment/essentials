<?php

/*
 * Čeština. Psáno ručně.
 *
 * Cesta dovnitř zvenčí panelu.
 *
 * Dva druhy čtenářů v jednom souboru, a chtějí opačné věci. Administrátor,
 * který tuhle stránku čte, se rozhoduje, jestli někomu svěří klíč, takže každý
 * řádek tady říká, kam klíč dosáhne, a ne jak se jmenuje. Ten, kdo o klíč
 * žádá, chce vědět, co dostává do ruky a co se stane, když ho ztratí — a proto
 * ta věta o tom, že se klíč ukáže jen jednou, není poznámka pod čarou.
 *
 * Nikde tady nestojí „token". „Klíč" je slovo z vlastní stránky účtu v
 * Pelicanu, a panel, který stejnou věc pojmenovává dvakrát jinak, je panel, kde
 * někdo hledá to špatné.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Klíče, které umožní něčemu mimo panel zeptat se na to, co tenhle plugin ví. Jen ke čtení — nic tady nespustí server, nezastaví ho ani na něj nedosáhne.',

    'my_title' => 'Přístup k API',
    'my_nav_label' => 'Přístup k API',
    'my_subheading' => 'Vlastní klíč, pro bota nebo skript. Odpovídá jen za ty servery, které stejně můžete otevřít.',

    // ---- co je klíč, řečeno jednou, tam kde na tom záleží ----------------
    'address' => 'Adresa',
    'address_helper' => 'Posílejte klíč jako hlavičku Authorization: :example',

    /*
     * Jediná věc, kterou musí mít člověk přečtenou, než okno zavře. Napsaná
     * jako co udělat, ne jako varování, protože „uložte ho někam bezpečně" je
     * rada, se kterou nikdo nic neudělá, a „vložte ho teď tam, kde ho čte bot",
     * ano.
     */
    'once' => 'Tohle je jediný okamžik, kdy je tenhle klíč vidět',
    'once_body' => 'Ukládá se jako otisk, takže ho nikdo — ani ten, kdo tenhle panel provozuje — nepřečte zpátky. Vložte ho teď tam, kde ho čte bot nebo skript. Když se ztratí, tenhle zrušte a požádejte o další.',
    'copy' => 'Kopírovat',
    'copied' => 'Zkopírováno',

    // ---- stavy -----------------------------------------------------------
    'state' => 'Stav',
    'state_pending' => 'Čeká',
    'state_active' => 'Platný',
    'state_refused' => 'Zamítnuto',
    'state_revoked' => 'Zrušen',

    'state_pending_body' => 'Někdo to musí schválit, než klíč na cokoli odpoví.',
    'state_refused_body' => 'Tohle bylo zamítnuto. Nic se nevydalo.',
    'state_revoked_body' => 'Tenhle klíč byl odebrán a už neodpovídá.',

    // ---- dosah -----------------------------------------------------------
    'scope' => 'Dosáhne na',
    'scope_person' => 'Vlastní servery',
    'scope_panel' => 'Celý panel',

    'scope_person_helper' => 'Odpovídá jen za ty servery, které jeho majitel stejně může otevřít, a ptá se na ně stejně jako panel. Ztratit tenhle klíč neznamená ztratit nic, co jeho majitel už tak neviděl.',
    'scope_panel_helper' => 'Odpovídá na otázky o celém panelu — každý uzel, kapacitu, watchdog, samotný stroj panelu. Pro bota, který podává zprávu o panelu, ne pro člověka.',

    // ---- tabulka ---------------------------------------------------------
    'column_name' => 'K čemu',
    'column_owner' => 'Čí',
    'column_prefix' => 'Klíč',
    'column_asked' => 'Požádáno',
    'column_used' => 'Naposledy použit',
    'column_expires' => 'Vyprší',

    'never_used' => 'Nikdy',
    'no_expiry' => 'Dokud se nezruší',

    'tab_waiting' => 'Čekající',
    'tab_active' => 'Platné',
    'tab_all' => 'Všechny',

    'empty' => 'Zatím žádné klíče',
    'empty_body' => 'Nikdo o žádný nepožádal a žádný nebyl vydán. Tahle stránka se plní sama, jak to lidé dělají.',

    'my_empty' => 'Nemáte žádný klíč',
    'my_empty_body' => 'Požádejte o jeden a objeví se tady i s tím, co vám na to odpověděli.',

    // ---- žádost ----------------------------------------------------------
    'ask' => 'Požádat o klíč',
    'ask_name' => 'K čemu je',
    'ask_name_helper' => 'Pár slov, ať později rozeznáte dva vlastní od sebe a ten, kdo ho schvaluje, ví, co schvaluje.',
    'ask_reason' => 'Cokoli, co stojí za dopsání',
    'ask_reason_helper' => 'Nepovinné. Čte to ten, kdo rozhoduje.',
    'ask_sent' => 'Požádáno',
    'ask_sent_body' => 'Objeví se níž, jakmile někdo odpoví.',
    'ask_granted' => 'Tady je váš klíč',
    'ask_open' => 'Jeden už máte a čeká na odpověď',
    'ask_open_body' => 'Jedna žádost naráz. Stáhněte tamtu, jestli to byl omyl.',
    'ask_failed' => 'O tohle se nepodařilo požádat',

    'cancel' => 'Stáhnout',
    'cancel_confirm' => 'Stáhne žádost. Nic se nevydalo, takže také nic nepřestane fungovat.',

    // ---- rozhodování -----------------------------------------------------
    'grant' => 'Schválit',
    'grant_confirm' => 'Vydá klíč, který odpovídá za vlastní servery tohohle člověka, a ukáže ho jednou. Všechno, co klíč nahlásí, ten člověk stejně vidí — tady se rozhoduje, jestli se na to smí něco mimo panel ptát jeho jménem.',
    'granted' => 'Schváleno',

    'refuse' => 'Zamítnout',
    'refuse_answer' => 'Co jim říct',
    'refuse_answer_helper' => 'Nepovinné, a vidí to na své vlastní stránce. Zamítnutí bez důvodu je zamítnutí, o které se příští týden požádá znovu.',
    'refused' => 'Zamítnuto',

    'revoke' => 'Zrušit',
    'revoke_confirm' => 'Klíč okamžitě přestane odpovídat a jeho otisk se smaže, takže ho nejde vrátit. Všechno, co ho používá, se zastaví. Požádejte o nový místo toho, abyste tohle chtěli vzít zpět.',
    'revoked' => 'Zrušen',

    'mint' => 'Nový klíč',
    'mint_body' => 'Pro bota, ne pro člověka. Je schválený v okamžiku, kdy vzniká, protože ten, kdo by ho schvaloval, jste vy.',
    'mint_owner' => 'Čí je',
    'mint_owner_helper' => 'Klíč odpovídá jménem někoho. U klíče na celý panel je to jen ten, kdo za něj ručí; u osobního je to zároveň i to, co klíč vidí.',
    'minted' => 'Vytvořen',

    // ---- co nastavuje administrátor --------------------------------------
    'settings' => 'Jak to funguje',
    'approval' => 'Žádosti čekají na schválení',
    'approval_helper' => 'Zapnuto — kdo požádá o klíč, dostane ho, až někdo řekne ano. Vypnuto — dostane ho rovnou, což na panelu, kde je každý s účtem stejně důvěryhodný, dává smysl a stojí za to to zvolit, ne se k tomu dostat nedopatřením.',
    'rate' => 'Dotazů za minutu, na klíč',
    'rate_helper' => 'Bot, který se ptá čtyřiceti serverů, kdo hraje, je čtyřicet otázek na čtyřicet herních serverů. Tohle je strop, který nedovolí, aby se ze smyčky napsané ve tři ráno stal zátěžový test.',
    'days' => 'Schválený klíč vydrží',
    'days_helper' => 'Ve dnech. Nula znamená dokud se nezruší, a to je výchozí — klíč, kterému vyprší platnost, když se nikdo nedívá, je bot, který se přes noc zastaví, aniž by kdekoli stálo proč.',
    'days_never' => 'Dokud se nezruší',

    /*
     * Řečeno na stránce, ne ponecháno k objevení. Pelican při odinstalaci
     * pluginu vrátí jeho migrace zpět, a jediná tabulka tohohle pluginu jde s
     * nimi.
     */
    'uninstall_note' => 'Odstranit tenhle plugin znamená odstranit s ním každý klíč. Je to schválně — klíč, který přežije to, co mu odpovídá, je přihlašovací údaj, který už nikdo nezruší.',
];
