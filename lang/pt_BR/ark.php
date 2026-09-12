<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Egg», «GameUserSettings.ini» e «daemon» ficam em inglês: são as palavras que
 * aparecem no Pelican, no gerenciador de arquivos e em tudo o que se escreve
 * sobre o ARK.
 */

return [
    /* -------------------------------------------------- a aba de admin --- */

    /*
     * O título da seção não está aqui. Cada seção de configurações tira o
     * título de settings.groups.<nome>, que é o que group() constrói.
     */
    'section_helper' => 'Quais eggs rodam ARK. Nada além disso - o resto de um servidor ARK se configura pelas variáveis de inicialização, e a página Inicialização do Pelican já edita essas.',

    'eggs' => 'Quais eggs são ARK',
    'eggs_helper' => 'Marque os eggs que rodam um servidor ARK. Dentro dos servidores que os usam aparece uma página de Configurações do mundo, e em nenhum outro lugar. É uma pergunta diferente da da página de status: aquela pergunta quais eggs respondem à consulta da Valve, o que Rust e Valheim também fazem, e esta pergunta quais eggs guardam o GameUserSettings.ini onde o ARK guarda, o que só o ARK faz. No começo nada está marcado, e é de propósito - um plugin não tem como saber os nomes que você deu aos seus eggs.',

    /* ------------------------------------------- a página do servidor ---- */

    'nav_label' => 'Configurações do mundo',
    'title' => 'Configurações de mundo do ARK',
    'subheading' => 'As configurações que as pessoas realmente mudam, do GameUserSettings.ini.',

    'group_server' => 'O servidor',
    'group_server_helper' => 'Como o servidor se chama, quem pode entrar, e quantos.',
    'group_rates' => 'Taxas',
    'group_rates_helper' => 'A que velocidade as coisas acontecem. 1.0 é o jogo como ele vem; 2.0 é o dobro da velocidade.',
    'group_rules' => 'Regras',
    'group_rules_helper' => 'O que os jogadores podem fazer e o que o jogo mostra para eles.',

    'keeps' => 'Quinze configurações de um arquivo que tem centenas. Todo o resto - as configurações dos seus mods, chaves das quais este plugin nunca ouviu falar, os comentários e a ordem de tudo isso - fica exatamente como está quando você salva.',
    'missing' => 'Este servidor ainda não tem GameUserSettings.ini. O jogo grava esse arquivo na primeira vez que roda, então inicie o servidor uma vez e esta página se preenche.',
    'read_only' => 'Você pode ler este arquivo mas não gravá-lo, então nada aqui pode ser mudado.',

    'save' => 'Salvar',
    'saved' => 'Salvo',
    'saved_restart' => 'O ARK lê este arquivo ao iniciar, então reinicie o servidor para a mudança valer.',
    'failed' => 'Não foi possível salvar',
    'failed_write' => 'O daemon recusou a gravação. Verifique se o servidor está alcançável e se o arquivo não é somente leitura.',
];
