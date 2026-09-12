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
    'cancel_confirm' => 'Tjänsten kör till :date och faktureras inte igen. Den dagen tas servern bort, med allt som ligger på den. Kunden får veta båda delarna nu.',
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
    'not_paid' => 'Den här beställningen har ingen betald faktura, så ingenting byggdes. Om den är betald tar fakturan den betalades på inte upp den här beställningen - säg till den som sköter panelen.',

    // ---- servern det blir till -------------------------------------------
    'server_description' => 'Köpt i butiken, beställning :number.',
    'server_fallback' => 'Server',
    'state_ending' => 'Avslutas',
    'ends_on' => 'Slutar :date',
    'no_more_dues' => 'Faktureras inte igen',
    'cancel_confirm_open' => 'Stoppar förnyelserna nu och lämnar tillbaka platsen i lagret. Servern får stå kvar och köra: det här paketet har ingen minsta bindningstid, så det finns inget datum att gå mot. Ta bort servern i Pelican när kunden är färdig med den.',
    'terminate' => 'Stoppa och ta bort',
    'terminate_heading' => 'Ta bort den här servern?',
    'terminate_confirm' => 'Servern tas bort nu, med sina filer, sina databaser och sina säkerhetskopior. Det går inte att ångra, och det väntas inte på att avtalet ska löpa ut. Avbryt i stället om kunden ska ha kvar den till det datum han fått.',
    'terminate_go' => 'Ta bort den',
    'terminated' => 'Borttagen',
    'terminated_body' => 'Servern är borta och beställningen är avslutad.',
    'bell_ending' => 'Ditt :package slutar :date',
    'bell_ending_open' => 'Ditt :package har avbrutits',
    'bell_ending_body' => 'Du faktureras inte för den igen. Allt på servern tas bort när den stannar, så kopiera ut det du vill behålla.',
    'bell_ended' => 'Ditt :package har tagit slut',
    'bell_ended_body' => 'Avtalet löpte ut och servern har tagits bort.',
    'bell_undeleted' => 'Beställning :number kunde inte tas bort',
    'bell_undeleted_body' => 'Panelen vägrade ta bort servern. Beställningen är avslutad och ingen faktureras för den, men servern står kvar och måste tas bort i Pelican.',
    'bell_undelivered' => 'Filen till beställning :number ligger kvar här',
    'bell_undelivered_body' => 'Servern byggdes, men kundens uppladdning gick inte att lägga in i den. Den ligger kvar i panelens lagring, och skälet står i storage/logs.',
    'by_customer' => 'Avslutad av kunden',
    'by_admin' => 'Avslutad här',
    'filter_by' => 'Vem avslutade',
    'details' => 'Detaljer',
    'details_of' => 'Beställning :number',
    'close' => 'Stäng',
    'detail_package' => 'Paket',
    'detail_placed' => 'Beställd',
    'detail_built' => 'Server byggd',
    'detail_due' => 'Nästa förfall',
    'detail_ends' => 'Slutar',
    'detail_suspended' => 'Avstängd',
    'detail_cancelled' => 'Avbruten',
    'detail_file_in' => 'Fil inlagd',
    'detail_file_waiting' => 'Fil',
    'detail_file_waiting_value' => 'Uppladdad, väntar på att servern byggs.',
    'detail_note' => 'Senaste problemet',

    'empty' => 'Ingenting har köpts än',
    'empty_body' => 'Beställningar dyker upp här så fort någon köper ett paket.',

    // ---- förnyelser ------------------------------------------------------
    'filter_late' => 'Efter med en räkning',
    'run_renewals' => 'Kör förnyelser nu',
    'run_renewals_confirm' => 'Gör det den nattliga rundan gör: skriver nästa faktura för allt som snart förfaller, och stoppar servrarna bakom en räkning som blivit obetald förbi respittiden.',
    'renewals_queued' => 'Ställd i kön',
    'renewals_queued_body' => 'Den kör i kön. Ladda om om en stund för att se vad som ändrats.',
];
