<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Egg», «nó», «subuser», «Wings», «queue», «webhook», «topbar», «cron» e os
 * formatos de arquivo ficam como estão: são as palavras que se acham no próprio
 * Pelican, no host e em tudo o que se escreve sobre eles. Os nomes dos estilos
 * também não são traduzidos — um estilo se chama o que se chama, e um nome
 * traduzido seria um segundo nome para a mesma coisa.
 */

return [
    'css_warning' => 'Salvo, mas este CSS parece errado',
    'css_unclosed' => 'Uma regra aberta na linha :line nunca é fechada. Tudo o que vem depois está dentro dessa regra e não vai valer.',
    'css_extra' => 'Tem uma chave de fechamento na linha :line sem nada aberto. Tudo o que vem depois fica fora de qualquer regra e é ignorado.',
    'css_comment' => 'Um comentário aberto na linha :line nunca é fechado, então o resto do arquivo está dentro dele.',

    'groups' => [
        'appearance' => 'Aparência',
        'servers' => 'Lista de servidores',
        'windows' => 'Estilos por horário',
        'windows_helper' => 'Um estilo diferente entre dois horários do dia. Nada acontece enquanto você não adicionar um. O relógio é o do próprio painel, da configuração de fuso horário dele, e não o de cada leitor — um painel que parecesse diferente para duas pessoas no mesmo momento pareceria quebrado e não agendado. Uma faixa muda a aparência que o painel já tem, então ela não faz nada enquanto o estilo estiver em «Nenhum». Um estilo que alguém escolheu para si continua ganhando.',
        'minecraft' => 'Minecraft',
        'ark' => 'ARK',
        'valheim' => 'Valheim',
        'languages' => 'Idiomas',
        'servers_helper' => 'Como um cartão de servidor é desenhado. Se eles aparecem em grade ou em lista é escolha de cada um, em Conta → Layout do painel inicial.',
        'server_pages' => 'Páginas de servidor',
        'server_pages_helper' => 'O que cada página dentro de um servidor carrega, seja qual for a página.',
        'console' => 'Página do console',
        'console_helper' => 'A fonte do terminal, o tamanho e a altura são escolha de cada um, em Conta.',
        'background' => 'Fundo',
        'background_helper' => 'Vale para o painel inteiro, inclusive a tela de entrada.',
        'icons' => 'Ícones',
        'bars' => 'Medidores de recursos',
        'bars_helper' => 'As barras de processador, memória e disco nos cartões de servidor.',
        'updates' => 'Atualizações',
        'updates_helper' => 'Quais versões a página do tema oferece, e onde ela procura.',
        'brand' => 'Marca',
        'login' => 'Tela de entrada',
        'login_helper' => 'Vale para as telas de entrada, de redefinição de senha e de dois fatores.',
        'advanced' => 'CSS próprio',
        'advanced_helper' => 'Para tudo o que as configurações acima não cobrem. É carregado depois de todo o resto, então ganha.',
        'areas' => 'Por área',
        'areas_helper' => 'Tudo o que está acima vale em todo lugar. Aqui você pode separar uma área; o que deixar vazio continua seguindo a configuração geral.',
        'footer' => 'Rodapé da barra lateral',
        'footer_helper' => 'O fim da barra lateral, que o Pelican deixa vazio. Tudo aqui está desligado até você preencher.',
        'features' => 'O que este plugin acrescenta',
        'features_helper' => 'Desmarcar uma coisa tira ela do painel por completo. As configurações dela são mantidas e a página dela mantém o endereço, então não se perde nada desligando algo para ver o que ele fazia. A maioria tem também uma permissão própria em Cargos, para entregar uma sem entregar o resto. Nem todas: os medidores de recursos, o rodapé da barra lateral e a busca de configurações são desenhados para todo mundo e não são administrados por ninguém, a estrela em um cartão de servidor pertence a quem clicou nela, e as páginas de Palworld e Minecraft dentro de um servidor seguem as permissões daquele servidor e não uma destas. O visual em si não está nesta lista — ele tem um botão próprio, em Visual → Aparência → Estilo → Nenhum.',
        'identity' => 'Este plugin na barra lateral',
        'identity_helper' => 'A entrada que este plugin acrescenta à barra lateral, e a imagem dela.',
    ],

    /*
     * As páginas de configurações, cada uma uma entrada do grupo próprio do
     * plugin na barra lateral. Agrupadas pela pergunta que se responde e não
     * pela classe que as implementa.
     */
    'pages' => [
        'look' => 'Visual',
        'look_helper' => 'A cor, a forma e como o painel se chama.',
        'pages' => 'Páginas',
        'pages_helper' => 'A lista de servidores, as páginas de dentro de um servidor, e o terminal.',
        'advanced' => 'Avançado',
        'advanced_helper' => 'As duas saídas de emergência: seu próprio CSS, e as configurações que valem só para uma área.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Quais eggs são Minecraft, e todo o resto sobre isso.',
        'artwork' => 'Imagens dos eggs',
        'artwork_helper' => 'Uma página com todos os eggs, e um jeito de buscar a imagem do jogo na Steam ou no IGDB. Ela grava nos próprios eggs — a imagem, e duas tags anotando de qual jogo se trata e se a imagem foi escolhida na mão — e por isso carrega uma permissão própria.',
        'alerts' => 'Alertas',
        'alerts_helper' => 'Uma checagem periódica das coisas que o painel já mede mas não conta para ninguém: um nó que para de responder, um disco enchendo, um queue worker que parou, uma versão ficando para trás. Manda para o Discord, para o painel, ou por e-mail. Permissão própria, porque alcança todos os nós periodicamente e publica para um endereço que alguém digitou.',
        'backups' => 'Visão geral de backups',
        'backups_helper' => 'Uma página com todos os servidores e o tempo que estão sem backup, ordenada para os que não têm nenhum ficarem no topo. Somente leitura — tudo o que age sobre um backup fica na página do Pelican daquele servidor. Permissão própria, porque a lista é um mapa de onde estão os buracos.',
        'public_status' => 'Página de status pública',
        'public_status_helper' => 'Uma página que qualquer um pode abrir sem conta, mostrando quais dos seus servidores estão no ar e quanta gente está neles. Nada é publicado até você nomear um servidor, uma máquina ou um serviço — as três listas começam vazias, e enquanto estiverem o endereço responde 404. Permissão própria, porque ela decide o que sai do painel.',
        'game_players' => 'Jogadores, outros jogos',
        'capacity' => 'Capacidade',
        'capacity_helper' => 'O que foi prometido em cada máquina diante do que ela pode distribuir, para ver se cabe mais um servidor. A lista de nós do Pelican mostra um nome e um número de servidores, e o bloco Máquinas do painel inicial mostra o que está rodando - esta é a terceira pergunta, e a conta é a do próprio Pelican. Somente leitura. Permissão própria.',
        'schedules' => 'Tarefas agendadas',
        'schedules_helper' => 'Todas as tarefas agendadas do painel com quais delas pararam: travadas no meio de uma execução, atrasadas porque o cron não está rodando, ou que nunca rodaram. O Pelican mostra as tarefas dentro de cada servidor e o status dele não tem palavra para nenhum desses casos. Somente leitura. Permissão própria.',
        'activity' => 'Atividade',
        'activity_helper' => 'Todos os eventos que o painel registra, em uma lista em vez de um servidor por vez. O Pelican guarda o registro e mostra por servidor; isto pergunta ao mesmo registro ao contrário. Somente leitura. Permissão própria, porque um registro de quem fez o quê é algo que se entrega de propósito.',
        'access' => 'Acesso a servidores',
        'access_helper' => 'Amarrar um cargo a servidores, para que todos que o tenham consigam alcançá-los. Funciona mantendo em dia os subusers do próprio Pelican, que é o que a lista de servidores e todas as checagens de permissão já leem. Permissão própria, porque é a única página daqui que dá acesso a coisas.',
        'games' => 'Outros jogos',
        'games_helper' => 'Os arquivos que o ARK e o Valheim guardam ao lado do mundo, como formulários: as configurações de mundo do ARK, e as listas de admins, banidos e permitidos do Valheim. Quais servidores as recebem é a lista de eggs daquela página, então uma lista vazia já é um botão de desligar por jogo.',
        'game_players_helper' => 'Uma página dentro do Rust, do ARK, do Valheim e de tudo o que responda à consulta da Valve, mostrando quem está conectado e há quanto tempo. Somente leitura — o que dá para fazer com alguém muda de jogo para jogo, e isso é uma versão à parte. Quais eggs contam é a mesma lista que a página de status usa.',
        'api' => 'API',
        'api_helper' => 'As chaves que as pessoas têm, quem pediu uma, e o que cada uma delas pode ver.',
        'languages' => 'Idiomas',
        'languages_helper' => 'Em quais idiomas este plugin responde.',
    ],

    'features' => [
        'look' => 'Configurações de visual',
        'look_helper' => 'A entrada da barra lateral para cor, forma e marca.',
        'pages' => 'Configurações de páginas',
        'pages_helper' => 'A entrada da barra lateral para a lista de servidores, as páginas de servidor e o terminal.',
        'advanced' => 'Configurações avançadas',
        'advanced_helper' => 'A entrada da barra lateral para o seu próprio CSS e as exceções por área.',
        'announcements' => 'Avisos',
        'announcements_helper' => 'A faixa no topo do painel.',
        'nav_links' => 'Links de navegação',
        'nav_links_helper' => 'Suas próprias entradas na barra lateral.',
        'login' => 'Tela de entrada',
        'login_helper' => 'A imagem, o recado e os links da tela de entrada.',
        'bars' => 'Medidores de recursos',
        'bars_helper' => 'As barras recoloridas de processador, memória e disco.',
        'dashboard_status' => 'Linha da versão',
        'dashboard_status_helper' => 'O topo do bloco do painel inicial: qual versão está instalada e se tem outra esperando.',
        'dashboard_nodes' => 'Máquinas',
        'dashboard_nodes_helper' => 'O resto do bloco do painel inicial: este painel e cada nó, com o que cada um está usando.',
        'system_status' => 'Página de status do sistema',
        'system_status_helper' => 'A página da máquina em que o próprio painel roda.',
        'sidebar_footer' => 'Rodapé da barra lateral',
        'sidebar_footer_helper' => 'Sua linha de texto, a versão do painel e um link, no fim da barra lateral.',
        'api' => 'API',
        'api_helper' => 'Uma entrada de fora do painel: um endereço para o qual um bot do Discord ou um script seu pode perguntar o que este plugin sabe — quem está jogando, quais servidores não têm backup, se cabe mais um em um nó. Desligado não registra rota nenhuma, em vez de uma que recusa, o que é menos superfície em vez de uma quantidade mais educada dela. Qualquer pessoa logada pode pedir uma chave que só responde pelos servidores dela; conceder uma, recusar uma, revogar a de outra pessoa e emitir uma do painel inteiro exigem todas a permissão.',
        'languages' => 'Idiomas',
        'languages_helper' => 'Responder a cada um no idioma que a conta dele tiver definido, onde este plugin estiver traduzido. Com isto desligado, todo mundo recebe inglês.',
        'minecraft' => 'Minecraft',
        'minecraft_helper' => 'Uma aba Minecraft na barra lateral, e uma página dentro de cada servidor Minecraft para editar o server.properties dele como formulário. Quais eggs contam é você que diz.',
        'palworld' => 'Configurações do Palworld',
        'palworld_helper' => 'Uma página dentro de um servidor Palworld para editar as configurações de mundo dele. Não aparece em nenhum outro servidor, e nunca enquanto aquele servidor estiver rodando.',
        'settings_search' => 'Busca de configurações',
        'settings_search_helper' => 'O campo acima destes formulários que reduz eles às seções que contêm o que você digitar.',
        'preview' => 'Prévia ao vivo',
        'preview_helper' => 'A caixa ao lado do formulário de Visual que mostra o que as cores, os cantos e os espaçamentos fazem antes de você salvar.',
        'duplicate' => 'Duplicar servidor',
        'duplicate_helper' => 'Uma página para montar outro servidor exatamente como um que você já tem, ou vários de uma vez. Os arquivos nunca são copiados.',
        'favourites' => 'Servidores marcados',
        'favourites_helper' => 'Uma estrela em cada cartão de servidor. Os marcados vêm primeiro, e a lista de cada um fica guardada no painel — então as estrelas acompanham a pessoa para onde ela entrar em seguida. Muda o que ela vê e nada para os outros. Ficar no painel quer dizer que é um arquivo em storage, que qualquer um com acesso à máquina pode ler.',
        'artwork' => 'Imagens dos eggs',
        'artwork_helper' => 'A página de administração que busca a imagem de cada egg na Steam ou no IGDB e grava no próprio egg.',
        'alerts' => 'Alertas',
        'alerts_helper' => 'A checagem periódica de um nó que parou de responder, de um disco enchendo, de um queue worker morto ou de uma versão ficando para trás, e a mensagem de Discord, de painel ou de e-mail que ela manda.',
        'backups' => 'Visão geral de backups',
        'backups_helper' => 'A página de administração que lista todos os servidores pelo tempo que estão sem backup. Somente leitura.',
        'public_status' => 'Página de status pública',
        'public_status_helper' => 'A página que qualquer um pode abrir sem conta. Com isto desligado, o endereço responde 404 tenha o que tiver na lista.',
        'game_players' => 'Jogadores, outros jogos',
        'game_players_helper' => 'Uma página dentro do Rust, do ARK, do Valheim e de tudo o que responda à consulta da Valve, mostrando quem está conectado e há quanto tempo.',
        'owner_alerts' => 'Avisar as pessoas de que o servidor delas está offline',
        'owner_alerts_helper' => 'A única parte deste plugin que escreve para pessoas que não são administradoras: uma notificação no painel quando a máquina de um dos servidores delas para de responder, e outra quando ela volta. Desligado até ser ligado aqui e na página de Alertas, nas duas - ele escreve para os seus clientes, então exige duas decisões e não uma.',
        'my_backups' => 'Aviso de backup na lista de servidores',
        'my_backups_helper' => 'Uma linha acima da lista de servidores de cada um quando algum dos dele nunca recebeu backup ou está há um tempo sem. Os cartões do Pelican dizem o que um servidor está fazendo agora; nada ali diz que não roda um backup faz três semanas. Só é desenhada quando algo está atrasado, e ela não nomeia nenhum servidor que a pessoa já não pudesse abrir.',
        'capacity' => 'Visão geral de capacidade',
        'capacity_helper' => 'A página de administração que mostra memória, disco e processador prometidos diante dos disponíveis em cada máquina, com os servidores que ficaram sem backups, sem bancos de dados ou sem alocações. Prometido e não consumido - um nó pode estar ocupado e vazio, ou parado e cheio.',
        'schedules' => 'Visão geral das tarefas agendadas',
        'schedules_helper' => 'A página de administração que lista todas as tarefas agendadas do painel, as piores primeiro - travadas, atrasadas, ou que nunca rodaram. Somente leitura; tudo o que edita ou roda uma fica na página do Pelican daquele servidor.',
        'activity' => 'Atividade do painel',
        'activity_helper' => 'A página de administração que lista todos os eventos registrados do painel, o mais recente primeiro, com quem fez e em qual servidor. Somente leitura - ela não apaga nada, e a configuração do próprio Pelican continua decidindo por quanto tempo as linhas ficam guardadas.',
        'access' => 'Acesso a servidores por cargo',
        'access_helper' => 'Uma página para amarrar um cargo a servidores, mantida certa na tabela de subusers do próprio Pelican. Ela não concede nada enquanto você não vincular alguma coisa. Desligar para a reconciliação; o acesso já concedido continua, e a página tem um botão para tirar de volta.',
        'scheduled' => 'Estilos por horário',
        'scheduled_helper' => 'A seção da página de Visual para dar ao painel um estilo diferente entre dois horários do dia. Ela não muda nada do que está salvo — uma faixa é posta por cima das configurações enquanto a página é desenhada e solta logo em seguida — então desligar devolve a aparência própria do painel na hora e não perde nada.',
        'games' => 'Outros jogos',
        'games_helper' => 'As configurações de mundo do ARK, e as listas de admins, banidos e permitidos do Valheim, como formulários em vez de arquivos no gerenciador de arquivos. Quais servidores as recebem é a lista de eggs da página Outros jogos.',
        'quick' => 'Menu «Ir para»',
        'quick_helper' => 'Um controle no topo de cada página para pular para um servidor ou para uma página marcada, com um campo de busca sobre toda a sua lista de servidores. Ele também marca a página em que você está. O que alguém acha por ele é o que já conseguia alcançar, então não concede nada - desligar tira o atalho e a página de Favoritos junto.',
    ],

    /*
     * O campo de busca acima dos formulários de configurações. Ele filtra o que
     * já está na página dentro do navegador e não pede nada ao servidor, então
     * não tem estado de «buscando» para descrever nem jeito de falhar.
     */
    /*
     * A caixa de prévia. Tudo nela é um substituto e não uma amostra do seu
     * painel, e as palavras dizem isso - uma caixa que nomeasse um servidor de
     * verdade ou um número de verdade seria lida como tal.
     */
    'preview' => [
        'label' => 'Prévia',
        'card' => 'Um cartão',
        'card_helper' => 'Desenhado pelas mesmas regras do painel, com as configurações desta página em vez das salvas.',
        'button' => 'Um botão',
        'field' => 'Um campo',
        'meter_ok' => 'Ok',
        'meter_warning' => 'Aviso',
        'meter_danger' => 'Perigo',

        /*
         * A prévia de página inteira. Uma aba e não um painel, porque o Pelican
         * manda X-Frame-Options: DENY e recusa ser enquadrado por qualquer
         * coisa, inclusive por ele mesmo - veja Support\FullPreview.
         */
        'full' => 'Ver o painel inteiro',
        'full_confirm' => 'Abre o painel desenhado a partir das configurações desta página em vez das salvas. Nada é gravado — os valores ficam guardados por quinze minutos e o painel volta ao normal quando você sair da prévia ou salvar.',
        'full_go' => 'Mostrar',
        'full_failed' => 'Não foi possível iniciar a prévia',
        'bar' => 'Você está vendo configurações não salvas. Nada disto foi gravado.',
        'bar_back' => 'Voltar às configurações',
    ],

    'search' => [
        'placeholder' => 'Buscar nas configurações',
        'label' => 'Buscar nestas configurações',
        'none' => 'Nada nesta página combina. As configurações estão espalhadas por quatro páginas — tente Visual, Páginas, Avançado, ou Configurações do Essentials.',
    ],

    'footer' => [
        'text' => 'Sua própria linha',
        'text_helper' => 'Texto simples, no máximo 120 caracteres. É escapado, igual à faixa de aviso — isto é desenhado em todas as páginas do painel, o que faz dele o lugar errado para aceitar marcação.',
        'version' => 'Mostrar a versão do painel',
        'version_helper' => 'A versão do Pelican, não a deste plugin. O plugin diz a dele no painel inicial; o que as pessoas procuram no fim de uma barra lateral é qual painel estão olhando.',
        'link_label' => 'Texto do link',
        'link_url' => 'Endereço do link',
        'link_url_helper' => 'Um endereço http ou https, ou um caminho do próprio painel como /account. Abre em uma aba nova.',
    ],

    'layout' => [
        'label' => 'Layout',
        'helper' => 'Como o painel está arrumado, e não de que cor ele é. Vale igual para a área de administração, a lista de servidores e a área de cliente. Onde a navegação fica é um padrão: quem tiver definido a dele em Conta → Navegação mantém.',
        'default' => 'Barra lateral — a do Pelican',
        'rail' => 'Trilho de ícones — estreito, abre ao passar o mouse',
        'top' => 'Navegação no topo — sem barra lateral',
        'mixed' => 'Barra de cima e barra lateral — as duas',
        'wide' => 'Largo — o conteúdo usa a tela toda',
        'focus' => 'Focado — coluna estreita, a barra lateral se recolhe',

        'nav_label' => 'Estilo da barra lateral',
        'nav_helper' => 'Como a própria barra lateral é desenhada.',
        'nav_default' => 'Padrão',
        'nav_floating' => 'Flutuante — um cartão à parte',
        'nav_flat' => 'Plana — sem fundo nenhum',
        'nav_bordered' => 'Com borda — uma linha, não uma superfície',

        'topbar_label' => 'Estilo da topbar',
        'topbar_helper' => '«Escondida» vale só no computador — em um celular, a topbar carrega o único caminho de volta ao menu.',
        'topbar_default' => 'Padrão',
        'topbar_floating' => 'Flutuante — uma barra solta',
        'topbar_flush' => 'Rente — plana, sem desfoque',
        'topbar_hidden' => 'Escondida no computador',

        'card_label' => 'Estilo dos cartões',
        'card_helper' => 'As seções, os widgets, os cartões de servidor e os blocos acima do console.',
        'card_default' => 'Padrão — elevado, com borda suave',
        'card_flat' => 'Plano — sem elevação',
        'card_outline' => 'Contorno — uma borda e nada atrás',
        'card_glass' => 'Fosco — o fundo aparece através',
        'card_sharp' => 'Reto — cantos quadrados',
    ],

    'servers' => [
        /*
         * A estrela em um cartão. Entregue ao script em vez de escrita dentro
         * dele, para os textos ficarem no único lugar onde textos moram.
         */
        'favourite' => 'Marcar este servidor',
        'favourited' => 'Marcado — aparece primeiro',

        /*
         * A pastilha ao lado das abas do Pelican. Nomeada pelo que faz com a
         * lista e não como uma quarta aba, porque ela filtra a aba escolhida em
         * vez de substituir.
         */
        'favourites_tab' => 'Favoritos',
        'favourites_empty' => 'Nada marcado nesta página. Use a estrela de um cartão de servidor para adicionar um — e note que isto filtra os servidores já listados aqui: um servidor marcado em uma página seguinte não está sendo escondido, ele simplesmente não está nesta.',
        'favourites_failed' => 'Não foi possível salvar seus servidores marcados, então eles voltaram ao último estado que o painel tinha. O console do navegador diz o que a requisição respondeu.',

        'art' => 'Imagem do jogo',
        'art_helper' => 'O Pelican desenha a imagem do egg em cada cartão. Isto decide o que se faz com ela.',
        'art_faded' => 'Desbotada — um véu atrás do texto',
        'art_cover' => 'Cobrindo — atrás do nome, sumindo aos poucos',
        'art_off' => 'Desligada',
        'art_dim' => 'Escurecer a imagem',
        'art_dim_helper' => 'A imagem de um jogo é um céu claro e a de outro é uma caverna.',

        'status' => 'Marca de estado',
        'status_helper' => 'Onde a cor de rodando / iniciando / parado é mostrada.',
        'status_bar' => 'Barra — na borda esquerda',
        'status_edge' => 'Borda — atravessando o topo',
        'status_dot' => 'Ponto — no canto',
        'status_off' => 'Desligada',

        'density' => 'Altura dos cartões',
        'density_comfortable' => 'Confortável',
        'density_compact' => 'Compacta — para muitos servidores',

        'filter_label' => 'Colocar texto no botão de filtro',
        'filter_label_helper' => 'O Pelican já filtra esta lista por egg e por dono, em todas as páginas - mas a entrada é um ícone sem texto ao lado do campo de busca. Isto coloca a palavra nele.',
        'filter_button' => 'Filtros',

        'columns' => 'Cartões lado a lado em tela grande',
        'columns_helper' => 'Vale só para a grade, e só a partir de 1280px. O máximo do próprio Pelican é dois.',
    ],

    'controls' => [
        'mode' => 'Botão de console em toda página de servidor',
        'mode_helper' => 'Um botão flutuante, em toda página dentro de um servidor. Ele abre o console por cima do que você estava fazendo, com o estado e os botões de energia no cabeçalho — alcançando o nó direto, do jeito que a lista de servidores faz, e não pelo websocket da página do console. Ele nunca aparece na página do console, que já tem tudo isso.',
        'mode_full' => 'Console e botões de energia',
        'mode_console' => 'Somente o console',
        'mode_off' => 'Desligado',

        'label' => 'O botão mostra',
        'label_text' => 'Ícone e nome',
        'label_icon' => 'Somente o ícone',

        'position' => 'Onde ele flutua',
        'position_helper' => 'Contra a borda que você tem menos chance de estar lendo.',
        'position_top' => 'Em cima',
        'position_right' => 'À direita',
        'position_bottom' => 'Embaixo',
    ],

    'console' => [
        'stats' => 'Blocos acima do console',
        'stats_helper' => 'O Pelican mostra o nome, o estado, o endereço e os três números de uso acima do terminal. Esconder eles devolve a altura ao console.',
        'stats_tiles' => 'Blocos — rótulo, número e um ícone',
        'stats_plain' => 'Simples — do jeito que o Pelican desenha',
        'stats_off' => 'Escondidos',
    ],

    'terminal' => [
        'helper' => 'São entregues ao próprio terminal, então valem a partir do próximo carregamento da página e não no momento em que você salva.',

        'renderer' => 'Desenhado por',
        'renderer_helper' => 'O Pelican desenha o terminal na GPU, o que é bem mais rápido diante de uma parede de saída rolando. Um navegador só mantém vivos alguns contextos de GPU ao mesmo tempo — menos em um celular — e tira o mais antigo quando o limite é passado; aí o terminal não desenha mais nada, sem nenhum erro. Se o seu console ficar em branco e todo o resto parecer certo, é esta a configuração que se muda.',
        'renderer_webgl' => 'A GPU — a do Pelican, mais rápida',
        'renderer_dom' => 'O navegador — mais lento, sempre desenha',

        'scheme' => 'Esquema de cores',
        'scheme_helper' => 'A única configuração de terminal que o Pelican não oferece. «Seguir o tema» tira as cores do acento, e é por isso que isto existe.',
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
        'cursor_helper' => 'O console não aceita digitação — o campo de comando fica embaixo — então isto é onde a saída parou, e não onde você está.',
        'cursor_underline' => 'Sublinhado — o do Pelican',
        'cursor_block' => 'Bloco',
        'cursor_bar' => 'Barra',

        'blink' => 'Cursor piscando',

        'scrollback' => 'Histórico de rolagem',
        'scrollback_helper' => 'Até onde dá para subir no console. Cada linha fica guardada no navegador, então um servidor falante com um valor alto é memória de verdade na máquina que está lendo.',
        'scrollback_lines' => ':lines linhas',
    ],

    'notice' => [
        'text' => 'Mensagem',
        'text_helper' => 'Uma linha, até 200 caracteres. Ela é escapada na entrada e na saída, então não tem como levar marcação para uma página que outras pessoas carreguem.',
        'style' => 'Tom',
        'style_info' => 'Informação',
        'style_warning' => 'Aviso',
        'style_danger' => 'Urgente',
        'style_accent' => 'Cor de acento',
        'scope' => 'Mostrada para',
        'scope_all' => 'Todo mundo',
        'scope_client' => 'Somente fora da área de administração',
        'scope_admin' => 'Somente na área de administração',
        'link_label' => 'Texto do botão',
        'link_url' => 'Endereço do botão',
        'link_url_helper' => 'https:// ou um caminho dentro deste painel, como /account. Todo o resto é ignorado — um link em uma faixa que aparece em toda página não é lugar para um esquema que ninguém espera.',
        'dismissible' => 'Pode ser fechada',
        'dismissible_helper' => 'Ter sido fechada é lembrado por navegador, e só para esta mensagem: mude o texto e ela volta para todo mundo.',
        'dismiss' => 'Fechar',
    ],

    'preset' => [
        'label' => 'Estilo',
        'helper' => 'Escolha uma aparência de partida. Ela preenche tudo o que está abaixo, que você pode mudar depois. «Nenhum» desliga o tema e deixa o painel exatamente como o Pelican entrega.',
        'options' => [
            'none' => 'Nenhum - sem tema',
            'legend' => 'Legend - fogo vermelho virando raio azul',
            'ember' => 'Ember - preto quente, acento laranja',
            'midnight' => 'Midnight - azul profundo, calmo',
            'crimson' => 'Crimson - vermelho, cantos retos, compacto',
            'forest' => 'Forest - verde, arredondado, sem brilho',
            'nebula' => 'Nebula - roxo com um fundo em degradê',
            'terminal' => 'Terminal - verde no preto, monoespaçado, reto',
            'console' => 'Console - redondo e espaçoso, para um tablet',
            'nord' => 'Nord - a paleta Nord, discreta',
            'solarized' => 'Solarized - Solarized dark, acento ciano',
            'paper' => 'Paper - claro, muito contraste, plano',
            'daylight' => 'Daylight - claro e quente, com um véu suave',
            'mono' => 'Mono - tons de cinza, plano e denso',
        ],

        'save' => 'Salvar como estilo',
        'save_confirm' => 'Guarda as cores, os cantos, o fundo, a tipografia, os ícones e os limites dos medidores que você tem na tela agora — com um nome seu, no seletor ao lado dos que já vêm. Ele salva o que está na página, e não o que foi salvo por último.',
        'save_name' => 'Nome',
        'save_name_helper' => 'Como ele vai se chamar no seletor. Salvar com um nome que você já usou substitui aquele.',
        'saved' => 'Estilo salvo',
        'save_failed' => 'Não foi possível salvar esse estilo',
        'save_full' => 'Tem espaço para :max estilos seus. Apague um primeiro.',

        'delete' => 'Apagar um estilo',
        'delete_which' => 'Qual',
        'delete_confirm' => 'Só dá para apagar os estilos seus; os que já vêm não. Nada muda na aparência atual do painel — um estilo é um ponto de partida, e todos os valores que ele definiu já estão nas configurações abaixo.',
        'deleted' => 'Estilo apagado',
        'deleted_current' => 'Era esse que este painel estava usando. As configurações dele estão intactas e continuam nesta página — escolha um estilo, ou salve de novo com um nome.',
    ],

    'user_themes' => [
        'label' => 'Estilos que as pessoas podem escolher para si',
        'helper' => 'Os estilos marcados aparecem em uma página de Aparência dentro da área de cliente, onde qualquer pessoa logada pode escolher um para si. Muda o que ela vê e nada para os outros. Nada marcado quer dizer que ninguém escolhe nada e que o painel mantém uma aparência só — que é o que ele faz hoje.',
    ],

    'mode' => [
        'label' => 'Modo do painel',
        'helper' => 'Em qual modo o painel abre. Quem não escolheu por conta própria recebe este; o botão no menu de usuário continua deixando trocar, a não ser que você trave abaixo.',
        'dark' => 'Escuro',
        'light' => 'Claro',
        'system' => 'Sistema — seguir a configuração do visitante',
    ],

    'font' => [
        'label' => 'Tipografia do painel',
        'helper' => 'Cada opção é uma família que o sistema operacional já tem — nada é buscado em um provedor de fontes. O terminal não é afetado: a fonte dele é escolha de cada um, em Conta.',
        'default' => 'Padrão - a do Pelican',
        'mono' => 'Monoespaçada',
        'rounded' => 'Arredondada',
        'serif' => 'Serifada',
        'system' => 'Sistema - a que esta máquina usar',
    ],

    'surface' => [
        'label' => 'Cor das superfícies',
        'helper' => 'Os cartões e os painéis. Os tons mais claros e mais escuros saem dela.',
        'placeholder' => 'Seguir o tema',
    ],

    'radius' => [
        'label' => 'Cantos',
    ],

    'accent' => [
        'label' => 'Cor de acento',
        'helper' => 'Usada nos botões, nos links, na entrada de navegação ativa e nos anéis de foco.',

        /*
         * Dito, não imposto. Uma cor sobre a qual isto avisa é salva do mesmo
         * jeito: é o painel de alguém, o número mede uma coisa só, e há bons
         * motivos para querer um acento que pontue mal. O seletor diz o que vê
         * e sai da frente.
         */
        'contrast_dark' => 'Legibilidade: :ratio contra um painel escuro. Abaixo de 3 um acento fica difícil de ler como botão ou como link — um mais claro levanta ele.',
        'contrast_light' => 'Legibilidade: :ratio contra um painel claro. Abaixo de 3 um acento fica difícil de ler como botão ou como link — um mais escuro levanta ele.',
    ],
    'density' => [
        'label' => 'Densidade',
        'helper' => 'Compacta aperta os espaçamentos para caberem mais linhas na tela.',
        'comfortable' => 'Confortável',
        'compact' => 'Compacta',
    ],
    'force_dark' => [
        'label' => 'Forçar o modo escuro',
        'helper' => 'Esconde o botão claro/escuro e mantém todos os usuários no tema escuro.',
    ],
    'glass' => [
        'label' => 'Topbar fosca',
        'helper' => 'Desfoca a topbar e os fundos das janelas modais. Desligue em aparelhos modestos.',
    ],
    'glow' => [
        'label' => 'Brilho de acento',
        'helper' => 'Uma sombra de acento suave nos botões principais, na navegação ativa e no cartão de entrada.',
    ],

    'background' => [
        'label' => 'Tipo de fundo',
        'helper' => 'Aurora é o fundo próprio do tema: brilhos de acento com um grão fino.',
        'aurora' => 'Aurora (padrão)',
        'solid' => 'Uma cor só',
        'gradient' => 'Degradê',
        'image' => 'Imagem',
        'color' => 'Cor',
        'base' => 'Cor atrás dos brilhos',
        'base_helper' => 'Sobre o que a página se apoia antes de os brilhos de acento serem pintados por cima. Deixe vazio para manter o padrão do painel, quase preto no escuro e quase branco no claro. Defina e um esquema mantém a cor de noite dele e continua ficando iluminado.',
        'color_end' => 'Segunda cor',
        'angle' => 'Direção',
        'upload' => 'Enviar uma imagem',
        'upload_helper' => 'Até 8 MB. Uma imagem enviada tem prioridade sobre a URL abaixo.',
        'url' => 'Ou uma URL',
        'url_helper' => 'Precisa começar com https:// e ser alcançável de fora.',
        'dim' => 'Escurecer',
        'dim_helper' => 'Sem escurecer, texto branco sobre uma foto clara não dá para ler.',
        'blur' => 'Desfoque',
    ],

    'channel' => [
        'installed' => 'instalada',
        'version' => 'Instalar uma versão específica',
        'version_helper' => 'Qualquer versão deste canal, e não só a mais nova — para voltar atrás quando algo novo sai pior, ou para a frente para um build que te falaram para testar. Só enquanto as atualizações não se instalarem sozinhas: com isso ligado, o que você escolher duraria até a próxima checagem.',
        'version_placeholder' => 'Escolha uma versão',
        'version_install' => 'Instalar esta versão',
        'version_confirm' => 'O painel baixa essa versão, reconstrói os assets dele e limpa os caches. Suas configurações são mantidas. Voltar para uma versão mais antiga é permitido e não é desfeito sozinho — escolha a mais nova de novo para avançar.',
        'label' => 'Canal de atualização',
        'helper' => 'Quais versões a página do tema oferece. O Beta recebe as versões novas primeiro, e as arestas também primeiro.',
        'stable' => 'Estável',
        'beta' => 'Beta',
        'dev' => 'Dev (branch de trabalho)',
        'auto' => [
            'label' => 'Instalar as atualizações automaticamente',
            'helper' => 'Desligado deixa a atualização com você. Ligado, o painel checa o canal escolhido e instala tudo o que for mais novo - ele reconstrói os assets durante isso e fica indisponível por alguns minutos, por isso o diário e o semanal vão às 04:00. Precisa do cron do painel rodando.',
            'interval' => 'Checar a cada',
            'minute' => 'A cada minuto',
            'five_minutes' => 'A cada 5 minutos',
            'ten_minutes' => 'A cada 10 minutos',
            'thirty_minutes' => 'A cada 30 minutos',
            'hourly' => 'A cada hora',
            'daily' => 'Todo dia (04:00)',
            'weekly' => 'Toda semana (segunda-feira 04:00)',
        ],
    ],

    /*
     * A aba de Idiomas.
     *
     * Cuidadosa com o que afirma. O Pelican já deixa cada pessoa escolher um
     * idioma para a conta inteira e já aplica; nada aqui muda isso nem deveria.
     * Isto decide apenas se os textos próprios deste plugin seguem essa
     * escolha.
     */
    'languages' => [
        'section_helper' => 'O Pelican já deixa cada um escolher um idioma para a conta, e este plugin segue onde ele estiver traduzido. É aqui que você decide quais deles ele vai seguir. A maioria dos idiomas está em uma porcentagem baixa de propósito: o que é traduzido primeiro é a parte que todo mundo vê em toda página — os botões de energia acima de um console e os medidores dos nós — e o resto chega conforme as pessoas contribuem.',
        'panel' => 'Deixar isto decidir o idioma do painel inteiro',
        'panel_helper' => 'Ligado, um idioma que este plugin não traz — ou um desligado abaixo — coloca o painel inteiro em inglês para aquele leitor, e não só estas páginas. Desligado, só este plugin segue a lista e o Pelican continua falando o que a conta tiver definido, o que quer dizer que um leitor pode encontrar dois idiomas em uma mesma tela. Nenhuma conta é alterada de um jeito nem de outro: ligue um idioma de novo e ele volta a ter.',
        'label' => 'Idiomas em que responder',
        'helper' => 'Desmarcar um manda de volta para o inglês, só neste plugin, os leitores que tiverem ele definido na conta — o resto do painel continua falando o idioma deles. O inglês não está na lista porque tudo cai de volta nele.',
        'under' => 'não é oferecido enquanto não avançar mais — marque para oferecer mesmo assim',
        'done' => ':percent % traduzido',
        'main' => 'Idioma principal',
        'main_helper' => 'O que um leitor recebe quando o idioma dele não pode ser usado — ou este plugin não traz, ou ele está desmarcado abaixo. Sempre foi o inglês; em um time que não trabalha em inglês essa era uma resposta errada dada com confiança. Ele não pode ser desmarcado abaixo, porque tudo cai de volta nele.',
        'labels' => 'Como cada idioma se chama',
        'labels_helper' => 'O nome que leitores e administradores veem nos seletores. Deixe um vazio para manter o nome pelo qual este plugin conhece ele. Um idioma enviado com um nome seu não tem nenhum, então apareceria com o código dele até você dar um aqui.',
        'labels_code' => 'Código',
        'labels_name' => 'Mostrado como',
        'download' => 'Baixar um arquivo de tradução',
        'download_from' => 'Partir de',
        'download_from_helper' => 'Um JSON com todos os textos deste plugin. Escolha inglês para um idioma que ninguém começou, ou um existente para continuar o que já está traduzido.',
        'code' => 'Código de idioma',
        'code_helper' => 'O código a que o arquivo corresponde. Um locale de verdade, do jeito que as contas usam — fr, de, pt_BR — chega nos leitores que tiverem ele definido, e precisa bater exatamente ou não chega. Um nome seu, como Gaming-BR, é permitido e funciona de outro jeito: o Pelican só deixa uma conta ter um locale de verdade, então ninguém consegue selecionar o seu. Ele é alcançável como idioma principal acima, que é o que todo mundo cujo idioma não pode ser usado recebe.',
        'url' => 'Ou buscar em um endereço',
        'url_helper' => 'Um endereço https que o painel consiga alcançar — um CDN, um bucket, um arquivo cru de um repositório. Ele é buscado uma vez ao salvar e gravado do mesmo jeito que um envio, então mudar o arquivo naquele endereço depois não faz nada até você salvar de novo. Um arquivo escolhido acima ganha de um endereço deixado neste campo.',
        'upload' => 'Enviar um arquivo de tradução',
        'upload_helper' => 'O JSON de cima, com os valores traduzidos. Ele é gravado fora do plugin, então uma atualização não joga fora, e é combinado por cima do inglês chave por chave — um arquivo com metade dos textos te dá meio idioma e inglês para o resto.',
        'uploaded' => ':count textos instalados para :code',
        'uploaded_halves' => 'Destes, :mine são textos próprios deste plugin e :panel são do painel. Zero de um dos lados quer dizer que aquela metade do arquivo não trazia nada — as chaves do plugin começam com essentials:: e as do painel não.',
        'uploaded_skipped' => ':count foram pulados: vazios, ou chaves que este plugin não tem. Os primeiros: :keys',
        'upload_failed' => 'Não foi possível ler esse arquivo',
        'upload_failed_body' => 'Precisa ser o JSON do download de cima — um objeto plano de chaves e textos. Verifique se um editor não salvou como outra coisa.',
    ],

    'windows' => [
        'add' => 'Adicionar uma faixa',
        'from' => 'De',
        'to' => 'Até',
        'to_helper' => 'Mais cedo que o começo quer dizer que ela atravessa a meia-noite — das 22:00 até as 06:00 é a noite.',
        'preset' => 'Estilo',
        'days' => 'Dias',
        'days_helper' => 'Deixe todos desmarcados para todos os dias. Uma faixa que atravessa a meia-noite pertence ao dia em que começa, então sexta das 22:00 até as 06:00 cobre a manhã de sábado.',
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
        'helper' => 'O botão «Organizar a página», em todas as páginas do painel. Quem tiver a permissão Organizar recebe ele e pode também definir o arranjo do qual todo mundo parte, ou um para um cargo. Desligado esconde para todo mundo; os arranjos já salvos ficam onde estão.',
        'roles' => 'Um arranjo não é uma permissão. Um bloco que um cargo esconde continua sendo um bloco que alguém poderia alcançar digitando o endereço — o que impede isso são as permissões do próprio Pelican, na página de cargos. Três camadas valem nesta ordem: a de partida comum, depois o cargo do leitor, depois o que ele mesmo tiver movido.',
        'users' => 'Deixar cada um organizar as próprias páginas',
        'users_helper' => 'Ligado, qualquer pessoa logada pode rearrumar e esconder blocos nas páginas que ela já vê, só para si — não muda nada para mais ninguém. Definir o arranjo de partida comum continua com a permissão Organizar.',
    ],

    'brand' => [
        'logo_height' => 'Altura do logo',
        'logo_height_helper' => 'O Pelican entrega 2rem. Valores maiores deixam o cabeçalho da barra lateral mais alto junto.',
        'logo_url' => 'Substituir o logo',
        'logo_url_helper' => 'Deixe vazio para manter aquilo para onde as configurações do próprio Pelican apontam.',
    ],

    'login' => [
        'image' => 'Imagem de fundo',
        'image_helper' => 'Somente para a tela de entrada. Sem ela, continua mostrando o fundo do painel.',
        'url' => 'Ou uma URL',
        'blur' => 'Desfoque do cartão',
        'blur_helper' => 'Deixa o cartão fosco para a imagem atrás aparecer através.',
        'width' => 'Largura do cartão',
        'position' => 'Enquadramento da imagem',
        'position_helper' => 'Qual parte da imagem sobrevive ao corte para a tela.',
        'position_center' => 'Centro',
        'position_top' => 'Em cima',
        'position_bottom' => 'Embaixo',
        'position_left' => 'À esquerda',
        'position_right' => 'À direita',
        'align' => 'Posição do cartão',
        'align_helper' => 'Onde o cartão de entrada fica ao longo da tela.',
        'align_center' => 'Centro',
        'align_start' => 'À esquerda',
        'align_end' => 'À direita',
        'opacity' => 'Opacidade do cartão',
        'opacity_helper' => 'Mais baixa deixa passar mais imagem através do cartão.',
        'glow' => 'Brilho de acento',
        'glow_helper' => 'O halo em volta do cartão. Desligado mantém a borda e a profundidade dele.',
        'hide_heading' => 'Esconder o título',
        'hide_heading_helper' => 'Tira o título acima do formulário, deixando o formulário sozinho.',
        'hide_footer' => 'Esconder o rodapé',
        'hide_footer_helper' => 'Tira a linha abaixo do cartão que leva para pelican.dev.',
        'above' => 'Linha acima do formulário',
        'above_helper' => 'Uma linha, mostrada para todo mundo que chegar na tela de entrada. Deixe vazio para nenhuma.',
        'notice' => 'Recado abaixo do cartão',
        'notice_helper' => 'Uma linha, mostrada para todo mundo que chegar na tela de entrada. Deixe vazio para nenhum.',
    ],

    'advanced' => [
        'css' => 'CSS próprio',
        'css_helper' => 'Até 100 KB. Salvo em storage, não no .env.',
        'reference' => 'Referência de CSS',
        'reference_helper' => 'Todas as variáveis e classes que este tema e o painel expõem.',
    ],

    'areas' => [
        'add' => 'Adicionar uma área',
        'area' => 'Área',
        'inherit' => 'Geral',
        'radius' => 'Cantos',
        'radius_sharp' => 'Retos',
        'radius_normal' => 'Normais',
        'radius_round' => 'Arredondados',
        'surface' => 'Cor das superfícies',
        'surface_helper' => 'Os cartões e os painéis dentro desta área; os tons mais claros e mais escuros saem dela.',
        'names' => [
            'terminal' => 'Terminal',
            'console' => 'Console (o resto da página)',
            'files' => 'Página de arquivos',
            'edit' => 'Página de edição',
            'server' => 'Outras páginas e abas de servidor',
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
        'accent_helper' => 'Vale para os ícones da barra lateral e da topbar.',
        'pack' => 'Pacote de ícones',
        'pack_helper' => 'De qual conjunto o seletor abaixo puxa. São oferecidos todos os conjuntos de ícones instalados no servidor, mais o conjunto Essentials que vem com este plugin e qualquer pacote que você enviar. Tem uma diferença que vale saber: um ícone de traço é desenhado na cor do menu e acompanha o passar do mouse e a entrada ativa, enquanto os ícones do Essentials são imagens e mantêm as cores próprias deles. Isso é decidido pelo que o arquivo é, e não pelo conjunto de onde ele veio.',
        'pack_custom' => 'Pacote enviado',
        'pack_shipped' => 'Ícones do Essentials',
        'use_shipped' => 'Usar os ícones do Essentials em todo lugar',
        'use_shipped_confirm' => 'Coloca o pacote nos ícones do Essentials e preenche cada entrada de menu abaixo com o ícone desenhado para ela — o console recebe o terminal, a inicialização recebe o botão de lançar, e assim por diante. Isso substitui as entradas que você tem agora, e nada é salvo até você clicar em Salvar, então fechar a página desfaz.',
        'pack_upload' => 'Enviar um pacote',
        'pack_upload_helper' => 'Um .zip de arquivos SVG. Cada arquivo vira um ícone com o nome dele — logo.svg vira custom-logo. Enviar substitui o pacote que estiver lá. Os arquivos com mais de 256 KB e tudo o que passar de 4.000 ícones ficam de fora, e você é avisado de quantos: para dar uma escala, o conjunto Tabler inteiro chega perto de seis mil ícones em cerca de três megabytes, então um pacote bem maior que isso carrega outra coisa que não ícones e a maior parte será pulada. Um envio grande também pode ser recusado antes de este campo dizer qualquer coisa, pelo upload_max_filesize e pelo post_max_size no php.ini do host do painel — nenhuma configuração daqui consegue subir esses.',
        'pack_partial' => ':count ícones instalados, mas não todos',
        'pack_partial_body' => 'Pulados: :big grandes demais para um ícone, :unusable não utilizáveis como SVG, :duplicate com um nome já ocupado, :empty sem nada para desenhar depois de limpos. Um SVG com mais de 256 KB quase sempre é uma imagem embrulhada em um e não um desenho — exporte no tamanho de um ícone e ele fica com alguns kilobytes. Um ícone sem nada para desenhar só continha algo que aqui não é servido — se for um pacote inteiro, vale a pena avisar.',
        'pack_stopped_files' => 'Ele parou também no limite de quantos ícones um pacote pode ter.',
        'pack_stopped_size' => 'Ele parou também porque o resto do pacote, descompactado, dá mais do que o painel segura na memória de uma vez — o zip pode ser menor que isso, já que SVG comprime cerca de cinco para um.',
        'overrides' => 'Substituir ícones',
        'overrides_helper' => 'Uma linha por ícone que você quiser trocar. Escolha a entrada de menu, e depois escolha um ícone do pacote de cima, dê um endereço, ou envie uma imagem sua. Se tiver mais de um preenchido, ganha o envio, depois o endereço, depois o pacote.',
        'overrides_key' => 'Entrada de menu',
        'overrides_value' => 'Ícone do pacote',
        'overrides_url' => 'Ou um endereço',
        'overrides_url_helper' => 'Um endereço https de uma imagem hospedada por você — um CDN, um bucket, qualquer lugar que o navegador alcance. Nada é copiado para o painel, então trocar o arquivo naquele endereço muda o ícone sem encostar nesta página; o outro lado disso é um ícone que some quando o endereço some. Ele mantém as cores próprias, como uma imagem enviada.',
        'overrides_file' => 'Ou enviar uma imagem',
        /*
         * Diz em que consiste de fato a diferença, porque ela não é óbvia e é o
         * motivo pelo qual alguém escolheria um em vez do outro.
         */
        'overrides_file_helper' => 'PNG, SVG ou ICO. Um ícone do pacote é desenhado na cor do menu e acompanha o passar do mouse e a entrada ativa; uma imagem enviada mantém as cores próprias e não acompanha. Para um logo isso normalmente é o que se quer.',
        'overrides_add' => 'Substituir outro ícone',
        'overrides_search' => 'Digite um nome, ou a entrada de menu…',
    ],

    /*
     * Não dentro de «Marca». A marca fala da aparência do painel; isto fala de
     * como este plugin aparece dentro dele, que é outra pergunta e é respondida
     * em outra página.
     */
    'identity' => [
        'nav_icon' => 'Ícone da entrada «Configurações do Essentials»',
        'nav_icon_helper' => 'PNG, SVG ou ICO, até 8 MB. Substitui o ícone daquela única entrada da barra lateral; deixe vazio para o que este plugin traz. Ele é desenhado como imagem e não como ícone, então mantém as cores próprias em vez de seguir o texto — que é o que um logo normalmente quer. O arquivo é servido em vez de embutido, então cada navegador busca uma vez só, mas ainda assim vale a pena exportar algo pequeno: alguns kilobytes sobram para uma entrada de vinte pixels de altura. Se um envio falhar antes de este campo dizer qualquer coisa, o limite em que ele bateu é o upload_max_filesize no php.ini do painel.',
    ],
];
