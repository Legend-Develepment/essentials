<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * «Egg», «GameUserSettings.ini» og «daemon» blir stående på engelsk: det er de
 * ordene som står i Pelican, i filbehandleren og i alt som skrives om ARK.
 */

return [
    /* --------------------------------------------- administratorfanen ---- */

    /*
     * Selve overskriften på seksjonen står ikke her. Hver innstillingsseksjon
     * henter tittelen sin fra settings.groups.<navn>, som group() bygger.
     */
    'section_helper' => 'Hvilke eggs som kjører ARK. Ikke noe mer - resten av en ARK-server settes opp med startvariablene sine, og Pelicans egen Start-side redigerer dem allerede.',

    'eggs' => 'Hvilke eggs er ARK',
    'eggs_helper' => 'Kryss av for de eggs som kjører en ARK-server. Inne i de serverne som bruker dem, dukker det opp en side med Verdensinnstillinger, og ingen andre steder. Det er ikke det samme spørsmålet som på statussiden: der spørres det hvilke eggs som svarer på Valves forespørsel, noe Rust og Valheim også gjør, og her hvilke eggs som holder GameUserSettings.ini der ARK holder den, noe bare ARK gjør. Ingenting er krysset av til å begynne med, og det er med vilje - et plugin kan ikke vite hva du har kalt eggene dine.',

    /* ------------------------------------------------------- serversiden - */

    'nav_label' => 'Verdensinnstillinger',
    'title' => 'ARK-verdensinnstillinger',
    'subheading' => 'De innstillingene folk faktisk endrer, fra GameUserSettings.ini.',

    'group_server' => 'Serveren',
    'group_server_helper' => 'Hva serveren heter, hvem som får komme inn, og hvor mange.',
    'group_rates' => 'Rater',
    'group_rates_helper' => 'Hvor fort ting skjer. 1.0 er spillet slik det leveres; 2.0 er dobbelt så fort.',
    'group_rules' => 'Regler',
    'group_rules_helper' => 'Hva spillerne får lov til, og hva spillet viser dem.',

    'keeps' => 'Femten innstillinger av en fil med hundrevis. Alt annet i den - modinnstillingene dine, nøkler dette pluginet aldri har hørt om, kommentarene og rekkefølgen på det hele - blir stående nøyaktig som det er når du lagrer.',
    'missing' => 'Denne serveren har ennå ingen GameUserSettings.ini. Spillet skriver den første gang det kjører, så start serveren én gang, og denne siden fyller seg ut.',
    'read_only' => 'Du får lese denne filen, men ikke skrive den, så ingenting her kan endres.',

    'save' => 'Lagre',
    'saved' => 'Lagret',
    'saved_restart' => 'ARK leser denne filen når den starter, så start serveren på nytt for at endringen skal virke.',
    'failed' => 'Kunne ikke lagre',
    'failed_write' => 'Daemonen avviste skrivingen. Sjekk at serveren kan nås, og at filen ikke er skrivebeskyttet.',
];
