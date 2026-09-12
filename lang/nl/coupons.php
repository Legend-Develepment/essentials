<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Kortingscodes: codes die iets van de eerste factuur afhalen.
 *
 * Alleen van de eerste, met opzet, en de tekst zegt dat waar het uitmaakt. Een
 * code die ook elke verlenging korting gaf, zou een prijswijziging met een
 * einddatum zijn, en wie dat wil hoort de prijs te wijzigen.
 */

return [
    'title' => 'Kortingscodes',
    'nav_label' => 'Kortingscodes',
    'subheading' => 'Codes die een percentage of een bedrag van de eerste factuur afhalen. Verlengingen gaan tegen de pakketprijs.',

    // ---- de tabel --------------------------------------------------------
    'column_code' => 'Code',
    'column_value' => 'Waarde',
    'column_uses' => 'Gebruikt',
    'column_expires' => 'Verloopt',
    'column_packages' => 'Geldt voor',
    'column_live' => 'Actief',

    'never_expires' => 'Geen einddatum',
    'all_packages' => 'Alles',
    'some_packages' => ':count pakketten',
    'usable' => 'Kan nu gebruikt worden',
    'unusable' => 'Uit, verlopen of opgebruikt',

    // ---- de knoppen ------------------------------------------------------
    'new' => 'Nieuwe code',
    'edit' => 'Bewerken',
    'delete' => 'Verwijderen',
    'delete_confirm' => 'Haalt de code weg. Facturen die hem al gebruikt hebben houden hun korting - elke factuur bewaart zelf wat eraf ging.',
    'deleted' => 'Code verwijderd',
    'saved' => 'Code opgeslagen',
    'save_failed' => 'De code kon niet opgeslagen worden',
    'taken' => 'Iets anders gebruikt die code al.',
    'invalid' => 'Een percentage is een heel getal van 1 tot 100. Een bedrag schrijf je als 12.50 of 12,50.',

    // ---- het formulier ---------------------------------------------------
    'section_code' => 'De code',
    'section_code_helper' => 'Wat een klant bij het afrekenen intypt.',
    'code' => 'Code',
    'code_helper' => 'Wordt in hoofdletters zonder spaties bewaard en vergeleken, zodat hij werkt hoe iemand hem ook typt.',
    'live' => 'Actief',
    'live_helper' => 'Uit laat de code niet meer werken zonder hem te verwijderen, zodat hij buiten gebruik raakt terwijl de korting die hij gaf op de facturen blijft staan.',

    'section_worth' => 'Wat hij eraf haalt',
    'section_worth_helper' => 'Alleen van de eerste factuur. Hij brengt een factuur nooit onder nul.',
    'kind' => 'Soort',
    'kind_helper' => 'Een deel van de prijs, of een vast bedrag.',
    'kind_percent' => 'Percentage',
    'kind_fixed' => 'Vast bedrag',
    'value' => 'Waarde',
    'value_percent_helper' => 'Een heel getal van 1 tot 100.',
    'value_fixed_helper' => 'In de valuta van de winkel. Schrijf het als 12.50 of 12,50.',

    'section_limits' => 'Grenzen',
    'section_limits_helper' => 'Alles hier is optioneel. Een code zonder een van deze werkt voor alles, voor iedereen, voor altijd.',
    'max_uses' => 'Aantal keer te gebruiken',
    'max_uses_helper' => 'Wordt geteld bij het plaatsen van de bestelling, niet bij het betalen van de factuur - anders kon een code met tien keer er honderd keer in een nacht ingezet worden.',
    'expires' => 'Verloopt',
    'expires_helper' => 'Na dit moment werkt de code niet meer. Leeg betekent dat dat nooit gebeurt.',
    'packages' => 'Pakketten',
    'packages_helper' => 'Niets aangevinkt betekent elk pakket, nu en later.',

    'empty' => 'Nog geen kortingscodes',
    'empty_body' => 'Maak er een en hij werkt bij het afrekenen zodra hij actief staat.',
];
