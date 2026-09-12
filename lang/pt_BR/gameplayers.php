<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * Quem está em um servidor, para os jogos que respondem à consulta da Valve.
 *
 * Uma única página para Rust, ARK, Valheim e os demais, porque respondem ao
 * mesmo pacote. O que muda de jogo para jogo é o que se pode fazer com alguém -
 * expulsar é `kick "nome"` em um e `KickPlayer <id>` em outro - e é por isso
 * que esta página lê e não age.
 */

return [
    'title' => 'Jogadores',
    'nav_label' => 'Jogadores',
    'subheading' => 'Quem está conectado, perguntado ao próprio jogo e não ao painel.',

    'refresh' => 'Perguntar de novo',

    'count' => ':count conectados',
    'score' => 'Pontuação',

    'just_joined' => 'acabou de entrar',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Não há ninguém neste servidor.',

    /*
     * Não «não tem ninguém», e a diferença importa.
     *
     * O painel e a porta do jogo muitas vezes estão em redes que não se
     * alcançam, e desenhar isso como uma lista vazia seria esta página dizer
     * algo que ela não sabe.
     */
    'unreachable' => 'O servidor não respondeu. Pode estar iniciando, ou o painel pode não alcançar a porta de jogo de onde ele roda - o que não é a mesma coisa que não ter ninguém dentro.',
];
