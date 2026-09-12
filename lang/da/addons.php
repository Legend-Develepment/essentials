<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Tilvalg, der sælges ved siden af en pakke.
 *
 * To ting holdes adskilt her. Hvad et tilvalg *koster*, er dets pris, og det er
 * det, der opkræves hver gang. Hvad det *koster i dag*, er en andel af det, for
 * den, der køber et midt i en måned, betaler for en halv måned. Det, kunden
 * læser, siger altid, hvilken af de to der menes.
 *
 * „Lægger intet til serveren“ er et rigtigt svar og bliver skrevet ud i stedet
 * for at stå tomt, for support med forrang er en helt almindelig ting at sælge,
 * og en tom celle læses som en fejl.
 */

return [
    'title' => 'Tilvalg',
    'nav_label' => 'Tilvalg',
    'subheading' => 'Ting, der sælges ved siden af en pakke: mere hukommelse, en sikkerhedskopi mere, eller noget, der kun er en linje på fakturaen.',

    // ---- tabellen ---------------------------------------------------------
    'column_name' => 'Tilvalg',
    'column_price' => 'Pris',
    'column_adds' => 'Lægger til',
    'column_sold' => 'I brug',
    'column_live' => 'Til salg',
    'adds_nothing' => 'Intet på serveren',

    // ---- formularen -------------------------------------------------------
    'section_what' => 'Hvad det er',
    'section_what_helper' => 'Det navn og den pris, en kunde ser, og hvilke pakker det kan købes til.',
    'name' => 'Navn',
    'price' => 'Pris',
    'price_helper' => 'Hvad det koster, hver gang det opkræves. Købt midt i en periode betaler kunden en andel af det, og hele beløbet fra næste fornyelse.',
    'billing' => 'Opkræves',
    'billing_helper' => 'Med ydelsen betyder, at det kommer igen ved hver fornyelse, så længe de beholder det. Én gang betyder, at det opkræves på den faktura, det først står på, og aldrig igen.',
    'billing_with' => 'Ved hver fornyelse',
    'billing_once' => 'Én gang',
    'max' => 'Højst pr. ydelse',
    'max_helper' => 'Hvor mange af dette én må have. Én er det almindelige; sæt den op for noget, der sælges pr. gigabyte.',
    'description' => 'Beskrivelse',
    'description_helper' => 'Én linje under navnet ved bestillingen. Skriv, hvad det gør, frem for hvad det hedder.',
    'packages' => 'Pakker',
    'packages_helper' => 'Hvilke pakker dette kan købes til. Intet afkrydset betyder dem alle, og det er som regel det, en supportaftale eller en ekstra sikkerhedskopi er.',

    'section_adds' => 'Hvad det lægger til serveren',
    'section_adds_helper' => 'Det her lægges oven i det, pakken allerede giver, og sættes ikke i stedet for: 4096 i hukommelse gør serveren 4 GiB større. To ens tilvalg lægges sammen. Lad dem alle stå på nul for noget, der kun er en linje på fakturaen. Et negativt tal tager noget væk, og det er tilladt og af og til lige det, nogen vil have.',
    'sort' => 'Rækkefølge',
    'sort_helper' => 'Lavere kommer først ved bestillingen. Ens tal falder tilbage på prisen.',
    'live' => 'Til salg',
    'live_helper' => 'Slukket bliver det ikke tilbudt nogen steder. Den, der allerede har det, beholder det og bliver ved med at blive opkrævet for det.',

    // ---- knapperne --------------------------------------------------------
    'new' => 'Nyt tilvalg',
    'edit' => 'Rediger',
    'delete' => 'Slet',
    'delete_confirm' => 'Ingen har dette. At slette det tager det af listen for altid.',
    'delete_sold' => ':count ydelse(r) har dette. De beholder det, beholder de grænser, det gav dem, og bliver ved med at blive opkrævet for det - det, der forsvinder, er posten på listen, så ingen ny kan købe det.',
    'go_live' => 'Sæt til salg',
    'go_offline' => 'Tag af salg',
    'saved' => 'Gemt',
    'deleted' => 'Tilvalget er væk',
    'save_failed' => 'Ikke gemt',
    'save_failed_body' => 'Der blev ikke skrevet noget. Prøv igen, og kig i loggen, hvis det bliver ved.',
    'invalid' => 'Et tilvalg skal have et navn og en pris.',
    'empty' => 'Ingen tilvalg endnu',
    'empty_body' => 'Et tilvalg er noget, der sælges ved siden af en pakke: en gigabyte mere, en sikkerhedskopi mere, eller en ydelse, der slet ikke lægger noget til serveren.',

    // ---- hvad en kunde ser ------------------------------------------------
    'choose' => 'Tilvalg',
    'choose_helper' => 'Frivilligt, og du kan lægge dem til eller tage dem fra senere.',
    'yours' => 'Tilvalg på denne ydelse',
    'add' => 'Læg et tilvalg til',
    'add_helper' => 'Du betaler for resten af denne periode nu, og hele prisen fra næste fornyelse.',
    'add_to' => 'Læg :name til',
    'add_confirm' => 'Skal :name lægges til denne ydelse?',
    'drop' => 'Fjern',
    'drop_confirm' => 'Fjern :name? Den del af det betalte, du ikke har brugt, går tilbage på din konto, og din server ændrer sig med det samme.',
    'costs_now' => ':amount nu',
    'free_now' => 'Ikke noget at betale nu',
    'then' => 'derefter :amount pr. fornyelse',
    'once_only' => ':amount, én gang',
    'each' => 'pr. stk.',
    'added' => ':name lagt til',
    'added_body' => 'Din server har fået det, tilvalget lægger til.',
    'dropped' => ':name fjernet',
    'dropped_body' => 'Det, du havde betalt og ikke brugt, står på din konto.',

    // ---- og når det ikke går ----------------------------------------------
    'refused' => 'Det kunne ikke lade sig gøre',
    'refused_off' => 'Tilvalg er slået fra på dette panel.',
    'refused_not_active' => 'Kun en kørende ydelse kan få tilvalg lagt til.',
    'refused_gone' => 'Det tilvalg er ikke til salg længere.',
    'refused_wrong_package' => 'Det tilvalg sælges ikke til denne pakke.',
    'refused_enough' => 'Du har allerede så mange af dem, som denne ydelse må have.',
    'refused_failed' => 'Der blev ikke skrevet noget ned, så intet er ændret. Prøv igen, og sig det til den, der driver dette panel, hvis det bliver ved.',
    'refused_server' => 'Serveren ville ikke tage de nye grænser, så der blev ikke ændret noget og ikke opkrævet noget.',
    'refused_not_yours' => 'Det tilvalg ligger ikke på denne ydelse.',

    // ---- hvad der står på dokumenterne ------------------------------------
    'line' => ':name × :many, for de :days dage der er tilbage af denne periode',
    'credit_reason' => 'Fjernet: :name',
    'bell_failed' => 'Et tilvalg kunne ikke gives til serveren på ordre :number',

    // ---- enheder, til administratorens tabel ------------------------------
    'unit_memory' => 'MiB hukommelse',
    'unit_swap' => 'MiB swap',
    'unit_disk' => 'MiB disk',
    'unit_cpu' => '% CPU',
    'unit_database_limit' => 'databaser',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'sikkerhedskopier',
];
