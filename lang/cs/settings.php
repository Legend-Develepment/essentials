<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Egg", „uzel", „subuser", „Wings", „queue", „webhook", „topbar", „cron" a
 * názvy formátů souborů zůstávají, jak jsou: pod těmito jmény se najdou v
 * samotném Pelicanu, na hostiteli a ve všem, co se o nich píše. Názvy stylů se
 * také nepřekládají - styl se jmenuje, jak se jmenuje, a přeložené jméno by
 * bylo druhým jménem téže věci.
 */

return [
    'css_warning' => 'Uloženo, ale tenhle CSS vypadá špatně',
    'css_unclosed' => 'Pravidlo otevřené na řádku :line se nikdy nezavírá. Všechno po něm stojí uvnitř toho pravidla a neuplatní se.',
    'css_extra' => 'Na řádku :line je zavírací závorka, i když nic není otevřené. Všechno po ní stojí mimo jakékoli pravidlo a přeskočí se.',
    'css_comment' => 'Komentář otevřený na řádku :line se nikdy nezavírá, takže zbytek souboru stojí uvnitř něj.',

    'groups' => [
        'appearance' => 'Vzhled',
        'servers' => 'Seznam serverů',
        'windows' => 'Styly podle času',
        'windows_helper' => 'Jiný styl mezi dvěma hodinami dne. Nic se neděje, dokud jeden nepřidáte. Hodiny jsou hodiny samotného panelu, z jeho nastavení časového pásma, ne hodiny každého čtenáře: panel, který by ve stejnou chvíli vypadal dvěma lidem jinak, by vypadal rozbitě, ne naplánovaně. Okno mění vzhled, který panel už má, takže nedělá nic, dokud styl stojí na „Žádný". Styl, který si někdo vybral sám, stejně vyhrává.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Jazyky',
        'files_where' => 'Kde soubory leží',
        'files_bucket' => 'Bucket',
        'files_cdn' => 'CDN',
        'files_mirror' => 'Jazyky, uložené mimo panel',
        'servers_helper' => 'Jak se kreslí karta serveru. Jestli se ukazují v mřížce nebo v seznamu, je volba každého, v Účet → Rozvržení nástěnky.',
        'server_pages' => 'Stránky serveru',
        'server_pages_helper' => 'Co nese každá stránka uvnitř serveru, ať je to která chce.',
        'console' => 'Stránka konzole',
        'console_helper' => 'Písmo terminálu, jeho velikost a výška jsou volba každého, v Účtu.',
        'background' => 'Pozadí',
        'background_helper' => 'Týká se celého panelu, včetně přihlašovací obrazovky.',
        'icons' => 'Ikony',
        'bars' => 'Ukazatele zdrojů',
        'bars_helper' => 'Pruhy procesoru, paměti a disku na kartách serverů.',
        'updates' => 'Aktualizace',
        'updates_helper' => 'Která vydání stránka motivu nabízí a kde je hledá.',
        'brand' => 'Značka',
        'login' => 'Přihlašovací obrazovka',
        'login_helper' => 'Týká se obrazovek přihlášení, obnovy hesla a druhého faktoru.',
        'advanced' => 'Vlastní CSS',
        'advanced_helper' => 'Na všechno, co nastavení výše nepokrývají. Načítá se po všem ostatním, takže vyhrává.',
        'areas' => 'Podle oblasti',
        'areas_helper' => 'Všechno výše platí všude. Tady se dá jedna oblast vyčlenit; co necháte prázdné, dál se řídí obecným nastavením.',
        'footer' => 'Pata bočního panelu',
        'footer_helper' => 'Spodek bočního panelu, který Pelican nechává prázdný. Všechno tady je vypnuté, dokud to nevyplníte.',
        'features' => 'Co tenhle plugin přidává',
        'features_helper' => 'Odškrtnout něco znamená vzít to z panelu úplně pryč. Jeho nastavení zůstávají a jeho stránka si nechává adresu, takže se nic neztratí, když něco vypnete, abyste viděli, co to dělalo. Většina má navíc vlastní oprávnění v Rolích, aby šlo předat jedno, aniž by se předal zbytek. Ne všechno: ukazatele zdrojů, pata bočního panelu a hledání v nastavení se kreslí všem a nikdo je nespravuje, hvězdička na kartě serveru patří tomu, kdo na ni klikl, a stránky Palworldu a Minecraftu uvnitř serveru se řídí oprávněními toho serveru, ne jedním z těchhle. Samotný vzhled v tomhle seznamu není - má vlastní vypínač, v Vzhled → Vzhled → Styl → Žádný.',
        'identity' => 'Tenhle plugin v bočním panelu',
        'identity_helper' => 'Položka, kterou tenhle plugin do bočního panelu přidává, a obrázek na ní.',
    ],

    /*
     * Stránky nastavení, každá jako položka ve vlastní skupině pluginu v bočním
     * panelu. Seskupené podle otázky, na kterou se odpovídá, ne podle třídy,
     * která je realizuje.
     */
    /*
     * Kam se ukládají soubory, které si tenhle plugin drží.
     *
     * Slova jsou o cíli, ne o poskytovateli, protože tytéž tři věty platí o
     * bucketu i o CDN a správce, který jedno z nich nastavuje, neřeší, na které
     * z nich se dívá, dokud se neliší políčka.
     */
    'files' => [
        'where' => 'Soubory leží',
        'where_helper' => 'Na panelu sedí na jeho vlastním disku, kam chodily odjakživa a kde není co nastavovat. Kdekoli jinde je místo, které tenhle panel držet nemusí, a doručuje se blíž tomu, kdo se dívá. Cíl, který neodpoví, spadne zpátky na panel místo toho, aby se nahraný soubor ztratil.',
        'panel' => 'Na tomhle panelu',
        's3' => 'V bucketu (S3, R2, MinIO, Wasabi)',
        'cdn' => 'Na CDN',
        'read_from' => 'Číst z',
        'read_from_helper' => 'Odkud se soubor stahuje, což není vždycky tam, kam se zapsal. Sem patří CDN před bucketem, a stejně tak doručovací adresa, která se liší od té, na které je API. Prázdné nechá cíl, ať si to vyřeší sám.',

        'bucket' => 'Bucket',
        'bucket_helper' => 'Cokoli, co mluví protokolem S3. Endpoint a přepínač adres ve stylu path jsou to, co potřebují ty, které nejsou AWS; pro samotné AWS nechte obojí být.',
        'bucket_key' => 'Přístupový klíč',
        'bucket_secret' => 'Tajný klíč',
        'bucket_name' => 'Název bucketu',
        'bucket_region' => 'Region',
        'bucket_region_helper' => 'auto sedí R2 i většině vlastních instalací. AWS chce svůj, třeba eu-central-1.',
        'bucket_endpoint' => 'Endpoint',
        'bucket_endpoint_helper' => 'Pro AWS nechte prázdné. R2, MinIO i ostatní mají každý svůj.',
        'bucket_path_style' => 'Adresy ve stylu path',
        'bucket_path_style_helper' => 'To, co potřebuje MinIO a většina vlastních instalací. AWS a R2 ne.',

        'cdn_title' => 'CDN',
        'cdn_helper' => 'CDN, které mluví API Modory. Token je server na server a je to plná správa nad celým tím účtem, takže se do exportovaného souboru nastavení nezapisuje, stejně jako každý jiný přihlašovací údaj tady.',
        'cdn_base' => 'Adresa',
        'cdn_base_helper' => 'Kde API sedí. Pokud se soubory doručují odjinud, napište tu adresu výš do Číst z.',
        'cdn_token' => 'Token',
        'cdn_token_helper' => 'Posílá se jako X-Internal-Token. Kdokoli, kdo ho má, smí do celého účtu zapisovat a mazat z něj.',
        'cdn_folder' => 'Složka',
        'cdn_folder_helper' => 'Složka pod účtem, kam se ukládají soubory tohohle panelu, aby jedno CDN mohlo obsluhovat několik panelů, aniž by si vlezly do cesty.',

        'move' => 'Přesunout to, co je ještě na panelu',
        'move_confirm' => 'Ikona v bočním panelu, pozadí panelu a pozadí přihlašovací obrazovky se zkopírují na cíl a jejich adresy se přepíšou. Kopie na tomhle panelu zůstanou, kde jsou, takže se nic nerozbije, když si to rozmyslíte. Obrázky nahrané od téhle chvíle jdou na cíl tak jako tak; tohle je jen pro ty, které tu už jsou.',
        'move_done' => 'Přesunuto',
        'move_done_body' => 'Prohlédnuto :looked, přesunuto :moved, nepodařilo se přesunout :failed.',
        'check' => 'Vyzkoušet',
        'check_ok' => 'Funguje to',
        'check_ok_body' => 'Soubor se zapsal, stáhl zpátky přes svou veřejnou adresu a zase smazal.',
        'check_bad' => 'Tohle nevyšlo',
        'check_panel' => 'Soubory jsou nastavené tak, že leží na tomhle panelu, takže není co zkoušet.',
        'check_refused' => 'Cíl soubor odmítl a neřekl proč.',
        'check_unreadable' => 'Soubor vzal, ale nešel přečíst zpátky z :url. To je adresa, kterou použije prohlížeč, takže soubor, který si nikdo nestáhne, je později rozbitý obrázek. Zkontrolujte Číst z a to, jestli cíl doručuje soubory veřejně.',
        'bucket_missing' => 'Než bude co zkoušet, je potřeba klíč, tajný klíč i název bucketu.',
        'cdn_missing' => 'Než bude co zkoušet, je potřeba adresa i token.',
        'cdn_shape' => 'Soubor přijal a pak odpověděl v podobě, ve které tenhle panel nenašel žádnou adresu. Řekl tohle: :body',
        'mirror_minutes' => 'Hledat změněné jazyky každých',
        'mirror_minutes_helper' => 'V minutách. Hledání je levné: každý nahraný jazyk se přečte, zahašuje a porovná s tím, co se odeslalo naposled, takže obyčejný průchod neodešle vůbec nic. Přes drát jde jen jazyk, který někdo změnil.',
        'mirror_now' => 'Zkopírovat jazyky teď',
        'mirror_done' => 'Jazyky zkopírovány',
        'mirror_done_body' => 'Prohlédnuto :looked, odesláno :sent, nepodařilo se odeslat :failed.',
        'mirror_restore' => 'Obnovit jazyky',
        'mirror_restore_confirm' => 'Tohle přepíše všechno, co je na tomhle panelu, každým jazykem z kopie mimo panel. Přesně o to po upgradu jde, a nainstalovaný jazyk se potom nedá odebrat, takže stojí za to mít jistotu.',
        'mirror_back' => 'Jazyky obnoveny',
        'mirror_back_body' => 'Nalezeno :found, vráceno :put, nepodařilo se stáhnout :failed.',
    ],

    'pages' => [
        'look' => 'Vzhled',
        'look_helper' => 'Barva, tvar a to, jak se panel jmenuje.',
        'pages' => 'Stránky',
        'pages_helper' => 'Seznam serverů, stránky uvnitř serveru a terminál.',
        'advanced' => 'Pokročilé',
        'advanced_helper' => 'Dva nouzové východy: vlastní CSS a nastavení, která platí jen v jedné oblasti.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Které eggs jsou Minecraft a všechno ostatní k tomu.',
        'artwork' => 'Obrázky eggs',
        'artwork_helper' => 'Stránka se všemi eggs a způsob, jak stáhnout obrázek hry ze Steamu nebo z IGDB. Zapisuje přímo do eggs - obrázek a dva štítky, které si pamatují, o kterou hru jde a jestli byl obrázek vybrán ručně - a proto nese vlastní oprávnění.',
        'alerts' => 'Upozornění',
        'alerts_helper' => 'Pravidelná kontrola věcí, které panel stejně měří, ale nikomu neříká: uzel přestal odpovídat, plní se disk, queue worker se zastavil, verze zaostala. Posílá na Discord, do panelu nebo e-mailem. Vlastní oprávnění, protože to pravidelně dosahuje na každý uzel a publikuje na adresu, kterou někdo napsal.',
        'backups' => 'Přehled záloh',
        'backups_helper' => 'Stránka se všemi servery a s tím, jak dlouho je každý bez zálohy, seřazená tak, aby ty bez jediné stály nahoře. Jen ke čtení - všechno, co se zálohou pracuje, zůstává na stránce Pelicanu pro ten server. Vlastní oprávnění, protože ten seznam je mapa toho, kde jsou díry.',
        'public_status' => 'Veřejná stránka stavu',
        'public_status_helper' => 'Stránka, kterou může otevřít kdokoli bez účtu a na které je vidět, které z vašich serverů běží a kolik lidí na nich je. Nic se nezveřejňuje, dokud nepojmenujete server, stroj nebo službu - všechny tři seznamy začínají prázdné, a dokud takové jsou, adresa odpovídá 404. Vlastní oprávnění, protože rozhoduje o tom, co z panelu ven.',
        'game_players' => 'Hráči, další hry',
        'capacity' => 'Kapacita',
        'capacity_helper' => 'Kolik je slíbeno na každém stroji proti tomu, kolik smí rozdat, aby bylo vidět, jestli se vejde ještě jeden server. Seznam uzlů Pelicanu ukazuje jméno a počet serverů a blok Stroje na nástěnce ukazuje, co běží - tohle je třetí otázka a počet je vlastní, Pelicanův. Jen ke čtení. Vlastní oprávnění.',
        'schedules' => 'Naplánované úlohy',
        'schedules_helper' => 'Všechny naplánované úlohy panelu i to, které z nich se zastavily: zaseknuté uprostřed běhu, zpožděné, protože cron neběží, nebo nikdy nespuštěné. Pelican ukazuje úlohy uvnitř každého serveru a jeho vlastní stav nemá slovo pro žádný z těch případů. Jen ke čtení. Vlastní oprávnění.',
        'activity' => 'Aktivita',
        'activity_helper' => 'Každá událost, kterou panel zaznamenává, v jednom seznamu místo po jednom serveru. Pelican záznam vede a ukazuje ho po serverech; tady se týž záznam ptá z druhé strany. Jen ke čtení. Vlastní oprávnění, protože záznam o tom, kdo co udělal, se předává vědomě.',
        'access' => 'Přístup k serverům',
        'access_helper' => 'Svázat roli se servery, aby na ně každý její držitel dosáhl. Funguje to udržováním subusers samotného Pelicanu v aktuálním stavu, které stejně čte seznam serverů i každá kontrola oprávnění. Vlastní oprávnění, protože je to jediná zdejší stránka, která lidem dává přístup k věcem.',
        'games' => 'Další hry',
        'games_helper' => 'Soubory, které si ARK a Valheim drží vedle svého světa, jako formuláře: nastavení světa ARKu a seznamy administrátorů, banů a povolených u Valheimu. Které servery je dostanou, říká seznam eggs na té stránce, takže prázdný seznam je už vypínač pro danou hru.',
        'game_players_helper' => 'Stránka uvnitř Rustu, ARKu, Valheimu a všeho, co odpovídá na dotaz Valve, která ukazuje, kdo je připojený a jak dlouho. Jen ke čtení - co se dá s někým udělat, se hra od hry liší, a to je samostatné vydání. Které eggs se počítají, je tentýž seznam, který používá stránka stavu.',
        'api' => 'API',
        'api_helper' => 'Klíče, které lidé mají, kdo o nějaký požádal, a co každý z nich smí vidět.',
        'languages' => 'Jazyky',
        'languages_helper' => 'V jakých jazycích tenhle plugin odpovídá.',
        'files' => 'Úložiště a CDN',
        'files_helper' => 'Kam se ukládají soubory, které si tenhle plugin drží, a adresa, ze které se čtou.',
    ],

    'features' => [
        'look' => 'Nastavení vzhledu',
        'look_helper' => 'Položka bočního panelu pro barvu, tvar a značku.',
        'pages' => 'Nastavení stránek',
        'pages_helper' => 'Položka bočního panelu pro seznam serverů, stránky serveru a terminál.',
        'advanced' => 'Pokročilá nastavení',
        'advanced_helper' => 'Položka bočního panelu pro vlastní CSS a výjimky podle oblasti.',
        'announcements' => 'Oznámení',
        'announcements_helper' => 'Pruh přes horní část panelu.',
        'nav_links' => 'Navigační odkazy',
        'nav_links_helper' => 'Vaše vlastní položky v bočním panelu.',
        'login' => 'Přihlašovací obrazovka',
        'login_helper' => 'Obrázek, hláška a odkazy přihlašovací obrazovky.',
        'bars' => 'Ukazatele zdrojů',
        'bars_helper' => 'Přebarvené pruhy procesoru, paměti a disku.',
        'dashboard_status' => 'Řádek verze',
        'dashboard_status_helper' => 'Vršek bloku na nástěnce: která verze je nainstalovaná a jestli nějaká nečeká.',
        'dashboard_nodes' => 'Stroje',
        'dashboard_nodes_helper' => 'Zbytek bloku na nástěnce: tenhle panel a každý uzel s tím, kolik každý spotřebovává.',
        'system_status' => 'Stránka stavu systému',
        'system_status_helper' => 'Stránka stroje, na kterém běží samotný panel.',
        'sidebar_footer' => 'Pata bočního panelu',
        'sidebar_footer_helper' => 'Váš řádek textu, verze panelu a jeden odkaz, úplně dole v bočním panelu.',
        'console' => 'Tlačítko konzole',
        'console_helper' => 'Plovoucí tlačítko uvnitř serveru, s konzolí a tlačítky napájení na sobě, které dosáhne na uzel rovnou. Jakou podobu má, řeší nastavení stránek; tohle rozhoduje, jestli se vůbec kreslí.',
        'arranger' => 'Uspořádání stránek',
        'arranger_helper' => 'Přetahování bloků na stránce do pořadí, jaké kdo chce. Nese vlastní oprávnění pod Rolemi, takže tohle rozhoduje, jestli to panel nabízí, a oprávnění rozhoduje komu.',
        'user_themes' => 'Styly pro každého',
        'user_themes_helper' => 'Nechat každého vybrat si styl z těch, které nabízíš, pod Vzhledem v klientské části. Které styly se nabízejí, řeší stránka Vzhled; tohle rozhoduje, jestli se vůbec někoho ptáme.',
        'api' => 'API',
        'api_helper' => 'Cesta dovnitř zvenčí panelu: adresa, na které se bot Discordu nebo vlastní skript může zeptat na to, co tenhle plugin ví - kdo hraje, které servery nemají zálohu, jestli se na uzel vejde ještě jeden. Vypnuto neregistruje vůbec žádnou cestu místo takové, která odmítá, což je méně povrchu, ne zdvořilejší množství povrchu. Kdokoli přihlášený smí požádat o klíč, který odpovídá jen za jeho vlastní servery; schválit ho, zamítnout ho, zrušit cizí a vydat klíč na celý panel - na to všechno je potřeba oprávnění.',
        'languages' => 'Jazyky',
        'languages_helper' => 'Odpovídat každému v jazyce nastaveném na jeho účtu, tam, kde je tenhle plugin přeložený. Vypnuto - každý dostane angličtinu.',
        'files' => 'Úložiště a CDN',
        'files_helper' => 'Držet soubory tohohle pluginu jinde než na panelu: v bucketu S3, nebo na CDN. Vypnuto neznamená „žádné soubory" - je to vlastní disk panelu, kam chodily odjakživa. Tohle rozhoduje jen o tom, jestli se vůbec nabídne něco jiného. Cíl, který neodpoví, spadne zpátky na panel místo toho, aby se nahraný soubor ztratil, a jednou zapsaná adresa se nikdy nebere zpátky: tohle rozhoduje, kam půjde příští soubor, ne kde leží ten poslední.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Karta Minecraft v bočním panelu a stránka uvnitř každého serveru Minecraftu pro úpravu jeho server.properties jako formuláře. Které eggs se počítají, říkáte vy.',
        'palworld' => 'Nastavení Palworldu',
        'palworld_helper' => 'Stránka uvnitř serveru Palworldu pro úpravu jeho nastavení světa. Na žádném jiném serveru se neobjeví, a nikdy, dokud ten server běží.',
        'settings_search' => 'Hledání v nastavení',
        'settings_search_helper' => 'Pole nad těmihle formuláři, které je zúží na sekce obsahující to, co napíšete.',
        'preview' => 'Živý náhled',
        'updating' => 'Hlášení o aktualizaci',
        'waitlist' => 'Čekací listina',
        'waitlist_helper' => 'Nechat někoho požádat, ať se mu ozveme, až bude vyprodaný balíček zase na prodej. Když se zásoba vrátí, řekne se to všem, kdo na ten balíček čekají, najednou, a dostane ho ten, kdo koupí první - nic se pro nikoho nedrží a každá zpráva to říká. Tím, že se to člověk dozví, ze seznamu zmizí, takže jedna žádost kupuje jedno upozornění a nikdy trvalý odběr. Potřebuje obchod, a je to jediná věc v obchodě, která píše zákazníkovi, který si nic nekoupil.',
        'updating_helper' => 'Jeden řádek nahoře na stránce, dokud tenhle plugin instaluje aktualizaci, a pět minut po tom, co skončí. Během samotné aktualizace ho ukázat nejde - dokud se vydání vyměňuje, čte Pelican tenhle plugin jako nenainstalovaný a nenačte z něj nic, takže nezbývá nic našeho, čím by se kreslilo. Je to pro toho, kdo potkal napůl vykreslenou stránku, počkal a vrátil se: ten řádek mu říká, co viděl.',
        'preview_helper' => 'Rámeček vedle formuláře Vzhled, který ukazuje, co barvy, rohy a rozestupy dělají, ještě než je uložíte.',
        'duplicate' => 'Duplikace serveru',
        'duplicate_helper' => 'Stránka pro postavení dalšího serveru přesně jako toho, který už máte, nebo rovnou několika. Soubory se nikdy nekopírují.',
        'favourites' => 'Označené servery',
        'favourites_helper' => 'Hvězdička na každé kartě serveru. Označené jdou první a seznam každého se drží v panelu - takže jeho hvězdičky jdou s ním tam, kde se příště přihlásí. Mění to, co vidí on, a pro ostatní nic. Být v panelu ovšem znamená, že je to soubor ve storage, který si může přečíst každý, kdo má přístup ke stroji.',
        'artwork' => 'Obrázky eggs',
        'artwork_helper' => 'Administrátorská stránka, která stahuje obrázek každého egg ze Steamu nebo z IGDB a zapisuje ho přímo do egg.',
        'alerts' => 'Upozornění',
        'alerts_helper' => 'Pravidelná kontrola uzlu, který přestal odpovídat, plnícího se disku, mrtvého queue workeru nebo zaostávající verze - a zpráva na Discord, do panelu nebo e-mailem, kterou pošle.',
        'backups' => 'Přehled záloh',
        'backups_helper' => 'Administrátorská stránka, která vypisuje každý server podle toho, jak dlouho je bez zálohy. Jen ke čtení.',
        'public_status' => 'Veřejná stránka stavu',
        'public_status_helper' => 'Stránka, kterou může otevřít kdokoli bez účtu. Vypnuto - adresa odpovídá 404, ať je v seznamu cokoli.',
        'game_players' => 'Hráči, další hry',
        'game_players_helper' => 'Stránka uvnitř Rustu, ARKu, Valheimu a všeho, co odpovídá na dotaz Valve, která ukazuje, kdo je připojený a jak dlouho.',
        'owner_alerts' => 'Říkat lidem, že jejich server je offline',
        'owner_alerts_helper' => 'Jediná část tohohle pluginu, která píše lidem, kteří nejsou administrátoři: upozornění v panelu, když stroj jednoho z jejich serverů přestane odpovídat, a další, když se vrátí. Vypnuto, dokud se to nezapne tady i na stránce Upozornění, na obou místech - píše to vašim zákazníkům, takže to chce dvě rozhodnutí, ne jedno.',
        'my_backups' => 'Upozornění na zálohy v seznamu serverů',
        'my_backups_helper' => 'Řádek nad vlastním seznamem serverů každého člověka, když některý z jeho serverů nikdy neměl zálohu nebo ji delší dobu nemá. Karty Pelicanu říkají, co server dělá teď; nic tam neříká, že záloha neběžela tři týdny. Kreslí se jen tehdy, když něco zaostává, a nejmenuje žádný server, který by ten člověk stejně nemohl otevřít.',
        'capacity' => 'Přehled kapacity',
        'capacity_helper' => 'Administrátorská stránka, která ukazuje paměť, disk a procesor slíbené proti dostupným na každém stroji, spolu se servery, kterým došly zálohy, databáze nebo alokace. Slíbeno, ne spotřebováno - uzel může být vytížený a prázdný, nebo nečinný a plný.',
        'schedules' => 'Přehled naplánovaných úloh',
        'schedules_helper' => 'Administrátorská stránka, která vypisuje všechny naplánované úlohy panelu, nejhorší nahoře - zaseknuté, zpožděné, nebo nikdy nespuštěné. Jen ke čtení; všechno, co úlohu upravuje nebo spouští, zůstává na stránce Pelicanu pro ten server.',
        'activity' => 'Aktivita panelu',
        'activity_helper' => 'Administrátorská stránka, která vypisuje každou zaznamenanou událost panelu, nejnovější nahoře, spolu s tím, kdo ji provedl a na kterém serveru. Jen ke čtení - nic nemaže, a jak dlouho se řádky uchovávají, dál rozhoduje nastavení samotného Pelicanu.',
        'access' => 'Přístup k serverům podle role',
        'access_helper' => 'Stránka pro svázání role se servery, udržovaná v souladu v tabulce subusers samotného Pelicanu. Nic nepřiděluje, dokud něco nepřiřadíte. Vypnutí zastaví slaďování; už přidělený přístup zůstává, a stránka má tlačítko, kterým se dá vzít zpátky.',
        'scheduled' => 'Styly podle času',
        'scheduled_helper' => 'Sekce na stránce Vzhled, která panelu dává jiný styl mezi dvěma hodinami dne. Nemění nic z uloženého - okno se položí přes nastavení ve chvíli, kdy se stránka kreslí, a hned nato se pustí - takže vypnutí vrátí vlastní vzhled panelu okamžitě a nic neztratí.',
        'games' => 'Další hry',
        'games_helper' => 'Nastavení světa ARKu a seznamy administrátorů, banů a povolených u Valheimu jako formuláře místo souborů ve správci souborů. Které servery je dostanou, říká seznam eggs na stránce Další hry.',
        'quick' => 'Nabídka „Přejít na"',
        'quick_helper' => 'Jeden prvek nahoře na každé stránce pro skok na server nebo na označenou stránku, s vyhledávacím polem přes celý váš seznam serverů. Označuje taky tu stránku, na které zrovna stojíte. To, co přes něj někdo najde, mohl stejně otevřít, takže to nic nepřiděluje - vypnutí vezme tuhle zkratku a stránku Oblíbené spolu s ní.',
        'shop' => 'Obchod',
        'shop_helper' => 'Prodej serverů z panelu: obchod a pokladna v zákaznické části, stránka faktur každého člověka a stránka Nastavení obchodu pro měnu, daň a texty. Hlavní přepínač - vypnutý, a nikdo nemůže koupit ani zaplatit, zatímco už prodané se dál spravuje stránkami níže.',
        'packages' => 'Balíčky',
        'packages_helper' => 'Stránka správy, kde se určuje, co se prodává: šablona serveru s cenou, obdobím a skladem. Vlastní oprávnění, protože stanovit ceny je jiná práce než označovat faktury jako zaplacené.',
        'orders' => 'Objednávky',
        'orders_helper' => 'Stránka správy se vším, co bylo koupeno, serverem, kterým se každá stala, a jejím stavem - čeká, aktivní, pozastavená, zrušená. Vlastní oprávnění.',
        'invoices' => 'Faktury',
        'invoices_helper' => 'Stránka správy s tím, co se dluží a co bylo zaplaceno, s tlačítkem pro ruční označení faktury jako zaplacené. Vlastní oprávnění, protože to tlačítko je místo, kde se zapisují peníze.',
        'payments' => 'Platby',
        'payments_helper' => 'Platební poskytovatelé - jejich klíče a každý pokus, který přes ně prošel. Vlastní oprávnění, protože tam leží přihlašovací údaje: kdo smí vidět každou fakturu, nemusí vidět tajemství.',
        'coupons' => 'Kupóny',
        'coupons_helper' => 'Kódy, které odečtou procento nebo pevnou částku z první faktury, s platností a limitem použití. Vlastní oprávnění.',
        'customers' => 'Zákazníci',
        'customers_helper' => 'Správcovská stránka, která obchod otáčí: jeden řádek na člověka, který nakoupil, s tím, co má, co zaplatil a co zbývá. Vlastní právo, protože je to jediná stránka obchodu o člověku místo o řádku - kdo určuje ceny, celou historii zákazníka nepotřebuje, a kdo odpovídá na požadavek, ano.',
        'credit' => 'Kredit a vracení peněz',
        'credit_helper' => 'Peníze, které obchod drží pro zákazníka. Vrácení může jít zpátky na kartu, ze které přišlo, nebo zůstat na účtu jako kredit; tak i tak se vypíše dobropis, a kredit na účtu se sám odečte z další faktury ještě dřív, než se zákazníka někdo zeptá, jestli zaplatí. Vlastní právo, protože označit fakturu jako zaplacenou zaznamenává, že peníze přišly, a tohle peníze vydává.',
        'upgrades' => 'Upgrade a downgrade',
        'upgrades_helper' => 'Přesun živé služby na jiný balíček, aniž by se kupovala nová. To, co zbývá z už zaplaceného období, se vrátí, tentýž úsek se naúčtuje novou cenou a rozdíl se buď vyfakturuje, nebo připíše zákazníkovi na účet. Každý balíček vypisuje, na které jiné se z něj smí přejít, a nabízejí se jen ty, které sdílejí jeho egg: jiný egg je jiný server, ne větší.',
        'addons' => 'Doplňky',
        'addons_helper' => 'Věci, které se prodávají vedle balíčku: víc paměti, další místo na zálohu, nebo něco, co je jen řádek na faktuře. Každý říká, ke kterým balíčkům patří a co serveru přidá, a účtuje se buď s každým obnovením, nebo jednorázově. Kupuje se u pokladny, nebo později k běžící službě, kde se poměrně rozpočítá na to, co z období zbývá. Vlastní právo, protože to, co smí doplněk přidat někomu na server, je rozhodnutí o jeho stroji, ne o ceníku.',
        'tickets' => 'Požadavky',
        'tickets_helper' => 'Místo, kde se zákazník může zeptat přímo z panelu, hned vedle služby, které se to týká - a to je ta jediná věc, kterou chatový kanál neumí. Odpovídá se na stránce tady, nebo se to přes Modoru předá do Discordu, podle toho, jak je stránka Požadavky nastavená. Každá otázka i každá odpověď se tak jako tak drží v tomhle panelu, takže se nic neztratí, když druhá strana není k zastižení. Vlastní právo, protože odpovídat zákazníkům je práce, kterou někdo dostane, ne práce, která přichází s určováním cen balíčků.',
        'overview' => 'Přehled obchodu',
        'overview_helper' => 'Stránka, která odpovídá, co tento měsíc přišlo, co se dluží, kolik běžící služby dělají každý měsíc a čemu se dnes věnovat. Vlastní právo, protože obrat není nic, co by měl umět přečíst každý, kdo smí určovat ceny balíčků.',
        'terminate' => 'Ukončit službu',
        'terminate_helper' => 'Tlačítko, které službu hned zastaví a smaže její server, se soubory i vším ostatním. Záměrně mimo právo na objednávky: pozastavení, posun splatnosti i zrušení jdou vzít zpět, tohle ne. Kdo odpovídá na požadavky, může mít první tři, aniž by měl tohle.',
        'public_shop' => 'Veřejná stránka obchodu',
        'public_shop_helper' => 'Stránka, kterou může otevřít kdokoli bez účtu, s tím, co se prodává. Nezveřejňuje nic, co by přihlášený zákazník v obchodě neviděl, takže zapnuto nebo vypnuto je celé rozhodnutí - vypnuto odpovídá 404, jako stránka stavu.',
    ],

    /*
     * Vyhledávací pole nad formuláři nastavení. Prosívá to, co už na stránce v
     * prohlížeči je, a serveru se na nic neptá, takže není žádný stav „hledám",
     * který by se dal popsat, ani způsob, jak by to mohlo selhat.
     */
    /*
     * Rámeček náhledu. Všechno v něm je náhražka, ne vzorek vašeho panelu, a
     * slova to říkají - rámeček, který by pojmenoval skutečný server nebo
     * skutečné číslo, by se tak i četl.
     */
    'preview' => [
        'label' => 'Náhled',
        'card' => 'Karta',
        'card_helper' => 'Nakreslená stejnými pravidly jako panel, jen s nastaveními z téhle stránky místo uložených.',
        'button' => 'Tlačítko',
        'field' => 'Pole',
        'meter_ok' => 'V pořádku',
        'meter_warning' => 'Varování',
        'meter_danger' => 'Nebezpečí',

        /*
         * Náhled přes celou stránku. Karta, ne panel, protože Pelican posílá
         * X-Frame-Options: DENY a odmítá se nechat vložit do rámu čímkoli,
         * včetně sebe sama - viz Support\FullPreview.
         */
        'full' => 'Zobrazit celý panel',
        'full_confirm' => 'Otevře panel nakreslený z nastavení téhle stránky místo z uložených. Nic se nezapisuje - hodnoty se drží patnáct minut a panel se vrátí do normálu, až z náhledu odejdete nebo uložíte.',
        'full_go' => 'Ukázat',
        'full_failed' => 'Náhled se nepodařilo spustit',
        'bar' => 'Díváte se na neuložená nastavení. Nic z tohohle se nezapsalo.',
        'bar_back' => 'Zpátky do nastavení',
    ],

    'search' => [
        'placeholder' => 'Hledat v nastavení',
        'label' => 'Hledat v těchhle nastaveních',
        'none' => 'Na téhle stránce nic nesedí. Nastavení jsou rozložená na čtyřech stránkách - zkuste Vzhled, Stránky, Pokročilé nebo Nastavení Essentials.',
    ],

    'footer' => [
        'text' => 'Váš vlastní řádek',
        'text_helper' => 'Prostý text, nejvýš 120 znaků. Escapuje se, stejně jako pruh oznámení - tohle se vykresluje na každé stránce panelu, takže je to špatné místo na přijímání značek.',
        'version' => 'Zobrazit verzi panelu',
        'version_helper' => 'Verzi Pelicanu, ne tohohle pluginu. Plugin svou vlastní hlásí na nástěnce; dole v bočním panelu lidé hledají odpověď na to, který panel mají před sebou.',
        'link_label' => 'Text odkazu',
        'link_url' => 'Adresa odkazu',
        'link_url_helper' => 'Adresa http nebo https, nebo cesta samotného panelu, třeba /account. Otevírá se v nové kartě.',
    ],

    'layout' => [
        'label' => 'Rozvržení',
        'helper' => 'Jak je panel uspořádaný, ne jakou má barvu. Platí stejně pro administrátorskou část, seznam serverů i klientskou část. Kam jde navigace, je výchozí hodnota: kdo si svou nastavil v Účet → Navigace, tomu zůstane.',
        'default' => 'Boční panel - vlastní Pelicanu',
        'rail' => 'Lišta ikon - úzká, rozbaluje se najetím',
        'top' => 'Navigace nahoře - bez bočního panelu',
        'mixed' => 'Horní i boční - obojí',
        'wide' => 'Široké - obsah zabírá celou obrazovku',
        'focus' => 'Soustředěné - úzký sloupec, boční panel se skládá',

        'nav_label' => 'Styl bočního panelu',
        'nav_helper' => 'Jak se kreslí samotný boční panel.',
        'nav_default' => 'Výchozí',
        'nav_floating' => 'Plovoucí - vlastní karta',
        'nav_flat' => 'Plochý - bez jakéhokoli pozadí',
        'nav_bordered' => 'S rámečkem - čára, ne plocha',

        'topbar_label' => 'Styl topbaru',
        'topbar_helper' => '„Skryto" platí jen na počítači - na telefonu nese topbar jedinou cestu zpátky do nabídky.',
        'topbar_default' => 'Výchozí',
        'topbar_floating' => 'Plovoucí - odsazený pruh',
        'topbar_flush' => 'Zarovnaný - plochý, bez rozostření',
        'topbar_hidden' => 'Skrytý na počítači',

        'card_label' => 'Styl karet',
        'card_helper' => 'Sekce, widgety, karty serverů a bloky nad konzolí.',
        'card_default' => 'Výchozí - nadzvednutá, s měkkým okrajem',
        'card_flat' => 'Plochá - bez nadzvednutí',
        'card_outline' => 'Obrys - rámeček a za ním nic',
        'card_glass' => 'Matná - pozadí prosvítá',
        'card_sharp' => 'Ostrá - pravé úhly',
    ],

    'servers' => [
        /*
         * Hvězdička na kartě. Předaná skriptu, ne vepsaná do něj, aby texty
         * zůstaly na tom jediném místě, kde texty bydlí.
         */
        'favourite' => 'Označit tenhle server',
        'favourited' => 'Označeno - zobrazuje se první',

        /*
         * Pilulka vedle vlastních karet Pelicanu. Pojmenovaná podle toho, co
         * dělá se seznamem, ne jako čtvrtá karta, protože prosívá tu vybranou
         * místo toho, aby ji nahrazovala.
         */
        'favourites_tab' => 'Oblíbené',
        'favourites_empty' => 'Na téhle stránce není nic označeno. Použijte hvězdičku na kartě serveru, ať něco přidáte - a všimněte si, že tohle prosívá servery, které tu už jsou vypsané: označený server na další stránce se neschovává, prostě na téhle není.',
        'favourites_failed' => 'Vaše označené servery se nepodařilo uložit, takže se vrátily k tomu, co měl panel naposledy. V konzoli prohlížeče je vidět, co požadavek odpověděl.',

        'art' => 'Obrázek hry',
        'art_helper' => 'Pelican kreslí obrázek egg na každou kartu. Tohle rozhoduje, co se s ním udělá.',
        'art_faded' => 'Vybledlý - závoj za textem',
        'art_cover' => 'Krycí - za jménem, ztrácí se',
        'art_off' => 'Vypnuto',
        'art_dim' => 'Ztmavit obrázek',
        'art_dim_helper' => 'Obrázek jedné hry je světlá obloha a jiné jeskyně.',

        'status' => 'Značka stavu',
        'status_helper' => 'Kde se ukazuje barva běží / spouští se / zastaveno.',
        'status_bar' => 'Pruh - podél levého okraje',
        'status_edge' => 'Hrana - napříč vrškem',
        'status_dot' => 'Tečka - v rohu',
        'status_off' => 'Vypnuto',

        'density' => 'Výška karet',
        'density_comfortable' => 'Pohodlná',
        'density_compact' => 'Kompaktní - když je serverů hodně',

        'filter_label' => 'Popsat tlačítko filtru',
        'filter_label_helper' => 'Pelican tenhle seznam stejně prosívá podle egg a podle vlastníka, na všech stránkách - jenže vstup je nepopsaná ikona vedle vyhledávacího pole. Tohle na ni dá to slovo.',
        'filter_button' => 'Filtry',

        'columns' => 'Karet vedle sebe na široké obrazovce',
        'columns_helper' => 'Platí jen pro mřížku, a až od 1280px. Vlastní strop Pelicanu jsou dvě.',
    ],

    'controls' => [
        'mode' => 'Tlačítko konzole na každé stránce serveru',
        'mode_helper' => 'Jedno plovoucí tlačítko, na každé stránce uvnitř serveru. Otevře konzoli přes to, co jste zrovna dělali, se stavem a tlačítky napájení v hlavičce - dosáhne na uzel rovnou, jako to dělá seznam serverů, ne přes websocket stránky konzole. Na samotné stránce konzole se neobjeví nikdy: tam už tohle všechno je.',
        'mode_full' => 'Konzole a tlačítka napájení',
        'mode_console' => 'Jen konzole',
        'mode_off' => 'Vypnuto',

        'label' => 'Na tlačítku je',
        'label_text' => 'Ikona a jméno',
        'label_icon' => 'Jen ikona',

        'position' => 'Kde plave',
        'position_helper' => 'U toho okraje, který zrovna nejspíš nečtete.',
        'position_top' => 'Nahoře',
        'position_right' => 'Vpravo',
        'position_bottom' => 'Dole',
    ],

    'console' => [
        'stats' => 'Bloky nad konzolí',
        'stats_helper' => 'Pelican nad terminálem ukazuje jméno, stav, adresu a tři čísla využití. Když se skryjí, konzole dostane výšku zpátky.',
        'stats_tiles' => 'Dlaždice - popisek, číslo a ikona',
        'stats_plain' => 'Prostě - tak, jak je kreslí Pelican',
        'stats_off' => 'Skryté',
    ],

    'terminal' => [
        'helper' => 'Předávají se samotnému terminálu, takže začnou platit při dalším načtení stránky, ne ve chvíli uložení.',

        'renderer' => 'Kreslí',
        'renderer_helper' => 'Pelican kreslí terminál na GPU, a to je u zdi rolujícího výstupu mnohem rychlejší. Prohlížeč drží naživu jen několik GPU kontextů naráz - na telefonu méně - a při překročení limitu ten nejstarší odebere; terminál pak nekreslí vůbec nic, a to bez jediné chyby. Když se vám konzole vybělí, zatímco všechno ostatní vypadá správně, je to tohle nastavení, které se mění.',
        'renderer_webgl' => 'GPU - vlastní varianta Pelicanu, rychlejší',
        'renderer_dom' => 'Prohlížeč - pomalejší, kreslí vždycky',

        'scheme' => 'Barevné schéma',
        'scheme_helper' => 'Jediné nastavení terminálu, které Pelican nenabízí. „Řídit se motivem" odvozuje barvy z akcentu, a právě proto tohle vůbec existuje.',
        'scheme_theme' => 'Řídit se motivem',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kurzor',
        'cursor_helper' => 'Konzole psaní nepřijímá - pole na příkazy je pod ní - takže tohle je místo, kde se výstup zastavil, ne místo, kde jste vy.',
        'cursor_underline' => 'Podtržítko - vlastní varianta Pelicanu',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Čárka',

        'blink' => 'Blikající kurzor',

        'scrollback' => 'Historie rolování',
        'scrollback_helper' => 'Jak daleko zpátky se dá v konzoli rolovat. Každý řádek se drží v prohlížeči, takže upovídaný server při vysokém nastavení je opravdová paměť na tom stroji, který to čte.',
        'scrollback_lines' => 'řádků: :lines',
    ],

    'notice' => [
        'text' => 'Zpráva',
        'text_helper' => 'Jeden řádek, až 200 znaků. Escapuje se na vstupu i na výstupu, takže nemůže zanést značky na stránku, kterou načítají jiní lidé.',
        'style' => 'Tón',
        'style_info' => 'Informace',
        'style_warning' => 'Varování',
        'style_danger' => 'Naléhavé',
        'style_accent' => 'Akcentní barva',
        'scope' => 'Zobrazit',
        'scope_all' => 'Všem',
        'scope_client' => 'Jen mimo administrátorskou část',
        'scope_admin' => 'Jen v administrátorské části',
        'link_label' => 'Text tlačítka',
        'link_url' => 'Adresa tlačítka',
        'link_url_helper' => 'https:// nebo cesta uvnitř tohohle panelu, třeba /account. Všechno ostatní se ignoruje - odkaz v pruhu, který je na každé stránce, není místo pro schéma, které nikdo nečeká.',
        'dismissible' => 'Dá se zavřít',
        'dismissible_helper' => 'Že se zavřela, si pamatuje každý prohlížeč zvlášť, a jen pro tuhle zprávu: změňte text a vrátí se všem.',
        'dismiss' => 'Zavřít',
    ],

    'preset' => [
        'label' => 'Styl',
        'helper' => 'Vyberte vzhled, od kterého začít. Vyplní všechno níž, což pak můžete měnit. „Žádný" motiv vypne a nechá panel přesně takový, jaký ho Pelican dodává.',
        'options' => [
            'none' => 'Žádný - bez motivu',
            'legend' => 'Legend - červený oheň přecházející v modrý blesk',
            'ember' => 'Ember - teplá čerň, oranžový akcent',
            'midnight' => 'Midnight - hluboká modř, klidná',
            'crimson' => 'Crimson - červená, ostré rohy, kompaktní',
            'forest' => 'Forest - zelená, zakulacená, bez záře',
            'nebula' => 'Nebula - fialová s přechodovým pozadím',
            'terminal' => 'Terminal - zelená na černé, neproporcionální, ostré',
            'console' => 'Console - kulaté a prostorné, na tablet',
            'nord' => 'Nord - paleta Nord, tlumená',
            'solarized' => 'Solarized - Solarized dark, azurový akcent',
            'paper' => 'Paper - světlý, silný kontrast, plochý',
            'daylight' => 'Daylight - světlý a teplý, s měkkým závojem',
            'mono' => 'Mono - odstíny šedi, ploché a husté',
        ],

        'save' => 'Uložit jako styl',
        'save_confirm' => 'Nechá si barvy, rohy, pozadí, písmo, ikony a prahy ukazatelů, které máte právě teď na obrazovce - pod vlastním jménem, ve výběru vedle vestavěných. Ukládá to, co je na stránce, ne to, co se uložilo naposled.',
        'save_name' => 'Název',
        'save_name_helper' => 'Jak se bude ve výběru jmenovat. Uložení pod už použitým jménem ten styl nahradí.',
        'saved' => 'Styl uložen',
        'save_failed' => 'Tenhle styl se nepodařilo uložit',
        'save_full' => 'Místa je na vlastních stylů: :max. Nejdřív jeden smažte.',

        'delete' => 'Smazat styl',
        'delete_which' => 'Který',
        'delete_confirm' => 'Smazat se dají jen vlastní styly; vestavěné ne. Na současném vzhledu panelu se nic nemění - styl je výchozí bod a každá hodnota, kterou nastavil, už je v nastaveních níž.',
        'deleted' => 'Styl smazán',
        'deleted_current' => 'To byl ten, na který byl tenhle panel nastavený. Jeho nastavení jsou nezměněná a pořád jsou na téhle stránce - vyberte styl, nebo je uložte znovu pod jménem.',
    ],

    'user_themes' => [
        'label' => 'Styly, které si lidé mohou vybrat pro sebe',
        'helper' => 'Zaškrtnuté styly se objeví na stránce Vzhled v klientské části, kde si každý přihlášený může jeden vybrat pro sebe. Mění to, co vidí on, a pro ostatní nic. Nic zaškrtnutého znamená, že si nikdo nic nevybírá a panel drží jeden vzhled - což je to, co dělá teď.',
    ],

    'mode' => [
        'label' => 'Režim panelu',
        'helper' => 'V jakém režimu se panel otevírá. Kdo si nevybral sám, dostane tenhle; přepínač v uživatelské nabídce mu pořád dovolí to změnit, pokud to níž nezamknete.',
        'dark' => 'Tmavý',
        'light' => 'Světlý',
        'system' => 'Systémový - řídit se nastavením návštěvníka',
    ],

    'font' => [
        'label' => 'Písmo panelu',
        'helper' => 'Každá možnost je rodina, kterou operační systém už má - od poskytovatele písem se nic nestahuje. Terminálu se to netýká: jeho písmo je volba každého, v Účtu.',
        'default' => 'Výchozí - vlastní Pelicanu',
        'mono' => 'Neproporcionální',
        'rounded' => 'Zakulacené',
        'serif' => 'Patkové',
        'system' => 'Systémové - to, které používá tenhle stroj',
    ],

    'surface' => [
        'label' => 'Barva ploch',
        'helper' => 'Karty a panely. Světlejší a tmavší odstíny se z ní odvozují.',
        'placeholder' => 'Řídit se motivem',
    ],

    'radius' => [
        'label' => 'Rohy',
    ],

    'accent' => [
        'label' => 'Akcentní barva',
        'helper' => 'Používá se u tlačítek, odkazů, aktivní položky navigace a prstenců fokusu.',

        /*
         * Řečeno, ne vynuceno. Barva, před kterou tohle varuje, se stejně uloží:
         * je to něčí panel, číslo měří jednu věc a jsou dobré důvody chtít
         * akcent, který dopadne špatně. Výběr řekne, co vidí, a jde z cesty.
         */
        'contrast_dark' => 'Čitelnost: :ratio na tmavém panelu. Pod 3 se akcent špatně čte jako tlačítko nebo odkaz - světlejší ho zvedne.',
        'contrast_light' => 'Čitelnost: :ratio na světlém panelu. Pod 3 se akcent špatně čte jako tlačítko nebo odkaz - tmavší ho zvedne.',
    ],
    'density' => [
        'label' => 'Hustota',
        'helper' => 'Kompaktní stáhne rozestupy, ať se na obrazovku vejde víc řádků.',
        'comfortable' => 'Pohodlná',
        'compact' => 'Kompaktní',
    ],
    'force_dark' => [
        'label' => 'Vynutit tmavý režim',
        'helper' => 'Skryje přepínač světlý/tmavý a drží všechny uživatele na tmavém motivu.',
    ],
    'glass' => [
        'label' => 'Matný topbar',
        'helper' => 'Rozostří topbar a pozadí modálních oken. Na slabších zařízeních vypněte.',
    ],
    'glow' => [
        'label' => 'Akcentní záře',
        'helper' => 'Měkký akcentní stín na hlavních tlačítkách, aktivní navigaci a přihlašovací kartě.',
    ],

    'background' => [
        'label' => 'Typ pozadí',
        'helper' => 'Aurora je vlastní pozadí motivu: akcentní záře s jemným zrnem.',
        'aurora' => 'Aurora (výchozí)',
        'solid' => 'Jedna barva',
        'gradient' => 'Přechod',
        'image' => 'Obrázek',
        'color' => 'Barva',
        'base' => 'Barva pod zářemi',
        'base_helper' => 'To, na čem stránka leží, než se přes ni namalují akcentní záře. Nechte prázdné, ať zůstane výchozí hodnota panelu, skoro černá v tmavém a skoro bílá ve světlém. Nastavte ji a schéma si nechá vlastní noční barvu a stejně bude nasvícené.',
        'color_end' => 'Druhá barva',
        'angle' => 'Směr',
        'upload' => 'Nahrát obrázek',
        'upload_helper' => 'Až 8 MB. Nahraný obrázek má přednost před adresou níž.',
        'url' => 'Nebo adresa URL',
        'url_helper' => 'Musí začínat https:// a být dostupná zvenčí.',
        'dim' => 'Ztmavení',
        'dim_helper' => 'Bez ztmavení se bílý text na světlé fotce nedá číst.',
        'blur' => 'Rozostření',
    ],

    'channel' => [
        'installed' => 'nainstalovaná',
        'version' => 'Nainstalovat konkrétní verzi',
        'version_helper' => 'Jakékoli vydání tohohle kanálu, ne jen to nejnovější - na vrácení se zpět, když se nové ukáže horší, nebo dopředu na build, který vám doporučili zkusit. Jen dokud se aktualizace neinstalují samy: se zapnutým tímhle by vybrané vydrželo do příští kontroly.',
        'version_placeholder' => 'Vyberte verzi',
        'version_install' => 'Nainstalovat tuhle verzi',
        'version_confirm' => 'Panel stáhne to vydání, přestaví své assets a vyprázdní cache. Vaše nastavení zůstávají. Vrátit se ke starší verzi je dovoleno a samo se to nevrací zpátky - vyberte tu novější znovu, ať se pohnete dopředu.',
        'label' => 'Kanál aktualizací',
        'helper' => 'Která vydání stránka motivu nabízí. Beta dostává nové verze první, a ostré hrany taky první.',
        'token' => 'Token dev repozitáře',
        'token_helper' => 'Kanál dev se publikuje ze soukromého repozitáře, takže na jeho čtení je potřeba token GitHubu - fine-grained personal access token s právem číst obsah toho repozitáře, a nic víc. Stabilní a beta jsou veřejné a nepotřebují žádný. Zůstává na tomhle panelu: do exportovaného souboru nastavení se nezapisuje.',
        'stable' => 'Stabilní',
        'beta' => 'Beta',
        'dev' => 'Dev (pracovní větev)',
        'auto' => [
            'label' => 'Instalovat aktualizace automaticky',
            'helper' => 'Vypnuto nechává aktualizování na vás. Zapnuto - panel kontroluje vybraný kanál a instaluje všechno novější; přitom přestavuje své assets a je pár minut nedostupný, proto denní a týdenní jde ve 04:00. Potřebuje běžící cron panelu.',
            'interval' => 'Kontrolovat každých',
            'minute' => 'Každou minutu',
            'five_minutes' => 'Každých 5 minut',
            'ten_minutes' => 'Každých 10 minut',
            'thirty_minutes' => 'Každých 30 minut',
            'hourly' => 'Každou hodinu',
            'daily' => 'Každý den (04:00)',
            'weekly' => 'Každý týden (pondělí 04:00)',
        ],
    ],

    /*
     * Karta Jazyky.
     *
     * Opatrná v tom, co tvrdí. Pelican už každému dovoluje vybrat jazyk pro celý
     * účet a už ho uplatňuje; nic tady to nemění ani by nemělo. Tady se
     * rozhoduje jen o tom, jestli tenhle výběr sledují vlastní texty tohohle
     * pluginu.
     */
    'languages' => [
        'section_helper' => 'Pelican už každému dovoluje vybrat jazyk pro jeho účet a tenhle plugin ho sleduje všude, kde je přeložený. Tady rozhodujete, kterých z nich poslechne. Většina jazyků stojí na nízkém procentu schválně: první se překládá ta část, kterou každý vidí na každé stránce - tlačítka napájení nad konzolí a ukazatele uzlů - a zbytek přichází, jak ho lidé dopisují.',
        'panel' => 'Nechat tohle rozhodovat o jazyce celého panelu',
        'panel_helper' => 'Zapnuto - jazyk, který tenhle plugin nenese, nebo vypnutý níž, přepne pro toho čtenáře do angličtiny celý panel, ne jen tyhle stránky. Vypnuto - seznam sleduje jen tenhle plugin a Pelican dál mluví tím, co je nastavené na účtu, což znamená, že čtenář může na jedné obrazovce potkat dva jazyky. Žádný účet se tak ani tak nemění: zapněte jazyk zpátky a zase ho má.',
        'label' => 'Jazyky, kterými odpovídat',
        'helper' => 'Odškrtnutí pošle zpátky k angličtině - jen pro tenhle plugin - ty čtenáře, kteří ho mají nastavený na účtu; zbytek panelu dál mluví jejich jazykem. Angličtina v seznamu není, protože všechno padá na ni.',
        'under' => 'nenabízí se, dokud nepostoupí dál - zaškrtněte, ať se nabízí i tak',
        'done' => 'přeloženo z :percent %',
        'main' => 'Hlavní jazyk',
        'main_helper' => 'To, co čtenář dostane, když se jeho vlastní jazyk použít nedá - buď ho tenhle plugin nenese, nebo je níž odškrtnutý. Vždycky to byla angličtina; v týmu, který v angličtině nepracuje, to byla špatná odpověď podaná s jistotou. Níž se odškrtnout nedá, protože všechno padá na ni.',
        'labels' => 'Jak se který jazyk jmenuje',
        'labels_helper' => 'Jméno, které čtenáři a administrátoři vidí ve výběrech. Nechte jedno prázdné, ať zůstane jméno, pod kterým ho tenhle plugin zná. Jazyk nahraný pod vlastním jménem žádné nemá, takže by se vypisoval svým kódem, dokud mu tu jméno nedáte.',
        'labels_code' => 'Kód',
        'labels_name' => 'Zobrazovat jako',
        'download' => 'Stáhnout soubor s překladem',
        'download_from' => 'Vyjít z',
        'download_from_helper' => 'JSON se všemi texty tohohle pluginu. Vezměte angličtinu pro jazyk, který nikdo nezačal, nebo existující, ať navážete na to, co už je přeložené.',
        'code' => 'Kód jazyka',
        'code_helper' => 'Kód, ke kterému soubor patří. Skutečná locale tak, jak ji používají účty - fr, de, pt_BR - dojde ke čtenářům, kteří ji mají nastavenou, a musí sedět přesně, jinak nedojde. Vlastní jméno, třeba Gaming-CZ, je dovolené a funguje jinak: Pelican nechá účet držet jen skutečnou locale, takže to vaše si nikdo nevybere. Dostupné je jako hlavní jazyk výše, což je to, co dostane každý, jehož jazyk se použít nedá.',
        'url' => 'Nebo ho stáhnout z adresy',
        'url_helper' => 'Adresa https, na kterou panel dosáhne - CDN, bucket, holý soubor v repozitáři. Stáhne se jednou při uložení a zapíše se stejně jako nahraný, takže změnit soubor na té adrese později nic nedělá, dokud znovu neuložíte. Soubor vybraný výše vyhrává nad adresou ponechanou v tomhle poli.',
        'upload' => 'Nahrát soubor s překladem',
        'upload_helper' => 'Ten JSON shora, s přeloženými hodnotami. Zapisuje se mimo plugin, takže ho aktualizace nezahodí, a slévá se přes angličtinu klíč po klíči - soubor s polovinou textů vám dá poloviční jazyk a angličtinu na zbytek.',
        'uploaded' => 'Nainstalováno textů pro :code: :count',
        'uploaded_halves' => 'Z toho :mine jsou vlastní texty tohohle pluginu a :panel patří panelu. Nula na jedné ze stran znamená, že ta polovina souboru nic neobsahovala - klíče pluginu začínají na essentials:: a klíče panelu ne.',
        'uploaded_skipped' => 'Přeskočeno :count: prázdné nebo klíče, které tenhle plugin nemá. První z nich: :keys',
        'upload_failed' => 'Tenhle soubor se nepodařilo přečíst',
        'upload_failed_body' => 'Musí to být ten JSON ze stažení výše - plochý objekt klíčů a textů. Zkontrolujte, že ho editor neuložil jako něco jiného.',
    ],

    'windows' => [
        'add' => 'Přidat okno',
        'from' => 'Od',
        'to' => 'Do',
        'to_helper' => 'Dřív než začátek znamená, že to přechází přes půlnoc - od 22:00 do 06:00 je noc.',
        'preset' => 'Styl',
        'days' => 'Dny',
        'days_helper' => 'Nechte je všechny nezaškrtnuté, ať to platí každý den. Okno přecházející přes půlnoc patří tomu dni, kterým začíná, takže pátek od 22:00 do 06:00 pokrývá sobotní ráno.',
        'day_mon' => 'Pondělí',
        'day_tue' => 'Úterý',
        'day_wed' => 'Středa',
        'day_thu' => 'Čtvrtek',
        'day_fri' => 'Pátek',
        'day_sat' => 'Sobota',
        'day_sun' => 'Neděle',
    ],

    'arranger' => [
        'label' => 'Uspořádání stránek',
        'helper' => 'Tlačítko „Uspořádat stránku", na každé stránce panelu. Kdo má oprávnění Uspořádat, ten ho dostane a může navíc nastavit uspořádání, od kterého začínají všichni ostatní, nebo uspořádání pro roli. Vypnuto ho skryje všem; už uložená uspořádání zůstávají na místě.',
        'roles' => 'Uspořádání není oprávnění. Blok, který role skryje, zůstává blokem, na který by se někdo dostal napsáním adresy - tomu brání vlastní oprávnění Pelicanu, na stránce rolí. Vrství se tři vrstvy v tomhle pořadí: společná výchozí, pak role čtenáře, pak to, co si posunul sám.',
        'users' => 'Nechat každého uspořádat si vlastní stránky',
        'users_helper' => 'Zapnuto - každý přihlášený smí přeskládat a schovávat bloky na stránkách, které stejně vidí, jen pro sebe; pro nikoho jiného to nic nemění. Nastavení společného výchozího uspořádání zůstává u oprávnění Uspořádat.',
    ],

    'brand' => [
        'logo_height' => 'Výška loga',
        'logo_height_helper' => 'Pelican dodává 2rem. Větší hodnoty zvedají spolu s ním i hlavičku bočního panelu.',
        'logo_url' => 'Nahradit logo',
        'logo_url_helper' => 'Nechte prázdné, ať zůstane to, na co míří vlastní nastavení Pelicanu.',
    ],

    'login' => [
        'image' => 'Obrázek na pozadí',
        'image_helper' => 'Jen pro přihlašovací obrazovku. Bez něj dál ukazuje pozadí panelu.',
        'url' => 'Nebo adresa URL',
        'blur' => 'Rozostření karty',
        'blur_helper' => 'Zmatní kartu, ať obrázek za ní prosvítá.',
        'width' => 'Šířka karty',
        'position' => 'Výřez obrázku',
        'position_helper' => 'Která část obrázku přežije ořez na obrazovku.',
        'position_center' => 'Střed',
        'position_top' => 'Nahoře',
        'position_bottom' => 'Dole',
        'position_left' => 'Vlevo',
        'position_right' => 'Vpravo',
        'align' => 'Umístění karty',
        'align_helper' => 'Kde přihlašovací karta stojí napříč obrazovkou.',
        'align_center' => 'Střed',
        'align_start' => 'Vlevo',
        'align_end' => 'Vpravo',
        'opacity' => 'Krytí karty',
        'opacity_helper' => 'Nižší pouští kartou víc obrázku.',
        'glow' => 'Akcentní záře',
        'glow_helper' => 'Svatozář kolem karty. Vypnuto jí nechává okraj i hloubku.',
        'hide_heading' => 'Skrýt nadpis',
        'hide_heading_helper' => 'Odebere nadpis nad formulářem a nechá formulář samotný.',
        'hide_footer' => 'Skrýt patičku',
        'hide_footer_helper' => 'Odebere řádek pod kartou, který vede na pelican.dev.',
        'above' => 'Řádek nad formulářem',
        'above_helper' => 'Jeden řádek, ukázaný každému, kdo dorazí na přihlašovací obrazovku. Nechte prázdné, ať tam žádný není.',
        'notice' => 'Hláška pod kartou',
        'notice_helper' => 'Jeden řádek, ukázaný každému, kdo dorazí na přihlašovací obrazovku. Nechte prázdné, ať tam žádná není.',
    ],

    'advanced' => [
        'css' => 'Vlastní CSS',
        'css_helper' => 'Až 100 KB. Ukládá se do storage, ne do .env.',
        'reference' => 'Přehled CSS',
        'reference_helper' => 'Každá proměnná a každá třída, které tenhle motiv a panel zpřístupňují.',
    ],

    'areas' => [
        'add' => 'Přidat oblast',
        'area' => 'Oblast',
        'inherit' => 'Obecné',
        'radius' => 'Rohy',
        'radius_sharp' => 'Ostré',
        'radius_normal' => 'Normální',
        'radius_round' => 'Zakulacené',
        'surface' => 'Barva ploch',
        'surface_helper' => 'Karty a panely uvnitř téhle oblasti; světlejší a tmavší odstíny se z ní odvozují.',
        'names' => [
            'terminal' => 'Terminál',
            'console' => 'Konzole (zbytek stránky)',
            'files' => 'Stránka souborů',
            'edit' => 'Stránka úprav',
            'server' => 'Ostatní stránky a karty serveru',
        ],
    ],

    'bars' => [
        'base' => 'Základní barva',
        'base_green' => 'Zelená',
        'base_accent' => 'Akcentní barva',
        'warning' => 'Jantarová od',
        'danger' => 'Červená od',
    ],

    'icons' => [
        'stroke' => 'Tloušťka čáry',
        'stroke_thin' => 'Tenká',
        'stroke_normal' => 'Normální',
        'stroke_bold' => 'Silná',
        'scale' => 'Velikost',
        'accent' => 'Ikony nabídky v akcentní barvě',
        'accent_helper' => 'Týká se ikon v bočním panelu a v topbaru.',
        'pack' => 'Balíček ikon',
        'pack_helper' => 'Ze které sady čerpá výběr níž. Nabízí se každá sada ikon nainstalovaná na serveru, k tomu sada Essentials, která přichází s tímhle pluginem, a jakýkoli balíček, který nahrajete. Jeden rozdíl stojí za to znát: čárová ikona se kreslí barvou nabídky a jde za najetím i aktivní položkou, kdežto ikony Essentials jsou obrázky a drží si vlastní barvy. Rozhoduje o tom, čím soubor je, ne to, ze které sady přišel.',
        'pack_custom' => 'Nahraný balíček',
        'pack_shipped' => 'Ikony Essentials',
        'use_shipped' => 'Použít ikony Essentials všude',
        'use_shipped_confirm' => 'Nastaví balíček na ikony Essentials a vyplní každou položku nabídky níž tou ikonou, která je pro ni nakreslená - konzole dostane terminál, spuštění dostane tlačítko startu a tak dál. Nahradí to položky, které máte teď, a nic se neukládá, dokud nezmáčknete Uložit, takže zavřít stránku to vrátí.',
        'pack_upload' => 'Nahrát balíček',
        'pack_upload_helper' => 'Archiv .zip se soubory SVG. Každý soubor se stane ikonou pojmenovanou po něm - logo.svg se stane custom-logo. Nahrání nahradí balíček, který je tam teď. Soubory nad 256 KB a všechno nad 4 000 ikon zůstane venku a dozvíte se kolik: pro měřítko, celá sada Tabler je skoro šest tisíc ikon zhruba ve třech megabajtech, takže balíček výrazně větší nese něco jiného než ikony a většina se přeskočí. Velké nahrání může být odmítnuto ještě dřív, než tohle pole cokoli řekne - hodnotami upload_max_filesize a post_max_size v php.ini hostitele panelu, a žádné nastavení odsud je nezvýší.',
        'pack_partial' => 'Nainstalováno ikon: :count, ale ne všechny',
        'pack_partial_body' => 'Přeskočeno: :big příliš velké na ikonu, :unusable nepoužitelné jako SVG, :duplicate se jménem, které je už zabrané, :empty po vyčištění není co kreslit. SVG nad 256 KB je skoro vždycky obrázek zabalený do SVG, ne kresba - vyexportujte ho ve velikosti ikony a bude mít pár kilobajtů. Ikona, u které není co kreslit, obsahovala jen něco, co se tady nepodává - jestli je to celý balíček, stojí za to to nahlásit.',
        'pack_stopped_files' => 'Zastavilo se to taky na limitu, kolik ikon smí balíček obsahovat.',
        'pack_stopped_size' => 'Zastavilo se to taky proto, že zbytek balíčku po rozbalení přesahuje to, co panel udrží najednou v paměti - samotný zip může být menší, protože SVG se komprimuje zhruba pět ku jedné.',
        'overrides' => 'Nahradit ikony',
        'overrides_helper' => 'Jeden řádek na každou ikonu, kterou chcete změnit. Vyberte položku nabídky, pak vezměte ikonu z balíčku výše, zadejte adresu, nebo nahrajte vlastní obrázek. Když je vyplněno víc než jedno, vyhrává nahrání, pak adresa, pak balíček.',
        'overrides_key' => 'Položka nabídky',
        'overrides_value' => 'Ikona z balíčku',
        'overrides_url' => 'Nebo adresa',
        'overrides_url_helper' => 'Adresa https obrázku, který hostujete sami - CDN, bucket, kamkoli prohlížeč dosáhne. Do panelu se nic nekopíruje, takže vyměnit soubor na té adrese změní ikonu, aniž by se sáhlo na tuhle stránku; rub toho je, že ikona zmizí, jakmile zmizí adresa. Drží si vlastní barvy, jako nahraný obrázek.',
        'overrides_file' => 'Nebo nahrát obrázek',
        /*
         * Říká, v čem ten rozdíl doopravdy je, protože zjevný není a právě kvůli
         * němu si člověk vybere jedno místo druhého.
         */
        'overrides_file_helper' => 'PNG, SVG nebo ICO. Ikona z balíčku se kreslí barvou nabídky a jde za najetím i aktivní položkou; nahraný obrázek si drží vlastní barvy a to nedělá. U loga se obvykle chce právě tohle.',
        'overrides_add' => 'Nahradit další ikonu',
        'overrides_search' => 'Napište název nebo položku nabídky…',
    ],

    /*
     * Ne pod „Značkou". Značka je o tom, jak panel vypadá; tohle je o tom, jak
     * se v něm objevuje tenhle plugin, což je jiná otázka a odpovídá na ni jiná
     * stránka.
     */
    'identity' => [
        'nav_icon' => 'Ikona pro položku „Nastavení Essentials"',
        'nav_icon_helper' => 'PNG, SVG nebo ICO, až 8 MB. Nahradí ikonu té jedné položky v bočním panelu; nechte prázdné, ať se vezme ta, kterou plugin přináší s sebou. Kreslí se jako obrázek, ne jako ikona, takže si drží vlastní barvy místo toho, aby šla za textem - a to logo obvykle chce. Soubor se podává, ne vkládá, takže si ho každý prohlížeč stáhne jednou, ale i tak stojí za to vyexportovat něco malého: pro položku vysokou dvacet pixelů pár kilobajtů bohatě stačí. Jestli nahrání spadne dřív, než tohle pole cokoli řekne, limit, o který narazilo, je upload_max_filesize v php.ini panelu.',
    ],
];
