<?php

/*
 * Português. Escrito à mão.
 *
 * Pagamentos: cada tentativa de pagar e o que o fornecedor disse sobre ela.
 *
 * Uma linha por tentativa em vez de por fatura, porque foi isso que aconteceu.
 * A palavra que esta página repete é «tentativa»: um pagamento que falhou é um
 * facto que vale a pena guardar, não um erro para esconder.
 */

return [
    'title' => 'Pagamentos',
    'nav_label' => 'Pagamentos',
    'subheading' => 'Cada tentativa de pagar, por cada fornecedor. Verificar de novo volta a perguntar ao fornecedor, que é o mesmo que o webhook deles faz quando chega.',

    // ---- a tabela --------------------------------------------------------
    'column_invoice' => 'Fatura',
    'column_gateway' => 'Fornecedor',
    'column_reference' => 'Referência deles',
    'column_amount' => 'Valor',
    'column_state' => 'Estado',
    'column_updated' => 'Última notícia',

    'gone_invoice' => 'Fatura apagada',

    'state_open' => 'À espera',
    'state_paid' => 'Pago',
    'state_failed' => 'Falhou',
    'state_cancelled' => 'Abandonado',

    // ---- os botões -------------------------------------------------------
    'recheck' => 'Verificar de novo',
    'rechecked' => 'Perguntado outra vez',
    'rechecked_body' => 'O fornecedor continua a não dizer que está pago. Nada mudou.',
    'settled' => 'Está pago',
    'settled_body' => 'A fatura está saldada e tudo o que esperava por ela vai a caminho.',
    'recheck_failed' => 'Não deu para perguntar',
    'recheck_failed_body' => 'O fornecedor não respondeu. Tenta daqui a um minuto; se continuar, confere a chave na página Definições da loja.',
    'no_gateway' => 'Esse fornecedor está desligado',
    'no_gateway_body' => 'Volta a ligá-lo para perguntar por este pagamento, ou marca a fatura como paga à mão.',

    'answer' => 'A resposta deles',
    'no_answer' => 'Nada registado',
    'close' => 'Fechar',

    'empty' => 'Ainda ninguém pagou por um fornecedor',
    'empty_body' => 'As tentativas aparecem aqui assim que alguém carregar em Pagar, cheguem ao fim ou não.',
];
