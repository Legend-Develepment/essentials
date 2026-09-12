<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Egg", „node", „subuser", „Wings", „queue", „webhook", „topbar", „cron" og
 * filformaternes navne bliver stående, som de er: det er under de navne, man
 * finder dem i Pelican selv, på værten og i alt, hvad der skrives om dem.
 * Stilenes navne bliver heller ikke oversat - en stil hedder det, den hedder, og
 * et oversat navn ville være endnu et navn for det samme.
 */

return [
    'css_warning' => 'Gemt, men denne CSS ser forkert ud',
    'css_unclosed' => 'En regel, der åbnes på linje :line, bliver aldrig lukket. Alt efter den står inde i den regel og får ingen virkning.',
    'css_extra' => 'Der står en lukkende tuborgklamme på linje :line, uden at noget er åbent. Alt efter den står uden for enhver regel og bliver sprunget over.',
    'css_comment' => 'En kommentar, der åbnes på linje :line, bliver aldrig lukket, så resten af filen står inde i den.',

    'groups' => [
        'appearance' => 'Udseende',
        'servers' => 'Serverliste',
        'windows' => 'Stile efter tidspunkt',
        'windows_helper' => 'En anden stil mellem to tidspunkter på dagen. Der sker ingenting, før du lægger et ind. Uret er panelets eget, fra dets tidszoneindstilling, og ikke hver enkelt læsers - et panel, der så forskelligt ud for to mennesker i samme øjeblik, ville ligne noget i stykker frem for noget planlagt. Et vindue ændrer det udseende, panelet allerede har, så det gør ingenting, mens stilen står på „Ingen". En stil, nogen har valgt til sig selv, vinder stadig over det.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Sprog',
        'files_where' => 'Hvor filerne ligger',
        'files_bucket' => 'Bucket',
        'files_cdn' => 'CDN',
        'files_mirror' => 'Sprog, holdt uden for panelet',
        'servers_helper' => 'Hvordan et serverkort tegnes. Om de vises som gitter eller liste er den enkeltes eget valg, under Konto → Oversigtens opsætning.',
        'server_pages' => 'Serversider',
        'server_pages_helper' => 'Hvad hver side inde i en server bærer, uanset hvilken side det er.',
        'console' => 'Konsolside',
        'console_helper' => 'Terminalens egen skrift, størrelse og højde er den enkeltes eget valg, under Konto.',
        'background' => 'Baggrund',
        'background_helper' => 'Gælder hele panelet, også login-skærmen.',
        'icons' => 'Ikoner',
        'bars' => 'Ressourcemålere',
        'bars_helper' => 'Bjælkerne for processor, hukommelse og disk på serverkortene.',
        'updates' => 'Opdateringer',
        'updates_helper' => 'Hvilke udgivelser Tema-siden byder frem, og hvor den leder efter dem.',
        'brand' => 'Brand',
        'login' => 'Login-skærm',
        'login_helper' => 'Gælder skærmene til login, nulstilling af adgangskode og to-faktor.',
        'advanced' => 'Egen CSS',
        'advanced_helper' => 'Til alt det, indstillingerne ovenfor ikke dækker. Indlæses efter alt andet, så den vinder.',
        'areas' => 'Pr. område',
        'areas_helper' => 'Alt ovenfor gælder overalt. Her kan du sætte ét område til side; alt, du lader stå tomt, følger fortsat den fælles indstilling.',
        'footer' => 'Sidebjælkens fod',
        'footer_helper' => 'Bunden af sidebjælken, som Pelican lader stå tom. Alt her er slået fra, indtil du udfylder det.',
        'features' => 'Hvad dette plugin lægger til',
        'features_helper' => 'Fjerner du hakket ved en ting, forsvinder den helt ud af panelet. Dens egne indstillinger bliver bevaret, og dens side beholder sin adresse, så der går intet tabt ved at slå noget fra for at se, hvad det gjorde. De fleste har også deres egen rettighed under Roller, så man kan udlevere én uden at udlevere resten. Ikke alle: ressourcemålerne, sidebjælkens fod og søgningen i indstillingerne tegnes for alle og styres af ingen, stjernen på et serverkort tilhører den, der klikkede på den, og Palworld- og Minecraft-siderne inde i en server følger den servers egne rettigheder frem for en af disse. Selve udseendet står ikke på listen - det har sin egen kontakt, under Look → Udseende → Stil → Ingen.',
        'identity' => 'Dette plugin i sidebjælken',
        'identity_helper' => 'Den række, dette plugin lægger til sidebjælken, og billedet på den.',
    ],

    /*
     * Indstillingssiderne, hver en række i pluginnets egen gruppe i
     * sidebjælken. Grupperet efter det spørgsmål, man svarer på, frem for efter,
     * hvilken klasse der laver dem.
     */
    /*
     * Hvor de filer, dette plugin holder, bliver lagt.
     *
     * Ordene handler om et mål frem for om en udbyder, for de samme tre
     * sætninger gælder både for en bucket og for et CDN, og den, der sætter et
     * af dem op, er ligeglad med, hvilket af dem han kigger på, indtil felterne
     * bliver forskellige.
     */
    'files' => [
        'where' => 'Filerne ligger',
        'where_helper' => 'På panelet ligger de på dets egen disk, og det er der, de altid er havnet, og det kræver ingen opsætning. Alt andet er et sted, dette panel ikke selv skal holde dem, og det bliver serveret tættere på den, der kigger. Et mål, der ikke svarer, falder tilbage til panelet frem for at miste en fil.',
        'panel' => 'På dette panel',
        's3' => 'I en bucket (S3, R2, MinIO, Wasabi)',
        'cdn' => 'På et CDN',
        'read_from' => 'Læses fra',
        'read_from_helper' => 'Hvor en fil hentes fra, og det er ikke altid der, hvor den blev skrevet. Et CDN foran en bucket står her, og det samme gør en leveringsadresse, der er en anden end den, API’et ligger på. Tom lader målet regne det ud selv.',

        'bucket' => 'Bucket',
        'bucket_helper' => 'Alt, der taler S3-protokollen. Endpoint og kontakten til stibaserede adresser er det, dem der ikke er AWS har brug for; lad begge stå for AWS selv.',
        'bucket_key' => 'Adgangsnøgle',
        'bucket_secret' => 'Hemmelighed',
        'bucket_name' => 'Bucket-navn',
        'bucket_region' => 'Region',
        'bucket_region_helper' => 'auto passer til R2 og de fleste, man selv står for. AWS vil have sin egen, som eu-central-1.',
        'bucket_endpoint' => 'Endpoint',
        'bucket_endpoint_helper' => 'Lad den stå tom for AWS. R2, MinIO og resten har hver deres.',
        'bucket_path_style' => 'Stibaserede adresser',
        'bucket_path_style_helper' => 'Det, MinIO og de fleste, man selv står for, har brug for. AWS og R2 har ikke.',

        'cdn_title' => 'CDN',
        'cdn_helper' => 'Et CDN, der taler Modoras API. Tokenet er et server-til-server-token, og det er fuld administrator på den konto, så det holdes uden for en eksporteret indstillingsfil, ligesom alt andet fortroligt her.',
        'cdn_base' => 'Adresse',
        'cdn_base_helper' => 'Hvor API’et ligger. Bliver filerne serveret et andet sted fra, så skriv den adresse i „Læses fra" ovenfor.',
        'cdn_token' => 'Token',
        'cdn_token_helper' => 'Sendes som X-Internal-Token. Enhver, der har det, kan skrive til og slette fra hele kontoen.',
        'cdn_folder' => 'Mappe',
        'cdn_folder_helper' => 'En mappe under kontoen til dette panels filer, så ét CDN kan betjene flere paneler, uden at de træder hinanden over tæerne.',

        'move' => 'Flyt det, der stadig ligger på panelet',
        'move_confirm' => 'Ikonet i sidebjælken, panelets baggrund og login-baggrunden bliver kopieret til målet, og deres adresser skrevet om. Kopierne på dette panel bliver liggende, hvor de er, så der går intet i stykker, hvis du fortryder. Billeder, der lægges op herfra og frem, ryger til målet under alle omstændigheder; det her gælder kun dem, der allerede ligger her.',
        'move_done' => 'Flyttet',
        'move_done_body' => 'Kiggede på :looked, flyttede :moved, kunne ikke flytte :failed.',
        'check' => 'Afprøv det',
        'check_ok' => 'Det virker',
        'check_ok_body' => 'En fil blev skrevet, hentet tilbage over sin offentlige adresse og fjernet igen.',
        'check_bad' => 'Det virkede ikke',
        'check_panel' => 'Filerne er sat til at ligge på dette panel, så der er ikke noget at afprøve.',
        'check_refused' => 'Målet afviste filen og sagde ikke noget om hvorfor.',
        'check_unreadable' => 'Den tog filen, men den kunne ikke læses tilbage fra :url. Det er den adresse, en browser vil bruge, så en fil, ingen kan hente, er et ødelagt billede senere. Tjek „Læses fra", og at målet serverer filer offentligt.',
        'bucket_missing' => 'Nøglen, hemmeligheden og bucket-navnet skal alle tre være der, før der er noget at afprøve.',
        'cdn_missing' => 'Adressen og tokenet skal begge være der, før der er noget at afprøve.',
        'cdn_shape' => 'Den tog imod filen og svarede så i en form, dette panel ikke kunne finde en adresse i. Den sagde: :body',
        'mirror_minutes' => 'Se efter ændrede sprog hvert',
        'mirror_minutes_helper' => 'I minutter. Det er billigt at kigge: hvert uploadet sprog bliver læst, hashet og sammenlignet med det, der sidst blev sendt, så en almindelig runde sender slet ingenting. Kun et sprog, nogen har ændret, går over ledningen.',
        'mirror_now' => 'Kopiér sprogene nu',
        'mirror_done' => 'Sprogene er kopieret',
        'mirror_done_body' => 'Kiggede på :looked, sendte :sent, kunne ikke sende :failed.',
        'mirror_restore' => 'Gendan sprogene',
        'mirror_restore_confirm' => 'Det her skriver hvert sprog i kopien uden for panelet hen over det, der ligger på dette panel. Det er netop meningen efter en opgradering, og der er ingen måde at fjerne et installeret sprog bagefter, så det er værd at være sikker.',
        'mirror_back' => 'Sprogene er gendannet',
        'mirror_back_body' => 'Fandt :found, lagde :put tilbage, kunne ikke hente :failed.',
    ],

    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Farve, form og hvad panelet hedder.',
        'pages' => 'Sider',
        'pages_helper' => 'Serverlisten, siderne inde i en server, og terminalen.',
        'advanced' => 'Avanceret',
        'advanced_helper' => 'De to nødudgange: din egen CSS, og indstillinger, der kun gælder ét område.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Hvilke eggs der er Minecraft, og alt andet om det.',
        'artwork' => 'Egg-billeder',
        'artwork_helper' => 'En side med hvert eneste egg, og en måde at hente spillets billede til det fra Steam eller IGDB. Den skriver i selve egg\'ene - billedet, og to mærkater, der noterer, hvilket spil det er, og om billedet blev valgt i hånden - og derfor bærer den sin egen rettighed.',
        'alerts' => 'Advarsler',
        'alerts_helper' => 'Et tjek med jævne mellemrum af det, panelet allerede måler, men ikke fortæller nogen: en node, der holder op med at svare, en disk, der fyldes, en queue worker, der er gået i stå, en version, der kommer bagud. Sender til Discord, til panelet eller på mail. Sin egen rettighed, for den når hver node med jævne mellemrum og sender til en adresse, nogen har tastet ind.',
        'backups' => 'Oversigt over sikkerhedskopier',
        'backups_helper' => 'En side med hver eneste server og hvor længe den har været uden en kopi, sorteret så dem uden nogen står øverst. Kun læsning - alt, der gør noget ved en kopi, bliver på Pelicans egen side for den server. Sin egen rettighed, for listen er et kort over, hvor hullerne er.',
        'public_status' => 'Offentlig statusside',
        'public_status_helper' => 'En side, hvem som helst kan åbne uden en konto, som viser, hvilke af dine servere der kører, og hvor mange der er på dem. Der offentliggøres intet, før du nævner en server, en maskine eller en tjeneste - alle tre lister starter tomme, og så længe de er det, svarer adressen 404. Sin egen rettighed, for den afgør, hvad der forlader panelet.',
        'game_players' => 'Spillere, andre spil',
        'capacity' => 'Kapacitet',
        'capacity_helper' => 'Hvad der er lovet væk på hver maskine over for, hvad den må dele ud, så du kan se, om der er plads til en server mere. Pelicans nodeliste viser et navn og et antal servere, og blokken Maskiner på oversigten viser, hvad der kører - det her er det tredje spørgsmål, og regnestykket er Pelicans eget. Kun læsning. Sin egen rettighed.',
        'schedules' => 'Planlagte opgaver',
        'schedules_helper' => 'Hver eneste planlagte opgave på panelet, med hvilke af dem der er gået i stå: hængt fast midt i en kørsel, forsinkede fordi cron ikke kører, eller aldrig kørt. Pelican viser planlagte opgaver inde i hver server, og dens egen tilstand har intet ord for nogen af de tilfælde. Kun læsning. Sin egen rettighed.',
        'activity' => 'Aktivitet',
        'activity_helper' => 'Hver eneste hændelse, panelet logger, i én liste frem for én server ad gangen. Pelican fører loggen og viser den pr. server; det her spørger den samme log den anden vej rundt. Kun læsning. Sin egen rettighed, for en optegnelse over, hvem der gjorde hvad, er noget, man udleverer med vilje.',
        'access' => 'Serveradgang',
        'access_helper' => 'Bind en rolle til servere, så alle med den kan nå dem. Det virker ved at holde Pelicans egne subusers ajour, og dem læser serverlisten og hver eneste rettighedskontrol allerede. Sin egen rettighed, for det er den ene side her, der giver folk adgang til noget.',
        'games' => 'Andre spil',
        'games_helper' => 'De filer, ARK og Valheim holder ved siden af deres verden, som formularer: ARKs verdensindstillinger, og Valheims lister over administratorer, bandlyste og tilladte. Hvilke servere der får dem, er egg-listen på den side, så en tom liste er allerede en kontakt pr. spil.',
        'game_players_helper' => 'En side inde i Rust, ARK, Valheim og alt andet, der svarer på Valves forespørgsel, som viser, hvem der er tilsluttet, og hvor længe de har været på. Kun læsning - hvad man kan gøre ved nogen er forskelligt fra spil til spil, og det er en udgivelse for sig. Hvilke eggs der tæller, er den samme liste, statussiden bruger.',
        'api' => 'API',
        'api_helper' => 'De nøgler, folk har, hvem der har bedt om en, og hvad hver af dem må se.',
        'languages' => 'Sprog',
        'languages_helper' => 'Hvilke sprog dette plugin svarer på.',
        'files' => 'Lagring og CDN',
        'files_helper' => 'Hvor de filer, dette plugin holder, bliver lagt, og den adresse, de læses fra.',
    ],

    'features' => [
        'look' => 'Look-indstillinger',
        'look_helper' => 'Rækken i sidebjælken til farve, form og brand.',
        'pages' => 'Sideindstillinger',
        'pages_helper' => 'Rækken i sidebjælken til serverlisten, serversiderne og terminalen.',
        'advanced' => 'Avancerede indstillinger',
        'advanced_helper' => 'Rækken i sidebjælken til din egen CSS og undtagelser pr. område.',
        'announcements' => 'Meddelelser',
        'announcements_helper' => 'Bjælken hen over toppen af panelet.',
        'nav_links' => 'Navigationslinks',
        'nav_links_helper' => 'Dine egne rækker i sidebjælken.',
        'login' => 'Login-skærm',
        'login_helper' => 'Login-skærmens billede, besked og links.',
        'bars' => 'Ressourcemålere',
        'bars_helper' => 'De omfarvede bjælker for processor, hukommelse og disk.',
        'dashboard_status' => 'Versionslinje',
        'dashboard_status_helper' => 'Toppen af blokken på oversigten: hvilken version der er installeret, og om en venter.',
        'dashboard_nodes' => 'Maskiner',
        'dashboard_nodes_helper' => 'Resten af blokken på oversigten: dette panel og hver node, med hvad hver af dem bruger.',
        'system_status' => 'Siden Systemstatus',
        'system_status_helper' => 'Siden for den maskine, panelet selv kører på.',
        'sidebar_footer' => 'Sidebjælkens fod',
        'sidebar_footer_helper' => 'Din tekstlinje, panelets version og ét link, nederst i sidebjælken.',
        'console' => 'Konsolknap',
        'console_helper' => 'Den svævende knap inde i en server, med konsollen og strømknapperne på sig, som når noden direkte. Hvilken form den har, står på sideindstillingerne; det her afgør, om den overhovedet bliver tegnet.',
        'arranger' => 'Sideopstiller',
        'arranger_helper' => 'At trække blokkene på en side i den rækkefølge, nogen vil have dem. Den har sin egen tilladelse under Roller, så det her afgør, om panelet tilbyder den, og tilladelsen afgør hvem.',
        'user_themes' => 'Stile til hver enkelt',
        'user_themes_helper' => 'At lade hver enkelt vælge en stil blandt dem, du tilbyder, under Udseende i klientdelen. Hvilke stile der tilbydes, står på Look-siden; det her afgør, om nogen overhovedet bliver spurgt.',
        'api' => 'API',
        'api_helper' => 'En vej ind udefra: en adresse, hvor en Discord-bot eller et script, du selv har skrevet, kan spørge om det, dette plugin ved - hvem der spiller, hvilke servere der ingen sikkerhedskopi har, om der er plads til en mere på en node. Fra registrerer slet ingen rute frem for en, der afviser, hvilket er mindre overflade frem for en høfligere mængde af den. Enhver, der er logget ind, må bede om en nøgle, der kun svarer for deres egne servere; at give en, at afvise en, at tilbagekalde en, en anden har, og at udstede en, der dækker hele panelet, kræver alle sammen rettigheden.',
        'languages' => 'Sprog',
        'languages_helper' => 'At svare hver enkelt på det sprog, deres egen konto er sat til, hvor dette plugin er oversat til det. Er det slået fra, får alle engelsk.',
        'files' => 'Lagring og CDN',
        'files_helper' => 'At holde dette plugins filer et andet sted end på panelet: en S3-bucket eller et CDN. Fra betyder ikke „ingen filer" - det betyder panelets egen disk, og det er der, de altid er havnet. Det, dette afgør, er, om der overhovedet bliver budt et andet sted frem. Et mål, der ikke svarer, falder tilbage til panelet frem for at miste en fil, og en adresse, der allerede er skrevet ned, bliver aldrig taget tilbage: at ændre dette afgør, hvor den næste fil havner, ikke hvor den sidste ligger.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'En Minecraft-fane i sidebjælken, og en side inde i hver Minecraft-server til at rette dens server.properties som en formular. Hvilke eggs der tæller, er dit at sige.',
        'palworld' => 'Palworld-indstillinger',
        'palworld_helper' => 'En side inde i en Palworld-server til at rette dens verdensindstillinger. Den dukker ikke op på nogen anden server, og aldrig mens den server kører.',
        'settings_search' => 'Søgning i indstillingerne',
        'settings_search_helper' => 'Feltet over disse formularer, der snævrer dem ind til de afsnit, der rummer det, du skriver.',
        'preview' => 'Levende forhåndsvisning',
        'updating' => 'Meddelelse om opdatering',
        'waitlist' => 'Venteliste',
        'waitlist_helper' => 'At lade nogen bede om besked, når en udsolgt pakke er til salg igen. Når der kommer noget på lager, får alle, der venter på den pakke, besked på én gang, og den går til den, der køber først - der bliver ikke holdt noget til nogen, og hver besked siger det. At få besked tager dem af listen, så én forespørgsel køber én besked og aldrig et stående abonnement. Det kræver butikken, og det er den ene ting i butikken, der skriver til en kunde, der ikke har købt noget.',
        'updating_helper' => 'Én linje øverst på siden, mens dette plugin installerer en opdatering, og i fem minutter efter den er færdig. Den kan ikke vises under selve opdateringen - mens udgivelsen bliver skiftet ind, læser Pelican dette plugin som ikke installeret og indlæser intet af det, så der er ikke noget af vores tilbage at tegne med. Den er til den, der mødte en halvtegnet side, ventede og kom tilbage: linjen fortæller dem, hvad de så.',
        'preview_helper' => 'Kassen ved siden af Look-formularen, der viser, hvad farver, hjørner og afstande gør, før du gemmer dem.',
        'duplicate' => 'Kopiér server',
        'duplicate_helper' => 'En side til at sætte endnu en server op præcis som en, du allerede har, eller flere på én gang. Filer bliver aldrig kopieret.',
        'favourites' => 'Markerede servere',
        'favourites_helper' => 'En stjerne på hvert serverkort. De markerede kommer først, og den enkeltes liste ligger på panelet - så stjernerne følger med til det næste sted, man logger ind. Det ændrer, hvad man selv ser, og intet for andre. At det ligger på panelet betyder dog, at det er en fil under storage, som enhver med adgang til maskinen kan læse.',
        'artwork' => 'Egg-billeder',
        'artwork_helper' => 'Administratorsiden, der henter hvert eggs billede fra Steam eller IGDB og skriver det ind i selve egg\'et.',
        'alerts' => 'Advarsler',
        'alerts_helper' => 'Tjekket med jævne mellemrum for en node, der er holdt op med at svare, en disk, der fyldes, en queue worker, der er død, eller en version, der kommer bagud - og den Discord-, panel- eller mailbesked, det sender.',
        'backups' => 'Oversigt over sikkerhedskopier',
        'backups_helper' => 'Administratorsiden, der lister hver eneste server efter, hvor længe den har været uden en kopi. Kun læsning.',
        'public_status' => 'Offentlig statusside',
        'public_status_helper' => 'Siden, hvem som helst kan åbne uden en konto. Er den slået fra, svarer adressen 404, uanset hvad der står på listen.',
        'game_players' => 'Spillere, andre spil',
        'game_players_helper' => 'En side inde i Rust, ARK, Valheim og alt andet, der svarer på Valves forespørgsel, som viser, hvem der er tilsluttet, og hvor længe de har været på.',
        'owner_alerts' => 'Fortæl folk, at deres server er offline',
        'owner_alerts_helper' => 'Den eneste del af dette plugin, der skriver til folk, som ikke er administratorer: en besked i panelet, når maskinen bag en af deres servere holder op med at svare, og en, når den kommer tilbage. Slået fra, indtil den slås til både her og på Advarsler-siden - den skriver til dine kunder, så det kræver to beslutninger frem for én.',
        'my_backups' => 'Advarsel om kopier på serverlisten',
        'my_backups_helper' => 'En linje over den enkeltes egen serverliste, når en af deres aldrig er blevet kopieret eller ikke er blevet det i et stykke tid. Pelicans kort siger, hvad en server laver nu; intet der siger, at en kopi ikke har kørt i tre uger. Tegnes kun, når noget er bagud, og den nævner ingen server, personen ikke allerede kunne åbne.',
        'capacity' => 'Kapacitetsoversigt',
        'capacity_helper' => 'Administratorsiden, der viser hukommelse, disk og processor lovet væk over for til rådighed på hver maskine, sammen med de servere, der er løbet tør for kopier, databaser eller tildelinger. Lovet væk frem for brugt - en node kan være travl og tom, eller stille og fuld.',
        'schedules' => 'Oversigt over planlagte opgaver',
        'schedules_helper' => 'Administratorsiden, der lister hver eneste planlagte opgave på tværs af panelet, de værste først - hængt fast, forsinkede, eller aldrig kørt. Kun læsning; alt, der retter eller kører en, bliver på Pelicans egen side for den server.',
        'activity' => 'Panelets aktivitet',
        'activity_helper' => 'Administratorsiden, der lister hver eneste loggede hændelse på tværs af panelet, den nyeste først, med hvem der gjorde det og på hvilken server. Kun læsning - den sletter intet, og Pelicans egen indstilling afgør stadig, hvor længe linjer bliver gemt.',
        'access' => 'Serveradgang efter rolle',
        'access_helper' => 'En side til at binde en rolle til servere, holdt sand i Pelicans egen subuser-tabel. Den giver ingenting, før du knytter noget sammen. At slå den fra stopper afstemningen; adgang, der allerede er givet, bliver, og siden har en knap til at tage den tilbage.',
        'scheduled' => 'Stile efter tidspunkt',
        'scheduled_helper' => 'Afsnittet på Look-siden, der giver panelet en anden stil mellem to tidspunkter på dagen. Det ændrer intet af det, der er gemt - et vindue lægges hen over indstillingerne, mens siden tegnes, og slippes igen straks efter - så at slå det fra bringer panelets eget udseende tilbage med det samme og mister ingenting.',
        'games' => 'Andre spil',
        'games_helper' => 'ARKs verdensindstillinger og Valheims lister over administratorer, bandlyste og tilladte, som formularer frem for som filer i filhåndteringen. Hvilke servere der får dem, er egg-listen på siden Andre spil.',
        'quick' => 'Menuen „Gå til"',
        'quick_helper' => 'Ét element øverst på hver side til at springe hen til en server eller en markeret side, med et søgefelt over hele din serverliste. Den markerer også den side, du står på. Det, nogen finder gennem den, er det, de allerede kunne nå, så den giver ingenting - at slå den fra tager genvejen væk og Favoritter-siden med den.',
        'shop' => 'Butik',
        'shop_helper' => 'At sælge servere fra panelet: butikken og kassen i kundeområdet, hver persons faktureringsside og siden Butiksindstillinger til valuta, moms og tekster. Hovedkontakten - slået fra kan ingen købe eller betale, og det, der allerede er solgt, administreres stadig gennem siderne nedenfor.',
        'packages' => 'Pakker',
        'packages_helper' => 'Administrationssiden, hvor det, der er til salg, defineres: en serverskabelon med en pris, en periode og et lager. Sin egen tilladelse, fordi at sætte priser er et andet arbejde end at markere fakturaer som betalt.',
        'orders' => 'Ordrer',
        'orders_helper' => 'Administrationssiden med alt, der er købt, den server, hver ordre blev til, og dens status - afventer, aktiv, suspenderet, annulleret. Sin egen tilladelse.',
        'invoices' => 'Fakturaer',
        'invoices_helper' => 'Administrationssiden med, hvad der skyldes, og hvad der er betalt, med en knap til at markere en faktura som betalt i hånden. Sin egen tilladelse, fordi den knap er der, hvor penge bogføres.',
        'payments' => 'Betalinger',
        'payments_helper' => 'Betalingsudbyderne - deres nøgler og hvert forsøg gennem dem. Sin egen tilladelse, fordi det er der, legitimationsoplysningerne bor: den, der må se hver faktura, behøver ikke at se hemmeligheden.',
        'coupons' => 'Rabatkoder',
        'coupons_helper' => 'Koder, der trækker en procentsats eller et fast beløb fra den første faktura, med udløb og et loft over antal brug. Sin egen tilladelse.',
        'customers' => 'Kunder',
        'customers_helper' => 'Den administratorside, der vender butikken om: én række per person, der har købt, med hvad de har, hvad de har betalt, og hvad der står tilbage. Sin egen ret, fordi det er den ene side i butikken, der handler om en person i stedet for om en række - den, der sætter priser, har ikke brug for en kundes hele historie, og den, der besvarer en sag, har.',
        'credit' => 'Tilgodehavende og tilbagebetalinger',
        'credit_helper' => 'Penge, butikken holder for en kunde. En tilbagebetaling kan gå tilbage til det kort, den kom fra, eller blive stående på kontoen som tilgodehavende; begge veje bliver der skrevet en kreditnota, og et tilgodehavende på en konto går af næste faktura af sig selv, før kunden overhovedet bliver bedt om at betale. Sin egen ret, fordi det at markere en faktura betalt noterer, at der kom penge ind, og det her deler penge ud.',
        'upgrades' => 'Op- og nedgradering',
        'upgrades_helper' => 'At flytte en kørende ydelse til en anden pakke uden at købe en ny. Det, der er tilbage af den periode, der allerede er betalt for, kommer retur, det samme stykke bliver beregnet til den nye pris, og forskellen bliver faktureret eller lagt på kundens konto. Hver pakke oplyser, hvilke andre den må flyttes til, og kun dem med samme egg bliver budt frem: et andet egg er en anden server, ikke en større.',
        'addons' => 'Tilvalg',
        'addons_helper' => 'Ting, der sælges ved siden af en pakke: mere hukommelse, en sikkerhedskopi mere, eller noget, der kun er en linje på fakturaen. Hvert af dem oplyser, hvilke pakker det passer til, og hvad det lægger til serveren, og det opkræves enten ved hver fornyelse eller én gang. Købes ved bestillingen eller senere på en kørende ydelse, hvor det regnes forholdsmæssigt efter resten af perioden. Sin egen ret, fordi hvad et tilvalg må lægge til nogens server er en beslutning om deres maskine frem for om en prisliste.',
        'tickets' => 'Sager',
        'tickets_helper' => 'Et sted, hvor kunder kan stille et spørgsmål inde fra panelet, ved siden af den ydelse, de spørger om - og det er den ene ting, en chatkanal ikke kan. Besvares på en side her, eller sendt videre til Discord gennem Modora, alt efter hvad Sager-siden er sat til. Hvert spørgsmål og hvert svar bliver gemt i dette panel under alle omstændigheder, så der går intet tabt, når den anden ende ikke kan nås. Sin egen ret, fordi det at svare kunder er et job, nogen bliver sat til, frem for et, der følger med at sætte priser på pakker.',
        'overview' => 'Butiksoverblik',
        'overview_helper' => 'Den side, der svarer på, hvad der kom ind denne måned, hvad der skyldes, hvad de kørende ydelser er værd hver måned, og hvad der trænger til et kig i dag. Sin egen ret, fordi omsætningen ikke er noget, enhver, der må sætte pris på en pakke, skal kunne læse.',
        'terminate' => 'Afslut en ydelse',
        'terminate_helper' => 'Den knap, der stopper en ydelse nu og sletter dens server, filer og det hele. Bevidst adskilt fra retten til ordrer: at suspendere, at rykke en forfaldsdato og at annullere kan alle gøres om, og denne kan ikke. Den, der besvarer sager, kan have de første tre uden at have denne.',
        'public_shop' => 'Offentlig butiksside',
        'public_shop_helper' => 'Siden, alle kan åbne uden konto, med det, der er til salg. Den offentliggør intet, en kunde, der er logget ind, ikke ville se i butikken, så til eller fra er hele beslutningen - fra svarer 404, ligesom statussiden.',
    ],

    /*
     * Søgefeltet over indstillingsformularerne. Det filtrerer det, der allerede
     * står på siden i browseren, og spørger serveren om ingenting, så der er
     * ingen „søger"-tilstand at beskrive og ingen måde, det kan slå fejl på.
     */
    /*
     * Forhåndsvisningen. Alt i den er en stedfortræder frem for en prøve på dit
     * panel, og ordlyden siger det - en kasse, der nævnte en rigtig server eller
     * et rigtigt tal, ville blive læst som en.
     */
    'preview' => [
        'label' => 'Forhåndsvisning',
        'card' => 'Et kort',
        'card_helper' => 'Tegnet efter de samme regler som panelet, med indstillingerne på denne side frem for de gemte.',
        'button' => 'En knap',
        'field' => 'Et felt',
        'meter_ok' => 'Fint',
        'meter_warning' => 'Advarsel',
        'meter_danger' => 'Fare',

        /*
         * Forhåndsvisningen af hele siden. En fane og ikke en rude, fordi
         * Pelican sender X-Frame-Options: DENY og nægter at lade sig ramme ind
         * af noget som helst, sig selv iberegnet - se Support\FullPreview.
         */
        'full' => 'Se hele panelet',
        'full_confirm' => 'Åbner panelet tegnet ud fra indstillingerne på denne side frem for de gemte. Der skrives ingenting - værdierne holdes i femten minutter, og panelet vender tilbage til normalen, når du forlader forhåndsvisningen eller gemmer.',
        'full_go' => 'Vis mig det',
        'full_failed' => 'Forhåndsvisningen kunne ikke sættes i gang',
        'bar' => 'Du kigger på indstillinger, der ikke er gemt. Intet af det er skrevet.',
        'bar_back' => 'Tilbage til indstillingerne',
    ],

    'search' => [
        'placeholder' => 'Søg i indstillinger',
        'label' => 'Søg i disse indstillinger',
        'none' => 'Intet på denne side passer. Indstillingerne er fordelt på fire sider - prøv Look, Sider, Avanceret eller Essentials-indstillinger.',
    ],

    'footer' => [
        'text' => 'Din egen linje',
        'text_helper' => 'Almindelig tekst, højst 120 tegn. Den bliver escapet, ligesom meddelelsesbjælken - det her tegnes på hver eneste side i panelet, hvilket gør det til det forkerte sted at tage imod opmærkning.',
        'version' => 'Vis panelets version',
        'version_helper' => 'Pelicans version, ikke dette plugins. Pluginnet siger sin egen på oversigten; det, folk leder efter i bunden af en sidebjælke, er, hvilket panel de kigger på.',
        'link_label' => 'Linktekst',
        'link_url' => 'Linkadresse',
        'link_url_helper' => 'En http- eller https-adresse, eller en sti i panelet selv som /account. Åbner i en ny fane.',
    ],

    'layout' => [
        'label' => 'Opsætning',
        'helper' => 'Hvordan panelet er sat op frem for hvilken farve det har. Gælder administrationsdelen, serverlisten og klientdelen lige meget. Hvor navigationen ligger, er en standard: den, der har sat sin egen under Konto → Navigation, beholder den.',
        'default' => 'Sidebjælke - Pelicans egen',
        'rail' => 'Ikonskinne - smal, åbner ved hover',
        'top' => 'Navigation i toppen - ingen sidebjælke',
        'mixed' => 'Topbjælke og sidebjælke - begge',
        'wide' => 'Bred - indholdet bruger hele skærmen',
        'focus' => 'Fokuseret - smal spalte, sidebjælken klapper væk',

        'nav_label' => 'Sidebjælkens stil',
        'nav_helper' => 'Hvordan selve sidebjælken tegnes.',
        'nav_default' => 'Standard',
        'nav_floating' => 'Svævende - et kort for sig',
        'nav_flat' => 'Flad - slet ingen baggrund',
        'nav_bordered' => 'Med kant - en streg, ikke en flade',

        'topbar_label' => 'Topbarens stil',
        'topbar_helper' => '„Skjult" gælder kun på computer - på en telefon bærer topbaren den eneste vej tilbage til menuen.',
        'topbar_default' => 'Standard',
        'topbar_floating' => 'Svævende - en løsrevet bjælke',
        'topbar_flush' => 'Flugtende - flad, uden slør',
        'topbar_hidden' => 'Skjult på computer',

        'card_label' => 'Kortstil',
        'card_helper' => 'Afsnit, widgets, serverkort og blokkene over konsollen.',
        'card_default' => 'Standard - hævet med en blød kant',
        'card_flat' => 'Fladt - uden løft',
        'card_outline' => 'Omrids - en kant og intet bagved',
        'card_glass' => 'Frostet - baggrunden skinner igennem',
        'card_sharp' => 'Skarpt - rette hjørner',
    ],

    'servers' => [
        /*
         * Stjernen på et kort. Givet videre til scriptet frem for skrevet ind i
         * det, så teksterne bliver det ene sted, tekster bor.
         */
        'favourite' => 'Markér denne server',
        'favourited' => 'Markeret - vises først',

        /*
         * Pillen ved siden af Pelicans egne faner. Navngivet efter, hvad den gør
         * ved listen, frem for som en fjerde fane, fordi den filtrerer den fane,
         * der er valgt, i stedet for at afløse den.
         */
        'favourites_tab' => 'Favoritter',
        'favourites_empty' => 'Der er intet markeret på denne side. Brug stjernen på et serverkort for at lægge et til - og læg mærke til, at det her filtrerer de servere, der allerede står her: en markeret server på en senere side bliver ikke skjult, den står bare ikke på denne.',
        'favourites_failed' => 'Dine markerede servere kunne ikke gemmes, så de er sat tilbage til det, panelet sidst havde. Browserens konsol siger, hvad forespørgslen svarede.',

        'art' => 'Spilbillede',
        'art_helper' => 'Pelican tegner egg\'ets billede på hvert kort. Det her afgør, hvad der sker med det.',
        'art_faded' => 'Falmet - et skær bag teksten',
        'art_cover' => 'Dækkende - bag navnet, toner ud',
        'art_off' => 'Fra',
        'art_dim' => 'Gør billedet mørkere',
        'art_dim_helper' => 'Ét spils billede er en lys himmel, og et andets er en hule.',

        'status' => 'Tilstandsmærke',
        'status_helper' => 'Hvor farven for kører/starter/stoppet vises.',
        'status_bar' => 'Bjælke - langs venstre kant',
        'status_edge' => 'Kant - hen over toppen',
        'status_dot' => 'Prik - i hjørnet',
        'status_off' => 'Fra',

        'density' => 'Korthøjde',
        'density_comfortable' => 'Rummelig',
        'density_compact' => 'Kompakt - til mange servere',

        'filter_label' => 'Sæt tekst på filterknappen',
        'filter_label_helper' => 'Pelican filtrerer allerede denne liste efter egg og efter ejer, på tværs af alle sider - men vejen ind er et ikon uden tekst ved siden af søgefeltet. Det her sætter ordet på.',
        'filter_button' => 'Filtre',

        'columns' => 'Kort ved siden af hinanden på en bred skærm',
        'columns_helper' => 'Gælder kun gitteropsætningen, og kun fra 1280px og op. Pelicans eget loft er to.',
    ],

    'controls' => [
        'mode' => 'Konsolknap på hver serverside',
        'mode_helper' => 'Én svævende knap, på hver eneste side inde i en server. Den åbner konsollen oven på det, du var i gang med, med tilstanden og strømknapperne i sit hoved - den når noden direkte, ligesom serverlisten gør, frem for gennem konsolsidens websocket. Den dukker aldrig op på konsolsiden, som allerede har det hele.',
        'mode_full' => 'Konsol og strømknapper',
        'mode_console' => 'Kun konsol',
        'mode_off' => 'Fra',

        'label' => 'Knappen viser',
        'label_text' => 'Ikon og navn',
        'label_icon' => 'Kun ikon',

        'position' => 'Hvor den svæver',
        'position_helper' => 'Op mod den kant, du er mindst tilbøjelig til at læse.',
        'position_top' => 'Top',
        'position_right' => 'Højre',
        'position_bottom' => 'Bund',
    ],

    'console' => [
        'stats' => 'Blokke over konsollen',
        'stats_helper' => 'Pelican viser navnet, tilstanden, adressen og de tre forbrugstal over terminalen. At skjule dem giver konsollen højden tilbage.',
        'stats_tiles' => 'Fliser - mærkat, tal og et ikon',
        'stats_plain' => 'Enkle - som Pelican tegner dem',
        'stats_off' => 'Skjult',
    ],

    'terminal' => [
        'helper' => 'Gives videre til terminalen selv, så de træder i kraft ved næste sideindlæsning frem for i det øjeblik, de gemmes.',

        'renderer' => 'Tegnet af',
        'renderer_helper' => 'Pelican tegner terminalen på GPU\'en, hvilket er meget hurtigere ved en mur af rullende output. En browser holder kun så og så mange GPU-kontekster i live ad gangen - færre på en telefon - og tager den ældste væk, når grænsen overskrides; terminalen tegner så slet ingenting, uden en fejl. Bliver din konsol tom, mens alt andet ved den ser rigtigt ud, er det den her indstilling, man ændrer.',
        'renderer_webgl' => 'GPU\'en - Pelicans egen, hurtigere',
        'renderer_dom' => 'Browseren - langsommere, tegner altid',

        'scheme' => 'Farveskema',
        'scheme_helper' => 'Den ene terminalindstilling, Pelican ikke byder frem. „Følg temaet" udleder farverne af accenten, og det er derfor, det her overhovedet findes.',
        'scheme_theme' => 'Følg temaet',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Markør',
        'cursor_helper' => 'Konsollen tager ikke imod tastning - kommandofeltet sidder under den - så det her er, hvor outputtet stoppede, ikke hvor du er.',
        'cursor_underline' => 'Understregning - Pelicans egen',
        'cursor_block' => 'Blok',
        'cursor_bar' => 'Streg',

        'blink' => 'Blinkende markør',

        'scrollback' => 'Rullehistorik',
        'scrollback_helper' => 'Hvor langt tilbage konsollen kan rulles. Hver eneste linje holdes i browseren, så en snakkesalig server med en høj indstilling er rigtig hukommelse på den maskine, der læser med.',
        'scrollback_lines' => ':lines linjer',
    ],

    'notice' => [
        'text' => 'Besked',
        'text_helper' => 'Én linje, op til 200 tegn. Den escapes på vej ind og på vej ud, så den kan ikke bære opmærkning ind på en side, andre folk indlæser.',
        'style' => 'Tone',
        'style_info' => 'Info',
        'style_warning' => 'Advarsel',
        'style_danger' => 'Haster',
        'style_accent' => 'Accentfarve',
        'scope' => 'Vises for',
        'scope_all' => 'Alle',
        'scope_client' => 'Kun uden for administrationsdelen',
        'scope_admin' => 'Kun i administrationsdelen',
        'link_label' => 'Knaptekst',
        'link_url' => 'Knapadresse',
        'link_url_helper' => 'https:// eller en sti inde i dette panel, for eksempel /account. Alt andet ignoreres - et link i en bjælke på hver eneste side er ikke et sted til et skema, ingen venter sig.',
        'dismissible' => 'Kan lukkes',
        'dismissible_helper' => 'At den er lukket, huskes pr. browser, og kun for denne besked: ændr teksten, og den kommer tilbage til alle.',
        'dismiss' => 'Luk',
    ],

    'preset' => [
        'label' => 'Stil',
        'helper' => 'Vælg et udseende at starte fra. Det udfylder alt nedenfor, som du så kan ændre. „Ingen" slår temaet fra og lader panelet stå præcis, som Pelican leverer det.',
        'options' => [
            'none' => 'Ingen - intet tema',
            'legend' => 'Legend - rød ild over i blåt lyn',
            'ember' => 'Ember - varm sort, orange accent',
            'midnight' => 'Midnight - dyb blå, rolig',
            'crimson' => 'Crimson - rød, skarpe hjørner, kompakt',
            'forest' => 'Forest - grøn, rund, uden skær',
            'nebula' => 'Nebula - lilla med en baggrund i overgang',
            'terminal' => 'Terminal - grøn på sort, fast bredde, skarp',
            'console' => 'Console - rund og rummelig, til en tablet',
            'nord' => 'Nord - Nord-paletten, dæmpet',
            'solarized' => 'Solarized - Solarized dark, cyan accent',
            'paper' => 'Paper - lys, høj kontrast, flad',
            'daylight' => 'Daylight - lys og varm, med et blødt skær',
            'mono' => 'Mono - gråtoner, flad og tæt',
        ],

        'save' => 'Gem som en stil',
        'save_confirm' => 'Beholder de farver, hjørner, den baggrund, skrift, de ikoner og målergrænser, du har på skærmen lige nu - under et navn, du selv vælger, i vælgeren ved siden af de indbyggede. Den gemmer det, der står på siden, ikke det, der sidst blev gemt.',
        'save_name' => 'Navn',
        'save_name_helper' => 'Hvad den kommer til at hedde i vælgeren. At gemme under et navn, du har brugt før, afløser det.',
        'saved' => 'Stil gemt',
        'save_failed' => 'Den stil kunne ikke gemmes',
        'save_full' => 'Der er plads til :max stile af dine egne. Slet en først.',

        'delete' => 'Slet en stil',
        'delete_which' => 'Hvilken',
        'delete_confirm' => 'Kun dine egne stile kan slettes; de indbyggede kan ikke. Der ændres intet ved, hvordan panelet ser ud lige nu - en stil er et udgangspunkt, og hver eneste værdi, den satte, står allerede i indstillingerne nedenfor.',
        'deleted' => 'Stil slettet',
        'deleted_current' => 'Det var den, dette panel var sat til. Dens indstillinger er uændrede og står stadig på denne side - vælg en stil, eller gem dem igen under et navn.',
    ],

    'user_themes' => [
        'label' => 'Stile, folk selv må vælge',
        'helper' => 'De stile, der er sat hak ved, dukker op på en Udseende-side i klientdelen, hvor enhver, der er logget ind, kan vælge en til sig selv. Det ændrer, hvad de selv ser, og intet for andre. Intet hak betyder, at ingen vælger noget, og at panelet holder ét udseende - hvilket er det, det gør nu.',
    ],

    'mode' => [
        'label' => 'Paneltilstand',
        'helper' => 'Hvilken tilstand panelet åbner i. Den, der ikke selv har valgt, får denne; skifteren i brugermenuen lader dem stadig ændre den, medmindre du låser den nedenfor.',
        'dark' => 'Mørk',
        'light' => 'Lys',
        'system' => 'System - følg den besøgendes egen indstilling',
    ],

    'font' => [
        'label' => 'Panelets skrift',
        'helper' => 'Hver mulighed er en familie, styresystemet allerede har - der hentes intet fra en skriftudbyder. Terminalen er ikke berørt: dens skrift er den enkeltes eget valg, under Konto.',
        'default' => 'Standard - Pelicans egen',
        'mono' => 'Fast bredde',
        'rounded' => 'Rundet',
        'serif' => 'Serif',
        'system' => 'System - det, denne maskine bruger',
    ],

    'surface' => [
        'label' => 'Fladefarve',
        'helper' => 'Kortene og panelerne. Lysere og mørkere nuancer udledes af den.',
        'placeholder' => 'Følg temaet',
    ],

    'radius' => [
        'label' => 'Hjørner',
    ],

    'accent' => [
        'label' => 'Accentfarve',
        'helper' => 'Bruges til knapper, links, det aktive navigationspunkt og fokusringe.',

        /*
         * Sagt, ikke håndhævet. En farve, det her advarer om, bliver gemt
         * alligevel: det er nogens panel, tallet måler én ting, og der er gode
         * grunde til at ville have en accent, der scorer dårligt. Vælgeren siger,
         * hvad den ser, og går til side.
         */
        'contrast_dark' => 'Læsbarhed: :ratio mod et mørkt panel. Under 3 er en accent svær at læse som knap eller link - en lysere løfter den.',
        'contrast_light' => 'Læsbarhed: :ratio mod et lyst panel. Under 3 er en accent svær at læse som knap eller link - en mørkere løfter den.',
    ],
    'density' => [
        'label' => 'Tæthed',
        'helper' => 'Kompakt strammer afstandene, så der er plads til flere rækker på skærmen.',
        'comfortable' => 'Rummelig',
        'compact' => 'Kompakt',
    ],
    'force_dark' => [
        'label' => 'Tving mørk tilstand',
        'helper' => 'Skjuler skifteren mellem lys og mørk og holder hver bruger på det mørke tema.',
    ],
    'glass' => [
        'label' => 'Frostet topbar',
        'helper' => 'Slører topbaren og baggrunden bag dialoger. Slå fra på svagere enheder.',
    ],
    'glow' => [
        'label' => 'Accentskær',
        'helper' => 'En blød accentskygge på de vigtigste knapper, den aktive navigation og login-kortet.',
    ],

    'background' => [
        'label' => 'Baggrundstype',
        'helper' => 'Aurora er temaets egen baggrund: accentskær med en fin kornethed.',
        'aurora' => 'Aurora (standard)',
        'solid' => 'Én farve',
        'gradient' => 'Overgang',
        'image' => 'Billede',
        'color' => 'Farve',
        'base' => 'Farven bag skæret',
        'base_helper' => 'Det, siden hviler på, før accentskæret males hen over den. Lad feltet stå tomt for at beholde panelets standard, som er næsten sort i mørk og næsten hvid i lys. Sætter du den, beholder et skema sin egen natfarve og bliver stadig lyst op.',
        'color_end' => 'Anden farve',
        'angle' => 'Retning',
        'upload' => 'Læg et billede op',
        'upload_helper' => 'Op til 8 MB. Et billede, der er lagt op, går forud for adressen nedenfor.',
        'url' => 'Eller en URL',
        'url_helper' => 'Skal begynde med https:// og kunne nås udefra.',
        'dim' => 'Dæmp',
        'dim_helper' => 'Uden dæmpning er hvid tekst på et lyst foto ulæselig.',
        'blur' => 'Slør',
    ],

    'channel' => [
        'installed' => 'installeret',
        'version' => 'Installér en bestemt version',
        'version_helper' => 'Enhver udgivelse på denne kanal, ikke kun den nyeste - til at gå tilbage, når noget nyt viser sig at være værre, eller frem til en build, nogen har bedt dig prøve. Kun mens opdateringer ikke installerer sig selv: med det slået til ville dit valg kun holde til næste tjek.',
        'version_placeholder' => 'Vælg en version',
        'version_install' => 'Installér denne version',
        'version_confirm' => 'Panelet henter den udgivelse, bygger sine assets om og rydder sine caches. Dine indstillinger bliver bevaret. Det er tilladt at gå tilbage til en ældre version, og det bliver ikke rullet tilbage for dig - vælg den nyere igen for at gå frem.',
        'label' => 'Opdateringskanal',
        'helper' => 'Hvilke udgivelser Tema-siden byder frem. Beta får nye versioner først, og de skarpe kanter først også.',
        'token' => 'Token til dev-repository',
        'token_helper' => 'Dev-kanalen udgives fra et privat repository, så det kræver et GitHub-token at læse den - et fine-grained personal access token med læseadgang til det repositorys indhold, og ikke mere end det. Stabil og beta er offentlige og kræver intet. Det bliver på dette panel: det skrives ikke til en eksporteret indstillingsfil.',
        'stable' => 'Stabil',
        'beta' => 'Beta',
        'dev' => 'Dev (arbejdsgren)',
        'auto' => [
            'label' => 'Installér opdateringer automatisk',
            'helper' => 'Fra lader opdateringen være op til dig. Til får panelet til at tjekke den valgte kanal og installere alt nyere - det bygger sine assets om imens og er utilgængeligt i et par minutter, så dagligt og ugentligt kører kl. 04:00. Kræver, at panelets cron kører.',
            'interval' => 'Tjek hvert',
            'minute' => 'Hvert minut',
            'five_minutes' => 'Hvert 5. minut',
            'ten_minutes' => 'Hvert 10. minut',
            'thirty_minutes' => 'Hvert 30. minut',
            'hourly' => 'Hver time',
            'daily' => 'Hver dag (04:00)',
            'weekly' => 'Hver uge (mandag 04:00)',
        ],
    ],

    /*
     * Sprog-fanen.
     *
     * Forsigtig med, hvad den påstår. Pelican lader allerede hver enkelt vælge
     * et sprog til hele sin konto og anvender det allerede; intet her ændrer det
     * eller bør gøre det. Det her afgør kun, om dette plugins egne tekster
     * følger det valg.
     */
    'languages' => [
        'section_helper' => 'Pelican lader allerede hver enkelt vælge et sprog til sin konto, og dette plugin følger det, hvor det er oversat. Her afgør du, hvilke af dem det følger. De fleste sprog står på en lav procent med vilje: det, der bliver oversat først, er den del, alle ser på hver eneste side - strømknapperne over en konsol og nodemålerne - og resten kommer, efterhånden som folk bidrager med den.',
        'panel' => 'Lad det her afgøre sproget i hele panelet',
        'panel_helper' => 'Slået til sætter et sprog, dette plugin ikke bærer - eller et, der er slået fra nedenfor - hele panelet på engelsk for den læser, ikke bare disse sider. Slået fra følger kun dette plugin listen, og Pelican bliver ved med at tale det, kontoen er sat til, hvilket vil sige, at en læser kan møde to sprog på én skærm. Ingen konto bliver ændret hverken den ene eller den anden vej: slå et sprog til igen, og de har det tilbage.',
        'label' => 'Sprog at svare på',
        'helper' => 'At fjerne hakket sender de læsere, hvis konto er sat til det, tilbage til engelsk for dette plugin alene - resten af panelet taler stadig deres sprog. Engelsk står ikke på listen, fordi alt falder tilbage til det.',
        'under' => 'bydes ikke frem, før det er kommet længere - sæt hak for at byde det frem alligevel',
        'done' => ':percent % oversat',
        'main' => 'Hovedsprog',
        'main_helper' => 'Det, en læser får, når hans eget sprog ikke kan bruges - enten bærer dette plugin det ikke, eller også er der ikke hak ved det nedenfor. Det var altid engelsk; i et hold, der ikke arbejder på engelsk, var det et forkert svar givet med sikkerhed. Der kan ikke fjernes hak ved det nedenfor, fordi alt falder tilbage til det.',
        'labels' => 'Hvad hvert sprog hedder',
        'labels_helper' => 'Det navn, læsere og administratorer ser i vælgerne. Lad et stå tomt for at beholde det navn, dette plugin kender det under. Et sprog, der er lagt op under et navn, du selv har fundet på, har ingen, så det ville stå med sin kode, indtil du giver det et her.',
        'labels_code' => 'Kode',
        'labels_name' => 'Vises som',
        'download' => 'Hent en oversættelsesfil',
        'download_from' => 'Start fra',
        'download_from_helper' => 'En JSON med hver eneste tekst i dette plugin. Vælg engelsk til et sprog, ingen har begyndt på, eller et bestående for at bygge videre på det, der allerede er oversat.',
        'code' => 'Sprogkode',
        'code_helper' => 'Den kode, filen er til. En rigtig locale, som konti bruger dem - fr, de, pt_BR - når frem til de læsere, hvis konto er sat til den, og skal passe præcis, ellers gør den det ikke. Et navn, du selv finder på, som Gaming-DK, er tilladt og virker anderledes: Pelican lader kun en konto have en rigtig locale, så ingen kan vælge dit. Det kan nås som hovedsproget ovenfor, hvilket er det, alle får, hvis eget ikke kan bruges.',
        'url' => 'Eller hent den fra en adresse',
        'url_helper' => 'En https-adresse, panelet kan nå - et CDN, en bucket, en rå fil i et repository. Den hentes én gang, når du gemmer, og skrives på samme måde som en, der lægges op, så det gør ingenting at ændre filen på den adresse senere, før du gemmer igen. En fil valgt ovenfor vinder over en adresse, der står tilbage i dette felt.',
        'upload' => 'Læg en oversættelsesfil op',
        'upload_helper' => 'JSON-filen ovenfra, med værdierne oversat. Den skrives uden for pluginnet, så en opdatering smider den ikke væk, og den lægges hen over engelsk nøgle for nøgle - en fil med halvdelen af teksterne giver dig et halvt sprog og engelsk til resten.',
        'uploaded' => ':count tekster installeret til :code',
        'uploaded_halves' => ':mine af dem er dette plugins egne tekster, og :panel er panelets. Nul på den ene side betyder, at den halvdel af filen ikke indeholdt noget - pluginnets nøgler begynder med essentials:: og panelets gør ikke.',
        'uploaded_skipped' => ':count blev sprunget over: tomme, eller nøgler dette plugin ikke har. De første par: :keys',
        'upload_failed' => 'Den fil kunne ikke læses',
        'upload_failed_body' => 'Det skal være JSON-filen fra hentningen ovenfor - et fladt objekt af nøgler og tekster. Tjek, at en editor ikke har gemt den som noget andet.',
    ],

    'windows' => [
        'add' => 'Tilføj et vindue',
        'from' => 'Fra',
        'to' => 'Indtil',
        'to_helper' => 'Tidligere end starten betyder, at det går over midnat - 22:00 indtil 06:00 er natten.',
        'preset' => 'Stil',
        'days' => 'Dage',
        'days_helper' => 'Lad dem alle stå uden hak for hver dag. Et vindue, der går over midnat, hører til den dag, det begynder på, så fredag 22:00 indtil 06:00 dækker lørdag morgen.',
        'day_mon' => 'Mandag',
        'day_tue' => 'Tirsdag',
        'day_wed' => 'Onsdag',
        'day_thu' => 'Torsdag',
        'day_fri' => 'Fredag',
        'day_sat' => 'Lørdag',
        'day_sun' => 'Søndag',
    ],

    'arranger' => [
        'label' => 'Sideopstiller',
        'helper' => 'Knappen „Stil siden op", på hver eneste side i panelet. Enhver med rettigheden Stil op får den og kan også sætte den opstilling, alle andre starter fra, eller en til en rolle. Fra skjuler den for alle; opstillinger, der allerede er gemt, bliver, hvor de er.',
        'roles' => 'En opstilling er ikke en rettighed. En blok, en rolle skjuler, er stadig en blok, nogen kunne nå ved at taste adressen - det, der stopper det, er Pelicans egne rettigheder, på rolle-siden. Der lægges tre lag på i denne rækkefølge: den, alle starter fra, så læserens rolle, og så det, de selv har flyttet.',
        'users' => 'Lad alle stille deres egne sider op',
        'users_helper' => 'Til lader enhver, der er logget ind, flytte rundt på og skjule blokke på de sider, de allerede kan se, kun for sig selv - det ændrer intet for andre. At sætte den opstilling, alle starter fra, bliver ved rettigheden Stil op.',
    ],

    'brand' => [
        'logo_height' => 'Logohøjde',
        'logo_height_helper' => 'Pelican leverer 2rem. Større værdier gør sidebjælkens hoved højere med.',
        'logo_url' => 'Erstat logoet',
        'logo_url_helper' => 'Lad feltet stå tomt for at beholde det, Pelicans egne indstillinger peger på.',
    ],

    'login' => [
        'image' => 'Baggrundsbillede',
        'image_helper' => 'Kun til login-skærmen. Uden et viser den fortsat panelets baggrund.',
        'url' => 'Eller en URL',
        'blur' => 'Slør på kortet',
        'blur_helper' => 'Froster kortet, så billedet bagved skinner igennem.',
        'width' => 'Kortets bredde',
        'position' => 'Billedets udsnit',
        'position_helper' => 'Hvilken del af billedet der overlever at blive beskåret til skærmen.',
        'position_center' => 'Midt',
        'position_top' => 'Top',
        'position_bottom' => 'Bund',
        'position_left' => 'Venstre',
        'position_right' => 'Højre',
        'align' => 'Kortets placering',
        'align_helper' => 'Hvor login-kortet sidder hen over skærmen.',
        'align_center' => 'Midt',
        'align_start' => 'Venstre',
        'align_end' => 'Højre',
        'opacity' => 'Kortets uigennemsigtighed',
        'opacity_helper' => 'Lavere lader mere af billedet komme gennem kortet.',
        'glow' => 'Accentskær',
        'glow_helper' => 'Glorien omkring kortet. Fra beholder dets kant og dets dybde.',
        'hide_heading' => 'Skjul overskriften',
        'hide_heading_helper' => 'Fjerner titlen over formularen og lader formularen stå alene.',
        'hide_footer' => 'Skjul foden',
        'hide_footer_helper' => 'Fjerner linjen under kortet, der linker til pelican.dev.',
        'above' => 'Linje over formularen',
        'above_helper' => 'Én linje, vist til alle, der kommer til login-skærmen. Lad feltet stå tomt for ingen.',
        'notice' => 'Besked under kortet',
        'notice_helper' => 'Én linje, vist til alle, der kommer til login-skærmen. Lad feltet stå tomt for ingen.',
    ],

    'advanced' => [
        'css' => 'Egen CSS',
        'css_helper' => 'Op til 100 KB. Gemmes i storage, ikke i .env.',
        'reference' => 'CSS-opslag',
        'reference_helper' => 'Hver eneste variabel og klasse, dette tema og panelet stiller frem.',
    ],

    'areas' => [
        'add' => 'Tilføj et område',
        'area' => 'Område',
        'inherit' => 'Fælles',
        'radius' => 'Hjørner',
        'radius_sharp' => 'Skarpe',
        'radius_normal' => 'Normale',
        'radius_round' => 'Runde',
        'surface' => 'Fladefarve',
        'surface_helper' => 'Kortene og panelerne inde i dette område; lysere og mørkere nuancer udledes af den.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsol (resten af siden)',
            'files' => 'Filsiden',
            'edit' => 'Redigeringssiden',
            'server' => 'Andre serversider og faner',
        ],
    ],

    'bars' => [
        'base' => 'Grundfarve',
        'base_green' => 'Grøn',
        'base_accent' => 'Accentfarve',
        'warning' => 'Ravgul fra',
        'danger' => 'Rød fra',
    ],

    'icons' => [
        'stroke' => 'Stregtykkelse',
        'stroke_thin' => 'Tynd',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Fed',
        'scale' => 'Størrelse',
        'accent' => 'Menuikoner i accentfarven',
        'accent_helper' => 'Gælder ikonerne i sidebjælken og i topbaren.',
        'pack' => 'Ikonpakke',
        'pack_helper' => 'Hvilket sæt vælgeren nedenfor henter fra. Hvert ikonsæt, der er installeret på serveren, bydes frem, plus Essentials-sættet, der følger med dette plugin, og enhver pakke, du lægger op. Én forskel er værd at kende: et stregikon tegnes i menuens farve og følger hover og den aktive række, mens Essentials-ikonerne er billeder og beholder deres egne farver i stedet. Det afgøres af, hvad filen er, ikke af hvilket sæt den kom fra.',
        'pack_custom' => 'Oplagt pakke',
        'pack_shipped' => 'Essentials-ikoner',
        'use_shipped' => 'Brug Essentials-ikonerne overalt',
        'use_shipped_confirm' => 'Sætter pakken til Essentials-ikonerne og udfylder hver menurække nedenfor med det ikon, der er tegnet til den - konsollen får terminalen, opstart får startknappen, og så videre. Det afløser de rækker, du har nu, og der gemmes intet, før du trykker Gem, så at lukke siden fortryder det.',
        'pack_upload' => 'Læg en pakke op',
        'pack_upload_helper' => 'En .zip med SVG-filer. Hver fil bliver til et ikon opkaldt efter den - logo.svg bliver custom-logo. At lægge op afløser den pakke, der ligger nu. Filer over 256 KB og alt ud over 4.000 ikoner bliver udeladt, og du får at vide hvor mange: som målestok er hele Tabler-sættet tæt på seks tusind ikoner i omkring tre megabyte, så en pakke, der er meget større, bærer noget andet end ikoner, og det meste af den bliver sprunget over. En stor oplægning kan også blive afvist, før dette felt siger noget som helst, af upload_max_filesize og post_max_size i php.ini på panelets vært - ingen indstilling her kan hæve dem.',
        'pack_partial' => ':count ikoner installeret, men ikke dem alle',
        'pack_partial_body' => 'Sprunget over: :big for store til et ikon, :unusable ikke brugbare som SVG, :duplicate med et navn, der allerede er taget, :empty stod tilbage uden noget at tegne, da de var renset. En SVG over 256 KB er næsten altid et billede pakket ind i en frem for en tegning - eksportér den i ikonstørrelse, så bliver den et par kilobyte. Et ikon, der står tilbage uden noget at tegne, rummede kun noget, det her ikke serverer - er det en hel pakke, er det værd at melde.',
        'pack_stopped_files' => 'Den stoppede også ved grænsen for, hvor mange ikoner en pakke må rumme.',
        'pack_stopped_size' => 'Den stoppede også, fordi resten af pakken folder sig ud til mere, end panelet kan holde i hukommelsen på én gang - zip-filen kan være mindre end det, da SVG komprimerer omkring fem til en.',
        'overrides' => 'Erstat ikoner',
        'overrides_helper' => 'Én række pr. ikon, du vil have ændret. Vælg menupunktet, og vælg så et ikon fra pakken ovenfor, giv en adresse, eller læg et billede op, du selv har. Er der udfyldt mere end ét, vinder det oplagte, så adressen, så pakken.',
        'overrides_key' => 'Menupunkt',
        'overrides_value' => 'Ikon fra pakken',
        'overrides_url' => 'Eller en adresse',
        'overrides_url_helper' => 'En https-adresse på et billede, du selv hoster - et CDN, en bucket, hvor som helst browseren kan nå. Der kopieres intet til panelet, så at udskifte filen på den adresse ændrer ikonet uden at røre denne side; bagsiden er et ikon, der forsvinder, når adressen gør. Det beholder sine egne farver, ligesom et billede, der er lagt op.',
        'overrides_file' => 'Eller læg et billede op',
        /*
         * Siger, hvad forskellen faktisk er, for den er ikke indlysende, og det
         * er grunden til, at man vælger det ene frem for det andet.
         */
        'overrides_file_helper' => 'PNG, SVG eller ICO. Et ikon fra pakken tegnes i menuens egen farve og følger hover og den aktive række; et billede, der er lagt op, beholder sine egne farver og gør ikke. Til et logo er det som regel det, man vil have.',
        'overrides_add' => 'Erstat endnu et ikon',
        'overrides_search' => 'Skriv et navn, eller menupunktet…',
    ],

    /*
     * Ikke under brand. Brand handler om, hvordan panelet ser ud; det her
     * handler om, hvordan dette plugin viser sig i det, og det er et andet
     * spørgsmål, som besvares på en anden side.
     */
    'identity' => [
        'nav_icon' => 'Ikon til rækken „Essentials-indstillinger"',
        'nav_icon_helper' => 'PNG, SVG eller ICO, op til 8 MB. Erstatter ikonet på netop den ene række i sidebjælken; lad feltet stå tomt for det, dette plugin leveres med. Det tegnes som et billede frem for som et ikon, så det beholder sine egne farver i stedet for at følge teksten - hvilket som regel er, hvad et logo vil. Filen serveres frem for at være indlejret, så hver browser henter den én gang, men det er stadig værd at eksportere noget lille: et par kilobyte er rigeligt til en række på tyve pixels. Slår en oplægning fejl, før dette felt siger noget, er den grænse, den ramte, upload_max_filesize i panelets php.ini.',
    ],
];
