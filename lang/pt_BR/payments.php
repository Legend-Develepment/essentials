<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Pagamentos: cada tentativa de pagar e o que o meio de pagamento disse sobre
 * ela.
 *
 * Uma linha por tentativa em vez de por fatura, porque foi isso que aconteceu.
 * A palavra que esta página repete é «tentativa»: um pagamento que falhou é um
 * fato que vale a pena guardar, não um erro para esconder.
 */

return [
    'title' => 'Pagamentos',
    'nav_label' => 'Pagamentos',
    'subheading' => 'Cada tentativa de pagar, por cada meio de pagamento. Verificar de novo pergunta outra vez a eles, que é o mesmo que o webhook deles faz quando chega.',

    // ---- a tabela --------------------------------------------------------
    'column_invoice' => 'Fatura',
    'column_gateway' => 'Meio de pagamento',
    'column_reference' => 'Referência deles',
    'column_amount' => 'Valor',
    'column_state' => 'Estado',
    'column_updated' => 'Última notícia',

    'gone_invoice' => 'Fatura excluída',

    'state_open' => 'Esperando',
    'state_paid' => 'Pago',
    'state_failed' => 'Falhou',
    'state_cancelled' => 'Abandonado',

    // ---- os botões -------------------------------------------------------
    'recheck' => 'Verificar de novo',
    'rechecked' => 'Perguntado de novo',
    'rechecked_body' => 'Eles continuam não dizendo que está pago. Nada mudou.',
    'settled' => 'Está pago',
    'settled_body' => 'A fatura está quitada e tudo o que esperava por ela já está a caminho.',
    'recheck_failed' => 'Não deu para perguntar',
    'recheck_failed_body' => 'Não houve resposta. Tente daqui a um minuto; se continuar, confira a chave na página Configurações da loja.',
    'no_gateway' => 'Esse meio de pagamento está desligado',
    'no_gateway_body' => 'Ligue de novo para perguntar sobre este pagamento, ou marque a fatura como paga na mão.',

    'answer' => 'A resposta deles',
    'no_answer' => 'Nada registrado',
    'close' => 'Fechar',

    'empty' => 'Ainda ninguém pagou por um meio de pagamento',
    'empty_body' => 'As tentativas aparecem aqui assim que alguém apertar Pagar, terminando ou não.',
];
