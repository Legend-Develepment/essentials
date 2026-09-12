<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * Uma entrada de fora do painel.
 *
 * Dois públicos num só ficheiro, e querem o contrário um do outro. Um
 * administrador que lê esta página está a decidir se confia uma chave a alguém,
 * por isso cada linha diz o que uma chave alcança e não como se chama. Quem
 * pede uma quer saber o que lhe entregam e o que acontece se a perder, e é por
 * isso que a frase sobre a chave ser mostrada uma só vez não é uma nota de
 * rodapé.
 *
 * Em lado nenhum se diz «token». «Chave» é a palavra da página de conta do
 * próprio Pelican, e um painel que dá dois nomes à mesma coisa é um painel onde
 * alguém procura o errado.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Chaves que permitem a algo fora do painel perguntar o que este plugin sabe. Só de leitura - nada aqui pode arrancar, parar ou alcançar um servidor.',

    'my_title' => 'Acesso à API',
    'my_nav_label' => 'Acesso à API',
    'my_subheading' => 'Uma chave sua, para um bot ou um script. Só responde pelos servidores que já consegue abrir.',

    // ---- o que é uma chave, dito uma vez, onde importa -------------------
    'address' => 'O endereço',
    'address_helper' => 'Envie a chave como cabeçalho Authorization: :example',

    /*
     * A única coisa que alguém tem de ter lido antes de fechar a janela.
     * Escrita como aquilo que se deve fazer e não como um aviso, porque
     * «guarde-a bem» é um conselho com que ninguém faz nada e «cole-a agora
     * onde o bot a lê» é.
     */
    'once' => 'Esta é a única vez que esta chave é mostrada',
    'once_body' => 'É guardada como hash, por isso ninguém - nem quem gere este painel - a consegue ler de volta. Cole-a agora onde o bot ou o script a lê. Se se perder, revogue esta e peça outra.',
    'copy' => 'Copiar',
    'copied' => 'Copiada',

    // ---- os estados ------------------------------------------------------
    'state' => 'Estado',
    'state_pending' => 'À espera',
    'state_active' => 'Ativa',
    'state_refused' => 'Recusada',
    'state_revoked' => 'Revogada',

    'state_pending_body' => 'Alguém tem de a conceder antes de ela responder seja ao que for.',
    'state_refused_body' => 'Isto foi recusado. Não foi emitido nada.',
    'state_revoked_body' => 'Esta chave foi retirada e já não responde.',

    // ---- os alcances -----------------------------------------------------
    'scope' => 'Alcança',
    'scope_person' => 'Os seus próprios servidores',
    'scope_panel' => 'O painel inteiro',

    'scope_person_helper' => 'Só responde pelos servidores que o dono já consegue abrir, perguntados da mesma maneira que o painel os pergunta. Perder esta chave não perde nada que o dono já não pudesse ver.',
    'scope_panel_helper' => 'Responde às perguntas do painel inteiro - cada nó, a capacidade, o watchdog, a própria máquina do painel. Para um bot que dá conta do painel em vez de para uma pessoa.',

    // ---- a tabela --------------------------------------------------------
    'column_name' => 'Para quê',
    'column_owner' => 'De quem',
    'column_prefix' => 'Chave',
    'column_asked' => 'Pedida',
    'column_used' => 'Última utilização',
    'column_expires' => 'Expira',

    'never_used' => 'Nunca',
    'no_expiry' => 'Até ser revogada',

    'tab_waiting' => 'À espera',
    'tab_active' => 'Ativas',
    'tab_all' => 'Todas',

    'empty' => 'Ainda não há chaves',
    'empty_body' => 'Ninguém pediu nenhuma e não foi emitida nenhuma. Esta página vai-se enchendo sozinha à medida que as pessoas o fazem.',

    'my_empty' => 'Não tem nenhuma chave',
    'my_empty_body' => 'Peça uma e aparecerá aqui com o que lhe tiver sido respondido.',

    // ---- pedir -----------------------------------------------------------
    'ask' => 'Pedir uma chave',
    'ask_name' => 'Para que serve',
    'ask_name_helper' => 'Umas quantas palavras, para mais tarde distinguir duas das suas e para quem a conceder saber o que está a conceder.',
    'ask_reason' => 'Algo que valha a pena acrescentar',
    'ask_reason_helper' => 'Opcional. Lido por quem decide.',
    'ask_sent' => 'Pedida',
    'ask_sent_body' => 'Aparece abaixo assim que alguém tiver respondido.',
    'ask_granted' => 'Aqui está a sua chave',
    'ask_open' => 'Já tem uma à espera de resposta',
    'ask_open_body' => 'Um pedido de cada vez. Cancele esse se foi um engano.',
    'ask_failed' => 'Isso não pôde ser pedido',

    'cancel' => 'Cancelar',
    'cancel_confirm' => 'Retira o pedido. Não foi emitido nada, por isso também não deixa nada de funcionar.',

    // ---- decidir ---------------------------------------------------------
    'grant' => 'Conceder',
    'grant_confirm' => 'Emite uma chave que responde pelos servidores desta pessoa, e mostra-a uma vez. Ela já vê tudo o que a chave irá reportar - isto decide se algo de fora do painel pode perguntar em nome dela.',
    'granted' => 'Concedida',

    'refuse' => 'Recusar',
    'refuse_answer' => 'O que lhes dizer',
    'refuse_answer_helper' => 'Opcional, e mostrado na página deles. Uma recusa sem razão é uma recusa que é pedida outra vez para a semana.',
    'refused' => 'Recusada',
    'collect' => 'Mostrar a minha chave',
    'state_ready_body' => 'Concedida. Carregue em Mostrar a minha chave para a ver - uma só vez, porque é guardada como hash e não pode ser lida de volta depois.',
    'replace' => 'Substituir',
    'replace_confirm' => 'Esta chave deixa de funcionar de imediato e uma nova toma o lugar dela, mostrada uma só vez. Não há maneira de consultar a antiga - nunca foi guardada - por isso substituí-la é a única resposta a tê-la perdido.',
    'granted_body' => 'São eles que a vão buscar, na sua própria página de Acesso à API. Não é mostrada aqui: uma chave pertence a quem a pediu, e não a quem disse que sim.',

    'revoke' => 'Revogar',
    'revoke_confirm' => 'A chave deixa de responder de imediato e o seu hash é removido, por isso não pode ser trazida de volta. Tudo o que a usa pára. Peça uma nova em vez de tentar desfazer isto.',
    'revoked' => 'Revogada',
    'forget' => 'Remover',
    'forget_confirm' => 'Tira a linha desta página de vez. Já deixou de responder, por isso nada do que está a funcionar pára - isto só remove o registo de que existiu.',
    'forgotten' => 'Removida',

    'mint' => 'Chave nova',
    'mint_body' => 'Para um bot e não para uma pessoa. É concedida no momento em que é criada, porque quem a teria aprovado é você.',
    'abilities' => 'Sobre o que pode perguntar',
    'abilities_helper' => 'Está tudo marcado para começar, porque era isso que uma chave era antes de isto existir. Desmarcar é o ato deliberado. O que fica guardado é a lista do que é permitido, por isso uma capacidade acrescentada numa versão posterior fica desligada nas chaves feitas antes dela - uma capacidade que ninguém marcou é uma capacidade que ninguém concedeu.',
    'ability_health' => 'Provar que a chave funciona',
    'ability_health_helper' => 'Não alcança mais nada. Seguro de chamar a intervalos regulares.',
    'ability_me' => 'Os seus próprios servidores',
    'ability_me_helper' => 'Os servidores que o dono já consegue abrir, e as cópias deles. Nunca consegue ver mais ninguém.',
    'ability_panel' => 'O painel inteiro',
    'ability_panel_helper' => 'Cada nó, cada cópia de segurança, as tarefas agendadas paradas, o watchdog e a máquina do painel. Precisa também de uma chave para o painel inteiro.',
    'ability_live' => 'Perguntar diretamente a um servidor',
    'ability_live_helper' => 'Quem está a jogar, e se um servidor está a correr. As únicas perguntas que custam alguma coisa - chegam a um servidor de jogo ou a um daemon, com cache de quinze a vinte segundos.',
    'ability_connect' => 'Ligar contas de Discord a contas do painel',
    'ability_connect_helper' => 'O único grupo que não é uma leitura. Cria chaves API do Pelican nas contas de quem o pede e pode terminar uma ligação. Dê-o apenas ao bot que precisa dele.',
    'own_rate' => 'Pedidos por minuto para esta chave',
    'own_rate_helper' => 'Deixe vazio para seguir a definição do painel. Um número aqui aplica-se só a esta chave. Zero significa tecto nenhum - razoável para um bot na sua própria máquina, e uma maneira bem real de se arrepender se a chave for parar a outro lado.',
    'own_rate_default' => 'Segue o painel',
    'mint_owner' => 'De quem é',
    'mint_owner_helper' => 'Uma chave responde em nome de alguém. Numa chave para o painel inteiro isso é só quem responde por ela; numa pessoal é também o que a chave consegue ver.',
    'minted' => 'Criada',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Uma chave para a Essentials API',
    'profile_make_helper' => 'Uma API diferente da de cima: esta responde ao que este plugin sabe - quais dos seus servidores não têm cópia de segurança, quem está a jogar neles, se estão a correr. Responde sempre só por si e alcança apenas os servidores que já consegue abrir.',
    'profile_create' => 'Criar',
    'profile_yours' => 'As suas chaves Essentials',
    'profile_manage' => 'Revogar uma chave, ver porque é que uma foi recusada e ligar o Discord está tudo na página Acesso à API, na barra lateral.',
    'discord' => 'Discord',
    'discord_body' => 'Ligue a sua conta de Discord a esta, para que um bot possa responder pelos seus servidores quando lho pedir. O que ele recebe é uma chave que alcança exatamente o que você alcança e nada mais.',
    'discord_connect' => 'Ligar o Discord',
    'discord_code' => 'Escreva isto no Discord dentro de dez minutos',
    'discord_code_body' => 'Envie :command num canal que o bot consiga ler. O código funciona uma vez. Ninguém o pode usar a não ser a conta para a qual foi feito.',
    'discord_on' => 'Ligado como :name',
    'discord_since' => 'Desde :when',
    'discord_cut' => 'Desligado',
    'discord_cut_confirm' => 'Termina a ligação e apaga a chave que criou, por isso o bot deixa de responder por si de imediato. Pode voltar a ligar quando quiser.',
    'discord_off' => 'Não ligado',
    'discord_key_note' => 'Ligar cria na sua conta uma chave API do Pelican chamada Discord (Essentials). Pode vê-la, e revogá-la, em Conta → Chaves API - esta página é apenas um atalho para a mesma coisa.',
    'docs_title' => 'Como usar esta API',
    'docs_subheading' => 'O que este painel responde, nos endereços em que responde. Escrito a partir da mesma descrição de que a API é feita, por isso não pode ficar uma versão atrás dela.',
    'docs_base' => 'Onde vive',
    'docs_endpoints' => 'Endpoints',
    'docs_answers' => 'O que vem de volta',
    'docs_calls' => 'Chaves que a podem chamar',
    'docs_params' => 'O que enviar',
    'docs_required' => 'obrigatório',
    'docs_optional' => 'opcional',
    'docs_try' => 'Experimentar',
    'docs_errors' => 'Quando algo está mal',
    'docs_hook' => 'O que o painel lhe envia',
    'docs_hook_body' => 'A outra direção, e a única parte disto que chega sem ser pedida. Ligada em Alertas com um endereço e um segredo de assinatura: um envio JSON quando o watchdog encontra alguma coisa e outro quando isso passa, para que um bot fique a saber de um node que caiu em vez de perguntar a cada minuto se há algum.',
    'docs_hook_verify' => 'O corpo é passado por hash com o seu segredo e o hash viaja em X-Essentials-Signature como sha256=<hex>. Faça o hash do corpo em bruto, e não de um objeto voltado a serializar - qualquer diferença de espaços ou de ordem das chaves dá um hash diferente, e a discordância lê-se como um ataque em vez de como um erro.',
    'docs_download_md' => 'Descarregar como Markdown',
    'docs_download_json' => 'Descarregar como OpenAPI',

    // ---- o que um administrador define -----------------------------------
    'settings' => 'Como isto funciona',
    'approval' => 'Os pedidos esperam para ser concedidos',
    'approval_helper' => 'Ligado, quem pede uma chave recebe-a quando alguém disser que sim. Desligado, recebe-a de imediato - o que é razoável num painel onde toda a gente com conta já é de confiança, e merece ser escolhido em vez de acontecer por acaso.',
    'rate' => 'Pedidos por minuto, por chave',
    'rate_helper' => 'Um bot que pergunta a quarenta servidores quem está a jogar são quarenta perguntas a quarenta servidores de jogo. Este é o tecto que impede que um ciclo escrito às três da manhã se transforme num teste de carga.',
    'days' => 'Uma chave concedida dura',
    'days_helper' => 'Em dias. Zero significa até ser revogada, que é o predefinido - uma chave que expira enquanto ninguém está a olhar é um bot que pára de noite sem que nada em lado nenhum diga porquê.',
    'days_never' => 'Até ser revogada',
    'hide_pelican' => 'Remover o separador de chaves API do próprio painel',
    'hide_pelican_helper' => 'Tira o separador Chaves API do perfil da conta por completo, para que só haja uma coisa chamada Chaves API nessa página. É removido da página em vez de tapado, por isso não fica nenhum endereço que lhe chegue. Uma coisa que não consegue fazer: a API de cliente do próprio painel continua a criar uma chave de conta para tudo o que lha peça diretamente - o separador é onde as pessoas fazem uma à mão, e isto tira a mão. As chaves que já existem continuam a funcionar.',

    /*
     * Dito na página em vez de deixado para ser descoberto. O Pelican reverte as
     * migrações de um plugin quando este é desinstalado, e a única tabela deste
     * plugin vai com elas.
     */
    'uninstall_note' => 'Remover este plugin remove com ele todas as chaves. É de propósito - uma chave que sobrevive àquilo que lhe responde é uma credencial que ninguém consegue revogar.',
];
