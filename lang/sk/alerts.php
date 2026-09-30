<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Watchdog.
 *
 * Každú správu odtiaľto číta človek na telefóne, o tretej ráno, minútu po
 * zobudení. Každá hovorí, ktorý stroj, čo je zle, a nič viac - podrobnosť patrí
 * tej stránke, ktorú otvorí vzápätí, nie riadku, ktorý ho zobudil.
 *
 * Návrat do poriadku je napísaný ako správa, nie ako dovetok. „Už je to späť?"
 * je otázka, kvôli ktorej by inak niekto vstával.
 *
 * „Node", „Wings", „daemon", „webhook", „queue", „Discord" a „SMTP" ostávajú po
 * anglicky: pod týmito menami sa nájdu v Pelicane, na hostiteľovi a vo všetkom,
 * čo sa o nich píše.
 */

return [
    'title' => 'Upozornenia',
    'nav_label' => 'Upozornenia',
    'subheading' => 'Panel už vie, kedy uzol prestane odpovedať, kedy sa plní disk a kedy sa zastaví front. Toto je to, čo vám o tom povie.',

    // ---- kanály a čo naposledy urobili ------------------------------------
    'channels' => 'Kam správy chodia',
    'channels_helper' => 'Čo urobil každý kanál naposledy, keď mal niečo odoslať. Zapnutý kanál, ktorý ticho odmieta, vyzerá presne ako panel, ktorému nič nie je, a preto toto stojí na stránke prvé.',

    'state_off' => 'Vypnuté',
    'state_untried' => 'Zatiaľ sa nič neodoslalo',
    'state_ok' => 'Doručené',
    'state_failed' => 'Odmietnuté',

    // ---- kedy -------------------------------------------------------------
    'when' => 'Ako často',
    'when_helper' => 'Kontroly bežia na pozadí, takže potrebujú queue worker. Bez neho sa nič neodosiela a nič to nepovie - vezmite „Poslať skúšku", tá frontom nejde.',

    'every' => 'Kontrolovať každých',
    'every_helper' => 'Každá kontrola dosiahne na daemona každého uzla, takže je to jedna požiadavka na uzol a prechod. Pätnásť minút stačí, aby sa o výpadku vedelo, kým je to ešte výpadok.',
    'every_off' => 'Vypnuté - žiadne kontroly',
    'every_five' => '5 minút',
    'every_fifteen' => '15 minút',
    'every_thirty' => '30 minút',
    'every_hourly' => 'Hodina',
    'every_daily' => 'Deň',

    'repeat' => 'Pripomínať mi to, kým to trvá',
    'repeat_helper' => 'Správa odíde, keď sa niečo zmení, a ďalšia, keď sa to spraví. Toto pridáva pripomienku, kým ťažkosť trvá. Nula znamená bez pripomienok - kanál, ktorý sa opakuje každú štvrťhodinu, je kanál, ktorý ľudia stlmia.',
    'hours' => 'hodín',

    // ---- kam --------------------------------------------------------------
    'where' => 'Kanály',
    'where_helper' => 'Viac než jeden dáva zmysel. Zlyhávajú rôzne.',

    'discord' => 'Discord',
    'discord_helper' => 'Miesto, kde si správu naozaj prečíta aj ten, kto sa práve nepozerá do panela.',
    'webhook' => 'Adresa webhooku',
    'webhook_helper' => 'V Discorde: Nastavenia servera → Integrácie → Webhooky → Nový webhook → Skopírovať URL webhooku. Len https, lebo sa týmto zverejňuje, ktorý z vašich strojov spadol a aký plný má disk.',
    'bot' => 'Vlastný bot',
    'bot_helper' => 'Jedno podpísané odoslanie JSON na adresu, ktorú prevádzkujete vy, aby sa niečo mimo panela dozvedelo o spadnutom uzle namiesto toho, aby sa každú minútu pýtalo, či taký je. Webhooky, ktoré prináša Pelican, to neunesú: spúšťajú sa na modeloch a na zázname aktivity, a uzol, ktorý prestal odpovedať, nezapíše ani do jedného.',
    'bot_url' => 'Kam to poslať',
    'bot_url_helper' => 'Len https, lebo sa týmto na adresu na internete posiela, ktorý z vašich strojov spadol.',
    'bot_secret' => 'Podpisové tajomstvo',
    'bot_secret_helper' => 'Zdieľané s tým, čo to prijíma. Z tela sa ním urobí odtlačok a ten cestuje v X-Essentials-Signature ako sha256=<hex>, takže váš bot môže odmietnuť čokoľvek, čo neprišlo z tohto panela. Kým je toto prázdne, neodošle sa nič - podpis, ktorý je nepovinný, je podpis, ktorý nikto nekontroluje.',
    'facts' => 'Povedať botovi aj to, čo sa stalo',
    'facts_helper' => 'Všetko vyššie je porucha. Toto nie: sú to veci, ktoré sa jednoducho stali. Každá je vypnutá, kým ju nezaškrtnete, takže aktualizácia nič nemení, a idú len botovi, nikdy na Discord, zvonček ani e-mail.',

    'panel' => 'V paneli',
    'panel_helper' => 'Upozornenie pre každého, kto má toto oprávnenie. Funguje vždy, nič sa nemusí nastavovať, a pre neprihláseného je neviditeľné.',

    'email' => 'E-mail',
    'email_helper' => 'Oddelené čiarkami. Používa mailer samotného panela - spoľahlivý, keď je nastavený, a úplne nemý, keď nie je, a to je tá jediná porucha, ktorú watchdog mať nesmie. Nechajte prázdne, nech sa vypne.',

    // ---- čo ---------------------------------------------------------------
    'what' => 'Na čo sa stráži',
    'what_helper' => 'Každé meranie tu je meranie, ktoré panel aj tak robí. Nič na tejto stránke neotvára spojenie, ktoré by neotvárala stránka Stav systému.',

    'percent_helper' => 'Nula túto kontrolu vypína.',
    'disk' => 'Varovať, keď disk uzla presiahne',
    'memory' => 'Varovať, keď pamäť uzla presiahne',

    'maintenance' => 'Varovať na údržbu ponechanú dlhšie ako',
    'maintenance_helper' => 'Uzol v údržbe všetky ostatné kontroly preskakujú, a tak to má byť - a je to zároveň spôsob, ako sa na jeden na štrnásť dní zabudne. Nula toto vypína.',

    'versions' => 'Verzie panela a Wings',
    'versions_helper' => 'Jedna správa, keď niečo zaostane, a jedna, keď je to zase aktuálne. Bez pripomienok - verzia nie je výpadok.',

    'backups' => 'Zálohy, ktoré zaostávajú',
    'backups_helper' => 'Jedna správa, ktorá vymenuje servery, nie jedna na server - keď sa naplánovaná úloha zastaví, všetky servery zastarajú naraz, a štyridsať oddelených správ o jednej príčine je kanál, ktorý ľudia stlmia. V predvolenom stave vypnuté: panelu, ktorý zálohuje ručne a nie podľa plánu, by sa to vyčítalo denne.',
    'backup_days' => 'Záloha sa počíta ako prepadnutá po',
    'backup_days_helper' => 'To isté berie aj stránka Zálohy. Server, ktorý sa zálohuje raz týždenne, by sa nemal hlásiť po ôsmich dňoch.',
    'days' => 'dňoch',

    'stock' => 'Balíky, ktoré dochádzajú',

    'unbuilt_switch_helper' => 'Objednávka so zaplatenou faktúrou, ktorej server uzol odmietol. Jediná kontrola tu, pri ktorej je niekto o peniaze a nič to nepovie: všetko ostatné v zozname je stroj, ktorý sa zastavil. Vypnuté, kým ju nezapnete, ako zvyšok.',

    'unbuilt_switch' => 'Zaplatené a nevytvorené',
    'stock_helper' => 'Jedna správa, ktorá vymenuje balíky, nie jedna na balík, a nikdy žiadna pripomienka: vypredané je bežný stav obchodu, nie výpadok, a počuť o tom každé štyri hodiny je spôsob, ako sa toto prestane čítať. Pozerá sa len na balíky, ktoré majú strop, takže obchod, ktorý predáva všetko bez obmedzenia, nestojí nič strážiť. V predvolenom stave vypnuté, ako všetko ostatné.',
    'modules_switch' => 'Modul, ktorý je zapnutý a nefunguje',
    'modules_switch_helper' => 'Jedna správa na modul, nie jedna za všetky, pretože pri každom je zle niečo iné a veta musí povedať čo. Hlási dve veci: modul, ktorému chýbajú tabuľky, čo je inštalácia, ktorá nedobehla, a modul so zapnutými časťami, ktoré čakajú, kým sa niečo vyplní. Stránka Moduly ukazuje oboje na karte; toto je pre panely, kam sa nikto nechodí pozerať. V predvolenom stave vypnuté, ako zvyšok.',
    'module_tables_title' => 'Modul :module je zapnutý a chýbajú mu tabuľky',
    'module_tables' => 'Stránky, ktoré patria k modulu :module, sa skrývajú, pretože tabuľky, z ktorých čítajú, tu nie sú - obyčajne je to inštalácia, ktorá nedobehla. Otvorte stránku Moduly, vypnite ho a zase zapnite, a tabuľky sa vytvoria.',
    'module_waiting_title' => 'Modul :module je zapnutý a časť z neho čaká',
    'module_waiting' => '{1} Jedna časť modulu :module je zapnutá a nič neukazuje, kým sa niečo nevyplní: ktorých eggov sa týka, aké štýly sú na výber, ktoré servery má verejná stránka ukazovať. Stránka Moduly povie ktoré, na karte.|[2,*] Zapnutých častí modulu :module, ktoré nič neukazujú, kým sa niečo nevyplní: :count. Ide o to, ktorých eggov sa týkajú, aké štýly sú na výber a ktoré servery má verejná stránka ukazovať. Stránka Moduly povie ktoré, na karte.',
    'module_cleared' => 'Modul :module zase funguje',
    'ports_switch' => 'Dochádzajúce porty',
    'ports_switch_helper' => 'Jedna správa na balík, nie jedna za všetky, pretože užitočné sú rozsah a počet, a zoznam názvov nie. Sledujú sa len balíky, ktoré majú nastavený rozsah, takže strážiť obchod, kde si nákup vezme ktorýkoľvek voľný port, nestojí nič. V predvolenom stave vypnuté, ako zvyšok.',
    'stock_left' => 'Varovať, keď ostáva už len',
    'stock_left_helper' => 'Počíta sa to voči stropu na balíku. Balík musí klesnúť na toto číslo, aby sa o ňom varovalo, a vyšplhať sa o dve nad, aby sa zase rátal za v poriadku, takže ten, ktorým jeden nákup a jedno zrušenie hádžu sem a tam, mlčí. Nula je tu číslo, nie neprítomnosť: drží varovanie ticho a necháva len tú správu, ktorá hovorí, že balík došiel.',
    'stock_left_suffix' => 'ks',

    'worker' => 'Queue worker',
    'worker_helper' => 'Či niečo vôbec vykonáva prácu tohto pluginu na pozadí. Všimnite si ten kruh: sama kontrola beží vo fronte, takže panel, ktorý worker nikdy nemal, to nahlásiť nedokáže. Riadok hore na tejto stránke to dokáže.',

    // ---- tlačidlá ---------------------------------------------------------
    'save' => 'Uložiť',
    'saved' => 'Uložené',
    'save_failed' => 'Nič sa neuložilo',

    'test' => 'Poslať skúšku',
    'test_one' => 'Vyskúšať',
    'test_off' => 'Tento kanál je vypnutý',
    'test_off_body' => 'Zapnite ho a uložte, a vyskúša sa spolu s ostatnými.',
    'test_title' => 'Skúšobná správa',
    'test_body' => 'Ak toto čítate, upozornenia z vášho panela Pelican sem budú chodiť. Nič sa nedeje.',
    'test_sent' => 'Odoslané do každého zapnutého kanála',
    'test_failed' => 'Aspoň jeden kanál to odmietol',
    'test_none' => 'Nie je kam poslať',
    'test_none_body' => 'Žiadny kanál nie je zapnutý, takže by ani skutočné upozornenie nikam nedošlo.',

    /*
     * Čo s odmietnutím.
     *
     * Dôvod, ktorý uvedie poskytovateľ, je stručný a správny a sám osebe
     * neužitočný. Dva, ktoré vyplávajú takmer zakaždým, sú tu pomenované, lebo
     * ani jeden sa z kódu neuhádne: 553 je o odosielateľovi, nie o príjemcovi, a
     * 401 z Discordu je odvolaná alebo zle vložená URL.
     */
    'hint_email_sender' => 'Váš SMTP server odmietol tú adresu, z ktorej panel posiela, nie tú, na ktorú posielal. V Admin → Nastavenia → Pošta musí byť adresa odosielateľa schránka, z ktorej váš SMTP účet smie posielať. S týmto pluginom to nemá čo robiť - skúšobný mail samotného Pelicanu na tej istej stránke spadne úplne rovnako.',
    'hint_email' => 'Pozrite sa do Admin → Nastavenia → Pošta. Tlačidlo skúšobného mailu na tej stránke používa rovnaké nastavenia a povie to isté.',
    'hint_discord_url' => 'Discord tento webhook nepoznal. Bol zmazaný, vygenerovaný znova, alebo vložený len sčasti - vytvorte nový v Nastavenia servera → Integrácie → Webhooky a skopírujte celú URL.',
    'hint_discord' => 'Panel sa na Discord nedostal. Ak tento panel stojí za firewallom, ktorý blokuje odchádzajúce požiadavky, odtiaľto tento kanál fungovať nemôže.',
    'hint_panel' => 'Nikto na toto nemá oprávnenie, alebo sa upozornenie nepodarilo uložiť. Pozrite sa do Rolí.',

    'run_now' => 'Spustiť kontroly teraz',
    'run_started' => 'Kontroluje sa na pozadí',
    'run_failed' => 'Kontroly sa nepodarilo spustiť',

    'reset' => 'Zabudnúť, čo vie',
    'reset_confirm' => 'Zmaže to, čo každá kontrola naposledy povedala. Ďalší prechod sa učí od nuly a nič neodošle, takže ťažkosť, ktorá stále trvá, sa ohlási až o prechod ďalej. Použite to potom, čo ste vyradili uzol, o ktorom watchdog stále hovorí.',
    'reset_done' => 'Zmazané',

    // ---- samotné správy ---------------------------------------------------
    'still' => 'Trvá to :for.',
    'cleared_body' => 'Takto to bolo :for.',
    'ports_title' => 'Dochádzajú porty pre hru :game',
    'ports_body' => 'Servery kúpené pre hru :game pristávajú na portoch :from až :to. Voľné porty: už len :free z :total. Nákup, ktorý žiadny nenájde, je zaplatený a až potom odmietnutý, tak pridajte na uzle alokácie alebo rozšírte rozsah na balíku, skôr než k tomu dôjde.',
    'ports_none_title' => 'Pre hru :game nezostal žiadny port',
    'ports_none' => 'Servery kúpené pre hru :game pristávajú na portoch :from až :to a z :total nezostal voľný ani jeden. Ďalší nákup tejto hry bude zaplatený a potom odmietnutý bez alokácie. Pridajte na uzle alokácie, alebo rozšírte rozsah na samotnom balíku.',
    'ports_empty_title' => 'Pre hru :game neexistuje žiadny port',
    'ports_empty' => 'Servery kúpené pre hru :game pristávajú na portoch :from až :to a v tomto rozsahu neexistuje ani jedna alokácia na žiadnom z uzlov, ktoré táto hra môže použiť. Každý nákup tejto hry bude zaplatený a až potom odmietnutý. Vytvorte alokácie na uzle, alebo rozsah rozšírte priamo na balíku.',
    'ports_cleared' => 'Pre hru :game sú zase voľné porty',

    'for_unknown' => 'nejaký čas',
    'for_minutes' => '{1} minútu|[2,*] :count minút',
    'for_hours' => '{1} hodinu|[2,*] :count hodín',
    'for_days' => '{1} deň|[2,*] :count dní',

    'node_down' => ':node neodpovedá',
    'node_down_body' => 'Panel nedosiahne na daemona na :node. Servery na ňom nenaštartujú, nezastavia sa a nič nenahlásia, kým sa nevráti.',
    'node_up' => ':node zase odpovedá',

    'node_disk' => 'Na :node dochádza disk',
    'node_disk_body' => 'Disk na :node je zaplnený na :percent %, nad :limit %, ktoré ste nastavili. Zálohy a inštalácie serverov padajú ako prvé, keď toto dôjde hore.',
    'node_disk_over' => 'Disk na :node je zase pod limitom',

    'node_memory' => 'Na :node dochádza pamäť',
    'node_memory_body' => 'Pamäť na :node je využitá na :percent %, nad :limit %, ktoré ste nastavili. Servery na ňom môže zabiť jadro skôr, než čokoľvek nahlási ťažkosť.',
    'node_memory_over' => 'Pamäť na :node je zase pod limitom',

    'node_maintenance' => ':node je v údržbe už dlho',
    'node_maintenance_body' => ':node je v údržbe dlhšie ako :hours hodín. Zatiaľ sa na ňom nič ďalšie nekontroluje, čo je práve zmysel - ale vedieť, že v tom stave stále stojí, sa hodí.',
    'node_maintenance_over' => ':node je z údržby vonku',

    'wings_behind' => 'Wings na :node je zastaraný',
    'wings_behind_body' => ':node beží na Wings :installed a vonku je :latest. Aktualizujte ho na samotnom uzle - panel na to spôsob nemá.',
    'wings_current' => 'Wings na :node je aktuálny',

    'panel_behind' => 'Panel je zastaraný',
    'panel_behind_body' => 'Tento panel beží na :installed a vonku je :latest.',
    'panel_current' => 'Panel je aktuálny',

    'and_more' => 'a ďalšie :count',


    'owner_down' => '{1} Jeden z vašich serverov je offline|[2,*] Vašich serverov offline: :count',
    'owner_down_body' => 'Stroj, na ktorom stoja, prestal odpovedať. Komu treba, už bolo povedané. Týka sa to: :servers',
    'owner_up' => '{1} Váš server je späť|[2,*] Vašich serverov sa vrátilo: :count',
    'owner_up_body' => 'Stroj zase odpovedá. Späť sú: :servers',

    'schedules' => 'Naplánované úlohy, ktoré zastali',
    'schedules_helper' => 'Úloha zaseknutá uprostred behu, taká, ktorej čas uplynul, lebo cron nebeží, alebo taká, ktorá nikdy nenabehla. Pelican nemá slovo ani pre jednu z troch - spadnutý beh ostane „spracúva sa" navždy a kreslí sa presne ako ten, ktorý práve ide. Pri každej kontrole číta všetky aktívne naplánované úlohy panela.',

    'schedule_stopped' => '{1} Jedna naplánovaná úloha sa zastavila|[2,*] :count naplánovaných úloh sa zastavilo',
    'schedule_stopped_body' => 'Zaseknuté viac ako :hours hodín, po termíne, nikdy nespustené, alebo bez jedinej úlohy: :schedules',
    'schedule_running' => 'Všetky naplánované úlohy zase bežia',

    'unbuilt_over' => 'Každá zaplatená objednávka má svoj server',

    'unbuilt_body' => 'Niekto zaplatil a nemá nič. Otvorte Objednávky a vytvorte ich, alebo si prečítajte, prečo boli odmietnuté: :orders',

    'unbuilt' => '{1} Zaplatená objednávka bez servera|[2,*] :count zaplatených objednávok bez servera',

    'stock_out' => '{1} Balík je vypredaný|[2,*] Vypredaných balíkov: :count',
    'stock_out_body' => 'Stále v predaji a nie je čo predať: :packages',
    'stock_low' => '{1} Balík je takmer vypredaný|[2,*] Takmer vypredaných balíkov: :count',
    'stock_low_body' => 'Ostáva :limit alebo menej: :packages',
    'stock_back' => '{1} Balík je zase v predaji|[2,*] Balíkov zase v predaji: :count',
    'stock_back_body' => 'Zase je čo predávať: :packages',

    'backup_none' => '{1} Jeden server nebol nikdy zálohovaný|[2,*] :count serverov nebolo nikdy zálohovaných',
    'backup_none_body' => 'Nikdy sa nezálohovalo na: :servers',
    'backup_none_over' => 'Každý server už zálohu má',

    'backup_stale' => '{1} Jeden server nebol v poslednom čase zálohovaný|[2,*] :count serverov nebolo v poslednom čase zálohovaných',
    'backup_stale_body' => 'Žiadna úspešná záloha za :days dní na: :servers',
    'backup_stale_over' => 'Každý server bol nedávno zazálohovaný',

    'backup_failed' => '{1} Zálohovanie zlyháva na jednom serveri|[2,*] Zálohovanie zlyháva na :count serveroch',
    'backup_failed_body' => 'Záloha skončila neúspešne na: :servers',
    'backup_failed_over' => 'Už nezlyháva žiadna záloha',

    'worker_missing' => 'Front nikto nespracúva',
    'worker_missing_body' => 'Úloha sa zaradila do frontu a nikto si ju nevzal. Aktualizácie pluginov, inštalácie modpackov a tieto kontroly stoja všetky, kým nebeží worker - skúste systemctl status pelican-queue na stroji panela.',
    'worker_back' => 'Front sa zase spracúva',
    'failed_title' => '{1} Od poslednej kontroly zlyhala jedna úloha|[2,*] Od poslednej kontroly zlyhalo :count úloh',
    'failed_body' => 'Niečo, čo mal panel urobiť, sa nestalo a už sa to nezopakuje - nepostavený server, nevypísaná faktúra, neodoslaný e-mail. Sú v tabuľke failed_jobs; `php artisan queue:retry all` ich vráti späť, len čo sa odstráni to, čo ich zastavilo.',
    'failed_back' => 'Od poslednej kontroly nič nezlyhalo',
    'failed' => 'Povedať mi, keď zlyhá úloha vo fronte',
    'failed_helper' => 'Laravel si úlohu, ktorú vzdal, zapíše a nepovie o nej nič. Toto o nej povie. Spočítané, nie vymenované: dvadsať zlyhaní za jednu noc má zvyčajne jednu príčinu.',

    'health_interval_off' => 'Upozornenia sú zapnuté, ale interval je nastavený na Vypnuté, takže strážca sa nikdy nespustí.',
    'health_owners_unwatched' => 'Upozornenia pre vlastníkov sú zapnuté, ale strážca nebeží, takže vlastníci sa o výpadku nikdy nedozvedia.',
    'health_no_channel' => 'Strážca beží, ale každý spôsob, ako niekoho upozorniť, je vypnutý.',
    'health_discord' => 'Upozornenia na Discord sú zapnuté, ale nie je uložený žiadny platný https webhook.',
    'health_bot' => 'Upozornenia pre bota sú zapnuté, ale chýba https adresa alebo podpisový kľúč.',
    'health_email' => 'Upozorňovacie e-maily sú zapnuté, ale nie je žiadna platná adresa, alebo pošta panela zapisuje len do svojho logu.',
];
