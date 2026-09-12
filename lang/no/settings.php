<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Egg», «node», «subuser», «Wings», «queue», «webhook», «topbar», «cron» og
 * navnene på filformatene blir stående som de er: det er under de navnene man
 * finner dem i Pelican selv, på verten og i alt som skrives om dem. Navnene på
 * stilene blir heller ikke oversatt - en stil heter det den heter, og et oversatt
 * navn ville vært enda et navn på det samme.
 */

return [
    'css_warning' => 'Lagret, men denne CSS-en ser feil ut',
    'css_unclosed' => 'En regel som åpnes på linje :line, blir aldri lukket. Alt etter den står inne i den regelen og får ingen virkning.',
    'css_extra' => 'Det står en lukkende krøllparentes på linje :line uten at noe er åpent. Alt etter den står utenfor enhver regel og blir hoppet over.',
    'css_comment' => 'En kommentar som åpnes på linje :line, blir aldri lukket, så resten av filen står inne i den.',

    'groups' => [
        'appearance' => 'Utseende',
        'servers' => 'Serverliste',
        'windows' => 'Stiler etter tidspunkt',
        'windows_helper' => 'En annen stil mellom to tidspunkter på dagen. Det skjer ingenting før du legger en inn. Klokken er panelets egen, fra tidssoneinnstillingen dens, og ikke hver enkelt lesers - et panel som så forskjellig ut for to mennesker i samme øyeblikk, ville lignet noe i stykker framfor noe planlagt. Et vindu endrer det utseendet panelet allerede har, så det gjør ingenting mens stilen står på «Ingen». En stil noen har valgt til seg selv, vinner fortsatt over det.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Språk',
        'files_where' => 'Hvor filer ligger',
        'files_bucket' => 'Bucketen',
        'files_cdn' => 'CDN-et',
        'files_mirror' => 'Språk, holdt utenfor panelet',
        'servers_helper' => 'Hvordan et serverkort tegnes. Om de vises som rutenett eller liste er den enkeltes eget valg, under Konto → Oversiktens oppsett.',
        'server_pages' => 'Serversider',
        'server_pages_helper' => 'Hva hver side inne i en server bærer, uansett hvilken side det er.',
        'console' => 'Konsollside',
        'console_helper' => 'Terminalens egen skrift, størrelse og høyde er den enkeltes eget valg, under Konto.',
        'background' => 'Bakgrunn',
        'background_helper' => 'Gjelder hele panelet, også innloggingsskjermen.',
        'icons' => 'Ikoner',
        'bars' => 'Ressursmålere',
        'bars_helper' => 'Stolpene for prosessor, minne og disk på serverkortene.',
        'updates' => 'Oppdateringer',
        'updates_helper' => 'Hvilke utgivelser Tema-siden tilbyr, og hvor den leter etter dem.',
        'brand' => 'Merkevare',
        'login' => 'Innloggingsskjerm',
        'login_helper' => 'Gjelder skjermene for innlogging, tilbakestilling av passord og tofaktor.',
        'advanced' => 'Egen CSS',
        'advanced_helper' => 'Til alt innstillingene ovenfor ikke dekker. Lastes etter alt annet, så den vinner.',
        'areas' => 'Per område',
        'areas_helper' => 'Alt ovenfor gjelder overalt. Her kan du sette ett område til side; alt du lar stå tomt, følger fortsatt den felles innstillingen.',
        'footer' => 'Sidefeltets fot',
        'footer_helper' => 'Bunnen av sidefeltet, som Pelican lar stå tom. Alt her er av inntil du fyller det ut.',
        'features' => 'Hva dette pluginet legger til',
        'features_helper' => 'Fjerner du krysset ved en ting, forsvinner den helt ut av panelet. Innstillingene dens blir beholdt, og siden dens beholder adressen sin, så det går ingenting tapt ved å slå noe av for å se hva det gjorde. De fleste har også sin egen rettighet under Roller, så man kan gi bort én uten å gi bort resten. Ikke alle: ressursmålerne, sidefeltets fot og søket i innstillingene tegnes for alle og styres av ingen, stjernen på et serverkort tilhører den som klikket på den, og Palworld- og Minecraft-sidene inne i en server følger den serverens egne rettigheter framfor en av disse. Selve utseendet står ikke på listen - det har sin egen bryter, under Look → Utseende → Stil → Ingen.',
        'identity' => 'Dette pluginet i sidefeltet',
        'identity_helper' => 'Raden dette pluginet legger til sidefeltet, og bildet på den.',
    ],

    /*
     * Innstillingssidene, hver en rad i pluginets egen gruppe i sidefeltet.
     * Gruppert etter det spørsmålet man svarer på, framfor etter hvilken klasse
     * som lager dem.
     */
    /*
     * Hvor filene dette pluginet tar vare på, blir lagt.
     *
     * Ordene handler om et mål framfor om en leverandør, for de samme tre
     * setningene er sanne om en bucket og om et CDN, og den som setter opp en
     * av dem, bryr seg ikke om hvilken av dem han ser på før feltene skiller
     * seg fra hverandre.
     */
    'files' => [
        'where' => 'Filer ligger',
        'where_helper' => 'På panelet ligger de på panelets egen disk, som er dit de alltid har gått, og som ikke krever noe oppsett. Alt annet er et sted dette panelet slipper å holde dem, og som serveres nærmere den som ser på. Et mål som ikke svarer, faller tilbake til panelet framfor å miste en opplasting.',
        'panel' => 'På dette panelet',
        's3' => 'I en bucket (S3, R2, MinIO, Wasabi)',
        'cdn' => 'På et CDN',
        'read_from' => 'Leses fra',
        'read_from_helper' => 'Hvor en fil hentes fra, som ikke alltid er der den ble skrevet. Et CDN foran en bucket hører hjemme her, og det samme gjør en leveringsadresse som er en annen enn den API-et står på. Står den tom, finner målet ut av det selv.',

        'bucket' => 'Bucketen',
        'bucket_helper' => 'Hva som helst som snakker S3-protokollen. Endepunktet og bryteren for stibaserte adresser er det de som ikke er AWS, trenger; la begge stå i fred for AWS selv.',
        'bucket_key' => 'Tilgangsnøkkel',
        'bucket_secret' => 'Hemmelighet',
        'bucket_name' => 'Bucketnavn',
        'bucket_region' => 'Region',
        'bucket_region_helper' => 'auto passer R2 og de fleste som driftes selv. AWS vil ha sin egen, som eu-central-1.',
        'bucket_endpoint' => 'Endepunkt',
        'bucket_endpoint_helper' => 'La den stå tom for AWS. R2, MinIO og resten har hver sitt.',
        'bucket_path_style' => 'Stibaserte adresser',
        'bucket_path_style_helper' => 'Det MinIO og de fleste som driftes selv, trenger. AWS og R2 gjør det ikke.',

        'cdn_title' => 'CDN-et',
        'cdn_helper' => 'Et CDN som snakker Modora-API-et. Tokenet er et server-til-server-token og er full administrator på den kontoen, så det holdes utenfor en eksportert innstillingsfil på samme måte som hver eneste andre legitimasjon her.',
        'cdn_base' => 'Adresse',
        'cdn_base_helper' => 'Der API-et ligger. Serveres filene fra et annet sted, legg den adressen inn i «Leses fra» ovenfor.',
        'cdn_token' => 'Token',
        'cdn_token_helper' => 'Sendes som X-Internal-Token. Den som har det, kan skrive til og slette fra hele kontoen.',
        'cdn_folder' => 'Mappe',
        'cdn_folder_helper' => 'En mappe under kontoen til å holde dette panelets filer i, så ett CDN kan betjene flere paneler uten at de går i beina på hverandre.',

        'move' => 'Flytt det som fortsatt ligger på panelet',
        'move_confirm' => 'Sidefeltikonet, panelbakgrunnen og innloggingsbakgrunnen kopieres til målet, og adressene deres skrives om. Kopiene på dette panelet blir liggende der de er, så ingenting ryker om du ombestemmer deg. Bilder som lastes opp fra nå av, går til målet uansett; dette gjelder bare dem som allerede ligger her.',
        'move_done' => 'Flyttet',
        'move_done_body' => 'Så på :looked, flyttet :moved, fikk ikke flyttet :failed.',
        'check' => 'Test dette',
        'check_ok' => 'Det virker',
        'check_ok_body' => 'En fil ble skrevet, hentet tilbake over den offentlige adressen sin og fjernet igjen.',
        'check_bad' => 'Det gikk ikke',
        'check_panel' => 'Filer er satt til å ligge på dette panelet, så det er ingenting å teste.',
        'check_refused' => 'Målet avviste filen og sa ingenting om hvorfor.',
        'check_unreadable' => 'Det tok imot filen, men den kunne ikke leses tilbake fra :url. Det er adressen en nettleser kommer til å bruke, så en fil ingen får hentet, er et ødelagt bilde senere. Sjekk «Leses fra», og at målet serverer filer offentlig.',
        'bucket_missing' => 'Nøkkelen, hemmeligheten og bucketnavnet trengs alle sammen før det er noe å teste.',
        'cdn_missing' => 'Adressen og tokenet trengs begge før det er noe å teste.',
        'cdn_shape' => 'Det tok imot filen og svarte så i en form dette panelet ikke fant noen adresse i. Det som ble sagt, var: :body',
        'mirror_minutes' => 'Se etter endrede språk hvert',
        'mirror_minutes_helper' => 'I minutter. Å se etter koster lite: hvert opplastede språk leses, hashes og sammenlignes med det som sist ble sendt, så en vanlig runde sender ingenting i det hele tatt. Bare et språk noen har endret, går over linjen.',
        'mirror_now' => 'Kopier språk nå',
        'mirror_done' => 'Språk kopiert',
        'mirror_done_body' => 'Så på :looked, sendte :sent, fikk ikke sendt :failed.',
        'mirror_restore' => 'Gjenopprett språk',
        'mirror_restore_confirm' => 'Dette skriver hvert eneste språk i kopien utenfor panelet over det som ligger på dette panelet. Det er nettopp poenget med den etter en oppgradering, og det finnes ingen måte å fjerne et installert språk på etterpå, så det er verdt å være sikker.',
        'mirror_back' => 'Språk gjenopprettet',
        'mirror_back_body' => 'Fant :found, la tilbake :put, fikk ikke hentet :failed.',
    ],

    'pages' => [
        'look' => 'Look',
        'look_helper' => 'Farge, form og hva panelet heter.',
        'pages' => 'Sider',
        'pages_helper' => 'Serverlisten, sidene inne i en server, og terminalen.',
        'advanced' => 'Avansert',
        'advanced_helper' => 'De to nødutgangene: din egen CSS, og innstillinger som bare gjelder ett område.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Hvilke eggs som er Minecraft, og alt annet om det.',
        'artwork' => 'Egg-bilder',
        'artwork_helper' => 'En side med hvert eneste egg, og en måte å hente spillets bilde til det fra Steam eller IGDB. Den skriver i selve eggene - bildet, og to merkelapper som noterer hvilket spill det er og om bildet ble valgt for hånd - og derfor bærer den sin egen rettighet.',
        'alerts' => 'Varsler',
        'alerts_helper' => 'En sjekk med jevne mellomrom av det panelet allerede måler, men ikke forteller noen: en node som slutter å svare, en disk som fylles, en queue worker som har stoppet, en versjon som ligger etter. Sender til Discord, til panelet eller på e-post. Sin egen rettighet, for den når hver node med jevne mellomrom og sender til en adresse noen har tastet inn.',
        'backups' => 'Oversikt over sikkerhetskopier',
        'backups_helper' => 'En side med hver eneste server og hvor lenge den har vært uten en kopi, sortert slik at de uten noen står øverst. Kun lesing - alt som gjør noe med en kopi, blir på Pelicans egen side for den serveren. Sin egen rettighet, for listen er et kart over hvor hullene er.',
        'public_status' => 'Offentlig statusside',
        'public_status_helper' => 'En side hvem som helst kan åpne uten en konto, som viser hvilke av serverne dine som kjører og hvor mange som er på dem. Det offentliggjøres ingenting før du nevner en server, en maskin eller en tjeneste - alle tre listene starter tomme, og så lenge de er det, svarer adressen 404. Sin egen rettighet, for den avgjør hva som forlater panelet.',
        'game_players' => 'Spillere, andre spill',
        'capacity' => 'Kapasitet',
        'capacity_helper' => 'Hva som er lovet bort på hver maskin mot hva den har lov til å dele ut, så du kan se om det er plass til en server til. Pelicans nodeliste viser et navn og et antall servere, og blokken Maskiner på oversikten viser hva som kjører - dette er det tredje spørsmålet, og regnestykket er Pelicans eget. Kun lesing. Sin egen rettighet.',
        'schedules' => 'Planlagte oppgaver',
        'schedules_helper' => 'Hver eneste planlagte oppgave på panelet, med hvilke av dem som har stoppet: sittende fast midt i en kjøring, forsinket fordi cron ikke kjører, eller aldri kjørt. Pelican viser planlagte oppgaver inne i hver server, og dens egen tilstand har ikke noe ord for noen av de tilfellene. Kun lesing. Sin egen rettighet.',
        'activity' => 'Aktivitet',
        'activity_helper' => 'Hver eneste hendelse panelet logger, i én liste framfor én server om gangen. Pelican fører loggen og viser den per server; dette spør den samme loggen den andre veien. Kun lesing. Sin egen rettighet, for en oversikt over hvem som gjorde hva er noe man gir fra seg med vilje.',
        'access' => 'Servertilgang',
        'access_helper' => 'Bind en rolle til servere, slik at alle med den kan nå dem. Det virker ved å holde Pelicans egne subusers oppdatert, og dem leser serverlisten og hver eneste rettighetssjekk allerede. Sin egen rettighet, for det er den ene siden her som gir folk tilgang til noe.',
        'games' => 'Andre spill',
        'games_helper' => 'De filene ARK og Valheim holder ved siden av verdenen sin, som skjemaer: ARKs verdensinnstillinger, og Valheims lister over administratorer, utestengte og tillatte. Hvilke servere som får dem, er egg-listen på den siden, så en tom liste er allerede en bryter per spill.',
        'game_players_helper' => 'En side inne i Rust, ARK, Valheim og alt annet som svarer på Valves forespørsel, som viser hvem som er tilkoblet og hvor lenge de har vært på. Kun lesing - hva man kan gjøre med noen er forskjellig fra spill til spill, og det er en utgivelse for seg. Hvilke eggs som teller, er den samme listen statussiden bruker.',
        'api' => 'API',
        'api_helper' => 'Nøklene folk har, hvem som har bedt om en, og hva hver av dem får se.',
        'languages' => 'Språk',
        'languages_helper' => 'Hvilke språk dette pluginet svarer på.',
        'files' => 'Lagring og CDN',
        'files_helper' => 'Hvor filene dette pluginet tar vare på, blir lagt, og adressen de leses fra.',
    ],

    'features' => [
        'look' => 'Look-innstillinger',
        'look_helper' => 'Raden i sidefeltet for farge, form og merkevare.',
        'pages' => 'Sideinnstillinger',
        'pages_helper' => 'Raden i sidefeltet for serverlisten, serversidene og terminalen.',
        'advanced' => 'Avanserte innstillinger',
        'advanced_helper' => 'Raden i sidefeltet for din egen CSS og unntak per område.',
        'announcements' => 'Kunngjøringer',
        'announcements_helper' => 'Stripen over toppen av panelet.',
        'nav_links' => 'Navigasjonslenker',
        'nav_links_helper' => 'Dine egne rader i sidefeltet.',
        'login' => 'Innloggingsskjerm',
        'login_helper' => 'Innloggingsskjermens bilde, melding og lenker.',
        'bars' => 'Ressursmålere',
        'bars_helper' => 'De omfargede stolpene for prosessor, minne og disk.',
        'dashboard_status' => 'Versjonslinje',
        'dashboard_status_helper' => 'Toppen av blokken på oversikten: hvilken versjon som er installert, og om en venter.',
        'dashboard_nodes' => 'Maskiner',
        'dashboard_nodes_helper' => 'Resten av blokken på oversikten: dette panelet og hver node, med hva hver av dem bruker.',
        'system_status' => 'Siden Systemstatus',
        'system_status_helper' => 'Siden for maskinen panelet selv kjører på.',
        'sidebar_footer' => 'Sidefeltets fot',
        'sidebar_footer_helper' => 'Tekstlinjen din, panelets versjon og én lenke, nederst i sidefeltet.',
        'console' => 'Konsollknapp',
        'console_helper' => 'Den svevende knappen inne i en server, med konsollen og strømknappene på seg, som når noden direkte. Hvilken form den tar, står i sideinnstillingene for serveren; dette avgjør om den tegnes i det hele tatt.',
        'arranger' => 'Sideoppstiller',
        'arranger_helper' => 'Å dra blokkene på en side inn i den rekkefølgen noen vil ha dem. Den har sin egen rettighet under Roller, så dette avgjør om panelet tilbyr den, og rettigheten avgjør for hvem.',
        'user_themes' => 'Stiler per person',
        'user_themes_helper' => 'Å la hver enkelt velge en stil blant dem du tilbyr, under Utseende i klientdelen. Hvilke stiler som tilbys, står på Look-siden; dette avgjør om noen blir spurt i det hele tatt.',
        'api' => 'API',
        'api_helper' => 'En vei inn utenfra panelet: en adresse en Discord-bot eller et skript av ditt eget kan spørre om det dette pluginet vet - hvem som spiller, hvilke servere som ikke har en sikkerhetskopi, om det er plass til en til på en node. Av registrerer ingen rute i det hele tatt framfor en som avviser, noe som er mindre overflate framfor en høfligere mengde av den. Alle som er logget inn, kan be om en nøkkel som bare svarer for deres egne servere; å gi en, avvise en, tilbakekalle en noen andre har og utstede en som gjelder hele panelet, krever alle rettigheten.',
        'languages' => 'Språk',
        'languages_helper' => 'Å svare hver enkelt på det språket kontoen deres er satt til, der dette pluginet er oversatt til det. Er dette av, får alle engelsk.',
        'files' => 'Lagring og CDN',
        'files_helper' => 'Å holde dette pluginets filer et annet sted enn på panelet: en S3-bucket, eller et CDN. Av betyr ikke «ingen filer» - det betyr panelets egen disk, som er dit de alltid har gått. Det dette avgjør, er om noe annet sted i det hele tatt tilbys. Et mål som ikke svarer, faller tilbake til panelet framfor å miste en opplasting, og en adresse som allerede er skrevet ned, tas aldri tilbake: å endre dette avgjør hvor neste fil går, ikke hvor den forrige ligger.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'En Minecraft-fane i sidefeltet, og en side inne i hver Minecraft-server for å redigere server.properties-en dens som et skjema. Hvilke eggs som teller, er ditt å si.',
        'palworld' => 'Palworld-innstillinger',
        'palworld_helper' => 'En side inne i en Palworld-server for å redigere verdensinnstillingene dens. Den dukker ikke opp på noen annen server, og aldri mens den serveren kjører.',
        'settings_search' => 'Søk i innstillingene',
        'settings_search_helper' => 'Feltet over disse skjemaene som snevrer dem inn til de seksjonene som inneholder det du skriver.',
        'preview' => 'Levende forhåndsvisning',
        'updating' => 'Melding om oppdatering',
        'waitlist' => 'Venteliste',
        'waitlist_helper' => 'Å la noen be om beskjed når en utsolgt pakke er til salgs igjen. Når det kommer varer inn igjen, får alle som venter på den pakken beskjed samtidig, og den går til den som kjøper først - ingenting holdes av til noen, og hver melding sier det. Å få beskjed tar dem av listen, så én forespørsel kjøper ett varsel og aldri et løpende abonnement. Det krever butikken, og det er den ene tingen i butikken som skriver til en kunde som ikke har kjøpt noe.',
        'updating_helper' => 'Én linje øverst på siden mens dette pluginet installerer en oppdatering, og i fem minutter etter at den er ferdig. Den kan ikke vises under selve oppdateringen - mens utgivelsen byttes inn, leser Pelican dette pluginet som ikke installert og laster ingenting av det, så det er ingenting igjen av vårt å tegne med. Den er til for den som møtte en halvtegnet side, ventet og kom tilbake: linjen forteller ham hva han så.',
        'preview_helper' => 'Boksen ved siden av Look-skjemaet som viser hva farger, hjørner og avstander gjør før du lagrer dem.',
        'duplicate' => 'Kopier server',
        'duplicate_helper' => 'En side for å sette opp enda en server nøyaktig som en du allerede har, eller flere på én gang. Filer blir aldri kopiert.',
        'favourites' => 'Markerte servere',
        'favourites_helper' => 'En stjerne på hvert serverkort. De markerte kommer først, og den enkeltes liste ligger på panelet - så stjernene følger med til neste sted man logger inn. Det endrer hva man selv ser, og ingenting for andre. At det ligger på panelet betyr riktignok at det er en fil under storage, som alle med tilgang til maskinen kan lese.',
        'artwork' => 'Egg-bilder',
        'artwork_helper' => 'Administratorsiden som henter hvert eggs bilde fra Steam eller IGDB og skriver det inn i selve egget.',
        'alerts' => 'Varsler',
        'alerts_helper' => 'Sjekken med jevne mellomrom for en node som har sluttet å svare, en disk som fylles, en queue worker som er død, eller en versjon som ligger etter - og den Discord-, panel- eller e-postmeldingen den sender.',
        'backups' => 'Oversikt over sikkerhetskopier',
        'backups_helper' => 'Administratorsiden som lister hver eneste server etter hvor lenge den har vært uten en kopi. Kun lesing.',
        'public_status' => 'Offentlig statusside',
        'public_status_helper' => 'Siden hvem som helst kan åpne uten en konto. Er den av, svarer adressen 404 uansett hva som står på listen.',
        'game_players' => 'Spillere, andre spill',
        'game_players_helper' => 'En side inne i Rust, ARK, Valheim og alt annet som svarer på Valves forespørsel, som viser hvem som er tilkoblet og hvor lenge de har vært på.',
        'owner_alerts' => 'Si fra til folk at serveren deres er nede',
        'owner_alerts_helper' => 'Den eneste delen av dette pluginet som skriver til folk som ikke er administratorer: et varsel i panelet når maskinen bak en av serverne deres slutter å svare, og ett når den kommer tilbake. Av inntil den slås på både her og på Varsler-siden - den skriver til kundene dine, så den krever to avgjørelser framfor én.',
        'my_backups' => 'Varsel om kopier på serverlisten',
        'my_backups_helper' => 'En linje over den enkeltes egen serverliste når en av deres aldri har hatt en kopi eller ikke har hatt en på en stund. Pelicans kort sier hva en server gjør nå; ingenting der sier at en kopi ikke har kjørt på tre uker. Tegnes bare når noe ligger etter, og den nevner ingen server personen ikke allerede kunne åpne.',
        'capacity' => 'Kapasitetsoversikt',
        'capacity_helper' => 'Administratorsiden som viser minne, disk og prosessor lovet bort mot tilgjengelig på hver maskin, sammen med de serverne som har gått tom for kopier, databaser eller tildelinger. Lovet bort framfor brukt - en node kan være travel og tom, eller stille og full.',
        'schedules' => 'Oversikt over planlagte oppgaver',
        'schedules_helper' => 'Administratorsiden som lister hver eneste planlagte oppgave på tvers av panelet, de verste først - sittende fast, forsinket, eller aldri kjørt. Kun lesing; alt som endrer eller kjører en, blir på Pelicans egen side for den serveren.',
        'activity' => 'Panelets aktivitet',
        'activity_helper' => 'Administratorsiden som lister hver eneste loggede hendelse på tvers av panelet, den nyeste først, med hvem som gjorde det og på hvilken server. Kun lesing - den sletter ingenting, og Pelicans egen innstilling avgjør fortsatt hvor lenge linjer blir liggende.',
        'access' => 'Servertilgang etter rolle',
        'access_helper' => 'En side for å binde en rolle til servere, holdt sann i Pelicans egen subuser-tabell. Den gir ingenting før du kobler noe sammen. Å slå den av stopper avstemmingen; tilgang som allerede er gitt, blir stående, og siden har en knapp for å ta den tilbake.',
        'scheduled' => 'Stiler etter tidspunkt',
        'scheduled_helper' => 'Seksjonen på Look-siden som gir panelet en annen stil mellom to tidspunkter på dagen. Den endrer ingenting av det som er lagret - et vindu legges over innstillingene mens siden tegnes og slippes rett etterpå - så å slå den av gir panelets eget utseende tilbake med det samme og mister ingenting.',
        'games' => 'Andre spill',
        'games_helper' => 'ARKs verdensinnstillinger og Valheims lister over administratorer, utestengte og tillatte, som skjemaer framfor som filer i filbehandleren. Hvilke servere som får dem, er egg-listen på siden Andre spill.',
        'quick' => 'Menyen «Gå til»',
        'quick_helper' => 'Ett element øverst på hver side for å hoppe til en server eller en markert side, med et søkefelt over hele serverlisten din. Den markerer også den siden du står på. Det noen finner gjennom den, er det de allerede kunne nå, så den gir ingenting - å slå den av tar bort snarveien og Favoritter-siden med den.',
        'shop' => 'Butikk',
        'shop_helper' => 'Å selge servere fra panelet: butikken og kassen i kundeområdet, hver persons faktureringsside og siden Butikkinnstillinger for valuta, avgift og tekster. Hovedbryteren - slått av kan ingen kjøpe eller betale, og det som allerede er solgt, administreres fortsatt gjennom sidene nedenfor.',
        'packages' => 'Pakker',
        'packages_helper' => 'Administrasjonssiden der det som er til salgs, defineres: en servermal med en pris, en periode og et lager. Egen tillatelse, fordi å sette priser er et annet arbeid enn å merke fakturaer som betalt.',
        'orders' => 'Ordrer',
        'orders_helper' => 'Administrasjonssiden med alt som er kjøpt, serveren hver ordre ble til, og statusen dens - venter, aktiv, suspendert, avbrutt. Egen tillatelse.',
        'invoices' => 'Fakturaer',
        'invoices_helper' => 'Administrasjonssiden med hva som skyldes og hva som er betalt, med en knapp for å merke en faktura som betalt for hånd. Egen tillatelse, fordi den knappen er der penger bokføres.',
        'payments' => 'Betalinger',
        'payments_helper' => 'Betalingsleverandørene - nøklene deres og hvert forsøk gjennom dem. Egen tillatelse, fordi det er der legitimasjonen bor: den som får se hver faktura, trenger ikke å se hemmeligheten.',
        'coupons' => 'Rabattkoder',
        'coupons_helper' => 'Koder som trekker en prosentsats eller et fast beløp fra den første fakturaen, med utløp og et tak på antall bruk. Egen tillatelse.',
        'customers' => 'Kunder',
        'customers_helper' => 'Administratorsiden som snur butikken: én rad per person som har kjøpt, med hva de har, hva de har betalt og hva som står igjen. Sin egen rett, fordi det er den ene siden i butikken som handler om en person i stedet for om en rad - den som setter priser trenger ikke hele historien til en kunde, og den som svarer på en sak gjør det.',
        'credit' => 'Tilgodehavende og refusjoner',
        'credit_helper' => 'Penger butikken holder for en kunde. En refusjon kan gå tilbake til kortet den kom fra, eller bli stående på kontoen som tilgodehavende; uansett skrives det en kreditnota, og tilgodehavende på en konto trekkes automatisk fra neste faktura før kunden i det hele tatt blir bedt om å betale. Sin egen rett, fordi å merke en faktura betalt noterer at penger er kommet inn, mens dette deler penger ut.',
        'upgrades' => 'Oppgradering og nedgradering',
        'upgrades_helper' => 'Å flytte en tjeneste som går, til en annen pakke uten å kjøpe en ny. Det som er igjen av perioden som allerede er betalt, kommer tilbake, den samme strekningen belastes til den nye prisen, og forskjellen faktureres eller legges inn på kundens konto. Hver pakke lister hvilke andre den kan flyttes til, og bare de som deler egget dens, tilbys: et annet egg er en annen server, ikke en større.',
        'addons' => 'Tillegg',
        'addons_helper' => 'Ting som selges ved siden av en pakke: mer minne, en ekstra kopiplass, eller noe som bare er en linje på fakturaen. Hvert av dem sier hvilke pakker det passer til og hva det legger til på serveren, og det belastes enten ved hver fornyelse eller én gang. Kjøpes i kassen eller senere på en tjeneste som går, der det regnes forholdsmessig ut fra det som er igjen av perioden. Sin egen rett, fordi hva et tillegg får legge til på noens server, er en avgjørelse om maskinen deres framfor om en prisliste.',
        'tickets' => 'Saker',
        'tickets_helper' => 'Et sted der kunder kan stille et spørsmål inne fra panelet, ved siden av tjenesten de spør om - som er den ene tingen en chattekanal ikke kan. Besvares på en side her, eller sendes videre til Discord gjennom Modora, alt etter hva Saker-siden er satt til. Hvert spørsmål og hvert svar tas vare på i dette panelet uansett, så ingenting går tapt når den andre enden ikke kan nås. Sin egen rett, fordi å svare kunder er en jobb noen får tildelt framfor en som følger med det å prise pakker.',
        'overview' => 'Butikkoversikt',
        'overview_helper' => 'Siden som svarer på hva som kom inn denne måneden, hva som skyldes, hva de aktive tjenestene er verdt hver måned, og hva som trenger et blikk i dag. Sin egen rett, fordi omsetning ikke er noe alle som får prise en pakke, bør kunne lese.',
        'terminate' => 'Avslutt en tjeneste',
        'terminate_helper' => 'Knappen som stopper en tjeneste nå og sletter serveren dens, filer og alt. Skilt fra retten til bestillinger med vilje: å suspendere, å flytte en forfallsdato og å avbestille lar seg alle gjøre om, og dette gjør det ikke. Den som svarer på saker, kan ha de tre første uten å ha denne.',
        'public_shop' => 'Offentlig butikkside',
        'public_shop_helper' => 'Siden alle kan åpne uten konto, med det som er til salgs. Den publiserer ingenting en innlogget kunde ikke ville sett i butikken, så på eller av er hele avgjørelsen - av svarer 404, som statussiden.',
    ],

    /*
     * Søkefeltet over innstillingsskjemaene. Det filtrerer det som allerede står
     * på siden i nettleseren og spør serveren om ingenting, så det finnes ingen
     * «søker»-tilstand å beskrive og ingen måte det kan slå feil på.
     */
    /*
     * Forhåndsvisningen. Alt i den er en stedfortreder framfor en prøve på
     * panelet ditt, og ordlyden sier det - en boks som nevnte en ekte server
     * eller et ekte tall, ville blitt lest som en.
     */
    'preview' => [
        'label' => 'Forhåndsvisning',
        'card' => 'Et kort',
        'card_helper' => 'Tegnet etter de samme reglene som panelet, med innstillingene på denne siden framfor de lagrede.',
        'button' => 'En knapp',
        'field' => 'Et felt',
        'meter_ok' => 'Greit',
        'meter_warning' => 'Advarsel',
        'meter_danger' => 'Fare',

        /*
         * Forhåndsvisningen av hele siden. En fane og ikke en rute, fordi
         * Pelican sender X-Frame-Options: DENY og nekter å la seg ramme inn av
         * noe som helst, seg selv medregnet - se Support\FullPreview.
         */
        'full' => 'Se hele panelet',
        'full_confirm' => 'Åpner panelet tegnet ut fra innstillingene på denne siden framfor de lagrede. Det skrives ingenting - verdiene holdes i femten minutter, og panelet går tilbake til det vanlige når du forlater forhåndsvisningen eller lagrer.',
        'full_go' => 'Vis meg det',
        'full_failed' => 'Forhåndsvisningen kunne ikke settes i gang',
        'bar' => 'Du ser på innstillinger som ikke er lagret. Ingenting av det er skrevet.',
        'bar_back' => 'Tilbake til innstillingene',
    ],

    'search' => [
        'placeholder' => 'Søk i innstillinger',
        'label' => 'Søk i disse innstillingene',
        'none' => 'Ingenting på denne siden passer. Innstillingene er fordelt på fire sider - prøv Look, Sider, Avansert eller Essentials-innstillinger.',
    ],

    'footer' => [
        'text' => 'Din egen linje',
        'text_helper' => 'Vanlig tekst, høyst 120 tegn. Den blir escapet, akkurat som kunngjøringsstripen - dette tegnes på hver eneste side i panelet, noe som gjør det til feil sted å ta imot oppmerking.',
        'version' => 'Vis panelets versjon',
        'version_helper' => 'Pelicans versjon, ikke dette pluginets. Pluginet sier sin egen på oversikten; det folk leter etter nederst i et sidefelt, er hvilket panel de ser på.',
        'link_label' => 'Lenketekst',
        'link_url' => 'Lenkeadresse',
        'link_url_helper' => 'En http- eller https-adresse, eller en sti i panelet selv som /account. Åpnes i en ny fane.',
    ],

    'layout' => [
        'label' => 'Oppsett',
        'helper' => 'Hvordan panelet er satt opp, ikke hvilken farge det har. Gjelder administrasjonsdelen, serverlisten og klientdelen likt. Hvor navigasjonen ligger, er en standard: den som har satt sin egen under Konto → Navigasjon, beholder den.',
        'default' => 'Sidefelt - Pelicans eget',
        'rail' => 'Ikonskinne - smal, åpner ved hover',
        'top' => 'Navigasjon på toppen - ingen sidefelt',
        'mixed' => 'Topplinje og sidefelt - begge',
        'wide' => 'Bredt - innholdet bruker hele skjermen',
        'focus' => 'Fokusert - smal spalte, sidefeltet legger seg sammen',

        'nav_label' => 'Sidefeltets stil',
        'nav_helper' => 'Hvordan selve sidefeltet tegnes.',
        'nav_default' => 'Standard',
        'nav_floating' => 'Svevende - et kort for seg',
        'nav_flat' => 'Flatt - ingen bakgrunn i det hele tatt',
        'nav_bordered' => 'Med kant - en strek, ikke en flate',

        'topbar_label' => 'Topbarens stil',
        'topbar_helper' => '«Skjult» gjelder bare på datamaskin - på en telefon bærer topbaren den eneste veien tilbake til menyen.',
        'topbar_default' => 'Standard',
        'topbar_floating' => 'Svevende - en løsrevet linje',
        'topbar_flush' => 'I flukt - flat, uten uskarphet',
        'topbar_hidden' => 'Skjult på datamaskin',

        'card_label' => 'Kortstil',
        'card_helper' => 'Seksjoner, widgets, serverkort og blokkene over konsollen.',
        'card_default' => 'Standard - hevet med en myk kant',
        'card_flat' => 'Flatt - uten løft',
        'card_outline' => 'Omriss - en kant og ingenting bak',
        'card_glass' => 'Frostet - bakgrunnen skinner gjennom',
        'card_sharp' => 'Skarpt - rette hjørner',
    ],

    'servers' => [
        /*
         * Stjernen på et kort. Gitt videre til skriptet framfor skrevet inn i
         * det, så tekstene blir det ene stedet tekster bor.
         */
        'favourite' => 'Marker denne serveren',
        'favourited' => 'Markert - vises først',

        /*
         * Pillen ved siden av Pelicans egne faner. Navngitt etter hva den gjør
         * med listen framfor som en fjerde fane, fordi den filtrerer den fanen
         * som er valgt, i stedet for å erstatte den.
         */
        'favourites_tab' => 'Favoritter',
        'favourites_empty' => 'Ingenting er markert på denne siden. Bruk stjernen på et serverkort for å legge til ett - og legg merke til at dette filtrerer de serverne som allerede står her: en markert server på en senere side blir ikke skjult, den står bare ikke på denne.',
        'favourites_failed' => 'De markerte serverne dine kunne ikke lagres, så de er satt tilbake til det panelet sist hadde. Nettleserens konsoll sier hva forespørselen svarte.',

        'art' => 'Spillbilde',
        'art_helper' => 'Pelican tegner eggets bilde på hvert kort. Dette avgjør hva som gjøres med det.',
        'art_faded' => 'Falmet - et skjær bak teksten',
        'art_cover' => 'Dekkende - bak navnet, toner ut',
        'art_off' => 'Av',
        'art_dim' => 'Gjør bildet mørkere',
        'art_dim_helper' => 'Ett spills bilde er en lys himmel, og et annets er en hule.',

        'status' => 'Tilstandsmerke',
        'status_helper' => 'Hvor fargen for kjører/starter/stoppet vises.',
        'status_bar' => 'Stolpe - langs venstre kant',
        'status_edge' => 'Kant - tvers over toppen',
        'status_dot' => 'Prikk - i hjørnet',
        'status_off' => 'Av',

        'density' => 'Korthøyde',
        'density_comfortable' => 'Romslig',
        'density_compact' => 'Kompakt - til mange servere',

        'filter_label' => 'Sett tekst på filterknappen',
        'filter_label_helper' => 'Pelican filtrerer allerede denne listen etter egg og etter eier, på tvers av alle sider - men veien inn er et ikon uten tekst ved siden av søkefeltet. Dette setter ordet på.',
        'filter_button' => 'Filtre',

        'columns' => 'Kort ved siden av hverandre på en bred skjerm',
        'columns_helper' => 'Gjelder bare rutenettet, og bare fra 1280px og opp. Pelicans eget tak er to.',
    ],

    'controls' => [
        'mode' => 'Konsollknapp på hver serverside',
        'mode_helper' => 'Én svevende knapp, på hver eneste side inne i en server. Den åpner konsollen oppå det du holdt på med, med tilstanden og strømknappene i hodet sitt - den når noden direkte, slik serverlisten gjør, framfor gjennom konsollsidens websocket. Den dukker aldri opp på konsollsiden, som allerede har alt sammen.',
        'mode_full' => 'Konsoll og strømknapper',
        'mode_console' => 'Bare konsoll',
        'mode_off' => 'Av',

        'label' => 'Knappen viser',
        'label_text' => 'Ikon og navn',
        'label_icon' => 'Bare ikon',

        'position' => 'Hvor den svever',
        'position_helper' => 'Mot den kanten du minst sannsynlig leser.',
        'position_top' => 'Topp',
        'position_right' => 'Høyre',
        'position_bottom' => 'Bunn',
    ],

    'console' => [
        'stats' => 'Blokker over konsollen',
        'stats_helper' => 'Pelican viser navnet, tilstanden, adressen og de tre bruksatallene over terminalen. Å skjule dem gir konsollen høyden tilbake.',
        'stats_tiles' => 'Fliser - merkelapp, tall og et ikon',
        'stats_plain' => 'Enkle - slik Pelican tegner dem',
        'stats_off' => 'Skjult',
    ],

    'terminal' => [
        'helper' => 'Gis videre til terminalen selv, så de trer i kraft ved neste sidelasting framfor i det øyeblikket de lagres.',

        'renderer' => 'Tegnet av',
        'renderer_helper' => 'Pelican tegner terminalen på GPU-en, noe som er mye raskere ved en vegg av rullende utdata. En nettleser holder bare et visst antall GPU-kontekster i live om gangen - færre på en telefon - og tar den eldste bort når grensen passeres; terminalen tegner da ingenting i det hele tatt, uten en feil. Blir konsollen din tom mens alt annet ved den ser riktig ut, er det denne innstillingen man endrer.',
        'renderer_webgl' => 'GPU-en - Pelicans egen, raskere',
        'renderer_dom' => 'Nettleseren - tregere, tegner alltid',

        'scheme' => 'Fargeskjema',
        'scheme_helper' => 'Den ene terminalinnstillingen Pelican ikke tilbyr. «Følg temaet» utleder fargene fra aksenten, og det er derfor dette finnes i det hele tatt.',
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
        'cursor_helper' => 'Konsollen tar ikke imot tasting - kommandofeltet ligger under den - så dette er der utdataene stoppet, ikke der du er.',
        'cursor_underline' => 'Understrek - Pelicans egen',
        'cursor_block' => 'Blokk',
        'cursor_bar' => 'Strek',

        'blink' => 'Blinkende markør',

        'scrollback' => 'Rullehistorikk',
        'scrollback_helper' => 'Hvor langt tilbake konsollen kan rulles. Hver eneste linje holdes i nettleseren, så en pratsom server med en høy innstilling er ekte minne på den maskinen som leser med.',
        'scrollback_lines' => ':lines linjer',
    ],

    'notice' => [
        'text' => 'Melding',
        'text_helper' => 'Én linje, opptil 200 tegn. Den escapes på vei inn og på vei ut, så den kan ikke bære oppmerking inn på en side andre folk laster.',
        'style' => 'Tone',
        'style_info' => 'Info',
        'style_warning' => 'Advarsel',
        'style_danger' => 'Haster',
        'style_accent' => 'Aksentfarge',
        'scope' => 'Vises for',
        'scope_all' => 'Alle',
        'scope_client' => 'Bare utenfor administrasjonsdelen',
        'scope_admin' => 'Bare i administrasjonsdelen',
        'link_label' => 'Knappetekst',
        'link_url' => 'Knappeadresse',
        'link_url_helper' => 'https:// eller en sti inne i dette panelet, for eksempel /account. Alt annet blir ignorert - en lenke i en stripe på hver eneste side er ikke et sted for et opplegg ingen venter seg.',
        'dismissible' => 'Kan lukkes',
        'dismissible_helper' => 'At den er lukket, huskes per nettleser, og bare for denne meldingen: endre teksten, så kommer den tilbake til alle.',
        'dismiss' => 'Lukk',
    ],

    'preset' => [
        'label' => 'Stil',
        'helper' => 'Velg et utseende å starte fra. Det fyller ut alt nedenfor, som du så kan endre. «Ingen» slår temaet av og lar panelet stå nøyaktig som Pelican leverer det.',
        'options' => [
            'none' => 'Ingen - ikke noe tema',
            'legend' => 'Legend - rød ild over i blått lyn',
            'ember' => 'Ember - varm svart, oransje aksent',
            'midnight' => 'Midnight - dyp blå, rolig',
            'crimson' => 'Crimson - rød, skarpe hjørner, kompakt',
            'forest' => 'Forest - grønn, rund, uten skjær',
            'nebula' => 'Nebula - lilla med en bakgrunn i overgang',
            'terminal' => 'Terminal - grønt på svart, fast bredde, skarp',
            'console' => 'Console - rund og romslig, til et nettbrett',
            'nord' => 'Nord - Nord-paletten, dempet',
            'solarized' => 'Solarized - Solarized dark, cyan aksent',
            'paper' => 'Paper - lys, høy kontrast, flat',
            'daylight' => 'Daylight - lys og varm, med et mykt skjær',
            'mono' => 'Mono - gråtoner, flat og tett',
        ],

        'save' => 'Lagre som en stil',
        'save_confirm' => 'Beholder de fargene, hjørnene, den bakgrunnen, skriften, de ikonene og målergrensene du har på skjermen akkurat nå - under et navn du selv velger, i velgeren ved siden av de innebygde. Den lagrer det som står på siden, ikke det som sist ble lagret.',
        'save_name' => 'Navn',
        'save_name_helper' => 'Hva den kommer til å hete i velgeren. Å lagre under et navn du har brukt før, erstatter det.',
        'saved' => 'Stil lagret',
        'save_failed' => 'Den stilen kunne ikke lagres',
        'save_full' => 'Det er plass til :max stiler av dine egne. Slett en først.',

        'delete' => 'Slett en stil',
        'delete_which' => 'Hvilken',
        'delete_confirm' => 'Bare dine egne stiler kan slettes; de innebygde kan ikke. Det endres ingenting ved hvordan panelet ser ut akkurat nå - en stil er et utgangspunkt, og hver eneste verdi den satte, står allerede i innstillingene nedenfor.',
        'deleted' => 'Stil slettet',
        'deleted_current' => 'Det var den dette panelet var satt til. Innstillingene dens er uendret og står fortsatt på denne siden - velg en stil, eller lagre dem på nytt under et navn.',
    ],

    'user_themes' => [
        'label' => 'Stiler folk selv får velge',
        'helper' => 'De stilene som er krysset av, dukker opp på en Utseende-side i klientdelen, der alle som er logget inn kan velge en til seg selv. Det endrer hva de selv ser, og ingenting for andre. Ingen kryss betyr at ingen velger noe, og at panelet holder ett utseende - som er det det gjør nå.',
    ],

    'mode' => [
        'label' => 'Paneltilstand',
        'helper' => 'Hvilken tilstand panelet åpner i. Den som ikke har valgt selv, får denne; velgeren i brukermenyen lar dem fortsatt endre den, med mindre du låser den nedenfor.',
        'dark' => 'Mørk',
        'light' => 'Lys',
        'system' => 'System - følg den besøkendes egen innstilling',
    ],

    'font' => [
        'label' => 'Panelets skrift',
        'helper' => 'Hver mulighet er en familie operativsystemet allerede har - det hentes ingenting fra en skriftleverandør. Terminalen er ikke berørt: skriften dens er den enkeltes eget valg, under Konto.',
        'default' => 'Standard - Pelicans egen',
        'mono' => 'Fast bredde',
        'rounded' => 'Rundet',
        'serif' => 'Serif',
        'system' => 'System - den denne maskinen bruker',
    ],

    'surface' => [
        'label' => 'Flatefarge',
        'helper' => 'Kortene og panelene. Lysere og mørkere nyanser utledes av den.',
        'placeholder' => 'Følg temaet',
    ],

    'radius' => [
        'label' => 'Hjørner',
    ],

    'accent' => [
        'label' => 'Aksentfarge',
        'helper' => 'Brukes til knapper, lenker, det aktive navigasjonspunktet og fokusringer.',

        /*
         * Sagt, ikke håndhevet. En farge dette advarer om, blir lagret likevel:
         * det er noens panel, tallet måler én ting, og det finnes gode grunner
         * til å ville ha en aksent som scorer dårlig. Velgeren sier hva den ser,
         * og går til side.
         */
        'contrast_dark' => 'Lesbarhet: :ratio mot et mørkt panel. Under 3 er en aksent vanskelig å lese som knapp eller lenke - en lysere løfter den.',
        'contrast_light' => 'Lesbarhet: :ratio mot et lyst panel. Under 3 er en aksent vanskelig å lese som knapp eller lenke - en mørkere løfter den.',
    ],
    'density' => [
        'label' => 'Tetthet',
        'helper' => 'Kompakt strammer avstandene så det er plass til flere rader på skjermen.',
        'comfortable' => 'Romslig',
        'compact' => 'Kompakt',
    ],
    'force_dark' => [
        'label' => 'Tving mørk tilstand',
        'helper' => 'Skjuler velgeren mellom lys og mørk og holder hver bruker på det mørke temaet.',
    ],
    'glass' => [
        'label' => 'Frostet topbar',
        'helper' => 'Gjør topbaren og bakgrunnen bak dialoger uskarp. Slå av på svakere enheter.',
    ],
    'glow' => [
        'label' => 'Aksentskjær',
        'helper' => 'En myk aksentskygge på de viktigste knappene, den aktive navigasjonen og innloggingskortet.',
    ],

    'background' => [
        'label' => 'Bakgrunnstype',
        'helper' => 'Aurora er temaets egen bakgrunn: aksentskjær med en fin kornethet.',
        'aurora' => 'Aurora (standard)',
        'solid' => 'Én farge',
        'gradient' => 'Overgang',
        'image' => 'Bilde',
        'color' => 'Farge',
        'base' => 'Fargen bak skjæret',
        'base_helper' => 'Det siden hviler på før aksentskjæret males over den. La feltet stå tomt for å beholde panelets standard, som er nesten svart i mørk og nesten hvit i lys. Setter du den, beholder et skjema sin egen nattfarge og blir likevel lyst opp.',
        'color_end' => 'Andre farge',
        'angle' => 'Retning',
        'upload' => 'Last opp et bilde',
        'upload_helper' => 'Opptil 8 MB. Et bilde som er lastet opp, går foran adressen nedenfor.',
        'url' => 'Eller en URL',
        'url_helper' => 'Må begynne med https:// og kunne nås utenfra.',
        'dim' => 'Demp',
        'dim_helper' => 'Uten demping er hvit tekst på et lyst bilde uleselig.',
        'blur' => 'Uskarphet',
    ],

    'channel' => [
        'installed' => 'installert',
        'version' => 'Installer en bestemt versjon',
        'version_helper' => 'Enhver utgivelse på denne kanalen, ikke bare den nyeste - til å gå tilbake når noe nytt viser seg å være verre, eller fram til et bygg noen har bedt deg prøve. Bare mens oppdateringer ikke installerer seg selv: med det på ville valget ditt bare holdt til neste sjekk.',
        'version_placeholder' => 'Velg en versjon',
        'version_install' => 'Installer denne versjonen',
        'version_confirm' => 'Panelet laster ned den utgivelsen, bygger assetene sine på nytt og tømmer cachene sine. Innstillingene dine blir beholdt. Det er lov å gå tilbake til en eldre versjon, og det blir ikke rullet tilbake for deg - velg den nyere igjen for å gå framover.',
        'label' => 'Oppdateringskanal',
        'helper' => 'Hvilke utgivelser Tema-siden tilbyr. Beta får nye versjoner først, og de skarpe kantene først også.',
        'token' => 'Token til dev-repositoriet',
        'token_helper' => 'Dev-kanalen utgis fra et privat repositorium, så for å lese den trengs et GitHub-token - et fine-grained personal access token med lesetilgang til innholdet i nettopp det repositoriet, og ingenting mer. Stabil og beta er offentlige og trenger ingen. Det blir værende på dette panelet: det skrives ikke til en eksportert innstillingsfil.',
        'stable' => 'Stabil',
        'beta' => 'Beta',
        'dev' => 'Dev (arbeidsgren)',
        'auto' => [
            'label' => 'Installer oppdateringer automatisk',
            'helper' => 'Av lar oppdateringen være opp til deg. På får panelet til å sjekke den valgte kanalen og installere alt som er nyere - det bygger assetene sine på nytt imens og er utilgjengelig i et par minutter, så daglig og ukentlig går kl. 04:00. Krever at panelets cron kjører.',
            'interval' => 'Sjekk hvert',
            'minute' => 'Hvert minutt',
            'five_minutes' => 'Hvert 5. minutt',
            'ten_minutes' => 'Hvert 10. minutt',
            'thirty_minutes' => 'Hvert 30. minutt',
            'hourly' => 'Hver time',
            'daily' => 'Hver dag (04:00)',
            'weekly' => 'Hver uke (mandag 04:00)',
        ],
    ],

    /*
     * Språk-fanen.
     *
     * Forsiktig med hva den påstår. Pelican lar allerede hver enkelt velge et
     * språk for hele kontoen sin og bruker det allerede; ingenting her endrer
     * det eller bør gjøre det. Dette avgjør bare om dette pluginets egne tekster
     * følger det valget.
     */
    'languages' => [
        'section_helper' => 'Pelican lar allerede hver enkelt velge et språk for kontoen sin, og dette pluginet følger det der det er oversatt. Her avgjør du hvilke av dem det følger. De fleste språkene står på en lav prosent med vilje: det som blir oversatt først, er den delen alle ser på hver eneste side - strømknappene over en konsoll og nodemålerne - og resten kommer etter hvert som folk bidrar med den.',
        'panel' => 'La dette avgjøre språket i hele panelet',
        'panel_helper' => 'På setter et språk dette pluginet ikke bærer - eller ett som er slått av nedenfor - hele panelet på engelsk for den leseren, ikke bare disse sidene. Av følger bare dette pluginet listen, og Pelican fortsetter å snakke det kontoen er satt til, som betyr at en leser kan møte to språk på én skjerm. Ingen konto blir endret verken den ene eller den andre veien: slå et språk på igjen, så har de det tilbake.',
        'label' => 'Språk å svare på',
        'helper' => 'Å fjerne krysset sender de leserne som har det satt på kontoen sin, tilbake til engelsk for dette pluginet alene - resten av panelet snakker fortsatt språket deres. Engelsk står ikke på listen, fordi alt faller tilbake til det.',
        'under' => 'tilbys ikke før det er kommet lenger - kryss av for å tilby det likevel',
        'done' => ':percent % oversatt',
        'main' => 'Hovedspråk',
        'main_helper' => 'Det en leser får når hans eget språk ikke kan brukes - enten bærer dette pluginet det ikke, eller så er det ikke krysset av nedenfor. Det var alltid engelsk; i et lag som ikke arbeider på engelsk, var det et galt svar gitt med sikkerhet. Krysset kan ikke fjernes nedenfor, fordi alt faller tilbake til det.',
        'labels' => 'Hva hvert språk heter',
        'labels_helper' => 'Navnet lesere og administratorer ser i velgerne. La ett stå tomt for å beholde det navnet dette pluginet kjenner det under. Et språk lastet opp under et navn du selv har funnet på, har ingen, så det ville stått med koden sin til du gir det ett her.',
        'labels_code' => 'Kode',
        'labels_name' => 'Vises som',
        'download' => 'Last ned en oversettelsesfil',
        'download_from' => 'Start fra',
        'download_from_helper' => 'En JSON med hver eneste tekst i dette pluginet. Velg engelsk til et språk ingen har begynt på, eller et bestående for å bygge videre på det som allerede er oversatt.',
        'code' => 'Språkkode',
        'code_helper' => 'Den koden filen er til. En ekte locale, slik kontoer bruker dem - fr, de, pt_BR - når fram til de leserne som har den satt, og må stemme nøyaktig, ellers gjør den det ikke. Et navn du selv finner på, som Gaming-NO, er lov og virker annerledes: Pelican lar bare en konto ha en ekte locale, så ingen kan velge ditt. Det kan nås som hovedspråket ovenfor, som er det alle får hvis eget ikke kan brukes.',
        'url' => 'Eller hent den fra en adresse',
        'url_helper' => 'En https-adresse panelet kan nå - et CDN, en bucket, en rå fil i et repository. Den hentes én gang når du lagrer og skrives på samme måte som en som lastes opp, så det gjør ingenting å endre filen på den adressen senere, før du lagrer igjen. En fil valgt ovenfor vinner over en adresse som står igjen i dette feltet.',
        'upload' => 'Last opp en oversettelsesfil',
        'upload_helper' => 'JSON-filen ovenfra, med verdiene oversatt. Den skrives utenfor pluginet, så en oppdatering kaster den ikke, og den legges over engelsk nøkkel for nøkkel - en fil med halvparten av tekstene gir deg et halvt språk og engelsk til resten.',
        'uploaded' => ':count tekster installert til :code',
        'uploaded_halves' => ':mine av dem er dette pluginets egne tekster, og :panel er panelets. Null på den ene siden betyr at den halvdelen av filen ikke inneholdt noe - pluginets nøkler begynner med essentials:: og panelets gjør ikke.',
        'uploaded_skipped' => ':count ble hoppet over: tomme, eller nøkler dette pluginet ikke har. De første: :keys',
        'upload_failed' => 'Den filen kunne ikke leses',
        'upload_failed_body' => 'Det må være JSON-filen fra nedlastingen ovenfor - et flatt objekt av nøkler og tekster. Sjekk at en editor ikke har lagret den som noe annet.',
    ],

    'windows' => [
        'add' => 'Legg til et vindu',
        'from' => 'Fra',
        'to' => 'Til',
        'to_helper' => 'Tidligere enn starten betyr at det går over midnatt - 22:00 til 06:00 er natten.',
        'preset' => 'Stil',
        'days' => 'Dager',
        'days_helper' => 'La dem alle stå uten kryss for hver dag. Et vindu som går over midnatt, hører til den dagen det begynner på, så fredag 22:00 til 06:00 dekker lørdag morgen.',
        'day_mon' => 'Mandag',
        'day_tue' => 'Tirsdag',
        'day_wed' => 'Onsdag',
        'day_thu' => 'Torsdag',
        'day_fri' => 'Fredag',
        'day_sat' => 'Lørdag',
        'day_sun' => 'Søndag',
    ],

    'arranger' => [
        'label' => 'Sideoppstiller',
        'helper' => 'Knappen «Still opp siden», på hver eneste side i panelet. Alle med rettigheten Still opp får den og kan også sette den oppstillingen alle andre starter fra, eller en til en rolle. Av skjuler den for alle; oppstillinger som allerede er lagret, blir der de er.',
        'roles' => 'En oppstilling er ikke en rettighet. En blokk en rolle skjuler, er fortsatt en blokk noen kunne nådd ved å taste adressen - det som stopper det, er Pelicans egne rettigheter, på rolle-siden. Tre lag legges på i denne rekkefølgen: den alle starter fra, så leserens rolle, og så det de selv har flyttet.',
        'users' => 'La alle stille opp sine egne sider',
        'users_helper' => 'På lar alle som er logget inn flytte om på og skjule blokker på de sidene de allerede kan se, bare for seg selv - det endrer ingenting for andre. Å sette den oppstillingen alle starter fra, blir hos rettigheten Still opp.',
    ],

    'brand' => [
        'logo_height' => 'Logohøyde',
        'logo_height_helper' => 'Pelican leverer 2rem. Større verdier gjør sidefeltets hode høyere med.',
        'logo_url' => 'Erstatt logoen',
        'logo_url_helper' => 'La feltet stå tomt for å beholde det Pelicans egne innstillinger peker på.',
    ],

    'login' => [
        'image' => 'Bakgrunnsbilde',
        'image_helper' => 'Bare til innloggingsskjermen. Uten ett viser den fortsatt panelets bakgrunn.',
        'url' => 'Eller en URL',
        'blur' => 'Uskarphet på kortet',
        'blur_helper' => 'Froster kortet så bildet bak skinner gjennom.',
        'width' => 'Kortets bredde',
        'position' => 'Bildets utsnitt',
        'position_helper' => 'Hvilken del av bildet som overlever å bli beskåret til skjermen.',
        'position_center' => 'Midt',
        'position_top' => 'Topp',
        'position_bottom' => 'Bunn',
        'position_left' => 'Venstre',
        'position_right' => 'Høyre',
        'align' => 'Kortets plassering',
        'align_helper' => 'Hvor innloggingskortet sitter tvers over skjermen.',
        'align_center' => 'Midt',
        'align_start' => 'Venstre',
        'align_end' => 'Høyre',
        'opacity' => 'Kortets dekkevne',
        'opacity_helper' => 'Lavere slipper mer av bildet gjennom kortet.',
        'glow' => 'Aksentskjær',
        'glow_helper' => 'Glorien rundt kortet. Av beholder kanten og dybden dens.',
        'hide_heading' => 'Skjul overskriften',
        'hide_heading_helper' => 'Fjerner tittelen over skjemaet og lar skjemaet stå alene.',
        'hide_footer' => 'Skjul foten',
        'hide_footer_helper' => 'Fjerner linjen under kortet som lenker til pelican.dev.',
        'above' => 'Linje over skjemaet',
        'above_helper' => 'Én linje, vist til alle som kommer til innloggingsskjermen. La feltet stå tomt for ingen.',
        'notice' => 'Melding under kortet',
        'notice_helper' => 'Én linje, vist til alle som kommer til innloggingsskjermen. La feltet stå tomt for ingen.',
    ],

    'advanced' => [
        'css' => 'Egen CSS',
        'css_helper' => 'Opptil 100 KB. Lagres i storage, ikke i .env.',
        'reference' => 'CSS-oppslag',
        'reference_helper' => 'Hver eneste variabel og klasse dette temaet og panelet stiller fram.',
    ],

    'areas' => [
        'add' => 'Legg til et område',
        'area' => 'Område',
        'inherit' => 'Felles',
        'radius' => 'Hjørner',
        'radius_sharp' => 'Skarpe',
        'radius_normal' => 'Normale',
        'radius_round' => 'Runde',
        'surface' => 'Flatefarge',
        'surface_helper' => 'Kortene og panelene inne i dette området; lysere og mørkere nyanser utledes av den.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Konsoll (resten av siden)',
            'files' => 'Filsiden',
            'edit' => 'Redigeringssiden',
            'server' => 'Andre serversider og faner',
        ],
    ],

    'bars' => [
        'base' => 'Grunnfarge',
        'base_green' => 'Grønn',
        'base_accent' => 'Aksentfarge',
        'warning' => 'Ravgul fra',
        'danger' => 'Rød fra',
    ],

    'icons' => [
        'stroke' => 'Strektykkelse',
        'stroke_thin' => 'Tynn',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Fet',
        'scale' => 'Størrelse',
        'accent' => 'Menyikoner i aksentfargen',
        'accent_helper' => 'Gjelder ikonene i sidefeltet og i topbaren.',
        'pack' => 'Ikonpakke',
        'pack_helper' => 'Hvilket sett velgeren nedenfor henter fra. Hvert ikonsett som er installert på serveren, tilbys, pluss Essentials-settet som følger med dette pluginet og enhver pakke du laster opp. Én forskjell er verdt å kjenne: et strekikon tegnes i menyens farge og følger hover og den aktive raden, mens Essentials-ikonene er bilder og beholder sine egne farger i stedet. Det avgjøres av hva filen er, ikke av hvilket sett den kom fra.',
        'pack_custom' => 'Opplastet pakke',
        'pack_shipped' => 'Essentials-ikoner',
        'use_shipped' => 'Bruk Essentials-ikonene overalt',
        'use_shipped_confirm' => 'Setter pakken til Essentials-ikonene og fyller hver menyrad nedenfor med det ikonet som er tegnet til den - konsollen får terminalen, oppstart får startknappen, og så videre. Det erstatter de radene du har nå, og det lagres ingenting før du trykker Lagre, så å lukke siden angrer det.',
        'pack_upload' => 'Last opp en pakke',
        'pack_upload_helper' => 'En .zip med SVG-filer. Hver fil blir til et ikon oppkalt etter den - logo.svg blir custom-logo. Å laste opp erstatter den pakken som ligger der nå. Filer over 256 KB og alt over 4 000 ikoner blir utelatt, og du får vite hvor mange: som målestokk er hele Tabler-settet nær seks tusen ikoner i omtrent tre megabyte, så en pakke som er mye større, bærer noe annet enn ikoner, og det meste av den blir hoppet over. En stor opplasting kan også bli avvist før dette feltet sier noe som helst, av upload_max_filesize og post_max_size i php.ini på panelets vert - ingen innstilling her kan heve dem.',
        'pack_partial' => ':count ikoner installert, men ikke alle',
        'pack_partial_body' => 'Hoppet over: :big for store til et ikon, :unusable ikke brukbare som SVG, :duplicate med et navn som allerede er tatt, :empty sto igjen uten noe å tegne da de var renset. En SVG over 256 KB er nesten alltid et bilde pakket inn i en framfor en tegning - eksporter den i ikonstørrelse, så blir den et par kilobyte. Et ikon som står igjen uten noe å tegne, inneholdt bare noe dette ikke serverer - er det en hel pakke, er det verdt å melde fra.',
        'pack_stopped_files' => 'Den stoppet også ved grensen for hvor mange ikoner en pakke får inneholde.',
        'pack_stopped_size' => 'Den stoppet også fordi resten av pakken folder seg ut til mer enn panelet kan holde i minnet på én gang - zip-filen kan være mindre enn det, siden SVG komprimerer omtrent fem til én.',
        'overrides' => 'Erstatt ikoner',
        'overrides_helper' => 'Én rad per ikon du vil ha endret. Velg menypunktet, og velg så et ikon fra pakken ovenfor, gi en adresse, eller last opp et bilde du selv har. Er mer enn ett fylt ut, vinner opplastingen, så adressen, så pakken.',
        'overrides_key' => 'Menypunkt',
        'overrides_value' => 'Ikon fra pakken',
        'overrides_url' => 'Eller en adresse',
        'overrides_url_helper' => 'En https-adresse til et bilde du selv hoster - et CDN, en bucket, hvor som helst nettleseren kan nå. Det kopieres ingenting til panelet, så å bytte ut filen på den adressen endrer ikonet uten å røre denne siden; baksiden er et ikon som forsvinner når adressen gjør det. Det beholder sine egne farger, som et bilde som er lastet opp.',
        'overrides_file' => 'Eller last opp et bilde',
        /*
         * Sier hva forskjellen faktisk er, for den er ikke innlysende, og det er
         * grunnen til at man velger det ene framfor det andre.
         */
        'overrides_file_helper' => 'PNG, SVG eller ICO. Et ikon fra pakken tegnes i menyens egen farge og følger hover og den aktive raden; et bilde som er lastet opp, beholder sine egne farger og gjør ikke det. Til en logo er det som regel det man vil ha.',
        'overrides_add' => 'Erstatt enda et ikon',
        'overrides_search' => 'Skriv et navn, eller menypunktet…',
    ],

    /*
     * Ikke under merkevare. Merkevare handler om hvordan panelet ser ut; dette
     * handler om hvordan dette pluginet viser seg i det, og det er et annet
     * spørsmål som besvares på en annen side.
     */
    'identity' => [
        'nav_icon' => 'Ikon til raden «Essentials-innstillinger»',
        'nav_icon_helper' => 'PNG, SVG eller ICO, opptil 8 MB. Erstatter ikonet på nettopp den ene raden i sidefeltet; la feltet stå tomt for det dette pluginet leveres med. Det tegnes som et bilde framfor som et ikon, så det beholder sine egne farger i stedet for å følge teksten - noe som som regel er det en logo vil. Filen serveres framfor å være innebygd, så hver nettleser henter den én gang, men det er likevel verdt å eksportere noe lite: et par kilobyte er rikelig til en rad på tjue piksler. Slår en opplasting feil før dette feltet sier noe, er grensen den traff upload_max_filesize i panelets php.ini.',
    ],
];
