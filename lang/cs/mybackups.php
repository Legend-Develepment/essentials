<?php

/*
 * Čeština. Psáno ručně.
 *
 * Čísla stojí na konci věty, ne uprostřed: čeština skloňuje podstatné jméno
 * podle čísla a jeden tvar všechny případy nepokryje. „Serverů bez zálohy: 3" je
 * správně pro tři, pro jeden i pro dvacet jedna.
 */

return [
    /*
     * Dvě věty, které se spojují do jednoho řádku, protože jsou to dvě různé
     * potíže: server bez jediné zálohy je obvykle ten, komu ji nikdo
     * nenastavil, a server, jehož poslední záloha je devět dní stará, je
     * naplánovaná úloha, která se zastavila.
     */
    'none' => 'Vašich serverů bez jediné zálohy: :count.',
    'stale' => 'Bez zálohy déle než :days dní: :count.',
    'schedules' => 'Vašich naplánovaných úloh, které se zastavily: :count.',

    'and_more' => 'a další :count',

    'open' => 'Otevřete server a jděte do Záloh, ať jednu vytvoříte.',
];
