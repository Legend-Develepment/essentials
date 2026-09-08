<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * De instellingen van de winkel, en later de winkel zelf.
 *
 * Twee lezers delen dit bestand met opzet. De instellingenhelft wordt gelezen
 * door de beheerder; de publieke en de klanthelft - die erbij komen naarmate
 * de winkel groeit - door mensen die misschien nog nooit van Pelican hebben
 * gehoord, en elke zin daar moet voor hen geschreven zijn.
 */

return [
    'title' => 'Winkelinstellingen',
    'nav_label' => 'Winkelinstellingen',
    'subheading' => 'De valuta, de btw, hoe facturen genummerd worden en wat de publieke pagina zegt. Wat te koop is staat op de pagina Pakketten.',

    // ---- waar hij is -----------------------------------------------------
    'address' => 'De publieke winkel staat op',
    'address_off' => 'De publieke pagina staat uit. Zet "Publieke winkelpagina" aan in de functielijst op de pagina Essentials-instellingen en hij antwoordt op :url.',

    // ---- algemeen --------------------------------------------------------
    'section_general' => 'Geld',
    'section_general_helper' => 'Eén valuta voor de hele winkel. Elke prijs op elk pakket is een getal daarin.',
    'currency' => 'Valuta',
    'currency_helper' => 'Wijzigen rekent niets om: de prijzen op de pakketten zijn getallen, en na een wijziging zijn het getallen in de nieuwe valuta.',
    'tax' => 'Btw',
    'tax_helper' => 'Een percentage dat als eigen regel bij elke factuur komt. Prijzen op de pakketten zijn exclusief. Nul voor geen.',
    'tax_suffix' => '%',
    'prefix' => 'Factuurnummers beginnen met',
    'prefix_helper' => 'Gevolgd door een oplopend nummer. INV- geeft INV-000001.',

    // ---- verlengingen ----------------------------------------------------
    'section_renewals' => 'Verlengingen',
    'section_renewals_helper' => 'Voor pakketten die per maand, kwartaal of jaar worden gefactureerd. Een eenmalig pakket wordt hier nooit door geraakt.',
    'notice_days' => 'Factureer dit aantal dagen voor het einde van de periode',
    'notice_days_helper' => 'Wanneer de volgende factuur wordt gemaakt en de klant erover wordt ingelicht.',
    'grace' => 'Schors dit aantal dagen nadat een factuur vervallen is',
    'grace_helper' => 'Een onbetaalde factuur die hier voorbij is schorst de server — Pelicans eigen schorsing, opgeheven zodra de factuur is betaald. De winkel verwijdert nooit iets.',
    'days' => 'dagen',

    // ---- de publieke pagina ----------------------------------------------
    'section_public' => 'De publieke pagina',
    'section_public_helper' => 'Gelezen door mensen zonder account. Of hij überhaupt wordt getoond, is de schakelaar "Publieke winkelpagina" in de functielijst.',
    'heading' => 'Kop',
    'heading_helper' => 'Leeg gelaten wordt de naam van het paneel zelf gebruikt.',
    'note' => 'Een regel boven de pakketten',
    'note_helper' => 'Om te zeggen wie je bent, of wat kopen iemand oplevert. Platte tekst.',
    'terms_url' => 'Voorwaarden',
    'terms_url_helper' => 'Een https-adres. Als het is ingesteld, betekent kopen een vinkje zetten dat ernaar verwijst.',

    // ---- handmatig betalen -----------------------------------------------
    'section_manual' => 'Betalen zonder provider',
    'section_manual_helper' => 'Getoond op een onbetaalde factuur zolang er geen betaalprovider aanstaat: bankgegevens, of waar het geld heen moet. Platte tekst.',
    'pay_note' => 'Hoe te betalen',
    'pay_note_helper' => 'Laat het leeg en een onbetaalde factuur zegt alleen dat hij onbetaald is.',

    // ---- de knoppen ------------------------------------------------------
    'save' => 'Opslaan',
    'saved' => 'Opgeslagen',
    'save_failed' => 'Er is niets opgeslagen',
];
