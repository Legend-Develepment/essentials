<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Doplnky predávané popri balíku.
 *
 * Dve veci sú tu držané oddelene. Čo doplnok stojí, je jeho cena, a tá sa
 * účtuje zakaždým. Čo stojí dnes, je z nej podiel, lebo ten, kto si ho kúpi
 * uprostred mesiaca, zaplatí zaň pol mesiaca. Text pre zákazníka vždy hovorí,
 * ktoré z tých dvoch čísel má na mysli.
 *
 * „Serveru nepridáva nič" je skutočná odpoveď a je povedaná nahlas, namiesto
 * toho, aby ostala prázdnym políčkom: prednostná podpora je bežná vec na predaj
 * a prázdna bunka vyzerá ako chyba.
 */

return [
    'title' => 'Doplnky',
    'nav_label' => 'Doplnky',
    'subheading' => 'Veci predávané popri balíku: viac pamäte, ďalšie miesto na zálohu alebo niečo, čo je len riadkom na faktúre.',

    // ---- tabuľka ----------------------------------------------------------
    'column_name' => 'Doplnok',
    'column_price' => 'Cena',
    'column_adds' => 'Pridáva',
    'column_sold' => 'V používaní',
    'column_live' => 'V predaji',
    'adds_nothing' => 'Nič na serveri',

    // ---- formulár ---------------------------------------------------------
    'section_what' => 'Čo to je',
    'section_what_helper' => 'Názov a cena, ktoré vidí zákazník, a to, s ktorými balíkmi sa dá kúpiť.',
    'name' => 'Názov',
    'price' => 'Cena',
    'price_helper' => 'Čo stojí zakaždým, keď sa účtuje. Pri kúpe uprostred obdobia zaplatí zákazník podiel z toho a celú sumu až od ďalšieho obnovenia.',
    'billing' => 'Účtuje sa',
    'billing_helper' => 'So službou znamená, že sa vráti pri každom obnovení, dokým si ho zákazník drží. Jednorazovo znamená, že sa naúčtuje na faktúre, ktorá ho nesie prvýkrát, a nikdy viac.',
    'billing_with' => 'Pri každom obnovení',
    'billing_once' => 'Jednorazovo',
    'max' => 'Najviac na jednu službu',
    'max_helper' => 'Koľko kusov tohto smie niekto mať. Jeden je bežný prípad; zvýšte to pri niečom, čo sa predáva po gigabajtoch.',
    'description' => 'Popis',
    'description_helper' => 'Jeden riadok pod názvom pri objednávaní. Povedzte, čo robí, nie ako sa volá.',
    'packages' => 'Balíky',
    'packages_helper' => 'S ktorými balíkmi sa toto dá kúpiť. Nič nezaškrtnuté znamená so všetkými, a to je zvyčajne prípad podpory alebo miesta na zálohu.',

    'section_adds' => 'Čo pridáva serveru',
    'section_adds_helper' => 'Toto sa pripočíta k tomu, čo balík už dáva, nenastavuje sa namiesto toho: 4096 pri pamäti spraví server o 4 GiB väčší. Dva rovnaké doplnky sa spočítajú. Nechajte všetko na nule pri niečom, čo je len riadkom na faktúre. Záporné číslo niečo uberie, čo je dovolené a občas presne to, čo niekto chce.',
    'sort' => 'Poradie',
    'sort_helper' => 'Nižšie ide pri objednávaní prvé. Pri rovnakých číslach rozhoduje cena.',
    'live' => 'V predaji',
    'live_helper' => 'Vypnuté sa neponúka nikde. Kto ho už má, ten si ho ponechá a ďalej sa mu zaň účtuje.',

    // ---- tlačidlá ---------------------------------------------------------
    'new' => 'Nový doplnok',
    'edit' => 'Upraviť',
    'delete' => 'Zmazať',
    'delete_confirm' => 'Tento nemá nikto. Zmazanie ho natrvalo odstráni zo zoznamu.',
    'delete_sold' => 'Tento má služieb: :count. Ponechajú si ho, ponechajú si limity, ktoré im dal, a ďalej sa im zaň účtuje - preč ide položka zo zoznamu, takže si ho už nikto nový nekúpi.',
    'go_live' => 'Dať do predaja',
    'go_offline' => 'Stiahnuť z predaja',
    'saved' => 'Uložené',
    'deleted' => 'Doplnok je preč',
    'save_failed' => 'Neuložené',
    'save_failed_body' => 'Nič sa nezapísalo. Skúste to znova a pozrite sa do logu, ak sa to bude opakovať.',
    'invalid' => 'Doplnok potrebuje názov a cenu.',
    'empty' => 'Zatiaľ žiadne doplnky',
    'empty_body' => 'Doplnok je to, čo sa predáva popri balíku: ďalší gigabajt, druhé miesto na zálohu alebo služba, ktorá serveru nepridá vôbec nič.',

    // ---- čo vidí zákazník -------------------------------------------------
    'choose' => 'Doplnky',
    'choose_helper' => 'Nepovinné a môžeš si ich pridať alebo zrušiť aj neskôr.',
    'yours' => 'Doplnky k tejto službe',
    'add' => 'Pridať doplnok',
    'add_helper' => 'Teraz zaplatíš za to, čo zostáva z tohto obdobia, a celú cenu od ďalšieho obnovenia.',
    'add_to' => 'Pridať :name',
    'add_confirm' => 'Pridať :name k tejto službe?',
    'drop' => 'Odobrať',
    'drop_confirm' => 'Odobrať :name? Nevyužitá časť toho, čo si zaplatil, ti pôjde späť na účet a tvoj server sa zmení hneď.',
    'costs_now' => ':amount teraz',
    'free_now' => 'Teraz nie je čo platiť',
    'then' => 'potom :amount za obnovenie',
    'once_only' => ':amount, jednorazovo',
    'each' => 'za kus',
    'added' => ':name pridané',
    'added_body' => 'Tvoj server dostal to, čo pridáva.',
    'dropped' => ':name odobrané',
    'dropped_body' => 'Čo si zaplatil a nevyužil, máš na účte.',

    // ---- a keď to nepôjde -------------------------------------------------
    'refused' => 'Toto sa urobiť nedalo',
    'refused_off' => 'Doplnky sú na tomto paneli vypnuté.',
    'refused_not_active' => 'Doplnky sa dajú pridať len k bežiacej službe.',
    'refused_gone' => 'Tento doplnok už nie je v predaji.',
    'refused_wrong_package' => 'Tento doplnok sa s týmto balíkom nepredáva.',
    'refused_enough' => 'Týchto máš už toľko, koľko ich táto služba smie mať.',
    'refused_failed' => 'Nič sa nezapísalo, takže sa nič nezmenilo. Skús to znova a povedz to tomu, kto tento panel spravuje, ak sa to bude opakovať.',
    'refused_server' => 'Server nové limity neprijal, takže sa nič nezmenilo a nič sa neúčtovalo.',
    'refused_not_yours' => 'Tento doplnok k tejto službe nepatrí.',

    // ---- čo stojí na dokladoch --------------------------------------------
    'line' => ':name × :many, za zvyšných :days dní tohto obdobia',
    'credit_reason' => 'Odobrané: :name',
    'bell_failed' => 'Doplnok sa nepodarilo pridať serveru pri objednávke :number',

    // ---- jednotky do tabuľky pre správcu ----------------------------------
    'unit_memory' => 'MiB pamäte',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disku',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databáz',
    'unit_allocation_limit' => 'alokácií',
    'unit_backup_limit' => 'záloh',
];
