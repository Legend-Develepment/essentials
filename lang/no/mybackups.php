<?php

/*
 * Norsk. Skrevet for hånd.
 */

return [
    /*
     * To setninger som føyes sammen til én linje, fordi det er to forskjellige
     * problemer: en server helt uten sikkerhetskopi er som regel en ingen har
     * satt opp en for, og en der den siste er ni dager gammel er en planlagt
     * oppgave som har stoppet.
     */
    'none' => '{1} En av serverne dine har aldri blitt sikkerhetskopiert.|[2,*] :count av serverne dine har aldri blitt sikkerhetskopiert.',
    'stale' => '{1} En har ikke blitt sikkerhetskopiert på over :days dager.|[2,*] :count har ikke blitt sikkerhetskopiert på over :days dager.',
    'schedules' => '{1} En av de planlagte oppgavene dine har stoppet.|[2,*] :count av de planlagte oppgavene dine har stoppet.',

    'and_more' => 'og :count til',

    'open' => 'Åpne en server og gå til Sikkerhetskopier for å lage en.',
];
