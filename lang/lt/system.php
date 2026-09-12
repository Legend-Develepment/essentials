<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Sistemos būsenos puslapis: mašina, kurioje veikia pats skydelis, ir kiekvienas
 * node, paprašytas šalia jos.
 *
 * Tai ne ta pati mašina kaip node nė vienoje diegimo aplinkoje, kur jie
 * atskirti - todėl abu ir gali būti puslapyje.
 *
 * „Swap“, „Wings“, „PHP“ ir „uptime“ lieka: taip jie vadinasi mašinoje ir
 * kiekviename įrankyje, su kuriuo žmogus lygintų.
 */

return [
    'title' => 'Sistemos būsena',
    'nav_label' => 'Sistemos būsena',
    'subheading' => 'Mašina, kurioje veikia pats skydelis, kas joje veikia, ir kiekvienas node, kurio paprašei šalia.',

    'options' => 'Parinktys',
    'enabled' => 'Rodyti šoninėje juostoje',
    'enabled_helper' => 'Išjungta pašalina eilutę iš šoninės juostos. Puslapis išlaiko savo adresą, tad jis visada ten, kad jį vėl įjungtum.',

    'refresh' => 'Skaityti iš naujo kas',
    'refresh_helper' => 'Visas puslapis prašomas iš naujo šiuo intervalu. Išjungta palieka jį tokį, koks buvo, kai jį atidarei.',
    'refresh_off' => 'Tik kai jį atidarau',
    'refresh_seconds' => ':seconds sekundės',

    'blocks' => 'Rodyti',
    'blocks_helper' => 'Pažymėta rodoma. Diskas yra po vieną kortelę failų sistemai, tad pilnas šakninis skirsnis nesislepia už pusiau tuščio duomenų prijungimo.',
    'block_cpu' => 'Procesorius',
    'block_memory' => 'Atmintis',
    'block_swap' => 'Swap',
    'block_disk' => 'Diskas',
    'block_load' => 'Vidutinė apkrova',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistema',
    'block_version' => 'Skydelio versija',
    // Niekada nerodoma - node kortelė ima jo paties pavadinimą - bet blank()
    // jos prašo, o trūkstamas raktas, spausdinantis savo paties vardą, yra
    // prasta atsarga.
    'block_node' => 'Node',

    'nodes' => 'Rodomi node',
    'nodes_helper' => 'Po vieną kortelę kiekvienam, šalia skydelio mašinos. Jei niekas nepažymėta, nerodomas nė vienas - apžvalgoje jau yra blokas su kiekvienu node. Kiekvieno klausiama jo paties demono, tad trumpas intervalas ir ilgas sąrašas reiškia daug užklausų.',

    'section_usage' => 'Naudojimas',
    'section_host' => 'Šis skydelis',
    'section_nodes' => 'Node',

    'disk_panel' => 'Skydelis gyvena čia',
    'wings' => 'Wings :version',
    'version_installed' => 'Įdiegta',
    'version_latest' => 'Naujausia',
    'version_current' => 'Aktuali',
    'version_update' => 'Yra atnaujinimas',
    'version_unknown' => 'Nepavyko patikrinti',

    /*
     * Ką siūlo atsilikusi kortelė.
     *
     * Nuoroda į laidą, o ne mygtukas, kuris atliktų atnaujinimą, nes iš čia
     * atnaujinimo atlikti nėra: Pelican neturi atnaujinimo komandos, o Wings
     * neturi endpoint, kuris pakeistų jo paties dvejetainį failą. Užuomina sako,
     * kur darbas iš tikrųjų atliekamas, kad niekas neitų ieškoti mygtuko, kuris
     * niekada nebuvo įmanomas.
     */
    'version_release' => 'Kas naujo',
    'version_how_panel' => 'Atidaro laidos pastabas. Skydelis atnaujinamas toje mašinoje, kurioje jis veikia - skydelis negali pakeisti savo paties failų, o nė vienam papildiniui neleidžiama leisti apvalkalo komandų.',
    'version_how_wings' => 'Atidaro laidos pastabas. Wings atnaujinamas pačiame node - skydelis neturi kanalo į programą, veikiančią kitoje mašinoje.',

    'wings_latest' => 'Naujausia :version',
    'load_cores' => ':percent% iš :cores procesorių',
    'load_windows' => ':five per 5 min · :fifteen per 15 min',
    'uptime_since' => 'Nuo :date',
    'unavailable' => 'Šioje mašinoje neprieinama',

    'fact_os' => 'Operacinė sistema',
    'fact_hostname' => 'Mašinos vardas',
    'fact_php' => 'PHP',
    'fact_cores' => 'Procesoriai',
    'fact_processes' => 'Procesai',
];
