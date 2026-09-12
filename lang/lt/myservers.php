<?php

/*
 * Puslapis, kuris atsako į „kuris iš manųjų atsilieka“. Rašyta tam, kieno
 * tie serveriai yra, o ne tam, kas valdo skydelį - todėl čia niekur neminimi
 * node ir nepateikiamas nė vienas skaičius, su kuriuo jis nieko negali
 * padaryti. Kiekviena eilutė arba įvardija serverį, kurį jis gali
 * atsidaryti, arba pasako, ką su juo daryti.
 */

return [
    'title' => 'Reikia dėmesio',
    'nav_label' => 'Reikia dėmesio',
    'subheading' => 'Tavo serveriai, surikiuoti pagal tai, kas atsilikę, o ne pagal vardą. Kopija laikoma pasenusia po :days dienų.',
    'column_server' => 'Serveris',
    'column_last' => 'Paskutinė kopija',
    'column_kept' => 'Saugomos',
    'column_schedules' => 'Sustojusios užduotys',
    'never' => 'Niekada',
    'filter_none' => 'Niekada nekopijuotas',
    'filter_stale' => 'Kopija pasenusi',
    'open' => 'Atsarginės kopijos',
    'empty' => 'Niekas neatsilieka',
    'empty_body' => 'Kiekvienas serveris, kurį pasieki, turi šviežią kopiją ir jokių sustojusių užduočių. Šis puslapis prisipildo pats, kai taip nebebūna.',
];
