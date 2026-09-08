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

    'empty' => 'Ingenting er kjøpt ennå',
    'empty_body' => 'Bestillinger dukker opp her så snart noen kjøper en pakke.',
];
