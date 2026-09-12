<?php

/*
 * Svenska. Skriven för hand.
 *
 * «GameUserSettings.ini» och «Startup» skrivs som de står i spelet och i
 * Pelican - det är namnen man letar efter.
 */

return [
    /* ---------------------------------------------- administratörsfliken - */

    /*
     * Själva rubriken står inte här. Varje inställningsavsnitt hämtar sin titel
     * ur settings.groups.<namn>, som group() bygger.
     */
    'section_helper' => 'Vilka eggs som kör ARK. Inget annat - resten av en ARK-server ställs in med sina startvariabler, och Pelicans egen Startup-sida redigerar redan dem.',

    'eggs' => 'Vilka eggs är ARK',
    'eggs_helper' => 'Kryssa i de eggs som kör en ARK-server. En sida med världsinställningar dyker upp inne i de servrar som använder dem, och ingen annanstans. Det är en annan fråga än den på statussidan: den frågar vilka eggs som svarar på Valves fråga, vilket Rust och Valheim också gör, och den här frågar vilka eggs som håller GameUserSettings.ini där ARK håller den, vilket bara ARK gör. Ingenting är ikryssat till att börja med, med flit - ett plugin kan inte veta vad du har döpt dina eggs till.',

    /* -------------------------------------------------- serverns sida ---- */

    'nav_label' => 'Världsinställningar',
    'title' => 'ARK:s världsinställningar',
    'subheading' => 'De inställningar folk faktiskt ändrar, ur GameUserSettings.ini.',

    'group_server' => 'Servern',
    'group_server_helper' => 'Vad servern heter, vilka som får gå med, och hur många.',
    'group_rates' => 'Takt',
    'group_rates_helper' => 'Hur fort saker sker. 1.0 är spelet som det levereras; 2.0 är dubbelt så fort.',
    'group_rules' => 'Regler',
    'group_rules_helper' => 'Vad spelare får göra och vad spelet visar dem.',

    'keeps' => 'Femton inställningar ur en fil med hundratals. Allt annat i den - dina mod-inställningar, nycklar det här pluginet aldrig har hört talas om, kommentarerna och ordningen på alltihop - lämnas exakt som det är när du sparar.',
    'missing' => 'Den här servern har ännu ingen GameUserSettings.ini. Spelet skriver den första gången det körs, så starta servern en gång så fyller den här sidan i sig.',
    'read_only' => 'Du får läsa den här filen men inte skriva den, så ingenting här går att ändra.',

    'save' => 'Spara',
    'saved' => 'Sparat',
    'saved_restart' => 'ARK läser den här filen när det startar, så starta om servern för att ändringen ska gälla.',
    'failed' => 'Det gick inte att spara',
    'failed_write' => 'Daemonen nekade skrivningen. Kontrollera att servern går att nå och att filen inte är skrivskyddad.',
];
