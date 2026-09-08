<?php

/*
 * A página que responde a «qual dos meus está atrasado». Escrita para quem é
 * dono dos servidores, não para quem toca o painel - por isso aqui não se
 * fala de nodes, nem se mostra um número com que ele não possa fazer nada.
 * Cada linha nomeia um servidor que ele pode abrir ou diz o que fazer a
 * respeito dele.
 */

return [
    'title' => 'Precisa de atenção',
    'nav_label' => 'Precisa de atenção',
    'subheading' => 'Os seus servidores, ordenados pelo que está atrasado e não pelo nome. Um backup conta como vencido depois de :days dias.',
    'column_server' => 'Servidor',
    'column_last' => 'Último backup',
    'column_kept' => 'Guardados',
    'column_schedules' => 'Tarefas paradas',
    'never' => 'Nunca',
    'filter_none' => 'Nunca receberam backup',
    'filter_stale' => 'Backup vencido',
    'open' => 'Backups',
    'empty' => 'Nada está atrasado',
    'empty_body' => 'Todos os servidores que você alcança têm um backup recente e nenhuma tarefa parada. Esta página se preenche sozinha quando isso deixar de ser verdade.',
];
