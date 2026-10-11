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
    'save' => 'Salvar',
    'saved' => 'Salvo',
    'restart' => 'O jogo lê este arquivo ao iniciar, então reinicie o servidor para a mudança fazer efeito.',
    'failed' => 'Não foi possível salvar',
    'failed_write' => 'O daemon recusou a escrita. Verifique se o servidor está acessível e se o arquivo não é somente leitura.',
    'read_only' => 'Você pode ler este arquivo mas não escrevê-lo, então nada aqui pode ser alterado.',
    'missing' => 'Este servidor ainda não tem arquivo de configuração. O jogo o escreve na primeira inicialização, então inicie o servidor uma vez e esta página se preenche.',
    'keeps' => 'Todo o resto do arquivo - os comentários, as linhas vazias, a ordem e cada chave que este plugin não conhece - fica exatamente como estava ao salvar.',
    'raw' => 'Os nomes aqui são os do jogo, na ordem do arquivo. Nada é traduzido nem agrupado, porque esta página lê o arquivo em vez de uma lista escrita à mão: mostra cada configuração que o jogo conhece.',
    'unset' => 'Não definido. O jogo menciona como exemplo; preencher adiciona.',
    'group_all' => 'Configurações',
    'group_all_helper' => 'Tudo o que este arquivo menciona.',
    'subheading' => 'Construído a partir de :files em vez de uma lista escrita à mão.',
];
