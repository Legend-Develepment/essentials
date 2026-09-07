<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Apžvalgos blokas: mašina, kurioje veikia pats skydelis, ir kiekvienas node.
 *
 * Node skaičiai yra paties Pelican, nuskaityti iš kiekvieno jų demono. Skydelio
 * eilutė skaitoma iš /proc, o tai jau kitas klausimas - žr. Support\SystemStatus.
 *
 * „Node“ lieka: taip Pelican vadina jį visur, o vertimas būtų tik antras vardas
 * tam pačiam dalykui.
 */

return [
    // Bloko antraštė yra pats papildinio pavadinimas, nuskaitomas veikimo metu,
    // todėl jam čia teksto nėra.
    'panel' => 'Šis skydelis',
    'offline' => 'neatsako',
    'maintenance' => 'priežiūra',
    'cpu' => 'CPU',
    'memory' => 'Atmintis',
    'disk' => 'Diskas',
    'load' => 'Apkrova',
];
