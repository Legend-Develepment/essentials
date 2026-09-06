<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * O bloco do painel inicial: a máquina onde o painel está, e cada nó.
 *
 * Os números dos nós são os do próprio Pelican, lidos do daemon de cada nó. A
 * linha do painel é lida em /proc, o que é outra pergunta - veja
 * Support\SystemStatus.
 */

return [
    // O título do bloco é o nome do próprio plugin, lido em tempo de execução:
    // por isso não há texto para ele aqui.
    'panel' => 'Este painel',
    'offline' => 'não responde',
    'maintenance' => 'manutenção',
    'cpu' => 'CPU',
    'memory' => 'Memória',
    'disk' => 'Disco',
    'load' => 'Carga',
];
