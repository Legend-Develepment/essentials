<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Paketai: serveris, kurį kažkas gali nusipirkti.
 *
 * Tai skaito tas, kuris tvarko parduotuvę. Kiekvienas žodis čia yra apie
 * šabloną ir kainą; tai, ką mato pirkėjas, yra shop.php, nes šie du skaitytojai
 * nori skirtingų sakinių apie tą pačią eilutę.
 *
 * „egg", „node", „swap", „io" ir Minecraft žodžiai lieka angliški: tai žodžiai
 * iš paties Pelican serverio formos, o paketas yra ta pati forma, išsaugota
 * vėlesniam kartui.
 */

return [
    'title' => 'Paketai',
    'nav_label' => 'Paketai',
    'subheading' => 'Tai, kas parduodama. Kiekvienas yra serverio šablonas su kaina; pirkėjas nuperka vieną, ir skydelis sukuria serverį.',

    // ---- lentelė ---------------------------------------------------------
    'column_name' => 'Paketas',
    'column_egg' => 'Egg',
    'column_price' => 'Kaina',
    'column_stock' => 'Atsargos',
    'column_live' => 'Parduodamas',
    'column_orders' => 'Parduota',

    'live' => 'Parduodamas',
    'offline' => 'Neparduodamas',
    'no_egg' => 'Be egg — negalima sukurti',

    'stock_unlimited' => 'Neribotos',
    'stock_left' => 'Liko :count',
    'stock_out' => 'Išparduota',

    // ---- laikotarpiai ----------------------------------------------------
    'period_once' => 'Vienkartinis',
    'period_month' => 'Kas mėnesį',
    'period_quarter' => 'Kas ketvirtį',
    'period_year' => 'Kas metus',

    // Po kainos: „12,50 € per mėnesį".
    'per_once' => 'vienkartinai',
    'per_month' => 'per mėnesį',
    'per_quarter' => 'per ketvirtį',
    'per_year' => 'per metus',

    // ---- veiksmai --------------------------------------------------------
    'new' => 'Naujas paketas',
    'edit' => 'Redaguoti',
    'duplicate' => 'Dubliuoti',
    'copy_suffix' => ' (kopija)',
    'go_live' => 'Pradėti pardavinėti',
    'go_offline' => 'Nustoti pardavinėti',
    'delete' => 'Ištrinti',
    'delete_confirm' => 'Pašalina paketą. Tai, kas jau nupirkta, neliečiama — užsakymai saugo savo kopiją to, kuo buvo.',
    'delete_refused' => 'Neištrinta',
    'delete_refused_body' => 'Šiam paketui yra užsakymų, ir jie į jį rodo. Verčiau nustokite jį pardavinėti; jis lieka apskaitai, ir niekas negali jo nusipirkti.',
    'deleted' => 'Paketas ištrintas',
    'saved' => 'Paketas išsaugotas',
    'save_failed' => 'Paketo išsaugoti nepavyko',
    'price_invalid' => 'Tai ne suma. Užrašykite ją kaip 12.50 arba 12,50.',

    // ---- forma: kas tai yra ----------------------------------------------
    'section_basics' => 'Paketas',
    'section_basics_helper' => 'Tai, ką pirkėjas mato kortelėje.',
    'name' => 'Pavadinimas',
    'name_helper' => 'Kaip jis vadinasi parduotuvėje.',
    'slug' => 'Adresas',
    'slug_helper' => 'Mažosios raidės, skaitmenys ir brūkšneliai. Palikus tuščią, sudaromas iš pavadinimo. Pakeitus vėliau, sulaužoma nuoroda, kurią kažkas išsisaugojo.',
    'description' => 'Aprašymas',
    'description_helper' => 'Kelios eilutės po pavadinimu. Paprastas tekstas.',
    'live_field' => 'Parduodamas',
    'live_helper' => 'Išjungta laiko paketą čia ir niekam jo nerodo. Paketas be egg niekada nerodomas, kad ir kas čia būtų.',
    'sort' => 'Eiliškumas',
    'sort_helper' => 'Mažesnis skaičius parduotuvėje eina anksčiau.',

    // ---- forma: kuo jis tampa --------------------------------------------
    'section_server' => 'Serveris, kuriuo jis tampa',
    'section_server_helper' => 'Tie patys klausimai, kuriuos Pelican užduoda kuriant serverį ranka, čia atsakyti vieną kartą ir naudojami kiekvieno pardavimo metu.',
    'egg' => 'Egg',
    'egg_helper' => 'Pasirinkus vieną, užpildomas atvaizdas, paleidimo komanda ir kiekvienas kintamasis egg numatytosiomis reikšmėmis. Paskui keiskite, ką norite.',
    'image' => 'Docker atvaizdas',
    'image_helper' => 'Vienas iš atvaizdų, kuriuos siūlo egg.',
    'image_default' => 'Pirmasis egg atvaizdas',
    'startup' => 'Paleidimo komanda',
    'startup_helper' => 'Viena iš komandų, kurias siūlo egg.',
    'startup_default' => 'Pirmoji egg komanda',
    'environment' => 'Kintamieji',
    'environment_helper' => 'Egg kintamieji ir jų reikšmės. Viskas, ką egg turi ir kas čia neišvardyta, kuriant serverį gauna savo numatytąją reikšmę.',
    'env_key' => 'Kintamasis',
    'env_value' => 'Reikšmė',
    'nodes' => 'Node',
    'nodes_helper' => 'Kur galima sukurti serverį iš šio paketo — bandoma šia eile, kol vienas turės laisvą adresą. Nieko nepažymėta reiškia bet kurį node.',

    // ---- forma: ribos ----------------------------------------------------
    'section_limits' => 'Ribos',
    'section_limits_helper' => 'Tai, ką serveris gauna. Tie patys laukai kaip paties Pelican serverio formoje, tais pačiais vienetais.',
    'memory' => 'Atmintis',
    'disk' => 'Diskas',
    'cpu' => 'CPU',
    'cpu_helper' => 'Vienos branduolio dalies procentas: 100 yra vienas branduolys, 200 yra du, 0 yra be ribos.',
    'swap' => 'Swap',
    'swap_helper' => '0 yra nieko, -1 yra neribotai.',
    'io' => 'Blokinio IO svoris',
    'io_helper' => 'Pelican numatytoji reikšmė yra 500. Palikite taip, nebent žinote, kodėl ne.',
    'threads' => 'CPU pririšimas',
    'threads_helper' => 'Kurie branduoliai, kaip juos rašo Pelican: 0,1 arba 0-3. Tuščia yra bet kurie.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Ar branduolys gali sustabdyti serverį, kai jam pritrūksta atminties.',
    'databases' => 'Duomenų bazės',
    'allocations' => 'Papildomi allocation',
    'backups' => 'Atsarginės kopijos',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- forma: pinigai --------------------------------------------------
    'section_price' => 'Kaina ir atsargos',
    'section_price_helper' => 'Parduotuvės valiuta, nustatyta Parduotuvės nustatymų puslapyje. Be mokesčio — mokestis pridedamas prie sąskaitos atskira eilute.',
    'price' => 'Kaina',
    'price_helper' => 'Už laikotarpį. Užrašykite ją kaip 12.50 arba 12,50.',
    'setup_fee' => 'Įdiegimo mokestis',
    'setup_fee_helper' => 'Imamas vieną kartą, pirmoje sąskaitoje. Nulis reiškia jokio.',
    'period' => 'Sąskaitų išrašymas',
    'period_helper' => 'Vienkartinis apmokamas kartą ir pasiliekamas. Kiti kiekvieną laikotarpį gauna naują sąskaitą; neapmokėta sustabdo serverį po lengvatinio laikotarpio iš Parduotuvės nustatymų puslapio.',
    'stock' => 'Atsargos',
    'stock_helper' => 'Kiek gali būti parduota vienu metu, skaičiuojant kiekvieną neatšauktą užsakymą. Tuščia yra neribotai.',

    'empty' => 'Paketų kol kas nėra',
    'empty_body' => 'Sukurkite vieną, ir jis atsiranda parduotuvėje tą akimirką, kai pradedamas pardavinėti.',
];
