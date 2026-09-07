<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * A barra de controlos de uma página de servidor. Um ficheiro próprio e não um
 * canto do settings.php, porque isto é lido por quem usa o painel e não por
 * quem configura o tema.
 *
 * O estado ao lado dos botões é a palavra do próprio Pelican, tirada do enum
 * ContainerStatus, para que a barra e a página da consola nunca se contradigam
 * sobre o que um servidor está a fazer.
 *
 * "Kill" fica em inglês: é o nome do botão do Pelican e o nome do comando, e
 * não é a mesma coisa que parar.
 */

return [
    'console' => 'Consola',
    'full_page' => 'Nova janela',
    'close' => 'Fechar',

    'start' => 'Iniciar',
    'restart' => 'Reiniciar',
    'stop' => 'Parar',
    'kill' => 'Kill',

    'kill_confirm' => 'O Kill pára o contentor de imediato. Tudo o que o servidor ainda não escreveu no disco perde-se. Continuar?',

    'sent_title' => 'Ação de energia',
    'sent_body' => ':action foi enviado para :name.',
    'failed' => 'Não foi possível contactar o nó.',
];
