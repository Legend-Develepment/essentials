<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „GameUserSettings.ini“ ir „Startup“ rašomi taip, kaip stovi žaidime ir
 * Pelican - būtent tų pavadinimų žmogus ir ieško.
 */

return [
    /* ------------------------------------------- administravimo kortelė -- */

    /*
     * Pati antraštė ne čia. Kiekvienas nuostatų skyrius savo antraštę ima iš
     * settings.groups.<pavadinimas>, kurią sudeda group().
     */
    'section_helper' => 'Kurie egg paleidžia ARK. Nieko daugiau — visa kita ARK serveryje derinama jo paleidimo kintamaisiais, o paties Pelican Startup puslapis juos jau redaguoja.',

    'eggs' => 'Kurie egg yra ARK',
    'eggs_helper' => 'Pažymėk tuos egg, kurie paleidžia ARK serverį. Pasaulio nuostatų puslapis atsiranda serveriuose, kurie juos naudoja, ir niekur kitur. Tai kitas klausimas nei būsenos puslapyje: anas klausia, kurie egg atsako į Valve užklausą, o tai daro ir Rust, ir Valheim, o šis klausia, kurie egg laiko GameUserSettings.ini ten, kur jį laiko ARK, o tai daro tik ARK. Pradžioje nieko nepažymėta, tyčia — papildinys negali žinoti, kaip pavadinai savo egg.',

    /* ------------------------------------------------ serverio puslapis -- */

    'nav_label' => 'Pasaulio nuostatos',
    'title' => 'ARK pasaulio nuostatos',
    'subheading' => 'Tos nuostatos, kurias žmonės iš tikrųjų keičia, iš GameUserSettings.ini.',

    'group_server' => 'Serveris',
    'group_server_helper' => 'Kaip serveris vadinasi, kas gali prisijungti ir kiek jų.',
    'group_rates' => 'Dažniai',
    'group_rates_helper' => 'Kaip greitai viskas vyksta. 1.0 yra žaidimas toks, koks ateina; 2.0 yra dukart greičiau.',
    'group_rules' => 'Taisyklės',
    'group_rules_helper' => 'Ką žaidėjams galima ir ką žaidimas jiems rodo.',

    'keeps' => 'Penkiolika nuostatų iš failo, kuriame jų yra šimtai. Visa kita jame — tavo modų nuostatos, raktai, apie kuriuos šis papildinys niekada negirdėjo, komentarai ir visa jų tvarka — lieka lygiai tokia, kokia yra, kai išsaugai.',
    'missing' => 'Šis serveris dar neturi GameUserSettings.ini. Žaidimas jį parašo per pirmą paleidimą, tad paleisk serverį vieną kartą, ir šis puslapis užsipildys.',
    'read_only' => 'Šį failą gali skaityti, bet ne rašyti, tad čia nieko pakeisti negalima.',

    'save' => 'Išsaugoti',
    'saved' => 'Išsaugota',
    'saved_restart' => 'ARK skaito šį failą paleidžiamas, tad paleisk serverį iš naujo, kad pakeitimas įsigaliotų.',
    'failed' => 'Nepavyko išsaugoti',
    'failed_write' => 'Demonas atmetė įrašymą. Patikrink, ar serveris pasiekiamas ir ar failas nėra tik skaitymui.',
];
