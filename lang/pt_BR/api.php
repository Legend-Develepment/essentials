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
    'subheading' => 'Chaves que deixam algo de fora do painel perguntar o que este plugin sabe. Somente leitura — nada aqui pode iniciar, parar ou alcançar um servidor.',

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
    'once_body' => 'Ela é guardada como hash, então ninguém — nem quem toca este painel — consegue lê-la de volta. Cole agora onde o bot ou o script lê. Se ela sumir, revogue esta e peça outra.',
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
    'scope_panel_helper' => 'Responde às perguntas do painel inteiro — cada nó, a capacidade, o watchdog, a própria máquina do painel. Para um bot que reporta sobre o painel, não para uma pessoa.',

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
    'grant_confirm' => 'Emite uma chave que responde pelos servidores dessa pessoa, e mostra ela uma vez. Ela já enxerga tudo o que a chave vai reportar — isto decide se algo de fora do painel pode perguntar em nome dela.',
    'granted' => 'Concedida',

    'refuse' => 'Recusar',
    'refuse_answer' => 'O que dizer a eles',
    'refuse_answer_helper' => 'Opcional, e aparece na página deles. Uma recusa sem motivo é uma recusa que é pedida de novo na semana seguinte.',
    'refused' => 'Recusada',

    'revoke' => 'Revogar',
    'revoke_confirm' => 'A chave para de responder na hora e o hash dela é removido, então não dá para trazer de volta. Tudo o que usa ela para. Peça uma nova em vez de tentar desfazer isso.',
    'revoked' => 'Revogada',

    'mint' => 'Chave nova',
    'mint_body' => 'Para um bot e não para uma pessoa. Ela é concedida no mesmo momento em que é criada, porque quem teria aprovado é você.',
    'mint_owner' => 'De quem é',
    'mint_owner_helper' => 'Uma chave responde em nome de alguém. Numa chave do painel inteiro isso é só quem responde por ela; numa pessoal é também o que a chave enxerga.',
    'minted' => 'Criada',

    // ---- o que um administrador define -----------------------------------
    'settings' => 'Como isso funciona',
    'approval' => 'Os pedidos esperam para ser concedidos',
    'approval_helper' => 'Ligado, quem pede uma chave recebe uma quando alguém disser sim. Desligado, recebe na hora — o que é razoável num painel onde todo mundo com conta já é de confiança, e vale ser escolhido em vez de acontecer sem querer.',
    'rate' => 'Requisições por minuto, por chave',
    'rate_helper' => 'Um bot que pergunta a quarenta servidores quem está jogando são quarenta perguntas para quarenta servidores de jogo. Este é o teto que impede um laço escrito às três da manhã de virar um teste de carga.',
    'days' => 'Uma chave concedida dura',
    'days_helper' => 'Em dias. Zero quer dizer até ser revogada, que é o padrão — uma chave que expira enquanto ninguém está olhando é um bot que para de madrugada sem nada em lugar nenhum dizer por quê.',
    'days_never' => 'Até ser revogada',

    /*
     * Dito na página em vez de deixado para descobrir. O Pelican desfaz as
     * migrações de um plugin quando ele é desinstalado, e a única tabela deste
     * plugin vai junto.
     */
    'uninstall_note' => 'Remover este plugin remove junto todas as chaves. Isso é de propósito — uma chave que sobrevive àquilo que responde por ela é uma credencial que ninguém mais consegue revogar.',
];
