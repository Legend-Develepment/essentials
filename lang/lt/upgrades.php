<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Veikiančios paslaugos perkėlimas iš vieno paketo į kitą.
 *
 * Formuluotės visą laiką laiko atskirai vieną dalyką: kiek paketas kainuoja ir
 * kiek šiandien kainuoja į jį pereiti - tai du skirtingi skaičiai. Pirmasis yra
 * ant lentynos; antrasis priklauso nuo to, kaip toli per apmokėtą laikotarpį
 * paslauga jau nuėjo, ir būtent su juo žmogus sutinka spausdamas mygtuką.
 *
 * Žodžio „atnaujinimas“ tame, ką skaito klientas, vengiama, nes pusė šių
 * perėjimų eina į kitą pusę. Čia tai vadinama keitimu.
 */

return [
    // ---- paslaugos kortelėje ---------------------------------------------
    'change' => 'Keisti paketą',
    'change_body' => 'Tai, kas liko iš jau apmokėto laikotarpio, nuimama, o tos pačios dienos apskaičiuojamos nauja kaina. Iš jūsų serverio niekas nedingsta.',
    'change_to' => 'Keisti į :name',
    'change_confirm' => 'Pakeisti šią paslaugą į :name?',
    'change_free' => 'Mokėti nieko nereikia',
    'costs_now' => ':amount dabar',
    'gives_back' => ':amount atgal',
    'waiting' => 'Keitimas sutartas',
    'waiting_for' => 'Keitimas į :name laukia neapmokėtos sąskaitos.',

    // ---- kas vyksta po to ------------------------------------------------
    'done' => 'Perkelta į :name',
    'done_body' => 'Jūsų paslauga jau naujame pakete. Viskas, kas jums priklausė, guli jūsų paskyroje.',
    'refused' => 'Keitimas neįvyko',

    // ---- ir kodėl ne, po vieną priežastį ---------------------------------
    'refused_off' => 'Paketo keitimas šiame skydelyje išjungtas.',
    'refused_not_active' => 'Keisti galima tik veikiančią paslaugą. Ta, kuri dar kuriama, sustabdyta ar baigiasi, neturi ko perskaičiuoti.',
    'refused_gone' => 'Paketo, kuriame yra ši paslauga, nebėra, tad nėra su kuo palyginti.',
    'refused_same' => 'Būtent tame pakete ji jau ir yra.',
    'refused_egg' => 'Tas paketas sukasi ant kitos programinės įrangos. Tai būtų kitas serveris, o ne didesnis, tad jį reikia pirkti kaip naują.',
    'refused_period' => 'Tas paketas apmokestinamas kitu laikotarpiu, o tai yra kitas susitarimas, o ne didesnis.',
    'refused_stock' => 'Tas paketas išparduotas.',
    'refused_waiting' => 'Šiai paslaugai jau yra keitimas, laukiantis neapmokėtos sąskaitos. Pirma ją apmokėkite arba atšaukite.',
    'refused_failed' => 'Niekas nebuvo užrašyta, tad niekas ir nepasikeitė. Pabandykite dar kartą, o jei kartosis, pasakykite tam, kas prižiūri šį skydelį.',
    'refused_server' => 'Serveriui nepavyko duoti naujų ribų, tad paslauga liko lygiai tokia, kokia buvo. Tam, kas prižiūri šį skydelį, jau pranešta.',

    // ---- kas parašyta dokumentuose ---------------------------------------
    'line' => 'Keitimas iš :from į :to, už likusias šio laikotarpio dienas: :days',
    'credit_reason' => 'Keitimas į :name',

    // ---- ir ką išgirsta savininkas ---------------------------------------
    'bell_failed' => 'Užsakyme :number nepavyko paketo keitimas',
    'cold_title' => 'Paketo keitimas pasiekė skydelį, bet ne node, užsakyme :number',
    'cold_body' => 'Paslauga jau yra :name pakete, ir naujos ribos užrašytos. Node jų dar nepaėmė ir perskaitys kitą kartą, kai tas serveris pasileis, tad iki tol klientas vis dar turi senąjį dydį. Patikrinkite node.',
    'gone' => 'Paketo, į kurį buvo keičiama, nebėra.',
    'refused_by_node' => 'Serveris nepriėmė naujų ribų: :why',

    // ---- kaip tai ištaisyti ----------------------------------------------
    'retry' => 'Bandyti keitimą dar kartą',
    'retry_confirm' => 'Pabandyti paketo keitimą iš naujo. Sąskaita už jį jau apmokėta, tad dukart niekas neapmokestinama.',
    'retried' => 'Keitimas pavyko',
    'retry_failed' => 'Vėl nepavyko. Priežastis yra užsakyme.',
];
