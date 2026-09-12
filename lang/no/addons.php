<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Tillegg som selges ved siden av en pakke.
 *
 * To ord holdes fra hverandre her. Hva et tillegg *koster* er prisen, og det
 * er den som belastes hver gang. Hva det *koster i dag* er en andel av den,
 * for den som kjøper et midt i en måned, betaler for en halv måned av det.
 * Ordlyden kunden leser, sier alltid hvilken av de to den mener.
 *
 * «Legger ingenting til på serveren» er et ekte svar og sies rett ut framfor å
 * bli stående som en tom rute, for forrang i support er en helt vanlig ting å
 * selge, og en tom rute leses som en feil.
 */

return [
    'title' => 'Tillegg',
    'nav_label' => 'Tillegg',
    'subheading' => 'Ting som selges ved siden av en pakke: mer minne, en plass til for sikkerhetskopier, eller noe som bare er en linje på fakturaen.',

    // ---- tabellen ---------------------------------------------------------
    'column_name' => 'Tillegg',
    'column_price' => 'Pris',
    'column_adds' => 'Legger til',
    'column_sold' => 'I bruk',
    'column_live' => 'Til salgs',
    'adds_nothing' => 'Ingenting på serveren',

    // ---- skjemaet ---------------------------------------------------------
    'section_what' => 'Hva det er',
    'section_what_helper' => 'Navnet og prisen en kunde ser, og hvilke pakker det kan kjøpes til.',
    'name' => 'Navn',
    'price' => 'Pris',
    'price_helper' => 'Hva det koster hver gang det belastes. Kjøpt midt i en periode betaler kunden en andel av dette, og hele beløpet fra neste fornyelse.',
    'billing' => 'Belastes',
    'billing_helper' => 'Med tjenesten betyr at det kommer igjen ved hver fornyelse, så lenge de beholder det. Én gang betyr at det belastes på den fakturaen som først bærer det, og aldri mer.',
    'billing_with' => 'Ved hver fornyelse',
    'billing_once' => 'Én gang',
    'max' => 'Høyst per tjeneste',
    'max_helper' => 'Hvor mange av dette én kan ha. Én er det vanlige; sett den opp for noe som selges per gigabyte.',
    'description' => 'Beskrivelse',
    'description_helper' => 'Én linje under navnet i kassen. Si hva det gjør framfor hva det heter.',
    'packages' => 'Pakker',
    'packages_helper' => 'Hvilke pakker dette kan kjøpes til. Ingenting avkrysset betyr alle sammen, som er det en supportordning eller en ekstra kopiplass som regel er.',

    'section_adds' => 'Hva det legger til på serveren',
    'section_adds_helper' => 'Disse legges til det pakken allerede gir, og settes ikke i stedet for det: 4096 i minne gjør serveren 4 GiB større. To like tillegg legges sammen. La dem alle stå på null for noe som bare er en linje på fakturaen. Et negativt tall tar noe bort, og det er tillatt - og av og til nettopp det noen vil.',
    'sort' => 'Rekkefølge',
    'sort_helper' => 'Lavere kommer først i kassen. Like tall faller tilbake på prisen.',
    'live' => 'Til salgs',
    'live_helper' => 'Av tilbys det ingen steder. Den som allerede har det, beholder det og fortsetter å bli belastet for det.',

    // ---- knappene ---------------------------------------------------------
    'new' => 'Nytt tillegg',
    'edit' => 'Rediger',
    'delete' => 'Slett',
    'delete_confirm' => 'Ingen har dette. Å slette det tar det av listen for godt.',
    'delete_sold' => ':count tjeneste(r) har dette. De beholder det, beholder grensene det ga dem og fortsetter å bli belastet for det - det som forsvinner, er oppføringen på listen, så ingen nye kan kjøpe det.',
    'go_live' => 'Legg ut for salg',
    'go_offline' => 'Ta av salg',
    'saved' => 'Lagret',
    'deleted' => 'Tillegget er borte',
    'save_failed' => 'Ikke lagret',
    'save_failed_body' => 'Ingenting ble skrevet. Prøv igjen, og se i loggen hvis det fortsetter å skje.',
    'invalid' => 'Et tillegg trenger et navn og en pris.',
    'empty' => 'Ingen tillegg ennå',
    'empty_body' => 'Et tillegg er noe som selges ved siden av en pakke: en gigabyte til, en ekstra kopiplass, eller en tjeneste som ikke legger noe til på serveren i det hele tatt.',

    // ---- hva en kunde ser -------------------------------------------------
    'choose' => 'Tillegg',
    'choose_helper' => 'Valgfritt, og du kan legge til eller fjerne dem senere.',
    'yours' => 'Tillegg på denne tjenesten',
    'add' => 'Legg til et tillegg',
    'add_helper' => 'Du betaler for det som er igjen av denne perioden nå, og hele prisen fra neste fornyelse.',
    'add_to' => 'Legg til :name',
    'add_confirm' => 'Legge :name til denne tjenesten?',
    'drop' => 'Fjern',
    'drop_confirm' => 'Fjerne :name? Den ubrukte delen av det du har betalt, går tilbake på kontoen din, og serveren din endrer seg med det samme.',
    'costs_now' => ':amount nå',
    'free_now' => 'Ingenting å betale nå',
    'then' => 'deretter :amount per fornyelse',
    'once_only' => ':amount, én gang',
    'each' => 'stykket',
    'added' => ':name lagt til',
    'added_body' => 'Serveren din har fått det tillegget gir.',
    'dropped' => ':name fjernet',
    'dropped_body' => 'Det du hadde betalt og ikke brukt, står på kontoen din.',

    // ---- og når det ikke går ----------------------------------------------
    'refused' => 'Det lot seg ikke gjøre',
    'refused_off' => 'Tillegg er slått av for dette panelet.',
    'refused_not_active' => 'Bare en tjeneste som går, kan få tillegg lagt til.',
    'refused_gone' => 'Det tillegget er ikke til salgs lenger.',
    'refused_wrong_package' => 'Det tillegget selges ikke til denne pakken.',
    'refused_enough' => 'Du har allerede så mange av dem som denne tjenesten kan ha.',
    'refused_failed' => 'Ingenting ble skrevet ned, så ingenting er endret. Prøv igjen, og si fra til den som driver panelet, hvis det fortsetter å skje.',
    'refused_server' => 'Serveren ville ikke ta de nye grensene, så ingenting ble endret og ingenting ble belastet.',
    'refused_not_yours' => 'Det tillegget står ikke på denne tjenesten.',

    // ---- hva dokumentene sier ---------------------------------------------
    'line' => ':name × :many, for de :days dagene som er igjen av denne perioden',
    'credit_reason' => 'Fjernet: :name',
    'bell_failed' => 'Et tillegg kunne ikke gis til serveren på bestilling :number',

    // ---- enheter, til admintabellen ---------------------------------------
    'unit_memory' => 'MiB minne',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disk',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databaser',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'sikkerhetskopier',
];
