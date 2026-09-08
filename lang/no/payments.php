<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Betalinger: hvert forsøk på å betale, og hva leverandøren sa om det.
 *
 * Én rad per forsøk i stedet for per faktura, for det er det som skjedde. Ordet
 * denne siden gjentar er "forsøk": en betaling som mislyktes er et faktum verdt
 * å ta vare på, ikke en feil å skjule.
 */

return [
    'title' => 'Betalinger',
    'nav_label' => 'Betalinger',
    'subheading' => 'Hvert forsøk på å betale, hos hver leverandør. Sjekk igjen spør leverandøren en gang til - akkurat det webhooken deres gjør når den kommer fram.',

    // ---- tabellen --------------------------------------------------------
    'column_invoice' => 'Faktura',
    'column_gateway' => 'Leverandør',
    'column_reference' => 'Referansen deres',
    'column_amount' => 'Beløp',
    'column_state' => 'Tilstand',
    'column_updated' => 'Sist hørt',

    'gone_invoice' => 'Faktura slettet',

    'state_open' => 'Venter',
    'state_paid' => 'Betalt',
    'state_failed' => 'Mislyktes',
    'state_cancelled' => 'Forlatt',

    // ---- knappene --------------------------------------------------------
    'recheck' => 'Sjekk igjen',
    'rechecked' => 'Spurt på nytt',
    'rechecked_body' => 'Leverandøren sier fortsatt ikke at den er betalt. Ingenting er endret.',
    'settled' => 'Den er betalt',
    'settled_body' => 'Fakturaen er gjort opp, og alt som ventet på den er på vei.',
    'recheck_failed' => 'Kunne ikke spørre',
    'recheck_failed_body' => 'Leverandøren svarte ikke. Prøv igjen om et minutt; fortsetter det, sjekk nøkkelen på siden Butikkinnstillinger.',
    'no_gateway' => 'Den leverandøren er av',
    'no_gateway_body' => 'Slå den på igjen for å spørre om denne betalingen, eller merk fakturaen betalt for hånd.',

    'answer' => 'Svaret deres',
    'no_answer' => 'Ingenting notert',
    'close' => 'Lukk',

    'empty' => 'Ingen har betalt gjennom en leverandør ennå',
    'empty_body' => 'Forsøk dukker opp her i det øyeblikket noen trykker Betal - enten de fullfører eller ikke.',
];
