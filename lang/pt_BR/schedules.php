<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Cron» fica em inglês: é assim que ele se chama no host e na documentação do
 * Pelican, e é exatamente o que se precisa saber quando esta página diz que ele
 * não está rodando.
 */

return [
    'nav_label' => 'Tarefas agendadas',
    'title' => 'Qual tarefa agendada parou',
    'subheading' => 'Todas as tarefas agendadas do painel, as piores primeiro — travadas há mais de :hours horas, atrasadas, ou que nunca rodaram.',

    'how' => 'O Pelican mostra as tarefas agendadas dentro de cada servidor, e o status dele tem três palavras para elas: inativa, processando, ativa. Nenhuma diz «esta parou». Uma execução que caiu no meio fica «processando» para sempre e é desenhada igualzinha a uma que está rodando agora; uma tarefa cujo horário passou faz horas porque o cron morreu continua sendo chamada de ativa. Esta página faz a outra pergunta. Somente leitura — tudo o que edita, roda ou apaga uma tarefa fica na página do Pelican daquele servidor.',

    'column_state' => 'Estado',
    'column_name' => 'Tarefa',
    'column_server' => 'Servidor',
    'column_last' => 'Última execução',
    'column_next' => 'Próxima execução',

    /*
     * Os cinco veredictos. Escritos como aquilo que é verdade e não como uma
     * instrução, porque três deles são coisas para olhar e dois não são.
     */
    'state_stuck' => 'Travada',
    'state_overdue' => 'Atrasada',
    'state_never' => 'Nunca rodou',
    'state_healthy' => 'Certa',
    'state_off' => 'Inativa',

    'filter_stuck' => 'Travadas',
    'filter_overdue' => 'Atrasadas',
    'filter_never' => 'Nunca rodaram',
    'filter_off' => 'Desligadas',

    'open' => 'Abrir no servidor',

    'empty' => 'Não há tarefas agendadas em nenhum servidor que você alcance — ou nenhuma parada, se tiver um filtro ligado.',
];
