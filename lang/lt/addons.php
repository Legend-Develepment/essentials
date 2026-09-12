<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Priedai, parduodami šalia paketo.
 *
 * Čia atskirai laikomi du dalykai. Kiek priedas *kainuoja* yra jo kaina - ta,
 * kuri imama kiekvieną kartą. Kiek jis *kainuoja šiandien* yra tos kainos
 * dalis, nes tas, kuris jį perka mėnesio viduryje, moka už pusę mėnesio.
 * Klientui skirtos eilutės visada pasako, kuris iš tų dviejų skaičių rodomas.
 *
 * „Serveriui nieko“ yra tikras atsakymas ir pasakomas garsiai, o ne paliekamas
 * tuščiu langeliu, nes pirmenybinė pagalba yra visai įprastas dalykas parduoti,
 * o tuščias langelis atrodo kaip klaida.
 */

return [
    'title' => 'Priedai',
    'nav_label' => 'Priedai',
    'subheading' => 'Tai, kas parduodama šalia paketo: daugiau atminties, dar viena atsarginės kopijos vieta arba kažkas, kas tėra eilutė sąskaitoje.',

    // ---- lentelė ----------------------------------------------------------
    'column_name' => 'Priedas',
    'column_price' => 'Kaina',
    'column_adds' => 'Prideda',
    'column_sold' => 'Naudojama',
    'column_live' => 'Parduodamas',
    'adds_nothing' => 'Serveriui nieko',

    // ---- forma ------------------------------------------------------------
    'section_what' => 'Kas tai yra',
    'section_what_helper' => 'Pavadinimas ir kaina, kuriuos mato klientas, ir su kuriais paketais jį galima nusipirkti.',
    'name' => 'Pavadinimas',
    'price' => 'Kaina',
    'price_helper' => 'Kiek kainuoja kiekvieną kartą, kai imama. Nusipirkus laikotarpio viduryje klientas sumoka šios kainos dalį, o nuo kito atnaujinimo - visą.',
    'billing' => 'Apmokestinama',
    'billing_helper' => 'Su paslauga reiškia, kad jis grįžta su kiekvienu atnaujinimu tol, kol klientas jį laiko. Vienkartinis reiškia, kad imama toje sąskaitoje, kuri jį pirmą kartą atneša, ir daugiau niekada.',
    'billing_with' => 'Su kiekvienu atnaujinimu',
    'billing_once' => 'Vienkartinis',
    'max' => 'Daugiausia vienai paslaugai',
    'max_helper' => 'Kiek tokių vienas gali laikyti. Vienas yra įprastas atvejis; pakelkite, jei parduodama gigabaitais.',
    'description' => 'Aprašymas',
    'description_helper' => 'Viena eilutė po pavadinimu atsiskaitant. Rašykite, ką jis daro, o ne kaip vadinasi.',
    'packages' => 'Paketai',
    'packages_helper' => 'Su kuriais paketais jį galima nusipirkti. Nieko nepažymėta reiškia visus, ir tokia paprastai būna pagalbos paslauga ar atsarginės kopijos vieta.',

    'section_adds' => 'Ką jis prideda serveriui',
    'section_adds_helper' => 'Tai pridedama prie to, ką paketas jau duoda, o ne nustatoma vietoj jo: 4096 atminties padaro serverį 4 GiB didesnį. Du tokie patys priedai susideda. Palikite visur nulius, jei tai tėra eilutė sąskaitoje. Neigiamas skaičius atima, ir tai leidžiama - kartais būtent to ir norima.',
    'sort' => 'Eilė',
    'sort_helper' => 'Mažesnis rodomas anksčiau atsiskaitant. Esant vienodiems, lemia kaina.',
    'live' => 'Parduodamas',
    'live_helper' => 'Išjungus jis niekur nesiūlomas. Kas jį jau turi, tas ir toliau turi, ir toliau už jį moka.',

    // ---- mygtukai ---------------------------------------------------------
    'new' => 'Naujas priedas',
    'edit' => 'Keisti',
    'delete' => 'Ištrinti',
    'delete_confirm' => 'Šito niekas neturi. Ištrynus jis iš sąrašo dingsta visam laikui.',
    'delete_sold' => 'Šitą turi paslaugų: :count. Jos jį išlaiko, išlaiko jo duotas ribas ir toliau už jį moka - dingsta tik įrašas sąraše, tad naujai jo niekas nebenusipirks.',
    'go_live' => 'Pradėti pardavinėti',
    'go_offline' => 'Nustoti pardavinėti',
    'saved' => 'Išsaugota',
    'deleted' => 'Priedo nebėra',
    'save_failed' => 'Neišsaugota',
    'save_failed_body' => 'Niekas nebuvo įrašyta. Pabandykite dar kartą, o jei kartosis, pažiūrėkite į storage/logs.',
    'invalid' => 'Priedui reikia pavadinimo ir kainos.',
    'empty' => 'Priedų kol kas nėra',
    'empty_body' => 'Priedas yra tai, kas parduodama šalia paketo: dar vienas gigabaitas, antra atsarginės kopijos vieta arba paslauga, kuri serveriui neprideda visai nieko.',

    // ---- ką mato klientas -------------------------------------------------
    'choose' => 'Priedai',
    'choose_helper' => 'Nebūtini, ir vėliau juos galima pridėti ar atsisakyti.',
    'yours' => 'Šios paslaugos priedai',
    'add' => 'Pridėti priedą',
    'add_helper' => 'Dabar sumokate už tai, kas liko iš šio laikotarpio, o nuo kito atnaujinimo - visą kainą.',
    'add_to' => 'Pridėti :name',
    'add_confirm' => 'Pridėti :name prie šios paslaugos?',
    'drop' => 'Pašalinti',
    'drop_confirm' => 'Pašalinti :name? Nepanaudota sumokėtų pinigų dalis grįžta į jūsų paskyrą, o serveris pasikeičia iš karto.',
    'costs_now' => ':amount dabar',
    'free_now' => 'Dabar mokėti nieko nereikia',
    'then' => 'toliau :amount už atnaujinimą',
    'once_only' => ':amount, vieną kartą',
    'each' => 'už vienetą',
    'added' => ':name pridėtas',
    'added_body' => 'Jūsų serveriui jau duota tai, ką jis prideda.',
    'dropped' => ':name pašalintas',
    'dropped_body' => 'Viskas, ką sumokėjote ir nepanaudojote, guli jūsų paskyroje.',

    // ---- ir kai to padaryti nepavyks --------------------------------------
    'refused' => 'To padaryti nepavyko',
    'refused_off' => 'Priedai šiame skydelyje išjungti.',
    'refused_not_active' => 'Priedų galima pridėti tik veikiančiai paslaugai.',
    'refused_gone' => 'Tas priedas nebeparduodamas.',
    'refused_wrong_package' => 'Tas priedas su šiuo paketu neparduodamas.',
    'refused_enough' => 'Tokių jau turite tiek, kiek ši paslauga gali laikyti.',
    'refused_failed' => 'Niekas nebuvo užrašyta, tad niekas ir nepasikeitė. Pabandykite dar kartą, o jei kartosis, pasakykite tam, kas prižiūri šį skydelį.',
    'refused_server' => 'Serveris nepriėmė naujų ribų, tad niekas nebuvo pakeista ir niekas neapmokestinta.',
    'refused_not_yours' => 'Šioje paslaugoje to priedo nėra.',

    // ---- kas parašyta dokumentuose ----------------------------------------
    'line' => ':name × :many, už likusias šio laikotarpio dienas: :days',
    'credit_reason' => 'Pašalinta: :name',
    'bell_failed' => 'Užsakyme :number serveriui nepavyko duoti priedo',

    // ---- vienetai administratoriaus lentelei ------------------------------
    'unit_memory' => 'MiB atminties',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disko',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'duomenų bazių',
    'unit_allocation_limit' => 'allocation',
    'unit_backup_limit' => 'atsarginių kopijų',
];
