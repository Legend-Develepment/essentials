<?php

/*
 * Tegoed, terugbetalingen en creditnota’s.
 *
 * Twee woorden worden hieronder overal uit elkaar gehouden.
 *
 * "Tegoed" is geld dat de winkel voor iemand vasthoudt. Het gaat vanzelf van
 * hun volgende factuur af, voordat er ook maar om betaling wordt gevraagd.
 *
 * Een "terugbetaling" is het teruggeven zelf, en dat kan twee kanten op: terug
 * naar de kaart waar het vandaan kwam, of als tegoed op de rekening. De tekst
 * zegt altijd welke van de twee, want een klant die leest dat er is
 * terugbetaald en dan niets op zijn rekening ziet, schrijft terecht.
 *
 * Een "creditnota" is het document. Dat wordt in beide gevallen geschreven,
 * want het legt vast dat het geld niet langer aan de winkel toekomt - het zegt
 * niets over waar het heen ging.
 */

return [
    // ---- wat een klant ziet ----------------------------------------------
    'yours' => 'Jouw tegoed',
    'yours_body' => 'Dit gaat automatisch van je volgende factuur af. Je hoeft er zelf niets mee te doen.',
    'applied' => 'Betaald uit je tegoed',
    'payable' => 'Nog te betalen',

    // ---- het grootboek, in het klantvenster ------------------------------
    'held' => 'Tegoed',
    'none_held' => 'Niets op de rekening',
    'movements' => 'Tegoed',
    'column' => 'Tegoed',
    'none' => 'Geen',

    // ---- tegoed geven ----------------------------------------------------
    'give' => 'Tegoed',
    'give_helper' => 'Op deze rekening staat :held. Wat je erbij zet gaat vanzelf van hun volgende factuur af. Een negatief bedrag haalt tegoed er weer af, en beide bewegingen blijven in de geschiedenis staan.',
    'amount' => 'Bedrag',
    'amount_helper' => 'Een negatief bedrag haalt tegoed weg in plaats van dat het geeft.',
    'reason' => 'Reden',
    'reason_helper' => 'De klant ziet dit naast het bedrag, dus schrijf het voor hem en niet voor het dossier.',
    'given' => ':amount tegoed voor :who',
    'bad_amount' => 'Dat is geen bedrag.',
    'give_failed' => 'Het tegoed is niet gegeven',
    'give_failed_body' => 'Er is niets weggeschreven. Probeer het opnieuw, en kijk in het log als het blijft gebeuren.',
    'take_failed' => 'Het tegoed is er niet afgehaald',
    'take_failed_body' => 'Er staat minder op de rekening dan je eraf wilde halen. Een saldo gaat nooit onder nul.',

    // ---- wat een beweging zegt ------------------------------------------
    'spent_on' => 'Factuur :number',
    'returned' => 'Teruggezet: de factuur waar het voor was kon niet worden geschreven',
    'note_line' => 'Creditnota bij factuur :number',
    'refund_description' => 'Terugbetaling van factuur :number',

    // ---- teruggeven ------------------------------------------------------
    'refund' => 'Terugbetalen',
    'refund_helper' => 'Van deze factuur is :left nog niet teruggegeven. Er wordt hoe dan ook een creditnota geschreven, zodat het aan beide kanten vastligt.',
    'refund_amount_helper' => 'Een deel mag ook. Wat overblijft kun je later alsnog teruggeven.',
    'refund_reason_helper' => 'Dit komt op de creditnota te staan die de klant kan openen.',
    'where' => 'Waar gaat het geld heen',
    'where_provider' => 'Terug naar hoe ze betaalden',
    'where_provider_helper' => 'De provider stuurt het naar de kaart of rekening waar het vandaan kwam. Het kan een paar dagen duren voordat het zichtbaar is, en ze kunnen weigeren - bij een oude betaling, of een methode die niet terugdraait.',
    'where_balance' => 'Als tegoed op hun rekening hier',
    'where_balance_helper' => 'Het wordt tegoed en gaat van hun volgende factuur af. Er verlaat niets de bank, en het kan niet mislukken.',
    'refunded' => ':amount terugbetaald',
    'refunded_body' => 'Creditnota :number is ervoor geschreven.',
    'refund_failed' => 'Er is niets terugbetaald',

    // ---- en waarom niet, één reden per zin -------------------------------
    'refused_off' => 'Tegoed en terugbetalingen staan uit voor dit panel.',
    'refused_amount' => 'Dat is meer dan er van deze factuur over is.',
    'refused_no_payment' => 'Geen enkele betaling op deze factuur heeft nog zoveel over, dus er is niets voor een provider om terug te draaien. Zet het in plaats daarvan op hun rekening.',
    'refused_no_gateway' => 'De provider waarmee dit betaald is staat niet meer aan, dus er valt niets terug te draaien. Zet het in plaats daarvan op hun rekening.',
    'refused_refused' => 'De provider weigerde. Meestal is dat een oude betaling of een methode die niet terugdraait; de reden die ze gaven staat in het log. Zet het in plaats daarvan op hun rekening.',
    'refused_note_failed' => 'Het geld is verplaatst maar de creditnota kon niet worden geschreven, dus er is niets vastgelegd. Kijk in het log voordat je het opnieuw probeert.',

    // ---- geld erop zetten -------------------------------------------------
    'topup' => 'Tegoed opwaarderen',
    'topup_helper' => 'Je hebt :held op je rekening staan. Wat je hier bijzet gaat vanzelf van je volgende factuur af, en een factuur die al openstaat wordt er meteen mee voldaan zodra het binnen is.',
    'topup_go' => 'Door naar betalen',
    'topup_amount_helper' => 'Tussen :least en :most.',
    'topup_bad' => 'Dat bedrag kan niet betaald worden',
    'topup_failed' => 'De betaling kon niet gestart worden. Probeer het opnieuw, en meld het bij wie dit panel beheert als het blijft gebeuren.',
    'topup_line' => 'Tegoed op de rekening gezet',
    'topup_reason' => 'Bijgezet op factuur :number',

    // ---- waar het te zien is ----------------------------------------------
    'menu' => ':amount tegoed',
    'held_helper' => 'Gaat vanzelf van je volgende factuur af. Opwaarderen kan op de facturenpagina.',
];
