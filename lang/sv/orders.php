<?php

/*
 * Svenska. Skrivet för hand.
 *
 * Beställningar: vad någon har köpt och vad det blev av det.
 *
 * De fyra tillstånden nedan handlar om pengarna, inte om servern. Om servern
 * kör just nu är Pelicans egen fråga och besvaras på Pelicans egna sidor. Orden
 * här håller de två sakerna isär.
 */

return [
    'title' => 'Beställningar',
    'nav_label' => 'Beställningar',
    'subheading' => 'Allt som har köpts, servern det blev till och hur det står till.',

    // ---- tabellen --------------------------------------------------------
    'column_order' => 'Beställning',
    'column_customer' => 'Kund',
    'column_package' => 'Paket',
    'column_server' => 'Server',
    'column_state' => 'Tillstånd',
    'column_due' => 'Nästa förfall',

    'no_server' => 'Inte byggd än',
    'no_due' => 'Engångsbetalning',
    'gone_customer' => 'Konto borttaget',
    'gone_package' => 'Paket borttaget',
    'overdue_days' => ':days dagar försenad',

    'state_pending' => 'Väntar',
    'state_active' => 'Aktiv',
    'state_suspended' => 'Avstängd',
    'state_cancelled' => 'Avbruten',

    // ---- knapparna -------------------------------------------------------
    'retry' => 'Bygg igen',
    'retry_confirm' => 'Ställer bygget i kön en gång till. Inget annat ändras, och fakturan förblir betald.',
    'retrying' => 'Ställd i kön',

    'suspend' => 'Stäng av',
    'suspend_confirm' => 'Stoppar servern med Pelicans egen avstängning. Filer, databaser och säkerhetskopior blir kvar där de är, och att betala fakturan häver den igen.',
    'suspended' => 'Avstängd',

    'unsuspend' => 'Häv avstängningen',
    'unsuspended' => 'Kör igen',

    'change_due' => 'Ändra förfallodagen',
    'change_due_helper' => 'När nästa faktura skrivs. Tomt betyder aldrig - beställningen slutar förnyas utan att vara avbruten.',

    'cancel' => 'Avbryt',
    'cancel_confirm' => 'Stoppar förnyelserna och lämnar tillbaka platsen i lagret. Servern får stå kvar: den tas bort i Pelican, där det hör hemma.',
    'cancelled' => 'Avbruten',

    'saved' => 'Sparat',
    'refused' => 'Ingenting ändrades',
    'refused_body' => 'Beställningen är inte i ett tillstånd där det gick. Ladda om sidan och titta en gång till.',

    // ---- vad kunden hör --------------------------------------------------
    'bell_ready' => 'Din server är klar',
    'bell_ready_body' => ':server har skapats och väntar på att du startar den.',
    'bell_suspended' => 'Din server har stängts av',
    'bell_suspended_body' => 'En faktura blev obetald förbi respittiden. Betalar du den startar servern igen; ingenting har tagits bort.',

    // ---- vad administratören hör -----------------------------------------
    'bell_failed' => 'Beställning :number kunde inte byggas',
    'no_allocation' => 'Ingen node i det här paketet har en ledig allocation. Lägg till en och bygg igen.',
    'no_reason' => 'Panelen nekade utan att säga varför.',

    // ---- servern det blir till -------------------------------------------
    'server_description' => 'Köpt i butiken, beställning :number.',
    'server_fallback' => 'Server',

    'empty' => 'Ingenting har köpts än',
    'empty_body' => 'Beställningar dyker upp här så fort någon köper ett paket.',

    // ---- förnyelser ------------------------------------------------------
    'filter_late' => 'Efter med en räkning',
    'run_renewals' => 'Kör förnyelser nu',
    'run_renewals_confirm' => 'Gör det den nattliga rundan gör: skriver nästa faktura för allt som snart förfaller, och stoppar servrarna bakom en räkning som blivit obetald förbi respittiden.',
    'renewals_queued' => 'Ställd i kön',
    'renewals_queued_body' => 'Den kör i kön. Ladda om om en stund för att se vad som ändrats.',
];
