<?php

/*
 * Română. Scrisă de mână.
 *
 * „Egg”, „node”, „subuser”, „Wings”, „queue”, „webhook”, „topbar”, „cron” și
 * numele formatelor de fișiere rămân cum sunt: sub acele nume le găsești în
 * Pelican, pe gazdă și în tot ce se scrie despre ele. Nici numele stilurilor nu
 * se traduc — un stil se numește cum se numește, iar un nume tradus ar fi încă
 * un nume pentru același lucru.
 */

return [
    'css_warning' => 'Salvat, dar acest CSS pare greșit',
    'css_unclosed' => 'O regulă deschisă la linia :line nu se închide niciodată. Tot ce urmează stă în interiorul acelei reguli și nu are niciun efect.',
    'css_extra' => 'La linia :line există o acoladă de închidere fără să fie nimic deschis. Tot ce urmează stă în afara oricărei reguli și se sare peste el.',
    'css_comment' => 'Un comentariu deschis la linia :line nu se închide niciodată, așa că restul fișierului stă în interiorul lui.',

    'groups' => [
        'appearance' => 'Aspect',
        'servers' => 'Lista de servere',
        'windows' => 'Stiluri după oră',
        'windows_helper' => 'Un alt stil între două ore ale zilei. Nu se întâmplă nimic până nu adaugi unul. Ceasul este chiar al panoului, din setarea lui de fus orar, și nu al fiecărui cititor — un panou care ar arăta diferit pentru doi oameni în aceeași clipă ar semăna cu ceva stricat, nu cu ceva plănuit. O fereastră schimbă aspectul pe care panoul îl are deja, deci nu face nimic cât timp stilul este „Niciunul”. Un stil pe care cineva și l-a ales pentru sine tot îl întrece.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Limbi',
        'servers_helper' => 'Cum se desenează o fișă de server. Dacă apar ca grilă sau ca listă este alegerea fiecăruia, la Cont → Aranjarea paginii de ansamblu.',
        'server_pages' => 'Pagini de server',
        'server_pages_helper' => 'Ce poartă fiecare pagină din interiorul unui server, oricare ar fi pagina.',
        'console' => 'Pagina de consolă',
        'console_helper' => 'Fontul, mărimea și înălțimea terminalului sunt alegerea fiecăruia, la Cont.',
        'background' => 'Fundal',
        'background_helper' => 'Se aplică întregului panou, inclusiv ecranului de conectare.',
        'icons' => 'Pictograme',
        'bars' => 'Indicatoare de resurse',
        'bars_helper' => 'Barele pentru procesor, memorie și disc de pe fișele serverelor.',
        'updates' => 'Actualizări',
        'updates_helper' => 'Ce lansări oferă pagina Temă și unde le caută.',
        'brand' => 'Marcă',
        'login' => 'Ecran de conectare',
        'login_helper' => 'Se aplică ecranelor de conectare, de resetare a parolei și de autentificare în doi pași.',
        'advanced' => 'CSS propriu',
        'advanced_helper' => 'Pentru tot ce nu acoperă setările de mai sus. Se încarcă după toate celelalte, deci el câștigă.',
        'areas' => 'Pe zone',
        'areas_helper' => 'Tot ce este mai sus se aplică peste tot. Aici poți pune o zonă deoparte; tot ce lași gol urmează în continuare setarea comună.',
        'footer' => 'Baza barei laterale',
        'footer_helper' => 'Partea de jos a barei laterale, pe care Pelicanul o lasă goală. Tot ce este aici este oprit până nu completezi.',
        'features' => 'Ce adaugă acest plugin',
        'features_helper' => 'Dacă scoți bifa de la ceva, acel lucru dispare complet din panou. Setările lui se păstrează, iar pagina lui își păstrează adresa, deci nu se pierde nimic dacă oprești ceva ca să vezi ce făcea. Cele mai multe au și permisiune proprie la Roluri, deci poți da una fără să le dai pe celelalte. Nu toate: indicatoarele de resurse, baza barei laterale și căutarea din setări se desenează pentru toată lumea și nu le comandă nimeni, steaua de pe o fișă de server îi aparține celui care a apăsat-o, iar paginile Palworld și Minecraft din interiorul unui server urmează permisiunile acelui server și nu vreuna de aici. Chiar aspectul nu este pe listă — are propriul lui comutator, la Look → Aspect → Stil → Niciunul.',
        'identity' => 'Acest plugin în bara laterală',
        'identity_helper' => 'Rândul pe care acest plugin îl adaugă barei laterale și imaginea de pe el.',
    ],

    /*
     * Paginile de setări, fiecare un rând în grupul propriu al pluginului din
     * bara laterală. Grupate după întrebarea la care răspunzi și nu după clasa
     * care le construiește.
     */
    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Culoare, formă și cum se numește panoul.',
        'pages' => 'Pagini',
        'pages_helper' => 'Lista de servere, paginile din interiorul unui server și terminalul.',
        'advanced' => 'Avansat',
        'advanced_helper' => 'Cele două ieșiri de urgență: CSS-ul tău și setările care se aplică unei singure zone.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Care egg-uri sunt Minecraft și tot restul despre asta.',
        'artwork' => 'Imagini pentru egg-uri',
        'artwork_helper' => 'O pagină cu fiecare egg și o cale de a aduce imaginea jocului de pe Steam sau IGDB. Scrie chiar în egg-uri — imaginea și două etichete care notează ce joc este și dacă imaginea a fost aleasă de mână — și de aceea are permisiune proprie.',
        'alerts' => 'Alerte',
        'alerts_helper' => 'O verificare periodică a ceea ce panoul măsoară deja, dar nu spune nimănui: un node care nu mai răspunde, un disc care se umple, un queue worker oprit, o versiune rămasă în urmă. Trimite pe Discord, în panou sau pe e-mail. Are permisiune proprie, pentru că ajunge periodic la fiecare node și trimite la o adresă tastată de cineva.',
        'backups' => 'Privire de ansamblu asupra copiilor',
        'backups_helper' => 'O pagină cu fiecare server și de cât timp a rămas fără copie, sortată astfel încât cele fără niciuna să fie sus. Doar citire — tot ce face ceva cu o copie rămâne pe pagina Pelicanului pentru acel server. Are permisiune proprie, pentru că lista este o hartă a locurilor unde sunt goluri.',
        'public_status' => 'Pagină publică de stare',
        'public_status_helper' => 'O pagină pe care oricine o poate deschide fără cont și care arată care dintre serverele tale rulează și câți sunt pe ele. Nu se publică nimic până nu menționezi un server, o mașină sau un serviciu — toate cele trei liste pornesc goale, iar cât timp sunt așa, adresa răspunde 404. Are permisiune proprie, pentru că ea hotărăște ce părăsește panoul.',
        'game_players' => 'Jucători, alte jocuri',
        'capacity' => 'Capacitate',
        'capacity_helper' => 'Ce s-a promis pe fiecare mașină față de cât are voie să împartă, ca să vezi dacă mai încape un server. Lista de node-uri a Pelicanului arată un nume și un număr de servere, iar blocul Mașini de pe pagina de ansamblu arată ce rulează - aceasta este a treia întrebare, iar calculul este chiar al Pelicanului. Doar citire. Are permisiune proprie.',
        'schedules' => 'Sarcini programate',
        'schedules_helper' => 'Fiecare sarcină programată de pe panou, cu cele care s-au oprit: blocate în mijlocul unei rulări, întârziate pentru că nu rulează cronul, sau niciodată rulate. Pelicanul arată programările în interiorul fiecărui server, iar starea lui nu are niciun cuvânt pentru niciunul dintre acele cazuri. Doar citire. Are permisiune proprie.',
        'activity' => 'Activitate',
        'activity_helper' => 'Fiecare eveniment înregistrat de panou, într-o singură listă și nu un server pe rând. Pelicanul ține jurnalul și îl arată pe server; aceasta întreabă același jurnal din cealaltă direcție. Doar citire. Are permisiune proprie, pentru că o privire de ansamblu asupra a cine ce a făcut este ceva ce dai intenționat.',
        'access' => 'Acces la servere',
        'access_helper' => 'Leagă un rol de servere, ca fiecare purtător al lui să ajungă la ele. Funcționează ținând la zi chiar subuserii Pelicanului, iar pe ei îi citesc deja lista de servere și fiecare verificare de permisiuni. Are permisiune proprie, pentru că este singura pagină de aici care dă oamenilor acces la ceva.',
        'games' => 'Alte jocuri',
        'games_helper' => 'Fișierele pe care ARK și Valheim le țin lângă lumea lor, ca formulare: setările de lume ale ARK și listele Valheim de admini, ban-uri și permiși. Care servere le primesc este lista de egg-uri de pe acea pagină, deci o listă goală este deja un comutator pentru fiecare joc.',
        'game_players_helper' => 'O pagină în interiorul Rust, ARK, Valheim și al oricărui altceva care răspunde interogării Valve, care arată cine este conectat și de cât timp. Doar citire — ce poți face cuiva diferă de la joc la joc, iar aceea este o lansare separată. Care egg-uri contează este aceeași listă pe care o folosește pagina de stare.',
        'api' => 'API',
        'api_helper' => 'Cheile pe care le au oamenii, cine a cerut una și ce poate vedea fiecare dintre ele.',
        'languages' => 'Limbi',
        'languages_helper' => 'În ce limbi răspunde acest plugin.',
    ],

    'features' => [
        'look' => 'Setări Look',
        'look_helper' => 'Rândul din bara laterală pentru culoare, formă și marcă.',
        'pages' => 'Setări de pagini',
        'pages_helper' => 'Rândul din bara laterală pentru lista de servere, paginile de server și terminal.',
        'advanced' => 'Setări avansate',
        'advanced_helper' => 'Rândul din bara laterală pentru CSS-ul tău și excepțiile pe zone.',
        'announcements' => 'Anunțuri',
        'announcements_helper' => 'Banda de-a lungul părții de sus a panoului.',
        'nav_links' => 'Legături de navigare',
        'nav_links_helper' => 'Rândurile tale în bara laterală.',
        'login' => 'Ecran de conectare',
        'login_helper' => 'Imaginea, mesajul și legăturile ecranului de conectare.',
        'bars' => 'Indicatoare de resurse',
        'bars_helper' => 'Barele care își schimbă culoarea pentru procesor, memorie și disc.',
        'dashboard_status' => 'Rândul de versiune',
        'dashboard_status_helper' => 'Partea de sus a blocului de pe pagina de ansamblu: ce versiune este instalată și dacă una așteaptă.',
        'dashboard_nodes' => 'Mașini',
        'dashboard_nodes_helper' => 'Restul blocului de pe pagina de ansamblu: acest panou și fiecare node, cu ce folosește fiecare.',
        'system_status' => 'Pagina Starea sistemului',
        'system_status_helper' => 'Pagina pentru mașina pe care rulează chiar panoul.',
        'sidebar_footer' => 'Baza barei laterale',
        'sidebar_footer_helper' => 'Rândul tău de text, versiunea panoului și o legătură, la baza barei laterale.',
        'api' => 'API',
        'api_helper' => 'O cale înăuntru de afara panoului: o adresă pe care un bot de Discord sau un script al tău o poate întreba ce știe acest plugin — cine joacă, ce servere nu au copie de siguranță, dacă mai încape unul pe un node. Oprit nu înregistrează nicio rută în loc să înregistreze una care refuză, ceea ce înseamnă mai puțină suprafață și nu o cantitate mai politicoasă din ea. Oricine este conectat poate cere o cheie care răspunde doar pentru serverele lui; a da una, a refuza una, a revoca una pe care o are altcineva și a emite una pentru tot panoul cer toate permisiunea.',
        'languages' => 'Limbi',
        'languages_helper' => 'Să răspundă fiecăruia în limba pe care i-o are contul, acolo unde acest plugin este tradus în ea. Dacă asta este oprit, toată lumea primește engleză.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'O filă Minecraft în bara laterală și o pagină în interiorul fiecărui server Minecraft pentru a-i edita server.properties ca formular. Care egg-uri contează spui tu.',
        'palworld' => 'Setări Palworld',
        'palworld_helper' => 'O pagină în interiorul unui server Palworld pentru a-i edita setările de lume. Nu apare pe niciun alt server și niciodată cât timp acel server rulează.',
        'settings_search' => 'Căutare în setări',
        'settings_search_helper' => 'Câmpul de deasupra acestor formulare care le restrânge la secțiunile ce conțin ce scrii.',
        'preview' => 'Previzualizare vie',
        'preview_helper' => 'Caseta de lângă formularul Look care arată ce fac culorile, colțurile și spațiile înainte să le salvezi.',
        'duplicate' => 'Duplică server',
        'duplicate_helper' => 'O pagină pentru a configura încă un server exact ca unul pe care îl ai deja, sau mai multe deodată. Fișierele nu se copiază niciodată.',
        'favourites' => 'Servere marcate',
        'favourites_helper' => 'O stea pe fiecare fișă de server. Cele marcate vin primele, iar lista fiecăruia stă pe panou — deci stelele te urmează la următorul loc de unde te conectezi. Schimbă ce vezi tu și nimic pentru alții. Faptul că stă pe panou înseamnă însă că este un fișier sub storage, pe care oricine are acces la mașină îl poate citi.',
        'artwork' => 'Imagini pentru egg-uri',
        'artwork_helper' => 'Pagina de administrare care aduce imaginea fiecărui egg de pe Steam sau IGDB și o scrie chiar în egg.',
        'alerts' => 'Alerte',
        'alerts_helper' => 'Verificarea periodică pentru un node care nu mai răspunde, un disc care se umple, un queue worker mort sau o versiune rămasă în urmă — și mesajul de Discord, de panou sau de e-mail pe care îl trimite.',
        'backups' => 'Privire de ansamblu asupra copiilor',
        'backups_helper' => 'Pagina de administrare care înșiră fiecare server după de cât timp a rămas fără copie. Doar citire.',
        'public_status' => 'Pagină publică de stare',
        'public_status_helper' => 'Pagina pe care oricine o poate deschide fără cont. Dacă este oprită, adresa răspunde 404 indiferent ce este pe listă.',
        'game_players' => 'Jucători, alte jocuri',
        'game_players_helper' => 'O pagină în interiorul Rust, ARK, Valheim și al oricărui altceva care răspunde interogării Valve, care arată cine este conectat și de cât timp.',
        'owner_alerts' => 'Anunță oamenii că serverul lor este jos',
        'owner_alerts_helper' => 'Singura parte a acestui plugin care scrie unor oameni care nu sunt administratori: o notificare în panou când mașina din spatele unuia dintre serverele lor nu mai răspunde, și una când revine. Oprită până nu o pornești și aici, și pe pagina Alerte - scrie clienților tăi, deci cere două decizii și nu una.',
        'my_backups' => 'Avertisment despre copii pe lista de servere',
        'my_backups_helper' => 'Un rând deasupra listei proprii de servere a fiecăruia, când unul dintre ale lor nu a avut niciodată o copie sau nu a mai avut de ceva vreme. Fișa Pelicanului spune ce face un server acum; nimic de acolo nu spune că o copie nu a mai rulat de trei săptămâni. Se desenează doar când ceva a rămas în urmă și nu menționează niciun server pe care persoana nu l-ar putea deschide oricum.',
        'capacity' => 'Privire de ansamblu asupra capacității',
        'capacity_helper' => 'Pagina de administrare care arată memoria, discul și procesorul promise față de cele disponibile pe fiecare mașină, împreună cu serverele care au rămas fără copii, baze de date sau alocări. Promis și nu folosit - un node poate fi ocupat și gol, sau liniștit și plin.',
        'schedules' => 'Privire de ansamblu asupra programărilor',
        'schedules_helper' => 'Pagina de administrare care înșiră fiecare sarcină programată de pe tot panoul, cele mai rele primele - blocate, întârziate, sau niciodată rulate. Doar citire; tot ce schimbă sau rulează una rămâne pe pagina Pelicanului pentru acel server.',
        'activity' => 'Activitatea panoului',
        'activity_helper' => 'Pagina de administrare care înșiră fiecare eveniment înregistrat pe tot panoul, cel mai nou primul, cu cine a făcut-o și pe ce server. Doar citire - nu șterge nimic, iar chiar setarea Pelicanului hotărăște în continuare cât timp rămân rândurile.',
        'access' => 'Acces la servere după rol',
        'access_helper' => 'O pagină pentru a lega un rol de servere, ținută adevărată în chiar tabelul de subuseri al Pelicanului. Nu dă nimic până nu conectezi ceva. Oprirea ei oprește reconcilierea; accesul deja dat rămâne, iar pagina are un buton pentru a-l retrage.',
        'scheduled' => 'Stiluri după oră',
        'scheduled_helper' => 'Secțiunea de pe pagina Look care dă panoului un alt stil între două ore ale zilei. Nu schimbă nimic din ce este salvat — o fereastră se așază peste setări cât timp pagina se desenează și se lasă imediat după — deci oprirea ei redă aspectul propriu al panoului pe loc și nu pierde nimic.',
        'games' => 'Alte jocuri',
        'games_helper' => 'Setările de lume ale ARK și listele Valheim de admini, ban-uri și permiși, ca formulare și nu ca fișiere în managerul de fișiere. Care servere le primesc este lista de egg-uri de pe pagina Alte jocuri.',
        'quick' => 'Meniul „Mergi la”',
        'quick_helper' => 'Un singur element în capul fiecărei pagini pentru a sări la un server sau la o pagină marcată, cu un câmp de căutare peste toată lista ta de servere. Evidențiază și pagina pe care ești. Ce găsește cineva prin el este ceea ce putea atinge oricum, deci nu dă nimic - oprirea lui ia scurtătura și pagina Favorite odată cu ea.',
        'shop' => 'Magazin',
        'shop_helper' => 'Vânzarea de servere din panou: magazinul și finalizarea comenzii în zona clientului, pagina de facturare a fiecăruia și pagina Setările magazinului pentru monedă, taxă și texte. Comutatorul principal — oprit, nimeni nu poate cumpăra sau plăti, iar ce s-a vândut deja este administrat în continuare prin paginile de mai jos.',
        'packages' => 'Pachete',
        'packages_helper' => 'Pagina de administrare unde se definește ce este de vânzare: un șablon de server cu preț, perioadă și stoc. Permisiune proprie, pentru că a stabili prețuri este altă muncă decât a marca facturi ca plătite.',
        'orders' => 'Comenzi',
        'orders_helper' => 'Pagina de administrare cu tot ce s-a cumpărat, serverul în care s-a transformat fiecare și starea ei — în așteptare, activă, suspendată, anulată. Permisiune proprie.',
        'invoices' => 'Facturi',
        'invoices_helper' => 'Pagina de administrare cu ce se datorează și ce s-a plătit, cu un buton pentru a marca manual o factură ca plătită. Permisiune proprie, pentru că acel buton este locul unde se înregistrează banii.',
        'payments' => 'Plăți',
        'payments_helper' => 'Furnizorii de plăți — cheile lor și fiecare încercare făcută prin ei. Permisiune proprie, pentru că acolo stau datele de acces: cine poate vedea fiecare factură nu trebuie neapărat să vadă secretul.',
        'coupons' => 'Cupoane',
        'coupons_helper' => 'Coduri care scad un procent sau o sumă fixă din prima factură, cu expirare și limită de utilizări. Permisiune proprie.',
        'public_shop' => 'Pagina publică a magazinului',
        'public_shop_helper' => 'Pagina pe care oricine o poate deschide fără cont, cu ce este de vânzare. Nu publică nimic din ce un client autentificat nu ar vedea în magazin, deci pornit sau oprit este toată decizia — oprit răspunde 404, ca pagina de stare.',
    ],

    /*
     * Câmpul de căutare de deasupra formularelor de setări. Filtrează ce este
     * deja pe pagină în browser și nu întreabă serverul nimic, deci nu există
     * nicio stare „se caută” de descris și niciun fel în care să eșueze.
     */
    /*
     * Previzualizarea. Tot ce este în ea este un înlocuitor și nu o mostră din
     * panoul tău, iar formularea o spune - o casetă care ar menționa un server
     * adevărat sau un număr adevărat ar fi citită ca atare.
     */
    'preview' => [
        'label' => 'Previzualizare',
        'card' => 'O fișă',
        'card_helper' => 'Desenată după aceleași reguli ca panoul, cu setările de pe această pagină și nu cu cele salvate.',
        'button' => 'Un buton',
        'field' => 'Un câmp',
        'meter_ok' => 'Bine',
        'meter_warning' => 'Avertisment',
        'meter_danger' => 'Pericol',

        /*
         * Previzualizarea paginii întregi. O filă și nu un cadru, pentru că
         * Pelicanul trimite X-Frame-Options: DENY și refuză să fie încadrat de
         * orice, inclusiv de el însuși - vezi Support\FullPreview.
         */
        'full' => 'Vezi tot panoul',
        'full_confirm' => 'Deschide panoul desenat din setările de pe această pagină și nu din cele salvate. Nu se scrie nimic — valorile se țin cincisprezece minute, iar panoul revine la normal când părăsești previzualizarea sau când salvezi.',
        'full_go' => 'Arată-mi',
        'full_failed' => 'Previzualizarea nu a putut fi pornită',
        'bar' => 'Privești setări care nu sunt salvate. Nimic din ele nu a fost scris.',
        'bar_back' => 'Înapoi la setări',
    ],

    'search' => [
        'placeholder' => 'Caută în setări',
        'label' => 'Caută în aceste setări',
        'none' => 'Nimic de pe această pagină nu se potrivește. Setările sunt împărțite pe patru pagini — încearcă Look, Pagini, Avansat sau Setări Essentials.',
    ],

    'footer' => [
        'text' => 'Rândul tău',
        'text_helper' => 'Text simplu, cel mult 120 de caractere. Se escapează, la fel ca banda de anunțuri — asta se desenează pe fiecare pagină a panoului, ceea ce o face locul greșit pentru a primi marcaj.',
        'version' => 'Arată versiunea panoului',
        'version_helper' => 'Versiunea Pelicanului, nu a acestui plugin. Pluginul o spune pe a lui pe pagina de ansamblu; ce caută oamenii la baza unei bare laterale este ce panou privesc.',
        'link_label' => 'Textul legăturii',
        'link_url' => 'Adresa legăturii',
        'link_url_helper' => 'O adresă http sau https, sau o cale chiar în panou, de pildă /account. Se deschide într-o filă nouă.',
    ],

    'layout' => [
        'label' => 'Aranjare',
        'helper' => 'Cum este aranjat panoul, nu ce culoare are. Se aplică la fel zonei de administrare, listei de servere și zonei de client. Unde stă navigarea este o valoare implicită: cine și-a pus una proprie la Cont → Navigare o păstrează.',
        'default' => 'Bară laterală — chiar a Pelicanului',
        'rail' => 'Șină de pictograme — îngustă, se deschide la trecerea cursorului',
        'top' => 'Navigare sus — fără bară laterală',
        'mixed' => 'Bară de sus și bară laterală — amândouă',
        'wide' => 'Lat — conținutul folosește tot ecranul',
        'focus' => 'Concentrat — coloană îngustă, bara laterală se pliază',

        'nav_label' => 'Stilul barei laterale',
        'nav_helper' => 'Cum se desenează chiar bara laterală.',
        'nav_default' => 'Implicit',
        'nav_floating' => 'Plutitoare — fișă separată',
        'nav_flat' => 'Plată — fără niciun fundal',
        'nav_bordered' => 'Cu chenar — o linie, nu o suprafață',

        'topbar_label' => 'Stilul topbar-ului',
        'topbar_helper' => '„Ascuns” se aplică doar pe calculator — pe telefon topbar-ul poartă singura cale înapoi spre meniu.',
        'topbar_default' => 'Implicit',
        'topbar_floating' => 'Plutitor — un rând desprins',
        'topbar_flush' => 'La același nivel — plat, fără estompare',
        'topbar_hidden' => 'Ascuns pe calculator',

        'card_label' => 'Stilul fișelor',
        'card_helper' => 'Secțiuni, widget-uri, fișe de server și blocurile de deasupra consolei.',
        'card_default' => 'Implicit — ridicat, cu chenar moale',
        'card_flat' => 'Plat — fără ridicare',
        'card_outline' => 'Contur — un chenar și nimic în spate',
        'card_glass' => 'Mat — fundalul se vede prin el',
        'card_sharp' => 'Ascuțit — colțuri drepte',
    ],

    'servers' => [
        /*
         * Steaua de pe o fișă. Dată scriptului și nu scrisă în el, ca textele să
         * fie singurul loc în care stau textele.
         */
        'favourite' => 'Marchează acest server',
        'favourited' => 'Marcat — apare primul',

        /*
         * Pastila de lângă filele Pelicanului. Numită după ce face cu lista și
         * nu ca a patra filă, pentru că filtrează fila selectată în loc să o
         * înlocuiască.
         */
        'favourites_tab' => 'Favorite',
        'favourites_empty' => 'Nimic marcat pe această pagină. Folosește steaua de pe o fișă de server ca să adaugi unul — și ține minte că asta filtrează serverele care sunt deja aici: un server marcat de pe o pagină ulterioară nu este ascuns, doar nu este pe aceasta.',
        'favourites_failed' => 'Serverele tale marcate nu au putut fi salvate, deci au fost puse înapoi la ce avea panoul ultima dată. Consola browserului spune ce a răspuns cererea.',

        'art' => 'Imaginea jocului',
        'art_helper' => 'Pelicanul desenează imaginea egg-ului pe fiecare fișă. Asta hotărăște ce se face cu ea.',
        'art_faded' => 'Estompată — o licărire în spatele textului',
        'art_cover' => 'Acoperitoare — în spatele numelui, se stinge',
        'art_off' => 'Oprită',
        'art_dim' => 'Întunecă imaginea',
        'art_dim_helper' => 'Imaginea unui joc este un cer luminos, iar a altuia este o peșteră.',

        'status' => 'Semn de stare',
        'status_helper' => 'Unde apare culoarea pentru rulează/pornește/oprit.',
        'status_bar' => 'Bară — de-a lungul marginii din stânga',
        'status_edge' => 'Margine — de-a lungul părții de sus',
        'status_dot' => 'Punct — în colț',
        'status_off' => 'Oprit',

        'density' => 'Înălțimea fișei',
        'density_comfortable' => 'Lejeră',
        'density_compact' => 'Compactă — pentru multe servere',

        'filter_label' => 'Pune text pe butonul de filtrare',
        'filter_label_helper' => 'Pelicanul filtrează deja această listă după egg și după proprietar, pe toate paginile - dar intrarea este o pictogramă fără text lângă câmpul de căutare. Asta pune cuvântul pe ea.',
        'filter_button' => 'Filtre',

        'columns' => 'Fișe una lângă alta pe un ecran lat',
        'columns_helper' => 'Se aplică doar grilei și doar de la 1280px în sus. Plafonul Pelicanului este de două.',
    ],

    'controls' => [
        'mode' => 'Buton de consolă pe fiecare pagină de server',
        'mode_helper' => 'Un singur buton plutitor, pe fiecare pagină din interiorul unui server. Deschide consola peste ce făceai, cu starea și butoanele de alimentare în capul ei — ajunge direct la node, cum face lista de servere, și nu prin websocketul paginii de consolă. Nu apare niciodată pe pagina de consolă, care le are deja pe toate.',
        'mode_full' => 'Consolă și butoane de alimentare',
        'mode_console' => 'Doar consolă',
        'mode_off' => 'Oprit',

        'label' => 'Butonul arată',
        'label_text' => 'Pictogramă și nume',
        'label_icon' => 'Doar pictogramă',

        'position' => 'Unde plutește',
        'position_helper' => 'Spre marginea pe care e cel mai puțin probabil să o citești.',
        'position_top' => 'Sus',
        'position_right' => 'Dreapta',
        'position_bottom' => 'Jos',
    ],

    'console' => [
        'stats' => 'Blocuri deasupra consolei',
        'stats_helper' => 'Pelicanul arată numele, starea, adresa și cele trei cifre de utilizare deasupra terminalului. Ascunderea lor redă consolei înălțimea.',
        'stats_tiles' => 'Plăci — etichetă, cifră și o pictogramă',
        'stats_plain' => 'Simple — cum le desenează Pelicanul',
        'stats_off' => 'Ascunse',
    ],

    'terminal' => [
        'helper' => 'Se dau chiar terminalului, deci intră în vigoare la următoarea încărcare a paginii și nu în clipa în care sunt salvate.',

        'renderer' => 'Desenat de',
        'renderer_helper' => 'Pelicanul desenează terminalul pe GPU, ceea ce este mult mai rapid în fața unui zid de ieșire care se derulează. Un browser ține în viață doar un anumit număr de contexte GPU deodată — mai puține pe telefon — și îl scoate pe cel mai vechi când se trece limita; terminalul nu mai desenează atunci absolut nimic, fără nicio eroare. Dacă ți se golește consola în timp ce tot restul din jurul ei arată bine, aceasta este setarea de schimbat.',
        'renderer_webgl' => 'GPU — chiar al Pelicanului, mai rapid',
        'renderer_dom' => 'Browserul — mai lent, desenează întotdeauna',

        'scheme' => 'Schemă de culori',
        'scheme_helper' => 'Singura setare de terminal pe care Pelicanul nu o oferă. „Urmează tema” deduce culorile din accent, și de aceea există asta.',
        'scheme_theme' => 'Urmează tema',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Cursor',
        'cursor_helper' => 'Consola nu primește tastare — câmpul de comandă este sub ea — deci acesta este locul unde s-a oprit ieșirea, nu locul unde ești tu.',
        'cursor_underline' => 'Subliniere — chiar a Pelicanului',
        'cursor_block' => 'Bloc',
        'cursor_bar' => 'Linie',

        'blink' => 'Cursor care clipește',

        'scrollback' => 'Istoric de derulare',
        'scrollback_helper' => 'Cât de departe în urmă se poate derula consola. Fiecare rând se ține în browser, deci un server vorbăreț cu o setare mare înseamnă memorie adevărată pe mașina care citește.',
        'scrollback_lines' => ':lines rânduri',
    ],

    'notice' => [
        'text' => 'Mesaj',
        'text_helper' => 'Un rând, până la 200 de caractere. Se escapează la intrare și la ieșire, deci nu poate duce marcaj într-o pagină pe care o încarcă alți oameni.',
        'style' => 'Ton',
        'style_info' => 'Informație',
        'style_warning' => 'Avertisment',
        'style_danger' => 'Urgent',
        'style_accent' => 'Culoare de accent',
        'scope' => 'Se arată pentru',
        'scope_all' => 'Toată lumea',
        'scope_client' => 'Doar în afara zonei de administrare',
        'scope_admin' => 'Doar în zona de administrare',
        'link_label' => 'Textul butonului',
        'link_url' => 'Adresa butonului',
        'link_url_helper' => 'https:// sau o cale în interiorul acestui panou, de pildă /account. Orice altceva se ignoră — o legătură dintr-o bandă de pe fiecare pagină nu este locul pentru o schemă la care nu se aștepta nimeni.',
        'dismissible' => 'Se poate închide',
        'dismissible_helper' => 'Închiderea se ține minte pe browser și doar pentru acest mesaj: schimbă textul și revine pentru toată lumea.',
        'dismiss' => 'Închide',
    ],

    'preset' => [
        'label' => 'Stil',
        'helper' => 'Alege o înfățișare de la care să pornești. Completează tot ce urmează, iar apoi poți schimba. „Niciunul” oprește tema și lasă panoul exact cum îl livrează Pelicanul.',
        'options' => [
            'none' => 'Niciunul - fără temă',
            'legend' => 'Legend - foc roșu care trece în fulger albastru',
            'ember' => 'Ember - negru cald, accent portocaliu',
            'midnight' => 'Midnight - albastru adânc, liniștit',
            'crimson' => 'Crimson - roșu, colțuri ascuțite, compact',
            'forest' => 'Forest - verde, rotund, fără licărire',
            'nebula' => 'Nebula - violet cu un fundal în degrade',
            'terminal' => 'Terminal - verde pe negru, lățime fixă, ascuțit',
            'console' => 'Console - rotund și lejer, pentru o tabletă',
            'nord' => 'Nord - paleta Nord, potolită',
            'solarized' => 'Solarized - Solarized dark, accent cyan',
            'paper' => 'Paper - luminos, contrast mare, plat',
            'daylight' => 'Daylight - luminos și cald, cu o licărire moale',
            'mono' => 'Mono - tonuri de gri, plat și dens',
        ],

        'save' => 'Salvează ca stil',
        'save_confirm' => 'Păstrează culorile, colțurile, fundalul, fontul, pictogramele și pragurile de indicator pe care le ai pe ecran chiar acum — sub un nume ales de tine, în selector, lângă cele încorporate. Salvează ce este pe pagină, nu ce s-a salvat ultima dată.',
        'save_name' => 'Nume',
        'save_name_helper' => 'Cum se va numi în selector. Salvarea sub un nume pe care l-ai mai folosit îl înlocuiește.',
        'saved' => 'Stil salvat',
        'save_failed' => 'Acel stil nu a putut fi salvat',
        'save_full' => 'Este loc pentru :max stiluri proprii. Șterge mai întâi unul.',

        'delete' => 'Șterge un stil',
        'delete_which' => 'Care',
        'delete_confirm' => 'Se pot șterge doar stilurile tale; cele încorporate nu. Nu se schimbă nimic în felul în care arată panoul acum — un stil este un punct de pornire, iar fiecare valoare pe care a pus-o este deja în setările de mai jos.',
        'deleted' => 'Stil șters',
        'deleted_current' => 'Acela era cel pe care era setat acest panou. Setările lui sunt neschimbate și încă pe această pagină — alege un stil sau salvează-le din nou sub un nume.',
    ],

    'user_themes' => [
        'label' => 'Stiluri pe care oamenii le pot alege singuri',
        'helper' => 'Stilurile bifate apar pe o pagină Aspect în zona de client, unde oricine este conectat poate alege unul pentru sine. Schimbă ce văd ei și nimic pentru alții. Nicio bifă înseamnă că nimeni nu alege nimic și că panoul păstrează o singură înfățișare — ceea ce face acum.',
    ],

    'mode' => [
        'label' => 'Modul panoului',
        'helper' => 'În ce mod se deschide panoul. Cine nu a ales singur primește asta; selectorul din meniul de utilizator îi lasă în continuare să schimbe, dacă nu îl blochezi mai jos.',
        'dark' => 'Întunecat',
        'light' => 'Luminos',
        'system' => 'Sistem — urmează setarea vizitatorului',
    ],

    'font' => [
        'label' => 'Fontul panoului',
        'helper' => 'Fiecare variantă este o familie pe care sistemul de operare o are deja — nu se aduce nimic de la un furnizor de fonturi. Terminalul nu este atins: fontul lui este alegerea fiecăruia, la Cont.',
        'default' => 'Implicit - chiar al Pelicanului',
        'mono' => 'Lățime fixă',
        'rounded' => 'Rotunjit',
        'serif' => 'Serif',
        'system' => 'Sistem - cel folosit de această mașină',
    ],

    'surface' => [
        'label' => 'Culoarea suprafeței',
        'helper' => 'Fișele și panourile. Nuanțele mai deschise și mai închise se deduc din ea.',
        'placeholder' => 'Urmează tema',
    ],

    'radius' => [
        'label' => 'Colțuri',
    ],

    'accent' => [
        'label' => 'Culoare de accent',
        'helper' => 'Se folosește la butoane, legături, elementul activ de navigare și inelele de focalizare.',

        /*
         * Spus, nu impus. O culoare despre care asta avertizează se salvează
         * oricum: este panoul cuiva, cifra măsoară un singur lucru, iar există
         * motive bune să vrei un accent cu scor slab. Selectorul spune ce vede
         * și se dă la o parte.
         */
        'contrast_dark' => 'Lizibilitate: :ratio pe un panou întunecat. Sub 3, un accent este greu de citit ca buton sau legătură — unul mai deschis îl ridică.',
        'contrast_light' => 'Lizibilitate: :ratio pe un panou luminos. Sub 3, un accent este greu de citit ca buton sau legătură — unul mai închis îl ridică.',
    ],
    'density' => [
        'label' => 'Densitate',
        'helper' => 'Compact strânge spațiile ca să încapă mai multe rânduri pe ecran.',
        'comfortable' => 'Lejeră',
        'compact' => 'Compactă',
    ],
    'force_dark' => [
        'label' => 'Forțează modul întunecat',
        'helper' => 'Ascunde selectorul dintre luminos și întunecat și ține fiecare utilizator pe tema întunecată.',
    ],
    'glass' => [
        'label' => 'Topbar mat',
        'helper' => 'Estompează topbar-ul și fundalul din spatele ferestrelor de dialog. Oprește-l pe dispozitive mai slabe.',
    ],
    'glow' => [
        'label' => 'Licărire de accent',
        'helper' => 'O umbră moale de accent pe cele mai importante butoane, pe navigarea activă și pe fișa de conectare.',
    ],

    'background' => [
        'label' => 'Tipul fundalului',
        'helper' => 'Aurora este fundalul propriu al temei: licărire de accent cu o granulație fină.',
        'aurora' => 'Aurora (implicit)',
        'solid' => 'O singură culoare',
        'gradient' => 'Degrade',
        'image' => 'Imagine',
        'color' => 'Culoare',
        'base' => 'Culoarea din spatele licăririi',
        'base_helper' => 'Pe ce se sprijină pagina înainte ca licărirea de accent să fie pictată peste ea. Lasă gol ca să păstrezi valoarea implicită a panoului, care este aproape neagră în modul întunecat și aproape albă în cel luminos. Dacă o setezi, o schemă își păstrează propria culoare de noapte și tot este luminată.',
        'color_end' => 'A doua culoare',
        'angle' => 'Direcție',
        'upload' => 'Încarcă o imagine',
        'upload_helper' => 'Până la 8 MB. O imagine încărcată trece înaintea adresei de mai jos.',
        'url' => 'Sau un URL',
        'url_helper' => 'Trebuie să înceapă cu https:// și să fie accesibil din exterior.',
        'dim' => 'Întunecă',
        'dim_helper' => 'Fără întunecare, textul alb pe o imagine luminoasă nu se poate citi.',
        'blur' => 'Estompare',
    ],

    'channel' => [
        'installed' => 'instalată',
        'version' => 'Instalează o anumită versiune',
        'version_helper' => 'Orice lansare de pe acest canal, nu doar cea mai nouă — ca să mergi înapoi când ceva nou se dovedește mai rău, sau înainte, spre o construcție pe care cineva ți-a cerut să o încerci. Doar cât timp actualizările nu se instalează singure: cu acea opțiune pornită, alegerea ta ar ține doar până la următoarea verificare.',
        'version_placeholder' => 'Alege o versiune',
        'version_install' => 'Instalează această versiune',
        'version_confirm' => 'Panoul descarcă acea lansare, își reconstruiește asset-urile și își golește cache-urile. Setările tale se păstrează. Este permis să mergi înapoi la o versiune mai veche, iar nimic nu se dă înapoi în locul tău — alege din nou pe cea mai nouă ca să mergi înainte.',
        'label' => 'Canal de actualizări',
        'helper' => 'Ce lansări oferă pagina Temă. Beta primește versiunile noi prima, și tot prima primește și muchiile ascuțite.',
        'stable' => 'Stabil',
        'beta' => 'Beta',
        'dev' => 'Dev (ramura de lucru)',
        'auto' => [
            'label' => 'Instalează actualizările automat',
            'helper' => 'Oprit lasă actualizarea în seama ta. Pornit face panoul să verifice canalul ales și să instaleze tot ce este mai nou - își reconstruiește asset-urile între timp și este inaccesibil câteva minute, de aceea zilnic și săptămânal rulează la 04:00. Cere ca cronul panoului să ruleze.',
            'interval' => 'Verifică la fiecare',
            'minute' => 'În fiecare minut',
            'five_minutes' => 'La 5 minute',
            'ten_minutes' => 'La 10 minute',
            'thirty_minutes' => 'La 30 de minute',
            'hourly' => 'În fiecare oră',
            'daily' => 'În fiecare zi (04:00)',
            'weekly' => 'În fiecare săptămână (luni 04:00)',
        ],
    ],

    /*
     * Fila Limbi.
     *
     * Atenție la ce pretinde. Pelicanul lasă deja pe fiecare să aleagă o limbă
     * pentru tot contul lui și o folosește deja; nimic de aici nu schimbă asta
     * și nici nu ar trebui. Aceasta hotărăște doar dacă textele proprii ale
     * acestui plugin urmează acea alegere.
     */
    'languages' => [
        'section_helper' => 'Pelicanul lasă deja pe fiecare să aleagă o limbă pentru contul lui, iar acest plugin o urmează acolo unde este tradus. Aici hotărăști pe care dintre ele o urmează. Cele mai multe limbi stau la un procent mic în mod intenționat: prima parte tradusă este cea pe care o vede toată lumea pe fiecare pagină — butoanele de alimentare de deasupra unei console și indicatoarele node-urilor — iar restul vine pe măsură ce oamenii îl aduc.',
        'panel' => 'Lasă asta să hotărască limba întregului panou',
        'panel_helper' => 'Pornit, o limbă pe care acest plugin nu o poartă — sau una oprită mai jos — pune tot panoul în engleză pentru acel cititor, nu doar aceste pagini. Oprit, doar acest plugin urmează lista, iar Pelicanul vorbește în continuare limba setată pe cont, ceea ce înseamnă că un cititor poate întâlni două limbi pe un singur ecran. Niciun cont nu se schimbă în vreun fel: repornește o limbă și o au înapoi.',
        'label' => 'Limbi în care să răspundă',
        'helper' => 'Scoaterea bifei trimite cititorii care o au setată pe cont înapoi la engleză doar pentru acest plugin — restul panoului le vorbește în continuare limba. Engleza nu este pe listă, pentru că totul cade înapoi pe ea.',
        'under' => 'nu se oferă până nu avansează — bifeaz-o ca să o oferi oricum',
        'done' => ':percent% tradusă',
        'main' => 'Limba principală',
        'main_helper' => 'Ce primește un cititor când limba lui nu poate fi folosită — fie acest plugin nu o poartă, fie nu este bifată mai jos. A fost mereu engleza; într-o echipă care nu lucrează în engleză, acesta era un răspuns greșit dat cu siguranță. Bifa nu se poate scoate mai jos, pentru că totul cade înapoi pe ea.',
        'labels' => 'Cum se numește fiecare limbă',
        'labels_helper' => 'Numele pe care cititorii și administratorii îl văd în selectoare. Lasă unul gol ca să păstrezi numele sub care acest plugin o cunoaște. O limbă încărcată sub un nume inventat de tine nu are unul, deci ar apărea cu codul ei până nu îi dai unul aici.',
        'labels_code' => 'Cod',
        'labels_name' => 'Apare ca',
        'download' => 'Descarcă un fișier de traducere',
        'download_from' => 'Pornește de la',
        'download_from_helper' => 'Un JSON cu fiecare text din acest plugin. Alege engleza pentru o limbă pe care nu a început-o nimeni, sau una existentă ca să construiești peste ce este deja tradus.',
        'code' => 'Cod de limbă',
        'code_helper' => 'Codul pentru care este fișierul. Un locale adevărat, așa cum le folosesc conturile — fr, de, pt_BR — ajunge la cititorii care îl au setat și trebuie să se potrivească exact, altfel nu ajunge. Un nume inventat de tine, precum Gaming-RO, este permis și funcționează altfel: Pelicanul lasă un cont să aibă doar un locale adevărat, deci nimeni nu îl poate alege pe al tău. Poate fi atins ca limbă principală mai sus, care este ce primesc toți când a lor nu poate fi folosită.',
        'url' => 'Sau adu-l de la o adresă',
        'url_helper' => 'O adresă https la care panoul poate ajunge — un CDN, un bucket, un fișier brut dintr-un repository. Se aduce o dată când salvezi și se scrie la fel ca unul încărcat, deci schimbarea fișierului de la acea adresă mai târziu nu face nimic până nu salvezi din nou. Un fișier ales mai sus întrece o adresă rămasă în acest câmp.',
        'upload' => 'Încarcă un fișier de traducere',
        'upload_helper' => 'Fișierul JSON de mai sus, cu valorile traduse. Se scrie în afara pluginului, deci o actualizare nu îl aruncă, și se așază peste engleză cheie cu cheie — un fișier cu jumătate din texte îți dă o limbă pe jumătate și engleză pentru rest.',
        'uploaded' => ':count texte instalate pentru :code',
        'uploaded_halves' => 'Dintre ele, :mine sunt texte proprii ale acestui plugin, iar :panel sunt ale panoului. Zero pe una dintre părți înseamnă că acea jumătate a fișierului nu conținea nimic — cheile pluginului încep cu essentials:: iar ale panoului nu.',
        'uploaded_skipped' => ':count sărite: goale, sau chei pe care acest plugin nu le are. Primele: :keys',
        'upload_failed' => 'Acel fișier nu a putut fi citit',
        'upload_failed_body' => 'Trebuie să fie fișierul JSON de la descărcarea de mai sus — un obiect plat de chei și texte. Verifică dacă nu cumva un editor l-a salvat altfel.',
    ],

    'windows' => [
        'add' => 'Adaugă o fereastră',
        'from' => 'De la',
        'to' => 'Până la',
        'to_helper' => 'Mai devreme decât începutul înseamnă că trece peste miezul nopții — 22:00 până la 06:00 este noaptea.',
        'preset' => 'Stil',
        'days' => 'Zile',
        'days_helper' => 'Lasă-le pe toate nebifate pentru fiecare zi. O fereastră care trece peste miezul nopții aparține zilei în care începe, deci vineri 22:00 până la 06:00 acoperă dimineața de sâmbătă.',
        'day_mon' => 'Luni',
        'day_tue' => 'Marți',
        'day_wed' => 'Miercuri',
        'day_thu' => 'Joi',
        'day_fri' => 'Vineri',
        'day_sat' => 'Sâmbătă',
        'day_sun' => 'Duminică',
    ],

    'arranger' => [
        'label' => 'Aranjator de pagină',
        'helper' => 'Butonul „Aranjează pagina”, pe fiecare pagină a panoului. Toți cei cu permisiunea Aranjează îl primesc și pot pune și aranjarea de la care pornesc toți ceilalți, sau una pentru un rol. Oprit îl ascunde pentru toată lumea; aranjările deja salvate rămân unde sunt.',
        'roles' => 'O aranjare nu este o permisiune. Un bloc pe care un rol îl ascunde este tot un bloc la care cineva ar putea ajunge tastând adresa — ce oprește asta sunt chiar permisiunile Pelicanului, în pagina de roluri. Trei straturi se așază în această ordine: cel de la care pornesc toți, apoi rolul cititorului, apoi ce a mutat el însuși.',
        'users' => 'Lasă pe toți să își aranjeze propriile pagini',
        'users_helper' => 'Pornit, oricine este conectat poate muta și ascunde blocuri pe paginile pe care le vede deja, doar pentru sine — nu schimbă nimic pentru alții. Punerea aranjării de la care pornesc toți rămâne la permisiunea Aranjează.',
    ],

    'brand' => [
        'logo_height' => 'Înălțimea siglei',
        'logo_height_helper' => 'Pelicanul livrează 2rem. Valorile mai mari fac și capul barei laterale mai înalt.',
        'logo_url' => 'Înlocuiește sigla',
        'logo_url_helper' => 'Lasă gol ca să păstrezi ce indică chiar setările Pelicanului.',
    ],

    'login' => [
        'image' => 'Imagine de fundal',
        'image_helper' => 'Doar pentru ecranul de conectare. Fără una, arată în continuare fundalul panoului.',
        'url' => 'Sau un URL',
        'blur' => 'Estomparea fișei',
        'blur_helper' => 'Mătuiește fișa, ca imaginea din spate să se vadă prin ea.',
        'width' => 'Lățimea fișei',
        'position' => 'Încadrarea imaginii',
        'position_helper' => 'Ce parte din imagine supraviețuiește tăierii pe ecran.',
        'position_center' => 'Centru',
        'position_top' => 'Sus',
        'position_bottom' => 'Jos',
        'position_left' => 'Stânga',
        'position_right' => 'Dreapta',
        'align' => 'Poziția fișei',
        'align_helper' => 'Unde stă fișa de conectare de-a latul ecranului.',
        'align_center' => 'Centru',
        'align_start' => 'Stânga',
        'align_end' => 'Dreapta',
        'opacity' => 'Opacitatea fișei',
        'opacity_helper' => 'Mai mică lasă mai mult din imagine să treacă prin fișă.',
        'glow' => 'Licărire de accent',
        'glow_helper' => 'Aura din jurul fișei. Oprită îi păstrează chenarul și adâncimea.',
        'hide_heading' => 'Ascunde titlul',
        'hide_heading_helper' => 'Scoate titlul de deasupra formularului și lasă formularul singur.',
        'hide_footer' => 'Ascunde subsolul',
        'hide_footer_helper' => 'Scoate rândul de sub fișă care duce la pelican.dev.',
        'above' => 'Rând deasupra formularului',
        'above_helper' => 'Un rând, arătat oricui ajunge la ecranul de conectare. Lasă gol pentru niciunul.',
        'notice' => 'Mesaj sub fișă',
        'notice_helper' => 'Un rând, arătat oricui ajunge la ecranul de conectare. Lasă gol pentru niciunul.',
    ],

    'advanced' => [
        'css' => 'CSS propriu',
        'css_helper' => 'Până la 100 KB. Se salvează în storage, nu în .env.',
        'reference' => 'Referință CSS',
        'reference_helper' => 'Fiecare variabilă și clasă pe care le pun la dispoziție această temă și panoul.',
    ],

    'areas' => [
        'add' => 'Adaugă o zonă',
        'area' => 'Zonă',
        'inherit' => 'Comună',
        'radius' => 'Colțuri',
        'radius_sharp' => 'Ascuțite',
        'radius_normal' => 'Normale',
        'radius_round' => 'Rotunde',
        'surface' => 'Culoarea suprafeței',
        'surface_helper' => 'Fișele și panourile din interiorul acestei zone; nuanțele mai deschise și mai închise se deduc din ea.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Consolă (restul paginii)',
            'files' => 'Pagina de fișiere',
            'edit' => 'Pagina de editare',
            'server' => 'Alte pagini și file de server',
        ],
    ],

    'bars' => [
        'base' => 'Culoare de bază',
        'base_green' => 'Verde',
        'base_accent' => 'Culoare de accent',
        'warning' => 'Chihlimbariu de la',
        'danger' => 'Roșu de la',
    ],

    'icons' => [
        'stroke' => 'Grosimea liniei',
        'stroke_thin' => 'Subțire',
        'stroke_normal' => 'Normală',
        'stroke_bold' => 'Groasă',
        'scale' => 'Mărime',
        'accent' => 'Pictograme de meniu în culoarea de accent',
        'accent_helper' => 'Se aplică pictogramelor din bara laterală și din topbar.',
        'pack' => 'Pachet de pictograme',
        'pack_helper' => 'Din ce set alege selectorul de mai jos. Se oferă fiecare set de pictograme instalat pe server, plus setul Essentials care vine cu acest plugin și orice pachet încărcat de tine. O deosebire merită știută: o pictogramă din linii se desenează în culoarea meniului și urmează trecerea cursorului și rândul activ, în timp ce pictogramele Essentials sunt imagini și își păstrează propriile culori. Asta o hotărăște ce este fișierul, nu din ce set a venit.',
        'pack_custom' => 'Pachet încărcat',
        'pack_shipped' => 'Pictograme Essentials',
        'use_shipped' => 'Folosește pictogramele Essentials peste tot',
        'use_shipped_confirm' => 'Pune pachetul pe pictogramele Essentials și completează fiecare rând de meniu de mai jos cu pictograma desenată pentru el — consola primește terminalul, pornirea primește butonul de pornire, și așa mai departe. Înlocuiește rândurile pe care le ai acum și nu se salvează nimic până nu apeși Salvează, deci închiderea paginii anulează.',
        'pack_upload' => 'Încarcă un pachet',
        'pack_upload_helper' => 'Un .zip cu fișiere SVG. Fiecare fișier devine o pictogramă numită după el — logo.svg devine custom-logo. Încărcarea înlocuiește pachetul care este acolo acum. Fișierele peste 256 KB și tot ce trece de 4.000 de pictograme sunt lăsate pe dinafară, iar ți se spune câte: ca reper, tot setul Tabler are aproape șase mii de pictograme în cam trei megabytes, deci un pachet mult mai mare poartă altceva decât pictograme, iar cea mai mare parte din el va fi sărită. O încărcare mare poate fi refuzată și înainte ca acest câmp să spună ceva, de upload_max_filesize și post_max_size din php.ini de pe gazda panoului — nicio setare de aici nu le poate ridica.',
        'pack_partial' => ':count pictograme instalate, dar nu toate',
        'pack_partial_body' => 'Sărite: :big prea mari pentru o pictogramă, :unusable nefolosibile ca SVG, :duplicate cu un nume deja luat, :empty au rămas fără nimic de desenat după curățare. Un SVG peste 256 KB este aproape întotdeauna o imagine împachetată în unul, nu un desen — exportă-l la mărime de pictogramă și va avea câțiva kilobytes. O pictogramă rămasă fără nimic de desenat conținea doar lucruri pe care acesta nu le servește — dacă este un pachet întreg, merită semnalat.',
        'pack_stopped_files' => 'S-a oprit și la limita numărului de pictograme pe care le poate conține un pachet.',
        'pack_stopped_size' => 'S-a oprit și pentru că restul pachetului se desfășoară în mai mult decât poate ține panoul în memorie deodată — zip-ul poate fi mai mic decât atât, pentru că SVG-ul se comprimă cam cinci la unu.',
        'overrides' => 'Înlocuiește pictograme',
        'overrides_helper' => 'Câte un rând pentru fiecare pictogramă pe care vrei să o schimbi. Alege elementul de meniu, apoi alege o pictogramă din pachetul de mai sus, dă o adresă sau încarcă o imagine proprie. Dacă este completat mai mult de unul, câștigă încărcarea, apoi adresa, apoi pachetul.',
        'overrides_key' => 'Element de meniu',
        'overrides_value' => 'Pictogramă din pachet',
        'overrides_url' => 'Sau o adresă',
        'overrides_url_helper' => 'O adresă https către o imagine găzduită de tine — un CDN, un bucket, oriunde poate ajunge browserul. Nu se copiază nimic în panou, deci schimbarea fișierului de la acea adresă schimbă pictograma fără să atingă această pagină; reversul este o pictogramă care dispare când dispare adresa. Își păstrează propriile culori, ca o imagine încărcată.',
        'overrides_file' => 'Sau încarcă o imagine',
        /*
         * Spune care este deosebirea de fapt, pentru că nu este evidentă și ea
         * este motivul pentru care alegi una în locul celeilalte.
         */
        'overrides_file_helper' => 'PNG, SVG sau ICO. O pictogramă din pachet se desenează în culoarea meniului și urmează trecerea cursorului și rândul activ; o imagine încărcată își păstrează propriile culori și nu face asta. Pentru o siglă, de obicei asta vrei.',
        'overrides_add' => 'Înlocuiește încă o pictogramă',
        'overrides_search' => 'Scrie un nume sau elementul de meniu…',
    ],

    /*
     * Nu la marcă. Marca este despre cum arată panoul; asta este despre cum se
     * arată acest plugin în el, iar aceea este altă întrebare, la care se
     * răspunde pe altă pagină.
     */
    'identity' => [
        'nav_icon' => 'Pictogramă pentru rândul „Setări Essentials”',
        'nav_icon_helper' => 'PNG, SVG sau ICO, până la 8 MB. Înlocuiește pictograma exact de pe acel rând din bara laterală; lasă gol pentru cea cu care vine acest plugin. Se desenează ca imagine și nu ca pictogramă, deci își păstrează propriile culori în loc să urmeze textul — ceea ce de obicei vrea o siglă. Fișierul este servit, nu încorporat, deci fiecare browser îl aduce o dată, dar tot merită exportat ceva mic: câțiva kilobytes ajung cu prisosință pentru un rând de douăzeci de pixeli. Dacă o încărcare eșuează înainte ca acest câmp să spună ceva, limita de care s-a lovit este upload_max_filesize din php.ini al panoului.',
    ],
];
