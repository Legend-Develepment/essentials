<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Tilgodehavende, tilbagebetalinger og kreditnotaer.
 *
 * To ord holdes med vilje adskilt hele vejen nedenfor.
 *
 * Et „tilgodehavende“ er penge, butikken holder for nogen. De går af deres
 * næste faktura af sig selv, før de overhovedet bliver bedt om at betale.
 *
 * En „tilbagebetaling“ er selve det at give penge tilbage, og den kan gå to
 * steder hen: tilbage til det kort, de kom fra, eller videre til kontoen som
 * tilgodehavende. Teksten siger altid hvilken af delene, for en kunde, der får
 * at vide, at der er betalt tilbage, og så ikke finder noget i banken, skriver
 * til os, og det med rette.
 *
 * En „kreditnota“ er dokumentet. Det bliver skrevet i begge tilfælde, for det
 * er beviset på, at pengene ikke længere skyldes butikken - ikke en påstand om,
 * hvor de tog hen.
 */

return [
    // ---- hvad en kunde ser -----------------------------------------------
    'yours' => 'Dit tilgodehavende',
    'yours_body' => 'Det går automatisk af din næste faktura. Du skal ikke selv gøre noget med det.',
    'applied' => 'Betalt af dit tilgodehavende',
    'payable' => 'Tilbage at betale',

    // ---- posterne, i kundevinduet ----------------------------------------
    'held' => 'Tilgodehavende',
    'none_held' => 'Intet på kontoen',
    'movements' => 'Tilgodehavende',
    'column' => 'Tilgodehavende',
    'none' => 'Intet',

    // ---- at give noget ---------------------------------------------------
    'give' => 'Tilgodehavende',
    'give_helper' => 'Der står :held på denne konto. Det, du lægger på, går af deres næste faktura af sig selv. Et negativt beløb tager tilgodehavende af igen, og begge posteringer bliver stående i historikken.',
    'amount' => 'Beløb',
    'amount_helper' => 'Et negativt beløb tager tilgodehavende væk i stedet for at give det.',
    'reason' => 'Årsag',
    'reason_helper' => 'Kunden ser dette ved siden af beløbet, så skriv det til dem og ikke til arkivet.',
    'given' => ':amount i tilgodehavende til :who',
    'bad_amount' => 'Det er ikke et beløb.',
    'give_failed' => 'Tilgodehavendet blev ikke givet',
    'give_failed_body' => 'Der blev ikke skrevet noget. Prøv igen, og kig i loggen, hvis det bliver ved.',
    'take_failed' => 'Tilgodehavendet blev ikke taget af',
    'take_failed_body' => 'Der står mindre på kontoen, end du bad om at fjerne. En saldo går aldrig under nul.',

    // ---- hvad en postering siger -----------------------------------------
    'spent_on' => 'Faktura :number',
    'returned' => 'Lagt tilbage: den faktura, det var til, kunne ikke skrives',
    'note_line' => 'Kreditnota til faktura :number',
    'refund_description' => 'Tilbagebetaling af faktura :number',

    // ---- at give dem tilbage ---------------------------------------------
    'refund' => 'Betal tilbage',
    'refund_helper' => ':left af denne faktura er endnu ikke givet tilbage. Der skrives en kreditnota under alle omstændigheder, så det står fast på begge sider.',
    'refund_amount_helper' => 'En del af det er helt fint. Resten kan gives tilbage senere.',
    'refund_reason_helper' => 'Dette bliver trykt på den kreditnota, kunden kan åbne.',
    'where' => 'Hvor går pengene hen',
    'where_provider' => 'Tilbage til den måde, de betalte på',
    'where_provider_helper' => 'Udbyderen sender dem til det kort eller den konto, de kom fra. Der kan gå et par dage, før de dukker op, og udbyderen kan sige nej - en gammel betaling, eller en metode, der ikke kan køres baglæns.',
    'where_balance' => 'Over på deres konto her',
    'where_balance_helper' => 'Det bliver til tilgodehavende og går af deres næste faktura. Der forlader ikke noget banken, og det kan ikke gå galt.',
    'refunded' => ':amount betalt tilbage',
    'refunded_body' => 'Kreditnota :number blev skrevet for det.',
    'refund_failed' => 'Der blev ikke betalt noget tilbage',

    // ---- og hvorfor ikke, én grund ad gangen -----------------------------
    'refused_off' => 'Tilgodehavende og tilbagebetalinger er slået fra på dette panel.',
    'refused_amount' => 'Det er mere, end der er tilbage på denne faktura.',
    'refused_no_payment' => 'Ingen betaling på denne faktura har så meget tilbage i sig, så der er ikke noget, en udbyder kan køre baglæns. Læg det på deres konto i stedet.',
    'refused_no_gateway' => 'Den udbyder, dette blev betalt gennem, er ikke slået til længere, så den kan ikke blive bedt om at køre noget baglæns. Læg det på deres konto i stedet.',
    'refused_refused' => 'Udbyderen sagde nej. Det er som regel en gammel betaling eller en metode, der ikke kan køres baglæns; grunden, de gav, står i loggen. Læg det på deres konto i stedet.',
    'refused_note_failed' => 'Pengene blev flyttet, men kreditnotaen ville ikke skrives, så der blev ikke noteret noget. Kig i loggen, før du prøver igen.',

    // ---- at lægge penge på -----------------------------------------------
    'topup' => 'Læg tilgodehavende på',
    'topup_helper' => 'Du har :held på kontoen. Det, du lægger på her, går af din næste faktura af sig selv, og enhver faktura, du allerede har stående åben, bliver betalt af det, i det øjeblik det er inde.',
    'topup_go' => 'Videre til betaling',
    'topup_amount_helper' => 'Mellem :least og :most.',
    'topup_bad' => 'Det beløb kan ikke betales',
    'topup_failed' => 'Betalingen kunne ikke startes. Prøv igen, og sig det til den, der driver dette panel, hvis det bliver ved.',
    'topup_line' => 'Tilgodehavende lagt på kontoen',
    'topup_reason' => 'Lagt på med faktura :number',

    // ---- hvor det bliver vist --------------------------------------------
    'menu' => ':amount tilgode',
    'held_helper' => 'Går af din næste faktura af sig selv. Du lægger mere på fra fakturasiden.',
];
