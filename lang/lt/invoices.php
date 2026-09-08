<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Sąskaitos: dokumentas, puslapis su sąrašu ir laiškas.
 *
 * Šį failą dalijasi trys skaitytojai. Administratorius skaito lentelę ir
 * spaudžia „pažymėti apmokėta"; klientas skaito spausdinamą dokumentą ir
 * laišką; o patį dokumentą po mėnesių skaito tas, kuris tvarko buhalteriją.
 * Būtent dėl pastarojo doc_ eilutės yra sausos ir oficialios - sąskaita nėra
 * vieta likusio skydelio tonui.
 */

return [
    'title' => 'Sąskaitos',
    'nav_label' => 'Sąskaitos',
    'subheading' => 'Kas skolinga ir kas apmokėta. Pažymėti sąskaitą čia padaro viską, ką padarytų apmokėjimas: serveris sukuriamas, sustabdytas grįžta.',

    // ---- lentelė ---------------------------------------------------------
    'column_number' => 'Sąskaita',
    'column_customer' => 'Klientas',
    'column_order' => 'Užsakymas',
    'column_total' => 'Iš viso',
    'column_state' => 'Būsena',
    'column_due' => 'Terminas',

    'kind_order' => 'Pirmoji sąskaita',
    'kind_renewal' => 'Atnaujinimas',

    'state_unpaid' => 'Neapmokėta',
    'state_paid' => 'Apmokėta',
    'state_cancelled' => 'Atšaukta',

    'no_order' => 'Be užsakymo',
    'no_due' => 'Be datos',
    'gone_customer' => 'Paskyra ištrinta',
    'discount_of' => ':amount nuolaida su :code',
    'paid_via' => 'per :how',
    'emailed' => 'Išsiųsta',
    'not_emailed' => 'Neišsiųsta',
    'filter_overdue' => 'Vėluojančios',

    // ---- mygtukai --------------------------------------------------------
    'open' => 'Atverti',
    'mark_paid' => 'Pažymėti apmokėta',
    'mark_paid_confirm' => 'Užfiksuoja, kad pinigai atėjo. Serveris sukuriamas, sustabdytas vėl pasileidžia, o kitas terminas pasislenka - lygiai taip, tarsi tai būtų pasakęs mokėjimų tiekėjas.',
    'paid' => 'Pažymėta apmokėta',
    'paid_body' => 'Viskas, kas laukė šios sąskaitos, jau pakeliui.',
    'already_paid' => 'Ji jau buvo apmokėta',

    'withdraw' => 'Atšaukti',
    'withdraw_confirm' => 'Išima sąskaitą iš apskaitos. Atšaukti galima tik neapmokėtą; apmokėta sąskaita yra pinigų, pakeitusių šeimininką, pėdsakas.',
    'withdrawn' => 'Atšaukta',
    'withdraw_refused' => 'Atšaukti galima tik neapmokėtą sąskaitą',

    'empty' => 'Sąskaitų kol kas nėra',
    'empty_body' => 'Pirmoji parašoma vos kam nors nusipirkus, o toliau po vieną per laikotarpį viskam, kas atsinaujina.',

    // ---- dokumentas ------------------------------------------------------
    'doc_title' => 'Sąskaita',
    'doc_number' => 'Numeris',
    'doc_issued' => 'Išrašyta',
    'doc_due' => 'Apmokėti iki',
    'doc_paid_on' => 'Apmokėta',
    'doc_billed_to' => 'Mokėtojas',
    'doc_from' => 'Pardavėjas',
    'doc_description' => 'Aprašymas',
    'doc_amount' => 'Suma',
    'doc_subtotal' => 'Be mokesčio',
    'doc_discount' => 'Nuolaida',
    'doc_total' => 'Iš viso',
    'doc_how_to_pay' => 'Kaip apmokėti',
    'doc_print' => 'Spausdinti arba įrašyti PDF',
    'doc_back' => 'Atgal į skydelį',

    // ---- laiškas ---------------------------------------------------------
    'mail_subject' => 'Sąskaita :number',
    'mail_hello' => 'Sveiki, :name,',
    'mail_intro' => 'Štai sąskaita :number.',
    'mail_open' => 'Atverti sąskaitą',
    'mail_foot' => 'Šią sąskaitą bet kada galite perskaityti savo atsiskaitymų puslapyje.',

    // ---- varpelis --------------------------------------------------------
    'bell_new' => 'Sąskaita :number',
    'bell_new_body' => 'Mokėti reikia :total. Atverkite atsiskaitymų puslapį, kad apmokėtumėte.',
    'bell_reminder' => 'Sąskaita :number praleido terminą',
    'bell_reminder_body' => 'Vis dar neapmokėta :total. Serveris, už kurį ji mokama, sustos :date, jei iki tol nebus apmokėta, ir nieko jame tuomet neištrinama.',
];
