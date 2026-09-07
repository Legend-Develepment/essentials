<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * «Nó» é a palavra que o Pelican usa em português para uma máquina, e é a que
 * se usa aqui; nas páginas públicas, onde lê alguém que nunca ouviu falar do
 * Pelican, é «máquina».
 */

return [
    'nav_label' => 'Capacidade',
    'title' => 'Se cabe mais um servidor',
    'subheading' => 'O que foi prometido em cada nó, face ao que ele pode distribuir.',

    'how' => 'Prometido, não consumido. Um nó pode estar a vinte por cento de ocupação e completamente cheio, porque «cheio» fala do que foi distribuído e não do que está a correr — o bloco Máquinas do painel principal responde à outra pergunta, e fica onde está. A conta feita aqui é a do próprio Pelican, tirada do método que decide se um servidor pode sequer ser criado: a capacidade vezes um mais a sobrealocação, face à soma do que foi prometido a cada servidor do nó. Uma capacidade de zero significa ilimitado, e uma sobrealocação abaixo de zero também — daí as linhas sem percentagem, em vez de uma barra cheia ou vazia.',

    'column_node' => 'Máquina',
    'column_fullest' => 'Mais cheio',
    'column_memory' => 'Memória',
    'column_disk' => 'Disco',
    'column_cpu' => 'Processador',
    'column_at_limit' => 'Num limite',

    'servers' => ':count servidores',

    'filter_tight' => 'Quase cheias',

    'open' => 'Abrir a máquina',

    'empty' => 'Não há máquinas que consiga alcançar.',
];
