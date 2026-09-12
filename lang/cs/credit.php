<?php

/*
 * Čeština. Psáno rukou.
 *
 * Kredit, vracení peněz a dobropisy.
 *
 * Dvě slova se všude níž záměrně drží od sebe.
 *
 * „Kredit" jsou peníze, které obchod pro někoho drží. Z jeho další faktury se
 * odečtou samy, ještě dřív, než se ho kdokoli zeptá, jestli zaplatí.
 *
 * „Vrácení peněz" je samotný akt vracení a má dva cíle: zpátky na kartu, ze
 * které peníze přišly, nebo dál na účet jako kredit. Text vždycky říká, který
 * z nich to je, protože zákazník, kterému se řekne „peníze jsou vráceny" a
 * který pak v bance nic nenajde, píše zpátky - a právem.
 *
 * „Dobropis" je doklad. Vypíše se tak i tak, protože je to záznam o tom, že ty
 * peníze už obchodu nepatří - ne tvrzení o tom, kam šly.
 */

return [
    // ---- co vidí zákazník ------------------------------------------------
    'yours' => 'Tvůj kredit',
    'yours_body' => 'Odečte se ti sám z další faktury. Nemusíš s ním nic dělat.',
    'applied' => 'Zaplaceno z kreditu',
    'payable' => 'Zbývá zaplatit',

    // ---- pohyby, v okně zákazníka ----------------------------------------
    'held' => 'Kredit',
    'none_held' => 'Na účtu nic',
    'movements' => 'Kredit',
    'column' => 'Kredit',
    'none' => 'Žádný',

    // ---- jak ho přidat ---------------------------------------------------
    'give' => 'Kredit',
    'give_helper' => 'Na tomhle účtu je :held. Co na něj přidáš, se samo odečte z jeho další faktury. Záporná částka kredit zase ubere a oba pohyby zůstanou v historii.',
    'amount' => 'Částka',
    'amount_helper' => 'Záporná částka kredit ubere místo toho, aby ho přidala.',
    'reason' => 'Důvod',
    'reason_helper' => 'Zákazník to vidí vedle částky, tak to piš pro něj, ne do spisu.',
    'given' => ':amount kreditu pro :who',
    'bad_amount' => 'Tohle není částka.',
    'give_failed' => 'Kredit se nepřipsal',
    'give_failed_body' => 'Nic se nezapsalo. Zkus to znovu, a jestli se to bude opakovat, mrkni do logu.',
    'take_failed' => 'Kredit se neodebral',
    'take_failed_body' => 'Na účtu je míň, než jsi chtěl odebrat. Zůstatek nikdy nejde pod nulu.',

    // ---- co říká jeden pohyb ---------------------------------------------
    'spent_on' => 'Faktura :number',
    'returned' => 'Vráceno zpátky: fakturu, na kterou to bylo, se nepodařilo vypsat',
    'note_line' => 'Dobropis k faktuře :number',
    'refund_description' => 'Vrácení peněz z faktury :number',

    // ---- jak je vrátit ---------------------------------------------------
    'refund' => 'Vrátit peníze',
    'refund_helper' => 'Z téhle faktury se ještě nevrátilo :left. Dobropis se vypíše tak i tak, ať je o tom záznam na obou stranách.',
    'refund_amount_helper' => 'Část klidně stačí. Zbytek se dá vrátit později.',
    'refund_reason_helper' => 'Tohle se tiskne na dobropis, který si zákazník může otevřít.',
    'where' => 'Kam peníze půjdou',
    'where_provider' => 'Zpátky tam, odkud přišly',
    'where_provider_helper' => 'Brána je pošle na kartu nebo účet, ze kterého přišly. Může pár dní trvat, než se objeví, a může to odmítnout - stará platba nebo způsob, který se nevrací.',
    'where_balance' => 'Sem na jeho účet',
    'where_balance_helper' => 'Stane se z nich kredit a odečtou se z další faktury. Z banky neodejde nic a selhat to nemůže.',
    'refunded' => 'Vráceno :amount',
    'refunded_body' => 'Byl na to vypsán dobropis :number.',
    'refund_failed' => 'Nic se nevrátilo',

    // ---- a proč ne, vždycky jeden důvod -----------------------------------
    'refused_off' => 'Kredit a vracení peněz jsou na tomhle panelu vypnuté.',
    'refused_amount' => 'To je víc, než na téhle faktuře zbývá.',
    'refused_no_payment' => 'Žádná platba na téhle faktuře už tolik nemá, takže není co u brány vracet. Připiš to radši na jeho účet.',
    'refused_no_gateway' => 'Brána, přes kterou se tohle platilo, už není zapnutá, takže ji není o co požádat. Připiš to radši na jeho účet.',
    'refused_refused' => 'Brána to odmítla. Obvykle jde o starou platbu nebo o způsob, který se nevrací; důvod, který uvedla, je v logu. Připiš to radši na jeho účet.',
    'refused_note_failed' => 'Peníze se pohnuly, ale dobropis se nepodařilo vypsat, takže se nic nezaznamenalo. Než to zkusíš znovu, mrkni do logu.',

    // ---- jak si kredit dobít ---------------------------------------------
    'topup' => 'Dobít kredit',
    'topup_helper' => 'Na účtu máš :held. Co sem přidáš, se ti samo odečte z další faktury, a každá faktura, kterou máš otevřenou, se z toho uhradí, jakmile to dorazí.',
    'topup_go' => 'Pokračovat k platbě',
    'topup_amount_helper' => 'Mezi :least a :most.',
    'topup_bad' => 'Tuhle částku zaplatit nejde',
    'topup_failed' => 'Platbu se nepodařilo spustit. Zkus to znovu, a jestli se to bude opakovat, řekni to tomu, kdo tenhle panel spravuje.',
    'topup_line' => 'Dobití kreditu na účet',
    'topup_reason' => 'Přidáno na faktuře :number',

    // ---- kde se to ukazuje -----------------------------------------------
    'menu' => ':amount kreditu',
    'held_helper' => 'Odečte se sám z tvé další faktury. Dobít ho můžeš na stránce faktur.',
];
