<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Kas yra serveryje, toms žaidimams, kurie atsako į Valve užklausą.
 *
 * Vienas puslapis Rust, ARK, Valheim ir kitiems, nes jie atsako į tą patį
 * paketą. Nuo žaidimo prie žaidimo skiriasi tai, ką gali kam nors padaryti -
 * išmesti yra `kick "vardas"` viename ir `KickPlayer <id>` kitame - ir todėl
 * šis puslapis skaito, o ne veikia.
 */

return [
    'title' => 'Žaidėjai',
    'nav_label' => 'Žaidėjai',
    'subheading' => 'Kas prisijungęs, paklausus paties žaidimo, o ne skydelio.',

    'refresh' => 'Klausk dar kartą',

    'count' => 'Prisijungusių: :count',
    'score' => 'Taškai',

    'just_joined' => 'ką tik įėjo',
    'minutes' => ':count min',
    'hours' => ':count val',
    'hours_minutes' => ':hours val :minutes min',

    'empty' => 'Šiame serveryje nieko nėra.',

    /*
     * Ne „nieko nėra“, ir skirtumas svarbus.
     *
     * Skydelis ir žaidimo prievadas dažnai yra tinkluose, kurie vienas kito
     * nepasiekia, o nupiešti tai kaip tuščią sąrašą reikštų, kad šis puslapis
     * teigia tai, ko nežino.
     */
    'unreachable' => 'Serveris neatsakė. Gali būti, kad jis pasileidžia, arba skydelis nepasiekia jo žaidimo prievado iš ten, kur veikia - o tai kas kita nei kad nieko nėra.',
];
