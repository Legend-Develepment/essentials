<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * A página de estado pública.
 *
 * A única coisa que este plugin serve a alguém que não tem sessão iniciada, e a
 * única página cujas palavras têm de ser lidas a pensar que um desconhecido as
 * verá - porque vai ver. Aqui nada diz que nó, que proprietário nem que
 * endereço; um nome, se está a correr, e quanta gente está lá dentro.
 *
 * «Nó» só aparece nas definições; na página pública é «máquina», porque aí lê
 * alguém que nunca ouviu falar do Pelican.
 */

return [
    // ---- a página de definições -------------------------------------------
    'title' => 'Página de estado pública',
    'nav_label' => 'Página de estado',
    'subheading' => 'Uma página que qualquer pessoa pode abrir, sem conta, a mostrar quais dos seus servidores estão a correr. Não aparece nada nela enquanto não nomear um servidor abaixo.',

    'address' => 'A sua página de estado está em',
    'address_off' => 'Ainda não é servido nada. Acrescente abaixo um servidor, uma máquina ou um serviço e guarde, e o endereço aparece aqui.',

    'which' => 'O que é publicado',
    'which_helper' => 'A lista começa vazia e nada é público enquanto não houver algo lá dentro. Só são oferecidos os servidores que já consegue abrir.',
    'add' => 'Publicar um servidor',
    'server' => 'Servidor',
    'shown_as' => 'Mostrado como',
    'shown_as_helper' => 'O que o público vê. Escreva-o em vez de deixar o painel usar o nome real - «mc-prod-3 (não mexer)» é uma nota para si, e não algo para pôr num fórum.',

    'look' => 'Texto',
    'look_helper' => 'Tudo o que está nesta página é lido por pessoas que não têm conta.',
    'heading' => 'Título',
    'heading_helper' => 'Deixado vazio, é usado o nome do próprio painel.',
    'note' => 'Uma linha por cima da lista',
    'note_helper' => 'Para dizer o que se passa - uma janela de manutenção, ou onde perguntar. Texto simples.',
    'link' => 'Ligação para o painel',
    'link_helper' => 'Um caminho de volta, no fundo da página. Desligue-o se preferir não anunciar onde está o seu painel.',

    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'Não foi guardado nada',
    'open' => 'Abrir a página',

    // ---- número de jogadores ----------------------------------------------
    'counts' => 'Número de jogadores',
    'counts_helper' => 'De onde vêm os números ao lado de um servidor. Os servidores de Minecraft respondem ao seu próprio handshake e configuram-se em Minecraft; tudo o que está abaixo é para os jogos que respondem à consulta da Valve - Rust, ARK, Valheim, 7 Days to Die e quase tudo o resto que corre sobre Source ou Unreal.',
    'query_eggs' => 'Eggs que respondem à consulta da Valve',
    'query_eggs_helper' => 'Marque os eggs desses jogos. Esta mesma lista decide também que servidores têm página de Jogadores dentro do painel - uma pergunta feita por duas razões. Não se pergunta nada enquanto não o disser: isto é a única coisa daqui que abre uma ligação do painel diretamente para uma porta de jogo, por isso é uma decisão e não algo que começa a acontecer sozinho. Um servidor cuja porta não seja alcançável a partir do painel simplesmente não mostra número.',

    // ---- os nós -----------------------------------------------------------
    'nodes' => 'Máquinas',
    'nodes_helper' => 'A correr ou parada, e nada mais. Nem a carga nem o quão cheio está o disco - quem pergunta se pode jogar não precisa de um relatório de capacidade do seu equipamento, e publicar um é desenhar o mapa de onde aperta.',
    'add_node' => 'Publicar uma máquina',
    'node' => 'Máquina',
    'node_shown_as_helper' => 'Escreva-o. Um nó chama-se normalmente algo como hetzner-fsn1-01, e isso é uma frase inteira sobre onde estão as suas máquinas.',

    // ---- os monitores HTTP ------------------------------------------------
    'monitors' => 'Outros serviços',
    'monitors_helper' => 'Tudo o resto de que vale a pena saber que está a correr: o seu site, uma API, o endpoint de saúde de um bot. O painel pergunta a cada um no mesmo ritmo que aos servidores. Só administradores - um monitor faz este painel ir buscar um endereço, e deixar qualquer pessoa acrescentar um transforma-o numa sonda que se pode apontar onde se quiser.',
    'add_monitor' => 'Acrescentar um serviço',
    'monitor_name' => 'Nome',
    'monitor_url' => 'Endereço',
    'monitor_url_helper' => 'Só https. Se este painel fosse buscar http simples de tempos a tempos, diria a qualquer pessoa que esteja pelo caminho quais dos seus serviços existem.',
    'monitor_expect' => 'Esperado',
    'monitor_expect_helper' => 'Deixe vazio para «qualquer resposta», o que serve para um site que redireciona ou que responde 403 a um pedido nu. Um número é para um endpoint escrito para dizer exatamente isso e nada mais - posto demasiado apertado, a linha fica vermelha para sempre num serviço que está bem.',

    // ---- páginas para os utilizadores -------------------------------------
    'users' => 'Páginas para os seus utilizadores',
    'users_helper' => 'Se as pessoas com servidores neste painel podem publicar uma página de estado própria.',
    'user_pages' => 'Deixar os utilizadores fazer a deles',
    'user_pages_helper' => 'Cada um recebe um endereço próprio em /status/o-atalho-dele, a mostrar apenas os servidores que possui, com os nomes que escrever. Nenhuma máquina e nenhum outro serviço nelas - as duas coisas são só suas. Com isto ligado, encontram-no em «Página de estado» no menu da conta deles, em qualquer painel onde estejam.',

    // ---- o aspeto ---------------------------------------------------------
    'every' => 'Verificar a cada',
    'every_helper' => 'De quanto em quanto tempo a página se reconstrói, e de quanto em quanto tempo se atualiza sozinha no navegador. Uma página que as pessoas olham durante um reinício quer segundos; uma ligada a partir de um fórum que ninguém tem aberta quer uma hora, e perguntar a cada nó a cada minuto por causa dela é trabalho feito para ninguém.',
    'every_realtime' => 'Tempo real (10 segundos)',
    'every_30s' => '30 segundos',
    'every_1m' => '1 minuto',
    'every_5m' => '5 minutos',
    'every_10m' => '10 minutos',
    'every_30m' => '30 minutos',
    'every_60m' => '60 minutos',

    'style' => 'Estilo',
    'style_helper' => 'Um dos aspetos do próprio painel, aplicado a esta página: a cor dele, os cinzentos construídos a partir da superfície, e o arredondado dos cantos. «Seguir o painel» significa aquele que estiver definido hoje, incluindo qualquer alteração posterior.',
    'style_mine_helper' => 'Os estilos que este painel oferece, aplicados à sua página: uma cor, os cinzentos construídos a partir dela, e o arredondado dos cantos. Que estilos estão nesta lista é o dono do painel que decide - a mesma lista de onde pode escolher em Aparência. «Seguir o painel» significa aquele que estiver definido.',
    'style_panel' => 'Seguir o painel',

    // ---- a página de alguém -----------------------------------------------
    'mine_title' => 'A minha página de estado',
    'mine_nav_label' => 'Página de estado',
    'mine_subheading' => 'Um endereço para dar às pessoas que jogam nos seus servidores. Mostra os servidores que escolher e mais nada sobre este painel.',
    'mine_address' => 'O seu endereço',
    'mine_address_helper' => 'Escolha algo curto. Mudá-lo mais tarde parte qualquer ligação que alguém já tenha guardado.',
    'mine_address_off' => 'Escolha abaixo um endereço e guarde, e a sua página aparece aqui.',
    'slug' => 'Endereço',
    'slug_helper' => 'Minúsculas, números e hífenes. Três caracteres ou mais.',
    'mine_heading' => 'Título',
    'mine_heading_helper' => 'Deixado vazio, é usado o seu endereço.',
    'mine_note_helper' => 'Para dizer o que se passa - um reinício, um evento, onde o encontrar. Texto simples, e lido por qualquer pessoa que tenha a ligação.',
    'mine_which' => 'Os seus servidores',
    'mine_which_helper' => 'Só são oferecidos os servidores que lhe pertencem. Ser subuser noutro sítio é acesso a uma máquina, e não permissão para publicar que ela existe.',
    'mine_shown_as_helper' => 'O que os visitantes veem. Escreva-o em vez de usar o nome do painel se esse nome for uma nota para si.',
    'mine_look_helper' => 'O aspeto da sua página para as pessoas a quem a envia.',
    'mine_remove' => 'Retirar a minha página',
    'mine_remove_confirm' => 'Retira a sua página e liberta o endereço para outra pessoa. Tudo o que tiver definido perde-se; os servidores em si não são tocados.',
    'mine_removed' => 'A sua página foi retirada',

    'why_slug' => 'Esse endereço não serve. Minúsculas, números e hífenes, três caracteres ou mais - e algumas palavras estão reservadas.',
    'why_taken' => 'Esse endereço já é de outra pessoa.',
    'why_unwritable' => 'Não foi possível escrever. Verifique que storage/app pertence ao utilizador com que o painel corre.',

    // ---- os títulos na própria página -------------------------------------
    'section_servers' => 'Servidores',
    'section_nodes' => 'Máquinas',
    'section_monitors' => 'Serviços',

    // ---- a própria página -------------------------------------------------
    'up' => 'Online',
    'down' => 'Offline',
    'starting' => 'A arrancar',

    /*
     * Não «offline», e a diferença conta em público.
     *
     * O painel não conseguiu alcançar o servidor. Isso é normalmente um nó em
     * manutenção ou um daemon a reiniciar - não é o mesmo que o servidor estar
     * desligado, e dizer a cem jogadores que o servidor deles caiu quando ele
     * está a correr é pior do que admitir que não se sabe.
     */
    'unknown' => 'Desconhecido',

    'players' => 'Jogadores',
    'online_now' => 'a jogar neste momento',
    'checked' => 'Verificado',
    'next_check' => 'até à próxima verificação',
    'just_now' => 'agora mesmo',
    'seconds_ago' => 'há :count segundos',
    'panel' => 'Iniciar sessão',

    'all_up' => 'Está tudo a correr.',
    'some_down' => 'Alguma coisa não está a correr.',
    'empty' => 'Aqui ainda não é publicado nada.',
];
