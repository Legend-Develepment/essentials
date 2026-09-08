<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Queue worker», «scheduler», «cron», «kanal» og stier som storage/app blir
 * stående som de er: det er under de navnene man finner dem på serveren og i
 * Pelicans dokumentasjon, og det er nøyaktig det man trenger når en av disse
 * meldingene dukker opp.
 */

return [
    'title' => 'Essentials-innstillinger',
    'nav_label' => 'Essentials-innstillinger',
    'save' => 'Lagre',
    'saved' => 'Innstillinger lagret',
    'save_failed' => 'Innstillingene kunne ikke lagres',
    'update' => 'Oppdater',
    'update_available' => 'Det finnes en oppdatering',
    'update_confirm' => 'Panelet laster ned den nye versjonen, bygger assetene sine på nytt og tømmer cachene sine. Innstillingene dine blir beholdt.',
    'update_started' => 'Oppdatering satt i gang',
    'update_background' => 'Den kjører i bakgrunnen og tar et minutt eller to.',
    'update_failed' => 'Temaet kunne ikke oppdateres',
    'update_done' => 'Tema oppdatert',
    'check' => 'Se etter oppdateringer',
    'check_failed' => 'Oppdateringsstrømmen kunne ikke leses',
    'check_failed_body' => 'Panelet nådde den ikke, eller den svarte ikke med gyldig JSON.',
    'up_to_date' => 'Du er på den nyeste versjonen',
    'reinstall' => 'Installer på nytt',

    'auto_on' => 'Oppdateringer installerer seg selv',

    /*
     * Hva den siste automatiske sjekken gjorde. Hver av disse linjene peker på
     * det stedet man måtte se på, for fra en nettleser ser de tre måtene dette
     * går galt på helt like ut: et tall som teller ned.
     */
    'auto_never' => 'Det har ennå ikke vært noen sjekk. Automatiske oppdateringer krever panelets scheduler — cron-linjen som kjører php artisan schedule:run hvert minutt. Uten den skjer ingenting av det som er planlagt.',
    'auto_ago' => 'Sist sjekket :ago',
    'auto_just_now' => 'akkurat nå',
    'auto_minutes' => 'minutter siden',
    'auto_current' => 'det er ikke noe nyere på denne kanalen.',
    'auto_installed' => 'v:version ble installert her, av selve den planlagte sjekken. Det gjør den når ingen queue worker svarer, så oppdateringen skjer uansett — men et panel uten worker er et panel der det andre arbeidet i køen heller ikke skjer.',
    'auto_queued' => 'v:version ble gitt til queue workeren. Endrer versjonen ovenfor seg ikke i løpet av et par minutter, tar workeren imot jobber, men feiler på denne — å starte den på nytt er den vanlige løsningen, og grunnen står i storage/logs.',
    'auto_unreachable' => 'oppdateringsstrømmen kunne ikke leses. Den hentes over internett, så dette er som regel et nettverks- eller DNS-problem på panelets vert.',
    'auto_error' => 'sjekken slo feil. Grunnen står i storage/logs.',

    /*
     * Queue workeren, som er det som faktisk utfører en oppdatering. Sagt for
     * seg framfor sammen med sjekken ovenfor, fordi de svikter hver for seg og
     * løsningen er forskjellig.
     */
    'worker_missing' => 'Ingen queue worker svarte. Oppdateringer, modpakke-installasjoner og disse sjekkene settes i kø og utføres av en worker-prosess, så inntil en kjører, blir de skrevet ned og aldri utført, uten en feil noe sted. Enten finnes det ingen worker, eller så finnes det en som ble startet før dette pluginet ble installert og som ikke får lastet koden dets — begge deler ordnes ved å starte den på nytt på panelets vert. Sett tjenesten dens til å starte på nytt av seg selv, ellers kommer dette igjen etter hver oppdatering.',

    'next_check' => 'Neste sjekk om',
    'due_now' => 'skulle vært nå',

    /*
     * Navngitt etter årsaken framfor symptomet, fordi symptomet er «det skjedde
     * ingenting», og det var nettopp det som gjorde det vanskelig å plassere:
     * kunngjøringer, navigasjonslenker, lagrede stiler og sideoppsett er alt
     * sammen filer under storage/app, og en mappe panelet ikke kan skrive i,
     * mister dem alle uten et ord.
     */
    'storage_failed' => 'Panelet fikk ikke skrevet i storage-mappen sin, så dette ble ikke lagret. Sjekk at storage/app tilhører den brukeren panelet kjører som. Grunnen står i storage/logs.',

    /*
     * Sagt etter hver mislykket oppdatering framfor bare etter et avvik.
     * Meldingen ovenfor nevner allerede årsaken; denne nevner den ene kuren man
     * ikke kan regne seg fram til av «ventet X, fikk Y».
     */
    'update_renamed' => 'Står det at to id-er ikke stemmer, har pluginet fått nytt navn, og ingen oppdatering kommer over det — Pelican kjenner et installert plugin på id-en. Avinstaller den gamle oppføringen under Admin → Plugins, og installer dette på nytt. Innstillingene dine overlever: de ligger i .env og i storage/app/private/legend-theme, og ingen av delene er slått opp etter id.',
];
