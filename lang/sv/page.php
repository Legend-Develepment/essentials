<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Queue worker», «cron», «storage» och sökvägarna står kvar precis som de
 * skrivs på panelens värd: det är dem man skriver in i ett skal.
 */

return [
    'title' => 'Essentials-inställningar',
    'nav_label' => 'Essentials-inställningar',
    'save' => 'Spara',
    'saved' => 'Inställningarna sparade',
    'save_failed' => 'Det gick inte att spara inställningarna',
    'secret_kept' => 'Sparad. Lämna tomt för att behålla den, eller skriv en ny för att byta.',
    'update_background' => 'Den körs i bakgrunden och tar en minut eller två.',

    /*
     * Queue workern och schemaläggaren (scheduler), som alla bakgrundsjobb
     * och schemalagda uppgifter hänger på. Sagt var för sig, för de går fel
     * var för sig och botemedlet är olika för dem.
     */
    'worker_missing' => 'Ingen queue worker svarade. Modpack-installationer, mejl och andra bakgrundsjobb köas och utförs av en worker-process, så tills en kör skrivs de ner och utförs aldrig, utan ett felmeddelande någonstans. Antingen finns det ingen worker, eller så finns det en som startades innan det här pluginet installerades och som inte kan ladda dess kod - båda löses genom att starta om den på panelens värd. Ställ in dess tjänst att starta om av sig själv, annars kommer det här tillbaka efter varje uppdatering.',

    'cron_missing' => 'Panelens schemaläggare har inte kört på :for minuter. Förnyelser och vakthundens kontroller väntar på den. Cron-raden står i Pelicans dokumentation.',

    /*
     * Uppkallat efter orsaken i stället för efter symtomet, för symtomet är
     * «ingenting hände» och det var det som gjorde det här svårt att placera:
     * meddelanden, navigationslänkar, sparade stilar och siduppställningar är
     * alla filer under storage/app, och en katalog panelen inte kan skriva till
     * tappar varenda en av dem utan ett ord.
     */
    'storage_failed' => 'Panelen kunde inte skriva till sin storage-katalog, så det här sparades inte. Kontrollera att storage/app tillhör den användare panelen kör som. Anledningen står i storage/logs.',
];
