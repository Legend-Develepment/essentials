<?php

/*
 * Français. Écrit à la main.
 *
 * Demander à être prévenu quand un pack épuisé est de nouveau en vente.
 *
 * La formulation ne promet jamais la chose elle-même à qui que ce soit. Quand
 * le stock revient, tout le monde sur la liste est prévenu en même temps et
 * c’est pour qui achète le premier : chaque phrase ici le dit clairement,
 * plutôt que d’annoncer « il est de retour ! » et de laisser vingt-huit
 * personnes découvrir ce que cela valait.
 *
 * Être prévenu retire aussi de la liste, et cela est dit franchement : une
 * demande achète un avertissement, et c’est ce qui fait que la cloche vaut la
 * peine d’être lue.
 */

return [
    'bell_back' => ':name est de nouveau disponible',
    'bell_back_body' => '{1} Il y en a un, et il est pour qui achète le premier. Vous n’êtes plus sur la liste, redemandez-le donc si vous le ratez.|[2,*] Il y en a :count, et ils sont pour qui achète le premier. Vous n’êtes plus sur la liste, redemandez-le donc si vous les ratez.',
    'bell_back_any' => 'Il n’est plus limité : il y en a donc un pour tout le monde. Vous n’êtes plus sur la liste.',
];
