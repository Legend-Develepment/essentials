<?php

/*
 * Português (Brasil). Escrito à mão.
 *
 * O seletor da barra de cima, e a página para onde ele leva.
 *
 * Um único controle que responde às duas perguntas que as pessoas fazem o tempo
 * todo - qual servidor, e onde estavam aquelas configurações - e uma página com
 * tudo o que alguém marcou. Veja Support\Quick.
 */

return [
    // ---- o controle na barra de cima -------------------------------------
    'label' => 'Ir para',
    'open' => 'Ir para um servidor ou para uma página marcada',
    'search' => 'Buscar servidores…',

    'favourites' => 'Favoritos',
    'servers' => 'Servidores',
    'pages' => 'Páginas',

    'loading' => 'Buscando…',
    'empty' => 'Nada encontrado.',
    // Dito em vez de escondido: uma lista que para em silêncio nos vinte e
    // cinco parece uma busca incapaz de achar as coisas.
    'more' => 'Há mais resultados do que cabem aqui - digite um pouco mais.',
    'failed' => 'Não foi possível contatar o painel, então esta lista pode estar desatualizada. O console do navegador diz o que a requisição respondeu.',

    'star_page' => 'Marcar esta página',
    'unstar_page' => 'Marcada - clique para tirar',
    'all' => 'Ver tudo',

    // ---- a página --------------------------------------------------------
    'title' => 'Favoritos',
    'nav_label' => 'Favoritos',
    'subheading' => 'Tudo o que você marcou, em um só lugar.',

    'how' => 'Marque um servidor pela estrela do cartão dele na lista de servidores, e uma página pelo botão do menu «Ir para», no topo da tela. Sua lista fica guardada no painel e não neste navegador, então ela vai com você para o próximo lugar onde entrar.',
    'page_empty' => 'Ainda não há nada marcado.',
    'remove' => 'Tirar dos favoritos',
];
