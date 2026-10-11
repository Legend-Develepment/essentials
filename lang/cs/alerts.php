<?php

/*
 * Čeština. Psáno ručně.
 *
 * Watchdog.
 *
 * Každou zprávu odsud čte člověk na telefonu, ve tři ráno, minutu po probuzení.
 * Každá říká, který stroj, co je špatně, a nic víc - podrobnost patří té
 * stránce, kterou otevře vzápětí, ne řádku, který ho vzbudil.
 *
 * Návrat do pořádku je napsaný jako zpráva, ne jako dovětek. „Už je to zpátky?"
 * je otázka, kvůli které by jinak někdo vstával.
 *
 * „Node", „Wings", „daemon", „webhook", „queue", „Discord" a „SMTP" zůstávají
 * anglicky: pod těmito jmény se najdou v Pelicanu, na hostiteli a ve všem, co se
 * o nich píše.
 */

return [
    'title' => 'Upozornění',
    'nav_label' => 'Upozornění',
    'subheading' => 'Panel už ví, kdy uzel přestane odpovídat, kdy se plní disk a kdy se zastaví fronta. Tohle je to, co vám o tom řekne.',

    // ---- kanály a co naposled udělaly -------------------------------------
    'channels' => 'Kam zprávy chodí',
    'channels_helper' => 'Co udělal každý kanál naposledy, když měl něco odeslat. Zapnutý kanál, který tiše odmítá, vypadá přesně jako panel, kterému nic není, a proto tohle stojí na stránce první.',

    'state_off' => 'Vypnuto',
    'state_untried' => 'Zatím se nic neodeslalo',
    'state_ok' => 'Doručeno',
    'state_failed' => 'Odmítnuto',

    // ---- kdy --------------------------------------------------------------
    'when' => 'Jak často',
    'when_helper' => 'Kontroly běží na pozadí, takže potřebují queue worker. Bez něj se nic neodesílá a nic to neřekne - vezměte „Poslat zkoušku", ta frontou nejde.',

    'every' => 'Kontrolovat každých',
    'every_helper' => 'Každá kontrola dosáhne na daemona každého uzlu, takže je to jeden požadavek na uzel a průchod. Patnáct minut stačí, aby se o výpadku vědělo, dokud je to ještě výpadek.',
    'every_off' => 'Vypnuto - žádné kontroly',
    'every_five' => '5 minut',
    'every_fifteen' => '15 minut',
    'every_thirty' => '30 minut',
    'every_hourly' => 'Hodina',
    'every_daily' => 'Den',

    'repeat' => 'Připomínat mi to, dokud to trvá',
    'repeat_helper' => 'Zpráva odejde, když se něco změní, a další, když se to spraví. Tohle přidává připomínku, dokud potíž trvá. Nula znamená bez připomínek - kanál, který se opakuje každou čtvrthodinu, je kanál, který lidé ztlumí.',
    'hours' => 'hodin',

    // ---- kam --------------------------------------------------------------
    'where' => 'Kanály',
    'where_helper' => 'Víc než jeden dává smysl. Selhávají různě.',

    'discord' => 'Discord',
    'discord_helper' => 'Místo, kde si zprávu opravdu přečte i ten, kdo se zrovna nedívá do panelu.',
    'webhook' => 'Adresa webhooku',
    'webhook_helper' => 'V Discordu: Nastavení serveru → Integrace → Webhooky → Nový webhook → Zkopírovat URL webhooku. Jen https, protože se tímhle zveřejňuje, který z vašich strojů spadl a jak plný má disk.',
    'bot' => 'Vlastní bot',
    'bot_helper' => 'Jeden podepsaný JSON požadavek na adresu, kterou provozujete vy, aby se něco mimo panel dozvědělo o mrtvém node místo toho, aby se každou minutu ptalo, jestli nějaký je. Webhooky, které Pelican přináší, tohle unést nedokážou: spouštějí se nad modely a nad protokolem činnosti, a node, který přestal odpovídat, nepíše ani do jednoho.',
    'bot_url' => 'Kam to posílat',
    'bot_url_helper' => 'Jen https, protože se tímhle posílá na adresu na internetu, který z vašich strojů spadl.',
    'bot_secret' => 'Podpisové tajemství',
    'bot_secret_helper' => 'Sdílené s tím, co tohle přijímá. Tělo se jím zahašuje a otisk cestuje v X-Essentials-Signature jako sha256=<hex>, takže váš bot může odmítnout všechno, co nepřišlo z tohoto panelu. Dokud je tohle prázdné, neodesílá se nic - podpis, který je nepovinný, je podpis, který nikdo nekontroluje.',
    'facts' => 'Říct botovi i to, co se stalo',
    'facts_helper' => 'Vše výše je porucha. Toto ne: to jsou věci, které se prostě staly. Každá je vypnutá, dokud ji nezaškrtnete, aktualizace tedy nic nemění, a jdou pouze botovi, nikdy na Discord, zvoneček ani e-mail.',

    'panel' => 'V panelu',
    'panel_helper' => 'Upozornění pro každého, kdo má tohle oprávnění. Funguje vždycky, nic se nemusí nastavovat, a pro nepřihlášeného je neviditelné.',

    'email' => 'E-mail',
    'email_helper' => 'Oddělené čárkami. Používá mailer samotného panelu - spolehlivý, když je nastavený, a naprosto němý, když není, a to je ta jediná porucha, kterou watchdog mít nesmí. Nechte prázdné, ať se vypne.',

    // ---- co ---------------------------------------------------------------
    'what' => 'Na co se hlídá',
    'what_helper' => 'Každé měření tady je měření, které panel stejně dělá. Nic na téhle stránce neotevírá spojení, které by neotevírala stránka Stav systému.',

    'percent_helper' => 'Nula tuhle kontrolu vypíná.',
    'disk' => 'Varovat, když disk uzlu přesáhne',
    'memory' => 'Varovat, když paměť uzlu přesáhne',

    'maintenance' => 'Varovat na údržbu ponechanou déle než',
    'maintenance_helper' => 'Uzel v údržbě všechny ostatní kontroly přeskakují, a tak to má být - a je to zároveň způsob, jak se na jeden na čtrnáct dní zapomene. Nula tohle vypíná.',

    'versions' => 'Verze panelu a Wings',
    'versions_helper' => 'Jedna zpráva, když něco zaostane, a jedna, když je to zase aktuální. Bez připomínek - verze není výpadek.',

    'backups' => 'Zálohy, které zaostávají',
    'backups_helper' => 'Jedna zpráva, která vyjmenuje servery, ne jedna na server - když se naplánovaná úloha zastaví, všechny servery zastarají najednou, a čtyřicet oddělených zpráv o jedné příčině je kanál, který lidé ztlumí. Ve výchozím stavu vypnuto: panelu, který zálohuje ručně a ne podle plánu, by se to vyčítalo denně.',
    'backup_days' => 'Záloha se počítá jako prošlá po',
    'backup_days_helper' => 'Totéž bere i stránka Zálohy. Server, který se zálohuje jednou týdně, by se neměl hlásit po osmi dnech.',
    'days' => 'dnech',

    'stock' => 'Balíčky, které docházejí',

    'unbuilt_switch_helper' => 'Objednávka se zaplacenou fakturou, jejíž server uzel odmítl. Jediná kontrola tady, kde je někdo o peníze a nic to neříká: všechno ostatní v tomhle seznamu je stroj, který se zastavil. Vypnuto, dokud ji nezapnete, jako zbytek.',

    'unbuilt_switch' => 'Zaplaceno a nevytvořeno',
    'stock_helper' => 'Jedna zpráva, která vyjmenuje balíčky, ne jedna na balíček, a nikdy žádná připomínka: vyprodáno je běžný stav obchodu, ne výpadek, a slyšet o tom každé čtyři hodiny je způsob, jak se tohle přestane číst. Dívá se jen na balíčky, které mají strop, takže hlídat obchod, který prodává všechno bez omezení, nestojí nic. Ve výchozím stavu vypnuto, jako zbytek.',
    'modules_switch' => 'Modul, který je zapnutý a nefunguje',
    'modules_switch_helper' => 'Jedna zpráva na modul, ne jedna za všechny, protože u každého je špatně něco jiného a věta musí říct co. Hlásí dvě věci: modul, kterému chybí tabulky, což je instalace, která nedoběhla, a modul se zapnutými částmi, které čekají, až se něco vyplní. Stránka Moduly ukazuje obojí na kartě; tohle je pro panely, kam se nikdo nechodí dívat. Ve výchozím stavu vypnuto, jako zbytek.',
    'module_tables_title' => 'Modul :module je zapnutý a chybí mu tabulky',
    'module_tables' => 'Stránky, které patří k modulu :module, se schovávají, protože tabulky, ze kterých čtou, tu nejsou - obvykle je to instalace, která nedoběhla. Otevřete stránku Moduly, vypněte ho a zase zapněte, a tabulky se vytvoří.',
    'module_waiting_title' => 'Modul :module je zapnutý a část z něj čeká',
    'module_waiting' => '{1} Jedna část modulu :module je zapnutá a nic neukazuje, dokud se něco nevyplní: kterých eggů se týká, jaké styly jsou na výběr, které servery má veřejná stránka ukazovat. Stránka Moduly řekne které, na kartě.|[2,*] Zapnutých částí modulu :module, které nic neukazují, dokud se něco nevyplní: :count. Jde o to, kterých eggů se týkají, jaké styly jsou na výběr a které servery má veřejná stránka ukazovat. Stránka Moduly řekne které, na kartě.',
    'module_cleared' => 'Modul :module zase funguje',
    'ports_switch' => 'Docházející porty',
    'ports_switch_helper' => 'Jedna zpráva na balíček, ne jedna za všechny, protože užitečné jsou rozsah a počet, a seznam názvů ne. Sledují se jen balíčky, které mají nastavený rozsah, takže hlídat obchod, kde si nákup vezme kterýkoli volný port, nestojí nic. Ve výchozím stavu vypnuto, jako zbytek.',
    'stock_left' => 'Varovat, když zbývající počet klesne na',
    'stock_left_helper' => 'Počítá se proti stropu balíčku. Balíček musí na tohle číslo klesnout, aby se o něm varovalo, a vystoupat o dva nad ně, aby se zase počítal za v pořádku, takže ten, kterým nákup a zrušení šoupají sem a tam, neřekne nic. Nula je tady číslo, ne nepřítomnost: drží varování zticha a nechává jen tu zprávu, která říká, že balíček došel.',
    'stock_left_suffix' => 'nebo méně',

    'worker' => 'Queue worker',
    'worker_helper' => 'Jestli něco vůbec vykonává práci tohohle pluginu na pozadí. Všimněte si toho kruhu: sama kontrola běží ve frontě, takže panel, který worker nikdy neměl, to nahlásit nedokáže. Řádek nahoře na téhle stránce to dokáže.',

    // ---- tlačítka ---------------------------------------------------------
    'save' => 'Uložit',
    'saved' => 'Uloženo',
    'save_failed' => 'Nic se neuložilo',

    'test' => 'Poslat zkoušku',
    'test_one' => 'Vyzkoušet',
    'test_off' => 'Tenhle kanál je vypnutý',
    'test_off_body' => 'Zapněte ho a uložte, a vyzkouší se spolu s ostatními.',
    'test_title' => 'Zkušební zpráva',
    'test_body' => 'Jestli tohle čtete, upozornění z vašeho panelu Pelican sem budou chodit. Nic se neděje.',
    'test_sent' => 'Odesláno do každého zapnutého kanálu',
    'test_failed' => 'Aspoň jeden kanál to odmítl',
    'test_none' => 'Není kam poslat',
    'test_none_body' => 'Žádný kanál není zapnutý, takže by ani skutečné upozornění nikam nedošlo.',

    /*
     * Co s odmítnutím.
     *
     * Důvod, který uvede poskytovatel, je stručný a správný a sám o sobě
     * neužitečný. Dva, které vyplavou skoro pokaždé, jsou tu pojmenované,
     * protože ani jeden se z kódu neuhodne: 553 je o odesílateli, ne o
     * příjemci, a 401 z Discordu je odvolaná nebo špatně vložená URL.
     */
    'hint_email_sender' => 'Váš SMTP server odmítl tu adresu, ze které panel posílá, ne tu, na kterou posílal. V Admin → Nastavení → Pošta musí být adresa odesílatele schránka, ze které váš SMTP účet smí posílat. S tímhle pluginem to nemá co dělat - zkušební mail samotného Pelicanu na téže stránce spadne úplně stejně.',
    'hint_email' => 'Podívejte se do Admin → Nastavení → Pošta. Tlačítko zkušebního mailu na té stránce používá stejné nastavení a řekne totéž.',
    'hint_discord_url' => 'Discord tenhle webhook nepoznal. Byl smazán, vygenerován znovu, nebo vložen jen zčásti - vytvořte nový v Nastavení serveru → Integrace → Webhooky a zkopírujte celou URL.',
    'hint_discord' => 'Panel se na Discord nedostal. Jestli tenhle panel stojí za firewallem, který blokuje odchozí požadavky, odsud tenhle kanál fungovat nemůže.',
    'hint_panel' => 'Nikdo na tohle nemá oprávnění, nebo se upozornění nepodařilo uložit. Podívejte se do Rolí.',

    'run_now' => 'Spustit kontroly teď',
    'run_started' => 'Kontroluje se na pozadí',
    'run_failed' => 'Kontroly se nepodařilo spustit',

    'reset' => 'Zapomenout, co ví',
    'reset_confirm' => 'Smaže to, co každá kontrola naposledy řekla. Příští průchod se učí od nuly a nic neodešle, takže potíž, která pořád trvá, se ohlásí až o průchod dál. Použijte to poté, co jste vyřadili uzel, o kterém watchdog pořád mluví.',
    'reset_done' => 'Smazáno',

    // ---- samotné zprávy ---------------------------------------------------
    'still' => 'Trvá to :for.',
    'cleared_body' => 'Takhle to bylo :for.',
    'ports_title' => 'Docházejí porty pro hru :game',
    'ports_body' => 'Servery koupené pro hru :game přistávají na portech :from až :to. Volné porty: už jen :free z :total. Nákup, který žádný nenajde, je zaplacený a teprve pak odmítnutý, tak přidejte na uzlu alokace nebo rozšiřte rozsah na balíčku, než k tomu dojde.',
    'ports_none_title' => 'Pro hru :game nezbyl žádný port',
    'ports_none' => 'Servery koupené pro hru :game přistávají na portech :from až :to a z :total nezbyl volný ani jeden. Další nákup téhle hry bude zaplacený a pak odmítnutý bez alokace. Přidejte na uzlu alokace, nebo rozsah rozšiřte na samotném balíčku.',
    'ports_empty_title' => 'Pro hru :game neexistuje žádný port',
    'ports_empty' => 'Servery koupené pro hru :game přistávají na portech :from až :to a v tomhle rozsahu neexistuje ani jedna alokace na žádném z uzlů, které tahle hra může použít. Každý nákup téhle hry bude zaplacený a teprve pak odmítnutý. Vytvořte alokace na uzlu, nebo rozsah rozšiřte přímo na balíčku.',
    'ports_cleared' => 'Pro hru :game jsou zase volné porty',

    'for_unknown' => 'nějakou dobu',
    'for_minutes' => '{1} minutu|[2,*] :count minut',
    'for_hours' => '{1} hodinu|[2,*] :count hodin',
    'for_days' => '{1} den|[2,*] :count dní',

    'node_down' => ':node neodpovídá',
    'node_down_body' => 'Panel nedosáhne na daemona na :node. Servery na něm nenastartují, nezastaví se a nic nenahlásí, dokud se nevrátí.',
    'node_up' => ':node zase odpovídá',

    'node_disk' => 'Na :node dochází disk',
    'node_disk_body' => 'Disk na :node je zaplněný na :percent %, nad :limit %, které jste nastavili. Zálohy a instalace serverů padají jako první, když tohle dojde nahoru.',
    'node_disk_over' => 'Disk na :node je zase pod limitem',

    'node_memory' => 'Na :node dochází paměť',
    'node_memory_body' => 'Paměť na :node je využitá na :percent %, nad :limit %, které jste nastavili. Servery na něm může zabít jádro dřív, než cokoli nahlásí potíž.',
    'node_memory_over' => 'Paměť na :node je zase pod limitem',

    'node_maintenance' => ':node je v údržbě už dlouho',
    'node_maintenance_body' => ':node je v údržbě déle než :hours hodin. Zatím se na něm nic dalšího nekontroluje, což je právě smysl - ale vědět, že v tom stavu pořád stojí, se hodí.',
    'node_maintenance_over' => ':node je z údržby venku',

    'wings_behind' => 'Wings na :node je zastaralý',
    'wings_behind_body' => ':node běží na Wings :installed a venku je :latest. Aktualizujte ho na samotném uzlu - panel na to nemá způsob.',
    'wings_current' => 'Wings na :node je aktuální',

    'panel_behind' => 'Panel je zastaralý',
    'panel_behind_body' => 'Tenhle panel běží na :installed a venku je :latest.',
    'panel_current' => 'Panel je aktuální',

    'and_more' => 'a další :count',


    'owner_down' => '{1} Jeden z vašich serverů je offline|[2,*] Vašich serverů offline: :count',
    'owner_down_body' => 'Stroj, na kterém stojí, přestal odpovídat. Komu je třeba, už bylo řečeno. Týká se to: :servers',
    'owner_up' => '{1} Váš server je zpátky|[2,*] Vašich serverů se vrátilo: :count',
    'owner_up_body' => 'Stroj zase odpovídá. Zpátky jsou: :servers',

    'schedules' => 'Naplánované úlohy, které se zastavily',
    'schedules_helper' => 'Úloha zaseknutá uprostřed běhu, taková, jejíž čas uplynul, protože cron neběží, nebo taková, která nikdy nenaběhla. Pelican nemá slovo ani pro jednu ze tří - spadlý běh zůstane „zpracovává se" navždy a kreslí se přesně jako ten, který právě jede. Při každé kontrole čte všechny aktivní naplánované úlohy panelu.',

    'schedule_stopped' => '{1} Jedna naplánovaná úloha se zastavila|[2,*] :count naplánovaných úloh se zastavilo',
    'schedule_stopped_body' => 'Zaseknuté déle než :hours hodin, po termínu, nikdy nespuštěné, nebo bez jediné úlohy: :schedules',
    'schedule_running' => 'Všechny naplánované úlohy zase běží',

    'unbuilt_over' => 'Každá zaplacená objednávka má svůj server',

    'unbuilt_body' => 'Někdo zaplatil a nemá nic. Otevřete Objednávky a vytvořte je, nebo si přečtěte, proč byly odmítnuty: :orders',

    'unbuilt' => '{1} Zaplacená objednávka bez serveru|[2,*] :count zaplacených objednávek bez serveru',

    'stock_out' => '{1} Jeden balíček je vyprodaný|[2,*] Vyprodaných balíčků: :count',
    'stock_out_body' => 'Pořád v prodeji, a není co prodávat: :packages',
    'stock_low' => '{1} Jeden balíček je skoro vyprodaný|[2,*] Skoro vyprodaných balíčků: :count',
    'stock_low_body' => 'Na hranici :limit nebo pod ní: :packages',
    'stock_back' => '{1} Jeden balíček je zase v prodeji|[2,*] Balíčků zase v prodeji: :count',
    'stock_back_body' => 'Zase je co prodávat: :packages',

    'backup_none' => '{1} Jeden server nebyl nikdy zálohován|[2,*] :count serverů nebylo nikdy zálohováno',
    'backup_none_body' => 'Nikdy se nezálohovalo na: :servers',
    'backup_none_over' => 'Každý server už zálohu má',

    'backup_stale' => '{1} Jeden server nebyl v poslední době zálohován|[2,*] :count serverů nebylo v poslední době zálohováno',
    'backup_stale_body' => 'Žádná úspěšná záloha za :days dní na: :servers',
    'backup_stale_over' => 'Každý server byl nedávno zazálohován',

    'backup_failed' => '{1} Zálohování selhává na jednom serveru|[2,*] Zálohování selhává na :count serverech',
    'backup_failed_body' => 'Záloha skončila neúspěšně na: :servers',
    'backup_failed_over' => 'Už neselhává žádná záloha',

    'worker_missing' => 'Frontu nikdo nezpracovává',
    'worker_missing_body' => 'Úloha se zařadila do fronty a nikdo si ji nevzal. Aktualizace pluginů, instalace modpacků a tyhle kontroly stojí všechny, dokud neběží worker - zkuste systemctl status pelican-queue na stroji panelu.',
    'worker_back' => 'Fronta se zase zpracovává',
    'failed_title' => '{1} Od minulé kontroly selhala jedna úloha|[2,*] Od minulé kontroly selhalo :count úloh',
    'failed_body' => 'Něco, co měl panel udělat, se nestalo a už se to znovu nezkusí - nepostavený server, nevypsaná faktura, neodeslaný e-mail. Leží to v tabulce failed_jobs; `php artisan queue:retry all` je vrátí zpátky, jakmile se spraví to, co je zastavilo.',
    'failed_back' => 'Od poslední kontroly nic neselhalo',
    'failed' => 'Dát vědět, když selže úloha ve frontě',
    'failed_helper' => 'Laravel si úlohu, kterou vzdal, poznamená a nic o ní neřekne. Tohle o ní řekne. Počítá se, nevypisuje: dvacet selhání za jednu noc mívá jednu příčinu.',

    'health_interval_off' => 'Upozornění jsou zapnutá, ale interval je nastaven na Vypnuto, takže hlídač se nikdy nespustí.',
    'health_owners_unwatched' => 'Upozornění pro vlastníky jsou zapnutá, ale hlídač neběží, takže se vlastníci o výpadku nikdy nedozví.',
    'health_no_channel' => 'Hlídač běží, ale každý způsob, jak někoho upozornit, je vypnutý.',
    'health_discord' => 'Upozornění na Discord jsou zapnutá, ale není uložen žádný platný https webhook.',
    'health_bot' => 'Upozornění pro bota jsou zapnutá, ale chybí https adresa nebo podpisový klíč.',
    'health_email' => 'Upozorňovací e-maily jsou zapnuté, ale není žádná platná adresa, nebo pošta panelu zapisuje jen do svého logu.',
];
