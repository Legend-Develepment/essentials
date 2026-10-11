<?php

/*
 * Svenska. Skriven för hand.
 *
 * Inställningarna som en fil: ut, och in igen.
 *
 * De uppladdade filerna ligger medvetet inte i den - se Support\Portable för
 * varför det är bättre att säga det än att tyst utelämna dem.
 */

return [
    'export' => 'Exportera inställningar',
    'records' => 'Exportera posterna',
    'records_helper' => 'Alla paket, beställningar, fakturor, betalningar och ärenden i en fil. Tar du bort det här tillägget försvinner allt, och Pelican frågar ingenting först, så det är den här kopian man tar i förväg. API-nycklarna är inte med: en nyckel återställs inte från en fil, den utfärdas på nytt.',
    'import' => 'Importera inställningar',
    'apply' => 'Importera',

    'file' => 'Inställningsfil',
    'file_helper' => 'En fil exporterad ur det här pluginet. Bilder och ikonpaket ligger inte i den - det är filer på en disk, och de blir kvar som de är.',

    'summary' => 'Vad det här skulle ändra',
    'summary_none' => 'Välj en fil för att se vad den skulle ändra.',
    'summary_unreadable' => 'Det är inte en inställningsfil från det här pluginet, eller så innehåller den ingenting den här panelen känner igen.',
    'summary_same' => 'Ingenting. Varje inställning i den filen stämmer redan med den här panelen.',
    'summary_count' => '{1} En inställning skulle ändras.|[2,*] :count inställningar skulle ändras.',
    'summary_more' => '· och :count till',

    'imported' => 'Inställningarna importerade',
    'missing' => 'De här bilderna finns inte på den här panelen och lämnas utanför: :files',
    'failed' => 'Den filen gick inte att importera',
    'no_file' => 'Ingen fil kom fram. En uppladdning som väntar för länge innan Importera trycks städas bort av panelen - välj filen igen och importera den direkt efteråt.',
    'denied' => 'Du har inte behörighet att ändra de här inställningarna.',
];
