<?php

/*
 * Português (Brasil). Escrito à mão.
 */

return [
    /*
     * Duas frases que se juntam em uma linha, porque são dois problemas
     * diferentes: um servidor sem nenhum backup é normalmente um servidor para
     * o qual ninguém configurou nenhum, e um cujo último backup tem nove dias é
     * uma tarefa agendada que parou.
     */
    'none' => '{1} Um dos seus servidores nunca teve backup.|[2,*] :count dos seus servidores nunca tiveram backup.',
    'stale' => '{1} Um não tem backup há mais de :days dias.|[2,*] :count não têm backup há mais de :days dias.',
    'schedules' => '{1} Uma das suas tarefas agendadas parou.|[2,*] :count das suas tarefas agendadas pararam.',

    'and_more' => 'e mais :count',

    'open' => 'Abra um servidor e vá em Backups para criar um.',
];
