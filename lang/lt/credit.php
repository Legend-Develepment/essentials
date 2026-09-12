<?php

/*
 * Lietuvių. Parašyta ranka.
 *
 * Kreditas, pinigų grąžinimai ir kreditinės sąskaitos.
 *
 * Du žodžiai žemiau visur sąmoningai laikomi atskirai.
 *
 * „Kreditas“ yra pinigai, kuriuos parduotuvė kam nors laiko. Jie patys nusiima
 * nuo kitos jo sąskaitos dar prieš paprašant sumokėti.
 *
 * „Grąžinimas“ yra pats pinigų atidavimas, ir jis turi dvi kryptis: atgal į tą
 * kortelę, iš kurios atėjo, arba į paskyrą kaip kreditas. Tekstas visada
 * pasako, kuri iš jų, nes klientas, kuriam pasakyta „pinigai grąžinti“ ir kuris
 * paskui banke nieko neranda, parašo - ir teisingai daro.
 *
 * „Kreditinė sąskaita“ yra dokumentas. Ji rašoma abiem atvejais, nes tai
 * įrašas, kad pinigai parduotuvei nebepriklauso - o ne teiginys apie tai, kur
 * jie nukeliavo.
 */

return [
    // ---- ką mato klientas ------------------------------------------------
    'yours' => 'Jūsų kreditas',
    'yours_body' => 'Jis pats nusiima nuo kitos jūsų sąskaitos. Jums su juo nieko daryti nereikia.',
    'applied' => 'Apmokėta iš jūsų kredito',
    'payable' => 'Liko sumokėti',

    // ---- didžioji knyga kliento lange ------------------------------------
    'held' => 'Kreditas',
    'none_held' => 'Paskyroje nieko',
    'movements' => 'Kreditas',
    'column' => 'Kreditas',
    'none' => 'Nėra',

    // ---- kaip jo duodama -------------------------------------------------
    'give' => 'Kreditas',
    'give_helper' => 'Šioje paskyroje yra :held. Tai, ką į ją įrašysite, pats nusiims nuo kitos jo sąskaitos. Neigiama suma kreditą vėl nuima, ir abu judesiai lieka istorijoje.',
    'amount' => 'Suma',
    'amount_helper' => 'Neigiama suma kreditą ne duoda, o atima.',
    'reason' => 'Priežastis',
    'reason_helper' => 'Klientas mato tai šalia sumos, tad rašykite jam, o ne bylai.',
    'given' => ':amount kredito klientui :who',
    'bad_amount' => 'Tai ne suma.',
    'give_failed' => 'Kreditas neduotas',
    'give_failed_body' => 'Niekas nebuvo įrašyta. Pabandykite dar kartą, o jei kartosis, pažiūrėkite į storage/logs.',
    'take_failed' => 'Kreditas nenuimtas',
    'take_failed_body' => 'Paskyroje yra mažiau, nei prašėte nuimti. Likutis niekada nenuleidžiamas žemiau nulio.',

    // ---- ką sako vienas judesys ------------------------------------------
    'spent_on' => 'Sąskaita :number',
    'returned' => 'Grąžinta atgal: sąskaitos, kuriai jis buvo skirtas, parašyti nepavyko',
    'note_line' => 'Kreditinė sąskaita už sąskaitą :number',
    'refund_description' => 'Sąskaitos :number grąžinimas',

    // ---- kaip atiduodama atgal -------------------------------------------
    'refund' => 'Grąžinti',
    'refund_helper' => 'Iš šios sąskaitos dar negrąžinta :left. Kreditinė sąskaita rašoma abiem atvejais, tad pėdsakas lieka abiejose pusėse.',
    'refund_amount_helper' => 'Galima ir dalį. Tai, kas liks, galima grąžinti vėliau.',
    'refund_reason_helper' => 'Tai atspausdinama kreditinėje sąskaitoje, kurią klientas gali atsidaryti.',
    'where' => 'Kur keliauja pinigai',
    'where_provider' => 'Atgal tuo pačiu keliu, kuriuo sumokėta',
    'where_provider_helper' => 'Tiekėjas nusiunčia juos į tą kortelę ar sąskaitą, iš kurios jie atėjo. Kol pasirodys, gali praeiti kelios dienos, ir tiekėjas gali atsisakyti - senas mokėjimas arba būdas, kuris atgal nesisuka.',
    'where_balance' => 'Į jo paskyrą čia',
    'where_balance_helper' => 'Jie virsta kreditu ir nusiima nuo kitos jo sąskaitos. Iš banko niekas neišeina, ir nepavykti tai negali.',
    'refunded' => 'Grąžinta :amount',
    'refunded_body' => 'Tam parašyta kreditinė sąskaita :number.',
    'refund_failed' => 'Niekas nebuvo grąžinta',

    // ---- ir kodėl ne, po vieną priežastį ---------------------------------
    'refused_off' => 'Kreditas ir grąžinimai šiame skydelyje išjungti.',
    'refused_amount' => 'Tai daugiau, nei šioje sąskaitoje liko.',
    'refused_no_payment' => 'Nė vienas šios sąskaitos mokėjimas neturi tiek likusio, tad tiekėjui nėra ko atsukti atgal. Verčiau įrašykite tai į jo paskyrą.',
    'refused_no_gateway' => 'Tiekėjas, per kurį buvo sumokėta, nebėra įjungtas, tad jo paprašyti ką nors atsukti atgal nebeįmanoma. Verčiau įrašykite tai į jo paskyrą.',
    'refused_refused' => 'Tiekėjas atsisakė. Paprastai tai senas mokėjimas arba būdas, kuris atgal nesisuka; jo nurodyta priežastis yra storage/logs. Verčiau įrašykite tai į jo paskyrą.',
    'refused_note_failed' => 'Pinigai pajudėjo, bet kreditinės sąskaitos parašyti nepavyko, tad niekas nebuvo užfiksuota. Prieš bandydami dar kartą pažiūrėkite į storage/logs.',

    // ---- kaip pinigų įdedama ---------------------------------------------
    'topup' => 'Papildyti kreditą',
    'topup_helper' => 'Paskyroje turite :held. Tai, ką čia pridėsite, pats nusiims nuo kitos jūsų sąskaitos, o bet kuri jau atverta neapmokėta sąskaita iš to padengiama vos tik pinigai atkeliauja.',
    'topup_go' => 'Toliau į mokėjimą',
    'topup_amount_helper' => 'Nuo :least iki :most.',
    'topup_bad' => 'Tokios sumos sumokėti negalima',
    'topup_failed' => 'Mokėjimo pradėti nepavyko. Pabandykite dar kartą, o jei kartosis, pasakykite tam, kas prižiūri šį skydelį.',
    'topup_line' => 'Kreditas, įrašytas į paskyrą',
    'topup_reason' => 'Pridėta sąskaitoje :number',

    // ---- kur jis rodomas -------------------------------------------------
    'menu' => ':amount kredito',
    'held_helper' => 'Pats nusiima nuo kitos jūsų sąskaitos. Papildyti galite sąskaitų puslapyje.',
];
