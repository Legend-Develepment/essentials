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

    // ---- mokėjimas -------------------------------------------------------
    'pay_with' => 'Mokėti per',
    'pay_now' => 'Mokėti',
    'pay_description' => 'Sąskaita :number',
    'pay_thanks' => 'Ačiū. Sąskaita apmokėta.',
    'pay_pending' => 'Tiekėjas to dar nepatvirtino. Šis puslapis atsinaujins, kai tik jis tai padarys.',
    'pay_refused' => 'Tai neprasidėjo',
    'pay_refused_body' => 'Mokėjimo nepavyko atidaryti. Pabandykite kitaip arba paklauskite to, kas prižiūri šį skydelį.',
    'gateway_mollie' => 'Mollie',

    // ---- tiekėjo nustatymai ----------------------------------------------
    'section_mollie' => 'Mollie',
    'section_mollie_helper' => 'Priima iDEAL, korteles, Bancontact ir visa kita per vieną paskyrą. Bandymas ir tikras režimas yra tas pats nustatymas: pats raktas pasako, kuriai paskyrai priklauso.',
    'mollie_on' => 'Siūlyti Mollie',
    'mollie_on_helper' => 'Išjungta nuima mygtuką nuo kiekvienos sąskaitos. Kas jau apmokėta, lieka apmokėta.',
    'mollie_key' => 'API raktas',
    'mollie_key_helper' => 'Iš savo Mollie skydelio Developers skilties. Jis niekada nerašomas į eksportuotą nustatymų failą.',
    'mollie_hook' => 'Webhook adresas',
    'mollie_hook_helper' => 'Mollie praneš adresu :url - jūsų skydelis ten turi būti pasiekiamas iš interneto.',

    'gateway_stripe' => 'Kortelė',

    'section_stripe' => 'Stripe',
    'section_stripe_helper' => 'Priima korteles puslapyje, kurį piešia pati Stripe, todėl kortelės numeris niekada nepasiekia šio skydelio. Bandymas ir tikras režimas glūdi rakto priešdėlyje, o ne jungiklyje.',
    'stripe_on' => 'Siūlyti Stripe',
    'stripe_on_helper' => 'Išjungta nuima mygtuką nuo kiekvienos sąskaitos. Kas jau apmokėta, lieka apmokėta.',
    'stripe_key' => 'Slaptas raktas',
    'stripe_key_helper' => 'Tas, kuris prasideda sk_, iš Developers, API keys. Jis niekada nerašomas į eksportuotą nustatymų failą.',
    'stripe_hook' => 'Parašo paslaptis',
    'stripe_hook_key_helper' => 'Ta whsec_ reikšmė, kurią Stripe parodo pridėjus žemiau esantį adresą. Be jos jų žinučių negalima įrodyti tikromis, ir jos ignoruojamos.',
    'stripe_hook_helper' => 'Pridėkite :url kaip endpoint skiltyje Developers, webhooks, įvykiui checkout.session.completed.',

    'gateway_paypal' => 'PayPal',

    'section_paypal' => 'PayPal',
    'section_paypal_helper' => 'Vienintelis tiekėjas, kuriam pinigai pajuda klientui grįžus, o ne kol jis dar yra PayPal puslapyje - uždaryta kortelė palieka neapmokėtą sąskaitą, o ne dingusį mokėjimą.',
    'paypal_on' => 'Siūlyti PayPal',
    'paypal_on_helper' => 'Išjungta nuima mygtuką nuo kiekvienos sąskaitos. Kas jau apmokėta, lieka apmokėta.',
    'paypal_sandbox' => 'Bandymų aplinka',
    'paypal_sandbox_helper' => 'Kalba su PayPal bandymų paskyra, o ne su tikrąja. Jų client id abiem atvejais atrodo vienodai, ir būtent todėl šis jungiklis egzistuoja.',
    'paypal_id' => 'Client ID',
    'paypal_secret' => 'Secret',
    'paypal_id_helper' => 'Iš programėlės, kurią sukūrėte skiltyje Apps & Credentials. Patikrinkite, ar kortelė atitinka jungiklį viršuje.',
    'paypal_secret_helper' => 'Šalia client ID, už mygtuko Show. Niekada nerašomas į eksportuotą nustatymų failą.',
    'paypal_hook' => 'Webhook ID',
    'paypal_hook_id_helper' => 'ID, kurį PayPal suteikia webhookui jį pridėjus, o ne adresas. Be jo jų žinučių pas juos patikrinti negalima, ir jos ignoruojamos.',
    'paypal_hook_helper' => 'Pridėkite :url kaip webhook toje programėlėje, įvykiui PAYMENT.CAPTURE.COMPLETED, ir įklijuokite čia gautą ID.',

    // ---- mokėjimo puslapis -----------------------------------------------
    'pay_title' => 'Mokėti',
    'pay_subheading' => 'Kiek esate skolingi ir kokiais būdais tai galima padengti.',
    'pay_choose' => 'Kaip norite sumokėti?',
    'pay_choose_body' => 'Ką bepasirinktumėte, užbaigsite jų pačių puslapyje ir iškart po to grįšite čia.',
    'pay_safe' => 'Mokėti jus nusiunčiame pas tiekėją. Jūsų kortelės duomenys niekada nepasiekia šio skydelio.',
    'pay_no_ways' => 'Vos pinigai atkeliaus, sąskaita pažymima apmokėta, o jūsų serveris paruošiamas.',
    'pay_gone' => 'Tokios sąskaitos nėra',
    'pay_gone_body' => 'Galbūt ji atšaukta arba adresas neteisingas.',
    'pay_already' => 'Ši jau apmokėta',
    'pay_already_body' => 'Daugiau nieko nereikia. Viskas, kas jos laukė, jau pakeliui.',
    'pay_withdrawn' => 'Ši buvo atšaukta',
    'pay_withdrawn_body' => 'Ji išimta iš apskaitos ir jos mokėti nereikia. Jei tai atrodo keistai, paklauskite to, kas prižiūri šį skydelį.',
    'back_to_billing' => 'Atgal į atsiskaitymus',

    'gateway_mollie_note' => 'iDEAL, Bancontact, kortelė ir kita',
    'gateway_stripe_note' => 'Visa, Mastercard, American Express',
    'gateway_paypal_note' => 'Jūsų PayPal likutis arba kortelė per PayPal',
];
