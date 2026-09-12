<?php

/*
 * Svenska. Skriven för hand.
 *
 * Att flytta en aktiv tjänst från ett paket till ett annat.
 *
 * Orden håller en sak rak hela vägen: vad ett paket kostar och vad det kostar
 * att byta till det i dag är två olika tal. Det första står på hyllan; det
 * andra beror på hur långt in i den betalda perioden tjänsten är, och det är
 * det man går med på när man trycker på knappen.
 *
 * «Uppgradering» undviks i det kunden läser, för hälften av de här bytena går
 * åt andra hållet. Ordet här är byte.
 */

return [
    // ---- på tjänstekortet -------------------------------------------------
    'change' => 'Byt paket',
    'change_body' => 'Det som är kvar av perioden du redan betalat dras av, och samma dagar debiteras till det nya priset. Ingenting på din server går förlorat.',
    'change_to' => 'Byt till :name',
    'change_confirm' => 'Byta den här tjänsten till :name?',
    'change_free' => 'Inget att betala',
    'costs_now' => ':amount nu',
    'gives_back' => ':amount tillbaka',
    'waiting' => 'Bytet är överenskommet',
    'waiting_for' => 'Ett byte till :name väntar på en obetald faktura.',

    // ---- vad som händer efteråt -------------------------------------------
    'done' => 'Flyttad till :name',
    'done_body' => 'Din tjänst ligger på det nya paketet. Det du hade tillgodo står på ditt konto.',
    'refused' => 'Bytet gjordes inte',

    // ---- och varför inte, ett skäl i taget --------------------------------
    'refused_off' => 'Att byta paket är avstängt för den här panelen.',
    'refused_not_active' => 'Bara en körande tjänst går att byta. En som väntar, är avstängd eller håller på att avslutas har ingenting att räkna på.',
    'refused_gone' => 'Paketet den här tjänsten ligger på finns inte längre, så det finns ingenting att jämföra mot.',
    'refused_same' => 'Det är paketet den redan ligger på.',
    'refused_egg' => 'Det paketet kör annan mjukvara. Det vore en annan server och inte en större, så det får köpas som en.',
    'refused_period' => 'Det paketet faktureras över en annan period, vilket är ett annat avtal och inte ett större.',
    'refused_stock' => 'Det paketet är slutsålt.',
    'refused_waiting' => 'Det finns redan ett byte som väntar på en obetald faktura för den här tjänsten. Betala eller avbryt den först.',
    'refused_failed' => 'Ingenting skrevs ner, så ingenting har ändrats. Försök igen, och säg till den som sköter panelen om det fortsätter.',
    'refused_server' => 'Servern gick inte att ge de nya gränserna, så tjänsten lämnades precis som den var. Den som sköter panelen har fått veta.',

    // ---- vad dokumenten säger ---------------------------------------------
    'line' => 'Byte från :from till :to, för de :days dagar som är kvar av perioden',
    'credit_reason' => 'Byte till :name',

    // ---- och vad ägaren får höra ------------------------------------------
    'bell_failed' => 'Ett paketbyte misslyckades på beställning :number',
    'cold_title' => 'Ett paketbyte nådde panelen men inte noden, på beställning :number',
    'cold_body' => 'Tjänsten ligger på :name och de nya gränserna är antecknade. Noden har inte tagit dem än och läser dem nästa gång den servern startar, så till dess har kunden kvar den gamla storleken. Titta till noden.',
    'gone' => 'Paketet som skulle bytas till finns inte längre.',
    'refused_by_node' => 'Servern ville inte ta de nya gränserna: :why',

    // ---- att rätta till ett ----------------------------------------------
    'retry' => 'Försök byta igen',
    'retry_confirm' => 'Provar paketbytet en gång till. Fakturan för det är redan betald, så ingenting debiteras två gånger.',
    'retried' => 'Bytet gick igenom',
    'retry_failed' => 'Det misslyckades igen. Skälet står på beställningen.',
];
