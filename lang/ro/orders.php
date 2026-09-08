<?php

/*
 * Română. Scris de mână.
 *
 * Comenzi: ce a cumpărat cineva și ce a ieșit din asta.
 *
 * Cele patru stări de mai jos vorbesc despre bani, nu despre server. Dacă
 * serverul merge chiar acum este întrebarea Pelicanului însuși și primește
 * răspuns în paginile lui. Cuvintele de aici țin cele două lucruri separate.
 */

return [
    'title' => 'Comenzi',
    'nav_label' => 'Comenzi',
    'subheading' => 'Tot ce s-a cumpărat, serverul care a ieșit din asta și cum stau lucrurile.',

    // ---- tabelul ---------------------------------------------------------
    'column_order' => 'Comandă',
    'column_customer' => 'Client',
    'column_package' => 'Pachet',
    'column_server' => 'Server',
    'column_state' => 'Stare',
    'column_due' => 'Următoarea scadență',

    'no_server' => 'Încă neconstruit',
    'no_due' => 'Plată unică',
    'gone_customer' => 'Cont șters',
    'gone_package' => 'Pachet șters',
    'overdue_days' => 'Întârziat cu :days zile',

    'state_pending' => 'Așteaptă',
    'state_active' => 'Activă',
    'state_suspended' => 'Suspendată',
    'state_cancelled' => 'Anulată',

    // ---- butoanele -------------------------------------------------------
    'retry' => 'Construiește din nou',
    'retry_confirm' => 'Pune construirea la coadă încă o dată. Nimic altceva nu se schimbă, iar factura rămâne plătită.',
    'retrying' => 'Pus la coadă',

    'suspend' => 'Suspendă',
    'suspend_confirm' => 'Oprește serverul cu suspendarea proprie a Pelicanului. Fișierele, bazele de date și copiile de siguranță rămân unde sunt, iar plata facturii o ridică la loc.',
    'suspended' => 'Suspendată',

    'unsuspend' => 'Ridică suspendarea',
    'unsuspended' => 'Merge din nou',

    'change_due' => 'Schimbă scadența',
    'change_due_helper' => 'Când se scrie următoarea factură. Gol înseamnă niciodată - comanda încetează să se reînnoiască fără a fi anulată.',

    'cancel' => 'Anulează',
    'cancel_confirm' => 'Oprește reînnoirile și dă înapoi locul din stoc. Serverul rămâne: se șterge din Pelican, acolo unde îi este locul.',
    'cancelled' => 'Anulată',

    'saved' => 'Salvat',
    'refused' => 'Nu s-a schimbat nimic',
    'refused_body' => 'Comanda nu este într-o stare care să permită asta. Reîncarcă pagina și uită-te încă o dată.',

    // ---- ce aude clientul ------------------------------------------------
    'bell_ready' => 'Serverul tău e gata',
    'bell_ready_body' => ':server a fost creat și așteaptă să îl pornești.',
    'bell_suspended' => 'Serverul tău a fost suspendat',
    'bell_suspended_body' => 'O factură a rămas neplătită dincolo de perioada de grație. Plata ei pornește serverul din nou; nu s-a șters nimic.',

    // ---- ce aude administratorul -----------------------------------------
    'bell_failed' => 'Comanda :number nu a putut fi construită',
    'no_allocation' => 'Niciun node din acest pachet nu are o allocation liberă. Adaugă una și construiește din nou.',
    'no_reason' => 'Panoul a refuzat fără să spună de ce.',

    // ---- serverul care iese din asta -------------------------------------
    'server_description' => 'Cumpărat din magazin, comanda :number.',
    'server_fallback' => 'Server',

    'empty' => 'Nu s-a cumpărat încă nimic',
    'empty_body' => 'Comenzile apar aici de îndată ce cineva cumpără un pachet.',

    // ---- reînnoiri -------------------------------------------------------
    'filter_late' => 'În urmă cu o factură',
    'run_renewals' => 'Rulează reînnoirile acum',
    'run_renewals_confirm' => 'Face ce face trecerea de noapte: scrie următoarea factură pentru tot ce ajunge curând la scadență și oprește serverele din spatele unei facturi rămase neplătite dincolo de perioada de grație.',
    'renewals_queued' => 'Pus la coadă',
    'renewals_queued_body' => 'Rulează la coadă. Reîncarcă peste o clipă ca să vezi ce s-a schimbat.',
];
