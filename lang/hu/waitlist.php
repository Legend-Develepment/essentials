<?php

/*
 * Magyar. Kézzel írva.
 *
 * Kérni, hogy szóljanak, ha egy elfogyott csomag újra eladó.
 *
 * A szöveg soha nem ígéri oda senkinek magát a dolgot. Amikor visszatér a
 * készlet, a listán mindenki egyszerre kapja meg a hírt, és azé lesz, aki
 * elsőként megveszi, tehát itt minden mondat ezt mondja ki ahelyett, hogy
 * annyit írna, „újra itt van”, és huszonnyolc emberre bízná, hogy kiderítse,
 * mennyit ért ez.
 *
 * A hír egyben le is veszi az embert a listáról, és ezt is kimondjuk: egy kérés
 * egy szólást vesz, és ettől marad olvasásra érdemes a harang.
 */

return [
    'bell_back' => 'A(z) :name újra elérhető',
    'bell_back_body' => '{1} Egy van belőle, és azé, aki elsőként megveszi. Most lekerültél a listáról, tehát kérd újra, ha lemaradsz róla.|[2,*] :count van belőle, és azé, aki elsőként megveszi. Most lekerültél a listáról, tehát kérd újra, ha lemaradsz róluk.',
    'bell_back_any' => 'Már nincs korlátozva, tehát mindenkinek jut. Most lekerültél a listáról.',
];
