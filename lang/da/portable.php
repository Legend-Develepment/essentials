<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Indstillingerne som en fil: ud og ind igen.
 *
 * De uploadede filer er bevidst ikke med - se Support\Portable for hvorfor det
 * er bedre at sige det end at lade dem blive væk i stilhed.
 */

return [
    'export' => 'Eksportér indstillinger',
    'records' => 'Eksportér posterne',
    'records_helper' => 'Alle pakker, ordrer, fakturaer, betalinger og sager i én fil. Fjerner du dette plugin, slettes det hele, og Pelican spørger ikke om noget først, så det er denne kopi, man tager på forhånd. API-nøglerne er ikke med: en nøgle gendannes ikke fra en fil, den udstedes på ny.',
    'import' => 'Importér indstillinger',
    'apply' => 'Importér',

    'file' => 'Indstillingsfil',
    'file_helper' => 'En fil, der er eksporteret fra dette plugin. Billeder og ikonpakker er ikke med - det er filer på en disk, og de bliver, som de er.',

    'summary' => 'Hvad det ville ændre',
    'summary_none' => 'Vælg en fil for at se, hvad den ville ændre.',
    'summary_unreadable' => 'Det er ikke en indstillingsfil fra dette plugin, eller den indeholder intet, dette panel kender.',
    'summary_same' => 'Ingenting. Hver eneste indstilling i den fil passer allerede til dette panel.',
    'summary_count' => '{1} Én indstilling ville ændre sig.|[2,*] :count indstillinger ville ændre sig.',
    'summary_more' => '· og :count mere',

    'imported' => 'Indstillinger importeret',
    'missing' => 'Disse billeder findes ikke på dette panel og bliver udeladt: :files',
    'failed' => 'Den fil kunne ikke importeres',
    'no_file' => 'Der kom ingen fil. En upload, der venter for længe, før der trykkes Importér, bliver ryddet væk af panelet - vælg filen igen, og importér den lige bagefter.',
    'denied' => 'Du har ikke lov til at ændre disse indstillinger.',
];
