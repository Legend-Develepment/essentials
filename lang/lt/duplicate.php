<?php

/*
 * Lietuvių. Rašyta ranka.
 *
 * „Egg“ ir „allocation“ lieka: tai Pelican žodžiai, ir būtent jų žmogus ieško
 * node puslapyje.
 */

return [
    'title' => 'Kopijuoti serverį',
    'nav_label' => 'Kopijuoti serverį',
    'subheading' => 'Dar vienas serveris, sutvarkytas lygiai kaip toks, kurį jau turi, arba keli iš karto.',

    'section' => 'Kas kopijuojama',
    'section_helper' => 'Savininkas, egg, paleidimo komanda, ribos ir kiekvienas kintamasis kopijuojami. Failai, duomenų bazės, atsarginės kopijos ir tvarkaraščiai - ne; veikiančio serverio failų kopija yra jo būsenos kopija, o tai retai reiškia „dar vieną tokį“.',

    'source' => 'Kopijuoti iš',
    'source_helper' => 'Kopijos atsiduria tame pačiame node kaip ir šis serveris, nes ten yra jo laisvi adresai.',

    'name' => 'Pavadink kopiją',
    'name_helper' => 'Jei padarysi daugiau nei vieną, jos sunumeruojamos: „Botas 1“, „Botas 2“, ir taip toliau.',

    'copies' => 'Kiek',
    'copies_helper' => 'Pirma pasirink serverį.',
    'room' => 'Laisvų adresų node :node: :count, taigi daugiau nei tiek dabar padaryti negalima.',
    'no_room' => 'Node :node neliko nė vieno laisvo adreso. Kopijai reikia savo, tad pirma pridėk allocation tam node.',

    /*
     * Sėkmės suskaičiuotos, o ne išvardytos, o nesėkmės išvardytos - ir būtent
     * tokia tvarka padeda: dešimt pavykusių vardų yra teksto siena, kurios
     * niekas neskaito, o tas vienas nepavykęs yra vienintelis, kurį verta
     * perskaityti.
     */
    'made' => 'Padaryta kopijų: :count',
    'partly_failed' => 'Kopijų, kurių nepavyko padaryti: :count',
    'failed' => 'Nieko nebuvo nukopijuota',
];
