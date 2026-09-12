<?php

/*
 * Sidan som svarar på «vilken av mina ligger efter». Skriven för den som
 * servrarna tillhör, inte för den som sköter panelen - därför nämns inga
 * noder här, och därför står det inget tal som hen inte kan göra något åt.
 * Varje rad namnger antingen en server som går att öppna eller säger vad man
 * ska göra åt den.
 */

return [
    'title' => 'Behöver ses över',
    'nav_label' => 'Behöver ses över',
    'subheading' => 'Dina servrar, sorterade efter vad som ligger efter i stället för efter namn. En säkerhetskopia räknas som föråldrad efter :days dagar.',
    'column_server' => 'Server',
    'column_last' => 'Senaste kopian',
    'column_kept' => 'Sparade',
    'column_schedules' => 'Stannade uppgifter',
    'never' => 'Aldrig',
    'filter_none' => 'Aldrig kopierad',
    'filter_stale' => 'Kopian är föråldrad',
    'open' => 'Säkerhetskopior',
    'empty' => 'Ingenting ligger efter',
    'empty_body' => 'Varje server du når har en färsk säkerhetskopia och inga stannade uppgifter. Den här sidan fyller i sig själv när det slutar stämma.',
];
