<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Egg», «daemon», «SteamID64» e «PlayFab ID» ficam em inglês: são as palavras
 * do Pelican e as do jogo, e é com esses nomes que se voltam a encontrar.
 */

return [
    /* -------------------------------------------- o separador de admin --- */

    'section_helper' => 'Que eggs correm Valheim. Nada mais - um servidor Valheim configura-se pelas variáveis de arranque, e a página Arranque do Pelican já as edita.',

    'eggs' => 'Que eggs são Valheim',
    'eggs_helper' => 'Marque os eggs que correm um servidor Valheim. Dentro dos servidores que os usam aparece uma página de Listas de jogadores, e em mais lado nenhum. Onde essas listas ficam muda de egg para egg, por isso é descoberto servidor a servidor, olhando nos sítios que o jogo usa. No início não está nada marcado, e é de propósito - um plugin não pode saber que nomes deu aos seus eggs.',

    /* ------------------------------------------- a página do servidor ---- */

    'nav_label' => 'Listas de jogadores',
    'title' => 'Listas de jogadores do Valheim',
    'subheading' => 'Os admins, os banidos e a lista de permitidos, como três listas em vez de três ficheiros de texto.',

    'admin' => 'Admins',
    'admin_helper' => 'Todos os que estiverem aqui podem usar os comandos de admin dentro do jogo.',
    'banned' => 'Banidos',
    'banned_helper' => 'Todos os que estiverem aqui são recusados quando tentam entrar.',
    'permitted' => 'Permitidos',
    'permitted_helper' => 'Se esta lista tiver alguém, só essas pessoas podem entrar. Uma lista vazia deixa entrar toda a gente - que é o que a maioria dos servidores quer, por isso deixe-a vazia a não ser que o queira mesmo.',

    'ids' => 'Identificadores de jogador',
    'ids_placeholder' => 'Cole um identificador e prima espaço',

    'how' => 'Um identificador por jogador - um SteamID64 num servidor Steam, um PlayFab ID num de jogo cruzado. Cole-os e prima espaço, tabulação ou vírgula. O que o jogo tiver escrito como comentário por cima da lista fica onde está.',
    'where' => 'Lido de :dir.',
    'missing' => 'Este servidor ainda não tem nenhum destes ficheiros. O jogo escreve-os quando precisa deles pela primeira vez, e guardar aqui cria aqueles que preencher.',
    'read_only' => 'Pode ler estes ficheiros mas não escrevê-los, por isso nada aqui pode ser alterado.',

    'save' => 'Guardar',
    'saved' => 'Guardado',
    'saved_reload' => 'O Valheim relê estas listas enquanto corre, por isso a alteração aplica-se sem reiniciar.',
    'unchanged' => 'Não tinha mudado nada, por isso não foi escrito nada',
    'failed' => 'Não foi possível guardar',
    'failed_lists' => 'O daemon recusou a escrita de: :lists. Verifique que o servidor está alcançável e que os ficheiros não são só de leitura.',
];
