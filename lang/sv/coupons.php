<?php

/*
 * Svenska. Skrivet för hand.
 *
 * Rabattkoder: koder som drar av något från den första fakturan.
 *
 * Bara från den första, med flit, och texten säger det där det spelar roll. En
 * kod som också gav rabatt på varje förnyelse vore en prisändring med ett
 * slutdatum, och den som vill det bör ändra priset.
 */

return [
    'title' => 'Rabattkoder',
    'nav_label' => 'Rabattkoder',
    'subheading' => 'Koder som drar av en procentsats eller ett belopp från den första fakturan. Förnyelser går till paketets pris.',

    // ---- tabellen --------------------------------------------------------
    'column_code' => 'Kod',
    'column_value' => 'Värde',
    'column_uses' => 'Använd',
    'column_expires' => 'Går ut',
    'column_packages' => 'Gäller för',
    'column_live' => 'Aktiv',

    'never_expires' => 'Inget slutdatum',
    'all_packages' => 'Allt',
    'some_packages' => ':count paket',
    'usable' => 'Går att använda just nu',
    'unusable' => 'Av, utgången eller slut',

    // ---- knapparna -------------------------------------------------------
    'new' => 'Ny rabattkod',
    'edit' => 'Redigera',
    'delete' => 'Ta bort',
    'delete_confirm' => 'Tar bort koden. Fakturor som redan använt den behåller sin rabatt - var och en sparar själv vad som drogs av.',
    'deleted' => 'Rabattkod borttagen',
    'saved' => 'Rabattkod sparad',
    'save_failed' => 'Rabattkoden kunde inte sparas',
    'taken' => 'Något annat använder redan den koden.',
    'invalid' => 'En procentsats är ett heltal från 1 till 100. Ett belopp skrivs som 12.50 eller 12,50.',

    // ---- formuläret ------------------------------------------------------
    'section_code' => 'Koden',
    'section_code_helper' => 'Det kunden skriver när hen beställer.',
    'code' => 'Kod',
    'code_helper' => 'Sparas och jämförs med versaler utan mellanslag, så att den fungerar hur någon än skriver den.',
    'live' => 'Aktiv',
    'live_helper' => 'Av gör att koden slutar fungera utan att tas bort: den går ur bruk medan rabatten den gav står kvar på de fakturor som hade den.',

    'section_worth' => 'Vad den drar av',
    'section_worth_helper' => 'Bara från den första fakturan. Den för aldrig en faktura under noll.',
    'kind' => 'Sort',
    'kind_helper' => 'En andel av priset, eller ett fast belopp.',
    'kind_percent' => 'Procent',
    'kind_fixed' => 'Fast belopp',
    'value' => 'Värde',
    'value_percent_helper' => 'Ett heltal från 1 till 100.',
    'value_fixed_helper' => 'I butikens valuta. Skriv det som 12.50 eller 12,50.',

    'section_limits' => 'Gränser',
    'section_limits_helper' => 'Allt här är frivilligt. En kod utan någon av dem gäller allt, för alla, för alltid.',
    'max_uses' => 'Hur många gånger den får användas',
    'max_uses_helper' => 'Räknas när beställningen läggs, inte när fakturan betalas - annars kunde en kod med tio användningar läggas hundra gånger på en natt.',
    'expires' => 'Går ut',
    'expires_helper' => 'Efter den tidpunkten fungerar koden inte längre. Tomt betyder att det aldrig händer.',
    'packages' => 'Paket',
    'packages_helper' => 'Inget ikryssat betyder varje paket, nu och senare.',

    'empty' => 'Inga rabattkoder än',
    'empty_body' => 'Gör en, så fungerar den vid beställning så fort den är aktiv.',
];
