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
    'subheading' => 'Nøgler, der lader noget uden for panelet spørge om det, dette plugin ved. Kun læsning - intet her kan starte, stoppe eller nå en server.',

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
    'once_body' => 'Den gemmes som en hash, så ingen - heller ikke den, der driver dette panel - kan læse den tilbage. Sæt den ind der, hvor botten eller scriptet læser den, nu. Går den tabt, så tilbagekald denne og bed om en ny.',
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
    'scope_panel_helper' => 'Svarer på de spørgsmål, der gælder hele panelet - hver node, kapaciteten, vagthunden, panelets vært selv. Til en bot, der rapporterer om panelet frem for for en person.',

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
    'grant_confirm' => 'Udsteder en nøgle, der svarer for denne persons egne servere, og viser den én gang. Han kan allerede se alt, den vil rapportere - det her afgør, om noget uden for panelet må spørge på hans vegne.',
    'granted' => 'Givet',

    'refuse' => 'Afvis',
    'refuse_answer' => 'Hvad de skal have at vide',
    'refuse_answer_helper' => 'Valgfrit, og vist på deres egen side. En afvisning uden en grund er en, der bliver bedt om igen i næste uge.',
    'refused' => 'Afvist',
    'collect' => 'Vis min nøgle',
    'state_ready_body' => 'Givet. Tryk på Vis min nøgle for at se den - én gang, for den gemmes som en hash og kan ikke læses tilbage bagefter.',
    'replace' => 'Erstat',
    'replace_confirm' => 'Denne nøgle holder op med at virke med det samme, og en ny tager dens plads og vises én gang. Den gamle kan ikke slås op, for den blev aldrig gemt: at erstatte den er det eneste svar på at have mistet den.',
    'granted_body' => 'De henter den selv på deres egen side API-adgang. Den vises ikke her: en nøgle hører til den, der bad om den, ikke til den, der sagde ja.',

    'revoke' => 'Tilbagekald',
    'revoke_confirm' => 'Nøglen holder op med at svare med det samme, og dens hash bliver fjernet, så den ikke kan hentes tilbage. Alt, der bruger den, går i stå. Bed om en ny frem for at fortryde det her.',
    'revoked' => 'Tilbagekaldt',
    'forget' => 'Fjern',
    'forget_confirm' => 'Tager rækken af denne side for altid. Den er allerede holdt op med at svare, så intet, der virker, går i stå - det her fjerner kun optegnelsen om, at den fandtes.',
    'forgotten' => 'Fjernet',

    'mint' => 'Ny nøgle',
    'mint_body' => 'Til en bot frem for til en person. Den bliver givet lov i samme øjeblik, den laves, for du er den, der ville have sagt ja til den.',
    'abilities' => 'Hvad den må spørge om',
    'abilities_helper' => 'Alt er sat til at begynde med, for det var det, en nøgle var, før det her fandtes. Det er fravalget, der er den bevidste handling. Det, der gemmes, er listen over det tilladte, så en evne, der kommer til i en senere udgave, er slået fra for nøgler, der er lavet før den - en evne, ingen har sat kryds ved, er en evne, ingen har givet.',
    'ability_health' => 'Bevis at nøglen virker',
    'ability_health_helper' => 'Når ikke andet. Kan trygt kaldes med jævne mellemrum.',
    'ability_me' => 'Dens egne servere',
    'ability_me_helper' => 'De servere, dens ejer allerede kan åbne, og deres sikkerhedskopier. Den kan aldrig se nogen andens.',
    'ability_panel' => 'Hele panelet',
    'ability_panel_helper' => 'Hver node, hver sikkerhedskopi, de planlagte opgaver, der er gået i stå, vagthunden og panelets vært. Kræver også en nøgle til hele panelet.',
    'ability_live' => 'Spørg en server direkte',
    'ability_live_helper' => 'Hvem der spiller, og om en server kører. De eneste spørgsmål, der koster noget - de når ud til en spilserver eller en daemon og gemmes i femten til tyve sekunder.',
    'ability_connect' => 'Knyt Discord-konti til konti i panelet',
    'ability_connect_helper' => 'Den ene gruppe, der ikke bare er en aflæsning. Den laver Pelican-API-nøgler på kontoen hos dem, der beder om det, og den kan afslutte en forbindelse. Giv den kun til den bot, der har brug for den.',
    'own_rate' => 'Forespørgsler i minuttet for denne nøgle',
    'own_rate_helper' => 'Lad feltet stå tomt for at følge panelets indstilling. Et tal her gælder kun denne nøgle. Nul betyder slet intet loft - rimeligt for en bot på din egen maskine, og en sikker måde at komme til at fortryde det på, hvis nøglen havner andre steder.',
    'own_rate_default' => 'Følger panelet',
    'mint_owner' => 'Hvis den er',
    'mint_owner_helper' => 'En nøgle svarer som nogen. For en nøgle til hele panelet er det kun, hvem der står til ansvar for den; for en personlig er det også, hvad nøglen kan se.',
    'minted' => 'Lavet',
    'profile_tab' => 'Essentials-API',
    'profile_make' => 'En nøgle til Essentials-API',
    'profile_make_helper' => 'En anden API end den ovenfor: den her svarer på det, dette plugin ved - hvilke af dine servere der ikke har en sikkerhedskopi, hvem der spiller på dem, og om de kører. Den svarer altid for dig alene og når kun de servere, du allerede kan åbne.',
    'profile_create' => 'Opret',
    'profile_yours' => 'Dine Essentials-nøgler',
    'profile_manage' => 'At tilbagekalde en nøgle, at se hvorfor en blev afvist, og at forbinde Discord ligger alt sammen på siden API-adgang i menuen.',
    'discord' => 'Discord',
    'discord_body' => 'Knyt din Discord-konto til denne, så en bot kan svare for dine servere, når du beder den om det. Det, den får, er en nøgle, der når præcis det, du kan nå, og ikke mere.',
    'discord_connect' => 'Forbind Discord',
    'discord_code' => 'Skriv det her i Discord inden for ti minutter',
    'discord_code_body' => 'Send :command i en kanal, botten kan læse. Koden virker én gang. Ingen kan bruge den ud over den konto, den blev lavet til.',
    'discord_on' => 'Forbundet som :name',
    'discord_since' => 'Siden :when',
    'discord_cut' => 'Afbrudt',
    'discord_cut_confirm' => 'Afslutter forbindelsen og sletter den nøgle, den lavede, så botten holder op med at svare for dig med det samme. Du kan forbinde igen, når du vil.',
    'discord_off' => 'Ikke forbundet',
    'discord_key_note' => 'At forbinde laver en Pelican-API-nøgle på din konto, der hedder Discord (Essentials). Du kan se den og tilbagekalde den under Konto → API-nøgler - denne side er kun en genvej til det samme.',
    'docs_title' => 'Sådan bruger du denne API',
    'docs_subheading' => 'Hvad dette panel svarer på, og på hvilke adresser. Skrevet ud fra den samme beskrivelse, som API er bygget af, så den ikke kan være en udgave bagud.',
    'docs_base' => 'Hvor den ligger',
    'docs_endpoints' => 'Endepunkter',
    'docs_answers' => 'Hvad der kommer tilbage',
    'docs_calls' => 'Nøgler, der må kalde det',
    'docs_params' => 'Hvad du skal sende',
    'docs_required' => 'påkrævet',
    'docs_optional' => 'valgfrit',
    'docs_try' => 'Prøv den',
    'docs_errors' => 'Når noget er galt',
    'docs_hook' => 'Hvad panelet sender til dig',
    'docs_hook_body' => 'Den anden vej, og den eneste del af det her, der kommer uden at være bedt om. Slås til under Advarsler med en adresse og en signeringshemmelighed: én JSON-besked, når vagthunden finder noget, og én, når det er ovre, så en bot hører om en død node frem for at spørge hvert minut, om der er en.',
    'docs_hook_verify' => 'Kroppen hashes med din hemmelighed, og hashen rejser med i X-Essentials-Signature som sha256=<hex>. Hash den rå krop og ikke et objekt, der er serialiseret om - den mindste forskel i mellemrum eller i rækkefølgen af nøgler giver en anden hash, og uoverensstemmelsen ligner et angreb frem for en fejl.',
    'docs_download_md' => 'Hent som Markdown',
    'docs_download_json' => 'Hent som OpenAPI',

    // ---- hvad en administrator sætter ------------------------------------
    'settings' => 'Sådan virker det',
    'approval' => 'Anmodninger venter på at få lov',
    'approval_helper' => 'Til får den, der beder om en nøgle, en, når nogen siger ja. Fra får de en med det samme - hvilket er rimeligt på et panel, hvor alle med en konto i forvejen er betroet, og er værd at vælge frem for at ende med.',
    'rate' => 'Forespørgsler i minuttet, pr. nøgle',
    'rate_helper' => 'En bot, der spørger fyrre servere, hvem der spiller, er fyrre spørgsmål til fyrre spilservere. Det her er loftet, der forhindrer en løkke, nogen skrev klokken tre om natten, i at blive en belastningstest.',
    'days' => 'En given nøgle holder',
    'days_helper' => 'I dage. Nul betyder, indtil den tilbagekaldes, og det er standarden - en nøgle, der udløber, mens ingen kigger, er en bot, der stopper om natten uden at noget som helst siger hvorfor.',
    'days_never' => 'Indtil den tilbagekaldes',
    'hide_pelican' => 'Fjern panelets egen fane med API-nøgler',
    'hide_pelican_helper' => 'Tager fanen API-nøgler helt af kontoprofilen, så der kun er én ting, der hedder API-nøgler på den side. Den fjernes fra siden frem for at blive malet over, så der ikke er nogen adresse tilbage, der når den. Én ting kan den ikke: panelets egen klient-API laver stadig en kontonøgle til alt, der beder om det direkte - fanen er der, hvor folk laver en i hånden, og det her tager hånden væk. Nøgler, der allerede findes, bliver ved med at virke.',

    /*
     * Sagt på siden frem for overladt til at blive opdaget. Pelican ruller et
     * plugins migreringer tilbage, når det afinstalleres, og dette plugins ene
     * tabel går med dem.
     */
    'uninstall_note' => 'At fjerne dette plugin fjerner hver eneste nøgle med det. Det er med vilje - en nøgle, der overlever det, der svarer på den, er et login, ingen kan trække tilbage.',
];
