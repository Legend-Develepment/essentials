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

    /* ---------------------------------------------------------------------
     * De winkel zelf, vanaf hier naar beneden.
     *
     * Een heel andere lezer: iemand die een server koopt, die misschien nog
     * nooit van Pelican gehoord heeft en niet weet wat een egg is. Niets
     * hieronder gebruikt de woorden van het paneel, en elke zin beantwoordt de
     * vraag die een klant op dat punt van de pagina echt heeft.
     * ------------------------------------------------------------------- */

    // ---- de winkel -------------------------------------------------------
    'store_title' => 'Winkel',
    'store_nav_label' => 'Winkel',
    'store_subheading' => 'Kies een server. Hij wordt voor je aangemaakt zodra de factuur betaald is.',
    'store_empty' => 'Er is op dit moment niets te koop',
    'store_empty_body' => 'Kom later terug, of vraag het aan wie dit paneel beheert.',

    'buy' => 'Kopen',
    'sold_out' => 'Uitverkocht',
    'plus_setup' => 'plus eenmalig :amount',

    'spec_memory' => ':amount MiB geheugen',
    'spec_disk' => ':amount MiB schijf',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count back-ups',
    'spec_databases' => ':count databases',

    // ---- de publieke pagina ----------------------------------------------
    'public_empty' => 'Er is op dit moment niets te koop',
    'public_empty_body' => 'Kom later terug.',
    'to_panel' => 'Inloggen',
    'terms' => 'Voorwaarden',
    'sign_in_note' => 'Kies hieronder een server. Je logt in om af te ronden, en hij wordt aangemaakt zodra de factuur betaald is.',

    // ---- het afrekenen ---------------------------------------------------
    'checkout_title' => 'Afrekenen',
    'tax_line' => 'Btw (:rate%)',
    'coupon' => 'Kortingscode',
    'coupon_placeholder' => 'Als je er een hebt',
    'coupon_bad' => 'Die code werkt hier niet.',
    'coupon_good' => 'Code toegepast.',
    'agree' => 'Ik ga akkoord met de',
    'place_order' => 'Bestelling plaatsen',
    'place_order_note' => 'Hiermee wordt een factuur geschreven. Er wordt niets afgeschreven tot je betaalt, en de server wordt aangemaakt zodra dat gebeurd is.',
    'back_to_store' => 'Terug naar de winkel',

    'placed' => 'Bestelling geplaatst',
    'placed_body' => 'Factuur :number staat klaar op je facturenpagina.',

    'refused' => 'Dat kon niet gekocht worden',
    'refused_gone' => 'Het is niet meer te koop.',
    'refused_sold_out' => 'De laatste is weg.',
    'refused_bad_coupon' => 'De kortingscode geldt hier niet voor.',
    'refused_failed' => 'Er ging iets mis bij het schrijven van de bestelling. Er is niets afgeschreven. Probeer het opnieuw en zeg het tegen wie dit paneel beheert als het blijft gebeuren.',

    // ---- facturen --------------------------------------------------------
    'billing_title' => 'Facturen',
    'billing_nav_label' => 'Facturen',
    'billing_subheading' => 'Wat je gekocht hebt en wat er openstaat.',
    'your_orders' => 'Je bestellingen',
    'your_invoices' => 'Je facturen',
    'no_orders' => 'Je hebt nog niets gekocht',
    'no_orders_body' => 'Alles wat je koopt komt hier te staan, met de server en de data erbij.',
    'no_invoices' => 'Nog geen facturen',
    'to_store' => 'Naar de winkel',
    'renews' => 'Verlengt',
    'ask_how_to_pay' => 'Vraag aan wie dit paneel beheert hoe je kunt betalen. Ze hebben het hier nog niet opgeschreven.',
    'order_pending' => 'Wacht tot de factuur betaald is. Meteen daarna wordt de server aangemaakt.',
    'order_suspended' => 'Stilgezet vanwege een onbetaalde factuur. Betalen zet de server weer aan - er is niets verwijderd.',

    // ---- betalen ---------------------------------------------------------
    'pay_with' => 'Betaal met',
    'pay_now' => 'Betalen',
    'pay_description' => 'Factuur :number',
    'pay_thanks' => 'Dank je. De factuur is betaald.',
    'pay_pending' => 'De aanbieder heeft het nog niet bevestigd. Deze pagina wordt bijgewerkt zodra dat gebeurt.',
    'pay_refused' => 'Dat is niet gestart',
    'pay_refused_body' => 'De betaling kon niet geopend worden. Probeer een andere manier, of vraag het aan wie dit paneel beheert.',
    'gateway_mollie' => 'Mollie',

    // ---- de instellingen van de aanbieder --------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Neemt iDEAL, kaarten, Bancontact en de rest aan via één account. Test en live zijn dezelfde instelling: de sleutel zelf zegt bij welk account hij hoort.',
    'mollie_on' => 'Mollie aanbieden',
    'mollie_on_helper' => 'Uit laat de knop van elke factuur weg. Wat al betaald is blijft betaald.',
    'mollie_key' => 'API-sleutel',
    'mollie_key_helper' => 'Uit het onderdeel Developers van je Mollie-dashboard. Hij wordt nooit in een geëxporteerd instellingenbestand geschreven.',
    'mollie_hook' => 'Webhook-adres',
    'mollie_hook_helper' => 'Mollie meldt zich bij :url - dat adres moet je paneel vanaf het internet kunnen bereiken.',
];
