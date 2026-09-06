<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * A barra de controles de uma página de servidor. Um arquivo próprio e não um
 * canto do settings.php, porque isto é lido por quem usa o painel e não por
 * quem configura o tema.
 *
 * O estado ao lado dos botões é a palavra do próprio Pelican, tirada do enum
 * ContainerStatus, para que a barra e a página do console nunca se contradigam
 * sobre o que um servidor está fazendo.
 *
 * "Kill" fica em inglês: é o nome do botão do Pelican e o nome do comando, e
 * não é a mesma coisa que parar.
 */

return [
    'console' => 'Console',
    'full_page' => 'Nova janela',
    'close' => 'Fechar',

    'start' => 'Iniciar',
    'restart' => 'Reiniciar',
    'stop' => 'Parar',
    'kill' => 'Kill',

    'kill_confirm' => 'O Kill para o contêiner na hora. Tudo o que o servidor ainda não gravou no disco é perdido. Continuar?',

    'sent_title' => 'Ação de energia',
    'sent_body' => ':action foi enviado para :name.',
    'failed' => 'Não foi possível contatar o nó.',
];
