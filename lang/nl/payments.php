<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Betalingen: elke poging om te betalen en wat de aanbieder erover zei.
 *
 * Eén regel per poging in plaats van per factuur, want dat is wat er gebeurd
 * is. Het woord dat deze pagina blijft zeggen is "poging": een betaling die
 * mislukte is een feit dat het bewaren waard is, geen vergissing om te
 * verstoppen.
 */

return [
    'title' => 'Betalingen',
    'nav_label' => 'Betalingen',
    'subheading' => 'Elke poging om te betalen, via elke aanbieder. Opnieuw nakijken vraagt het de aanbieder nog eens, precies wat hun webhook doet zodra die binnenkomt.',

    // ---- de tabel --------------------------------------------------------
    'column_invoice' => 'Factuur',
    'column_gateway' => 'Aanbieder',
    'column_reference' => 'Hun kenmerk',
    'column_amount' => 'Bedrag',
    'column_state' => 'Toestand',
    'column_updated' => 'Laatst gehoord',

    'gone_invoice' => 'Factuur verwijderd',

    'state_open' => 'Wacht',
    'state_paid' => 'Betaald',
    'state_failed' => 'Mislukt',
    'state_cancelled' => 'Afgebroken',

    // ---- de knoppen ------------------------------------------------------
    'recheck' => 'Opnieuw nakijken',
    'rechecked' => 'Opnieuw gevraagd',
    'rechecked_body' => 'De aanbieder zegt nog steeds niet dat het betaald is. Er is niets veranderd.',
    'settled' => 'Het is betaald',
    'settled_body' => 'De factuur is voldaan en alles wat erop wachtte is onderweg.',
    'recheck_failed' => 'Vragen lukte niet',
    'recheck_failed_body' => 'De aanbieder antwoordde niet. Probeer het over een minuut nog eens; blijft het gebeuren, kijk dan de sleutel na op de pagina Winkelinstellingen.',
    'no_gateway' => 'Die aanbieder staat uit',
    'no_gateway_body' => 'Zet hem weer aan om naar deze betaling te vragen, of zet de factuur met de hand op betaald.',

    'answer' => 'Hun antwoord',
    'no_answer' => 'Niets vastgelegd',
    'close' => 'Sluiten',

    'empty' => 'Nog niemand heeft via een aanbieder betaald',
    'empty_body' => 'Pogingen komen hier te staan zodra iemand op Betalen drukt, of ze nu afgerond worden of niet.',
];
