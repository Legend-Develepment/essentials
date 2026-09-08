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
];
