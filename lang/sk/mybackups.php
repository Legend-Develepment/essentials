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
    'none' => 'Vašich serverov bez jedinej zálohy: :count.',
    'stale' => 'Bez zálohy dlhšie ako :days dní: :count.',
    'schedules' => 'Vašich zastavených naplánovaných úloh: :count.',

    'and_more' => 'a ďalšie :count',

    'open' => 'Otvorte server a choďte do Záloh, nech jednu vytvoríte.',
];
