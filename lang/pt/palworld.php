<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * As definições de mundo do Palworld, numa página em vez de num ficheiro.
 *
 * Aqui não se nomeia nenhuma definição. Cada etiqueta dessa página é deduzida
 * da chave que o ficheiro do próprio servidor contém — ver
 * Support\Palworld\Palworld::label() para perceber porque uma lista de nomes
 * seria pior do que nenhuma.
 */

return [
    'title' => 'Definições do Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'As definições de mundo do PalWorldSettings.ini deste servidor, lidas quando abriu esta página. Só podem ser editadas com o servidor parado.',

    'reload' => 'Ler o ficheiro outra vez',

    'save_confirm' => 'O ficheiro é reescrito com estes valores. Cada definição que esta página não mostrou é reescrita exatamente como estava, e todo o resto do ficheiro também.',
    'saved' => 'Definições guardadas',
    'saved_body' => 'Entram em vigor no próximo arranque do servidor.',
    'save_failed' => 'Não foi possível escrever o ficheiro',

    'running' => 'O servidor está a correr',
    'running_body' => 'O Palworld guarda estas definições em memória e reescreve o ficheiro ao parar, por isso uma alteração guardada agora seria desfeita sem uma palavra. Pare primeiro o servidor.',

    'groups' => [
        'server' => 'Servidor e ligação',
        'world' => 'Mundo e taxas',
        'pals' => 'Pals',
        'players' => 'Jogadores',
        'building' => 'Construção, itens e recolha',
        'guild' => 'Guildas',
        'other' => 'Outros',
    ],
];
