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

    'empty' => 'Ainda não foi comprado nada',
    'empty_body' => 'As encomendas aparecem aqui assim que alguém comprar um pacote.',

    // ---- renovações ------------------------------------------------------
    'filter_late' => 'Atrasado numa fatura',
    'run_renewals' => 'Correr as renovações agora',
    'run_renewals_confirm' => 'Faz o que a passagem noturna faz: escreve a próxima fatura para tudo o que vence em breve, e para os servidores atrás de uma fatura que ficou por pagar além do período de tolerância.',
    'renewals_queued' => 'Posto na fila',
    'renewals_queued_body' => 'Corre na fila. Recarrega daqui a pouco para ver o que mudou.',
];
