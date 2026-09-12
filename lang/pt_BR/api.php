<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * Uma entrada de fora do painel.
 *
 * Dois públicos em um só arquivo, e eles querem o contrário um do outro. Um
 * administrador que lê esta página está decidindo se confia uma chave a alguém,
 * então cada linha diz o que uma chave alcança e não como ela se chama. Quem
 * pede uma quer saber o que estão entregando e o que acontece se perder, e é
 * por isso que a frase sobre a chave aparecer uma vez só não é uma nota de
 * rodapé.
 *
 * Em lugar nenhum se diz «token». «Chave» é a palavra da página de conta do
 * próprio Pelican, e um painel que dá dois nomes para a mesma coisa é um painel
 * onde alguém procura o errado.
 */

return [
    'title' => 'API',
    'nav_label' => 'API',
    'subheading' => 'Chaves que deixam algo de fora do painel perguntar o que este plugin sabe. Somente leitura - nada aqui pode iniciar, parar ou alcançar um servidor.',

    'my_title' => 'Acesso à API',
    'my_nav_label' => 'Acesso à API',
    'my_subheading' => 'Uma chave sua, para um bot ou um script. Ela só responde pelos servidores que você já consegue abrir.',

    // ---- o que é uma chave, dito uma vez, onde importa -------------------
    'address' => 'O endereço',
    'address_helper' => 'Mande a chave como cabeçalho Authorization: :example',

    /*
     * A única coisa que alguém precisa ter lido antes de fechar a janela.
     * Escrita como o que fazer e não como um aviso, porque «guarde bem» é um
     * conselho com o qual ninguém faz nada e «cole agora onde o bot lê» é.
     */
    'once' => 'Esta é a única vez que esta chave aparece',
    'once_body' => 'Ela é guardada como hash, então ninguém - nem quem toca este painel - consegue lê-la de volta. Cole agora onde o bot ou o script lê. Se ela sumir, revogue esta e peça outra.',
    'copy' => 'Copiar',
    'copied' => 'Copiada',

    // ---- os estados ------------------------------------------------------
    'state' => 'Estado',
    'state_pending' => 'Aguardando',
    'state_active' => 'Ativa',
    'state_refused' => 'Recusada',
    'state_revoked' => 'Revogada',

    'state_pending_body' => 'Alguém precisa conceder isso antes que ela responda qualquer coisa.',
    'state_refused_body' => 'Isso foi recusado. Nada foi emitido.',
    'state_revoked_body' => 'Esta chave foi retirada e não responde mais.',

    // ---- os alcances -----------------------------------------------------
    'scope' => 'Alcança',
    'scope_person' => 'Os servidores da própria pessoa',
    'scope_panel' => 'O painel inteiro',

    'scope_person_helper' => 'Só responde pelos servidores que o dono já consegue abrir, perguntados do mesmo jeito que o painel pergunta. Perder esta chave não perde nada que o dono já não pudesse ver.',
    'scope_panel_helper' => 'Responde às perguntas do painel inteiro - cada nó, a capacidade, o watchdog, a própria máquina do painel. Para um bot que reporta sobre o painel, não para uma pessoa.',

    // ---- a tabela --------------------------------------------------------
    'column_name' => 'Para quê',
    'column_owner' => 'De quem',
    'column_prefix' => 'Chave',
    'column_asked' => 'Pedida',
    'column_used' => 'Último uso',
    'column_expires' => 'Expira',

    'never_used' => 'Nunca',
    'no_expiry' => 'Até ser revogada',

    'tab_waiting' => 'Aguardando',
    'tab_active' => 'Ativas',
    'tab_all' => 'Todas',

    'empty' => 'Ainda não há chaves',
    'empty_body' => 'Ninguém pediu nenhuma e nenhuma foi emitida. Esta página vai se preenchendo sozinha conforme as pessoas fazem isso.',

    'my_empty' => 'Você não tem nenhuma chave',
    'my_empty_body' => 'Peça uma e ela aparece aqui com o que quer que tenham respondido.',

    // ---- pedir -----------------------------------------------------------
    'ask' => 'Pedir uma chave',
    'ask_name' => 'Para que serve',
    'ask_name_helper' => 'Umas poucas palavras, para você distinguir duas suas depois e para quem conceder saber o que está concedendo.',
    'ask_reason' => 'Algo que valha a pena acrescentar',
    'ask_reason_helper' => 'Opcional. Lido por quem decide.',
    'ask_sent' => 'Pedida',
    'ask_sent_body' => 'Ela aparece abaixo assim que alguém responder.',
    'ask_granted' => 'Aqui está sua chave',
    'ask_open' => 'Você já tem uma esperando resposta',
    'ask_open_body' => 'Um pedido por vez. Cancele aquele se foi engano.',
    'ask_failed' => 'Não deu para pedir isso',

    'cancel' => 'Cancelar',
    'cancel_confirm' => 'Retira o pedido. Nada foi emitido, então nada para de funcionar.',

    // ---- decidir ---------------------------------------------------------
    'grant' => 'Conceder',
    'grant_confirm' => 'Emite uma chave que responde pelos servidores dessa pessoa, e mostra ela uma vez. Ela já enxerga tudo o que a chave vai reportar - isto decide se algo de fora do painel pode perguntar em nome dela.',
    'granted' => 'Concedida',

    'refuse' => 'Recusar',
    'refuse_answer' => 'O que dizer a eles',
    'refuse_answer_helper' => 'Opcional, e aparece na página deles. Uma recusa sem motivo é uma recusa que é pedida de novo na semana seguinte.',
    'refused' => 'Recusada',
    'collect' => 'Mostrar minha chave',
    'state_ready_body' => 'Concedida. Aperte Mostrar minha chave para vê-la - uma vez só, porque ela é guardada como hash e depois não dá para ler de volta.',
    'replace' => 'Substituir',
    'replace_confirm' => 'Esta chave para de funcionar na hora e uma nova toma o lugar dela, mostrada uma vez só. Não há como consultar a antiga - ela nunca foi guardada - então substituir é a única resposta para tê-la perdido.',
    'granted_body' => 'Ela é recolhida pela própria pessoa, na página de Acesso à API dela. Não é mostrada aqui: uma chave é de quem pediu, não de quem disse sim.',

    'revoke' => 'Revogar',
    'revoke_confirm' => 'A chave para de responder na hora e o hash dela é removido, então não dá para trazer de volta. Tudo o que usa ela para. Peça uma nova em vez de tentar desfazer isso.',
    'revoked' => 'Revogada',
    'forget' => 'Remover',
    'forget_confirm' => 'Tira a linha desta página de vez. Ela já parou de responder, então nada que esteja funcionando para - isto só apaga o registro de que ela existiu.',
    'forgotten' => 'Removida',

    'mint' => 'Chave nova',
    'mint_body' => 'Para um bot e não para uma pessoa. Ela é concedida no mesmo momento em que é criada, porque quem teria aprovado é você.',
    'abilities' => 'Sobre o que ela pode perguntar',
    'abilities_helper' => 'Tudo vem marcado no começo, porque era isso que uma chave era antes disto existir. Desmarcar é o ato deliberado. O que fica guardado é a lista do que é permitido, então uma habilidade acrescentada numa versão posterior fica desligada nas chaves feitas antes dela - uma capacidade que ninguém marcou é uma capacidade que ninguém concedeu.',
    'ability_health' => 'Provar que a chave funciona',
    'ability_health_helper' => 'Não alcança mais nada. Dá para chamar num temporizador sem risco.',
    'ability_me' => 'Os próprios servidores',
    'ability_me_helper' => 'Os servidores que o dono já consegue abrir, e os backups deles. Ela nunca enxerga mais ninguém.',
    'ability_panel' => 'O painel inteiro',
    'ability_panel_helper' => 'Cada nó, cada backup, as tarefas agendadas paradas, o watchdog e a máquina do painel. Precisa também de uma chave de painel inteiro.',
    'ability_live' => 'Perguntar direto a um servidor',
    'ability_live_helper' => 'Quem está jogando, e se um servidor está rodando. As únicas perguntas que custam algo - elas alcançam um servidor de jogo ou um daemon, com cache de quinze a vinte segundos.',
    'ability_connect' => 'Ligar contas do Discord a contas do painel',
    'ability_connect_helper' => 'O único grupo que não é uma leitura. Ele cria chaves de API do Pelican nas contas de quem pede, e pode encerrar uma ligação. Dê isso só ao bot que precisa.',
    'own_rate' => 'Requisições por minuto para esta chave',
    'own_rate_helper' => 'Deixe vazio para seguir a configuração do painel. Um número aqui vale só para esta chave. Zero quer dizer teto nenhum - razoável para um bot na sua própria máquina, e um jeito de verdade de se arrepender se a chave for parar em outro lugar.',
    'own_rate_default' => 'Segue o painel',
    'mint_owner' => 'De quem é',
    'mint_owner_helper' => 'Uma chave responde em nome de alguém. Numa chave do painel inteiro isso é só quem responde por ela; numa pessoal é também o que a chave enxerga.',
    'minted' => 'Criada',
    'profile_tab' => 'Essentials API',
    'profile_make' => 'Uma chave para a Essentials API',
    'profile_make_helper' => 'Uma API diferente da de cima: esta responde o que este plugin sabe - qual dos seus servidores está sem backup, quem está jogando neles, se eles estão rodando. Ela responde sempre só por você e alcança apenas os servidores que você já consegue abrir.',
    'profile_create' => 'Criar',
    'profile_yours' => 'Suas chaves do Essentials',
    'profile_manage' => 'Revogar uma chave, ver por que uma foi recusada e conectar o Discord estão todos na página Acesso à API, na barra lateral.',
    'discord' => 'Discord',
    'discord_body' => 'Ligue sua conta do Discord a esta, para que um bot possa responder pelos seus servidores quando você pedir. O que ele recebe é uma chave que alcança exatamente o que você alcança e nada mais.',
    'discord_connect' => 'Conectar o Discord',
    'discord_code' => 'Digite isto no Discord dentro de dez minutos',
    'discord_code_body' => 'Mande :command num canal que o bot consiga ler. O código funciona uma vez. Ninguém pode usá-lo além da conta para a qual ele foi feito.',
    'discord_on' => 'Conectado como :name',
    'discord_since' => 'Desde :when',
    'discord_cut' => 'Desconectado',
    'discord_cut_confirm' => 'Encerra a ligação e exclui a chave que ela criou, então o bot para de responder por você na hora. Você pode conectar de novo quando quiser.',
    'discord_off' => 'Não conectado',
    'discord_key_note' => 'Conectar cria na sua conta uma chave de API do Pelican chamada Discord (Essentials). Você pode vê-la, e revogá-la, em Conta → Chaves de API - esta página é só um atalho para a mesma coisa.',
    'docs_title' => 'Como usar esta API',
    'docs_subheading' => 'O que este painel responde, nos endereços em que responde. Escrito a partir da mesma descrição com que a API é construída, então não tem como ficar uma versão atrás dela.',
    'docs_base' => 'Onde ela fica',
    'docs_endpoints' => 'Endpoints',
    'docs_answers' => 'O que volta',
    'docs_calls' => 'Chaves que podem chamar',
    'docs_params' => 'O que mandar',
    'docs_required' => 'obrigatório',
    'docs_optional' => 'opcional',
    'docs_try' => 'Testar',
    'docs_errors' => 'Quando algo está errado',
    'docs_hook' => 'O que o painel envia para você',
    'docs_hook_body' => 'A outra direção, e a única parte disto que chega sem ser pedida. Ligada em Alertas, com um endereço e um segredo de assinatura: um envio JSON quando o watchdog acha algo e outro quando aquilo passa, para que um bot fique sabendo de um nó caído em vez de perguntar a cada minuto se há um.',
    'docs_hook_verify' => 'O corpo é passado por hash com o seu segredo e o hash viaja em X-Essentials-Signature como sha256=<hex>. Faça o hash do corpo cru, e não de um objeto reserializado - qualquer diferença de espaçamento ou de ordem das chaves dá um hash diferente, e a diferença parece um ataque em vez de um defeito.',
    'docs_download_md' => 'Baixar como Markdown',
    'docs_download_json' => 'Baixar como OpenAPI',

    // ---- o que um administrador define -----------------------------------
    'settings' => 'Como isso funciona',
    'approval' => 'Os pedidos esperam para ser concedidos',
    'approval_helper' => 'Ligado, quem pede uma chave recebe uma quando alguém disser sim. Desligado, recebe na hora - o que é razoável num painel onde todo mundo com conta já é de confiança, e vale ser escolhido em vez de acontecer sem querer.',
    'rate' => 'Requisições por minuto, por chave',
    'rate_helper' => 'Um bot que pergunta a quarenta servidores quem está jogando são quarenta perguntas para quarenta servidores de jogo. Este é o teto que impede um laço escrito às três da manhã de virar um teste de carga.',
    'days' => 'Uma chave concedida dura',
    'days_helper' => 'Em dias. Zero quer dizer até ser revogada, que é o padrão - uma chave que expira enquanto ninguém está olhando é um bot que para de madrugada sem nada em lugar nenhum dizer por quê.',
    'days_never' => 'Até ser revogada',
    'hide_pelican' => 'Remover a aba de chaves de API do próprio painel',
    'hide_pelican_helper' => 'Tira a aba de chaves de API do perfil da conta por completo, então só existe uma coisa chamada chaves de API naquela página. Ela é retirada da página em vez de ser pintada por cima, então não sobra endereço que a alcance. Uma coisa que isto não faz: a client API do próprio painel continua criando uma chave de conta para qualquer coisa que peça direto a ela - a aba é onde as pessoas fazem uma à mão, e isto tira a mão. As chaves que já existem continuam funcionando.',

    /*
     * Dito na página em vez de deixado para descobrir. O Pelican desfaz as
     * migrações de um plugin quando ele é desinstalado, e a única tabela deste
     * plugin vai junto.
     */
    'uninstall_note' => 'Remover este plugin remove junto todas as chaves. Isso é de propósito - uma chave que sobrevive àquilo que responde por ela é uma credencial que ninguém mais consegue revogar.',
];
