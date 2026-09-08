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
    'collect' => 'Parodyk mano raktą',
    'state_ready_body' => 'Duota. Paspausk Parodyk mano raktą, kad jį pamatytum — vieną kartą, nes jis laikomas kaip maiša ir vėliau perskaityti jo nebegalima.',
    'replace' => 'Pakeisti',
    'replace_confirm' => 'Šis raktas iš karto nustoja veikti, o jo vietą užima naujas, parodomas vieną kartą. Senojo niekur nepasižiūrėsi — jis niekada nebuvo laikomas — tad pakeisti jį yra vienintelis atsakymas į tai, kad jis pamestas.',
    'granted_body' => 'Jie patys jį pasiima savo API prieigos puslapyje. Čia jis nerodomas: raktas priklauso tam, kas jo prašė, o ne tam, kas pasakė taip.',

    'revoke' => 'Atšaukti',
    'revoke_confirm' => 'Raktas iš karto nustoja atsakinėti, o jo maiša dingsta, tad jo atgauti negalima. Viskas, kas jį naudoja, sustoja. Paprašyk naujo, užuot tai atšaukęs.',
    'revoked' => 'Atšauktas',
    'forget' => 'Pašalinti',
    'forget_confirm' => 'Visam laikui pašalina eilutę iš šio puslapio. Jis jau nustojo atsakinėti, tad niekas, kas veikia, nesustoja - dingsta tik įrašas, kad jis buvo.',
    'forgotten' => 'Pašalintas',

    'mint' => 'Naujas raktas',
    'mint_body' => 'Botui, o ne žmogui. Leidimą jis gauna tą pačią akimirką, kai sukuriamas, nes tu esi tas, kas jam būtų pasakęs taip.',
    'abilities' => 'Apie ką jam leidžiama klausti',
    'abilities_helper' => 'Iš pradžių pažymėta viskas, nes toks raktas ir buvo, kol šito nebuvo. Nuimti varnelę yra sąmoningas veiksmas. Laikomas leidžiamų dalykų sąrašas, tad galimybė, pridėta vėlesnėje laidoje, prieš ją padarytiems raktams yra išjungta - galimybė, kurios niekas nepažymėjo, yra galimybė, kurios niekas nedavė.',
    'ability_health' => 'Parodyti, kad raktas veikia',
    'ability_health_helper' => 'Daugiau niekur nepasiekia. Saugu kviesti pagal laikmatį.',
    'ability_me' => 'Savo paties serverius',
    'ability_me_helper' => 'Serveriai, kuriuos savininkas jau gali atidaryti, ir jų atsarginės kopijos. Niekada nemato nieko kito.',
    'ability_panel' => 'Visą skydelį',
    'ability_panel_helper' => 'Kiekvienas node, kiekviena atsarginė kopija, sustojusios suplanuotos užduotys, sargas ir skydelio mašina. Dar reikia, kad raktas liestų visą skydelį.',
    'ability_live' => 'Klausti serverio tiesiogiai',
    'ability_live_helper' => 'Kas žaidžia ir ar serveris veikia. Vieninteliai klausimai, kurie kainuoja — jie pasiekia žaidimo serverį arba daemon, o atsakymas laikomas penkiolika ar dvidešimt sekundžių.',
    'ability_connect' => 'Susieti Discord paskyras su skydelio paskyromis',
    'ability_connect_helper' => 'Vienintelė grupė, kuri nėra skaitymas. Ji sukuria Pelican API raktus to prašančių žmonių paskyrose ir gali nutraukti ryšį. Duok ją tik tam botui, kuriam jos reikia.',
    'own_rate' => 'Užklausų per minutę šiam raktui',
    'own_rate_helper' => 'Palik tuščią, kad būtų laikomasi skydelio nustatymo. Čia įrašytas skaičius galioja tik šiam raktui. Nulis reiškia, kad lubų nėra visai — protinga botui tavo paties mašinoje ir tikras būdas gailėtis, jei raktas nukeliauja kur nors kitur.',
    'own_rate_default' => 'Kaip skydelyje',
    'mint_owner' => 'Kas jis',
    'mint_owner_helper' => 'Raktas atsako kaip kažkas. Raktui, kuris liečia visą skydelį, tai tik tas, kas už jį atsako; asmeniniam tai dar ir tai, ką raktas gali matyti.',
    'minted' => 'Sukurtas',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Raktas Essentials API',
    'profile_make_helper' => 'Kita API nei ta, kuri aukščiau: ši atsako tai, ką žino šis papildinys — kuris tavo serveris neturi atsarginės kopijos, kas juose žaidžia, ar jie veikia. Ji visada atsako tik už tave ir pasiekia tik tuos serverius, kuriuos jau gali atidaryti.',
    'profile_create' => 'Sukurti',
    'profile_yours' => 'Tavo Essentials raktai',
    'profile_manage' => 'Rakto atšaukimas, priežastis, kodėl vienas buvo atmestas, ir Discord susiejimas — visa tai yra API prieigos puslapyje, šoninėje juostoje.',
    'discord' => 'Discord',
    'discord_body' => 'Susiek savo Discord paskyrą su šia, kad botas galėtų atsakyti už tavo serverius, kai jo paprašai. Jis gauna raktą, kuris pasiekia lygiai tiek, kiek pasieki tu, ir nieko daugiau.',
    'discord_connect' => 'Susieti Discord',
    'discord_code' => 'Įrašyk tai Discord per dešimt minučių',
    'discord_code_body' => 'Nusiųsk :command kanale, kurį botas gali skaityti. Kodas veikia vieną kartą. Niekas kitas juo nepasinaudos, tik ta paskyra, kuriai jis padarytas.',
    'discord_on' => 'Susieta kaip :name',
    'discord_since' => 'Nuo :when',
    'discord_cut' => 'Atsieta',
    'discord_cut_confirm' => 'Nutraukia ryšį ir ištrina jo sukurtą raktą, tad botas iš karto nustoja atsakinėti už tave. Susieti gali vėl, kada tik nori.',
    'discord_off' => 'Nesusieta',
    'discord_key_note' => 'Susiejus tavo paskyroje sukuriamas Pelican API raktas, vadinamas Discord (Essentials). Jį matai ir gali atšaukti Paskyra → API raktai — šis puslapis tėra nuoroda į tą patį dalyką.',
    'docs_title' => 'Kaip naudotis šia API',
    'docs_subheading' => 'Į ką šis skydelis atsako ir kokiais adresais atsako. Parašyta iš to paties aprašo, iš kurio sudėta pati API, tad ji negali nuo jos atsilikti per laidą.',
    'docs_base' => 'Kur ji gyvena',
    'docs_endpoints' => 'Galiniai taškai',
    'docs_answers' => 'Kas grįžta',
    'docs_calls' => 'Raktai, kurie gali jį kviesti',
    'docs_params' => 'Ką siųsti',
    'docs_required' => 'būtina',
    'docs_optional' => 'nebūtina',
    'docs_try' => 'Išbandyk',
    'docs_errors' => 'Kai kas nors ne taip',
    'docs_hook' => 'Ką skydelis siunčia tau',
    'docs_hook_body' => 'Kita kryptis ir vienintelė šio dalyko dalis, kuri ateina neprašyta. Įjungiama Įspėjimuose nurodžius adresą ir parašo paslaptį: vienas JSON siuntimas, kai sargas ką nors randa, ir vienas, kai tai praeina, tad botas išgirsta apie nebeatsakantį node, užuot kas minutę klausinėjęs, ar tokio yra.',
    'docs_hook_verify' => 'Turinys sumaišomas su tavo paslaptimi, o maiša keliauja X-Essentials-Signature antraštėje kaip sha256=<hex>. Maišyk žalią turinį, o ne iš naujo suformuotą objektą — bet koks tarpų ar raktų tvarkos skirtumas duoda kitą maišą, o nesutapimas atrodo kaip užpuolimas, o ne kaip klaida.',
    'docs_download_md' => 'Atsisiųsti kaip Markdown',
    'docs_download_json' => 'Atsisiųsti kaip OpenAPI',

    // ---- ką nustato administratorius -------------------------------------
    'settings' => 'Štai kaip tai veikia',
    'approval' => 'Prašymai laukia leidimo',
    'approval_helper' => 'Įjungta: tas, kas prašo rakto, gauna jį, kai kas nors pasako taip. Išjungta: gauna jį iš karto — o tai protinga skydelyje, kur kiekvienas su paskyra jau yra patikimas, ir tai verta pasirinkti, o ne tiesiog į tai įkristi.',
    'rate' => 'Užklausų per minutę, kiekvienam raktui',
    'rate_helper' => 'Botas, klausiantis keturiasdešimties serverių, kas žaidžia, yra keturiasdešimt klausimų keturiasdešimčiai žaidimų serverių. Tai lubos, neleidžiančios ciklui, parašytam trečią nakties, tapti apkrovos bandymu.',
    'days' => 'Duotas raktas galioja',
    'days_helper' => 'Dienomis. Nulis reiškia iki atšaukimo, ir tai numatyta — raktas, kuris baigiasi, kol niekas nežiūri, yra botas, kuris naktį sustoja, o niekur nepasakyta kodėl.',
    'days_never' => 'Iki atšaukimo',
    'hide_pelican' => 'Pašalinti paties skydelio API raktų kortelę',
    'hide_pelican_helper' => 'Visiškai išima API raktų kortelę iš paskyros profilio, tad tame puslapyje lieka tik vienas dalykas, vadinamas API raktais. Ji pašalinama iš puslapio, o ne užpiešiama, tad nelieka nė adreso, kuris ją pasiektų. Vieno dalyko tai negali: paties skydelio kliento API vis tiek sukurs paskyros raktą viskam, kas jo paprašo tiesiogiai — kortelė yra ten, kur žmonės pasidaro raktą ranka, ir tai atima ranką. Jau esantys raktai veikia toliau.',

    /*
     * Pasakyta puslapyje, o ne palikta atrasti. Pelican atsuka papildinio
     * migracijas, kai jis pašalinamas, o vienintelė šio papildinio lentelė
     * išeina kartu su jomis.
     */
    'uninstall_note' => 'Pašalinti šį papildinį reiškia pašalinti kartu su juo kiekvieną raktą. Tai tyčia — raktas, pergyvenantis tai, kas jam atsako, yra prisijungimas, kurio niekas nebegali atšaukti.',
];
