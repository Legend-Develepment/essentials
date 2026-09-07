<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Whitelist» e «operator» ficam em inglês: são as palavras que o próprio
 * Minecraft escreve no server.properties, no whitelist.json e no ops.json, e
 * são as que se voltam a escrever na consola.
 */

return [
    'nav_label' => 'Jogadores',
    'title' => 'Jogadores',
    'subheading' => 'A whitelist, os operators, os banimentos, e todos os que este servidor já viu.',

    /*
     * Dito uma vez, perto do topo, porque explica tanto o que a página pode
     * fazer como porque é que uma coisa que não faz não é um defeito. Cada
     * alteração é emitida como comando de consola, que é como se deve dizer ao
     * Minecraft - o jogo faz a alteração e escreve o seu próprio ficheiro, por
     * isso os dois nunca se contradizem.
     */
    'how' => 'As alterações são enviadas ao servidor como comandos de consola, por isso é o jogo que as faz e que escreve os seus ficheiros. Para isso o servidor tem de estar a correr.',
    'needs_running' => 'O servidor tem de estar a correr. Estas alterações são feitas pelo jogo, e não editando os ficheiros dele por baixo.',

    'name' => 'Nome do jogador',
    'reason' => 'Motivo (opcional)',

    'whitelist' => 'Adicionar à whitelist',
    'unwhitelist' => 'Retirar da whitelist',
    'op' => 'Tornar operator',
    'deop' => 'Retirar operator',
    'ban' => 'Banir',
    'pardon' => 'Desbanir',
    'kick' => 'Expulsar',

    'sent' => 'Comando enviado',
    'sent_body' => 'O servidor aplica-o e atualiza os seus próprios ficheiros. Recarregue a página para ver as listas mudar.',
    'refused' => 'Isso não foi enviado',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Na whitelist',
    'flag_banned' => 'Banido',
    'flag_seen' => 'Já jogou aqui',

    'online' => 'Ligados agora',
    'online_count' => ':online de :max',
    'online_none' => 'Não está ninguém ligado.',

    'players' => 'Jogadores',
    'ips' => 'Endereços banidos',
    'ips_empty' => 'Não há nenhum endereço banido.',

    /*
     * O que significa uma página vazia, que normalmente não é «não há
     * jogadores» mas «este servidor nunca arrancou». O Minecraft não cria
     * nenhum destes ficheiros antes da primeira execução.
     */
    'empty' => 'Ainda não há nada para mostrar. O Minecraft escreve estas listas sozinho, e não as cria enquanto o servidor não arrancar pela primeira vez.',

    'level' => 'Nível :level',

    /*
     * A única coisa que esta página não faz, dita em vez de deixada para
     * descobrir. Um estado ao vivo precisa de uma segunda ligação ao próprio
     * jogo, o que é outra funcionalidade com os seus próprios requisitos.
     */
    'not_live' => 'Isto é o que o servidor anotou, e não quem está ligado neste momento.',
];
