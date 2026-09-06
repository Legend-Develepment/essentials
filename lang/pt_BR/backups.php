<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * Os backups, no painel inteiro.
 *
 * O Pelican responde a «quais backups este servidor tem». Esta página responde
 * ao contrário, que é a pergunta que um administrador realmente tem e que o
 * painel não tem onde colocar: quais dos meus não têm nenhum.
 */

return [
    'title' => 'Backups',
    'nav_label' => 'Backups',
    'subheading' => 'Todos os servidores que você alcança, com o tempo que estão sem backup. Os que nunca receberam um estão no topo; acima de :days dias um backup conta como vencido.',

    // ---- a tabela ---------------------------------------------------------
    'column_server' => 'Servidor',
    'column_last' => 'Último backup',
    'column_kept' => 'Guardados',
    'column_size' => 'Tamanho',
    'column_failed' => 'Com falha',

    'never' => 'Nunca',

    'filter_none' => 'Nunca receberam backup',
    'filter_stale' => 'Vencidos',
    'filter_failed' => 'Falhando',

    'open' => 'Abrir no Pelican',
];
