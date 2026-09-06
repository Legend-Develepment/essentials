<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * As cópias de segurança, em todo o painel.
 *
 * O Pelican responde a «que cópias tem este servidor». Esta página responde ao
 * contrário, que é a pergunta que um administrador realmente tem e que o painel
 * não tem onde colocar: quais dos meus não têm nenhuma.
 */

return [
    'title' => 'Cópias de segurança',
    'nav_label' => 'Cópias de segurança',
    'subheading' => 'Todos os servidores que consegue alcançar, com o tempo que levam sem uma cópia. Os que nunca foram copiados estão no topo; a partir de :days dias uma cópia conta como desatualizada.',

    // ---- a tabela ---------------------------------------------------------
    'column_server' => 'Servidor',
    'column_last' => 'Última cópia',
    'column_kept' => 'Guardadas',
    'column_size' => 'Tamanho',
    'column_failed' => 'Falhadas',

    'never' => 'Nunca',

    'filter_none' => 'Nunca copiados',
    'filter_stale' => 'Desatualizadas',
    'filter_failed' => 'A falhar',

    'open' => 'Abrir no Pelican',
];
