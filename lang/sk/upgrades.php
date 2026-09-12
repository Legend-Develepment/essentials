<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Presun bežiacej služby z jedného balíka na druhý.
 *
 * Slová tu držia jednu vec stále oddelene: čo balík stojí a čo stojí prechod
 * naň dnes, sú dve rôzne čísla. To prvé je na pulte; to druhé závisí od toho,
 * ako ďaleko je táto služba v zaplatenom období, a práve s ním človek súhlasí,
 * keď stlačí tlačidlo.
 *
 * Slovu „upgrade" sa v tom, čo číta zákazník, vyhýbame, lebo polovica týchto
 * prechodov ide opačným smerom. Tu sa to volá zmena.
 */

return [
    // ---- na karte služby --------------------------------------------------
    'change' => 'Zmeniť balík',
    'change_body' => 'To, čo zostáva z obdobia, ktoré si už zaplatil, sa odpočíta a tie isté dni sa vyúčtujú novou cenou. Na tvojom serveri sa nič nestratí.',
    'change_to' => 'Zmeniť na :name',
    'change_confirm' => 'Zmeniť túto službu na :name?',
    'change_free' => 'Nie je čo platiť',
    'costs_now' => ':amount teraz',
    'gives_back' => ':amount späť',
    'waiting' => 'Zmena dohodnutá',
    'waiting_for' => 'Zmena na :name čaká na nezaplatenú faktúru.',

    // ---- čo sa stane potom ------------------------------------------------
    'done' => 'Presunuté na :name',
    'done_body' => 'Tvoja služba beží na novom balíku. Čo ti patrilo späť, máš na účte.',
    'refused' => 'Zmena sa neuskutočnila',

    // ---- a prečo nie, dôvod po dôvode -------------------------------------
    'refused_off' => 'Zmena balíka je na tomto paneli vypnutá.',
    'refused_not_active' => 'Zmeniť sa dá len bežiaca služba. Pri tej, ktorá čaká, je pozastavená alebo sa končí, niet čo prepočítať.',
    'refused_gone' => 'Balík, na ktorom táto služba beží, už neexistuje, takže niet s čím porovnávať.',
    'refused_same' => 'To je balík, na ktorom už beží.',
    'refused_egg' => 'Ten balík beží na inom softvéri. Bol by to iný server, nie väčší, tak si ho treba kúpiť ako samostatný.',
    'refused_period' => 'Ten balík sa účtuje za iné obdobie, a to je iná dohoda, nie väčšia.',
    'refused_stock' => 'Ten balík je vypredaný.',
    'refused_waiting' => 'Pre túto službu už jedna zmena čaká na nezaplatenú faktúru. Najprv ju zaplať alebo zruš.',
    'refused_failed' => 'Nič sa nezapísalo, takže sa nič nezmenilo. Skús to znova a povedz to tomu, kto panel spravuje, ak sa to bude opakovať.',
    'refused_server' => 'Serveru sa nepodarilo nastaviť nové limity, tak služba zostala presne taká, aká bola. Ten, kto tento panel spravuje, už o tom vie.',

    // ---- čo stojí na dokladoch --------------------------------------------
    'line' => 'Zmena z :from na :to, za zvyšných :days dní tohto obdobia',
    'credit_reason' => 'Zmena na :name',

    // ---- a čo sa dozvie ten, komu panel patrí -----------------------------
    'bell_failed' => 'Zmena balíka pri objednávke :number zlyhala',
    'cold_title' => 'Zmena balíka dorazila do panela, ale nie na node, pri objednávke :number',
    'cold_body' => 'Služba beží na :name a nové limity sú zapísané. Node si ich zatiaľ nevzal a prečíta si ich, až keď ten server nabudúce naštartuje, takže dovtedy má zákazník stále starú veľkosť. Pozri sa na ten node.',
    'gone' => 'Balík, na ktorý sa malo prejsť, už neexistuje.',
    'refused_by_node' => 'Server nové limity neprijal: :why',

    // ---- ako to dať do poriadku -------------------------------------------
    'retry' => 'Skúsiť zmenu znova',
    'retry_confirm' => 'Skúsi zmenu balíka ešte raz. Faktúra za ňu je už zaplatená, takže sa nič neúčtuje dvakrát.',
    'retried' => 'Zmena prešla',
    'retry_failed' => 'Zlyhalo to znova. Dôvod stojí pri objednávke.',
];
