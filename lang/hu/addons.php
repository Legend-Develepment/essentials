<?php

/*
 * Magyar. Kézzel írva.
 *
 * Egy csomag mellé eladott extrák.
 *
 * Két dolgot tartunk itt külön. Az, hogy egy extra mennyibe *kerül*, az ára,
 * és ezt számoljuk fel minden alkalommal. Az, hogy *ma* mennyibe kerül, ennek
 * egy része, mert aki egy hónap közepén vesz egyet, fél hónapot fizet érte. A
 * vásárlónak szóló szövegek mindig megmondják, melyikről van szó.
 *
 * A „semmit sem ad a szerverhez” valódi válasz, és ki is mondjuk ahelyett,
 * hogy üresen hagynánk: az elsőbbségi támogatás teljesen hétköznapi eladható
 * dolog, egy üres cella viszont hibának látszik.
 */

return [
    'title' => 'Extrák',
    'nav_label' => 'Extrák',
    'subheading' => 'Csomag mellé eladott dolgok: több memória, még egy mentési hely, vagy valami, ami csak egy sor a számlán.',

    // ---- a táblázat ------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Ár',
    'column_adds' => 'Hozzáad',
    'column_sold' => 'Használatban',
    'column_live' => 'Eladó',
    'adds_nothing' => 'Semmit a szerverhez',

    // ---- az űrlap --------------------------------------------------------
    'section_what' => 'Mi ez',
    'section_what_helper' => 'A név és az ár, amit a vásárló lát, és hogy mely csomagok mellé vehető meg.',
    'name' => 'Név',
    'price' => 'Ár',
    'price_helper' => 'Amennyibe minden egyes felszámításkor kerül. Ha valaki egy időszak közepén veszi meg, ennek egy részét fizeti, a következő megújítástól pedig az egészet.',
    'billing' => 'Felszámítás',
    'billing_helper' => 'A szolgáltatással azt jelenti, hogy minden megújításkor visszatér, amíg megtartják. Az egyszeri azt jelenti, hogy azon a számlán szerepel, amelyik először viszi, és soha többé.',
    'billing_with' => 'Minden megújításkor',
    'billing_once' => 'Egyszer',
    'max' => 'Legfeljebb szolgáltatásonként',
    'max_helper' => 'Ebből mennyit tarthat valaki. Az egy a szokásos eset; emeld feljebb olyasminél, amit gigabájtonként adsz el.',
    'description' => 'Leírás',
    'description_helper' => 'Egy sor a név alatt a pénztárnál. Azt mondd el, mit tesz, ne azt, hogy hívják.',
    'packages' => 'Csomagok',
    'packages_helper' => 'Mely csomagok mellé vehető meg. Semmi bejelölve azt jelenti: mindegyik mellé, és általában ez a helyzet egy támogatási lehetőséggel vagy egy mentési hellyel.',

    'section_adds' => 'Mit ad a szerverhez',
    'section_adds_helper' => 'Ezek ahhoz adódnak hozzá, amit a csomag már ad, nem a helyére kerülnek: a memóriánál a 4096 négy GiB-tal nagyobbá teszi a szervert. Két ugyanolyan extra összeadódik. Hagyd mindet nullán, ha ez csak egy sor a számlán. A negatív szám elvesz valamit, ami megengedett, és néha pontosan ezt akarja valaki.',
    'sort' => 'Sorrend',
    'sort_helper' => 'Az alacsonyabb kerül előbbre a pénztárnál. Egyenlő számoknál az ár dönt.',
    'live' => 'Eladó',
    'live_helper' => 'Kikapcsolva sehol sem ajánljuk fel. Akinél már megvan, megtartja, és továbbra is fizet érte.',

    // ---- a gombok --------------------------------------------------------
    'new' => 'Új extra',
    'edit' => 'Szerkesztés',
    'delete' => 'Törlés',
    'delete_confirm' => 'Ez senkinél sincs. A törlése végleg leveszi a listáról.',
    'delete_sold' => ':count szolgáltatásnál megvan ez. Megtartják, megtartják a korlátokat is, amiket adott, és továbbra is fizetnek érte - ami eltűnik, az a listán lévő bejegyzés, hogy újonnan senki se vehesse meg.',
    'go_live' => 'Eladásra bocsátás',
    'go_offline' => 'Levétel az eladásról',
    'saved' => 'Mentve',
    'deleted' => 'Az extra eltűnt',
    'save_failed' => 'Nincs mentve',
    'save_failed_body' => 'Semmi sem íródott le. Próbáld újra, és ha továbbra is előfordul, nézz bele a naplóba.',
    'invalid' => 'Egy extrához név és ár kell.',
    'empty' => 'Még nincsenek extrák',
    'empty_body' => 'Az extra olyasmi, amit egy csomag mellé adnak el: még egy gigabájt, egy második mentési hely, vagy egy szolgáltatás, ami a szerverhez semmit sem tesz hozzá.',

    // ---- amit a vásárló lát ----------------------------------------------
    'choose' => 'Extrák',
    'choose_helper' => 'Nem kötelező, és később is hozzáadhatod vagy elhagyhatod őket.',
    'yours' => 'Extrák ezen a szolgáltatáson',
    'add' => 'Extra hozzáadása',
    'add_helper' => 'Most az időszakból hátralévő részt fizeted, a következő megújítástól pedig a teljes árat.',
    'add_to' => ':name hozzáadása',
    'add_confirm' => 'Hozzáadod ehhez a szolgáltatáshoz ezt: :name?',
    'drop' => 'Eltávolítás',
    'drop_confirm' => 'Eltávolítod ezt: :name? A kifizetett, de fel nem használt rész visszakerül a fiókodra, a szervered pedig azonnal megváltozik.',
    'costs_now' => 'most :amount',
    'free_now' => 'Most nincs mit fizetni',
    'then' => 'utána :amount megújításonként',
    'once_only' => ':amount, egyszer',
    'each' => 'darabonként',
    'added' => ':name hozzáadva',
    'added_body' => 'A szervered megkapta, amit hozzáad.',
    'dropped' => ':name eltávolítva',
    'dropped_body' => 'Amit kifizettél és nem használtál el, a fiókodon van.',

    // ---- és amikor nem megy ----------------------------------------------
    'refused' => 'Ez nem sikerült',
    'refused_off' => 'Az extrák ezen a panelen ki vannak kapcsolva.',
    'refused_not_active' => 'Csak futó szolgáltatáshoz lehet extrát adni.',
    'refused_gone' => 'Az az extra már nem eladó.',
    'refused_wrong_package' => 'Azt az extrát nem ehhez a csomaghoz adjuk el.',
    'refused_enough' => 'Már annyi van belőle, amennyit ez a szolgáltatás tarthat.',
    'refused_failed' => 'Semmi sem íródott le, tehát semmi sem változott. Próbáld újra, és ha továbbra is előfordul, szólj annak, aki ezt a panelt üzemelteti.',
    'refused_server' => 'A szerver nem fogadta el az új korlátokat, így semmi sem változott, és semmit sem számláztunk.',
    'refused_not_yours' => 'Az az extra nincs ezen a szolgáltatáson.',

    // ---- mit mondanak a dokumentumok -------------------------------------
    'line' => ':name × :many, az időszakból hátralévő :days napra',
    'credit_reason' => 'Eltávolítva: :name',
    'bell_failed' => 'Egy extrát nem sikerült megadni a szervernek a(z) :number rendelésen',

    // ---- egységek, az admin táblázathoz ----------------------------------
    'unit_memory' => 'MiB memória',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB lemez',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'adatbázis',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'mentés',
];
