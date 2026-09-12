<?php

/*
 * Română. Scris de mână.
 *
 * Credit, rambursări și note de credit.
 *
 * Două cuvinte sunt ținute dinadins separate peste tot mai jos.
 *
 * „Creditul” sunt bani pe care magazinul îi ține pentru cineva. Se scad singuri
 * din următoarea lui factură, înainte să i se ceară vreodată să plătească.
 *
 * „Rambursarea” este actul de a da banii înapoi și are două destinații: pe
 * cardul de pe care au venit sau în cont, ca credit. Formularea spune mereu
 * care dintre ele, pentru că un client căruia i se spune „ai fost rambursat”
 * și care apoi nu găsește nimic în bancă scrie, și pe bună dreptate.
 *
 * „Nota de credit” este documentul. Se scrie în ambele cazuri, pentru că ea
 * consemnează că banii nu mai sunt datorați magazinului - nu spune nimic despre
 * unde au ajuns.
 */

return [
    // ---- ce vede clientul ------------------------------------------------
    'yours' => 'Creditul tău',
    'yours_body' => 'Se scade automat din următoarea ta factură. Nu trebuie să faci nimic cu el.',
    'applied' => 'Plătit din creditul tău',
    'payable' => 'Rămâne de plată',

    // ---- registrul, în fereastra clientului ------------------------------
    'held' => 'Credit',
    'none_held' => 'Nimic în cont',
    'movements' => 'Credit',
    'column' => 'Credit',
    'none' => 'Nimic',

    // ---- cum se dă -------------------------------------------------------
    'give' => 'Credit',
    'give_helper' => 'Contul acesta are :held. Ce pui pe el se scade singur din următoarea lui factură. O sumă negativă ia creditul înapoi, iar ambele mișcări rămân în istoric.',
    'amount' => 'Sumă',
    'amount_helper' => 'O sumă negativă ia credit în loc să dea.',
    'reason' => 'Motiv',
    'reason_helper' => 'Clientul vede asta lângă sumă, deci scrie-o pentru el, nu pentru dosar.',
    'given' => ':amount credit pentru :who',
    'bad_amount' => 'Aceea nu este o sumă.',
    'give_failed' => 'Creditul nu a fost dat',
    'give_failed_body' => 'Nu s-a scris nimic. Încearcă din nou și uită-te în log dacă se tot întâmplă.',
    'take_failed' => 'Creditul nu a fost luat',
    'take_failed_body' => 'În cont este mai puțin decât ai cerut să scoți. Un sold nu se duce niciodată sub zero.',

    // ---- ce spune o mișcare ----------------------------------------------
    'spent_on' => 'Factura :number',
    'returned' => 'Pus înapoi: factura pentru care era nu a putut fi scrisă',
    'note_line' => 'Notă de credit pentru factura :number',
    'refund_description' => 'Rambursarea facturii :number',

    // ---- cum se dau banii înapoi -----------------------------------------
    'refund' => 'Rambursează',
    'refund_helper' => 'Din factura aceasta nu s-au dat încă înapoi :left. Nota de credit se scrie în ambele cazuri, deci rămâne o urmă de ambele părți.',
    'refund_amount_helper' => 'O parte din ea este în regulă. Ce rămâne se poate da înapoi mai târziu.',
    'refund_reason_helper' => 'Asta se tipărește pe nota de credit pe care clientul o poate deschide.',
    'where' => 'Unde se duc banii',
    'where_provider' => 'Înapoi pe unde a plătit',
    'where_provider_helper' => 'Procesatorul îi trimite pe cardul sau în contul din care au venit. Pot trece câteva zile până să apară, iar el poate refuza - o plată veche sau o metodă care nu se poate întoarce.',
    'where_balance' => 'În contul lui de aici',
    'where_balance_helper' => 'Devin credit și se scad din următoarea lui factură. Nu pleacă nimic din bancă și nu poate eșua.',
    'refunded' => 'S-au rambursat :amount',
    'refunded_body' => 'Pentru ei s-a scris nota de credit :number.',
    'refund_failed' => 'Nu s-a rambursat nimic',

    // ---- și de ce nu, câte un motiv pe rând ------------------------------
    'refused_off' => 'Creditul și rambursările sunt oprite pe acest panou.',
    'refused_amount' => 'Este mai mult decât a rămas pe factura aceasta.',
    'refused_no_payment' => 'Nicio plată de pe factura aceasta nu mai are atât în ea, deci procesatorul nu are ce să întoarcă. Pune suma în contul lui de aici.',
    'refused_no_gateway' => 'Procesatorul prin care s-a plătit nu mai este pornit, deci nu i se poate cere să întoarcă nimic. Pune suma în contul lui de aici.',
    'refused_refused' => 'Procesatorul a refuzat. De obicei este vorba de o plată veche sau de o metodă care nu se poate întoarce; motivul pe care l-a dat este în log. Pune suma în contul lui de aici.',
    'refused_note_failed' => 'Banii s-au mutat, dar nota de credit nu s-a scris, deci nu s-a consemnat nimic. Uită-te în log înainte să încerci din nou.',

    // ---- cum se pun bani în cont -----------------------------------------
    'topup' => 'Adaugă credit',
    'topup_helper' => 'Ai :held în cont. Ce adaugi aici se scade singur din următoarea ta factură, iar orice factură deschisă pe care o ai deja se achită din el în clipa în care ajunge.',
    'topup_go' => 'Continuă spre plată',
    'topup_amount_helper' => 'Între :least și :most.',
    'topup_bad' => 'Suma aceasta nu se poate plăti',
    'topup_failed' => 'Plata nu a putut fi pornită. Încearcă din nou și spune-i celui care ține panoul dacă se tot întâmplă.',
    'topup_line' => 'Credit adăugat în cont',
    'topup_reason' => 'Adăugat pe factura :number',

    // ---- unde se arată ---------------------------------------------------
    'menu' => ':amount credit',
    'held_helper' => 'Se scade singur din următoarea ta factură. Îl poți completa în pagina de facturi.',
];
