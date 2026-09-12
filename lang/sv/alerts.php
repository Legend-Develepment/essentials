<?php

/*
 * Svenska. Skriven för hand.
 *
 * Vakthunden.
 *
 * Varje meddelande härifrån läses på en telefon, klockan tre på natten, av
 * någon som sov för en minut sedan. Vart och ett säger vilken maskin, vad som
 * är fel, och inget mer - detaljen hör hemma på den sida personen öppnar
 * efteråt, inte i raden som väckte honom.
 *
 * Att något har rättat till sig är skrivet som en nyhet snarare än som en
 * fotnot. «Är det tillbaka än» är den fråga någon annars skulle stiga upp för.
 *
 * «Nod», «Wings», «daemon», «webhook», «queue», «Discord» och «SMTP» står kvar
 * på engelska: det är under de namnen man hittar dem i Pelican, på värden och i
 * allt som skrivs om dem.
 */

return [
    'title' => 'Aviseringar',
    'nav_label' => 'Aviseringar',
    'subheading' => 'Panelen vet redan när en nod slutar svara, när en disk fylls, eller när kön stannar. Det här är det som talar om det för dig.',

    // ---- kanalerna, och vad de senast gjorde ------------------------------
    'channels' => 'Vart meddelandena går',
    'channels_helper' => 'Vad varje kanal gjorde senast den ombads skicka något. En kanal som är på och tyst nekar ser precis ut som en panel där ingenting är fel, och därför står det här först på sidan.',

    'state_off' => 'Av',
    'state_untried' => 'Ingenting har skickats ännu',
    'state_ok' => 'Levererat',
    'state_failed' => 'Nekat',

    // ---- när ---------------------------------------------------------------
    'when' => 'Hur ofta',
    'when_helper' => 'Kontrollerna körs i bakgrunden, så de kräver en queue worker. Utan en skickas ingenting, och ingenting säger till - använd «Skicka ett prov», som inte går genom kön.',

    'every' => 'Kontrollera var',
    'every_helper' => 'Varje kontroll når daemonen på varje nod, så det är en förfrågan per nod och runda. Femton minuter räcker för att få höra om ett avbrott medan det fortfarande är ett avbrott.',
    'every_off' => 'Av - inga kontroller alls',
    'every_five' => '5 minuter',
    'every_fifteen' => '15 minuter',
    'every_thirty' => '30 minuter',
    'every_hourly' => 'Timme',
    'every_daily' => 'Dygn',

    'repeat' => 'Påminn mig så länge det varar',
    'repeat_helper' => 'Ett meddelande skickas när något ändras, och ett till när det rättar till sig. Det här lägger till en påminnelse så länge ett problem fortfarande pågår. Noll betyder inga påminnelser - en kanal som upprepar sig var femtonde minut är en kanal folk tystar.',
    'hours' => 'timmar',

    // ---- var ---------------------------------------------------------------
    'where' => 'Kanaler',
    'where_helper' => 'Mer än en är förnuftigt. De går fel på olika sätt.',

    'discord' => 'Discord',
    'discord_helper' => 'Där ett meddelande faktiskt läses av någon som inte sitter och tittar på panelen.',
    'webhook' => 'Webhook-adress',
    'webhook_helper' => 'I Discord: Serverinställningar → Integrationer → Webhooks → Ny webhook → Kopiera webhook-URL. Begränsat till https, för det här offentliggör vilken av dina maskiner som är nere, och hur full dess disk är.',
    'bot' => 'En egen bot',
    'bot_helper' => 'En signerad JSON-post till en adress du själv driver, så att något utanför panelen får höra om en död nod i stället för att fråga varje minut om det finns en. De webhooks Pelican levererar klarar inte det här: de utlöses på modeller och på aktivitetsloggen, och en nod som slutat svara skriver ingetdera.',
    'bot_url' => 'Vart den ska skickas',
    'bot_url_helper' => 'Begränsat till https, för det här skickar vilken av dina maskiner som är nere till en adress på internet.',
    'bot_secret' => 'Signeringshemlighet',
    'bot_secret_helper' => 'Delad med det som tar emot det här. Kroppen hashas med den och hashen följer med i X-Essentials-Signature som sha256=<hex>, så din bot kan neka allt som inte kom från den här panelen. Ingenting skickas så länge den är tom - en signatur som är frivillig är en som ingen kontrollerar.',

    'panel' => 'I panelen',
    'panel_helper' => 'En avisering till alla med den här behörigheten. Fungerar alltid, kräver ingen uppsättning, och är osynlig för alla som inte är inloggade.',

    'email' => 'E-post',
    'email_helper' => 'Åtskilda med komma. Använder panelens egen mailer - pålitlig när den är uppsatt, och fullständigt tyst när den inte är det, och det är det enda fel en vakthund inte får ha. Lämna tomt för att stänga av det.',

    // ---- vad ---------------------------------------------------------------
    'what' => 'Vad som hålls ett öga på',
    'what_helper' => 'Varenda avläsning här är en panelen redan gör. Ingenting på den här sidan öppnar en anslutning som Systemstatus inte öppnar.',

    'percent_helper' => 'Noll stänger av den här kontrollen.',
    'disk' => 'Avisera när en nods disk är över',
    'memory' => 'Avisera när en nods minne är över',

    'maintenance' => 'Avisera om underhåll som stått i mer än',
    'maintenance_helper' => 'En nod på underhåll hoppas över av alla andra kontroller, och det är rätt - och det är också så en glöms bort i fjorton dagar. Noll stänger av det.',

    'versions' => 'Versioner av panel och Wings',
    'versions_helper' => 'Ett meddelande när något ligger efter, och ett när det är ikapp igen. Inga påminnelser - en version är inget avbrott.',

    'backups' => 'Säkerhetskopior som ligger efter',
    'backups_helper' => 'Ett meddelande som nämner servrarna i stället för ett per server - när en schemalagd uppgift stannar blir alla servrar föråldrade på en gång, och fyrtio separata meddelanden om en enda orsak är en kanal folk tystar. Av som standard: en panel som kopierar för hand i stället för efter ett schema skulle få höra det varje dag.',
    'backup_days' => 'Kalla en kopia föråldrad efter',
    'backup_days_helper' => 'Det är också vad sidan Säkerhetskopior använder. En server som kopieras varje vecka ska inte rapporteras efter åtta dagar.',
    'days' => 'dagar',

    'stock' => 'Paket som håller på att ta slut',
    'stock_helper' => 'Ett meddelande som nämner paketen i stället för ett per paket, och aldrig en påminnelse: att vara slutsåld är ett vanligt tillstånd hos en butik snarare än ett avbrott, och att få höra om det var fjärde timme är hur det här slutar läsas. Bara paket med ett tak hålls ett öga på, så en butik som säljer allt utan gräns kostar ingenting att bevaka. Av som standard, precis som resten.',
    'stock_left' => 'Avisera när så här många är kvar',
    'stock_left_helper' => 'Räknat mot taket på paketet. Ett paket måste sjunka till det här talet för att aviseras, och stiga två steg över det för att räknas som friskt igen, så ett som en beställning och en avbokning knuffar fram och tillbaka säger ingenting. Noll är ett tal här, inte en frånvaro: det håller aviseringen tyst och lämnar bara kvar meddelandet om att ett paket är slut.',
    'stock_left_suffix' => 'kvar',

    'worker' => 'Queue worker',
    'worker_helper' => 'Om något alls utför det här pluginets bakgrundsarbete. Lägg märke till cirkeln: själva kontrollen körs på kön, så en panel som aldrig har haft en worker kan inte anmäla det. Raden högst upp på den här sidan kan.',

    // ---- knapparna ---------------------------------------------------------
    'save' => 'Spara',
    'saved' => 'Sparat',
    'save_failed' => 'Ingenting sparades',

    'test' => 'Skicka ett prov',
    'test_one' => 'Prova',
    'test_off' => 'Den kanalen är av',
    'test_off_body' => 'Slå på den och spara, så provas den tillsammans med resten.',
    'test_title' => 'Provmeddelande',
    'test_body' => 'Läser du det här kommer aviseringar från din Pelican-panel hit. Det är ingenting fel.',
    'test_sent' => 'Skickat till varje kanal som är på',
    'test_failed' => 'Minst en kanal nekade det',
    'test_none' => 'Det finns ingenstans att skicka',
    'test_none_body' => 'Ingen kanal är på, så en riktig avisering skulle inte heller komma någonstans.',

    /*
     * Vad man gör med ett nekande.
     *
     * En leverantörs egen motivering är kort och korrekt och ensam värdelös. De
     * två som dyker upp nästan varje gång nämns vid namn, för ingen av dem går
     * att gissa ur koden: en 553 handlar om avsändaren och inte om mottagaren,
     * och en 401 från Discord är en URL som är återkallad eller feltryckt.
     */
    'hint_email_sender' => 'Din SMTP-server nekade den adress panelen skickar från, inte den det skickade till. Under Admin → Inställningar → E-post måste Från-adressen vara en brevlåda ditt SMTP-konto får skicka som. Det har ingenting med det här pluginet att göra - Pelicans eget provmejl på den sidan går fel på precis samma sätt.',
    'hint_email' => 'Se under Admin → Inställningar → E-post. Knappen för provmejl på den sidan använder samma inställningar och säger samma sak.',
    'hint_discord_url' => 'Discord kände inte igen den webhooken. Den är borttagen, gjord på nytt, eller inklistrad utan alltihop - gör en ny under Serverinställningar → Integrationer → Webhooks, och kopiera hela URL:en.',
    'hint_discord' => 'Panelen nådde inte Discord. Står den här panelen bakom en brandvägg som spärrar utgående förfrågningar kan den här kanalen inte fungera härifrån.',
    'hint_panel' => 'Ingen har behörighet till det här, eller så gick aviseringen inte att spara. Se under Roller.',

    'run_now' => 'Kör kontrollerna nu',
    'run_started' => 'Kontrollerar i bakgrunden',
    'run_failed' => 'Kontrollerna gick inte att sätta igång',

    'reset' => 'Glöm vad den vet',
    'reset_confirm' => 'Tömmer vad varje kontroll senast sade. Nästa runda lär sig från grunden och skickar ingenting, så ett problem som fortfarande pågår anmäls rundan därpå. Använd det här efter att du tagit en nod ur drift som vakthunden fortsätter tjata om.',
    'reset_done' => 'Tömt',

    // ---- själva meddelandena -----------------------------------------------
    'still' => 'Har pågått i :for.',
    'cleared_body' => 'Det hade stått så i :for.',

    'for_unknown' => 'en stund',
    'for_minutes' => ':count minuter',
    'for_hours' => ':count timmar',
    'for_days' => ':count dagar',

    'node_down' => ':node svarar inte',
    'node_down_body' => 'Panelen når inte daemonen på :node. Servrar på den kommer varken att starta, stoppa eller rapportera något förrän den är tillbaka.',
    'node_up' => ':node svarar igen',

    'node_disk' => ':node håller på att få slut på disk',
    'node_disk_body' => 'Disken på :node är :percent % full, över de :limit % du satt. Säkerhetskopior och serverinstallationer är det första som går fel när det här slår i taket.',
    'node_disk_over' => 'Disken på :node är under gränsen igen',

    'node_memory' => ':node håller på att få slut på minne',
    'node_memory_body' => 'Minnet på :node är :percent % använt, över de :limit % du satt. Servrar på den kan dödas av kärnan innan något alls anmäler ett problem.',
    'node_memory_over' => 'Minnet på :node är under gränsen igen',

    'node_maintenance' => ':node har varit på underhåll länge',
    'node_maintenance_body' => ':node har varit på underhåll i mer än :hours timmar. Under tiden kontrolleras ingenting annat på den, och det är hela poängen - men det är värt att veta att den fortfarande står så.',
    'node_maintenance_over' => ':node är ur underhåll',

    'wings_behind' => 'Wings på :node är föråldrad',
    'wings_behind_body' => ':node kör Wings :installed, och :latest finns ute. Uppdatera den på själva noden - panelen har inget sätt att göra det.',
    'wings_current' => 'Wings på :node är aktuell',

    'panel_behind' => 'Panelen är föråldrad',
    'panel_behind_body' => 'Den här panelen kör :installed, och :latest finns ute.',
    'panel_current' => 'Panelen är aktuell',

    'and_more' => 'och :count till',

    'owners' => 'Säg till folk när maskinen bakom deras egen server är nere',
    'owners_helper' => 'Den enda kontrollen här som skriver till någon annan än dig. Ägaren till varje server på en maskin som slutat svara får en avisering i panelen - klockan, aldrig ett mejl - och en när den kommer tillbaka. Aldrig en påminnelse däremellan: att upprepa det var femtonde minut till alla på en upptagen nod är hur en panels aviseringar slutar läsas. Subusers får inte veta något; det är ägaren som avgör vad som ska göras. Maskinen nämns inte för dem, av samma skäl som statussidan inte offentliggör den.',

    'owner_down' => '{1} En av dina servrar är nere|[2,*] :count av dina servrar är nere',
    'owner_down_body' => 'Maskinen de står på har slutat svara. Någon har fått veta. Berörda: :servers',
    'owner_up' => '{1} Din server är tillbaka|[2,*] :count av dina servrar är tillbaka',
    'owner_up_body' => 'Maskinen svarar igen. Tillbaka: :servers',

    'schedules' => 'Schemalagda uppgifter som har stannat',
    'schedules_helper' => 'En uppgift som sitter fast mitt i en körning, en vars tid gick för att cron inte kör, eller en som aldrig har körts. Pelican har inget ord för någon av dem - en körning som föll står kvar som «behandlar» för alltid och ritas precis som en som kör nu. Läser varenda aktiv schemalagd uppgift på panelen varje gång den kontrollerar.',

    'schedule_stopped' => ':count schemalagda uppgifter har stannat',
    'schedule_stopped_body' => 'Fast i över :hours timmar, försenade, eller aldrig körda: :schedules',
    'schedule_running' => 'Alla schemalagda uppgifter kör igen',

    'stock_out' => '{1} Ett paket är slutsålt|[2,*] :count paket är slutsålda',
    'stock_out_body' => 'Fortfarande till salu, och det finns ingenting kvar att sälja: :packages',
    'stock_low' => '{1} Ett paket är nästan slutsålt|[2,*] :count paket är nästan slutsålda',
    'stock_low_body' => ':limit eller färre kvar: :packages',
    'stock_back' => '{1} Ett paket är till salu igen|[2,*] :count paket är till salu igen',
    'stock_back_body' => 'Det finns något att sälja igen: :packages',

    'backup_none' => ':count servrar har aldrig haft en säkerhetskopia',
    'backup_none_body' => 'Ingen kopia har någonsin tagits på: :servers',
    'backup_none_over' => 'Varje server har nu en kopia',

    'backup_stale' => ':count servrar har inte haft en kopia på ett tag',
    'backup_stale_body' => 'Ingen lyckad kopia på :days dagar på: :servers',
    'backup_stale_over' => 'Varje server har haft en kopia nyligen',

    'backup_failed' => 'Säkerhetskopior går fel på :count servrar',
    'backup_failed_body' => 'En kopia slutade utan framgång på: :servers',
    'backup_failed_over' => 'Inga säkerhetskopior går fel längre',

    'worker_missing' => 'Det finns ingenting som arbetar på kön',
    'worker_missing_body' => 'Ett jobb köades, och ingenting tog det. Plugin-uppdateringar, modpack-installationer och de här kontrollerna stannar alla upp tills en worker kör - prova systemctl status pelican-queue på panelens maskin.',
    'worker_back' => 'Det arbetas på kön igen',
    'failed_title' => ':count jobb har misslyckats sedan förra kontrollen',
    'failed_body' => 'Något panelen blivit tillsagd att göra blev inte gjort, och provas inte igen - en server som inte byggdes, en faktura som inte skrevs, ett mejl som inte skickades. De ligger i tabellen failed_jobs; `php artisan queue:retry all` lägger tillbaka dem, när det som stoppade dem är åtgärdat.',
    'failed_back' => 'Ingenting har misslyckats sedan förra kontrollen',
    'failed' => 'Säg till när ett köat jobb misslyckas',
    'failed_helper' => 'Laravel antecknar ett jobb det gett upp och säger ingenting om det. Det här säger något. Räknade i stället för uppräknade: tjugo fel på en natt har oftast en enda orsak.',
];
