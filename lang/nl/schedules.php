<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * "Schedule" blijft staan waar het over Pelicans eigen tabblad gaat, want zo
 * heet het op het scherm waar je heen gestuurd wordt. De cron-regel wordt niet
 * vertaald: dat zijn vijf velden uit het bestand zelf.
 */

return [
    'nav_label' => 'Schedules',
    'title' => 'Welke planning is gestopt',
    'subheading' => 'Elke geplande taak op het panel, ergste eerst - langer dan :hours uur vast, overtijd, of nooit gelopen.',

    'how' => 'Pelican toont schedules binnen elke server, en zijn eigen status heeft er drie woorden voor: uit, bezig, actief. Geen daarvan betekent "dit is gestopt". Een run die halverwege gecrasht is blijft voor altijd op bezig staan en ziet er precies zo uit als eentje die nu draait; een planning waarvan de tijd uren geleden verstreek omdat de cron eruit lag heet nog steeds actief. Deze pagina stelt de andere vraag. Alleen lezen - alles wat een planning wijzigt, start of verwijdert blijft op Pelicans eigen pagina voor die server.',

    'column_state' => 'Staat',
    'column_name' => 'Planning',
    'column_server' => 'Server',
    'column_last' => 'Laatste run',
    'column_next' => 'Volgende run',

    'state_stuck' => 'Vast',
    'state_overdue' => 'Overtijd',
    'state_never' => 'Nooit gelopen',
    'state_healthy' => 'Prima',
    'state_off' => 'Uit',

    'filter_stuck' => 'Vast',
    'filter_overdue' => 'Overtijd',
    'filter_never' => 'Nooit gelopen',
    'filter_off' => 'Uitgezet',

    'open' => 'Openen op de server',

    'empty' => 'Geen schedules op een server die je kunt bereiken - of geen die gestopt zijn, als je een filter aan hebt staan.',
];
