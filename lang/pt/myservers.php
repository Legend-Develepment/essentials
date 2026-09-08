<?php

/*
 * A página que responde a «qual dos meus está atrasado». Escrita para quem é
 * dono dos servidores, não para quem gere o painel - por isso não se fala
 * aqui de nodes, nem se apresenta um número com que nada possa fazer. Cada
 * linha nomeia um servidor que pode abrir ou diz o que fazer quanto a ele.
 */

return [
    'title' => 'Precisa de atenção',
    'nav_label' => 'Precisa de atenção',
    'subheading' => 'Os seus servidores, ordenados pelo que está atrasado e não pelo nome. Uma cópia conta como desatualizada ao fim de :days dias.',
    'column_server' => 'Servidor',
    'column_last' => 'Última cópia',
    'column_kept' => 'Guardadas',
    'column_schedules' => 'Tarefas paradas',
    'never' => 'Nunca',
    'filter_none' => 'Nunca copiados',
    'filter_stale' => 'Cópia desatualizada',
    'open' => 'Cópias de segurança',
    'empty' => 'Não há nada atrasado',
    'empty_body' => 'Todos os servidores que consegue alcançar têm uma cópia recente e nenhuma tarefa parada. Esta página enche-se sozinha quando isso deixar de ser verdade.',
];
