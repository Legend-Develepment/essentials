<?php

/*
 * Português. Escrito à mão.
 *
 * Clientes: a loja, mas virada para a pessoa em vez da linha.
 *
 * Encomendas, faturas e pagamentos são cada um uma lista do que aconteceu.
 * Esta página faz a pergunta que quem está a responder a um ticket tem mesmo:
 * quem é isto, o que tem, o que pagou e o que ficou por pagar.
 */

return [
    'title' => 'Clientes',
    'nav_label' => 'Clientes',
    'subheading' => 'Toda a gente que comprou alguma coisa, com o que tem, o que pagou e o que ainda deve.',

    // ---- a tabela --------------------------------------------------------
    'column_customer' => 'Cliente',
    'column_services' => 'Serviços',
    'column_spent' => 'Pago',
    'column_outstanding' => 'Por pagar',

    'of_orders' => 'de :count encomendados',
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
    'no_services' => 'Nada ativo, e nada à espera de ser criado.',
    'no_invoices' => 'Não foi escrita nenhuma fatura para esta conta.',

    'empty' => 'Ainda ninguém comprou nada',
    'empty_body' => 'Aqui aparece quem encomendou, não toda a gente com conta, por isso enche-se com a primeira venda.',
];
