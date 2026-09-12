<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Egg» fica em inglês: é a palavra que o Pelican usa em toda a sua interface,
 * e uma definição com um nome diferente do do ecrã de onde vem é uma definição
 * que é preciso procurar duas vezes.
 */

return [
    'title' => 'Duplicar um servidor',
    'nav_label' => 'Duplicar servidor',
    'subheading' => 'Outro servidor montado exatamente como um que já tem, ou vários de uma vez.',

    'section' => 'O que é copiado',
    'section_helper' => 'São copiados o proprietário, o egg, o comando de arranque, os limites e todas as variáveis. Os ficheiros, as bases de dados, as cópias de segurança e as tarefas agendadas não - copiar os ficheiros de um servidor em funcionamento é copiar o seu estado, o que raramente é o que se quer dizer com «outro como este».',

    'source' => 'Copiar de',
    'source_helper' => 'As cópias ficam no mesmo nó que este servidor, porque é aí que estão os endereços livres dele.',

    'name' => 'Nome da cópia',
    'name_helper' => 'Fazer mais do que uma numera-as: «Bot 1», «Bot 2», e assim por diante.',

    'copies' => 'Quantas',
    'copies_helper' => 'Escolha primeiro um servidor.',
    'room' => ':count endereços livres em :node, por isso é esse o máximo que pode ser feito agora.',
    'no_room' => 'Não resta nenhum endereço livre em :node. Uma cópia precisa do seu, por isso adicione primeiro uma alocação a esse nó.',

    /*
     * Contadas e não enumeradas para os sucessos, e enumeradas para as falhas,
     * que é o sentido que ajuda: dez nomes que funcionaram são uma parede de
     * texto que ninguém lê, e o que não funcionou é a única coisa que vale a
     * pena ler.
     */
    'made' => ':count cópias criadas',
    'partly_failed' => 'Não foi possível criar :count cópias',
    'failed' => 'Não foi copiado nada',
];
