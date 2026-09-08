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
    'when_helper' => 'Kontroly běží na pozadí, takže potřebují queue worker. Bez něj se nic neodesílá a nic to neřekne — vezměte „Poslat zkoušku", ta frontou nejde.',

    'every' => 'Kontrolovat každých',
    'every_helper' => 'Každá kontrola dosáhne na daemona každého uzlu, takže je to jeden požadavek na uzel a průchod. Patnáct minut stačí, aby se o výpadku vědělo, dokud je to ještě výpadek.',
    'every_off' => 'Vypnuto — žádné kontroly',
    'every_five' => '5 minut',
    'every_fifteen' => '15 minut',
    'every_thirty' => '30 minut',
    'every_hourly' => 'Hodina',
    'every_daily' => 'Den',

    'repeat' => 'Připomínat mi to, dokud to trvá',
    'repeat_helper' => 'Zpráva odejde, když se něco změní, a další, když se to spraví. Tohle přidává připomínku, dokud potíž trvá. Nula znamená bez připomínek — kanál, který se opakuje každou čtvrthodinu, je kanál, který lidé ztlumí.',
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
    'bot_secret_helper' => 'Sdílené s tím, co tohle přijímá. Tělo se jím zahašuje a otisk cestuje v X-Essentials-Signature jako sha256=<hex>, takže váš bot může odmítnout všechno, co nepřišlo z tohoto panelu. Dokud je tohle prázdné, neodesílá se nic — podpis, který je nepovinný, je podpis, který nikdo nekontroluje.',

    'panel' => 'V panelu',
    'panel_helper' => 'Upozornění pro každého, kdo má tohle oprávnění. Funguje vždycky, nic se nemusí nastavovat, a pro nepřihlášeného je neviditelné.',

    'email' => 'E-mail',
    'email_helper' => 'Oddělené čárkami. Používá mailer samotného panelu — spolehlivý, když je nastavený, a naprosto němý, když není, a to je ta jediná porucha, kterou watchdog mít nesmí. Nechte prázdné, ať se vypne.',

    // ---- co ---------------------------------------------------------------
    'what' => 'Na co se hlídá',
    'what_helper' => 'Každé měření tady je měření, které panel stejně dělá. Nic na téhle stránce neotevírá spojení, které by neotevírala stránka Stav systému.',

    'percent_helper' => 'Nula tuhle kontrolu vypíná.',
    'disk' => 'Varovat, když disk uzlu přesáhne',
    'memory' => 'Varovat, když paměť uzlu přesáhne',

    'maintenance' => 'Varovat na údržbu ponechanou déle než',
    'maintenance_helper' => 'Uzel v údržbě všechny ostatní kontroly přeskakují, a tak to má být — a je to zároveň způsob, jak se na jeden na čtrnáct dní zapomene. Nula tohle vypíná.',

    'versions' => 'Verze panelu a Wings',
    'versions_helper' => 'Jedna zpráva, když něco zaostane, a jedna, když je to zase aktuální. Bez připomínek — verze není výpadek.',

    'backups' => 'Zálohy, které zaostávají',
    'backups_helper' => 'Jedna zpráva, která vyjmenuje servery, ne jedna na server — když se naplánovaná úloha zastaví, všechny servery zastarají najednou, a čtyřicet oddělených zpráv o jedné příčině je kanál, který lidé ztlumí. Ve výchozím stavu vypnuto: panelu, který zálohuje ručně a ne podle plánu, by se to vyčítalo denně.',
    'backup_days' => 'Záloha se počítá jako prošlá po',
    'backup_days_helper' => 'Totéž bere i stránka Zálohy. Server, který se zálohuje jednou týdně, by se neměl hlásit po osmi dnech.',
    'days' => 'dnech',

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
    'hint_email_sender' => 'Váš SMTP server odmítl tu adresu, ze které panel posílá, ne tu, na kterou posílal. V Admin → Nastavení → Pošta musí být adresa odesílatele schránka, ze které váš SMTP účet smí posílat. S tímhle pluginem to nemá co dělat — zkušební mail samotného Pelicanu na téže stránce spadne úplně stejně.',
    'hint_email' => 'Podívejte se do Admin → Nastavení → Pošta. Tlačítko zkušebního mailu na té stránce používá stejné nastavení a řekne totéž.',
    'hint_discord_url' => 'Discord tenhle webhook nepoznal. Byl smazán, vygenerován znovu, nebo vložen jen zčásti — vytvořte nový v Nastavení serveru → Integrace → Webhooky a zkopírujte celou URL.',
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

    'for_unknown' => 'nějakou dobu',
    'for_minutes' => ':count minut',
    'for_hours' => ':count hodin',
    'for_days' => ':count dní',

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
    'node_maintenance_body' => ':node je v údržbě déle než :hours hodin. Zatím se na něm nic dalšího nekontroluje, což je právě smysl — ale vědět, že v tom stavu pořád stojí, se hodí.',
    'node_maintenance_over' => ':node je z údržby venku',

    'wings_behind' => 'Wings na :node je zastaralý',
    'wings_behind_body' => ':node běží na Wings :installed a venku je :latest. Aktualizujte ho na samotném uzlu — panel na to nemá způsob.',
    'wings_current' => 'Wings na :node je aktuální',

    'panel_behind' => 'Panel je zastaralý',
    'panel_behind_body' => 'Tenhle panel běží na :installed a venku je :latest.',
    'panel_current' => 'Panel je aktuální',

    'and_more' => 'a další :count',

    'owners' => 'Říkat lidem, když stroj jejich vlastního serveru spadl',
    'owners_helper' => 'Jediná zdejší kontrola, která píše někomu jinému než vám. Vlastník každého serveru na stroji, který přestal odpovídat, dostane upozornění v panelu — zvoneček, nikdy e-mail — a další, když se stroj vrátí. Mezi tím nikdy žádnou připomínku: opakovat to každou čtvrthodinu všem na vytíženém uzlu je způsob, jak se upozornění z panelu přestanou číst. Subusers se to neříká; rozhoduje o tom, co dělat, vlastník. Stroj se jim nepojmenovává, ze stejného důvodu, z jakého ho nezveřejňuje stránka stavu.',

    'owner_down' => 'Jeden z vašich serverů je offline|Vašich serverů offline: :count',
    'owner_down_body' => 'Stroj, na kterém stojí, přestal odpovídat. Komu je třeba, už bylo řečeno. Týká se to: :servers',
    'owner_up' => 'Váš server je zpátky|Vašich serverů se vrátilo: :count',
    'owner_up_body' => 'Stroj zase odpovídá. Zpátky jsou: :servers',

    'schedules' => 'Naplánované úlohy, které se zastavily',
    'schedules_helper' => 'Úloha zaseknutá uprostřed běhu, taková, jejíž čas uplynul, protože cron neběží, nebo taková, která nikdy nenaběhla. Pelican nemá slovo ani pro jednu ze tří — spadlý běh zůstane „zpracovává se" navždy a kreslí se přesně jako ten, který právě jede. Při každé kontrole čte všechny aktivní naplánované úlohy panelu.',

    'schedule_stopped' => 'Zastavených naplánovaných úloh: :count',
    'schedule_stopped_body' => 'Zaseknuté déle než :hours hodin, zpožděné, nebo nikdy nespuštěné: :schedules',
    'schedule_running' => 'Všechny naplánované úlohy zase běží',

    'backup_none' => 'Serverů bez jediné zálohy: :count',
    'backup_none_body' => 'Nikdy se nezálohovalo na: :servers',
    'backup_none_over' => 'Každý server už zálohu má',

    'backup_stale' => 'Serverů delší dobu bez zálohy: :count',
    'backup_stale_body' => 'Žádná úspěšná záloha za :days dní na: :servers',
    'backup_stale_over' => 'Každý server byl nedávno zazálohován',

    'backup_failed' => 'Zálohy selhávají na serverech: :count',
    'backup_failed_body' => 'Záloha skončila neúspěšně na: :servers',
    'backup_failed_over' => 'Už neselhává žádná záloha',

    'worker_missing' => 'Frontu nikdo nezpracovává',
    'worker_missing_body' => 'Úloha se zařadila do fronty a nikdo si ji nevzal. Aktualizace pluginů, instalace modpacků a tyhle kontroly stojí všechny, dokud neběží worker — zkuste systemctl status pelican-queue na stroji panelu.',
    'worker_back' => 'Fronta se zase zpracovává',
];
