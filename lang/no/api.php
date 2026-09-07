<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * En vei inn utenfra.
 *
 * To slags lesere i én fil, og de vil ha hver sin ting. En administrator som
 * leser denne siden, er i ferd med å avgjøre om han tør betro noen en nøkkel, så
 * hver linje her sier hva en nøkkel kan nå framfor hva den heter. Den som ber om
 * en, vil vite hva han får i hånden og hva som skjer om han mister den, og
 * derfor er setningen om at en nøkkel bare vises én gang, ingen fotnote.
 *
 * Ingenting her sier «token». «Nøkkel» er ordet på Pelicans egen kontoside, og
 * et panel som kaller det samme to ting, er et panel der noen leter etter feil
 * en.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Nøkler som lar noe utenfor panelet spørre om det dette pluginet vet. Kun lesing — ingenting her kan starte, stoppe eller nå en server.',

    'my_title' => 'API-tilgang',
    'my_nav_label' => 'API-tilgang',
    'my_subheading' => 'En nøkkel av ditt eget, til en bot eller et skript. Den svarer bare for de serverne du allerede kan åpne.',

    // ---- hva en nøkkel er, sagt én gang, der det betyr noe ---------------
    'address' => 'Adressen',
    'address_helper' => 'Send nøkkelen som en Authorization-header: :example',

    /*
     * Den ene tingen noen må ha lest før dialogen lukkes. Skrevet som hva man
     * skal gjøre framfor som en advarsel, fordi «ta godt vare på den» er et råd
     * ingen kan handle på, og «lim den inn der boten leser den, nå» er det.
     */
    'once' => 'Dette er den eneste gangen denne nøkkelen vises',
    'once_body' => 'Den lagres som en hash, så ingen — heller ikke den som driver dette panelet — kan lese den tilbake. Lim den inn der boten eller skriptet leser den, nå. Går den tapt, tilbakekall denne og be om en ny.',
    'copy' => 'Kopier',
    'copied' => 'Kopiert',

    // ---- tilstandene -----------------------------------------------------
    'state' => 'Tilstand',
    'state_pending' => 'Venter',
    'state_active' => 'Aktiv',
    'state_refused' => 'Avvist',
    'state_revoked' => 'Tilbakekalt',

    'state_pending_body' => 'Noen må gi tillatelse før den svarer på noe som helst.',
    'state_refused_body' => 'Dette ble sagt nei til. Det ble ikke utstedt noe.',
    'state_revoked_body' => 'Denne nøkkelen er tatt bort og svarer ikke lenger.',

    // ---- rekkevidden -----------------------------------------------------
    'scope' => 'Når',
    'scope_person' => 'Sine egne servere',
    'scope_panel' => 'Hele panelet',

    'scope_person_helper' => 'Svarer bare for de serverne eieren allerede kan åpne, spurt på samme måte som panelet spør. Å miste denne nøkkelen mister ingenting eieren ikke allerede kunne se.',
    'scope_panel_helper' => 'Svarer på spørsmålene som gjelder hele panelet — hver node, kapasiteten, vakthunden, panelets vert selv. Til en bot som rapporterer om panelet framfor for en person.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Hva til',
    'column_owner' => 'Hvis',
    'column_prefix' => 'Nøkkel',
    'column_asked' => 'Bedt om',
    'column_used' => 'Sist brukt',
    'column_expires' => 'Utløper',

    'never_used' => 'Aldri',
    'no_expiry' => 'Til den tilbakekalles',

    'tab_waiting' => 'Venter',
    'tab_active' => 'Aktive',
    'tab_all' => 'Alle',

    'empty' => 'Ingen nøkler ennå',
    'empty_body' => 'Ingen har bedt om en, og det er ikke utstedt noen. Denne siden fyller seg selv ut etter hvert som folk gjør det.',

    'my_empty' => 'Du har ingen nøkkel',
    'my_empty_body' => 'Be om en, så dukker den opp her med det den har fått til svar.',

    // ---- å be om en ------------------------------------------------------
    'ask' => 'Be om en nøkkel',
    'ask_name' => 'Hva den skal brukes til',
    'ask_name_helper' => 'Et par ord, så du senere kjenner to av dine egne fra hverandre, og den som gir tillatelse vet hva han gir tillatelse til.',
    'ask_reason' => 'Noe som er verdt å legge til',
    'ask_reason_helper' => 'Valgfritt. Leses av den som avgjør.',
    'ask_sent' => 'Bedt om',
    'ask_sent_body' => 'Den dukker opp nedenfor så snart noen har svart.',
    'ask_granted' => 'Her er nøkkelen din',
    'ask_open' => 'Du har allerede en som venter på svar',
    'ask_open_body' => 'Én forespørsel om gangen. Trekk den tilbake hvis den var en feil.',
    'ask_failed' => 'Det kunne ikke bes om',

    'cancel' => 'Angre',
    'cancel_confirm' => 'Trekker forespørselen tilbake. Det ble ikke utstedt noe, så det er heller ingenting som slutter å virke.',

    // ---- å avgjøre -------------------------------------------------------
    'grant' => 'Gi tillatelse',
    'grant_confirm' => 'Utsteder en nøkkel som svarer for denne personens egne servere, og viser den én gang. Han kan allerede se alt den vil rapportere — dette avgjør om noe utenfor panelet får spørre på hans vegne.',
    'granted' => 'Gitt',

    'refuse' => 'Avvis',
    'refuse_answer' => 'Hva de skal få vite',
    'refuse_answer_helper' => 'Valgfritt, og vist på deres egen side. En avvisning uten grunn er en det blir bedt om igjen neste uke.',
    'refused' => 'Avvist',

    'revoke' => 'Tilbakekall',
    'revoke_confirm' => 'Nøkkelen slutter å svare med det samme, og hashen dens fjernes, så den kan ikke hentes tilbake. Alt som bruker den, stopper. Be om en ny framfor å angre dette.',
    'revoked' => 'Tilbakekalt',

    'mint' => 'Ny nøkkel',
    'mint_body' => 'Til en bot framfor til en person. Den får tillatelse i samme øyeblikk som den lages, for du er den som ville sagt ja til den.',
    'mint_owner' => 'Hvem den er',
    'mint_owner_helper' => 'En nøkkel svarer som noen. For en nøkkel som gjelder hele panelet er det bare hvem som står til ansvar for den; for en personlig er det også hva nøkkelen kan se.',
    'minted' => 'Laget',

    // ---- hva en administrator setter -------------------------------------
    'settings' => 'Slik virker det',
    'approval' => 'Forespørsler venter på tillatelse',
    'approval_helper' => 'På får den som ber om en nøkkel, en når noen sier ja. Av får han en med det samme — noe som er rimelig på et panel der alle med en konto allerede er betrodd, og som er verdt å velge framfor å ende opp med.',
    'rate' => 'Forespørsler i minuttet, per nøkkel',
    'rate_helper' => 'En bot som spør førti servere hvem som spiller, er førti spørsmål til førti spillservere. Dette er taket som hindrer en løkke noen skrev klokken tre om natten i å bli en belastningstest.',
    'days' => 'En gitt nøkkel varer',
    'days_helper' => 'I dager. Null betyr til den tilbakekalles, og det er standarden — en nøkkel som utløper mens ingen ser på, er en bot som stopper om natten uten at noe sted sier hvorfor.',
    'days_never' => 'Til den tilbakekalles',

    /*
     * Sagt på siden framfor overlatt til å bli oppdaget. Pelican ruller
     * migreringene til et plugin tilbake når det avinstalleres, og den ene
     * tabellen til dette pluginet går med.
     */
    'uninstall_note' => 'Å fjerne dette pluginet fjerner hver eneste nøkkel med det. Det er med vilje — en nøkkel som overlever det som svarer på den, er en pålogging ingen kan trekke tilbake.',
];
