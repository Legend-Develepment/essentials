<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * Os modos de jogo e as dificuldades não são traduzidos. O Minecraft mostra
 * eles dentro do jogo como Survival, Creative, Peaceful e Hard — e uma
 * configuração com nome diferente do da tela de onde ela vem é uma configuração
 * que se procura duas vezes.
 *
 * O mesmo vale para os termos que estão no próprio server.properties:
 * whitelist, operator, seed, chunk, RCON, query, resource pack e o Nether.
 */

return [
    /* -------------------------------------------------- a aba de admin --- */

    'nav_label' => 'Minecraft',
    'title' => 'Configurações do Minecraft',
    'subheading' => 'O server.properties deste servidor, como formulário em vez de arquivo de texto.',

    /*
     * O título em si não está aqui. Cada seção de configurações tira o título
     * de settings.groups.<nome>, que é o que group() constrói.
     */
    'section_helper' => 'A quais eggs isto se aplica, e tudo o mais que este plugin faz em volta do Minecraft.',

    'live' => 'Perguntar aos servidores quem está jogando',
    'live_helper' => 'Adiciona à página de Jogadores uma lista ao vivo de quem está conectado, pelo mesmo handshake que o cliente do Minecraft faz para desenhar um servidor na lista dele. Desligado por padrão porque é a única coisa aqui que abre uma conexão do painel direto para uma porta de jogo: se o seu painel e os seus nós estiverem em redes que não se alcançam, nada responde e a linha simplesmente não aparece. No servidor de jogo não precisa ligar nada.',

    'eggs' => 'Quais eggs são Minecraft',
    'eggs_helper' => 'Marque os eggs que rodam um servidor Minecraft — Vanilla, Paper, Purpur, Fabric, Forge, e como os seus se chamarem. A página aparece dentro dos servidores que os usam, e em nenhum outro lugar. No começo nada está marcado, e é de propósito: um plugin não tem como saber os nomes que você deu aos seus eggs, e uma lista chutada estaria errada no painel de alguém já na semana em que saísse.',

    /* ------------------------------------------- a página do servidor ---- */

    'groups' => [
        'general' => 'O servidor',
        'players' => 'Jogadores',
        'world' => 'O mundo',
        'performance' => 'Desempenho',
        'access' => 'Acesso e extras',
        'other' => 'Todo o resto do arquivo',
    ],

    'other_helper' => 'Lido do server.properties e deixado exatamente como está. Os mods e os modpacks colocam as configurações deles aqui; elas são mostradas para você ver que existem, e se mudam pelo gerenciador de arquivos. Salvar esta página nunca encosta nelas.',

    'reload' => 'Ler o arquivo de novo',

    'saved' => 'Salvo no server.properties',
    'saved_helper' => 'Vale a partir da próxima vez que o servidor iniciar.',

    'running' => 'O servidor está rodando',
    'running_helper' => 'O Minecraft lê o server.properties ao iniciar e reescreve ao parar, então o que fosse salvo agora seria sobrescrito na saída. Pare o servidor e salve de novo.',

    'missing' => 'Nenhum server.properties encontrado',
    'missing_helper' => 'O arquivo aparece quando o servidor é iniciado pela primeira vez. Inicie uma vez e volte aqui.',

    'failed' => 'Não foi possível salvar',
    'failed_helper' => 'O daemon recusou a gravação. O servidor pode ter iniciado enquanto esta página estava aberta.',

    /* ------------------------------------ o que cada chave quer dizer ---- */

    'keys' => [
        'motd' => 'Mensagem na lista de servidores',
        'gamemode' => 'Modo de jogo',
        'difficulty' => 'Dificuldade',
        'hardcore' => 'Hardcore — a morte é definitiva',
        'force_gamemode' => 'Colocar todo mundo no modo padrão ao entrar',
        'pvp' => 'Os jogadores podem se machucar',

        'max_players' => 'Máximo de jogadores ao mesmo tempo',
        'white_list' => 'Somente whitelist',
        'enforce_whitelist' => 'Expulsar quem não estiver na whitelist',
        'online_mode' => 'Conferir as contas com a Mojang',
        'player_idle_timeout' => 'Expulsar depois de tantos minutos parado',
        'op_permission_level' => 'O que um operator pode fazer (1–4)',

        'level_name' => 'Pasta do mundo',
        'level_seed' => 'Seed',
        'level_type' => 'Tipo de mundo',
        'allow_nether' => 'O Nether',
        'spawn_monsters' => 'Monstros aparecem',
        'spawn_protection' => 'Blocos protegidos em volta do spawn',

        'view_distance' => 'Distância de visão em chunks',
        'simulation_distance' => 'Distância de simulação em chunks',
        'max_tick_time' => 'Watchdog, em milissegundos (-1 desliga)',
        'sync_chunk_writes' => 'Gravar os chunks direto no disco',

        'enable_command_block' => 'Blocos de comando',
        'allow_flight' => 'Permitir voar',
        'enable_rcon' => 'RCON',
        'enable_query' => 'Query',
        'resource_pack' => 'Endereço do resource pack',
        'require_resource_pack' => 'O resource pack é obrigatório',
    ],

    'values' => [
        'survival' => 'Survival',
        'creative' => 'Creative',
        'adventure' => 'Adventure',
        'spectator' => 'Spectator',
        'peaceful' => 'Peaceful',
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
    ],
];
