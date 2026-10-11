<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Egg», «nod», «subuser», «Wings», «queue», «webhook», «topbar», «cron» och
 * filformatens namn står kvar som de är: det är under de namnen man hittar dem
 * i Pelican, på värden och i allt som skrivs om dem. Stilarnas namn översätts
 * inte heller - en stil heter vad den heter, och ett översatt namn vore ännu
 * ett namn på samma sak.
 */

return [
    'shrunk' => 'En bild har gjorts mindre',
    'shrunk_body' => ':name kom in på :was och ritas långt mindre än så, därför sparades en kopia på :now i stället. Den du valde är orörd på din egen maskin.',

    'css_warning' => 'Sparat, men den här CSS:en ser fel ut',
    'css_unclosed' => 'En regel som öppnas på rad :line stängs aldrig. Allt efter den ligger inne i den regeln och får ingen verkan.',
    'css_extra' => 'Det står en stängande klammer på rad :line utan att något är öppet. Allt efter den ligger utanför varje regel och hoppas över.',
    'css_comment' => 'En kommentar som öppnas på rad :line stängs aldrig, så resten av filen ligger inne i den.',

    'modules' => [
        'appearance' => 'Hur panelen ser ut',
        'appearance_helper' => 'Färger, form, inloggningsskärmen, meddelanden, dina egna länkar i sidopanelen och sidorna för att ändra det. Det är därför de flesta paneler hämtar det här tillägget, och det kostar ingenting någon kan mäta.',

        'servers' => 'På en server',
        'servers_helper' => 'Det som dyker upp inuti en server eller bredvid den i listan: kopiering, en stjärna, konsolknappen, säkerhetskopievarningen, illustrationer och sidorna för Minecraft, Palworld, ARK och Valheim.',

        'panel' => 'Att hålla panelen igång',
        'panel_helper' => 'Vad som är fullt, vad som har stannat och vad som har hänt. Blocket på översikten, systemstatussidan, översikterna över säkerhetskopior och scheman, kapaciteten och aktivitetsloggen.',

        'alerts' => 'Att säga till någon',
        'alerts_helper' => 'En vakthund som rapporterar en nod som slutat svara, en disk som fylls, en kö som står still, ett paket som är slutsålt. Den skickar till Discord, till e-post, till panelen eller till en adress du väljer själv, och den går på en timer vare sig någon tittar eller inte.',

        'support' => 'Att svara kunder',
        'support_helper' => 'En ärendedisk, i panelen eller via Modora på Discord. Den sätter en hjälpknapp på varje sida och en tabell som någon måste hålla ett öga på.',

        'shop' => 'Att sälja det du kör',
        'shop_helper' => 'Paket, en varukorg, fakturor, tre betalleverantörer, förnyelser, avstängning, tillgodohavande, uppgraderingar, tillval och en väntelista. Den skapar sina egna tabeller och den tar emot pengar, så den är av tills du säger något annat.',

        'outside' => 'Nåbar utifrån',
        'outside_helper' => 'Ett API med nycklar, offentliga statussidor som vem som helst öppnar utan att logga in, och filer som ligger på ett CDN eller i en bucket i stället för på den här maskinen. Var och en är en dörr; av tills du själv vill öppna en.',
    ],

    'cost' => [
        'page' => 'Arbetar på varje sida',
        'timer' => 'Går på en timer',
        'opened' => 'Bara när du öppnar den',
    ],

    'waiting' => [
        'eggs' => 'På, och visar ingenting: ange först vilka eggs det gäller.',
        'styles' => 'På, och visar ingenting: ingen kan välja en egen stil förrän du erbjuder några.',
        'store' => 'På, och sparar filer på den här maskinen. Peka på ett CDN eller en bucket för att ändra det.',
        'shown' => 'På och svarar 404: välj de servrar, noder eller övervakningar den ska visa.',
        'granted' => 'På, och ger ingen åtkomst: ingen når en server den vägen förrän en roll har kopplats till en server.',
    ],

    'needs' => 'Behöver :names, som är av.',
    'lessens' => 'Gör mindre utan :names, som är av.',

    'groups' => [
        'appearance' => 'Utseende',
        'servers' => 'Serverlista',
        'windows' => 'Stilar efter tid',
        'windows_helper' => 'En annan stil mellan två tidpunkter på dygnet. Ingenting händer förrän du lägger in en. Klockan är panelens egen, ur dess tidszonsinställning, och inte varje läsares - en panel som såg olika ut för två människor i samma ögonblick skulle likna något trasigt snarare än något planerat. Ett fönster ändrar det utseende panelen redan har, så det gör ingenting medan stilen står på «Ingen». En stil någon har valt åt sig själv vinner fortfarande över det.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'dontstarve' => 'Don\'t Starve Together',
        'enshrouded' => 'Enshrouded',
        'factorio' => 'Factorio',
        'satisfactory' => 'Satisfactory',
        'terraria' => 'Terraria',
        'vrising' => 'V Rising',
        'onset' => 'Onset',
        'craftopia' => 'Craftopia',
        'valheim' => 'Valheim',
        'languages' => 'Språk',
        'files_where' => 'Var filer sparas',
        'files_bucket' => 'Bucketen',
        'files_cdn' => 'CDN:et',
        'files_mirror' => 'Språk, sparade utanför panelen',
        'servers_helper' => 'Hur ett serverkort ritas. Om de visas som rutnät eller lista är var och ens eget val, under Konto → Översiktens layout.',
        'server_pages' => 'Serversidor',
        'server_pages_helper' => 'Vad varje sida inne i en server bär, vilken sida det än är.',
        'console' => 'Konsolsidan',
        'console_helper' => 'Terminalens egen font, storlek och höjd är var och ens eget val, under Konto.',
        'background' => 'Bakgrund',
        'background_helper' => 'Gäller hela panelen, även inloggningsskärmen.',
        'icons' => 'Ikoner',
        'bars' => 'Resursmätare',
        'bars_helper' => 'Staplarna för processor, minne och disk på serverkorten.',
        'updates' => 'Uppdateringar',
        'updates_helper' => 'Den installerade versionen och uppdateringsstatusen som Essentials Auto Updater rapporterar när det tillägget är installerat.',
        'brand' => 'Varumärke',
        'login' => 'Inloggningsskärm',
        'login_helper' => 'Gäller skärmarna för inloggning, lösenordsåterställning och tvåfaktor.',
        'advanced' => 'Egen CSS',
        'advanced_helper' => 'Till allt inställningarna ovan inte täcker. Laddas efter allt annat, så den vinner.',
        'areas' => 'Per område',
        'areas_helper' => 'Allt ovan gäller överallt. Här kan du sätta ett område åt sidan; allt du lämnar tomt följer fortfarande den gemensamma inställningen.',
        'footer' => 'Sidofältets fot',
        'footer_helper' => 'Sidofältets nederkant, som Pelican lämnar tom. Allt här är av tills du fyller i det.',
        'features' => 'Vad det här pluginet lägger till',
        'features_helper' => 'Vilka delar av det här tillägget en panel erbjuder bestäms på modulsidan, där de är grupperade efter vad de är till för i stället för att stå i bokstavsordning - och där en strömbrytare kan säga att den är på och ännu inte visar något. Att stänga av något där tar bort det ur panelen och behåller inställningarna, så ingenting går förlorat på att prova.',
        'features_open' => 'Öppna moduler',
        'identity' => 'Det här pluginet i sidofältet',
        'identity_helper' => 'Den rad det här pluginet lägger till i sidofältet, och bilden på den.',
    ],

    /*
     * Inställningssidorna, var och en en rad i pluginets egen grupp i
     * sidofältet. Grupperade efter den fråga man svarar på snarare än efter
     * vilken klass som gör dem.
     */
    /*
     * Var filerna det här pluginet sparar hamnar.
     *
     * Orden handlar om ett mål snarare än om en leverantör, för samma tre
     * meningar är sanna om en bucket och om ett CDN, och den som ställer in ett
     * bryr sig inte om vilket av dem han tittar på förrän fälten skiljer sig åt.
     */
    'files' => [
        'where' => 'Filer sparas',
        'where_helper' => 'På panelen ligger de på dess egen disk, vilket är dit de alltid har gått och inte kräver något uppsatt. Någon annanstans är någonstans den här panelen inte behöver hålla dem, och serveras närmare den som tittar. Ett mål som inte svarar faller tillbaka på panelen i stället för att tappa bort en uppladdning.',
        'panel' => 'På den här panelen',
        's3' => 'I en bucket (S3, R2, MinIO, Wasabi)',
        'cdn' => 'På ett CDN',
        'read_from' => 'Läs från',
        'read_from_helper' => 'Var en fil hämtas ifrån, vilket inte alltid är där den skrevs. Ett CDN framför en bucket hör hemma här, och likaså en leveransadress som skiljer sig från den API:et ligger på. Tomt låter målet räkna ut det själv.',
        'read_from_https' => 'Börja den här med https:// eller lämna den tom. En adress utan läses som en sökväg på den här panelen, så där skulle aldrig något gå att hitta.',

        'bucket' => 'Bucketen',
        'bucket_helper' => 'Allt som talar S3-protokollet. Endpointen och brytaren för path-style är vad de som inte är AWS behöver; lämna båda i fred för AWS självt.',
        'bucket_key' => 'Access key',
        'bucket_secret' => 'Secret',
        'bucket_name' => 'Bucketnamn',
        'bucket_region' => 'Region',
        'bucket_region_helper' => 'auto passar R2 och de flesta som körs i egen regi. AWS vill ha sin egen, som eu-central-1.',
        'bucket_endpoint' => 'Endpoint',
        'bucket_endpoint_helper' => 'Lämna tom för AWS. R2, MinIO och resten har var sin egen.',
        'bucket_path_style' => 'Adresser i path-style',
        'bucket_path_style_helper' => 'Vad MinIO och de flesta som körs i egen regi behöver. AWS och R2 gör inte det.',

        'cdn_title' => 'CDN:et',
        'cdn_helper' => 'Ett CDN som talar Modoras API. Token är av server-till-server-slaget och är full administratör på det kontot, så den hålls utanför en exporterad inställningsfil på samma sätt som varje annan hemlighet här.',
        'cdn_base' => 'Adress',
        'cdn_base_helper' => 'Var API:et ligger. Serveras filerna från någon annanstans, skriv in den adressen i «Läs från» ovan.',
        'cdn_token' => 'Token',
        'cdn_token_helper' => 'Skickas som X-Internal-Token. Den som har den kan skriva till och ta bort från hela kontot.',
        'cdn_folder' => 'Mapp',
        'cdn_folder_helper' => 'En mapp under kontot att hålla den här panelens filer i, så att ett CDN kan betjäna flera paneler utan att de trampar på varandra.',

        'move' => 'Flytta det som fortfarande ligger på panelen',
        'move_confirm' => 'Sidofältets ikon, panelens bakgrund och inloggningens bakgrund kopieras till målet och deras adresser skrivs om. Kopiorna på den här panelen lämnas där de ligger, så ingenting går sönder om du ändrar dig. Bilder som laddas upp härifrån och framåt går till målet ändå; det här gäller bara dem som redan finns här.',
        'move_done' => 'Flyttat',
        'move_done_body' => 'Tittade på :looked, flyttade :moved, kunde inte flytta :failed.',
        'check' => 'Testa det här',
        'check_ok' => 'Det fungerar',
        'check_ok_body' => 'En fil skrevs, hämtades tillbaka över sin öppna adress och togs bort igen.',
        'check_bad' => 'Det fungerade inte',
        'check_panel' => 'Filer är inställda på att sparas på den här panelen, så det finns ingenting att testa.',
        'check_refused' => 'Målet nekade filen och sa ingenting om varför.',
        'check_unreadable' => 'Det tog emot filen, men den gick inte att läsa tillbaka från :url. Det är den adress en webbläsare kommer att använda, så en fil ingen kan hämta är en trasig bild senare. Kontrollera «Läs från», och att målet serverar filer öppet.',
        'bucket_missing' => 'Access key, secret och bucketnamn behövs alla innan det finns något att testa.',
        'cdn_missing' => 'Både adressen och token behövs innan det finns något att testa.',
        'cdn_shape' => 'Det tog emot filen och svarade sedan i en form den här panelen inte kunde hitta någon adress i. Det som sades var: :body',
        'mirror_minutes' => 'Leta efter ändrade språk var',
        'mirror_minutes_helper' => 'I minuter. Att leta är billigt: varje uppladdat språk läses, hashas och jämförs med det som senast skickades, så en vanlig runda skickar ingenting alls. Bara ett språk någon har ändrat går över tråden.',
        'mirror_now' => 'Kopiera språken nu',
        'mirror_done' => 'Språken kopierade',
        'mirror_done_body' => 'Tittade på :looked, skickade :sent, kunde inte skicka :failed.',
        'mirror_restore' => 'Återställ språken',
        'mirror_restore_confirm' => 'Det här skriver varje språk i kopian utanför panelen över det som finns på den här panelen. Det är hela poängen med den efter en uppgradering, och det finns inget sätt att ta bort ett installerat språk efteråt, så det är värt att vara säker.',
        'mirror_back' => 'Språken återställda',
        'mirror_back_body' => 'Hittade :found, lade tillbaka :put, kunde inte hämta :failed.',
    ],

    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Färg, form och vad panelen heter.',
        'pages' => 'Sidor',
        'pages_helper' => 'Serverlistan, sidorna inne i en server, och terminalen.',
        'advanced' => 'Avancerat',
        'advanced_helper' => 'De två nödutgångarna: din egen CSS, och inställningar som bara gäller ett område.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Vilka eggs som är Minecraft, och allt annat om det.',
        'games' => 'Andra spel',
        'games_helper' => 'Filerna som dessa spel håller bredvid sin värld, som formulär i stället för text. Vilka servrar som får en sida avgörs av egg-listan i varje sektion, så en sektion utan kryss är det spelet redan avstängt.',
        'languages' => 'Språk',
        'languages_helper' => 'Vilka språk det här pluginet svarar på.',
        'files' => 'Lagring och CDN',
        'files_helper' => 'Var filerna det här pluginet sparar hamnar, och adressen de läses från.',
    ],

    'features' => [
        'look' => 'Look-inställningar',
        'look_helper' => 'Raden i sidofältet för färg, form och varumärke.',
        'pages' => 'Sidinställningar',
        'pages_helper' => 'Raden i sidofältet för serverlistan, serversidorna och terminalen.',
        'advanced' => 'Avancerade inställningar',
        'advanced_helper' => 'Raden i sidofältet för din egen CSS och undantag per område.',
        'announcements' => 'Meddelanden',
        'announcements_helper' => 'Remsan över panelens överkant.',
        'nav_links' => 'Navigationslänkar',
        'nav_links_helper' => 'Egna rader i sidofältet.',
        'login' => 'Inloggningsskärm',
        'login_helper' => 'Inloggningsskärmens bild, meddelande och länkar.',
        'bars' => 'Resursmätare',
        'bars_helper' => 'De omfärgade staplarna för processor, minne och disk.',
        'dashboard_status' => 'Versionsrad',
        'dashboard_status_helper' => 'Överkanten av blocket på översikten: vilken version som är installerad, och om en väntar.',
        'dashboard_nodes' => 'Maskiner',
        'dashboard_nodes_helper' => 'Resten av blocket på översikten: den här panelen och varje nod, med vad var och en använder.',
        'system_status' => 'Sidan Systemstatus',
        'system_status_helper' => 'Sidan för maskinen panelen själv kör på.',
        'sidebar_footer' => 'Sidofältets fot',
        'sidebar_footer_helper' => 'Din textrad, panelens version och en länk, längst ner i sidofältet.',
        'console' => 'Konsolknapp',
        'console_helper' => 'Den svävande knappen inne i en server, med konsolen och strömknapparna på sig, som når noden direkt. Vilken form den tar står i serversidornas inställningar; det här avgör om den ritas alls.',
        'arranger' => 'Siduppställare',
        'arranger_helper' => 'Att dra blocken på en sida i den ordning någon vill ha dem. Den bär en egen behörighet under Roller, så det här avgör om panelen erbjuder den och behörigheten avgör åt vem.',
        'user_themes' => 'Stilar per person',
        'user_themes_helper' => 'Att låta var och en välja en stil bland dem du erbjuder, under Utseende i klientdelen. Vilka stilar som erbjuds står på Look-sidan; det här avgör om någon får frågan alls.',
        'api' => 'API',
        'api_helper' => 'En väg in utifrån panelen: en adress en Discord-bot eller ett eget skript kan fråga om det här pluginet vet - vilka som spelar, vilka servrar som saknar säkerhetskopia, om det får plats en till på en nod. Av registrerar ingen rutt alls i stället för en som nekar, vilket är mindre yta snarare än en artigare mängd av den. Alla som är inloggade får be om en nyckel som bara svarar för deras egna servrar; att ge en, neka en, återkalla en någon annan har och utfärda en som gäller hela panelen kräver alla behörigheten.',
        'languages' => 'Språk',
        'languages_helper' => 'Att svara var och en på det språk deras konto är satt till, där det här pluginet är översatt till det. Är det här av får alla engelska.',
        'files' => 'Lagring och CDN',
        'files_helper' => 'Att hålla det här pluginets filer någon annanstans än på panelen: en S3-bucket, eller ett CDN. Av betyder inte «inga filer» - det betyder panelens egen disk, vilket är dit de alltid har gått. Det här avgör om någon annan plats över huvud taget erbjuds. Ett mål som inte svarar faller tillbaka på panelen i stället för att tappa bort en uppladdning, och en adress som redan skrivits ner tas aldrig tillbaka: att ändra det här avgör vart nästa fil går, inte var den förra ligger.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'En Minecraft-flik i sidofältet, och en sida inne i varje Minecraft-server för att redigera dess server.properties som ett formulär. Vilka eggs som räknas är ditt att säga.',
        'palworld' => 'Palworld-inställningar',
        'palworld_helper' => 'En sida inne i en Palworld-server för att redigera dess världsinställningar. Den dyker inte upp på någon annan server, och aldrig medan den servern kör.',
        'settings_search' => 'Sök i inställningarna',
        'settings_search_helper' => 'Fältet ovanför de här formulären som smalnar av dem till de avsnitt som innehåller det du skriver.',
        'preview' => 'Levande förhandsvisning',
        'waitlist' => 'Väntelista',
        'waitlist_helper' => 'Att låta någon be om besked när ett slutsålt paket går att köpa igen. När lagret fylls på får alla som väntar på det paketet veta det samtidigt, och det går till den som köper först - ingenting hålls åt någon, och varje meddelande säger det. Att få besked tar bort dem från listan, så en fråga köper ett meddelande och aldrig en stående prenumeration. Den behöver butiken, och den är det enda i butiken som skriver till en kund som inte har köpt något.',
        'preview_helper' => 'Rutan bredvid Look-formuläret som visar vad färger, hörn och avstånd gör innan du sparar dem.',
        'duplicate' => 'Duplicera server',
        'duplicate_helper' => 'En sida för att sätta upp ännu en server precis som en du redan har, eller flera på en gång. Filer kopieras aldrig.',
        'favourites' => 'Stjärnmärkta servrar',
        'favourites_helper' => 'En stjärna på varje serverkort. De märkta kommer först, och var och ens lista ligger på panelen - så stjärnorna följer med till nästa ställe man loggar in. Det ändrar vad man själv ser, och ingenting för andra. Att den ligger på panelen betyder visserligen att det är en fil under storage, som alla med åtkomst till maskinen kan läsa.',
        'artwork' => 'Egg-bilder',
        'artwork_helper' => 'Administratörssidan som hämtar varje eggs bild från Steam eller IGDB och skriver in den i själva egget.',
        'alerts' => 'Aviseringar',
        'alerts_helper' => 'Kontrollen med jämna mellanrum efter en nod som slutat svara, en disk som fylls, en queue worker som är död, eller en version som ligger efter - och det Discord-, panel- eller e-postmeddelande den skickar.',
        'backups' => 'Översikt över säkerhetskopior',
        'backups_helper' => 'Administratörssidan som listar varenda server efter hur länge den varit utan en kopia. Endast läsning.',
        'public_status' => 'Offentlig statussida',
        'public_status_helper' => 'Sidan vem som helst kan öppna utan ett konto. Är den av svarar adressen 404 oavsett vad som står på listan.',
        'game_players' => 'Spelare, andra spel',
        'game_players_helper' => 'En sida inne i Rust, ARK, Valheim och allt annat som svarar på Valves fråga, som visar vilka som är anslutna och hur länge de varit inne.',
        'owner_alerts' => 'Säg till folk att deras server är nere',
        'owner_alerts_helper' => 'Den enda delen av det här pluginet som skriver till folk som inte är administratörer: en avisering i panelen när maskinen bakom en av deras servrar slutar svara, och en när den kommer tillbaka. Klockan, aldrig ett mejl, och aldrig en påminnelse däremellan - att upprepa den var kvart till alla på en upptagen nod är precis så aviseringarna i en panel slutar bli lästa. Subusers får inte besked, för det är ägaren som bestämmer vad som ska göras, och maskinen nämns inte för dem av samma skäl som statussidan inte publicerar den. Av tills den slås på, som resten.',
        'my_backups' => 'Varning om kopior på serverlistan',
        'my_backups_helper' => 'En rad ovanför var och ens egen serverlista när en av deras aldrig har haft en kopia eller inte har haft en på ett tag. Pelicans kort säger vad en server gör nu; ingenting där säger att en kopia inte har körts på tre veckor. Ritas bara när något ligger efter, och den nämner ingen server personen inte redan kunde öppna.',
        'capacity' => 'Kapacitetsöversikt',
        'capacity_helper' => 'Administratörssidan som visar minne, disk och processor utlovat mot tillgängligt på varje maskin, tillsammans med de servrar som fått slut på kopior, databaser eller allokeringar. Utlovat i stället för använt - en nod kan vara upptagen och tom, eller tyst och full.',
        'schedules' => 'Översikt över schemalagda uppgifter',
        'schedules_helper' => 'Administratörssidan som listar varenda schemalagd uppgift tvärs över panelen, de värsta först - fast, försenade, eller aldrig körda. Endast läsning; allt som ändrar eller kör en stannar på Pelicans egen sida för den servern.',
        'activity' => 'Panelens aktivitet',
        'activity_helper' => 'Administratörssidan som listar varenda loggad händelse tvärs över panelen, den senaste först, med vem som gjorde det och på vilken server. Endast läsning - den tar inte bort något, och Pelicans egen inställning avgör fortfarande hur länge rader ligger kvar.',
        'access' => 'Serveråtkomst per roll',
        'access_helper' => 'En sida för att knyta en roll till servrar, hållen sann i Pelicans egen subuser-tabell. Den ger ingenting förrän du kopplar ihop något. Att stänga av den stoppar avstämningen; åtkomst som redan getts står kvar, och sidan har en knapp för att ta tillbaka den.',
        'scheduled' => 'Stilar efter tid',
        'scheduled_helper' => 'Avsnittet på Look-sidan som ger panelen en annan stil mellan två tidpunkter på dygnet. Det ändrar ingenting av det som är sparat - ett fönster läggs över inställningarna medan sidan ritas och släpps direkt efteråt - så att stänga av det ger tillbaka panelens eget utseende omedelbart och tappar ingenting.',
        'games' => 'Andra spel',
        'games_helper' => 'Konfigurationsfilen som vart och ett av dessa spel håller, som formulär i stället för som fil i filhanteraren. Vilka servrar som får en avgörs av egg-listan på sidan Andra spel.',
        'quick' => 'Menyn «Gå till»',
        'quick_helper' => 'En post högst upp på varje sida för att hoppa till en server eller en stjärnmärkt sida, med ett sökfält över hela din serverlista. Den markerar också den sida du står på. Det någon hittar genom den är det de redan kunde nå, så den ger ingenting - att stänga av den tar bort genvägen och Favoriter-sidan med den.',
        'shop' => 'Butik',
        'shop_helper' => 'Att sälja servrar från panelen: butiken och kassan i kundområdet, varje persons faktureringssida och sidan Butiksinställningar för valuta, moms och texter. Huvudbrytaren - avstängd kan ingen köpa eller betala, och det som redan sålts administreras fortfarande via sidorna nedan.',
        'packages' => 'Paket',
        'packages_helper' => 'Administrationssidan där det som är till salu definieras: en servermall med ett pris, en period och ett lager. Egen behörighet, eftersom att sätta priser är ett annat arbete än att markera fakturor som betalda.',
        'orders' => 'Beställningar',
        'orders_helper' => 'Administrationssidan med allt som köpts, servern varje beställning blev och dess status - väntar, aktiv, avstängd, avbruten. Egen behörighet.',
        'invoices' => 'Fakturor',
        'invoices_helper' => 'Administrationssidan med vad som är skyldigt och vad som betalats, med en knapp för att markera en faktura som betald för hand. Egen behörighet, eftersom den knappen är där pengar bokförs.',
        'payments' => 'Betalningar',
        'payments_helper' => 'Betalleverantörerna - deras nycklar och varje försök genom dem. Egen behörighet, eftersom det är där uppgifterna bor: den som får se varje faktura behöver inte se hemligheten.',
        'coupons' => 'Rabattkoder',
        'coupons_helper' => 'Koder som drar av en procentsats eller ett fast belopp från den första fakturan, med utgång och ett tak på antal användningar. Egen behörighet.',
        'customers' => 'Kunder',
        'customers_helper' => 'Administratörssidan som vänder på butiken: en rad per person som köpt, med vad de har, vad de betalat och vad som står kvar. Egen rättighet, för det är den enda sidan i butiken som handlar om en person i stället för om en rad - den som sätter priser behöver inte en kunds hela historia, och den som svarar på ett ärende gör det.',
        'credit' => 'Tillgodo och återbetalningar',
        'credit_helper' => 'Pengar butiken håller åt en kund. En återbetalning kan gå tillbaka till kortet den kom från eller stanna på kontot som tillgodo; i båda fallen skrivs en kreditfaktura, och tillgodo på ett konto dras från nästa faktura automatiskt innan kunden ens blir ombedd att betala. Egen rättighet, för att markera en faktura betald antecknar att pengar kommit in, och det här delar ut pengar.',
        'upgrades' => 'Uppgradera och nedgradera',
        'upgrades_helper' => 'Att flytta en aktiv tjänst till ett annat paket utan att köpa en ny. Det som är kvar av den redan betalda perioden kommer tillbaka, samma sträcka debiteras till det nya priset, och skillnaden faktureras eller läggs på kundens konto. Varje paket räknar upp vilka andra det får flyttas till, och bara de som delar dess egg erbjuds: ett annat egg är en annan server, inte en större.',
        'addons' => 'Tillägg',
        'addons_helper' => 'Sådant som säljs vid sidan av ett paket: mer minne, en säkerhetskopia till, eller något som bara är en rad på fakturan. Varje tillägg säger vilka paket det passar till och vad det lägger till på servern, och det debiteras antingen vid varje förnyelse eller en gång. Köps i kassan eller senare på en körande tjänst, där det räknas om efter vad som är kvar av perioden. Egen rättighet, för vad ett tillägg får lägga till på någons server är ett beslut om deras maskin snarare än om en prislista.',
        'tickets' => 'Ärenden',
        'tickets_helper' => 'Någonstans för kunder att ställa en fråga inifrån panelen, bredvid den tjänst de frågar om - vilket är det enda en chattkanal inte kan göra. Besvaras på en sida här, eller lämnas över till Discord genom Modora, vilket av dem Ärendesidan är inställd på. Varje fråga och varje svar sparas i den här panelen i båda fallen, så ingenting går förlorat när andra änden inte går att nå. Egen rättighet, för att svara kunder är ett jobb någon blir tilldelad snarare än ett som följer med att sätta priser på paket.',
        'overview' => 'Butiksöversikt',
        'overview_helper' => 'Sidan som svarar på vad som kommit in den här månaden, vad som är obetalt, vad de aktiva tjänsterna är värda varje månad och vad som behöver ses över i dag. Egen behörighet, för omsättningen är inte något alla som får prissätta ett paket ska kunna läsa.',
        'terminate' => 'Avsluta en tjänst',
        'terminate_helper' => 'Knappen som stoppar en tjänst nu och tar bort dess server, med filer och allt. Skild från behörigheten för beställningar med flit: att stänga av, flytta en förfallodag och avbryta går alla att ångra, och den här gör det inte. Den som svarar på ärenden kan få de tre första utan att få den här.',
        'public_shop' => 'Offentlig butikssida',
        'public_shop_helper' => 'Sidan som vem som helst kan öppna utan konto, med det som är till salu. Den publicerar inget som en inloggad kund inte skulle se i butiken, så på eller av är hela beslutet - av svarar 404, som statussidan.',
        'pelican_strings' => 'Pelicans egna texter',
        'pelican_strings_helper' => 'Pelicans egna sidor på ditt språk där Pelicans översättning tar slut. Översättningarna är gemenskapens och de flesta är ofärdiga; Essentials fyller bara i det som Pelican på den här panelen saknar, så varje text som Pelican har behåller Pelicans ord. Avstängt förblir resten av Pelican på engelska.',
        'log_clock' => 'Logg i servertid',
        'log_clock_helper' => 'Panelens logg skrivs i den tidszon som servern själv är inställd på, så att raderna stämmer med nginx och systemjournalen. Bara loggen ändras: Pelican lagrar fortfarande tider i UTC och visar varje konto dess egen zon. Avstängt förblir loggen i UTC, så som Pelican skriver den.',
    ],

    /*
     * Sökfältet ovanför inställningsformulären. Det filtrerar det som redan står
     * på sidan i webbläsaren och frågar servern om ingenting, så det finns inget
     * «söker»-tillstånd att beskriva och inget sätt det kan gå fel på.
     */
    /*
     * Förhandsvisningen. Allt i den är en ställföreträdare i stället för ett
     * prov på din panel, och ordvalet säger det - en ruta som nämnde en riktig
     * server eller en riktig siffra skulle läsas som en.
     */
    'preview' => [
        'label' => 'Förhandsvisning',
        'card' => 'Ett kort',
        'card_helper' => 'Ritat efter samma regler som panelen, med inställningarna på den här sidan i stället för de sparade.',
        'button' => 'En knapp',
        'field' => 'Ett fält',
        'meter_ok' => 'Bra',
        'meter_warning' => 'Varning',
        'meter_danger' => 'Fara',

        /*
         * Förhandsvisningen av hela sidan. En flik och inte en ruta, för
         * Pelican skickar X-Frame-Options: DENY och vägrar låta sig ramas in av
         * något alls, sig själv inräknat - se Support\FullPreview.
         */
        'full' => 'Se hela panelen',
        'full_confirm' => 'Öppnar panelen ritad ur inställningarna på den här sidan i stället för ur de sparade. Ingenting skrivs - värdena hålls i femton minuter, och panelen går tillbaka till det vanliga när du lämnar förhandsvisningen eller sparar.',
        'full_go' => 'Visa mig',
        'full_failed' => 'Förhandsvisningen gick inte att sätta igång',
        'bar' => 'Du tittar på inställningar som inte är sparade. Ingenting av det är skrivet.',
        'bar_back' => 'Tillbaka till inställningarna',
    ],

    'search' => [
        'placeholder' => 'Sök i inställningar',
        'label' => 'Sök i de här inställningarna',
        'none' => 'Ingenting på den här sidan passar. Inställningarna är fördelade på fyra sidor - prova Look, Sidor, Avancerat eller Essentials-inställningar.',
    ],

    'footer' => [
        'text' => 'Din egen rad',
        'text_helper' => 'Vanlig text, högst 120 tecken. Den escapas, precis som meddelanderemsan - det här ritas på varenda sida i panelen, vilket gör det till fel ställe att ta emot uppmärkning på.',
        'version' => 'Visa panelens version',
        'version_helper' => 'Pelicans version, inte det här pluginets. Pluginet säger sin egen på översikten; det folk letar efter längst ner i ett sidofält är vilken panel de tittar på.',
        'link_label' => 'Länktext',
        'link_url' => 'Länkadress',
        'link_url_helper' => 'En http- eller https-adress, eller en sökväg i panelen själv som /account. Öppnas i en ny flik.',
    ],

    'layout' => [
        'label' => 'Layout',
        'helper' => 'Hur panelen är uppställd, inte vilken färg den har. Gäller administrationsdelen, serverlistan och klientdelen lika. Var navigationen ligger är en standard: den som har satt en egen under Konto → Navigation behåller den.',
        'default' => 'Sidofält - Pelicans eget',
        'rail' => 'Ikonskena - smal, öppnas vid hover',
        'top' => 'Navigation högst upp - inget sidofält',
        'mixed' => 'Topbar och sidofält - båda',
        'wide' => 'Brett - innehållet använder hela skärmen',
        'focus' => 'Fokuserat - smal spalt, sidofältet fälls ihop',

        'nav_label' => 'Sidofältets stil',
        'nav_helper' => 'Hur själva sidofältet ritas.',
        'nav_default' => 'Standard',
        'nav_floating' => 'Svävande - ett eget kort',
        'nav_flat' => 'Platt - ingen bakgrund alls',
        'nav_bordered' => 'Med kant - ett streck, inte en yta',

        'topbar_label' => 'Topbarens stil',
        'topbar_helper' => '«Dold» gäller bara på dator - på en telefon bär topbaren den enda vägen tillbaka till menyn.',
        'topbar_default' => 'Standard',
        'topbar_floating' => 'Svävande - en fristående rad',
        'topbar_flush' => 'I liv - platt, utan oskärpa',
        'topbar_hidden' => 'Dold på dator',

        'card_label' => 'Kortstil',
        'card_helper' => 'Avsnitt, widgets, serverkort och blocken ovanför konsolen.',
        'card_default' => 'Standard - upphöjt med en mjuk kant',
        'card_flat' => 'Platt - utan lyft',
        'card_outline' => 'Kontur - en kant och ingenting bakom',
        'card_glass' => 'Frostat - bakgrunden lyser igenom',
        'card_sharp' => 'Skarpt - raka hörn',
    ],

    'servers' => [
        /*
         * Stjärnan på ett kort. Skickad vidare till skriptet i stället för
         * inskriven i det, så att texterna blir det enda ställe texter bor.
         */
        'favourite' => 'Stjärnmärk den här servern',
        'favourited' => 'Stjärnmärkt - visas först',

        /*
         * Pillret bredvid Pelicans egna flikar. Uppkallat efter vad det gör med
         * listan snarare än som en fjärde flik, för det filtrerar den flik som
         * är vald i stället för att ersätta den.
         */
        'favourites_tab' => 'Favoriter',
        'favourites_empty' => 'Ingenting är stjärnmärkt på den här sidan. Använd stjärnan på ett serverkort för att lägga till ett - och lägg märke till att det här filtrerar de servrar som redan står här: en stjärnmärkt server på en senare sida göms inte, den står bara inte på den här.',
        'favourites_failed' => 'Dina stjärnmärkta servrar kunde inte sparas, så de är satta tillbaka till det panelen senast hade. Webbläsarens konsol säger vad förfrågan svarade.',

        'art' => 'Spelbild',
        'art_helper' => 'Pelican ritar eggets bild på varje kort. Det här avgör vad som görs med den.',
        'art_faded' => 'Blekt - ett skimmer bakom texten',
        'art_cover' => 'Täckande - bakom namnet, tonar ut',
        'art_off' => 'Av',
        'art_dim' => 'Gör bilden mörkare',
        'art_dim_helper' => 'Ett spels bild är en ljus himmel, och ett annats är en grotta.',

        'status' => 'Tillståndsmärke',
        'status_helper' => 'Var färgen för kör/startar/stoppad visas.',
        'status_bar' => 'Stapel - längs vänsterkanten',
        'status_edge' => 'Kant - tvärs över överkanten',
        'status_dot' => 'Prick - i hörnet',
        'status_off' => 'Av',

        'density' => 'Korthöjd',
        'density_comfortable' => 'Luftig',
        'density_compact' => 'Kompakt - till många servrar',

        'filter_label' => 'Sätt text på filterknappen',
        'filter_label_helper' => 'Pelican filtrerar redan den här listan efter egg och efter ägare, tvärs över alla sidor - men vägen in är en ikon utan text bredvid sökfältet. Det här sätter ordet på.',
        'filter_button' => 'Filter',

        'columns' => 'Kort bredvid varandra på en bred skärm',
        'columns_helper' => 'Gäller bara rutnätet, och bara från 1280px och uppåt. Pelicans eget tak är två.',
    ],

    'controls' => [
        'mode' => 'Konsolknapp på varje serversida',
        'mode_helper' => 'En svävande knapp, på varenda sida inne i en server. Den öppnar konsolen ovanpå det du höll på med, med tillståndet och strömknapparna i sitt huvud - den når noden direkt, som serverlistan gör, i stället för genom konsolsidans websocket. Den dyker aldrig upp på konsolsidan, som redan har alltihop.',
        'mode_full' => 'Konsol och strömknappar',
        'mode_console' => 'Bara konsol',

        'label' => 'Knappen visar',
        'label_text' => 'Ikon och namn',
        'label_icon' => 'Bara ikon',

        'position' => 'Var den svävar',
        'position_helper' => 'Mot den kant du minst troligt läser.',
        'position_top' => 'Överkant',
        'position_right' => 'Höger',
        'position_bottom' => 'Nederkant',
    ],

    'console' => [
        'stats' => 'Block ovanför konsolen',
        'stats_helper' => 'Pelican visar namnet, tillståndet, adressen och de tre användningssiffrorna ovanför terminalen. Att dölja dem ger konsolen höjden tillbaka.',
        'stats_tiles' => 'Plattor - etikett, siffra och en ikon',
        'stats_plain' => 'Enkla - som Pelican ritar dem',
        'stats_off' => 'Dolda',
    ],

    'terminal' => [
        'helper' => 'Skickas vidare till terminalen själv, så de träder i kraft vid nästa sidladdning i stället för i det ögonblick de sparas.',

        'renderer' => 'Ritad av',
        'renderer_helper' => 'Pelican ritar terminalen på GPU:n, vilket är mycket snabbare vid en vägg av rullande utdata. En webbläsare håller bara ett visst antal GPU-kontexter vid liv åt gången - färre på en telefon - och tar bort den äldsta när gränsen passeras; terminalen ritar då ingenting alls, utan ett felmeddelande. Blir din konsol tom medan allt annat kring den ser rätt ut är det den här inställningen man ändrar.',
        'renderer_webgl' => 'GPU:n - Pelicans egen, snabbare',
        'renderer_dom' => 'Webbläsaren - långsammare, ritar alltid',

        'scheme' => 'Färgschema',
        'scheme_helper' => 'Den enda terminalinställning Pelican inte erbjuder. «Följ temat» härleder färgerna ur accenten, och det är därför det här finns över huvud taget.',
        'scheme_theme' => 'Följ temat',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Markör',
        'cursor_helper' => 'Konsolen tar inte emot tangenttryck - kommandofältet ligger under den - så det här är där utdatan stannade, inte där du är.',
        'cursor_underline' => 'Understreck - Pelicans eget',
        'cursor_block' => 'Block',
        'cursor_bar' => 'Streck',

        'blink' => 'Blinkande markör',

        'scrollback' => 'Rullhistorik',
        'scrollback_helper' => 'Hur långt tillbaka konsolen går att rulla. Varenda rad hålls i webbläsaren, så en pratsam server med en hög inställning är riktigt minne på den maskin som läser med.',
        'scrollback_lines' => ':lines rader',
    ],

    'notice' => [
        'text' => 'Meddelande',
        'text_helper' => 'En rad, upp till 200 tecken. Den escapas på vägen in och på vägen ut, så den kan inte bära uppmärkning in på en sida andra människor laddar.',
        'style' => 'Ton',
        'style_info' => 'Info',
        'style_warning' => 'Varning',
        'style_danger' => 'Brådskande',
        'style_accent' => 'Accentfärg',
        'scope' => 'Visas för',
        'scope_all' => 'Alla',
        'scope_client' => 'Bara utanför administrationsdelen',
        'scope_admin' => 'Bara i administrationsdelen',
        'link_label' => 'Knapptext',
        'link_url' => 'Knappadress',
        'link_url_helper' => 'https:// eller en sökväg inne i den här panelen, till exempel /account. Allt annat ignoreras - en länk i en remsa på varenda sida är inte en plats för ett upplägg ingen väntade sig.',
        'dismissible' => 'Går att stänga',
        'dismissible_helper' => 'Att den är stängd kommer ihågas per webbläsare, och bara för det här meddelandet: ändra texten så kommer det tillbaka till alla.',
        'dismiss' => 'Stäng',
    ],

    'preset' => [
        'label' => 'Stil',
        'helper' => 'Välj ett utseende att utgå från. Det fyller i allt nedan, som du sedan kan ändra. «Ingen» stänger av temat och lämnar panelen precis som Pelican levererar den.',
        'options' => [
            'none' => 'Ingen - inget tema',
            'legend' => 'Legend - röd eld över i blå blixt',
            'ember' => 'Ember - varm svart, orange accent',
            'midnight' => 'Midnight - djupblå, lugn',
            'crimson' => 'Crimson - röd, skarpa hörn, kompakt',
            'forest' => 'Forest - grön, rund, utan skimmer',
            'nebula' => 'Nebula - lila med en toning i bakgrunden',
            'terminal' => 'Terminal - grönt på svart, fast bredd, skarp',
            'console' => 'Console - rund och luftig, till en surfplatta',
            'nord' => 'Nord - Nord-paletten, dämpad',
            'solarized' => 'Solarized - Solarized dark, cyan accent',
            'paper' => 'Paper - ljus, hög kontrast, platt',
            'daylight' => 'Daylight - ljus och varm, med ett mjukt skimmer',
            'mono' => 'Mono - gråtoner, platt och tät',
        ],

        'save' => 'Spara som en stil',
        'save_confirm' => 'Behåller de färger, hörn, den bakgrund, font, de ikoner och mätargränser du har på skärmen just nu - under ett namn du själv väljer, i väljaren bredvid de inbyggda. Den sparar det som står på sidan, inte det som senast sparades.',
        'save_name' => 'Namn',
        'save_name_helper' => 'Vad den kommer att heta i väljaren. Att spara under ett namn du har använt förut ersätter det.',
        'saved' => 'Stilen sparad',
        'save_failed' => 'Den stilen gick inte att spara',
        'save_full' => 'Det får plats :max egna stilar. Ta bort en först.',

        'delete' => 'Ta bort en stil',
        'delete_which' => 'Vilken',
        'delete_confirm' => 'Bara dina egna stilar går att ta bort; de inbyggda gör det inte. Ingenting ändras i hur panelen ser ut just nu - en stil är en utgångspunkt, och varenda värde den satte står redan i inställningarna nedan.',
        'deleted' => 'Stilen borttagen',
        'deleted_current' => 'Det var den här panelen var satt till. Dess inställningar är oförändrade och står fortfarande på den här sidan - välj en stil, eller spara om dem under ett namn.',
    ],

    'user_themes' => [
        'label' => 'Stilar folk får välja själva',
        'helper' => 'De stilar som är ikryssade dyker upp på en Utseende-sida i klientdelen, där alla som är inloggade kan välja en åt sig själva. Det ändrar vad de själva ser, och ingenting för andra. Inga kryss betyder att ingen väljer något, och att panelen håller ett utseende - vilket är vad den gör nu.',
        'helper_off' => 'Ikryssade stilar dyker upp på en Utseende-sida i klientdelen, där alla som är inloggade kan välja en åt sig själva. Stilar per person är avstängda just nu, så ingen blir tillfrågad. Deras brytare finns på sidan Moduler, och det du kryssar i här sparas och börjar fungera igen så fort den är påslagen igen.',
    ],

    'mode' => [
        'label' => 'Paneltillstånd',
        'helper' => 'Vilket tillstånd panelen öppnar i. Den som inte har valt själv får det här; väljaren i användarmenyn låter dem fortfarande ändra det, om du inte låser det nedan.',
        'dark' => 'Mörkt',
        'light' => 'Ljust',
        'system' => 'System - följ besökarens egen inställning',
    ],

    'font' => [
        'label' => 'Panelens font',
        'helper' => 'Varje alternativ är en familj operativsystemet redan har - ingenting hämtas från en fontleverantör. Terminalen berörs inte: dess font är var och ens eget val, under Konto.',
        'default' => 'Standard - Pelicans egen',
        'mono' => 'Fast bredd',
        'rounded' => 'Rundad',
        'serif' => 'Serif',
        'system' => 'System - den här maskinens egen',
    ],

    'surface' => [
        'label' => 'Ytfärg',
        'helper' => 'Korten och panelerna. Ljusare och mörkare nyanser härleds ur den.',
        'placeholder' => 'Följ temat',
    ],

    'radius' => [
        'label' => 'Hörn',
    ],

    'accent' => [
        'label' => 'Accentfärg',
        'helper' => 'Används till knappar, länkar, den aktiva navigationspunkten och fokusringar.',

        /*
         * Sagt, inte framtvingat. En färg det här varnar för sparas ändå: det
         * är någons panel, siffran mäter en sak, och det finns goda skäl att
         * vilja ha en accent som får ett dåligt värde. Väljaren säger vad den
         * ser, och går åt sidan.
         */
        'contrast_dark' => 'Läsbarhet: :ratio mot en mörk panel. Under 3 är en accent svår att läsa som knapp eller länk - en ljusare lyfter den.',
        'contrast_light' => 'Läsbarhet: :ratio mot en ljus panel. Under 3 är en accent svår att läsa som knapp eller länk - en mörkare lyfter den.',
    ],
    'density' => [
        'label' => 'Täthet',
        'helper' => 'Kompakt drar ihop avstånden så att det får plats fler rader på skärmen.',
        'comfortable' => 'Luftig',
        'compact' => 'Kompakt',
    ],
    'force_dark' => [
        'label' => 'Tvinga mörkt läge',
        'helper' => 'Döljer väljaren mellan ljust och mörkt och håller varje användare på det mörka temat.',
    ],
    'glass' => [
        'label' => 'Frostad topbar',
        'helper' => 'Gör topbaren och bakgrunden bakom dialoger oskarp. Stäng av på svagare enheter.',
    ],
    'glow' => [
        'label' => 'Accentskimmer',
        'helper' => 'En mjuk accentskugga på de viktigaste knapparna, den aktiva navigationen och inloggningskortet.',
    ],

    'background' => [
        'label' => 'Bakgrundstyp',
        'helper' => 'Aurora är temats egen bakgrund: accentskimmer med en fin kornighet.',
        'aurora' => 'Aurora (standard)',
        'solid' => 'En färg',
        'gradient' => 'Toning',
        'image' => 'Bild',
        'color' => 'Färg',
        'base' => 'Färgen bakom skimret',
        'base_helper' => 'Det sidan vilar på innan accentskimret målas över den. Lämna tomt för att behålla panelens standard, som är nästan svart i mörkt och nästan vitt i ljust. Sätter du den behåller ett schema sin egen nattfärg och lyses ändå upp.',
        'color_end' => 'Andra färgen',
        'angle' => 'Riktning',
        'upload' => 'Ladda upp en bild',
        'upload_helper' => 'Upp till 8 MB. En uppladdad bild går före adressen nedan.',
        'url' => 'Eller en URL',
        'url_helper' => 'Måste börja med https:// och gå att nå utifrån.',
        'dim' => 'Dämpa',
        'dim_helper' => 'Utan dämpning är vit text på en ljus bild oläslig.',
        'blur' => 'Oskärpa',
    ],

    /*
     * The plugin's own page, under Updates. Only something to read: the
     * installed version, and what the Essentials Auto Updater reports when it
     * is installed.
     */
    'updates' => [
        'installed' => 'Installerad version',
        'state' => 'Uppdatering',
    ],

    /*
     * Språk-fliken.
     *
     * Försiktigt med vad den påstår. Pelican låter redan var och en välja ett
     * språk för hela sitt konto och använder det redan; ingenting här ändrar
     * det eller bör göra det. Det här avgör bara om det här pluginets egna
     * texter följer det valet.
     */
    'languages' => [
        'section_helper' => 'Pelican låter redan var och en välja ett språk för sitt konto, och det här pluginet följer det där det är översatt. Här avgör du vilka av dem det följer. De flesta språken står på en låg procent med flit: det som översätts först är den del alla ser på varenda sida - strömknapparna ovanför en konsol och nodmätarna - och resten kommer allteftersom folk bidrar med den.',
        'panel' => 'Låt det här avgöra språket i hela panelen',
        'panel_helper' => 'På sätter ett språk det här pluginet inte bär - eller ett som är avstängt nedan - hela panelen på engelska för den läsaren, inte bara de här sidorna. Av följer bara det här pluginet listan, och Pelican fortsätter tala det kontot är satt till, vilket betyder att en läsare kan möta två språk på en skärm. Inget konto ändras åt vare sig det ena eller andra hållet: slå på ett språk igen så har de det tillbaka.',
        'label' => 'Språk att svara på',
        'helper' => 'Att ta bort krysset skickar de läsare som har det satt på sitt konto tillbaka till engelska för det här pluginet ensamt - resten av panelen talar fortfarande deras språk. Engelska står inte med på listan, för allt faller tillbaka till det.',
        'under' => 'erbjuds inte förrän det kommit längre - kryssa i för att erbjuda det ändå',
        'done' => ':percent % översatt',
        'main' => 'Huvudspråk',
        'main_helper' => 'Det en läsare får när hans eget språk inte går att använda - antingen bär det här pluginet det inte, eller så är det inte ikryssat nedan. Det var alltid engelska; i ett lag som inte arbetar på engelska var det ett fel svar givet med säkerhet. Krysset går inte att ta bort nedan, för allt faller tillbaka till det.',
        'labels' => 'Vad varje språk heter',
        'labels_helper' => 'Namnet läsare och administratörer ser i väljarna. Lämna ett tomt för att behålla det namn det här pluginet känner det under. Ett språk som laddats upp under ett påhittat namn har inget, så det skulle stå med sin kod tills du ger det ett här.',
        'labels_code' => 'Kod',
        'labels_name' => 'Visas som',
        'remove' => 'Ta bort ett språk',
        'remove_which' => 'Vilket',
        'remove_which_helper' => 'Språk som någon har laddat upp, och de som det här tillägget bär med sig om någon har laddat upp rättelser ovanpå dem. För dem försvinner bara rättelserna.',
        'remove_confirm' => 'Det som laddades upp under det namnet försvinner: det här tilläggets texter, och panelens också där Pelican inte själv har språket. För ett språk som det här tillägget bär med sig är det bara rättelserna, och det tillägget levererar kommer tillbaka. Det går inte att ångra härifrån: den enda kopia som finns kvar är den som personen som gjorde den fortfarande har, och kopian utanför panelen glöms också bort, så en återställning hämtar inte tillbaka den.',
        'remove_refused' => 'Det språket blev kvar där det var',
        'remove_refused_bad_code' => 'Så kan ett språk inte heta.',
        'remove_refused_shipped' => 'Det här tillägget bär det språket självt och ingenting har laddats upp ovanpå det, så det finns ingenting att ta tillbaka.',
        'remove_refused_unknown' => 'Ingenting har någonsin laddats upp under det namnet.',
        'remove_refused_in_use' => 'Det är språket panelen faller tillbaka på. Välj ett annat huvudspråk först och ta bort det här sedan.',
        'remove_refused_stuck' => 'Filerna gick inte att få bort. Panelen kunde inte skriva i sin egen språkmapp.',
        'removed' => ':code har tagits bort',
        'removed_body' => 'Den som läste panelen på det läser den nu på huvudspråket.',
        'removed_shipped' => ':code är tillbaka till det som det här tillägget levererar',
        'download' => 'Ladda ner en översättningsfil',
        'download_from' => 'Utgå från',
        'download_from_helper' => 'En JSON med varenda text i det här pluginet. Välj engelska till ett språk ingen har börjat på, eller ett befintligt för att bygga vidare på det som redan är översatt.',
        'download_ready' => ':translated av :total texter var redan översatta. Resten kom ut på engelska, och det är de som är värda att arbeta med.',
        'code' => 'Språkkod',
        'code_helper' => 'Den kod filen gäller. En riktig locale, som konton använder dem - fr, de, pt_BR - når fram till de läsare som har den satt, och måste stämma exakt, annars gör den inte det. Ett påhittat namn, som Gaming-SV, är tillåtet och fungerar annorlunda: Pelican låter bara ett konto ha en riktig locale, så ingen kan välja ditt. Det går att nå som huvudspråket ovan, vilket är det alla får när deras eget inte går att använda.',
        'url' => 'Eller hämta den från en adress',
        'url_helper' => 'En https-adress panelen kan nå - ett CDN, en bucket, en rå fil i ett repository. Den hämtas en gång när du sparar och skrivs på samma sätt som en som laddas upp, så det gör ingenting att ändra filen på den adressen senare, förrän du sparar igen. En fil vald ovan vinner över en adress som blivit kvar i det här fältet.',
        'upload' => 'Ladda upp en översättningsfil',
        'upload_helper' => 'JSON-filen ovanifrån, med värdena översatta. Den skrivs utanför pluginet, så en uppdatering kastar inte bort den, och den läggs över engelska nyckel för nyckel - en fil med hälften av texterna ger dig ett halvt språk och engelska till resten.',
        'uploaded' => '{1} En text installerad för :code|[2,*] :count texter installerade för :code',
        'uploaded_halves' => ':mine av dem är det här pluginets egna texter, och :panel är panelens. Noll på den ena sidan betyder att den halvan av filen inte innehöll något - pluginets nycklar börjar med essentials:: och panelens gör det inte.',
        'uploaded_same' => '{1} Den andra sade redan det den här panelen säger, så den lämnades i fred.|[2,*] De andra :count sade redan det den här panelen säger, så de lämnades i fred.',
        'uploaded_skipped' => '{1} :count rad utelämnades:|[2,*] :count rader utelämnades:',
        'upload_failed' => 'Den filen gick inte att läsa',
        'upload_failed_body' => 'Det måste vara JSON-filen från nedladdningen ovan - ett platt objekt av nycklar och texter. Kontrollera att en editor inte har sparat den som något annat.',
    ],

    'windows' => [
        'add' => 'Lägg till ett fönster',
        'from' => 'Från',
        'to' => 'Till',
        'to_helper' => 'Tidigare än starten betyder att det går över midnatt - 22:00 till 06:00 är natten.',
        'preset' => 'Stil',
        'days' => 'Dagar',
        'days_helper' => 'Lämna alla utan kryss för varje dag. Ett fönster som går över midnatt hör till den dag det börjar på, så fredag 22:00 till 06:00 täcker lördag morgon.',
        'day_mon' => 'Måndag',
        'day_tue' => 'Tisdag',
        'day_wed' => 'Onsdag',
        'day_thu' => 'Torsdag',
        'day_fri' => 'Fredag',
        'day_sat' => 'Lördag',
        'day_sun' => 'Söndag',
    ],

    'arranger' => [
        'label' => 'Siduppställare',
        'helper' => 'Knappen «Ställ upp sidan», på varenda sida i panelen. Alla med behörigheten Ställ upp får den och kan också sätta den uppställning alla andra utgår från, eller en till en roll. Av döljer den för alla; uppställningar som redan är sparade blir kvar där de är.',
        'roles' => 'En uppställning är ingen behörighet. Ett block en roll döljer är fortfarande ett block någon kunde nå genom att skriva in adressen - det som stoppar det är Pelicans egna behörigheter, på rollsidan. Tre lager läggs på i den här ordningen: den alla utgår från, sedan läsarens roll, och sedan det de själva har flyttat.',
        'users' => 'Låt alla ställa upp sina egna sidor',
        'users_helper' => 'På låter alla som är inloggade flytta om och dölja block på de sidor de redan kan se, bara för sig själva - det ändrar ingenting för andra. Att sätta den uppställning alla utgår från stannar hos behörigheten Ställ upp.',

        'launch' => 'Ställ upp sidan',
        'hint' => 'Dra ett block i greppet, eller använd ögat för att dölja det.',
        'drag_to_move' => 'Dra för att flytta',
        'show_or_hide' => 'Visa eller dölj det här blocket',
        'save_layout' => 'Spara uppställning',
        'reset_page' => 'Återställ sidan',
        'done' => 'Klar',
        'saving' => 'Sparar…',
        'saved_own' => 'Sparat.',
        'saved_everyone' => 'Sparat för alla.',
        'saved_role' => 'Sparat för :role.',
        'save_failed' => 'Kunde inte spara - se konsolen.',
        'reset_done' => 'Återställt.',
        'scope_me' => 'Bara för mig',
        'scope_shared' => 'För alla',
        'scope_role' => 'För :role',
        'that_role' => 'den rollen',
        'editing_own' => 'Du redigerar din egen uppställning.',
        'editing_shared' => 'Du redigerar uppställningen alla utgår från.',
        'editing_role' => 'Du redigerar uppställningen för :role.',
    ],

    'brand' => [
        'logo_height' => 'Logotypens höjd',
        'logo_height_helper' => 'Pelican levererar 2rem. Större värden gör sidofältets huvud högre med.',
        'logo_url' => 'Byt ut logotypen',
        'logo_url_helper' => 'Lämna tomt för att behålla det Pelicans egna inställningar pekar på.',
    ],

    'login' => [
        'image' => 'Bakgrundsbild',
        'image_helper' => 'Bara till inloggningsskärmen. Utan en visar den fortfarande panelens bakgrund.',
        'url' => 'Eller en URL',
        'blur' => 'Oskärpa på kortet',
        'blur_helper' => 'Frostar kortet så att bilden bakom lyser igenom.',
        'width' => 'Kortets bredd',
        'position' => 'Bildens utsnitt',
        'position_helper' => 'Vilken del av bilden som överlever att beskäras till skärmen.',
        'position_center' => 'Mitten',
        'position_top' => 'Överkant',
        'position_bottom' => 'Nederkant',
        'position_left' => 'Vänster',
        'position_right' => 'Höger',
        'align' => 'Kortets placering',
        'align_helper' => 'Var inloggningskortet sitter tvärs över skärmen.',
        'align_center' => 'Mitten',
        'align_start' => 'Vänster',
        'align_end' => 'Höger',
        'opacity' => 'Kortets täckning',
        'opacity_helper' => 'Lägre släpper igenom mer av bilden genom kortet.',
        'glow' => 'Accentskimmer',
        'glow_helper' => 'Glorian runt kortet. Av behåller dess kant och djup.',
        'hide_heading' => 'Dölj rubriken',
        'hide_heading_helper' => 'Tar bort titeln ovanför formuläret och låter formuläret stå ensamt.',
        'hide_footer' => 'Dölj foten',
        'hide_footer_helper' => 'Tar bort raden under kortet som länkar till pelican.dev.',
        'above' => 'Rad ovanför formuläret',
        'above_helper' => 'En rad, visad för alla som kommer till inloggningsskärmen. Lämna tomt för ingen.',
        'notice' => 'Meddelande under kortet',
        'notice_helper' => 'En rad, visad för alla som kommer till inloggningsskärmen. Lämna tomt för ingen.',
        'register' => 'Låt folk skapa sitt eget konto',
        'register_helper' => 'Av, och den förblir av tills du slår på den härifrån: en uppdatering får aldrig öppna en panel för främlingar av sig själv. På får inloggningsskärmen en länk till ett registreringsformulär, och alla som når din panel kan skapa ett konto. De får inga servrar och inga behörigheter, så det de faktiskt kan göra är det du har gett folk utan roll - kontrollera det innan du öppnar det här. Slår du av den igen, slutar formuläret att finnas. Men det är inte den enda vägen in: se nedan.',
        'register_note' => 'Rad under registreringsformuläret',
        'register_note_helper' => 'En rad, för en regel eller för var man ber om åtkomst. Ren text, visad för dem som inte är inloggade. Lämna tomt för ingen.',
        'register_oauth' => 'Att logga in skapar också konton',
        'register_oauth_body' => 'Vad strömbrytaren ovan än säger kan de här redan skapa ett konto vid första inloggningen: :names. Det är Pelicans egen inställning, en per leverantör, under Settings, OAuth, och den heter «Auto Create Missing Users?». Stäng av den där om din panel var tänkt att vara stängd.',
    ],

    'advanced' => [
        'css' => 'Egen CSS',
        'css_helper' => 'Upp till 100 KB. Sparas i storage, inte i .env.',
        'reference' => 'CSS-referens',
        'reference_helper' => 'Varenda variabel och klass det här temat och panelen ställer fram.',
    ],

    'areas' => [
        'add' => 'Lägg till ett område',
        'area' => 'Område',
        'inherit' => 'Gemensam',
        'radius' => 'Hörn',
        'radius_sharp' => 'Skarpa',
        'radius_normal' => 'Normala',
        'radius_round' => 'Runda',
        'surface' => 'Ytfärg',
        'surface_helper' => 'Korten och panelerna inne i det här området; ljusare och mörkare nyanser härleds ur den.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsol (resten av sidan)',
            'files' => 'Filsidan',
            'edit' => 'Redigeringssidan',
            'server' => 'Andra serversidor och flikar',
        ],
    ],

    'bars' => [
        'base' => 'Grundfärg',
        'base_green' => 'Grön',
        'base_accent' => 'Accentfärg',
        'warning' => 'Bärnsten från',
        'danger' => 'Röd från',
    ],

    'icons' => [
        'stroke' => 'Strecktjocklek',
        'stroke_thin' => 'Tunn',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Fet',
        'scale' => 'Storlek',
        'accent' => 'Menyikoner i accentfärgen',
        'accent_helper' => 'Gäller ikonerna i sidofältet och i topbaren.',
        'pack' => 'Ikonpaket',
        'pack_helper' => 'Vilken uppsättning väljaren nedan hämtar ur. Varje ikonuppsättning som är installerad på servern erbjuds, plus Essentials-uppsättningen som följer med det här pluginet och varje paket du laddar upp. En skillnad är värd att känna till: en streckikon ritas i menyns färg och följer hover och den aktiva raden, medan Essentials-ikonerna är bilder och behåller sina egna färger i stället. Det avgörs av vad filen är, inte av vilken uppsättning den kom ur.',
        'pack_custom' => 'Uppladdat paket',
        'pack_shipped' => 'Essentials-ikoner',
        'use_shipped' => 'Använd Essentials-ikonerna överallt',
        'use_shipped_confirm' => 'Sätter paketet till Essentials-ikonerna och fyller varje menyrad nedan med den ikon som är ritad till den - konsolen får terminalen, start får startknappen, och så vidare. Det ersätter de rader du har nu, och ingenting sparas förrän du trycker Spara, så att stänga sidan ångrar det.',
        'pack_upload' => 'Ladda upp ett paket',
        'pack_upload_helper' => 'En .zip med SVG-filer. Varje fil blir en ikon uppkallad efter den - logo.svg blir custom-logo. Att ladda upp ersätter det paket som ligger där nu. Filer över 256 KB och allt över 4 000 ikoner utelämnas, och du får veta hur många: som måttstock är hela Tabler-uppsättningen nära sex tusen ikoner i ungefär tre megabyte, så ett paket som är mycket större bär något annat än ikoner, och det mesta av det hoppas över. En stor uppladdning kan också nekas innan det här fältet säger något alls, av upload_max_filesize och post_max_size i php.ini på panelens värd - ingen inställning här kan höja dem.',
        'pack_partial' => '{1} En ikon installerad, men inte alla|[2,*] :count ikoner installerade, men inte alla',
        'pack_partial_body' => 'Överhoppade: :big för stora för en ikon, :unusable inte användbara som SVG, :duplicate med ett namn som redan är taget, :empty blev utan något att rita när de hade rensats. En SVG över 256 KB är nästan alltid en bild inpackad i en snarare än en teckning - exportera den i ikonstorlek så blir den ett par kilobyte. En ikon som blir utan något att rita innehöll bara sådant det här inte serverar - är det ett helt paket är det värt att anmäla.',
        'pack_stopped_files' => 'Den stannade också vid gränsen för hur många ikoner ett paket får innehålla.',
        'pack_stopped_size' => 'Den stannade också för att resten av paketet vecklar ut sig till mer än panelen kan hålla i minnet på en gång - zip-filen kan vara mindre än så, eftersom SVG komprimerar ungefär fem till ett.',
        'overrides' => 'Byt ut ikoner',
        'overrides_helper' => 'En rad per ikon du vill ha ändrad. Välj menyposten, och välj sedan en ikon ur paketet ovan, ange en adress, eller ladda upp en egen bild. Är mer än ett ifyllt vinner uppladdningen, sedan adressen, sedan paketet.',
        'overrides_key' => 'Menypost',
        'overrides_value' => 'Ikon ur paketet',
        'overrides_url' => 'Eller en adress',
        'overrides_url_helper' => 'En https-adress till en bild du själv står värd för - ett CDN, en bucket, var som helst webbläsaren kan nå. Ingenting kopieras till panelen, så att byta ut filen på den adressen ändrar ikonen utan att röra den här sidan; baksidan är en ikon som försvinner när adressen gör det. Den behåller sina egna färger, som en uppladdad bild.',
        'overrides_file' => 'Eller ladda upp en bild',
        /*
         * Säger vad skillnaden faktiskt är, för den är inte självklar, och det
         * är skälet till att man väljer det ena framför det andra.
         */
        'overrides_file_helper' => 'PNG, SVG eller ICO. En ikon ur paketet ritas i menyns egen färg och följer hover och den aktiva raden; en uppladdad bild behåller sina egna färger och gör inte det. Till en logotyp är det oftast vad man vill ha.',
        'overrides_add' => 'Byt ut ännu en ikon',
        'overrides_search' => 'Skriv ett namn, eller menyposten…',
    ],

    /*
     * Inte under varumärke. Varumärke handlar om hur panelen ser ut; det här
     * handlar om hur det här pluginet visar sig i den, och det är en annan fråga
     * som besvaras på en annan sida.
     */
    'identity' => [
        'nav_icon' => 'Ikon till raden «Essentials-inställningar»',
        'nav_icon_helper' => 'PNG, SVG eller ICO, upp till 8 MB. Ersätter ikonen på just den ena raden i sidofältet; lämna tomt för den det här pluginet levereras med. Den ritas som en bild i stället för som en ikon, så den behåller sina egna färger i stället för att följa texten - vilket oftast är vad en logotyp vill. Filen serveras i stället för att bäddas in, så varje webbläsare hämtar den en gång, men det är ändå värt att exportera något litet: ett par kilobyte räcker gott till en rad på tjugo pixlar. Går en uppladdning fel innan det här fältet säger något är gränsen den slog i upload_max_filesize i panelens php.ini.',
    ],
];
