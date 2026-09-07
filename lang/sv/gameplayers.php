<?php

/*
 * Svenska. Skriven för hand.
 *
 * Vem som är inne på en server, för de spel som svarar på Valves fråga.
 *
 * En sida för Rust, ARK, Valheim och resten, för de svarar på samma paket. Det
 * som skiljer sig mellan spelen är vad man kan göra med någon - att kicka är
 * `kick "namn"` i det ena och `KickPlayer <id>` i det andra - och det är därför
 * den här sidan läser och inte gör något.
 */

return [
    'title' => 'Spelare',
    'nav_label' => 'Spelare',
    'subheading' => 'Vilka som är anslutna, frågat av spelet självt i stället för av panelen.',

    'refresh' => 'Fråga igen',

    'count' => ':count anslutna',
    'score' => 'Poäng',

    'just_joined' => 'kom nyss in',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Ingen är inne på den här servern.',

    /*
     * Inte «ingen är inne», och skillnaden spelar roll.
     *
     * Panelen och spelporten ligger ofta på nät som inte når varandra, och att
     * rita det som en tom lista vore att den här sidan sade något den inte vet.
     */
    'unreachable' => 'Servern svarade inte. Den kanske startar, eller så når panelen inte dess spelport därifrån den körs — och det är något annat än att ingen är inne.',
];
