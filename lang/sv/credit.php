<?php

/*
 * Svenska. Skriven för hand.
 *
 * Tillgodo, återbetalningar och kreditfakturor.
 *
 * Två ord hålls isär med flit överallt här nedanför.
 *
 * «Tillgodo» är pengar butiken håller åt någon. De dras från nästa faktura av
 * sig själva, innan personen ens blir ombedd att betala.
 *
 * En «återbetalning» är själva handlingen att ge pengar tillbaka, och den har
 * två mål: till kortet de kom ifrån, eller vidare till kontot som tillgodo.
 * Orden säger alltid vilket av dem det är, för en kund som fått höra «du har
 * fått pengarna tillbaka» och sedan inte hittar något på banken hör av sig, och
 * det med rätta.
 *
 * En «kreditfaktura» är dokumentet. Ett skrivs oavsett vilken väg pengarna tog,
 * för det är beviset på att pengarna inte längre är butikens - inte ett
 * påstående om vart de tog vägen.
 */

return [
    // ---- vad en kund ser --------------------------------------------------
    'yours' => 'Ditt tillgodo',
    'yours_body' => 'Det dras från din nästa faktura automatiskt. Du behöver inte göra något med det.',
    'applied' => 'Betalt med ditt tillgodo',
    'payable' => 'Kvar att betala',

    // ---- kontot, i kundfönstret -------------------------------------------
    'held' => 'Tillgodo',
    'none_held' => 'Ingenting på kontot',
    'movements' => 'Tillgodo',
    'column' => 'Tillgodo',
    'none' => 'Inget',

    // ---- att ge lite ------------------------------------------------------
    'give' => 'Tillgodo',
    'give_helper' => 'Det här kontot har :held. Det du lägger på det dras från deras nästa faktura av sig självt. Ett negativt belopp tar bort tillgodo igen, och båda rörelserna blir kvar i historiken.',
    'amount' => 'Belopp',
    'amount_helper' => 'Ett negativt belopp tar bort tillgodo i stället för att ge det.',
    'reason' => 'Skäl',
    'reason_helper' => 'Kunden ser det här bredvid beloppet, så skriv det åt dem och inte åt pärmen.',
    'given' => ':amount tillgodo till :who',
    'bad_amount' => 'Det är inget belopp.',
    'give_failed' => 'Tillgodot gavs inte',
    'give_failed_body' => 'Ingenting skrevs. Försök igen, och titta i loggen om det fortsätter.',
    'take_failed' => 'Tillgodot togs inte bort',
    'take_failed_body' => 'Det finns mindre på kontot än du bad om att ta bort. Ett saldo går aldrig under noll.',

    // ---- vad en rörelse säger ---------------------------------------------
    'spent_on' => 'Faktura :number',
    'returned' => 'Tillbakalagt: fakturan det gällde gick inte att skriva',
    'note_line' => 'Kreditfaktura till faktura :number',
    'refund_description' => 'Återbetalning av faktura :number',

    // ---- att ge tillbaka det ----------------------------------------------
    'refund' => 'Betala tillbaka',
    'refund_helper' => ':left av den här fakturan har inte getts tillbaka än. En kreditfaktura skrivs oavsett vilket, så att det finns ett spår av det på båda sidor.',
    'refund_amount_helper' => 'En del av det går bra. Det som blir kvar går att ge tillbaka senare.',
    'refund_reason_helper' => 'Det här trycks på den kreditfaktura kunden kan öppna.',
    'where' => 'Vart tar pengarna vägen',
    'where_provider' => 'Tillbaka samma väg de betalades',
    'where_provider_helper' => 'Leverantören skickar dem till kortet eller kontot de kom ifrån. Det kan ta några dagar innan de syns, och de kan neka - en gammal betalning, eller ett sätt som inte går att backa.',
    'where_balance' => 'Vidare till deras konto här',
    'where_balance_helper' => 'De blir tillgodo och dras från deras nästa faktura. Ingenting lämnar banken, och det kan inte gå fel.',
    'refunded' => ':amount återbetalt',
    'refunded_body' => 'Kreditfaktura :number skrevs för det.',
    'refund_failed' => 'Ingenting betalades tillbaka',

    // ---- och varför inte, ett skäl i taget --------------------------------
    'refused_off' => 'Tillgodo och återbetalningar är avstängda för den här panelen.',
    'refused_amount' => 'Det är mer än vad som är kvar på den här fakturan.',
    'refused_no_payment' => 'Ingen betalning på den här fakturan har så mycket kvar i sig, så det finns ingenting för en leverantör att backa. Lägg det på deras konto i stället.',
    'refused_no_gateway' => 'Leverantören det här betalades genom är inte påslagen längre, så den går inte att be att backa något. Lägg det på deras konto i stället.',
    'refused_refused' => 'Leverantören nekade. Det beror oftast på en gammal betalning eller ett sätt som inte går att backa; skälet de gav står i loggen. Lägg det på deras konto i stället.',
    'refused_note_failed' => 'Pengarna flyttades men kreditfakturan gick inte att skriva, så ingenting antecknades. Titta i loggen innan du försöker igen.',

    // ---- att lägga på pengar ----------------------------------------------
    'topup' => 'Fyll på tillgodo',
    'topup_helper' => 'Du har :held på kontot. Det du lägger på här dras från din nästa faktura av sig självt, och varje faktura du redan har öppen regleras ur det i samma stund det kommer in.',
    'topup_go' => 'Gå vidare till betalning',
    'topup_amount_helper' => 'Mellan :least och :most.',
    'topup_bad' => 'Det beloppet går inte att betala',
    'topup_failed' => 'Betalningen gick inte att starta. Försök igen, och säg till den som sköter panelen om det fortsätter.',
    'topup_line' => 'Tillgodo tillagt på kontot',
    'topup_reason' => 'Tillagt på faktura :number',

    // ---- var det visas ----------------------------------------------------
    'menu' => ':amount tillgodo',
    'held_helper' => 'Dras från din nästa faktura av sig självt. Fyll på det på fakturasidan.',
];
