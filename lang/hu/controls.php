<?php

/*
 * Magyar. Kézzel írva.
 *
 * A vezérlősáv egy szerver oldalán. Saját fájl, nem a settings.php egy sarka,
 * mert ezt a panel használói olvassák, nem az, aki a témát állítja.
 *
 * A gombok melletti állapot a Pelican saját szava rá, a ContainerStatus
 * felsorolásból véve, hogy a sáv és a konzololdal soha ne mondjon mást arról,
 * mit csinál egy szerver.
 *
 * A „Kill” angolul marad: ez a Pelican saját gombjának és a parancsnak a neve,
 * és más dolog, mint a leállítás.
 */

return [
    'console' => 'Konzol',
    'full_page' => 'Új ablak',
    'close' => 'Bezárás',

    'start' => 'Indítás',
    'restart' => 'Újraindítás',
    'stop' => 'Leállítás',
    'kill' => 'Kill',

    'kill_confirm' => 'A Kill helyben állítja meg a konténert. Minden, amit a szerver még nem írt lemezre, elvész. Folytatod?',

    'sent_title' => 'Energiaparancs',
    'sent_body' => 'A(z) :action elküldve ide: :name.',
    'failed' => 'A node nem volt elérhető.',
];
