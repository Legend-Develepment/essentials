<?php

/*
 * Magyar. Kézzel írva.
 *
 * A „cron” marad: ez a panel gazdagépén futó dolog neve, és aki utánanéz, erre
 * a szóra keres.
 */

return [
    'nav_label' => 'Ütemezések',
    'title' => 'Melyik ütemezés állt meg',
    'subheading' => 'A panel minden ütemezett feladata, a legrosszabb elöl — több mint :hours órája beragadva, késésben, vagy soha nem futott.',

    'how' => 'A Pelican az ütemezéseket az egyes szervereken belül mutatja, és a saját állapotának három szava van rájuk: ki, feldolgoz, aktív. Egyik sem az, hogy „ez megállt”. Egy félúton elszállt futás örökre feldolgoz marad, és pontosan úgy néz ki, mint egy most futó; egy ütemezés, amelynek az ideje órákkal ezelőtt lejárt, mert a cron leállt, még mindig aktívnak számít. Ez az oldal a másik kérdést teszi fel. Csak olvasás — minden, ami szerkeszt, futtat vagy töröl egy ütemezést, a Pelican saját oldalán marad annál a szervernél.',

    'column_state' => 'Állapot',
    'column_name' => 'Ütemezés',
    'column_server' => 'Szerver',
    'column_last' => 'Utolsó futás',
    'column_next' => 'Következő futás',

    /*
     * Az öt ítélet. Annak írva, ami igaz, nem utasításnak, mert három közülük
     * megnézendő dolog, kettő pedig nem.
     */
    'state_stuck' => 'Beragadt',
    'state_overdue' => 'Késésben',
    'state_never' => 'Soha nem futott',
    'state_healthy' => 'Rendben',
    'state_off' => 'Ki',

    'filter_stuck' => 'Beragadt',
    'filter_overdue' => 'Késésben',
    'filter_never' => 'Soha nem futott',
    'filter_off' => 'Kikapcsolva',

    'open' => 'Megnyitás a szerveren',

    'empty' => 'Nincs ütemezés egyetlen elérhető szerveren sem — vagy egy sem állt meg, ha be van kapcsolva egy szűrő.',
];
