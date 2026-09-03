<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * "Allocation" heet in Pelican zelf zo en blijft dus staan waar het over het
 * paneelbegrip gaat; waar het Engels "free addresses" zegt gaat het over de
 * poorten zelf, en dan staat er "vrije adressen".
 */

return [
    'title' => 'Server dupliceren',
    'nav_label' => 'Server dupliceren',
    'subheading' => 'Nog een server, precies ingericht als eentje die je al hebt — of meerdere tegelijk.',

    'section' => 'Wat er wordt gekopieerd',
    'section_helper' => 'De eigenaar, de egg, het startcommando, de limieten en alle variabelen worden gekopieerd. Bestanden, databases, back-ups en schema\'s niet — een kopie van de bestanden van een draaiende server is een kopie van zijn toestand, en dat is zelden wat "nog eentje zoals deze" betekent.',

    'source' => 'Kopiëren van',
    'source_helper' => 'De kopieën komen op dezelfde node als deze server, want daar staan zijn vrije adressen.',

    'name' => 'Naam voor de kopie',
    'name_helper' => 'Bij meer dan één worden ze genummerd: “Bot 1”, “Bot 2”, enzovoort.',

    'copies' => 'Hoeveel',
    'copies_helper' => 'Kies eerst een server.',

    'room' => ':count vrije adressen op :node, dus dat is het maximum dat er nu gemaakt kan worden.',
    'no_room' => 'Er is geen vrij adres meer op :node. Een kopie heeft er zelf een nodig, dus voeg eerst een allocation toe aan die node.',

    'made' => ':count kopieën gemaakt',
    'partly_failed' => ':count kopieën konden niet worden gemaakt',
    'failed' => 'Er is niets gekopieerd',
];
