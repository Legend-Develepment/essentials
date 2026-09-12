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
    'cancel_confirm' => 'O serviço roda até :date e não é faturado de novo. Nesse dia o servidor é excluído, com tudo o que tem dentro. O cliente é avisado das duas coisas agora.',
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
    'not_paid' => 'Este pedido não tem nenhuma fatura paga, então nada foi criado. Se ele foi pago, a fatura em que foi pago não lista este pedido - avise quem administra este painel.',

    // ---- o servidor que sai daí ------------------------------------------
    'server_description' => 'Comprado na loja, pedido :number.',
    'server_fallback' => 'Servidor',
    'state_ending' => 'Encerrando',
    'ends_on' => 'Encerra em :date',
    'no_more_dues' => 'Não é mais cobrado',
    'cancel_confirm_open' => 'Para as renovações agora e devolve o lugar no estoque. O servidor fica rodando: este pacote não tem prazo mínimo, então não há data para correr até lá. Exclua o servidor no Pelican quando o cliente não precisar mais dele.',
    'terminate' => 'Parar e excluir',
    'terminate_heading' => 'Excluir este servidor?',
    'terminate_confirm' => 'O servidor é excluído agora, com os arquivos, os bancos de dados e os backups dele. Não há como desfazer nem espera pelo fim do contrato. Cancele em vez disso, se o cliente deve ficar com ele até a data que recebeu.',
    'terminate_go' => 'Excluir',
    'terminated' => 'Excluído',
    'terminated_body' => 'O servidor não existe mais e o pedido está fechado.',
    'bell_ending' => 'Seu :package encerra em :date',
    'bell_ending_open' => 'Seu :package foi cancelado',
    'bell_ending_body' => 'Você não será cobrado por ele de novo. Tudo o que está no servidor é excluído quando ele para, então copie o que quiser guardar.',
    'bell_ended' => 'Seu :package chegou ao fim',
    'bell_ended_body' => 'O contrato acabou e o servidor foi excluído.',
    'bell_undeleted' => 'O pedido :number não pôde ser excluído',
    'bell_undeleted_body' => 'O painel recusou excluir o servidor. O pedido está fechado e ninguém será cobrado por ele, mas o servidor continua lá e precisa ser removido no Pelican.',
    'bell_undelivered' => 'O arquivo do pedido :number ainda está aqui',
    'bell_undelivered_body' => 'O servidor foi criado, mas o arquivo que o cliente enviou não pôde ser colocado dentro dele. Ele continua no armazenamento do painel, e o motivo está em storage/logs.',
    'by_customer' => 'Encerrado pelo cliente',
    'by_admin' => 'Encerrado aqui',
    'filter_by' => 'Quem encerrou',
    'details' => 'Detalhes',
    'details_of' => 'Pedido :number',
    'close' => 'Fechar',
    'detail_package' => 'Pacote',
    'detail_placed' => 'Pedido em',
    'detail_built' => 'Servidor criado',
    'detail_due' => 'Próximo vencimento',
    'detail_ends' => 'Encerra em',
    'detail_suspended' => 'Suspenso',
    'detail_cancelled' => 'Cancelado',
    'detail_file_in' => 'Arquivo colocado',
    'detail_file_waiting' => 'Arquivo',
    'detail_file_waiting_value' => 'Enviado, esperando o servidor ser criado.',
    'detail_note' => 'Último problema',

    'empty' => 'Ainda não compraram nada',
    'empty_body' => 'Os pedidos aparecem aqui assim que alguém comprar um pacote.',

    // ---- renovações ------------------------------------------------------
    'filter_late' => 'Atrasado numa fatura',
    'run_renewals' => 'Rodar as renovações agora',
    'run_renewals_confirm' => 'Faz o que a passagem noturna faz: escreve a próxima fatura para tudo o que vence logo, e para os servidores atrás de uma fatura que ficou em aberto além do prazo de tolerância.',
    'renewals_queued' => 'Colocado na fila',
    'renewals_queued_body' => 'Roda na fila. Atualize daqui a pouco para ver o que mudou.',
];
