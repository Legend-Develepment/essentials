<?php

/*
 * Magyar. Kézzel írva.
 *
 * A Rendszerállapot oldal: a gazdagép, amelyen maga a panel fut, és minden
 * node, amelyet mellé kértek.
 *
 * Nem ugyanaz a gép, mint a node-ok azokon a telepítéseken, ahol ezek külön
 * vannak, és ezért lehet mindkettő az oldalon.
 *
 * A „swap”, „Wings”, „PHP” és „uptime” marad: így írják a gazdagépen és minden
 * eszközben, amellyel az ember összevetné.
 */

return [
    'title' => 'Rendszerállapot',
    'nav_label' => 'Rendszerállapot',
    'subheading' => 'A gép, amelyen maga a panel fut, hogy mit futtat, és minden node, amelyet mellé kértél.',

    'options' => 'Beállítások',
    'enabled' => 'Mutasd az oldalsávban',
    'enabled_helper' => 'A ki kiveszi a sort az oldalsávból. Az oldal megtartja a saját címét, tehát mindig ott van, hogy visszakapcsold.',

    'refresh' => 'Olvasd újra minden',
    'refresh_helper' => 'Az egész oldalt ilyen közönként kéri le újra. A ki úgy hagyja, ahogy megnyitáskor volt.',
    'refresh_off' => 'Csak amikor megnyitom',
    'refresh_seconds' => ':seconds másodperc',

    'blocks' => 'Mutasd',
    'blocks_helper' => 'Ami ki van pipálva, az látszik. A lemez fájlrendszerenként egy kártya, tehát egy tele gyökérpartíció nem rejtőzik el egy félig üres adatcsatolás mögé.',
    'block_cpu' => 'Processzor',
    'block_memory' => 'Memória',
    'block_swap' => 'Swap',
    'block_disk' => 'Lemez',
    'block_load' => 'Átlagos terhelés',
    'block_uptime' => 'Uptime',
    'block_system' => 'Rendszer',
    'block_version' => 'Panel verziója',
    // Soha nem látszik - egy node kártyája a node saját nevét veszi fel - de a
    // blank() kéri, és egy hiányzó kulcs, amely a saját nevét írja ki, gyenge
    // tartalék.
    'block_node' => 'Node',

    'nodes' => 'Megjelenítendő node-ok',
    'nodes_helper' => 'Egy-egy kártya, a panel gazdagépe mellett. Ha semmi sincs kipipálva, egy sem látszik — az áttekintőn már van egy blokk minden node-dal. Mindegyiket a saját daemonjától kérdezi, tehát rövid közönként és hosszú listával sok kérés lesz.',

    'section_usage' => 'Használat',
    'section_host' => 'Ez a panel',
    'section_nodes' => 'Node-ok',

    'disk_panel' => 'A panel itt lakik',
    'wings' => 'Wings :version',
    'version_installed' => 'Telepítve',
    'version_latest' => 'Legújabb',
    'version_current' => 'Naprakész',
    'version_update' => 'Elérhető frissítés',
    'version_unknown' => 'Nem sikerült ellenőrizni',

    /*
     * Mit kínál egy lemaradt kártya.
     *
     * Link a kiadáshoz, nem gomb, amely elvégzi a frissítést, mert innen nincs
     * elvégzendő frissítés: a Pelicannak nincs frissítőparancsa, a Wingsnek
     * pedig nincs végpontja, amely lecserélné a saját binárisát. A súgó
     * megmondja, hol történik valójában a munka, hogy senki ne keressen olyan
     * gombot, amely soha nem volt lehetséges.
     */
    'version_release' => 'Mi az újdonság',
    'version_how_panel' => 'Megnyitja a kiadási jegyzeteket. A panel frissítése azon a gépen történik, amelyen fut - a panel nem tudja lecserélni a saját fájljait, és egyetlen bővítmény sem futtathat shell-parancsokat.',
    'version_how_wings' => 'Megnyitja a kiadási jegyzeteket. A Wingst magán a node-on frissítik - a panelnek nincs csatornája egy másik gépen futó programhoz.',

    'wings_latest' => 'Legújabb :version',
    'load_cores' => ':percent% / :cores processzor',
    'load_windows' => ':five 5 perc alatt · :fifteen 15 perc alatt',
    'uptime_since' => ':date óta',
    'unavailable' => 'Ezen a gazdagépen nem érhető el',

    'fact_os' => 'Operációs rendszer',
    'fact_hostname' => 'Gépnév',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processzorok',
    'fact_processes' => 'Folyamatok',
];
