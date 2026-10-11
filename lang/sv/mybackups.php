<?php

/*
 * Svenska. Skriven för hand.
 *
 * Raden ovanför någons egen serverlista. Två meningar som blir en rad, för det
 * är två skilda problem: en server helt utan säkerhetskopia är oftast en som
 * ingen har ställt in någon för, och en vars senaste är nio dagar gammal är ett
 * schema som har stannat.
 */

return [
    'none' => '{1} En av dina servrar har aldrig säkerhetskopierats.|[2,*] :count av dina servrar har aldrig säkerhetskopierats.',
    'stale' => '{1} En har inte säkerhetskopierats på över :days dagar.|[2,*] :count har inte säkerhetskopierats på över :days dagar.',
    'schedules' => '{1} En av dina schemalagda uppgifter har stannat.|[2,*] :count av dina schemalagda uppgifter har stannat.',

    'and_more' => 'och :count till',

    'open' => 'Öppna en server och gå till Säkerhetskopior för att göra en.',
];
