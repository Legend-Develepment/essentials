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
    'none' => 'Palvelimiasi ilman yhtäkään varmuuskopiota: :count.',
    'stale' => 'Yli :days päivää ilman varmuuskopiota: :count.',
    'schedules' => 'Ajastetuista tehtävistäsi on pysähtynyt: :count.',

    'and_more' => 'ja :count muuta',

    'open' => 'Avaa palvelin ja mene kohtaan Varmuuskopiot tehdäksesi sellaisen.',
];
