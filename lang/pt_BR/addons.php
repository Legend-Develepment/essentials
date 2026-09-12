<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Extras vendidos junto com um pacote.
 *
 * Duas coisas são mantidas separadas aqui. Quanto um extra *custa* é o preço
 * dele, que é o que é cobrado toda vez. Quanto ele *custa hoje* é uma parte
 * disso, porque quem compra um no meio do mês paga meio mês dele. O texto que o
 * cliente lê sempre diz qual dos dois está falando.
 *
 * «Não acrescenta nada ao servidor» é uma resposta de verdade e é dita com
 * todas as letras em vez de ficar em branco, porque atendimento prioritário é
 * uma coisa comum de se vender e uma célula vazia parece um erro.
 */

return [
    'title' => 'Extras',
    'nav_label' => 'Extras',
    'subheading' => 'Coisas vendidas junto com um pacote: mais memória, mais um slot de backup, ou algo que é só uma linha na fatura.',

    // ---- a tabela ---------------------------------------------------------
    'column_name' => 'Extra',
    'column_price' => 'Preço',
    'column_adds' => 'Acrescenta',
    'column_sold' => 'Em uso',
    'column_live' => 'À venda',
    'adds_nothing' => 'Nada no servidor',

    // ---- o formulário -----------------------------------------------------
    'section_what' => 'O que ele é',
    'section_what_helper' => 'O nome e o preço que o cliente vê, e com quais pacotes ele pode ser comprado.',
    'name' => 'Nome',
    'price' => 'Preço',
    'price_helper' => 'Quanto ele custa cada vez que é cobrado. Comprado no meio de um período, o cliente paga uma parte disto e o valor inteiro a partir da próxima renovação.',
    'billing' => 'Cobrado',
    'billing_helper' => 'Com o serviço significa que ele volta a cada renovação, enquanto o cliente mantiver. Uma vez significa que ele é cobrado na fatura que o traz pela primeira vez e nunca mais.',
    'billing_with' => 'A cada renovação',
    'billing_once' => 'Uma vez',
    'max' => 'No máximo por serviço',
    'max_helper' => 'Quantos deste alguém pode ter. Um é o caso comum; aumente para algo vendido por gigabyte.',
    'description' => 'Descrição',
    'description_helper' => 'Uma linha abaixo do nome na hora de pagar. Diga o que ele faz em vez de como ele se chama.',
    'packages' => 'Pacotes',
    'packages_helper' => 'Com quais pacotes isto pode ser comprado. Nada marcado significa todos eles, que é o que uma opção de atendimento ou um slot de backup costuma ser.',

    'section_adds' => 'O que ele acrescenta ao servidor',
    'section_adds_helper' => 'Isto é somado ao que o pacote já dá, não colocado no lugar: 4096 em memória deixa o servidor 4 GiB maior. Dois extras iguais se somam. Deixe tudo em zero para algo que é só uma linha na fatura. Um número negativo tira alguma coisa, o que é permitido e de vez em quando é justamente o que alguém quer.',
    'sort' => 'Ordem',
    'sort_helper' => 'Menor vem primeiro na hora de pagar. Números iguais desempatam pelo preço.',
    'live' => 'À venda',
    'live_helper' => 'Desligado, ele não é oferecido em lugar nenhum. Quem já tem continua com ele e continua sendo cobrado por ele.',

    // ---- os botões --------------------------------------------------------
    'new' => 'Novo extra',
    'edit' => 'Editar',
    'delete' => 'Excluir',
    'delete_confirm' => 'Ninguém tem este. Excluir tira ele da lista de vez.',
    'delete_sold' => ':count serviço(s) têm este extra. Eles continuam com ele, continuam com os limites que ele deu e continuam sendo cobrados por ele - o que sai é a entrada na lista, para que ninguém novo possa comprar.',
    'go_live' => 'Colocar à venda',
    'go_offline' => 'Tirar de venda',
    'saved' => 'Salvo',
    'deleted' => 'O extra foi excluído',
    'save_failed' => 'Não foi salvo',
    'save_failed_body' => 'Nada foi gravado. Tente de novo, e olhe o log se continuar acontecendo.',
    'invalid' => 'Um extra precisa de um nome e de um preço.',
    'empty' => 'Ainda não há extras',
    'empty_body' => 'Um extra é algo vendido ao lado de um pacote: mais um gigabyte, um segundo slot de backup, ou um serviço que não acrescenta nada ao servidor.',

    // ---- o que o cliente vê -----------------------------------------------
    'choose' => 'Extras',
    'choose_helper' => 'São opcionais, e você pode adicionar ou tirar depois.',
    'yours' => 'Extras neste serviço',
    'add' => 'Adicionar um extra',
    'add_helper' => 'Você paga agora o que falta deste período, e o preço inteiro a partir da próxima renovação.',
    'add_to' => 'Adicionar :name',
    'add_confirm' => 'Adicionar :name a este serviço?',
    'drop' => 'Remover',
    'drop_confirm' => 'Remover :name? A parte não usada do que você pagou volta para a sua conta, e seu servidor muda na hora.',
    'costs_now' => ':amount agora',
    'free_now' => 'Nada a pagar agora',
    'then' => 'depois :amount por renovação',
    'once_only' => ':amount, uma vez',
    'each' => 'cada',
    'added' => ':name adicionado',
    'added_body' => 'Seu servidor já recebeu o que ele acrescenta.',
    'dropped' => ':name removido',
    'dropped_body' => 'Tudo o que você tinha pago e não usou está na sua conta.',

    // ---- e quando não dá --------------------------------------------------
    'refused' => 'Não foi possível fazer isso',
    'refused_off' => 'Os extras estão desligados neste painel.',
    'refused_not_active' => 'Só um serviço rodando pode receber extras.',
    'refused_gone' => 'Esse extra não está mais à venda.',
    'refused_wrong_package' => 'Esse extra não é vendido com este pacote.',
    'refused_enough' => 'Você já tem tantos desses quanto este serviço pode ter.',
    'refused_failed' => 'Nada foi registrado, então nada mudou. Tente de novo, e avise quem administra este painel se continuar acontecendo.',
    'refused_server' => 'O servidor não aceitou os novos limites, então nada foi mudado e nada foi cobrado.',
    'refused_not_yours' => 'Esse extra não está neste serviço.',

    // ---- o que os documentos dizem ----------------------------------------
    'line' => ':name × :many, pelos :days dias que faltam deste período',
    'credit_reason' => 'Removido: :name',
    'bell_failed' => 'Não foi possível dar um extra ao servidor no pedido :number',

    // ---- unidades, para a tabela do administrador -------------------------
    'unit_memory' => 'MiB de memória',
    'unit_swap' => 'MiB de swap',
    'unit_disk' => 'MiB de disco',
    'unit_cpu' => '% de CPU',
    'unit_database_limit' => 'bancos de dados',
    'unit_allocation_limit' => 'allocations',
    'unit_backup_limit' => 'backups',
];
