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

    'revoke' => 'Återkalla',
    'revoke_confirm' => 'Nyckeln slutar svara omedelbart, och dess hash tas bort, så den går inte att få tillbaka. Allt som använder den stannar. Be om en ny i stället för att ångra det här.',
    'revoked' => 'Återkallad',

    'mint' => 'Ny nyckel',
    'mint_body' => 'Till en bot i stället för till en person. Den får tillstånd i samma stund som den skapas, för du är den som skulle ha sagt ja till den.',
    'mint_owner' => 'Vem den är',
    'mint_owner_helper' => 'En nyckel svarar som någon. För en nyckel som gäller hela panelen är det bara vem som står till svars för den; för en personlig är det också vad nyckeln får se.',
    'minted' => 'Skapad',

    // ---- vad en administratör ställer in ---------------------------------
    'settings' => 'Så här fungerar det',
    'approval' => 'Förfrågningar väntar på tillstånd',
    'approval_helper' => 'På får den som ber om en nyckel en när någon säger ja. Av får han en direkt — vilket är rimligt på en panel där alla med ett konto redan är betrodda, och som är värt att välja i stället för att hamna i.',
    'rate' => 'Förfrågningar i minuten, per nyckel',
    'rate_helper' => 'En bot som frågar fyrtio servrar vilka som spelar är fyrtio frågor till fyrtio spelservrar. Det här är taket som hindrar en slinga någon skrev klockan tre på natten från att bli ett belastningstest.',
    'days' => 'En given nyckel varar',
    'days_helper' => 'I dagar. Noll betyder tills den återkallas, och det är standarden — en nyckel som går ut medan ingen tittar är en bot som stannar på natten utan att någonstans säga varför.',
    'days_never' => 'Tills den återkallas',

    /*
     * Sagt på sidan i stället för lämnat att upptäckas. Pelican rullar tillbaka
     * ett plugins migrationer när det avinstalleras, och det här pluginets enda
     * tabell följer med.
     */
    'uninstall_note' => 'Att ta bort det här pluginet tar bort varenda nyckel med det. Det är med flit — en nyckel som överlever det som svarar på den är en inloggning ingen kan dra tillbaka.',
];
