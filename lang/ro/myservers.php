<?php

/*
 * Pagina care răspunde la „care dintre ale mele a rămas în urmă”. Scrisă
 * pentru cel ale cărui sunt serverele, nu pentru cel care ține panoul - de
 * aceea aici nu se pomenește de node și nu apare niciun număr cu care nu
 * poate face nimic. Fiecare rând fie numește un server pe care îl poate
 * deschide, fie spune ce e de făcut cu el.
 */

return [
    'title' => 'Cere atenție',
    'nav_label' => 'Cere atenție',
    'subheading' => 'Serverele tale, ordonate după ce a rămas în urmă și nu după nume. O copie de siguranță se numește învechită după :days zile.',
    'column_server' => 'Server',
    'column_last' => 'Ultima copie',
    'column_kept' => 'Păstrate',
    'column_schedules' => 'Programări oprite',
    'never' => 'Niciodată',
    'filter_none' => 'Niciodată salvat',
    'filter_stale' => 'Copie învechită',
    'open' => 'Copii de siguranță',
    'empty' => 'Nimic nu a rămas în urmă',
    'empty_body' => 'Fiecare server la care ajungi are o copie recentă și nicio programare oprită. Pagina aceasta se completează singură când asta încetează să fie adevărat.',
];
