<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Bestellingen: wat iemand gekocht heeft en wat ervan geworden is.
 *
 * De vier toestanden hieronder gaan over het geld, niet over de server. Draait
 * de server op dit moment, dan is dat de vraag van Pelican zelf en die wordt op
 * Pelicans eigen pagina's beantwoord. De woorden hier houden die twee uit
 * elkaar.
 */

return [
    'title' => 'Bestellingen',
    'nav_label' => 'Bestellingen',
    'subheading' => 'Alles wat gekocht is, de server die eruit voortkwam en hoe het ervoor staat.',

    // ---- de tabel --------------------------------------------------------
    'column_order' => 'Bestelling',
    'column_customer' => 'Klant',
    'column_package' => 'Pakket',
    'column_server' => 'Server',
    'column_state' => 'Toestand',
    'column_due' => 'Volgende termijn',

    'no_server' => 'Nog niet gebouwd',
    'no_due' => 'Eenmalig',
    'gone_customer' => 'Account verwijderd',
    'gone_package' => 'Pakket verwijderd',
    'overdue_days' => ':days dagen over tijd',

    'state_pending' => 'Wacht',
    'state_active' => 'Actief',
    'state_suspended' => 'Stilgezet',
    'state_cancelled' => 'Geannuleerd',

    // ---- de knoppen ------------------------------------------------------
    'retry' => 'Opnieuw bouwen',
    'retry_confirm' => 'Zet het bouwen nog eens in de wachtrij. Verder verandert er niets en de factuur blijft betaald.',
    'retrying' => 'In de wachtrij gezet',

    'suspend' => 'Stilzetten',
    'suspend_confirm' => 'Zet de server stil met Pelicans eigen schorsing. Bestanden, databases en back-ups blijven waar ze zijn, en het betalen van de factuur heft het weer op.',
    'suspended' => 'Stilgezet',

    'unsuspend' => 'Weer aanzetten',
    'unsuspended' => 'Draait weer',

    'change_due' => 'Termijn wijzigen',
    'change_due_helper' => 'Wanneer de volgende factuur geschreven wordt. Leeg betekent nooit - de bestelling verlengt niet meer zonder geannuleerd te zijn.',

    'cancel' => 'Annuleren',
    'cancel_confirm' => 'Stopt de verlengingen en geeft de plek in de voorraad terug. De server blijft staan: die verwijder je in Pelican, waar dat hoort.',
    'cancelled' => 'Geannuleerd',

    'saved' => 'Opgeslagen',
    'refused' => 'Er is niets veranderd',
    'refused_body' => 'De bestelling staat niet in een toestand waarin dat kon. Ververs de pagina en kijk er nog eens naar.',

    // ---- wat de klant hoort ----------------------------------------------
    'bell_ready' => 'Je server staat klaar',
    'bell_ready_body' => ':server is aangemaakt en wacht tot jij hem start.',
    'bell_suspended' => 'Je server is stilgezet',
    'bell_suspended_body' => 'Een factuur bleef onbetaald tot voorbij de coulanceperiode. Betalen zet de server weer aan; er is niets verwijderd.',

    // ---- wat de beheerder hoort ------------------------------------------
    'bell_failed' => 'Bestelling :number kon niet gebouwd worden',
    'no_allocation' => 'Geen enkele node in dit pakket heeft nog een vrije allocation. Voeg er een toe en bouw opnieuw.',
    'no_reason' => 'Het paneel weigerde het zonder te zeggen waarom.',

    // ---- de server die eruit voortkomt -----------------------------------
    'server_description' => 'Gekocht via de winkel, bestelling :number.',
    'server_fallback' => 'Server',
    'state_ending' => 'Loopt af',
    'ends_on' => 'Loopt af op :date',
    'no_more_dues' => 'Wordt niet meer gefactureerd',
    'cancel_confirm_open' => 'Stopt de verlengingen nu en geeft de plek in de voorraad terug. De server blijft draaien: dit pakket heeft geen minimale looptijd, dus er is geen datum om naartoe te lopen. Verwijder de server in Pelican als de klant er klaar mee is.',
    'terminate' => 'Stoppen en verwijderen',
    'terminate_heading' => 'Deze server verwijderen?',
    'terminate_confirm' => 'De server wordt nu verwijderd, met zijn bestanden, zijn databases en zijn back-ups. Er is geen ongedaan maken en er wordt niet gewacht tot het contract afloopt. Annuleer in plaats daarvan als de klant hem tot de gegeven datum mag houden.',
    'terminate_go' => 'Verwijder hem',
    'terminated' => 'Verwijderd',
    'terminated_body' => 'De server is weg en de bestelling is gesloten.',
    'bell_ending' => 'Je :package loopt af op :date',
    'bell_ending_open' => 'Je :package is geannuleerd',
    'bell_ending_body' => 'Je krijgt er geen factuur meer voor. Alles op de server wordt verwijderd zodra hij stopt, dus maak een kopie van wat je wilt houden.',
    'bell_ended' => 'Je :package is afgelopen',
    'bell_ended_body' => 'Het contract is verlopen en de server is verwijderd.',
    'bell_undeleted' => 'Bestelling :number kon niet verwijderd worden',
    'bell_undeleted_body' => 'Het paneel weigerde de server te verwijderen. De bestelling is gesloten en er wordt niemand voor gefactureerd, maar de server staat er nog en moet in Pelican weggehaald worden.',
    'bell_undelivered' => 'Het bestand van bestelling :number staat er nog',
    'bell_undelivered_body' => 'De server is aangemaakt, maar het bestand dat de klant geüpload heeft kon er niet in gezet worden. Het staat nog in de opslag van het paneel, en de reden staat in storage/logs.',

    'empty' => 'Er is nog niets gekocht',
    'empty_body' => 'Bestellingen verschijnen hier zodra iemand een pakket koopt.',

    // ---- verlengingen ----------------------------------------------------
    'filter_late' => 'Achter met betalen',
    'run_renewals' => 'Verlengingen nu draaien',
    'run_renewals_confirm' => 'Doet wat de nachtelijke ronde doet: schrijft de volgende factuur voor alles wat binnenkort vervalt, en zet de servers stil achter een rekening die voorbij de coulanceperiode onbetaald bleef.',
    'renewals_queued' => 'In de wachtrij gezet',
    'renewals_queued_body' => 'Het draait op de wachtrij. Ververs zo meteen om te zien wat er veranderd is.',
];
