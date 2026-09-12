<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Cron» fica em inglês: é assim que se chama no anfitrião e na documentação do
 * Pelican, e é exatamente o que é preciso saber quando esta página diz que não
 * está a correr.
 */

return [
    'nav_label' => 'Tarefas agendadas',
    'title' => 'Que tarefa agendada parou',
    'subheading' => 'Todas as tarefas agendadas do painel, as piores primeiro - presas há mais de :hours horas, atrasadas, ou nunca executadas.',

    'how' => 'O Pelican mostra as tarefas agendadas dentro de cada servidor, e o seu próprio estado tem três palavras para elas: inativa, em processamento, ativa. Nenhuma diz «esta parou». Uma execução que caiu a meio fica «em processamento» para sempre e é desenhada exatamente como uma que está a correr agora; uma tarefa cuja hora passou há horas porque o cron morreu continua a chamar-se ativa. Esta página faz a outra pergunta. Só de leitura - tudo o que edita, executa ou apaga uma tarefa fica na página do Pelican para esse servidor.',

    'column_state' => 'Estado',
    'column_name' => 'Tarefa',
    'column_server' => 'Servidor',
    'column_last' => 'Última execução',
    'column_next' => 'Próxima execução',

    /*
     * Os cinco veredictos. Escritos como aquilo que é verdade e não como uma
     * instrução, porque três deles são coisas para olhar e dois não são.
     */
    'state_stuck' => 'Presa',
    'state_overdue' => 'Atrasada',
    'state_never' => 'Nunca executada',
    'state_healthy' => 'Bem',
    'state_off' => 'Inativa',

    'filter_stuck' => 'Presas',
    'filter_overdue' => 'Atrasadas',
    'filter_never' => 'Nunca executadas',
    'filter_off' => 'Desativadas',

    'open' => 'Abrir no servidor',

    'empty' => 'Não há tarefas agendadas em nenhum servidor que consiga alcançar - ou nenhuma parada, se tiver um filtro ligado.',
];
