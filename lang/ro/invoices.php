<?php

/*
 * Română. Scris de mână.
 *
 * Facturi: documentul, pagina care le listează și e-mailul.
 *
 * Trei cititori împart acest fișier. Administratorul citește tabelul și apasă
 * „marchează ca plătită"; clientul citește documentul de tipărit și e-mailul;
 * iar documentul însuși e citit luni mai târziu de cine ține contabilitatea.
 * Din cauza acestuia din urmă rândurile doc_ sunt seci și oficiale - o factură
 * nu e locul pentru tonul restului panoului.
 */

return [
    'title' => 'Facturi',
    'nav_label' => 'Facturi',
    'subheading' => 'Ce se datorează și ce s-a plătit. A marca una ca plătită aici face tot ce ar face plata: serverul se construiește, unul suspendat revine.',

    // ---- tabelul ---------------------------------------------------------
    'column_number' => 'Factură',
    'column_customer' => 'Client',
    'column_order' => 'Comandă',
    'column_total' => 'Total',
    'column_state' => 'Stare',
    'column_due' => 'Scadentă',

    'kind_order' => 'Prima factură',
    'kind_renewal' => 'Reînnoire',
    'kind_credit' => 'Notă de credit',
    'kind_upgrade' => 'Schimbare de pachet',
    'kind_topup' => 'Adăugare de credit',
    'kind_addon' => 'Supliment',

    'state_unpaid' => 'Neplătită',
    'state_paid' => 'Plătită',
    'state_cancelled' => 'Retrasă',

    'no_order' => 'Fără comandă',
    'order_count' => ':count servicii',
    'no_due' => 'Fără dată',
    'gone_customer' => 'Cont șters',
    'discount_of' => ':amount reducere cu :code',
    'paid_via' => 'prin :how',
    'column_attempts' => 'Plată',
    'paid_by' => 'plătită cu :how',
    'paid_by_unknown' => 'plătită',
    'paid_by_manual' => 'mâna',
    'paid_by_free' => 'nimic de plată',
    'attempts_none' => 'nicio încercare',
    'attempts_open' => ':count încercări - :how',
    'attempt_last' => 'ultima :when, :state',
    'attempt_open' => 'neterminată',
    'attempt_paid' => 'plătită',
    'attempt_cancelled' => 'anulată',
    'attempt_failed' => 'eșuată',
    'emailed' => 'Trimisă',
    'not_emailed' => 'Netrimisă',
    'filter_overdue' => 'Întârziate',

    // ---- butoanele -------------------------------------------------------
    'open' => 'Deschide',
    'mark_paid' => 'Marchează ca plătită',
    'mark_paid_confirm' => 'Consemnează că banii au sosit. Serverul se construiește, unul suspendat pornește din nou, iar următoarea scadență avansează - exact ca și cum ar fi spus-o un procesator de plăți.',
    'paid' => 'Marcată ca plătită',
    'paid_body' => 'Tot ce aștepta această factură e pe drum.',
    'already_paid' => 'Era deja plătită',

    'withdraw' => 'Retrage',
    'withdraw_confirm' => 'Scoate factura din registre. Se poate retrage doar una neplătită; o factură plătită este urma unor bani care au schimbat mâinile.',
    'withdrawn' => 'Retrasă',
    'withdraw_refused' => 'Se poate retrage doar o factură neplătită',

    'empty' => 'Încă nu există facturi',
    'empty_body' => 'Una se scrie de îndată ce cineva cumpără, apoi câte una pe perioadă pentru tot ce se reînnoiește.',

    // ---- documentul ------------------------------------------------------
    'doc_title' => 'Factură',
    'doc_number' => 'Număr',
    'doc_issued' => 'Emisă',
    'doc_due' => 'Scadentă la',
    'doc_paid_on' => 'Plătită',
    'doc_billed_to' => 'Facturat către',
    'doc_from' => 'De la',
    'doc_vat' => 'Cod TVA',
    'doc_coc' => 'Registrul Comerțului',
    'doc_description' => 'Descriere',
    'doc_amount' => 'Sumă',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Reducere',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'Cum se plătește',
    'doc_print' => 'Tipărește sau salvează ca PDF',
    'doc_back' => 'Înapoi la panou',

    // ---- e-mailul --------------------------------------------------------
    'mail_subject' => 'Factura :number',
    'mail_hello' => 'Salut, :name,',
    'mail_intro' => 'Iată factura :number.',
    'mail_open' => 'Deschide factura',
    'mail_foot' => 'Poți reciti oricând această factură pe pagina ta de facturare.',

    // ---- clopoțelul ------------------------------------------------------
    'bell_new' => 'Factura :number',
    'bell_new_body' => 'Ai de plată :total. Deschide pagina de facturare ca să plătești.',
    'bell_reminder' => 'Factura :number a trecut de scadență',
    'bell_reminder_body' => 'Este tot deschisă, de :total. Serverul pe care îl plătește se oprește pe :date dacă nu e achitată până atunci, iar nimic de pe el nu se șterge când asta se întâmplă.',
];
