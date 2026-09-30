<?php

/*
 * Slovenčina. Písané ručne.
 *
 * Čísla stoja na konci vety, nie v jej strede: slovenčina skloňuje podstatné
 * meno podľa čísla a jeden tvar všetky prípady nepokryje. „Serverov bez zálohy:
 * 3" je správne pre tri, pre jeden aj pre dvadsaťjeden.
 */

return [
    /*
     * Dve vety, ktoré sa spájajú do jedného riadka, lebo sú to dve rôzne
     * ťažkosti: server bez jedinej zálohy je obyčajne ten, komu ju nikto
     * nenastavil, a server, ktorého posledná záloha má deväť dní, je
     * naplánovaná úloha, ktorá zastala.
     */
    'none' => '{1} Jeden z vašich serverov nebol nikdy zálohovaný.|[2,*] :count vašich serverov nebolo nikdy zálohovaných.',
    'stale' => '{1} Jeden nebol zálohovaný viac ako :days dní.|[2,*] :count nebolo zálohovaných viac ako :days dní.',
    'schedules' => '{1} Jedna z vašich naplánovaných úloh sa zastavila.|[2,*] :count vašich naplánovaných úloh sa zastavilo.',

    'and_more' => 'a ďalšie :count',

    'open' => 'Otvorte server a choďte do Záloh, nech jednu vytvoríte.',
];
