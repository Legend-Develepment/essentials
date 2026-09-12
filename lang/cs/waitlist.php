<?php

/*
 * Čeština. Psáno rukou.
 *
 * Žádost o zprávu, až bude vyprodaný balíček zase na prodej.
 *
 * Slova nikomu neslibují tu věc samotnou. Když se zásoba vrátí, řekne se to
 * všem na seznamu najednou a dostane ji ten, kdo koupí první - a každá věta to
 * tady říká rovnou místo toho, aby zahlásila „je zpátky!" a nechala
 * osmadvacet lidí zjistit, co to bylo za zprávu.
 *
 * Tím, že se to člověk dozví, zmizí ze seznamu, a i to je řečeno nahlas:
 * jedna žádost kupuje jednu zprávu, a právě proto stojí zvoneček za čtení.
 */

return [
    'bell_back' => ':name je zase na prodej',
    'bell_back_body' => '{1} Je jeden a dostane ho ten, kdo koupí první. Ze seznamu jsi teď pryč, tak se ozvi znovu, jestli ti uteče.|[2,*] Je jich :count a dostanou je ti, kdo koupí první. Ze seznamu jsi teď pryč, tak se ozvi znovu, jestli ti utečou.',
    'bell_back_any' => 'Už není omezený, takže je pro každého. Ze seznamu jsi teď pryč.',
];
