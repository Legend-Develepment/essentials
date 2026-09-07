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
    'update' => 'Opdatér',
    'update_available' => 'Der er en opdatering klar',
    'update_confirm' => 'Panelet henter den nye version, bygger sine assets om og rydder sine caches. Dine indstillinger bliver bevaret.',
    'update_started' => 'Opdatering sat i gang',
    'update_background' => 'Den kører i baggrunden og tager et minut eller to.',
    'update_failed' => 'Temaet kunne ikke opdateres',
    'update_done' => 'Tema opdateret',
    'check' => 'Søg efter opdateringer',
    'check_failed' => 'Opdateringsfeedet kunne ikke læses',
    'check_failed_body' => 'Panelet nåede det ikke, eller det svarede ikke med gyldig JSON.',
    'up_to_date' => 'Du er på den nyeste version',
    'reinstall' => 'Geninstallér',

    'auto_on' => 'Opdateringer installerer sig selv',

    /*
     * Hvad det seneste automatiske tjek gjorde. Hver af disse linjer peger på
     * det sted, man skulle kigge, for fra en browser ser de tre måder, det her
     * går galt på, ens ud: et tal, der tæller ned.
     */
    'auto_never' => 'Der har endnu ikke været noget tjek. Automatiske opdateringer kræver panelets scheduler — den cron-linje, der kører php artisan schedule:run hvert minut. Uden den sker der overhovedet intet af det planlagte.',
    'auto_ago' => 'Sidst tjekket :ago',
    'auto_just_now' => 'lige nu',
    'auto_minutes' => 'minutter siden',
    'auto_current' => 'der er ikke noget nyere på denne kanal.',
    'auto_queued' => 'v:version blev sat i kø. Ændrer versionen ovenfor sig ikke inden for et par minutter, kører der ingen queue worker — og det er der, opdateringen finder sted.',
    'auto_unreachable' => 'opdateringsfeedet kunne ikke læses. Det hentes over internettet, så det er som regel et netværks- eller DNS-problem på panelets vært.',
    'auto_error' => 'tjekket slog fejl. Grunden står i storage/logs.',

    /*
     * Queue worker'en, som er den, der rent faktisk udfører en opdatering. Sagt
     * for sig frem for sammen med tjekket ovenfor, fordi de fejler hver for sig,
     * og løsningen er forskellig.
     */
    'worker_missing' => 'Ingen queue worker svarede. Opdateringer, modpakke-installationer og disse tjek bliver sat i kø og udført af en worker-proces, så indtil en kører, bliver de skrevet ned og aldrig udført, uden en fejl nogen steder. Enten er der ingen worker, eller også er der en, der blev startet, før dette plugin blev installeret, og som ikke kan indlæse dets kode — begge dele klares ved at genstarte den på panelets vært. Sæt dens service til at genstarte af sig selv, ellers kommer det her igen efter hver opdatering.',

    'next_check' => 'Næste tjek om',
    'due_now' => 'skulle være nu',

    /*
     * Navngivet efter årsagen frem for symptomet, fordi symptomet er „der skete
     * ingenting", og det var netop det, der gjorde det svært at placere:
     * meddelelser, navigationslinks, gemte stile og sideopsætninger er alt
     * sammen filer under storage/app, og en mappe, panelet ikke kan skrive i,
     * mister dem alle uden et ord.
     */
    'storage_failed' => 'Panelet kunne ikke skrive i sin storage-mappe, så dette blev ikke gemt. Tjek, at storage/app tilhører den bruger, panelet kører som. Grunden står i storage/logs.',

    /*
     * Sagt efter hver mislykket opdatering frem for kun efter en uoverensstem-
     * melse. Beskeden ovenfor nævner allerede årsagen; denne nævner den ene
     * kur, man ikke kan regne ud af „forventede X, fik Y".
     */
    'update_renamed' => 'Står der, at to id\'er ikke stemmer, er pluginnet blevet omdøbt, og ingen opdatering kommer over det — Pelican kender et installeret plugin på dets id. Afinstallér den gamle post under Admin → Plugins, og installér dette forfra. Dine indstillinger overlever: de ligger i .env og i storage/app/private/legend-theme, og ingen af delene er slået op efter id.',
];
