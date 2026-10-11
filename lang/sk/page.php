<?php

/*
 * Slovenčina. Písané ručne.
 *
 * „Queue worker", „scheduler", „cron", „kanál" a cesty ako storage/app
 * ostávajú, ako sú: pod týmito menami sa nájdu na serveri aj v dokumentácii
 * Pelicanu, a presne to treba, keď sa niektorá z tých hlások objaví.
 */

return [
    'title' => 'Nastavenia Essentials',
    'nav_label' => 'Nastavenia Essentials',
    'save' => 'Uložiť',
    'saved' => 'Nastavenia uložené',
    'save_failed' => 'Nastavenia sa nepodarilo uložiť',
    'secret_kept' => 'Uložené. Nechajte prázdne na zachovanie, alebo zadajte nový na nahradenie.',
    'update_background' => 'Beží na pozadí a zaberie minútu-dve.',

    /*
     * Queue worker a plánovač (scheduler), od ktorých závisí každá úloha na
     * pozadí aj každá naplánovaná úloha. Povedané zvlášť, lebo zlyhávajú
     * oddelene a liek je pre každý iný.
     */
    'worker_missing' => 'Žiadny queue worker neodpovedal. Inštalácie modpackov, maily a ďalšie úlohy na pozadí sa radia do frontu a vykonáva ich proces worker, takže kým žiadny nebeží, len sa zapisujú a nikdy neprebehnú, a to bez jedinej chyby kdekoľvek. Buď worker nie je, alebo je taký, ktorý naštartoval skôr, než sa tento plugin nainštaloval, a nevie načítať jeho kód - oboje spraví jeho reštart na hostiteľovi panela. Nastavte jeho službu tak, nech sa reštartuje sama, inak sa to vráti po každej aktualizácii.',
    'cron_missing' => 'Plánovač panela nebežal :for minút. Obnovy a kontroly watchdogu naň čakajú. Riadok pre cron je v dokumentácii Pelicanu.',

    /*
     * Pomenované podľa príčiny, nie podľa príznaku, lebo príznak je „nič sa
     * nestalo", a práve to bolo ťažké zaradiť: oznamy, navigačné odkazy, uložené
     * štýly a rozloženia stránok sú všetko súbory v storage/app, a adresár, do
     * ktorého panel nemôže písať, o ne o všetky bez jediného slova príde.
     */
    'storage_failed' => 'Panel nemohol zapísať do svojho adresára storage, takže sa toto neuložilo. Skontrolujte, že storage/app patrí používateľovi, pod ktorým panel beží. Dôvod je v storage/logs.',
];
