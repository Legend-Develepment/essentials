<?php

/*
 * Svenska. Skriven för hand.
 *
 * En väg in utifrån.
 *
 * Två sorters läsare i en fil, och de vill ha var sin sak. En administratör som
 * läser den här sidan står i begrepp att avgöra om han vågar anförtro någon en
 * nyckel, så varje rad här säger vad en nyckel når snarare än vad den heter.
 * Den som ber om en vill veta vad han får i handen och vad som händer om han
 * tappar bort den, och därför är meningen om att en nyckel bara visas en gång
 * ingen fotnot.
 *
 * Ingenting här säger «token». «Nyckel» är ordet på Pelicans egen kontosida,
 * och en panel som kallar samma sak för två ting är en panel där någon letar
 * efter fel sak.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Nycklar som låter något utanför panelen fråga om det här pluginet vet. Endast läsning — ingenting här kan starta, stoppa eller nå en server.',

    'my_title' => 'API-åtkomst',
    'my_nav_label' => 'API-åtkomst',
    'my_subheading' => 'En egen nyckel, till en bot eller ett skript. Den svarar bara för de servrar du redan kan öppna.',

    // ---- vad en nyckel är, sagt en gång, där det spelar roll -------------
    'address' => 'Adressen',
    'address_helper' => 'Skicka nyckeln som en Authorization-header: :example',

    /*
     * Det enda någon måste ha läst innan dialogen stängs. Skrivet som vad man
     * ska göra i stället för som en varning, för «ta väl hand om den» är ett
     * råd ingen kan handla efter, och «klistra in den där boten läser den, nu»
     * är det.
     */
    'once' => 'Det här är enda gången den här nyckeln visas',
    'once_body' => 'Den lagras som en hash, så ingen — inte heller den som driver den här panelen — kan läsa tillbaka den. Klistra in den där boten eller skriptet läser den, nu. Går den förlorad, återkalla den här och be om en ny.',
    'copy' => 'Kopiera',
    'copied' => 'Kopierat',

    // ---- tillstånden -----------------------------------------------------
    'state' => 'Tillstånd',
    'state_pending' => 'Väntar',
    'state_active' => 'Aktiv',
    'state_refused' => 'Nekad',
    'state_revoked' => 'Återkallad',

    'state_pending_body' => 'Någon måste ge tillstånd innan den svarar på något alls.',
    'state_refused_body' => 'Det här fick nej. Ingenting utfärdades.',
    'state_revoked_body' => 'Den här nyckeln är borttagen och svarar inte längre.',

    // ---- räckvidden ------------------------------------------------------
    'scope' => 'Når',
    'scope_person' => 'Sina egna servrar',
    'scope_panel' => 'Hela panelen',

    'scope_person_helper' => 'Svarar bara för de servrar ägaren redan kan öppna, frågat på samma sätt som panelen frågar. Att tappa bort den här nyckeln tappar bort ingenting ägaren inte redan kunde se.',
    'scope_panel_helper' => 'Svarar på de frågor som gäller hela panelen — varje nod, kapaciteten, vakthunden, panelens egen värd. Till en bot som rapporterar om panelen i stället för åt en person.',

    // ---- tabellen --------------------------------------------------------
    'column_name' => 'Till vad',
    'column_owner' => 'Vems',
    'column_prefix' => 'Nyckel',
    'column_asked' => 'Ombedd',
    'column_used' => 'Senast använd',
    'column_expires' => 'Går ut',

    'never_used' => 'Aldrig',
    'no_expiry' => 'Tills den återkallas',

    'tab_waiting' => 'Väntar',
    'tab_active' => 'Aktiva',
    'tab_all' => 'Alla',

    'empty' => 'Inga nycklar ännu',
    'empty_body' => 'Ingen har bett om en, och ingen är utfärdad. Den här sidan fyller i sig själv allteftersom folk gör det.',

    'my_empty' => 'Du har ingen nyckel',
    'my_empty_body' => 'Be om en, så dyker den upp här med det svar den fått.',

    // ---- att be om en ----------------------------------------------------
    'ask' => 'Be om en nyckel',
    'ask_name' => 'Vad den ska användas till',
    'ask_name_helper' => 'Ett par ord, så att du senare känner igen två av dina egna, och så att den som ger tillstånd vet vad han ger tillstånd till.',
    'ask_reason' => 'Något som är värt att lägga till',
    'ask_reason_helper' => 'Frivilligt. Läses av den som avgör.',
    'ask_sent' => 'Ombedd',
    'ask_sent_body' => 'Den dyker upp nedan så snart någon har svarat.',
    'ask_granted' => 'Här är din nyckel',
    'ask_open' => 'Du har redan en som väntar på svar',
    'ask_open_body' => 'En förfrågan i taget. Dra tillbaka den om den var ett misstag.',
    'ask_failed' => 'Det gick inte att be om en',

    'cancel' => 'Ångra',
    'cancel_confirm' => 'Drar tillbaka förfrågan. Ingenting utfärdades, så det är inte heller något som slutar fungera.',

    // ---- att avgöra ------------------------------------------------------
    'grant' => 'Ge tillstånd',
    'grant_confirm' => 'Utfärdar en nyckel som svarar för den här personens egna servrar, och visar den en gång. Han kan redan se allt den kommer att rapportera — det här avgör om något utanför panelen får fråga å hans vägnar.',
    'granted' => 'Givet',

    'refuse' => 'Neka',
    'refuse_answer' => 'Vad de får veta',
    'refuse_answer_helper' => 'Frivilligt, och visat på deras egen sida. Ett nekande utan skäl är ett som det bes om igen nästa vecka.',
    'refused' => 'Nekat',
    'collect' => 'Visa min nyckel',
    'state_ready_body' => 'Givet. Tryck på Visa min nyckel för att se den — en gång, för den lagras som en hash och går inte att läsa tillbaka efteråt.',
    'replace' => 'Ersätt',
    'replace_confirm' => 'Den här nyckeln slutar fungera omedelbart och en ny tar dess plats, visad en gång. Den gamla går inte att slå upp någonstans — den lagrades aldrig — så att ersätta den är det enda svaret på att ha tappat bort den.',
    'granted_body' => 'De hämtar den själva på sin egen sida för API-åtkomst. Den visas inte här: en nyckel hör till den som bad om den, inte till den som sade ja.',

    'revoke' => 'Återkalla',
    'revoke_confirm' => 'Nyckeln slutar svara omedelbart, och dess hash tas bort, så den går inte att få tillbaka. Allt som använder den stannar. Be om en ny i stället för att ångra det här.',
    'revoked' => 'Återkallad',
    'forget' => 'Ta bort',
    'forget_confirm' => 'Tar bort raden från den här sidan för gott. Den har redan slutat svara, så ingenting som fungerar stannar - det här tar bara bort spåret av att den funnits.',
    'forgotten' => 'Borttagen',

    'mint' => 'Ny nyckel',
    'mint_body' => 'Till en bot i stället för till en person. Den får tillstånd i samma stund som den skapas, för du är den som skulle ha sagt ja till den.',
    'abilities' => 'Vad den får fråga om',
    'abilities_helper' => 'Allt är ikryssat till att börja med, för det var vad en nyckel var innan det här fanns. Att kryssa ur är den avsiktliga handlingen. Det som lagras är listan över det tillåtna, så en förmåga som läggs till i en senare version är av för nycklar gjorda före den - en förmåga ingen kryssade i är en förmåga ingen gav.',
    'ability_health' => 'Visa att nyckeln fungerar',
    'ability_health_helper' => 'Når ingenting annat. Går bra att anropa på en timer.',
    'ability_me' => 'Sina egna servrar',
    'ability_me_helper' => 'De servrar dess ägare redan kan öppna, och deras säkerhetskopior. Den kan aldrig se någon annans.',
    'ability_panel' => 'Hela panelen',
    'ability_panel_helper' => 'Varje nod, varje säkerhetskopia, de schemalagda uppgifter som stannat, vakthunden och panelens egen värd. Kräver också en nyckel som gäller hela panelen.',
    'ability_live' => 'Fråga en server direkt',
    'ability_live_helper' => 'Vilka som spelar, och om en server kör. De enda frågorna som kostar något — de når en spelserver eller en daemon, och svaret sparas femton till tjugo sekunder.',
    'ability_connect' => 'Knyt Discord-konton till panelkonton',
    'ability_connect_helper' => 'Den enda gruppen som inte är en avläsning. Den skapar Pelican-API-nycklar på kontona hos dem som ber om det, och kan avsluta en koppling. Ge den bara till den bot som behöver den.',
    'own_rate' => 'Förfrågningar i minuten för den här nyckeln',
    'own_rate_helper' => 'Lämna tomt för att följa panelens inställning. Ett tal här gäller bara den här nyckeln. Noll betyder inget tak alls — rimligt för en bot på din egen maskin, och ett riktigt sätt att bli ledsen om nyckeln hamnar någon annanstans.',
    'own_rate_default' => 'Följer panelen',
    'mint_owner' => 'Vem den är',
    'mint_owner_helper' => 'En nyckel svarar som någon. För en nyckel som gäller hela panelen är det bara vem som står till svars för den; för en personlig är det också vad nyckeln får se.',
    'minted' => 'Skapad',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'En nyckel för Essentials API',
    'profile_make_helper' => 'Ett annat API än det ovanför: det här svarar på vad det här pluginet vet — vilken av dina servrar som saknar säkerhetskopia, vilka som spelar på dem, om de kör. Det svarar alltid för dig ensam och når bara de servrar du redan kan öppna.',
    'profile_create' => 'Skapa',
    'profile_yours' => 'Dina Essentials-nycklar',
    'profile_manage' => 'Att återkalla en nyckel, se varför en nekades och koppla Discord finns alltihop på sidan API-åtkomst i sidomenyn.',
    'discord' => 'Discord',
    'discord_body' => 'Knyt ditt Discord-konto till det här, så att en bot kan svara för dina servrar när du ber den om det. Det den får är en nyckel som når precis det du når och inget mer.',
    'discord_connect' => 'Koppla Discord',
    'discord_code' => 'Skriv det här i Discord inom tio minuter',
    'discord_code_body' => 'Skicka :command i en kanal boten kan läsa. Koden fungerar en gång. Ingen kan använda den utom det konto den gjordes för.',
    'discord_on' => 'Kopplad som :name',
    'discord_since' => 'Sedan :when',
    'discord_cut' => 'Frånkopplad',
    'discord_cut_confirm' => 'Avslutar kopplingen och tar bort nyckeln den gjorde, så boten slutar svara för dig omedelbart. Du kan koppla igen när du vill.',
    'discord_off' => 'Inte kopplad',
    'discord_key_note' => 'Att koppla skapar en Pelican-API-nyckel på ditt konto som heter Discord (Essentials). Du kan se den, och återkalla den, under Konto → API-nycklar — den här sidan är bara en genväg till samma sak.',
    'docs_title' => 'Så använder du det här API-gränssnittet',
    'docs_subheading' => 'Vad den här panelen svarar på, och på vilka adresser den svarar. Skrivet ur samma beskrivning som gränssnittet är byggt av, så det kan inte ligga en version efter det.',
    'docs_base' => 'Var det finns',
    'docs_endpoints' => 'Endpoints',
    'docs_answers' => 'Vad som kommer tillbaka',
    'docs_calls' => 'Nycklar som får anropa det',
    'docs_params' => 'Vad som ska skickas',
    'docs_required' => 'krävs',
    'docs_optional' => 'frivilligt',
    'docs_try' => 'Prova',
    'docs_errors' => 'När något är fel',
    'docs_hook' => 'Vad panelen skickar till dig',
    'docs_hook_body' => 'Den andra riktningen, och den enda delen av det här som kommer utan att bli ombedd. Slås på under Aviseringar med en adress och en signeringshemlighet: en JSON-post när vakthunden hittar något och en när det klarnar, så att en bot får höra om en död nod i stället för att fråga varje minut om det finns en.',
    'docs_hook_verify' => 'Kroppen hashas med din hemlighet och hashen följer med i X-Essentials-Signature som sha256=<hex>. Hasha den råa kroppen, inte ett objekt du serialiserat om — minsta skillnad i mellanrum eller nyckelordning ger en annan hash, och avvikelsen läses som ett angrepp snarare än som ett fel.',
    'docs_download_md' => 'Ladda ner som Markdown',
    'docs_download_json' => 'Ladda ner som OpenAPI',

    // ---- vad en administratör ställer in ---------------------------------
    'settings' => 'Så här fungerar det',
    'approval' => 'Förfrågningar väntar på tillstånd',
    'approval_helper' => 'På får den som ber om en nyckel en när någon säger ja. Av får han en direkt — vilket är rimligt på en panel där alla med ett konto redan är betrodda, och som är värt att välja i stället för att hamna i.',
    'rate' => 'Förfrågningar i minuten, per nyckel',
    'rate_helper' => 'En bot som frågar fyrtio servrar vilka som spelar är fyrtio frågor till fyrtio spelservrar. Det här är taket som hindrar en slinga någon skrev klockan tre på natten från att bli ett belastningstest.',
    'days' => 'En given nyckel varar',
    'days_helper' => 'I dagar. Noll betyder tills den återkallas, och det är standarden — en nyckel som går ut medan ingen tittar är en bot som stannar på natten utan att någonstans säga varför.',
    'days_never' => 'Tills den återkallas',
    'hide_pelican' => 'Ta bort panelens egen flik för API-nycklar',
    'hide_pelican_helper' => 'Tar bort fliken API-nycklar från kontoprofilen helt, så att det bara finns en sak som heter API-nycklar på den sidan. Den tas bort från sidan i stället för att målas över, så det finns ingen adress kvar som når den. En sak den inte kan: panelens eget klient-API gör fortfarande en kontonyckel åt vad som helst som ber det direkt — fliken är där folk gör en för hand, och det här tar bort handen. Nycklar som redan finns fortsätter att fungera.',

    /*
     * Sagt på sidan i stället för lämnat att upptäckas. Pelican rullar tillbaka
     * ett plugins migrationer när det avinstalleras, och det här pluginets enda
     * tabell följer med.
     */
    'uninstall_note' => 'Att ta bort det här pluginet tar bort varenda nyckel med det. Det är med flit — en nyckel som överlever det som svarar på den är en inloggning ingen kan dra tillbaka.',
];
