<?php

/*
 * Română. Scrisă de mână.
 *
 * Pe pagina însăși scrie „mașină”, pentru că rândul vorbește despre fier și nu
 * despre noțiunea Pelicanului; „node” își are locul în setări, unde cuvântul a
 * fost deja citit.
 */

return [
    'nav_label' => 'Capacitate',
    'title' => 'Dacă mai încape un server',
    'subheading' => 'Ce s-a promis pe fiecare node, față de cât are voie să împartă.',

    'how' => 'Promis, nu folosit. Un node poate fi ocupat în proporție de douăzeci la sută și complet plin în același timp, pentru că plin înseamnă cât s-a împărțit, nu ce rulează - blocul Mașini de pe pagina de ansamblu este cealaltă întrebare, și rămâne unde este. Calculul de aici este chiar al Pelicanului, din metoda care hotărăște dacă un server poate fi creat: capacitatea înmulțită cu unu plus supraalocarea, față de suma a ceea ce i s-a promis fiecărui server de pe node. O capacitate de zero înseamnă nelimitat, la fel și o supraalocare sub zero - de aceea unele rânduri nu au procent în loc să aibă o bară plină sau una goală.',

    'column_node' => 'Mașină',
    'column_fullest' => 'Cel mai plin',
    'column_memory' => 'Memorie',
    'column_disk' => 'Disc',
    'column_cpu' => 'Procesor',
    'column_at_limit' => 'La limită',

    'servers' => ':count servere',

    'filter_tight' => 'Aproape plin',

    'open' => 'Deschide mașina',

    'empty' => 'Nicio mașină la care să ajungi.',
];
