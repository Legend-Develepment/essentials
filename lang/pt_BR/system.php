<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * «Swap», «Load average», «Wings» e «Uptime» ficam em inglês: são os nomes com
 * que se acham no host e na própria interface do Pelican.
 */

return [
    'title' => 'Status do sistema',
    'nav_label' => 'Status do sistema',
    'subheading' => 'A máquina em que o próprio painel roda, o que ela tem rodando, e ao lado cada nó que você pediu.',

    'options' => 'Opções',
    'enabled' => 'Mostrar na barra lateral',
    'enabled_helper' => 'Desligado tira a entrada da barra lateral. A página mantém o endereço dela, então está sempre lá para ligar de novo.',

    'refresh' => 'Reler a cada',
    'refresh_helper' => 'A página inteira é pedida de novo nesse intervalo. Desligado deixa ela como estava quando você abriu.',
    'refresh_off' => 'Só quando eu abrir',
    'refresh_seconds' => ':seconds segundos',

    'blocks' => 'Mostrar',
    'blocks_helper' => 'Marcado quer dizer visível. «Disco» é um cartão por sistema de arquivos, então uma partição raiz cheia não fica escondida atrás de uma montagem de dados pela metade.',
    'block_cpu' => 'Processador',
    'block_memory' => 'Memória',
    'block_swap' => 'Swap',
    'block_disk' => 'Disco',
    'block_load' => 'Load average',
    'block_uptime' => 'Uptime',
    'block_system' => 'Sistema',
    'block_version' => 'Versão do painel',
    // Nunca aparece - um cartão de nó leva o nome do próprio nó - mas blank()
    // pede por ele, e uma chave faltando imprimindo o próprio nome é um recurso
    // ruim.
    'block_node' => 'Nó',

    'nodes' => 'Nós a mostrar',
    'nodes_helper' => 'Um cartão para cada, ao lado do host do painel. Nada marcado não mostra nenhum — o painel inicial já tem um bloco com todos os nós. Cada um é perguntado ao daemon dele, então um intervalo curto e uma lista longa são muitas requisições.',

    'section_usage' => 'Uso',
    'section_host' => 'Este painel',
    'section_nodes' => 'Nós',

    'disk_panel' => 'O painel mora aqui',
    'wings' => 'Wings :version',
    'version_installed' => 'Instalada',
    'version_latest' => 'Mais recente',
    'version_current' => 'Em dia',
    'version_update' => 'Atualização disponível',
    'version_unknown' => 'Não foi possível checar',

    /*
     * O que um cartão atrasado oferece.
     *
     * Um link para a publicação em vez de um botão que atualiza, porque daqui
     * não há nada para atualizar: o Pelican não tem comando de atualização, e o
     * Wings não tem endpoint que troque o próprio binário. A dica diz onde o
     * trabalho acontece de verdade, para ninguém sair procurando um botão que
     * nunca foi possível.
     */
    'version_release' => 'O que há de novo',
    'version_how_panel' => 'Abre as notas de versão. O painel é atualizado na máquina em que ele roda - o painel não pode trocar os próprios arquivos, e nenhum plugin pode rodar comandos de shell.',
    'version_how_wings' => 'Abre as notas de versão. O Wings é atualizado no próprio nó - o painel não tem canal nenhum para um programa que roda em outra máquina.',

    'wings_latest' => 'Mais recente :version',
    'load_cores' => ':percent % de :cores processadores',
    'load_windows' => ':five em 5 min · :fifteen em 15 min',
    'uptime_since' => 'Desde :date',
    'unavailable' => 'Não disponível neste host',

    'fact_os' => 'Sistema operacional',
    'fact_hostname' => 'Nome do host',
    'fact_php' => 'PHP',
    'fact_cores' => 'Processadores',
    'fact_processes' => 'Processos',
];
