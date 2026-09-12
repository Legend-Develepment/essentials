<?php

/*
 * Extra’s die naast een pakket verkocht worden.
 *
 * Twee dingen worden hier uit elkaar gehouden. Wat een extra *kost* is zijn
 * prijs, en dat is wat er elke keer in rekening wordt gebracht. Wat het
 * *vandaag* kost is een deel daarvan, want wie er halverwege de maand een koopt
 * betaalt een halve maand. De teksten voor de klant zeggen altijd welke van de
 * twee bedoeld wordt.
 *
 * "Voegt niets toe aan de server" is een echt antwoord en wordt uitgeschreven
 * in plaats van leeg gelaten, want voorrang bij support is een doodgewoon ding
 * om te verkopen en een lege cel leest als een fout.
 */

return [
    'title' => 'Extra’s',
    'nav_label' => 'Extra’s',
    'subheading' => 'Dingen die naast een pakket verkocht worden: meer geheugen, een extra back-upslot, of iets dat alleen een regel op de factuur is.',

    // ---- de tabel ---------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Prijs',
    'column_adds' => 'Voegt toe',
    'column_sold' => 'In gebruik',
    'column_live' => 'Te koop',
    'adds_nothing' => 'Niets aan de server',

    // ---- het formulier ----------------------------------------------------
    'section_what' => 'Wat het is',
    'section_what_helper' => 'De naam en de prijs die een klant ziet, en bij welke pakketten het gekocht kan worden.',
    'name' => 'Naam',
    'price' => 'Prijs',
    'price_helper' => 'Wat het elke keer kost. Koopt iemand het halverwege een periode, dan betaalt hij daar een deel van en vanaf de volgende verlenging het hele bedrag.',
    'billing' => 'In rekening gebracht',
    'billing_helper' => 'Bij de dienst betekent dat het bij elke verlenging terugkomt, zolang ze het houden. Eenmalig betekent dat het op de factuur staat die het voor het eerst draagt en daarna nooit meer.',
    'billing_with' => 'Bij elke verlenging',
    'billing_once' => 'Eenmalig',
    'max' => 'Hoogstens per dienst',
    'max_helper' => 'Hoeveel iemand er van deze mag hebben. Eén is het gewone geval; zet het hoger voor iets dat per gigabyte verkocht wordt.',
    'description' => 'Omschrijving',
    'description_helper' => 'Eén regel onder de naam bij het afrekenen. Zeg wat het doet, niet hoe het heet.',
    'packages' => 'Pakketten',
    'packages_helper' => 'Bij welke pakketten dit gekocht kan worden. Niets aangevinkt betekent bij allemaal, en dat is wat een supportoptie of een back-upslot meestal is.',

    'section_adds' => 'Wat het aan de server toevoegt',
    'section_adds_helper' => 'Dit komt bovenop wat het pakket al geeft, het komt er niet voor in de plaats: 4096 bij geheugen maakt de server 4 GiB groter. Twee dezelfde extra’s tellen bij elkaar op. Laat alles op nul voor iets dat alleen een regel op de factuur is. Een negatief getal haalt iets weg, dat mag, en het is af en toe precies wat iemand wil.',
    'sort' => 'Volgorde',
    'sort_helper' => 'Lager komt eerst bij het afrekenen. Bij gelijke getallen telt de prijs.',
    'live' => 'Te koop',
    'live_helper' => 'Uit wordt het nergens aangeboden. Wie het al heeft houdt het en blijft ervoor betalen.',

    // ---- de knoppen -------------------------------------------------------
    'new' => 'Nieuw extra',
    'edit' => 'Bewerken',
    'delete' => 'Verwijderen',
    'delete_confirm' => 'Niemand heeft deze. Verwijderen haalt hem definitief van de lijst.',
    'delete_sold' => ':count dienst(en) hebben deze. Zij houden hem, houden de limieten die hij gaf en blijven ervoor betalen - wat weggaat is de regel op de lijst, zodat niemand hem nog nieuw kan kopen.',
    'go_live' => 'Te koop zetten',
    'go_offline' => 'Uit de verkoop halen',
    'saved' => 'Opgeslagen',
    'deleted' => 'Het extra is weg',
    'save_failed' => 'Niet opgeslagen',
    'save_failed_body' => 'Er is niets weggeschreven. Probeer het opnieuw, en kijk in het log als het blijft gebeuren.',
    'invalid' => 'Een extra heeft een naam en een prijs nodig.',
    'empty' => 'Nog geen extra’s',
    'empty_body' => 'Een extra is iets dat naast een pakket verkocht wordt: nog een gigabyte, een tweede back-upslot, of een dienst die helemaal niets aan de server toevoegt.',

    // ---- wat een klant ziet -----------------------------------------------
    'choose' => 'Extra’s',
    'choose_helper' => 'Niet verplicht, en je kunt ze later toevoegen of eraf halen.',
    'yours' => 'Extra’s bij deze dienst',
    'add' => 'Extra toevoegen',
    'add_helper' => 'Je betaalt nu voor wat er over is van deze periode, en vanaf de volgende verlenging het hele bedrag.',
    'add_to' => ':name toevoegen',
    'add_confirm' => ':name aan deze dienst toevoegen?',
    'drop' => 'Verwijderen',
    'drop_confirm' => ':name verwijderen? Het ongebruikte deel van wat je betaald hebt gaat terug op je rekening, en je server verandert meteen.',
    'costs_now' => 'nu :amount',
    'free_now' => 'Nu niets te betalen',
    'then' => 'daarna :amount per verlenging',
    'once_only' => ':amount, eenmalig',
    'each' => 'per stuk',
    'added' => ':name toegevoegd',
    'added_body' => 'Je server heeft gekregen wat het toevoegt.',
    'dropped' => ':name verwijderd',
    'dropped_body' => 'Wat je betaald had en niet gebruikt hebt staat op je rekening.',

    // ---- en wanneer het niet lukt -----------------------------------------
    'refused' => 'Dat kon niet',
    'refused_off' => 'Extra’s staan uit voor dit panel.',
    'refused_not_active' => 'Alleen bij een lopende dienst kun je extra’s toevoegen.',
    'refused_gone' => 'Dat extra is niet meer te koop.',
    'refused_wrong_package' => 'Dat extra wordt niet bij dit pakket verkocht.',
    'refused_enough' => 'Je hebt er al zoveel van als deze dienst mag hebben.',
    'refused_failed' => 'Er is niets vastgelegd, dus er is niets veranderd. Probeer het opnieuw, en meld het bij wie dit panel beheert als het blijft gebeuren.',
    'refused_server' => 'De server wilde de nieuwe limieten niet aannemen, dus er is niets veranderd en er is niets in rekening gebracht.',
    'refused_not_yours' => 'Dat extra hoort niet bij deze dienst.',

    // ---- wat er op de documenten staat ------------------------------------
    'line' => ':name × :many, voor de resterende :days dagen van deze periode',
    'credit_reason' => 'Verwijderd: :name',
    'bell_failed' => 'Een extra kon niet aan de server gegeven worden op bestelling :number',

    // ---- eenheden, voor de beheertabel ------------------------------------
    'unit_memory' => 'MiB geheugen',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB schijf',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databases',
    'unit_allocation_limit' => 'allocaties',
    'unit_backup_limit' => 'back-ups',
];
