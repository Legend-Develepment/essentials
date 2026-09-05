<?php

/*
 * Wie er op een server zit, voor de spellen die Valve's query beantwoorden.
 *
 * Eén pagina voor Rust, ARK, Valheim en de rest, want ze beantwoorden hetzelfde
 * pakket. Wat per spel verschilt is wat je met iemand kunt dóen - kicken is
 * `kick "naam"` bij de een en `KickPlayer <id>` bij de ander - en daarom leest
 * deze pagina en handelt hij niet.
 */

return [
    'title' => 'Spelers',
    'nav_label' => 'Spelers',
    'subheading' => 'Wie er verbonden is, gevraagd aan het spel zelf in plaats van aan het panel.',

    'refresh' => 'Opnieuw vragen',

    'count' => ':count verbonden',
    'score' => 'Score',

    'just_joined' => 'net binnen',
    'minutes' => ':count min',
    'hours' => ':count u',
    'hours_minutes' => ':hours u :minutes min',

    'empty' => 'Er zit niemand op deze server.',

    /*
     * Niet "er zit niemand", en dat verschil telt. Het panel en de spelpoort
     * zitten vaak op netwerken die elkaar niet kunnen bereiken, en dat tekenen
     * als een lege lijst zou deze pagina iets laten zeggen wat hij niet weet.
     */
    'unreachable' => 'De server antwoordde niet. Hij start misschien nog op, of het panel kan zijn spelpoort niet bereiken vanaf waar het draait — dat is iets anders dan dat er niemand op zit.',
];
