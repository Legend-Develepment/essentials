<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Sargas.
 *
 * Kiekviena žinutė iš čia skaitoma telefone, trečią nakties, to, kas prieš
 * minutę miegojo. Kiekviena sako, kuri mašina, kas negerai, ir nieko daugiau -
 * smulkmena priklauso tam puslapiui, kurį žmogus atsidarys paskui, o ne tai
 * eilutei, kuri jį pažadino.
 *
 * Tai, kad kažkas susitvarkė, parašyta kaip naujiena, o ne kaip išnaša. „Ar jau
 * grįžo“ yra tas klausimas, dėl kurio kitaip kas nors keltųsi.
 *
 * „Node“, „Wings“, „daemon“, „webhook“, „queue“, „Discord“ ir „SMTP“ lieka
 * angliškai: tais vardais juos randi Pelican, mašinoje ir visame, kas apie juos
 * rašoma.
 */

return [
    'title' => 'Įspėjimai',
    'nav_label' => 'Įspėjimai',
    'subheading' => 'Skydelis jau žino, kada node nustoja atsakinėti, kada diskas prisipildo, ar kada eilė sustoja. Tai yra tas dalykas, kuris tau apie tai pasako.',

    // ---- kanalai ir ką jie padarė paskutinį kartą -------------------------
    'channels' => 'Kur keliauja žinutės',
    'channels_helper' => 'Ką kiekvienas kanalas padarė paskutinį kartą, kai jo buvo paprašyta ką nors išsiųsti. Kanalas, kuris įjungtas ir tyliai atmeta, atrodo lygiai taip pat kaip skydelis, kuriame niekas nesugedę, ir todėl tai stovi puslapyje pirma.',

    'state_off' => 'Išjungtas',
    'state_untried' => 'Kol kas nieko nesiųsta',
    'state_ok' => 'Pristatyta',
    'state_failed' => 'Atmesta',

    // ---- kada --------------------------------------------------------------
    'when' => 'Kaip dažnai',
    'when_helper' => 'Patikrinimai veikia fone, tad jiems reikia queue worker. Be jo niekas nesiunčiama, ir niekas apie tai nepasako - naudokis „Siųsti bandymą“, kuris per eilę neina.',

    'every' => 'Tikrink kas',
    'every_helper' => 'Kiekvienas patikrinimas pasiekia kiekvieno node demoną, tad tai po vieną užklausą node ir ratui. Penkiolikos minučių pakanka, kad išgirstum apie sutrikimą, kol jis dar sutrikimas.',
    'every_off' => 'Išjungta - jokių patikrinimų',
    'every_five' => '5 minutės',
    'every_fifteen' => '15 minučių',
    'every_thirty' => '30 minučių',
    'every_hourly' => 'Valanda',
    'every_daily' => 'Para',

    'repeat' => 'Priminki man, kol tęsiasi',
    'repeat_helper' => 'Žinutė siunčiama, kai kas nors pasikeičia, ir dar viena, kai susitvarko. Tai prideda priminimą, kol bėda dar tęsiasi. Nulis reiškia be priminimų - kanalas, kuris kartojasi kas ketvirtį valandos, yra kanalas, kurį žmonės nutildo.',
    'hours' => 'valandas',

    // ---- kur ---------------------------------------------------------------
    'where' => 'Kanalai',
    'where_helper' => 'Daugiau nei vienas yra protinga. Jie genda skirtingais būdais.',

    'discord' => 'Discord',
    'discord_helper' => 'Vieta, kur žinutę iš tikrųjų perskaito tas, kas nesėdi ir nežiūri į skydelį.',
    'webhook' => 'Webhook adresas',
    'webhook_helper' => 'Discord: Serverio nustatymai → Integracijos → Webhooks → Naujas webhook → Kopijuoti webhook URL. Apribota iki https, nes tai paskelbia, kuri tavo mašina yra apačioje ir kiek pilnas jos diskas.',
    'bot' => 'Savas botas',
    'bot_helper' => 'Vienas pasirašytas JSON siuntimas į tavo paties prižiūrimą adresą, kad kažkas už skydelio ribų išgirstų apie nebeatsakantį node, užuot kas minutę klausinėjęs, ar tokio yra. Su Pelican ateinantys webhook to pranešti negali: jie suveikia nuo modelių ir nuo veiklos žurnalo, o node, kuris nustojo atsakinėti, neįrašo nei į vieną, nei į kitą.',
    'bot_url' => 'Kur jį siųsti',
    'bot_url_helper' => 'Apribota iki https, nes tai paskelbia adresu internete, kuri tavo mašina yra apačioje.',
    'bot_secret' => 'Parašo paslaptis',
    'bot_secret_helper' => 'Bendra su tuo, kas tai gauna. Turinys ja sumaišomas, o maiša keliauja X-Essentials-Signature antraštėje kaip sha256=<hex>, tad tavo botas gali atmesti viską, kas atėjo ne iš šio skydelio. Kol ši vieta tuščia, nieko nesiunčiama - nebūtinas parašas yra toks, kurio niekas netikrina.',

    'panel' => 'Skydelyje',
    'panel_helper' => 'Pranešimas visiems, turintiems šią teisę. Veikia visada, nereikalauja nustatymų, ir nematomas kiekvienam, kas neprisijungęs.',

    'email' => 'El. paštas',
    'email_helper' => 'Atskirti kableliais. Naudoja paties skydelio mailer - patikimą, kai jis sutvarkytas, ir visiškai nebylį, kai ne, o būtent tokio gedimo sargas turėti negali. Palik tuščią, kad išjungtum.',

    // ---- ką ----------------------------------------------------------------
    'what' => 'Ko stebima',
    'what_helper' => 'Kiekvienas matavimas čia yra toks, kurį skydelis šiaip jau atlieka. Niekas šiame puslapyje neatveria ryšio, kurio neatvertų Sistemos būsena.',

    'percent_helper' => 'Nulis išjungia šį patikrinimą.',
    'disk' => 'Įspėti, kai node diskas viršija',
    'memory' => 'Įspėti, kai node atmintis viršija',

    'maintenance' => 'Įspėti apie priežiūrą, trunkančią ilgiau nei',
    'maintenance_helper' => 'Node priežiūroje praleidžia visi kiti patikrinimai, ir tai teisinga - ir būtent taip apie vieną pamirštama keturiolikai dienų. Nulis tai išjungia.',

    'versions' => 'Skydelio ir Wings versijos',
    'versions_helper' => 'Viena žinutė, kai kas nors atsilieka, ir viena, kai vėl aktualu. Be priminimų - versija nėra sutrikimas.',

    'backups' => 'Atsilikusios atsarginės kopijos',
    'backups_helper' => 'Viena žinutė, įvardijanti serverius, o ne po vieną kiekvienam serveriui - kai suplanuota užduotis sustoja, visi serveriai pasensta iš karto, o keturiasdešimt atskirų žinučių dėl vienos priežasties yra kanalas, kurį žmonės nutildo. Iš pradžių išjungta: skydelis, kuris kopijuoja ranka, o ne pagal tvarkaraštį, girdėtų apie tai kasdien.',
    'backup_days' => 'Laikyti kopiją pasenusia po',
    'backup_days_helper' => 'Tą patį naudoja ir Atsarginių kopijų puslapis. Serverio, kopijuojamo kas savaitę, nereikia pranešti po aštuonių dienų.',
    'days' => 'dienų',

    'stock' => 'Besibaigiantys paketai',
    'stock_helper' => 'Viena žinutė, įvardijanti paketus, o ne po vieną kiekvienam paketui, ir niekada priminimo: išparduota yra įprasta parduotuvės būsena, o ne sutrikimas, ir girdėti apie tai kas keturias valandas yra būdas, kuriuo tokios žinutės nustoja būti skaitomos. Žiūrima tik į paketus, turinčius atsargų ribą, tad parduotuvę, kuri viską parduoda be ribos, stebėti nekainuoja nieko. Iš pradžių išjungta, kaip ir visa kita.',
    'stock_left' => 'Įspėti, kai lieka',
    'stock_left_helper' => 'Skaičiuojama nuo paketo atsargų ribos. Paketas turi nukristi iki šio skaičiaus ar žemiau, kad apie jį būtų įspėta, ir pakilti dviem vienetais virš jo, kad vėl būtų laikomas sveiku, tad tas, kurį pirkimas ir atšaukimas stumdo pirmyn atgal, nesako nieko. Nulis čia yra skaičius, o ne tuštuma: jis nutildo įspėjimą ir palieka tik tą žinutę, kuri sako, kad paketo nebeliko.',
    'stock_left_suffix' => 'ar mažiau',

    'worker' => 'Queue worker',
    'worker_helper' => 'Ar apskritai kas nors atlieka šio papildinio fono darbą. Pastebėk ratą: pats patikrinimas veikia eilėje, tad skydelis, kuris niekada neturėjo worker, apie tai net pranešti negali. Eilutė šio puslapio viršuje gali.',

    // ---- mygtukai ----------------------------------------------------------
    'save' => 'Išsaugoti',
    'saved' => 'Išsaugota',
    'save_failed' => 'Niekas nebuvo išsaugota',

    'test' => 'Siųsti bandymą',
    'test_one' => 'Išbandyti',
    'test_off' => 'Tas kanalas išjungtas',
    'test_off_body' => 'Įjunk jį ir išsaugok, ir jis bus išbandytas kartu su kitais.',
    'test_title' => 'Bandomoji žinutė',
    'test_body' => 'Jei tai skaitai, įspėjimai iš tavo Pelican skydelio atkeliauja čia. Niekas nėra sugedę.',
    'test_sent' => 'Išsiųsta kiekvienam įjungtam kanalui',
    'test_failed' => 'Bent vienas kanalas tai atmetė',
    'test_none' => 'Nėra kur siųsti',
    'test_none_body' => 'Nė vienas kanalas neįjungtas, tad ir tikras įspėjimas niekur nenukeliautų.',

    /*
     * Ką daryti su atmetimu.
     *
     * Tiekėjo paaiškinimas trumpas, teisingas ir pats savaime nenaudingas. Tie
     * du, kurie iškyla beveik kaskart, įvardyti vardais, nes nė vieno neįmanoma
     * atspėti iš kodo: 553 yra apie siuntėją, o ne apie gavėją, o 401 iš Discord
     * yra URL, kuris atšauktas arba surinktas su klaida.
     */
    'hint_email_sender' => 'Tavo SMTP serveris atmetė tą adresą, iš kurio skydelis siunčia, o ne tą, į kurį jis siuntė. Ties Admin → Nustatymai → El. paštas adresas Nuo turi būti pašto dėžutė, kaip kuri tavo SMTP paskyrai leidžiama siųsti. Su šiuo papildiniu tai neturi nieko bendro - paties Pelican bandomasis laiškas tame puslapyje lūžta lygiai taip pat.',
    'hint_email' => 'Žiūrėk ties Admin → Nustatymai → El. paštas. Bandomojo laiško mygtukas tame puslapyje naudoja tuos pačius nustatymus ir sako tą patį.',
    'hint_discord_url' => 'Discord neatpažino to webhook. Jis ištrintas, sukurtas iš naujo, arba įklijuotas ne visas - sukurk naują ties Serverio nustatymai → Integracijos → Webhooks ir nukopijuok visą URL.',
    'hint_discord' => 'Skydelis nepasiekė Discord. Jei šis skydelis yra už ugniasienės, blokuojančios išeinančias užklausas, šis kanalas iš čia veikti negali.',
    'hint_panel' => 'Niekas neturi tam teisės, arba pranešimo nepavyko išsaugoti. Žiūrėk ties Vaidmenys.',

    'run_now' => 'Vykdyti patikrinimus dabar',
    'run_started' => 'Tikrinama fone',
    'run_failed' => 'Patikrinimų nepavyko paleisti',

    'reset' => 'Pamiršk, ką jis žino',
    'reset_confirm' => 'Ištuština tai, ką kiekvienas patikrinimas pasakė paskutinį kartą. Kitas ratas mokosi nuo nulio ir nieko nesiunčia, tad bėda, kuri dar tęsiasi, pranešama ratu po jo. Naudokis tuo po to, kai išvedei iš darbo node, apie kurį sargas vis tebeburba.',
    'reset_done' => 'Ištuštinta',

    // ---- pačios žinutės ----------------------------------------------------
    'still' => 'Tęsiasi :for.',
    'cleared_body' => 'Taip stovėjo :for.',

    'for_unknown' => 'kurį laiką',
    'for_minutes' => ':count minutes',
    'for_hours' => ':count valandas',
    'for_days' => ':count dienas',

    'node_down' => ':node neatsako',
    'node_down_body' => 'Skydelis nepasiekia demono ties :node. Jame esantys serveriai nei pasileis, nei sustos, nei ką nors praneš, kol jis negrįš.',
    'node_up' => ':node vėl atsako',

    'node_disk' => ':node baigiasi diskas',
    'node_disk_body' => 'Diskas ties :node užpildytas :percent %, virš tavo nustatytų :limit %. Atsarginės kopijos ir serverių diegimai lūžta pirmieji, kai tai prisipildo.',
    'node_disk_over' => 'Diskas ties :node vėl žemiau ribos',

    'node_memory' => ':node baigiasi atmintis',
    'node_memory_body' => 'Atmintis ties :node panaudota :percent %, virš tavo nustatytų :limit %. Jame esančius serverius branduolys gali nužudyti anksčiau, nei kas nors apskritai praneš apie bėdą.',
    'node_memory_over' => 'Atmintis ties :node vėl žemiau ribos',

    'node_maintenance' => ':node ilgai yra priežiūroje',
    'node_maintenance_body' => ':node yra priežiūroje daugiau nei :hours valandas. Tuo tarpu jame niekas kitas netikrinama, ir būtent tokia yra visa esmė - bet verta žinoti, kad jis vis dar taip stovi.',
    'node_maintenance_over' => ':node išėjo iš priežiūros',

    'wings_behind' => 'Wings ties :node pasenęs',
    'wings_behind_body' => ':node paleidžia Wings :installed, o :latest jau išėjusi. Atnaujink jį pačiame node - skydelis neturi jokio būdo tai padaryti.',
    'wings_current' => 'Wings ties :node aktualus',

    'panel_behind' => 'Skydelis pasenęs',
    'panel_behind_body' => 'Šis skydelis paleidžia :installed, o :latest jau išėjusi.',
    'panel_current' => 'Skydelis aktualus',

    'and_more' => 'ir dar :count',

    'owners' => 'Pranešk žmonėms, kai mašina už jų serverio yra apačioje',
    'owners_helper' => 'Vienintelis patikrinimas čia, kuris rašo kam nors kitam, o ne tau. Kiekvieno serverio, esančio mašinoje, kuri nustojo atsakinėti, savininkas gauna vieną pranešimą skydelyje - varpelį, niekada ne laišką - ir vieną, kai ji grįžta. Niekada priminimo tarp jų: kartoti tai kas ketvirtį valandos visiems užimtame node yra būdas, kuriuo skydelio įspėjimai nustoja būti skaitomi. Subuser nepranešama; sprendžia, ką daryti, savininkas. Mašina jiems neįvardijama dėl tos pačios priežasties, dėl kurios jos neskelbia ir būsenos puslapis.',

    'owner_down' => '{1} Vienas tavo serveris yra apačioje|[2,*] Tavo serverių apačioje: :count',
    'owner_down_body' => 'Mašina, kurioje jie stovi, nustojo atsakinėti. Kam nors pranešta. Paliesti: :servers',
    'owner_up' => '{1} Tavo serveris grįžo|[2,*] Tavo serverių grįžo: :count',
    'owner_up_body' => 'Mašina vėl atsako. Atgal: :servers',

    'schedules' => 'Suplanuotos užduotys, kurios sustojo',
    'schedules_helper' => 'Užduotis, įstrigusi vykdymo viduryje, tokia, kurios laikas praėjo, nes cron neveikia, arba tokia, kuri niekada nebuvo vykdyta. Pelican neturi žodžio nė vienai iš jų - vykdymas, kuris nukrito, lieka „apdoroja“ amžiams ir piešiamas lygiai kaip tas, kuris veikia dabar. Kiekvieno patikrinimo metu perskaito kiekvieną aktyvią suplanuotą skydelio užduotį.',

    'schedule_stopped' => 'Sustojusių suplanuotų užduočių: :count',
    'schedule_stopped_body' => 'Įstrigusios daugiau nei :hours valandas, pavėlavusios, arba niekada nevykdytos: :schedules',
    'schedule_running' => 'Visos suplanuotos užduotys vėl veikia',

    'stock_out' => '{1} Paketas išparduotas|[2,*] Išparduotų paketų: :count',
    'stock_out_body' => 'Vis dar prekyboje, o parduoti nebėra ko: :packages',
    'stock_low' => '{1} Paketas beveik išparduotas|[2,*] Beveik išparduotų paketų: :count',
    'stock_low_body' => 'Liko :limit ar mažiau: :packages',
    'stock_back' => '{1} Paketas vėl parduodamas|[2,*] Vėl parduodamų paketų: :count',
    'stock_back_body' => 'Vėl yra ką parduoti: :packages',

    'backup_none' => 'Serverių, kurie niekada neturėjo atsarginės kopijos: :count',
    'backup_none_body' => 'Kopija niekada nebuvo daryta ties: :servers',
    'backup_none_over' => 'Dabar kiekvienas serveris turi kopiją',

    'backup_stale' => 'Serverių be kopijos jau kurį laiką: :count',
    'backup_stale_body' => 'Nėra sėkmingos kopijos :days dienas ties: :servers',
    'backup_stale_over' => 'Kiekvienas serveris neseniai turėjo kopiją',

    'backup_failed' => 'Atsarginės kopijos nepavyksta :count serveriuose',
    'backup_failed_body' => 'Kopija baigėsi be sėkmės ties: :servers',
    'backup_failed_over' => 'Nė viena atsarginė kopija daugiau nelūžta',

    'worker_missing' => 'Niekas nedirba prie eilės',
    'worker_missing_body' => 'Darbas buvo įtrauktas į eilę, ir niekas jo nepaėmė. Papildinių atnaujinimai, modpack diegimai ir šie patikrinimai visi sustoja, kol nepradės veikti worker - pabandyk systemctl status pelican-queue skydelio mašinoje.',
    'worker_back' => 'Prie eilės vėl dirbama',
    'failed_title' => 'Nuo paskutinio patikrinimo nepavykusių darbų: :count',
    'failed_body' => 'Kažkas, ką skydeliui buvo liepta padaryti, neįvyko ir nebus bandoma iš naujo - nesukurtas serveris, neišrašyta sąskaita, neišsiųstas laiškas. Jie guli failed_jobs lentelėje; `php artisan queue:retry all` juos sugrąžina, kai tik pataisoma tai, kas juos sustabdė.',
    'failed_back' => 'Nuo paskutinio patikrinimo nepavykusių darbų nebuvo',
    'failed' => 'Pranešti, kai nepavyksta eilės darbas',
    'failed_helper' => 'Laravel užrašo darbą, kurio atsisakė, ir nieko apie tai nepasako. Šitas pasako. Suskaičiuojama, o ne išvardijama: dvidešimt nepavykusių darbų per vieną naktį paprastai yra viena priežastis.',
];
