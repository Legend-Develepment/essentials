<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * Pacotes: um servidor que alguém pode comprar.
 *
 * Lido por quem monta a loja. Cada palavra aqui é sobre o modelo e o preço; o
 * que um cliente vê está em shop.php, porque os dois leitores querem frases
 * diferentes sobre a mesma linha.
 *
 * "egg", "node", "swap", "io" e as palavras do Minecraft ficam em inglês: são as
 * palavras do formulário de servidor do próprio Pelican, e um pacote é esse
 * formulário guardado para depois.
 */

return [
    'title' => 'Pacotes',
    'nav_label' => 'Pacotes',
    'subheading' => 'O que está à venda. Cada um é um modelo de servidor com um preço; um cliente compra um e o painel cria o servidor.',

    // ---- a tabela --------------------------------------------------------
    'column_name' => 'Pacote',
    'column_flags' => 'Selos',
    'column_flags_from' => 'a partir de :count',
    'column_egg' => 'Egg',
    'column_price' => 'Preço',
    'column_stock' => 'Estoque',
    'column_live' => 'À venda',
    'column_orders' => 'Vendidos',

    'live' => 'À venda',
    'offline' => 'Fora de venda',
    'no_egg' => 'Sem egg - não pode ser construído',

    'stock_unlimited' => 'Ilimitado',
    'stock_left' => 'Restam :count',
    'stock_out' => 'Esgotado',

    // ---- períodos --------------------------------------------------------
    'period_once' => 'Pagamento único',
    'period_month' => 'Mensal',
    'period_quarter' => 'Trimestral',
    'period_year' => 'Anual',

    // Depois de um preço: "R$ 12,50 por mês".
    'per_once' => 'uma vez',
    'per_month' => 'por mês',
    'per_quarter' => 'por trimestre',
    'per_year' => 'por ano',

    // ---- ações -----------------------------------------------------------
    'new' => 'Novo pacote',
    'edit' => 'Editar',
    'duplicate' => 'Duplicar',
    'copy_suffix' => ' (cópia)',
    'go_live' => 'Colocar à venda',
    'go_offline' => 'Tirar de venda',
    'delete' => 'Excluir',
    'delete_confirm' => 'Remove o pacote. O que já foi comprado não é tocado - os pedidos guardam a própria cópia do que eram.',
    'delete_confirm_sold' => 'Já foi vendido :count vezes. Esses serviços não são tocados: um pedido leva a própria cópia de tudo com que foi vendido, então os servidores continuam rodando e as faturas continuam dizendo o que foi comprado. Some apenas a imagem no cartão do serviço deles, e o pacote sai de venda.',
    'delete_refused' => 'Não excluído',
    'delete_refused_body' => 'Há pedidos feitos neste pacote, e eles apontam para ele. Tire-o de venda em vez disso; ele fica para os registros e ninguém pode comprá-lo.',
    'deleted' => 'Pacote excluído',
    'deleted_sold' => 'Os :count serviços vendidos a partir dele ficam intactos e continuam rodando.',
    'saved' => 'Pacote salvo',
    'save_failed' => 'Não foi possível salvar o pacote',
    'price_invalid' => 'Isso não é um valor. Escreva como 12.50 ou 12,50.',

    // ---- o formulário: o que é -------------------------------------------
    'section_basics' => 'O pacote',
    'section_basics_helper' => 'O que um cliente vê no cartão.',
    'name' => 'Nome',
    'name_helper' => 'Como ele se chama na loja.',
    'slug' => 'Endereço',
    'slug_helper' => 'Minúsculas, números e hifens. Deixado vazio, é feito a partir do nome. Mudar depois quebra um link que alguém salvou.',
    'description' => 'Descrição',
    'description_helper' => 'Algumas linhas abaixo do nome. Texto simples.',
    'live_field' => 'À venda',
    'live_helper' => 'Desligado mantém o pacote aqui e não o mostra a ninguém. Um pacote sem egg nunca é mostrado, diga isto o que disser.',
    'sort' => 'Ordem',
    'sort_helper' => 'Menor vem primeiro na loja.',

    // ---- o formulário: no que ele vira -----------------------------------
    'section_server' => 'O servidor que ele vira',
    'section_server_helper' => 'As mesmas perguntas que o Pelican faz quando você cria um servidor à mão, respondidas uma vez aqui e usadas em cada venda.',
    'egg' => 'Egg',
    'egg_helper' => 'Escolher um preenche a imagem, o comando de inicialização e cada variável com os padrões do egg. Mude o que quiser depois.',
    'image' => 'Imagem Docker',
    'image_helper' => 'Uma das imagens que o egg oferece.',
    'image_default' => 'A primeira imagem do egg',
    'startup' => 'Comando de inicialização',
    'startup_helper' => 'Um dos comandos que o egg oferece.',
    'startup_default' => 'O primeiro comando do egg',
    'environment' => 'Variáveis',
    'environment_helper' => 'As variáveis do egg e o valor de cada uma. Tudo o que o egg tem e não está aqui usa o padrão quando o servidor é criado.',
    'env_key' => 'Variável',
    'env_value' => 'Valor',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Onde um servidor deste pacote pode ser criado, tentados nesta ordem até um ter um endereço livre. Nada marcado significa qualquer node.',
    'upgrade_to' => 'Pode ser trocado por',
    'upgrade_to_helper' => 'Para quais pacotes um serviço ativo neste aqui pode ser movido, para cima ou para baixo. Só aparecem os pacotes que usam o mesmo egg, porque um egg diferente é outro servidor e não um servidor maior. Nada marcado significa que não dá para sair deste pacote.',
    'upgrade_to_none' => 'Nenhum outro pacote usa este egg ainda.',

    // ---- o formulário: limites -------------------------------------------
    'section_limits' => 'Limites',
    'section_limits_helper' => 'O que o servidor recebe. Os mesmos campos do formulário de servidor do Pelican, nas mesmas unidades.',
    'memory' => 'Memória',
    'disk' => 'Disco',
    'cpu' => 'CPU',
    'cpu_helper' => 'Porcentagem de um núcleo: 100 é um núcleo, 200 são dois, 0 é sem limite.',
    'swap' => 'Swap',
    'swap_helper' => '0 é nenhum, -1 é ilimitado.',
    'io' => 'Peso de IO de bloco',
    'io_helper' => 'O padrão do Pelican é 500. Deixe assim a menos que saiba por que não.',
    'threads' => 'Fixação de CPU',
    'threads_helper' => 'Quais núcleos, como o Pelican escreve: 0,1 ou 0-3. Vazio é qualquer um.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Se o kernel pode encerrar o servidor quando fica sem memória.',
    'databases' => 'Bancos de dados',
    'allocations' => 'Allocations extras',
    'backups' => 'Backups',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- o formulário: o dinheiro ----------------------------------------
    'section_price' => 'Preço e estoque',
    'section_price_helper' => 'Na moeda da loja, definida na página Configurações da loja. Sem imposto - o imposto é acrescentado na fatura como linha própria.',
    'price' => 'Preço',
    'price_helper' => 'Por período. Escreva como 12.50 ou 12,50.',
    'setup_fee' => 'Taxa de instalação',
    'setup_fee_helper' => 'Cobrada uma vez, na primeira fatura. Zero para nenhuma.',
    'period' => 'Cobrado',
    'period_helper' => 'Pagamento único é pago uma vez e mantido. Os outros recebem uma fatura nova a cada período; uma não paga suspende o servidor após o período de carência da página Configurações da loja.',
    'stock' => 'Estoque',
    'stock_helper' => 'Quantos podem estar vendidos ao mesmo tempo, contando cada pedido não cancelado. Vazio é ilimitado.',
    'term' => 'Prazo mínimo',
    'term_helper' => 'Por quanto tempo alguém fica comprometido depois de comprar. Zero é sem compromisso: ele pode cancelar e acaba no fim do período que já pagou.',
    'term_unit' => 'Contado em',
    'term_unit_helper' => 'Dias, meses ou anos. Um pedido cancelado corre até o fim deste prazo e o servidor é excluído nesse dia.',
    'unit_day' => 'Dias',
    'unit_month' => 'Meses',
    'unit_year' => 'Anos',
    'term_day' => 'Prazo mínimo: :count dias',
    'term_month' => 'Prazo mínimo: :count meses',
    'term_year' => 'Prazo mínimo: :count anos',
    'section_art' => 'Imagem',
    'section_art_helper' => 'A imagem no cartão do pacote, na loja e nos serviços de um cliente. Deixe os dois vazios e é usada a própria imagem do egg, que a maioria dos pacotes já tem.',
    'art_file' => 'Enviar uma imagem',
    'art_file_helper' => 'Larga em vez de alta: o cartão corta para 16:9. Até 8 MB.',
    'art_url' => 'Ou um endereço de imagem',
    'art_url_helper' => 'Um endereço https completo. Usado quando nada é enviado acima.',

    'empty' => 'Ainda não há pacotes',
    'section_ask' => 'Perguntar ao cliente',
    'section_ask_helper' => 'Perguntas colocadas no pagamento, respondidas antes de o pedido ser feito. As respostas chegam ao servidor quando ele é criado.',
    'ask_vars' => 'Variáveis a perguntar',
    'ask_vars_helper' => 'As variáveis do próprio egg. Marque uma e o cliente a preenche enquanto compra, e a resposta dele é usada no lugar do valor deste pacote. Deixe tudo desmarcado e não se pergunta nada a ninguém.',
    'upload_ask' => 'Pedir um arquivo',
    'upload_ask_helper' => 'Um zip que o cliente envia enquanto compra - um mundo, um modpack, um conjunto de configurações. Ele é colocado no servidor dele quando o servidor é criado, antes de avisarem que está pronto.',
    'upload_label' => 'Como chamar isso',
    'upload_label_helper' => 'A etiqueta acima da caixa do arquivo, com suas próprias palavras. Vazia usa uma simples.',
    'upload_dir' => 'Onde dentro do servidor',
    'upload_dir_helper' => 'Um caminho dentro do servidor, como / ou /world. Ele é tornado seguro antes de ser usado.',
    'upload_extract' => 'Descompactar',
    'upload_extract_helper' => 'Ligado, o zip é descompactado onde cai e o próprio compactado é removido - o certo para um mundo ou um conjunto de configurações. Desligado, o zip fica como arquivo, que é o que quer um egg que instala um modpack a partir de um.',
    'empty_body' => 'Crie um e ele aparece na loja assim que for colocado à venda.',
    'popular' => 'Aponte para este',
    'popular_helper' => 'Marca este como o que a maioria escolhe. Ele sobe na loja, abaixo do que estiver em promoção, e ganha um selo pequeno. Não é uma afirmação sobre números de venda - é o lojista apontando.',
    'offer' => 'Em promoção',
    'offer_helper' => 'Leva o pacote para a frente da loja com um selo nele, e tira do preço dele o desconto abaixo.',
    'offer_kind' => 'Desconto como',
    'offer_percent' => 'Uma porcentagem',
    'offer_amount' => 'Um valor',
    'offer_value' => 'Quanto tirar',
    'offer_value_percent' => 'Uma porcentagem do preço, então 20 significa um quinto a menos.',
    'offer_value_amount' => 'Um valor na moeda da loja, então 2,50 significa dois e cinquenta a menos.',
    'offer_min' => 'Só a partir desta quantidade de itens',
    'offer_min_helper' => 'Quão cheio o carrinho precisa estar antes de o desconto valer, contando tudo o que está nele e não só este pacote. Zero ou um significa que vale sempre. Dois é um motivo para colocar uma segunda coisa.',
];
