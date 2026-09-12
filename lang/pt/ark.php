<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Egg», «GameUserSettings.ini» e «daemon» ficam em inglês: são as palavras que
 * aparecem no Pelican, no gestor de ficheiros e em tudo o que se escreve sobre
 * o ARK.
 */

return [
    /* -------------------------------------------- o separador de admin --- */

    /*
     * O título da secção não está aqui. Cada secção de definições tira o seu
     * título de settings.groups.<nome>, que é o que group() constrói.
     */
    'section_helper' => 'Que eggs correm ARK. Nada mais - o resto de um servidor ARK configura-se pelas variáveis de arranque, e a página Arranque do Pelican já as edita.',

    'eggs' => 'Que eggs são ARK',
    'eggs_helper' => 'Marque os eggs que correm um servidor ARK. Dentro dos servidores que os usam aparece uma página de Definições do mundo, e em mais lado nenhum. É uma pergunta diferente da da página de estado: aquela pergunta que eggs respondem à consulta da Valve, coisa que o Rust e o Valheim também fazem, e esta pergunta que eggs guardam o GameUserSettings.ini onde o ARK o guarda, coisa que só o ARK faz. No início não está nada marcado, e é de propósito - um plugin não pode saber que nomes deu aos seus eggs.',

    /* ------------------------------------------- a página do servidor ---- */

    'nav_label' => 'Definições do mundo',
    'title' => 'Definições de mundo do ARK',
    'subheading' => 'As definições que as pessoas realmente mudam, do GameUserSettings.ini.',

    'group_server' => 'O servidor',
    'group_server_helper' => 'Como se chama o servidor, quem pode entrar, e quantos.',
    'group_rates' => 'Taxas',
    'group_rates_helper' => 'A que velocidade as coisas acontecem. 1.0 é o jogo tal como vem; 2.0 é o dobro da velocidade.',
    'group_rules' => 'Regras',
    'group_rules_helper' => 'O que os jogadores podem fazer e o que o jogo lhes mostra.',

    'keeps' => 'Quinze definições de um ficheiro que tem centenas. Tudo o resto - as definições dos seus mods, chaves de que este plugin nunca ouviu falar, os comentários e a ordem de tudo isso - fica exatamente como está quando guardar.',
    'missing' => 'Este servidor ainda não tem GameUserSettings.ini. O jogo escreve-o na primeira vez que corre, por isso arranque o servidor uma vez e esta página preenche-se.',
    'read_only' => 'Pode ler este ficheiro mas não escrevê-lo, por isso nada aqui pode ser alterado.',

    'save' => 'Guardar',
    'saved' => 'Guardado',
    'saved_restart' => 'O ARK lê este ficheiro ao arrancar, por isso reinicie o servidor para a alteração entrar em vigor.',
    'failed' => 'Não foi possível guardar',
    'failed_write' => 'O daemon recusou a escrita. Verifique que o servidor está alcançável e que o ficheiro não é só de leitura.',
];
