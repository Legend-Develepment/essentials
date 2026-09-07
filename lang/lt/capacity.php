<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Pačiame puslapyje rašoma „mašina“, nes eilutė kalba apie geležį, o ne apie
 * Pelican sąvoką; „node“ priklauso nuostatoms, kur šis žodis jau perskaitytas.
 */

return [
    'nav_label' => 'Talpa',
    'title' => 'Ar telpa dar vienas serveris',
    'subheading' => 'Kiek pažadėta kiekviename node, palyginti su tuo, kiek jam leidžiama išdalyti.',

    'how' => 'Pažadėta, o ne panaudota. Node gali būti dvidešimt procentų užimtas ir tuo pačiu visiškai pilnas, nes pilnas yra apie tai, kiek išdalyta, o ne apie tai, kas veikia — Mašinų blokas apžvalgoje yra kitas klausimas ir lieka ten, kur yra. Skaičiavimas čia yra paties Pelican, iš to metodo, kuris sprendžia, ar serverį apskritai galima sukurti: talpa padauginta iš vieno plius perteklinis paskirstymas, palyginti su suma to, kas buvo pažadėta kiekvienam node serveriui. Talpa nulis reiškia neribotą, tą patį reiškia ir perteklinis paskirstymas žemiau nulio — todėl kai kurios eilutės neturi procento, užuot rodžiusios pilną ar tuščią juostą.',

    'column_node' => 'Mašina',
    'column_fullest' => 'Pilniausia',
    'column_memory' => 'Atmintis',
    'column_disk' => 'Diskas',
    'column_cpu' => 'Procesorius',
    'column_at_limit' => 'Ties riba',

    'servers' => 'Serverių: :count',

    'filter_tight' => 'Beveik pilna',

    'open' => 'Atidaryti mašiną',

    'empty' => 'Nėra mašinų, kurias pasiektum.',
];
