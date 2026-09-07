<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Whitelist» e «operator» ficam em inglês: são as palavras que o próprio
 * Minecraft grava no server.properties, no whitelist.json e no ops.json, e são
 * as que se digitam de novo no console.
 */

return [
    'nav_label' => 'Jogadores',
    'title' => 'Jogadores',
    'subheading' => 'A whitelist, os operators, os banimentos, e todos que este servidor já viu.',

    /*
     * Dito uma vez, perto do topo, porque explica tanto o que a página pode
     * fazer quanto por que uma coisa que ela não faz não é um defeito. Cada
     * mudança é emitida como comando de console, que é como se deve avisar o
     * Minecraft - o jogo faz a mudança e grava o próprio arquivo, então os dois
     * nunca se contradizem.
     */
    'how' => 'As mudanças são enviadas ao servidor como comandos de console, então é o jogo que as faz e que grava os arquivos dele. Para isso o servidor precisa estar rodando.',
    'needs_running' => 'O servidor precisa estar rodando. Estas mudanças são feitas pelo jogo, não editando os arquivos dele por baixo.',

    'name' => 'Nome do jogador',
    'reason' => 'Motivo (opcional)',

    'whitelist' => 'Adicionar à whitelist',
    'unwhitelist' => 'Tirar da whitelist',
    'op' => 'Tornar operator',
    'deop' => 'Tirar operator',
    'ban' => 'Banir',
    'pardon' => 'Desbanir',
    'kick' => 'Expulsar',

    'sent' => 'Comando enviado',
    'sent_body' => 'O servidor aplica e atualiza os arquivos dele. Recarregue a página para ver as listas mudarem.',
    'refused' => 'Isso não foi enviado',

    'flag_op' => 'Operator',
    'flag_whitelisted' => 'Na whitelist',
    'flag_banned' => 'Banido',
    'flag_seen' => 'Já jogou aqui',

    'online' => 'Online agora',
    'online_count' => ':online de :max',
    'online_none' => 'Não há ninguém conectado.',

    'players' => 'Jogadores',
    'ips' => 'Endereços banidos',
    'ips_empty' => 'Não há nenhum endereço banido.',

    /*
     * O que uma página vazia quer dizer, e normalmente não é «não tem
     * jogadores» e sim «este servidor nunca iniciou». O Minecraft não cria
     * nenhum desses arquivos antes da primeira execução.
     */
    'empty' => 'Ainda não há nada para mostrar. O Minecraft grava estas listas sozinho, e não as cria enquanto o servidor não iniciar pela primeira vez.',

    'level' => 'Nível :level',

    /*
     * A única coisa que esta página não faz, dita em vez de deixada para
     * descobrir. Um status ao vivo precisa de uma segunda conexão com o próprio
     * jogo, que é outro recurso com requisitos próprios.
     */
    'not_live' => 'Isto é o que o servidor anotou, e não quem está conectado neste momento.',
];
