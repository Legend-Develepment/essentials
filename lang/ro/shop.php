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
    'grace_helper' => 'O factură neplătită dincolo de acest termen suspendă serverul — suspendarea proprie a lui Pelican, ridicată în clipa în care factura este plătită. Magazinul nu șterge niciodată nimic.',
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
];
