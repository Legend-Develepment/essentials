<?php

/*
 * Dansk. Skrevet i hånden.
 *
 * Butikkens indstillinger, og senere butikken selv.
 *
 * To læsere deler denne fil med vilje. Indstillingshalvdelen læses af
 * administratoren; den offentlige halvdel og kundehalvdelen - som kommer til,
 * efterhånden som butikken vokser - læses af folk, der måske aldrig har hørt
 * om Pelican, og hver sætning dér skal være skrevet til dem.
 */

return [
    'title' => 'Butiksindstillinger',
    'nav_label' => 'Butiksindstillinger',
    'subheading' => 'Valutaen, momsen, hvordan fakturaer nummereres, og hvad den offentlige side siger. Det, der er til salg, står på siden Pakker.',

    // ---- hvor den er -----------------------------------------------------
    'address' => 'Den offentlige butik er på',
    'address_off' => 'Den offentlige side er slået fra. Slå „Offentlig butiksside" til i funktionslisten på siden Essentials-indstillinger, så svarer den på :url.',

    // ---- generelt --------------------------------------------------------
    'section_general' => 'Penge',
    'section_general_helper' => 'Én valuta for hele butikken. Hver pris på hver pakke er et tal i den.',
    'currency' => 'Valuta',
    'currency_helper' => 'At ændre den omregner ingenting: priserne på pakkerne er tal, og efter en ændring er de tal i den nye valuta.',
    'tax' => 'Moms',
    'tax_helper' => 'En procentsats, der lægges på hver faktura som sin egen linje. Priserne på pakkerne er uden moms. Nul for ingen.',
    'tax_suffix' => '%',
    'prefix' => 'Fakturanumre begynder med',
    'prefix_helper' => 'Efterfulgt af et tal, der tæller op. INV- giver INV-000001.',

    // ---- fornyelser ------------------------------------------------------
    'section_renewals' => 'Fornyelser',
    'section_renewals_helper' => 'For pakker, der faktureres pr. måned, kvartal eller år. En engangspakke røres aldrig af dette.',
    'notice_days' => 'Fakturér så mange dage før perioden udløber',
    'notice_days_helper' => 'Hvornår den næste faktura laves, og kunden får besked om den.',
    'grace' => 'Suspendér så mange dage efter, at en faktura forfalder',
    'grace_helper' => 'En ubetalt faktura ud over dette suspenderer serveren — Pelicans egen suspension, ophævet i det øjeblik fakturaen betales. Butikken sletter aldrig noget.',
    'days' => 'dage',

    // ---- den offentlige side ---------------------------------------------
    'section_public' => 'Den offentlige side',
    'section_public_helper' => 'Læses af folk uden konto. Om den overhovedet vises, er kontakten „Offentlig butiksside" i funktionslisten.',
    'heading' => 'Overskrift',
    'heading_helper' => 'Efterlades den tom, bruges panelets eget navn.',
    'note' => 'En linje over pakkerne',
    'note_helper' => 'Til at sige, hvem du er, eller hvad et køb giver nogen. Ren tekst.',
    'terms_url' => 'Vilkår',
    'terms_url_helper' => 'En https-adresse. Er den sat, betyder et køb at sætte kryds i et felt, der peger på den.',

    // ---- at betale i hånden ----------------------------------------------
    'section_manual' => 'Betaling uden udbyder',
    'section_manual_helper' => 'Vises på en ubetalt faktura, så længe ingen betalingsudbyder er slået til: bankoplysninger, eller hvor pengene skal sendes hen. Ren tekst.',
    'pay_note' => 'Sådan betaler man',
    'pay_note_helper' => 'Lad den stå tom, så siger en ubetalt faktura kun, at den er ubetalt.',

    // ---- knapperne -------------------------------------------------------
    'save' => 'Gem',
    'saved' => 'Gemt',
    'save_failed' => 'Intet blev gemt',
];
