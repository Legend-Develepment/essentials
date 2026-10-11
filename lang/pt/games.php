<?php

/*
 * The words every game settings page uses.
 *
 * Shared because that is where the cost of a game turned out to be. A page's
 * own list of settings costs nothing to translate - a key in a config file is
 * the same string in every language, and the two pages that exist both derive
 * their field names from it. What a game actually costs is its page: the title,
 * the sentence under it, what to say when the file is not there yet, and what
 * to say when the daemon refuses a write.
 *
 * None of that is about any particular game, so none of it is repeated per
 * game. A third game needs six strings of its own rather than eighteen.
 *
 * See roadmap/games.md.
 */

return [
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'restart' => 'O jogo lê este ficheiro ao arrancar, por isso reinicia o servidor para a alteração fazer efeito.',
    'failed' => 'Não foi possível guardar',
    'failed_write' => 'O daemon recusou a escrita. Verifica se o servidor está acessível e se o ficheiro não é apenas de leitura.',
    'read_only' => 'Podes ler este ficheiro mas não escrevê-lo, por isso nada aqui pode ser alterado.',
    'missing' => 'Este servidor ainda não tem ficheiro de configuração. O jogo escreve-o no primeiro arranque, por isso inicia o servidor uma vez e esta página preenche-se.',
    'keeps' => 'Todo o resto do ficheiro - os comentários, as linhas vazias, a ordem e cada chave que este plugin não conhece - fica exatamente como estava ao guardar.',
    'raw' => 'Os nomes aqui são os do jogo, pela ordem do ficheiro. Nada é traduzido nem agrupado, porque esta página lê o ficheiro em vez de uma lista escrita à mão: mostra cada definição que o jogo conhece.',
    'unset' => 'Não definido. O jogo menciona-o como exemplo; preencher adiciona-o.',
    'group_all' => 'Definições',
    'group_all_helper' => 'Tudo o que este ficheiro menciona.',
    'subheading' => 'Construído a partir de :files em vez de uma lista escrita à mão.',
];
