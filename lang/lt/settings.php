<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Egg“, „node“, „subuser“, „Wings“, „queue“, „webhook“, „topbar“, „cron“ ir
 * failų formatų pavadinimai lieka tokie, kokie yra: tais vardais juos randi
 * Pelican, mašinoje ir visame, kas apie juos rašoma. Stilių pavadinimai taip pat
 * neverčiami — stilius vadinasi taip, kaip vadinasi, o išverstas vardas būtų tik
 * dar vienas vardas tam pačiam.
 */

return [
    'css_warning' => 'Išsaugota, bet šis CSS atrodo klaidingas',
    'css_unclosed' => 'Taisyklė, atsiverianti :line eilutėje, niekada neužsidaro. Viskas po jos stovi tos taisyklės viduje ir neturi jokio poveikio.',
    'css_extra' => ':line eilutėje stovi uždaranti riestinė skliaustė, o niekas neatvira. Viskas po jos stovi už bet kokios taisyklės ribų ir praleidžiama.',
    'css_comment' => 'Komentaras, atsiveriantis :line eilutėje, niekada neužsidaro, tad likusi failo dalis stovi jo viduje.',

    'groups' => [
        'appearance' => 'Išvaizda',
        'servers' => 'Serverių sąrašas',
        'windows' => 'Stiliai pagal laiką',
        'windows_helper' => 'Kitas stilius tarp dviejų paros valandų. Niekas nevyksta, kol nepridedi vieno. Laikrodis yra paties skydelio, iš jo laiko juostos nuostatos, o ne kiekvieno skaitytojo — skydelis, kuris tą pačią akimirką atrodytų skirtingai dviem žmonėms, būtų panašus į sugedusį, o ne į suplanuotą. Langas keičia tą išvaizdą, kurią skydelis jau turi, tad jis nieko nedaro, kol stilius yra „Jokio“. Stilius, kurį kas nors pasirinko sau, vis tiek jį nugali.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Kalbos',
        'servers_helper' => 'Kaip piešiama serverio kortelė. Ar jie rodomi tinkleliu, ar sąrašu, yra kiekvieno paties pasirinkimas, ties Paskyra → Apžvalgos išdėstymas.',
        'server_pages' => 'Serverio puslapiai',
        'server_pages_helper' => 'Ką neša kiekvienas puslapis serverio viduje, koks tas puslapis bebūtų.',
        'console' => 'Konsolės puslapis',
        'console_helper' => 'Terminalo šriftas, dydis ir aukštis yra kiekvieno paties pasirinkimas, ties Paskyra.',
        'background' => 'Fonas',
        'background_helper' => 'Galioja visam skydeliui, įskaitant prisijungimo ekraną.',
        'icons' => 'Piktogramos',
        'bars' => 'Išteklių matuokliai',
        'bars_helper' => 'Procesoriaus, atminties ir disko juostos serverių kortelėse.',
        'updates' => 'Atnaujinimai',
        'updates_helper' => 'Kurias laidas siūlo Temos puslapis, ir kur jų ieško.',
        'brand' => 'Ženklas',
        'login' => 'Prisijungimo ekranas',
        'login_helper' => 'Galioja prisijungimo, slaptažodžio atstatymo ir dviejų veiksnių patikros ekranams.',
        'advanced' => 'Savas CSS',
        'advanced_helper' => 'Viskam, ko aukščiau esančios nuostatos neapima. Įkeliamas po visko kito, tad jis nugali.',
        'areas' => 'Pagal sritis',
        'areas_helper' => 'Viskas aukščiau galioja visur. Čia gali atskirti vieną sritį; viskas, ką paliksi tuščia, ir toliau seka bendra nuostata.',
        'footer' => 'Šoninės juostos apačia',
        'footer_helper' => 'Šoninės juostos apačia, kurią Pelican palieka tuščią. Viskas čia išjungta, kol to neužpildai.',
        'features' => 'Ką šis papildinys prideda',
        'features_helper' => 'Jei nuimsi varnelę nuo ko nors, tai visiškai dingsta iš skydelio. Jo nuostatos išsaugomos, o jo puslapis išlaiko savo adresą, tad niekas neprarandama išjungus ką nors, kad pamatytum, ką jis darė. Dauguma turi ir savo teisę ties Vaidmenys, tad vieną galima atiduoti, neatiduodant kitų. Ne visi: išteklių matuokliai, šoninės juostos apačia ir paieška nuostatose piešiami visiems, ir niekas jų nevaldo, žvaigždutė serverio kortelėje priklauso tam, kas ją spustelėjo, o Palworld ir Minecraft puslapiai serverio viduje seka to serverio paties teisėmis, o ne kuria nors iš šių. Pati išvaizda ne sąraše — ji turi savo jungiklį, ties Look → Išvaizda → Stilius → Jokio.',
        'identity' => 'Šis papildinys šoninėje juostoje',
        'identity_helper' => 'Eilutė, kurią šis papildinys prideda į šoninę juostą, ir paveikslėlis joje.',
    ],

    /*
     * Nuostatų puslapiai, kiekvienas - eilutė paties papildinio grupėje šoninėje
     * juostoje. Sugrupuoti pagal klausimą, į kurį atsakai, o ne pagal klasę,
     * kuri juos sudeda.
     */
    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Spalva, forma ir tai, kaip skydelis vadinasi.',
        'pages' => 'Puslapiai',
        'pages_helper' => 'Serverių sąrašas, puslapiai serverio viduje, ir terminalas.',
        'advanced' => 'Išplėstiniai',
        'advanced_helper' => 'Du avariniai išėjimai: tavo paties CSS, ir nuostatos, galiojančios tik vienoje srityje.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Kurie egg yra Minecraft, ir visa kita apie tai.',
        'artwork' => 'Egg paveikslėliai',
        'artwork_helper' => 'Puslapis su kiekvienu egg, ir būdas parsiųsti jam žaidimo paveikslėlį iš Steam ar IGDB. Rašo į pačius egg — paveikslėlį ir dvi žymes, kurios pažymi, koks tai žaidimas ir ar paveikslėlis buvo parinktas ranka — ir todėl neša savo teisę.',
        'alerts' => 'Įspėjimai',
        'alerts_helper' => 'Reguliarus patikrinimas to, ką skydelis jau matuoja, bet niekam nesako: node, kuris nustoja atsakinėti, prisipildantis diskas, sustojęs queue worker, atsiliekanti versija. Siunčia į Discord, į skydelį arba paštu. Sava teisė, nes jis reguliariai pasiekia kiekvieną node ir siunčia į adresą, kurį kas nors surinko.',
        'backups' => 'Atsarginių kopijų apžvalga',
        'backups_helper' => 'Puslapis su kiekvienu serveriu ir tuo, kiek laiko jis be kopijos, surikiuotas taip, kad tie, kurie neturi nė vienos, būtų viršuje. Tik skaitymas — viskas, kas ką nors daro su kopija, lieka paties Pelican puslapyje tam serveriui. Sava teisė, nes sąrašas yra žemėlapis to, kur yra skylės.',
        'public_status' => 'Viešas būsenos puslapis',
        'public_status_helper' => 'Puslapis, kurį kiekvienas gali atidaryti be paskyros ir kuris rodo, kurie tavo serveriai veikia ir kiek žmonių juose. Niekas neskelbiama, kol nepaminėsi serverio, mašinos ar paslaugos — visi trys sąrašai prasideda tušti, o kol jie tokie, adresas atsako 404. Sava teisė, nes ji sprendžia, kas palieka skydelį.',
        'game_players' => 'Žaidėjai, kiti žaidimai',
        'capacity' => 'Talpa',
        'capacity_helper' => 'Kiek pažadėta kiekvienoje mašinoje, palyginti su tuo, kiek jai leidžiama išdalyti, kad matytum, ar telpa dar vienas serveris. Pelican node sąrašas rodo pavadinimą ir serverių skaičių, o Mašinų blokas apžvalgoje rodo, kas veikia - tai trečias klausimas, o skaičiavimas yra paties Pelican. Tik skaitymas. Sava teisė.',
        'schedules' => 'Suplanuotos užduotys',
        'schedules_helper' => 'Kiekviena suplanuota užduotis skydelyje, kartu su tuo, kuri sustojo: įstrigusi vykdymo viduryje, pavėlavusi, nes cron neveikia, arba niekada nevykdyta. Pelican rodo tvarkaraščius kiekvieno serverio viduje, o jo paties būsena neturi žodžio nė vienam iš tų atvejų. Tik skaitymas. Sava teisė.',
        'activity' => 'Veikla',
        'activity_helper' => 'Kiekvienas įvykis, kurį skydelis užrašo, viename sąraše, o ne po vieną serverį iš eilės. Pelican veda žurnalą ir rodo jį pagal serverius; tai klausia to paties žurnalo iš kitos pusės. Tik skaitymas. Sava teisė, nes apžvalga to, kas ką darė, yra tai, ką atiduodama sąmoningai.',
        'access' => 'Prieiga prie serverių',
        'access_helper' => 'Susiek vaidmenį su serveriais, kad kiekvienas jo turėtojas juos pasiektų. Tai veikia palaikant pačius Pelican subuser įrašus aktualius, o būtent juos jau skaito serverių sąrašas ir kiekviena teisių patikra. Sava teisė, nes tai čia vienintelis puslapis, kuris duoda žmonėms prieigą prie ko nors.',
        'games' => 'Kiti žaidimai',
        'games_helper' => 'Tie failai, kuriuos ARK ir Valheim laiko šalia savo pasaulio, kaip formos: ARK pasaulio nuostatos ir Valheim admin, ban bei leidžiamųjų sąrašai. Kurie serveriai juos gauna, yra to puslapio egg sąrašas, tad tuščias sąrašas jau yra jungiklis kiekvienam žaidimui.',
        'game_players_helper' => 'Puslapis Rust, ARK, Valheim ir visko kito, kas atsako į Valve užklausą, viduje, rodantis, kas prisijungęs ir kiek laiko jis viduje. Tik skaitymas — ką gali kam nors padaryti, skiriasi nuo žaidimo prie žaidimo, o tai atskira laida. Kurie egg skaičiuojami, yra tas pats sąrašas, kurį naudoja būsenos puslapis.',
        'api' => 'API',
        'api_helper' => 'Raktai, kuriuos žmonės turi, kas vieno prašė, ir ką kiekvienas iš jų gali matyti.',
        'languages' => 'Kalbos',
        'languages_helper' => 'Kokiomis kalbomis šis papildinys atsako.',
    ],

    'features' => [
        'look' => 'Look nuostatos',
        'look_helper' => 'Eilutė šoninėje juostoje spalvai, formai ir ženklui.',
        'pages' => 'Puslapių nuostatos',
        'pages_helper' => 'Eilutė šoninėje juostoje serverių sąrašui, serverio puslapiams ir terminalui.',
        'advanced' => 'Išplėstinės nuostatos',
        'advanced_helper' => 'Eilutė šoninėje juostoje tavo paties CSS ir sričių išimtims.',
        'announcements' => 'Skelbimai',
        'announcements_helper' => 'Juosta skydelio viršuje.',
        'nav_links' => 'Navigacijos nuorodos',
        'nav_links_helper' => 'Tavo paties eilutės šoninėje juostoje.',
        'login' => 'Prisijungimo ekranas',
        'login_helper' => 'Prisijungimo ekrano paveikslėlis, žinutė ir nuorodos.',
        'bars' => 'Išteklių matuokliai',
        'bars_helper' => 'Spalvą keičiančios juostos procesoriui, atminčiai ir diskui.',
        'dashboard_status' => 'Versijos eilutė',
        'dashboard_status_helper' => 'Bloko apžvalgoje viršus: kuri versija įdiegta, ir ar kuri nors laukia.',
        'dashboard_nodes' => 'Mašinos',
        'dashboard_nodes_helper' => 'Likusi bloko apžvalgoje dalis: šis skydelis ir kiekvienas node, su tuo, ką kiekvienas naudoja.',
        'system_status' => 'Sistemos būsenos puslapis',
        'system_status_helper' => 'Puslapis tai mašinai, kurioje veikia pats skydelis.',
        'sidebar_footer' => 'Šoninės juostos apačia',
        'sidebar_footer_helper' => 'Tavo teksto eilutė, skydelio versija ir viena nuoroda, šoninės juostos apačioje.',
        'console' => 'Konsolės mygtukas',
        'console_helper' => 'Plaukiojantis mygtukas serverio viduje, su konsole ir maitinimo mygtukais ant jo, pasiekiantis node tiesiogiai. Kokią formą jis įgauna, nustatoma serverio puslapių nuostatose; tai nusprendžia, ar jis apskritai piešiamas.',
        'arranger' => 'Puslapio dėliotojas',
        'arranger_helper' => 'Blokų vilkimas puslapyje į tą tvarką, kurios kas nors nori. Turi savo teisę ties Vaidmenys, tad tai nusprendžia, ar skydelis jį siūlo, o teisė nusprendžia, kam.',
        'user_themes' => 'Stiliai kiekvienam',
        'user_themes_helper' => 'Leisti kiekvienam pasirinkti stilių iš tų, kuriuos siūlai, ties Išvaizda kliento dalyje. Kurie stiliai siūlomi, nustatoma Look puslapyje; tai nusprendžia, ar apskritai ko nors klausiama.',
        'api' => 'API',
        'api_helper' => 'Kelias vidun iš išorės: adresas, kurio Discord botas ar tavo paties scenarijus gali paklausti to, ką šis papildinys žino — kas žaidžia, kurie serveriai neturi atsarginės kopijos, ar telpa dar vienas node. Išjungta neužregistruoja jokio maršruto apskritai, užuot registravusi tą, kuris atmeta, o tai mažiau paviršiaus, o ne mandagesnis jo kiekis. Kiekvienas prisijungęs gali paprašyti rakto, kuris atsako tik už jo paties serverius; duoti vieną, atmesti vieną, atšaukti tą, kurį turi kas nors kitas, ir išduoti tą, kuris liečia visą skydelį — visiems tiems reikia teisės.',
        'languages' => 'Kalbos',
        'languages_helper' => 'Atsakyti kiekvienam ta kalba, į kurią nustatyta jo paskyra, ten kur šis papildinys į ją išverstas. Jei tai išjungta, visi gauna anglų.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Minecraft kortelė šoninėje juostoje ir puslapis kiekvieno Minecraft serverio viduje jo server.properties redaguoti kaip formą. Kurie egg skaičiuojami, sakai tu.',
        'palworld' => 'Palworld nuostatos',
        'palworld_helper' => 'Puslapis Palworld serverio viduje jo pasaulio nuostatoms redaguoti. Neatsiranda jokiame kitame serveryje, ir niekada, kol tas serveris veikia.',
        'settings_search' => 'Paieška nuostatose',
        'settings_search_helper' => 'Laukas virš šių formų, susiaurinantis jas iki tų skyrių, kuriuose yra tai, ką rašai.',
        'preview' => 'Gyva peržiūra',
        'preview_helper' => 'Dėžutė šalia Look formos, rodanti, ką daro spalvos, kampai ir tarpai, prieš tau juos išsaugant.',
        'duplicate' => 'Kopijuoti serverį',
        'duplicate_helper' => 'Puslapis dar vienam serveriui sutvarkyti lygiai kaip tas, kurį jau turi, arba keliems iš karto. Failai niekada nekopijuojami.',
        'favourites' => 'Pažymėti serveriai',
        'favourites_helper' => 'Žvaigždutė kiekvienoje serverio kortelėje. Pažymėti eina pirmi, o kiekvieno sąrašas laikomas skydelyje — tad žvaigždutės seka jį ten, iš kur jis prisijungs kitą kartą. Tai keičia tai, ką jis pats mato, ir nieko kitiems. Tai, kad sąrašas laikomas skydelyje, tiesa, reiškia, kad tai failas po storage, kurį gali perskaityti kiekvienas, turintis prieigą prie mašinos.',
        'artwork' => 'Egg paveikslėliai',
        'artwork_helper' => 'Administravimo puslapis, kuris parsiunčia kiekvieno egg paveikslėlį iš Steam ar IGDB ir įrašo jį į patį egg.',
        'alerts' => 'Įspėjimai',
        'alerts_helper' => 'Reguliarus patikrinimas dėl node, nustojusio atsakinėti, prisipildančio disko, mirusio queue worker ar atsiliekančios versijos — ir ta Discord, skydelio ar pašto žinutė, kurią jis siunčia.',
        'backups' => 'Atsarginių kopijų apžvalga',
        'backups_helper' => 'Administravimo puslapis, išvardijantis kiekvieną serverį pagal tai, kiek laiko jis be kopijos. Tik skaitymas.',
        'public_status' => 'Viešas būsenos puslapis',
        'public_status_helper' => 'Puslapis, kurį kiekvienas gali atidaryti be paskyros. Jei jis išjungtas, adresas atsako 404, kad ir kas būtų sąraše.',
        'game_players' => 'Žaidėjai, kiti žaidimai',
        'game_players_helper' => 'Puslapis Rust, ARK, Valheim ir visko kito, kas atsako į Valve užklausą, viduje, rodantis, kas prisijungęs ir kiek laiko jis viduje.',
        'owner_alerts' => 'Pranešk žmonėms, kad jų serveris apačioje',
        'owner_alerts_helper' => 'Vienintelė šio papildinio dalis, kuri rašo žmonėms, nesantiems administratoriais: pranešimas skydelyje, kai mašina už vieno jų serverio nustoja atsakinėti, ir vienas, kai ji grįžta. Išjungta, kol neįjungsi ir čia, ir Įspėjimų puslapyje - ji rašo tavo klientams, tad reikalauja dviejų sprendimų, o ne vieno.',
        'my_backups' => 'Įspėjimas apie kopijas serverių sąraše',
        'my_backups_helper' => 'Eilutė virš kiekvieno savo serverių sąrašo, kai vienas iš jų niekada neturėjo kopijos arba jos nėra jau kurį laiką. Pelican kortelė sako, ką serveris daro dabar; niekas ten nesako, kad kopija nevykdyta tris savaites. Piešiama tik tada, kai kažkas atsilieka, ir neįvardija nė vieno serverio, kurio tas žmogus šiaip jau negalėtų atidaryti.',
        'capacity' => 'Talpos apžvalga',
        'capacity_helper' => 'Administravimo puslapis, rodantis atmintį, diską ir procesorių, pažadėtus palyginti su prieinamais kiekvienoje mašinoje, kartu su tais serveriais, kuriems baigėsi kopijos, duomenų bazės ar allocation. Pažadėta, o ne panaudota - node gali būti užimtas ir tuščias, arba tylus ir pilnas.',
        'schedules' => 'Suplanuotų užduočių apžvalga',
        'schedules_helper' => 'Administravimo puslapis, išvardijantis kiekvieną suplanuotą užduotį visame skydelyje, blogiausias pirmas - įstrigusias, pavėlavusias, arba niekada nevykdytas. Tik skaitymas; viskas, kas keičia ar paleidžia kurią nors, lieka paties Pelican puslapyje tam serveriui.',
        'activity' => 'Skydelio veikla',
        'activity_helper' => 'Administravimo puslapis, išvardijantis kiekvieną užrašytą įvykį visame skydelyje, naujausią pirmą, su tuo, kas tai padarė ir kuriame serveryje. Tik skaitymas - jis nieko netrina, o paties Pelican nuostata ir toliau sprendžia, kiek eilutės lieka.',
        'access' => 'Prieiga prie serverių pagal vaidmenį',
        'access_helper' => 'Puslapis vaidmeniui su serveriais susieti, palaikomas teisingu pačioje Pelican subuser lentelėje. Nieko neduoda, kol ko nors nesusiesi. Jo išjungimas sustabdo derinimą; jau suteikta prieiga lieka, o puslapyje yra mygtukas jai atimti.',
        'scheduled' => 'Stiliai pagal laiką',
        'scheduled_helper' => 'Look puslapio skyrius, duodantis skydeliui kitą stilių tarp dviejų paros valandų. Jis nieko nekeičia iš to, kas išsaugota — langas uždedamas ant nuostatų, kol puslapis piešiamas, ir iškart po to paleidžiamas — tad jo išjungimas grąžina paties skydelio išvaizdą tuoj pat ir nieko nepraranda.',
        'games' => 'Kiti žaidimai',
        'games_helper' => 'ARK pasaulio nuostatos ir Valheim admin, ban bei leidžiamųjų sąrašai, kaip formos, o ne kaip failai failų tvarkyklėje. Kurie serveriai juos gauna, yra Kitų žaidimų puslapio egg sąrašas.',
        'quick' => 'Meniu „Eiti į“',
        'quick_helper' => 'Vienas elementas kiekvieno puslapio viršuje, kad peršoktum į serverį ar į pažymėtą puslapį, su paieškos lauku per visą tavo serverių sąrašą. Jis taip pat paryškina tą puslapį, kuriame esi. Tai, ką kas nors per jį randa, yra tai, ką jis šiaip jau pasiekė, tad jis nieko neduoda - išjungti jį reiškia atimti nuorodą ir kartu su ja Mėgstamų puslapį.',
        'shop' => 'Parduotuvė',
        'shop_helper' => 'Serverių pardavimas iš skydelio: parduotuvė ir kasa kliento pusėje, kiekvieno sąskaitų puslapis ir Parduotuvės nustatymų puslapis valiutai, mokesčiui ir tekstams. Pagrindinis jungiklis — išjungus niekas negali pirkti ar mokėti, o tai, kas jau parduota, toliau tvarkoma per žemiau esančius puslapius.',
        'packages' => 'Paketai',
        'packages_helper' => 'Administratoriaus puslapis, kuriame nustatoma, kas parduodama: serverio šablonas su kaina, laikotarpiu ir atsargomis. Atskira teisė, nes kainų nustatymas yra kitas darbas nei sąskaitų žymėjimas apmokėtomis.',
        'orders' => 'Užsakymai',
        'orders_helper' => 'Administratoriaus puslapis su viskuo, kas nupirkta, serveriu, kuriuo tapo kiekvienas užsakymas, ir jo būsena — laukiantis, aktyvus, sustabdytas, atšauktas. Atskira teisė.',
        'invoices' => 'Sąskaitos',
        'invoices_helper' => 'Administratoriaus puslapis su tuo, kas skolinga ir kas apmokėta, su mygtuku sąskaitai pažymėti apmokėta ranka. Atskira teisė, nes tas mygtukas yra vieta, kur apskaitomi pinigai.',
        'payments' => 'Mokėjimai',
        'payments_helper' => 'Mokėjimų tiekėjai — jų raktai ir kiekvienas bandymas per juos. Atskira teisė, nes ten gyvena prisijungimo duomenys: tam, kuris mato kiekvieną sąskaitą, nebūtina matyti paslapties.',
        'coupons' => 'Kuponai',
        'coupons_helper' => 'Kodai, nuimantys procentą arba fiksuotą sumą nuo pirmos sąskaitos, su galiojimo terminu ir panaudojimų riba. Atskira teisė.',
        'customers' => 'Klientai',
        'customers_helper' => 'Administravimo puslapis, apverčiantis parduotuvę: po eilutę kiekvienam pirkusiam, su tuo, ką jis turi, ką sumokėjo ir kas lieka. Atskira teisė, nes tai vienintelis parduotuvės puslapis apie žmogų, o ne apie eilutę - tam, kuris nustato kainas, visa kliento istorija nereikalinga, o tam, kuris atsako į užklausą, reikalinga.',
        'overview' => 'Parduotuvės apžvalga',
        'overview_helper' => 'Puslapis, atsakantis, kas įplaukė šį mėnesį, kas skolinga, kiek per mėnesį vertos veikiančios paslaugos ir į ką reikia pažiūrėti šiandien. Atskira teisė, nes apyvarta nėra tai, ką turėtų galėti skaityti kiekvienas, kam leista nustatyti paketo kainą.',
        'terminate' => 'Nutraukti paslaugą',
        'terminate_helper' => 'Mygtukas, kuris sustabdo paslaugą dabar ir ištrina jos serverį su failais ir viskuo. Sąmoningai atskirta nuo užsakymų teisės: sustabdymas, termino perkėlimas ir atšaukimas yra atitaisomi, o šis — ne. Tas, kuris atsako į užklausas, gali turėti pirmuosius tris neturėdamas šio.',
        'public_shop' => 'Viešasis parduotuvės puslapis',
        'public_shop_helper' => 'Puslapis, kurį bet kas gali atverti be paskyros, su tuo, kas parduodama. Jis neskelbia nieko, ko prisijungęs pirkėjas nematytų parduotuvėje, tad įjungta ar išjungta yra visas sprendimas — išjungtas atsako 404, kaip būsenos puslapis.',
    ],

    /*
     * Paieškos laukas virš nuostatų formų. Jis filtruoja tai, kas jau yra
     * puslapyje naršyklėje, ir serverio nieko neklausia, tad nėra būsenos
     * „ieškoma“, kurią reikėtų aprašyti, ir nėra būdo jam sugesti.
     */
    /*
     * Peržiūra. Viskas joje yra pakaitalas, o ne pavyzdys iš tavo skydelio, ir
     * formuluotė tai sako - dėžutė, kuri paminėtų tikrą serverį ar tikrą
     * skaičių, būtų taip ir perskaityta.
     */
    'preview' => [
        'label' => 'Peržiūra',
        'card' => 'Kortelė',
        'card_helper' => 'Nupiešta pagal tas pačias taisykles kaip ir skydelis, su nuostatomis šiame puslapyje, o ne su išsaugotomis.',
        'button' => 'Mygtukas',
        'field' => 'Laukas',
        'meter_ok' => 'Gerai',
        'meter_warning' => 'Įspėjimas',
        'meter_danger' => 'Pavojus',

        /*
         * Viso puslapio peržiūra. Kortelė, o ne rėmelis, nes Pelican siunčia
         * X-Frame-Options: DENY ir atsisako būti įrėmintas bet ko, įskaitant ir
         * save patį - žr. Support\FullPreview.
         */
        'full' => 'Peržiūrėti visą skydelį',
        'full_confirm' => 'Atidaro skydelį, nupieštą iš nuostatų šiame puslapyje, o ne iš išsaugotų. Niekas neįrašoma — reikšmės laikomos penkiolika minučių, o skydelis grįžta į įprastą, kai palieki peržiūrą arba išsaugai.',
        'full_go' => 'Parodyk man',
        'full_failed' => 'Peržiūros paleisti nepavyko',
        'bar' => 'Žiūri į nuostatas, kurios neišsaugotos. Niekas iš jų neįrašyta.',
        'bar_back' => 'Atgal į nuostatas',
    ],

    'search' => [
        'placeholder' => 'Ieškoti nuostatose',
        'label' => 'Ieškoti šiose nuostatose',
        'none' => 'Niekas šiame puslapyje neatitinka. Nuostatos išdėstytos keturiuose puslapiuose — pabandyk Look, Puslapiai, Išplėstiniai arba Essentials nuostatos.',
    ],

    'footer' => [
        'text' => 'Tavo paties eilutė',
        'text_helper' => 'Paprastas tekstas, ne daugiau kaip 120 ženklų. Jis pakeičiamas saugia forma, kaip ir skelbimų juosta — tai piešiama kiekviename skydelio puslapyje, o tai daro jį netinkama vieta žymėms priimti.',
        'version' => 'Rodyti skydelio versiją',
        'version_helper' => 'Pelican versija, o ne šio papildinio. Papildinys savąją sako apžvalgoje; tai, ko žmonės ieško šoninės juostos apačioje, yra tai, kurį skydelį jie mato.',
        'link_label' => 'Nuorodos tekstas',
        'link_url' => 'Nuorodos adresas',
        'link_url_helper' => 'http ar https adresas, arba kelias pačiame skydelyje, pavyzdžiui /account. Atsidaro naujoje kortelėje.',
    ],

    'layout' => [
        'label' => 'Išdėstymas',
        'helper' => 'Kaip skydelis sudėtas, o ne kokios jis spalvos. Vienodai galioja administravimo daliai, serverių sąrašui ir kliento daliai. Kur stovi navigacija, yra numatytoji reikšmė: kas nusistatė savą ties Paskyra → Navigacija, tą ir išlaiko.',
        'default' => 'Šoninė juosta — paties Pelican',
        'rail' => 'Piktogramų juostelė — siaura, atsiveria užvedus',
        'top' => 'Navigacija viršuje — be šoninės juostos',
        'mixed' => 'Viršutinė ir šoninė juostos — abi',
        'wide' => 'Plačiai — turinys naudoja visą ekraną',
        'focus' => 'Sutelkta — siauras stulpelis, šoninė juosta susilanksto',

        'nav_label' => 'Šoninės juostos stilius',
        'nav_helper' => 'Kaip piešiama pati šoninė juosta.',
        'nav_default' => 'Numatytasis',
        'nav_floating' => 'Plaukiojanti — sava kortelė',
        'nav_flat' => 'Plokščia — visai be fono',
        'nav_bordered' => 'Su rėmeliu — linija, o ne paviršius',

        'topbar_label' => 'Topbar stilius',
        'topbar_helper' => '„Paslėpta“ galioja tik kompiuteryje — telefone topbar neša vienintelį kelią atgal į meniu.',
        'topbar_default' => 'Numatytasis',
        'topbar_floating' => 'Plaukiojanti — atskira eilutė',
        'topbar_flush' => 'Lygiai — plokščia, be suliejimo',
        'topbar_hidden' => 'Paslėpta kompiuteryje',

        'card_label' => 'Kortelių stilius',
        'card_helper' => 'Skyriai, widget-ai, serverių kortelės ir blokai virš konsolės.',
        'card_default' => 'Numatytasis — pakeltas su minkštu rėmeliu',
        'card_flat' => 'Plokščias — be pakėlimo',
        'card_outline' => 'Kontūras — rėmelis ir nieko už jo',
        'card_glass' => 'Matinis — fonas prašviečia',
        'card_sharp' => 'Aštrus — tiesūs kampai',
    ],

    'servers' => [
        /*
         * Žvaigždutė kortelėje. Perduota scenarijui, o ne įrašyta į jį, kad
         * tekstai būtų ta vienintelė vieta, kur tekstai gyvena.
         */
        'favourite' => 'Pažymėk šį serverį',
        'favourited' => 'Pažymėtas — rodomas pirmas',

        /*
         * Piliulė šalia paties Pelican kortelių. Pavadinta pagal tai, ką ji daro
         * su sąrašu, o ne kaip ketvirta kortelė, nes ji filtruoja pasirinktą
         * kortelę, o ne ją pakeičia.
         */
        'favourites_tab' => 'Mėgstami',
        'favourites_empty' => 'Šiame puslapyje niekas nepažymėta. Naudokis žvaigždute serverio kortelėje, kad pridėtum vieną — ir atkreipk dėmesį, kad tai filtruoja tuos serverius, kurie jau čia: pažymėtas serveris vėlesniame puslapyje nesislepia, jis tiesiog ne šiame.',
        'favourites_failed' => 'Tavo pažymėtų serverių išsaugoti nepavyko, tad jie grąžinti į tai, ką skydelis turėjo paskutinį kartą. Naršyklės konsolė sako, ką atsakė užklausa.',

        'art' => 'Žaidimo paveikslėlis',
        'art_helper' => 'Pelican piešia egg paveikslėlį kiekvienoje kortelėje. Tai sprendžia, kas su juo daroma.',
        'art_faded' => 'Išblukęs — švytėjimas už teksto',
        'art_cover' => 'Dengiantis — už pavadinimo, išnyksta',
        'art_off' => 'Išjungtas',
        'art_dim' => 'Tamsinti paveikslėlį',
        'art_dim_helper' => 'Vieno žaidimo paveikslėlis yra šviesus dangus, o kito — urvas.',

        'status' => 'Būsenos ženklas',
        'status_helper' => 'Kur rodoma veikia/pasileidžia/sustabdytas spalva.',
        'status_bar' => 'Juosta — palei kairį kraštą',
        'status_edge' => 'Kraštas — per viršų',
        'status_dot' => 'Taškas — kampe',
        'status_off' => 'Išjungtas',

        'density' => 'Kortelės aukštis',
        'density_comfortable' => 'Erdvi',
        'density_compact' => 'Glausta — daugeliui serverių',

        'filter_label' => 'Užrašyk tekstą ant filtro mygtuko',
        'filter_label_helper' => 'Pelican jau filtruoja šį sąrašą pagal egg ir pagal savininką, per visus puslapius - bet įėjimas yra piktograma be teksto šalia paieškos lauko. Tai užrašo ant jos žodį.',
        'filter_button' => 'Filtrai',

        'columns' => 'Kortelės greta plačiame ekrane',
        'columns_helper' => 'Galioja tik tinkleliui, ir tik nuo 1280px į viršų. Paties Pelican lubos yra dvi.',
    ],

    'controls' => [
        'mode' => 'Konsolės mygtukas kiekviename serverio puslapyje',
        'mode_helper' => 'Vienas plaukiojantis mygtukas, kiekviename puslapyje serverio viduje. Jis atidaro konsolę ant to, ką darei, su būsena ir maitinimo mygtukais savo galvutėje — pasiekia node tiesiogiai, kaip tai daro serverių sąrašas, o ne per konsolės puslapio websocket. Niekada nepasirodo konsolės puslapyje, kuriame viso to jau yra.',
        'mode_full' => 'Konsolė ir maitinimo mygtukai',
        'mode_console' => 'Tik konsolė',
        'mode_off' => 'Išjungta',

        'label' => 'Mygtukas rodo',
        'label_text' => 'Piktogramą ir pavadinimą',
        'label_icon' => 'Tik piktogramą',

        'position' => 'Kur jis plaukioja',
        'position_helper' => 'Prie to krašto, kurį mažiausiai tikėtina skaitai.',
        'position_top' => 'Viršus',
        'position_right' => 'Dešinė',
        'position_bottom' => 'Apačia',
    ],

    'console' => [
        'stats' => 'Blokai virš konsolės',
        'stats_helper' => 'Pelican rodo virš terminalo pavadinimą, būseną, adresą ir tris naudojimo skaičius. Juos paslėpti reiškia grąžinti konsolei aukštį.',
        'stats_tiles' => 'Plytelės — užrašas, skaičius ir piktograma',
        'stats_plain' => 'Paprasti — kaip juos piešia Pelican',
        'stats_off' => 'Paslėpti',
    ],

    'terminal' => [
        'helper' => 'Perduodami pačiam terminalui, tad įsigalioja kitą kartą įkėlus puslapį, o ne tą akimirką, kai išsaugomi.',

        'renderer' => 'Piešia',
        'renderer_helper' => 'Pelican piešia terminalą GPU, o tai kur kas greičiau prieš riedančios išvesties sieną. Naršyklė vienu metu palaiko gyvą tik tam tikrą GPU kontekstų skaičių — telefone mažiau — ir pašalina seniausią, kai riba peržengiama; terminalas tada nieko nebepiešia, be klaidos. Jei tavo konsolė ištuštėja, kol viskas kita aplink ją atrodo teisingai, būtent šią nuostatą ir keičia.',
        'renderer_webgl' => 'GPU — paties Pelican, greitesnis',
        'renderer_dom' => 'Naršyklė — lėtesnė, piešia visada',

        'scheme' => 'Spalvų schema',
        'scheme_helper' => 'Vienintelė terminalo nuostata, kurios Pelican nesiūlo. „Sekti tema“ išveda spalvas iš akcento, ir būtent todėl tai apskritai egzistuoja.',
        'scheme_theme' => 'Sekti tema',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Žymeklis',
        'cursor_helper' => 'Konsolė nepriima rinkimo — komandų laukas yra po ja — tad tai ta vieta, kur išvestis sustojo, o ne ta, kur esi tu.',
        'cursor_underline' => 'Pabraukimas — paties Pelican',
        'cursor_block' => 'Blokas',
        'cursor_bar' => 'Brūkšnys',

        'blink' => 'Mirksintis žymeklis',

        'scrollback' => 'Slinkimo istorija',
        'scrollback_helper' => 'Kaip toli atgal galima slinkti konsolę. Kiekviena eilutė laikoma naršyklėje, tad plepus serveris su aukšta nuostata yra tikra atmintis toje mašinoje, kuri skaito.',
        'scrollback_lines' => ':lines eilutės',
    ],

    'notice' => [
        'text' => 'Žinutė',
        'text_helper' => 'Viena eilutė, iki 200 ženklų. Pakeičiama saugia forma ir įeinant, ir išeinant, tad ji negali įnešti žymių į puslapį, kurį įkelia kiti žmonės.',
        'style' => 'Tonas',
        'style_info' => 'Informacija',
        'style_warning' => 'Įspėjimas',
        'style_danger' => 'Skubu',
        'style_accent' => 'Akcento spalva',
        'scope' => 'Rodoma',
        'scope_all' => 'Visiems',
        'scope_client' => 'Tik už administravimo dalies ribų',
        'scope_admin' => 'Tik administravimo dalyje',
        'link_label' => 'Mygtuko tekstas',
        'link_url' => 'Mygtuko adresas',
        'link_url_helper' => 'https:// arba kelias šio skydelio viduje, pavyzdžiui /account. Visa kita nepaisoma — nuoroda juostoje, matomoje kiekviename puslapyje, nėra vieta schemai, kurios niekas nesitikėjo.',
        'dismissible' => 'Galima uždaryti',
        'dismissible_helper' => 'Uždarymas įsimenamas kiekvienai naršyklei atskirai, ir tik šiai žinutei: pakeisk tekstą, ir ji grįžta visiems.',
        'dismiss' => 'Uždaryti',
    ],

    'preset' => [
        'label' => 'Stilius',
        'helper' => 'Pasirink išvaizdą, nuo kurios pradėti. Ji užpildo viską žemiau, ką paskui gali keisti. „Jokio“ išjungia temą ir palieka skydelį lygiai tokį, kokį jį pateikia Pelican.',
        'options' => [
            'none' => 'Jokio - be temos',
            'legend' => 'Legend - raudona ugnis, pereinanti į mėlyną žaibą',
            'ember' => 'Ember - šilta juoda, oranžinis akcentas',
            'midnight' => 'Midnight - gili mėlyna, rami',
            'crimson' => 'Crimson - raudona, aštrūs kampai, glausta',
            'forest' => 'Forest - žalia, apvali, be švytėjimo',
            'nebula' => 'Nebula - violetinė su perėjimo fonu',
            'terminal' => 'Terminal - žalia ant juodos, fiksuoto pločio, aštri',
            'console' => 'Console - apvali ir erdvi, planšetei',
            'nord' => 'Nord - Nord paletė, prislopinta',
            'solarized' => 'Solarized - Solarized dark, žydras akcentas',
            'paper' => 'Paper - šviesi, didelio kontrasto, plokščia',
            'daylight' => 'Daylight - šviesi ir šilta, su švelniu švytėjimu',
            'mono' => 'Mono - pilki tonai, plokščia ir tanki',
        ],

        'save' => 'Išsaugoti kaip stilių',
        'save_confirm' => 'Išlaiko tas spalvas, kampus, tą foną, šriftą, tas piktogramas ir matuoklių ribas, kurias turi ekrane kaip tik dabar — tavo paties pasirinktu pavadinimu, rinkiklyje šalia įtaisytųjų. Išsaugo tai, kas stovi puslapyje, o ne tai, kas buvo išsaugota paskutinį kartą.',
        'save_name' => 'Pavadinimas',
        'save_name_helper' => 'Kaip jis vadinsis rinkiklyje. Išsaugoti pavadinimu, kurį jau naudojai, reiškia jį pakeisti.',
        'saved' => 'Stilius išsaugotas',
        'save_failed' => 'To stiliaus išsaugoti nepavyko',
        'save_full' => 'Yra vietos :max savų stilių. Pirma ištrink vieną.',

        'delete' => 'Ištrinti stilių',
        'delete_which' => 'Kurį',
        'delete_confirm' => 'Trinti galima tik tavo paties stilius; įtaisytųjų - ne. Niekas nesikeičia tame, kaip skydelis atrodo dabar — stilius yra atspirties taškas, o kiekviena jo nustatyta reikšmė jau stovi nuostatose žemiau.',
        'deleted' => 'Stilius ištrintas',
        'deleted_current' => 'Tai buvo tas, į kurį šis skydelis buvo nustatytas. Jo nuostatos nepakitusios ir vis dar stovi šiame puslapyje — pasirink stilių arba išsaugok jas iš naujo pavadinimu.',
    ],

    'user_themes' => [
        'label' => 'Stiliai, kuriuos žmonės gali rinktis patys',
        'helper' => 'Pažymėti stiliai atsiranda Išvaizdos puslapyje kliento dalyje, kur kiekvienas prisijungęs gali išsirinkti vieną sau. Tai keičia tai, ką jie patys mato, ir nieko kitiems. Jokių varnelių reiškia, kad niekas nieko nesirenka ir kad skydelis laikosi vienos išvaizdos — o būtent tai jis ir daro dabar.',
    ],

    'mode' => [
        'label' => 'Skydelio režimas',
        'helper' => 'Kokiu režimu skydelis atsidaro. Kas nesirinko pats, gauna šį; rinkiklis naudotojo meniu vis tiek leidžia jiems jį pakeisti, nebent žemiau jį užrakinsi.',
        'dark' => 'Tamsus',
        'light' => 'Šviesus',
        'system' => 'Sistema — sekti lankytojo nuostata',
    ],

    'font' => [
        'label' => 'Skydelio šriftas',
        'helper' => 'Kiekviena galimybė yra šeima, kurią operacinė sistema jau turi — niekas neparsiunčiama iš šriftų tiekėjo. Terminalas nepaliečiamas: jo šriftas yra kiekvieno paties pasirinkimas, ties Paskyra.',
        'default' => 'Numatytasis - paties Pelican',
        'mono' => 'Fiksuoto pločio',
        'rounded' => 'Suapvalintas',
        'serif' => 'Serifinis',
        'system' => 'Sistema - tas, kurį naudoja ši mašina',
    ],

    'surface' => [
        'label' => 'Paviršiaus spalva',
        'helper' => 'Kortelės ir skydeliai. Šviesesni ir tamsesni atspalviai išvedami iš jos.',
        'placeholder' => 'Sekti tema',
    ],

    'radius' => [
        'label' => 'Kampai',
    ],

    'accent' => [
        'label' => 'Akcento spalva',
        'helper' => 'Naudojama mygtukams, nuorodoms, aktyviam navigacijos elementui ir fokuso žiedams.',

        /*
         * Pasakyta, o ne primesta. Spalva, apie kurią tai įspėja, vis tiek
         * išsaugoma: tai kažkieno skydelis, skaičius matuoja vieną dalyką, o yra
         * gerų priežasčių norėti akcento, kuris gauna prastą įvertinimą.
         * Rinkiklis pasako, ką mato, ir pasitraukia į šalį.
         */
        'contrast_dark' => 'Įskaitomumas: :ratio tamsiame skydelyje. Žemiau 3 akcentą sunku skaityti kaip mygtuką ar nuorodą — šviesesnis jį pakelia.',
        'contrast_light' => 'Įskaitomumas: :ratio šviesiame skydelyje. Žemiau 3 akcentą sunku skaityti kaip mygtuką ar nuorodą — tamsesnis jį pakelia.',
    ],
    'density' => [
        'label' => 'Tankis',
        'helper' => 'Glaustas suveržia tarpus, kad ekrane tilptų daugiau eilučių.',
        'comfortable' => 'Erdvus',
        'compact' => 'Glaustas',
    ],
    'force_dark' => [
        'label' => 'Priverstinis tamsus režimas',
        'helper' => 'Paslepia rinkiklį tarp šviesaus ir tamsaus ir laiko kiekvieną naudotoją tamsioje temoje.',
    ],
    'glass' => [
        'label' => 'Matinis topbar',
        'helper' => 'Sulieja topbar ir foną už dialogų. Išjunk jį silpnesniuose įrenginiuose.',
    ],
    'glow' => [
        'label' => 'Akcento švytėjimas',
        'helper' => 'Švelnus akcento šešėlis ant svarbiausių mygtukų, ant aktyvios navigacijos ir ant prisijungimo kortelės.',
    ],

    'background' => [
        'label' => 'Fono tipas',
        'helper' => 'Aurora yra paties temos fonas: akcento švytėjimas su smulkiu grūdėtumu.',
        'aurora' => 'Aurora (numatytasis)',
        'solid' => 'Viena spalva',
        'gradient' => 'Perėjimas',
        'image' => 'Paveikslėlis',
        'color' => 'Spalva',
        'base' => 'Spalva už švytėjimo',
        'base_helper' => 'Tai, ant ko puslapis remiasi, prieš užpiešiant ant jo akcento švytėjimą. Palik tuščią, kad išlaikytum numatytąją skydelio reikšmę, beveik juodą tamsiame ir beveik baltą šviesiame režime. Jei ją nustatysi, schema išlaiko savo nakties spalvą ir vis tiek nušvinta.',
        'color_end' => 'Antra spalva',
        'angle' => 'Kryptis',
        'upload' => 'Įkelk paveikslėlį',
        'upload_helper' => 'Iki 8 MB. Įkeltas paveikslėlis nugali žemiau esantį adresą.',
        'url' => 'Arba URL',
        'url_helper' => 'Turi prasidėti https:// ir būti pasiekiamas iš išorės.',
        'dim' => 'Tamsinti',
        'dim_helper' => 'Be tamsinimo baltas tekstas ant šviesaus paveikslėlio neįskaitomas.',
        'blur' => 'Suliejimas',
    ],

    'channel' => [
        'installed' => 'įdiegta',
        'version' => 'Įdiegti tam tikrą versiją',
        'version_helper' => 'Bet kuri šio kanalo laida, o ne tik naujausia — kad grįžtum atgal, kai kas nors nauja pasirodo blogesnis, arba pirmyn į sudėjimą, kurį kas nors paprašė išbandyti. Tik tol, kol atnaujinimai nediegia savęs patys: su tuo įjungtu tavo pasirinkimas galiotų tik iki kito patikrinimo.',
        'version_placeholder' => 'Pasirink versiją',
        'version_install' => 'Įdiegti šią versiją',
        'version_confirm' => 'Skydelis parsiunčia tą laidą, iš naujo sudeda savo asset ir išvalo savo podėlius. Tavo nuostatos išsaugomos. Grįžti prie senesnės versijos leidžiama, ir niekas už tave neatsukama — pasirink naujesnę iš naujo, kad eitum pirmyn.',
        'label' => 'Atnaujinimų kanalas',
        'helper' => 'Kurias laidas siūlo Temos puslapis. Beta gauna naujas versijas pirma, ir aštrius kraštus taip pat pirma.',
        'stable' => 'Stabilus',
        'beta' => 'Beta',
        'dev' => 'Dev (darbinė šaka)',
        'auto' => [
            'label' => 'Diegti atnaujinimus automatiškai',
            'helper' => 'Išjungta palieka atnaujinimą tau. Įjungta priverčia skydelį tikrinti pasirinktą kanalą ir diegti viską, kas naujesnė - jis tuo metu iš naujo sudeda savo asset ir kelias minutes yra nepasiekiamas, todėl kasdienis ir savaitinis vyksta 04:00. Reikalauja, kad skydelio cron veiktų.',
            'interval' => 'Tikrink kas',
            'minute' => 'Kas minutę',
            'five_minutes' => 'Kas 5 minutes',
            'ten_minutes' => 'Kas 10 minučių',
            'thirty_minutes' => 'Kas 30 minučių',
            'hourly' => 'Kas valandą',
            'daily' => 'Kasdien (04:00)',
            'weekly' => 'Kas savaitę (pirmadienį 04:00)',
        ],
    ],

    /*
     * Kalbų kortelė.
     *
     * Atsargiai su tuo, ką ji teigia. Pelican jau leidžia kiekvienam pasirinkti
     * kalbą visai savo paskyrai ir jau ją naudoja; niekas čia to nekeičia ir
     * neturi. Tai sprendžia tik tai, ar paties šio papildinio tekstai seka tuo
     * pasirinkimu.
     */
    'languages' => [
        'section_helper' => 'Pelican jau leidžia kiekvienam pasirinkti kalbą savo paskyrai, o šis papildinys ja seka ten, kur yra į ją išverstas. Čia sprendi, kuriomis iš jų jis seka. Dauguma kalbų stovi ties žemu procentu tyčia: pirma verčiama ta dalis, kurią visi mato kiekviename puslapyje — maitinimo mygtukai virš konsolės ir node matuokliai — o likusi ateina taip, kaip žmonės ją atneša.',
        'panel' => 'Tegul tai sprendžia viso skydelio kalbą',
        'panel_helper' => 'Įjungta: kalba, kurios šis papildinys neneša — arba tokia, kuri žemiau išjungta — perjungia visą skydelį į anglų tam skaitytojui, o ne tik šiuos puslapius. Išjungta: sąrašu seka tik šis papildinys, o Pelican ir toliau kalba ta kalba, į kurią nustatyta paskyra, o tai reiškia, kad skaitytojas gali sutikti dvi kalbas viename ekrane. Nė viena paskyra nekeičiama nė į vieną pusę: įjunk kalbą iš naujo, ir jie ją atgauna.',
        'label' => 'Kalbos, kuriomis atsakyti',
        'helper' => 'Nuimti varnelę reiškia grąžinti tuos skaitytojus, kuriems ji nustatyta paskyroje, prie anglų kalbos tik šiam papildiniui — likusi skydelio dalis ir toliau kalba jų kalba. Anglų kalbos sąraše nėra, nes viskas krenta atgal į ją.',
        'under' => 'nesiūloma, kol nepažengs toliau — pažymėk, kad vis tiek pasiūlytum',
        'done' => 'išversta :percent%',
        'main' => 'Pagrindinė kalba',
        'main_helper' => 'Tai, ką skaitytojas gauna, kai jo paties kalbos naudoti negalima — arba šis papildinys jos neneša, arba ji nepažymėta žemiau. Tai visada buvo anglų; komandoje, kuri nedirba angliškai, tai buvo klaidingas atsakymas, duotas su pasitikėjimu. Varnelės žemiau nuimti negalima, nes viskas krenta atgal į ją.',
        'labels' => 'Kaip kiekviena kalba vadinasi',
        'labels_helper' => 'Pavadinimas, kurį skaitytojai ir administratoriai mato rinkikliuose. Palik vieną tuščią, kad išlaikytum tą pavadinimą, kuriuo šis papildinys ją pažįsta. Kalba, įkelta tavo paties sugalvotu pavadinimu, tokio neturi, tad stovėtų su savo kodu, kol jai čia nesuteiksi vieno.',
        'labels_code' => 'Kodas',
        'labels_name' => 'Rodoma kaip',
        'download' => 'Parsisiųsti vertimo failą',
        'download_from' => 'Pradėk nuo',
        'download_from_helper' => 'JSON su kiekvienu šio papildinio tekstu. Pasirink anglų kalbai, kurios niekas nepradėjo, arba esamą, kad statytum ant to, kas jau išversta.',
        'code' => 'Kalbos kodas',
        'code_helper' => 'Kodas, kuriam failas skirtas. Tikras locale, kaip juos naudoja paskyros — fr, de, pt_BR — pasiekia tuos skaitytojus, kuriems jis nustatytas, ir turi sutapti tiksliai, kitaip nepasiekia. Tavo paties sugalvotas pavadinimas, kaip Gaming-LT, yra leidžiamas ir veikia kitaip: Pelican leidžia paskyrai turėti tik tikrą locale, tad tavojo niekas pasirinkti negali. Jis pasiekiamas kaip pagrindinė kalba aukščiau, o tai yra tai, ką gauna visi, kurių pačių naudoti negalima.',
        'url' => 'Arba parsisiųsk jį iš adreso',
        'url_helper' => 'https adresas, kurį skydelis gali pasiekti — CDN, bucket, žalias failas saugykloje. Parsiunčiamas vieną kartą, kai išsaugai, ir įrašomas taip pat kaip įkeltas, tad pakeisti failą tuo adresu vėliau nieko nedaro, kol neišsaugosi iš naujo. Aukščiau pasirinktas failas nugali adresą, likusį šiame lauke.',
        'upload' => 'Įkelk vertimo failą',
        'upload_helper' => 'JSON failas iš viršaus, su išverstomis reikšmėmis. Jis įrašomas už papildinio ribų, tad atnaujinimas jo neišmeta, ir dedamas ant anglų kalbos raktas po rakto — failas su puse tekstų duoda tau pusę kalbos ir anglų kalbą likusiai.',
        'uploaded' => 'Įdiegta tekstų kalbai :code: :count',
        'uploaded_halves' => 'Iš jų :mine yra paties šio papildinio tekstai, o :panel — skydelio. Nulis vienoje pusėje reiškia, kad ta failo pusė nieko neturėjo — papildinio raktai prasideda essentials::, o skydelio - ne.',
        'uploaded_skipped' => 'Praleista :count: tušti, arba raktai, kurių šis papildinys neturi. Pirmieji: :keys',
        'upload_failed' => 'To failo nuskaityti nepavyko',
        'upload_failed_body' => 'Tai turi būti JSON failas iš parsisiuntimo aukščiau — plokščias raktų ir tekstų objektas. Patikrink, ar koks nors redaktorius jo neišsaugojo kaip ko nors kito.',
    ],

    'windows' => [
        'add' => 'Pridėti langą',
        'from' => 'Nuo',
        'to' => 'Iki',
        'to_helper' => 'Anksčiau nei pradžia reiškia, kad jis pereina vidurnaktį — 22:00 iki 06:00 yra naktis.',
        'preset' => 'Stilius',
        'days' => 'Dienos',
        'days_helper' => 'Palik visas be varnelių kiekvienai dienai. Langas, pereinantis vidurnaktį, priklauso tai dienai, kurią prasideda, tad penktadienis 22:00 iki 06:00 apima šeštadienio rytą.',
        'day_mon' => 'Pirmadienis',
        'day_tue' => 'Antradienis',
        'day_wed' => 'Trečiadienis',
        'day_thu' => 'Ketvirtadienis',
        'day_fri' => 'Penktadienis',
        'day_sat' => 'Šeštadienis',
        'day_sun' => 'Sekmadienis',
    ],

    'arranger' => [
        'label' => 'Puslapio dėliotojas',
        'helper' => 'Mygtukas „Sudėliok puslapį“, kiekviename skydelio puslapyje. Kiekvienas, turintis Dėliojimo teisę, jį gauna ir gali taip pat nustatyti tą išdėstymą, nuo kurio visi kiti pradeda, arba vieną vaidmeniui. Išjungta paslepia jį nuo visų; jau išsaugoti išdėstymai lieka ten, kur yra.',
        'roles' => 'Išdėstymas nėra teisė. Blokas, kurį vaidmuo paslepia, vis tiek lieka bloku, kurį kas nors galėtų pasiekti surinkęs adresą — tai, kas tai sustabdo, yra pačios Pelican teisės, vaidmenų puslapyje. Trys sluoksniai dedami tokia tvarka: tas, nuo kurio visi pradeda, paskui skaitytojo vaidmuo, paskui tai, ką jis pats perkėlė.',
        'users' => 'Leisk visiems dėlioti savo puslapius',
        'users_helper' => 'Įjungta leidžia kiekvienam prisijungusiam perkelti ir slėpti blokus tuose puslapiuose, kuriuos jis jau mato, tik sau — tai nieko nekeičia kitiems. Nustatyti tą išdėstymą, nuo kurio visi pradeda, lieka prie Dėliojimo teisės.',
    ],

    'brand' => [
        'logo_height' => 'Logotipo aukštis',
        'logo_height_helper' => 'Pelican pateikia 2rem. Didesnės reikšmės padaro aukštesnę ir šoninės juostos galvutę.',
        'logo_url' => 'Pakeisti logotipą',
        'logo_url_helper' => 'Palik tuščią, kad išlaikytum tai, į ką rodo pačios Pelican nuostatos.',
    ],

    'login' => [
        'image' => 'Fono paveikslėlis',
        'image_helper' => 'Tik prisijungimo ekranui. Be jo jis vis tiek rodo skydelio foną.',
        'url' => 'Arba URL',
        'blur' => 'Kortelės suliejimas',
        'blur_helper' => 'Padaro kortelę matinę, kad už jos esantis paveikslėlis prašviestų.',
        'width' => 'Kortelės plotis',
        'position' => 'Paveikslėlio kadravimas',
        'position_helper' => 'Kuri paveikslėlio dalis išgyvena apkirpimą pagal ekraną.',
        'position_center' => 'Centre',
        'position_top' => 'Viršuje',
        'position_bottom' => 'Apačioje',
        'position_left' => 'Kairėje',
        'position_right' => 'Dešinėje',
        'align' => 'Kortelės vieta',
        'align_helper' => 'Kur prisijungimo kortelė stovi per ekraną.',
        'align_center' => 'Centre',
        'align_start' => 'Kairėje',
        'align_end' => 'Dešinėje',
        'opacity' => 'Kortelės nepermatomumas',
        'opacity_helper' => 'Mažesnis praleidžia pro kortelę daugiau paveikslėlio.',
        'glow' => 'Akcento švytėjimas',
        'glow_helper' => 'Aureolė aplink kortelę. Išjungta išlaiko jos rėmelį ir gylį.',
        'hide_heading' => 'Slėpti antraštę',
        'hide_heading_helper' => 'Pašalina antraštę virš formos ir palieka formą vieną.',
        'hide_footer' => 'Slėpti apačios eilutę',
        'hide_footer_helper' => 'Pašalina eilutę po kortele, vedančią į pelican.dev.',
        'above' => 'Eilutė virš formos',
        'above_helper' => 'Viena eilutė, rodoma kiekvienam, kas patenka į prisijungimo ekraną. Palik tuščią, kad nebūtų.',
        'notice' => 'Žinutė po kortele',
        'notice_helper' => 'Viena eilutė, rodoma kiekvienam, kas patenka į prisijungimo ekraną. Palik tuščią, kad nebūtų.',
    ],

    'advanced' => [
        'css' => 'Savas CSS',
        'css_helper' => 'Iki 100 KB. Saugoma storage, o ne .env.',
        'reference' => 'CSS žinynas',
        'reference_helper' => 'Kiekvienas kintamasis ir klasė, kuriuos ši tema ir skydelis pateikia.',
    ],

    'areas' => [
        'add' => 'Pridėti sritį',
        'area' => 'Sritis',
        'inherit' => 'Bendra',
        'radius' => 'Kampai',
        'radius_sharp' => 'Aštrūs',
        'radius_normal' => 'Įprasti',
        'radius_round' => 'Apvalūs',
        'surface' => 'Paviršiaus spalva',
        'surface_helper' => 'Kortelės ir skydeliai šios srities viduje; šviesesni ir tamsesni atspalviai išvedami iš jos.',
        'names' => [
            'terminal' => 'Terminalas',
            'console' => 'Konsolė (likusi puslapio dalis)',
            'files' => 'Failų puslapis',
            'edit' => 'Redagavimo puslapis',
            'server' => 'Kiti serverio puslapiai ir kortelės',
        ],
    ],

    'bars' => [
        'base' => 'Pagrindinė spalva',
        'base_green' => 'Žalia',
        'base_accent' => 'Akcento spalva',
        'warning' => 'Gintarinė nuo',
        'danger' => 'Raudona nuo',
    ],

    'icons' => [
        'stroke' => 'Linijos storis',
        'stroke_thin' => 'Plona',
        'stroke_normal' => 'Įprasta',
        'stroke_bold' => 'Stora',
        'scale' => 'Dydis',
        'accent' => 'Meniu piktogramos akcento spalva',
        'accent_helper' => 'Galioja šoninės juostos ir topbar piktogramoms.',
        'pack' => 'Piktogramų paketas',
        'pack_helper' => 'Iš kurio rinkinio ima žemiau esantis rinkiklis. Siūlomas kiekvienas serveryje įdiegtas piktogramų rinkinys, plius Essentials rinkinys, ateinantis su šiuo papildiniu, ir kiekvienas tavo įkeltas paketas. Vieną skirtumą verta žinoti: linijinė piktograma piešiama meniu spalva ir seka užvedimu bei aktyvia eilute, o Essentials piktogramos yra paveikslėliai ir vietoj to išlaiko savo pačių spalvas. Tai sprendžia tai, kas yra failas, o ne tai, iš kurio rinkinio jis atėjo.',
        'pack_custom' => 'Įkeltas paketas',
        'pack_shipped' => 'Essentials piktogramos',
        'use_shipped' => 'Naudoti Essentials piktogramas visur',
        'use_shipped_confirm' => 'Nustato paketą į Essentials piktogramas ir užpildo kiekvieną meniu eilutę žemiau ta piktograma, kuri jai nupiešta — konsolė gauna terminalą, paleidimas gauna paleidimo mygtuką, ir taip toliau. Tai pakeičia tas eilutes, kurias turi dabar, ir niekas neišsaugoma, kol nepaspausi Išsaugoti, tad uždaryti puslapį reiškia tai atšaukti.',
        'pack_upload' => 'Įkelk paketą',
        'pack_upload_helper' => 'Vienas .zip su SVG failais. Kiekvienas failas tampa piktograma, pavadinta pagal jį — logo.svg tampa custom-logo. Įkėlimas pakeičia tą paketą, kuris dabar ten yra. Failai virš 256 KB ir viskas virš 4000 piktogramų lieka lauke, ir tau pasakoma kiek: masteliui, visas Tabler rinkinys yra beveik šeši tūkstančiai piktogramų maždaug trijuose megabaituose, tad daug didesnis paketas neša kažką kita nei piktogramas, ir didesnė jo dalis bus praleista. Didelis įkėlimas gali būti atmestas ir anksčiau, nei šis laukas ką nors pasakys — upload_max_filesize ir post_max_size skydelio mašinos php.ini, o jokia nuostata čia jų pakelti negali.',
        'pack_partial' => 'Įdiegta :count piktogramų, bet ne visos',
        'pack_partial_body' => 'Praleista: :big per didelės piktogramai, :unusable netinkamos kaip SVG, :duplicate su vardu, kuris jau užimtas, :empty liko be nieko, ką piešti, po išvalymo. SVG virš 256 KB beveik visada yra paveikslėlis, suvyniotas į tokį, o ne piešinys — eksportuok jį piktogramos dydžiu, ir bus pora kilobaitų. Piktograma, likusi be nieko, ką piešti, turėjo tik tai, ko tai nepateikia — jei tai visas paketas, verta pranešti.',
        'pack_stopped_files' => 'Jis sustojo ir ties riba, kiek piktogramų paketas gali turėti.',
        'pack_stopped_size' => 'Jis sustojo ir dėl to, kad likusi paketo dalis išsiskleidžia į daugiau, nei skydelis gali laikyti atmintyje iš karto — zip gali būti mažesnis už tai, nes SVG suspaudžiamas maždaug penki į vieną.',
        'overrides' => 'Pakeisti piktogramas',
        'overrides_helper' => 'Po vieną eilutę kiekvienai piktogramai, kurią nori pakeisti. Pasirink meniu elementą, o tada pasirink piktogramą iš paketo aukščiau, nurodyk adresą arba įkelk savo paveikslėlį. Jei užpildyta daugiau nei viena, nugali įkėlimas, tada adresas, tada paketas.',
        'overrides_key' => 'Meniu elementas',
        'overrides_value' => 'Piktograma iš paketo',
        'overrides_url' => 'Arba adresas',
        'overrides_url_helper' => 'https adresas į paveikslėlį, kurį pats laikai — CDN, bucket, bet kur, kur naršyklė pasiekia. Niekas nekopijuojama į skydelį, tad pakeisti failą tuo adresu reiškia pakeisti piktogramą neliečiant šio puslapio; kita pusė yra piktograma, kuri dingsta, kai dingsta adresas. Ji išlaiko savo pačios spalvas, kaip įkeltas paveikslėlis.',
        'overrides_file' => 'Arba įkelk paveikslėlį',
        /*
         * Pasako, koks skirtumas iš tikrųjų, nes jis nėra akivaizdus ir nes
         * būtent dėl to pasirenkama viena, o ne kita.
         */
        'overrides_file_helper' => 'PNG, SVG ar ICO. Piktograma iš paketo piešiama pačia meniu spalva ir seka užvedimu bei aktyvia eilute; įkeltas paveikslėlis išlaiko savo pačios spalvas ir to nedaro. Logotipui paprastai to ir norima.',
        'overrides_add' => 'Pakeisti dar vieną piktogramą',
        'overrides_search' => 'Įrašyk pavadinimą arba meniu elementą…',
    ],

    /*
     * Ne po ženklu. Ženklas yra apie tai, kaip skydelis atrodo; tai yra apie
     * tai, kaip šis papildinys jame pasirodo, o tai kitas klausimas, į kurį
     * atsakoma kitame puslapyje.
     */
    'identity' => [
        'nav_icon' => 'Piktograma eilutei „Essentials nuostatos“',
        'nav_icon_helper' => 'PNG, SVG ar ICO, iki 8 MB. Pakeičia piktogramą būtent toje vienoje šoninės juostos eilutėje; palik tuščią tai, su kuria šis papildinys ateina. Ji piešiama kaip paveikslėlis, o ne kaip piktograma, tad išlaiko savo pačios spalvas, užuot sekusi tekstu — o to logotipas paprastai ir nori. Failas pateikiamas, o ne įterpiamas, tad kiekviena naršyklė jį parsiunčia vieną kartą, bet vis tiek verta eksportuoti ką nors mažo: poros kilobaitų su kaupu užtenka dvidešimties pikselių eilutei. Jei įkėlimas nepavyksta anksčiau, nei šis laukas ką nors pasako, ta riba, į kurią jis atsimušė, yra upload_max_filesize skydelio php.ini.',
    ],
];
