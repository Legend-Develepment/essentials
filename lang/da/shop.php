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

    /* ---------------------------------------------------------------------
     * Selve butikken, herfra og ned.
     *
     * En helt anden læser: nogen der køber en server, som måske aldrig har hørt
     * om Pelican og ikke ved, hvad en egg er. Intet herunder bruger panelets
     * ord, og hver sætning svarer på det spørgsmål, en kunde faktisk har det
     * sted på siden.
     * ------------------------------------------------------------------- */

    // ---- butikken --------------------------------------------------------
    'store_title' => 'Butik',
    'store_nav_label' => 'Butik',
    'store_subheading' => 'Vælg en server. Den bliver oprettet til dig, så snart fakturaen er betalt.',
    'store_empty' => 'Der er ikke noget til salg lige nu',
    'store_empty_body' => 'Kom igen senere, eller spørg den, der driver dette panel.',

    'buy' => 'Køb',
    'sold_out' => 'Udsolgt',
    'plus_setup' => 'plus :amount én gang',

    'spec_memory' => ':amount MiB hukommelse',
    'spec_disk' => ':amount MiB disk',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count sikkerhedskopier',
    'spec_databases' => ':count databaser',

    // ---- den offentlige side ---------------------------------------------
    'public_empty' => 'Der er ikke noget til salg lige nu',
    'public_empty_body' => 'Kom igen senere.',
    'to_panel' => 'Log ind',
    'terms' => 'Betingelser',
    'sign_in_note' => 'Vælg en server nedenfor. Du logger ind for at gøre det færdigt, og den bliver oprettet, når fakturaen er betalt.',

    // ---- bestillingen ----------------------------------------------------
    'checkout_title' => 'Bestilling',
    'tax_line' => 'Moms (:rate%)',
    'coupon' => 'Rabatkode',
    'coupon_placeholder' => 'Hvis du har en',
    'coupon_bad' => 'Den kode virker ikke her.',
    'coupon_good' => 'Koden er brugt.',
    'agree' => 'Jeg accepterer',
    'place_order' => 'Afgiv bestillingen',
    'place_order_note' => 'Dette skriver en faktura. Der bliver ikke trukket noget, før du betaler, og serveren oprettes, når den er betalt.',
    'back_to_store' => 'Tilbage til butikken',

    'placed' => 'Bestillingen er afgivet',
    'placed_body' => 'Faktura :number venter på din faktureringsside.',

    'refused' => 'Det kunne ikke købes',
    'refused_gone' => 'Det er ikke til salg længere.',
    'refused_sold_out' => 'Den sidste er væk.',
    'refused_bad_coupon' => 'Rabatkoden gælder ikke for dette.',
    'refused_failed' => 'Noget gik galt, da bestillingen skulle skrives. Der er ikke trukket noget. Prøv igen, og sig det til den, der driver dette panel, hvis det bliver ved.',

    // ---- fakturering -----------------------------------------------------
    'billing_title' => 'Fakturering',
    'billing_nav_label' => 'Fakturering',
    'billing_subheading' => 'Hvad du har købt, og hvad du skylder.',
    'your_orders' => 'Dine ordrer',
    'your_invoices' => 'Dine fakturaer',
    'no_orders' => 'Du har ikke købt noget endnu',
    'no_orders_body' => 'Alt hvad du køber, står her med sin server og sine datoer.',
    'no_invoices' => 'Ingen fakturaer endnu',
    'to_store' => 'Gå til butikken',
    'renews' => 'Fornyes',
    'ask_how_to_pay' => 'Spørg den, der driver dette panel, hvordan du betaler. De har ikke skrevet det her endnu.',
    'order_pending' => 'Venter på, at fakturaen bliver betalt. Lige derefter oprettes serveren.',
    'order_suspended' => 'Standset på grund af en ubetalt faktura. Betaler du den, starter serveren igen - der er ikke slettet noget.',
];
