<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * Os modos de jogo e as dificuldades não são traduzidos. O Minecraft
 * mostra-os dentro do jogo como Survival, Creative, Peaceful e Hard — e uma
 * definição com um nome diferente do do ecrã de onde vem é uma definição que é
 * preciso procurar duas vezes.
 *
 * O mesmo vale para os termos que estão no próprio server.properties:
 * whitelist, operator, seed, chunk, RCON, query, resource pack e o Nether.
 */

return [
    /* -------------------------------------------- o separador de admin --- */

    'nav_label' => 'Minecraft',
    'title' => 'Definições do Minecraft',
    'subheading' => 'O server.properties deste servidor, como formulário em vez de ficheiro de texto.',

    /*
     * O título em si não está aqui. Cada secção de definições tira o seu título
     * de settings.groups.<nome>, que é o que group() constrói.
     */
    'section_helper' => 'A que eggs isto se aplica, e tudo o resto que este plugin faz à volta do Minecraft.',

    'live' => 'Perguntar aos servidores quem está a jogar',
    'live_helper' => 'Acrescenta à página de Jogadores uma lista ao vivo de quem está ligado, pelo mesmo handshake que o cliente do Minecraft faz para desenhar um servidor na sua própria lista. Desligado por omissão porque é a única coisa daqui que abre uma ligação do painel diretamente para uma porta de jogo: se o painel e os nós estiverem em redes que não se alcançam, nada responde e a linha simplesmente não aparece. No servidor de jogo não é preciso ativar nada.',

    'eggs' => 'Que eggs são Minecraft',
    'eggs_helper' => 'Marque os eggs que correm um servidor Minecraft — Vanilla, Paper, Purpur, Fabric, Forge, e como quer que se chamem os seus. A página aparece dentro dos servidores que os usam, e em mais lado nenhum. No início não está nada marcado, e é de propósito: um plugin não pode saber que nomes deu aos seus eggs, e uma lista adivinhada estaria errada no painel de alguém logo na semana em que saísse.',

    /* ------------------------------------------- a página do servidor ---- */

    'groups' => [
        'general' => 'O servidor',
        'players' => 'Jogadores',
        'world' => 'O mundo',
        'performance' => 'Desempenho',
        'access' => 'Acesso e extras',
        'other' => 'Tudo o resto do ficheiro',
    ],

    'other_helper' => 'Lido do server.properties e deixado exatamente como está. Os mods e os modpacks põem aqui as suas próprias definições; são mostradas para que veja que existem, e mudam-se pelo gestor de ficheiros. Guardar esta página nunca lhes toca.',

    'reload' => 'Ler o ficheiro outra vez',

    'saved' => 'Guardado no server.properties',
    'saved_helper' => 'Entra em vigor no próximo arranque do servidor.',

    'running' => 'O servidor está a correr',
    'running_helper' => 'O Minecraft lê o server.properties ao arrancar e reescreve-o ao parar, por isso o que fosse guardado agora seria sobrescrito à saída. Pare o servidor e guarde outra vez.',

    'missing' => 'Não foi encontrado nenhum server.properties',
    'missing_helper' => 'O ficheiro aparece quando o servidor arranca pela primeira vez. Arranque-o uma vez e volte cá.',

    'failed' => 'Não foi possível guardar',
    'failed_helper' => 'O daemon recusou a escrita. O servidor pode ter arrancado enquanto esta página estava aberta.',

    /* ------------------------------------ o que cada chave significa ----- */

    'keys' => [
        'motd' => 'Mensagem na lista de servidores',
        'gamemode' => 'Modo de jogo',
        'difficulty' => 'Dificuldade',
        'hardcore' => 'Hardcore — a morte é definitiva',
        'force_gamemode' => 'Pôr toda a gente no modo predefinido ao entrar',
        'pvp' => 'Os jogadores podem magoar-se uns aos outros',

        'max_players' => 'Máximo de jogadores ao mesmo tempo',
        'white_list' => 'Só whitelist',
        'enforce_whitelist' => 'Expulsar quem não estiver na whitelist',
        'online_mode' => 'Verificar as contas junto da Mojang',
        'player_idle_timeout' => 'Expulsar ao fim de tantos minutos inativo',
        'op_permission_level' => 'O que um operator pode fazer (1–4)',

        'level_name' => 'Pasta do mundo',
        'level_seed' => 'Seed',
        'level_type' => 'Tipo de mundo',
        'allow_nether' => 'O Nether',
        'spawn_monsters' => 'Nascem monstros',
        'spawn_protection' => 'Blocos protegidos à volta do spawn',

        'view_distance' => 'Distância de visão em chunks',
        'simulation_distance' => 'Distância de simulação em chunks',
        'max_tick_time' => 'Watchdog, em milissegundos (-1 desliga)',
        'sync_chunk_writes' => 'Escrever os chunks diretamente no disco',

        'enable_command_block' => 'Blocos de comandos',
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
