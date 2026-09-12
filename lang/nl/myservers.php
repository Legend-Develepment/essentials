<?php

/*
 * De pagina die antwoord geeft op “welke van de mijne loopt achter”.
 * Geschreven voor degene van wie de servers zijn, niet voor wie het panel
 * draait - daarom is hier nergens sprake van nodes, en staat er geen getal
 * waar hij niets mee kan. Elke regel noemt of een server die hij kan openen,
 * of zegt wat eraan te doen valt.
 */

return [
    'title' => 'Vraagt aandacht',
    'nav_label' => 'Vraagt aandacht',
    'subheading' => 'Je servers, gesorteerd op wat achterloopt in plaats van op naam. Een back-up heet verouderd na :days dagen.',
    'column_server' => 'Server',
    'column_last' => 'Laatste back-up',
    'column_kept' => 'Bewaard',
    'column_schedules' => 'Gestopte taken',
    'never' => 'Nooit',
    'filter_none' => 'Nooit geback-upt',
    'filter_stale' => 'Back-up is verouderd',
    'open' => 'Back-ups',
    'empty' => 'Niets loopt achter',
    'empty_body' => 'Elke server die je kunt bereiken heeft een recente back-up en geen gestopte taken. Deze pagina vult zichzelf zodra dat niet meer waar is.',
];
