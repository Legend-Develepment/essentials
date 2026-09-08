<?php

/*
 * Português. Escrito à mão.
 *
 * Pacotes: um servidor que alguém pode comprar.
 *
 * Lido por quem monta a loja. Cada palavra aqui é sobre o modelo e o preço; o
 * que um cliente vê está em shop.php, porque os dois leitores querem frases
 * diferentes sobre a mesma linha.
 *
 * «egg», «node», «swap», «io» e as palavras do Minecraft ficam em inglês: são as
 * palavras do formulário de servidor do próprio Pelican, e um pacote é esse
 * formulário guardado para mais tarde.
 */

return [
    'title' => 'Pacotes',
    'nav_label' => 'Pacotes',
    'subheading' => 'O que está à venda. Cada um é um modelo de servidor com um preço; um cliente compra um e o painel cria o servidor.',

    // ---- a tabela --------------------------------------------------------
    'column_name' => 'Pacote',
    'column_egg' => 'Egg',
    'column_price' => 'Preço',
    'column_stock' => 'Stock',
    'column_live' => 'À venda',
    'column_orders' => 'Vendidos',

    'live' => 'À venda',
    'offline' => 'Fora de venda',
    'no_egg' => 'Sem egg — não pode ser construído',

    'stock_unlimited' => 'Ilimitado',
    'stock_left' => 'Restam :count',
    'stock_out' => 'Esgotado',

    // ---- períodos --------------------------------------------------------
    'period_once' => 'Pagamento único',
    'period_month' => 'Mensal',
    'period_quarter' => 'Trimestral',
    'period_year' => 'Anual',

    // A seguir a um preço: «12,50 € por mês».
    'per_once' => 'uma vez',
    'per_month' => 'por mês',
    'per_quarter' => 'por trimestre',
    'per_year' => 'por ano',

    // ---- ações -----------------------------------------------------------
    'new' => 'Novo pacote',
    'edit' => 'Editar',
    'duplicate' => 'Duplicar',
    'copy_suffix' => ' (cópia)',
    'go_live' => 'Pôr à venda',
    'go_offline' => 'Retirar de venda',
    'delete' => 'Eliminar',
    'delete_confirm' => 'Remove o pacote. O que já foi comprado não é tocado — as encomendas guardam a sua própria cópia do que eram.',
    'delete_refused' => 'Não eliminado',
    'delete_refused_body' => 'Foram feitas encomendas sobre este pacote, e apontam para ele. Retire-o de venda em vez disso; fica para os registos e ninguém o pode comprar.',
    'deleted' => 'Pacote eliminado',
    'saved' => 'Pacote guardado',
    'save_failed' => 'Não foi possível guardar o pacote',
    'price_invalid' => 'Isso não é um montante. Escreva-o como 12.50 ou 12,50.',

    // ---- o formulário: o que é -------------------------------------------
    'section_basics' => 'O pacote',
    'section_basics_helper' => 'O que um cliente vê no cartão.',
    'name' => 'Nome',
    'name_helper' => 'Como se chama na loja.',
    'slug' => 'Endereço',
    'slug_helper' => 'Minúsculas, algarismos e hífens. Deixado vazio é feito a partir do nome. Mudá-lo depois quebra uma ligação que alguém guardou.',
    'description' => 'Descrição',
    'description_helper' => 'Algumas linhas por baixo do nome. Texto simples.',
    'live_field' => 'À venda',
    'live_helper' => 'Desligado mantém o pacote aqui e não o mostra a ninguém. Um pacote sem egg nunca é mostrado, diga isto o que disser.',
    'sort' => 'Ordem',
    'sort_helper' => 'Menor vem primeiro na loja.',

    // ---- o formulário: no que se torna -----------------------------------
    'section_server' => 'O servidor em que se torna',
    'section_server_helper' => 'As mesmas perguntas que o Pelican faz quando cria um servidor à mão, respondidas uma vez aqui e usadas em cada venda.',
    'egg' => 'Egg',
    'egg_helper' => 'Escolher um preenche a imagem, o comando de arranque e cada variável com as predefinições do egg. Mude o que quiser depois.',
    'image' => 'Imagem Docker',
    'image_helper' => 'Uma das imagens que o egg oferece.',
    'image_default' => 'A primeira imagem do egg',
    'startup' => 'Comando de arranque',
    'startup_helper' => 'Um dos comandos que o egg oferece.',
    'startup_default' => 'O primeiro comando do egg',
    'environment' => 'Variáveis',
    'environment_helper' => 'As variáveis do egg e o seu valor. Tudo o que o egg tem e não está aqui toma a predefinição quando o servidor é criado.',
    'env_key' => 'Variável',
    'env_value' => 'Valor',
    'nodes' => 'Nodes',
    'nodes_helper' => 'Onde um servidor deste pacote pode ser criado, tentadas por esta ordem até uma ter um endereço livre. Nada marcado significa qualquer node.',

    // ---- o formulário: limites -------------------------------------------
    'section_limits' => 'Limites',
    'section_limits_helper' => 'O que o servidor recebe. Os mesmos campos do formulário de servidor do Pelican, nas mesmas unidades.',
    'memory' => 'Memória',
    'disk' => 'Disco',
    'cpu' => 'CPU',
    'cpu_helper' => 'Percentagem de um núcleo: 100 é um núcleo, 200 são dois, 0 é sem limite.',
    'swap' => 'Swap',
    'swap_helper' => '0 é nenhum, -1 é ilimitado.',
    'io' => 'Peso de IO de bloco',
    'io_helper' => 'A predefinição do Pelican é 500. Deixe-a aí a menos que saiba porque não.',
    'threads' => 'Fixação de CPU',
    'threads_helper' => 'Que núcleos, como o Pelican os escreve: 0,1 ou 0-3. Vazio é qualquer um.',
    'oom_killer' => 'OOM killer',
    'oom_killer_helper' => 'Se o kernel pode terminar o servidor quando fica sem memória.',
    'databases' => 'Bases de dados',
    'allocations' => 'Allocations extra',
    'backups' => 'Cópias de segurança',
    'unit_mib' => 'MiB',
    'unit_percent' => '%',

    // ---- o formulário: o dinheiro ----------------------------------------
    'section_price' => 'Preço e stock',
    'section_price_helper' => 'Na moeda da loja, definida na página Definições da loja. Sem imposto — o imposto é acrescentado na fatura como linha própria.',
    'price' => 'Preço',
    'price_helper' => 'Por período. Escreva-o como 12.50 ou 12,50.',
    'setup_fee' => 'Taxa de instalação',
    'setup_fee_helper' => 'Cobrada uma vez, na primeira fatura. Zero para nenhuma.',
    'period' => 'Faturado',
    'period_helper' => 'Pagamento único paga-se uma vez e fica. Os outros recebem uma fatura nova a cada período; uma por pagar suspende o servidor após o período de tolerância da página Definições da loja.',
    'stock' => 'Stock',
    'stock_helper' => 'Quantos podem estar vendidos ao mesmo tempo, contando cada encomenda não cancelada. Vazio é ilimitado.',
    'term' => 'Período mínimo',
    'term_helper' => 'Por quanto tempo alguém fica comprometido depois de comprar. Zero é sem compromisso: pode cancelar e acaba no fim do período que já pagou.',
    'term_unit' => 'Contado em',
    'term_unit_helper' => 'Dias, meses ou anos. Uma encomenda cancelada corre até ao fim deste período e o servidor é apagado nesse dia.',
    'unit_day' => 'Dias',
    'unit_month' => 'Meses',
    'unit_year' => 'Anos',
    'term_day' => 'Período mínimo: :count dias',
    'term_month' => 'Período mínimo: :count meses',
    'term_year' => 'Período mínimo: :count anos',
    'section_art' => 'Imagem',
    'section_art_helper' => 'A imagem no cartão do pacote, na loja e nos serviços de um cliente. Deixe ambos vazios e é usada a imagem do próprio egg, que a maioria dos pacotes já tem.',
    'art_file' => 'Carregar uma imagem',
    'art_file_helper' => 'Antes larga do que alta: o cartão corta-a para 16:9. Até 8 MB.',
    'art_url' => 'Ou o endereço de uma imagem',
    'art_url_helper' => 'Um endereço https completo. Usado quando não há nada carregado acima.',

    'empty' => 'Ainda sem pacotes',
    'empty_body' => 'Crie um e aparece na loja assim que for posto à venda.',
];
