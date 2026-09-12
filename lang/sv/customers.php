<?php

/*
 * Svenska. Skrivet för hand.
 *
 * Kunder: butiken, fast vänd mot personen i stället för mot raden.
 *
 * Beställningar, fakturor och betalningar är var och en en lista över vad som
 * hänt. Den här sidan ställer den fråga som den som sitter med ett ärende
 * faktiskt har: vem är det här, vad har de, vad har de betalat och vad står
 * kvar.
 */

return [
    'title' => 'Kunder',
    'nav_label' => 'Kunder',
    'subheading' => 'Alla som köpt något, med vad de har, vad de betalat och vad som fortfarande är obetalt.',

    // ---- tabellen --------------------------------------------------------
    'column_customer' => 'Kund',
    'column_services' => 'Tjänster',
    'column_spent' => 'Betalat',
    'column_outstanding' => 'Utestående',

    'of_orders' => 'av :count beställda',
    'nothing_owed' => 'Ingenting',

    'filter_owing' => 'Är skyldig något',
    'filter_active' => 'Har en aktiv tjänst',

    // ---- en av dem -------------------------------------------------------
    'open' => 'Öppna',
    'close' => 'Stäng',
    'servers' => 'Servrar',
    'since' => 'Kund sedan',
    'their_services' => 'Tjänster',
    'their_invoices' => 'Fakturor',
    'no_services' => 'Inget aktivt, och inget som väntar på att byggas.',
    'no_invoices' => 'Inga fakturor har skrivits för det här kontot.',

    'empty' => 'Ingen har köpt något än',
    'empty_body' => 'Här står de som beställt, inte alla med ett konto - så den fylls vid första försäljningen.',
    'who' => 'Vem det är',
];
