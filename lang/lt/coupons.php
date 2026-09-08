<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Nuolaidų kodai: kodai, kurie nuima kažką nuo pirmosios sąskaitos.
 *
 * Tik nuo pirmosios, tyčia, ir tekstas tai pasako ten, kur tai svarbu. Kodas,
 * kuris atpigintų ir kiekvieną atnaujinimą, būtų kainos pakeitimas su pabaigos
 * data, o kas to nori, tegu keičia kainą.
 */

return [
    'title' => 'Nuolaidų kodai',
    'nav_label' => 'Nuolaidų kodai',
    'subheading' => 'Kodai, kurie nuima procentą arba sumą nuo pirmosios sąskaitos. Atnaujinimai eina paketo kaina.',

    // ---- lentelė ---------------------------------------------------------
    'column_code' => 'Kodas',
    'column_value' => 'Vertė',
    'column_uses' => 'Panaudota',
    'column_expires' => 'Baigia galioti',
    'column_packages' => 'Taikoma',
    'column_live' => 'Įjungtas',

    'never_expires' => 'Be pabaigos datos',
    'all_packages' => 'Viskam',
    'some_packages' => 'Paketų: :count',
    'usable' => 'Šiuo metu tinka naudoti',
    'unusable' => 'Išjungtas, pasibaigęs arba išnaudotas',

    // ---- mygtukai --------------------------------------------------------
    'new' => 'Naujas kodas',
    'edit' => 'Redaguoti',
    'delete' => 'Ištrinti',
    'delete_confirm' => 'Pašalina kodą. Sąskaitos, kurios jį jau panaudojo, išlaiko savo nuolaidą - kiekviena pati saugo, kiek jai buvo nuimta.',
    'deleted' => 'Kodas ištrintas',
    'saved' => 'Kodas išsaugotas',
    'save_failed' => 'Kodo nepavyko išsaugoti',
    'taken' => 'Tą kodą jau naudoja kažkas kitas.',
    'invalid' => 'Procentas yra sveikasis skaičius nuo 1 iki 100. Suma rašoma kaip 12.50 arba 12,50.',

    // ---- forma -----------------------------------------------------------
    'section_code' => 'Kodas',
    'section_code_helper' => 'Tai, ką klientas įveda užsakydamas.',
    'code' => 'Kodas',
    'code_helper' => 'Saugomas ir lyginamas didžiosiomis raidėmis be tarpų, kad veiktų, kad ir kaip jį kas užrašytų.',
    'live' => 'Įjungtas',
    'live_helper' => 'Išjungus kodas nustoja veikti, bet nėra ištrinamas: jis išeina iš apyvartos, o nuolaida, kurią davė, lieka tose sąskaitose, kurios ją turėjo.',

    'section_worth' => 'Kiek nuima',
    'section_worth_helper' => 'Tik nuo pirmosios sąskaitos. Niekada nenuveda sąskaitos žemiau nulio.',
    'kind' => 'Rūšis',
    'kind_helper' => 'Kainos dalis arba pastovi suma.',
    'kind_percent' => 'Procentas',
    'kind_fixed' => 'Pastovi suma',
    'value' => 'Vertė',
    'value_percent_helper' => 'Sveikasis skaičius nuo 1 iki 100.',
    'value_fixed_helper' => 'Parduotuvės valiuta. Rašykite kaip 12.50 arba 12,50.',

    'section_limits' => 'Ribos',
    'section_limits_helper' => 'Viskas čia neprivaloma. Kodas be nė vienos iš jų galioja viskam, visiems, visada.',
    'max_uses' => 'Kiek kartų galima panaudoti',
    'max_uses_helper' => 'Skaičiuojama pateikiant užsakymą, o ne apmokant sąskaitą - kitaip dešimties panaudojimų kodą būtų galima pateikti šimtą kartų per naktį.',
    'expires' => 'Baigia galioti',
    'expires_helper' => 'Po šio momento kodas nustoja veikti. Tuščia reiškia, kad taip niekada nenutinka.',
    'packages' => 'Paketai',
    'packages_helper' => 'Nieko nepažymėta reiškia kiekvieną paketą, dabar ir vėliau.',

    'empty' => 'Kodų kol kas nėra',
    'empty_body' => 'Sukurkite vieną, ir jis veiks užsakant, vos tik bus įjungtas.',
];
