<?php

/*
 * Română. Scris de mână.
 *
 * Setările magazinului, iar mai târziu magazinul însuși.
 *
 * Doi cititori împart acest fișier intenționat. Jumătatea cu setări este
 * citită de administrator; jumătățile publică și a clientului - adăugate pe
 * măsură ce magazinul crește - sunt citite de oameni care poate n-au auzit
 * niciodată de Pelican, și fiecare frază de acolo trebuie scrisă pentru ei.
 */

return [
    'title' => 'Setările magazinului',
    'nav_label' => 'Setările magazinului',
    'subheading' => 'Moneda, taxa, cum sunt numerotate facturile și ce spune pagina publică. Ce este de vânzare stă pe pagina Pachete.',

    // ---- unde este -------------------------------------------------------
    'address' => 'Magazinul public este la',
    'address_off' => 'Pagina publică este oprită. Pornește „Pagina publică a magazinului" din lista de funcții de pe pagina Setări Essentials și va răspunde la :url.',

    // ---- general ---------------------------------------------------------
    'section_general' => 'Bani',
    'section_general_helper' => 'O singură monedă pentru tot magazinul. Fiecare preț al fiecărui pachet este un număr în ea.',
    'currency' => 'Monedă',
    'currency_helper' => 'Schimbarea nu convertește nimic: prețurile de pe pachete sunt numere, iar după o schimbare sunt numere în noua monedă.',
    'tax' => 'Taxă',
    'tax_helper' => 'Un procent adăugat pe fiecare factură ca rând separat. Prețurile de pe pachete sunt fără taxă. Zero pentru niciuna.',
    'tax_suffix' => '%',
    'prefix' => 'Numerele facturilor încep cu',
    'prefix_helper' => 'Urmat de un număr care crește. INV- dă INV-000001.',

    // ---- reînnoiri -------------------------------------------------------
    'section_renewals' => 'Reînnoiri',
    'section_renewals_helper' => 'Pentru pachetele facturate lunar, trimestrial sau anual. Un pachet plătit o singură dată nu este niciodată atins de asta.',
    'notice_days' => 'Facturează cu atâtea zile înainte de sfârșitul perioadei',
    'notice_days_helper' => 'Când se creează următoarea factură și clientul este anunțat.',
    'grace' => 'Suspendă la atâtea zile după scadența unei facturi',
    'grace_helper' => 'O factură neplătită dincolo de acest termen suspendă serverul — suspendarea proprie a lui Pelican, ridicată în clipa în care factura este plătită. Suspendarea în sine nu șterge nimic.',
    'days' => 'zile',

    // ---- pagina publică --------------------------------------------------
    'section_public' => 'Pagina publică',
    'section_public_helper' => 'Citită de oameni fără cont. Dacă este servită deloc decide comutatorul „Pagina publică a magazinului" din lista de funcții.',
    'heading' => 'Titlu',
    'heading_helper' => 'Lăsat gol, se folosește numele panoului.',
    'note' => 'Un rând deasupra pachetelor',
    'note_helper' => 'Ca să spui cine ești sau ce primește cineva cumpărând. Text simplu.',
    'terms_url' => 'Termeni',
    'terms_url_helper' => 'O adresă https. Dacă este setată, cumpărarea înseamnă bifarea unei căsuțe care trimite la ea.',

    // ---- plata manuală ---------------------------------------------------
    'section_manual' => 'Plată fără furnizor',
    'section_manual_helper' => 'Afișat pe o factură neplătită cât timp niciun furnizor de plăți nu este pornit: date bancare sau unde se trimit banii. Text simplu.',
    'pay_note' => 'Cum se plătește',
    'pay_note_helper' => 'Lasă gol și o factură neplătită spune doar că este neplătită.',

    // ---- butoanele -------------------------------------------------------
    'save' => 'Salvează',
    'saved' => 'Salvat',
    'save_failed' => 'Nu s-a salvat nimic',

    /* ---------------------------------------------------------------------
     * Magazinul propriu-zis, de aici în jos.
     *
     * Un cititor cu totul diferit: cineva care cumpără un server, care poate nu
     * a auzit niciodată de Pelican și nu știe ce este un egg. Nimic de mai jos
     * nu folosește cuvintele panoului, iar fiecare frază răspunde la întrebarea
     * pe care clientul chiar o are în acel punct al paginii.
     * ------------------------------------------------------------------- */

    // ---- magazinul -------------------------------------------------------
    'store_title' => 'Magazin',
    'store_nav_label' => 'Magazin',
    'store_subheading' => 'Alege un server. Se creează pentru tine de îndată ce factura e plătită.',
    'store_empty' => 'Momentan nu e nimic de vânzare',
    'store_empty_body' => 'Revino mai târziu, sau întreabă-l pe cel care ține panoul acesta.',

    'buy' => 'Cumpără',
    'sold_out' => 'Epuizat',
    'plus_setup' => 'plus :amount o singură dată',

    'spec_memory' => ':amount MiB memorie',
    'spec_disk' => ':amount MiB disc',
    'spec_cpu' => ':amount% CPU',
    'spec_backups' => ':count copii de siguranță',
    'spec_databases' => ':count baze de date',

    // ---- pagina publică --------------------------------------------------
    'public_empty' => 'Momentan nu e nimic de vânzare',
    'public_empty_body' => 'Revino mai târziu.',
    'to_panel' => 'Autentifică-te',
    'terms' => 'Termeni',
    'sign_in_note' => 'Alege un server mai jos. Te autentifici ca să termini, iar el se creează când factura e plătită.',

    // ---- comanda ---------------------------------------------------------
    'checkout_title' => 'Comandă',
    'tax_line' => 'TVA (:rate%)',
    'coupon' => 'Cod de reducere',
    'coupon_placeholder' => 'Dacă ai unul',
    'coupon_bad' => 'Codul acela nu e valabil aici.',
    'coupon_good' => 'Cod aplicat.',
    'agree' => 'Sunt de acord cu',
    'place_order' => 'Plasează comanda',
    'place_order_note' => 'Asta scrie o factură. Nu se ia nimic până nu plătești, iar serverul se creează când factura e plătită.',
    'back_to_store' => 'Înapoi la magazin',

    'placed' => 'Comandă plasată',
    'placed_body' => 'Factura :number te așteaptă pe pagina ta de facturare.',

    'refused' => 'Asta nu a putut fi cumpărată',
    'refused_gone' => 'Nu mai e de vânzare.',
    'refused_sold_out' => 'Ultimul s-a dus.',
    'refused_bad_coupon' => 'Codul de reducere nu e valabil pentru asta.',
    'refused_failed' => 'Ceva n-a mers la scrierea comenzii. Nu s-a luat nimic. Încearcă din nou și spune-i celui care ține panoul dacă se repetă.',

    // ---- facturare -------------------------------------------------------
    'billing_title' => 'Facturare',
    'billing_nav_label' => 'Facturare',
    'billing_subheading' => 'Ce ai cumpărat și ce datorezi.',
    'your_orders' => 'Comenzile tale',
    'your_invoices' => 'Facturile tale',
    'no_orders' => 'Nu ai cumpărat încă nimic',
    'no_orders_body' => 'Tot ce cumperi apare aici cu serverul și datele lui.',
    'no_invoices' => 'Încă nu există facturi',
    'to_store' => 'Mergi la magazin',
    'renews' => 'Se reînnoiește',
    'ask_how_to_pay' => 'Întreabă-l pe cel care ține panoul acesta cum se plătește. Încă nu a scris-o aici.',
    'order_pending' => 'Așteaptă plata facturii. Imediat după aceea se creează serverul.',
    'order_suspended' => 'Oprit din cauza unei facturi neplătite. Plata ei pornește serverul din nou - nu s-a șters nimic.',
    'order_ending' => 'Se încheie pe :date. Nu se mai facturează, iar tot ce este pe el se șterge în ziua aceea.',
    'order_ending_open' => 'Anulat. Nu se mai facturează și merge mai departe până când este scos.',

    // ---- plata -----------------------------------------------------------
    'pay_with' => 'Plătește cu',
    'pay_now' => 'Plătește',
    'pay_description' => 'Factura :number',
    'pay_thanks' => 'Mulțumim. Factura este plătită.',
    'pay_pending' => 'Procesatorul nu a confirmat încă. Pagina se actualizează imediat ce o face.',
    'pay_refused' => 'Asta nu a pornit',
    'pay_refused_body' => 'Plata nu a putut fi deschisă. Încearcă altfel, sau întreabă-l pe cel care ține panoul acesta.',
    'gateway_mollie' => 'Mollie',

    // ---- setările procesatorului -----------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Acceptă iDEAL, carduri, Bancontact și restul printr-un singur cont. Testul și producția sunt aceeași setare: cheia însăși spune cărui cont îi aparține.',
    'mollie_on' => 'Oferă Mollie',
    'mollie_on_helper' => 'Oprit scoate butonul de pe toate facturile. Ce e deja plătit rămâne plătit.',
    'mollie_key' => 'Cheie API',
    'mollie_key_helper' => 'Din secțiunea Developers a panoului tău Mollie. Nu se scrie niciodată într-un fișier de setări exportat.',
    'mollie_hook' => 'Adresa webhookului',
    'mollie_hook_helper' => 'Mollie va anunța la :url - panoul tău trebuie să fie accesibil acolo de pe internet.',

    'gateway_stripe' => 'Card',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Acceptă carduri pe o pagină desenată chiar de Stripe, așa că niciun număr de card nu ajunge vreodată la panoul acesta. Testul și producția stau în prefixul cheii, nu într-un comutator.',
    'stripe_on' => 'Oferă Stripe',
    'stripe_on_helper' => 'Oprit scoate butonul de pe toate facturile. Ce e deja plătit rămâne plătit.',
    'stripe_key' => 'Cheie secretă',
    'stripe_key_helper' => 'Cea care începe cu sk_, din Developers, API keys. Nu se scrie niciodată într-un fișier de setări exportat.',
    'stripe_hook' => 'Secret de semnătură',
    'stripe_hook_key_helper' => 'Valoarea whsec_ pe care Stripe o arată când adaugi adresa de mai jos. Fără ea, mesajele lor nu pot fi dovedite autentice și sunt ignorate.',
    'stripe_hook_helper' => 'Adaugă :url ca endpoint în Developers, webhooks, pentru evenimentul checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Singurul procesator la care banii se mișcă la întoarcerea clientului, nu cât timp e încă la PayPal - o filă închisă lasă deci o factură neplătită, nu o plată pierdută.',
    'paypal_on' => 'Oferă PayPal',
    'paypal_on_helper' => 'Oprit scoate butonul de pe toate facturile. Ce e deja plătit rămâne plătit.',
    'paypal_sandbox' => 'Mediu de test',
    'paypal_sandbox_helper' => 'Vorbește cu contul de test al PayPal în loc de cel adevărat. Client id-urile lor arată la fel în ambele cazuri, și tocmai de aceea există comutatorul ăsta.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Din aplicația pe care ai făcut-o în Apps & Credentials. Vezi ca fila să corespundă comutatorului de mai sus.',
    'paypal_secret_helper' => 'Lângă client ID, în spatele lui Show. Nu se scrie niciodată într-un fișier de setări exportat.',
    'paypal_hook' => 'ID-ul webhookului',
    'paypal_hook_id_helper' => 'ID-ul pe care PayPal îl dă webhookului după ce îl adaugi, nu adresa. Fără el mesajele lor nu pot fi verificate la ei și sunt ignorate.',
    'paypal_hook_helper' => 'Adaugă :url ca webhook în acea aplicație, pentru PAYMENT.CAPTURE.COMPLETED, apoi lipește aici ID-ul primit.',

    // ---- pagina de plată -------------------------------------------------
    'pay_title' => 'Plătește',
    'pay_subheading' => 'Ce datorezi și în ce feluri poți achita.',
    'pay_choose' => 'Cum vrei să plătești?',
    'pay_choose_body' => 'Orice ai alege, termini pe pagina lor și te întorci aici imediat după.',
    'pay_safe' => 'Pentru plată ești trimis la procesator. Datele cardului tău nu ajung niciodată la panoul acesta.',
    'pay_no_ways' => 'Imediat ce banii ajung, factura devine plătită și serverul tău este pregătit.',
    'pay_gone' => 'Nu există factura asta',
    'pay_gone_body' => 'Poate a fost retrasă, sau adresa e greșită.',
    'pay_already' => 'Asta e plătită',
    'pay_already_body' => 'Nu mai e nimic de făcut. Tot ce o aștepta e deja pe drum.',
    'pay_withdrawn' => 'Asta a fost retrasă',
    'pay_withdrawn_body' => 'E scoasă din registre și nu trebuie plătită. Dacă ți se pare ciudat, întreabă-l pe cel care ține panoul.',
    'back_to_billing' => 'Înapoi la facturare',

    'gateway_mollie_note' => 'iDEAL, Bancontact, card și altele',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Soldul tău PayPal, sau un card prin PayPal',

    // ---- servicii și facturi, separat ------------------------------------
    'services_title' => 'Serviciile mele',
    'services_nav_label' => 'Serviciile mele',
    'services_subheading' => 'Pentru ce plătești, și serverul în care s-a transformat fiecare.',
    'open_server' => 'Deschide serverul',
    'no_server_yet' => 'Se pregătește',

    'invoices_title' => 'Facturi',
    'invoices_subheading' => 'Ce ți s-a facturat și ce mai e de plată.',
    'no_invoices_body' => 'Tot ce cumperi se facturează aici și rămâne aici și după ce e plătit.',

    // ---- magazinul ca pagină de start ------------------------------------
    'section_landing' => 'Unde stă magazinul',
    'section_landing_helper' => 'Dacă cel care se autentifică ajunge pe magazin sau pe serverele lui.',
    'landing' => 'Deschide întâi magazinul',
    'landing_helper' => 'Pornit, magazinul e prima pagină după autentificare, iar lista de servere se mută alături. Serviciile și facturile tale rămân la un clic, în antetul magazinului și în meniul contului. Oprit, nu se mută nimic, iar magazinul e o pagină ca oricare alta.',
];
