<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Kelias vidun iš išorės.
 *
 * Dvi skaitytojų rūšys viename faile, ir kiekviena nori kito dalyko.
 * Administratorius, skaitantis šį puslapį, kaip tik sprendžia, ar drįsta kam
 * nors patikėti raktą, tad kiekviena eilutė čia sako, kur raktas pasiekia, o ne
 * kaip jis vadinasi. Tas, kas prašo rakto, nori žinoti, ką gauna į rankas ir kas
 * bus, jei jį pames, ir todėl sakinys, kad raktas rodomas tik vieną kartą, nėra
 * išnaša.
 *
 * Niekas čia nesako „token“. „Raktas“ yra tas žodis paties Pelican paskyros
 * puslapyje, o skydelis, tą patį dalyką vadinantis dviem būdais, yra skydelis,
 * kuriame kas nors ieško ne to.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Raktai, leidžiantys kažkam už skydelio ribų paklausti to, ką šis papildinys žino. Tik skaitymas — niekas čia negali paleisti, sustabdyti ar pasiekti serverio.',

    'my_title' => 'API prieiga',
    'my_nav_label' => 'API prieiga',
    'my_subheading' => 'Savas raktas, botui ar scenarijui. Jis atsako tik už tuos serverius, kuriuos jau gali atidaryti.',

    // ---- kas yra raktas, pasakyta kartą, ten kur svarbu ----------------
    'address' => 'Adresas',
    'address_helper' => 'Siųsk raktą kaip Authorization antraštę: :example',

    /*
     * Vienintelis dalykas, kurį kas nors turi perskaityti prieš užsidarant
     * langui. Parašyta kaip tai, ką reikia padaryti, o ne kaip įspėjimas, nes
     * „saugok jį“ yra patarimas, pagal kurį niekas negali veikti, o „įklijuok jį
     * ten, kur botas jį skaito, dabar“ - gali.
     */
    'once' => 'Tai vienintelis kartas, kai šis raktas rodomas',
    'once_body' => 'Jis laikomas kaip maiša, tad niekas — nė tas, kas prižiūri šį skydelį — negali jo perskaityti atgal. Įklijuok jį ten, kur botas ar scenarijus jį skaito, dabar. Jei pames, atšauk šį ir paprašyk naujo.',
    'copy' => 'Kopijuoti',
    'copied' => 'Nukopijuota',

    // ---- būsenos ---------------------------------------------------------
    'state' => 'Būsena',
    'state_pending' => 'Laukia',
    'state_active' => 'Aktyvus',
    'state_refused' => 'Atmestas',
    'state_revoked' => 'Atšauktas',

    'state_pending_body' => 'Kas nors turi duoti leidimą, kol jis apskritai į ką nors atsakys.',
    'state_refused_body' => 'Į tai buvo pasakyta ne. Niekas nebuvo išduota.',
    'state_revoked_body' => 'Šis raktas atimtas ir daugiau neatsako.',

    // ---- apimtis ---------------------------------------------------------
    'scope' => 'Pasiekia',
    'scope_person' => 'Savo paties serverius',
    'scope_panel' => 'Visą skydelį',

    'scope_person_helper' => 'Atsako tik už tuos serverius, kuriuos savininkas jau gali atidaryti, paklaustus tuo pačiu būdu, kuriuo klausia skydelis. Pamesti šį raktą nereiškia pamesti nieko, ko savininkas šiaip jau nematytų.',
    'scope_panel_helper' => 'Atsako į tuos klausimus, kurie liečia visą skydelį — kiekvieną node, talpą, sargą, pačią skydelio mašiną. Botui, kuris praneša apie skydelį, o ne kieno nors vardu.',

    // ---- lentelė ---------------------------------------------------------
    'column_name' => 'Kam',
    'column_owner' => 'Kieno',
    'column_prefix' => 'Raktas',
    'column_asked' => 'Paprašyta',
    'column_used' => 'Paskutinį kartą naudotas',
    'column_expires' => 'Baigiasi',

    'never_used' => 'Niekada',
    'no_expiry' => 'Iki atšaukimo',

    'tab_waiting' => 'Laukia',
    'tab_active' => 'Aktyvūs',
    'tab_all' => 'Visi',

    'empty' => 'Kol kas raktų nėra',
    'empty_body' => 'Niekas neprašė, ir nė vienas nebuvo išduotas. Šis puslapis pildosi pats, kai žmonės tai daro.',

    'my_empty' => 'Neturi rakto',
    'my_empty_body' => 'Paprašyk vieno, ir jis pasirodys čia kartu su gautu atsakymu.',

    // ---- kaip prašyti ----------------------------------------------------
    'ask' => 'Paprašyti rakto',
    'ask_name' => 'Kam jis bus naudojamas',
    'ask_name_helper' => 'Pora žodžių, kad vėliau atskirtum du savus ir kad tas, kas duoda leidimą, žinotų, kam jį duoda.',
    'ask_reason' => 'Kažkas, ką verta pridurti',
    'ask_reason_helper' => 'Nebūtina. Tai skaito tas, kas sprendžia.',
    'ask_sent' => 'Paprašyta',
    'ask_sent_body' => 'Pasirodys žemiau, vos kas nors atsakys.',
    'ask_granted' => 'Štai tavo raktas',
    'ask_open' => 'Jau turi vieną, kuris laukia atsakymo',
    'ask_open_body' => 'Po vieną prašymą iš karto. Atšauk jį, jei tai buvo klaida.',
    'ask_failed' => 'Prašymo pateikti nepavyko',

    'cancel' => 'Atsisakyti',
    'cancel_confirm' => 'Atšaukia prašymą. Niekas nebuvo išduota, tad niekas ir nenustoja veikti.',

    // ---- kaip spręsti ----------------------------------------------------
    'grant' => 'Duoti leidimą',
    'grant_confirm' => 'Išduoda raktą, kuris atsako už šio žmogaus paties serverius, ir parodo jį vieną kartą. Jis jau mato viską, apie ką raktas praneš — tai sprendžia, ar kažkam už skydelio ribų leidžiama klausti jo vardu.',
    'granted' => 'Duota',

    'refuse' => 'Atmesti',
    'refuse_answer' => 'Ką jie sužinos',
    'refuse_answer_helper' => 'Nebūtina, ir rodoma jų pačių puslapyje. Atmetimas be priežasties yra toks, kurio kitą savaitę paprašo iš naujo.',
    'refused' => 'Atmestas',

    'revoke' => 'Atšaukti',
    'revoke_confirm' => 'Raktas iš karto nustoja atsakinėti, o jo maiša dingsta, tad jo atgauti negalima. Viskas, kas jį naudoja, sustoja. Paprašyk naujo, užuot tai atšaukęs.',
    'revoked' => 'Atšauktas',

    'mint' => 'Naujas raktas',
    'mint_body' => 'Botui, o ne žmogui. Leidimą jis gauna tą pačią akimirką, kai sukuriamas, nes tu esi tas, kas jam būtų pasakęs taip.',
    'mint_owner' => 'Kas jis',
    'mint_owner_helper' => 'Raktas atsako kaip kažkas. Raktui, kuris liečia visą skydelį, tai tik tas, kas už jį atsako; asmeniniam tai dar ir tai, ką raktas gali matyti.',
    'minted' => 'Sukurtas',

    // ---- ką nustato administratorius -------------------------------------
    'settings' => 'Štai kaip tai veikia',
    'approval' => 'Prašymai laukia leidimo',
    'approval_helper' => 'Įjungta: tas, kas prašo rakto, gauna jį, kai kas nors pasako taip. Išjungta: gauna jį iš karto — o tai protinga skydelyje, kur kiekvienas su paskyra jau yra patikimas, ir tai verta pasirinkti, o ne tiesiog į tai įkristi.',
    'rate' => 'Užklausų per minutę, kiekvienam raktui',
    'rate_helper' => 'Botas, klausiantis keturiasdešimties serverių, kas žaidžia, yra keturiasdešimt klausimų keturiasdešimčiai žaidimų serverių. Tai lubos, neleidžiančios ciklui, parašytam trečią nakties, tapti apkrovos bandymu.',
    'days' => 'Duotas raktas galioja',
    'days_helper' => 'Dienomis. Nulis reiškia iki atšaukimo, ir tai numatyta — raktas, kuris baigiasi, kol niekas nežiūri, yra botas, kuris naktį sustoja, o niekur nepasakyta kodėl.',
    'days_never' => 'Iki atšaukimo',

    /*
     * Pasakyta puslapyje, o ne palikta atrasti. Pelican atsuka papildinio
     * migracijas, kai jis pašalinamas, o vienintelė šio papildinio lentelė
     * išeina kartu su jomis.
     */
    'uninstall_note' => 'Pašalinti šį papildinį reiškia pašalinti kartu su juo kiekvieną raktą. Tai tyčia — raktas, pergyvenantis tai, kas jam atsako, yra prisijungimas, kurio niekas nebegali atšaukti.',
];
