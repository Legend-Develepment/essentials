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
    'column_flags' => 'Žymos',
    'column_flags_from' => 'nuo :count',
    'column_egg' => 'Egg',
    'column_price' => 'Kaina',
    'column_stock' => 'Atsargos',
    'column_live' => 'Parduodamas',
    'column_orders' => 'Parduota',

    'live' => 'Parduodamas',
    'offline' => 'Neparduodamas',
    'no_egg' => 'Be egg - negalima sukurti',

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
    'delete_confirm' => 'Pašalina paketą. Tai, kas jau nupirkta, neliečiama - užsakymai saugo savo kopiją to, kuo buvo.',
    'delete_confirm_sold' => 'Parduota kartų: :count. Tos paslaugos neliečiamos: užsakymas turi savo kopiją visko, su kuo buvo parduotas, todėl serveriai toliau veikia, o sąskaitos ir toliau sako, kas buvo nupirkta. Dingsta tik paveikslėlis ant jų paslaugos kortelės, ir paketas nustoja būti parduodamas.',
    'delete_refused' => 'Neištrinta',
    'delete_refused_body' => 'Šiam paketui yra užsakymų, ir jie į jį rodo. Verčiau nustokite jį pardavinėti; jis lieka apskaitai, ir niekas negali jo nusipirkti.',
    'deleted' => 'Paketas ištrintas',
    'deleted_sold' => 'Iš jo parduotos paslaugos, kurių yra :count, lieka nepaliestos ir toliau veikia.',
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
    'nodes_helper' => 'Kur galima sukurti serverį iš šio paketo - bandoma šia eile, kol vienas turės laisvą adresą. Nieko nepažymėta reiškia bet kurį node.',
    'upgrade_to' => 'Galima pakeisti į',
    'upgrade_to_helper' => 'Į kuriuos paketus galima perkelti veikiančią šio paketo paslaugą - aukštyn ar žemyn. Išvardijami tik tie paketai, kurie naudoja tą patį egg, nes kitas egg yra kitas serveris, o ne didesnis. Nieko nepažymėta reiškia, kad nuo šio paketo pereiti negalima.',
    'upgrade_to_none' => 'Kol kas nė vienas kitas paketas šio egg nenaudoja.',

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
    'section_price_helper' => 'Parduotuvės valiuta, nustatyta Parduotuvės nustatymų puslapyje. Be mokesčio - mokestis pridedamas prie sąskaitos atskira eilute.',
    'price' => 'Kaina',
    'price_helper' => 'Už laikotarpį. Užrašykite ją kaip 12.50 arba 12,50.',
    'setup_fee' => 'Įdiegimo mokestis',
    'setup_fee_helper' => 'Imamas vieną kartą, pirmoje sąskaitoje. Nulis reiškia jokio.',
    'period' => 'Sąskaitų išrašymas',
    'period_helper' => 'Vienkartinis apmokamas kartą ir pasiliekamas. Kiti kiekvieną laikotarpį gauna naują sąskaitą; neapmokėta sustabdo serverį po lengvatinio laikotarpio iš Parduotuvės nustatymų puslapio.',
    'stock' => 'Atsargos',
    'stock_helper' => 'Kiek gali būti parduota vienu metu, skaičiuojant kiekvieną neatšauktą užsakymą. Tuščia yra neribotai.',
    'term' => 'Minimalus terminas',
    'term_helper' => 'Kiek laiko žmogus įsipareigoja, kai nusiperka. Nulis reiškia jokio įsipareigojimo: jis gali atšaukti, ir viskas sustoja apmokėto laikotarpio pabaigoje.',
    'term_unit' => 'Skaičiuojama',
    'term_unit_helper' => 'Dienomis, mėnesiais arba metais. Atšauktas užsakymas veikia iki šio termino pabaigos, ir tą dieną serveris ištrinamas.',
    'unit_day' => 'Dienos',
    'unit_month' => 'Mėnesiai',
    'unit_year' => 'Metai',
    'term_day' => 'Minimalus terminas: :count dienų',
    'term_month' => 'Minimalus terminas: :count mėnesių',
    'term_year' => 'Minimalus terminas: :count metų',
    'section_art' => 'Paveikslėlis',
    'section_art_helper' => 'Paveikslėlis ant paketo kortelės, parduotuvėje ir kliento paslaugose. Palikus abu tuščius, naudojamas paties egg paveikslėlis, kurį dauguma paketų jau turi.',
    'art_file' => 'Įkelkite paveikslėlį',
    'art_file_helper' => 'Verčiau platus nei aukštas: kortelė apkerpa jį iki 16:9. Iki 8 MB.',
    'art_url' => 'Arba paveikslėlio adresas',
    'art_url_helper' => 'Pilnas https adresas. Naudojamas, kai aukščiau nieko neįkelta.',

    'empty' => 'Paketų kol kas nėra',
    'section_ask' => 'Paklauskite pirkėjo',
    'section_ask_helper' => 'Klausimai, pateikiami užsakymo lange, į kuriuos atsakoma prieš pateikiant užsakymą. Atsakymai pasiekia serverį, kai jis sukuriamas.',
    'ask_vars' => 'Kintamieji, kurių klausti',
    'ask_vars_helper' => 'Paties egg kintamieji. Pažymėkite vieną, ir pirkėjas jį užpildys pirkdamas, o jo atsakymas bus panaudotas vietoj šio paketo reikšmės. Nepažymėjus nieko, pirkėjo nieko neklausiama.',
    'upload_ask' => 'Prašyti failo',
    'upload_ask_helper' => 'Zip, kurį pirkėjas įkelia pirkdamas - pasaulis, modpack, nustatymų rinkinys. Jis įdedamas į jo serverį, kai šis sukuriamas, dar prieš pranešant, kad serveris paruoštas.',
    'upload_label' => 'Kaip jį vadinti',
    'upload_label_helper' => 'Užrašas virš failo lauko, jūsų pačių žodžiais. Tuščias reiškia paprastą užrašą.',
    'upload_dir' => 'Kurioje serverio vietoje',
    'upload_dir_helper' => 'Kelias serverio viduje, pavyzdžiui / arba /world. Prieš naudojant jis padaromas saugus.',
    'upload_extract' => 'Išpakuoti',
    'upload_extract_helper' => 'Įjungta - zip išpakuojamas ten, kur nukrenta, o pats archyvas pašalinamas; taip reikia pasauliui ar nustatymų rinkiniui. Išjungta - zip paliekamas failu, o būtent to nori egg, kuris iš jo įdiegia modpack.',
    'empty_body' => 'Sukurkite vieną, ir jis atsiranda parduotuvėje tą akimirką, kai pradedamas pardavinėti.',
    'popular' => 'Parodyti į šį',
    'popular_helper' => 'Pažymi jį kaip tą, kurį renkasi dauguma. Parduotuvėje jis pakyla aukščiau, po viskuo, kas su nuolaida, ir gauna mažą žymą. Tai ne teiginys apie pardavimų skaičius - tai pardavėjo mostas ranka.',
    'offer' => 'Su nuolaida',
    'offer_helper' => 'Perkelia jį į parduotuvės priekį su žyma ir nuima nuo jo kainos žemiau nurodytą nuolaidą.',
    'offer_kind' => 'Nuolaida kaip',
    'offer_percent' => 'Procentai',
    'offer_amount' => 'Suma',
    'offer_value' => 'Kiek nuleisti',
    'offer_value_percent' => 'Kainos procentai, tad 20 reiškia penktadaliu pigiau.',
    'offer_value_amount' => 'Suma parduotuvės valiuta, tad 2,50 reiškia dviem su puse pigiau.',
    'offer_min' => 'Tik nuo tiek prekių',
    'offer_min_helper' => 'Koks pilnas turi būti krepšelis, kad nuolaida imtų galioti; skaičiuojama viskas jame, o ne vien šis paketas. Nulis arba vienas reiškia, kad galioja visada. Du yra priežastis įsidėti antrą daiktą.',
];
