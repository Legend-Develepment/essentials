<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Užsakymai: ką kas nors nusipirko ir kas iš to išėjo.
 *
 * Keturios būsenos žemiau kalba apie pinigus, ne apie serverį. Ar serveris
 * dabar veikia, yra paties Pelican klausimas, į kurį atsakoma jo paties
 * puslapiuose. Žodžiai čia laiko šiuos du dalykus atskirai.
 */

return [
    'title' => 'Užsakymai',
    'nav_label' => 'Užsakymai',
    'subheading' => 'Viskas, kas nupirkta, serveris, kuris iš to atsirado, ir kaip yra dabar.',

    // ---- lentelė ---------------------------------------------------------
    'column_order' => 'Užsakymas',
    'column_customer' => 'Klientas',
    'column_package' => 'Paketas',
    'column_server' => 'Serveris',
    'column_state' => 'Būsena',
    'column_due' => 'Kitas terminas',

    'no_server' => 'Dar nesukurtas',
    'no_due' => 'Vienkartinis',
    'gone_customer' => 'Paskyra ištrinta',
    'gone_package' => 'Paketas ištrintas',
    'overdue_days' => 'Vėluoja :days dienų',

    'state_pending' => 'Laukia',
    'state_active' => 'Veikiantis',
    'state_suspended' => 'Sustabdytas',
    'state_cancelled' => 'Atšauktas',

    // ---- mygtukai --------------------------------------------------------
    'retry' => 'Kurti iš naujo',
    'retry_confirm' => 'Įstato kūrimą į eilę dar kartą. Niekas kitas nesikeičia, o sąskaita lieka apmokėta.',
    'retrying' => 'Įstatyta į eilę',

    'suspend' => 'Sustabdyti',
    'suspend_confirm' => 'Sustabdo serverį paties Pelican stabdymu. Failai, duomenų bazės ir atsarginės kopijos lieka ten, kur yra, o sąskaitos apmokėjimas jį panaikina.',
    'suspended' => 'Sustabdytas',

    'unsuspend' => 'Panaikinti sustabdymą',
    'unsuspended' => 'Vėl veikia',

    'change_due' => 'Keisti terminą',
    'change_due_helper' => 'Kada rašoma kita sąskaita. Tuščia reiškia niekada - užsakymas nustoja atsinaujinti nebūdamas atšauktas.',

    'cancel' => 'Atšaukti',
    'cancel_confirm' => 'Sustabdo atnaujinimus ir grąžina vietą atsargose. Serveris lieka: jis trinamas Pelican sistemoje, kur tam ir vieta.',
    'cancelled' => 'Atšauktas',

    'saved' => 'Išsaugota',
    'refused' => 'Niekas nepasikeitė',
    'refused_body' => 'Užsakymas nėra tokios būsenos, kurioje tai būtų įmanoma. Perkraukite puslapį ir pažiūrėkite dar kartą.',

    // ---- ką girdi klientas -----------------------------------------------
    'bell_ready' => 'Jūsų serveris paruoštas',
    'bell_ready_body' => ':server sukurtas ir laukia, kol jį paleisite.',
    'bell_suspended' => 'Jūsų serveris sustabdytas',
    'bell_suspended_body' => 'Sąskaita liko neapmokėta praėjus lengvatiniam laikotarpiui. Apmokėjus serveris paleidžiamas iš naujo; niekas nebuvo ištrinta.',

    // ---- ką girdi administratorius ---------------------------------------
    'bell_failed' => 'Užsakymo :number nepavyko sukurti',
    'no_allocation' => 'Nė vienas šio paketo node neturi laisvo allocation. Pridėkite vieną ir kurkite iš naujo.',
    'no_reason' => 'Skydelis atsisakė nepasakęs kodėl.',

    // ---- serveris, kuris iš to atsiranda ---------------------------------
    'server_description' => 'Pirkta parduotuvėje, užsakymas :number.',
    'server_fallback' => 'Serveris',
    'state_ending' => 'Baigiasi',
    'ends_on' => 'Baigiasi :date',
    'no_more_dues' => 'Sąskaitų daugiau nebus',
    'cancel_confirm_open' => 'Sustabdo atnaujinimus dabar ir grąžina vietą atsargose. Serveris paliekamas veikti: šis paketas neturi minimalaus termino, tad nėra ir datos, iki kurios reikėtų dirbti. Ištrinkite serverį Pelican sistemoje, kai klientui jo nebereikės.',
    'terminate' => 'Sustabdyti ir ištrinti',
    'terminate_heading' => 'Ištrinti šį serverį?',
    'terminate_confirm' => 'Serveris ištrinamas dabar, kartu su failais, duomenų bazėmis ir atsarginėmis kopijomis. Atgal grįžti nebus kaip, ir sutarties pabaigos nelaukiama. Verčiau atšaukite, jei klientas turi jį laikyti iki jam nurodytos datos.',
    'terminate_go' => 'Ištrinti',
    'terminated' => 'Ištrintas',
    'terminated_body' => 'Serverio nebėra, o užsakymas uždarytas.',
    'bell_ending' => 'Jūsų :package baigiasi :date',
    'bell_ending_open' => 'Jūsų :package atšauktas',
    'bell_ending_body' => 'Už jį daugiau sąskaitų negausite. Viskas, kas yra serveryje, ištrinama jam sustojus, todėl pasidarykite kopiją to, ką norite išsaugoti.',
    'bell_ended' => 'Jūsų :package baigėsi',
    'bell_ended_body' => 'Sutartis pasibaigė, o serveris ištrintas.',
    'bell_undeleted' => 'Užsakymo :number nepavyko ištrinti',
    'bell_undeleted_body' => 'Skydelis atsisakė ištrinti serverį. Užsakymas uždarytas ir niekam už jį nebus išrašyta sąskaita, bet serveris tebėra ir jį reikia pašalinti Pelican sistemoje.',
    'bell_undelivered' => 'Užsakymo :number failas tebėra čia',
    'bell_undelivered_body' => 'Serveris sukurtas, bet kliento įkelto failo į jį įdėti nepavyko. Failas tebėra skydelio saugykloje, o priežastis yra storage/logs.',

    'empty' => 'Kol kas nieko nenupirkta',
    'empty_body' => 'Užsakymai pasirodo čia vos kam nors nusipirkus paketą.',

    // ---- atnaujinimai ----------------------------------------------------
    'filter_late' => 'Vėluoja su sąskaita',
    'run_renewals' => 'Paleisti atnaujinimus dabar',
    'run_renewals_confirm' => 'Padaro tai, ką daro naktinis pravažiavimas: išrašo kitą sąskaitą visam, kam netrukus sueina terminas, ir sustabdo serverius, už kurių yra sąskaita, likusi neapmokėta praėjus lengvatiniam laikotarpiui.',
    'renewals_queued' => 'Įstatyta į eilę',
    'renewals_queued_body' => 'Vykdoma eilėje. Po akimirkos perkraukite puslapį ir pamatysite, kas pasikeitė.',
];
