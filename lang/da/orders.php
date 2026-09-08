<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Ordrer: hvad nogen har købt, og hvad der blev af det.
 *
 * De fire tilstande nedenfor handler om pengene, ikke om serveren. Om serveren
 * kører lige nu er Pelicans eget spørgsmål og bliver besvaret på Pelicans egne
 * sider. Ordene her holder de to ting adskilt.
 */

return [
    'title' => 'Ordrer',
    'nav_label' => 'Ordrer',
    'subheading' => 'Alt hvad der er købt, serveren det blev til, og hvordan det står til.',

    // ---- tabellen --------------------------------------------------------
    'column_order' => 'Ordre',
    'column_customer' => 'Kunde',
    'column_package' => 'Pakke',
    'column_server' => 'Server',
    'column_state' => 'Tilstand',
    'column_due' => 'Næste forfald',

    'no_server' => 'Ikke bygget endnu',
    'no_due' => 'Engangsbetaling',
    'gone_customer' => 'Konto slettet',
    'gone_package' => 'Pakke slettet',
    'overdue_days' => ':days dage over tiden',

    'state_pending' => 'Venter',
    'state_active' => 'Aktiv',
    'state_suspended' => 'Suspenderet',
    'state_cancelled' => 'Annulleret',

    // ---- knapperne -------------------------------------------------------
    'retry' => 'Byg igen',
    'retry_confirm' => 'Sætter bygningen i kø én gang til. Intet andet ændrer sig, og fakturaen bliver ved med at være betalt.',
    'retrying' => 'Sat i kø',

    'suspend' => 'Suspendér',
    'suspend_confirm' => 'Standser serveren med Pelicans egen suspendering. Filer, databaser og sikkerhedskopier bliver, hvor de er, og betaling af fakturaen løfter den igen.',
    'suspended' => 'Suspenderet',

    'unsuspend' => 'Ophæv suspenderingen',
    'unsuspended' => 'Kører igen',

    'change_due' => 'Ret forfaldsdatoen',
    'change_due_helper' => 'Hvornår den næste faktura skrives. Tom betyder aldrig - ordren holder op med at forny sig uden at være annulleret.',

    'cancel' => 'Annullér',
    'cancel_confirm' => 'Stopper fornyelserne og giver pladsen i lageret tilbage. Serveren står som den står: den slettes i Pelican, hvor det hører hjemme.',
    'cancelled' => 'Annulleret',

    'saved' => 'Gemt',
    'refused' => 'Der skete ingenting',
    'refused_body' => 'Ordren er ikke i en tilstand, hvor det kunne lade sig gøre. Hent siden igen og se på den en gang til.',

    // ---- hvad kunden hører -----------------------------------------------
    'bell_ready' => 'Din server er klar',
    'bell_ready_body' => ':server er oprettet og venter på, at du starter den.',
    'bell_suspended' => 'Din server er suspenderet',
    'bell_suspended_body' => 'En faktura forblev ubetalt ud over henstandsfristen. Betaler du den, starter serveren igen; der er ikke slettet noget.',

    // ---- hvad administratoren hører --------------------------------------
    'bell_failed' => 'Ordre :number kunne ikke bygges',
    'no_allocation' => 'Ingen node i denne pakke har en ledig allocation. Læg en til, og byg igen.',
    'no_reason' => 'Panelet afviste det uden at sige hvorfor.',

    // ---- serveren det bliver til -----------------------------------------
    'server_description' => 'Købt i butikken, ordre :number.',
    'server_fallback' => 'Server',
    'state_ending' => 'Ophører',
    'ends_on' => 'Ophører :date',
    'no_more_dues' => 'Faktureres ikke igen',
    'cancel_confirm_open' => 'Stopper fornyelserne nu og giver pladsen i lageret tilbage. Serveren bliver ved med at køre: denne pakke har ingen bindingsperiode, så der er ingen dato at køre frem til. Slet serveren i Pelican, når kunden er færdig med den.',
    'terminate' => 'Stop og slet',
    'terminate_heading' => 'Slet denne server?',
    'terminate_confirm' => 'Serveren slettes nu, med sine filer, sine databaser og sine sikkerhedskopier. Der er ingen fortrydelse og ingen venten på, at aftalen løber ud. Annullér i stedet, hvis kunden skal beholde den indtil den dato, kunden har fået.',
    'terminate_go' => 'Slet den',
    'terminated' => 'Slettet',
    'terminated_body' => 'Serveren er væk, og ordren er lukket.',
    'bell_ending' => 'Din :package ophører :date',
    'bell_ending_open' => 'Din :package er annulleret',
    'bell_ending_body' => 'Du bliver ikke faktureret for den igen. Alt på serveren slettes, når den stopper, så kopier det, du vil beholde.',
    'bell_ended' => 'Din :package er ophørt',
    'bell_ended_body' => 'Aftalen løb ud, og serveren er slettet.',
    'bell_undeleted' => 'Ordre :number kunne ikke slettes',
    'bell_undeleted_body' => 'Panelet afviste at slette serveren. Ordren er lukket, og ingen bliver faktureret for den, men serveren står der stadig og skal fjernes i Pelican.',
    'bell_undelivered' => 'Filen til ordre :number ligger her endnu',
    'bell_undelivered_body' => 'Serveren blev bygget, men kundens fil kunne ikke lægges ind i den. Den ligger stadig hos panelet, og grunden står i storage/logs.',

    'empty' => 'Der er ikke købt noget endnu',
    'empty_body' => 'Ordrer dukker op her, så snart nogen køber en pakke.',

    // ---- fornyelser ------------------------------------------------------
    'filter_late' => 'Bagud med en regning',
    'run_renewals' => 'Kør fornyelser nu',
    'run_renewals_confirm' => 'Gør det, den natlige runde gør: skriver næste faktura for alt, der snart forfalder, og standser de servere, der står bag en regning, som er forblevet ubetalt ud over henstandsfristen.',
    'renewals_queued' => 'Sat i kø',
    'renewals_queued_body' => 'Den kører i køen. Hent siden igen om lidt for at se, hvad der er ændret.',
];
