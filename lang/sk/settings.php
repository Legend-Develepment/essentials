<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Egg", „uzol", „subuser", „Wings", „queue", „webhook", „topbar", „cron" a
 * názvy formátov súborov ostávajú, ako sú: pod týmito menami sa nájdu v
 * samotnom Pelicane, na hostiteľovi a vo všetkom, čo sa o nich píše. Názvy
 * štýlov sa tiež neprekladajú - štýl sa volá, ako sa volá, a preložené meno by
 * bolo druhým menom tej istej veci.
 */

return [
    'shrunk' => 'Obrázok bol zmenšený',
    'shrunk_body' => ':name prišiel v :was a kreslí sa oveľa menší, takže sa namiesto neho uložila kópia :now. Ten, ktorý si vybral, zostáva nedotknutý na tvojom stroji.',

    'css_warning' => 'Uložené, ale toto CSS vyzerá zle',
    'css_unclosed' => 'Pravidlo otvorené na riadku :line sa nikdy nezatvára. Všetko po ňom stojí vnútri toho pravidla a neuplatní sa.',
    'css_extra' => 'Na riadku :line je zatváracia zátvorka, hoci nič nie je otvorené. Všetko po nej stojí mimo akéhokoľvek pravidla a preskočí sa.',
    'css_comment' => 'Komentár otvorený na riadku :line sa nikdy nezatvára, takže zvyšok súboru stojí vnútri neho.',

    'modules' => [
        'appearance' => 'Ako panel vyzerá',
        'appearance_helper' => 'Farby, tvar, prihlasovacia obrazovka, oznamy, tvoje vlastné odkazy v bočnom paneli a stránky, na ktorých sa to mení. Kvôli tomuto si väčšina panelov tento plugin obstaráva a nestojí to nič, čo by sa dalo zmerať.',

        'servers' => 'Na serveri',
        'servers_helper' => 'To, čo sa objaví vnútri servera alebo vedľa neho v zozname: duplikovanie, hviezdička, tlačidlo konzoly, upozornenie na zálohy, obrázky a stránky pre Minecraft, Palworld, ARK a Valheim.',

        'panel' => 'Udržať panel v chode',
        'panel_helper' => 'Čo je plné, čo sa zastavilo a čo sa stalo. Blok na nástenke, stránka stavu systému, prehľady záloh a plánov, kapacita a záznam činnosti.',

        'alerts' => 'Dať niekomu vedieť',
        'alerts_helper' => 'Strážca, ktorý hlási node, čo prestal odpovedať, plniaci sa disk, stojaci front, vypredaný balík. Posiela na Discord, e-mailom, do panela alebo na tvoju vlastnú adresu a beží podľa času, či sa niekto pozerá alebo nie.',

        'support' => 'Odpovedať zákazníkom',
        'support_helper' => 'Priehradka s tiketmi, v paneli alebo cez Modoru na Discorde. Pridá tlačidlo pomoci na každú stránku a tabuľku, ktorú musí niekto sledovať.',

        'shop' => 'Predávať to, čo prevádzkuješ',
        'shop_helper' => 'Balíky, košík, faktúry, tri platobné brány, obnovy, pozastavenie, kredit, vylepšenia, doplnky a čakací zoznam. Vytvára si vlastné tabuľky a berie peniaze, takže je vypnutý, kým nepovieš inak.',

        'outside' => 'Dostupné zvonku',
        'outside_helper' => 'API s kľúčmi, verejné stránky stavu, ktoré si ktokoľvek otvorí bez prihlásenia, a súbory uložené na CDN alebo v buckete namiesto na tomto stroji. Každé z toho sú dvere; vypnuté, kým jedny sám neotvoríš.',
    ],

    'cost' => [
        'page' => 'Pracuje na každej stránke',
        'timer' => 'Beží podľa času',
        'opened' => 'Len keď to otvoríš',
    ],

    'waiting' => [
        'eggs' => 'Zapnuté a nič neukazuje: najprv urči eggs, ktorých sa to týka.',
        'styles' => 'Zapnuté a nič neukazuje: nikto si nemôže vybrať vlastný štýl, kým žiadny neponúkneš.',
        'store' => 'Zapnuté a súbory drží na tomto stroji. Ukáž na CDN alebo bucket, nech sa to zmení.',
        'shown' => 'Zapnuté a odpovedá 404: vyberte servery, uzly alebo sledovania, ktoré má ukazovať.',
        'granted' => 'Zapnuté a nič neprideľuje: odtiaľto sa nikto na žiadny server nedostane, kým k nejakému serveru nepriradíte rolu.',
    ],

    'needs' => 'Potrebuje :names, a to je vypnuté.',
    'lessens' => 'Bez :names toho robí menej, a to je vypnuté.',

    'groups' => [
        'appearance' => 'Vzhľad',
        'servers' => 'Zoznam serverov',
        'windows' => 'Štýly podľa času',
        'windows_helper' => 'Iný štýl medzi dvoma hodinami dňa. Nič sa nedeje, kým jeden nepridáte. Hodiny sú hodiny samotného panela, z jeho nastavenia časového pásma, nie hodiny každého čitateľa: panel, ktorý by v tú istú chvíľu vyzeral dvom ľuďom inak, by vyzeral pokazene, nie naplánovane. Okno mení vzhľad, ktorý panel už má, takže nerobí nič, kým štýl stojí na „Žiadny". Štýl, ktorý si niekto vybral sám, aj tak vyhráva.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'dontstarve' => 'Don\'t Starve Together',
        'enshrouded' => 'Enshrouded',
        'factorio' => 'Factorio',
        'satisfactory' => 'Satisfactory',
        'terraria' => 'Terraria',
        'vrising' => 'V Rising',
        'onset' => 'Onset',
        'craftopia' => 'Craftopia',
        'valheim' => 'Valheim',
        'languages' => 'Jazyky',
        'files_where' => 'Kde sa súbory ukladajú',
        'files_bucket' => 'Bucket',
        'files_cdn' => 'CDN',
        'files_mirror' => 'Jazyky, držané mimo panela',
        'servers_helper' => 'Ako sa kreslí karta servera. Či sa ukazujú v mriežke alebo v zozname, je voľba každého, v Účet → Rozloženie nástenky.',
        'server_pages' => 'Stránky servera',
        'server_pages_helper' => 'Čo nesie každá stránka vnútri servera, nech je to ktorá chce.',
        'console' => 'Stránka konzoly',
        'console_helper' => 'Písmo terminálu, jeho veľkosť a výška sú voľba každého, v Účte.',
        'background' => 'Pozadie',
        'background_helper' => 'Týka sa celého panela, vrátane prihlasovacej obrazovky.',
        'icons' => 'Ikony',
        'bars' => 'Ukazovatele zdrojov',
        'bars_helper' => 'Pásy procesora, pamäte a disku na kartách serverov.',
        'updates' => 'Aktualizácie',
        'updates_helper' => 'Nainštalovaná verzia a stav aktualizácie, ktorý hlási Essentials Auto Updater, ak je tento plugin nainštalovaný.',
        'brand' => 'Značka',
        'login' => 'Prihlasovacia obrazovka',
        'login_helper' => 'Týka sa obrazoviek prihlásenia, obnovy hesla a druhého faktora.',
        'advanced' => 'Vlastné CSS',
        'advanced_helper' => 'Na všetko, čo nastavenia vyššie nepokrývajú. Načítava sa po všetkom ostatnom, takže vyhráva.',
        'areas' => 'Podľa oblasti',
        'areas_helper' => 'Všetko vyššie platí všade. Tu sa dá jedna oblasť vyčleniť; čo necháte prázdne, sa ďalej riadi všeobecným nastavením.',
        'footer' => 'Päta bočného panela',
        'footer_helper' => 'Spodok bočného panela, ktorý Pelican necháva prázdny. Všetko tu je vypnuté, kým to nevyplníte.',
        'features' => 'Čo tento plugin pridáva',
        'features_helper' => 'Ktoré časti tohto pluginu panel ponúka, sa rozhoduje na stránke modulov, kde sú zoskupené podľa toho, na čo sú, namiesto abecedného zoznamu - a kde prepínač môže povedať, že je zapnutý a zatiaľ nič neukazuje. Vypnúť tam niečo to vezme z panela a nastavenia si to nechá, takže skúsiť to nič nestojí.',
        'features_open' => 'Otvoriť moduly',
        'identity' => 'Tento plugin v bočnom paneli',
        'identity_helper' => 'Položka, ktorú tento plugin do bočného panela pridáva, a obrázok na nej.',
    ],

    /*
     * Stránky nastavení, každá ako položka vo vlastnej skupine pluginu v bočnom
     * paneli. Zoskupené podľa otázky, na ktorú sa odpovedá, nie podľa triedy,
     * ktorá ich realizuje.
     */
    /*
     * Kam sa ukladajú súbory, ktoré si tento plugin drží.
     *
     * Slová hovoria o cieli, nie o poskytovateľovi, lebo tie isté tri vety
     * platia o buckete aj o CDN a správcu, ktorý jedno z nich nastavuje,
     * nezaujíma, na ktoré z nich sa pozerá, dokým sa polia nelíšia.
     */
    'files' => [
        'where' => 'Súbory sa ukladajú',
        'where_helper' => 'Na paneli ležia na jeho vlastnom disku, kam vždy chodili, a netreba na to nič nastavovať. Kdekoľvek inde je miesto, ktoré tento panel držať nemusí a ktoré sa podáva bližšie k tomu, kto sa pozerá. Cieľ, ktorý neodpovie, spadne späť na panel namiesto toho, aby sa nahratý súbor stratil.',
        'panel' => 'Na tomto paneli',
        's3' => 'V buckete (S3, R2, MinIO, Wasabi)',
        'cdn' => 'Na CDN',
        'read_from' => 'Čítať z',
        'read_from_helper' => 'Odkiaľ sa súbor načítava, čo nie je vždy tam, kam sa zapísal. CDN pred bucketom patrí sem a rovnako aj doručovacia adresa, ktorá sa líši od tej, na ktorej beží API. Prázdne necháva na cieli, aby si to odvodil sám.',
        'read_from_https' => 'Toto musí začínať https://, alebo zostať prázdne. Adresa bez toho sa číta ako cesta na tomto paneli, takže by sa na nej nikdy nič nenašlo.',

        'bucket' => 'Bucket',
        'bucket_helper' => 'Čokoľvek, čo hovorí protokolom S3. Endpoint a prepínač path-style potrebujú tie, ktoré nie sú AWS; pre samotné AWS nechajte oboje tak.',
        'bucket_key' => 'Access key',
        'bucket_secret' => 'Secret',
        'bucket_name' => 'Názov bucketu',
        'bucket_region' => 'Región',
        'bucket_region_helper' => 'auto sedí R2 a väčšine tých vo vlastnej réžii. AWS chce svoj vlastný, napríklad eu-central-1.',
        'bucket_endpoint' => 'Endpoint',
        'bucket_endpoint_helper' => 'Pre AWS nechajte prázdne. R2, MinIO aj ostatné majú každý svoj.',
        'bucket_path_style' => 'Adresy v štýle path-style',
        'bucket_path_style_helper' => 'To, čo potrebuje MinIO a väčšina tých vo vlastnej réžii. AWS a R2 nie.',

        'cdn_title' => 'CDN',
        'cdn_helper' => 'CDN, ktorá hovorí API Modory. Token je typu server na server a je plným správcom toho účtu, takže sa do exportovaného súboru nastavení nezapisuje, rovnako ako každý iný prístupový údaj tu.',
        'cdn_base' => 'Adresa',
        'cdn_base_helper' => 'Kde býva API. Ak sa súbory podávajú odinakiaľ, dajte tú adresu vyššie do „Čítať z".',
        'cdn_token' => 'Token',
        'cdn_token_helper' => 'Posiela sa ako X-Internal-Token. Kto ho má, môže do celého účtu zapisovať aj z neho mazať.',
        'cdn_folder' => 'Priečinok',
        'cdn_folder_helper' => 'Priečinok pod účtom, v ktorom sa držia súbory tohto panela, aby jedna CDN mohla obsluhovať viacero panelov bez toho, aby si liezli do cesty.',

        'move' => 'Presunúť to, čo je ešte na paneli',
        'move_confirm' => 'Ikona bočného panela, pozadie panela a pozadie prihlásenia sa skopírujú do cieľa a ich adresy sa prepíšu. Kópie na tomto paneli zostanú tam, kde sú, takže sa nič nepokazí, ak si to rozmyslíte. Obrázky nahraté odteraz idú do cieľa tak či tak; toto je len pre tie, ktoré tu už sú.',
        'move_done' => 'Presunuté',
        'move_done_body' => 'Pozreté :looked, presunuté :moved, nepodarilo sa presunúť :failed.',
        'check' => 'Otestovať to',
        'check_ok' => 'Funguje to',
        'check_ok_body' => 'Súbor sa zapísal, načítal sa späť cez svoju verejnú adresu a zase sa odstránil.',
        'check_bad' => 'Toto nevyšlo',
        'check_panel' => 'Súbory sú nastavené na ukladanie na tomto paneli, takže nie je čo testovať.',
        'check_refused' => 'Cieľ súbor odmietol a o dôvode nepovedal nič.',
        'check_unreadable' => 'Súbor prijal, ale z :url sa nedal prečítať späť. Práve tú adresu použije prehliadač, takže súbor, ktorý si nikto nenačíta, je neskôr pokazený obrázok. Skontrolujte „Čítať z" a to, či cieľ podáva súbory verejne.',
        'bucket_missing' => 'Kým nie je vyplnený access key, secret aj názov bucketu, nie je čo testovať.',
        'cdn_missing' => 'Kým nie je vyplnená adresa aj token, nie je čo testovať.',
        'cdn_shape' => 'Súbor prijal a potom odpovedal v podobe, v ktorej tento panel nenašiel žiadnu adresu. Povedal toto: :body',
        'mirror_minutes' => 'Hľadať zmenené jazyky každých',
        'mirror_minutes_helper' => 'V minútach. Hľadanie je lacné: každý nahratý jazyk sa prečíta, zahašuje a porovná s tým, čo sa naposledy poslalo, takže bežný prechod neodošle vôbec nič. Cez drôt ide len jazyk, ktorý niekto zmenil.',
        'mirror_now' => 'Skopírovať jazyky teraz',
        'mirror_done' => 'Jazyky skopírované',
        'mirror_done_body' => 'Pozreté :looked, odoslané :sent, nepodarilo sa odoslať :failed.',
        'mirror_restore' => 'Obnoviť jazyky',
        'mirror_restore_confirm' => 'Toto prepíše všetko, čo je na tomto paneli, každým jazykom z kópie mimo panela. Presne o to po aktualizácii ide, a nainštalovaný jazyk sa potom nedá nijako odstrániť, takže sa oplatí byť si istý.',
        'mirror_back' => 'Jazyky obnovené',
        'mirror_back_body' => 'Nájdené :found, vrátené :put, nepodarilo sa načítať :failed.',
    ],

    'pages' => [
        'look' => 'Vzhľad',
        'look_helper' => 'Farba, tvar a to, ako sa panel volá.',
        'pages' => 'Stránky',
        'pages_helper' => 'Zoznam serverov, stránky vnútri servera a terminál.',
        'advanced' => 'Pokročilé',
        'advanced_helper' => 'Dva núdzové východy: vlastné CSS a nastavenia, ktoré platia len v jednej oblasti.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Ktoré eggs sú Minecraft a všetko ostatné k tomu.',
        'games' => 'Ďalšie hry',
        'games_helper' => 'Súbory, ktoré si tieto hry držia vedľa svojho sveta, ako formulár namiesto textu. Ktoré servery dostanú stránku, rozhoduje zoznam eggov v každej sekcii, takže sekcia bez zaškrtnutia je tá hra už vypnutá.',
        'languages' => 'Jazyky',
        'languages_helper' => 'V akých jazykoch tento plugin odpovedá.',
        'files' => 'Úložisko a CDN',
        'files_helper' => 'Kam sa ukladajú súbory, ktoré si tento plugin drží, a z akej adresy sa čítajú.',
    ],

    'features' => [
        'look' => 'Nastavenia vzhľadu',
        'look_helper' => 'Položka bočného panela pre farbu, tvar a značku.',
        'pages' => 'Nastavenia stránok',
        'pages_helper' => 'Položka bočného panela pre zoznam serverov, stránky servera a terminál.',
        'advanced' => 'Pokročilé nastavenia',
        'advanced_helper' => 'Položka bočného panela pre vlastné CSS a výnimky podľa oblasti.',
        'announcements' => 'Oznamy',
        'announcements_helper' => 'Pás cez hornú časť panela.',
        'nav_links' => 'Navigačné odkazy',
        'nav_links_helper' => 'Vaše vlastné položky v bočnom paneli.',
        'login' => 'Prihlasovacia obrazovka',
        'login_helper' => 'Obrázok, hláška a odkazy prihlasovacej obrazovky.',
        'bars' => 'Ukazovatele zdrojov',
        'bars_helper' => 'Prefarbené pásy procesora, pamäte a disku.',
        'dashboard_status' => 'Riadok verzie',
        'dashboard_status_helper' => 'Vrch bloku na nástenke: ktorá verzia je nainštalovaná a či nejaká nečaká.',
        'dashboard_nodes' => 'Stroje',
        'dashboard_nodes_helper' => 'Zvyšok bloku na nástenke: tento panel a každý uzol s tým, koľko každý spotrebúva.',
        'system_status' => 'Stránka stavu systému',
        'system_status_helper' => 'Stránka stroja, na ktorom beží samotný panel.',
        'sidebar_footer' => 'Päta bočného panela',
        'sidebar_footer_helper' => 'Váš riadok textu, verzia panela a jeden odkaz, celkom dole v bočnom paneli.',
        'console' => 'Tlačidlo konzoly',
        'console_helper' => 'Plávajúce tlačidlo vnútri servera, s konzolou a tlačidlami napájania na ňom, ktoré dosiahne na uzol rovno. Akú má podobu, sa nastavuje v nastaveniach stránok servera; toto rozhoduje, či sa vôbec kreslí.',
        'arranger' => 'Usporiadanie stránok',
        'arranger_helper' => 'Ťahanie blokov na stránke do poradia, ktoré niekto chce. Nesie vlastné oprávnenie v Rolách, takže toto rozhoduje, či to panel ponúka, a oprávnenie rozhoduje komu.',
        'user_themes' => 'Štýly pre každého',
        'user_themes_helper' => 'Nechať si každého vybrať štýl z tých, ktoré ponúkate, vo Vzhľade v klientskej časti. Ktoré štýly sa ponúkajú, sa nastavuje na stránke Vzhľad; toto rozhoduje, či sa niekoho vôbec pýta.',
        'api' => 'API',
        'api_helper' => 'Cesta dnu zvonka panela: adresa, na ktorej sa bot Discordu alebo vlastný skript môže opýtať na to, čo tento plugin vie - kto hrá, ktoré servery nemajú zálohu, či sa na uzol zmestí ešte jeden. Vypnuté neregistruje vôbec žiadnu cestu namiesto takej, ktorá odmieta, čo je menej povrchu, nie zdvorilejšie množstvo povrchu. Ktokoľvek prihlásený smie požiadať o kľúč, ktorý odpovedá len za jeho vlastné servery; schváliť ho, zamietnuť ho, zrušiť cudzí a vydať kľúč na celý panel - na to všetko treba oprávnenie.',
        'languages' => 'Jazyky',
        'languages_helper' => 'Odpovedať každému v jazyku nastavenom na jeho účte, tam, kde je tento plugin preložený. Vypnuté - každý dostane angličtinu.',
        'files' => 'Úložisko a CDN',
        'files_helper' => 'Držanie súborov tohto pluginu inde než na paneli: v buckete S3 alebo na CDN. Vypnuté neznamená „žiadne súbory" - znamená vlastný disk panela, kam vždy chodili. Toto rozhoduje o tom, či sa vôbec ponúka niečo iné. Cieľ, ktorý neodpovie, spadne späť na panel namiesto toho, aby sa nahratý súbor stratil, a už zapísaná adresa sa nikdy neberie späť: táto zmena rozhoduje o tom, kam pôjde ďalší súbor, nie o tom, kde býva ten posledný.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Karta Minecraft v bočnom paneli a stránka vnútri každého servera Minecraftu na úpravu jeho server.properties ako formulára. Ktoré eggs sa počítajú, hovoríte vy.',
        'palworld' => 'Nastavenia Palworldu',
        'palworld_helper' => 'Stránka vnútri servera Palworldu na úpravu jeho nastavení sveta. Na žiadnom inom serveri sa neobjaví, a nikdy, kým ten server beží.',
        'settings_search' => 'Hľadanie v nastaveniach',
        'settings_search_helper' => 'Pole nad týmito formulármi, ktoré ich zúži na sekcie obsahujúce to, čo napíšete.',
        'preview' => 'Živý náhľad',
        'waitlist' => 'Čakací zoznam',
        'waitlist_helper' => 'Možnosť požiadať o správu, keď je vypredaný balík zase v predaji. Keď sa zásoba vráti, dozvedia sa to naraz všetci, čo naň čakajú, a dostane ho ten, kto kúpi prvý - nedrží sa nič pre nikoho a každá správa to hovorí. Správa berie človeka zo zoznamu, takže jedna žiadosť kupuje jedno upozornenie a nikdy nie trvalý odber. Potrebuje obchod a je to jediná vec v obchode, ktorá píše zákazníkovi, čo si nič nekúpil.',
        'preview_helper' => 'Rámček vedľa formulára Vzhľad, ktorý ukazuje, čo farby, rohy a rozostupy robia ešte pred uložením.',
        'duplicate' => 'Duplikácia servera',
        'duplicate_helper' => 'Stránka na postavenie ďalšieho servera presne ako toho, ktorý už máte, alebo rovno niekoľkých. Súbory sa nikdy nekopírujú.',
        'favourites' => 'Označené servery',
        'favourites_helper' => 'Hviezdička na každej karte servera. Označené idú prvé a zoznam každého sa drží v paneli - takže jeho hviezdičky idú s ním tam, kde sa nabudúce prihlási. Mení to, čo vidí on, a pre ostatných nič. Byť v paneli však znamená, že je to súbor v storage, ktorý si môže prečítať každý, kto má prístup k stroju.',
        'artwork' => 'Obrázky eggs',
        'artwork_helper' => 'Administrátorská stránka, ktorá sťahuje obrázok každého egg zo Steamu alebo z IGDB a zapisuje ho priamo do egg.',
        'alerts' => 'Upozornenia',
        'alerts_helper' => 'Pravidelná kontrola uzla, ktorý prestal odpovedať, plniaceho sa disku, mŕtveho queue workera alebo zaostávajúcej verzie - a správa na Discord, do panela alebo e-mailom, ktorú pošle.',
        'backups' => 'Prehľad záloh',
        'backups_helper' => 'Administrátorská stránka, ktorá vypisuje každý server podľa toho, ako dlho je bez zálohy. Len na čítanie.',
        'public_status' => 'Verejná stránka stavu',
        'public_status_helper' => 'Stránka, ktorú môže otvoriť ktokoľvek bez účtu. Vypnuté - adresa odpovedá 404, nech je v zozname čokoľvek.',
        'game_players' => 'Hráči, ďalšie hry',
        'game_players_helper' => 'Stránka vnútri Rustu, ARKu, Valheimu a všetkého, čo odpovedá na dopyt Valve, ktorá ukazuje, kto je pripojený a ako dlho.',
        'owner_alerts' => 'Hovoriť ľuďom, že ich server je offline',
        'owner_alerts_helper' => 'Jediná časť tohto pluginu, ktorá píše ľuďom, ktorí nie sú administrátori: upozornenie v paneli, keď stroj, na ktorom stojí jeden z ich serverov, prestane odpovedať, a ďalšie, keď sa vráti. Zvonček, nikdy e-mail a nikdy pripomienka medzitým - opakovať to každú štvrťhodinu všetkým na vyťaženom uzle je presne to, po čom sa upozornenia v paneli prestanú čítať. Subuseri sa to nedozvedia, lebo rozhodnúť, čo ďalej, je na majiteľovi, a meno stroja v upozornení nezaznie z toho istého dôvodu, pre ktorý ho nezverejňuje stránka stavu. Vypnuté, kým sa to nezapne, ako zvyšok.',
        'my_backups' => 'Upozornenie na zálohy v zozname serverov',
        'my_backups_helper' => 'Riadok nad vlastným zoznamom serverov každého človeka, keď niektorý z jeho serverov nikdy nemal zálohu alebo ju dlhšie nemá. Karty Pelicanu hovoria, čo server robí teraz; nič tam nehovorí, že záloha nebežala tri týždne. Kreslí sa len vtedy, keď niečo zaostáva, a nepomenúva žiadny server, ktorý by ten človek aj tak nemohol otvoriť.',
        'capacity' => 'Prehľad kapacity',
        'capacity_helper' => 'Administrátorská stránka, ktorá ukazuje pamäť, disk a procesor sľúbené proti dostupným na každom stroji, spolu so servermi, ktorým došli zálohy, databázy alebo alokácie. Sľúbené, nie spotrebované - uzol môže byť vyťažený a prázdny, alebo nečinný a plný.',
        'schedules' => 'Prehľad naplánovaných úloh',
        'schedules_helper' => 'Administrátorská stránka, ktorá vypisuje všetky naplánované úlohy panela, najhoršie hore - zaseknuté, oneskorené, alebo nikdy nespustené. Len na čítanie; všetko, čo úlohu upravuje alebo spúšťa, ostáva na stránke Pelicanu pre ten server.',
        'activity' => 'Aktivita panela',
        'activity_helper' => 'Administrátorská stránka, ktorá vypisuje každú zaznamenanú udalosť panela, najnovšiu hore, spolu s tým, kto ju vykonal a na ktorom serveri. Len na čítanie - nič nemaže, a ako dlho sa riadky uchovávajú, ďalej rozhoduje nastavenie samotného Pelicanu.',
        'access' => 'Prístup k serverom podľa roly',
        'access_helper' => 'Stránka na zviazanie roly so servermi, udržiavaná v súlade v tabuľke subusers samotného Pelicanu. Nič neprideľuje, kým niečo nepriradíte. Vypnutie zastaví zosúlaďovanie; už pridelený prístup ostáva, a stránka má tlačidlo, ktorým sa dá vziať späť.',
        'scheduled' => 'Štýly podľa času',
        'scheduled_helper' => 'Sekcia na stránke Vzhľad, ktorá panelu dáva iný štýl medzi dvoma hodinami dňa. Nemení nič z uloženého - okno sa položí cez nastavenia vo chvíli, keď sa stránka kreslí, a hneď nato sa pustí - takže vypnutie vráti vlastný vzhľad panela okamžite a nič nestratí.',
        'games' => 'Ďalšie hry',
        'games_helper' => 'Konfiguračný súbor, ktorý si drží každá z týchto hier, ako formulár namiesto súboru v správcovi. Ktoré servery ho dostanú, rozhoduje zoznam eggov na stránke Ostatné hry.',
        'quick' => 'Ponuka „Prejsť na"',
        'quick_helper' => 'Jeden prvok hore na každej stránke na skok na server alebo na označenú stránku, s vyhľadávacím poľom cez celý váš zoznam serverov. Označuje aj tú stránku, na ktorej práve stojíte. To, čo cez neho niekto nájde, mohol aj tak otvoriť, takže to nič neprideľuje - vypnutie vezme túto skratku a stránku Obľúbené spolu s ňou.',
        'shop' => 'Obchod',
        'shop_helper' => 'Predaj serverov z panela: obchod a pokladňa v zákazníckej časti, stránka faktúr každého človeka a stránka Nastavenia obchodu pre menu, daň a texty. Hlavný prepínač - vypnutý, a nikto nemôže kúpiť ani zaplatiť, kým už predané sa ďalej spravuje stránkami nižšie.',
        'packages' => 'Balíky',
        'packages_helper' => 'Stránka správy, kde sa určuje, čo sa predáva: šablóna servera s cenou, obdobím a skladom. Vlastné oprávnenie, lebo stanoviť ceny je iná práca než označovať faktúry ako zaplatené.',
        'orders' => 'Objednávky',
        'orders_helper' => 'Stránka správy so všetkým, čo bolo kúpené, serverom, ktorým sa každá stala, a jej stavom - čaká, aktívna, pozastavená, zrušená. Vlastné oprávnenie.',
        'invoices' => 'Faktúry',
        'invoices_helper' => 'Stránka správy s tým, čo sa dlhuje a čo bolo zaplatené, s tlačidlom na ručné označenie faktúry ako zaplatenej. Vlastné oprávnenie, lebo to tlačidlo je miesto, kde sa zapisujú peniaze.',
        'payments' => 'Platby',
        'payments_helper' => 'Platobní poskytovatelia - ich kľúče a každý pokus, ktorý cez nich prešiel. Vlastné oprávnenie, lebo tam ležia prihlasovacie údaje: kto smie vidieť každú faktúru, nemusí vidieť tajomstvo.',
        'coupons' => 'Kupóny',
        'coupons_helper' => 'Kódy, ktoré odpočítajú percento alebo pevnú sumu z prvej faktúry, s platnosťou a limitom použití. Vlastné oprávnenie.',
        'customers' => 'Zákazníci',
        'customers_helper' => 'Správcovská stránka, ktorá obchod otáča: jeden riadok na človeka, ktorý nakúpil, s tým, čo má, čo zaplatil a čo zostáva. Vlastné právo, lebo je to jediná stránka obchodu o človeku namiesto o riadku - kto určuje ceny, celú históriu zákazníka nepotrebuje, a kto odpovedá na požiadavku, áno.',
        'credit' => 'Kredit a vrátenie peňazí',
        'credit_helper' => 'Peniaze, ktoré obchod pre zákazníka drží. Vrátenie môže ísť späť na kartu, z ktorej prišlo, alebo zostať na účte ako kredit; tak či tak sa vypíše dobropis, a kredit na účte sa z ďalšej faktúry odpočíta sám ešte skôr, než je zákazník o zaplatenie vôbec požiadaný. Vlastné právo, lebo označiť faktúru za zaplatenú zaznamenáva, že peniaze prišli, a toto peniaze vydáva.',
        'upgrades' => 'Prechod hore aj dole',
        'upgrades_helper' => 'Presun bežiacej služby na iný balík bez toho, aby sa kupovala nová. To, čo zostáva zo zaplateného obdobia, sa vráti, ten istý úsek sa naúčtuje novou cenou a rozdiel sa buď vyfaktúruje, alebo pripíše zákazníkovi na účet. Každý balík vymenúva, na ktoré ďalšie sa smie prejsť, a ponúkajú sa len tie s rovnakým eggom: iný egg je iný server, nie väčší.',
        'addons' => 'Doplnky',
        'addons_helper' => 'Veci predávané popri balíku: viac pamäte, ďalšie miesto na zálohu alebo niečo, čo je len riadkom na faktúre. Každý hovorí, ku ktorým balíkom sedí a čo pridáva serveru, a účtuje sa buď pri každom obnovení, alebo jednorazovo. Kupuje sa pri objednávaní alebo neskôr k bežiacej službe, kde sa prepočíta na to, čo z obdobia zostáva. Vlastné právo, lebo to, čo smie doplnok niekomu pridať k serveru, je rozhodnutie o jeho stroji, nie o cenníku.',
        'tickets' => 'Požiadavky',
        'tickets_helper' => 'Miesto, kde sa zákazníci môžu opýtať zvnútra panela, hneď vedľa služby, ktorej sa to týka - a to je jediná vec, ktorú chatovací kanál nedokáže. Odpovedá sa na stránke tu, alebo sa to podá Discordu cez Modoru, podľa toho, ako je stránka Požiadavky nastavená. Každá otázka aj každá odpoveď sa v tomto paneli držia tak či tak, takže sa nič nestratí, keď sa na druhý koniec nedá dosiahnuť. Vlastné právo, lebo odpovedať zákazníkom je práca, ktorú niekto dostane, nie taká, ktorá príde s oceňovaním balíkov.',
        'overview' => 'Prehľad obchodu',
        'overview_helper' => 'Stránka, ktorá odpovedá, čo prišlo tento mesiac, čo sa dlhuje, koľko mesačne nesú aktívne služby a čomu sa dnes treba venovať. Vlastné právo, lebo obrat nie je niečo, čo by mal vedieť prečítať každý, kto smie oceniť balík.',
        'terminate' => 'Ukončenie služby',
        'terminate_helper' => 'Tlačidlo, ktoré službu zastaví hneď teraz a zmaže jej server aj so súbormi. Naschvál mimo práva na objednávky: pozastavenie, posunutie splatnosti aj zrušenie sa dajú vziať späť, toto nie. Kto odpovedá na požiadavky, môže mať prvé tri bez tohto.',
        'public_shop' => 'Verejná stránka obchodu',
        'public_shop_helper' => 'Stránka, ktorú môže otvoriť ktokoľvek bez účtu, s tým, čo sa predáva. Nezverejňuje nič, čo by prihlásený zákazník v obchode nevidel, takže zapnuté alebo vypnuté je celé rozhodnutie - vypnuté odpovedá 404, ako stránka stavu.',
        'pelican_strings' => 'Vlastné texty Pelicanu',
        'pelican_strings_helper' => 'Vlastné stránky Pelicanu vo vašom jazyku tam, kde jeho preklad končí. Jeho preklady robí komunita a väčšina nie je hotová; Essentials doplní len to, čo Pelican na tomto paneli nemá, takže každý text, ktorý Pelican má, zostane jeho slovami. Vypnuté zostane zvyšok Pelicanu po anglicky.',
        'log_clock' => 'Log v čase servera',
        'log_clock_helper' => 'Log panela sa zapisuje v časovom pásme, na ktoré je nastavený samotný server, takže jeho riadky sedia s nginx a systémovým žurnálom. Mení sa len log: Pelican naďalej ukladá časy v UTC a každému účtu ukazuje jeho vlastné pásmo. Vypnuté zostane log v UTC, ako ho píše Pelican.',
    ],

    /*
     * Vyhľadávacie pole nad formulármi nastavení. Preosieva to, čo už na stránke
     * v prehliadači je, a servera sa na nič nepýta, takže nie je žiadny stav
     * „hľadám", ktorý by sa dal opísať, ani spôsob, ako by to mohlo zlyhať.
     */
    /*
     * Rámček náhľadu. Všetko v ňom je náhrada, nie vzorka vášho panela, a slová
     * to hovoria - rámček, ktorý by pomenoval skutočný server alebo skutočné
     * číslo, by sa tak aj čítal.
     */
    'preview' => [
        'label' => 'Náhľad',
        'card' => 'Karta',
        'card_helper' => 'Nakreslená tými istými pravidlami ako panel, len s nastaveniami z tejto stránky namiesto uložených.',
        'button' => 'Tlačidlo',
        'field' => 'Pole',
        'meter_ok' => 'V poriadku',
        'meter_warning' => 'Varovanie',
        'meter_danger' => 'Nebezpečenstvo',

        /*
         * Náhľad cez celú stránku. Karta, nie panel, lebo Pelican posiela
         * X-Frame-Options: DENY a odmieta sa nechať vložiť do rámu čímkoľvek,
         * vrátane seba samého - pozri Support\FullPreview.
         */
        'full' => 'Zobraziť celý panel',
        'full_confirm' => 'Otvorí panel nakreslený z nastavení tejto stránky namiesto z uložených. Nič sa nezapisuje - hodnoty sa držia pätnásť minút a panel sa vráti do normálu, keď z náhľadu odídete alebo uložíte.',
        'full_go' => 'Ukázať',
        'full_failed' => 'Náhľad sa nepodarilo spustiť',
        'bar' => 'Pozeráte sa na neuložené nastavenia. Nič z tohto sa nezapísalo.',
        'bar_back' => 'Späť do nastavení',
    ],

    'search' => [
        'placeholder' => 'Hľadať v nastaveniach',
        'label' => 'Hľadať v týchto nastaveniach',
        'none' => 'Na tejto stránke nič nesedí. Nastavenia sú rozložené na štyroch stránkach - skúste Vzhľad, Stránky, Pokročilé alebo Nastavenia Essentials.',
    ],

    'footer' => [
        'text' => 'Váš vlastný riadok',
        'text_helper' => 'Obyčajný text, najviac 120 znakov. Escapuje sa, rovnako ako pás oznamov - toto sa vykresľuje na každej stránke panela, takže je to zlé miesto na prijímanie značiek.',
        'version' => 'Zobraziť verziu panela',
        'version_helper' => 'Verziu Pelicanu, nie tohto pluginu. Plugin svoju vlastnú hlási na nástenke; dole v bočnom paneli ľudia hľadajú odpoveď na to, ktorý panel majú pred sebou.',
        'link_label' => 'Text odkazu',
        'link_url' => 'Adresa odkazu',
        'link_url_helper' => 'Adresa http alebo https, alebo cesta samotného panela, napríklad /account. Otvára sa v novej karte.',
    ],

    'layout' => [
        'label' => 'Rozloženie',
        'helper' => 'Ako je panel usporiadaný, nie akú má farbu. Platí rovnako pre administrátorskú časť, zoznam serverov aj klientsku časť. Kam ide navigácia, je predvolená hodnota: kto si svoju nastavil v Účet → Navigácia, tomu ostane.',
        'default' => 'Bočný panel - vlastný Pelicanu',
        'rail' => 'Lišta ikon - úzka, rozbaľuje sa nabehnutím',
        'top' => 'Navigácia hore - bez bočného panela',
        'mixed' => 'Horný aj bočný - oboje',
        'wide' => 'Široké - obsah zaberá celú obrazovku',
        'focus' => 'Sústredené - úzky stĺpec, bočný panel sa skladá',

        'nav_label' => 'Štýl bočného panela',
        'nav_helper' => 'Ako sa kreslí samotný bočný panel.',
        'nav_default' => 'Predvolený',
        'nav_floating' => 'Plávajúci - vlastná karta',
        'nav_flat' => 'Plochý - bez akéhokoľvek pozadia',
        'nav_bordered' => 'S rámčekom - čiara, nie plocha',

        'topbar_label' => 'Štýl topbaru',
        'topbar_helper' => '„Skryté" platí len na počítači - na telefóne nesie topbar jedinú cestu späť do ponuky.',
        'topbar_default' => 'Predvolený',
        'topbar_floating' => 'Plávajúci - odsadený pás',
        'topbar_flush' => 'Zarovnaný - plochý, bez rozostrenia',
        'topbar_hidden' => 'Skrytý na počítači',

        'card_label' => 'Štýl kariet',
        'card_helper' => 'Sekcie, widgety, karty serverov a bloky nad konzolou.',
        'card_default' => 'Predvolený - nadvihnutá, s mäkkým okrajom',
        'card_flat' => 'Plochá - bez nadvihnutia',
        'card_outline' => 'Obrys - rámček a za ním nič',
        'card_glass' => 'Matná - pozadie presvitá',
        'card_sharp' => 'Ostrá - pravé uhly',
    ],

    'servers' => [
        /*
         * Hviezdička na karte. Odovzdaná skriptu, nie vpísaná doň, aby texty
         * ostali na tom jedinom mieste, kde texty bývajú.
         */
        'favourite' => 'Označiť tento server',
        'favourited' => 'Označené - zobrazuje sa prvé',

        /*
         * Pilulka vedľa vlastných kariet Pelicanu. Pomenovaná podľa toho, čo
         * robí so zoznamom, nie ako štvrtá karta, lebo preosieva tú vybranú
         * namiesto toho, aby ju nahrádzala.
         */
        'favourites_tab' => 'Obľúbené',
        'favourites_empty' => 'Na tejto stránke nie je nič označené. Použite hviezdičku na karte servera, nech niečo pridáte - a všimnite si, že toto preosieva servery, ktoré tu už sú vypísané: označený server na ďalšej stránke sa neschováva, jednoducho na tejto nie je.',
        'favourites_failed' => 'Vaše označené servery sa nepodarilo uložiť, takže sa vrátili k tomu, čo mal panel naposledy. V konzole prehliadača vidno, čo požiadavka odpovedala.',

        'art' => 'Obrázok hry',
        'art_helper' => 'Pelican kreslí obrázok egg na každú kartu. Toto rozhoduje, čo sa s ním urobí.',
        'art_faded' => 'Vyblednutý - závoj za textom',
        'art_cover' => 'Krycí - za menom, stráca sa',
        'art_off' => 'Vypnuté',
        'art_dim' => 'Stmaviť obrázok',
        'art_dim_helper' => 'Obrázok jednej hry je svetlá obloha a inej jaskyňa.',

        'status' => 'Značka stavu',
        'status_helper' => 'Kde sa ukazuje farba beží / spúšťa sa / zastavené.',
        'status_bar' => 'Pás - pozdĺž ľavého okraja',
        'status_edge' => 'Hrana - naprieč vrchom',
        'status_dot' => 'Bodka - v rohu',
        'status_off' => 'Vypnuté',

        'density' => 'Výška kariet',
        'density_comfortable' => 'Pohodlná',
        'density_compact' => 'Kompaktná - keď je serverov veľa',

        'filter_label' => 'Popísať tlačidlo filtra',
        'filter_label_helper' => 'Pelican tento zoznam aj tak preosieva podľa egg a podľa vlastníka, na všetkých stránkach - lenže vstup je nepopísaná ikona vedľa vyhľadávacieho poľa. Toto na ňu dá to slovo.',
        'filter_button' => 'Filtre',

        'columns' => 'Kariet vedľa seba na širokej obrazovke',
        'columns_helper' => 'Platí len pre mriežku, a až od 1280px. Vlastný strop Pelicanu sú dve.',
    ],

    'controls' => [
        'mode' => 'Tlačidlo konzoly na každej stránke servera',
        'mode_helper' => 'Jedno plávajúce tlačidlo, na každej stránke vnútri servera. Otvorí konzolu cez to, čo ste práve robili, so stavom a tlačidlami napájania v hlavičke - dosiahne na uzol rovno, ako to robí zoznam serverov, nie cez websocket stránky konzoly. Na samotnej stránke konzoly sa neobjaví nikdy: tam už toto všetko je.',
        'mode_full' => 'Konzola a tlačidlá napájania',
        'mode_console' => 'Len konzola',

        'label' => 'Na tlačidle je',
        'label_text' => 'Ikona a meno',
        'label_icon' => 'Len ikona',

        'position' => 'Kde pláva',
        'position_helper' => 'Pri tom okraji, ktorý práve najskôr nečítate.',
        'position_top' => 'Hore',
        'position_right' => 'Vpravo',
        'position_bottom' => 'Dole',
    ],

    'console' => [
        'stats' => 'Bloky nad konzolou',
        'stats_helper' => 'Pelican nad terminálom ukazuje meno, stav, adresu a tri čísla využitia. Keď sa skryjú, konzola dostane výšku späť.',
        'stats_tiles' => 'Dlaždice - popis, číslo a ikona',
        'stats_plain' => 'Jednoducho - tak, ako ich kreslí Pelican',
        'stats_off' => 'Skryté',
    ],

    'terminal' => [
        'helper' => 'Odovzdávajú sa samotnému terminálu, takže začnú platiť pri ďalšom načítaní stránky, nie vo chvíli uloženia.',

        'renderer' => 'Kreslí',
        'renderer_helper' => 'Pelican kreslí terminál na GPU, a to je pri stene rolujúceho výstupu oveľa rýchlejšie. Prehliadač drží nažive len niekoľko GPU kontextov naraz - na telefóne menej - a pri prekročení limitu ten najstarší odoberie; terminál potom nekreslí vôbec nič, a to bez jedinej chyby. Keď sa vám konzola vybieli, kým všetko ostatné vyzerá správne, je to toto nastavenie, ktoré sa mení.',
        'renderer_webgl' => 'GPU - vlastný variant Pelicanu, rýchlejší',
        'renderer_dom' => 'Prehliadač - pomalší, kreslí vždy',

        'scheme' => 'Farebná schéma',
        'scheme_helper' => 'Jediné nastavenie terminálu, ktoré Pelican neponúka. „Riadiť sa motívom" odvodzuje farby z akcentu, a práve preto toto vôbec existuje.',
        'scheme_theme' => 'Riadiť sa motívom',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Kurzor',
        'cursor_helper' => 'Konzola písanie neprijíma - pole na príkazy je pod ňou - takže toto je miesto, kde sa výstup zastavil, nie miesto, kde ste vy.',
        'cursor_underline' => 'Podčiarknutie - vlastný variant Pelicanu',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Čiarka',

        'blink' => 'Blikajúci kurzor',

        'scrollback' => 'História rolovania',
        'scrollback_helper' => 'Ako ďaleko späť sa dá v konzole rolovať. Každý riadok sa drží v prehliadači, takže ukecaný server pri vysokom nastavení je naozajstná pamäť na tom stroji, ktorý to číta.',
        'scrollback_lines' => 'riadkov: :lines',
    ],

    'notice' => [
        'text' => 'Správa',
        'text_helper' => 'Jeden riadok, až 200 znakov. Escapuje sa na vstupe aj na výstupe, takže nemôže zaniesť značky na stránku, ktorú načítavajú iní ľudia.',
        'style' => 'Tón',
        'style_info' => 'Informácia',
        'style_warning' => 'Varovanie',
        'style_danger' => 'Naliehavé',
        'style_accent' => 'Akcentná farba',
        'scope' => 'Zobraziť',
        'scope_all' => 'Všetkým',
        'scope_client' => 'Len mimo administrátorskej časti',
        'scope_admin' => 'Len v administrátorskej časti',
        'link_label' => 'Text tlačidla',
        'link_url' => 'Adresa tlačidla',
        'link_url_helper' => 'https:// alebo cesta vnútri tohto panela, napríklad /account. Všetko ostatné sa ignoruje - odkaz v páse, ktorý je na každej stránke, nie je miesto pre schému, ktorú nikto nečaká.',
        'dismissible' => 'Dá sa zavrieť',
        'dismissible_helper' => 'Že sa zavrela, si pamätá každý prehliadač zvlášť, a len pre túto správu: zmeňte text a vráti sa všetkým.',
        'dismiss' => 'Zavrieť',
    ],

    'preset' => [
        'label' => 'Štýl',
        'helper' => 'Vyberte vzhľad, od ktorého začať. Vyplní všetko nižšie, čo potom môžete meniť. „Žiadny" motív vypne a nechá panel presne taký, aký ho Pelican dodáva.',
        'options' => [
            'none' => 'Žiadny - bez motívu',
            'legend' => 'Legend - červený oheň prechádzajúci v modrý blesk',
            'ember' => 'Ember - teplá čierna, oranžový akcent',
            'midnight' => 'Midnight - hlboká modrá, pokojná',
            'crimson' => 'Crimson - červená, ostré rohy, kompaktné',
            'forest' => 'Forest - zelená, zaguľatená, bez žiary',
            'nebula' => 'Nebula - fialová s prechodovým pozadím',
            'terminal' => 'Terminal - zelená na čiernej, neproporcionálne, ostro',
            'console' => 'Console - okrúhle a priestranné, na tablet',
            'nord' => 'Nord - paleta Nord, tlmená',
            'solarized' => 'Solarized - Solarized dark, azúrový akcent',
            'paper' => 'Paper - svetlý, silný kontrast, plochý',
            'daylight' => 'Daylight - svetlý a teplý, s mäkkým závojom',
            'mono' => 'Mono - odtiene sivej, ploché a husté',
        ],

        'save' => 'Uložiť ako štýl',
        'save_confirm' => 'Nechá si farby, rohy, pozadie, písmo, ikony a prahy ukazovateľov, ktoré máte práve teraz na obrazovke - pod vlastným menom, vo výbere vedľa vstavaných. Ukladá to, čo je na stránke, nie to, čo sa uložilo naposledy.',
        'save_name' => 'Názov',
        'save_name_helper' => 'Ako sa bude vo výbere volať. Uloženie pod už použitým menom ten štýl nahradí.',
        'saved' => 'Štýl uložený',
        'save_failed' => 'Tento štýl sa nepodarilo uložiť',
        'save_full' => 'Miesta je na vlastných štýlov: :max. Najprv jeden zmažte.',

        'delete' => 'Zmazať štýl',
        'delete_which' => 'Ktorý',
        'delete_confirm' => 'Zmazať sa dajú len vlastné štýly; vstavané nie. Na súčasnom vzhľade panela sa nič nemení - štýl je východiskový bod a každá hodnota, ktorú nastavil, už je v nastaveniach nižšie.',
        'deleted' => 'Štýl zmazaný',
        'deleted_current' => 'To bol ten, na ktorý bol tento panel nastavený. Jeho nastavenia sú nezmenené a stále sú na tejto stránke - vyberte štýl, alebo ich uložte znova pod menom.',
    ],

    'user_themes' => [
        'label' => 'Štýly, ktoré si ľudia môžu vybrať pre seba',
        'helper' => 'Zaškrtnuté štýly sa objavia na stránke Vzhľad v klientskej časti, kde si každý prihlásený môže jeden vybrať pre seba. Mení to, čo vidí on, a pre ostatných nič. Nič zaškrtnuté znamená, že si nikto nič nevyberá a panel drží jeden vzhľad - čo je to, čo robí teraz.',
        'helper_off' => 'Zaškrtnuté štýly sa objavia na stránke Vzhľad v klientskej časti, kde si každý prihlásený môže jeden vybrať pre seba. Osobné štýly sú teraz vypnuté, takže sa nikoho nepýtame. Ich vypínač je na stránke Moduly, a čo tu zaškrtnete, ostane uložené a začne fungovať, hneď ako bude zase zapnutý.',
    ],

    'mode' => [
        'label' => 'Režim panela',
        'helper' => 'V akom režime sa panel otvára. Kto si nevybral sám, dostane tento; prepínač v používateľskej ponuke mu stále dovolí to zmeniť, ak to nižšie nezamknete.',
        'dark' => 'Tmavý',
        'light' => 'Svetlý',
        'system' => 'Systémový - riadiť sa nastavením návštevníka',
    ],

    'font' => [
        'label' => 'Písmo panela',
        'helper' => 'Každá možnosť je rodina, ktorú operačný systém už má - od poskytovateľa písem sa nič nesťahuje. Terminálu sa to netýka: jeho písmo je voľba každého, v Účte.',
        'default' => 'Predvolené - vlastné Pelicanu',
        'mono' => 'Neproporcionálne',
        'rounded' => 'Zaguľatené',
        'serif' => 'Pätkové',
        'system' => 'Systémové - to, ktoré používa tento stroj',
    ],

    'surface' => [
        'label' => 'Farba plôch',
        'helper' => 'Karty a panely. Svetlejšie a tmavšie odtiene sa z nej odvodzujú.',
        'placeholder' => 'Riadiť sa motívom',
    ],

    'radius' => [
        'label' => 'Rohy',
    ],

    'accent' => [
        'label' => 'Akcentná farba',
        'helper' => 'Používa sa pri tlačidlách, odkazoch, aktívnej položke navigácie a prstencoch fokusu.',

        /*
         * Povedané, nie vynútené. Farba, pred ktorou toto varuje, sa aj tak
         * uloží: je to niečí panel, číslo meria jednu vec a sú dobré dôvody
         * chcieť akcent, ktorý dopadne zle. Výber povie, čo vidí, a ide z cesty.
         */
        'contrast_dark' => 'Čitateľnosť: :ratio na tmavom paneli. Pod 3 sa akcent zle číta ako tlačidlo alebo odkaz - svetlejší ho zdvihne.',
        'contrast_light' => 'Čitateľnosť: :ratio na svetlom paneli. Pod 3 sa akcent zle číta ako tlačidlo alebo odkaz - tmavší ho zdvihne.',
    ],
    'density' => [
        'label' => 'Hustota',
        'helper' => 'Kompaktná stiahne rozostupy, nech sa na obrazovku zmestí viac riadkov.',
        'comfortable' => 'Pohodlná',
        'compact' => 'Kompaktná',
    ],
    'force_dark' => [
        'label' => 'Vynútiť tmavý režim',
        'helper' => 'Skryje prepínač svetlý/tmavý a drží všetkých používateľov na tmavom motíve.',
    ],
    'glass' => [
        'label' => 'Matný topbar',
        'helper' => 'Rozostrí topbar a pozadia modálnych okien. Na slabších zariadeniach vypnite.',
    ],
    'glow' => [
        'label' => 'Akcentná žiara',
        'helper' => 'Mäkký akcentný tieň na hlavných tlačidlách, aktívnej navigácii a prihlasovacej karte.',
    ],

    'background' => [
        'label' => 'Typ pozadia',
        'helper' => 'Aurora je vlastné pozadie motívu: akcentné žiary s jemným zrnom.',
        'aurora' => 'Aurora (predvolené)',
        'solid' => 'Jedna farba',
        'gradient' => 'Prechod',
        'image' => 'Obrázok',
        'color' => 'Farba',
        'base' => 'Farba pod žiarami',
        'base_helper' => 'To, na čom stránka leží, kým sa cez ňu namaľujú akcentné žiary. Nechajte prázdne, nech ostane predvolená hodnota panela, takmer čierna v tmavom a takmer biela vo svetlom. Nastavte ju a schéma si nechá vlastnú nočnú farbu a aj tak bude nasvietená.',
        'color_end' => 'Druhá farba',
        'angle' => 'Smer',
        'upload' => 'Nahrať obrázok',
        'upload_helper' => 'Až 8 MB. Nahraný obrázok má prednosť pred adresou nižšie.',
        'url' => 'Alebo adresa URL',
        'url_helper' => 'Musí začínať https:// a byť dostupná zvonka.',
        'dim' => 'Stmavenie',
        'dim_helper' => 'Bez stmavenia sa biely text na svetlej fotke nedá čítať.',
        'blur' => 'Rozostrenie',
    ],

    /*
     * The plugin's own page, under Updates. Only something to read: the
     * installed version, and what the Essentials Auto Updater reports when it
     * is installed.
     */
    'updates' => [
        'installed' => 'Nainštalovaná verzia',
        'state' => 'Aktualizácia',
    ],

    /*
     * Karta Jazyky.
     *
     * Opatrná v tom, čo tvrdí. Pelican už každému dovoľuje vybrať jazyk pre celý
     * účet a už ho uplatňuje; nič tu to nemení ani by nemalo. Tu sa rozhoduje
     * len o tom, či tento výber sledujú vlastné texty tohto pluginu.
     */
    'languages' => [
        'section_helper' => 'Pelican už každému dovoľuje vybrať jazyk pre jeho účet a tento plugin ho sleduje všade, kde je preložený. Tu rozhodujete, ktoré z nich poslúchne. Väčšina jazykov stojí na nízkom percente naschvál: prvá sa prekladá tá časť, ktorú každý vidí na každej stránke - tlačidlá napájania nad konzolou a ukazovatele uzlov - a zvyšok prichádza, ako ho ľudia dopisujú.',
        'panel' => 'Nechať toto rozhodovať o jazyku celého panela',
        'panel_helper' => 'Zapnuté - jazyk, ktorý tento plugin nenesie, alebo vypnutý nižšie, prepne pre toho čitateľa do angličtiny celý panel, nie len tieto stránky. Vypnuté - zoznam sleduje len tento plugin a Pelican ďalej hovorí tým, čo je nastavené na účte, čo znamená, že čitateľ môže na jednej obrazovke stretnúť dva jazyky. Žiadny účet sa tak ani tak nemení: zapnite jazyk späť a zase ho má.',
        'label' => 'Jazyky, ktorými odpovedať',
        'helper' => 'Odškrtnutie pošle späť k angličtine - len pre tento plugin - tých čitateľov, ktorí ho majú nastavený na účte; zvyšok panela ďalej hovorí ich jazykom. Angličtina v zozname nie je, lebo všetko padá na ňu.',
        'under' => 'neponúka sa, kým nepostúpi ďalej - zaškrtnite, nech sa ponúka aj tak',
        'done' => 'preložené na :percent %',
        'main' => 'Hlavný jazyk',
        'main_helper' => 'To, čo čitateľ dostane, keď sa jeho vlastný jazyk použiť nedá - buď ho tento plugin nenesie, alebo je nižšie odškrtnutý. Vždy to bola angličtina; v tíme, ktorý v angličtine nepracuje, to bola zlá odpoveď podaná s istotou. Nižšie sa odškrtnúť nedá, lebo všetko padá na ňu.',
        'labels' => 'Ako sa ktorý jazyk volá',
        'labels_helper' => 'Meno, ktoré čitatelia a administrátori vidia vo výberoch. Nechajte jedno prázdne, nech ostane meno, pod ktorým ho tento plugin pozná. Jazyk nahraný pod vlastným menom žiadne nemá, takže by sa vypisoval svojím kódom, kým mu tu meno nedáte.',
        'labels_code' => 'Kód',
        'labels_name' => 'Zobrazovať ako',
        'remove' => 'Odobrať jazyk',
        'remove_which' => 'Ktorý',
        'remove_which_helper' => 'Jazyky, ktoré niekto nahral, a tie, ktoré plugin nesie sám, ak cez ne niekto nahral opravy. Pri nich odídu len opravy.',
        'remove_confirm' => 'Odíde to, čo bolo nahrané pod týmto názvom: texty tohto pluginu a tam, kde Pelican ten jazyk sám nemá, aj texty panela. Pri jazyku, ktorý plugin nesie sám, sú to len opravy a vráti sa to, čo plugin dodáva. Odtiaľto sa to nedá vziať späť: jediná kópia, ktorá zostane, je tá, ktorú má ešte ten, kto ju vytvoril, a zabudne sa aj kópia držaná mimo panela, takže obnova ju nevráti.',
        'remove_refused' => 'Ten jazyk zostal tam, kde bol',
        'remove_refused_bad_code' => 'Takto sa jazyk volať nemôže.',
        'remove_refused_shipped' => 'Tento plugin ten jazyk nesie sám a nič cez neho nahrané nebolo, takže niet čo vracať.',
        'remove_refused_unknown' => 'Pod tým menom nikdy nič nahrané nebolo.',
        'remove_refused_in_use' => 'Je to jazyk, ku ktorému sa panel vracia. Zvoľ najprv iný hlavný jazyk a tento odober až potom.',
        'remove_refused_stuck' => 'Súbory neodišli. Panel nedokázal zapísať do vlastného priečinka s jazykmi.',
        'removed' => ':code bol odobraný',
        'removed_body' => 'Kto čítal panel v ňom, číta ho teraz v hlavnom jazyku.',
        'removed_shipped' => ':code je znova taký, ako ho plugin dodáva',
        'download' => 'Stiahnuť súbor s prekladom',
        'download_from' => 'Vyjsť z',
        'download_from_helper' => 'JSON so všetkými textami tohto pluginu. Vezmite angličtinu pre jazyk, ktorý nikto nezačal, alebo existujúci, nech nadviažete na to, čo už je preložené.',
        'download_ready' => ':translated z :total textov už bolo preložených. Zvyšok vyšiel po anglicky a práve na ňom sa oplatí pracovať.',
        'code' => 'Kód jazyka',
        'code_helper' => 'Kód, ku ktorému súbor patrí. Skutočná locale tak, ako ju používajú účty - fr, de, pt_BR - dôjde k čitateľom, ktorí ju majú nastavenú, a musí sedieť presne, inak nedôjde. Vlastné meno, napríklad Gaming-SK, je dovolené a funguje inak: Pelican nechá účet držať len skutočnú locale, takže to vaše si nikto nevyberie. Dostupné je ako hlavný jazyk vyššie, čo je to, čo dostane každý, ktorého jazyk sa použiť nedá.',
        'url' => 'Alebo ho stiahnuť z adresy',
        'url_helper' => 'Adresa https, na ktorú panel dosiahne - CDN, bucket, holý súbor v repozitári. Stiahne sa raz pri uložení a zapíše sa rovnako ako nahraný, takže zmeniť súbor na tej adrese neskôr nič nerobí, kým znova neuložíte. Súbor vybraný vyššie vyhráva nad adresou ponechanou v tomto poli.',
        'upload' => 'Nahrať súbor s prekladom',
        'upload_helper' => 'Ten JSON zhora, s preloženými hodnotami. Zapisuje sa mimo pluginu, takže ho aktualizácia nezahodí, a zlieva sa cez angličtinu kľúč po kľúči - súbor s polovicou textov vám dá polovičný jazyk a angličtinu na zvyšok.',
        'uploaded' => '{1} Nainštalovaný jeden reťazec pre :code|[2,*] Nainštalovaných :count reťazcov pre :code',
        'uploaded_halves' => 'Z toho :mine sú vlastné texty tohto pluginu a :panel patria panelu. Nula na jednej zo strán znamená, že tá polovica súboru nič neobsahovala - kľúče pluginu začínajú na essentials:: a kľúče panela nie.',
        'uploaded_same' => '{1} Ten druhý už hovoril to isté čo tento panel, takže zostal nedotknutý.|[2,*] Ostatných :count už hovorilo to isté čo tento panel, takže zostali nedotknuté.',
        'uploaded_skipped' => 'Vynechaných riadkov (:count):',
        'upload_failed' => 'Tento súbor sa nepodarilo prečítať',
        'upload_failed_body' => 'Musí to byť ten JSON zo stiahnutia vyššie - plochý objekt kľúčov a textov. Skontrolujte, že ho editor neuložil ako niečo iné.',
    ],

    'windows' => [
        'add' => 'Pridať okno',
        'from' => 'Od',
        'to' => 'Do',
        'to_helper' => 'Skôr než začiatok znamená, že to prechádza cez polnoc - od 22:00 do 06:00 je noc.',
        'preset' => 'Štýl',
        'days' => 'Dni',
        'days_helper' => 'Nechajte ich všetky nezaškrtnuté, nech to platí každý deň. Okno prechádzajúce cez polnoc patrí tomu dňu, ktorým začína, takže piatok od 22:00 do 06:00 pokrýva sobotné ráno.',
        'day_mon' => 'Pondelok',
        'day_tue' => 'Utorok',
        'day_wed' => 'Streda',
        'day_thu' => 'Štvrtok',
        'day_fri' => 'Piatok',
        'day_sat' => 'Sobota',
        'day_sun' => 'Nedeľa',
    ],

    'arranger' => [
        'label' => 'Usporiadanie stránok',
        'helper' => 'Tlačidlo „Usporiadať stránku", na každej stránke panela. Kto má oprávnenie Usporiadať, ten ho dostane a môže navyše nastaviť usporiadanie, od ktorého začínajú všetci ostatní, alebo usporiadanie pre rolu. Vypnuté ho skryje všetkým; už uložené usporiadania ostávajú na mieste.',
        'roles' => 'Usporiadanie nie je oprávnenie. Blok, ktorý rola skryje, ostáva blokom, na ktorý by sa niekto dostal napísaním adresy - tomu bránia vlastné oprávnenia Pelicanu, na stránke rolí. Vrstvia sa tri vrstvy v tomto poradí: spoločná východisková, potom rola čitateľa, potom to, čo si posunul sám.',
        'users' => 'Nechať každého usporiadať si vlastné stránky',
        'users_helper' => 'Zapnuté - každý prihlásený smie preskladať a skrývať bloky na stránkach, ktoré aj tak vidí, len pre seba; pre nikoho iného to nič nemení. Nastavenie spoločného východiskového usporiadania ostáva pri oprávnení Usporiadať.',

        'launch' => 'Usporiadať stránku',
        'hint' => 'Potiahnite blok za úchyt, alebo ho skryte okom.',
        'drag_to_move' => 'Potiahnutím presuniete',
        'show_or_hide' => 'Zobraziť alebo skryť tento blok',
        'save_layout' => 'Uložiť usporiadanie',
        'reset_page' => 'Resetovať stránku',
        'done' => 'Hotovo',
        'saving' => 'Ukladá sa…',
        'saved_own' => 'Uložené.',
        'saved_everyone' => 'Uložené pre všetkých.',
        'saved_role' => 'Uložené pre rolu „:role“.',
        'save_failed' => 'Uloženie sa nepodarilo - pozrite sa do konzoly.',
        'reset_done' => 'Resetované.',
        'scope_me' => 'Len pre mňa',
        'scope_shared' => 'Pre všetkých',
        'scope_role' => 'Pre rolu „:role“',
        'that_role' => 'bez názvu',
        'editing_own' => 'Upravujete svoje vlastné usporiadanie.',
        'editing_shared' => 'Upravujete usporiadanie, od ktorého začínajú všetci.',
        'editing_role' => 'Upravujete usporiadanie pre rolu „:role“.',
    ],

    'brand' => [
        'logo_height' => 'Výška loga',
        'logo_height_helper' => 'Pelican dodáva 2rem. Väčšie hodnoty dvíhajú spolu s ním aj hlavičku bočného panela.',
        'logo_url' => 'Nahradiť logo',
        'logo_url_helper' => 'Nechajte prázdne, nech ostane to, na čo mieria vlastné nastavenia Pelicanu.',
    ],

    'login' => [
        'image' => 'Obrázok na pozadí',
        'image_helper' => 'Len pre prihlasovaciu obrazovku. Bez neho ďalej ukazuje pozadie panela.',
        'url' => 'Alebo adresa URL',
        'blur' => 'Rozostrenie karty',
        'blur_helper' => 'Zmatní kartu, nech obrázok za ňou presvitá.',
        'width' => 'Šírka karty',
        'position' => 'Výrez obrázka',
        'position_helper' => 'Ktorá časť obrázka prežije orez na obrazovku.',
        'position_center' => 'Stred',
        'position_top' => 'Hore',
        'position_bottom' => 'Dole',
        'position_left' => 'Vľavo',
        'position_right' => 'Vpravo',
        'align' => 'Umiestnenie karty',
        'align_helper' => 'Kde prihlasovacia karta stojí naprieč obrazovkou.',
        'align_center' => 'Stred',
        'align_start' => 'Vľavo',
        'align_end' => 'Vpravo',
        'opacity' => 'Krytie karty',
        'opacity_helper' => 'Nižšie púšťa kartou viac obrázka.',
        'glow' => 'Akcentná žiara',
        'glow_helper' => 'Svätožiara okolo karty. Vypnuté jej necháva okraj aj hĺbku.',
        'hide_heading' => 'Skryť nadpis',
        'hide_heading_helper' => 'Odoberie nadpis nad formulárom a nechá formulár samotný.',
        'hide_footer' => 'Skryť pätu',
        'hide_footer_helper' => 'Odoberie riadok pod kartou, ktorý vedie na pelican.dev.',
        'above' => 'Riadok nad formulárom',
        'above_helper' => 'Jeden riadok, ukázaný každému, kto dorazí na prihlasovaciu obrazovku. Nechajte prázdne, nech tam žiadny nie je.',
        'notice' => 'Hláška pod kartou',
        'notice_helper' => 'Jeden riadok, ukázaný každému, kto dorazí na prihlasovaciu obrazovku. Nechajte prázdne, nech tam žiadna nie je.',
        'register' => 'Nechať ľudí založiť si vlastný účet',
        'register_helper' => 'Vypnuté, a vypnuté to ostane, kým to tu nezapnete: aktualizácia nesmie nikdy otvoriť panel cudzím ľuďom sama od seba. Zapnuté - prihlasovacia obrazovka dostane odkaz na registračný formulár a účet si môže založiť ktokoľvek, kto na váš panel dorazí. Nedostanú žiadne servery a žiadne oprávnenia, takže naozaj zmôžu presne to, čo ste dali ľuďom bez roly - skontrolujte to, skôr než toto otvoríte. Vypnite to späť a ten formulár prestane existovať. Nie je to však jediná cesta dnu: pozri nižšie.',
        'register_note' => 'Riadok pod registračným formulárom',
        'register_note_helper' => 'Jeden riadok, na pravidlo alebo na to, kde požiadať o prístup. Obyčajný text, ukázaný ľuďom, ktorí nie sú prihlásení. Nechajte prázdne, nech tam žiadny nie je.',
        'register_oauth' => 'Aj prihlásenie zakladá účty',
        'register_oauth_body' => 'Nech prepínač vyššie hovorí čokoľvek, účet sa pri prvom prihlásení už teraz založí cez: :names. To je vlastné nastavenie Pelicanu, jedno na každého poskytovateľa, v Nastaveniach pod OAuth, volá sa „create missing users". Vypnite ho tam, ak mal byť panel zatvorený.',
    ],

    'advanced' => [
        'css' => 'Vlastné CSS',
        'css_helper' => 'Až 100 KB. Ukladá sa do storage, nie do .env.',
        'reference' => 'Prehľad CSS',
        'reference_helper' => 'Každá premenná a každá trieda, ktoré tento motív a panel sprístupňujú.',
    ],

    'areas' => [
        'add' => 'Pridať oblasť',
        'area' => 'Oblasť',
        'inherit' => 'Všeobecné',
        'radius' => 'Rohy',
        'radius_sharp' => 'Ostré',
        'radius_normal' => 'Normálne',
        'radius_round' => 'Zaguľatené',
        'surface' => 'Farba plôch',
        'surface_helper' => 'Karty a panely vnútri tejto oblasti; svetlejšie a tmavšie odtiene sa z nej odvodzujú.',
        'names' => [
            'terminal' => 'Terminál',
            'console' => 'Konzola (zvyšok stránky)',
            'files' => 'Stránka súborov',
            'edit' => 'Stránka úprav',
            'server' => 'Ostatné stránky a karty servera',
        ],
    ],

    'bars' => [
        'base' => 'Základná farba',
        'base_green' => 'Zelená',
        'base_accent' => 'Akcentná farba',
        'warning' => 'Jantárová od',
        'danger' => 'Červená od',
    ],

    'icons' => [
        'stroke' => 'Hrúbka čiary',
        'stroke_thin' => 'Tenká',
        'stroke_normal' => 'Normálna',
        'stroke_bold' => 'Silná',
        'scale' => 'Veľkosť',
        'accent' => 'Ikony ponuky v akcentnej farbe',
        'accent_helper' => 'Týka sa ikon v bočnom paneli a v topbare.',
        'pack' => 'Balíček ikon',
        'pack_helper' => 'Z ktorej sady čerpá výber nižšie. Ponúka sa každá sada ikon nainštalovaná na serveri, k tomu sada Essentials, ktorá prichádza s týmto pluginom, a akýkoľvek balíček, ktorý nahráte. Jeden rozdiel stojí za to vedieť: čiarová ikona sa kreslí farbou ponuky a ide za nabehnutím aj aktívnou položkou, kým ikony Essentials sú obrázky a držia si vlastné farby. Rozhoduje o tom, čím súbor je, nie to, z ktorej sady prišiel.',
        'pack_custom' => 'Nahraný balíček',
        'pack_shipped' => 'Ikony Essentials',
        'use_shipped' => 'Použiť ikony Essentials všade',
        'use_shipped_confirm' => 'Nastaví balíček na ikony Essentials a vyplní každú položku ponuky nižšie tou ikonou, ktorá je pre ňu nakreslená - konzola dostane terminál, spustenie dostane tlačidlo štartu a tak ďalej. Nahradí to položky, ktoré máte teraz, a nič sa neukladá, kým nestlačíte Uložiť, takže zavrieť stránku to vráti.',
        'pack_upload' => 'Nahrať balíček',
        'pack_upload_helper' => 'Archív .zip so súbormi SVG. Každý súbor sa stane ikonou pomenovanou po ňom - logo.svg sa stane custom-logo. Nahranie nahradí balíček, ktorý je tam teraz. Súbory nad 256 KB a všetko nad 4 000 ikon ostane vonku a dozviete sa koľko: pre mierku, celá sada Tabler je takmer šesťtisíc ikon zhruba v troch megabajtoch, takže balíček výrazne väčší nesie niečo iné než ikony a väčšina sa preskočí. Veľké nahranie môže byť odmietnuté ešte skôr, než toto pole čokoľvek povie - hodnotami upload_max_filesize a post_max_size v php.ini hostiteľa panela, a žiadne nastavenie odtiaľto ich nezvýši.',
        'pack_partial' => '{1} Nainštalovaná jedna ikona, ale nie všetky|[2,*] Nainštalovaných :count ikon, ale nie všetky',
        'pack_partial_body' => 'Preskočené: :big priveľké na ikonu, :unusable nepoužiteľné ako SVG, :duplicate s menom, ktoré je už zabraté, :empty po vyčistení nie je čo kresliť. SVG nad 256 KB je takmer vždy obrázok zabalený do SVG, nie kresba - vyexportujte ho vo veľkosti ikony a bude mať pár kilobajtov. Ikona, pri ktorej nie je čo kresliť, obsahovala len niečo, čo sa tu nepodáva - ak je to celý balíček, stojí za to to nahlásiť.',
        'pack_stopped_files' => 'Zastavilo sa to aj na limite, koľko ikon smie balíček obsahovať.',
        'pack_stopped_size' => 'Zastavilo sa to aj preto, že zvyšok balíčka po rozbalení presahuje to, čo panel udrží naraz v pamäti - samotný zip môže byť menší, lebo SVG sa komprimuje zhruba päť k jednej.',
        'overrides' => 'Nahradiť ikony',
        'overrides_helper' => 'Jeden riadok na každú ikonu, ktorú chcete zmeniť. Vyberte položku ponuky, potom vezmite ikonu z balíčka vyššie, zadajte adresu, alebo nahrajte vlastný obrázok. Keď je vyplnené viac než jedno, vyhráva nahranie, potom adresa, potom balíček.',
        'overrides_key' => 'Položka ponuky',
        'overrides_value' => 'Ikona z balíčka',
        'overrides_url' => 'Alebo adresa',
        'overrides_url_helper' => 'Adresa https obrázka, ktorý hostujete sami - CDN, bucket, kamkoľvek prehliadač dosiahne. Do panela sa nič nekopíruje, takže vymeniť súbor na tej adrese zmení ikonu bez toho, aby sa siahlo na túto stránku; rub toho je, že ikona zmizne, len čo zmizne adresa. Drží si vlastné farby, ako nahraný obrázok.',
        'overrides_file' => 'Alebo nahrať obrázok',
        /*
         * Hovorí, v čom ten rozdiel naozaj je, lebo zjavný nie je a práve preň
         * si človek vyberie jedno namiesto druhého.
         */
        'overrides_file_helper' => 'PNG, SVG alebo ICO. Ikona z balíčka sa kreslí farbou ponuky a ide za nabehnutím aj aktívnou položkou; nahraný obrázok si drží vlastné farby a to nerobí. Pri logu sa obyčajne chce práve toto.',
        'overrides_add' => 'Nahradiť ďalšiu ikonu',
        'overrides_search' => 'Napíšte názov alebo položku ponuky…',
    ],

    /*
     * Nie pod „Značkou". Značka je o tom, ako panel vyzerá; toto je o tom, ako
     * sa v ňom objavuje tento plugin, čo je iná otázka a odpovedá na ňu iná
     * stránka.
     */
    'identity' => [
        'nav_icon' => 'Ikona pre položku „Nastavenia Essentials"',
        'nav_icon_helper' => 'PNG, SVG alebo ICO, až 8 MB. Nahradí ikonu tej jednej položky v bočnom paneli; nechajte prázdne, nech sa vezme tá, ktorú plugin prináša so sebou. Kreslí sa ako obrázok, nie ako ikona, takže si drží vlastné farby namiesto toho, aby išla za textom - a to logo obyčajne chce. Súbor sa podáva, nie vkladá, takže si ho každý prehliadač stiahne raz, ale aj tak stojí za to vyexportovať niečo malé: pre položku vysokú dvadsať pixelov pár kilobajtov bohato stačí. Ak nahranie spadne skôr, než toto pole čokoľvek povie, limit, o ktorý narazilo, je upload_max_filesize v php.ini panela.',
    ],
];
