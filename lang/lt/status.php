<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * Viešas būsenos puslapis.
 *
 * Vienintelis dalykas, kurį šis papildinys pateikia neprisijungusiam, ir
 * vienintelis puslapis, kurio žodžius reikia skaityti taip, kaip juos matytų
 * svetimas - nes svetimas juos ir pamatys. Niekas čia nesako, kuris node, kuris
 * savininkas ar kuris adresas; vardas, ar veikia, ir kiek žmonių viduje.
 *
 * „Node“ pasitaiko tik nuostatose; pačiame viešame puslapyje rašoma „mašina“,
 * nes ten jį skaito tas, kas apie Pelican niekada negirdėjo.
 */

return [
    // ---- nuostatų puslapis -------------------------------------------------
    'title' => 'Viešas būsenos puslapis',
    'nav_label' => 'Būsenos puslapis',
    'subheading' => 'Puslapis, kurį kiekvienas gali atidaryti be paskyros ir kuris rodo, kurie tavo serveriai veikia. Jame niekas nepasirodys, kol žemiau nepaminėsi serverio.',

    'address' => 'Tavo būsenos puslapis yra adresu',
    'address_off' => 'Kol kas niekas nepateikiama. Pridėk žemiau serverį, mašiną ar paslaugą ir išsaugok, ir adresas pasirodys čia.',

    'which' => 'Kas skelbiama',
    'which_helper' => 'Sąrašas prasideda tuščias, ir niekas nėra vieša, kol jame kas nors neatsiranda. Siūlomi tik tie serveriai, kuriuos jau gali atidaryti.',
    'add' => 'Paskelbti serverį',
    'server' => 'Serveris',
    'shown_as' => 'Rodomas kaip',
    'shown_as_helper' => 'Tai, ką mato publika. Parašyk tai pats, užuot leidęs skydeliui imti tikrąjį vardą — „mc-prod-3 (neliesti)“ yra užrašas sau, o ne tai, ką dedama į forumą.',

    'look' => 'Formuluotės',
    'look_helper' => 'Viską šiame puslapyje skaito žmonės, neturintys paskyros.',
    'heading' => 'Antraštė',
    'heading_helper' => 'Jei tuščia, naudojamas paties skydelio vardas.',
    'note' => 'Eilutė virš sąrašo',
    'note_helper' => 'Kad pasakytum, kas vyksta — priežiūros langas arba kur galima paklausti. Paprastas tekstas.',
    'link' => 'Nuoroda į skydelį',
    'link_helper' => 'Kelias atgal vidun, puslapio apačioje. Išjunk ją, jei verčiau neatskleistum, kur stovi tavo skydelis.',

    'save' => 'Išsaugoti',
    'saved' => 'Išsaugota',
    'save_failed' => 'Niekas nebuvo išsaugota',
    'open' => 'Atidaryti puslapį',

    // ---- žaidėjų skaičiai --------------------------------------------------
    'counts' => 'Žaidėjų skaičiai',
    'counts_helper' => 'Iš kur ateina skaičiai šalia serverio. Minecraft serveriai atsako į savo paties rankos paspaudimą ir derinami ties Minecraft; visa, kas žemiau, galioja toms žaidimams, kurie atsako į Valve užklausą — Rust, ARK, Valheim, 7 Days to Die ir daugumai kitų, veikiančių ant Source ar Unreal.',
    'query_eggs' => 'Egg, atsakantys į Valve užklausą',
    'query_eggs_helper' => 'Pažymėk tų žaidimų egg. Tas pats sąrašas lemia ir tai, kurie serveriai gauna Žaidėjų puslapį skydelio viduje — vienas klausimas dėl dviejų priežasčių. Niekas neklausiama, kol tu nepasakai: tai vienintelis dalykas čia, kuris atveria ryšį iš skydelio tiesiai į žaidimo prievadą, tad tai pasirinkimas, o ne kažkas, kas prasideda savaime. Serveris, kurio prievado skydelis nepasiekia, tiesiog nerodo skaičių.',

    // ---- node --------------------------------------------------------------
    'nodes' => 'Mašinos',
    'nodes_helper' => 'Viršuje ar apačioje, ir nieko daugiau. Ne apkrova ir ne tai, kiek diskas pilnas — tam, kas klausia, ar gali žaisti, nereikia tavo geležies talpos ataskaitos, o paskelbti tokią yra žemėlapis to, kur spaudžia.',
    'add_node' => 'Paskelbti mašiną',
    'node' => 'Mašina',
    'node_shown_as_helper' => 'Parašyk tai pats. Node paprastai vadinasi kažkaip panašiai kaip hetzner-fsn1-01, o tai ištisas sakinys apie tai, kur stovi tavo mašinos.',

    // ---- HTTP stebėjimai ---------------------------------------------------
    'monitors' => 'Kitos paslaugos',
    'monitors_helper' => 'Visa kita, apie ką verta žinoti, kad veikia: tavo svetainė, koks nors API, boto health endpoint. Skydelis klausia kiekvieno iš jų tuo pačiu ritmu kaip ir serverių. Tik administratoriai — stebėjimas priverčia šį skydelį parsisiųsti adresą, o jei pridėti tokį gali bet kas, jis virsta zondu, kurį nukreipi kur nori.',
    'add_monitor' => 'Pridėti paslaugą',
    'monitor_name' => 'Pavadinimas',
    'monitor_url' => 'Adresas',
    'monitor_url_helper' => 'Tik https. Jei šis skydelis reguliariai siųstųsi paprastą http, visi kelyje žinotų, kurios tavo paslaugos egzistuoja.',
    'monitor_expect' => 'Tikisi',
    'monitor_expect_helper' => 'Palik tuščią „bet kokiam atsakymui“, o tai tinka svetainei, kuri peradresuoja arba atsako 403 į plikinę užklausą. Skaičius skirtas endpoint, parašytam sakyti būtent tai ir nieko daugiau — nustatytas per griežtai, eilutė amžinai stovi raudona ties paslauga, kuriai nieko nėra.',

    // ---- puslapiai naudotojams ---------------------------------------------
    'users' => 'Puslapiai tavo naudotojams',
    'users_helper' => 'Ar žmonės, turintys serverių šiame skydelyje, gali skelbti savo pačių būsenos puslapį.',
    'user_pages' => 'Leisk naudotojams pasidaryti savo',
    'user_pages_helper' => 'Kiekvienas gauna savo adresą ties /status/jų-vardas, kur stovi tik jo turimi serveriai, tais vardais, kuriuos jis pats įrašo. Jokių mašinų ir jokių kitų paslaugų juose — abu dalykai tik tavo. Kai tai įjungta, jie randa tai ties Būsenos puslapis savo paskyros meniu, kokiame skydelyje bebūtų.',

    // ---- išvaizda ----------------------------------------------------------
    'every' => 'Tikrink kas',
    'every_helper' => 'Kaip dažnai puslapis sudedamas iš naujo, ir kaip dažnai jis atsinaujina naršyklėje. Puslapis, į kurį žmonės žiūri paleidimo iš naujo metu, nori sekundžių; toks, į kurį nukreipiama iš forumo ir kurio niekas nelaiko atidaryto, nori valandos, o klausti kiekvieno node kas minutę dėl jo yra darbas, atliktas niekam.',
    'every_realtime' => 'Realusis laikas (10 sekundžių)',
    'every_30s' => '30 sekundžių',
    'every_1m' => '1 minutė',
    'every_5m' => '5 minutės',
    'every_10m' => '10 minučių',
    'every_30m' => '30 minučių',
    'every_60m' => '60 minučių',

    'style' => 'Stilius',
    'style_helper' => 'Vienas iš paties skydelio išvaizdų, pritaikytas šiam puslapiui: jo spalva, pilki tonai, sudėti iš jo paviršiaus, ir kiek apvalūs kampai. „Sekti skydeliu“ reiškia tą, kuris nustatytas šiandien, įskaitant viską, kas pasikeis vėliau.',
    'style_mine_helper' => 'Tie stiliai, kuriuos šis skydelis siūlo, pritaikyti tavo puslapiui: spalva, pilki tonai, sudėti iš jos, ir kiek apvalūs kampai. Kurie stiliai yra sąraše, sprendžia skydelio savininkas — tas pats sąrašas, iš kurio gali rinktis ties Išvaizda. „Sekti skydeliu“ reiškia tą, kuris nustatytas.',
    'style_panel' => 'Sekti skydeliu',

    // ---- savas puslapis ----------------------------------------------------
    'mine_title' => 'Mano būsenos puslapis',
    'mine_nav_label' => 'Būsenos puslapis',
    'mine_subheading' => 'Vienas adresas, kurį duodi tiems žmonėms, kurie žaidžia tavo serveriuose. Jis rodo tavo pasirinktus serverius ir nieko daugiau apie šį skydelį.',
    'mine_address' => 'Tavo adresas',
    'mine_address_helper' => 'Pasirink ką nors trumpo. Pakeisti jį vėliau reiškia sulaužyti kiekvieną nuorodą, kurią kas nors jau išsaugojo.',
    'mine_address_off' => 'Pasirink žemiau adresą ir išsaugok, ir tavo puslapis pasirodys čia.',
    'slug' => 'Adresas',
    'slug_helper' => 'Mažosios raidės, skaitmenys ir brūkšneliai. Trys ženklai ar daugiau.',
    'mine_heading' => 'Antraštė',
    'mine_heading_helper' => 'Jei tuščia, naudojamas tavo adresas.',
    'mine_note_helper' => 'Kad pasakytum, kas vyksta — paleidimas iš naujo, renginys, kur tave rasti. Paprastas tekstas, ir jį skaito kiekvienas, turintis nuorodą.',
    'mine_which' => 'Tavo serveriai',
    'mine_which_helper' => 'Siūlomi tik tie serveriai, kuriuos pats turi. Būti subuser kitur yra prieiga prie mašinos, o ne teisė skelbti, kad ji egzistuoja.',
    'mine_shown_as_helper' => 'Tai, ką mato lankytojai. Parašyk tai pats, užuot ėmęs vardą iš skydelio, jei tas vardas yra užrašas sau.',
    'mine_look_helper' => 'Kaip tavo puslapis atrodo tiems, kuriems jį siunti.',
    'mine_remove' => 'Nuimti mano puslapį',
    'mine_remove_confirm' => 'Nuima tavo puslapį ir atlaisvina adresą kam nors kitam. Viskas, ką sutvarkei, prarandama; patys serveriai neliečiami.',
    'mine_removed' => 'Tavo puslapis nuimtas',

    'why_slug' => 'Tas adresas netinka. Mažosios raidės, skaitmenys ir brūkšneliai, trys ženklai ar daugiau — o keli žodžiai yra rezervuoti.',
    'why_taken' => 'Tą adresą jau turi kas nors kitas.',
    'why_unwritable' => 'Nepavyko įrašyti. Patikrink, ar storage/app priklauso tam naudotojui, kaip kuris veikia skydelis.',

    // ---- antraštės pačiame puslapyje ---------------------------------------
    'section_servers' => 'Serveriai',
    'section_nodes' => 'Mašinos',
    'section_monitors' => 'Paslaugos',

    // ---- pats puslapis -----------------------------------------------------
    'up' => 'Viršuje',
    'down' => 'Apačioje',
    'starting' => 'Pasileidžia',

    /*
     * Ne „apačioje“, ir skirtumas viešai svarbus.
     *
     * Skydelis nepasiekė serverio. Paprastai tai node priežiūroje arba demonas,
     * kuris pasileidžia iš naujo - tai ne tas pats, kas išjungtas serveris, o
     * pasakyti šimtui žaidėjų, kad jų serveris apačioje, kol jis veikia, yra
     * blogiau nei pripažinti, kad nežinai.
     */
    'unknown' => 'Nežinoma',

    'players' => 'Žaidėjai',
    'online_now' => 'žaidžia kaip tik dabar',
    'checked' => 'Tikrinta',
    'next_check' => 'iki kito patikrinimo',
    'just_now' => 'ką tik',
    'seconds_ago' => 'prieš :count sekundes',
    'panel' => 'Prisijungti',

    'all_up' => 'Viskas veikia.',
    'some_down' => 'Kažkas neveikia.',
    'empty' => 'Čia kol kas niekas neskelbiama.',
];
