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
    'update' => 'Frissítés',
    'update_available' => 'Elérhető egy frissítés',
    'update_confirm' => 'A panel letölti az új verziót, újraépíti az assetjeit, és kiüríti a gyorsítótárait. A beállításaid megmaradnak.',
    'update_started' => 'Frissítés elindítva',
    'update_background' => 'A háttérben fut, és egy-két percet vesz igénybe.',
    'update_failed' => 'A témát nem sikerült frissíteni',
    'update_done' => 'Téma frissítve',
    'check' => 'Frissítések keresése',
    'check_failed' => 'A frissítési adatfolyamot nem sikerült olvasni',
    'check_failed_body' => 'A panel nem érte el, vagy nem érvényes JSON-t adott vissza.',
    'up_to_date' => 'A legújabb verziót futtatod',
    'reinstall' => 'Újratelepítés',

    'auto_on' => 'A frissítések maguktól települnek',

    /*
     * Mit tett a legutóbbi automatikus ellenőrzés. Mindegyik megnevezi azt a
     * részt, amelyet meg kellene nézni, mert egy böngészőből mind a három
     * elromlási mód ugyanúgy néz ki: egy visszafelé számláló szám.
     */
    'auto_never' => 'Még nem futott ellenőrzés. Az automatikus frissítésekhez a panel ütemezője kell — az a cron-bejegyzés, amely percenként futtatja a php artisan schedule:run parancsot. Nélküle semmi ütemezett nem történik.',
    'auto_ago' => 'Utoljára ellenőrizve: :ago',
    'auto_just_now' => 'épp most',
    'auto_minutes' => 'perce',
    'auto_current' => 'ezen a csatornán nincs újabb.',
    'auto_installed' => 'A v:version itt települt: maga az ütemezett ellenőrzés telepítette. Akkor teszi ezt, ha egyetlen queue worker sem válaszol, tehát a frissítés így is, úgy is megtörténik — de az a panel, amelyen nincs worker, olyan panel, amelyen a sorban álló többi munka sem halad.',
    'auto_queued' => 'A v:version átkerült a queue workerhez. Ha a fenti verzió néhány percen belül nem változik, a worker vesz ugyan feladatokat, de ezen elbukik — általában az újraindítása segít, az oka pedig a storage/logs alatt van.',
    'auto_unreachable' => 'a frissítési adatfolyamot nem sikerült olvasni. Az internetről töltődik le, tehát ez rendszerint hálózati vagy DNS-gond a panel gazdagépén.',
    'auto_error' => 'az ellenőrzés meghiúsult. Az oka a storage/logs alatt van.',

    /*
     * A queue worker, amely valójában végrehajtja a frissítést. A fenti
     * ellenőrzéstől külön kimondva, mert külön romlanak el, és mindegyikre más
     * a gyógymód.
     */
    'worker_missing' => 'Egyetlen queue worker sem válaszolt. A frissítéseket és a modpack-telepítéseket sorba állítja és egy worker folyamat hajtja végre, tehát amíg nem fut ilyen, csak leíródnak és soha nem hajtódnak végre, sehol egy hibaüzenet nélkül. Vagy nincs worker, vagy van, de a bővítmény telepítése előtt indult, és nem tudja betölteni a kódját — mindkettőt az orvosolja, ha újraindítod a panel gazdagépén. Állítsd be a szolgáltatását magától újrainduló módra, különben ez minden frissítés után visszatér.',

    'next_check' => 'Következő ellenőrzés',
    'due_now' => 'esedékes',

    /*
     * Az ok, nem a tünet szerint elnevezve, mert a tünet az, hogy „nem történt
     * semmi”, és éppen ezért volt ezt nehéz elhelyezni: a közlemények, a
     * navigációs linkek, a mentett stílusok és az oldalelrendezések mind fájlok
     * a storage/app alatt, és egy könyvtár, amelybe a panel nem tud írni, szó
     * nélkül elveszíti mindegyiket.
     */
    'storage_failed' => 'A panel nem tudott a storage könyvtárába írni, így ez nem lett elmentve. Ellenőrizd, hogy a storage/app azé a felhasználóé-e, amelyként a panel fut. Az ok a storage/logs alatt van.',

    /*
     * Minden sikertelen frissítés után kimondva, nem csak eltérés esetén. A
     * fenti üzenet már megnevezi az okot; ez azt az egyetlen gyógymódot nevezi
     * meg, amelyre egy ember nem tud rájönni abból, hogy „X-et vártam, Y-t
     * kaptam”.
     */
    'update_renamed' => 'Ha ez azt írja, hogy két azonosító nem egyezik, a bővítményt átnevezték, és ezen egyetlen frissítés sem jut át — a Pelican az azonosítójáról ismeri a telepített bővítményt. Távolítsd el a régi bejegyzést az Admin → Plugins alatt, és telepítsd ezt tisztán. A beállításaid túlélik: az .env fájlban és a storage/app/private/legend-theme alatt laknak, és egyiket sem az azonosító kulcsolja.',
];
