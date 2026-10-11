<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „queue worker”, „cron”, „storage” és az útvonalak pontosan úgy maradnak,
 * ahogy a panel gazdagépén írják őket: így kerülnek be egy parancssorba.
 */

return [
    'title' => 'Essentials-beállítások',
    'nav_label' => 'Essentials-beállítások',
    'save' => 'Mentés',
    'saved' => 'Beállítások mentve',
    'save_failed' => 'A beállításokat nem sikerült menteni',
    'secret_kept' => 'Mentve. Hagyd üresen a megtartáshoz, vagy írj be újat a cseréhez.',
    'update_background' => 'A háttérben fut, és egy-két percet vesz igénybe.',

    /*
     * A queue worker és az ütemező (scheduler), amelyektől minden
     * háttérfeladat és időzített feladat függ. Külön kimondva, mert külön
     * romlanak el, és mindegyikre más a gyógymód.
     */
    'worker_missing' => 'Egyetlen queue worker sem válaszolt. A modpack-telepítések, a levelek és a többi háttérfeladat sorba kerül, és egy worker folyamat hajtja végre őket, tehát amíg nem fut ilyen, csak leíródnak és soha nem hajtódnak végre, sehol egy hibaüzenet nélkül. Vagy nincs worker, vagy van, de a bővítmény telepítése előtt indult, és nem tudja betölteni a kódját - mindkettőt az orvosolja, ha újraindítod a panel gazdagépén. Állítsd be a szolgáltatását magától újrainduló módra, különben ez minden frissítés után visszatér.',
    'cron_missing' => 'A panel ütemezője :for perce nem futott. A megújítások és a watchdog-ellenőrzések erre várnak. A cron-sor a Pelican dokumentációjában van.',

    /*
     * Az ok, nem a tünet szerint elnevezve, mert a tünet az, hogy „nem történt
     * semmi”, és éppen ezért volt ezt nehéz elhelyezni: a közlemények, a
     * navigációs linkek, a mentett stílusok és az oldalelrendezések mind fájlok
     * a storage/app alatt, és egy könyvtár, amelybe a panel nem tud írni, szó
     * nélkül elveszíti mindegyiket.
     */
    'storage_failed' => 'A panel nem tudott a storage könyvtárába írni, így ez nem lett elmentve. Ellenőrizd, hogy a storage/app azé a felhasználóé-e, amelyként a panel fut. Az ok a storage/logs alatt van.',
];
