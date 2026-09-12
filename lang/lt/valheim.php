<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „SteamID64“ ir „PlayFab ID“ lieka lygiai tokie, kokie rašomi tose vietose, iš
 * kurių juos pasiimi. „Admin“ taip pat lieka: tai žodis pačiame žaidimo faile.
 */

return [
    /* ------------------------------------------- administravimo kortelė -- */

    'section_helper' => 'Kurie egg paleidžia Valheim. Nieko daugiau - Valheim serveris derinamas savo paleidimo kintamaisiais, o paties Pelican Startup puslapis juos jau redaguoja.',

    'eggs' => 'Kurie egg yra Valheim',
    'eggs_helper' => 'Pažymėk tuos egg, kurie paleidžia Valheim serverį. Žaidėjų sąrašų puslapis atsiranda serveriuose, kurie juos naudoja, ir niekur kitur. Kur tie sąrašai laikomi, skiriasi nuo egg iki egg, tad tai nustatoma kiekvienam serveriui, žvelgiant į tas vietas, kurias naudoja žaidimas. Pradžioje nieko nepažymėta, tyčia - papildinys negali žinoti, kaip pavadinai savo egg.',

    /* ------------------------------------------------ serverio puslapis -- */

    'nav_label' => 'Žaidėjų sąrašai',
    'title' => 'Valheim žaidėjų sąrašai',
    'subheading' => 'Admin-ai, ban-ai ir leidžiamųjų sąrašas, kaip trys sąrašai vietoje trijų tekstinių failų.',

    'admin' => 'Admin-ai',
    'admin_helper' => 'Visi čia gali naudoti admin komandas žaidime.',
    'banned' => 'Su ban',
    'banned_helper' => 'Visi čia atmetami, kai bando prisijungti.',
    'permitted' => 'Leidžiami',
    'permitted_helper' => 'Jei šiame sąraše kas nors yra, prisijungti gali tik jie. Tuščias sąrašas įleidžia visus - o to dauguma serverių ir nori, tad palik jį tuščią, jei negalvoji kitaip.',

    'ids' => 'Žaidėjų identifikatoriai',
    'ids_placeholder' => 'Įklijuok identifikatorių ir paspausk tarpą',

    'how' => 'Po vieną identifikatorių žaidėjui - SteamID64 Steam serveryje, PlayFab ID tame, kur yra crossplay. Įklijuok juos ir paspausk tarpą, tabuliatorių arba kablelį. Viskas, ką žaidimas parašė kaip komentarą virš sąrašo, lieka ten, kur yra.',
    'where' => 'Nuskaityta iš :dir.',
    'missing' => 'Šis serveris dar neturi nė vieno iš šių failų. Žaidimas juos parašo, kai jų pirmą kartą prireikia, o išsaugojimas čia sukurs tuos, kuriuos užpildysi.',
    'read_only' => 'Šiuos failus gali skaityti, bet ne rašyti, tad čia nieko pakeisti negalima.',

    'save' => 'Išsaugoti',
    'saved' => 'Išsaugota',
    'saved_reload' => 'Valheim skaito šiuos sąrašus veikdamas, tad pakeitimas galioja be paleidimo iš naujo.',
    'unchanged' => 'Niekas nepasikeitė, tad niekas ir nebuvo įrašyta',
    'failed' => 'Nepavyko išsaugoti',
    'failed_lists' => 'Demonas atmetė įrašymą šiems: :lists. Patikrink, ar serveris pasiekiamas ir ar failai nėra tik skaitymui.',
];
