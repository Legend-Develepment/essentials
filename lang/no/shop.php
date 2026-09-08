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

    /* ---------------------------------------------------------------------
     * Selve butikken, herfra og ned.
     *
     * En helt annen leser: noen som kjøper en server, som kanskje aldri har
     * hørt om Pelican og ikke vet hva en egg er. Ingenting her nede bruker
     * panelets ord, og hver setning svarer på det spørsmålet en kunde faktisk
     * har på det stedet på siden.
     * ------------------------------------------------------------------- */

    // ---- butikken --------------------------------------------------------
    'store_title' => 'Butikk',
    'store_nav_label' => 'Butikk',
    'store_subheading' => 'Velg en server. Den blir opprettet for deg så snart fakturaen er betalt.',
    'store_empty' => 'Ingenting er til salgs akkurat nå',
    'store_empty_body' => 'Kom tilbake senere, eller spør den som driver dette panelet.',

    'buy' => 'Kjøp',
    'sold_out' => 'Utsolgt',
    'plus_setup' => 'pluss :amount én gang',

    'spec_memory' => ':amount MiB minne',
    'spec_disk' => ':amount MiB disk',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count sikkerhetskopier',
    'spec_databases' => ':count databaser',

    // ---- den offentlige siden --------------------------------------------
    'public_empty' => 'Ingenting er til salgs akkurat nå',
    'public_empty_body' => 'Kom tilbake senere.',
    'to_panel' => 'Logg inn',
    'terms' => 'Vilkår',
    'sign_in_note' => 'Velg en server nedenfor. Du logger inn for å fullføre, og den blir opprettet når fakturaen er betalt.',

    // ---- bestillingen ----------------------------------------------------
    'checkout_title' => 'Bestilling',
    'tax_line' => 'Mva. (:rate%)',
    'coupon' => 'Rabattkode',
    'coupon_placeholder' => 'Hvis du har en',
    'coupon_bad' => 'Den koden virker ikke her.',
    'coupon_good' => 'Koden er brukt.',
    'agree' => 'Jeg godtar',
    'place_order' => 'Legg inn bestillingen',
    'place_order_note' => 'Dette skriver en faktura. Ingenting trekkes før du betaler, og serveren opprettes når den er betalt.',
    'back_to_store' => 'Tilbake til butikken',

    'placed' => 'Bestillingen er lagt inn',
    'placed_body' => 'Faktura :number venter på faktureringssiden din.',

    'refused' => 'Dette kunne ikke kjøpes',
    'refused_gone' => 'Det er ikke til salgs lenger.',
    'refused_sold_out' => 'Den siste er borte.',
    'refused_bad_coupon' => 'Rabattkoden gjelder ikke for dette.',
    'refused_failed' => 'Noe gikk galt da bestillingen skulle skrives. Ingenting er trukket. Prøv igjen, og si fra til den som driver dette panelet hvis det fortsetter.',

    // ---- fakturering -----------------------------------------------------
    'billing_title' => 'Fakturering',
    'billing_nav_label' => 'Fakturering',
    'billing_subheading' => 'Hva du har kjøpt, og hva du skylder.',
    'your_orders' => 'Bestillingene dine',
    'your_invoices' => 'Fakturaene dine',
    'no_orders' => 'Du har ikke kjøpt noe ennå',
    'no_orders_body' => 'Alt du kjøper, står her med serveren og datoene sine.',
    'no_invoices' => 'Ingen fakturaer ennå',
    'to_store' => 'Gå til butikken',
    'renews' => 'Fornyes',
    'ask_how_to_pay' => 'Spør den som driver dette panelet hvordan du betaler. De har ikke skrevet det her ennå.',
    'order_pending' => 'Venter på at fakturaen blir betalt. Rett etterpå opprettes serveren.',
    'order_suspended' => 'Stoppet på grunn av en ubetalt faktura. Betaler du den, starter serveren igjen - ingenting er slettet.',

    // ---- å betale --------------------------------------------------------
    'pay_with' => 'Betal med',
    'pay_now' => 'Betal',
    'pay_description' => 'Faktura :number',
    'pay_thanks' => 'Takk. Fakturaen er betalt.',
    'pay_pending' => 'Leverandøren har ikke bekreftet det ennå. Denne siden oppdaterer seg så snart de gjør det.',
    'pay_refused' => 'Det startet ikke',
    'pay_refused_body' => 'Betalingen lot seg ikke åpne. Prøv en annen vei, eller spør den som driver dette panelet.',
    'gateway_mollie' => 'Mollie',

    // ---- leverandørens innstillinger -------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Tar iDEAL, kort, Bancontact og resten gjennom én konto. Test og live er den samme innstillingen: nøkkelen sier selv hvilken konto den hører til.',
    'mollie_on' => 'Tilby Mollie',
    'mollie_on_helper' => 'Av fjerner knappen fra hver faktura. Det som er betalt, blir værende betalt.',
    'mollie_key' => 'API-nøkkel',
    'mollie_key_helper' => 'Fra Developers-delen i Mollie-panelet ditt. Den skrives aldri inn i en eksportert innstillingsfil.',
    'mollie_hook' => 'Webhook-adresse',
    'mollie_hook_helper' => 'Mollie melder fra til :url - panelet ditt må kunne nås der fra internett.',

    'gateway_stripe' => 'Kort',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Tar kort på en side Stripe selv tegner, så et kortnummer aldri når fram til dette panelet. Test og live ligger i nøkkelens prefiks, ikke i en bryter.',
    'stripe_on' => 'Tilby Stripe',
    'stripe_on_helper' => 'Av fjerner knappen fra hver faktura. Det som er betalt, blir værende betalt.',
    'stripe_key' => 'Hemmelig nøkkel',
    'stripe_key_helper' => 'Den som begynner med sk_, fra Developers, API keys. Skrives aldri inn i en eksportert innstillingsfil.',
    'stripe_hook' => 'Signeringshemmelighet',
    'stripe_hook_key_helper' => 'whsec_-verdien Stripe viser når du legger til adressen nedenfor. Uten den kan meldingene deres ikke bevises ekte, og de blir ignorert.',
    'stripe_hook_helper' => 'Legg til :url som endepunkt under Developers, webhooks, for hendelsen checkout.session.completed.',
];
