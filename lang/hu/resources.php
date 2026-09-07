<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „mod”, „plugin”, „loader”, „jar” és a mods/ meg plugins/ mappanevek
 * maradnak: pontosan így állnak a Modrinthen és a szerver fájlfáján.
 */

return [
    'nav_label' => 'Modok és pluginok',
    'title' => 'Modok és pluginok',
    'subheading' => 'Egyszerre egy, a Modrinthről, erre a szerverre.',

    'section' => 'Keress valamit',
    'section_helper' => 'A modpack oldal egy egész packot telepít egyszerre. Ez egyetlen modot vagy plugint telepít, és sokkal gyakrabban erre van szükség.',

    'kind' => 'Mit adsz hozzá',
    /*
     * Megkérdezve, nem kitalálva. Egy egg annak hívják, aminek egy
     * adminisztrátor elnevezte, és több loader is olvassa mindkét mappát, tehát
     * innen nincs becsületes mód ezt kitalálni - és a rossz tipp olyan mappába
     * ír egy jart, amelyet semmi sem olvas.
     */
    'kind_helper' => 'Egy mod a mods/ mappába megy, és a Fabricnek, a Forge-nak vagy a NeoForge-nak szól. Egy plugin a plugins/ mappába megy, és a Bukkitnek, a Spigotnak vagy a Papernek szól. Ez dönti el azt is, hogy a Modrinth melyik felében keres.',
    'kind_mod' => 'Mod (mods/)',
    'kind_plugin' => 'Plugin (plugins/)',

    'search' => 'Keresés',
    'search_helper' => 'Írj be egy nevet, és kattints a mezőn kívülre. Az eredmények a legtöbbet letöltöttekkel kezdődnek.',

    'project' => 'Mod vagy plugin',
    'version' => 'Verzió',
    'version_helper' => 'Minden sor a verziószám, azok a Minecraft-verziók, amelyekre épült, és azok a loaderek, amelyeket támogat. Válassz olyat, amely illik a szerveredhez — itt semmi sem ellenőrzi ezt helyetted.',

    'install' => 'Telepítés',
    'install_confirm' => 'A fájlt a node közvetlenül a Modrinthről tölti le, és beteszi a mappába. Semmi sem törlődik, ami már ott van.',
    'installed' => 'Telepítve',
    'installed_helper' => 'A szerver következő indításakor töltődik be.',

    'change' => 'Verzió cseréje',
    'change_helper' => 'Ugyanannak a projektnek egy másik verzióját teszi ennek a fájlnak a helyére. Az új azelőtt töltődik le, hogy a régi törlődne, tehát egy sikertelen letöltés után az marad, amid volt.',
    'change_project_helper' => 'Rögzítve mindenhez, amit erről az oldalról telepítettek. A megváltoztatása nem verziócsere lenne — egy másik mod lenne ugyanazon a fájlnéven.',
    'change_lookup_helper' => 'Ez a fájl már a mappában volt, így itt semmi sem tudja, mi az. Keresd meg egyszer, és megjegyzi.',
    'changed' => 'Verzió lecserélve',

    'check' => 'Frissítések keresése',
    'checked' => 'Ellenőrizve',
    'checked_none' => 'Minden ismert a legújabb verzióján van.',
    'checked_some' => ':count elemhez van újabb verzió. A listában meg vannak jelölve.',
    'update_ready' => 'v:number elérhető',
    /*
     * A jelvény mellett kimondva, nem buboréksúgóban, mert megváltoztatja,
     * hogy mit jelent a jelvény. Itt semmi sem tudja, melyik Minecraft-verziót
     * vagy loadert futtatja a szerver, tehát a legújabb legújabbat jelent, nem
     * pedig a legújabbat, amely működni fog.
     */
    'check_note' => 'Az újabb a Modrinthen újabbat jelent. Itt semmi sem tudja, melyik Minecraft-verziót vagy loadert futtatja a szervered, tehát ellenőrizd, hogy a választott verzió azt írja-e, hogy illik, mielőtt elindítod a szervert.',
    'unknown' => 'Nem innen — a Verzió cseréje gombbal mondd meg, mi ez',

    'remove' => 'Eltávolítás',
    'remove_confirm' => 'A fájl törlődik a szerverről. Innen ezt nem lehet visszavonni.',
    'removed' => 'Eltávolítva',

    'running' => 'A szerver fut',
    'running_helper' => 'A Minecraft egyszer olvassa a mods/ és plugins/ mappát, indításkor. Egy most hozzáadott fájl csak újraindítás után töltődne be, egy futó játék alól elvett pedig magával viheti a játékot. Előbb állítsd le a szervert.',

    'failed' => 'Ez nem sikerült',
    'failed_version' => 'Ahhoz a verzióhoz nincs olyan jar, amelyet ez telepíthetne. Egyes kiadások csak forrást vagy csak kliensbuildet tartalmaznak.',
    'failed_write' => 'A node elutasította a letöltést. Lehet, hogy nem tudta elérni a Modrintht.',

    'installed_title' => 'Telepítve',
    'installed_mods' => 'A mods/ mappában',
    'installed_plugins' => 'A plugins/ mappában',
    /*
     * Kimondva, mert egy üres lista kétértelmű: rendszerint azt jelenti, hogy
     * ez a szerver egyáltalán nem használja azt a mappát, nem pedig azt, hogy
     * hiányzik valami.
     */
    'installed_empty' => 'Itt nincs semmi. Egy szerver csak az egyiket használja e két mappa közül, tehát az, hogy az egyik üres, normális.',
    'installed_note' => 'Csak a .jar fájlok szerepelnek. A konfigurációs mappákat és a letiltott fájlokat békén hagyja, és nem mutatja őket.',
];
