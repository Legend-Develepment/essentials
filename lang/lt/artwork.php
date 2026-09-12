<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Steam App ID“, „IGDB“, „Twitch client ID“ ir „client secret“ lieka
 * angliškai: būtent tie žodžiai stovi tuose puslapiuose, iš kurių reikšmės
 * ateina.
 */

return [
    'title' => 'Egg paveikslėliai',
    'nav_label' => 'Egg paveikslėliai',
    'subheading' => 'Žaidimų paveikslėliai tavo egg, parsiųsti iš Steam ir IGDB. Egg be paveikslėlio rodo paties Pelican paukštį kiekvienoje jį naudojančio serverio kortelėje.',

    // ---- lentelė ---------------------------------------------------------
    'column_name' => 'Egg',
    'column_steam' => 'Steam App ID',
    'column_locked' => 'Užrakinta',

    'locked' => 'Užrakinta',
    'unlocked' => 'Atverta',

    // ---- ką galima padaryti su viena eilute ------------------------------
    'fetch_steam' => 'Steam',
    'app_id' => 'Steam App ID',
    'app_id_helper' => 'Skaičius žaidimo Steam parduotuvės adrese - store.steampowered.com/app/892970 yra 892970. Parsiuntimas pagal identifikatorių užrakina paveikslėlį, nes įvesti skaičių yra sprendimas, o vėlesnis masinis paleidimas neturi teisės jo atšaukti.',

    'fetch_igdb' => 'IGDB',
    'search_term' => 'Ieškoti',
    'search_term_helper' => 'Egg pavadinimas užpildytas, bet tai retai yra žaidimo pavadinimas - „Paper 1.20.4“ yra Minecraft. Įrašyk žaidimą.',

    'lock' => 'Užrakinti',
    'unlock' => 'Atrakinti',
    'locked_done' => 'Užrakinta - masinis parsiuntimas šio nelies',
    'unlocked_done' => 'Atrakinta - masinis parsiuntimas gali pakeisti šį paveikslėlį',

    'clear' => 'Išvalyti',
    'clear_confirm' => 'Pašalina paveikslėlį ir Steam App ID. Egg grįžta prie paties Pelican paukščio, o kitas masinis parsiuntimas bandys iš naujo.',
    'cleared' => 'Paveikslėlis pašalintas',

    // ---- rezultatai ------------------------------------------------------
    'fetched' => 'Paveikslėlis išsaugotas',
    'failed' => 'Nė vienas paveikslėlis neišsaugotas',

    /*
     * Po vieną priežastį kiekvienam, nes tai skirtingos bėdos.
     *
     * Parsiuntimas, kuris nepavyko dėl rašybos klaidos, ir toks, kuris nepavyko,
     * nes diskas pilnas, neturi abu sakyti „nepavyko“ - pirmas gydomas žvilgsniu
     * į skaičių, antras žvilgsniu į serverį.
     */
    'why_bad_id' => 'Tai ne Steam App ID.',
    'why_not_found' => 'Steam tuo adresu nieko neturi. Patikrink App ID - žaidimas be parduotuvės puslapio neturi ir antraštinio paveikslėlio.',
    'why_no_match' => 'Tuo pavadinimu nieko nerasta. Pabandyk tai, kaip žaidimas iš tikrųjų vadinasi, o ne tai, kaip vadinasi egg.',
    'why_no_name' => 'Nėra ko ieškoti.',
    'why_no_token' => 'Twitch nesutiko išduoti token. Patikrink client ID ir secret ties Prisijungimo duomenys.',
    'why_not_configured' => 'IGDB reikia Twitch client ID ir secret. Nustatyk juos ties Prisijungimo duomenys.',
    'why_empty' => 'Atsakymas buvo tuščias.',
    'why_large' => 'Tas paveikslėlis kur kas didesnis už piktogramą ir nebuvo išsaugotas.',
    'why_not_an_image' => 'Tai, kas grįžo, nėra paveikslėlis. Paprastai tai reiškia, kad klaidos puslapis atsakė sėkmės kodu.',
    'why_wrong_format' => 'Tas paveikslėlis yra formato, kurio šis skydelis nesaugo. Pelican laiko PNG, JPEG ir WebP.',
    'why_unwritable' => 'Paveikslėlio nepavyko įrašyti. Patikrink, ar storage/app/public priklauso tam naudotojui, kaip kuris veikia skydelis, ir ar buvo paleista php artisan storage:link.',
    'why_unknown' => 'Nepavyko, o priežastis nėra iš tų, kurioms tai turi vardą.',

    // ---- viskas iš karto -------------------------------------------------
    'bulk' => 'Parsiųsti visus trūkstamus',
    'bulk_confirm_steam' => 'Ieško Steam pagal pavadinimą kiekvienam egg, kuris neturi paveikslėlio ir nėra užrakintas. Užrakinti egg ir tie, kurie paveikslėlį jau turi, paliekami ramybėje. Tai veikia fone - būsi informuotas, kai baigsis.',
    'bulk_confirm_both' => 'Ieško Steam pagal pavadinimą kiekvienam egg, kuris neturi paveikslėlio ir nėra užrakintas, o paskui bando IGDB tam, ko Steam nerado. Užrakinti egg ir tie, kurie paveikslėlį jau turi, paliekami ramybėje. Tai veikia fone - būsi informuotas, kai baigsis.',

    'bulk_started' => 'Parsiunčiama fone',
    'bulk_started_body' => 'Dideliame skydelyje tai gali užtrukti kelias minutes. Gauni pranešimą, kai bus atlikta, ir gali palikti šį puslapį.',

    'bulk_done' => 'Egg paveikslėliai baigti',
    'bulk_done_body' => ':fetched parsiųsta, :skipped palikta ramybėje, :failed be radinio. Egg paliekamas ramybėje, kai jis užrakintas arba jau turi paveikslėlį.',

    'bulk_failed' => 'Masinis parsiuntimas neįvyko',
    'bulk_failed_queue' => 'Jo nepavyko perduoti eilei. Tam reikia queue worker - patikrink, ar pelican-queue veikia.',

    // ---- IGDB prisijungimo duomenys --------------------------------------
    'credentials' => 'Prisijungimo duomenys',
    'credentials_helper' => 'Steam veikia be nė vieno iš jų. Jie reikalingi tik IGDB, kuris apima tuos žaidimus, apie kuriuos Steam niekada negirdėjo - Minecraft ir kiekvieną jo atšaką, viską, kas išėjo konsolėje, daugumą egg su modais.',
    'credentials_where' => 'Susikurk programą adresu dev.twitch.tv/console, sugeneruok client secret ir įklijuok abu čia. Tai nemokama.',
    'client_id' => 'Twitch client ID',
    'client_secret' => 'Twitch client secret',
    'credentials_saved' => 'Prisijungimo duomenys išsaugoti',
    'credentials_failed' => 'Prisijungimo duomenų išsaugoti nepavyko',
];
