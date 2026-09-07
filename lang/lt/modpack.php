<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Modpack“, „mod“ ir „loader“ lieka: tai Modrinth ir žaidimo žodžiai, ir
 * būtent jų ir ieškoma.
 */

return [
    'nav_label' => 'Modpack-ai',
    'title' => 'Modpack-ai',
    'subheading' => 'Įdiek modpack iš Modrinth į šį serverį.',

    'section' => 'Surask paketą',
    'section_helper' => 'Tik Modrinth, ir tik serverio pusės paketai. Nereikia nei paskyros, nei API rakto, todėl tai čia vienintelis šaltinis — kiti visi nori įklijuoto rakto, kol apskritai kas nors pasirodys.',

    'search' => 'Paieška',
    'search_helper' => 'Palik tuščią, kad gautum daugiausiai atsisiųstus. Paieška klausia Modrinth, tad ji vyksta, kai išeini iš lauko, o ne rašant.',

    'pack' => 'Paketas',
    'pack_helper' => 'Išvardijami tik tie paketai, kurie sako, kad veikia serveryje.',

    'version' => 'Versija',
    'version_helper' => 'Žaidimo versija ir loader matomi šalia kiekvienos. Pasirink tą loader, kurį šio serverio egg jau paleidžia — tai įdiegia failus ir nekeičia nei tavo egg, nei paleidimo komandos.',

    'downloads' => 'atsisiuntimų',

    'install' => 'Įdiegti šį paketą',
    'install_go' => 'Įdiegti jį',
    'install_confirm' => 'Paketo failai pridedami prie šio serverio. **Niekas neištrinama** — nei tavo pasaulis, nei tavo seni modai, nei kokia konfigūracija. Paketas, įdiegtas ant kito, palieka abu, tad pirma pats pašalink ankstesnio paketo modus, jei to nori. Serveris turi būti sustabdytas ir lieka sustabdytas.',

    'started' => 'Diegiama',
    'started_helper' => 'Paketas atsisiunčiamas ir išpakuojamas. Keli šimtai failų užtrunka kelias minutes, ir gausi pranešimą, kai baigsis — tęsiasi, net jei paliksi šį puslapį.',

    'running' => 'Serveris veikia',
    'running_helper' => 'Minecraft įkelia savo modus paleidžiamas, tad paketas, įdiegtas dabar, paliktų serverį, kuris nėra nei senasis, nei naujasis paketas, iki paleidimo iš naujo. Sustabdyk jį ir bandyk vėl.',

    'done' => ':pack įdiegtas',
    'done_body' => 'Atsisiųsta failų: :files, ir į vietą sudėta elementų iš paties paketo aplanko: :overrides. Paleisk serverį, kai būsi pasiruošęs.',
    'done_refused' => 'Praleista failų: :count, nes paketas prašė jų iš vietos, iš kurios tai neatsisiunčia.',

    'failed' => 'Paketas nebuvo įdiegtas',
    'failed_fetch' => 'Paketo nepavyko atsisiųsti ar išpakuoti. Gali būti, kad demonas nepasiekiamas, arba serveryje baigėsi vieta diske.',
    'failed_index' => 'Paketas buvo atsiųstas, bet jame nebuvo skaitomo indekso, tad nebuvo ką diegti.',
    'failed_version' => 'Ta versija nebeturi paketo failo atsisiuntimui. Pasirink kitą.',
    'failed_queue' => 'Diegimo nepavyko įtraukti į eilę. Tam skydelyje turi veikti queue worker.',
];
