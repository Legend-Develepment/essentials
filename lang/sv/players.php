<?php

/*
 * Svenska. Skriven för hand.
 *
 * «Whitelist», «operator», «ban» och «kick» står kvar på engelska: det är
 * kommandona man skriver i konsolen och namnen på de filer Minecraft själv
 * skriver, och en översatt knapp bredvid ett engelskt kommando är en knapp man
 * måste översätta tillbaka i huvudet.
 */

return [
    'nav_label' => 'Spelare',
    'title' => 'Spelare',
    'subheading' => 'Whitelisten, operatorerna, banlistan, och alla den här servern har sett.',

    /*
     * Sagt en gång, högt upp, för det förklarar både vad sidan kan göra och
     * varför en sak den inte kan inte är ett fel. Varje ändring skickas som ett
     * konsolkommando, vilket är så Minecraft är tänkt att få veta - spelet gör
     * ändringen och skriver sin egen fil, så de två säger aldrig emot varandra.
     */
    'how' => 'Ändringar skickas till servern som konsolkommandon, så spelet gör dem och skriver sina egna filer. Det kräver att servern kör.',
    'needs_running' => 'Servern måste köra. De här ändringarna görs av spelet, inte genom att redigera dess filer under fötterna på det.',

    'name' => 'Spelarnamn',
    'reason' => 'Anledning (valfritt)',

    'whitelist' => 'Lägg till på whitelisten',
    'unwhitelist' => 'Ta bort från whitelisten',
    'op' => 'Gör till operator',
    'deop' => 'Ta bort operator',
    'ban' => 'Banna',
    'pardon' => 'Ta bort ban',
    'kick' => 'Kicka',

    'sent' => 'Kommandot skickat',
    'sent_body' => 'Servern tillämpar det och uppdaterar sina egna filer. Ladda om sidan för att se listorna ändras.',
    'refused' => 'Det skickades inte',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'På whitelisten',
    'flag_banned' => 'Bannad',
    'flag_seen' => 'Har spelat här',

    'online' => 'Inne just nu',
    'online_count' => ':online av :max',
    'online_none' => 'Ingen är ansluten.',

    'players' => 'Spelare',
    'ips' => 'Bannade adresser',
    'ips_empty' => 'Inga adresser är bannade.',

    /*
     * Vad en tom sida betyder, vilket oftast inte är «inga spelare» utan «den
     * här servern har aldrig startat». Minecraft skapar ingen av de här filerna
     * förrän efter första körningen.
     */
    'empty' => 'Ingenting att visa ännu. Minecraft skriver de här listorna själv, och det skapar dem inte förrän servern har startat en första gång.',

    'level' => 'Nivå :level',

    /*
     * Den enda sak sidan inte gör, sagt i stället för lämnat att upptäckas.
     * Levande status kräver en andra anslutning till spelet självt, vilket är
     * en annan funktion med sina egna krav.
     */
    'not_live' => 'Det här är vad servern har skrivit ner, inte vilka som är inne just nu.',
];
