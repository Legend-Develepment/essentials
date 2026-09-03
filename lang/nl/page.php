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

    'update' => 'Bijwerken',
    'update_available' => 'Er is een update beschikbaar',
    'update_confirm' => 'Het panel downloadt de nieuwe versie, bouwt zijn assets opnieuw en leegt zijn caches. Je instellingen blijven behouden.',
    'update_started' => 'Bijwerken gestart',
    'update_background' => 'Het draait op de achtergrond en duurt een minuut of twee.',
    'update_failed' => 'Het thema kon niet worden bijgewerkt',
    'update_done' => 'Thema bijgewerkt',

    'check' => 'Controleren op updates',
    'check_failed' => 'De update-feed kon niet worden gelezen',
    'check_failed_body' => 'Het panel kon hem niet bereiken, of hij gaf geen geldige JSON terug.',
    'up_to_date' => 'Je hebt de nieuwste versie',
    'reinstall' => 'Opnieuw installeren',

    'auto_on' => 'Updates installeren zichzelf',

    /*
     * Wat de laatste automatische controle deed. Elk van deze noemt het
     * onderdeel dat aandacht nodig heeft, want vanuit een browser zien de drie
     * manieren waarop dit misgaat er hetzelfde uit: een getal dat aftelt.
     */
    'auto_never' => 'Er is nog geen controle gedraaid. Automatische updates hebben de planner van het panel nodig — de cron-regel die elke minuut php artisan schedule:run uitvoert. Zonder die regel gebeurt er helemaal niets van wat ingepland staat.',
    'auto_ago' => 'Laatst gecontroleerd :ago',
    'auto_just_now' => 'zojuist',
    'auto_minutes' => 'minuten geleden',
    'auto_current' => 'niets nieuwers op dit kanaal.',
    'auto_queued' => 'v:version is in de wachtrij gezet. Verandert de versie hierboven niet binnen een paar minuten, dan draait de queue worker niet — daar gebeurt het bijwerken zelf.',
    'auto_unreachable' => 'de update-feed kon niet worden gelezen. Die wordt over internet opgehaald, dus dit is meestal een netwerk- of DNS-probleem op de host van het panel.',
    'auto_error' => 'de controle is mislukt. De reden staat in storage/logs.',

    'worker_missing' => 'Geen enkele queue worker antwoordde. Updates en modpack-installaties worden in de wachtrij gezet en door een workerproces uitgevoerd, dus tot er een draait worden ze wel opgeschreven en nooit uitgevoerd — zonder foutmelding, waar dan ook. Óf er is geen worker, óf er draait er een die is gestart voordat deze plugin was geïnstalleerd en zijn code niet kan laden. Beide los je op door hem op de host van het panel te herstarten. Zet zijn service op automatisch herstarten, anders komt dit na elke update terug.',

    'next_check' => 'Volgende controle over',
    'due_now' => 'nu aan de beurt',

    'storage_failed' => 'Het panel kon niet naar zijn opslagmap schrijven, dus dit is niet opgeslagen. Controleer of storage/app eigendom is van de gebruiker waaronder het panel draait. De reden staat in storage/logs.',

    'update_renamed' => 'Staat hier dat twee ids niet overeenkomen, dan is de plugin hernoemd en kan geen enkele update daar overheen — Pelican kent een geïnstalleerde plugin aan zijn id. Verwijder het oude item onder Beheer → Plugins en installeer deze opnieuw. Je instellingen overleven dat: die staan in .env en in storage/app/private/legend-theme, en geen van beide is op het id gesleuteld.',
];
