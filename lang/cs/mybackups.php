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
    'none' => '{1} Jeden z vašich serverů nebyl nikdy zálohován.|[2,*] :count z vašich serverů nebylo nikdy zálohováno.',
    'stale' => '{1} Jeden nebyl zálohován déle než :days dní.|[2,*] :count nebylo zálohováno déle než :days dní.',
    'schedules' => '{1} Jedna z vašich naplánovaných úloh se zastavila.|[2,*] :count z vašich naplánovaných úloh se zastavilo.',

    'and_more' => 'a další :count',

    'open' => 'Otevřete server a jděte do Záloh, ať jednu vytvoříte.',
];
