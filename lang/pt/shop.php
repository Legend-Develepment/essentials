<?php

/*
 * Português. Escrito à mão.
 *
 * As definições da loja, e mais tarde a própria loja.
 *
 * Dois leitores partilham este ficheiro de propósito. A metade das definições
 * é lida pelo administrador; as metades pública e de cliente - acrescentadas
 * à medida que a loja cresce - são lidas por gente que talvez nunca tenha
 * ouvido falar do Pelican, e cada frase aí tem de ser escrita para eles.
 */

return [
    'title' => 'Definições da loja',
    'nav_label' => 'Definições da loja',
    'subheading' => 'A moeda, o imposto, como as faturas são numeradas e o que a página pública diz. O que está à venda está na página Pacotes.',

    // ---- onde está -------------------------------------------------------
    'address' => 'A loja pública está em',
    'address_off' => 'A página pública está desligada. Ligue «Página pública da loja» na lista de funcionalidades da página Definições do Essentials e ela responde em :url.',

    // ---- geral -----------------------------------------------------------
    'section_general' => 'Dinheiro',
    'section_general_helper' => 'Uma moeda para toda a loja. Cada preço de cada pacote é um número nela.',
    'currency' => 'Moeda',
    'currency_helper' => 'Mudá-la não converte nada: os preços nos pacotes são números, e depois de uma mudança são números na nova moeda.',
    'tax' => 'Imposto',
    'tax_helper' => 'Uma percentagem acrescentada a cada fatura como linha própria. Os preços nos pacotes são sem imposto. Zero para nenhum.',
    'tax_suffix' => '%',
    'prefix' => 'Os números de fatura começam por',
    'prefix_helper' => 'Seguido de um número que vai subindo. INV- dá INV-000001.',

    // ---- renovações ------------------------------------------------------
    'section_renewals' => 'Renovações',
    'section_renewals_helper' => 'Para pacotes faturados ao mês, ao trimestre ou ao ano. Um pacote de pagamento único nunca é tocado por isto.',
    'notice_days' => 'Faturar estes dias antes do fim do período',
    'notice_days_helper' => 'Quando a fatura seguinte é criada e o cliente é avisado.',
    'grace' => 'Suspender estes dias depois do vencimento de uma fatura',
    'grace_helper' => 'Uma fatura por pagar para lá disto suspende o servidor — a suspensão do próprio Pelican, levantada assim que a fatura é paga. A loja nunca elimina nada.',
    'days' => 'dias',

    // ---- a página pública ------------------------------------------------
    'section_public' => 'A página pública',
    'section_public_helper' => 'Lida por gente sem conta. Se é servida ou não é o interruptor «Página pública da loja» na lista de funcionalidades.',
    'heading' => 'Título',
    'heading_helper' => 'Deixado vazio, é usado o nome do próprio painel.',
    'note' => 'Uma linha por cima dos pacotes',
    'note_helper' => 'Para dizer quem é, ou o que comprar dá a alguém. Texto simples.',
    'terms_url' => 'Condições',
    'terms_url_helper' => 'Um endereço https. Se estiver definido, comprar significa marcar uma caixa que aponta para ele.',

    // ---- pagar à mão -----------------------------------------------------
    'section_manual' => 'Pagar sem fornecedor',
    'section_manual_helper' => 'Mostrado numa fatura por pagar enquanto nenhum fornecedor de pagamento estiver ligado: dados bancários, ou para onde enviar o dinheiro. Texto simples.',
    'pay_note' => 'Como pagar',
    'pay_note_helper' => 'Deixe vazio e uma fatura por pagar diz apenas que está por pagar.',

    // ---- os botões -------------------------------------------------------
    'save' => 'Guardar',
    'saved' => 'Guardado',
    'save_failed' => 'Nada foi guardado',
];
