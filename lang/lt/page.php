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
    'update' => 'Atnaujinti',
    'update_available' => 'Yra atnaujinimas',
    'update_confirm' => 'Skydelis parsiunčia naują versiją, iš naujo sudeda savo asset ir išvalo savo podėlius. Tavo nuostatos išsaugomos.',
    'update_started' => 'Atnaujinimas pradėtas',
    'update_background' => 'Veikia fone ir užtrunka minutę ar dvi.',
    'update_failed' => 'Temos atnaujinti nepavyko',
    'update_done' => 'Tema atnaujinta',
    'check' => 'Tikrinti atnaujinimus',
    'check_failed' => 'Atnaujinimų srauto nepavyko nuskaityti',
    'check_failed_body' => 'Skydelis jo nepasiekė, arba jis negrąžino tinkamo JSON.',
    'up_to_date' => 'Esi ties naujausia versija',
    'reinstall' => 'Įdiegti iš naujo',

    'auto_on' => 'Atnaujinimai diegiasi patys',

    /*
     * Ką padarė paskutinis automatinis patikrinimas. Kiekvienas iš šių įvardija
     * tą dalį, į kurią vertėtų pažiūrėti, nes iš naršyklės visi trys būdai,
     * kuriais tai genda, atrodo vienodai: skaičius, skaičiuojantis atgal.
     */
    'auto_never' => 'Kol kas nė vienas patikrinimas nevyko. Automatiniams atnaujinimams reikia skydelio planuoklio — to cron įrašo, kuris kas minutę paleidžia php artisan schedule:run. Be jo apskritai niekas suplanuoto nevyksta.',
    'auto_ago' => 'Paskutinį kartą tikrinta :ago',
    'auto_just_now' => 'ką tik',
    'auto_minutes' => 'minutės prieš',
    'auto_current' => 'šiame kanale nieko naujesnio.',
    'auto_installed' => 'v:version čia įdiegta paties suplanuoto patikrinimo. Jis taip daro, kai nė vienas queue worker neatsako, tad atnaujinimas įvyksta šiaip ar taip — bet skydelis be worker yra toks, kuriame nevyksta ir kiti į eilę įtraukti darbai.',
    'auto_queued' => 'v:version perduota queue worker procesui. Jei aukščiau esanti versija per kelias minutes nepasikeis, worker darbus ima, bet šito atlikti jam nepavyksta — paprastai padeda paleisti jį iš naujo, o priežastis yra storage/logs.',
    'auto_unreachable' => 'atnaujinimų srauto nepavyko nuskaityti. Jis parsiunčiamas iš interneto, tad tai paprastai tinklo ar DNS bėda skydelio mašinoje.',
    'auto_error' => 'patikrinimas nepavyko. Priežastis yra storage/logs.',

    /*
     * Queue worker, kuris iš tikrųjų ir atlieka atnaujinimą. Pasakyta atskirai
     * nuo patikrinimo aukščiau, nes jie genda atskirai, o vaistas kiekvienam
     * kitas.
     */
    'worker_missing' => 'Nė vienas queue worker neatsakė. Atnaujinimai ir modpack diegimai įtraukiami į eilę, o atlieka juos worker procesas, tad kol nė vienas neveikia, jie tik užrašomi ir niekada neatliekami, be klaidos kur nors. Arba worker nėra, arba yra toks, kuris buvo paleistas prieš įdiegiant šį papildinį ir negali įkelti jo kodo — abu gydomi paleidžiant jį iš naujo skydelio mašinoje. Nustatyk jo tarnybą paleisti save iš naujo, kitaip tai grįžta po kiekvieno atnaujinimo.',

    'next_check' => 'Kitas patikrinimas po',
    'due_now' => 'dabar',

    /*
     * Pavadinta pagal priežastį, o ne pagal simptomą, nes simptomas yra „nieko
     * neįvyko“, ir būtent tai darė šitą sunkiai randamą: skelbimai, navigacijos
     * nuorodos, išsaugoti stiliai ir puslapių išdėstymai visi yra failai po
     * storage/app, o katalogas, į kurį skydelis negali rašyti, praranda
     * kiekvieną iš jų be žodžio.
     */
    'storage_failed' => 'Skydelis negalėjo rašyti į savo storage katalogą, tad tai nebuvo išsaugota. Patikrink, ar storage/app priklauso tam naudotojui, kaip kuris veikia skydelis. Priežastis yra storage/logs.',

    /*
     * Pasakyta po kiekvieno nepavykusio atnaujinimo, o ne tik po neatitikimo.
     * Žinutė aukščiau jau įvardija priežastį; ši įvardija tą vienintelį vaistą,
     * prie kurio žmogus neprieina iš „laukiau X, gavau Y“.
     */
    'update_renamed' => 'Jei čia rašoma, kad du identifikatoriai nesutampa, papildinys buvo pervadintas, ir nė vienas atnaujinimas per tai nepereis — Pelican atpažįsta įdiegtą papildinį pagal jo identifikatorių. Pašalink seną įrašą ties Admin → Plugins ir įdiek šį iš naujo. Tavo nuostatos išlieka: jos gyvena .env ir storage/app/private/legend-theme, ir nė viena nėra susieta su identifikatoriumi.',
];
