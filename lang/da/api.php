<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * En vej ind udefra.
 *
 * To slags læsere i én fil, og de vil have hver sit. En administrator, der
 * læser denne side, er ved at afgøre, om han tør betro nogen en nøgle, så hver
 * linje her siger, hvad en nøgle kan nå, frem for hvad den hedder. Den, der
 * beder om en, vil vide, hvad han får i hånden, og hvad der sker, hvis han
 * mister den, og derfor er sætningen om, at en nøgle kun vises én gang, ikke en
 * fodnote.
 *
 * Intet her siger „token". „Nøgle" er ordet på Pelicans egen kontoside, og et
 * panel, der kalder det samme to ting, er et panel, hvor nogen leder efter det
 * forkerte.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Nøgler, der lader noget uden for panelet spørge om det, dette plugin ved. Kun læsning — intet her kan starte, stoppe eller nå en server.',

    'my_title' => 'API-adgang',
    'my_nav_label' => 'API-adgang',
    'my_subheading' => 'En nøgle af din egen, til en bot eller et script. Den svarer kun for de servere, du allerede kan åbne.',

    // ---- hvad en nøgle er, sagt én gang, hvor det betyder noget ----------
    'address' => 'Adressen',
    'address_helper' => 'Send nøglen som en Authorization-header: :example',

    /*
     * Det ene, nogen skal have læst, før dialogen lukkes. Skrevet som hvad man
     * skal gøre frem for som en advarsel, fordi „pas godt på den" er et råd,
     * ingen kan handle på, og „sæt den ind, hvor botten læser den, nu" er.
     */
    'once' => 'Det er den eneste gang, denne nøgle bliver vist',
    'once_body' => 'Den gemmes som en hash, så ingen — heller ikke den, der driver dette panel — kan læse den tilbage. Sæt den ind der, hvor botten eller scriptet læser den, nu. Går den tabt, så tilbagekald denne og bed om en ny.',
    'copy' => 'Kopiér',
    'copied' => 'Kopieret',

    // ---- tilstandene -----------------------------------------------------
    'state' => 'Tilstand',
    'state_pending' => 'Venter',
    'state_active' => 'Aktiv',
    'state_refused' => 'Afvist',
    'state_revoked' => 'Tilbagekaldt',

    'state_pending_body' => 'Nogen skal give lov, før den svarer på noget.',
    'state_refused_body' => 'Den blev sagt nej til. Der blev ikke udstedt noget.',
    'state_revoked_body' => 'Denne nøgle er taget væk og svarer ikke længere.',

    // ---- rækkevidden -----------------------------------------------------
    'scope' => 'Når',
    'scope_person' => 'Deres egne servere',
    'scope_panel' => 'Hele panelet',

    'scope_person_helper' => 'Svarer kun for de servere, dens ejer allerede kan åbne, spurgt på samme måde, som panelet spørger. At miste denne nøgle mister intet, dens ejer ikke allerede kunne se.',
    'scope_panel_helper' => 'Svarer på de spørgsmål, der gælder hele panelet — hver node, kapaciteten, vagthunden, panelets vært selv. Til en bot, der rapporterer om panelet frem for for en person.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Hvad til',
    'column_owner' => 'Hvis',
    'column_prefix' => 'Nøgle',
    'column_asked' => 'Bedt om',
    'column_used' => 'Sidst brugt',
    'column_expires' => 'Udløber',

    'never_used' => 'Aldrig',
    'no_expiry' => 'Indtil den tilbagekaldes',

    'tab_waiting' => 'Venter',
    'tab_active' => 'Aktive',
    'tab_all' => 'Alle',

    'empty' => 'Ingen nøgler endnu',
    'empty_body' => 'Ingen har bedt om en, og der er ikke udstedt nogen. Denne side fylder sig selv ud, efterhånden som folk gør det.',

    'my_empty' => 'Du har ingen nøgle',
    'my_empty_body' => 'Bed om en, så dukker den op her med, hvad der end er blevet svaret.',

    // ---- at bede om en ---------------------------------------------------
    'ask' => 'Bed om en nøgle',
    'ask_name' => 'Hvad skal den bruges til',
    'ask_name_helper' => 'Et par ord, så du selv kan kende to af dine egne fra hinanden senere, og den, der giver lov, ved, hvad han giver lov til.',
    'ask_reason' => 'Noget, der er værd at lægge til',
    'ask_reason_helper' => 'Valgfrit. Læses af den, der afgør det.',
    'ask_sent' => 'Bedt om',
    'ask_sent_body' => 'Den dukker op nedenfor, så snart nogen har svaret.',
    'ask_granted' => 'Her er din nøgle',
    'ask_open' => 'Du har allerede en, der venter på svar',
    'ask_open_body' => 'Én anmodning ad gangen. Træk den tilbage, hvis den var en fejl.',
    'ask_failed' => 'Der kunne ikke bedes om den',

    'cancel' => 'Fortryd',
    'cancel_confirm' => 'Trækker anmodningen tilbage. Der blev ikke udstedt noget, så der er heller ikke noget, der holder op med at virke.',

    // ---- at afgøre -------------------------------------------------------
    'grant' => 'Giv lov',
    'grant_confirm' => 'Udsteder en nøgle, der svarer for denne persons egne servere, og viser den én gang. Han kan allerede se alt, den vil rapportere — det her afgør, om noget uden for panelet må spørge på hans vegne.',
    'granted' => 'Givet',

    'refuse' => 'Afvis',
    'refuse_answer' => 'Hvad de skal have at vide',
    'refuse_answer_helper' => 'Valgfrit, og vist på deres egen side. En afvisning uden en grund er en, der bliver bedt om igen i næste uge.',
    'refused' => 'Afvist',

    'revoke' => 'Tilbagekald',
    'revoke_confirm' => 'Nøglen holder op med at svare med det samme, og dens hash bliver fjernet, så den ikke kan hentes tilbage. Alt, der bruger den, går i stå. Bed om en ny frem for at fortryde det her.',
    'revoked' => 'Tilbagekaldt',

    'mint' => 'Ny nøgle',
    'mint_body' => 'Til en bot frem for til en person. Den bliver givet lov i samme øjeblik, den laves, for du er den, der ville have sagt ja til den.',
    'mint_owner' => 'Hvis den er',
    'mint_owner_helper' => 'En nøgle svarer som nogen. For en nøgle til hele panelet er det kun, hvem der står til ansvar for den; for en personlig er det også, hvad nøglen kan se.',
    'minted' => 'Lavet',

    // ---- hvad en administrator sætter ------------------------------------
    'settings' => 'Sådan virker det',
    'approval' => 'Anmodninger venter på at få lov',
    'approval_helper' => 'Til får den, der beder om en nøgle, en, når nogen siger ja. Fra får de en med det samme — hvilket er rimeligt på et panel, hvor alle med en konto i forvejen er betroet, og er værd at vælge frem for at ende med.',
    'rate' => 'Forespørgsler i minuttet, pr. nøgle',
    'rate_helper' => 'En bot, der spørger fyrre servere, hvem der spiller, er fyrre spørgsmål til fyrre spilservere. Det her er loftet, der forhindrer en løkke, nogen skrev klokken tre om natten, i at blive en belastningstest.',
    'days' => 'En given nøgle holder',
    'days_helper' => 'I dage. Nul betyder, indtil den tilbagekaldes, og det er standarden — en nøgle, der udløber, mens ingen kigger, er en bot, der stopper om natten uden at noget som helst siger hvorfor.',
    'days_never' => 'Indtil den tilbagekaldes',

    /*
     * Sagt på siden frem for overladt til at blive opdaget. Pelican ruller et
     * plugins migreringer tilbage, når det afinstalleres, og dette plugins ene
     * tabel går med dem.
     */
    'uninstall_note' => 'At fjerne dette plugin fjerner hver eneste nøgle med det. Det er med vilje — en nøgle, der overlever det, der svarer på den, er et login, ingen kan trække tilbage.',
];
