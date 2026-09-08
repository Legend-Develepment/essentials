<?php

/*
 * Português. Escrito à mão.
 *
 * Faturas: o documento, a página que as lista e o email.
 *
 * Três leitores partilham este ficheiro. Quem administra lê a tabela e carrega
 * em «marcar como paga»; um cliente lê o documento para imprimir e o email; e o
 * próprio documento é lido meses depois por quem faz a contabilidade. É por
 * causa deste último que as linhas doc_ são secas e formais: uma fatura não é o
 * sítio para o tom do resto do painel.
 */

return [
    'title' => 'Faturas',
    'nav_label' => 'Faturas',
    'subheading' => 'O que está em dívida e o que foi pago. Marcar uma como paga aqui faz tudo o que pagá-la faria: o servidor é criado, um suspenso volta.',

    // ---- a tabela --------------------------------------------------------
    'column_number' => 'Fatura',
    'column_customer' => 'Cliente',
    'column_order' => 'Encomenda',
    'column_total' => 'Total',
    'column_state' => 'Estado',
    'column_due' => 'Vence',

    'kind_order' => 'Primeira fatura',
    'kind_renewal' => 'Renovação',

    'state_unpaid' => 'Por pagar',
    'state_paid' => 'Paga',
    'state_cancelled' => 'Retirada',

    'no_order' => 'Sem encomenda',
    'no_due' => 'Sem data',
    'gone_customer' => 'Conta apagada',
    'discount_of' => ':amount de desconto com :code',
    'paid_via' => 'por :how',
    'emailed' => 'Enviada',
    'not_emailed' => 'Não enviada',
    'filter_overdue' => 'Em atraso',

    // ---- os botões -------------------------------------------------------
    'open' => 'Abrir',
    'mark_paid' => 'Marcar como paga',
    'mark_paid_confirm' => 'Regista que o dinheiro chegou. O servidor é criado, um suspenso arranca outra vez e o próximo vencimento avança, tal como se um serviço de pagamentos o tivesse dito.',
    'paid' => 'Marcada como paga',
    'paid_body' => 'Tudo o que esperava por esta fatura já vai a caminho.',
    'already_paid' => 'Já estava paga',

    'withdraw' => 'Retirar',
    'withdraw_confirm' => 'Tira a fatura das contas. Só uma por pagar pode ser retirada; uma fatura paga é o registo de dinheiro que mudou de mãos.',
    'withdrawn' => 'Retirada',
    'withdraw_refused' => 'Só uma fatura por pagar pode ser retirada',

    'empty' => 'Ainda não há faturas',
    'empty_body' => 'Escreve-se uma assim que alguém compra, e outra por cada período para tudo o que renova.',

    // ---- o documento -----------------------------------------------------
    'doc_title' => 'Fatura',
    'doc_number' => 'Número',
    'doc_issued' => 'Emitida',
    'doc_due' => 'Vencimento',
    'doc_paid_on' => 'Paga',
    'doc_billed_to' => 'Faturada a',
    'doc_from' => 'De',
    'doc_description' => 'Descrição',
    'doc_amount' => 'Valor',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Desconto',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'Como pagar',
    'doc_print' => 'Imprimir ou guardar como PDF',
    'doc_back' => 'Voltar ao painel',

    // ---- o email ---------------------------------------------------------
    'mail_subject' => 'Fatura :number',
    'mail_hello' => 'Olá :name,',
    'mail_intro' => 'Aqui está a fatura :number.',
    'mail_open' => 'Abrir a fatura',
    'mail_foot' => 'Podes reler esta fatura quando quiseres na tua página de faturação.',

    // ---- o sino ----------------------------------------------------------
    'bell_new' => 'Fatura :number',
    'bell_new_body' => 'Estão :total por pagar. Abre a tua página de faturação para pagar.',
];
