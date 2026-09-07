<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Palworld pasaulio nuostatos puslapyje, o ne faile.
 *
 * Niekas čia neįvardija atskiros nuostatos. Kiekvienas užrašas tame puslapyje
 * išvedamas iš rakto, kurį turi pats serverio failas - žr.
 * Support\Palworld\Palworld::label(), kodėl vardų sąrašas būtų blogiau nei
 * jokio.
 *
 * „Pal“ ir „guild“ lieka: tai paties žaidimo žodžiai, ir juos žmogus jame ir
 * mato.
 */

return [
    'title' => 'Palworld nuostatos',
    'nav_label' => 'Palworld',
    'subheading' => 'Pasaulio nuostatos iš paties šio serverio PalWorldSettings.ini, nuskaitytos, kai atidarei šį puslapį. Redaguojamos tik kol serveris sustabdytas.',

    'reload' => 'Skaityk failą iš naujo',

    'save_confirm' => 'Failas perrašomas šiomis reikšmėmis. Kiekviena nuostata, kurios šis puslapis nerodė, įrašoma atgal lygiai tokia, kokia buvo, kaip ir visa kita faile.',
    'saved' => 'Nuostatos išsaugotos',
    'saved_body' => 'Įsigalios kitą kartą paleidus serverį.',
    'save_failed' => 'Failo įrašyti nepavyko',

    'running' => 'Serveris veikia',
    'running_body' => 'Palworld laiko šias nuostatas atmintyje ir, sustodamas, failą perrašo iš naujo, tad dabar išsaugotas pakeitimas būtų atšauktas be žodžio. Pirma sustabdyk serverį.',

    'groups' => [
        'server' => 'Serveris ir ryšys',
        'world' => 'Pasaulis ir dažniai',
        'pals' => 'Pals',
        'players' => 'Žaidėjai',
        'building' => 'Statyba, daiktai ir rinkimas',
        'guild' => 'Guilds',
        'other' => 'Kita',
    ],
];
