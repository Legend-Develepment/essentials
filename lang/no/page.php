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
    'secret_kept' => 'Lagret. La feltet stå tomt for å beholde den, eller skriv inn en ny.',
    'update_background' => 'Den kjører i bakgrunnen og tar et minutt eller to.',

    /*
     * Queue workeren og scheduleren, som alle bakgrunnsjobber og planlagte
     * oppgaver er avhengige av. Sagt hver for seg, fordi de svikter hver for
     * seg og løsningen er forskjellig.
     */
    'worker_missing' => 'Ingen queue worker svarte. Modpakke-installasjoner, e-poster og andre bakgrunnsjobber settes i kø og utføres av en worker-prosess, så inntil en kjører, blir de skrevet ned og aldri utført, uten en feil noe sted. Enten finnes det ingen worker, eller så finnes det en som ble startet før dette pluginet ble installert og som ikke får lastet koden dets - begge deler ordnes ved å starte den på nytt på panelets vert. Sett tjenesten dens til å starte på nytt av seg selv, ellers kommer dette igjen etter hver oppdatering.',
    'cron_missing' => 'Panelets scheduler har ikke kjørt på :for minutter. Fornyelser og watchdog-sjekker venter på den. Cron-linjen står i Pelicans dokumentasjon.',

    /*
     * Navngitt etter årsaken framfor symptomet, fordi symptomet er «det skjedde
     * ingenting», og det var nettopp det som gjorde det vanskelig å plassere:
     * kunngjøringer, navigasjonslenker, lagrede stiler og sideoppsett er alt
     * sammen filer under storage/app, og en mappe panelet ikke kan skrive i,
     * mister dem alle uten et ord.
     */
    'storage_failed' => 'Panelet fikk ikke skrevet i storage-mappen sin, så dette ble ikke lagret. Sjekk at storage/app tilhører den brukeren panelet kjører som. Grunnen står i storage/logs.',
];
