<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Vakthunden.
 *
 * Hver melding herfra leses på en telefon, klokken tre om natten, av en som sov
 * for et minutt siden. Hver enkelt sier hvilken maskin, hva som er galt, og
 * ikke noe mer - detaljen hører hjemme på den siden vedkommende åpner etterpå,
 * ikke i linjen som vekket ham.
 *
 * At noe har rettet seg, er skrevet som en nyhet framfor som en fotnote. «Er det
 * tilbake ennå» er det spørsmålet noen ellers ville stått opp for.
 *
 * «Node», «Wings», «daemon», «webhook», «queue», «Discord» og «SMTP» blir
 * stående på engelsk: det er under de navnene man finner dem i Pelican, på
 * verten og i alt som skrives om dem.
 */

return [
    'title' => 'Varsler',
    'nav_label' => 'Varsler',
    'subheading' => 'Panelet vet allerede når en node slutter å svare, når en disk fylles opp, eller når køen stopper. Dette er det som forteller deg det.',

    // ---- kanalene, og hva de sist gjorde ----------------------------------
    'channels' => 'Hvor meldingene går',
    'channels_helper' => 'Hva hver kanal gjorde sist den ble bedt om å sende noe. En kanal som er på og stille avviser, ser nøyaktig ut som et panel der ingenting er galt, og derfor står dette først på siden.',

    'state_off' => 'Av',
    'state_untried' => 'Ingenting er sendt ennå',
    'state_ok' => 'Levert',
    'state_failed' => 'Avvist',

    // ---- når --------------------------------------------------------------
    'when' => 'Hvor ofte',
    'when_helper' => 'Sjekkene kjører i bakgrunnen, så de krever en queue worker. Uten en blir ingenting sendt, og ingenting sier fra — bruk «Send en prøve», som ikke går gjennom køen.',

    'every' => 'Sjekk hvert',
    'every_helper' => 'Hver sjekk når daemonen på hver node, så det er én forespørsel per node per runde. Femten minutter er nok til å høre om et avbrudd mens det fortsatt er et avbrudd.',
    'every_off' => 'Av — ingen sjekker i det hele tatt',
    'every_five' => '5 minutter',
    'every_fifteen' => '15 minutter',
    'every_thirty' => '30 minutter',
    'every_hourly' => 'Time',
    'every_daily' => 'Dag',

    'repeat' => 'Minn meg på det så lenge det varer',
    'repeat_helper' => 'Det sendes en melding når noe endrer seg, og en til når det retter seg. Dette legger til en påminnelse så lenge et problem fortsatt pågår. Null betyr ingen påminnelser — en kanal som gjentar seg selv hvert kvarter, er en kanal folk demper.',
    'hours' => 'timer',

    // ---- hvor -------------------------------------------------------------
    'where' => 'Kanaler',
    'where_helper' => 'Mer enn én er fornuftig. De svikter på forskjellige måter.',

    'discord' => 'Discord',
    'discord_helper' => 'Der en melding faktisk blir lest av en som ikke sitter og ser på panelet.',
    'webhook' => 'Webhook-adresse',
    'webhook_helper' => 'I Discord: Serverinnstillinger → Integrasjoner → Webhooks → Ny webhook → Kopier webhook-URL. Holdt til https, for dette offentliggjør hvilken av maskinene dine som er nede, og hvor full disken dens er.',
    'bot' => 'En bot av ditt eget',
    'bot_helper' => 'Én signert JSON-post til en adresse du selv driver, så noe utenfor panelet får høre om en node som er nede framfor å spørre hvert minutt om det finnes en. Webhookene Pelican leveres med kan ikke bære dette: de utløses på modeller og på aktivitetsloggen, og en node som har sluttet å svare skriver ingen av delene.',
    'bot_url' => 'Hvor den skal sendes',
    'bot_url_helper' => 'Holdt til https, for dette sender hvilken av maskinene dine som er nede til en adresse på internett.',
    'bot_secret' => 'Signeringshemmelighet',
    'bot_secret_helper' => 'Delt med det som mottar dette. Kroppen hashes med den, og hashen følger med i X-Essentials-Signature som sha256=<hex>, så boten din kan avvise alt som ikke kom fra dette panelet. Ingenting sendes så lenge dette står tomt — en signatur som er valgfri, er en ingen sjekker.',

    'panel' => 'I panelet',
    'panel_helper' => 'Et varsel til alle med denne rettigheten. Virker alltid, krever ingen oppsett, og er usynlig for alle som ikke er logget inn.',

    'email' => 'E-post',
    'email_helper' => 'Skilt med komma. Bruker panelets egen mailer — pålitelig når den er satt opp, og fullstendig taus når den ikke er det, og det er den ene svikten en vakthund ikke får ha. La feltet stå tomt for å slå det av.',

    // ---- hva --------------------------------------------------------------
    'what' => 'Hva det holdes øye med',
    'what_helper' => 'Hver eneste avlesning her er en panelet allerede tar. Ingenting på denne siden åpner en forbindelse siden Systemstatus ikke åpner.',

    'percent_helper' => 'Null slår denne sjekken av.',
    'disk' => 'Varsle når en nodes disk er over',
    'memory' => 'Varsle når en nodes minne er over',

    'maintenance' => 'Varsle om vedlikehold som har stått i mer enn',
    'maintenance_helper' => 'En node til vedlikehold hoppes over av alle andre sjekker, og det er riktig — og det er også slik en blir glemt i fjorten dager. Null slår det av.',

    'versions' => 'Versjoner av panel og Wings',
    'versions_helper' => 'Én melding når noe ligger etter, og én når det er ajour igjen. Ingen påminnelser — en versjon er ikke et avbrudd.',

    'backups' => 'Sikkerhetskopier som ligger etter',
    'backups_helper' => 'Én melding som nevner serverne framfor én per server — når en planlagt oppgave stopper, blir alle servere foreldet på én gang, og førti separate meldinger om én årsak er en kanal folk demper. Av som standard: et panel som kopierer for hånd framfor etter en plan, ville fått høre det hver dag.',
    'backup_days' => 'Kall en kopi foreldet etter',
    'backup_days_helper' => 'Det er også det siden Sikkerhetskopier bruker. En server som kopieres ukentlig, skal ikke rapporteres etter åtte dager.',
    'days' => 'dager',

    'worker' => 'Queue worker',
    'worker_helper' => 'Om noe som helst utfører bakgrunnsarbeidet til dette pluginet. Legg merke til sirkelen: selve sjekken kjører på køen, så et panel som aldri har hatt en worker, kan ikke melde fra om det. Linjen øverst på denne siden kan.',

    // ---- knappene ---------------------------------------------------------
    'save' => 'Lagre',
    'saved' => 'Lagret',
    'save_failed' => 'Ingenting ble lagret',

    'test' => 'Send en prøve',
    'test_one' => 'Prøv',
    'test_off' => 'Den kanalen er av',
    'test_off_body' => 'Slå den på og lagre, så blir den prøvd sammen med resten.',
    'test_title' => 'Prøvemelding',
    'test_body' => 'Leser du dette, kommer varsler fra Pelican-panelet ditt hit. Det er ingenting galt.',
    'test_sent' => 'Sendt til hver kanal som er på',
    'test_failed' => 'Minst én kanal avviste den',
    'test_none' => 'Det er ingen steder å sende',
    'test_none_body' => 'Ingen kanal er på, så et ekte varsel ville heller ikke kommet noe sted.',

    /*
     * Hva man gjør med en avvisning.
     *
     * En leverandørs egen begrunnelse er kort og korrekt og alene ubrukelig. De
     * to som dukker opp nesten hver gang, er nevnt ved navn, for ingen av dem
     * kan gjettes ut fra koden: en 553 handler om avsenderen og ikke mottakeren,
     * og en 401 fra Discord er en URL som er trukket tilbake eller tastet feil.
     */
    'hint_email_sender' => 'SMTP-serveren din avviste den adressen panelet sender fra, ikke den det sendte til. Under Admin → Innstillinger → E-post må Fra-adressen være en postkasse SMTP-kontoen din har lov til å sende som. Det har ingenting med dette pluginet å gjøre — Pelicans egen prøvemail på den siden svikter på nøyaktig samme måte.',
    'hint_email' => 'Se under Admin → Innstillinger → E-post. Knappen for prøvemail på den siden bruker de samme innstillingene og sier det samme.',
    'hint_discord_url' => 'Discord kjente ikke igjen den webhooken. Den er blitt slettet, laget på nytt, eller limt inn uten det hele — lag en ny under Serverinnstillinger → Integrasjoner → Webhooks, og kopier hele URL-en.',
    'hint_discord' => 'Panelet nådde ikke Discord. Står dette panelet bak en brannmur som sperrer utgående forespørsler, kan denne kanalen ikke virke herfra.',
    'hint_panel' => 'Ingen har rettigheten til dette, eller varselet kunne ikke lagres. Se under Roller.',

    'run_now' => 'Kjør sjekkene nå',
    'run_started' => 'Sjekker i bakgrunnen',
    'run_failed' => 'Sjekkene kunne ikke settes i gang',

    'reset' => 'Glem det den vet',
    'reset_confirm' => 'Tømmer det hver sjekk sist sa. Neste runde lærer fra bunnen av og sender ingenting, så et problem som fortsatt pågår, blir meldt på runden etter. Bruk dette etter at du har tatt en node ut av drift som vakthunden fortsetter å mase om.',
    'reset_done' => 'Tømt',

    // ---- selve meldingene -------------------------------------------------
    'still' => 'Har pågått i :for.',
    'cleared_body' => 'Det hadde stått slik i :for.',

    'for_unknown' => 'en stund',
    'for_minutes' => ':count minutter',
    'for_hours' => ':count timer',
    'for_days' => ':count dager',

    'node_down' => ':node svarer ikke',
    'node_down_body' => 'Panelet når ikke daemonen på :node. Servere på den vil verken starte, stoppe eller melde noe før den er tilbake.',
    'node_up' => ':node svarer igjen',

    'node_disk' => ':node holder på å gå tom for disk',
    'node_disk_body' => 'Disken på :node er :percent % full, over de :limit % du har satt. Sikkerhetskopier og serverinstallasjoner er det første som svikter når dette når toppen.',
    'node_disk_over' => 'Disken på :node er under grensen igjen',

    'node_memory' => ':node holder på å gå tom for minne',
    'node_memory_body' => 'Minnet på :node er :percent % brukt, over de :limit % du har satt. Servere på den kan bli drept av kjernen før noe som helst melder et problem.',
    'node_memory_over' => 'Minnet på :node er under grensen igjen',

    'node_maintenance' => ':node har vært til vedlikehold lenge',
    'node_maintenance_body' => ':node har vært til vedlikehold i mer enn :hours timer. Imens blir ingenting annet ved den sjekket, og det er hele poenget — men det er verdt å vite at den fortsatt står slik.',
    'node_maintenance_over' => ':node er ute av vedlikehold',

    'wings_behind' => 'Wings på :node er utdatert',
    'wings_behind_body' => ':node kjører Wings :installed, og :latest er ute. Oppdater den på selve noden — panelet har ingen måte å gjøre det på.',
    'wings_current' => 'Wings på :node er ajour',

    'panel_behind' => 'Panelet er utdatert',
    'panel_behind_body' => 'Dette panelet kjører :installed, og :latest er ute.',
    'panel_current' => 'Panelet er ajour',

    'and_more' => 'og :count til',

    'owners' => 'Si fra til folk når maskinen bak deres egen server er nede',
    'owners_helper' => 'Den eneste sjekken her som skriver til andre enn deg. Eieren av hver server på en maskin som har sluttet å svare, får ett varsel i panelet — bjellen, aldri en e-post — og ett når den kommer tilbake. Aldri en påminnelse imellom: å gjenta det hvert kvarter til alle på en travel node er hvordan et panels varsler slutter å bli lest. Subusers får ikke beskjed; det er eieren som avgjør hva som skal gjøres. Maskinen blir ikke nevnt for dem, av samme grunn som statussiden ikke offentliggjør den.',

    'owner_down' => 'En av serverne dine er nede|:count av serverne dine er nede',
    'owner_down_body' => 'Maskinen de står på, har sluttet å svare. Noen har fått beskjed. Berørt: :servers',
    'owner_up' => 'Serveren din er tilbake|:count av serverne dine er tilbake',
    'owner_up_body' => 'Maskinen svarer igjen. Tilbake: :servers',

    'schedules' => 'Planlagte oppgaver som har stoppet',
    'schedules_helper' => 'En oppgave som sitter fast midt i en kjøring, en hvis tidspunkt gikk fordi cron ikke kjører, eller en som aldri har kjørt. Pelican har ikke noe ord for noen av dem — en kjøring som falt sammen, blir stående som «behandler» for alltid og tegnes nøyaktig som en som kjører nå. Leser hver eneste aktive planlagte oppgave på panelet hver gang den sjekker.',

    'schedule_stopped' => ':count planlagte oppgaver har stoppet',
    'schedule_stopped_body' => 'Sittende fast i over :hours timer, forsinket, eller aldri kjørt: :schedules',
    'schedule_running' => 'Alle planlagte oppgaver kjører igjen',

    'backup_none' => ':count servere har aldri hatt en sikkerhetskopi',
    'backup_none_body' => 'Det er aldri tatt en kopi på: :servers',
    'backup_none_over' => 'Hver server har nå en kopi',

    'backup_stale' => ':count servere har ikke hatt en kopi på en stund',
    'backup_stale_body' => 'Ingen vellykket kopi på :days dager på: :servers',
    'backup_stale_over' => 'Hver server har hatt en kopi nylig',

    'backup_failed' => 'Sikkerhetskopier svikter på :count servere',
    'backup_failed_body' => 'En kopi endte uten hell på: :servers',
    'backup_failed_over' => 'Ingen sikkerhetskopier svikter lenger',

    'worker_missing' => 'Det er ingenting som arbeider på køen',
    'worker_missing_body' => 'En jobb ble satt i kø, og ingenting tok den. Plugin-oppdateringer, modpakke-installasjoner og disse sjekkene stopper alle opp inntil det kjører en worker — prøv systemctl status pelican-queue på panelets maskin.',
    'worker_back' => 'Det arbeides på køen igjen',
];
