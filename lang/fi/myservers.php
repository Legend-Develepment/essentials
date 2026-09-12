<?php

/*
 * Sivu, joka vastaa kysymykseen ”mikä minun palvelimistani on jäljessä”.
 * Kirjoitettu sille, jonka palvelimet ne ovat, ei sille, joka paneelia
 * pyörittää - siksi täällä ei puhuta nodeista eikä anneta lukua, jolle hän
 * ei voi tehdä mitään. Jokainen rivi joko nimeää palvelimen, jonka hän voi
 * avata, tai kertoo mitä sille pitää tehdä.
 */

return [
    'title' => 'Vaatii huomiota',
    'nav_label' => 'Vaatii huomiota',
    'subheading' => 'Palvelimesi, järjestettynä sen mukaan mikä on jäljessä eikä nimen mukaan. Varmuuskopiota sanotaan vanhentuneeksi :days päivän jälkeen.',
    'column_server' => 'Palvelin',
    'column_last' => 'Viimeisin varmuuskopio',
    'column_kept' => 'Säilytetty',
    'column_schedules' => 'Pysähtyneet tehtävät',
    'never' => 'Ei koskaan',
    'filter_none' => 'Ei koskaan varmuuskopioitu',
    'filter_stale' => 'Varmuuskopio on vanhentunut',
    'open' => 'Varmuuskopiot',
    'empty' => 'Mikään ei ole jäljessä',
    'empty_body' => 'Jokaisella palvelimella, jonka voit avata, on tuore varmuuskopio eikä yhtään pysähtynyttä tehtävää. Tämä sivu täyttää itsensä, kun se lakkaa olemasta totta.',
];
