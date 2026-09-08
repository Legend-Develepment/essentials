<?php

/*
 * Norsk. Skrevet for hånd.
 *
 * Butikkens innstillinger, og senere butikken selv.
 *
 * To lesere deler denne filen med vilje. Innstillingshalvdelen leses av
 * administratoren; den offentlige halvdelen og kundehalvdelen - som kommer til
 * etter hvert som butikken vokser - leses av folk som kanskje aldri har hørt om
 * Pelican, og hver setning der må være skrevet for dem.
 */

return [
    'title' => 'Butikkinnstillinger',
    'nav_label' => 'Butikkinnstillinger',
    'subheading' => 'Valutaen, avgiften, hvordan fakturaer nummereres, og hva den offentlige siden sier. Det som er til salgs, står på siden Pakker.',

    // ---- hvor den er -----------------------------------------------------
    'address' => 'Den offentlige butikken er på',
    'address_off' => 'Den offentlige siden er slått av. Slå på «Offentlig butikkside» i funksjonslisten på siden Essentials-innstillinger, så svarer den på :url.',

    // ---- generelt --------------------------------------------------------
    'section_general' => 'Penger',
    'section_general_helper' => 'Én valuta for hele butikken. Hver pris på hver pakke er et tall i den.',
    'currency' => 'Valuta',
    'currency_helper' => 'Å endre den regner ikke om noe: prisene på pakkene er tall, og etter en endring er de tall i den nye valutaen.',
    'tax' => 'Avgift',
    'tax_helper' => 'En prosentsats som legges på hver faktura som sin egen linje. Prisene på pakkene er uten avgift. Null for ingen.',
    'tax_suffix' => '%',
    'prefix' => 'Fakturanumre begynner med',
    'prefix_helper' => 'Etterfulgt av et tall som teller oppover. INV- gir INV-000001.',

    // ---- fornyelser ------------------------------------------------------
    'section_renewals' => 'Fornyelser',
    'section_renewals_helper' => 'For pakker som faktureres per måned, kvartal eller år. En engangspakke røres aldri av dette.',
    'notice_days' => 'Fakturer så mange dager før perioden slutter',
    'notice_days_helper' => 'Når den neste fakturaen lages og kunden får beskjed om den.',
    'grace' => 'Suspender så mange dager etter at en faktura forfaller',
    'grace_helper' => 'En ubetalt faktura utover dette suspenderer serveren — Pelicans egen suspensjon, opphevet i det øyeblikket fakturaen betales. Butikken sletter aldri noe.',
    'days' => 'dager',

    // ---- den offentlige siden --------------------------------------------
    'section_public' => 'Den offentlige siden',
    'section_public_helper' => 'Leses av folk uten konto. Om den i det hele tatt vises, er bryteren «Offentlig butikkside» i funksjonslisten.',
    'heading' => 'Overskrift',
    'heading_helper' => 'Står den tom, brukes panelets eget navn.',
    'note' => 'En linje over pakkene',
    'note_helper' => 'For å si hvem du er, eller hva et kjøp gir noen. Ren tekst.',
    'terms_url' => 'Vilkår',
    'terms_url_helper' => 'En https-adresse. Er den satt, betyr et kjøp å krysse av i en boks som peker på den.',

    // ---- å betale for hånd -----------------------------------------------
    'section_manual' => 'Betaling uten leverandør',
    'section_manual_helper' => 'Vises på en ubetalt faktura så lenge ingen betalingsleverandør er slått på: bankopplysninger, eller hvor pengene skal sendes. Ren tekst.',
    'pay_note' => 'Slik betaler man',
    'pay_note_helper' => 'La den stå tom, så sier en ubetalt faktura bare at den er ubetalt.',

    // ---- knappene --------------------------------------------------------
    'save' => 'Lagre',
    'saved' => 'Lagret',
    'save_failed' => 'Ingenting ble lagret',
];
