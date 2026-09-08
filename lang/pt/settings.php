<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Egg», «nó», «subuser», «Wings», «queue», «webhook», «topbar», «cron» e os
 * formatos de ficheiro ficam como estão: são as palavras que se encontram no
 * próprio Pelican, no anfitrião e em tudo o que se escreve sobre eles. Os nomes
 * dos estilos também não são traduzidos — um estilo chama-se aquilo que se
 * chama, e um nome traduzido seria um segundo nome para a mesma coisa.
 */

return [
    'css_warning' => 'Guardado, mas este CSS parece errado',
    'css_unclosed' => 'Uma regra aberta na linha :line nunca é fechada. Tudo o que vem depois está dentro dessa regra e não se aplica.',
    'css_extra' => 'Há uma chaveta de fecho na linha :line sem nada aberto. Tudo o que vem depois fica fora de qualquer regra e é ignorado.',
    'css_comment' => 'Um comentário aberto na linha :line nunca é fechado, por isso o resto do ficheiro está lá dentro.',

    'groups' => [
        'appearance' => 'Aparência',
        'servers' => 'Lista de servidores',
        'windows' => 'Estilos por horário',
        'windows_helper' => 'Um estilo diferente entre duas horas do dia. Não acontece nada enquanto não acrescentar um. O relógio é o do próprio painel, da definição de fuso horário dele, e não o de cada leitor — um painel que parecesse diferente a duas pessoas no mesmo momento pareceria avariado e não agendado. Uma janela muda o aspeto que o painel já tem, por isso não faz nada enquanto o estilo estiver em «Nenhum». Um estilo que alguém tenha escolhido para si continua a ganhar.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Idiomas',
        'servers_helper' => 'Como é desenhado um cartão de servidor. Se aparecem em grelha ou em lista é a escolha de cada um, em Conta → Disposição do painel principal.',
        'server_pages' => 'Páginas de servidor',
        'server_pages_helper' => 'O que cada página dentro de um servidor leva, seja ela qual for.',
        'console' => 'Página da consola',
        'console_helper' => 'O tipo de letra do terminal, o tamanho e a altura são a escolha de cada um, em Conta.',
        'background' => 'Fundo',
        'background_helper' => 'Aplica-se a todo o painel, incluindo o ecrã de entrada.',
        'icons' => 'Ícones',
        'bars' => 'Medidores de recursos',
        'bars_helper' => 'As barras de processador, memória e disco nos cartões de servidor.',
        'updates' => 'Atualizações',
        'updates_helper' => 'Que versões a página do tema oferece, e onde as procura.',
        'brand' => 'Marca',
        'login' => 'Ecrã de entrada',
        'login_helper' => 'Aplica-se aos ecrãs de entrada, de reposição de palavra-passe e de dois fatores.',
        'advanced' => 'CSS próprio',
        'advanced_helper' => 'Para tudo o que as definições acima não cobrem. É carregado depois de tudo o resto, por isso ganha.',
        'areas' => 'Por área',
        'areas_helper' => 'Tudo o que está acima aplica-se em todo o lado. Aqui pode pôr uma área à parte; o que deixar vazio continua a seguir a definição geral.',
        'footer' => 'Rodapé da barra lateral',
        'footer_helper' => 'O fundo da barra lateral, que o Pelican deixa vazio. Tudo isto está desligado até o preencher.',
        'features' => 'O que este plugin acrescenta',
        'features_helper' => 'Desmarcar uma coisa retira-a do painel por completo. As definições dela são mantidas e a página dela mantém o endereço, por isso não se perde nada por desligar algo para ver o que fazia. A maioria tem também uma permissão própria em Funções, para entregar uma sem entregar o resto. Não todas: os medidores de recursos, o rodapé da barra lateral e a pesquisa de definições são desenhados para toda a gente e não são administrados por ninguém, a estrela num cartão de servidor pertence a quem lhe clicou, e as páginas de Palworld e Minecraft dentro de um servidor seguem as permissões desse servidor e não uma destas. O estilo em si não está nesta lista — tem um interruptor próprio, em Aspeto → Aparência → Estilo → Nenhum.',
        'identity' => 'Este plugin na barra lateral',
        'identity_helper' => 'A entrada que este plugin acrescenta à barra lateral, e a imagem que leva.',
    ],

    /*
     * As páginas de definições, cada uma uma entrada do grupo próprio do plugin
     * na barra lateral. Agrupadas pela pergunta a que se responde e não pela
     * classe que as implementa.
     */
    'pages' => [
        'look' => 'Aspeto',
        'look_helper' => 'A cor, a forma e como o painel se chama.',
        'pages' => 'Páginas',
        'pages_helper' => 'A lista de servidores, as páginas de dentro de um servidor, e o terminal.',
        'advanced' => 'Avançado',
        'advanced_helper' => 'As duas saídas de emergência: o seu próprio CSS, e as definições que só valem para uma área.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Que eggs são Minecraft, e tudo o resto sobre isso.',
        'artwork' => 'Imagens dos eggs',
        'artwork_helper' => 'Uma página com todos os eggs, e uma maneira de obter a imagem do jogo na Steam ou no IGDB. Escreve nos próprios eggs — a imagem, e duas etiquetas que registam de que jogo se trata e se a imagem foi escolhida à mão — e por isso leva uma permissão própria.',
        'alerts' => 'Alertas',
        'alerts_helper' => 'Uma verificação periódica das coisas que o painel já mede mas não conta a ninguém: um nó que deixa de responder, um disco a encher, um queue worker que parou, uma versão a ficar para trás. Envia para o Discord, para o painel, ou por e-mail. Permissão própria, porque chega a todos os nós periodicamente e publica para um endereço que alguém escreveu.',
        'backups' => 'Resumo das cópias',
        'backups_helper' => 'Uma página com todos os servidores e o tempo que levam sem uma cópia, ordenada para que os que não têm nenhuma fiquem no topo. Só de leitura — tudo o que age sobre uma cópia fica na página do Pelican desse servidor. Permissão própria, porque a lista é um mapa de onde estão os buracos.',
        'public_status' => 'Página de estado pública',
        'public_status_helper' => 'Uma página que qualquer pessoa pode abrir sem conta, a mostrar quais dos seus servidores estão a correr e quanta gente está neles. Não é publicado nada enquanto não nomear um servidor, uma máquina ou um serviço — as três listas começam vazias, e enquanto estiverem o endereço responde 404. Permissão própria, porque decide o que sai do painel.',
        'game_players' => 'Jogadores, outros jogos',
        'capacity' => 'Capacidade',
        'capacity_helper' => 'O que foi prometido em cada máquina face ao que ela pode distribuir, para ver se cabe mais um servidor. A lista de nós do Pelican mostra um nome e um número de servidores, e o bloco Máquinas do painel principal mostra o que está a correr - esta é a terceira pergunta, e a conta é a do próprio Pelican. Só de leitura. Permissão própria.',
        'schedules' => 'Tarefas agendadas',
        'schedules_helper' => 'Todas as tarefas agendadas do painel com quais delas pararam: presas a meio de uma execução, atrasadas porque o cron não está a correr, ou nunca executadas. O Pelican mostra as tarefas dentro de cada servidor e o estado dele não tem palavra para nenhum desses casos. Só de leitura. Permissão própria.',
        'activity' => 'Atividade',
        'activity_helper' => 'Todos os eventos que o painel regista, numa lista em vez de um servidor de cada vez. O Pelican mantém o registo e mostra-o por servidor; isto pergunta ao mesmo registo ao contrário. Só de leitura. Permissão própria, porque um registo de quem fez o quê é algo que se entrega de propósito.',
        'access' => 'Acesso a servidores',
        'access_helper' => 'Ligar uma função a servidores, para que todos os que a tiverem consigam alcançá-los. Funciona mantendo atualizados os subusers do próprio Pelican, que é o que a lista de servidores e todas as verificações de permissões já leem. Permissão própria, porque é a única página daqui que dá acesso a coisas.',
        'games' => 'Outros jogos',
        'games_helper' => 'Os ficheiros que o ARK e o Valheim guardam ao lado do mundo, como formulários: as definições de mundo do ARK, e as listas de admins, banidos e permitidos do Valheim. Que servidores as recebem é a lista de eggs dessa página, por isso uma lista vazia já é um interruptor por jogo.',
        'game_players_helper' => 'Uma página dentro do Rust, do ARK, do Valheim e de tudo o que responda à consulta da Valve, a mostrar quem está ligado e há quanto tempo. Só de leitura — o que se pode fazer a alguém muda de jogo para jogo, e isso é uma versão à parte. Que eggs contam é a mesma lista que a página de estado usa.',
        'api' => 'API',
        'api_helper' => 'As chaves que as pessoas têm, quem pediu uma, e o que cada uma delas pode ver.',
        'languages' => 'Idiomas',
        'languages_helper' => 'Em que idiomas este plugin responde.',
    ],

    'features' => [
        'look' => 'Definições de aspeto',
        'look_helper' => 'A entrada da barra lateral para cor, forma e marca.',
        'pages' => 'Definições de páginas',
        'pages_helper' => 'A entrada da barra lateral para a lista de servidores, as páginas de servidor e o terminal.',
        'advanced' => 'Definições avançadas',
        'advanced_helper' => 'A entrada da barra lateral para o seu próprio CSS e as exceções por área.',
        'announcements' => 'Anúncios',
        'announcements_helper' => 'A faixa no topo do painel.',
        'nav_links' => 'Ligações de navegação',
        'nav_links_helper' => 'As suas próprias entradas na barra lateral.',
        'login' => 'Ecrã de entrada',
        'login_helper' => 'A imagem, o aviso e as ligações do ecrã de entrada.',
        'bars' => 'Medidores de recursos',
        'bars_helper' => 'As barras recoloridas de processador, memória e disco.',
        'dashboard_status' => 'Linha da versão',
        'dashboard_status_helper' => 'O topo do bloco do painel principal: que versão está instalada e se há outra à espera.',
        'dashboard_nodes' => 'Máquinas',
        'dashboard_nodes_helper' => 'O resto do bloco do painel principal: este painel e cada nó, com o que cada um está a usar.',
        'system_status' => 'Página de estado do sistema',
        'system_status_helper' => 'A página da máquina onde o próprio painel corre.',
        'sidebar_footer' => 'Rodapé da barra lateral',
        'sidebar_footer_helper' => 'A sua linha de texto, a versão do painel e uma ligação, no fundo da barra lateral.',
        'api' => 'API',
        'api_helper' => 'Uma entrada de fora do painel: um endereço a que um bot do Discord ou um script seu pode perguntar o que este plugin sabe — quem está a jogar, que servidores não têm cópia de segurança, se cabe mais um num nó. Desligado não regista rota nenhuma em vez de uma que recusa, o que é menos superfície em vez de uma quantidade mais educada dela. Qualquer pessoa com sessão iniciada pode pedir uma chave que só responde pelos seus próprios servidores; conceder uma, recusar uma, revogar uma que outra pessoa tenha e emitir uma para o painel inteiro exigem todas a permissão.',
        'languages' => 'Idiomas',
        'languages_helper' => 'Responder a cada um no idioma que a conta dele tiver definido, onde este plugin estiver traduzido. Com isto desligado, toda a gente recebe inglês.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Um separador Minecraft na barra lateral, e uma página dentro de cada servidor Minecraft para editar o server.properties dele como formulário. Que eggs contam é você que diz.',
        'palworld' => 'Definições do Palworld',
        'palworld_helper' => 'Uma página dentro de um servidor Palworld para editar as definições de mundo dele. Não aparece em nenhum outro servidor, nem nunca enquanto esse servidor estiver a correr.',
        'settings_search' => 'Pesquisa de definições',
        'settings_search_helper' => 'O campo por cima destes formulários que os reduz às secções que contêm o que escrever.',
        'preview' => 'Pré-visualização ao vivo',
        'preview_helper' => 'A caixa ao lado do formulário de Aspeto que mostra o que as cores, os cantos e os espaçamentos fazem antes de os guardar.',
        'duplicate' => 'Duplicar servidor',
        'duplicate_helper' => 'Uma página para montar outro servidor exatamente como um que já tem, ou vários de uma vez. Os ficheiros nunca são copiados.',
        'favourites' => 'Servidores marcados',
        'favourites_helper' => 'Uma estrela em cada cartão de servidor. Os marcados vêm primeiro, e a lista de cada um fica guardada no painel — por isso as estrelas seguem-no para onde quer que inicie sessão a seguir. Muda o que ele vê e nada para os outros. Estar no painel quer dizer que é um ficheiro em storage, que qualquer pessoa com acesso à máquina pode ler.',
        'artwork' => 'Imagens dos eggs',
        'artwork_helper' => 'A página de administração que obtém a imagem de cada egg na Steam ou no IGDB e a escreve no próprio egg.',
        'alerts' => 'Alertas',
        'alerts_helper' => 'A verificação periódica de um nó que deixou de responder, de um disco a encher, de um queue worker morto ou de uma versão a ficar para trás, e a mensagem de Discord, de painel ou de e-mail que envia.',
        'backups' => 'Resumo das cópias',
        'backups_helper' => 'A página de administração que lista todos os servidores pelo tempo que levam sem uma cópia. Só de leitura.',
        'public_status' => 'Página de estado pública',
        'public_status_helper' => 'A página que qualquer pessoa pode abrir sem conta. Com isto desligado, o endereço responde 404 haja o que houver na lista.',
        'game_players' => 'Jogadores, outros jogos',
        'game_players_helper' => 'Uma página dentro do Rust, do ARK, do Valheim e de tudo o que responda à consulta da Valve, a mostrar quem está ligado e há quanto tempo.',
        'owner_alerts' => 'Avisar as pessoas de que o servidor delas está offline',
        'owner_alerts_helper' => 'A única parte deste plugin que escreve a pessoas que não são administradoras: uma notificação no painel quando a máquina de um dos servidores delas deixa de responder, e outra quando ela volta. Desligado até ser ligado aqui e na página de Alertas, nas duas - escreve aos seus clientes, por isso exige duas decisões e não uma.',
        'my_backups' => 'Aviso de cópias na lista de servidores',
        'my_backups_helper' => 'Uma linha por cima da lista de servidores de cada um quando algum dos dele nunca foi copiado ou já não é copiado há algum tempo. Os cartões do Pelican dizem o que um servidor está a fazer agora; nada aí diz que não é feita uma cópia há três semanas. Só é desenhada quando algo está atrasado, e não nomeia nenhum servidor que a pessoa já não pudesse abrir.',
        'capacity' => 'Resumo da capacidade',
        'capacity_helper' => 'A página de administração que mostra memória, disco e processador prometidos face a disponíveis em cada máquina, com os servidores que ficaram sem cópias, sem bases de dados ou sem alocações. Prometido e não consumido - um nó pode estar ocupado e vazio, ou parado e cheio.',
        'schedules' => 'Resumo das tarefas agendadas',
        'schedules_helper' => 'A página de administração que lista todas as tarefas agendadas do painel, as piores primeiro - presas, atrasadas, ou nunca executadas. Só de leitura; tudo o que edita ou executa uma fica na página do Pelican desse servidor.',
        'activity' => 'Atividade do painel',
        'activity_helper' => 'A página de administração que lista todos os eventos registados do painel, o mais recente primeiro, com quem o fez e em que servidor. Só de leitura - não apaga nada, e a definição do próprio Pelican continua a decidir durante quanto tempo as linhas são guardadas.',
        'access' => 'Acesso a servidores por função',
        'access_helper' => 'Uma página para ligar uma função a servidores, mantida certa na tabela de subusers do próprio Pelican. Não concede nada enquanto não associar alguma coisa. Desligá-la pára a reconciliação; o acesso já concedido fica, e a página tem um botão para o retirar.',
        'scheduled' => 'Estilos por horário',
        'scheduled_helper' => 'A secção da página de Aspeto para dar ao painel um estilo diferente entre duas horas do dia. Não muda nada do que está guardado — uma janela é posta por cima das definições enquanto a página é desenhada e largada logo a seguir — por isso desligá-la repõe o aspeto próprio do painel de imediato e não perde nada.',
        'games' => 'Outros jogos',
        'games_helper' => 'As definições de mundo do ARK, e as listas de admins, banidos e permitidos do Valheim, como formulários em vez de ficheiros no gestor de ficheiros. Que servidores as recebem é a lista de eggs da página Outros jogos.',
        'quick' => 'Menu «Ir para»',
        'quick_helper' => 'Um controlo no topo de cada página para saltar para um servidor ou para uma página marcada, com uma caixa de pesquisa sobre toda a sua lista de servidores. Marca também a página onde está. O que alguém encontra por ele é o que já conseguia alcançar, por isso não concede nada - desligá-lo tira o atalho e a página de Favoritos com ele.',
        'shop' => 'Loja',
        'shop_helper' => 'Vender servidores a partir do painel: a loja e o pagamento na área de cliente, a página de faturação de cada pessoa, e a página Definições da loja para a moeda, o imposto e os textos. O interruptor principal — desligado, ninguém pode comprar nem pagar, e o que já foi vendido continua a ser administrado nas páginas abaixo.',
        'packages' => 'Pacotes',
        'packages_helper' => 'A página de administração onde se define o que está à venda: um modelo de servidor com um preço, um período e um stock. Permissão própria, porque definir preços é um trabalho diferente de marcar faturas como pagas.',
        'orders' => 'Encomendas',
        'orders_helper' => 'A página de administração com tudo o que foi comprado, o servidor em que cada uma se tornou e o seu estado — pendente, ativa, suspensa, cancelada. Permissão própria.',
        'invoices' => 'Faturas',
        'invoices_helper' => 'A página de administração com o que se deve e o que foi pago, com um botão para marcar uma fatura como paga à mão. Permissão própria, porque esse botão é onde o dinheiro é registado.',
        'payments' => 'Pagamentos',
        'payments_helper' => 'Os fornecedores de pagamento — as suas chaves, e cada tentativa feita através deles. Permissão própria, porque é aí que vivem as credenciais: quem pode ver cada fatura não tem de ver o segredo.',
        'coupons' => 'Cupões',
        'coupons_helper' => 'Códigos que tiram uma percentagem ou um montante fixo à primeira fatura, com validade e limite de utilizações. Permissão própria.',
        'customers' => 'Clientes',
        'customers_helper' => 'A página de administração que vira a loja do avesso: uma linha por pessoa que comprou, com o que tem, o que pagou e o que falta pagar. Direito próprio, porque é a única página da loja sobre uma pessoa em vez de sobre uma linha - quem define preços não precisa do histórico todo de um cliente, e quem responde a um ticket precisa.',
        'public_shop' => 'Página pública da loja',
        'public_shop_helper' => 'A página que qualquer pessoa pode abrir sem conta, com o que está à venda. Não publica nada que um cliente com sessão não visse na loja, por isso ligada ou desligada é toda a decisão — desligada responde 404, como a página de estado.',
    ],

    /*
     * A caixa de pesquisa por cima dos formulários de definições. Filtra o que
     * já está na página dentro do navegador e não pede nada ao servidor, por
     * isso não há estado de «a procurar» para descrever nem maneira de falhar.
     */
    /*
     * A caixa de pré-visualização. Tudo o que está nela é um substituto e não
     * uma amostra do seu painel, e as palavras dizem-no - uma caixa que
     * nomeasse um servidor real ou um número real seria lida como tal.
     */
    'preview' => [
        'label' => 'Pré-visualização',
        'card' => 'Um cartão',
        'card_helper' => 'Desenhado pelas mesmas regras que o painel, com as definições desta página em vez das guardadas.',
        'button' => 'Um botão',
        'field' => 'Um campo',
        'meter_ok' => 'Bem',
        'meter_warning' => 'Aviso',
        'meter_danger' => 'Perigo',

        /*
         * A pré-visualização de página inteira. Um separador e não um painel,
         * porque o Pelican envia X-Frame-Options: DENY e recusa ser enquadrado
         * por seja o que for, nem por ele próprio - ver Support\FullPreview.
         */
        'full' => 'Ver o painel inteiro',
        'full_confirm' => 'Abre o painel desenhado a partir das definições desta página em vez das guardadas. Não é escrito nada — os valores são mantidos quinze minutos e o painel volta ao normal quando sair da pré-visualização ou guardar.',
        'full_go' => 'Mostrar',
        'full_failed' => 'Não foi possível iniciar a pré-visualização',
        'bar' => 'Está a ver definições por guardar. Nada disto foi escrito.',
        'bar_back' => 'Voltar às definições',
    ],

    'search' => [
        'placeholder' => 'Procurar nas definições',
        'label' => 'Procurar nestas definições',
        'none' => 'Não há nada que corresponda nesta página. As definições estão espalhadas por quatro páginas — experimente Aspeto, Páginas, Avançado, ou Definições do Essentials.',
    ],

    'footer' => [
        'text' => 'A sua própria linha',
        'text_helper' => 'Texto simples, no máximo 120 caracteres. É escapado, tal como a faixa de anúncio — isto é desenhado em todas as páginas do painel, o que faz dele o sítio errado para aceitar marcação.',
        'version' => 'Mostrar a versão do painel',
        'version_helper' => 'A versão do Pelican, não a deste plugin. O plugin diz a dele no painel principal; o que as pessoas procuram no fundo de uma barra lateral é que painel estão a ver.',
        'link_label' => 'Texto da ligação',
        'link_url' => 'Endereço da ligação',
        'link_url_helper' => 'Um endereço http ou https, ou um caminho do próprio painel como /account. Abre num separador novo.',
    ],

    'layout' => [
        'label' => 'Disposição',
        'helper' => 'Como o painel está arrumado, e não de que cor é. Aplica-se por igual à área de administração, à lista de servidores e à área de cliente. Onde a navegação fica é um valor por omissão: quem tiver definido o seu em Conta → Navegação mantém-no.',
        'default' => 'Barra lateral — a do Pelican',
        'rail' => 'Calha de ícones — estreita, abre ao passar por cima',
        'top' => 'Navegação no topo — sem barra lateral',
        'mixed' => 'Barra do topo e barra lateral — as duas',
        'wide' => 'Largo — o conteúdo usa o ecrã todo',
        'focus' => 'Focado — coluna estreita, a barra lateral dobra-se',

        'nav_label' => 'Estilo da barra lateral',
        'nav_helper' => 'Como a própria barra lateral é desenhada.',
        'nav_default' => 'Por omissão',
        'nav_floating' => 'Flutuante — um cartão à parte',
        'nav_flat' => 'Plana — sem fundo nenhum',
        'nav_bordered' => 'Com borda — uma linha, não uma superfície',

        'topbar_label' => 'Estilo da topbar',
        'topbar_helper' => '«Escondida» só vale no computador — num telemóvel, a topbar leva o único caminho de volta ao menu.',
        'topbar_default' => 'Por omissão',
        'topbar_floating' => 'Flutuante — uma barra destacada',
        'topbar_flush' => 'Encostada — plana, sem desfoque',
        'topbar_hidden' => 'Escondida no computador',

        'card_label' => 'Estilo dos cartões',
        'card_helper' => 'As secções, os widgets, os cartões de servidor e os blocos por cima da consola.',
        'card_default' => 'Por omissão — elevado, com bordo suave',
        'card_flat' => 'Plano — sem elevação',
        'card_outline' => 'Contorno — uma borda e nada por trás',
        'card_glass' => 'Fosco — o fundo transparece',
        'card_sharp' => 'Angular — cantos retos',
    ],

    'servers' => [
        /*
         * A estrela num cartão. Entregue ao script em vez de escrita dentro
         * dele, para que os textos fiquem no único sítio onde os textos vivem.
         */
        'favourite' => 'Marcar este servidor',
        'favourited' => 'Marcado — aparece primeiro',

        /*
         * A pastilha ao lado dos separadores do Pelican. Nomeada pelo que faz à
         * lista e não como um quarto separador, porque filtra o separador que
         * estiver escolhido em vez de o substituir.
         */
        'favourites_tab' => 'Favoritos',
        'favourites_empty' => 'Não há nada marcado nesta página. Use a estrela de um cartão de servidor para acrescentar um — e note que isto filtra os servidores já listados aqui: um servidor marcado numa página seguinte não está a ser escondido, simplesmente não está nesta.',
        'favourites_failed' => 'Não foi possível guardar os seus servidores marcados, por isso voltaram ao último estado que o painel tinha. A consola do navegador diz o que o pedido respondeu.',

        'art' => 'Imagem do jogo',
        'art_helper' => 'O Pelican desenha a imagem do egg em cada cartão. Isto decide o que se faz com ela.',
        'art_faded' => 'Esbatida — um véu por trás do texto',
        'art_cover' => 'A cobrir — por trás do nome, a desvanecer',
        'art_off' => 'Desligada',
        'art_dim' => 'Escurecer a imagem',
        'art_dim_helper' => 'A imagem de um jogo é um céu claro e a de outro é uma gruta.',

        'status' => 'Marca de estado',
        'status_helper' => 'Onde é mostrada a cor de a correr / a arrancar / parado.',
        'status_bar' => 'Barra — pela borda esquerda',
        'status_edge' => 'Bordo — a atravessar o topo',
        'status_dot' => 'Ponto — no canto',
        'status_off' => 'Desligada',

        'density' => 'Altura dos cartões',
        'density_comfortable' => 'Confortável',
        'density_compact' => 'Compacta — para muitos servidores',

        'filter_label' => 'Pôr texto no botão de filtro',
        'filter_label_helper' => 'O Pelican já filtra esta lista por egg e por proprietário, em todas as páginas - mas a entrada é um ícone sem texto ao lado da caixa de pesquisa. Isto põe-lhe a palavra.',
        'filter_button' => 'Filtros',

        'columns' => 'Cartões ao largo num ecrã grande',
        'columns_helper' => 'Só vale para a grelha, e só a partir de 1280px. O máximo do próprio Pelican é dois.',
    ],

    'controls' => [
        'mode' => 'Botão de consola em todas as páginas de servidor',
        'mode_helper' => 'Um botão flutuante, em todas as páginas dentro de um servidor. Abre a consola por cima do que estivesse a fazer, com o estado e os botões de energia no cabeçalho — a chegar ao nó diretamente, como faz a lista de servidores, e não pelo websocket da página da consola. Nunca aparece na página da consola, que já tem tudo isso.',
        'mode_full' => 'Consola e botões de energia',
        'mode_console' => 'Só a consola',
        'mode_off' => 'Desligado',

        'label' => 'O botão mostra',
        'label_text' => 'Ícone e nome',
        'label_icon' => 'Só o ícone',

        'position' => 'Onde flutua',
        'position_helper' => 'Contra a borda que menos provavelmente estará a ler.',
        'position_top' => 'Topo',
        'position_right' => 'Direita',
        'position_bottom' => 'Fundo',
    ],

    'console' => [
        'stats' => 'Blocos por cima da consola',
        'stats_helper' => 'O Pelican mostra o nome, o estado, o endereço e os três números de utilização por cima do terminal. Escondê-los devolve a altura à consola.',
        'stats_tiles' => 'Mosaicos — rótulo, número e um ícone',
        'stats_plain' => 'Simples — tal como o Pelican os desenha',
        'stats_off' => 'Escondidos',
    ],

    'terminal' => [
        'helper' => 'São entregues ao próprio terminal, por isso entram em vigor no carregamento seguinte da página e não no momento em que são guardados.',

        'renderer' => 'Desenhado por',
        'renderer_helper' => 'O Pelican desenha o terminal na GPU, o que é muito mais rápido perante uma parede de saída a correr. Um navegador só mantém vivos alguns contextos de GPU ao mesmo tempo — menos num telemóvel — e retira o mais antigo quando o limite é passado; o terminal deixa então de desenhar seja o que for, sem nenhum erro. Se a sua consola ficar em branco e todo o resto parecer bem, é esta a definição que se muda.',
        'renderer_webgl' => 'A GPU — a do Pelican, mais rápida',
        'renderer_dom' => 'O navegador — mais lento, desenha sempre',

        'scheme' => 'Esquema de cores',
        'scheme_helper' => 'A única definição de terminal que o Pelican não oferece. «Seguir o tema» deriva as cores do acento, e é por isso que isto existe.',
        'scheme_theme' => 'Seguir o tema',
        'scheme_dracula' => 'Dracula',
        'scheme_nord' => 'Nord',
        'scheme_solarized' => 'Solarized Dark',
        'scheme_gruvbox' => 'Gruvbox Dark',
        'scheme_one_dark' => 'One Dark',
        'scheme_tokyo_night' => 'Tokyo Night',
        'scheme_catppuccin' => 'Catppuccin Mocha',
        'scheme_monokai' => 'Monokai',

        'cursor' => 'Cursor',
        'cursor_helper' => 'A consola não aceita escrita — a caixa de comandos está por baixo — por isso isto é onde a saída parou, e não onde você está.',
        'cursor_underline' => 'Sublinhado — o do Pelican',
        'cursor_block' => 'Bloco',
        'cursor_bar' => 'Barra',

        'blink' => 'Cursor a piscar',

        'scrollback' => 'Histórico',
        'scrollback_helper' => 'Até onde a consola pode ser subida. Cada linha fica guardada no navegador, por isso um servidor falador com uma definição alta é memória a sério na máquina que está a ler.',
        'scrollback_lines' => ':lines linhas',
    ],

    'notice' => [
        'text' => 'Mensagem',
        'text_helper' => 'Uma linha, até 200 caracteres. É escapada à entrada e à saída, por isso não pode levar marcação para uma página que outras pessoas carreguem.',
        'style' => 'Tom',
        'style_info' => 'Informação',
        'style_warning' => 'Aviso',
        'style_danger' => 'Urgente',
        'style_accent' => 'Cor de acento',
        'scope' => 'Mostrado a',
        'scope_all' => 'Toda a gente',
        'scope_client' => 'Só fora da área de administração',
        'scope_admin' => 'Só na área de administração',
        'link_label' => 'Texto do botão',
        'link_url' => 'Endereço do botão',
        'link_url_helper' => 'https:// ou um caminho dentro deste painel, como /account. Tudo o resto é ignorado — uma ligação numa faixa que aparece em todas as páginas não é sítio para um esquema que ninguém espera.',
        'dismissible' => 'Pode ser fechada',
        'dismissible_helper' => 'Ter sido fechada é lembrado por navegador, e só para esta mensagem: mude o texto e ela volta para toda a gente.',
        'dismiss' => 'Fechar',
    ],

    'preset' => [
        'label' => 'Estilo',
        'helper' => 'Escolha um aspeto de partida. Preenche tudo o que está abaixo, que depois pode mudar. «Nenhum» desliga o tema e deixa o painel exatamente como o Pelican o entrega.',
        'options' => [
            'none' => 'Nenhum - sem tema',
            'legend' => 'Legend - fogo vermelho para relâmpago azul',
            'ember' => 'Ember - preto quente, acento laranja',
            'midnight' => 'Midnight - azul profundo, calmo',
            'crimson' => 'Crimson - vermelho, cantos retos, compacto',
            'forest' => 'Forest - verde, arredondado, sem brilho',
            'nebula' => 'Nebula - roxo com um fundo em gradiente',
            'terminal' => 'Terminal - verde sobre preto, monoespaçado, reto',
            'console' => 'Console - redondo e espaçoso, para um tablet',
            'nord' => 'Nord - a paleta Nord, sóbria',
            'solarized' => 'Solarized - Solarized dark, acento ciano',
            'paper' => 'Paper - claro, muito contraste, plano',
            'daylight' => 'Daylight - claro e quente, com um véu suave',
            'mono' => 'Mono - escala de cinzentos, plano e denso',
        ],

        'save' => 'Guardar como estilo',
        'save_confirm' => 'Guarda as cores, os cantos, o fundo, o tipo de letra, os ícones e os limiares dos medidores que tem agora no ecrã — com um nome seu, no seletor ao lado dos que vêm incluídos. Guarda o que está na página, e não o que foi guardado da última vez.',
        'save_name' => 'Nome',
        'save_name_helper' => 'Como se vai chamar no seletor. Guardar com um nome já usado substitui esse.',
        'saved' => 'Estilo guardado',
        'save_failed' => 'Não foi possível guardar esse estilo',
        'save_full' => 'Há espaço para :max estilos seus. Apague um primeiro.',

        'delete' => 'Apagar um estilo',
        'delete_which' => 'Qual',
        'delete_confirm' => 'Só se podem apagar os estilos seus; os que vêm incluídos não. Nada muda no aspeto atual do painel — um estilo é um ponto de partida, e todos os valores que ele definiu já estão nas definições abaixo.',
        'deleted' => 'Estilo apagado',
        'deleted_current' => 'Era esse que este painel tinha definido. As definições dele estão inalteradas e continuam nesta página — escolha um estilo, ou volte a guardá-las com um nome.',
    ],

    'user_themes' => [
        'label' => 'Estilos que as pessoas podem escolher para si',
        'helper' => 'Os estilos marcados aparecem numa página de Aparência dentro da área de cliente, onde qualquer pessoa com sessão iniciada pode escolher um para si. Muda o que ela vê e nada para os outros. Nada marcado quer dizer que ninguém escolhe nada e que o painel mantém um só aspeto — que é o que faz agora.',
    ],

    'mode' => [
        'label' => 'Modo do painel',
        'helper' => 'Em que modo o painel abre. Quem não tiver escolhido por si recebe este; o interruptor no menu de utilizador continua a deixá-lo mudar, a não ser que o bloqueie abaixo.',
        'dark' => 'Escuro',
        'light' => 'Claro',
        'system' => 'Sistema — seguir a definição do visitante',
    ],

    'font' => [
        'label' => 'Tipo de letra do painel',
        'helper' => 'Cada opção é uma família que o sistema operativo já tem — não é obtido nada de um fornecedor de tipos de letra. O terminal não é afetado: o tipo de letra dele é a escolha de cada um, em Conta.',
        'default' => 'Por omissão - o do Pelican',
        'mono' => 'Monoespaçado',
        'rounded' => 'Arredondado',
        'serif' => 'Serifado',
        'system' => 'Sistema - o que esta máquina usar',
    ],

    'surface' => [
        'label' => 'Cor das superfícies',
        'helper' => 'Os cartões e os painéis. Os tons mais claros e mais escuros são derivados dela.',
        'placeholder' => 'Seguir o tema',
    ],

    'radius' => [
        'label' => 'Cantos',
    ],

    'accent' => [
        'label' => 'Cor de acento',
        'helper' => 'Usada nos botões, nas ligações, na entrada de navegação ativa e nos anéis de foco.',

        /*
         * Dito, não imposto. Uma cor sobre a qual isto avisa é guardada na
         * mesma: é o painel de alguém, o número mede uma só coisa, e há boas
         * razões para querer um acento que pontue mal. O seletor diz o que vê e
         * sai da frente.
         */
        'contrast_dark' => 'Legibilidade: :ratio contra um painel escuro. Abaixo de 3 um acento é difícil de ler como botão ou como ligação — um mais claro levanta-o.',
        'contrast_light' => 'Legibilidade: :ratio contra um painel claro. Abaixo de 3 um acento é difícil de ler como botão ou como ligação — um mais escuro levanta-o.',
    ],
    'density' => [
        'label' => 'Densidade',
        'helper' => 'Compacta aperta os espaçamentos para caberem mais linhas no ecrã.',
        'comfortable' => 'Confortável',
        'compact' => 'Compacta',
    ],
    'force_dark' => [
        'label' => 'Forçar o modo escuro',
        'helper' => 'Esconde o interruptor claro/escuro e mantém todos os utilizadores no tema escuro.',
    ],
    'glass' => [
        'label' => 'Topbar fosca',
        'helper' => 'Desfoca a topbar e os fundos das janelas modais. Desligue em dispositivos modestos.',
    ],
    'glow' => [
        'label' => 'Brilho de acento',
        'helper' => 'Uma sombra de acento suave nos botões principais, na navegação ativa e no cartão de entrada.',
    ],

    'background' => [
        'label' => 'Tipo de fundo',
        'helper' => 'Aurora é o fundo próprio do tema: brilhos de acento com um grão fino.',
        'aurora' => 'Aurora (por omissão)',
        'solid' => 'Uma só cor',
        'gradient' => 'Gradiente',
        'image' => 'Imagem',
        'color' => 'Cor',
        'base' => 'Cor por trás dos brilhos',
        'base_helper' => 'Sobre o que a página assenta antes de os brilhos de acento serem pintados por cima. Deixe vazio para manter o valor por omissão do painel, quase preto no escuro e quase branco no claro. Defina-o e um esquema mantém a sua própria cor de noite e continua a ficar iluminado.',
        'color_end' => 'Segunda cor',
        'angle' => 'Direção',
        'upload' => 'Enviar uma imagem',
        'upload_helper' => 'Até 8 MB. Uma imagem enviada tem prioridade sobre o URL abaixo.',
        'url' => 'Ou um URL',
        'url_helper' => 'Tem de começar por https:// e ser alcançável de fora.',
        'dim' => 'Escurecer',
        'dim_helper' => 'Sem escurecer, texto branco sobre uma foto clara não se lê.',
        'blur' => 'Desfoque',
    ],

    'channel' => [
        'installed' => 'instalada',
        'version' => 'Instalar uma versão específica',
        'version_helper' => 'Qualquer versão deste canal, e não apenas a mais recente — para voltar atrás quando algo novo sai pior, ou para a frente para uma compilação que lhe disseram para experimentar. Só enquanto as atualizações não se instalarem sozinhas: com isso ligado, o que escolher duraria até à verificação seguinte.',
        'version_placeholder' => 'Escolha uma versão',
        'version_install' => 'Instalar esta versão',
        'version_confirm' => 'O painel descarrega essa versão, reconstrói os seus assets e limpa as suas caches. As suas definições são mantidas. Voltar a uma versão mais antiga é permitido e não é desfeito sozinho — escolha outra vez a mais recente para avançar.',
        'label' => 'Canal de atualização',
        'helper' => 'Que versões a página do tema oferece. O Beta recebe as versões novas primeiro, e as arestas também primeiro.',
        'stable' => 'Estável',
        'beta' => 'Beta',
        'dev' => 'Dev (ramo de trabalho)',
        'auto' => [
            'label' => 'Instalar as atualizações automaticamente',
            'helper' => 'Desligado deixa a atualização consigo. Ligado, o painel verifica o canal escolhido e instala tudo o que for mais recente - reconstrói os assets durante isso e fica indisponível alguns minutos, por isso o diário e o semanal são às 04:00. Precisa do cron do painel a correr.',
            'interval' => 'Verificar a cada',
            'minute' => 'Cada minuto',
            'five_minutes' => 'Cada 5 minutos',
            'ten_minutes' => 'Cada 10 minutos',
            'thirty_minutes' => 'Cada 30 minutos',
            'hourly' => 'Cada hora',
            'daily' => 'Todos os dias (04:00)',
            'weekly' => 'Todas as semanas (segunda-feira 04:00)',
        ],
    ],

    /*
     * O separador de Idiomas.
     *
     * Cuidadoso com o que afirma. O Pelican já deixa cada pessoa escolher um
     * idioma para toda a conta e já o aplica; nada aqui muda isso nem deveria.
     * Isto decide apenas se os textos próprios deste plugin seguem essa
     * escolha.
     */
    'languages' => [
        'section_helper' => 'O Pelican já deixa cada um escolher um idioma para a conta, e este plugin segue-o onde quer que esteja traduzido. É aqui que decide a quais deles ele vai obedecer. A maioria dos idiomas está numa percentagem baixa de propósito: o que é traduzido primeiro é a parte que toda a gente vê em todas as páginas — os botões de energia por cima de uma consola e os medidores dos nós — e o resto chega à medida que as pessoas contribuem.',
        'panel' => 'Deixar isto decidir o idioma de todo o painel',
        'panel_helper' => 'Ligado, um idioma que este plugin não leva — ou um desligado abaixo — põe todo o painel em inglês para esse leitor, e não apenas estas páginas. Desligado, só este plugin segue a lista e o Pelican continua a falar aquilo que a conta tiver definido, o que quer dizer que um leitor pode encontrar dois idiomas no mesmo ecrã. Nenhuma conta é alterada em qualquer dos casos: volte a ligar um idioma e ele tem-no outra vez.',
        'label' => 'Idiomas em que responder',
        'helper' => 'Desmarcar um manda de volta para inglês, só neste plugin, os leitores que o tiverem definido na conta — o resto do painel continua a falar o idioma deles. O inglês não está na lista porque tudo recai sobre ele.',
        'under' => 'não é oferecido enquanto não avançar mais — marque-o para o oferecer na mesma',
        'done' => ':percent % traduzido',
        'main' => 'Idioma principal',
        'main_helper' => 'O que um leitor recebe quando o idioma dele não pode ser usado — ou este plugin não o leva, ou está desmarcado abaixo. Foi sempre o inglês; numa equipa que não trabalha em inglês essa era uma resposta errada dada com confiança. Não pode ser desmarcado abaixo, porque tudo recai sobre ele.',
        'labels' => 'Como se chama cada idioma',
        'labels_helper' => 'O nome que leitores e administradores veem nos seletores. Deixe um vazio para manter o nome pelo qual este plugin o conhece. Um idioma enviado com um nome seu não tem nenhum, por isso apareceria com o código dele até lhe dar um aqui.',
        'labels_code' => 'Código',
        'labels_name' => 'Mostrado como',
        'download' => 'Descarregar um ficheiro de tradução',
        'download_from' => 'Partir de',
        'download_from_helper' => 'Um JSON com todos os textos deste plugin. Escolha inglês para um idioma que ninguém começou, ou um existente para continuar o que já está traduzido.',
        'code' => 'Código de idioma',
        'code_helper' => 'O código a que o ficheiro corresponde. Uma locale a sério, tal como as contas a usam — fr, de, pt_BR — chega aos leitores que a tiverem definida, e tem de coincidir exatamente ou não chega. Um nome seu, como Gaming-PT, é permitido e funciona de outra maneira: o Pelican só deixa uma conta ter uma locale a sério, por isso ninguém consegue selecionar o seu. É alcançável como idioma principal acima, que é o que recebe toda a gente cujo idioma não pode ser usado.',
        'url' => 'Ou obtê-lo de um endereço',
        'url_helper' => 'Um endereço https que o painel consiga alcançar — um CDN, um bucket, um ficheiro em bruto de um repositório. É obtido uma vez ao guardar e escrito tal como um envio, por isso mudar o ficheiro nesse endereço mais tarde não faz nada até voltar a guardar. Um ficheiro escolhido acima ganha a um endereço deixado neste campo.',
        'upload' => 'Enviar um ficheiro de tradução',
        'upload_helper' => 'O JSON de cima, com os valores traduzidos. É escrito fora do plugin, por isso uma atualização não o deita fora, e é combinado por cima do inglês chave a chave — um ficheiro com metade dos textos dá-lhe meio idioma e inglês para o resto.',
        'uploaded' => ':count textos instalados para :code',
        'uploaded_halves' => 'Destes, :mine são textos próprios deste plugin e :panel são do painel. Zero de um dos lados quer dizer que essa metade do ficheiro não trazia nada — as chaves do plugin começam por essentials:: e as do painel não.',
        'uploaded_skipped' => 'Foram ignorados :count: vazios, ou chaves que este plugin não tem. Os primeiros: :keys',
        'upload_failed' => 'Não foi possível ler esse ficheiro',
        'upload_failed_body' => 'Tem de ser o JSON do descarregamento de cima — um objeto plano de chaves e textos. Verifique que um editor não o guardou como outra coisa.',
    ],

    'windows' => [
        'add' => 'Acrescentar uma janela',
        'from' => 'De',
        'to' => 'Até',
        'to_helper' => 'Mais cedo do que o início quer dizer que atravessa a meia-noite — das 22:00 até às 06:00 é a noite.',
        'preset' => 'Estilo',
        'days' => 'Dias',
        'days_helper' => 'Deixe-os todos por marcar para todos os dias. Uma janela que atravessa a meia-noite pertence ao dia em que começa, por isso sexta-feira das 22:00 até às 06:00 cobre a manhã de sábado.',
        'day_mon' => 'Segunda-feira',
        'day_tue' => 'Terça-feira',
        'day_wed' => 'Quarta-feira',
        'day_thu' => 'Quinta-feira',
        'day_fri' => 'Sexta-feira',
        'day_sat' => 'Sábado',
        'day_sun' => 'Domingo',
    ],

    'arranger' => [
        'label' => 'Organizador de páginas',
        'helper' => 'O botão «Organizar a página», em todas as páginas do painel. Quem tiver a permissão Organizar recebe-o e pode também definir a disposição de que todos os outros partem, ou uma para uma função. Desligado esconde-o para toda a gente; as disposições já guardadas ficam onde estão.',
        'roles' => 'Uma disposição não é uma permissão. Um bloco que uma função esconde continua a ser um bloco que alguém poderia alcançar escrevendo o endereço — o que impede isso são as permissões do próprio Pelican, na página de funções. Aplicam-se três camadas por esta ordem: a de partida comum, depois a função do leitor, depois o que ele próprio tiver movido.',
        'users' => 'Deixar cada um organizar as suas próprias páginas',
        'users_helper' => 'Ligado, qualquer pessoa com sessão iniciada pode reorganizar e esconder blocos nas páginas que já vê, só para si — não muda nada para mais ninguém. Definir a disposição de partida comum continua ligado à permissão Organizar.',
    ],

    'brand' => [
        'logo_height' => 'Altura do logótipo',
        'logo_height_helper' => 'O Pelican entrega 2rem. Valores maiores tornam o cabeçalho da barra lateral mais alto com ele.',
        'logo_url' => 'Substituir o logótipo',
        'logo_url_helper' => 'Deixe vazio para manter aquilo para que as definições do próprio Pelican apontam.',
    ],

    'login' => [
        'image' => 'Imagem de fundo',
        'image_helper' => 'Só para o ecrã de entrada. Sem ela continua a mostrar o fundo do painel.',
        'url' => 'Ou um URL',
        'blur' => 'Desfoque do cartão',
        'blur_helper' => 'Torna o cartão fosco para que a imagem por trás transpareça.',
        'width' => 'Largura do cartão',
        'position' => 'Enquadramento da imagem',
        'position_helper' => 'Que parte da imagem sobrevive ao corte para o ecrã.',
        'position_center' => 'Centro',
        'position_top' => 'Topo',
        'position_bottom' => 'Fundo',
        'position_left' => 'Esquerda',
        'position_right' => 'Direita',
        'align' => 'Posição do cartão',
        'align_helper' => 'Onde o cartão de entrada fica ao largo do ecrã.',
        'align_center' => 'Centro',
        'align_start' => 'Esquerda',
        'align_end' => 'Direita',
        'opacity' => 'Opacidade do cartão',
        'opacity_helper' => 'Mais baixa deixa passar mais imagem através do cartão.',
        'glow' => 'Brilho de acento',
        'glow_helper' => 'A auréola à volta do cartão. Desligada mantém o bordo e a profundidade dele.',
        'hide_heading' => 'Esconder o título',
        'hide_heading_helper' => 'Retira o título por cima do formulário, deixando o formulário sozinho.',
        'hide_footer' => 'Esconder o rodapé',
        'hide_footer_helper' => 'Retira a linha por baixo do cartão que liga a pelican.dev.',
        'above' => 'Linha por cima do formulário',
        'above_helper' => 'Uma linha, mostrada a toda a gente que chegue ao ecrã de entrada. Deixe vazio para nenhuma.',
        'notice' => 'Aviso por baixo do cartão',
        'notice_helper' => 'Uma linha, mostrada a toda a gente que chegue ao ecrã de entrada. Deixe vazio para nenhum.',
    ],

    'advanced' => [
        'css' => 'CSS próprio',
        'css_helper' => 'Até 100 KB. Guardado em storage, não no .env.',
        'reference' => 'Referência de CSS',
        'reference_helper' => 'Todas as variáveis e classes que este tema e o painel expõem.',
    ],

    'areas' => [
        'add' => 'Acrescentar uma área',
        'area' => 'Área',
        'inherit' => 'Geral',
        'radius' => 'Cantos',
        'radius_sharp' => 'Retos',
        'radius_normal' => 'Normais',
        'radius_round' => 'Arredondados',
        'surface' => 'Cor das superfícies',
        'surface_helper' => 'Os cartões e os painéis dentro desta área; os tons mais claros e mais escuros são derivados dela.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Consola (o resto da página)',
            'files' => 'Página de ficheiros',
            'edit' => 'Página de edição',
            'server' => 'Outras páginas e separadores de servidor',
        ],
    ],

    'bars' => [
        'base' => 'Cor base',
        'base_green' => 'Verde',
        'base_accent' => 'Cor de acento',
        'warning' => 'Âmbar a partir de',
        'danger' => 'Vermelho a partir de',
    ],

    'icons' => [
        'stroke' => 'Espessura do traço',
        'stroke_thin' => 'Fino',
        'stroke_normal' => 'Normal',
        'stroke_bold' => 'Grosso',
        'scale' => 'Tamanho',
        'accent' => 'Ícones de menu na cor de acento',
        'accent_helper' => 'Aplica-se aos ícones da barra lateral e da topbar.',
        'pack' => 'Pacote de ícones',
        'pack_helper' => 'De que conjunto o seletor abaixo tira. São oferecidos todos os conjuntos de ícones instalados no servidor, mais o conjunto Essentials que vem com este plugin e qualquer pacote que envie. Há uma diferença que vale a pena saber: um ícone de traço é desenhado na cor do menu e segue o passar do rato e a entrada ativa, enquanto os ícones do Essentials são imagens e mantêm as suas próprias cores. Isso é decidido pelo que o ficheiro é, e não pelo conjunto de onde veio.',
        'pack_custom' => 'Pacote enviado',
        'pack_shipped' => 'Ícones do Essentials',
        'use_shipped' => 'Usar os ícones do Essentials em todo o lado',
        'use_shipped_confirm' => 'Põe o pacote nos ícones do Essentials e preenche cada entrada de menu abaixo com o ícone desenhado para ela — a consola recebe o terminal, o arranque recebe o botão de lançar, e assim por diante. Substitui as entradas que tem agora, e não é guardado nada até carregar em Guardar, por isso fechar a página desfaz.',
        'pack_upload' => 'Enviar um pacote',
        'pack_upload_helper' => 'Um .zip de ficheiros SVG. Cada ficheiro passa a ser um ícone com o nome dele — logo.svg passa a custom-logo. Enviar substitui o pacote que estiver lá. Os ficheiros com mais de 256 KB e tudo o que passe de 4000 ícones ficam de fora, e é-lhe dito quantos: para dar uma escala, o conjunto Tabler inteiro anda perto dos seis mil ícones em cerca de três megabytes, por isso um pacote muito maior leva outra coisa que não ícones e a maior parte será ignorada. Um envio grande também pode ser recusado antes de este campo dizer o que quer que seja, por upload_max_filesize e post_max_size no php.ini do anfitrião do painel — nenhuma definição daqui os consegue subir.',
        'pack_partial' => ':count ícones instalados, mas não todos',
        'pack_partial_body' => 'Ignorados: :big demasiado grandes para um ícone, :unusable não utilizáveis como SVG, :duplicate com um nome já ocupado, :empty sem nada para desenhar depois de limpos. Um SVG com mais de 256 KB é quase sempre uma imagem embrulhada num e não um desenho — exporte-o no tamanho de um ícone e ficará com alguns kilobytes. Um ícone sem nada para desenhar só continha algo que aqui não é servido — se for um pacote inteiro, vale a pena reportar.',
        'pack_stopped_files' => 'Parou também no limite de quantos ícones um pacote pode conter.',
        'pack_stopped_size' => 'Parou também porque o resto do pacote, descompactado, dá mais do que o painel mantém em memória de uma vez — o zip pode ser mais pequeno, já que o SVG comprime cerca de cinco para um.',
        'overrides' => 'Substituir ícones',
        'overrides_helper' => 'Uma linha por cada ícone que queira mudar. Escolha a entrada de menu, e depois escolha um ícone do pacote de cima, dê um endereço, ou envie uma imagem sua. Se estiver mais do que um preenchido, ganha o envio, depois o endereço, depois o pacote.',
        'overrides_key' => 'Entrada de menu',
        'overrides_value' => 'Ícone do pacote',
        'overrides_url' => 'Ou um endereço',
        'overrides_url_helper' => 'Um endereço https de uma imagem alojada por si — um CDN, um bucket, qualquer sítio onde o navegador chegue. Não é copiado nada para o painel, por isso substituir o ficheiro nesse endereço muda o ícone sem tocar nesta página; o reverso é um ícone que desaparece quando o endereço desaparece. Mantém as suas próprias cores, como uma imagem enviada.',
        'overrides_file' => 'Ou enviar uma imagem',
        /*
         * Diz em que consiste realmente a diferença, porque não é óbvio e é a
         * razão pela qual alguém escolheria um em vez do outro.
         */
        'overrides_file_helper' => 'PNG, SVG ou ICO. Um ícone do pacote é desenhado na cor do menu e segue o passar do rato e a entrada ativa; uma imagem enviada mantém as suas próprias cores e não segue. Para um logótipo é normalmente isso que se quer.',
        'overrides_add' => 'Substituir outro ícone',
        'overrides_search' => 'Escreva um nome, ou a entrada de menu…',
    ],

    /*
     * Não dentro de «Marca». A marca fala do aspeto do painel; isto fala de como
     * este plugin aparece nele, o que é outra pergunta e responde-se noutra
     * página.
     */
    'identity' => [
        'nav_icon' => 'Ícone da entrada «Definições do Essentials»',
        'nav_icon_helper' => 'PNG, SVG ou ICO, até 8 MB. Substitui o ícone dessa única entrada da barra lateral; deixe vazio para o que este plugin traz. É desenhado como uma imagem e não como um ícone, por isso mantém as suas próprias cores em vez de seguir o texto — que é o que um logótipo normalmente quer. O ficheiro é servido em vez de embutido, por isso cada navegador obtém-no uma só vez, mas mesmo assim vale a pena exportar algo pequeno: alguns kilobytes chegam e sobram para uma entrada de vinte pixels de altura. Se um envio falhar antes de este campo dizer o que quer que seja, o limite em que bateu é o upload_max_filesize no php.ini do painel.',
    ],
];
