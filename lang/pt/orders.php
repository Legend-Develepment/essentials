<?php

/*
 * Português. Escrito à mão.
 *
 * Encomendas: o que alguém comprou e no que isso deu.
 *
 * Os quatro estados abaixo falam do dinheiro, não do servidor. Se o servidor
 * está a correr neste momento é a pergunta do Pelican, e é respondida nas
 * páginas do Pelican. As palavras aqui mantêm as duas coisas separadas.
 */

return [
    'title' => 'Encomendas',
    'nav_label' => 'Encomendas',
    'subheading' => 'Tudo o que foi comprado, o servidor em que se tornou e como está.',

    // ---- a tabela --------------------------------------------------------
    'column_order' => 'Encomenda',
    'column_customer' => 'Cliente',
    'column_package' => 'Pacote',
    'column_server' => 'Servidor',
    'column_state' => 'Estado',
    'column_due' => 'Próximo vencimento',

    'no_server' => 'Ainda não criado',
    'no_due' => 'Pagamento único',
    'gone_customer' => 'Conta apagada',
    'gone_package' => 'Pacote apagado',
    'overdue_days' => ':days dias em atraso',

    'state_pending' => 'À espera',
    'state_active' => 'Ativo',
    'state_suspended' => 'Suspenso',
    'state_cancelled' => 'Cancelado',

    // ---- os botões -------------------------------------------------------
    'retry' => 'Criar de novo',
    'retry_confirm' => 'Volta a pôr a criação na fila. Nada mais muda e a fatura continua paga.',
    'retrying' => 'Posto na fila',

    'suspend' => 'Suspender',
    'suspend_confirm' => 'Para o servidor com a suspensão do próprio Pelican. Ficheiros, bases de dados e cópias de segurança ficam onde estão, e pagar a fatura levanta-a.',
    'suspended' => 'Suspenso',

    'unsuspend' => 'Levantar a suspensão',
    'unsuspended' => 'A correr de novo',

    'change_due' => 'Mudar o vencimento',
    'change_due_helper' => 'Quando é escrita a próxima fatura. Vazio quer dizer nunca: a encomenda deixa de renovar sem estar cancelada.',

    'cancel' => 'Cancelar',
    'cancel_confirm' => 'Para as renovações e devolve o lugar no stock. O servidor fica como está: apagá-lo faz-se no Pelican, que é onde isso pertence.',
    'cancelled' => 'Cancelada',

    'saved' => 'Guardado',
    'refused' => 'Nada mudou',
    'refused_body' => 'A encomenda não está num estado que o permita. Recarrega a página e olha outra vez.',

    // ---- o que o cliente ouve --------------------------------------------
    'bell_ready' => 'O teu servidor está pronto',
    'bell_ready_body' => ':server foi criado e espera que o arranques.',
    'bell_suspended' => 'O teu servidor foi suspenso',
    'bell_suspended_body' => 'Uma fatura ficou por pagar para além do período de tolerância. Pagá-la arranca o servidor outra vez; nada foi apagado.',

    // ---- o que quem administra ouve --------------------------------------
    'bell_failed' => 'A encomenda :number não pôde ser criada',
    'no_allocation' => 'Nenhum node deste pacote tem uma allocation livre. Acrescenta uma e cria de novo.',
    'no_reason' => 'O painel recusou sem dizer porquê.',

    // ---- o servidor que daí sai ------------------------------------------
    'server_description' => 'Comprado na loja, encomenda :number.',
    'server_fallback' => 'Servidor',
    'state_ending' => 'A terminar',
    'ends_on' => 'Termina a :date',
    'no_more_dues' => 'Sem mais faturas',
    'cancel_confirm_open' => 'Para as renovações agora e devolve o lugar no stock. O servidor fica a correr: este pacote não tem período mínimo, por isso não há data até à qual correr. Apague o servidor no Pelican quando o cliente já não precisar dele.',
    'terminate' => 'Parar e apagar',
    'terminate_heading' => 'Apagar este servidor?',
    'terminate_confirm' => 'O servidor é apagado agora, com os ficheiros, as bases de dados e as cópias de segurança. Não há como desfazer nem espera pelo fim do contrato. Cancele em vez disso, se o cliente o deve manter até à data que lhe foi dada.',
    'terminate_go' => 'Apagar',
    'terminated' => 'Apagado',
    'terminated_body' => 'O servidor desapareceu e a encomenda está fechada.',
    'bell_ending' => 'O teu :package termina a :date',
    'bell_ending_open' => 'O teu :package foi cancelado',
    'bell_ending_body' => 'Não voltarás a ser faturado por ele. Tudo o que está no servidor é apagado quando ele para, por isso copia o que quiseres guardar.',
    'bell_ended' => 'O teu :package terminou',
    'bell_ended_body' => 'O contrato chegou ao fim e o servidor foi apagado.',
    'bell_undeleted' => 'A encomenda :number não pôde ser apagada',
    'bell_undeleted_body' => 'O painel recusou apagar o servidor. A encomenda está fechada e ninguém será faturado por ela, mas o servidor continua lá e tem de ser removido no Pelican.',

    'empty' => 'Ainda não foi comprado nada',
    'empty_body' => 'As encomendas aparecem aqui assim que alguém comprar um pacote.',

    // ---- renovações ------------------------------------------------------
    'filter_late' => 'Atrasado numa fatura',
    'run_renewals' => 'Correr as renovações agora',
    'run_renewals_confirm' => 'Faz o que a passagem noturna faz: escreve a próxima fatura para tudo o que vence em breve, e para os servidores atrás de uma fatura que ficou por pagar além do período de tolerância.',
    'renewals_queued' => 'Posto na fila',
    'renewals_queued_body' => 'Corre na fila. Recarrega daqui a pouco para ver o que mudou.',
];
