<?php

/*
 * Čeština. Psáno ručně.
 *
 * „Queue worker", „scheduler", „cron", „kanál" a cesty jako storage/app
 * zůstávají, jak jsou: pod těmito jmény se najdou na serveru i v dokumentaci
 * Pelicanu, a přesně to je potřeba, když se některá z těch hlášek objeví.
 */

return [
    'title' => 'Nastavení Essentials',
    'nav_label' => 'Nastavení Essentials',
    'save' => 'Uložit',
    'saved' => 'Nastavení uloženo',
    'save_failed' => 'Nastavení se nepodařilo uložit',
    'secret_kept' => 'Uloženo. Nechte prázdné pro zachování, nebo zadejte nový pro nahrazení.',
    'update_background' => 'Běží na pozadí a zabere minutu dvě.',

    /*
     * Queue worker a plánovač (scheduler), na kterých závisí každá úloha na
     * pozadí i každá naplánovaná úloha. Řečeno zvlášť, protože selhávají
     * odděleně a lék je pro každý jiný.
     */
    'worker_missing' => 'Žádný queue worker neodpověděl. Instalace modpacků, maily a další úlohy na pozadí se řadí do fronty a provádí je proces worker, takže dokud žádný neběží, jen se zapisují a nikdy neproběhnou, a to bez jediné chyby kdekoli. Buď worker není, nebo je takový, který nastartoval dřív, než se tenhle plugin nainstaloval, a neumí načíst jeho kód - obojí spraví jeho restart na hostiteli panelu. Nastavte jeho službu tak, ať se restartuje sama, jinak se to vrátí po každé aktualizaci.',
    'cron_missing' => 'Scheduler panelu neběžel :for minut. Obnovy a kontroly watchdogu na něj čekají. Řádek do cronu je v dokumentaci Pelicanu.',

    /*
     * Pojmenováno podle příčiny, ne podle příznaku, protože příznak je „nic se
     * nestalo", a právě to bylo těžké zařadit: oznámení, navigační odkazy,
     * uložené styly a rozvržení stránek jsou všechno soubory v storage/app, a
     * adresář, do kterého panel nemůže psát, o ně o všechny bez jediného slova
     * přijde.
     */
    'storage_failed' => 'Panel nemohl zapsat do svého adresáře storage, takže se tohle neuložilo. Zkontrolujte, že storage/app patří uživateli, pod kterým panel běží. Důvod je v storage/logs.',
];
