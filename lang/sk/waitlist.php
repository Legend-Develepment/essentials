<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Žiadosť o správu, keď je vypredaný balík zase v predaji.
 *
 * Formulácie nikdy nikomu nesľubujú samotnú vec. Keď sa zásoba vráti, dozvedia
 * sa to naraz všetci na zozname a dostane ju ten, kto kúpi prvý, tak to každá
 * veta hovorí rovno, namiesto toho, aby povedala „je to späť!" a nechala
 * dvadsaťosem ľudí zisťovať, čo to bolo hodné.
 *
 * Správa zároveň berie človeka zo zoznamu, a aj to je povedané nahlas: jedna
 * žiadosť kupuje jednu správu, a práve to drží zvonček v cene, pre ktorú sa ho
 * oplatí čítať.
 */

return [
    'bell_back' => ':name je zase v predaji',
    'bell_back_body' => '{1} Je jeden a dostane ho ten, kto kúpi prvý. Zo zoznamu si už preč, tak si oň povedz znova, ak ti ujde.|[2,*] Sú :count a dostane ich ten, kto kúpi prvý. Zo zoznamu si už preč, tak si o ne povedz znova, ak ti ujdú.',
    'bell_back_any' => 'Už nie je obmedzený, takže je jeden pre každého. Zo zoznamu si už preč.',
];
