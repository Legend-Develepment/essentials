<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Egg» fica em inglês: é a palavra que o Pelican usa em toda a interface dele,
 * e uma configuração com nome diferente do da tela de onde ela vem é uma
 * configuração que se procura duas vezes.
 */

return [
    'title' => 'Duplicar um servidor',
    'nav_label' => 'Duplicar servidor',
    'subheading' => 'Outro servidor montado exatamente como um que você já tem, ou vários de uma vez.',

    'section' => 'O que é copiado',
    'section_helper' => 'São copiados o dono, o egg, o comando de inicialização, os limites e todas as variáveis. Os arquivos, os bancos de dados, os backups e as tarefas agendadas não — copiar os arquivos de um servidor rodando é copiar o estado dele, que raramente é o que se quer dizer com «outro igual a este».',

    'source' => 'Copiar de',
    'source_helper' => 'As cópias ficam no mesmo nó que este servidor, porque é aí que estão os endereços livres dele.',

    'name' => 'Nome da cópia',
    'name_helper' => 'Fazer mais de uma numera as cópias: «Bot 1», «Bot 2», e assim por diante.',

    'copies' => 'Quantas',
    'copies_helper' => 'Escolha um servidor primeiro.',
    'room' => ':count endereços livres em :node, então esse é o máximo que dá para fazer agora.',
    'no_room' => 'Não sobrou nenhum endereço livre em :node. Uma cópia precisa do dela, então adicione primeiro uma alocação a esse nó.',

    /*
     * Contadas e não listadas para os acertos, e listadas para as falhas, que é
     * o sentido que ajuda: dez nomes que deram certo são uma parede de texto
     * que ninguém lê, e o que não deu é a única coisa que vale a pena ler.
     */
    'made' => ':count cópias criadas',
    'partly_failed' => 'Não foi possível criar :count cópias',
    'failed' => 'Nada foi copiado',
];
