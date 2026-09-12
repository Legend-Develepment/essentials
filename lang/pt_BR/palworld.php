<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * As configurações de mundo do Palworld, em uma página em vez de em um arquivo.
 *
 * Aqui não se nomeia nenhuma configuração. Cada rótulo daquela página é
 * deduzido da chave que o arquivo do próprio servidor contém - veja
 * Support\Palworld\Palworld::label() para entender por que uma lista de nomes
 * seria pior do que nenhuma.
 */

return [
    'title' => 'Configurações do Palworld',
    'nav_label' => 'Palworld',
    'subheading' => 'As configurações de mundo do PalWorldSettings.ini deste servidor, lidas quando você abriu esta página. Só dá para editar com o servidor parado.',

    'reload' => 'Ler o arquivo de novo',

    'save_confirm' => 'O arquivo é reescrito com estes valores. Cada configuração que esta página não mostrou é reescrita exatamente como estava, e todo o resto do arquivo também.',
    'saved' => 'Configurações salvas',
    'saved_body' => 'Elas valem a partir da próxima vez que o servidor iniciar.',
    'save_failed' => 'Não foi possível gravar o arquivo',

    'running' => 'O servidor está rodando',
    'running_body' => 'O Palworld guarda estas configurações na memória e reescreve o arquivo ao parar, então uma mudança salva agora seria desfeita sem avisar. Pare o servidor primeiro.',

    'groups' => [
        'server' => 'Servidor e conexão',
        'world' => 'Mundo e taxas',
        'pals' => 'Pals',
        'players' => 'Jogadores',
        'building' => 'Construção, itens e coleta',
        'guild' => 'Guildas',
        'other' => 'Outros',
    ],
];
