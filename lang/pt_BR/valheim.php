<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Egg», «daemon», «SteamID64» e «PlayFab ID» ficam em inglês: são as palavras
 * do Pelican e as do jogo, e é com esses nomes que se acham de novo.
 */

return [
    /* -------------------------------------------------- a aba de admin --- */

    'section_helper' => 'Quais eggs rodam Valheim. Nada além disso — um servidor Valheim se configura pelas variáveis de inicialização, e a página Inicialização do Pelican já edita essas.',

    'eggs' => 'Quais eggs são Valheim',
    'eggs_helper' => 'Marque os eggs que rodam um servidor Valheim. Dentro dos servidores que os usam aparece uma página de Listas de jogadores, e em nenhum outro lugar. Onde essas listas ficam muda de egg para egg, então isso é descoberto servidor por servidor, olhando nos lugares que o jogo usa. No começo nada está marcado, e é de propósito — um plugin não tem como saber os nomes que você deu aos seus eggs.',

    /* ------------------------------------------- a página do servidor ---- */

    'nav_label' => 'Listas de jogadores',
    'title' => 'Listas de jogadores do Valheim',
    'subheading' => 'Os admins, os banidos e a lista de permitidos, como três listas em vez de três arquivos de texto.',

    'admin' => 'Admins',
    'admin_helper' => 'Todos os que estiverem aqui podem usar os comandos de admin dentro do jogo.',
    'banned' => 'Banidos',
    'banned_helper' => 'Todos os que estiverem aqui são recusados quando tentam entrar.',
    'permitted' => 'Permitidos',
    'permitted_helper' => 'Se esta lista tiver alguém, só essas pessoas podem entrar. Uma lista vazia deixa todo mundo entrar — que é o que a maioria dos servidores quer, então deixe vazia a não ser que você queira mesmo.',

    'ids' => 'Identificadores de jogador',
    'ids_placeholder' => 'Cole um identificador e aperte espaço',

    'how' => 'Um identificador por jogador — um SteamID64 em um servidor Steam, um PlayFab ID em um de crossplay. Cole-os e aperte espaço, tab ou vírgula. O que o jogo tiver escrito como comentário acima da lista fica onde está.',
    'where' => 'Lido de :dir.',
    'missing' => 'Este servidor ainda não tem nenhum desses arquivos. O jogo grava esses arquivos quando precisa deles pela primeira vez, e salvar aqui cria os que você preencher.',
    'read_only' => 'Você pode ler estes arquivos mas não gravá-los, então nada aqui pode ser mudado.',

    'save' => 'Salvar',
    'saved' => 'Salvo',
    'saved_reload' => 'O Valheim relê estas listas enquanto roda, então a mudança vale sem reiniciar.',
    'unchanged' => 'Nada tinha mudado, então nada foi gravado',
    'failed' => 'Não foi possível salvar',
    'failed_lists' => 'O daemon recusou a gravação de: :lists. Verifique se o servidor está alcançável e se os arquivos não são somente leitura.',
];
