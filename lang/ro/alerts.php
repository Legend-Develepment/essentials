<?php

/*
 * Română. Scrisă de mână.
 *
 * Câinele de pază.
 *
 * Fiecare mesaj de aici se citește pe un telefon, la trei dimineața, de către
 * cineva care dormea acum un minut. Fiecare spune care mașină, ce nu e în
 * regulă, și nimic mai mult - detaliul își are locul pe pagina pe care omul o
 * deschide după aceea, nu în rândul care l-a trezit.
 *
 * Faptul că ceva s-a rezolvat este scris ca o veste și nu ca o notă de subsol.
 * „S-a întors deja?” este întrebarea pentru care altfel s-ar da cineva jos din
 * pat.
 *
 * „Node”, „Wings”, „daemon”, „webhook”, „queue”, „Discord” și „SMTP” rămân în
 * engleză: sub acele nume le găsești în Pelican, pe gazdă și în tot ce se scrie
 * despre ele.
 */

return [
    'title' => 'Alerte',
    'nav_label' => 'Alerte',
    'subheading' => 'Panoul știe deja când un node nu mai răspunde, când se umple un disc sau când se oprește coada. Acesta este lucrul care ți-o spune.',

    // ---- canalele și ce au făcut ultima dată ------------------------------
    'channels' => 'Unde ajung mesajele',
    'channels_helper' => 'Ce a făcut fiecare canal ultima dată când i s-a cerut să trimită ceva. Un canal pornit care refuză în tăcere arată exact ca un panou pe care nu e nimic în neregulă, și de aceea acesta stă primul pe pagină.',

    'state_off' => 'Oprit',
    'state_untried' => 'Nu s-a trimis încă nimic',
    'state_ok' => 'Livrat',
    'state_failed' => 'Refuzat',

    // ---- când --------------------------------------------------------------
    'when' => 'Cât de des',
    'when_helper' => 'Verificările rulează în fundal, deci au nevoie de un queue worker. Fără unul nu se trimite nimic și nu spune nimic - folosește „Trimite o probă”, care nu trece prin coadă.',

    'every' => 'Verifică la fiecare',
    'every_helper' => 'Fiecare verificare ajunge la daemonul fiecărui node, deci este o cerere pe node și pe rundă. Cincisprezece minute ajung ca să afli despre o cădere cât timp încă este o cădere.',
    'every_off' => 'Oprit - nicio verificare',
    'every_five' => '5 minute',
    'every_fifteen' => '15 minute',
    'every_thirty' => '30 de minute',
    'every_hourly' => 'Oră',
    'every_daily' => 'Zi',

    'repeat' => 'Amintește-mi cât timp ține',
    'repeat_helper' => 'Se trimite un mesaj când ceva se schimbă și încă unul când se rezolvă. Acesta adaugă o reamintire cât timp o problemă este încă în desfășurare. Zero înseamnă fără reamintiri - un canal care se repetă din sfert în sfert de oră este un canal pe care oamenii îl amuțesc.',
    'hours' => 'ore',

    // ---- unde --------------------------------------------------------------
    'where' => 'Canale',
    'where_helper' => 'Mai mult de unul e cuminte. Se strică în feluri diferite.',

    'discord' => 'Discord',
    'discord_helper' => 'Locul unde un mesaj chiar este citit de cineva care nu stă cu ochii pe panou.',
    'webhook' => 'Adresă webhook',
    'webhook_helper' => 'În Discord: Setări server → Integrări → Webhook-uri → Webhook nou → Copiază URL-ul webhook-ului. Limitat la https, pentru că asta publică care dintre mașinile tale este jos și cât de plin este discul ei.',
    'bot' => 'Un bot al tău',
    'bot_helper' => 'O singură trimitere JSON semnată către o adresă ținută de tine, ca ceva din afara panoului să afle de un node căzut în loc să întrebe în fiecare minut dacă există unul. Webhook-urile aduse de Pelican nu pot duce asta: ele pornesc la modele și la jurnalul de activitate, iar un node care a încetat să răspundă nu scrie în niciunul.',
    'bot_url' => 'Unde se trimite',
    'bot_url_helper' => 'Limitat la https, pentru că asta trimite către o adresă de pe internet care dintre mașinile tale este jos.',
    'bot_secret' => 'Secret de semnare',
    'bot_secret_helper' => 'Împărțit cu ce primește asta. Corpul este trecut prin hash cu el, iar hash-ul călătorește în X-Essentials-Signature ca sha256=<hex>, așa că botul tău poate refuza orice nu a venit de la acest panou. Nu se trimite nimic cât timp asta este goală - o semnătură opțională este una pe care nu o verifică nimeni.',
    'facts' => 'Spune botului și când se întâmplă ceva',
    'facts_helper' => 'Tot ce este mai sus este o defecțiune. Acestea nu: sunt lucruri care pur și simplu s-au întâmplat. Fiecare este oprită până o bifezi, deci actualizarea nu schimbă nimic, și merg doar către bot, niciodată către Discord, clopoțel sau email.',

    'panel' => 'În panou',
    'panel_helper' => 'O notificare pentru toți cei cu această permisiune. Funcționează întotdeauna, nu cere configurare și este invizibilă pentru oricine nu este conectat.',

    'email' => 'E-mail',
    'email_helper' => 'Separate prin virgulă. Folosește chiar mailerul panoului - de încredere când este configurat și complet mut când nu este, iar aceea este singura defecțiune pe care un câine de pază nu are voie să o aibă. Lasă gol ca să o oprești.',

    // ---- ce ----------------------------------------------------------------
    'what' => 'Ce se urmărește',
    'what_helper' => 'Fiecare citire de aici este una pe care panoul o face oricum. Nimic de pe această pagină nu deschide o conexiune pe care Starea sistemului să nu o deschidă.',

    'percent_helper' => 'Zero oprește această verificare.',
    'disk' => 'Alertă când discul unui node trece de',
    'memory' => 'Alertă când memoria unui node trece de',

    'maintenance' => 'Alertă pentru mentenanță care ține mai mult de',
    'maintenance_helper' => 'Un node în mentenanță este sărit de toate celelalte verificări, și asta este corect - și tot așa se uită de unul timp de paisprezece zile. Zero oprește asta.',

    'versions' => 'Versiunile panoului și ale Wings',
    'versions_helper' => 'Un mesaj când ceva a rămas în urmă și unul când este iar la zi. Fără reamintiri - o versiune nu este o cădere.',

    'backups' => 'Copii de siguranță rămase în urmă',
    'backups_helper' => 'Un singur mesaj care numește serverele în loc de câte unul pe server - când o sarcină programată se oprește, toate serverele se învechesc deodată, iar patruzeci de mesaje separate pentru un singur motiv sunt un canal pe care oamenii îl amuțesc. Oprit din start: un panou care salvează de mână și nu după program ar afla despre asta în fiecare zi.',
    'backup_days' => 'Consideră o copie învechită după',
    'backup_days_helper' => 'Este și ceea ce folosește pagina Copii de siguranță. Un server salvat săptămânal nu trebuie raportat după opt zile.',
    'days' => 'zile',

    'stock' => 'Pachete care se epuizează',

    'unbuilt_switch_helper' => 'O comandă cu factura plătită al cărei server a fost refuzat de un nod. Singura verificare de aici în care cineva rămâne fără bani și nimic nu o spune: tot restul din listă e o mașină care s-a oprit. Oprit până îl pornești, ca restul.',

    'unbuilt_switch' => 'Plătit și necreat',
    'stock_helper' => 'Un singur mesaj care numește pachetele în loc de câte unul pe pachet, și niciodată o reamintire: faptul că ceva s-a epuizat este o stare obișnuită a unui magazin, nu o cădere, iar să afli despre ea din patru în patru ore este felul în care mesajele astea nu mai sunt citite. Se uită doar la pachetele cu un plafon, deci un magazin care vinde totul fără limită nu costă nimic de urmărit. Oprit din start, ca și restul.',
    'modules_switch' => 'Un modul pornit care nu funcționează',
    'modules_switch_helper' => 'Un mesaj pe modul în loc de unul singur pentru toate, pentru că fiecare are altceva în neregulă, iar propoziția trebuie să spună ce anume. Raportează două lucruri: un modul căruia îi lipsesc tabelele, adică o instalare care nu a putut termina, și un modul cu părți pornite care așteaptă să fie completat ceva. Pagina Module le arată pe amândouă pe fișă; asta este pentru panourile la care nu se uită nimeni. Oprit din start, ca și restul.',
    'module_tables_title' => 'Modulul „:module” este pornit, iar tabelele lui lipsesc',
    'module_tables' => 'Paginile lui „:module” se ascund pentru că tabelele pe care le citesc nu există, de obicei o instalare care nu a putut termina. Deschide pagina Module, oprește-l și pornește-l la loc, iar tabelele se creează.',
    'module_waiting_title' => 'Modulul „:module” este pornit și o parte din el așteaptă',
    'module_waiting' => '{1} O parte din „:module” este pornită și nu arată nimic până nu se completează ceva - egg-urile pentru care este valabilă, stilurile oferite, serverele pe care trebuie să le arate o pagină publică. Pagina Module spune care, pe fișă.|[2,19] :count părți din „:module” sunt pornite și nu arată nimic până nu se completează ceva - egg-urile pentru care sunt valabile, stilurile oferite, serverele pe care trebuie să le arate o pagină publică. Pagina Module spune care, pe fișă.|[20,*] :count de părți din „:module” sunt pornite și nu arată nimic până nu se completează ceva - egg-urile pentru care sunt valabile, stilurile oferite, serverele pe care trebuie să le arate o pagină publică. Pagina Module spune care, pe fișă.',
    'module_cleared' => 'Modulul „:module” funcționează din nou',
    'ports_switch' => 'Porturi care se epuizează',
    'ports_switch_helper' => 'Un mesaj pe pachet în loc de unul singur pentru toate, pentru că ce folosește este intervalul și numărul, nu o listă de nume. Se uită doar la pachetele cu un interval setat, deci un magazin care lasă cumpărările să ia orice port liber nu costă nimic de urmărit. Oprit din start, ca și restul.',
    'stock_left' => 'Alertă când mai rămân doar',
    'stock_left_helper' => 'Se numără față de plafonul pus pe pachet. Un pachet trebuie să scadă la acest număr ca să fie semnalat și să urce cu doi peste el ca să fie socotit iar sănătos, deci unul pe care o cumpărare și o anulare îl împing încolo și încoace nu spune nimic. Zero este aici un număr, nu o lipsă: ține alerta tăcută și lasă doar mesajul care spune că un pachet s-a terminat.',
    'stock_left_suffix' => 'bucăți',

    'worker' => 'Queue worker',
    'worker_helper' => 'Dacă ceva face de fapt munca de fundal a acestui plugin. Observă cercul: chiar verificarea rulează pe coadă, deci un panou care nu a avut niciodată un worker nu poate raporta asta. Rândul din capul acestei pagini poate.',

    // ---- butoanele ---------------------------------------------------------
    'save' => 'Salvează',
    'saved' => 'Salvat',
    'save_failed' => 'Nu s-a salvat nimic',

    'test' => 'Trimite o probă',
    'test_one' => 'Probează',
    'test_off' => 'Acel canal este oprit',
    'test_off_body' => 'Pornește-l și salvează, iar apoi va fi probat împreună cu celelalte.',
    'test_title' => 'Mesaj de probă',
    'test_body' => 'Dacă citești asta, alertele de la panoul tău Pelican ajung aici. Nu este nimic în neregulă.',
    'test_sent' => 'Trimis către fiecare canal pornit',
    'test_failed' => 'Cel puțin un canal l-a refuzat',
    'test_none' => 'Nu este unde să trimită',
    'test_none_body' => 'Niciun canal nu este pornit, deci nici o alertă adevărată nu ar ajunge nicăieri.',

    /*
     * Ce faci cu un refuz.
     *
     * Motivarea unui furnizor este scurtă, corectă și, singură, nefolositoare.
     * Cele două care apar aproape de fiecare dată sunt numite pe nume, pentru că
     * niciuna nu se poate ghici din cod: un 553 este despre expeditor și nu
     * despre destinatar, iar un 401 de la Discord este un URL retras sau greșit
     * tastat.
     */
    'hint_email_sender' => 'Serverul tău SMTP a refuzat adresa de la care trimite panoul, nu pe cea către care a trimis. La Admin → Setări → E-mail, adresa De la trebuie să fie o cutie poștală în numele căreia contul tău SMTP are voie să trimită. Nu are nicio legătură cu acest plugin - chiar e-mailul de probă al Pelicanului din acea pagină eșuează exact la fel.',
    'hint_email' => 'Vezi la Admin → Setări → E-mail. Butonul de e-mail de probă din acea pagină folosește aceleași setări și spune același lucru.',
    'hint_discord_url' => 'Discord nu a recunoscut acel webhook. A fost șters, refăcut sau lipit incomplet - fă unul nou la Setări server → Integrări → Webhook-uri și copiază tot URL-ul.',
    'hint_discord' => 'Panoul nu a ajuns la Discord. Dacă acest panou este în spatele unui firewall care blochează cererile spre exterior, acest canal nu poate funcționa de aici.',
    'hint_panel' => 'Nimeni nu are permisiunea pentru asta, sau notificarea nu a putut fi salvată. Vezi la Roluri.',

    'run_now' => 'Rulează verificările acum',
    'run_started' => 'Se verifică în fundal',
    'run_failed' => 'Verificările nu au putut fi pornite',

    'reset' => 'Uită ce știe',
    'reset_confirm' => 'Golește ce a spus ultima dată fiecare verificare. Runda următoare învață de la zero și nu trimite nimic, deci o problemă încă în desfășurare este raportată la runda de după. Folosește asta după ce ai scos din funcțiune un node despre care câinele de pază continuă să bată.',
    'reset_done' => 'Golit',

    // ---- mesajele însele ---------------------------------------------------
    'still' => 'Ține de :for.',
    'cleared_body' => 'Stătea așa de :for.',
    'ports_title' => ':game rămâne aproape fără porturi',
    'ports_body' => 'Cumpărările de :game ajung pe :from până la :to, iar doar :free din :total mai sunt libere. O cumpărare care nu găsește niciunul este plătită și apoi refuzată, deci adaugă allocation-uri pe node, sau lărgește intervalul de pe pachet, înainte să se ajungă acolo.',
    'ports_none_title' => 'Nu mai este niciun port pentru :game',
    'ports_none' => 'Cumpărările de :game ajung pe :from până la :to, iar toate cele :total sunt luate. Următoarea cumpărare a acestui joc va fi plătită și apoi refuzată, fără nicio allocation. Adaugă allocation-uri pe node, sau lărgește intervalul chiar pe pachet.',
    'ports_empty_title' => 'Nu există niciun port pentru :game',
    'ports_empty' => 'Cumpărările de :game ajung pe :from până la :to, iar în intervalul acela nu există nicio allocation pe niciun node pe care îl poate folosi. Orice cumpărare a acestui joc va fi plătită și apoi refuzată. Fă allocation-urile pe node, sau lărgește intervalul chiar pe pachet.',
    'ports_cleared' => 'Sunt iar porturi libere pentru :game',

    'for_unknown' => 'o vreme',
    'for_minutes' => '{1} un minut|[2,*] :count minute',
    'for_hours' => '{1} o oră|[2,*] :count ore',
    'for_days' => '{1} o zi|[2,*] :count zile',

    'node_down' => ':node nu răspunde',
    'node_down_body' => 'Panoul nu ajunge la daemonul de pe :node. Serverele de acolo nu vor porni, nu se vor opri și nu vor raporta nimic până nu se întoarce.',
    'node_up' => ':node răspunde din nou',

    'node_disk' => ':node rămâne fără disc',
    'node_disk_body' => 'Discul de pe :node este plin în proporție de :percent %, peste cele :limit % pe care le-ai pus. Copiile de siguranță și instalările de servere sunt primele care cedează când asta se umple.',
    'node_disk_over' => 'Discul de pe :node este iar sub limită',

    'node_memory' => ':node rămâne fără memorie',
    'node_memory_body' => 'Memoria de pe :node este folosită în proporție de :percent %, peste cele :limit % pe care le-ai pus. Serverele de acolo pot fi ucise de kernel înainte ca ceva să raporteze vreo problemă.',
    'node_memory_over' => 'Memoria de pe :node este iar sub limită',

    'node_maintenance' => ':node este de mult în mentenanță',
    'node_maintenance_body' => ':node este în mentenanță de peste :hours ore. Între timp nu se verifică nimic altceva la el, și tocmai asta e ideea - dar merită știut că încă stă așa.',
    'node_maintenance_over' => ':node a ieșit din mentenanță',

    'wings_behind' => 'Wings de pe :node este învechit',
    'wings_behind_body' => ':node rulează Wings :installed, iar :latest a apărut. Actualizează-l chiar pe node - panoul nu are nicio cale să o facă.',
    'wings_current' => 'Wings de pe :node este la zi',

    'panel_behind' => 'Panoul este învechit',
    'panel_behind_body' => 'Acest panou rulează :installed, iar :latest a apărut.',
    'panel_current' => 'Panoul este la zi',

    'and_more' => 'și încă :count',


    'owner_down' => '{1} Unul dintre serverele tale este jos|[2,*] :count dintre serverele tale sunt jos',
    'owner_down_body' => 'Mașina pe care stau nu mai răspunde. Cineva a fost anunțat. Afectate: :servers',
    'owner_up' => '{1} Serverul tău s-a întors|[2,*] :count dintre serverele tale s-au întors',
    'owner_up_body' => 'Mașina răspunde din nou. Înapoi: :servers',

    'schedules' => 'Sarcini programate care s-au oprit',
    'schedules_helper' => 'O sarcină blocată în mijlocul unei rulări, una a cărei oră a trecut pentru că nu rulează cronul, sau una care nu a rulat niciodată. Pelicanul nu are niciun cuvânt pentru niciuna dintre ele - o rulare care a căzut rămâne „în procesare” pentru totdeauna și se desenează exact ca una care rulează acum. Citește fiecare sarcină programată activă de pe panou la fiecare verificare.',

    'schedule_stopped' => '{1} O sarcină programată s-a oprit|[2,*] :count sarcini programate s-au oprit',
    'schedule_stopped_body' => 'Blocate de peste :hours ore, întârziate, niciodată rulate, sau fără nicio sarcină: :schedules',
    'schedule_running' => 'Toate sarcinile programate rulează din nou',

    'unbuilt_over' => 'Fiecare comandă plătită are serverul ei',

    'unbuilt_body' => 'Cineva a plătit și nu are nimic. Deschide Comenzi și creează-le, sau citește de ce au fost refuzate: :orders',

    'unbuilt' => '{1} O comandă plătită fără server|[2,*] :count comenzi plătite fără server',

    'stock_out' => '{1} Un pachet s-a epuizat|[2,*] :count dintre pachetele tale s-au epuizat',
    'stock_out_body' => 'Încă la vânzare, și nu mai este nimic de vândut: :packages',
    'stock_low' => '{1} Un pachet este aproape epuizat|[2,*] :count dintre pachetele tale sunt aproape epuizate',
    'stock_low_body' => 'Au mai rămas :limit sau mai puține la: :packages',
    'stock_back' => '{1} Un pachet este iar la vânzare|[2,*] :count dintre pachetele tale sunt iar la vânzare',
    'stock_back_body' => 'Este iar ceva de vândut: :packages',

    'backup_none' => '{1} Un server nu a fost niciodată salvat|[2,*] :count servere nu au fost niciodată salvate',
    'backup_none_body' => 'Nu s-a făcut niciodată o copie la: :servers',
    'backup_none_over' => 'Acum fiecare server are o copie',

    'backup_stale' => '{1} Un server nu a fost salvat de ceva vreme|[2,*] :count servere nu au fost salvate de ceva vreme',
    'backup_stale_body' => 'Nicio copie reușită de :days zile la: :servers',
    'backup_stale_over' => 'Fiecare server a avut o copie recent',

    'backup_failed' => '{1} Salvările eșuează pe un server|[2,*] Salvările eșuează pe :count servere',
    'backup_failed_body' => 'O copie s-a încheiat fără succes la: :servers',
    'backup_failed_over' => 'Nicio copie de siguranță nu mai eșuează',

    'worker_missing' => 'Nimic nu lucrează pe coadă',
    'worker_missing_body' => 'O sarcină a fost pusă în coadă și nimic nu a luat-o. Actualizările de plugin-uri, instalările de modpack-uri și aceste verificări se opresc toate până când rulează un worker - încearcă systemctl status pelican-queue pe mașina panoului.',
    'worker_back' => 'Se lucrează iar pe coadă',
    'failed_title' => '{1} O sarcină a eșuat de la ultima verificare|[2,*] :count sarcini au eșuat de la ultima verificare',
    'failed_body' => 'Ceva ce panoul avea de făcut nu s-a întâmplat și nu va mai fi încercat - un server neconstruit, o factură nescrisă, un mail netrimis. Sunt în tabela failed_jobs; `php artisan queue:retry all` le pune înapoi, odată ce s-a rezolvat ce le-a oprit.',
    'failed_back' => 'Nimic nu a eșuat de la ultima verificare',
    'failed' => 'Spune-mi când eșuează o sarcină din coadă',
    'failed_helper' => 'Laravel notează o sarcină la care a renunțat și nu spune nimic despre ea. Aceasta spune. Numărate, nu enumerate: douăzeci de eșecuri într-o noapte au de obicei o singură cauză.',

    'health_interval_off' => 'Alertele sunt activate, dar intervalul este pe Oprit, așa că paznicul nu rulează niciodată.',
    'health_owners_unwatched' => 'Alertele pentru proprietari sunt activate, dar paznicul nu rulează, așa că proprietarii nu află niciodată de o întrerupere.',
    'health_no_channel' => 'Paznicul rulează, dar orice mod de a anunța pe cineva este dezactivat.',
    'health_discord' => 'Alertele pe Discord sunt activate, dar nu este salvat niciun webhook https valid.',
    'health_bot' => 'Alertele pentru bot sunt activate, dar lipsește adresa https sau secretul de semnare.',
    'health_email' => 'E-mailurile de alertă sunt activate, dar nu există nicio adresă validă, sau serviciul de e-mail al panoului scrie doar în jurnal.',
];
