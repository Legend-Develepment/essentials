<?php

/*
 * Siden som svarer på «hvilke av mine ligger etter». Skrevet for den som
 * serverne tilhører, ikke for den som driver panelet - derfor nevnes noder
 * ikke her, og derfor står det ikke et tall han ikke kan gjøre noe med. Hver
 * linje enten navngir en server han kan åpne, eller sier hva han skal gjøre
 * med den.
 */

return [
    'title' => 'Trenger oppmerksomhet',
    'nav_label' => 'Trenger oppmerksomhet',
    'subheading' => 'Serverne dine, sortert etter hva som ligger etter framfor etter navn. En sikkerhetskopi kalles foreldet etter :days dager.',
    'column_server' => 'Server',
    'column_last' => 'Siste kopi',
    'column_kept' => 'Beholdt',
    'column_schedules' => 'Stoppede oppgaver',
    'never' => 'Aldri',
    'filter_none' => 'Aldri kopiert',
    'filter_stale' => 'Kopien er foreldet',
    'open' => 'Sikkerhetskopier',
    'empty' => 'Ingenting ligger etter',
    'empty_body' => 'Hver server du kan nå har en fersk sikkerhetskopi og ingen stoppede oppgaver. Denne siden fyller seg selv ut når det slutter å være sant.',
];
