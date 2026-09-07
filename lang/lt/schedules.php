<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Cron“ lieka: taip vadinasi tai, kas veikia skydelio mašinoje, ir kas eis to
 * tikrinti, ieškos būtent šio žodžio.
 */

return [
    'nav_label' => 'Tvarkaraščiai',
    'title' => 'Kuris tvarkaraštis sustojo',
    'subheading' => 'Kiekviena suplanuota užduotis skydelyje, blogiausia pirma — įstrigusi daugiau nei :hours valandas, pavėlavusi, arba niekada nevykdyta.',

    'how' => 'Pelican rodo tvarkaraščius kiekvieno serverio viduje, o jo paties būsena turi jiems tris žodžius: išjungta, apdoroja, aktyvu. Nė vienas nereiškia „šis sustojo“. Vykdymas, nukritęs pusiaukelėje, lieka „apdoroja“ amžiams ir atrodo lygiai taip pat kaip tas, kuris veikia dabar; tvarkaraštis, kurio laikas praėjo prieš valandas, nes cron mirė, vis dar vadinamas aktyviu. Šis puslapis kelia kitą klausimą. Tik skaitymas — viskas, kas redaguoja, paleidžia ar ištrina tvarkaraštį, lieka paties Pelican puslapyje tam serveriui.',

    'column_state' => 'Būsena',
    'column_name' => 'Tvarkaraštis',
    'column_server' => 'Serveris',
    'column_last' => 'Paskutinis vykdymas',
    'column_next' => 'Kitas vykdymas',

    /*
     * Penki nuosprendžiai. Parašyti kaip tai, kas yra tiesa, o ne kaip
     * nurodymas, nes trys iš jų yra dalykai, į kuriuos verta pažiūrėti, o du -
     * ne.
     */
    'state_stuck' => 'Įstrigęs',
    'state_overdue' => 'Pavėlavęs',
    'state_never' => 'Niekada nevykdytas',
    'state_healthy' => 'Tvarkoje',
    'state_off' => 'Išjungtas',

    'filter_stuck' => 'Įstrigęs',
    'filter_overdue' => 'Pavėlavęs',
    'filter_never' => 'Niekada nevykdytas',
    'filter_off' => 'Išjungtas',

    'open' => 'Atidaryti serveryje',

    'empty' => 'Nėra tvarkaraščių nė viename serveryje, kurį pasieki — arba nėra sustojusių, jei įjungtas filtras.',
];
