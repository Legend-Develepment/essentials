<?php

/*
 * Română. Scrisă de mână.
 *
 * Setările de lume ale Palworld, pe o pagină în loc de într-un fișier.
 *
 * Nimic de aici nu numește o setare anume. Fiecare etichetă de pe acea pagină
 * se deduce din cheia pe care o are chiar fișierul serverului - vezi
 * Support\Palworld\Palworld::label() pentru care o listă de nume ar fi mai rea
 * decât niciuna.
 *
 * „Pal” și „guild” rămân: sunt cuvintele jocului și acelea se văd în el.
 */

return [
    'title' => 'Setări Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'Setările de lume din chiar PalWorldSettings.ini al acestui server, citite când ai deschis pagina. Se pot modifica doar cât timp serverul este oprit.',

    'reload' => 'Citește fișierul din nou',

    'save_confirm' => 'Fișierul se rescrie cu aceste valori. Fiecare setare pe care pagina nu a arătat-o se scrie înapoi exact cum era, la fel și tot restul din fișier.',
    'saved' => 'Setări salvate',
    'saved_body' => 'Intră în vigoare la următoarea pornire a serverului.',
    'save_failed' => 'Fișierul nu a putut fi scris',

    'running' => 'Serverul rulează',
    'running_body' => 'Palworld ține aceste setări în memorie și rescrie fișierul când se oprește, așa că o modificare salvată acum ar fi anulată fără un cuvânt. Oprește mai întâi serverul.',

    'groups' => [
        'server' => 'Server și conexiune',
        'world' => 'Lume și rate',
        'pals' => 'Pals',
        'players' => 'Jucători',
        'building' => 'Construcție, obiecte și recoltare',
        'guild' => 'Guilds',
        'other' => 'Altele',
    ],
];
