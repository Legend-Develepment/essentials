<?php

/*
 * Suomi. Käsin kirjoitettu.
 *
 * Rivi jonkun oman palvelinlistan yläpuolella. Kaksi lausetta, jotka liittyvät
 * yhdeksi riviksi, koska ne ovat kaksi eri ongelmaa: palvelin ilman yhtäkään
 * varmuuskopiota on yleensä sellainen, jolle kukaan ei ole sellaista asettanut,
 * ja sellainen, jonka viimeisin on yhdeksän päivän ikäinen, on pysähtynyt
 * ajastus.
 */

return [
    'none' => '{1} Yhtä palvelimistasi ei ole koskaan varmuuskopioitu.|[2,*] :count palvelimistasi ei ole koskaan varmuuskopioitu.',
    'stale' => '{1} Yhtä ei ole varmuuskopioitu yli :days päivään.|[2,*] :count ei ole varmuuskopioitu yli :days päivään.',
    'schedules' => '{1} Yksi ajastetuista tehtävistäsi on pysähtynyt.|[2,*] :count ajastetuista tehtävistäsi on pysähtynyt.',

    'and_more' => 'ja :count muuta',

    'open' => 'Avaa palvelin ja mene kohtaan Varmuuskopiot tehdäksesi sellaisen.',
];
