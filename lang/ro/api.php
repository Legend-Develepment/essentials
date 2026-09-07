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
    'subheading' => 'Chei care lasă ceva din afara panoului să întrebe ce știe acest plugin. Doar citire — nimic de aici nu poate porni, opri sau atinge un server.',

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
    'once_body' => 'Se păstrează ca hash, deci nimeni — nici cel care ține acest panou — nu o poate citi înapoi. Lipește-o unde o citește botul sau scriptul, acum. Dacă se pierde, revoc-o pe aceasta și cere alta.',
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
    'scope_panel_helper' => 'Răspunde la întrebările care privesc tot panoul — fiecare node, capacitatea, câinele de pază, chiar gazda panoului. Pentru un bot care raportează despre panou și nu în numele unei persoane.',

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
    'grant_confirm' => 'Emite o cheie care răspunde pentru serverele proprii ale acestei persoane și o arată o singură dată. El vede deja tot ce va raporta ea — asta hotărăște dacă ceva din afara panoului poate întreba în numele lui.',
    'granted' => 'Dată',

    'refuse' => 'Refuză',
    'refuse_answer' => 'Ce vor afla',
    'refuse_answer_helper' => 'Opțional, și arătat pe pagina lor. Un refuz fără motiv este unul care se cere din nou săptămâna viitoare.',
    'refused' => 'Refuzată',

    'revoke' => 'Revocă',
    'revoke_confirm' => 'Cheia încetează imediat să răspundă, iar hash-ul ei dispare, deci nu poate fi recuperată. Tot ce o folosește se oprește. Cere una nouă în loc să anulezi asta.',
    'revoked' => 'Revocată',

    'mint' => 'Cheie nouă',
    'mint_body' => 'Pentru un bot și nu pentru o persoană. Primește permisiunea chiar în clipa în care este creată, pentru că tu ești cel care i-ar fi spus da.',
    'mint_owner' => 'Cine este',
    'mint_owner_helper' => 'O cheie răspunde ca cineva. Pentru o cheie care privește tot panoul, este doar cine răspunde de ea; pentru una personală, este și ce poate vedea cheia.',
    'minted' => 'Creată',

    // ---- ce setează un administrator -------------------------------------
    'settings' => 'Așa funcționează',
    'approval' => 'Cererile așteaptă permisiunea',
    'approval_helper' => 'Pornit, cel care cere o cheie o primește când cineva spune da. Oprit, o primește imediat — ceea ce are sens pe un panou unde toți cei cu cont sunt deja de încredere, și merită ales și nu doar nimerit.',
    'rate' => 'Cereri pe minut, pentru fiecare cheie',
    'rate_helper' => 'Un bot care întreabă patruzeci de servere cine joacă înseamnă patruzeci de întrebări către patruzeci de servere de joc. Acesta este plafonul care oprește o buclă scrisă la trei dimineața să devină un test de încărcare.',
    'days' => 'O cheie dată ține',
    'days_helper' => 'În zile. Zero înseamnă până la revocare, și aceasta este valoarea implicită — o cheie care expiră când nimeni nu se uită este un bot care se oprește noaptea fără ca nimic să spună de ce.',
    'days_never' => 'Până la revocare',

    /*
     * Spus pe pagină și nu lăsat să fie descoperit. Pelicanul dă înapoi
     * migrările unui plugin când acesta este dezinstalat, iar singurul tabel al
     * acestui plugin pleacă odată cu ele.
     */
    'uninstall_note' => 'Ștergerea acestui plugin șterge fiecare cheie odată cu el. Este intenționat — o cheie care supraviețuiește lucrului care îi răspunde este o autentificare pe care nimeni nu o mai poate retrage.',
];
