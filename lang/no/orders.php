<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Bestillinger: hva noen har kjøpt, og hva det ble til.
 *
 * De fire tilstandene nedenfor handler om pengene, ikke om serveren. Om
 * serveren kjører akkurat nå er Pelicans eget spørsmål og blir besvart på
 * Pelicans egne sider. Ordene her holder de to tingene fra hverandre.
 */

return [
    'title' => 'Bestillinger',
    'nav_label' => 'Bestillinger',
    'subheading' => 'Alt som er kjøpt, serveren det ble til, og hvordan det står til.',

    // ---- tabellen --------------------------------------------------------
    'column_order' => 'Bestilling',
    'column_customer' => 'Kunde',
    'column_package' => 'Pakke',
    'column_server' => 'Server',
    'column_state' => 'Tilstand',
    'column_due' => 'Neste forfall',

    'no_server' => 'Ikke bygget ennå',
    'no_due' => 'Engangsbetaling',
    'gone_customer' => 'Konto slettet',
    'gone_package' => 'Pakke slettet',
    'overdue_days' => ':days dager på overtid',

    'state_pending' => 'Venter',
    'state_active' => 'Aktiv',
    'state_suspended' => 'Suspendert',
    'state_cancelled' => 'Avbestilt',

    // ---- knappene --------------------------------------------------------
    'retry' => 'Bygg på nytt',
    'retry_confirm' => 'Setter byggingen i kø én gang til. Ingenting annet endres, og fakturaen forblir betalt.',
    'retrying' => 'Satt i kø',

    'suspend' => 'Suspender',
    'suspend_confirm' => 'Stopper serveren med Pelicans egen suspendering. Filer, databaser og sikkerhetskopier blir der de er, og betaling av fakturaen løfter den igjen.',
    'suspended' => 'Suspendert',

    'unsuspend' => 'Opphev suspenderingen',
    'unsuspended' => 'Kjører igjen',

    'change_due' => 'Endre forfallsdatoen',
    'change_due_helper' => 'Når neste faktura blir skrevet. Tomt betyr aldri - bestillingen slutter å fornye seg uten å være avbestilt.',

    'cancel' => 'Avbestill',
    'cancel_confirm' => 'Stopper fornyelsene og gir plassen i beholdningen tilbake. Serveren blir stående: den slettes i Pelican, der det hører hjemme.',
    'cancelled' => 'Avbestilt',

    'saved' => 'Lagret',
    'refused' => 'Ingenting endret seg',
    'refused_body' => 'Bestillingen er ikke i en tilstand der det lot seg gjøre. Last siden på nytt og se på den en gang til.',

    // ---- hva kunden hører ------------------------------------------------
    'bell_ready' => 'Serveren din er klar',
    'bell_ready_body' => ':server er opprettet og venter på at du starter den.',
    'bell_suspended' => 'Serveren din er suspendert',
    'bell_suspended_body' => 'En faktura ble stående ubetalt forbi fristen. Betaler du den, starter serveren igjen; ingenting er slettet.',

    // ---- hva administratoren hører ---------------------------------------
    'bell_failed' => 'Bestilling :number kunne ikke bygges',
    'no_allocation' => 'Ingen node i denne pakken har en ledig allocation. Legg til en, og bygg på nytt.',
    'no_reason' => 'Panelet avviste det uten å si hvorfor.',

    // ---- serveren det blir til -------------------------------------------
    'server_description' => 'Kjøpt i butikken, bestilling :number.',
    'server_fallback' => 'Server',
    'state_ending' => 'Avsluttes',
    'ends_on' => 'Avsluttes :date',
    'no_more_dues' => 'Faktureres ikke igjen',
    'cancel_confirm_open' => 'Stopper fornyelsene nå og gir plassen i beholdningen tilbake. Serveren blir stående og kjøre: denne pakken har ingen bindingstid, så det finnes ingen dato å løpe fram til. Slett serveren i Pelican når kunden er ferdig med den.',
    'terminate' => 'Stopp og slett',
    'terminate_heading' => 'Slette denne serveren?',
    'terminate_confirm' => 'Serveren slettes nå, med filene sine, databasene sine og sikkerhetskopiene sine. Det finnes ingen angring og ingen venting på at kontrakten løper ut. Avbestill i stedet hvis kunden skal beholde den til datoen han har fått.',
    'terminate_go' => 'Slett den',
    'terminated' => 'Slettet',
    'terminated_body' => 'Serveren er borte og bestillingen er lukket.',
    'bell_ending' => 'Din :package avsluttes :date',
    'bell_ending_open' => 'Din :package er avbestilt',
    'bell_ending_body' => 'Du blir ikke fakturert for den igjen. Alt på serveren slettes når den stopper, så kopier ut det du vil beholde.',
    'bell_ended' => 'Din :package er avsluttet',
    'bell_ended_body' => 'Kontrakten løp ut, og serveren er slettet.',
    'bell_undeleted' => 'Bestilling :number kunne ikke slettes',
    'bell_undeleted_body' => 'Panelet nektet å slette serveren. Bestillingen er lukket og ingen blir fakturert for den, men serveren står der fortsatt og må fjernes i Pelican.',
    'bell_undelivered' => 'Filen til bestilling :number ligger fortsatt her',
    'bell_undelivered_body' => 'Serveren ble opprettet, men filen kunden lastet opp kunne ikke legges inn i den. Den ligger fortsatt lagret i panelet, og grunnen står i storage/logs.',

    'empty' => 'Ingenting er kjøpt ennå',
    'empty_body' => 'Bestillinger dukker opp her så snart noen kjøper en pakke.',

    // ---- fornyelser ------------------------------------------------------
    'filter_late' => 'På etterskudd med en regning',
    'run_renewals' => 'Kjør fornyelser nå',
    'run_renewals_confirm' => 'Gjør det den nattlige runden gjør: skriver neste faktura for alt som snart forfaller, og stopper serverne bak en regning som har blitt stående ubetalt forbi fristen.',
    'renewals_queued' => 'Satt i kø',
    'renewals_queued_body' => 'Den kjører i køen. Last siden på nytt om litt for å se hva som er endret.',
];
