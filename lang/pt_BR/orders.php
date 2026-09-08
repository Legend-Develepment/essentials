<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Pedidos: o que alguém comprou e no que deu.
 *
 * Os quatro estados abaixo falam do dinheiro, não do servidor. Se o servidor
 * está rodando agora é pergunta do Pelican, e é respondida nas páginas do
 * Pelican. As palavras aqui mantêm as duas coisas separadas.
 */

return [
    'title' => 'Pedidos',
    'nav_label' => 'Pedidos',
    'subheading' => 'Tudo o que foi comprado, o servidor em que virou e como está.',

    // ---- a tabela --------------------------------------------------------
    'column_order' => 'Pedido',
    'column_customer' => 'Cliente',
    'column_package' => 'Pacote',
    'column_server' => 'Servidor',
    'column_state' => 'Estado',
    'column_due' => 'Próximo vencimento',

    'no_server' => 'Ainda não criado',
    'no_due' => 'Pagamento único',
    'gone_customer' => 'Conta excluída',
    'gone_package' => 'Pacote excluído',
    'overdue_days' => ':days dias em atraso',

    'state_pending' => 'Esperando',
    'state_active' => 'Ativo',
    'state_suspended' => 'Suspenso',
    'state_cancelled' => 'Cancelado',

    // ---- os botões -------------------------------------------------------
    'retry' => 'Criar de novo',
    'retry_confirm' => 'Coloca a criação na fila outra vez. Nada mais muda e a fatura continua paga.',
    'retrying' => 'Colocado na fila',

    'suspend' => 'Suspender',
    'suspend_confirm' => 'Para o servidor com a suspensão do próprio Pelican. Arquivos, bancos de dados e backups ficam onde estão, e pagar a fatura tira a suspensão.',
    'suspended' => 'Suspenso',

    'unsuspend' => 'Tirar a suspensão',
    'unsuspended' => 'Rodando de novo',

    'change_due' => 'Mudar o vencimento',
    'change_due_helper' => 'Quando a próxima fatura é escrita. Vazio quer dizer nunca: o pedido para de renovar sem estar cancelado.',

    'cancel' => 'Cancelar',
    'cancel_confirm' => 'Para as renovações e devolve o lugar no estoque. O servidor fica como está: excluir é coisa que se faz no Pelican, onde é o lugar disso.',
    'cancelled' => 'Cancelado',

    'saved' => 'Salvo',
    'refused' => 'Nada mudou',
    'refused_body' => 'O pedido não está num estado que permita isso. Recarregue a página e olhe de novo.',

    // ---- o que o cliente ouve --------------------------------------------
    'bell_ready' => 'Seu servidor está pronto',
    'bell_ready_body' => ':server foi criado e está esperando você ligar.',
    'bell_suspended' => 'Seu servidor foi suspenso',
    'bell_suspended_body' => 'Uma fatura ficou sem pagar além do prazo de tolerância. Pagar liga o servidor de novo; nada foi excluído.',

    // ---- o que quem administra ouve --------------------------------------
    'bell_failed' => 'O pedido :number não pôde ser criado',
    'no_allocation' => 'Nenhum node deste pacote tem allocation livre. Adicione uma e crie de novo.',
    'no_reason' => 'O painel recusou sem dizer por quê.',

    // ---- o servidor que sai daí ------------------------------------------
    'server_description' => 'Comprado na loja, pedido :number.',
    'server_fallback' => 'Servidor',

    'empty' => 'Ainda não compraram nada',
    'empty_body' => 'Os pedidos aparecem aqui assim que alguém comprar um pacote.',
];
