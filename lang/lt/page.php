<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Queue worker“, „cron“, „storage“ ir keliai lieka lygiai tokie, kokie rašomi
 * skydelio mašinoje: būtent taip jie ir surenkami apvalkale.
 */

return [
    'title' => 'Essentials nuostatos',
    'nav_label' => 'Essentials nuostatos',
    'save' => 'Išsaugoti',
    'saved' => 'Nuostatos išsaugotos',
    'save_failed' => 'Nuostatų išsaugoti nepavyko',
    'secret_kept' => 'Išsaugota. Palikite tuščią, kad išliktų, arba įveskite naują.',
    'update_background' => 'Veikia fone ir užtrunka minutę ar dvi.',

    /*
     * Queue worker ir planuoklis (scheduler), nuo kurių priklauso kiekviena
     * foninė užduotis ir kiekviena suplanuota užduotis. Pasakyta atskirai, nes
     * jie genda atskirai, o vaistas kiekvienam kitas.
     */
    'worker_missing' => 'Nė vienas queue worker neatsakė. Modpack diegimai, laiškai ir kiti foniniai darbai įtraukiami į eilę, o atlieka juos worker procesas, tad kol nė vienas neveikia, jie tik užrašomi ir niekada neatliekami, be klaidos kur nors. Arba worker nėra, arba yra toks, kuris buvo paleistas prieš įdiegiant šį papildinį ir negali įkelti jo kodo - abu gydomi paleidžiant jį iš naujo skydelio mašinoje. Nustatyk jo tarnybą paleisti save iš naujo, kitaip tai grįžta po kiekvieno atnaujinimo.',
    'cron_missing' => 'Skydelio planuoklis nepasileido jau :for minučių. Prenumeratų atnaujinimai ir watchdog patikrinimai jo laukia. Cron eilutė yra Pelican dokumentacijoje.',

    /*
     * Pavadinta pagal priežastį, o ne pagal simptomą, nes simptomas yra „nieko
     * neįvyko“, ir būtent tai darė šitą sunkiai randamą: skelbimai, navigacijos
     * nuorodos, išsaugoti stiliai ir puslapių išdėstymai visi yra failai po
     * storage/app, o katalogas, į kurį skydelis negali rašyti, praranda
     * kiekvieną iš jų be žodžio.
     */
    'storage_failed' => 'Skydelis negalėjo rašyti į savo storage katalogą, tad tai nebuvo išsaugota. Patikrink, ar storage/app priklauso tam naudotojui, kaip kuris veikia skydelis. Priežastis yra storage/logs.',
];
