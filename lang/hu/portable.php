<?php

/*
 * Magyar. Kézzel írva.
 *
 * A beállítások fájlként: ki, és vissza be.
 *
 * A feltöltött fájlok szándékosan nincsenek benne - lásd Support\Portable, hogy
 * miért jobb ezt kimondani, mint csendben kihagyni őket.
 */

return [
    'export' => 'Beállítások exportálása',
    'records' => 'A rekordok exportálása',
    'records_helper' => 'Minden csomag, rendelés, számla, fizetés és hibajegy egyetlen fájlban. A bővítmény eltávolítása mindet törli, és a Pelican előtte semmit sem kérdez, tehát ez az a másolat, amit előre kell elkészíteni. Az API-kulcsok nincsenek benne: egy kulcsot nem fájlból állítanak vissza, hanem újra kiadnak.',
    'import' => 'Beállítások importálása',
    'apply' => 'Importálás',

    'file' => 'Beállításfájl',
    'file_helper' => 'Egy fájl, amelyet ebből a bővítményből exportáltak. Képek és ikoncsomagok nincsenek benne - azok fájlok egy lemezen, és úgy is maradnak, ahogy vannak.',

    'summary' => 'Mit változtatna ez',
    'summary_none' => 'Válassz fájlt, hogy lásd, mit változtatna.',
    'summary_unreadable' => 'Ez nem ennek a bővítménynek a beállításfájlja, vagy nincs benne semmi, amit ez a panel felismerne.',
    'summary_same' => 'Semmit. Abban a fájlban minden beállítás már megegyezik ezzel a panellel.',
    'summary_count' => '{1} Egy beállítás változna.|[2,*] :count beállítás változna.',
    'summary_more' => '· és még :count',

    'imported' => 'Beállítások importálva',
    'missing' => 'Ezek a képek nincsenek meg ezen a panelen, ezért kimaradnak: :files',
    'failed' => 'Azt a fájlt nem sikerült importálni',
    'no_file' => 'Nem érkezett fájl. A panel eltakarítja azt a feltöltést, amely túl sokáig vár az Importálás megnyomása előtt - válaszd ki újra a fájlt, és rögtön utána importáld.',
    'denied' => 'Nincs jogosultságod ezeknek a beállításoknak a módosítására.',
];
