<?php

/*
 * Svenska. Skrivet för hand.
 *
 * Betalningar: varje försök att betala, och vad leverantören sa om det.
 *
 * En rad per försök i stället för per faktura, för det är det som hände. Ordet
 * den här sidan upprepar är "försök": en betalning som misslyckades är ett
 * faktum värt att spara, inte ett fel att gömma.
 */

return [
    'title' => 'Betalningar',
    'nav_label' => 'Betalningar',
    'subheading' => 'Varje försök att betala, hos varje leverantör. Kolla igen frågar leverantören en gång till - precis det deras webhook gör när den kommer fram.',

    // ---- tabellen --------------------------------------------------------
    'column_invoice' => 'Faktura',
    'column_gateway' => 'Leverantör',
    'column_reference' => 'Deras referens',
    'column_amount' => 'Belopp',
    'column_state' => 'Tillstånd',
    'column_updated' => 'Senast hört',

    'gone_invoice' => 'Faktura borttagen',

    'state_open' => 'Väntar',
    'state_paid' => 'Betald',
    'state_failed' => 'Misslyckades',
    'state_cancelled' => 'Övergiven',

    // ---- knapparna -------------------------------------------------------
    'recheck' => 'Kolla igen',
    'rechecked' => 'Frågade på nytt',
    'rechecked_body' => 'Leverantören säger fortfarande inte att den är betald. Ingenting har ändrats.',
    'settled' => 'Den är betald',
    'settled_body' => 'Fakturan är reglerad och allt som väntade på den är på väg.',
    'recheck_failed' => 'Gick inte att fråga',
    'recheck_failed_body' => 'Leverantören svarade inte. Försök igen om en minut; fortsätter det, kontrollera nyckeln på sidan Butiksinställningar.',
    'no_gateway' => 'Den leverantören är av',
    'no_gateway_body' => 'Slå på den igen för att fråga om den här betalningen, eller markera fakturan betald för hand.',

    'answer' => 'Deras svar',
    'no_answer' => 'Ingenting antecknat',
    'close' => 'Stäng',

    'empty' => 'Ingen har betalat via en leverantör än',
    'empty_body' => 'Försök dyker upp här i samma stund som någon trycker Betala - oavsett om de blir klara.',
];
