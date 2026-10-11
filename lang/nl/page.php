<?php

/*
 * Nederlands. Met de hand geschreven.
 *
 * Commando's, paden en bestandsnamen blijven staan zoals ze zijn: iemand die
 * `php artisan schedule:run` moet intypen heeft niets aan een vertaling ervan,
 * en `storage/logs` is een map en geen woord.
 */

return [
    'title' => 'Essentials-instellingen',
    'nav_label' => 'Essentials-instellingen',

    'save' => 'Opslaan',
    'saved' => 'Instellingen opgeslagen',
    'save_failed' => 'De instellingen konden niet worden opgeslagen',
    'secret_kept' => 'Opgeslagen. Laat leeg om te behouden, of typ een nieuwe om te vervangen.',

    'update_background' => 'Het draait op de achtergrond en duurt een minuut of twee.',

    'worker_missing' => 'Geen enkele queue worker antwoordde. Modpack-installaties, mails en andere achtergrondtaken worden in de wachtrij gezet en door een workerproces uitgevoerd, dus tot er een draait worden ze wel opgeschreven en nooit uitgevoerd - zonder foutmelding, waar dan ook. Óf er is geen worker, óf er draait er een die is gestart voordat deze plugin was geïnstalleerd en zijn code niet kan laden. Beide los je op door hem op de host van het panel te herstarten. Zet zijn service op automatisch herstarten, anders komt dit na elke update terug.',
    'cron_missing' => 'De planner van het panel heeft :for minuten niet gedraaid. Verlengingen en watchdog-controles wachten daarop. De cron-regel staat in de documentatie van Pelican.',

    'storage_failed' => 'Het panel kon niet naar zijn opslagmap schrijven, dus dit is niet opgeslagen. Controleer of storage/app eigendom is van de gebruiker waaronder het panel draait. De reden staat in storage/logs.',
];
