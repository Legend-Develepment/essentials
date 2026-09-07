<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Subuser“, „Wings“, „SFTP“, „cron“ ir „root admin“ lieka: tai Pelican ir
 * mašinos žodžiai, ir būtent jų ieško tas, kas eis tikrinti eilutės.
 */

return [
    'nav_label' => 'Prieiga prie serverių',
    'title' => 'Serveriai pagal vaidmenį',
    'subheading' => 'Suteik visiems, kas turi vieną vaidmenį, prieigą prie tų pačių serverių.',

    /*
     * Pasakyta prieš visa kita puslapyje, nes tai čia vienintelė galimybė, kuri
     * rašo į lentelę, priklausančią Pelican.
     */
    'more' => 'Kaip tai veikia',
    'warning' => 'Tai veikia taip, kad palaiko pačius Pelican subuser įrašus aktualius — tas pačias eilutes, kurias pridėtum ranka serverio Users puslapyje, ir būtent jas skaito serverių sąrašas, teisių patikros ir Wings. Liečia tik tas eilutes, kurias pati sukūrė: nieko, ką pridėjai ranka, niekada nekeičia ir nešalina. Niekas negauna laiško, kai vaidmuo duoda jam serverį. Prieigos atėmimas taip pat panaikina jų SFTP, o tam reikia to queue worker, kurio Pelican šiaip jau prašo.',

    'never' => 'Kol kas niekas nesuderinta. Išsaugok žemiau vieną susiejimą, ir tai įvyks iškart, o po to kas minutę per paties skydelio cron.',
    'timing' => 'Prieiga atimama tą akimirką, kai turi būti: kas praranda vaidmenį, praranda serverius jau kitame savo puslapyje. Suteikimas gali užtrukti iki minutės, nes tai tas praėjimas, kuris ieško tų, kas šiuo metu skydeliu nesinaudoja.',
    'last_run' => 'Paskutinis vykdymas prieš :ago sekundes: :added pridėta, :removed pašalinta, :held palikta.',
    'capped' => 'Per daug iš karto — :pairs suteikimų, o riba yra :max. Niekas nebuvo įrašyta. Susiaurink susiejimą: vaidmuo su penkiasdešimt žmonių ir dvidešimt serverių pats vienas yra tūkstantis suteikimų.',

    'which' => 'Susiejimai',
    'which_helper' => 'Vaidmuo, serveriai, kuriuos kiekvienas jo turėtojas turėtų pasiekti, ir ką jam ten galima. Kas yra dviejuose vaidmenyse, gauna viską, ką duoda abu. Serverių savininkai ir root admin praleidžiami — jie jau turi daugiau, nei tai galėtų duoti.',
    'add' => 'Pridėti vaidmenį',

    'role' => 'Vaidmuo',
    'role_helper' => 'Kiekvienas, kas jį turi, įskaitant tą, kas gaus jį vėliau.',
    'servers' => 'Serveriai',
    'servers_helper' => 'Serveriai, kuriuos jie gauna. Pašalinti vieną iš čia reiškia tą prieigą vėl atimti.',

    'permissions' => 'Ką jiems galima',
    'permissions_helper' => 'Pačios Pelican subuser teisės. Palik jas tokias, kokios yra, protingam rinkiniui: konsolė, maitinimo mygtukai, failai, atsarginės kopijos ir veiklos žurnalas — ir nieko, kas redaguotų serverį, jo naudotojus, jo duomenų bazes ar jo allocation. Connect to websocket visada įtrauktas, nes be jo konsolės puslapis prie nieko neprisijungia.',

    'save' => 'Išsaugoti ir pritaikyti',
    'saved' => 'Išsaugota',
    'saved_body' => ':added suteikta, :removed atimta atgal.',
    'save_failed' => 'Nepavyko išsaugoti',
    'save_failed_disk' => 'Sąrašo nepavyko įrašyti į storage. Patikrink, ar storage/app priklauso tam naudotojui, kaip kuris veikia skydelis.',

    'revoke' => 'Atimti viską atgal',
    'revoke_confirm' => 'Pašalinti viską, ką tai suteikė?',
    'revoke_confirm_helper' => 'Kiekviena subuser eilutė, kurią šis puslapis sukūrė, kiekviename serveryje, kiekvienam — ir jų SFTP kartu su ja. Eilutės, pridėtos ranka, neliečiamos. Susiejimai žemiau lieka, tad kitas išsaugojimas ar kitas laikmatis suteiktų jas iš naujo: pirma ištuštink sąrašą, jei tai galvoji visam laikui.',
    'revoked' => 'Pašalinta: :count',
    'revoked_body' => 'Tik tos eilutės, kurias šis puslapis buvo sukūręs. Viskas, kas pridėta ranka, ten, kur ir buvo.',
    'revoke_failed' => 'Nepavyko jų pašalinti',
];
