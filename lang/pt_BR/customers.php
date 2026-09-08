<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Clientes: a loja, mas virada para a pessoa em vez da linha.
 *
 * Pedidos, faturas e pagamentos são cada um uma lista do que aconteceu. Esta
 * página faz a pergunta que quem está respondendo um ticket realmente tem:
 * quem é, o que tem, o que pagou e o que ficou em aberto.
 */

return [
    'title' => 'Clientes',
    'nav_label' => 'Clientes',
    'subheading' => 'Todo mundo que comprou alguma coisa, com o que tem, o que pagou e o que ainda deve.',

    // ---- a tabela --------------------------------------------------------
    'column_customer' => 'Cliente',
    'column_services' => 'Serviços',
    'column_spent' => 'Pago',
    'column_outstanding' => 'Em aberto',

    'of_orders' => 'de :count pedidos',
    'nothing_owed' => 'Nada',

    'filter_owing' => 'Deve alguma coisa',
    'filter_active' => 'Tem um serviço ativo',

    // ---- um deles --------------------------------------------------------
    'open' => 'Abrir',
    'close' => 'Fechar',
    'servers' => 'Servidores',
    'since' => 'Cliente desde',
    'their_services' => 'Serviços',
    'their_invoices' => 'Faturas',
    'no_services' => 'Nada ativo, e nada esperando para ser criado.',
    'no_invoices' => 'Nenhuma fatura foi escrita para esta conta.',

    'empty' => 'Ainda ninguém comprou nada',
    'empty_body' => 'Aqui aparece quem fez pedido, não todo mundo com conta, então enche com a primeira venda.',
];
