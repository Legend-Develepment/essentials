<?php

/*
 * Português do Brasil. Escrito à mão.
 *
 * A página dos módulos.
 *
 * Um arquivo próprio em vez de um canto do settings.php, que já é o maior
 * arquivo de idioma deste plugin.
 */

return [
    'title' => 'Módulos',
    'nav_label' => 'Módulos',
    'subheading' => 'O que este plugin é neste painel. Tudo aqui pode ser desligado, e desligar algo nunca apaga o que ele já registrou.',

    'first_title' => 'Para que serve este painel?',
    'first_helper' => 'Responda uma vez e as partes que combinam ficam ligadas. Nada fica preso por isso: cada interruptor abaixo continua sendo seu, e desligar algo nunca apaga o que já foi registrado.',
    'first_look' => 'Principalmente a aparência',
    'first_look_helper' => 'Cores, a tela de entrada, os avisos, seus próprios links e as páginas para mudá-los. Nada que venda, responda ou saia do painel.',
    'first_run' => 'Manter servidores rodando, para mim ou um time',
    'first_run_helper' => 'A aparência, mais o que um servidor mostra e o que está cheio ou parado. Sem loja, sem balcão de tickets e sem nada mandando email num temporizador.',
    'first_sell' => 'Vender hospedagem para clientes',
    'first_sell_helper' => 'Tudo. Uma loja sem lugar para responder perguntas, e sem nada olhando os nodes, é meia loja.',
    'first_skip' => 'Eu mesmo escolho',

    'first_left' => 'Fica como está. Os interruptores estão todos abaixo.',
    'go' => 'Configurar',

    'state_on' => 'Ligado',
    'state_part' => 'Em parte',
    'state_off' => 'Desligado',

    'count' => '{1} :on de :of parte ligada|[2,*] :on de :of partes ligadas',
    'parts' => '{1} A única parte|[2,*] As :count partes',

    'health_tables' => 'As tabelas dele ainda não existem. Salvar qualquer coisa nesta página cria elas.',
    'health_missing' => '{1} Uma parte precisa de algo que está desligado|[2,*] :count partes precisam de algo que está desligado',
    'health_waiting' => '{1} Uma parte está ligada e ainda não mostra nada|[2,*] :count partes estão ligadas e ainda não mostram nada',

    'left_access' => '{1} Uma pessoa ainda tem um servidor concedido aqui|[2,*] :count pessoas ainda têm servidores concedidos aqui',
    'left_public_status' => '{1} Uma página publicada e o endereço dela ficam|[2,*] :count páginas publicadas e os endereços delas ficam',
    'left_arranger' => '{1} Uma disposição salva fica|[2,*] :count disposições salvas ficam',
    'left_user_themes' => '{1} O estilo escolhido de uma pessoa fica|[2,*] Os estilos escolhidos de :count pessoas ficam',
    'left_unknown' => 'Fica alguma coisa aqui, e o painel não conseguiu ler quanto.',
    'cleared' => '{1} Um retirado|[2,*] :count retirados',
    'clear_failed' => 'Isso não deu para limpar',

    'turn_on' => 'Ligar',
    'turn_off' => 'Desligar',

    'saved' => 'Salvo',
    'brought' => 'Ligadas junto, porque sem elas aqui nada funciona: :names.',
    'save_failed' => 'Não deu para salvar isso',
    'read_only' => 'Você pode ver isto e não mudar. Mudar o que o painel oferece pede a permissão mais ampla sobre este plugin.',
];
