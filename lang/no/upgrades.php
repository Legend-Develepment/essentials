<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Å flytte en tjeneste som går, fra én pakke til en annen.
 *
 * Ordlyden holder én ting fra hverandre hele veien: hva en pakke koster, og
 * hva det koster å bytte til den i dag, er to forskjellige tall. Det første
 * står i hyllen; det andre avhenger av hvor langt ut i den betalte perioden
 * denne tjenesten er, og det er det man sier ja til når man trykker.
 *
 * «Oppgradering» unngås i det en kunde leser, for halvparten av disse byttene
 * går den andre veien. Ordet her er bytte.
 */

return [
    // ---- på tjenestekortet -----------------------------------------------
    'change' => 'Bytt pakke',
    'change_body' => 'Det som er igjen av perioden du allerede har betalt for, trekkes fra, og de samme dagene beregnes til den nye prisen. Ingenting på serveren din går tapt.',
    'change_to' => 'Bytt til :name',
    'change_confirm' => 'Bytte denne tjenesten til :name?',
    'change_free' => 'Ingenting å betale',
    'costs_now' => ':amount nå',
    'gives_back' => ':amount tilbake',
    'waiting' => 'Bytte avtalt',
    'waiting_for' => 'Et bytte til :name venter på en ubetalt faktura.',

    // ---- hva som skjer etterpå -------------------------------------------
    'done' => 'Flyttet til :name',
    'done_body' => 'Tjenesten din står på den nye pakken. Det du hadde til gode, står på kontoen din.',
    'refused' => 'Byttet ble ikke gjort',

    // ---- og hvorfor ikke, én grunn om gangen -----------------------------
    'refused_off' => 'Å bytte pakke er slått av for dette panelet.',
    'refused_not_active' => 'Bare en tjeneste som går, kan byttes. En som venter, er suspendert eller holder på å avsluttes, har ingenting å regne ut.',
    'refused_gone' => 'Pakken denne tjenesten står på, finnes ikke lenger, så det er ingenting å sammenligne med.',
    'refused_same' => 'Det er pakken den allerede står på.',
    'refused_egg' => 'Den pakken kjører annen programvare. Det ville blitt en annen server framfor en større, så den må kjøpes som en egen.',
    'refused_period' => 'Den pakken faktureres over en annen periode, og det er en annen avtale framfor en større.',
    'refused_stock' => 'Den pakken er utsolgt.',
    'refused_waiting' => 'Det venter allerede et bytte på en ubetalt faktura for denne tjenesten. Betal eller avbryt den først.',
    'refused_failed' => 'Ingenting ble skrevet ned, så ingenting er endret. Prøv igjen, og si fra til den som driver panelet, hvis det fortsetter å skje.',
    'refused_server' => 'Serveren kunne ikke få de nye grensene, så tjenesten ble stående nøyaktig som den var. Den som driver panelet, har fått beskjed.',

    // ---- hva dokumentene sier --------------------------------------------
    'line' => 'Bytte fra :from til :to, for de :days dagene som er igjen av denne perioden',
    'credit_reason' => 'Bytte til :name',

    // ---- og hva eieren får høre ------------------------------------------
    'bell_failed' => 'Et pakkebytte feilet på bestilling :number',
    'cold_title' => 'Et pakkebytte nådde panelet, men ikke noden, på bestilling :number',
    'cold_body' => 'Tjenesten står på :name, og de nye grensene er notert. Noden har ikke tatt dem ennå og leser dem neste gang den serveren starter, så inntil da har kunden fortsatt den gamle størrelsen. Se over noden.',
    'gone' => 'Pakken det ble byttet til, finnes ikke lenger.',
    'refused_by_node' => 'Serveren ville ikke ta de nye grensene: :why',

    // ---- å rette opp et -------------------------------------------------
    'retry' => 'Prøv byttet på nytt',
    'retry_confirm' => 'Prøv pakkebyttet på nytt. Fakturaen for det er allerede betalt, så ingenting belastes to ganger.',
    'retried' => 'Byttet gikk gjennom',
    'retry_failed' => 'Det feilet igjen. Grunnen står på bestillingen.',
];
