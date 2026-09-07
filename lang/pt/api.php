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
    'subheading' => 'Chaves que permitem a algo fora do painel perguntar o que este plugin sabe. Só de leitura — nada aqui pode arrancar, parar ou alcançar um servidor.',

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
    'once_body' => 'É guardada como hash, por isso ninguém — nem quem gere este painel — a consegue ler de volta. Cole-a agora onde o bot ou o script a lê. Se se perder, revogue esta e peça outra.',
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
    'scope_panel_helper' => 'Responde às perguntas do painel inteiro — cada nó, a capacidade, o watchdog, a própria máquina do painel. Para um bot que dá conta do painel em vez de para uma pessoa.',

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
    'grant_confirm' => 'Emite uma chave que responde pelos servidores desta pessoa, e mostra-a uma vez. Ela já vê tudo o que a chave irá reportar — isto decide se algo de fora do painel pode perguntar em nome dela.',
    'granted' => 'Concedida',

    'refuse' => 'Recusar',
    'refuse_answer' => 'O que lhes dizer',
    'refuse_answer_helper' => 'Opcional, e mostrado na página deles. Uma recusa sem razão é uma recusa que é pedida outra vez para a semana.',
    'refused' => 'Recusada',

    'revoke' => 'Revogar',
    'revoke_confirm' => 'A chave deixa de responder de imediato e o seu hash é removido, por isso não pode ser trazida de volta. Tudo o que a usa pára. Peça uma nova em vez de tentar desfazer isto.',
    'revoked' => 'Revogada',

    'mint' => 'Chave nova',
    'mint_body' => 'Para um bot e não para uma pessoa. É concedida no momento em que é criada, porque quem a teria aprovado é você.',
    'mint_owner' => 'De quem é',
    'mint_owner_helper' => 'Uma chave responde em nome de alguém. Numa chave para o painel inteiro isso é só quem responde por ela; numa pessoal é também o que a chave consegue ver.',
    'minted' => 'Criada',

    // ---- o que um administrador define -----------------------------------
    'settings' => 'Como isto funciona',
    'approval' => 'Os pedidos esperam para ser concedidos',
    'approval_helper' => 'Ligado, quem pede uma chave recebe-a quando alguém disser que sim. Desligado, recebe-a de imediato — o que é razoável num painel onde toda a gente com conta já é de confiança, e merece ser escolhido em vez de acontecer por acaso.',
    'rate' => 'Pedidos por minuto, por chave',
    'rate_helper' => 'Um bot que pergunta a quarenta servidores quem está a jogar são quarenta perguntas a quarenta servidores de jogo. Este é o tecto que impede que um ciclo escrito às três da manhã se transforme num teste de carga.',
    'days' => 'Uma chave concedida dura',
    'days_helper' => 'Em dias. Zero significa até ser revogada, que é o predefinido — uma chave que expira enquanto ninguém está a olhar é um bot que pára de noite sem que nada em lado nenhum diga porquê.',
    'days_never' => 'Até ser revogada',

    /*
     * Dito na página em vez de deixado para ser descoberto. O Pelican reverte as
     * migrações de um plugin quando este é desinstalado, e a única tabela deste
     * plugin vai com elas.
     */
    'uninstall_note' => 'Remover este plugin remove com ele todas as chaves. É de propósito — uma chave que sobrevive àquilo que lhe responde é uma credencial que ninguém consegue revogar.',
];
