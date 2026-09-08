<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Kunder: butikken, bare vendt mot personen i stedet for mot raden.
 *
 * Bestillinger, fakturaer og betalinger er hver en liste over hva som har
 * skjedd. Denne siden stiller spørsmålet den som sitter med en sak faktisk
 * har: hvem er dette, hva har de, hva har de betalt, og hva står igjen.
 */

return [
    'title' => 'Kunder',
    'nav_label' => 'Kunder',
    'subheading' => 'Alle som har kjøpt noe, med hva de har, hva de har betalt og hva som fortsatt skyldes.',

    // ---- tabellen --------------------------------------------------------
    'column_customer' => 'Kunde',
    'column_services' => 'Tjenester',
    'column_spent' => 'Betalt',
    'column_outstanding' => 'Utestående',

    'of_orders' => 'av :count bestilte',
    'nothing_owed' => 'Ingenting',

    'filter_owing' => 'Skylder noe',
    'filter_active' => 'Har en aktiv tjeneste',

    // ---- en av dem -------------------------------------------------------
    'open' => 'Åpne',
    'close' => 'Lukk',
    'servers' => 'Servere',
    'since' => 'Kunde siden',
    'their_services' => 'Tjenester',
    'their_invoices' => 'Fakturaer',
    'no_services' => 'Ingenting aktivt, og ingenting som venter på å bli bygget.',
    'no_invoices' => 'Det er ikke skrevet noen fakturaer for denne kontoen.',

    'empty' => 'Ingen har kjøpt noe ennå',
    'empty_body' => 'Her står de som har bestilt, ikke alle med en konto - så den fylles ved første salg.',
];
