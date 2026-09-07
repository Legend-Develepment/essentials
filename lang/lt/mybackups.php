<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Eilutė virš kieno nors savo serverių sąrašo. Du sakiniai, susijungiantys į
 * vieną eilutę, nes tai dvi skirtingos bėdos: serveris be nė vienos atsarginės
 * kopijos paprastai yra toks, kuriam niekas jų ir nenustatė, o toks, kurio
 * paskutinė yra devynių dienų senumo, yra sustojęs tvarkaraštis.
 *
 * Skaičius eina į galą: lietuvių kalba keičia daiktavardį pagal skaičių, todėl
 * „:count serverių“ tinka ne visoms reikšmėms, o „Serverių: :count“ tinka
 * kiekvienai.
 */

return [
    'none' => 'Tavo serverių, kurie niekada nebuvo kopijuoti: :count.',
    'stale' => 'Be kopijos daugiau kaip :days dienas: :count.',

    'and_more' => 'ir dar :count',

    'open' => 'Atidaryk serverį ir eik į Atsarginės kopijos, kad padarytum vieną.',
];
