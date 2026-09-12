<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Tilgodehavende, refusjoner og kreditnotaer.
 *
 * To ord holdes bevisst fra hverandre overalt nedenfor.
 *
 * «Tilgodehavende» er penger butikken holder for noen. Det trekkes fra neste
 * faktura av seg selv, før de i det hele tatt blir bedt om å betale.
 *
 * En «refusjon» er det å gi penger tilbake, og den har to steder å gå: til
 * kortet de kom fra, eller videre inn på kontoen som tilgodehavende. Ordlyden
 * sier alltid hvilken av delene, for en kunde som får høre «du har fått
 * pengene tilbake» og så ikke finner noe i banken, skriver til deg - med rette.
 *
 * En «kreditnota» er dokumentet. Det skrives uansett hvilken vei pengene gikk,
 * for det er beviset på at pengene ikke lenger skyldes butikken - ikke en
 * påstand om hvor de tok veien.
 */

return [
    // ---- hva en kunde ser ------------------------------------------------
    'yours' => 'Tilgodehavendet ditt',
    'yours_body' => 'Dette trekkes automatisk fra neste faktura. Du trenger ikke gjøre noe med det.',
    'applied' => 'Betalt fra tilgodehavendet ditt',
    'payable' => 'Igjen å betale',

    // ---- regnskapet, i kundevinduet --------------------------------------
    'held' => 'Tilgodehavende',
    'none_held' => 'Ingenting på konto',
    'movements' => 'Tilgodehavende',
    'column' => 'Tilgodehavende',
    'none' => 'Ingen',

    // ---- å gi noe --------------------------------------------------------
    'give' => 'Tilgodehavende',
    'give_helper' => 'Denne kontoen har :held. Det du legger inn, trekkes fra neste faktura av seg selv. Et negativt beløp tar tilgodehavende av igjen, og begge bevegelsene blir stående i historikken.',
    'amount' => 'Beløp',
    'amount_helper' => 'Et negativt beløp tar tilgodehavende bort i stedet for å gi.',
    'reason' => 'Grunn',
    'reason_helper' => 'Kunden ser dette ved siden av beløpet, så skriv det til ham og ikke til arkivet.',
    'given' => ':amount i tilgodehavende til :who',
    'bad_amount' => 'Det er ikke et beløp.',
    'give_failed' => 'Tilgodehavendet ble ikke gitt',
    'give_failed_body' => 'Ingenting ble skrevet. Prøv igjen, og se i loggen hvis det fortsetter å skje.',
    'take_failed' => 'Tilgodehavendet ble ikke tatt av',
    'take_failed_body' => 'Det står mindre på kontoen enn du ba om å fjerne. En saldo tas aldri under null.',

    // ---- hva en bevegelse sier -------------------------------------------
    'spent_on' => 'Faktura :number',
    'returned' => 'Lagt tilbake: fakturaen det gjaldt, kunne ikke skrives',
    'note_line' => 'Kreditnota for faktura :number',
    'refund_description' => 'Refusjon av faktura :number',

    // ---- å gi det tilbake ------------------------------------------------
    'refund' => 'Refunder',
    'refund_helper' => ':left av denne fakturaen er ennå ikke gitt tilbake. Det skrives en kreditnota uansett, så det står nedtegnet på begge sider.',
    'refund_amount_helper' => 'En del av den går fint. Det som blir igjen, kan gis tilbake senere.',
    'refund_reason_helper' => 'Dette trykkes på kreditnotaen kunden kan åpne.',
    'where' => 'Hvor går pengene',
    'where_provider' => 'Tilbake dit de betalte fra',
    'where_provider_helper' => 'Leverandøren sender dem til kortet eller kontoen de kom fra. Det kan ta noen dager før de dukker opp, og leverandøren kan si nei - en gammel betaling, eller en måte som ikke lar seg reversere.',
    'where_balance' => 'Inn på kontoen deres her',
    'where_balance_helper' => 'Det blir tilgodehavende og trekkes fra neste faktura. Ingenting forlater banken, og det kan ikke feile.',
    'refunded' => ':amount refundert',
    'refunded_body' => 'Kreditnota :number ble skrevet for det.',
    'refund_failed' => 'Ingenting ble refundert',

    // ---- og hvorfor ikke, én grunn om gangen -----------------------------
    'refused_off' => 'Tilgodehavende og refusjoner er slått av for dette panelet.',
    'refused_amount' => 'Det er mer enn det som er igjen på denne fakturaen.',
    'refused_no_payment' => 'Ingen betaling på denne fakturaen har så mye igjen i seg, så det er ingenting en leverandør kan reversere. Legg det heller inn på kontoen deres.',
    'refused_no_gateway' => 'Leverandøren dette ble betalt gjennom, er ikke på lenger, så den kan ikke bli bedt om å reversere noe. Legg det heller inn på kontoen deres.',
    'refused_refused' => 'Leverandøren sa nei. Det er som regel en gammel betaling eller en måte som ikke lar seg reversere; grunnen de ga, står i loggen. Legg det heller inn på kontoen deres.',
    'refused_note_failed' => 'Pengene ble flyttet, men kreditnotaen lot seg ikke skrive, så ingenting ble nedtegnet. Se i loggen før du prøver igjen.',

    // ---- å legge penger inn ----------------------------------------------
    'topup' => 'Fyll på tilgodehavende',
    'topup_helper' => 'Du har :held på konto. Det du legger inn her, trekkes fra neste faktura av seg selv, og en faktura du allerede har åpen, gjøres opp fra det i det øyeblikket det kommer inn.',
    'topup_go' => 'Videre til betaling',
    'topup_amount_helper' => 'Mellom :least og :most.',
    'topup_bad' => 'Det beløpet kan ikke betales',
    'topup_failed' => 'Betalingen kunne ikke settes i gang. Prøv igjen, og si fra til den som driver panelet, hvis det fortsetter å skje.',
    'topup_line' => 'Tilgodehavende lagt inn på konto',
    'topup_reason' => 'Lagt inn på faktura :number',

    // ---- hvor det vises --------------------------------------------------
    'menu' => ':amount tilgode',
    'held_helper' => 'Trekkes fra neste faktura av seg selv. Fyll på fra fakturasiden.',
];
