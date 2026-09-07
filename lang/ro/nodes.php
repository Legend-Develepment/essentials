<?php

/*
 * Română. Scrisă de mână.
 *
 * Blocul de pe pagina de ansamblu: mașina pe care rulează panoul însuși și
 * fiecare node.
 *
 * Cifrele node-urilor sunt ale Pelicanului, citite de la daemonul fiecăruia.
 * Rândul panoului se citește din /proc, ceea ce e altă întrebare - vezi
 * Support\SystemStatus.
 *
 * „Node” rămâne: este cuvântul Pelicanului peste tot, iar o traducere ar fi doar
 * un al doilea nume pentru același lucru.
 */

return [
    // Titlul blocului este chiar numele pluginului, citit la rulare, așa că
    // pentru el nu există niciun text aici.
    'panel' => 'Acest panou',
    'offline' => 'nu răspunde',
    'maintenance' => 'mentenanță',
    'cpu' => 'CPU',
    'memory' => 'Memorie',
    'disk' => 'Disc',
    'load' => 'Încărcare',
];
