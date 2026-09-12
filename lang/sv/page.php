<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Queue worker», «cron», «storage» och sökvägarna står kvar precis som de
 * skrivs på panelens värd: det är dem man skriver in i ett skal.
 */

return [
    'updating_now' => 'Den här panelen installerar en uppdatering. En sida kan se konstig ut en stund.',
    'updating_done' => 'Uppdateringen är installerad. Såg en sida konstig ut nyss, ladda om den.',
    'title' => 'Essentials-inställningar',
    'nav_label' => 'Essentials-inställningar',
    'save' => 'Spara',
    'saved' => 'Inställningarna sparade',
    'save_failed' => 'Det gick inte att spara inställningarna',
    'update' => 'Uppdatera',
    'update_available' => 'En uppdatering finns',
    'update_confirm' => 'Panelen laddar ner den nya versionen, bygger om sina assets och tömmer sina cacher. Dina inställningar behålls.',
    'update_started' => 'Uppdateringen startad',
    'update_background' => 'Den körs i bakgrunden och tar en minut eller två.',
    'update_failed' => 'Det gick inte att uppdatera temat',
    'update_done' => 'Temat uppdaterat',
    'check' => 'Leta efter uppdateringar',
    'check_failed' => 'Uppdateringsflödet gick inte att läsa',
    'check_failed_body' => 'Panelen nådde det inte, eller så svarade det inte med giltig JSON.',
    'up_to_date' => 'Du kör den senaste versionen',
    'reinstall' => 'Installera om',

    'auto_on' => 'Uppdateringar installerar sig själva',

    /*
     * Vad den senaste automatiska kontrollen gjorde. Var och en av dem pekar ut
     * den del som behöver ses över, för ur en webbläsare ser de tre sätt det
     * här går fel på likadana ut: en siffra som räknar ner.
     */
    'auto_never' => 'Ingen kontroll har körts ännu. Automatiska uppdateringar behöver panelens schemaläggare - cron-raden som kör php artisan schedule:run varje minut. Utan den händer ingenting schemalagt alls.',
    'auto_ago' => 'Senast kontrollerad :ago',
    'auto_just_now' => 'nyss',
    'auto_minutes' => 'minuter sedan',
    'auto_current' => 'inget nyare på den här kanalen.',
    'auto_installed' => 'v:version installerades här, av den schemalagda kontrollen själv. Det gör den när ingen queue worker svarar, så uppdateringen sker ändå - men en panel utan worker är en panel där annat köat arbete inte heller blir gjort.',
    'auto_queued' => 'v:version lämnades över till queue workern. Om versionen ovan inte ändras inom några minuter tar workern jobb men klarar inte det här - att starta om den brukar lösa det, och anledningen står i storage/logs.',
    'auto_unreachable' => 'uppdateringsflödet gick inte att läsa. Det hämtas över internet, så det här är oftast ett nätverks- eller DNS-problem på panelens värd.',
    'auto_error' => 'kontrollen misslyckades. Anledningen står i storage/logs.',

    /*
     * Queue workern, som är det som faktiskt utför en uppdatering. Sagt för sig
     * skilt från kontrollen ovan, för de går fel var för sig och botemedlet är
     * olika för dem.
     */
    'worker_missing' => 'Ingen queue worker svarade. Uppdateringar och modpack-installationer köas och utförs av en worker-process, så tills en kör skrivs de ner och utförs aldrig, utan ett felmeddelande någonstans. Antingen finns det ingen worker, eller så finns det en som startades innan det här pluginet installerades och som inte kan ladda dess kod - båda löses genom att starta om den på panelens värd. Ställ in dess tjänst att starta om av sig själv, annars kommer det här tillbaka efter varje uppdatering.',

    'cron_missing' => 'Panelens schemaläggare har inte kört på :for minuter. Förnyelser, vakthundens kontroller och automatiska uppdateringar väntar alla på den. Cron-raden står i Pelicans dokumentation.',

    'next_check' => 'Nästa kontroll om',
    'due_now' => 'ska ske nu',

    /*
     * Uppkallat efter orsaken i stället för efter symtomet, för symtomet är
     * «ingenting hände» och det var det som gjorde det här svårt att placera:
     * meddelanden, navigationslänkar, sparade stilar och siduppställningar är
     * alla filer under storage/app, och en katalog panelen inte kan skriva till
     * tappar varenda en av dem utan ett ord.
     */
    'storage_failed' => 'Panelen kunde inte skriva till sin storage-katalog, så det här sparades inte. Kontrollera att storage/app tillhör den användare panelen kör som. Anledningen står i storage/logs.',

    /*
     * Sagt efter varje misslyckad uppdatering i stället för bara efter en
     * krock. Meddelandet ovan namnger redan orsaken; det här namnger det enda
     * botemedel en människa inte kan räkna ut ur «väntade X, fick Y».
     */
    'update_renamed' => 'Om det står att två id:n inte stämmer överens har pluginet bytt namn, och ingen uppdatering tar sig över det - Pelican känner igen ett installerat plugin på dess id. Avinstallera den gamla posten under Admin → Plugins och installera den här på nytt. Dina inställningar överlever: de bor i .env och i storage/app/private/legend-theme, och ingetdera är nycklat på id:t.',
];
