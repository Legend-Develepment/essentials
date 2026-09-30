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
    'none' => '{1} Vienas jūsų serveris niekada nebuvo kopijuotas.|[2,*] :count jūsų serverių niekada nebuvo kopijuoti.',
    'stale' => '{1} Vienas nekopijuotas ilgiau nei :days dienas.|[2,*] :count nekopijuoti ilgiau nei :days dienas.',
    'schedules' => '{1} Sustojo viena jūsų suplanuota užduotis.|[2,*] Sustojo :count jūsų suplanuotų užduočių.',

    'and_more' => 'ir dar :count',

    'open' => 'Atidaryk serverį ir eik į Atsarginės kopijos, kad padarytum vieną.',
];
