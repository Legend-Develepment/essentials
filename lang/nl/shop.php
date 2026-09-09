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
    'grace_helper' => 'Een onbetaalde factuur die hier voorbij is schorst de server — Pelicans eigen schorsing, opgeheven zodra de factuur is betaald. Het schorsen zelf verwijdert niets.',
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
    'to_account' => 'Mijn account',
    'filter_all' => 'Alles',
    'filter_label' => 'Toon',
    'includes' => 'Inbegrepen',
    'public_count' => ':count te koop',

    // ---- het afrekenen ---------------------------------------------------
    'checkout_title' => 'Afrekenen',
    'tax_line' => 'Btw (:rate%)',
    'coupon' => 'Kortingscode',
    'asks' => 'Over je server',
    'upload_default' => 'Je bestand',
    'upload_help' => 'Een zipbestand. Het gaat in je server zodra die wordt aangemaakt.',
    'upload_busy' => 'Bezig met uploaden…',
    'what_is_this' => 'Wat is dit?',
    'refused_no_file' => 'Dit pakket heeft een bestand nodig, en er is er geen gekozen.',
    'refused_not_zip' => 'Dat moet een zipbestand zijn.',
    'refused_too_big' => 'Dat bestand is te groot voor dit paneel.',
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
    'order_ending' => 'Loopt af op :date. Er wordt niet meer gefactureerd, en alles wat erop staat wordt die dag verwijderd.',
    'order_ending_open' => 'Geannuleerd. Er wordt niet meer gefactureerd en hij blijft draaien tot hij weggehaald wordt.',

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

    'gateway_stripe' => 'Kaart',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Neemt kaarten aan via een pagina die Stripe zelf tekent, zodat er nooit een kaartnummer bij dit paneel komt. Test en live zitten in het voorvoegsel van de sleutel, niet in een schakelaar.',
    'stripe_on' => 'Stripe aanbieden',
    'stripe_on_helper' => 'Uit laat de knop van elke factuur weg. Wat al betaald is blijft betaald.',
    'stripe_key' => 'Geheime sleutel',
    'stripe_key_helper' => 'Die met sk_ ervoor, uit Developers, API keys. Wordt nooit in een geëxporteerd instellingenbestand geschreven.',
    'stripe_hook' => 'Ondertekeningsgeheim',
    'stripe_hook_key_helper' => 'De whsec_-waarde die Stripe toont wanneer je het adres hieronder toevoegt. Zonder dat kunnen hun berichten niet als echt bewezen worden en worden ze genegeerd.',
    'stripe_hook_helper' => 'Voeg :url toe als endpoint onder Developers, webhooks, voor de gebeurtenis checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'De enige aanbieder waarbij het geld pas beweegt als de klant terugkomt in plaats van terwijl die nog bij PayPal is, zodat een gesloten tabblad een onbetaalde factuur oplevert en geen zoekgeraakte betaling.',
    'paypal_on' => 'PayPal aanbieden',
    'paypal_on_helper' => 'Uit laat de knop van elke factuur weg. Wat al betaald is blijft betaald.',
    'paypal_sandbox' => 'Sandbox',
    'paypal_sandbox_helper' => 'Praat met het testaccount van PayPal in plaats van met het echte. Hun client-ids zien er in beide gevallen hetzelfde uit, en daarom bestaat deze schakelaar.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Uit de app die je onder Apps & Credentials hebt gemaakt. Let erop dat het tabblad overeenkomt met de schakelaar hierboven.',
    'paypal_secret_helper' => 'Naast de client-id, achter Show. Wordt nooit in een geëxporteerd instellingenbestand geschreven.',
    'paypal_hook' => 'Webhook-ID',
    'paypal_hook_id_helper' => 'De ID die PayPal aan de webhook geeft nadat je hem toevoegt - niet het adres. Zonder die ID kunnen hun berichten niet bij hen nagevraagd worden en worden ze genegeerd.',
    'paypal_hook_helper' => 'Voeg :url toe als webhook op die app, voor PAYMENT.CAPTURE.COMPLETED, en plak de ID die je krijgt hier.',

    // ---- de betaalpagina -------------------------------------------------
    'pay_title' => 'Betalen',
    'pay_subheading' => 'Wat je openstaan hebt, en de manieren om het te voldoen.',
    'pay_choose' => 'Hoe wil je betalen?',
    'pay_choose_body' => 'Wat je ook kiest, je rondt het af op hun eigen pagina en komt daarna meteen hier terug.',
    'pay_safe' => 'Je wordt naar de aanbieder gestuurd om te betalen. Je kaartgegevens komen nooit bij dit paneel.',
    'pay_no_ways' => 'Zodra het geld binnen is wordt de factuur op betaald gezet en wordt je server klaargemaakt.',
    'free' => 'Niets te betalen',
    'free_body' => 'Een kortingscode heeft deze factuur helemaal gedekt, dus er valt niets te betalen. Druk op de knop en het is klaar.',
    'free_go' => 'Afronden',
    'free_done' => 'Voldaan',
    'free_done_body' => 'Er viel niets te betalen, dus hij is gesloten. Je server wordt nu klaargemaakt.',
    'pay_gone' => 'Die factuur bestaat niet',
    'pay_gone_body' => 'Misschien is hij ingetrokken, of klopt het adres niet.',
    'pay_already' => 'Deze is al betaald',
    'pay_already_body' => 'Verder niets te doen. Alles wat erop wachtte is al onderweg.',
    'pay_withdrawn' => 'Deze is ingetrokken',
    'pay_withdrawn_body' => 'Hij staat niet meer in de boeken en hoeft niet betaald te worden. Vraag het aan wie dit paneel beheert als dat vreemd lijkt.',
    'back_to_billing' => 'Terug naar facturen',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kaart en meer',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Je PayPal-saldo, of een kaart via PayPal',

    // ---- diensten en facturen, uit elkaar --------------------------------
    'services_title' => 'Mijn diensten',
    'services_nav_label' => 'Mijn diensten',
    'services_subheading' => 'Waar je voor betaalt, en de server die er bij elke dienst uit voortkwam.',
    'open_server' => 'Server openen',
    'no_server_yet' => 'Wordt klaargemaakt',

    'invoices_title' => 'Facturen',
    'invoices_subheading' => 'Wat je in rekening is gebracht, en wat er nog te betalen staat.',
    'no_invoices_body' => 'Alles wat je koopt wordt hier gefactureerd, en blijft hier staan nadat het betaald is.',

    // ---- de winkel als landingspagina ------------------------------------
    'section_landing' => 'Waar de winkel staat',
    'section_landing_helper' => 'Of de winkel de voordeur van het paneel is, voor klanten en voor mensen die niet ingelogd zijn.',
    'landing' => 'Open eerst de winkel',
    'landing_helper' => 'Aan is de winkel de eerste pagina na het inloggen en schuift de serverlijst ernaast. Je diensten en je facturen blijven één klik weg, in de kop van de winkel en in het accountmenu. Wie niet ingelogd is, krijgt de publieke winkel in plaats van het inlogformulier, en wordt pas gevraagd om in te loggen zodra er een pakket gekozen wordt - daarvoor moet de publieke winkelpagina ook aanstaan. Uit opent het paneel op de serverlijst zoals Pelican die tekent, krijgt wie niet ingelogd is het inlogformulier, en is de winkel een pagina als elke andere.',
];
