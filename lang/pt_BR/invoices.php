<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Faturas: o documento, a página que lista e o e-mail.
 *
 * Três leitores dividem este arquivo. Quem administra lê a tabela e aperta
 * «marcar como paga»; um cliente lê o documento para imprimir e o e-mail; e o
 * próprio documento é lido meses depois por quem cuida da contabilidade. É por
 * causa desse último que as linhas doc_ são secas e formais: uma fatura não é
 * lugar para o tom do resto do painel.
 */

return [
    'title' => 'Faturas',
    'nav_label' => 'Faturas',
    'subheading' => 'O que está devendo e o que foi pago. Marcar uma como paga aqui faz tudo o que pagar faria: o servidor é criado, um suspenso volta.',

    // ---- a tabela --------------------------------------------------------
    'column_number' => 'Fatura',
    'column_customer' => 'Cliente',
    'column_order' => 'Pedido',
    'column_total' => 'Total',
    'column_state' => 'Estado',
    'column_due' => 'Vence',

    'kind_order' => 'Primeira fatura',
    'kind_renewal' => 'Renovação',
    'kind_credit' => 'Nota de crédito',
    'kind_upgrade' => 'Troca de pacote',
    'kind_topup' => 'Adicionar crédito',
    'kind_addon' => 'Extra',

    'state_unpaid' => 'Em aberto',
    'state_paid' => 'Paga',
    'state_cancelled' => 'Cancelada',

    'no_order' => 'Sem pedido',
    'order_count' => ':count serviços',
    'no_due' => 'Sem data',
    'gone_customer' => 'Conta excluída',
    'discount_of' => ':amount de desconto com :code',
    'paid_via' => 'por :how',
    'column_attempts' => 'Pagamento',
    'paid_by' => 'pago por :how',
    'paid_by_unknown' => 'pago',
    'paid_by_manual' => 'registro manual',
    'paid_by_free' => 'nada a pagar',
    'attempts_none' => 'nenhuma tentativa',
    'attempts_open' => ':count tentativas - :how',
    'attempt_last' => 'última :when, :state',
    'attempt_open' => 'não concluída',
    'attempt_paid' => 'paga',
    'attempt_cancelled' => 'cancelada',
    'attempt_failed' => 'falhou',
    'emailed' => 'Enviada',
    'not_emailed' => 'Não enviada',
    'filter_overdue' => 'Em atraso',

    // ---- os botões -------------------------------------------------------
    'open' => 'Abrir',
    'mark_paid' => 'Marcar como paga',
    'mark_paid_confirm' => 'Registra que o dinheiro chegou. O servidor é criado, um suspenso liga de novo e o próximo vencimento avança, exatamente como se um meio de pagamento tivesse avisado.',
    'paid' => 'Marcada como paga',
    'paid_body' => 'Tudo o que estava esperando esta fatura já está a caminho.',
    'already_paid' => 'Já estava paga',

    'withdraw' => 'Cancelar',
    'withdraw_confirm' => 'Tira a fatura dos livros. Só uma em aberto pode ser cancelada; uma fatura paga é o registro de um dinheiro que mudou de mãos.',
    'withdrawn' => 'Cancelada',
    'withdraw_refused' => 'Só uma fatura em aberto pode ser cancelada',

    'empty' => 'Ainda não há faturas',
    'empty_body' => 'Uma é escrita assim que alguém compra, e outra a cada período para tudo o que renova.',

    // ---- o documento -----------------------------------------------------
    'doc_title' => 'Fatura',
    'doc_number' => 'Número',
    'doc_issued' => 'Emitida em',
    'doc_due' => 'Vencimento',
    'doc_paid_on' => 'Paga em',
    'doc_billed_to' => 'Faturada para',
    'doc_from' => 'De',
    'doc_vat' => 'IVA',
    'doc_coc' => 'Registro comercial',
    'doc_description' => 'Descrição',
    'doc_amount' => 'Valor',
    'doc_subtotal' => 'Subtotal',
    'doc_discount' => 'Desconto',
    'doc_total' => 'Total',
    'doc_how_to_pay' => 'Como pagar',
    'doc_print' => 'Imprimir ou salvar em PDF',
    'doc_back' => 'Voltar ao painel',

    // ---- o e-mail --------------------------------------------------------
    'mail_subject' => 'Fatura :number',
    'mail_hello' => 'Olá :name,',
    'mail_intro' => 'Aqui está a fatura :number.',
    'mail_open' => 'Abrir a fatura',
    'mail_foot' => 'Você pode reler esta fatura quando quiser na sua página de faturas.',

    // ---- o sino ----------------------------------------------------------
    'bell_new' => 'Fatura :number',
    'bell_new_body' => 'São :total em aberto. Abra sua página de faturas para pagar.',
    'bell_reminder' => 'A fatura :number passou da data',
    'bell_reminder_body' => 'Continua em aberto, no valor de :total. Se não for paga até lá, o servidor que ela paga é parado em :date, e nada do que está nele é excluído quando isso acontecer.',
];
