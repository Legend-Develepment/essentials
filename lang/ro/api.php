<?php

/*
 * Română. Scrisă de mână.
 *
 * O cale înăuntru de afară.
 *
 * Două feluri de cititori într-un singur fișier, iar fiecare vrea altceva. Un
 * administrator care citește pagina aceasta e pe cale să hotărască dacă are
 * încredere să dea cuiva o cheie, așa că fiecare rând de aici spune până unde
 * ajunge o cheie și nu cum se numește. Cel care cere una vrea să știe ce
 * primește în mână și ce se întâmplă dacă o pierde, iar de aceea propoziția
 * despre faptul că o cheie se arată o singură dată nu este o notă de subsol.
 *
 * Nimic de aici nu spune „token”. „Cheie” este cuvântul de pe chiar pagina de
 * cont a Pelicanului, iar un panou care numește același lucru în două feluri
 * este un panou în care cineva caută altceva.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Chei care lasă ceva din afara panoului să întrebe ce știe acest plugin. Doar citire - nimic de aici nu poate porni, opri sau atinge un server.',

    'my_title' => 'Acces API',
    'my_nav_label' => 'Acces API',
    'my_subheading' => 'O cheie a ta, pentru un bot sau un script. Răspunde doar pentru serverele pe care le poți deschide deja.',

    // ---- ce este o cheie, spus o dată, acolo unde contează --------------
    'address' => 'Adresa',
    'address_helper' => 'Trimite cheia ca antet Authorization: :example',

    /*
     * Singurul lucru pe care cineva trebuie să îl fi citit înainte să se închidă
     * fereastra. Scris ca ce trebuie făcut și nu ca avertisment, pentru că „ai
     * grijă de ea” este un sfat după care nimeni nu poate acționa, iar
     * „lipește-o unde o citește botul, acum” este.
     */
    'once' => 'Aceasta este singura dată când se arată această cheie',
    'once_body' => 'Se păstrează ca hash, deci nimeni - nici cel care ține acest panou - nu o poate citi înapoi. Lipește-o unde o citește botul sau scriptul, acum. Dacă se pierde, revoc-o pe aceasta și cere alta.',
    'copy' => 'Copiază',
    'copied' => 'Copiat',

    // ---- stările ---------------------------------------------------------
    'state' => 'Stare',
    'state_pending' => 'În așteptare',
    'state_active' => 'Activă',
    'state_refused' => 'Refuzată',
    'state_revoked' => 'Revocată',

    'state_pending_body' => 'Cineva trebuie să dea permisiunea înainte ca ea să răspundă la ceva.',
    'state_refused_body' => 'La aceasta s-a spus nu. Nu s-a emis nimic.',
    'state_revoked_body' => 'Această cheie a fost luată și nu mai răspunde.',

    // ---- întinderea ------------------------------------------------------
    'scope' => 'Ajunge la',
    'scope_person' => 'Serverele lui',
    'scope_panel' => 'Tot panoul',

    'scope_person_helper' => 'Răspunde doar pentru serverele pe care proprietarul le poate deschide deja, întrebate la fel cum întreabă panoul. Pierderea acestei chei nu pierde nimic ce proprietarul nu ar putea vedea oricum.',
    'scope_panel_helper' => 'Răspunde la întrebările care privesc tot panoul - fiecare node, capacitatea, câinele de pază, chiar gazda panoului. Pentru un bot care raportează despre panou și nu în numele unei persoane.',

    // ---- tabelul ---------------------------------------------------------
    'column_name' => 'Pentru ce',
    'column_owner' => 'Al cui',
    'column_prefix' => 'Cheie',
    'column_asked' => 'Cerută',
    'column_used' => 'Folosită ultima dată',
    'column_expires' => 'Expiră',

    'never_used' => 'Niciodată',
    'no_expiry' => 'Până la revocare',

    'tab_waiting' => 'În așteptare',
    'tab_active' => 'Active',
    'tab_all' => 'Toate',

    'empty' => 'Încă nicio cheie',
    'empty_body' => 'Nimeni nu a cerut una și nu s-a emis niciuna. Pagina se completează singură pe măsură ce oamenii o fac.',

    'my_empty' => 'Nu ai nicio cheie',
    'my_empty_body' => 'Cere una și va apărea aici, împreună cu răspunsul primit.',

    // ---- cererea ---------------------------------------------------------
    'ask' => 'Cere o cheie',
    'ask_name' => 'La ce va fi folosită',
    'ask_name_helper' => 'Câteva cuvinte, ca mai târziu să deosebești două de-ale tale și ca cel care dă permisiunea să știe la ce dă permisiune.',
    'ask_reason' => 'Ceva ce merită adăugat',
    'ask_reason_helper' => 'Opțional. Îl citește cel care hotărăște.',
    'ask_sent' => 'Cerută',
    'ask_sent_body' => 'Va apărea mai jos de îndată ce cineva a răspuns.',
    'ask_granted' => 'Iată cheia ta',
    'ask_open' => 'Ai deja una care așteaptă răspuns',
    'ask_open_body' => 'O cerere pe rând. Retrage-o dacă a fost o greșeală.',
    'ask_failed' => 'Cererea nu a putut fi făcută',

    'cancel' => 'Renunță',
    'cancel_confirm' => 'Retrage cererea. Nu s-a emis nimic, deci nici nu încetează ceva să funcționeze.',

    // ---- hotărârea -------------------------------------------------------
    'grant' => 'Dă permisiunea',
    'grant_confirm' => 'Emite o cheie care răspunde pentru serverele proprii ale acestei persoane și o arată o singură dată. El vede deja tot ce va raporta ea - asta hotărăște dacă ceva din afara panoului poate întreba în numele lui.',
    'granted' => 'Dată',

    'refuse' => 'Refuză',
    'refuse_answer' => 'Ce vor afla',
    'refuse_answer_helper' => 'Opțional, și arătat pe pagina lor. Un refuz fără motiv este unul care se cere din nou săptămâna viitoare.',
    'refused' => 'Refuzată',
    'collect' => 'Arată-mi cheia',
    'state_ready_body' => 'Dată. Apasă Arată-mi cheia ca să o vezi - o singură dată, pentru că se păstrează ca hash și după aceea nu mai poate fi citită înapoi.',
    'replace' => 'Înlocuiește',
    'replace_confirm' => 'Cheia aceasta încetează să funcționeze imediat și una nouă îi ia locul, arătată o singură dată. Cea veche nu poate fi căutată nicăieri - nu a fost păstrată niciodată - deci înlocuirea este singurul răspuns la pierderea ei.',
    'granted_body' => 'Și-o ia singur, de pe pagina lui de Acces API. Nu se arată aici: o cheie este a celui care a cerut-o, nu a celui care a spus da.',

    'revoke' => 'Revocă',
    'revoke_confirm' => 'Cheia încetează imediat să răspundă, iar hash-ul ei dispare, deci nu poate fi recuperată. Tot ce o folosește se oprește. Cere una nouă în loc să anulezi asta.',
    'revoked' => 'Revocată',
    'forget' => 'Elimină',
    'forget_confirm' => 'Scoate rândul de pe pagina aceasta pentru totdeauna. A încetat deja să răspundă, deci nu se oprește nimic din ce funcționează - asta doar șterge urma că a existat.',
    'forgotten' => 'Eliminată',

    'mint' => 'Cheie nouă',
    'mint_body' => 'Pentru un bot și nu pentru o persoană. Primește permisiunea chiar în clipa în care este creată, pentru că tu ești cel care i-ar fi spus da.',
    'abilities' => 'Despre ce are voie să întrebe',
    'abilities_helper' => 'Totul este bifat de la început, pentru că asta era o cheie înainte ca lucrul acesta să existe. Debifarea este actul făcut cu intenție. Ce se păstrează este lista celor permise, așa că o abilitate adăugată într-o versiune mai târzie stă oprită pentru cheile făcute înaintea ei - o putere pe care nu a bifat-o nimeni este o putere pe care nu a dat-o nimeni.',
    'ability_health' => 'Dovedește că cheia merge',
    'ability_health_helper' => 'Nu ajunge la nimic altceva. Poate fi chemată pe un cronometru fără grijă.',
    'ability_me' => 'Serverele proprii',
    'ability_me_helper' => 'Serverele pe care proprietarul le poate deschide deja și copiile lor de siguranță. Nu poate vedea niciodată pe altcineva.',
    'ability_panel' => 'Tot panoul',
    'ability_panel_helper' => 'Fiecare node, fiecare copie de siguranță, programările oprite, câinele de pază și gazda panoului. Are nevoie și de o cheie pentru tot panoul.',
    'ability_live' => 'Întreabă direct un server',
    'ability_live_helper' => 'Cine joacă și dacă un server merge. Singurele întrebări care costă ceva - ajung la un server de joc sau la un daemon, ținute în cache cincisprezece până la douăzeci de secunde.',
    'ability_connect' => 'Leagă conturi Discord de conturi din panou',
    'ability_connect_helper' => 'Singurul grup care nu este o citire. Creează chei API Pelican pe conturile celor care cer asta și poate încheia o legătură. Dă-l numai botului care are nevoie de el.',
    'own_rate' => 'Cereri pe minut pentru cheia aceasta',
    'own_rate_helper' => 'Lasă gol ca să urmeze setarea panoului. Un număr aici se aplică numai acestei chei. Zero înseamnă că nu există niciun plafon - rezonabil pentru un bot de pe mașina ta și un fel foarte adevărat de a-ți părea rău dacă cheia ajunge altundeva.',
    'own_rate_default' => 'Urmează panoul',
    'mint_owner' => 'Cine este',
    'mint_owner_helper' => 'O cheie răspunde ca cineva. Pentru o cheie care privește tot panoul, este doar cine răspunde de ea; pentru una personală, este și ce poate vedea cheia.',
    'minted' => 'Creată',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'O cheie pentru Essentials API',
    'profile_make_helper' => 'Un API diferit de cel de mai sus: acesta răspunde ce știe acest plugin - care dintre serverele tale nu are copie de siguranță, cine joacă pe ele, dacă merg. Răspunde întotdeauna numai pentru tine și ajunge doar la serverele pe care le poți deschide deja.',
    'profile_create' => 'Creează',
    'profile_yours' => 'Cheile tale Essentials',
    'profile_manage' => 'Revocarea unei chei, motivul pentru care una a fost refuzată și conectarea Discord stau toate pe pagina Acces API din bara laterală.',
    'discord' => 'Discord',
    'discord_body' => 'Leagă contul tău de Discord de acesta, ca un bot să poată răspunde pentru serverele tale când îi ceri. Ce primește este o cheie care ajunge exact la ce ajungi și tu și la nimic mai mult.',
    'discord_connect' => 'Conectează Discord',
    'discord_code' => 'Scrie asta în Discord în zece minute',
    'discord_code_body' => 'Trimite :command într-un canal pe care botul îl poate citi. Codul merge o singură dată. Nu îl poate folosi nimeni în afară de contul pentru care a fost făcut.',
    'discord_on' => 'Conectat ca :name',
    'discord_since' => 'Din :when',
    'discord_cut' => 'Deconectat',
    'discord_cut_confirm' => 'Încheie legătura și șterge cheia pe care a făcut-o, așa că botul încetează imediat să răspundă pentru tine. Te poți conecta din nou oricând vrei.',
    'discord_off' => 'Neconectat',
    'discord_key_note' => 'Conectarea creează pe contul tău o cheie API Pelican numită Discord (Essentials). O poți vedea, și o poți revoca, la Cont → Chei API - pagina aceasta este doar o scurtătură către același lucru.',
    'docs_title' => 'Cum se folosește acest API',
    'docs_subheading' => 'La ce răspunde acest panou și la ce adrese răspunde. Scris din aceeași descriere din care este construit API-ul, așa că nu are cum să rămână o versiune în urma lui.',
    'docs_base' => 'Unde se află',
    'docs_endpoints' => 'Endpoint-uri',
    'docs_answers' => 'Ce vine înapoi',
    'docs_calls' => 'Cheile care îl pot chema',
    'docs_params' => 'Ce se trimite',
    'docs_required' => 'obligatoriu',
    'docs_optional' => 'opțional',
    'docs_try' => 'Încearcă',
    'docs_errors' => 'Când ceva nu este în regulă',
    'docs_hook' => 'Ce îți trimite panoul',
    'docs_hook_body' => 'Cealaltă direcție și singura parte de aici care sosește fără să fie cerută. Se pornește la Alerte, cu o adresă și un secret de semnare: o trimitere JSON când câinele de pază găsește ceva și una când trece, ca un bot să afle de un node căzut în loc să întrebe în fiecare minut dacă există unul.',
    'docs_hook_verify' => 'Corpul este trecut prin hash cu secretul tău, iar hash-ul călătorește în X-Essentials-Signature ca sha256=<hex>. Fă hash-ul pe corpul brut, nu pe un obiect reserializat - orice diferență de spațiere sau de ordine a cheilor dă alt hash, iar nepotrivirea se citește ca un atac, nu ca o eroare.',
    'docs_download_md' => 'Descarcă în format Markdown',
    'docs_download_json' => 'Descarcă în format OpenAPI',

    // ---- ce setează un administrator -------------------------------------
    'settings' => 'Așa funcționează',
    'approval' => 'Cererile așteaptă permisiunea',
    'approval_helper' => 'Pornit, cel care cere o cheie o primește când cineva spune da. Oprit, o primește imediat - ceea ce are sens pe un panou unde toți cei cu cont sunt deja de încredere, și merită ales și nu doar nimerit.',
    'rate' => 'Cereri pe minut, pentru fiecare cheie',
    'rate_helper' => 'Un bot care întreabă patruzeci de servere cine joacă înseamnă patruzeci de întrebări către patruzeci de servere de joc. Acesta este plafonul care oprește o buclă scrisă la trei dimineața să devină un test de încărcare.',
    'days' => 'O cheie dată ține',
    'days_helper' => 'În zile. Zero înseamnă până la revocare, și aceasta este valoarea implicită - o cheie care expiră când nimeni nu se uită este un bot care se oprește noaptea fără ca nimic să spună de ce.',
    'days_never' => 'Până la revocare',
    'hide_pelican' => 'Scoate fila de chei API a panoului însuși',
    'hide_pelican_helper' => 'Scoate cu totul fila de chei API din profilul contului, așa că pe pagina aceea rămâne un singur lucru numit chei API. Este scoasă din pagină, nu acoperită, deci nu mai rămâne nicio adresă care să ajungă la ea. Un lucru pe care nu îl poate face: propriul client API al panoului tot va face o cheie de cont pentru orice îi cere direct - fila este locul unde oamenii fac una de mână, iar asta ia mâna. Cheile care există deja merg mai departe.',

    /*
     * Spus pe pagină și nu lăsat să fie descoperit. Pelicanul dă înapoi
     * migrările unui plugin când acesta este dezinstalat, iar singurul tabel al
     * acestui plugin pleacă odată cu ele.
     */
    'uninstall_note' => 'Ștergerea acestui plugin șterge fiecare cheie odată cu el. Este intenționat - o cheie care supraviețuiește lucrului care îi răspunde este o autentificare pe care nimeni nu o mai poate retrage.',
];
