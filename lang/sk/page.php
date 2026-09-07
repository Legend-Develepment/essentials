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
    'update' => 'Aktualizovať',
    'update_available' => 'Je dostupná aktualizácia',
    'update_confirm' => 'Panel stiahne novú verziu, prestavia svoje assets a vyprázdni cache. Vaše nastavenia ostávajú.',
    'update_started' => 'Aktualizácia spustená',
    'update_background' => 'Beží na pozadí a zaberie minútu-dve.',
    'update_failed' => 'Motív sa nepodarilo aktualizovať',
    'update_done' => 'Motív aktualizovaný',
    'check' => 'Skontrolovať aktualizácie',
    'check_failed' => 'Nepodarilo sa prečítať kanál aktualizácií',
    'check_failed_body' => 'Panel sa k nemu nedostal, alebo nevrátil platný JSON.',
    'up_to_date' => 'Máte najnovšiu verziu',
    'reinstall' => 'Preinštalovať',

    'auto_on' => 'Aktualizácie sa inštalujú samy',

    /*
     * Čo urobila posledná automatická kontrola. Každý z týchto riadkov
     * pomenúva miesto, kam by bolo treba pozrieť, lebo z prehliadača všetky tri
     * spôsoby, ako sa toto pokazí, vyzerajú rovnako: číslo, ktoré odpočítava.
     */
    'auto_never' => 'Zatiaľ žiadna kontrola neprebehla. Automatické aktualizácie potrebujú scheduler panela — záznam v crone, ktorý každú minútu spúšťa php artisan schedule:run. Bez neho sa nič naplánované vôbec nedeje.',
    'auto_ago' => 'Posledná kontrola :ago',
    'auto_just_now' => 'práve teraz',
    'auto_minutes' => 'minút dozadu',
    'auto_current' => 'v tomto kanáli nie je nič novšie.',
    'auto_queued' => 'v:version bola zaradená do frontu. Keď sa verzia vyššie do pár minút nezmení, queue worker nebeží — a práve tam sa aktualizácia odohráva.',
    'auto_unreachable' => 'kanál aktualizácií sa nepodarilo prečítať. Sťahuje sa cez internet, takže je to obyčajne sieťový problém alebo DNS na hostiteľovi panela.',
    'auto_error' => 'kontrola zlyhala. Dôvod je v storage/logs.',

    /*
     * Queue worker, teda to, čo aktualizáciu naozaj vykoná. Povedané zvlášť od
     * kontroly vyššie, lebo zlyhávajú oddelene a liek je pre každé iný.
     */
    'worker_missing' => 'Žiadny queue worker neodpovedal. Aktualizácie, inštalácie modpackov a tieto kontroly sa radia do frontu a vykonáva ich proces worker, takže kým žiadny nebeží, len sa zapisujú a nikdy neprebehnú, a to bez jedinej chyby kdekoľvek. Buď worker nie je, alebo je taký, ktorý naštartoval skôr, než sa tento plugin nainštaloval, a nevie načítať jeho kód — oboje spraví jeho reštart na hostiteľovi panela. Nastavte jeho službu tak, nech sa reštartuje sama, inak sa to vráti po každej aktualizácii.',

    'next_check' => 'Ďalšia kontrola o',
    'due_now' => 'má byť teraz',

    /*
     * Pomenované podľa príčiny, nie podľa príznaku, lebo príznak je „nič sa
     * nestalo", a práve to bolo ťažké zaradiť: oznamy, navigačné odkazy, uložené
     * štýly a rozloženia stránok sú všetko súbory v storage/app, a adresár, do
     * ktorého panel nemôže písať, o ne o všetky bez jediného slova príde.
     */
    'storage_failed' => 'Panel nemohol zapísať do svojho adresára storage, takže sa toto neuložilo. Skontrolujte, že storage/app patrí používateľovi, pod ktorým panel beží. Dôvod je v storage/logs.',

    /*
     * Povedané po každej neúspešnej aktualizácii, nie len po nezhode
     * identifikátorov. Hláška vyššie už príčinu pomenúva; táto pomenúva jediný
     * liek, ktorý sa z „očakávané X, prišlo Y" nedá odvodiť.
     */
    'update_renamed' => 'Keď tu stojí, že sa dva identifikátory nezhodujú, plugin bol premenovaný a žiadna aktualizácia cez to neprejde — Pelican pozná nainštalovaný plugin podľa identifikátora. Odinštalujte starú položku v Admin → Pluginy a tento nainštalujte znova. Vaše nastavenia to prežijú: ležia v .env a v storage/app/private/legend-theme, a ani jedno nie je vedené podľa identifikátora.',
];
