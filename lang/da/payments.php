<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Betalinger: hvert forsøg på at betale, og hvad udbyderen sagde om det.
 *
 * Én række per forsøg i stedet for per faktura, for det er det, der skete.
 * Ordet, denne side bliver ved med at sige, er "forsøg": en betaling, der
 * mislykkedes, er en kendsgerning, det er værd at gemme, ikke en fejl at
 * skjule.
 */

return [
    'title' => 'Betalinger',
    'nav_label' => 'Betalinger',
    'subheading' => 'Hvert forsøg på at betale, hos hver udbyder. Tjek igen spørger udbyderen en gang til - præcis det, deres webhook gør, når den kommer frem.',

    // ---- tabellen --------------------------------------------------------
    'column_invoice' => 'Faktura',
    'column_gateway' => 'Udbyder',
    'column_reference' => 'Deres reference',
    'column_amount' => 'Beløb',
    'column_state' => 'Tilstand',
    'column_updated' => 'Sidst hørt',

    'gone_invoice' => 'Faktura slettet',

    'state_open' => 'Venter',
    'state_paid' => 'Betalt',
    'state_failed' => 'Mislykkedes',
    'state_cancelled' => 'Opgivet',

    // ---- knapperne -------------------------------------------------------
    'recheck' => 'Tjek igen',
    'rechecked' => 'Spurgt igen',
    'rechecked_body' => 'Udbyderen siger stadig ikke, at den er betalt. Der er ikke ændret noget.',
    'settled' => 'Den er betalt',
    'settled_body' => 'Fakturaen er afregnet, og alt, hvad der ventede på den, er på vej.',
    'recheck_failed' => 'Kunne ikke spørge',
    'recheck_failed_body' => 'Udbyderen svarede ikke. Prøv igen om et minut; bliver det ved, så tjek nøglen på siden Butiksindstillinger.',
    'no_gateway' => 'Den udbyder er slukket',
    'no_gateway_body' => 'Tænd den igen for at spørge om denne betaling, eller markér fakturaen betalt i hånden.',

    'answer' => 'Deres svar',
    'no_answer' => 'Intet noteret',
    'close' => 'Luk',

    'empty' => 'Ingen har endnu betalt gennem en udbyder',
    'empty_body' => 'Forsøg dukker op her, i samme øjeblik nogen trykker Betal - uanset om de gør det færdigt.',
];
