<?php

/*
 * Română. Scris de mână.
 *
 * Plăți: fiecare încercare de a plăti și ce a spus procesatorul despre ea.
 *
 * Un rând pe încercare în loc de unul pe factură, pentru că așa s-a întâmplat.
 * Cuvântul pe care pagina asta îl tot repetă este „încercare": o plată eșuată
 * este un fapt care merită păstrat, nu o greșeală de ascuns.
 */

return [
    'title' => 'Plăți',
    'nav_label' => 'Plăți',
    'subheading' => 'Fiecare încercare de plată, la fiecare procesator. Verifică din nou îl întreabă încă o dată - exact ce face webhookul lor când ajunge.',

    // ---- tabelul ---------------------------------------------------------
    'column_invoice' => 'Factură',
    'column_gateway' => 'Procesator',
    'column_reference' => 'Referința lor',
    'column_amount' => 'Sumă',
    'column_state' => 'Stare',
    'column_updated' => 'Ultima veste',

    'gone_invoice' => 'Factură ștearsă',

    'state_open' => 'Așteaptă',
    'state_paid' => 'Plătită',
    'state_failed' => 'Eșuată',
    'state_cancelled' => 'Abandonată',

    // ---- butoanele -------------------------------------------------------
    'recheck' => 'Verifică din nou',
    'rechecked' => 'Am întrebat din nou',
    'rechecked_body' => 'Procesatorul tot nu spune că e plătită. Nu s-a schimbat nimic.',
    'settled' => 'E plătită',
    'settled_body' => 'Factura e închisă și tot ce o aștepta e pe drum.',
    'recheck_failed' => 'Nu am putut întreba',
    'recheck_failed_body' => 'Procesatorul nu a răspuns. Încearcă peste un minut; dacă se repetă, verifică cheia în pagina Setările magazinului.',
    'no_gateway' => 'Procesatorul acela e oprit',
    'no_gateway_body' => 'Pornește-l la loc ca să întrebi de plata asta, sau marchează factura plătită manual.',

    'answer' => 'Răspunsul lor',
    'no_answer' => 'Nimic consemnat',
    'close' => 'Închide',

    'empty' => 'Nimeni nu a plătit încă printr-un procesator',
    'empty_body' => 'Încercările apar aici din clipa în care cineva apasă Plătește - fie că duce treaba la capăt, fie că nu.',
];
