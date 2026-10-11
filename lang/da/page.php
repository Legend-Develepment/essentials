<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Queue worker", „scheduler", „cron", „kanal" og stier som storage/app bliver
 * stående, som de er: det er under de navne, man finder dem på serveren og i
 * Pelicans dokumentation, og det er præcis det, man skal bruge, når en af disse
 * beskeder dukker op.
 */

return [
    'title' => 'Essentials-indstillinger',
    'nav_label' => 'Essentials-indstillinger',
    'save' => 'Gem',
    'saved' => 'Indstillinger gemt',
    'save_failed' => 'Indstillingerne kunne ikke gemmes',
    'secret_kept' => 'Gemt. Lad feltet stå tomt for at beholde den, eller skriv en ny.',
    'update_background' => 'Den kører i baggrunden og tager et minut eller to.',

    /*
     * Queue worker'en og scheduleren, som alle baggrundsjob og planlagte
     * opgaver afhænger af. Sagt hver for sig, fordi de fejler hver for sig, og
     * løsningen er forskellig.
     */
    'worker_missing' => 'Ingen queue worker svarede. Modpakke-installationer, mails og andre baggrundsjob bliver sat i kø og udført af en worker-proces, så indtil en kører, bliver de skrevet ned og aldrig udført, uden en fejl nogen steder. Enten er der ingen worker, eller også er der en, der blev startet, før dette plugin blev installeret, og som ikke kan indlæse dets kode - begge dele klares ved at genstarte den på panelets vært. Sæt dens service til at genstarte af sig selv, ellers kommer det her igen efter hver opdatering.',
    'cron_missing' => 'Panelets scheduler har ikke kørt i :for minutter. Fornyelser og watchdog-tjek venter på den. Cron-linjen står i Pelicans dokumentation.',

    /*
     * Navngivet efter årsagen frem for symptomet, fordi symptomet er „der skete
     * ingenting", og det var netop det, der gjorde det svært at placere:
     * meddelelser, navigationslinks, gemte stile og sideopsætninger er alt
     * sammen filer under storage/app, og en mappe, panelet ikke kan skrive i,
     * mister dem alle uden et ord.
     */
    'storage_failed' => 'Panelet kunne ikke skrive i sin storage-mappe, så dette blev ikke gemt. Tjek, at storage/app tilhører den bruger, panelet kører som. Grunden står i storage/logs.',
];
