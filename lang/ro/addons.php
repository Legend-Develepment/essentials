<?php

/*
 * Română. Scris de mână.
 *
 * Suplimente vândute alături de un pachet.
 *
 * Două lucruri sunt ținute aici separate. Cât *costă* un supliment este prețul
 * lui, adică ce se taxează de fiecare dată. Cât costă *astăzi* este o parte din
 * asta, pentru că cine cumpără unul la jumătatea lunii plătește o jumătate de
 * lună. Textele pentru client spun mereu la care dintre cele două se referă.
 *
 * „Nu adaugă nimic serverului” este un răspuns adevărat și se scrie pe față în
 * loc să fie lăsat gol, pentru că suportul cu prioritate este un lucru cât se
 * poate de obișnuit de vândut, iar o celulă goală se citește ca o greșeală.
 */

return [
    'title' => 'Suplimente',
    'nav_label' => 'Suplimente',
    'subheading' => 'Lucruri vândute alături de un pachet: mai multă memorie, încă un loc de copie de rezervă sau ceva ce este doar un rând pe factură.',

    // ---- tabelul ----------------------------------------------------------
    'column_name' => 'Supliment',
    'column_price' => 'Preț',
    'column_adds' => 'Adaugă',
    'column_sold' => 'În uz',
    'column_live' => 'De vânzare',
    'adds_nothing' => 'Nimic pe server',

    // ---- formularul -------------------------------------------------------
    'section_what' => 'Ce este',
    'section_what_helper' => 'Numele și prețul pe care le vede un client, și cu ce pachete poate fi cumpărat.',
    'name' => 'Nume',
    'price' => 'Preț',
    'price_helper' => 'Cât costă de fiecare dată când se taxează. Cumpărat la mijlocul unei perioade, clientul plătește o parte din el, iar de la următoarea reînnoire plătește tot.',
    'billing' => 'Se taxează',
    'billing_helper' => 'Cu serviciul înseamnă că revine la fiecare reînnoire, cât timp îl păstrează. O dată înseamnă că se taxează pe factura care îl poartă prima și niciodată după aceea.',
    'billing_with' => 'La fiecare reînnoire',
    'billing_once' => 'O dată',
    'max' => 'Cel mult pe serviciu',
    'max_helper' => 'Câte bucăți din acesta poate avea cineva. Una este cazul obișnuit; ridică numărul pentru ceva vândut la gigabyte.',
    'description' => 'Descriere',
    'description_helper' => 'Un rând sub nume, la finalizarea comenzii. Spune ce face, nu cum se numește.',
    'packages' => 'Pachete',
    'packages_helper' => 'Cu ce pachete poate fi cumpărat acesta. Nimic bifat înseamnă toate, iar așa este de obicei o opțiune de suport sau un loc de copie de rezervă.',

    'section_adds' => 'Ce adaugă serverului',
    'section_adds_helper' => 'Acestea se adaugă la ce dă deja pachetul, nu se pun în locul lui: 4096 la memorie face serverul cu 4 GiB mai mare. Două bucăți din același supliment se adună. Lasă-le pe toate pe zero pentru ceva ce este doar un rând pe factură. Un număr negativ ia ceva înapoi, ceea ce este permis și este uneori chiar ce vrea cineva.',
    'sort' => 'Ordine',
    'sort_helper' => 'Mai mic vine mai întâi la finalizarea comenzii. La numere egale se merge după preț.',
    'live' => 'De vânzare',
    'live_helper' => 'Oprit, nu este oferit nicăieri. Cine îl are deja îl păstrează și este taxat mai departe pentru el.',

    // ---- acțiuni ----------------------------------------------------------
    'new' => 'Supliment nou',
    'edit' => 'Modifică',
    'delete' => 'Șterge',
    'delete_confirm' => 'Nimeni nu îl are. Ștergerea îl scoate de pe listă definitiv.',
    'delete_sold' => ':count servicii îl au. Ele îl păstrează, păstrează limitele pe care li le-a dat și sunt taxate mai departe pentru el - ce dispare este intrarea de pe listă, deci nimeni nou nu îl mai poate cumpăra.',
    'go_live' => 'Pune la vânzare',
    'go_offline' => 'Retrage de la vânzare',
    'saved' => 'Salvat',
    'deleted' => 'Suplimentul a dispărut',
    'save_failed' => 'Nu s-a salvat',
    'save_failed_body' => 'Nu s-a scris nimic. Încearcă din nou și uită-te în log dacă se tot întâmplă.',
    'invalid' => 'Un supliment are nevoie de un nume și de un preț.',
    'empty' => 'Încă nu există suplimente',
    'empty_body' => 'Un supliment este ceva vândut lângă un pachet: încă un gigabyte, un al doilea loc de copie de rezervă sau un serviciu care nu adaugă absolut nimic serverului.',

    // ---- ce vede clientul -------------------------------------------------
    'choose' => 'Suplimente',
    'choose_helper' => 'Opționale, iar mai târziu le poți adăuga sau renunța la ele.',
    'yours' => 'Suplimente pe acest serviciu',
    'add' => 'Adaugă un supliment',
    'add_helper' => 'Acum plătești cât a mai rămas din această perioadă, iar de la următoarea reînnoire plătești prețul întreg.',
    'add_to' => 'Adaugă :name',
    'add_confirm' => 'Adaugi :name la acest serviciu?',
    'drop' => 'Elimină',
    'drop_confirm' => 'Elimini :name? Partea nefolosită din ce ai plătit se întoarce în contul tău, iar serverul tău se schimbă imediat.',
    'costs_now' => ':amount acum',
    'free_now' => 'Nimic de plată acum',
    'then' => 'apoi :amount pe reînnoire',
    'once_only' => ':amount, o dată',
    'each' => 'bucata',
    'added' => ':name adăugat',
    'added_body' => 'Serverul tău a primit ce adaugă el.',
    'dropped' => ':name eliminat',
    'dropped_body' => 'Tot ce ai plătit și nu ai folosit este în contul tău.',

    // ---- și când nu se poate ----------------------------------------------
    'refused' => 'Asta nu s-a putut face',
    'refused_off' => 'Suplimentele sunt oprite pe acest panou.',
    'refused_not_active' => 'Doar unui serviciu care merge i se pot adăuga suplimente.',
    'refused_gone' => 'Acel supliment nu mai este de vânzare.',
    'refused_wrong_package' => 'Acel supliment nu se vinde cu acest pachet.',
    'refused_enough' => 'Ai deja atâtea dintre acelea câte poate avea acest serviciu.',
    'refused_failed' => 'Nu s-a notat nimic, deci nu s-a schimbat nimic. Încearcă din nou și spune-i celui care ține panoul dacă se tot întâmplă.',
    'refused_server' => 'Serverul nu a acceptat limitele noi, deci nu s-a schimbat nimic și nu s-a taxat nimic.',
    'refused_not_yours' => 'Acel supliment nu este pe acest serviciu.',

    // ---- ce scrie pe documente --------------------------------------------
    'line' => ':name × :many, pentru cele :days zile rămase din această perioadă',
    'credit_reason' => 'Eliminat: :name',
    'bell_failed' => 'Un supliment nu a putut fi dat serverului la comanda :number',

    // ---- unități, pentru tabelul de administrare --------------------------
    'unit_memory' => 'MiB memorie',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disc',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'baze de date',
    'unit_allocation_limit' => 'allocation-uri',
    'unit_backup_limit' => 'copii de rezervă',
];
