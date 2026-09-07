<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * „Egg", „GameUserSettings.ini" og „daemon" bliver stående på engelsk: det er
 * de ord, der står i Pelican, i filhåndteringen og i alt, hvad der skrives om
 * ARK.
 */

return [
    /* ---------------------------------------------- administratorfanen --- */

    /*
     * Selve overskriften på afsnittet står ikke her. Hvert indstillingsafsnit
     * tager sin titel fra settings.groups.<navn>, som group() bygger.
     */
    'section_helper' => 'Hvilke eggs der kører ARK. Ikke andet — resten af en ARK-server sættes op med dens startvariabler, og Pelicans egen Start-side redigerer dem allerede.',

    'eggs' => 'Hvilke eggs er ARK',
    'eggs_helper' => 'Sæt hak ved de eggs, der kører en ARK-server. Inde i de servere, der bruger dem, dukker en side med Verdensindstillinger op, og ingen andre steder. Det er ikke det samme spørgsmål som på statussiden: der spørges der, hvilke eggs der svarer på Valves forespørgsel, hvad Rust og Valheim også gør, og her, hvilke eggs der holder GameUserSettings.ini der, hvor ARK holder den, hvad kun ARK gør. Der er ikke sat hak ved noget til at begynde med, og det er med vilje — et plugin kan ikke vide, hvad du har kaldt dine eggs.',

    /* ------------------------------------------------------ serverside --- */

    'nav_label' => 'Verdensindstillinger',
    'title' => 'ARK-verdensindstillinger',
    'subheading' => 'De indstillinger, folk rent faktisk ændrer, fra GameUserSettings.ini.',

    'group_server' => 'Serveren',
    'group_server_helper' => 'Hvad serveren hedder, hvem der må ind, og hvor mange.',
    'group_rates' => 'Satser',
    'group_rates_helper' => 'Hvor hurtigt tingene sker. 1.0 er spillet, som det leveres; 2.0 er dobbelt så hurtigt.',
    'group_rules' => 'Regler',
    'group_rules_helper' => 'Hvad spillerne må, og hvad spillet viser dem.',

    'keeps' => 'Femten indstillinger ud af en fil med hundredvis. Alt andet i den — dine mod-indstillinger, nøgler dette plugin aldrig har hørt om, kommentarerne og rækkefølgen af det hele — bliver stående præcis som det er, når du gemmer.',
    'missing' => 'Denne server har endnu ingen GameUserSettings.ini. Spillet skriver den, første gang det kører, så start serveren én gang, og denne side fyldes ud.',
    'read_only' => 'Du må læse denne fil, men ikke skrive den, så intet her kan ændres.',

    'save' => 'Gem',
    'saved' => 'Gemt',
    'saved_restart' => 'ARK læser denne fil, når den starter, så genstart serveren, for at ændringen får virkning.',
    'failed' => 'Kunne ikke gemme',
    'failed_write' => 'Daemonen afviste skrivningen. Tjek, at serveren kan nås, og at filen ikke er skrivebeskyttet.',
];
