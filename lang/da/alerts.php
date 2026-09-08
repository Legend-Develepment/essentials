<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Vagthunden.
 *
 * Hver besked herfra læses på en telefon, klokken tre om natten, af en, der sov
 * for et minut siden. Hver enkelt siger, hvilken maskine, hvad der er galt, og
 * ikke andet - detaljen hører til på den side, vedkommende åbner bagefter, ikke
 * i den linje, der vækkede ham.
 *
 * At noget er kommet sig, er skrevet som en nyhed frem for som en fodnote. „Er
 * det tilbage endnu" er det spørgsmål, nogen ellers ville stå op for.
 *
 * „Node", „Wings", „daemon", „webhook", „queue", „Discord" og „SMTP" bliver
 * stående på engelsk: det er under de navne, man finder dem i Pelican, på
 * værten og i alt, hvad der skrives om dem.
 */

return [
    'title' => 'Advarsler',
    'nav_label' => 'Advarsler',
    'subheading' => 'Panelet ved allerede, hvornår en node holder op med at svare, hvornår en disk fyldes op, og hvornår køen går i stå. Det her er det, der fortæller dig det.',

    // ---- kanalerne, og hvad de sidst gjorde -------------------------------
    'channels' => 'Hvor beskederne går hen',
    'channels_helper' => 'Hvad hver kanal gjorde, sidst den blev bedt om at sende noget. En kanal, der er slået til og stille afviser, ser præcis ud som et panel, hvor intet er galt, og derfor står det her først på siden.',

    'state_off' => 'Fra',
    'state_untried' => 'Der er endnu ikke sendt noget',
    'state_ok' => 'Leveret',
    'state_failed' => 'Afvist',

    // ---- hvornår ----------------------------------------------------------
    'when' => 'Hvor tit',
    'when_helper' => 'Tjekkene kører i baggrunden, så de kræver en queue worker. Uden en bliver der ikke sendt noget, og intet siger det — brug „Send en prøve", som ikke går gennem køen.',

    'every' => 'Tjek hvert',
    'every_helper' => 'Hvert tjek når ud til hver nodes daemon, så det er én forespørgsel pr. node pr. gennemløb. Femten minutter er nok til at høre om et nedbrud, mens det stadig er et nedbrud.',
    'every_off' => 'Fra — slet ingen tjek',
    'every_five' => '5 minutter',
    'every_fifteen' => '15 minutter',
    'every_thirty' => '30 minutter',
    'every_hourly' => 'Time',
    'every_daily' => 'Dag',

    'repeat' => 'Mind mig om det, mens det varer',
    'repeat_helper' => 'Der sendes en besked, når noget ændrer sig, og en til, når det kommer sig. Det her lægger en påmindelse til, mens et problem stadig står på. Nul betyder ingen påmindelser — en kanal, der gentager sig selv hvert kvarter, er en kanal, folk slår fra.',
    'hours' => 'timer',

    // ---- hvorhen ----------------------------------------------------------
    'where' => 'Kanaler',
    'where_helper' => 'Mere end én giver mening. De fejler på forskellige måder.',

    'discord' => 'Discord',
    'discord_helper' => 'Der, hvor en besked faktisk bliver læst af en, der ikke sidder og kigger på panelet.',
    'webhook' => 'Webhook-adresse',
    'webhook_helper' => 'I Discord: Serverindstillinger → Integrationer → Webhooks → Ny webhook → Kopiér webhook-URL. Holdt til https, for det her offentliggør, hvilken af dine maskiner der er nede, og hvor fuld dens disk er.',
    'bot' => 'En bot af din egen',
    'bot_helper' => 'Én signeret JSON-besked til en adresse, du selv driver, så noget uden for panelet hører om en død node frem for at spørge hvert minut, om der er en. Pelicans egne webhooks kan ikke bære det her: de udløses af modeller og af aktivitetsloggen, og en node, der er holdt op med at svare, skriver ingen af delene.',
    'bot_url' => 'Hvor den skal sendes hen',
    'bot_url_helper' => 'Holdt til https, for det her sender ud til en adresse på internettet, hvilken af dine maskiner der er nede.',
    'bot_secret' => 'Signeringshemmelighed',
    'bot_secret_helper' => 'Deles med det, der modtager det her. Kroppen hashes med den, og hashen rejser med i X-Essentials-Signature som sha256=<hex>, så din bot kan afvise alt, der ikke kom fra dette panel. Der sendes intet, så længe feltet er tomt — en signatur, der er valgfri, er en, ingen tjekker.',

    'panel' => 'I panelet',
    'panel_helper' => 'En besked til alle med denne rettighed. Virker altid, kræver ingen opsætning, og er usynlig for enhver, der ikke er logget ind.',

    'email' => 'E-mail',
    'email_helper' => 'Adskilt med komma. Bruger panelets egen mailer — pålidelig, når den er sat op, og fuldstændig tavs, når den ikke er, og det er den ene fejl, en vagthund ikke må have. Lad feltet stå tomt for at slå det fra.',

    // ---- hvad -------------------------------------------------------------
    'what' => 'Hvad der holdes øje med',
    'what_helper' => 'Hver eneste aflæsning her er en, panelet allerede tager. Intet på denne side åbner en forbindelse, siden Systemstatus ikke åbner.',

    'percent_helper' => 'Nul slår dette tjek fra.',
    'disk' => 'Advar, når en nodes disk er over',
    'memory' => 'Advar, når en nodes hukommelse er over',

    'maintenance' => 'Advar om vedligeholdelse, der har stået i mere end',
    'maintenance_helper' => 'En node til vedligeholdelse springes over af alle andre tjek, og det er rigtigt — og det er også sådan, en bliver glemt i fjorten dage. Nul slår det fra.',

    'versions' => 'Versioner af panel og Wings',
    'versions_helper' => 'Én besked, når noget kommer bagud, og én, når det er ajour igen. Ingen påmindelser — en version er ikke et nedbrud.',

    'backups' => 'Sikkerhedskopier, der kommer bagud',
    'backups_helper' => 'Én besked, der nævner serverne, frem for én pr. server — når en planlagt opgave går i stå, bliver alle servere forældede på én gang, og fyrre særskilte beskeder om én årsag er en kanal, folk slår fra. Fra som standard: et panel, der kopierer i hånden frem for efter en plan, ville få det at høre hver dag.',
    'backup_days' => 'Kald en kopi forældet efter',
    'backup_days_helper' => 'Det er også det, siden Sikkerhedskopier bruger. En server, der kopieres ugentligt, skal ikke rapporteres efter otte dage.',
    'days' => 'dage',

    'worker' => 'Queue worker',
    'worker_helper' => 'Om noget som helst udfører dette plugins baggrundsarbejde. Læg mærke til cirklen: selve tjekket kører på køen, så et panel, der aldrig har haft en worker, kan ikke melde det. Linjen øverst på denne side kan.',

    // ---- knapperne --------------------------------------------------------
    'save' => 'Gem',
    'saved' => 'Gemt',
    'save_failed' => 'Der blev ikke gemt noget',

    'test' => 'Send en prøve',
    'test_one' => 'Prøv',
    'test_off' => 'Den kanal er slået fra',
    'test_off_body' => 'Slå den til og gem, så bliver den prøvet sammen med resten.',
    'test_title' => 'Prøvebesked',
    'test_body' => 'Læser du det her, kommer advarsler fra dit Pelican-panel frem hertil. Der er ikke noget galt.',
    'test_sent' => 'Sendt til hver kanal, der er slået til',
    'test_failed' => 'Mindst én kanal afviste den',
    'test_none' => 'Der er ingen steder at sende hen',
    'test_none_body' => 'Ingen kanal er slået til, så en rigtig advarsel ville heller ikke komme nogen steder.',

    /*
     * Hvad man stiller op med en afvisning.
     *
     * En udbyders egen begrundelse er kort og korrekt og alene ubrugelig. De to,
     * der dukker op næsten hver gang, er nævnt ved navn, for ingen af dem kan
     * gættes ud fra koden: en 553 handler om afsenderen og ikke modtageren, og
     * en 401 fra Discord er en URL, der er trukket tilbage eller tastet forkert.
     */
    'hint_email_sender' => 'Din SMTP-server afviste den adresse, panelet sender fra, ikke den, det sendte til. Under Admin → Indstillinger → Mail skal Fra-adressen være en postkasse, din SMTP-konto har lov til at sende som. Det har intet med dette plugin at gøre — Pelicans egen prøvemail på den side fejler på nøjagtig samme måde.',
    'hint_email' => 'Se under Admin → Indstillinger → Mail. Knappen til prøvemail på den side bruger de samme indstillinger og siger det samme.',
    'hint_discord_url' => 'Discord kendte ikke den webhook. Den er blevet slettet, lavet om, eller sat ind uden det hele — lav en ny under Serverindstillinger → Integrationer → Webhooks, og kopiér hele URL\'en.',
    'hint_discord' => 'Panelet kunne ikke nå Discord. Står dette panel bag en firewall, der spærrer for udgående forespørgsler, kan denne kanal ikke virke herfra.',
    'hint_panel' => 'Ingen har rettigheden til det her, eller beskeden kunne ikke gemmes. Se under Roller.',

    'run_now' => 'Kør tjekkene nu',
    'run_started' => 'Tjekker i baggrunden',
    'run_failed' => 'Tjekkene kunne ikke sættes i gang',

    'reset' => 'Glem, hvad den ved',
    'reset_confirm' => 'Rydder det, hvert tjek sidst sagde. Næste gennemløb lærer forfra og sender ingenting, så et problem, der stadig står på, bliver meldt ved gennemløbet derefter. Brug det her, efter du har taget en node ud af drift, som vagthunden bliver ved med at brokke sig over.',
    'reset_done' => 'Ryddet',

    // ---- selve beskederne -------------------------------------------------
    'still' => 'Har stået på i :for.',
    'cleared_body' => 'Det havde stået sådan i :for.',

    'for_unknown' => 'et stykke tid',
    'for_minutes' => ':count minutter',
    'for_hours' => ':count timer',
    'for_days' => ':count dage',

    'node_down' => ':node svarer ikke',
    'node_down_body' => 'Panelet kan ikke nå daemonen på :node. Servere på den vil hverken starte, stoppe eller melde noget, før den er tilbage.',
    'node_up' => ':node svarer igen',

    'node_disk' => ':node er ved at løbe tør for disk',
    'node_disk_body' => 'Disken på :node er :percent % fuld, over de :limit %, du har sat. Sikkerhedskopier og serverinstallationer er det første, der fejler, når det her når toppen.',
    'node_disk_over' => 'Disken på :node er under grænsen igen',

    'node_memory' => ':node er ved at løbe tør for hukommelse',
    'node_memory_body' => 'Hukommelsen på :node er :percent % brugt, over de :limit %, du har sat. Servere på den kan blive slået ihjel af kernen, før noget som helst melder et problem.',
    'node_memory_over' => 'Hukommelsen på :node er under grænsen igen',

    'node_maintenance' => ':node har været til vedligeholdelse længe',
    'node_maintenance_body' => ':node har været til vedligeholdelse i mere end :hours timer. Imens bliver intet andet ved den tjekket, hvilket netop er meningen — men det er værd at vide, at den stadig står sådan.',
    'node_maintenance_over' => ':node er ude af vedligeholdelse',

    'wings_behind' => 'Wings på :node er forældet',
    'wings_behind_body' => ':node kører Wings :installed, og :latest er ude. Opdatér den på selve noden — panelet har ingen måde at gøre det på.',
    'wings_current' => 'Wings på :node er ajour',

    'panel_behind' => 'Panelet er forældet',
    'panel_behind_body' => 'Dette panel kører :installed, og :latest er ude.',
    'panel_current' => 'Panelet er ajour',

    'and_more' => 'og :count mere',

    'owners' => 'Fortæl folk, når maskinen bag deres egen server er nede',
    'owners_helper' => 'Det eneste tjek her, der skriver til andre end dig. Ejeren af hver server på en maskine, der er holdt op med at svare, får én besked i panelet — klokken, aldrig en mail — og én, når den kommer tilbage. Aldrig en påmindelse ind imellem: at gentage det hvert kvarter til alle på en travl node er, hvordan et panels beskeder holder op med at blive læst. Subusers får intet at vide; det er ejeren, der bestemmer, hvad der skal gøres. Maskinen bliver ikke nævnt over for dem, af samme grund som statussiden ikke offentliggør den.',

    'owner_down' => 'En af dine servere er offline|:count af dine servere er offline',
    'owner_down_body' => 'Maskinen, de står på, er holdt op med at svare. Nogen har fået besked. Berørt: :servers',
    'owner_up' => 'Din server er tilbage|:count af dine servere er tilbage',
    'owner_up_body' => 'Maskinen svarer igen. Tilbage: :servers',

    'schedules' => 'Planlagte opgaver, der er gået i stå',
    'schedules_helper' => 'En opgave, der hænger fast midt i en kørsel, en, hvis tidspunkt gik, fordi cron ikke kører, eller en, der aldrig har kørt. Pelican har intet ord for nogen af dem — en kørsel, der faldt om, bliver ved med at være „behandler" for altid og tegnes præcis som en, der kører lige nu. Læser hver eneste aktive planlagte opgave på panelet, hver gang den tjekker.',

    'schedule_stopped' => ':count planlagte opgaver er gået i stå',
    'schedule_stopped_body' => 'Hængt fast i over :hours timer, forsinkede, eller aldrig kørt: :schedules',
    'schedule_running' => 'Alle planlagte opgaver kører igen',

    'backup_none' => ':count servere er aldrig blevet sikkerhedskopieret',
    'backup_none_body' => 'Der er aldrig taget en kopi på: :servers',
    'backup_none_over' => 'Hver server har nu en kopi',

    'backup_stale' => ':count servere er ikke blevet kopieret for nylig',
    'backup_stale_body' => 'Ingen vellykket kopi i :days dage på: :servers',
    'backup_stale_over' => 'Hver server er blevet kopieret for nylig',

    'backup_failed' => 'Sikkerhedskopier fejler på :count servere',
    'backup_failed_body' => 'En kopi endte uden held på: :servers',
    'backup_failed_over' => 'Ingen sikkerhedskopier fejler længere',

    'worker_missing' => 'Der er intet, der arbejder på køen',
    'worker_missing_body' => 'Et job blev sat i kø, og intet tog det op. Plugin-opdateringer, modpakke-installationer og disse tjek går alle i stå, indtil der kører en worker — prøv systemctl status pelican-queue på panelets maskine.',
    'worker_back' => 'Der bliver arbejdet på køen igen',
];
