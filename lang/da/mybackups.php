<?php

/*
 * Dansk. Skrevet i hånden.
 */

return [
    /*
     * To sætninger, der føjes sammen til én linje, fordi det er to forskellige
     * problemer: en server helt uden sikkerhedskopi er som regel en, ingen har
     * sat en op til, og en, hvis seneste er ni dage gammel, er en planlagt
     * opgave, der er gået i stå.
     */
    'none' => ':count af dine servere er aldrig blevet sikkerhedskopieret.',
    'stale' => ':count er ikke blevet sikkerhedskopieret i over :days dage.',
    'schedules' => ':count af dine planlagte opgaver er gået i stå.',

    'and_more' => 'og :count mere',

    'open' => 'Åbn en server og gå til Sikkerhedskopier for at lave en.',
];
