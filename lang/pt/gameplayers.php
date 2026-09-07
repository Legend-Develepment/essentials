<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * Quem está num servidor, para os jogos que respondem à consulta da Valve.
 *
 * Uma só página para Rust, ARK, Valheim e os restantes, porque respondem ao
 * mesmo pacote. O que muda de jogo para jogo é o que se pode fazer a alguém —
 * expulsar é `kick "nome"` num e `KickPlayer <id>` noutro — e é por isso que
 * esta página lê e não age.
 */

return [
    'title' => 'Jogadores',
    'nav_label' => 'Jogadores',
    'subheading' => 'Quem está ligado, perguntado ao próprio jogo e não ao painel.',

    'refresh' => 'Perguntar outra vez',

    'count' => ':count ligados',
    'score' => 'Pontuação',

    'just_joined' => 'acabou de entrar',
    'minutes' => ':count min',
    'hours' => ':count h',
    'hours_minutes' => ':hours h :minutes min',

    'empty' => 'Não está ninguém neste servidor.',

    /*
     * Não «não está ninguém», e a diferença importa.
     *
     * O painel e a porta do jogo estão muitas vezes em redes que não se
     * alcançam, e desenhar isso como uma lista vazia seria esta página dizer
     * algo que não sabe.
     */
    'unreachable' => 'O servidor não respondeu. Pode estar a arrancar, ou o painel pode não conseguir alcançar a porta de jogo a partir de onde corre — o que não é o mesmo que não estar lá ninguém.',
];
