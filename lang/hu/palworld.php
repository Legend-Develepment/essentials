<?php

/*
 * Magyar. Kézzel írva.
 *
 * A Palworld világbeállításai oldalon, nem fájlban.
 *
 * Itt semmi nem nevez meg egy beállítást. Azon az oldalon minden címke abból a
 * kulcsból áll össze, amelyet a szerver saját fájlja tartalmaz - lásd
 * Support\Palworld\Palworld::label(), hogy miért lenne rosszabb egy névlista a
 * semminél.
 *
 * A „Pal” és a „guild” marad: ezek a játék saját szavai, és ezeket látni benne.
 */

return [
    'title' => 'Palworld-beállítások',
    'nav_label' => 'Palworld',
    'subheading' => 'A világbeállítások a szerver saját PalWorldSettings.ini fájljából, akkor beolvasva, amikor megnyitottad ezt az oldalt. Csak leállított szervernél szerkeszthető.',

    'reload' => 'Olvasd újra a fájlt',

    'save_confirm' => 'A fájl újraíródik ezekkel az értékekkel. Minden beállítás, amelyet ez az oldal nem mutatott, pontosan úgy íródik vissza, ahogy volt, és így minden más is a fájlban.',
    'saved' => 'Beállítások mentve',
    'saved_body' => 'A szerver következő indításakor lépnek életbe.',
    'save_failed' => 'A fájlt nem sikerült írni',

    'running' => 'A szerver fut',
    'running_body' => 'A Palworld memóriában tartja ezeket a beállításokat, és leálláskor újra kiírja a fájlt, így egy most mentett változtatás szó nélkül visszavonódna. Előbb állítsd le a szervert.',

    'groups' => [
        'server' => 'Szerver és kapcsolat',
        'world' => 'Világ és szorzók',
        'pals' => 'Palok',
        'players' => 'Játékosok',
        'building' => 'Építés, tárgyak és gyűjtés',
        'guild' => 'Guildek',
        'other' => 'Egyéb',
    ],
];
