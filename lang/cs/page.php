<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Queue worker", „scheduler", „cron", „kanál" a cesty jako storage/app
 * zůstávají, jak jsou: pod těmito jmény se najdou na serveru i v dokumentaci
 * Pelicanu, a přesně to je potřeba, když se některá z těch hlášek objeví.
 */

return [
    'updating_now' => 'Tenhle panel právě instaluje aktualizaci. Stránka může chvíli vypadat divně.',
    'updating_done' => 'Aktualizace je nainstalovaná. Pokud stránka před chvílí vypadala divně, načtěte ji znovu.',
    'title' => 'Nastavení Essentials',
    'nav_label' => 'Nastavení Essentials',
    'save' => 'Uložit',
    'saved' => 'Nastavení uloženo',
    'save_failed' => 'Nastavení se nepodařilo uložit',
    'update' => 'Aktualizovat',
    'update_available' => 'Je dostupná aktualizace',
    'update_confirm' => 'Panel stáhne novou verzi, přestaví své assets a vyprázdní cache. Vaše nastavení zůstávají.',
    'update_started' => 'Aktualizace spuštěna',
    'update_background' => 'Běží na pozadí a zabere minutu dvě.',
    'update_failed' => 'Motiv se nepodařilo aktualizovat',
    'update_done' => 'Motiv aktualizován',
    'check' => 'Zkontrolovat aktualizace',
    'check_failed' => 'Nepodařilo se přečíst kanál aktualizací',
    'check_failed_body' => 'Panel se k němu nedostal, nebo nevrátil platný JSON.',
    'up_to_date' => 'Máte nejnovější verzi',
    'reinstall' => 'Přeinstalovat',

    'auto_on' => 'Aktualizace se instalují samy',

    /*
     * Co udělala poslední automatická kontrola. Každý z těchhle řádků
     * pojmenovává místo, kam by bylo potřeba se podívat, protože z prohlížeče
     * všechny tři způsoby, jak se tohle pokazí, vypadají stejně: číslo, které
     * odpočítává.
     */
    'auto_never' => 'Zatím žádná kontrola neproběhla. Automatické aktualizace potřebují scheduler panelu - záznam v cronu, který každou minutu spouští php artisan schedule:run. Bez něj se nic naplánovaného vůbec neděje.',
    'auto_ago' => 'Poslední kontrola :ago',
    'auto_just_now' => 'právě teď',
    'auto_minutes' => 'minut zpět',
    'auto_current' => 'v tomhle kanálu není nic novějšího.',
    'auto_installed' => 'v:version se nainstalovala rovnou tady, samotnou naplánovanou kontrolou. Dělá to, když neodpoví žádný queue worker, takže aktualizace proběhne tak jako tak - jenže panel bez workeru je panel, kde se neděje ani ostatní práce ve frontě.',
    'auto_queued' => 'v:version byla předána queue workeru. Když se verze výše během pár minut nezmění, worker úlohy bere, ale na téhle selhává - obvykle pomůže jeho restart a důvod je v storage/logs.',
    'auto_unreachable' => 'kanál aktualizací se nepodařilo přečíst. Stahuje se přes internet, takže je to obvykle síťový problém nebo DNS na hostiteli panelu.',
    'auto_error' => 'kontrola selhala. Důvod je v storage/logs.',

    /*
     * Queue worker, tedy to, co aktualizaci doopravdy provádí. Řečeno zvlášť od
     * kontroly výše, protože selhávají odděleně a lék je pro každé jiný.
     */
    'worker_missing' => 'Žádný queue worker neodpověděl. Aktualizace, instalace modpacků a tyhle kontroly se řadí do fronty a provádí je proces worker, takže dokud žádný neběží, jen se zapisují a nikdy neproběhnou, a to bez jediné chyby kdekoli. Buď worker není, nebo je takový, který nastartoval dřív, než se tenhle plugin nainstaloval, a neumí načíst jeho kód - obojí spraví jeho restart na hostiteli panelu. Nastavte jeho službu tak, ať se restartuje sama, jinak se to vrátí po každé aktualizaci.',
    'cron_missing' => 'Scheduler panelu neběžel :for minut. Obnovy, kontroly watchdogu i automatické aktualizace čekají na něj. Řádek do cronu je v dokumentaci Pelicanu.',

    'next_check' => 'Příští kontrola za',
    'due_now' => 'má být teď',

    /*
     * Pojmenováno podle příčiny, ne podle příznaku, protože příznak je „nic se
     * nestalo", a právě to bylo těžké zařadit: oznámení, navigační odkazy,
     * uložené styly a rozvržení stránek jsou všechno soubory v storage/app, a
     * adresář, do kterého panel nemůže psát, o ně o všechny bez jediného slova
     * přijde.
     */
    'storage_failed' => 'Panel nemohl zapsat do svého adresáře storage, takže se tohle neuložilo. Zkontrolujte, že storage/app patří uživateli, pod kterým panel běží. Důvod je v storage/logs.',

    /*
     * Řečeno po každé neúspěšné aktualizaci, ne jen po neshodě identifikátorů.
     * Hláška výše už příčinu pojmenovává; tahle pojmenovává jediný lék, který se
     * z „očekáváno X, přišlo Y" nedá odvodit.
     */
    'update_renamed' => 'Když tu stojí, že se dva identifikátory neshodují, plugin byl přejmenován a žádná aktualizace přes to nepřejde - Pelican poznává nainstalovaný plugin podle identifikátoru. Odinstalujte starou položku v Admin → Pluginy a tenhle nainstalujte znovu. Vaše nastavení to přežije: leží v .env a v storage/app/private/legend-theme, a ani jedno není vedeno podle identifikátoru.',
];
