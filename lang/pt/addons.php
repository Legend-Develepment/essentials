<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * Extras vendidos ao lado de um pacote.
 *
 * Há duas coisas mantidas à parte aqui. O que um extra *custa* é o preço dele,
 * que é o que se cobra de cada vez. O que ele *custa hoje* é uma parte disso,
 * porque quem compra um a meio do mês paga meio mês dele. O que o cliente lê
 * diz sempre a qual dos dois se refere.
 *
 * «Não acrescenta nada ao servidor» é uma resposta a sério e é escrita em vez
 * de ficar em branco, porque apoio prioritário é uma coisa vulgar de vender e
 * uma célula vazia lê-se como um erro.
 */

return [
    'title' => 'Extras',
    'nav_label' => 'Extras',
    'subheading' => 'Coisas vendidas ao lado de um pacote: mais memória, mais um lugar de cópia de segurança, ou algo que é só uma linha na fatura.',

    // ---- a tabela ---------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Preço',
    'column_adds' => 'Acrescenta',
    'column_sold' => 'Em uso',
    'column_live' => 'À venda',
    'adds_nothing' => 'Nada no servidor',

    // ---- o formulário -----------------------------------------------------
    'section_what' => 'O que é',
    'section_what_helper' => 'O nome e o preço que o cliente vê, e com que pacotes pode ser comprado.',
    'name' => 'Nome',
    'price' => 'Preço',
    'price_helper' => 'O que custa de cada vez que é cobrado. Comprado a meio de um período, o cliente paga uma parte disto e o valor inteiro a partir da renovação seguinte.',
    'billing' => 'Cobrado',
    'billing_helper' => 'Com o serviço quer dizer que volta em cada renovação, enquanto o cliente o mantiver. Uma vez quer dizer que é cobrado na fatura que o leva pela primeira vez e nunca mais.',
    'billing_with' => 'Em cada renovação',
    'billing_once' => 'Uma vez',
    'max' => 'Máximo por serviço',
    'max_helper' => 'Quantos destes é que alguém pode ter. Um é o caso normal; aumente-o para algo vendido ao gigabyte.',
    'description' => 'Descrição',
    'description_helper' => 'Uma linha por baixo do nome na página de pagamento. Diga o que faz e não como se chama.',
    'packages' => 'Pacotes',
    'packages_helper' => 'Com que pacotes é que isto pode ser comprado. Nada marcado significa todos, que é o que uma opção de apoio ou um lugar de cópia de segurança costuma ser.',

    'section_adds' => 'O que acrescenta ao servidor',
    'section_adds_helper' => 'Isto soma-se ao que o pacote já dá, não fica no lugar dele: 4096 na memória torna o servidor 4 GiB maior. Dois extras iguais somam-se. Deixe tudo a zero para algo que é só uma linha na fatura. Um número negativo tira alguma coisa, o que é permitido e de vez em quando é mesmo o que se quer.',
    'sort' => 'Ordem',
    'sort_helper' => 'Menor vem primeiro na página de pagamento. Números iguais desempatam pelo preço.',
    'live' => 'À venda',
    'live_helper' => 'Desligado, não é oferecido em lado nenhum. Quem já o tem mantém-no e continua a pagá-lo.',

    // ---- os botões --------------------------------------------------------
    'new' => 'Novo extra',
    'edit' => 'Editar',
    'delete' => 'Eliminar',
    'delete_confirm' => 'Ninguém tem este. Eliminá-lo tira-o da lista de vez.',
    'delete_sold' => ':count serviço(s) têm este. Ficam com ele, ficam com os limites que lhes deu e continuam a pagá-lo - o que sai é a linha da lista, para que mais ninguém o possa comprar.',
    'go_live' => 'Pôr à venda',
    'go_offline' => 'Retirar de venda',
    'saved' => 'Guardado',
    'deleted' => 'Extra eliminado',
    'save_failed' => 'Não foi guardado',
    'save_failed_body' => 'Não ficou nada registado. Tente outra vez, e veja o registo se continuar a acontecer.',
    'invalid' => 'Um extra precisa de um nome e de um preço.',
    'empty' => 'Ainda sem extras',
    'empty_body' => 'Um extra é algo vendido ao lado de um pacote: mais um gigabyte, um segundo lugar de cópia de segurança, ou um serviço que não acrescenta nada ao servidor.',

    // ---- o que o cliente vê -----------------------------------------------
    'choose' => 'Extras',
    'choose_helper' => 'Opcionais, e podes acrescentá-los ou tirá-los mais tarde.',
    'yours' => 'Extras neste serviço',
    'add' => 'Acrescentar um extra',
    'add_helper' => 'Pagas agora o que falta deste período, e o preço inteiro a partir da renovação seguinte.',
    'add_to' => 'Acrescentar :name',
    'add_confirm' => 'Acrescentar :name a este serviço?',
    'drop' => 'Remover',
    'drop_confirm' => 'Remover :name? A parte que pagaste e não usaste volta para a tua conta, e o teu servidor muda logo a seguir.',
    'costs_now' => ':amount agora',
    'free_now' => 'Nada a pagar agora',
    'then' => 'depois :amount por renovação',
    'once_only' => ':amount, uma vez',
    'each' => 'cada',
    'added' => ':name acrescentado',
    'added_body' => 'O teu servidor já recebeu o que ele acrescenta.',
    'dropped' => ':name removido',
    'dropped_body' => 'O que tinhas pago e não chegaste a usar está na tua conta.',

    // ---- e quando não dá --------------------------------------------------
    'refused' => 'Não foi possível fazer isso',
    'refused_off' => 'Os extras estão desligados neste painel.',
    'refused_not_active' => 'Só um serviço a correr pode receber extras.',
    'refused_gone' => 'Esse extra já não está à venda.',
    'refused_wrong_package' => 'Esse extra não se vende com este pacote.',
    'refused_enough' => 'Já tens tantos desses quantos este serviço pode ter.',
    'refused_failed' => 'Não ficou nada registado, por isso nada mudou. Tenta outra vez, e diz a quem toma conta deste painel se continuar a acontecer.',
    'refused_server' => 'O servidor não aceitou os limites novos, por isso nada mudou e nada foi cobrado.',
    'refused_not_yours' => 'Esse extra não está neste serviço.',

    // ---- o que fica nos documentos ---------------------------------------
    'line' => ':name × :many, pelos :days dias que faltam deste período',
    'credit_reason' => 'Removido: :name',
    'bell_failed' => 'Não foi possível dar um extra ao servidor na encomenda :number',

    // ---- unidades, para a tabela de administração -------------------------
    'unit_memory' => 'MiB de memória',
    'unit_swap' => 'MiB de swap',
    'unit_disk' => 'MiB de disco',
    'unit_cpu' => '% de CPU',
    'unit_database_limit' => 'bases de dados',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'cópias de segurança',
];
