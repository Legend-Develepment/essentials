<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * At flytte en kørende ydelse fra én pakke til en anden.
 *
 * Teksten holder én ting adskilt hele vejen igennem: hvad en pakke koster, og
 * hvad det koster at skifte til den i dag, er to forskellige tal. Det første
 * står på hylden; det andet afhænger af, hvor langt inde i den betalte periode
 * denne ydelse er, og det er det, man siger ja til, når man trykker på knappen.
 *
 * Ordet „opgradering“ undgås i det, en kunde læser, for halvdelen af disse
 * flytninger går den anden vej. Her hedder det et skift.
 */

return [
    // ---- på kortet med ydelsen -------------------------------------------
    'change' => 'Skift pakke',
    'change_body' => 'Det, der er tilbage af den periode, du allerede har betalt for, trækkes fra, og de samme dage beregnes til den nye pris. Der går ikke noget tabt på din server.',
    'change_to' => 'Skift til :name',
    'change_confirm' => 'Skal denne ydelse skiftes til :name?',
    'change_free' => 'Ikke noget at betale',
    'costs_now' => ':amount nu',
    'gives_back' => ':amount tilbage',
    'waiting' => 'Skift aftalt',
    'waiting_for' => 'Et skift til :name venter på en ubetalt faktura.',

    // ---- hvad der sker bagefter ------------------------------------------
    'done' => 'Flyttet til :name',
    'done_body' => 'Din ydelse ligger på den nye pakke. Det, du havde til gode, står på din konto.',
    'refused' => 'Skiftet blev ikke gennemført',

    // ---- og hvorfor ikke, én grund ad gangen -----------------------------
    'refused_off' => 'Det er slået fra på dette panel at skifte pakke.',
    'refused_not_active' => 'Kun en kørende ydelse kan skiftes. En, der venter på at blive bygget, er suspenderet eller er på vej ud, har ikke noget at gøre op.',
    'refused_gone' => 'Den pakke, denne ydelse ligger på, findes ikke længere, så der er ikke noget at sammenligne med.',
    'refused_same' => 'Det er den pakke, den allerede ligger på.',
    'refused_egg' => 'Den pakke kører anden software. Det ville være en anden server frem for en større, så den skal købes som en ny.',
    'refused_period' => 'Den pakke faktureres over en anden periode, og det er en anden aftale frem for en større.',
    'refused_stock' => 'Den pakke er udsolgt.',
    'refused_waiting' => 'Der venter allerede et skift på en ubetalt faktura for denne ydelse. Betal eller annullér den først.',
    'refused_failed' => 'Der blev ikke skrevet noget ned, så intet er ændret. Prøv igen, og sig det til den, der driver dette panel, hvis det bliver ved.',
    'refused_server' => 'Serveren kunne ikke få de nye grænser, så ydelsen blev stående præcis, som den var. Den, der driver dette panel, har fået besked.',

    // ---- hvad der står på dokumenterne -----------------------------------
    'line' => 'Skift fra :from til :to, for de :days dage der er tilbage af denne periode',
    'credit_reason' => 'Skift til :name',

    // ---- og hvad ejeren får at vide --------------------------------------
    'bell_failed' => 'Et pakkeskift mislykkedes på ordre :number',
    'cold_title' => 'Et pakkeskift nåede panelet, men ikke noden, på ordre :number',
    'cold_body' => 'Ydelsen ligger på :name, og de nye grænser er noteret. Noden har ikke taget dem endnu og læser dem, næste gang den server starter, så indtil da har kunden stadig den gamle størrelse. Tjek noden.',
    'gone' => 'Den pakke, der blev skiftet til, findes ikke længere.',
    'refused_by_node' => 'Serveren ville ikke tage de nye grænser: :why',

    // ---- at rette op på et ------------------------------------------------
    'retry' => 'Prøv skiftet igen',
    'retry_confirm' => 'Prøv pakkeskiftet igen. Fakturaen for det er allerede betalt, så der bliver ikke opkrævet noget to gange.',
    'retried' => 'Skiftet gik igennem',
    'retry_failed' => 'Det mislykkedes igen. Årsagen står på ordren.',
];
