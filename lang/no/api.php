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
    'subheading' => 'Nøkler som lar noe utenfor panelet spørre om det dette pluginet vet. Kun lesing - ingenting her kan starte, stoppe eller nå en server.',

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
    'once_body' => 'Den lagres som en hash, så ingen - heller ikke den som driver dette panelet - kan lese den tilbake. Lim den inn der boten eller skriptet leser den, nå. Går den tapt, tilbakekall denne og be om en ny.',
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
    'scope_panel_helper' => 'Svarer på spørsmålene som gjelder hele panelet - hver node, kapasiteten, vakthunden, panelets vert selv. Til en bot som rapporterer om panelet framfor for en person.',

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
    'grant_confirm' => 'Utsteder en nøkkel som svarer for denne personens egne servere, og viser den én gang. Han kan allerede se alt den vil rapportere - dette avgjør om noe utenfor panelet får spørre på hans vegne.',
    'granted' => 'Gitt',

    'refuse' => 'Avvis',
    'refuse_answer' => 'Hva de skal få vite',
    'refuse_answer_helper' => 'Valgfritt, og vist på deres egen side. En avvisning uten grunn er en det blir bedt om igjen neste uke.',
    'refused' => 'Avvist',
    'collect' => 'Vis nøkkelen min',
    'state_ready_body' => 'Gitt. Trykk Vis nøkkelen min for å se den - én gang, for den lagres som en hash og kan ikke leses tilbake etterpå.',
    'replace' => 'Erstatt',
    'replace_confirm' => 'Denne nøkkelen slutter å virke med det samme, og en ny tar plassen dens og vises én gang. Den gamle er det ingen måte å slå opp på - den ble aldri lagret - så å erstatte den er det eneste svaret på å ha mistet den.',
    'granted_body' => 'De henter den selv på sin egen side for API-tilgang. Den vises ikke her: en nøkkel hører til den som ba om den, ikke til den som sa ja.',

    'revoke' => 'Tilbakekall',
    'revoke_confirm' => 'Nøkkelen slutter å svare med det samme, og hashen dens fjernes, så den kan ikke hentes tilbake. Alt som bruker den, stopper. Be om en ny framfor å angre dette.',
    'revoked' => 'Tilbakekalt',
    'forget' => 'Fjern',
    'forget_confirm' => 'Tar raden bort fra denne siden for godt. Den har allerede sluttet å svare, så ingenting som virker stopper - dette fjerner bare oppføringen om at den fantes.',
    'forgotten' => 'Fjernet',

    'mint' => 'Ny nøkkel',
    'mint_body' => 'Til en bot framfor til en person. Den får tillatelse i samme øyeblikk som den lages, for du er den som ville sagt ja til den.',
    'abilities' => 'Hva den får spørre om',
    'abilities_helper' => 'Alt er krysset av til å begynne med, for det var det en nøkkel var før dette fantes. Å ta bort krysset er den bevisste handlingen. Det som lagres er listen over det tillatte, så en evne som kommer til i en senere utgave, er av for nøkler laget før den - en evne ingen krysset av, er en evne ingen har gitt.',
    'ability_health' => 'Vis at nøkkelen virker',
    'ability_health_helper' => 'Når ingenting annet. Trygg å kalle med jevne mellomrom.',
    'ability_me' => 'Sine egne servere',
    'ability_me_helper' => 'De serverne eieren allerede kan åpne, og sikkerhetskopiene deres. Den kan aldri se noen andre.',
    'ability_panel' => 'Hele panelet',
    'ability_panel_helper' => 'Hver node, hver sikkerhetskopi, de stoppede planlagte oppgavene, vakthunden og panelets vert. Krever i tillegg en nøkkel for hele panelet.',
    'ability_live' => 'Spørre en server direkte',
    'ability_live_helper' => 'Hvem som spiller, og om en server kjører. De eneste spørsmålene som koster noe - de når en spillserver eller en daemon, mellomlagret femten til tjue sekunder.',
    'ability_connect' => 'Knytte Discord-kontoer til panelkontoer',
    'ability_connect_helper' => 'Den ene gruppen som ikke er en avlesning. Den oppretter Pelican-API-nøkler på kontoene til dem som ber om det, og kan avslutte en tilknytning. Gi den bare til boten som trenger den.',
    'own_rate' => 'Forespørsler i minuttet for denne nøkkelen',
    'own_rate_helper' => 'La feltet stå tomt for å følge panelets innstilling. Et tall her gjelder bare denne nøkkelen. Null betyr ikke noe tak i det hele tatt - rimelig for en bot på din egen maskin, og en reell måte å bli lei seg på hvis nøkkelen havner et annet sted.',
    'own_rate_default' => 'Følger panelet',
    'mint_owner' => 'Hvem den er',
    'mint_owner_helper' => 'En nøkkel svarer som noen. For en nøkkel som gjelder hele panelet er det bare hvem som står til ansvar for den; for en personlig er det også hva nøkkelen kan se.',
    'minted' => 'Laget',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'En nøkkel til Essentials API',
    'profile_make_helper' => 'En annen API enn den ovenfor: denne svarer på det dette pluginet vet - hvilke av serverne dine som ikke har en sikkerhetskopi, hvem som spiller på dem, om de kjører. Den svarer alltid for deg alene og når bare de serverne du allerede kan åpne.',
    'profile_create' => 'Opprett',
    'profile_yours' => 'Essentials-nøklene dine',
    'profile_manage' => 'Å tilbakekalle en nøkkel, se hvorfor en ble avvist og å koble til Discord gjøres alt sammen på siden API-tilgang i sidemenyen.',
    'discord' => 'Discord',
    'discord_body' => 'Knytt Discord-kontoen din til denne, så en bot kan svare for serverne dine når du ber den om det. Det den får, er en nøkkel som når nøyaktig det du kan nå, og ingenting mer.',
    'discord_connect' => 'Koble til Discord',
    'discord_code' => 'Skriv dette i Discord innen ti minutter',
    'discord_code_body' => 'Send :command i en kanal boten kan lese. Koden virker én gang. Ingen kan bruke den utenom kontoen den ble laget for.',
    'discord_on' => 'Tilknyttet som :name',
    'discord_since' => 'Siden :when',
    'discord_cut' => 'Frakoblet',
    'discord_cut_confirm' => 'Avslutter tilknytningen og sletter nøkkelen den laget, så boten slutter å svare for deg med det samme. Du kan koble til igjen når du vil.',
    'discord_off' => 'Ikke tilknyttet',
    'discord_key_note' => 'Å koble til oppretter en Pelican-API-nøkkel på kontoen din som heter Discord (Essentials). Du kan se den, og tilbakekalle den, under Konto → API-nøkler - denne siden er bare en snarvei til det samme.',
    'docs_title' => 'Slik bruker du denne API-en',
    'docs_subheading' => 'Hva dette panelet svarer på, på adressene det svarer på. Skrevet ut fra den samme beskrivelsen som API-en er bygget av, så den kan ikke ligge en utgave bak den.',
    'docs_base' => 'Hvor den ligger',
    'docs_endpoints' => 'Endepunkter',
    'docs_answers' => 'Hva som kommer tilbake',
    'docs_calls' => 'Nøkler som får kalle den',
    'docs_params' => 'Hva du skal sende',
    'docs_required' => 'påkrevd',
    'docs_optional' => 'valgfritt',
    'docs_try' => 'Prøv den',
    'docs_errors' => 'Når noe er galt',
    'docs_hook' => 'Hva panelet sender til deg',
    'docs_hook_body' => 'Den andre retningen, og den eneste delen av dette som kommer uten å bli bedt om. Slås på under Varsler med en adresse og en signeringshemmelighet: én JSON-post når vakthunden finner noe, og én når det er over, så en bot får høre om en node som er nede framfor å spørre hvert minutt om det finnes en.',
    'docs_hook_verify' => 'Kroppen hashes med hemmeligheten din, og hashen følger med i X-Essentials-Signature som sha256=<hex>. Hash den rå kroppen, ikke et objekt som er serialisert på nytt - enhver forskjell i mellomrom eller i rekkefølgen på nøklene gir en annen hash, og misforholdet leses som et angrep framfor som en feil.',
    'docs_download_md' => 'Last ned som Markdown',
    'docs_download_json' => 'Last ned som OpenAPI',

    // ---- hva en administrator setter -------------------------------------
    'settings' => 'Slik virker det',
    'approval' => 'Forespørsler venter på tillatelse',
    'approval_helper' => 'På får den som ber om en nøkkel, en når noen sier ja. Av får han en med det samme - noe som er rimelig på et panel der alle med en konto allerede er betrodd, og som er verdt å velge framfor å ende opp med.',
    'rate' => 'Forespørsler i minuttet, per nøkkel',
    'rate_helper' => 'En bot som spør førti servere hvem som spiller, er førti spørsmål til førti spillservere. Dette er taket som hindrer en løkke noen skrev klokken tre om natten i å bli en belastningstest.',
    'days' => 'En gitt nøkkel varer',
    'days_helper' => 'I dager. Null betyr til den tilbakekalles, og det er standarden - en nøkkel som utløper mens ingen ser på, er en bot som stopper om natten uten at noe sted sier hvorfor.',
    'days_never' => 'Til den tilbakekalles',
    'hide_pelican' => 'Fjern panelets egen fane for API-nøkler',
    'hide_pelican_helper' => 'Tar fanen API-nøkler helt bort fra kontoprofilen, så det bare er én ting som heter API-nøkler på den siden. Den fjernes fra siden framfor å males over, så det står ingen adresse igjen som når den. Én ting den ikke kan: panelets egen klient-API lager fortsatt en kontonøkkel til alt som ber den direkte om det - fanen er der folk lager en for hånd, og dette tar bort hånden. Nøkler som allerede finnes, virker videre.',

    /*
     * Sagt på siden framfor overlatt til å bli oppdaget. Pelican ruller
     * migreringene til et plugin tilbake når det avinstalleres, og den ene
     * tabellen til dette pluginet går med.
     */
    'uninstall_note' => 'Å fjerne dette pluginet fjerner hver eneste nøkkel med det. Det er med vilje - en nøkkel som overlever det som svarer på den, er en pålogging ingen kan trekke tilbake.',
];
