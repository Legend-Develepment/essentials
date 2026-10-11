<?php

/*
 * Magyar. Kézzel írva.
 *
 * A sor valakinek a saját szerverlistája fölött. Két mondat, ami egy sorrá áll
 * össze, mert két különböző gond: egy szerver, amelyről soha nem készült
 * mentés, rendszerint olyan, amelyhez senki sem állított be ilyet, egy pedig,
 * amelynek a legutóbbija kilencnapos, megállt ütemezés.
 */

return [
    'none' => '{1} Az egyik kiszolgálójáról soha nem készült mentés.|[2,*] :count kiszolgálójáról soha nem készült mentés.',
    'stale' => '{1} Egyről több mint :days napja nem készült mentés.|[2,*] :count kiszolgálóról több mint :days napja nem készült mentés.',
    'schedules' => '{1} Az egyik ütemezett feladata leállt.|[2,*] :count ütemezett feladata leállt.',

    'and_more' => 'és még :count',

    'open' => 'Nyiss meg egy szervert, és a Mentések alatt készíts egyet.',
];
