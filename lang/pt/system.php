<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Swap», «Load average», «Wings» e «Uptime» ficam em inglês: são os nomes com
 * que se encontram no anfitrião e na própria interface do Pelican.
 */

return [
    'title' => 'Estado do sistema',
    'nav_label' => 'Estado do sistema',
    'subheading' => 'A máquina onde o próprio painel corre, o que tem a correr, e ao lado cada nó que tenha pedido.',

    'options' => 'Opções',
    'enabled' => 'Mostrar na barra lateral',
    'enabled_helper' => 'Desligado retira a entrada da barra lateral. A página mantém o seu próprio endereço, por isso está sempre lá para a voltar a ligar.',

    'refresh' => 'Voltar a ler a cada',
    'refresh_helper' => 'A página inteira é pedida outra vez com este intervalo. Desligado deixa-a como estava quando a abriu.',
    'refresh_off' => 'Só quando a abro',
    'refresh_seconds' => ':seconds segundos',

    'blocks' => 'Mostrar',
    'blocks_helper' => 'Marcado quer dizer visível. «Disco» é um cartão por sistema de ficheiros, por isso uma partição raiz cheia não fica escondida atrás de uma montagem de dados meio vazia.',
    'block_cpu' => 'Processador',
    'block_memory' => 'Memória',
    'block_swap' => 'Swap',
    'block_disk' => 'Disco',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistema',
    'block_version' => 'Versão do painel',
    // Nunca aparece - um cartão de nó leva o nome do próprio nó - mas blank()
    // pede-o, e uma chave em falta a imprimir o próprio nome é um mau recurso.
    'block_node' => 'Nó',

    'nodes' => 'Nós a mostrar',
    'nodes_helper' => 'Um cartão cada, ao lado do anfitrião do painel. Nada marcado não mostra nenhum — o painel principal já tem um bloco com todos os nós. Cada um é perguntado ao seu próprio daemon, por isso um intervalo curto e uma lista longa são muitos pedidos.',

    'section_usage' => 'Utilização',
    'section_host' => 'Este painel',
    'section_nodes' => 'Nós',

    'disk_panel' => 'O painel vive aqui',
    'wings' => 'Wings :version',
    'version_installed' => 'Instalada',
    'version_latest' => 'Mais recente',
    'version_current' => 'Atualizado',
    'version_update' => 'Atualização disponível',
    'version_unknown' => 'Não foi possível verificar',

    /*
     * O que oferece um cartão que está atrasado.
     *
     * Uma ligação para a publicação em vez de um botão que atualiza, porque
     * daqui não há nada para atualizar: o Pelican não tem comando de
     * atualização, e o Wings não tem um endpoint que substitua o próprio
     * binário. A indicação diz onde o trabalho acontece de facto, para que
     * ninguém procure um botão que nunca foi possível.
     */
    'version_release' => 'O que há de novo',
    'version_how_panel' => 'Abre as notas de versão. O painel atualiza-se na máquina onde corre - o painel não pode substituir os seus próprios ficheiros, e nenhum plugin pode executar comandos de shell.',
    'version_how_wings' => 'Abre as notas de versão. O Wings atualiza-se no próprio nó - o painel não tem nenhum canal para um programa que corre noutra máquina.',

    'wings_latest' => 'Mais recente :version',
    'load_cores' => ':percent % de :cores processadores',
    'load_windows' => ':five em 5 min · :fifteen em 15 min',
    'uptime_since' => 'Desde :date',
    'unavailable' => 'Não disponível neste anfitrião',

    'fact_os' => 'Sistema operativo',
    'fact_hostname' => 'Nome do anfitrião',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processadores',
    'fact_processes' => 'Processos',
];
