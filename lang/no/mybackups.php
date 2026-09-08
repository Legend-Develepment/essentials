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
    'none' => ':count av serverne dine har aldri hatt en sikkerhetskopi.',
    'stale' => ':count har ikke hatt en sikkerhetskopi på over :days dager.',
    'schedules' => ':count av de planlagte oppgavene dine har stoppet.',

    'and_more' => 'og :count til',

    'open' => 'Åpne en server og gå til Sikkerhetskopier for å lage en.',
];
