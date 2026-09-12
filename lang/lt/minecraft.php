<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Žaidimo režimai ir sudėtingumo lygiai neverčiami. Minecraft rodo juos žaidime
 * kaip Survival, Creative, Peaceful ir Hard - o nuostata, kuri vadinasi kitaip
 * nei ekranas, iš kurio ji atėjo, yra tokia, kurios ieškai du kartus.
 *
 * Tas pat su posakiais, stovinčiais pačiame server.properties: whitelist,
 * operator, seed, chunk, RCON, query, resource pack ir the Nether.
 */

return [
    /* ------------------------------------------- administravimo kortelė -- */

    'nav_label' => 'Minecraft',
    'title' => 'Minecraft nuostatos',
    'subheading' => 'Paties šio serverio server.properties, kaip forma vietoje tekstinio failo.',

    /*
     * Pati antraštė ne čia. Kiekvienas nuostatų skyrius savo antraštę ima iš
     * settings.groups.<pavadinimas>, kurią sudeda group().
     */
    'section_helper' => 'Kuriems egg tai galioja, ir visa kita, ką šis papildinys daro apie Minecraft.',

    'live' => 'Klausk serverių, kas žaidžia',
    'live_helper' => 'Prideda gyvą prisijungusiųjų sąrašą į Žaidėjų puslapį, tuo pačiu rankos paspaudimu, kurį daro Minecraft klientas, kad nupieštų serverį savo paties sąraše. Iš pradžių išjungta, nes tai vienintelis dalykas čia, kuris atveria ryšį iš skydelio tiesiai į žaidimo prievadą: jei tavo skydelis ir tavo node yra tinkluose, kurie vienas kito nepasiekia, niekas neatsako, ir eilutė tiesiog nepasirodo. Pačiame žaidimo serveryje nieko įjungti nereikia.',

    'eggs' => 'Kurie egg yra Minecraft',
    'eggs_helper' => 'Pažymėk tuos egg, kurie paleidžia Minecraft serverį - Vanilla, Paper, Purpur, Fabric, Forge, ir kaip tavieji dar vadinasi. Puslapis atsiranda serveriuose, kurie juos naudoja, ir niekur kitur. Pradžioje nieko nepažymėta, ir tai tyčia: papildinys negali žinoti, kaip pavadinai savo egg, o atspėtas sąrašas būtų klaidingas kažkieno skydelyje jau išleidimo savaitę.',

    /* ------------------------------------------------ serverio puslapis -- */

    'groups' => [
        'general' => 'Serveris',
        'players' => 'Žaidėjai',
        'world' => 'Pasaulis',
        'performance' => 'Našumas',
        'access' => 'Prieiga ir priedai',
        'other' => 'Visa kita faile',
    ],

    'other_helper' => 'Nuskaityta iš server.properties ir palikta lygiai tokia, kokia yra. Modai ir modpack-ai deda čia savo nuostatas; jos rodomos, kad matytum, jog jos egzistuoja, o keičiamos per failų tvarkyklę. Šio puslapio išsaugojimas jų niekada neliečia.',

    'reload' => 'Skaityk failą iš naujo',

    'saved' => 'Išsaugota į server.properties',
    'saved_helper' => 'Įsigalioja kitą kartą paleidus serverį.',

    'running' => 'Serveris veikia',
    'running_helper' => 'Minecraft skaito server.properties paleidžiamas ir įrašo jį atgal sustodamas, tad tai, kas išsaugota dabar, būtų perrašyta išeinant. Sustabdyk serverį ir išsaugok iš naujo.',

    'missing' => 'server.properties nerastas',
    'missing_helper' => 'Failas atsiranda, kai serveris paleidžiamas pirmą kartą. Paleisk jį vieną kartą ir grįžk.',

    'failed' => 'Nepavyko išsaugoti',
    'failed_helper' => 'Demonas atmetė įrašymą. Gali būti, kad serveris pasileido, kol šis puslapis buvo atidarytas.',

    /* ------------------------------------ ką reiškia kiekvienas raktas --- */

    'keys' => [
        'motd' => 'Žinutė serverių sąraše',
        'gamemode' => 'Žaidimo režimas',
        'difficulty' => 'Sudėtingumas',
        'hardcore' => 'Hardcore - mirtis galutinė',
        'force_gamemode' => 'Grąžink visus į numatytąjį režimą jiems įeinant',
        'pvp' => 'Žaidėjai gali vienas kitą sužeisti',

        'max_players' => 'Daugiausia žaidėjų vienu metu',
        'white_list' => 'Tik whitelist',
        'enforce_whitelist' => 'Išmesk kiekvieną, kurio nėra whitelist sąraše',
        'online_mode' => 'Tikrink paskyras pas Mojang',
        'player_idle_timeout' => 'Išmesk po tiek neveiklumo minučių',
        'op_permission_level' => 'Ką operator gali (1–4)',

        'level_name' => 'Pasaulio aplankas',
        'level_seed' => 'Seed',
        'level_type' => 'Pasaulio tipas',
        'allow_nether' => 'The Nether',
        'spawn_monsters' => 'Atsiranda pabaisos',
        'spawn_protection' => 'Apsaugoti blokai aplink spawn',

        'view_distance' => 'Matomumo atstumas chunk-ais',
        'simulation_distance' => 'Simuliacijos atstumas chunk-ais',
        'max_tick_time' => 'Watchdog, milisekundėmis (-1 jį išjungia)',
        'sync_chunk_writes' => 'Rašyk chunk-us tiesiai į diską',

        'enable_command_block' => 'Command block-ai',
        'allow_flight' => 'Leisti skraidyti',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Resource pack adresas',
        'require_resource_pack' => 'Resource pack privalomas',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
