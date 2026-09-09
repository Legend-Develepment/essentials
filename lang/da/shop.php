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
    'grace_helper' => 'En ubetalt faktura ud over dette suspenderer serveren — Pelicans egen suspension, ophævet i det øjeblik fakturaen betales. Selve suspenderingen sletter ingenting.',
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
    'to_account' => 'Min konto',
    'filter_all' => 'Alt',
    'filter_label' => 'Vis',
    'includes' => 'Indeholder',
    'public_count' => ':count til salg',

    // ---- bestillingen ----------------------------------------------------
    'checkout_title' => 'Bestilling',
    'tax_line' => 'Moms (:rate%)',
    'coupon' => 'Rabatkode',
    'asks' => 'Om din server',
    'upload_default' => 'Din fil',
    'upload_help' => 'En zip-fil. Den kommer ind i din server, når den bygges.',
    'upload_busy' => 'Lægger op…',
    'what_is_this' => 'Hvad er det?',
    'leave_as_is' => 'Lad det stå uændret',
    'asks_optional' => 'Alt det her er valgfrit. Alt, hvad du lader stå, beholder det, serverskabelonen allerede havde.',
    'refused_no_file' => 'Denne pakke skal bruge en fil, og der blev ikke valgt nogen.',
    'refused_not_zip' => 'Det skal være en zip-fil.',
    'refused_too_big' => 'Den fil er for stor til, at dette panel kan tage den.',
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
    'server_installing' => 'Bliver stadig sat op. Den starter selv, når det er færdigt.',
    'server_failed' => 'Opsætningen blev ikke færdig. Den, der driver dette panel, har fået besked.',
    'server_suspended' => 'Standset af panelet. Der er ikke slettet noget på den.',
    'server_restoring' => 'En sikkerhedskopi bliver lagt tilbage. Det tager et par minutter.',
    'give' => 'Afslut denne ydelse',
    'give_end' => 'Afslut den på den dato',
    'give_end_on' => 'Afslut den :date',
    'give_end_body' => 'Den kører til :date, og du bliver ikke faktureret for den igen. Alt på den slettes den dag, så kopier det, du vil beholde.',
    'give_end_open' => 'Der er ingen dato at køre frem til, så at afslutte denne stopper faktureringen og lader serveren stå, indtil nogen fjerner den.',
    'give_end_confirm' => 'Afslut denne ydelse :date? Den kører indtil da og faktureres ikke igen.',
    'give_now' => 'Stop og slet den nu',
    'give_now_confirm' => 'Slet denne server nu, med sine filer, sine databaser og sine sikkerhedskopier? Der er ingen fortrydelse, og ingen penge tilbage for resten af den periode, du har betalt for.',
    'gave_end' => 'Opsagt',
    'gave_end_body' => 'Den kører til datoen på kortet og faktureres ikke igen. Der slettes ikke noget inden da.',
    'gave_now' => 'Væk',
    'gave_now_body' => 'Serveren er slettet, og du bliver ikke faktureret for den igen.',
    'gave_refused' => 'Det gik ikke',
    'gave_refused_body' => 'Der blev ikke ændret noget. Hent siden igen, og spørg den, der driver dette panel, hvis det bliver ved.',
    'ask_how_to_pay' => 'Spørg den, der driver dette panel, hvordan du betaler. De har ikke skrevet det her endnu.',
    'order_pending' => 'Venter på, at fakturaen bliver betalt. Lige derefter oprettes serveren.',
    'order_suspended' => 'Standset på grund af en ubetalt faktura. Betaler du den, starter serveren igen - der er ikke slettet noget.',
    'order_ending' => 'Ophører :date. Den faktureres ikke igen, og alt på den slettes den dag.',
    'order_ending_open' => 'Annulleret. Den faktureres ikke igen og bliver ved med at køre, indtil den fjernes.',

    // ---- at betale -------------------------------------------------------
    'pay_with' => 'Betal med',
    'pay_now' => 'Betal',
    'pay_description' => 'Faktura :number',
    'pay_thanks' => 'Tak. Fakturaen er betalt.',
    'pay_pending' => 'Udbyderen har ikke bekræftet det endnu. Denne side opdaterer sig, så snart de gør.',
    'pay_refused' => 'Det gik ikke i gang',
    'pay_refused_body' => 'Betalingen kunne ikke åbnes. Prøv en anden vej, eller spørg den, der driver dette panel.',
    'check' => 'Afprøv betalingsnøglerne',
    'check_ok' => 'virker',
    'check_bad' => 'afviste',
    'check_good' => 'Nøglerne virker, og denne udbyder svarer.',
    'check_off' => 'Slukket, så der var ingen at spørge.',
    'check_none' => 'Ingen udbyder er slået til',
    'check_none_body' => 'Slå en til nedenfor, udfyld dens nøgler, gem, og tryk her igen.',
    'check_no_key' => 'Der er ikke udfyldt nogen nøgler til denne.',
    'check_refused' => 'Udbyderen afviste disse nøgler. Den svarede HTTP :status.',
    'check_paypal' => 'PayPal afviste disse nøgler. Den svarede HTTP :status, og dette panel er sat til :where — nøglerne skal komme fra den fane i deres dashboard.',
    'check_sandbox' => 'testmiljø',
    'check_live' => 'live',
    'check_ellipsis' => 'Client ID slutter med et punktum, hvilket betyder, at den forkortede tekst fra deres dashboard blev kopieret og ikke hele nøglen. Brug kopiknappen ved siden af, og gem igen.',
    'gateway_mollie' => 'Mollie',

    // ---- udbyderens indstillinger ----------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Tager iDEAL, kort, Bancontact og resten gennem én konto. Test og live er den samme indstilling: nøglen siger selv, hvilken konto den hører til.',
    'mollie_on' => 'Tilbyd Mollie',
    'mollie_on_helper' => 'Slukket fjerner knappen fra alle fakturaer. Det, der er betalt, bliver ved med at være betalt.',
    'mollie_key' => 'API-nøgle',
    'mollie_key_helper' => 'Fra Developers-afsnittet i dit Mollie-dashboard. Den skrives aldrig ind i en eksporteret indstillingsfil.',
    'mollie_hook' => 'Webhook-adresse',
    'mollie_hook_helper' => 'Mollie melder tilbage til :url - dit panel skal kunne nås der fra internettet.',

    'gateway_stripe' => 'Stripe',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Tager kort på en side, Stripe selv tegner, så et kortnummer aldrig når frem til dette panel. Test og live ligger i nøglens præfiks, ikke i en kontakt.',
    'stripe_on' => 'Tilbyd Stripe',
    'stripe_on_helper' => 'Slukket fjerner knappen fra alle fakturaer. Det, der er betalt, bliver ved med at være betalt.',
    'stripe_key' => 'Hemmelig nøgle',
    'stripe_key_helper' => 'Den, der begynder med sk_, fra Developers, API keys. Skrives aldrig ind i en eksporteret indstillingsfil.',
    'stripe_hook' => 'Signeringshemmelighed',
    'stripe_hook_key_helper' => 'Den whsec_-værdi, Stripe viser, når du tilføjer adressen nedenfor. Uden den kan deres beskeder ikke bevises ægte, og de ignoreres.',
    'stripe_hook_helper' => 'Tilføj :url som endpoint under Developers, webhooks, for hændelsen checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Den eneste udbyder, hvor pengene flytter sig, når kunden kommer tilbage, i stedet for mens de stadig er hos PayPal - en lukket fane efterlader altså en ubetalt faktura og ikke en forsvundet betaling.',
    'paypal_on' => 'Tilbyd PayPal',
    'paypal_on_helper' => 'Slukket fjerner knappen fra alle fakturaer. Det, der er betalt, bliver ved med at være betalt.',
    'paypal_sandbox' => 'Testmiljø',
    'paypal_sandbox_helper' => 'Taler med PayPals testkonto i stedet for den rigtige. Deres client ids ser ens ud i begge tilfælde, og det er netop derfor denne kontakt findes.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Fra den app, du lavede under Apps & Credentials. Se efter, at fanen passer til kontakten ovenfor.',
    'paypal_secret_helper' => 'Ved siden af client ID, bag Show. Skrives aldrig ind i en eksporteret indstillingsfil.',
    'paypal_hook' => 'Webhook-ID',
    'paypal_hook_id_helper' => 'Det ID, PayPal giver webhooken, når du har tilføjet den - ikke adressen. Uden det kan deres beskeder ikke tjekkes hos dem og bliver ignoreret.',
    'paypal_hook_helper' => 'Tilføj :url som webhook på den app, for PAYMENT.CAPTURE.COMPLETED, og indsæt det ID, den får, her.',

    // ---- betalingssiden --------------------------------------------------
    'pay_title' => 'Betal',
    'pay_subheading' => 'Hvad du skylder, og måderne at gøre det op på.',
    'pay_choose' => 'Hvordan vil du betale?',
    'pay_choose_body' => 'Uanset hvad du vælger, afslutter du på deres egen side og kommer lige bagefter tilbage hertil.',
    'pay_safe' => 'Du sendes til udbyderen for at betale. Dine kortoplysninger når aldrig frem til dette panel.',
    'pay_no_ways' => 'Så snart pengene kommer, markeres fakturaen betalt, og din server sættes op.',
    'free' => 'Intet at betale',
    'free_body' => 'En rabatkode dækkede hele denne her, så der er ingen betaling. Tryk på knappen, så er det klaret.',
    'free_go' => 'Afslut',
    'free_done' => 'Gjort op',
    'free_done_body' => 'Der var intet at betale, så fakturaen er lukket. Din server bliver sat op nu.',
    'pay_gone' => 'Den faktura findes ikke',
    'pay_gone_body' => 'Måske er den trukket tilbage, eller adressen er forkert.',
    'pay_already' => 'Denne er betalt',
    'pay_already_body' => 'Der er ikke mere at gøre. Alt, hvad der ventede på den, er allerede på vej.',
    'pay_withdrawn' => 'Denne blev trukket tilbage',
    'pay_withdrawn_body' => 'Den er ude af bøgerne og skal ikke betales. Spørg den, der driver dette panel, hvis det ser forkert ud.',
    'back_to_billing' => 'Tilbage til fakturering',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kort og mere',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Din PayPal-saldo, eller et kort via PayPal',

    // ---- ydelser og fakturaer, hver for sig ------------------------------
    'services_title' => 'Mine ydelser',
    'services_nav_label' => 'Mine ydelser',
    'services_subheading' => 'Det, du betaler for, og den server, hver enkelt blev til.',
    'open_server' => 'Åbn serveren',
    'no_server_yet' => 'Bliver sat op',

    'invoices_title' => 'Fakturaer',
    'invoices_subheading' => 'Hvad du er blevet faktureret, og hvad der står tilbage at betale.',
    'no_invoices_body' => 'Alt, hvad du køber, faktureres her og bliver stående her, efter det er betalt.',

    // ---- butikken som forside --------------------------------------------
    'section_landing' => 'Hvor butikken sidder',
    'section_landing_helper' => 'Om butikken er panelets hoveddør, både for kunder og for dem, der ikke er logget ind.',
    'landing' => 'Åbn butikken først',
    'landing_helper' => 'Tændt er butikken den første side efter login, og serverlisten rykker ved siden af. Dine ydelser og dine fakturaer er stadig ét klik væk, i butikkens hoved og i kontomenuen. Den, der ikke er logget ind, får den offentlige butik i stedet for login-formularen og bliver først bedt om at logge ind, når vedkommende vælger en pakke - så det kræver, at den offentlige butiksside også er slået til. Slukket åbner panelet på serverlisten, sådan som Pelican tegner den, mens den, der ikke er logget ind, får login-formularen, og butikken er en side som alle andre.',
    'self_cancel' => 'Lad kunderne afslutte deres egen ydelse',
    'self_cancel_helper' => 'To veje ud på deres side med ydelser: afslut på aftalens dato, hvilket stopper faktureringen og sletter serveren den dag, kunden har fået at vide, eller stop nu, hvilket sletter den med det samme. Det er de samme knapper, som du har på ordresiden. Slukket bliver ingen af delene tilbudt, og at afslutte en ydelse er noget, de skal bede dig om.',
];
