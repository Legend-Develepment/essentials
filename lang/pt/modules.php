<?php

/*
 * Português (Portugal). Escrito à mão.
 *
 * A página dos módulos.
 *
 * Um ficheiro próprio em vez de um canto do settings.php, que já é o maior
 * ficheiro de idioma deste plugin.
 */

return [
    'title' => 'Módulos',
    'nav_label' => 'Módulos',
    'subheading' => 'O que este plugin é neste painel. Tudo aqui pode ser desligado, e desligar algo nunca apaga o que já ficou registado.',

    'first_title' => 'Para que serve este painel?',
    'first_helper' => 'Responde uma vez e as partes que combinam ficam ligadas. Nada fica preso por isso: cada interruptor abaixo continua a ser teu, e desligar algo nunca apaga o que já ficou registado.',
    'first_look' => 'Sobretudo o aspeto',
    'first_look_helper' => 'Cores, o ecrã de entrada, os anúncios, as tuas ligações e as páginas para as mudar. Nada que venda, responda ou saia do painel.',
    'first_run' => 'Manter servidores a andar, para mim ou uma equipa',
    'first_run_helper' => 'O aspeto, mais o que um servidor mostra e o que está cheio ou parado. Sem loja, sem balcão de tickets e sem nada a enviar correio num temporizador.',
    'first_sell' => 'Vender alojamento a clientes',
    'first_sell_helper' => 'Tudo. Uma loja sem sítio para responder a perguntas, e sem nada a vigiar os nodes, é meia loja.',
    'first_skip' => 'Escolho eu',

    'first_left' => 'Fica como está. Os interruptores estão todos abaixo.',
    'go' => 'Configurar',

    'state_on' => 'Ligado',
    'state_part' => 'Em parte',
    'state_off' => 'Desligado',

    'count' => '{1} :on de :of parte ligada|[2,*] :on de :of partes ligadas',
    'parts' => '{1} A única parte|[2,*] As :count partes',

    'health_tables' => 'As suas tabelas ainda não existem. Guardar qualquer coisa nesta página cria-as.',
    'health_missing' => '{1} Uma parte precisa de algo que está desligado|[2,*] :count partes precisam de algo que está desligado',
    'health_waiting' => '{1} Uma parte está ligada e ainda não mostra nada|[2,*] :count partes estão ligadas e ainda não mostram nada',

    'left_access' => '{1} Uma pessoa ainda tem um servidor concedido aqui|[2,*] :count pessoas ainda têm servidores concedidos aqui',
    'left_public_status' => '{1} Uma página publicada e o seu endereço ficam|[2,*] :count páginas publicadas e os seus endereços ficam',
    'left_arranger' => '{1} Uma disposição guardada fica|[2,*] :count disposições guardadas ficam',
    'left_user_themes' => '{1} O estilo escolhido de uma pessoa fica|[2,*] Os estilos escolhidos de :count pessoas ficam',
    'left_unknown' => 'Fica aqui alguma coisa, e o painel não conseguiu ler quanta.',
    'cleared' => '{1} Um retirado|[2,*] :count retirados',
    'clear_failed' => 'Isso não pôde ser limpo',

    'turn_on' => 'Ligar',
    'turn_off' => 'Desligar',

    'saved' => 'Guardado',
    'brought' => 'Ligadas junto, porque sem elas aqui nada funciona: :names.',
    'save_failed' => 'Não foi possível guardar isso',
    'read_only' => 'Podes ver isto e não o alterar. Alterar o que o painel oferece pede a permissão mais ampla sobre este plugin.',
];
