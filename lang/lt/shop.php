<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Parduotuvės nustatymai, o vėliau ir pati parduotuvė.
 *
 * Du skaitytojai šį failą dalijasi sąmoningai. Pusę su nustatymais skaito
 * administratorius; viešąją ir kliento pusę - pridedamą parduotuvei augant -
 * skaito žmonės, kurie galbūt niekada nėra girdėję apie Pelican, ir kiekvienas
 * sakinys ten turi būti parašytas jiems.
 */

return [
    'title' => 'Parduotuvės nustatymai',
    'nav_label' => 'Parduotuvės nustatymai',
    'subheading' => 'Valiuta, mokestis, sąskaitų numeravimas ir tai, ką sako viešasis puslapis. Tai, kas parduodama, yra Paketų puslapyje.',

    // ---- kur ji yra ------------------------------------------------------
    'address' => 'Viešoji parduotuvė yra',
    'address_off' => 'Viešasis puslapis išjungtas. Įjunkite „Viešasis parduotuvės puslapis" funkcijų sąraše Essentials nustatymų puslapyje, ir jis atsakys adresu :url.',

    // ---- bendra ----------------------------------------------------------
    'section_general' => 'Pinigai',
    'section_general_helper' => 'Viena valiuta visai parduotuvei. Kiekviena kiekvieno paketo kaina yra skaičius joje.',
    'currency' => 'Valiuta',
    'currency_helper' => 'Pakeitimas nieko neperskaičiuoja: paketų kainos yra skaičiai, ir po pakeitimo jos yra skaičiai naująja valiuta.',
    'tax' => 'Mokestis',
    'tax_helper' => 'Procentas, pridedamas prie kiekvienos sąskaitos atskira eilute. Paketų kainos yra be mokesčio. Nulis reiškia jokio.',
    'tax_suffix' => '%',
    'prefix' => 'Sąskaitų numeriai prasideda',
    'prefix_helper' => 'Toliau eina didėjantis numeris. INV- duoda INV-000001.',

    // ---- pratęsimai ------------------------------------------------------
    'section_renewals' => 'Pratęsimai',
    'section_renewals_helper' => 'Paketams, už kuriuos sąskaita išrašoma kas mėnesį, kas ketvirtį arba kas metus. Vienkartinio paketo tai niekada neliečia.',
    'notice_days' => 'Išrašyti sąskaitą tiek dienų iki laikotarpio pabaigos',
    'notice_days_helper' => 'Kada sukuriama kita sąskaita ir pirkėjui pranešama.',
    'grace' => 'Sustabdyti praėjus tiek dienų po sąskaitos termino',
    'grace_helper' => 'Neapmokėta sąskaita, peržengusi šią ribą, sustabdo serverį — paties Pelican sustabdymu, kuris panaikinamas tą akimirką, kai sąskaita apmokama. Parduotuvė niekada nieko netrina.',
    'days' => 'dienų',

    // ---- viešasis puslapis -----------------------------------------------
    'section_public' => 'Viešasis puslapis',
    'section_public_helper' => 'Jį skaito žmonės be paskyros. Ar jis apskritai rodomas, sprendžia jungiklis „Viešasis parduotuvės puslapis" funkcijų sąraše.',
    'heading' => 'Antraštė',
    'heading_helper' => 'Palikus tuščią, naudojamas paties skydelio pavadinimas.',
    'note' => 'Eilutė virš paketų',
    'note_helper' => 'Kad pasakytumėte, kas esate arba ką duoda pirkinys. Paprastas tekstas.',
    'terms_url' => 'Sąlygos',
    'terms_url_helper' => 'https adresas. Jei nustatytas, pirkimas reiškia langelio, rodančio į jį, pažymėjimą.',

    // ---- mokėjimas ranka -------------------------------------------------
    'section_manual' => 'Mokėjimas be tiekėjo',
    'section_manual_helper' => 'Rodoma neapmokėtoje sąskaitoje, kol neįjungtas nė vienas mokėjimų tiekėjas: banko duomenys arba kur siųsti pinigus. Paprastas tekstas.',
    'pay_note' => 'Kaip mokėti',
    'pay_note_helper' => 'Palikite tuščią, ir neapmokėta sąskaita tik pasako, kad ji neapmokėta.',

    // ---- mygtukai --------------------------------------------------------
    'save' => 'Išsaugoti',
    'saved' => 'Išsaugota',
    'save_failed' => 'Niekas nebuvo išsaugota',

    /* ---------------------------------------------------------------------
     * Pati parduotuvė, nuo čia žemyn.
     *
     * Visai kitas skaitytojas: tas, kuris perka serverį, kuris galbūt niekada
     * nėra girdėjęs apie Pelican ir nežino, kas yra egg. Niekas žemiau
     * nenaudoja skydelio žodžių, ir kiekvienas sakinys atsako į klausimą, kurį
     * klientas toje puslapio vietoje iš tikrųjų turi.
     * ------------------------------------------------------------------- */

    // ---- parduotuvė ------------------------------------------------------
    'store_title' => 'Parduotuvė',
    'store_nav_label' => 'Parduotuvė',
    'store_subheading' => 'Pasirinkite serverį. Jis bus sukurtas jums vos tik sąskaita bus apmokėta.',
    'store_empty' => 'Šiuo metu nieko neparduodama',
    'store_empty_body' => 'Užsukite vėliau arba paklauskite to, kas prižiūri šį skydelį.',

    'buy' => 'Pirkti',
    'sold_out' => 'Išparduota',
    'plus_setup' => 'plius :amount vieną kartą',

    'spec_memory' => 'Atmintis: :amount MiB',
    'spec_disk' => 'Diskas: :amount MiB',
    'spec_cpu' => 'CPU: :amount%',
    'spec_backups' => 'Atsarginių kopijų: :count',
    'spec_databases' => 'Duomenų bazių: :count',

    // ---- viešasis puslapis -----------------------------------------------
    'public_empty' => 'Šiuo metu nieko neparduodama',
    'public_empty_body' => 'Užsukite vėliau.',
    'to_panel' => 'Prisijungti',
    'terms' => 'Sąlygos',
    'sign_in_note' => 'Pasirinkite serverį žemiau. Užbaigti prisijungsite, o jis bus sukurtas, kai sąskaita bus apmokėta.',

    // ---- užsakymas -------------------------------------------------------
    'checkout_title' => 'Užsakymas',
    'tax_line' => 'PVM (:rate%)',
    'coupon' => 'Nuolaidos kodas',
    'coupon_placeholder' => 'Jei turite',
    'coupon_bad' => 'Tas kodas čia negalioja.',
    'coupon_good' => 'Kodas pritaikytas.',
    'agree' => 'Sutinku su',
    'place_order' => 'Pateikti užsakymą',
    'place_order_note' => 'Tai išrašo sąskaitą. Niekas nenuskaitoma, kol neapmokate, o serveris sukuriamas, kai ji apmokėta.',
    'back_to_store' => 'Atgal į parduotuvę',

    'placed' => 'Užsakymas pateiktas',
    'placed_body' => 'Sąskaita :number laukia jūsų atsiskaitymų puslapyje.',

    'refused' => 'To nupirkti nepavyko',
    'refused_gone' => 'Tai nebeparduodama.',
    'refused_sold_out' => 'Paskutinis jau išpirktas.',
    'refused_bad_coupon' => 'Nuolaidos kodas šiam dalykui negalioja.',
    'refused_failed' => 'Rašant užsakymą kažkas nepavyko. Niekas nebuvo nuskaityta. Pabandykite dar kartą ir pasakykite tam, kas prižiūri šį skydelį, jei tai kartojasi.',

    // ---- atsiskaitymai ---------------------------------------------------
    'billing_title' => 'Atsiskaitymai',
    'billing_nav_label' => 'Atsiskaitymai',
    'billing_subheading' => 'Ką nusipirkote ir ką esate skolingi.',
    'your_orders' => 'Jūsų užsakymai',
    'your_invoices' => 'Jūsų sąskaitos',
    'no_orders' => 'Kol kas nieko nenusipirkote',
    'no_orders_body' => 'Viskas, ką nusipirksite, atsiras čia su savo serveriu ir datomis.',
    'no_invoices' => 'Sąskaitų kol kas nėra',
    'to_store' => 'Į parduotuvę',
    'renews' => 'Atsinaujina',
    'ask_how_to_pay' => 'Paklauskite to, kas prižiūri šį skydelį, kaip apmokėti. Jis to čia dar neužrašė.',
    'order_pending' => 'Laukia, kol sąskaita bus apmokėta. Iškart po to serveris sukuriamas.',
    'order_suspended' => 'Sustabdyta dėl neapmokėtos sąskaitos. Apmokėjus serveris paleidžiamas iš naujo - niekas nebuvo ištrinta.',
];
