<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * A página de status pública.
 *
 * A única coisa que este plugin serve para alguém que não está logado, e a
 * única página cujas palavras precisam ser lidas pensando que um desconhecido
 * vai ver - porque vai. Aqui nada diz qual nó, qual dono nem qual endereço; um
 * nome, se está rodando, e quanta gente está dentro.
 *
 * «Nó» só aparece nas configurações; na página pública é «máquina», porque ali
 * quem lê nunca ouviu falar do Pelican.
 */

return [
    // ---- a página de configurações ----------------------------------------
    'title' => 'Página de status pública',
    'nav_label' => 'Página de status',
    'subheading' => 'Uma página que qualquer um pode abrir, sem conta, mostrando quais dos seus servidores estão no ar. Nada aparece nela até você nomear um servidor abaixo.',

    'address' => 'Sua página de status está no ar em',
    'address_off' => 'Ainda não tem nada sendo servido. Adicione abaixo um servidor, uma máquina ou um serviço e salve, e o endereço aparece aqui.',

    'which' => 'O que é publicado',
    'which_helper' => 'A lista começa vazia e nada é público enquanto não tiver algo nela. Só são oferecidos os servidores que você já consegue abrir.',
    'add' => 'Publicar um servidor',
    'server' => 'Servidor',
    'shown_as' => 'Mostrado como',
    'shown_as_helper' => 'O que o público vê. Digite em vez de deixar o painel usar o nome de verdade - «mc-prod-3 (não mexer)» é um bilhete para você mesmo, não uma coisa para colocar em um fórum.',

    'look' => 'Texto',
    'look_helper' => 'Tudo o que está nesta página é lido por gente que não tem conta.',
    'heading' => 'Título',
    'heading_helper' => 'Deixado vazio, é usado o nome do próprio painel.',
    'note' => 'Uma linha acima da lista',
    'note_helper' => 'Para dizer o que está acontecendo - uma janela de manutenção, ou onde perguntar. Texto simples.',
    'link' => 'Link para o painel',
    'link_helper' => 'Um caminho de volta, no rodapé da página. Desligue se você preferir não anunciar onde fica o seu painel.',

    'save' => 'Salvar',
    'saved' => 'Salvo',
    'save_failed' => 'Nada foi salvo',
    'open' => 'Abrir a página',

    // ---- número de jogadores ----------------------------------------------
    'counts' => 'Número de jogadores',
    'counts_helper' => 'De onde vêm os números ao lado de um servidor. Os servidores de Minecraft respondem ao próprio handshake e se configuram em Minecraft; tudo o que está abaixo é para os jogos que respondem à consulta da Valve - Rust, ARK, Valheim, 7 Days to Die e quase tudo o mais que roda em Source ou Unreal.',
    'query_eggs' => 'Eggs que respondem à consulta da Valve',
    'query_eggs_helper' => 'Marque os eggs desses jogos. Essa mesma lista decide também quais servidores ganham uma página de Jogadores dentro do painel - uma pergunta feita por dois motivos. Nada é perguntado enquanto você não disser: isto é a única coisa aqui que abre uma conexão do painel direto para uma porta de jogo, então é uma escolha e não algo que começa a acontecer sozinho. Um servidor cuja porta não é alcançável a partir do painel simplesmente não mostra número.',

    // ---- os nós -----------------------------------------------------------
    'nodes' => 'Máquinas',
    'nodes_helper' => 'No ar ou fora, e nada além disso. Nem a carga nem o quanto o disco está cheio - quem pergunta se dá para jogar não precisa de um relatório de capacidade do seu hardware, e publicar um é desenhar o mapa de onde aperta.',
    'add_node' => 'Publicar uma máquina',
    'node' => 'Máquina',
    'node_shown_as_helper' => 'Digite. Um nó normalmente se chama algo como hetzner-fsn1-01, e isso é uma frase inteira sobre onde ficam as suas máquinas.',

    // ---- os monitores HTTP ------------------------------------------------
    'monitors' => 'Outros serviços',
    'monitors_helper' => 'Qualquer outra coisa que valha a pena saber que está no ar: seu site, uma API, o endpoint de saúde de um bot. O painel pergunta a cada um no mesmo ritmo dos servidores. Somente administradores - um monitor faz este painel buscar um endereço, e deixar qualquer um adicionar um transforma isso em uma sonda que dá para apontar para onde quiser.',
    'add_monitor' => 'Adicionar um serviço',
    'monitor_name' => 'Nome',
    'monitor_url' => 'Endereço',
    'monitor_url_helper' => 'Somente https. Se este painel buscasse http puro de tempos em tempos, contaria para qualquer um no caminho quais dos seus serviços existem.',
    'monitor_expect' => 'Esperado',
    'monitor_expect_helper' => 'Deixe vazio para «qualquer resposta», o que serve para um site que redireciona ou que responde 403 a uma requisição crua. Um número é para um endpoint escrito para dizer exatamente isso e nada mais - apertado demais, a linha fica vermelha para sempre em um serviço que está bem.',

    // ---- páginas para os usuários -----------------------------------------
    'users' => 'Páginas para os seus usuários',
    'users_helper' => 'Se as pessoas com servidores neste painel podem publicar uma página de status própria.',
    'user_pages' => 'Deixar os usuários fazerem a deles',
    'user_pages_helper' => 'Cada um ganha um endereço próprio em /status/o-apelido-dele, mostrando só os servidores que ele tem, com os nomes que ele digitar. Nenhuma máquina e nenhum outro serviço nelas - as duas coisas são só suas. Com isto ligado, eles acham em «Página de status» no menu da conta deles, em qualquer painel em que estejam.',

    // ---- a aparência ------------------------------------------------------
    'every' => 'Checar a cada',
    'every_helper' => 'De quanto em quanto tempo a página se reconstrói, e de quanto em quanto tempo ela se atualiza sozinha no navegador. Uma página que as pessoas ficam olhando durante um reinício quer segundos; uma linkada de um fórum que ninguém deixa aberta quer uma hora, e perguntar a cada nó todo minuto por causa dela é trabalho feito para ninguém.',
    'every_realtime' => 'Tempo real (10 segundos)',
    'every_30s' => '30 segundos',
    'every_1m' => '1 minuto',
    'every_5m' => '5 minutos',
    'every_10m' => '10 minutos',
    'every_30m' => '30 minutos',
    'every_60m' => '60 minutos',

    'style' => 'Estilo',
    'style_helper' => 'Uma das aparências do próprio painel, aplicada a esta página: a cor dele, os cinzas construídos a partir da superfície, e o quanto os cantos são arredondados. «Seguir o painel» quer dizer o que estiver definido hoje, incluindo qualquer mudança posterior.',
    'style_mine_helper' => 'Os estilos que este painel oferece, aplicados à sua página: uma cor, os cinzas construídos a partir dela, e o quanto os cantos são arredondados. Quais estilos estão nesta lista é o dono do painel que decide - a mesma lista da qual você pode escolher em Aparência. «Seguir o painel» quer dizer o que estiver definido.',
    'style_panel' => 'Seguir o painel',

    // ---- a página de alguém -----------------------------------------------
    'mine_title' => 'Minha página de status',
    'mine_nav_label' => 'Página de status',
    'mine_subheading' => 'Um endereço para dar às pessoas que jogam nos seus servidores. Mostra os servidores que você escolher e nada mais sobre este painel.',
    'mine_address' => 'Seu endereço',
    'mine_address_helper' => 'Pegue algo curto. Mudar depois quebra qualquer link que alguém já tenha salvado.',
    'mine_address_off' => 'Escolha abaixo um endereço e salve, e sua página aparece aqui.',
    'slug' => 'Endereço',
    'slug_helper' => 'Minúsculas, números e hifens. Três caracteres ou mais.',
    'mine_heading' => 'Título',
    'mine_heading_helper' => 'Deixado vazio, é usado o seu endereço.',
    'mine_note_helper' => 'Para dizer o que está acontecendo - um reinício, um evento, onde te achar. Texto simples, e lido por qualquer um que tenha o link.',
    'mine_which' => 'Seus servidores',
    'mine_which_helper' => 'Só são oferecidos os servidores que são seus. Ser subuser em outro lugar é acesso a uma máquina, não permissão para publicar que ela existe.',
    'mine_shown_as_helper' => 'O que os visitantes veem. Digite em vez de usar o nome do painel se esse nome for um bilhete para você mesmo.',
    'mine_look_helper' => 'Como sua página aparece para as pessoas para quem você a manda.',
    'mine_remove' => 'Tirar minha página do ar',
    'mine_remove_confirm' => 'Tira sua página do ar e libera o endereço para outra pessoa. Tudo o que você configurou é perdido; os servidores em si não são tocados.',
    'mine_removed' => 'Sua página foi tirada do ar',

    'why_slug' => 'Esse endereço não serve. Minúsculas, números e hifens, três caracteres ou mais - e algumas palavras são reservadas.',
    'why_taken' => 'Esse endereço já é de outra pessoa.',
    'why_unwritable' => 'Não foi possível gravar. Verifique se storage/app pertence ao usuário com que o painel roda.',

    // ---- os títulos na própria página -------------------------------------
    'section_servers' => 'Servidores',
    'section_nodes' => 'Máquinas',
    'section_monitors' => 'Serviços',

    // ---- a própria página -------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'Iniciando',

    /*
     * Não «offline», e a diferença conta em público.
     *
     * O painel não conseguiu alcançar o servidor. Isso normalmente é um nó em
     * manutenção ou um daemon reiniciando - não é a mesma coisa que o servidor
     * estar desligado, e dizer para cem jogadores que o servidor deles caiu
     * enquanto ele está rodando é pior do que admitir que não se sabe.
     */
    'unknown' => 'Desconhecido',

    'players' => 'Jogadores',
    'online_now' => 'jogando agora',
    'checked' => 'Checado',
    'next_check' => 'até a próxima checagem',
    'just_now' => 'agora mesmo',
    'seconds_ago' => 'há :count segundos',
    'panel' => 'Entrar',

    'all_up' => 'Está tudo rodando.',
    'some_down' => 'Alguma coisa não está rodando.',
    'empty' => 'Aqui ainda não tem nada publicado.',
];
