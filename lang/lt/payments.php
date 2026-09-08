<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Mokėjimai: kiekvienas bandymas sumokėti ir tai, ką apie jį pasakė tiekėjas.
 *
 * Viena eilutė bandymui, o ne sąskaitai, nes taip tai ir vyko. Žodis, kurį šis
 * puslapis kartoja, yra „bandymas": nepavykęs mokėjimas yra faktas, vertas
 * išsaugoti, o ne klaida, kurią reikia paslėpti.
 */

return [
    'title' => 'Mokėjimai',
    'nav_label' => 'Mokėjimai',
    'subheading' => 'Kiekvienas bandymas sumokėti, per kiekvieną tiekėją. Patikrinti iš naujo paklausia tiekėjo dar kartą - būtent to, ką daro jų webhook, kai ateina.',

    // ---- lentelė ---------------------------------------------------------
    'column_invoice' => 'Sąskaita',
    'column_gateway' => 'Tiekėjas',
    'column_reference' => 'Jų nuoroda',
    'column_amount' => 'Suma',
    'column_state' => 'Būsena',
    'column_updated' => 'Paskutinė žinia',

    'gone_invoice' => 'Sąskaita ištrinta',

    'state_open' => 'Laukia',
    'state_paid' => 'Apmokėta',
    'state_failed' => 'Nepavyko',
    'state_cancelled' => 'Palikta',

    // ---- mygtukai --------------------------------------------------------
    'recheck' => 'Patikrinti iš naujo',
    'rechecked' => 'Paklausėme dar kartą',
    'rechecked_body' => 'Tiekėjas vis dar nesako, kad apmokėta. Niekas nepasikeitė.',
    'settled' => 'Apmokėta',
    'settled_body' => 'Sąskaita padengta, ir viskas, kas jos laukė, jau pakeliui.',
    'recheck_failed' => 'Nepavyko paklausti',
    'recheck_failed_body' => 'Tiekėjas neatsakė. Pabandykite po minutės; jei kartojasi, patikrinkite raktą Parduotuvės nustatymų puslapyje.',
    'no_gateway' => 'Tas tiekėjas išjungtas',
    'no_gateway_body' => 'Įjunkite jį atgal, kad galėtumėte paklausti apie šį mokėjimą, arba pažymėkite sąskaitą apmokėta ranka.',

    'answer' => 'Jų atsakymas',
    'no_answer' => 'Nieko neužfiksuota',
    'close' => 'Uždaryti',

    'empty' => 'Per tiekėją kol kas niekas nemokėjo',
    'empty_body' => 'Bandymai pasirodo čia tą akimirką, kai kas nors paspaudžia Mokėti - nesvarbu, ar užbaigia.',
];
