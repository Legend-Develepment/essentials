<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Kredit, vrátenie peňazí a dobropisy.
 *
 * Dve slová sú všade nižšie zámerne držané oddelene.
 *
 * „Kredit" sú peniaze, ktoré obchod pre niekoho drží. Z jeho ďalšej faktúry sa
 * odpočítajú samy, ešte skôr, než je vôbec požiadaný o zaplatenie.
 *
 * „Vrátenie peňazí" je samotné vrátenie a má dva smery: späť na kartu, z ktorej
 * prišli, alebo na účet ako kredit. Text vždy hovorí, ktorý z nich, lebo
 * zákazník, ktorému sa povie „peniaze sú vrátené" a potom v banke nič nenájde,
 * sa ozve - a právom.
 *
 * „Dobropis" je doklad. Vypíše sa tak či tak, lebo je to záznam o tom, že tie
 * peniaze už obchodu nepatria - nie tvrdenie o tom, kam odišli.
 */

return [
    // ---- čo vidí zákazník -------------------------------------------------
    'yours' => 'Tvoj kredit',
    'yours_body' => 'Toto sa samo odpočíta z tvojej ďalšej faktúry. Nemusíš s tým nič robiť.',
    'applied' => 'Zaplatené z tvojho kreditu',
    'payable' => 'Zostáva zaplatiť',

    // ---- kniha pohybov v okne zákazníka -----------------------------------
    'held' => 'Kredit',
    'none_held' => 'Nič na účte',
    'movements' => 'Kredit',
    'column' => 'Kredit',
    'none' => 'Žiadny',

    // ---- ako ho pripísať --------------------------------------------------
    'give' => 'Kredit',
    'give_helper' => 'Na tomto účte je :held. To, čo naň pridáte, sa samo odpočíta z jeho ďalšej faktúry. Záporná suma kredit zase uberie a oba pohyby zostanú v histórii.',
    'amount' => 'Suma',
    'amount_helper' => 'Záporná suma kredit uberie namiesto toho, aby ho pridala.',
    'reason' => 'Dôvod',
    'reason_helper' => 'Zákazník to vidí vedľa sumy, tak to píšte preňho, nie do spisu.',
    'given' => ':amount kreditu pre :who',
    'bad_amount' => 'Toto nie je suma.',
    'give_failed' => 'Kredit sa nepripísal',
    'give_failed_body' => 'Nič sa nezapísalo. Skúste to znova a pozrite sa do logu, ak sa to bude opakovať.',
    'take_failed' => 'Kredit sa neubral',
    'take_failed_body' => 'Na účte je menej, než ste chceli ubrať. Zostatok nikdy neklesne pod nulu.',

    // ---- čo hovorí jeden pohyb -------------------------------------------
    'spent_on' => 'Faktúra :number',
    'returned' => 'Vrátené späť: faktúru, na ktorú to bolo, sa nepodarilo vypísať',
    'note_line' => 'Dobropis k faktúre :number',
    'refund_description' => 'Vrátenie peňazí z faktúry :number',

    // ---- ako ich vrátiť ---------------------------------------------------
    'refund' => 'Vrátiť peniaze',
    'refund_helper' => 'Z tejto faktúry sa zatiaľ nevrátilo :left. Dobropis sa vypíše tak či tak, aby o tom bol záznam na oboch stranách.',
    'refund_amount_helper' => 'Aj časť je v poriadku. Zvyšok sa dá vrátiť neskôr.',
    'refund_reason_helper' => 'Toto sa vytlačí na dobropis, ktorý si zákazník môže otvoriť.',
    'where' => 'Kam peniaze pôjdu',
    'where_provider' => 'Späť tou cestou, ktorou zaplatil',
    'where_provider_helper' => 'Poskytovateľ ich pošle na kartu alebo účet, z ktorých prišli. Môže pár dní trvať, kým sa objavia, a môže to aj odmietnuť - pri starej platbe alebo pri spôsobe, ktorý sa nedá otočiť.',
    'where_balance' => 'Sem na jeho účet',
    'where_balance_helper' => 'Stane sa z nich kredit a odpočíta sa z jeho ďalšej faktúry. Z banky nič neodíde a zlyhať to nemôže.',
    'refunded' => 'Vrátené :amount',
    'refunded_body' => 'Vypísal sa naň dobropis :number.',
    'refund_failed' => 'Nič sa nevrátilo',

    // ---- a prečo nie, dôvod po dôvode -------------------------------------
    'refused_off' => 'Kredit a vrátenie peňazí sú na tomto paneli vypnuté.',
    'refused_amount' => 'To je viac, než na tejto faktúre zostáva.',
    'refused_no_payment' => 'Žiadna platba na tejto faktúre nemá toľko zvyšku, takže poskytovateľ nemá čo otočiť. Pripíšte to radšej na jeho účet.',
    'refused_no_gateway' => 'Poskytovateľ, cez ktorého sa to zaplatilo, už nie je zapnutý, takže sa ho niet ako spýtať na otočenie. Pripíšte to radšej na jeho účet.',
    'refused_refused' => 'Poskytovateľ to odmietol. Zvyčajne ide o starú platbu alebo o spôsob, ktorý sa nedá otočiť; dôvod, ktorý uviedol, je v logu. Pripíšte to radšej na jeho účet.',
    'refused_note_failed' => 'Peniaze sa pohli, ale dobropis sa vypísať nedal, takže sa nič nezaznamenalo. Skôr než to skúsite znova, pozrite sa do logu.',

    // ---- ako si ho dobiť --------------------------------------------------
    'topup' => 'Dobiť kredit',
    'topup_helper' => 'Na účte máš :held. To, čo sem pridáš, sa samo odpočíta z tvojej ďalšej faktúry, a faktúra, ktorú máš otvorenú, sa z toho vyrovná hneď, ako to dorazí.',
    'topup_go' => 'Prejsť na platbu',
    'topup_amount_helper' => 'Medzi :least a :most.',
    'topup_bad' => 'Táto suma sa zaplatiť nedá',
    'topup_failed' => 'Platbu sa nepodarilo otvoriť. Skús to znova a povedz to tomu, kto tento panel spravuje, ak sa to bude opakovať.',
    'topup_line' => 'Kredit pripísaný na účet',
    'topup_reason' => 'Pridané na faktúre :number',

    // ---- kde ho vidno -----------------------------------------------------
    'menu' => ':amount kreditu',
    'held_helper' => 'Sám sa odpočíta z tvojej ďalšej faktúry. Dobiť si ho môžeš na stránke faktúr.',
];
