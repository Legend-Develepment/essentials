<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Klanten: de winkel, maar dan gericht op de persoon in plaats van op de regel.
 *
 * Bestellingen, facturen en betalingen zijn elk een lijst van wat er gebeurd
 * is. Deze pagina stelt de vraag die iemand met een ticket voor zich echt
 * heeft: wie is dit, wat heeft die, wat is er betaald en wat staat er nog
 * open. De woorden hier zijn voor dat moment gekozen, niet voor een rapport.
 */

return [
    'title' => 'Klanten',
    'nav_label' => 'Klanten',
    'subheading' => 'Iedereen die iets gekocht heeft, met wat ze hebben, wat ze betaald hebben en wat er nog openstaat.',

    // ---- de tabel --------------------------------------------------------
    'column_customer' => 'Klant',
    'column_services' => 'Diensten',
    'column_spent' => 'Betaald',
    'column_outstanding' => 'Openstaand',

    'of_orders' => 'van :count besteld',
    'nothing_owed' => 'Niets',

    'filter_owing' => 'Heeft nog openstaan',
    'filter_active' => 'Heeft een actieve dienst',

    // ---- één van hen -----------------------------------------------------
    'open' => 'Openen',
    'close' => 'Sluiten',
    'servers' => 'Servers',
    'since' => 'Klant sinds',
    'their_services' => 'Diensten',
    'their_invoices' => 'Facturen',
    'no_services' => 'Niets actiefs, en niets dat nog gebouwd moet worden.',
    'no_invoices' => 'Voor dit account zijn geen facturen geschreven.',

    'empty' => 'Nog niemand heeft iets gekocht',
    'empty_body' => 'Hier staan mensen die besteld hebben, niet iedereen met een account, dus het vult zich met de eerste verkoop.',
    'who' => 'Wie het is',
];
